<?php
    include "../php/validarSesion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src = "ajax.js" ></script>
    <script src = "app.js" ></script>
    <script src = "../javascript/validaciones.js" ></script>

    <style>
        body
        {
            background-image: url("https://j.gifs.com/vllWEg.gif");
            background-position: center 50%; 
            background-size: cover; 
        }
    </style>
    <title>Menu AJAX</title>

</head>
<body>

    <section class = "MostrarAjax">

    <table>
        <thead>
            <caption><div id="nombre"></caption>
        </thead>
        <tbody>
            <td>
                <div id="divAlta">
            </td>
            <td>
                <div id="divMostrar">
            </td>
        </tbody>      
    </table>

    <h2><div id="cerrarSesion"></h2>
    </section>
</body>
</html>