<?php

    include "./clases/Receta.php";

    $nombre = $_POST['nombre'];
    $ingredientes = $_POST['ingredientes'];
    $tipo = $_POST['tipo'];

    $horario = date('h');
    $horario .= date('i');
    $horario .= date('s');
    $horario = str_replace(":","",$horario);

    $extension = $_FILES["foto"]["name"];

    $destinoFoto = "./recetas/imagenes/". $nombre . "." . $tipo . "." . $horario . "." . pathinfo($extension, PATHINFO_EXTENSION);

    $nombreFoto = $nombre . "." . $tipo . "." . $horario . "." . pathinfo($extension, PATHINFO_EXTENSION);

    $verificar = new stdClass();
    $verificar->exito = false;
    $verificar->mensaje = "Fallo al agregar la receta a la base de datos.";

    $r1 = new Receta($nombre,$ingredientes,$tipo,$nombreFoto);

    $array = $r1->Traer();

    if($r1->Existe($array))
    {
        $verificar->mensaje = "La receta ya existe en la base de datos.";
    }
    else
    {
        if($r1->Agregar())
        {
            move_uploaded_file($_FILES["foto"]["tmp_name"],$destinoFoto);

            $verificar->exito = true;
            $verificar->mensaje = "Se agrego la receta a la base de datos.";
        }
    }

    echo json_encode($verificar);

?>