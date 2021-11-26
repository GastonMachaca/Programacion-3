/// <reference path="./libs/jquery/index.d.ts" />

function TablaPrincipal()
{

    const APIREST : string = "http://SPP/";

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


        if(objJson.exito)
        {
            console.clear();
            (<HTMLInputElement> document.getElementById("idError")).style.display = "none";

            let obj = JSON.parse(objJson.dato);

            let tabla = "";
            tabla += '<table align="center">';
            tabla += "<tr>";
            tabla += "<th>CORREO</th>";
            tabla += "<th>NOMBRE</th>";
            tabla += "<th>APELLIDO</th>";
            tabla += "<th>PERFIL</th>";
            tabla += "<th>FOTO</th>";
            tabla += "</tr>";
            

            for(let i = 0 ; i < obj.length ; i++)
            {
                tabla+= "<tr>";
                tabla+= "<td>"+obj[i].correo+"</td>";
                tabla+= "<td>"+obj[i].nombre+"</td>";
                tabla+= "<td>"+obj[i].apellido+"</td>";
                tabla+= "<td>"+obj[i].perfil+"</td>";
                tabla+= "<td>" +'<img src="'+ obj[i].foto +'" width="50" height="50"'+ "</td>";
                tabla += "</tr>";
            }
            
            tabla += "</table>";

            $("#idTabla").html(tabla);    
        }

        return;
    })
    .fail(function (jqXHR, textStatus, errorThrown) 
    {
        try
        {
            let aux = JSON.parse(jqXHR.responseText);

            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(aux.mensaje);
        }
        catch
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(jqXHR.responseText);
        }
 
    });

}

function TablaAutos()
{
    const APIREST : string = "http://SPP/";

    (<HTMLInputElement> document.getElementById("AltaAuto")).style.display = "none";
    (<HTMLInputElement> document.getElementById("Autos")).style.display = "block";
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


        if(objJson.exito)
        {
            console.clear();
            (<HTMLInputElement> document.getElementById("idError")).style.display = "none";

            let obj = JSON.parse(objJson.dato);

            let tabla = "";
            tabla+= "<table id>";
            tabla += '<table align="center">';
            tabla += "<tr>";
            tabla += "<th>MARCA</th>";
            tabla += "<th>COLOR</th>";
            tabla += "<th>MODELO</th>";
            tabla += "<th>PRECIO</th>";
            tabla += "<th>BORRAR</th>";
            tabla += "<th>MODIFICAR</th>";
            tabla += "</tr>";
            
            for(let i = 0 ; i < obj.length ; i++)
            {
                tabla+= "<tr>";
                tabla+= "<td>"+obj[i].marca+"</td>";
                tabla+= "<td>"+obj[i].color+"</td>";
                tabla+= "<td>"+obj[i].modelo+"</td>";
                tabla+= "<td>"+obj[i].precio+"</td>";
                let id = obj[i].id;
                tabla+= "<td>"+'<button type="button" class="btn btn-danger" onclick="BorrarAuto('+ id +')">Borrar</button>'+"</td>";
                tabla+= "<td>"+'<button type="button" class="btn btn-info" onclick="AltaModificarAuto('+ id +')">Modificar</button>' +"</td>";
                tabla += "</tr>";
            }
            
            tabla += "</table>";
            tabla += "</table>";

            $("#Autos").html(tabla);
        }
        else
        {
            if(objJson.status == 424)
            {
                (<HTMLInputElement> document.getElementById("idError")).style.display = "block";
            
                $("#idErrorBorrarAuto").html(objJson.mensaje);
            }
        }

        return;
    })
    .fail(function (jqXHR, textStatus, errorThrown) 
    {
        try
        {
            let aux = JSON.parse(jqXHR.responseText);

            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(aux.mensaje);
        }
        catch
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(jqXHR.responseText);
        }
 
    });

}

function BorrarAuto(id : number)
{
    const APIREST : string = "http://SPP/";

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

    .done(function (objJson) 
    {
        if(objJson.exito)
        {
            console.clear();

            (<HTMLInputElement> document.getElementById("idError")).style.display = "none";

            let autoDelete = JSON.parse(objJson.dato);

            for(let i = 0 ; i < autoDelete.length ; i++)
            {
                if(autoDelete[i].id == id)
                {
                    var marca = autoDelete[i].marca;
                    var color = autoDelete[i].color;
                    var modelo = autoDelete[i].modelo;
                    break;
                }
            }

            let confirma = "Desea borrar el auto de " + "marca : " + marca + ",color : " + color + " y modelo : " + modelo + " de la lista?.";

            let opcion = confirm(confirma);

            if(opcion)
            {
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

                    if(objJson.exito)
                    {
                        console.clear();

                        TablaAutos();
                        
                        return;
                    }
                    else
                    {
                        if(objJson.status == 418)
                        {
                            (<HTMLInputElement> document.getElementById("idErrorBorrarAuto")).style.display = "block";
            
                            $("#idErrorBorrarAuto").html(objJson.mensaje);
                        }
                    }
                })

                .fail(function (jqXHR) 
                {
                    try
                    {
                        let aux = JSON.parse(jqXHR.responseText);
            
                        (<HTMLInputElement> document.getElementById("idErrorBorrarAuto")).style.display = "block";
            
                        $("#idErrorBorrarAuto").html(aux.mensaje);
                    }
                    catch
                    {
                        (<HTMLInputElement> document.getElementById("idErrorBorrarAuto")).style.display = "block";
            
                        $("#idErrorBorrarAuto").html(jqXHR.responseText);
                    }
                });
            }
            else
            {
                alert("Se cancelo la eliminacion del auto...");
            }
        }

        return;
    })
    .fail(function (jqXHR) 
    {
        try
        {
            let aux = JSON.parse(jqXHR.responseText);

            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(aux.mensaje);
        }
        catch
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(jqXHR.responseText);
        }
    });
}

