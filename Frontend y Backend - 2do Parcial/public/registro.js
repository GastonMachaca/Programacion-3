"use strict";
/// <reference path="./libs/jquery/index.d.ts" />
function RegistrarUsuario() {
    var APIREST = "http://SPP/";
    var nombre = document.getElementById("txtNombre").value;
    var apellido = document.getElementById("txtApellido").value;
    var correo = document.getElementById("txtCorreo").value;
    var clave = document.getElementById("password").value;
    var perfil = document.getElementById("sel1").value;
    var foto = document.getElementById("foto");
    var json = JSON.stringify({ "nombre": nombre, "apellido": apellido, "correo": correo, "clave": clave, "perfil": perfil });
    var formD = new FormData();
    formD.append("usuario", json);
    formD.append('foto', foto.files[0]);
    $.ajax({
        type: 'POST',
        url: APIREST + 'usuarios',
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: formD,
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            document.getElementById("idError").style.display = "none";
            window.open("http://SPP/front-end-login#", "_self");
            return;
        }
        else {
            if (objJson.status == 403) {
                document.getElementById("idError").style.display = "block";
                $("#idError").html(objJson.mensaje);
            }
        }
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
        try {
            var aux = JSON.parse(jqXHR.responseText);
            document.getElementById("idError").style.display = "block";
            $("#idError").html(aux.mensaje);
        }
        catch (_a) {
            document.getElementById("idError").style.display = "block";
            $("#idError").html(jqXHR.responseText);
        }
    });
}
//# sourceMappingURL=registro.js.map