/*
Crear una función que reciba como único parámetro una cadena que contenga el día, mes
y año de nacimiento de una persona (con formato dd-mm-yyyy). La función mostrará por
consola a que signo corresponde dicha fecha de nacimiento.
Nota: Para descomponer la fecha recibida como parámetro utilice la función split.
*/

var cadena : string = "09-01-2021";

mostrarSigno(cadena);

function mostrarSigno(fecha : string)  : void
{
    let auxArray : Array<string> = [];

    auxArray = fecha.split("-");

    let auxMes = parseInt(auxArray[1]);
    let auxDia = parseInt(auxArray[0]);

    console.log(auxMes);
    
    switch(auxMes)
    {
        case 1: 
            if(auxDia > 19)
            {
                console.log("Signo: Acuario");
            }
            else
            {
                console.log("Signo: Capricornio");
            }
            break;
        case 2:
            break;

    }

}