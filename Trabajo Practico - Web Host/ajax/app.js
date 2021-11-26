"use strict";
/// <reference path="ajax.ts" />
/// <reference path="../javascript/validaciones.ts" />
window.onload = function () { Main.MostrarEmpleados(); Main.MostrarAltaEmpleados(); Main.MostrarAlumno(); Main.CerrarSesion(); };
function EliminarEmpleadoExterno(legajo) {
    Main.EliminarEmpleado(legajo);
}
var Main;
(function (Main) {
    function MostrarEmpleados() {
        var ajax = new Ajax();
        ajax.Post("../php/mostrar.php", FrmMostrar);
    }
    Main.MostrarEmpleados = MostrarEmpleados;
    function FrmMostrar(empleados) {
        document.getElementById("divMostrar").innerHTML = empleados;
    }
    Main.FrmMostrar = FrmMostrar;
    function MostrarAltaEmpleados() {
        var ajax = new Ajax();
        ajax.Post("../php/index.php", FrmAlta);
    }
    Main.MostrarAltaEmpleados = MostrarAltaEmpleados;
    function FrmAlta(empleados) {
        document.getElementById("divAlta").innerHTML = empleados;
    }
    Main.FrmAlta = FrmAlta;
    function MostrarAlumno() {
        var ajax = new Ajax();
        ajax.Post("./ajaxNombre.php", alumnoNombre);
    }
    Main.MostrarAlumno = MostrarAlumno;
    function alumnoNombre(nombre) {
        document.getElementById("nombre").innerHTML = nombre;
    }
    Main.alumnoNombre = alumnoNombre;
    function CerrarSesion() {
        var ajax = new Ajax();
        ajax.Post("./ajaxCerrarSesion.php", CerrarSesionSuccess);
    }
    Main.CerrarSesion = CerrarSesion;
    function CerrarSesionSuccess(sesion) {
        document.getElementById("cerrarSesion").innerHTML = sesion;
    }
    Main.CerrarSesionSuccess = CerrarSesionSuccess;
    function EliminarEmpleado(legajo) {
        var ajax = new Ajax();
        var parametros = "legajo=" + legajo;
        ajax.Get("../backend/eliminar.php", EliminarEmpleadoSuccess, parametros, Fail);
    }
    Main.EliminarEmpleado = EliminarEmpleado;
    function EliminarEmpleadoSuccess(retorno) {
        console.clear();
        console.log(retorno);
        MostrarEmpleados();
    }
    Main.EliminarEmpleadoSuccess = EliminarEmpleadoSuccess;
    function ModificarEmpleado(dni) {
        var ajax = new Ajax();
        var parametros = "dniHidden=" + dni;
        ajax.Post("../php/index.php", FrmAlta, parametros, Fail);
    }
    Main.ModificarEmpleado = ModificarEmpleado;
    function CargarDatos() {
        if (AdministrarValidaciones() == true) {
            var turno = ObtenerTurnoSeleccionado();
            var sexo = document.getElementById("cboSexo").value;
            var dni = document.getElementById("txtDni").value;
            var modificar = document.getElementById("hdnModificar").value;
            var nombre = document.getElementById("txtNombre").value;
            var sueldo = document.getElementById("txtSueldo").value;
            var legajo = document.getElementById("txtLegajo").value;
            var apellido = document.getElementById("txtApellido").value;
            var foto = document.getElementById("foto");
            var form = new FormData();
            form.append("DNI", dni);
            form.append("Nombre", nombre);
            form.append("Apellido", apellido);
            form.append("selectSexo", sexo);
            form.append("Sueldo", sueldo);
            form.append("Legajo", legajo);
            form.append("turnos", turno);
            form.append('Foto', foto.files[0]);
            form.append("hdnModificar", modificar);
            MandarEmpleado(form);
        }
    }
    Main.CargarDatos = CargarDatos;
    var MandarEmpleado = function (form) {
        var ajax = new Ajax();
        ajax.Post("../backend/administracion.php", Main.MostrarEmpleados, form, Fail);
    };
    function Fail(retorno) {
        console.clear();
        console.log(retorno);
    }
})(Main || (Main = {}));
//# sourceMappingURL=app.js.map