function AltaAuto()
{    
    const APIREST : string = "http://SPP/";

    let color : string = (<HTMLInputElement>document.getElementById("idColor")).value;
    let marca : string = (<HTMLInputElement>document.getElementById("idMarca")).value;
    let precio : string = (<HTMLInputElement>document.getElementById("idPrecio")).value;
    let modelo : string = (<HTMLInputElement>document.getElementById("idModelo")).value;

    let formData : FormData = new FormData();

    let json = JSON.stringify({ "color": color, "marca": marca, "precio": precio, "modelo": modelo })

    formData.append("auto",json);

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

        if(objJson.exito)
        {
            alert(objJson.mensaje);
        }
        else
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html("Error -" + objJson.mensaje);
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) 
    {
        //AdministrarGif(false);
        //alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);

        (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

        $("#idError").html("xd.");
    });

    return;
}

function ModificarAuto()
{
    const APIREST : string = "http://SPP/";

    let id : string = (<HTMLInputElement>document.getElementById("idAuxAuto")).value;
    let marca : string = (<HTMLInputElement>document.getElementById("idMarca")).value;
    let color : string = (<HTMLInputElement>document.getElementById("idColor")).value;
    let modelo : string = (<HTMLInputElement>document.getElementById("idModelo")).value;
    let precio : string = (<HTMLInputElement>document.getElementById("idPrecio")).value;
    
    let newID = parseInt(id);

    let json = JSON.stringify({ "id_auto": newID, "color": color, "marca": marca, "precio": precio, "modelo": modelo })
    
    $.ajax({
        type: 'PUT',
        url: APIREST + "cars/"+ json,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        async: true
    })

    .done(function (objJson) 
    {
        if(objJson.exito)
        {
            alert("Se modifico con exito el auto.");
        }
        else
        {
            if(objJson.status == 418)
            {
                (<HTMLInputElement> document.getElementById("idErrorBorrarAuto")).style.display = "block";
            
                $("#idErrorBorrarAuto").html(objJson.mensaje);
            }
        }

        return;
    })

    .fail(function (jqXHR, textStatus, errorThrown) 
    {
        try
        {
            let aux = JSON.parse(jqXHR.responseText);

            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(aux.mensaje);
        }
        catch
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(jqXHR.responseText);
        }

    });
   
}

function AltaModificarAuto(id : number)
{
    const APIREST : string = "http://SPP/";

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
    
    .done(function (objJson) 
    {
        if(objJson.exito)
        {
            console.clear();
            
            //(<HTMLInputElement> document.getElementById("idError")).style.display = "none";

            let obj = JSON.parse(objJson.dato);

            for(let i = 0 ; i < obj.length ; i++)
            {
                if(obj[i].id == id)
                {
                    marca = obj[i].marca;
                    color = obj[i].color;
                    modelo = obj[i].modelo;
                    precio = obj[i].precio;
                    break;
                }
            }

            if(id == 0)
            {    
                //Autos
                (<HTMLInputElement> document.getElementById("btnModificar")).style.display = "none";
                (<HTMLInputElement> document.getElementById("btnAgregar")).style.display = "block";
                (<HTMLInputElement> document.getElementById("Autos")).style.display = "none";
                (<HTMLInputElement> document.getElementById("AltaAuto")).style.display = "block";

                (<HTMLInputElement>document.getElementById("idAuxAuto")).value = "";
                (<HTMLInputElement>document.getElementById("idMarca")).value = "";
                (<HTMLInputElement>document.getElementById("idColor")).value = "";
                (<HTMLInputElement>document.getElementById("idModelo")).value = "";
                (<HTMLInputElement>document.getElementById("idPrecio")).value = "";
            }
            else
            {
                (<HTMLInputElement> document.getElementById("btnAgregar")).style.display = "none";
                (<HTMLInputElement> document.getElementById("btnModificar")).style.display = "block";
                (<HTMLInputElement> document.getElementById("Autos")).style.display = "none";
                (<HTMLInputElement> document.getElementById("AltaAuto")).style.display = "block";
        
                (<HTMLInputElement>document.getElementById("idAuxAuto")).value = id.toString();
                (<HTMLInputElement>document.getElementById("idMarca")).value = marca;
                (<HTMLInputElement>document.getElementById("idColor")).value = color;
                (<HTMLInputElement>document.getElementById("idModelo")).value = modelo;
                (<HTMLInputElement>document.getElementById("idPrecio")).value = precio;
            }
        }

        return;
    })
    .fail(function (jqXHR, textStatus, errorThrown) 
    {
        try
        {
            let aux = JSON.parse(jqXHR.responseText);

            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(aux.mensaje);
        }
        catch
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

            $("#idError").html(jqXHR.responseText);
        }
 
    });
}