function AdministrarValidaciones() : boolean
{

    let retorno = false;

    let dni : string = (<HTMLInputElement> document.getElementById('txtDni')).value;
    let apellido : string = (<HTMLInputElement> document.getElementById('txtApellido')).value;
    let nombre : string = (<HTMLInputElement> document.getElementById('txtNombre')).value;
    let sexo : string = (<HTMLInputElement> document.getElementById('cboSexo')).value;
    let legajo : string = (<HTMLInputElement> document.getElementById('txtLegajo')).value;
    let sueldo : string = (<HTMLInputElement> document.getElementById('txtSueldo')).value;
    let foto : string = (<HTMLInputElement> document.getElementById('foto')).value;

    let auxIngreso : Array<string> = ["spanDni","spanApellido","spanNombre","spanSexo","spanLegajo","spanSueldo","spanFoto"];

    for (let i = 0; i < auxIngreso.length; i++)
    {
        switch(auxIngreso[i])
        {
            case "spanDni":
                AdministrarSpanError(auxIngreso[i],!ValidarRangoNumerico(parseInt(dni),1000000,55000000));
                break;
            case "spanApellido":
                AdministrarSpanError(auxIngreso[i],ValidarCamposVacios(apellido));
                break;
            case "spanNombre":
                AdministrarSpanError(auxIngreso[i],ValidarCamposVacios(nombre));
                break;
            case "spanSexo":
                AdministrarSpanError(auxIngreso[i],ValidarCamposVacios(sexo));
                break;
            case "spanLegajo":
                AdministrarSpanError(auxIngreso[i],!ValidarRangoNumerico(parseInt(legajo),100,550));
                break;
            case "spanSueldo":
                AdministrarSpanError(auxIngreso[i],!ValidarRangoNumerico(parseInt(sueldo),8000,ObtenerSueldoMaximo(ObtenerTurnoSeleccionado())));
                break;
            case "spanFoto":
                AdministrarSpanError(auxIngreso[i],ValidarCamposVacios(foto));
                break;
        }

    }

    if(VerificarValidaciones())
    {
        alert("Ingrese los datos correctamente. Se marco los campos a completar.");
    }
    else
    {
        retorno = true;
    }

    return retorno;
}

function AdministrarValidacionesLogin() : void
{
    let dni : string = (<HTMLInputElement> document.getElementById('txtDni')).value;
    let apellido : string = (<HTMLInputElement> document.getElementById('txtApellido')).value;

    AdministrarSpanError("spanDni",!ValidarRangoNumerico(parseInt(dni),1000000,55000000));
    AdministrarSpanError("spanApellido",ValidarCamposVacios(apellido));
    
    if(VerificarValidacionesLogin())
    {
        alert("Ingrese los datos correctamente");
    }
}

function AdministrarModificar(dni : number)
{
    (<HTMLInputElement> document.getElementById('dniHidden')).value = dni.toString();

    let aux = (<HTMLFormElement> document.getElementById('modificar'));

    aux.submit()
    
}

function ValidarCamposVacios(cadena : string) : boolean
{
    let retorno : boolean = false;

    if(cadena === null || cadena === "")
    {
        retorno = true;
    }

    return retorno;
}

function ValidarRangoNumerico(num1: number,num2: number,num3: number) : boolean
{
    let retorno : boolean = false;

    if(num1 >= num2 && num1 <= num3 && !ValidarCamposVacios(num1.toString()))
    {
        retorno = true;
    }

    return retorno;
}

function ValidarCombo(cadena1 : string, cadena2 : string) : boolean
{
    let retorno : boolean = false;

    if(cadena1 === cadena2)
    {
        retorno = true;
    }

    return retorno;
}

function ObtenerTurnoSeleccionado() : string
{
    var retorno : string = "";
    var turno = document.getElementsByName('turnos');    

    for(var i : number = 0; i < turno.length; i++)
    {
        if((turno[i] as HTMLInputElement).checked)
        {
            retorno = (turno[i] as HTMLInputElement).value;
            break;
        }
    }

    return retorno;
}

function ObtenerSueldoMaximo(cadena : string) : number 
{
    let numRetorno : number = 0;

    switch(cadena)
    {
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

function AdministrarSpanError(cadena : string,verificacion : boolean) : void
{
    if(verificacion)
    {
        (<HTMLInputElement> document.getElementById(cadena)).style.display = "block";
    }
    else
    {
        (<HTMLInputElement> document.getElementById(cadena)).style.display = "none";
    }
}

function VerificarValidacionesLogin() : boolean
{
    let auxArray : Array<string> = ["spanDni","spanApellido"];

    let retorno = false;

    for (let i = 0; i < auxArray.length; i++)
    {
        if((<HTMLInputElement> document.getElementById(auxArray[i])).style.display == "block")
        {
            retorno = true;  
            break;
        }
    }
    
    return retorno;
}

function VerificarValidaciones() : boolean
{
    let auxArray : Array<string> = ["spanDni","spanApellido","spanNombre","spanSexo","spanLegajo","spanSueldo","spanFoto"];

    let retorno = false;

    for (let i = 0; i < auxArray.length; i++)
    {
        if((<HTMLInputElement> document.getElementById(auxArray[i])).style.display == "block")
        {
            retorno = true;  
            break;
        }
    }
    
    return retorno;
}