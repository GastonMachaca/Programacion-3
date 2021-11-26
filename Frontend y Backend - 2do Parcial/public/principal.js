"use strict";
/// <reference path="./libs/jquery/index.d.ts" />
function TablaPrincipal() {
    var APIREST = "http://SPP/";
    $.ajax({
        type: 'GET',
        url: APIREST,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            console.clear();
            document.getElementById("idError").style.display = "none";
            var obj = JSON.parse(objJson.dato);
            var tabla = "";
            tabla += '<table align="center">';
            tabla += "<tr>";
            tabla += "<th>CORREO</th>";
            tabla += "<th>NOMBRE</th>";
            tabla += "<th>APELLIDO</th>";
            tabla += "<th>PERFIL</th>";
            tabla += "<th>FOTO</th>";
            tabla += "</tr>";
            for (var i = 0; i < obj.length; i++) {
                tabla += "<tr>";
                tabla += "<td>" + obj[i].correo + "</td>";
                tabla += "<td>" + obj[i].nombre + "</td>";
                tabla += "<td>" + obj[i].apellido + "</td>";
                tabla += "<td>" + obj[i].perfil + "</td>";
                tabla += "<td>" + '<img src="' + obj[i].foto + '" width="50" height="50"' + "</td>";
                tabla += "</tr>";
            }
            tabla += "</table>";
            $("#idTabla").html(tabla);
        }
        return;
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
function TablaAutos() {
    var APIREST = "http://SPP/";
    document.getElementById("AltaAuto").style.display = "none";
    document.getElementById("Autos").style.display = "block";
    //"Autos"
    $.ajax({
        type: 'GET',
        url: APIREST + "autos",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            console.clear();
            document.getElementById("idError").style.display = "none";
            var obj = JSON.parse(objJson.dato);
            var tabla = "";
            tabla += "<table id>";
            tabla += '<table align="center">';
            tabla += "<tr>";
            tabla += "<th>MARCA</th>";
            tabla += "<th>COLOR</th>";
            tabla += "<th>MODELO</th>";
            tabla += "<th>PRECIO</th>";
            tabla += "<th>BORRAR</th>";
            tabla += "<th>MODIFICAR</th>";
            tabla += "</tr>";
            for (var i = 0; i < obj.length; i++) {
                tabla += "<tr>";
                tabla += "<td>" + obj[i].marca + "</td>";
                tabla += "<td>" + obj[i].color + "</td>";
                tabla += "<td>" + obj[i].modelo + "</td>";
                tabla += "<td>" + obj[i].precio + "</td>";
                var id = obj[i].id;
                tabla += "<td>" + '<button type="button" class="btn btn-danger" onclick="BorrarAuto(' + id + ')">Borrar</button>' + "</td>";
                tabla += "<td>" + '<button type="button" class="btn btn-info" onclick="AltaModificarAuto(' + id + ')">Modificar</button>' + "</td>";
                tabla += "</tr>";
            }
            tabla += "</table>";
            tabla += "</table>";
            $("#Autos").html(tabla);
        }
        else {
            if (objJson.status == 424) {
                document.getElementById("idError").style.display = "block";
                $("#idErrorBorrarAuto").html(objJson.mensaje);
            }
        }
        return;
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
function BorrarAuto(id) {
    var APIREST = "http://SPP/";
    $.ajax({
        type: 'GET',
        url: APIREST + "autos",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            console.clear();
            document.getElementById("idError").style.display = "none";
            var autoDelete = JSON.parse(objJson.dato);
            for (var i = 0; i < autoDelete.length; i++) {
                if (autoDelete[i].id == id) {
                    var marca = autoDelete[i].marca;
                    var color = autoDelete[i].color;
                    var modelo = autoDelete[i].modelo;
                    break;
                }
            }
            var confirma = "Desea borrar el auto de " + "marca : " + marca + ",color : " + color + " y modelo : " + modelo + " de la lista?.";
            var opcion = confirm(confirma);
            if (opcion) {
                $.ajax({
                    type: 'DELETE',
                    url: APIREST + "cars/" + id,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: {},
                    async: true
                })
                    .done(function (objJson) {
                    if (objJson.exito) {
                        console.clear();
                        TablaAutos();
                        return;
                    }
                    else {
                        if (objJson.status == 418) {
                            document.getElementById("idErrorBorrarAuto").style.display = "block";
                            $("#idErrorBorrarAuto").html(objJson.mensaje);
                        }
                    }
                })
                    .fail(function (jqXHR) {
                    try {
                        var aux = JSON.parse(jqXHR.responseText);
                        document.getElementById("idErrorBorrarAuto").style.display = "block";
                        $("#idErrorBorrarAuto").html(aux.mensaje);
                    }
                    catch (_a) {
                        document.getElementById("idErrorBorrarAuto").style.display = "block";
                        $("#idErrorBorrarAuto").html(jqXHR.responseText);
                    }
                });
            }
            else {
                alert("Se cancelo la eliminacion del auto...");
            }
        }
        return;
    })
        .fail(function (jqXHR) {
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
function AltaAuto() {
    var APIREST = "http://SPP/";
    var color = document.getElementById("idColor").value;
    var marca = document.getElementById("idMarca").value;
    var precio = document.getElementById("idPrecio").value;
    var modelo = document.getElementById("idModelo").value;
    var formData = new FormData();
    var json = JSON.stringify({ "color": color, "marca": marca, "precio": precio, "modelo": modelo });
    formData.append("auto", json);
    $.ajax({
        type: 'POST',
        url: APIREST,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            alert(objJson.mensaje);
        }
        else {
            document.getElementById("idError").style.display = "block";
            $("#idError").html("Error -" + objJson.mensaje);
        }
    })
        .fail(function (jqXHR, textStatus, errorThrown) {
        //AdministrarGif(false);
        //alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        document.getElementById("idError").style.display = "block";
        $("#idError").html("xd.");
    });
    return;
}
function ModificarAuto() {
    var APIREST = "http://SPP/";
    var id = document.getElementById("idAuxAuto").value;
    var marca = document.getElementById("idMarca").value;
    var color = document.getElementById("idColor").value;
    var modelo = document.getElementById("idModelo").value;
    var precio = document.getElementById("idPrecio").value;
    var newID = parseInt(id);
    var json = JSON.stringify({ "id_auto": newID, "color": color, "marca": marca, "precio": precio, "modelo": modelo });
    $.ajax({
        type: 'PUT',
        url: APIREST + "cars/" + json,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            alert("Se modifico con exito el auto.");
        }
        else {
            if (objJson.status == 418) {
                document.getElementById("idErrorBorrarAuto").style.display = "block";
                $("#idErrorBorrarAuto").html(objJson.mensaje);
            }
        }
        return;
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
function AltaModificarAuto(id) {
    var APIREST = "http://SPP/";
    var marca = "";
    var modelo = "";
    var precio = "";
    var color = "";
    $.ajax({
        type: 'GET',
        url: APIREST + "autos",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        async: true
    })
        .done(function (objJson) {
        if (objJson.exito) {
            console.clear();
            //(<HTMLInputElement> document.getElementById("idError")).style.display = "none";
            var obj = JSON.parse(objJson.dato);
            for (var i = 0; i < obj.length; i++) {
                if (obj[i].id == id) {
                    marca = obj[i].marca;
                    color = obj[i].color;
                    modelo = obj[i].modelo;
                    precio = obj[i].precio;
                    break;
                }
            }
            if (id == 0) {
                //Autos
                document.getElementById("btnModificar").style.display = "none";
                document.getElementById("btnAgregar").style.display = "block";
                document.getElementById("Autos").style.display = "none";
                document.getElementById("AltaAuto").style.display = "block";
                document.getElementById("idAuxAuto").value = "";
                document.getElementById("idMarca").value = "";
                document.getElementById("idColor").value = "";
                document.getElementById("idModelo").value = "";
                document.getElementById("idPrecio").value = "";
            }
            else {
                document.getElementById("btnAgregar").style.display = "none";
                document.getElementById("btnModificar").style.display = "block";
                document.getElementById("Autos").style.display = "none";
                document.getElementById("AltaAuto").style.display = "block";
                document.getElementById("idAuxAuto").value = id.toString();
                document.getElementById("idMarca").value = marca;
                document.getElementById("idColor").value = color;
                document.getElementById("idModelo").value = modelo;
                document.getElementById("idPrecio").value = precio;
            }
        }
        return;
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
//# sourceMappingURL=principal.js.map