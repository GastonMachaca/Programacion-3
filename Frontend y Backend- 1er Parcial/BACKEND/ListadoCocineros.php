<?php

    include "./clases/Cocinero.php";

    $aux = Cocinero::TraerTodos();
    
    if(count($aux) > 0)
    {
        $json = json_encode($aux);
    }
    else
    {
        $json = "{}";
    }

    echo $json;
    
?>