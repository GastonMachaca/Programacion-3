<?php

    include "./clases/Receta.php";

    $r1 = new Receta();

    $array = $r1->Traer();

    if(isset($array))
    {

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        table,th,td
        {
            background: white;
            padding: auto;
            margin: auto;
            font-family: 'Times new Roman';
            color: black;
            border: 1px solid black;
            border-collapse: separate;
        }
    </style>

    <title>Tabla Base de datos</title>
</head>
<body>
    <table>
        <tr><th>ID</th><th>NOMBRE</th><th>INGREDIENTES</th><th>TIPO</th><th>FOTO</th></tr>
        <?php
        
        for($i = 0; $i < count($array);$i++)
        {
            $mensaje = "<tr><td> {$array[$i]->id}</td><td>{$array[$i]->nombre}</td><td>{$array[$i]->ingredientes}</td><td>{$array[$i]->tipo}</td> <td>";

            if($array[$i]->foto != "vacio" && $array[$i]->foto != null)
            {
                if(strpos($array[$i]->foto, "modificado") !== false)
                {
                    $mensaje .= "<img src='". "./recetasModificadas/" . $array[$i]->foto ."'width='90' height='90'</td></tr>";
                } 
                else
                {
                    $mensaje .= "<img src='". "./recetas/imagenes/" . $array[$i]->foto ."'width='90' height='90'</td></tr>";
                }
            }
            else
            {
                $mensaje .= 'Sin foto'. "</td>";
            }
            
            //$mensaje .= "<img src='". "./recetas/imagenes/" . $array[$i]->foto ."'width='90' height='90'</td></tr>";

            echo $mensaje;
        }
        ?>
    </table>

</body>
</html>

<?php
    }  
?>