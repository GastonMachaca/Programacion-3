/*
Guardar su nombre y apellido en dos variables distintas. Dichas variables serán pasadas
como parámetro de la función MostrarNombreApellido, que mostrará el apellido en
mayúscula y el nombre solo con la primera letra en mayúsculas y el resto en minúsculas.
El apellido y el nombre se mostrarán separados por una coma (,).
*/

var nombre : string  = "gaston";
var apellido : string = "machaca";

function MostrarNombreApellido(nombre : string,apellido : string) : void
{
    let auxApellido = apellido.toUpperCase();

    let auxNombre : string = "";

    for(let i : number = 0;i < nombre.length; i++)
    {
        if(i == 0)
        {
            auxNombre = nombre.charAt(i).toUpperCase();
        }
        else
        {
            auxNombre += nombre.charAt(i).toLowerCase();
        }
    }

    console.log(`${auxNombre},${auxApellido}`);

}

MostrarNombreApellido(nombre,apellido);