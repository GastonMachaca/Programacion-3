"use strict";
var RecuperatorioPrimerParcial;
(function (RecuperatorioPrimerParcial) {
    var Manejadora = /** @class */ (function () {
        function Manejadora() {
        }
        Manejadora.AgregarCocinero = function () {
            var especialidad = document.getElementById('especialidad').value;
            var email = document.getElementById('correo').value;
            var clave = document.getElementById('clave').value;
            var form = new FormData();
            form.append("especialidad", especialidad);
            form.append("email", email);
            form.append("clave", clave);
            var xhr = new XMLHttpRequest();
            var DONE = 4;
            var OK = 200;
            xhr.open('POST', "./BACKEND/AltaCocinero.php", true);
            xhr.send(form);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                }
            };
        };
        Manejadora.MostrarCocineros = function () {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', "./BACKEND/ListadoCocineros.php", true);
            xhr.send();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var datos = JSON.parse(this.responseText);
                    var res = "<table><th>ESPECIALIDAD</th><th>CORREO</th><th>CLAVE</th>";
                    for (var _i = 0, datos_1 = datos; _i < datos_1.length; _i++) {
                        var item = datos_1[_i];
                        res += "\n                        <tr>\n                            <td>" + item.especialidad + "</td>\n                            <td>" + item.email + "</td>\n                            <td>" + item.clave + "</td>\n                        </tr>\n                        ";
                    }
                    document.getElementById('divTabla').innerHTML = res;
                }
            };
        };
        Manejadora.VerificarExistencia = function () {
            var email = document.getElementById('correo').value;
            var clave = document.getElementById('clave').value;
            var form = new FormData();
            form.append("email", email);
            form.append("clave", clave);
            var xhr = new XMLHttpRequest();
            var DONE = 4;
            var OK = 200;
            xhr.open('POST', "./BACKEND/VerificarCocinero.php", true);
            xhr.send(form);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                }
            };
        };
        Manejadora.AgregarRecetaSinFoto = function () {
            var nombre = document.getElementById('nombre').value;
            var ingredientes = document.getElementById('ingredientes').value;
            var tipo = document.getElementById('cboTipo').value;
            var form = new FormData();
            form.append("nombre", nombre);
            form.append("ingredientes", ingredientes);
            form.append("tipo", tipo);
            var xhr = new XMLHttpRequest();
            var DONE = 4;
            var OK = 200;
            xhr.open('POST', "./BACKEND/AgregarRecetaSinFoto.php", true);
            xhr.send(form);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                    }
                }
            };
        };
        Manejadora.MostrarRecetas = function () {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', "./BACKEND/ListadoRecetas.php", true);
            xhr.send();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var datos = JSON.stringify(this.responseText);
                    var aux = JSON.parse(datos);
                    console.log(aux);
                    var printContents = document.getElementById('divTabla').innerHTML;
                    if (printContents != null || printContents != undefined) {
                        document.getElementById('divTabla').innerHTML = aux;
                    }
                    else {
                        alert('El elemento (' + 'divTabla' + ') no existe');
                    }
                }
            };
        };
        Manejadora.prototype.AgregarVerificarReceta = function () {
            Manejadora.AgregarVerificarReceta();
        };
        Manejadora.AgregarVerificarReceta = function () {
            var nombre = document.getElementById('nombre').value;
            var ingredientes = document.getElementById('ingredientes').value;
            var tipo = document.getElementById('cboTipo').value;
            var foto = document.getElementById('foto');
            var form = new FormData();
            form.append("nombre", nombre);
            form.append("ingredientes", ingredientes);
            form.append("tipo", tipo);
            form.append('foto', foto.files[0]);
            var xhr = new XMLHttpRequest();
            var DONE = 4;
            var OK = 200;
            xhr.open('POST', "./BACKEND/AgregarReceta.php", true);
            xhr.send(form);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                        Manejadora.MostrarRecetas();
                    }
                }
            };
        };
        Manejadora.prototype.EliminarReceta = function (json) {
            Manejadora.EliminarReceta(json);
        };
        Manejadora.EliminarReceta = function (json) {
        };
        Manejadora.prototype.ModificarReceta = function () {
            Manejadora.ModificarReceta();
        };
        Manejadora.ModificarReceta = function () {
        };
        return Manejadora;
    }());
    RecuperatorioPrimerParcial.Manejadora = Manejadora;
})(RecuperatorioPrimerParcial || (RecuperatorioPrimerParcial = {}));
//# sourceMappingURL=manejadora.js.map