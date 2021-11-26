<?php

class Cocinero
{
    private $especialidad;
    private $email;
    private $clave;


    public function __construct($especialidad,$email,$clave)
    {
        $this->especialidad = $especialidad;
        $this->email = $email;
        $this->clave = $clave;
    }

    public function ToJSON()
    {     
	    $cocinero = new stdClass();
	    $cocinero->especialidad = $this->especialidad;
	    $cocinero->email = $this->email;
        $cocinero->clave = $this->clave;

        return json_encode($cocinero);
    }

    public function GuardarEnArchivo()
    {
        $cocinero = new stdClass();
        $cocinero->exito= false;
        $cocinero->Mensaje = "Fallo al agregar al cocinero.";

        $path = "./archivos/cocinero.json";

        if(file_exists($path))
        {
            $aux = fopen($path,"a");

            $resultado = file_get_contents($path);
            $tempArray = json_decode($resultado);

            $auxArray = json_decode(Cocinero::ToJSON());
            $tempArray[] = $auxArray;
            $json = json_encode($tempArray);

            if(file_put_contents($path, $json) != false)
            {
                $cocinero->exito= true;
                $cocinero->Mensaje = "Se agrego al cocinero con exito.";    
            }  

            fclose($aux);

        }
        else
        {
            fopen($path,"w");
        }

        return json_encode($cocinero);
    }

    public static function TraerTodos()
    {
        $path = "./archivos/cocinero.json";

        if(file_exists($path))
        {
            $archivo = fopen($path,"r");

            $cadena = '';

            while(!feof($archivo))
            {
                $cadena .= fgets($archivo);
            }

            fclose($archivo);

            $aux = json_decode($cadena);

            $auxArray = array();

            foreach($aux as $cocineros)
            {
                $lista = new stdclass();
                $lista->especialidad = $cocineros->especialidad; 
                $lista->email = $cocineros->email;
                $lista->clave = $cocineros->clave;

                array_push($auxArray, $lista);
            }
        }

        return $auxArray;
    }

    public static function VerificarExistencia($cocinero)
    {
        $array = Cocinero::TraerTodos();

        $cantCocinerosEsp = 0; 
        $aux = new stdClass();
	    $aux->exito = false;
	    $aux->mensaje = "";

        foreach($array as $lista)
        {
            if($lista->email == $cocinero->email && $lista->clave == $cocinero->clave)
            {
                $aux->exito = true;
                $especialidad = $lista->especialidad;
                break;
            }
        }

        if($aux->exito == true)
        {
            foreach($array as $lista)
            {
                if($lista->especialidad == $especialidad)
                {
                    $cantCocinerosEsp++;
                }
            }

            $aux->mensaje = "La cantidad de cocineros que estan registrados con la misma especialidad son " . $cantCocinerosEsp . ".";

        }
        else
        {
            $out = array();
            $linea = "";
            $listaString = "";
            $numero = 0;
            $auxNumero = 0;
            $masPopular = "";

            foreach($array as $lista)
            {
                array_push($out,$lista->especialidad);
            }
            
            $valores = array_count_values($out);
        
            while (current($valores)) 
            {
                $linea .= key($valores).',';

                next($valores);
            }

            $verdadero = rtrim($linea,",");

            $porciones = explode(",", $verdadero);

            $cantPorciones = count($porciones);

            for($i=0;$i<count($array);$i++)
            {
                $listaString .= $array[$i]->especialidad;
            }
            
            for($i=0;$i<$cantPorciones;$i++)
            {
                $numero = substr_count($listaString,$porciones[$i]);

                if($i == 0)
                {
                    $auxNumero = $numero;
                    $masPopular = $porciones[$i];
                }
                else
                {
                    if($auxNumero > $numero)
                    {
                        
                    }   
                    else
                    {
                        $masPopular .= $porciones[$i];
                    }
                }
            }

            echo "La/las especialidad/es mas popular/es son : " . $masPopular;
        }
        
        return json_encode($aux);
    }


}

?>