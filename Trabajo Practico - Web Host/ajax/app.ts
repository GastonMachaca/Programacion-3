
/// <reference path="ajax.ts" />
/// <reference path="../javascript/validaciones.ts" />

window.onload = ():void => {Main.MostrarEmpleados();Main.MostrarAltaEmpleados();Main.MostrarAlumno();Main.CerrarSesion()};

function EliminarEmpleadoExterno(legajo:number):void
{
    Main.EliminarEmpleado(legajo);  
}

namespace Main
{
    export function MostrarEmpleados():void
    {
        let ajax : Ajax = new Ajax();

        ajax.Post("../php/mostrar.php",FrmMostrar);     
    }

    export function FrmMostrar(empleados:string):void
    {      
        (<HTMLDivElement>document.getElementById("divMostrar")).innerHTML = empleados; 
    }

    export function MostrarAltaEmpleados():void
    {
        let ajax : Ajax = new Ajax();

        ajax.Post("../php/index.php",FrmAlta);     
    }

    export function FrmAlta(empleados:string):void
    {      
        (<HTMLDivElement>document.getElementById("divAlta")).innerHTML = empleados; 
    }

    export function MostrarAlumno():void
    {
        let ajax : Ajax = new Ajax();

        ajax.Post("./ajaxNombre.php",alumnoNombre);     
    }

    export function alumnoNombre(nombre:string):void
    {      
        (<HTMLDivElement>document.getElementById("nombre")).innerHTML = nombre; 
    }

    export function CerrarSesion():void
    {
        let ajax : Ajax = new Ajax();

        ajax.Post("./ajaxCerrarSesion.php",CerrarSesionSuccess);     
    }

    export function CerrarSesionSuccess(sesion:string):void
    {      
        (<HTMLDivElement>document.getElementById("cerrarSesion")).innerHTML = sesion; 
    }

    export function EliminarEmpleado(legajo:number):void
    {
        let ajax = new Ajax();
        let parametros: string = `legajo=${legajo}`;
        ajax.Get("../backend/eliminar.php",EliminarEmpleadoSuccess,parametros,Fail);
    }

    export function EliminarEmpleadoSuccess(retorno: string):void 
    {
        console.clear();
        console.log(retorno);
        MostrarEmpleados();
    }
    

    export function ModificarEmpleado(dni: number): void
    {
        let ajax : Ajax = new Ajax();
        let parametros: string = `dniHidden=${dni}`;

        ajax.Post("../php/index.php",FrmAlta,parametros,Fail);
    }

    export function CargarDatos(): void
    {           
        if(AdministrarValidaciones() == true)
        {
            let turno: string = ObtenerTurnoSeleccionado();
            let sexo: string = (<HTMLInputElement> document.getElementById("cboSexo")).value;
            let dni: string = (<HTMLInputElement> document.getElementById("txtDni")).value;
            let modificar = (<HTMLInputElement>document.getElementById("hdnModificar")).value;
            let nombre: string = (<HTMLInputElement> document.getElementById("txtNombre")).value;
            let sueldo: string = (<HTMLInputElement> document.getElementById("txtSueldo")).value;
            let legajo: string = (<HTMLInputElement> document.getElementById("txtLegajo")).value;
            let apellido: string = (<HTMLInputElement> document.getElementById("txtApellido")).value;
            let foto : any = (<HTMLInputElement> document.getElementById("foto"));
    
            let form: FormData = new FormData();
    
            form.append("DNI",dni);
            form.append("Nombre",nombre);
            form.append("Apellido",apellido);
            form.append("selectSexo",sexo);
    
            form.append("Sueldo",sueldo);
            form.append("Legajo",legajo);
            form.append("turnos",turno);
    
            form.append('Foto', foto.files[0]);
            form.append("hdnModificar",modificar);
            
            MandarEmpleado(form);
        }
    }

    const MandarEmpleado = (form: FormData) =>
    {
        let ajax = new Ajax();
        ajax.Post("../backend/administracion.php", Main.MostrarEmpleados, form, Fail);
    } 

    function Fail(retorno:string):void 
    {
        console.clear();
        console.log(retorno);
    }
}