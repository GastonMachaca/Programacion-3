"use strict";
function AdministrarValidaciones() {
    var dni = document.getElementById('txtDni').value;
    var apellido = document.getElementById('txtApellido').value;
    var nombre = document.getElementById('txtNombre').value;
    var sexo = document.getElementById('cboSexo').value;
    var legajo = document.getElementById('txtLegajo').value;
    var sueldo = document.getElementById('txtSueldo').value;
    var foto = document.getElementById('foto').value;
    var auxIngreso = ["spanDni", "spanApellido", "spanNombre", "spanSexo", "spanLegajo", "spanSueldo", "spanFoto"];
    for (var i = 0; i < auxIngreso.length; i++) {
        switch (auxIngreso[i]) {
            case "spanDni":
                AdministrarSpanError(auxIngreso[i], !ValidarRangoNumerico(parseInt(dni), 1000000, 55000000));
                break;
            case "spanApellido":
                AdministrarSpanError(auxIngreso[i], ValidarCamposVacios(apellido));
                break;
            case "spanNombre":
                AdministrarSpanError(auxIngreso[i], ValidarCamposVacios(nombre));
                break;
            case "spanSexo":
                AdministrarSpanError(auxIngreso[i], ValidarCamposVacios(sexo));
                break;
            case "spanLegajo":
                AdministrarSpanError(auxIngreso[i], !ValidarRangoNumerico(parseInt(legajo), 100, 550));
                break;
            case "spanSueldo":
                AdministrarSpanError(auxIngreso[i], !ValidarRangoNumerico(parseInt(sueldo), 8000, ObtenerSueldoMaximo(ObtenerTurnoSeleccionado())));
                break;
            case "spanFoto":
                AdministrarSpanError(auxIngreso[i], ValidarCamposVacios(foto));
                break;
        }
    }
    if (VerificarValidaciones()) {
        alert("Ingrese los datos correctamente. Se marco los campos a completar.");
    }
}
function AdministrarValidacionesLogin() {
    var dni = document.getElementById('txtDni').value;
    var apellido = document.getElementById('txtApellido').value;
    AdministrarSpanError("spanDni", !ValidarRangoNumerico(parseInt(dni), 1000000, 55000000));
    AdministrarSpanError("spanApellido", ValidarCamposVacios(apellido));
    if (VerificarValidacionesLogin()) {
        alert("Ingrese los datos correctamente");
    }
}
function AdministrarModificar(dni) {
    document.getElementById('dniHidden').value = dni.toString();
    var aux = document.getElementById('modificar');
    aux.submit();
}
function ValidarCamposVacios(cadena) {
    var retorno = false;
    if (cadena === null || cadena === "") {
        retorno = true;
    }
    return retorno;
}
function ValidarRangoNumerico(num1, num2, num3) {
    var retorno = false;
    if (num1 >= num2 && num1 <= num3 && !ValidarCamposVacios(num1.toString())) {
        retorno = true;
    }
    return retorno;
}
function ValidarCombo(cadena1, cadena2) {
    var retorno = false;
    if (cadena1 === cadena2) {
        retorno = true;
    }
    return retorno;
}
function ObtenerTurnoSeleccionado() {
    var retorno = "";
    var turno = document.getElementsByName('turnos');
    for (var i = 0; i < turno.length; i++) {
        if (turno[i].checked) {
            retorno = turno[i].value;
            break;
        }
    }
    return retorno;
}
function ObtenerSueldoMaximo(cadena) {
    var numRetorno = 0;
    switch (cadena) {
        case "Mañana":
            numRetorno = 20000;
            break;
        case "Tarde":
            numRetorno = 18500;
            break;
        case "Noche":
            numRetorno = 25000;
            break;
    }
    return numRetorno;
}
function AdministrarSpanError(cadena, verificacion) {
    if (verificacion) {
        document.getElementById(cadena).style.display = "block";
    }
    else {
        document.getElementById(cadena).style.display = "none";
    }
}
function VerificarValidacionesLogin() {
    var auxArray = ["spanDni", "spanApellido"];
    var retorno = false;
    for (var i = 0; i < auxArray.length; i++) {
        if (document.getElementById(auxArray[i]).style.display == "block") {
            retorno = true;
            break;
        }
    }
    return retorno;
}
function VerificarValidaciones() {
    var auxArray = ["spanDni", "spanApellido", "spanNombre", "spanSexo", "spanLegajo", "spanSueldo", "spanFoto"];
    var retorno = false;
    for (var i = 0; i < auxArray.length; i++) {
        if (document.getElementById(auxArray[i]).style.display == "block") {
            retorno = true;
            break;
        }
    }
    return retorno;
}
//# sourceMappingURL=funciones.js.map