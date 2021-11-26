<?php

    include "./clases/Receta.php";

    $receta = $_POST['receta'];
    $mensaje = "";
    $retorno = false;
    $validarNombre = 0;
    $validarTipo = 0;

    $r1 = new Receta();

    $array = $r1->Traer();

    if(isset($array))
    {
        $aux = json_decode($receta);
        
        for($i = 0;$i< count($array);$i++)
        {
            if($aux->nombre == $array[$i]->nombre && $aux->tipo == $array[$i]->tipo)
            {
                echo $array[$i]->ToJSON();

                $retorno = true;

                break;
            }
            else
            {
                $retorno = false;
            }
        }

        if($retorno == false)   
        {
            for($i = 0;$i< count($array);$i++)
            {
                if($aux->nombre == $array[$i]->nombre)
                {
                    $validarNombre++;
                }

                if($aux->tipo == $array[$i]->tipo)
                {
                    $validarTipo++;
                }
            }

            if($validarNombre == 0)
            {
                $mensaje = "No coincide el nombre";
            }

            if($validarTipo == 0)
            {
                $mensaje = "No coincide el tipo";
            }

            if($validarNombre == 0 && $validarTipo == 0)
            {
                $mensaje = "No coincide ni por el nombre ni por tipo";
            }
            else
            {
                $mensaje = "El nombre y/o tipo existen pero no coincide la receta";
            }

            echo $mensaje;
        }
    }




?>