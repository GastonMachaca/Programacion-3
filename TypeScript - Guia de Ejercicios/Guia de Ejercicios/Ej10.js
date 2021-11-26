"use strict";
/*
Definir una función que muestre información sobre una cadena de texto que se le pasa
como argumento. A partir de la cadena que se le pasa, la función determina si esa cadena
está formada sólo por mayúsculas, sólo por minúsculas o por una mezcla de ambas.
*/
function mostrarInfo(cadena) {
    var retorno = 0;
    for (var i = 0; i < cadena.length; i++) {
        if (cadena === cadena.toUpperCase()) {
            retorno = 1;
        }
        else if (cadena === cadena.toLowerCase()) {
            retorno = 2;
        }
        else {
            retorno = 3;
        }
    }
    return retorno;
}
switch (mostrarInfo("hola")) {
    case 1:
        console.log("La cadena esta conformada por mayusculas.");
        break;
    case 2:
        console.log("La cadena esta conformada por minusculas.");
        break;
    case 3:
        console.log("La cadena esta conformada tanto por mayusculas como minusculas");
        break;
    default:
        console.log("Se a ingresado un caracter invalido.");
        break;
}
//# sourceMappingURL=Ej10.js.map