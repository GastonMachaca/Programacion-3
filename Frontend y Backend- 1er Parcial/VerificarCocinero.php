<?php

    include "./clases/Cocinero.php";
   
    $email = $_POST['email'];
    $clave = $_POST['clave'];
    $especialidad = "";

    $verificar = new stdClass();
    $verificar->exito = false;
    $verificar->mensaje = "Fallo al verificar y crear una cookie.";
    
    $c1 = new Cocinero("",$email,$clave);

    $aux = json_decode(Cocinero::VerificarExistencia($c1));

    if($aux->exito == true)
    {
        $listaJSON = Cocinero::TraerTodos();

        foreach($listaJSON as $lista)
        {
            if($lista->email == $email && $lista->clave == $clave)
            {
                $especialidad = $lista->especialidad;
                break;
            }
        }

        $cadena = date("Gis") . $aux->mensaje;

        $cookieEmail = str_replace(".","_",$email);

        setcookie($cookieEmail . "_" . $especialidad, $cadena);

        $verificar->exito = true;
        $verificar->mensaje = "Se encontro al cocinero y creo la cookie con exito." . $aux->mensaje;

    }
    else
    {
        echo $aux->mensaje;
    }

    echo json_encode($verificar);
?>