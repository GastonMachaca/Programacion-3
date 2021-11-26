/// <reference path="./libs/jquery/index.d.ts" />

const APIREST : string = "http://SPP/";

function VerificarLogin()
{
    let correo : string = (<HTMLInputElement>document.getElementById("idCorreo")).value;
    let clave : string = (<HTMLInputElement>document.getElementById("idPassword")).value;

    let formData : FormData = new FormData();

    let json = JSON.stringify({ "correo": correo, "clave": clave })

    formData.append("user",json);

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

        if(objJson.exito)
        {
            (<HTMLInputElement> document.getElementById("idError")).style.display = "none";
            //alert(objJson.usuario);
            localStorage.setItem("usuario",objJson.usuario);
            window.open("http://SPP/front-end-principal#","_self");
            return;
        }
        else
        {
            if(objJson.status == 403)
            {
                (<HTMLInputElement> document.getElementById("idError")).style.display = "block";

                $("#idError").html(objJson.mensaje);
            }

            if(objJson.status == 409)
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

