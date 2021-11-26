"use strict";
var Entidades;
(function (Entidades) {
    var Persona = /** @class */ (function () {
        function Persona(email, clave) {
            this.email = email;
            this.clave = clave;
        }
        Persona.prototype.ToString = function () {
            var mensaje = "email:" + this.email + ",clave:" + this.clave + ",";
            return mensaje;
        };
        return Persona;
    }());
    Entidades.Persona = Persona;
})(Entidades || (Entidades = {}));
//# sourceMappingURL=persona.js.map