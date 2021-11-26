/*
Realizar una función que reciba como parámetro un número y que retorne el cubo del
mismo.
Nota: La función retornará el cubo del parámetro ingresado. Realizar una función que
invoque a esta última y permita mostrar por consola el resultado.
*/

var numero : number = 10;

function alCubo(numero : number) : number
{
    return Math.pow(numero,3);
}

console.log(alCubo(numero));