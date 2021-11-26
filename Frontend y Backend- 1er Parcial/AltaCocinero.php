<?php

    include "./clases/Cocinero.php";

    $especialidad = $_POST['especialidad'];
    $email = $_POST['email'];
    $clave = $_POST['clave'];


    $c1 = new Cocinero($especialidad,$email,$clave);

    echo $c1->GuardarEnArchivo();

?>