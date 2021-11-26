/*
Definir una función que determine si la cadena de texto que se le pasa como parámetro
es un palíndromo, es decir, si se lee de la misma forma desde la izquierda y desde la
derecha. Ejemplo de palíndromo complejo: "La ruta nos aporto otro paso natural".
*/

var cadena : string = "La ruta nos aporto otro paso natural";
var str;
var aux;

leerPalindromo(cadena);

function leerPalindromo(cadena : string) : void
{
    let auxCadena : string = cadena.toLowerCase();

    str = auxCadena.split(' ').join('');

    console.log(str);

    let invertido : string = auxCadena.split("").reverse().join("");

    aux = invertido.split(' ').join('');

    console.log(aux);

    if(str === aux)
    {
        console.log("La cadena ingresada es palindromo.");
    }
    else
    {
        console.log("La cadena ingresada no es palindromo.");
    }
}