<?php

    include "./clases/Receta.php";

    $nombre = $_POST['nombre'];
    $ingredientes = $_POST['ingredientes'];
    $tipo = $_POST['tipo'];

    
    $verificar = new stdClass();
    $verificar->exito = false;
    $verificar->mensaje = "Fallo al agregar el elemento a la base de datos.";

    $r1 = new Receta($nombre,$ingredientes,$tipo);

    if($r1->Agregar() == true)
    {
        $verificar->exito = true;
        $verificar->mensaje = "Se agrego con exito el elemento a la base de datos.";
    }

    echo json_encode($verificar);

?>