<?php

    $altaApellido = $_POST["Apellido"];
    $altaDni = $_POST["DNI"];
    $bandera = false;

    if(file_exists("../archivos/empleados.txt"))
    {
        $archivo = fopen("../archivos/empleados.txt","r");

        while(!feof($archivo))
        {
            $empleado = fgets($archivo);
            $empleado = is_string($empleado) ? trim($empleado) : false;

            $array_aux = explode(" ",$empleado);

            if(count($array_aux)>1)
            {
                if($array_aux[0] != "" && $array_aux[0] != "\r\n")
                {
                    if($array_aux[7] == $altaDni && $array_aux[4] == $altaApellido)
                    {
                        session_start();
                        $bandera = false;
                        $_SESSION["DNIEmpleado"] = $_POST["DNI"];
                        header('Location: ../ajax/ajaxMenu.php');
                    }
                    else
                    {
                        $bandera = true;    
                    }
                }
            }
        }

        fclose($archivo);
    }

    if($bandera == true)
    {
        header('Location: ../login.html');
        echo "No se encontro el empleado en la lista." . "<br>" . "<a href='../login.html'>Volver al login</a>";
    }
?>