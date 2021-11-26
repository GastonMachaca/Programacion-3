<?php

    include "./clases/Receta.php";

    $receta = $_POST['receta_json'];

    $aux = json_decode($receta);

    $nombre = $aux->nombre;
    $ingredientes = $aux->ingredientes;
    $tipo = $aux->tipo;
    $foto = $aux->foto;

    $validacion = false;

    $verificar = new stdClass();
    $verificar->exito = false;
    $verificar->mensaje = "Fallo al modificar la receta.";

    $horario = date('h');
    $horario .= date('i');
    $horario .= date('s');
    $horario = str_replace(":","",$horario);

    $extension = $_FILES["foto"]["name"];

    $destinoFoto = "./recetasModificadas/". $nombre . "." . $tipo . ".modificado." . $horario . "." . pathinfo($extension, PATHINFO_EXTENSION);

    $nombreFoto = $nombre . "." . $tipo . ".modificado." . $horario . "." . pathinfo($extension, PATHINFO_EXTENSION);

    $auxReceta = new Receta();
    $arrayRecetas = $auxReceta->Traer();

    if(isset($arrayRecetas))
    {
        for($i = 0; $i < count($arrayRecetas);$i++)
        {
            if($arrayRecetas[$i]->nombre == $nombre && $arrayRecetas[$i]->ingredientes == $ingredientes && $arrayRecetas[$i]->tipo == $tipo && $arrayRecetas[$i]->foto == $foto)
            {
                $id = $arrayRecetas[$i]->id;
                $validacion = true;
            }
        }
    }

    if($validacion == true)
    {
        $r1 = new Receta($nombre,$ingredientes,$tipo,$nombreFoto,$id);

        if($r1->Modificar())
        {
            $verificar->exito = true;
            $verificar->mensaje = "Exito al modificar la receta.";

            move_uploaded_file($_FILES["foto"]["tmp_name"],$destinoFoto);
        }
    }

    echo json_encode($verificar);
?>