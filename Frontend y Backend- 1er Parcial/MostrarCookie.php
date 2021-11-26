<?php

    $especialidad = $_GET['especialidad'];

    $email = $_GET['email'];

    $verificar = new stdClass();
    $verificar->exito = false;
    $verificar->mensaje = "Fallo al encontrar cookie.";

    $cookieEmail = str_replace(".","_",$email . "_" . $especialidad);

    if(isset($_COOKIE[$cookieEmail]))
    {
        $verificar->exito = true;
        $verificar->mensaje = "Se encontro la cookie. Contenido de la cookie : " . $_COOKIE[$cookieEmail];
    }

    echo json_encode($verificar);
?>