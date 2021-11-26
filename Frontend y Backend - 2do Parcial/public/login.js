"use strict";
/// <reference path="./libs/jquery/index.d.ts" />
var APIREST = "http://SPP/";
function VerificarLogin() {
    var correo = document.getElementById("idCorreo").value;
    var clave = document.getElementById("idPassword").value;
    var formData = new FormData();
    var json = JSON.stringify({ "correo": correo, "clave": clave });
    formData.append("user", json);
    $.ajax({
        type: 'POST',
        url: APIREST + 'login',
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            document.getElementById("idError").style.display = "none";
            //alert(objJson.usuario);
            localStorage.setItem("usuario", objJson.usuario);
            window.open("http://SPP/front-end-principal#", "_self");
            return;
        }
        else {
            if (objJson.status == 403) {
                document.getElementById("idError").style.display = "block";
                $("#idError").html(objJson.mensaje);
            }
            if (objJson.status == 409) {
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
//# sourceMappingURL=login.js.map