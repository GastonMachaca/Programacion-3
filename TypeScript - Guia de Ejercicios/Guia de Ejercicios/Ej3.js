"use strict";
function mensaje(numero, texto) {
    if (texto == null) {
        var invertido = 0;
        var resto = numero;
        do {
            invertido = invertido * 10 + (resto % 10);
            resto = Math.floor(resto / 10);
        } while (resto > 0);
        console.log(invertido);
    }
    else {
        for (var i = 0; i < numero; i++) {
            console.log(texto);
        }
    }
}
mensaje(12, "Hola");
//# sourceMappingURL=Ej3.js.map