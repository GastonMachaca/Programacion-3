/// <reference path="./libs/jquery/index.d.ts" />

function RegistrarUsuario()
{
    const APIREST : string = "http://SPP/";

    let nombre:string = (<HTMLInputElement> document.getElementById("txtNombre")).value;
    let apellido:string = (<HTMLInputElement> document.getElementById("txtApellido")).value;
    let correo:string = (<HTMLInputElement> document.getElementById("txtCorreo")).value;
    let clave:string = (<HTMLInputElement> document.getElementById("password")).value;
    let perfil:string = (<HTMLInputElement> document.getElementById("sel1")).value;
    let foto : any = (<HTMLInputElement> document.getElementById("foto"));

    let json =JSON.stringify({ "nombre":nombre,"apellido":apellido,"correo": correo, "clave": clave,"perfil":perfil});

    var formD = new FormData();
    formD.append("usuario",json);
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

        if(objJson.exito)
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "none";
            window.open("http://SPP/front-end-login#","_self");
            return;
        }
        else
        {
            if(objJson.status == 403)
            {
                (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

                $("#idError").html(objJson.mensaje);
            }
        }
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