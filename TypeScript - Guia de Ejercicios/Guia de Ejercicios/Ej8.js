"use strict";
/*
Crear una función que realice el cálculo factorial del número que recibe como parámetro.
Nota: Utilizar console.log()
*/
function calcularFactorial(numero) {
    var auxNumero = 0;
    var factorial = 0;
    auxNumero = numero * (numero - 1);
    for (var i = numero - 2; i >= 1; i--) {
        factorial = auxNumero * i;
        auxNumero = factorial;
    }
    return auxNumero;
}
console.log(calcularFactorial(10));
//# sourceMappingURL=Ej8.js.map