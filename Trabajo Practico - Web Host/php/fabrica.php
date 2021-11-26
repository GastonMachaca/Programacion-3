<?php

include "interfaces.php";
include "empleado.php";

class Fabrica implements IArchivo
{
    private int $_cantidadMaxima;
    private $_empleados;
    private string $_razonSocial;

    public function __construct(string $razonSocial)
    {
        $this->_razonSocial = $razonSocial;
        $this->_cantidadMaxima = 7;
        $this->_empleados = array();

    }

    public function AgregarEmpleado(Empleado $emp)
    {
        $retorno = false;

        if(count($this->_empleados) < $this->_cantidadMaxima)
        {
            array_push($this->_empleados,$emp);
            $this->EliminarEmpleadosRepetidos();
            $retorno = true;
        }

        return $retorno;
    }

    public function CalcularSueldos()
    {
        $aux = 0;

        for($i = 0; $i < count($this->_empleados); $i++)
        {
            if($this->_empleados[$i] != null)
            {
                $aux += $this->_empleados[$i]->GetSueldo();
            }
        }

        return $aux;
    }

    public function GetEmpleados()
    {
        return $this->_empleados;
    }
    public function EliminarEmpleado(Empleado $emp)
    {
        $retorno = false;

        for($i = 0; $i < count($this->_empleados); $i++)
        {
            if($this->_empleados[$i] != null)
            {
                if($emp == $this->_empleados[$i])
                {
                    unset($this->_empleados[$i]);
                    sort($this->_empleados);
                    $retorno = true;
                }
            }
        }

        return $retorno;
    }

    private function EliminarEmpleadosRepetidos()
    {
        if(!empty($this->_empleados[count($this->_empleados)])) 
        {
            $this->_empleados = array_unique($this->_empleados,3);
        }
    }

    public function TraerDeArchivo($archivo = "empleados.txt")
    {
        if(file_exists("../archivos/" . $archivo))
        {
            $auxArchivo = fopen("../archivos/" . $archivo,"r");
    
            while(!feof($auxArchivo))
            {
                $empleado = fgets($auxArchivo);
                $empleado = is_string($empleado) ? trim($empleado) : false;
    
                $array_aux = explode(" ",$empleado);
    
                if(count($array_aux)>1)
                {
    
                    if($array_aux[0] != "" && $array_aux[0] != "\r\n")
                    {
                        $auxEmpleado = new Empleado($array_aux[1],$array_aux[4],(int)$array_aux[7],$array_aux[10],(int)$array_aux[13],$array_aux[16],$array_aux[19]);

                        $auxEmpleado->SetPathFoto($array_aux[22]);
    
                        $this->AgregarEmpleado($auxEmpleado);
                    }
    
                }
            }
            fclose($auxArchivo);
        }
    }

    public function GuardarEnArchivo($archivo = "empleados.txt")
    {
        $emp = fopen("../archivos/" . $archivo,"w");

        for($i = 0; $i < count($this->_empleados); $i++)
        {
            if($this->_empleados[$i] != null)
            {  
                fwrite($emp,$this->_empleados[$i]->ToString() . "\r\n");
            }
        }
    }


    public function ToString()
    {
        $mensaje = "<br> Cantidad maxima de empleados: " . $this->_cantidadMaxima . "<br>";

        $mensaje .= "Razon social: " . $this->_razonSocial . "<br>";

        $mensaje .= "Lista de empleados de la fabrica: " . "<br>";

        for($i = 0; $i < count($this->_empleados); $i++)
        {
            if($this->_empleados[$i] != null)
            {
                $mensaje .= $this->_empleados[$i]->ToString() . "<br>";
            }
        }

        return $mensaje;

    }
}

?>