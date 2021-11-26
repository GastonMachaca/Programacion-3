/*
Realizar una función que solicite (por medio de un parámetro) un número. Si el número
es positivo, se mostrará el factorial de ese número, caso contrario se mostrará el cubo de
dicho número.
Nota: Reutilizar la función que determina el factorial de un número y la que calcula el
cubo de un número.
*/

function manejador(numero : number) : void
{
    if(numero > 0)
    {
        console.log(calcularFactorial(numero));
    }
    else
    {
        console.log(alCubo(numero));
    }
}

manejador(20);