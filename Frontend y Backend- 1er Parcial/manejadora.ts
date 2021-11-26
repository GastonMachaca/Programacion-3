namespace RecuperatorioPrimerParcial
{
    interface Iparte2
    {
        AgregarVerificarReceta() : void;
        EliminarReceta(json : string) : void;
        ModificarReceta(json : string) : void;
    }


    export class Manejadora implements Iparte2
    {
        public static AgregarCocinero()
        {
            let especialidad : string = (<HTMLInputElement> document.getElementById('especialidad')).value;
            let email : string = (<HTMLInputElement> document.getElementById('correo')).value;
            let clave : string = (<HTMLInputElement> document.getElementById('clave')).value;

            let form: FormData = new FormData();
    
            form.append("especialidad",especialidad);
            form.append("email",email);
            form.append("clave",clave);
    
            let xhr = new XMLHttpRequest();
            let DONE = 4;
            let OK = 200;

            xhr.open('POST',"./BACKEND/AltaCocinero.php", true);

            xhr.send(form);

            xhr.onreadystatechange = ():void => {

                if (xhr.readyState === DONE)
                {
                    if (xhr.status === OK)
                    {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                }
            };
        }

        public static MostrarCocineros()
        {
            const xhr = new XMLHttpRequest();

            xhr.open('GET',"./BACKEND/ListadoCocineros.php",true);

            xhr.send();

            xhr.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    let datos = JSON.parse(this.responseText);
                              
                    let res = "<table><th>ESPECIALIDAD</th><th>CORREO</th><th>CLAVE</th>";

                    for(let item of datos)
                    {
                        res +=  `
                        <tr>
                            <td>${item.especialidad}</td>
                            <td>${item.email}</td>
                            <td>${item.clave}</td>
                        </tr>
                        `
                    }

                    (<HTMLInputElement>document.getElementById('divTabla')).innerHTML = res;

                }
            }
        }

        public static VerificarExistencia()
        {
            let email : string = (<HTMLInputElement> document.getElementById('correo')).value;
            let clave : string = (<HTMLInputElement> document.getElementById('clave')).value;

            let form: FormData = new FormData();
    
            form.append("email",email);
            form.append("clave",clave);
    
            let xhr = new XMLHttpRequest();
            let DONE = 4;
            let OK = 200;

            xhr.open('POST',"./BACKEND/VerificarCocinero.php", true);

            xhr.send(form);

            xhr.onreadystatechange = ():void => {

                if (xhr.readyState === DONE)
                {
                    if (xhr.status === OK)
                    {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                }
            };
        }

        public static AgregarRecetaSinFoto()
        {
            let nombre : string = (<HTMLInputElement> document.getElementById('nombre')).value;
            let ingredientes : string = (<HTMLInputElement> document.getElementById('ingredientes')).value;
            let tipo : string = (<HTMLInputElement> document.getElementById('cboTipo')).value;

            let form: FormData = new FormData();
    
            form.append("nombre",nombre);
            form.append("ingredientes",ingredientes);
            form.append("tipo",tipo);
    
            let xhr = new XMLHttpRequest();
            let DONE = 4;
            let OK = 200;

            xhr.open('POST',"./BACKEND/AgregarRecetaSinFoto.php", true);

            xhr.send(form);

            xhr.onreadystatechange = ():void => {

                if (xhr.readyState === DONE)
                {
                    if (xhr.status === OK)
                    {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                }
            };
        }

        public static MostrarRecetas()
        {
            const xhr = new XMLHttpRequest();

            xhr.open('GET',"./BACKEND/ListadoRecetas.php",true);

            xhr.send();

            xhr.onreadystatechange = function(){

                if(this.readyState == 4 && this.status == 200)
                {
                    let datos = JSON.stringify(this.responseText);

                    let aux  = JSON.parse(datos);

                    console.log(aux);

                    var printContents = (<HTMLDivElement>document.getElementById('divTabla')).innerHTML;
	
                    if (printContents != null || printContents != undefined) {                    
                        (<HTMLDivElement>document.getElementById('divTabla')).innerHTML = aux;	
                    } else {
                        alert('El elemento (' + 'divTabla' + ') no existe');
                    }
                }
            }
        }

        public AgregarVerificarReceta() : void
        {
            Manejadora.AgregarVerificarReceta();
        }

        public static AgregarVerificarReceta() : void
        {
            let nombre : string = (<HTMLInputElement> document.getElementById('nombre')).value;
            let ingredientes : string = (<HTMLInputElement> document.getElementById('ingredientes')).value;
            let tipo : string = (<HTMLInputElement> document.getElementById('cboTipo')).value;
            let foto : any = (<HTMLInputElement> document.getElementById('foto'));

            let form: FormData = new FormData();
    
            form.append("nombre",nombre);
            form.append("ingredientes",ingredientes);
            form.append("tipo",tipo);
            form.append('foto',foto.files[0]);
    
            let xhr = new XMLHttpRequest();
            let DONE = 4;
            let OK = 200;

            xhr.open('POST',"./BACKEND/AgregarReceta.php", true);

            xhr.send(form);

            xhr.onreadystatechange = ():void => {

                if (xhr.readyState === DONE)
                {
                    if (xhr.status === OK)
                    {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                        Manejadora.MostrarRecetas();
                    }
                }
            };
        }

        public EliminarReceta(json : string) : void
        {
            Manejadora.EliminarReceta(json);
        }

        public static EliminarReceta(json : string) : void
        {

        }

        public ModificarReceta() : void
        {
            Manejadora.ModificarReceta();
        }

        public static ModificarReceta() : void
        {
            



        }










    }


}