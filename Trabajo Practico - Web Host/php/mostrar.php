<?php

    include "./validarSesion.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src = "../javascript/funciones.js" ></script>
    <script src = "../ajax/ajax.js" ></script>
    <script src = "../ajax/app.js" ></script>

    <link rel="stylesheet" href="../css/style.css">
    
    <title>HTML 5 &#45 Listado de Empleados </title>

</head>

<body>

    <section class = "FormMostrar">
        
    <h2>Listado de Empleados</h2>

    <form class = "mostrar" method="POST">
        <h4>Info</h4>
        <hr>
        <table>
            <tbody>
            <tr>
                <?php
                    include "./fabrica.php";

                    $auxFabrica = new Fabrica("Mostrar");

                    $auxFabrica->TraerDeArchivo("empleados.txt");

                    $auxArray = $auxFabrica->GetEmpleados();

                    
                    for($i = 0; $i < count($auxArray);$i++)
                    {
                        $mensaje = $auxArray[$i]->GetDni() . " - " .  $auxArray[$i]->GetNombre() . " - " . $auxArray[$i]->GetApellido() . " - " . $auxArray[$i]->GetSexo() . " - " . $auxArray[$i]->GetLegajo() . " - " . $auxArray[$i]->GetSueldo() . " - " . $auxArray[$i]->GetTurno() . " - " . $auxArray[$i]->GetPathFoto();

                        echo " <tr><td> " . $mensaje . "<td> <img src='".$auxArray[$i]->GetPathFoto()."'width='90' height='90'</td>" ."</td>";
                        
                        //echo '<td><a href="../backend/eliminar.php?legajo='.$auxArray[$i]->GetLegajo().'">Eliminar</a></td>';

                        echo '<td><a href="javascript:EliminarEmpleadoExterno('.$auxArray[$i]->GetLegajo().')">Eliminar</a></td>';

                        //echo "<td><input type=button onclick='AdministrarModificar(" . $auxArray[$i]->GetDni() . ")' value='Modificar' /></td>";

                        echo '<td><input onclick="Main.ModificarEmpleado('.$auxArray[$i]->GetDni().')" type="button" value="Modificar" /></td>';

                    }
                ?>
            </tr>
          </tbody>
        </table>
        <hr>
    </form>

    <form action = "./index.php" method="POST" style = "display: none" id="modificar"> 

        <input type = "hidden" id= "dniHidden" name= "dniHidden"/>

    </form>
    <br>

    </section>
    <!--<a style = "margin-left: 330px;" href="./index.php">Alta de Empleados</a>

    <a style = "margin-left: 450px;" href="./cerrarSesion.php">Cerrar sesion</a>-->
</body>
</html>



