<?php

    //include "empleado.php";
    include "../php/fabrica.php";

    $getLegajo = $_GET["legajo"];

    $bandera = false;

    $fabrica = new Fabrica("Eliminar");

    $fabrica->TraerDeArchivo("empleados.txt");

    $auxArray = $fabrica->GetEmpleados();

    for($i = 0; $i < count($auxArray); $i++)
    {
        if($auxArray[$i]->GetLegajo() == $getLegajo)
        {
            echo "Se encontro el legajo y se procede a eliminar. </br>";

            $fabrica->EliminarEmpleado($auxArray[$i]);

            unlink($auxArray[$i]->GetPathFoto());

            $fabrica->GuardarEnArchivo("empleados.txt");

            $bandera = true;

            break;
        }
    }

    /*if(file_exists("./archivos/empleados.txt"))
    {
        $archivo = fopen("./archivos/empleados.txt","r");
    
        while(!feof($archivo))
        {
            $empleado = fgets($archivo);
            $empleado = is_string($empleado) ? trim($empleado) : false;
    
            $array_aux = explode(" ",$empleado);
    
            if(count($array_aux)>1)
            {
                if($array_aux[0] != "" && $array_aux[0] != "\r\n")
                {                      
                    if($array_aux[13] == $getLegajo)
                    {
                        $auxEmpleado = new Empleado($array_aux[1],$array_aux[4],(int)$array_aux[7],$array_aux[10],(int)$array_aux[13],$array_aux[16],$array_aux[19]);

                        echo "</br>" . $auxEmpleado->ToString();

                        $auxFabrica = new Fabrica("Eliminar");

                        $auxFabrica->TraerDeArchivo("empleados.txt");

                        if($auxFabrica->EliminarEmpleado($auxEmpleado) == true)
                        {
                            $auxFabrica->GuardarEnArchivo("empleados.txt");
                            $bandera = false;
                            break;
                        }
                        else
                        {
                            echo "No se pudo eliminar el empleado";
                        }
                    }
                    else
                    {
                        $bandera = true;
                    }
                }
    
            }
        }
    
        fclose($archivo);
    }*/


    if($bandera == false)
    {
        echo "No hubo coincidencia en el legajo." . "</br>";
    }

    echo "</br> " . "<a href='../php/index.php'>Ir a alta de empleados</a>";
    echo "</br> " . "<a href='../php/mostrar.php'>Ir a mostrar.php</a>";

?>