/*
Crear una función que realice el cálculo factorial del número que recibe como parámetro.
Nota: Utilizar console.log()
*/

function calcularFactorial(numero : number) : number
{
    let auxNumero : number = 0;
    let factorial : number = 0;

    auxNumero = numero * (numero - 1);

    for(let i : number = numero-2; i >= 1;i--)
    {
        factorial = auxNumero * i;

        auxNumero = factorial;
    }

    return auxNumero;
}

console.log(calcularFactorial(10));