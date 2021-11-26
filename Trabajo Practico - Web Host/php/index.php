
<?php

    include "validarSesion.php";
    include "fabrica.php";

    $dni = isset($_POST['dniHidden']) ? $_POST['dniHidden'] : NULL;
    $titulo = "Agregar";
    $nombre = "";
    $apellido = "";
    $sexo = "";
    $legajo = "";
    $sueldo = "";
    $turno = "Mañana";

    if(isset($dni))
    {
        $fabrica = new Fabrica("index");

        $fabrica->TraerDeArchivo("empleados.txt");

        $auxArray = $fabrica->GetEmpleados();
        
        for($i=0;$i<count($auxArray);$i++)
        {
            if($auxArray[$i]->GetDni() == $dni)
            {
                $titulo = "Modificar";
                $turno = $auxArray[$i]->GetTurno();
                $nombre = $auxArray[$i]->GetNombre();
                $apellido = $auxArray[$i]->GetApellido();
                $sexo = $auxArray[$i]->GetSexo();
                $legajo = $auxArray[$i]->GetLegajo();
                $sueldo = $auxArray[$i]->GetSueldo();
            }
        }
    }
?>

<!doctype html>

<html>

<head>

<meta charset=“utf-8” />

<script src = "../javascript/funciones.js" ></script>
<script src = "../ajax/ajax.js" ></script>
<script src = "../ajax/app.js" ></script>

<link rel="stylesheet" href="../css/style.css">

<title>HTML 5 &#45 Formulario <?php echo $titulo; ?> Empleado </title>

</head>

<body>

        <section class = "FormAlta">
            
        <h2><?php echo $titulo; ?> de Empleados</h2>

        <form class = "alta" enctype="multipart/form-data" method="post">

         <!--<form class = "alta" enctype="multipart/form-data" action="../backend/administracion.php" method="post">-->
            
            <h4>Datos Personales</h4>
            <hr>
            <table>
                <tr>
                    <td>DNI:</td><td><input class= "ingreso" name="DNI" id="txtDni" type="number" size="11" min= "1000000" max= "55000000" required value="<?php echo $dni; ?>" <?php if($titulo == "Modificar"){echo "readonly";} ?> ><span id="spanDni" style="display: none">*</span></td>
                </tr>
                <tr>
                    <td>Apellido:</td><td><input class= "ingreso" name="Apellido" id="txtApellido" type="text" size="21" pattern="[a-zA-Z ]{2,254}" required value = <?php echo $apellido; ?> ><span id="spanApellido" style="display: none">*</span></td>
                </tr>
                <tr>
                    <td>Nombre:</td><td><input class= "ingreso" name="Nombre" id="txtNombre" type="text" size="21" pattern="[a-zA-Z ]{2,254}" required value = <?php echo $nombre ?> ><span id="spanNombre" style="display: none">*</span></td>
                </tr>
                <tr>
                    <td>Sexo:</td>
                    <td>
                        <select class= "ingreso" name="selectSexo" id="cboSexo" required>
                            <option value="" <?php if($sexo == ""){echo 'selected="selected"';} ?>>Seleccione</option>
                            <option value="M" <?php if($sexo == "M"){echo 'selected="selected"';} ?>>Masculino</option>
                            <option value="F" <?php if($sexo == "F"){echo 'selected="selected"';} ?> >Femenino</option>
                          </select>
                          <span id="spanSexo" style="display: none">*</span>
                    </td>
                </tr>
            </table>

            <h4>Datos Laborales</h4>
            <hr>
            <table>
                <tr>
                    <td>Legajo:</td><td><input class= "ingreso" name="Legajo" id="txtLegajo" type="number" size="5" min= "100" max= "550" required value = "<?php echo $legajo; ?>" <?php if($titulo == "Modificar"){echo "readonly";}?> ><span id="spanLegajo" style="display: none">*</span></td>
                </tr>
                <tr>
                    <td>Sueldo:</td><td><input class= "ingreso" name="Sueldo" id="txtSueldo" type="number" size="21" min="8000" step="500" required value = <?php echo $sueldo ?>><span id="spanSueldo" style="display: none">*</span></td>
                </tr>
                <tr>
                 <td>Turno:</td>
                  <tr>
                     <td style="text-align:left;padding-left:40px"><input name="turnos" type="radio" value="Mañana" checked/></td>
                     <td>Ma&ntilde;ana</td>
                  </tr>
                  <tr>
                    <td style="text-align:left;padding-left:40px"><input name="turnos" type="radio" value="Tarde" /></td>
                    <td>Tarde</td>
                 </tr>
                 <tr>
                    <td style="text-align:left;padding-left:40px"><input name="turnos" type="radio" value="Noche" /></td>
                    <td>Noche</td>
                 </tr>
                </tr>
            </table>

            <table>
                <tr>
                    <td>Foto:</td>
                    <tr>
                        <td><input name="Foto" id="foto" type="file" required/><span id="spanFoto" style="display: none">*</span></td>
                    </tr>
                </tr>
            </table>
            
            <hr>

            <table>
                <tr>
                    <td style="text-align: right;width:250px">
                        <button class= "botones" type="reset" name="btnLimpiar">Limpiar</button>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right;width:250px">                
                        <input class= "botones" type="button" onclick="Main.CargarDatos()" value=  <?php if($titulo == "Modificar"){echo $titulo;}else{echo "Enviar";} ?> /> 
                    </td>
                </tr>
            </table>

            <input type = "hidden" id= "hdnModificar" name= "hdnModificar" value="<?php echo $dni; ?>"/>

        </form>
    
        <!--<a href="./cerrarSesion.php">Cerrar sesion</a>-->

        </section>
</body>

</html>