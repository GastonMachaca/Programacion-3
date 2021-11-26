<?php

    include "./clases/Receta.php";

    //$c1 = new Cocinero($especialidad,$email,$clave);

    //echo $c1->GuardarEnArchivo();

    $verificar = new stdClass();
    $verificar->exito = false;
    $verificar->mensaje = "Fallo al borrar la receta.";

    $validacion= 0;
    $contador = 0;

    $r1 = new Receta();

    $array = $r1->Traer();
    
    if(isset($_GET['nombre']))
    {
        $nombre = $_GET['nombre'];
        
        for($i = 0;$i< count($array);$i++)
        {
            if($nombre == $array[$i]->nombre)
            {
                $verificar->mensaje = "La receta se encuentra en la base de datos";
                $validacion = 1;
                echo $verificar->mensaje;
                break;
            }
        }

        if($validacion == 0)
        {
            $verificar->mensaje = "La receta no se encuentra en la base de datos";
        }
    }
    else
    {
        $contador++;
    }

    if(isset($_POST['receta_json']) && isset($_POST['accion']))
    {
        $auxReceta = json_decode($_POST['receta_json']);

        if($_POST['accion'] == "borrar")
        {
            $id = $auxReceta->id;
            $nombre = $auxReceta->nombre;
            $tipo = $auxReceta->tipo;
            $ingredientes = "No tiene";

            if(isset($array))
            {
                for($i = 0; $i < count($array);$i++)
                {
                    if($array[$i]->id == $id && $array[$i]->nombre == $nombre && $array[$i]->tipo == $tipo)
                    {
                        $ingredientes = $array[$i]->ingredientes;
                        $foto = $array[$i]->foto;
                        $validacion = true;
                    }
                }
            }
            
            if($validacion == true)
            {
                $r2 = new Receta($nombre,$ingredientes,$tipo,$foto,$id);
                if($r2->Eliminar())
                {
                    $verificar->mensaje = "Se pudo eliminar con exito de la base de datos.";
                    $verificar->exito = true;
                    $r2->GuardarEnArchivo();
                }
                else
                {
                    $verificar->mensaje = "Error al eliminar la receta.";
                }
            }
            else
            {
                $verificar->mensaje = "No se encontro la receta a eliminar,deben de coincidir el id,nombre y tipo.";
            }
        }
    }
    else
    {
        $contador++;
    }

    if($contador == 2)
    {
        if(file_exists("./archivos/recetas_borradas.txt"))
        {
            $auxArchivo = fopen("./archivos/recetas_borradas.txt","r");

            $tabla = '<table style="background: black;padding: auto;margin-top: 50px;color: white;border: 1px solid black;border-collapse: separate;">';
            $tabla .= "<caption>Listado de Recetas</caption>";            
            $tabla .= "<tr><th>ID</th><th>NOMBRE</th><th>INGREDIENTES</th><th>TIPO</th><th>FOTO</th></tr>";

            while(!feof($auxArchivo))
            {
                $receta = fgets($auxArchivo);
                $receta = is_string($receta) ? trim($receta) : false;
    
                $newstring = rtrim($receta, "-");

                $aux = str_replace(",", "", $newstring);
   
                $array_aux = explode("-",$aux);
                
                $arrayReady = array();

                for($i = 0;$i < count($array_aux);$i++)
                {
                    $aux = $array_aux[$i];

                    $lista = explode(" ",$aux);

                    array_push($arrayReady,$lista);
                }

                foreach($arrayReady as $lista)
                {
                    $tabla .= "<tr>";
                    $tabla .= "<td>".$lista[0]."</td>";
                    $tabla .="<td>".$lista[1]."</td>";
                    $tabla .="<td>".$lista[2]."</td>";
                    $tabla .="<td>".$lista[3]."</td>";
                    $tabla .="<td>" .'<img src="'.$lista[4].'" width="50" height="50"'. "</td>";
                    $tabla .="</tr>";
                }

                $tabla .= '</table>';
            }

            echo $tabla;
            
            fclose($auxArchivo);
        }
    }
    else
    {
        echo json_encode($verificar);
    }

?>