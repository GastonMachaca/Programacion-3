
<?php

    include "../php/fabrica.php";
    
    $altaNombre = empty($_POST["Nombre"]);
    $altaApellido = empty($_POST["Apellido"]);
    $altaDni = empty($_POST["DNI"]);
    $altaSexo = empty($_POST["selectSexo"]);
    $altaLegajo = empty($_POST["Legajo"]);
    $altaSueldo = empty($_POST["Sueldo"]);
    $altaTurnos= empty($_POST["turnos"]);

    $destinoFotos = "../fotos/". $_FILES["Foto"]["name"];

    $array = array("png","jpg","gif","bmp","jpeg");
    
    $validarFoto = false;
    $auxEmpleado = false;

    $auxModificar = false;

    if($_FILES['Foto']['name'] != null)
    {
        $validarFoto = true;
    }

    if($altaNombre || $altaApellido || $altaDni || $altaSexo || $altaLegajo || $altaSueldo || $altaTurnos || $validarFoto == false)
    {
        echo "<h4>" . "Fallo al intentar agregar el empleado, falto rellenar campos en el formulario." . "</h4>";
        echo "<a href='../php/index.php'>Ir a formulario</a>";
    }
    else
    {
        if(getimagesize($_FILES["Foto"]["tmp_name"]) != false)
        {
            for($i = 0;$i< count($array);$i++)
            {
                if(pathinfo($destinoFotos, PATHINFO_EXTENSION) == $array[$i])
                {
                    if($_FILES["Foto"]["size"] <= 1000000)
                    {
                        $auxEmpleado = true;
                        break;
                    }
                }
            }
        }
    }

    
    if($auxEmpleado == true)
    {
        $verif = 0;

        $auxFotos = "../fotos/". $_POST["DNI"] . "-" . $_POST["Apellido"] . "." . pathinfo($destinoFotos, PATHINFO_EXTENSION);

        $empleado1 = new Empleado($_POST['Nombre'],$_POST['Apellido'],(int)$_POST['DNI'],$_POST['selectSexo'],(int)$_POST['Legajo'],$_POST['Sueldo'],$_POST['turnos']);

        $empleado1->SetPathFoto($auxFotos);

        if($_POST["hdnModificar"] != "")
        {
            $fabrica = new Fabrica("Modificar");
            $fabrica->TraerDeArchivo("empleados.txt");
 
            $aux = $fabrica->GetEmpleados();

            for($i = 0; $i<count($aux); $i++)
            {
                if($aux[$i]->GetDni() == $_POST["DNI"])
                {
                    $fabrica->EliminarEmpleado($aux[$i]);

                    unlink($aux[$i]->GetPathFoto());

                    $fabrica->AgregarEmpleado($empleado1);

                    if(move_uploaded_file($_FILES["Foto"]["tmp_name"],$auxFotos))
                    {
                        echo "<br/>El archivo  " . basename($_FILES["Foto"]["name"]). " ha sido subido exitosamente y modificado con DNI y Apellido del empleado.";
                    }

                    $fabrica->GuardarEnArchivo("empleados.txt");

                    break;
                }
            }
        }
        else
        {
            $fabrica = new Fabrica("Administracion");

            $fabrica->TraerDeArchivo("empleados.txt");
    
            $auxArray = $fabrica->GetEmpleados();

            for($i = 0; $i < count($auxArray); $i++)
            {
                if($auxArray[$i]->GetDni() == $_POST["DNI"] || $auxArray[$i]->GetLegajo() == $_POST["Legajo"] ) 
                {
                    $verif = 1;
                    break;
                }
            }

            if($verif == 0)
            {
                if($fabrica->AgregarEmpleado($empleado1)== false)
                {
                    echo "Se ha superado la capacidad de la fabrica.";
                }
                else
                {
                    echo "Empleado agregado y guardado con exito";
                }

                $fabrica->GuardarEnArchivo("empleados.txt");
    
                if(move_uploaded_file($_FILES["Foto"]["tmp_name"],$auxFotos))
                {
                    echo "<br/>El archivo  " . basename($_FILES["Foto"]["name"]). " ha sido subido exitosamente y modificado con DNI y Apellido del empleado.";
                }
                //header('Location: ../ajax/ajax_test.php'); 
            }
            else
            {
                echo "El empleado no se agrego a la fabrica. Ya existe dni o legajo ingresado.";
            }

        }
    }
    else
    {
        echo "La imagen que intento ingresar no corresponde a los aceptados por la pagina. Vuelva a intentarlo.";
    }

     
    echo "</br> " . "<a href='../php/mostrar.php'>Ir a Mostrar.php</a>";

    echo "</br> " . "<a href='../php/index.php'>Ir a formulario</a>";

?>