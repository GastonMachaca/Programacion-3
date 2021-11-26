"use strict";
/*
Se necesita mostrar por consola los primeros 20 números primos. Para ello realizar una
función.
Nota: Utilizar console.log()
*/
function esPrimo(numero) {
    for (var i = 2, raiz = Math.sqrt(numero); i <= raiz; i++) {
        if (numero % i === 0) {
            return false;
        }
    }
    return numero > 1;
}
for (var x = 0; x < 73; x++) {
    if (esPrimo(x)) {
        console.log("El número " + x + " es primo");
    }
}
//# sourceMappingURL=Ej7.js.map