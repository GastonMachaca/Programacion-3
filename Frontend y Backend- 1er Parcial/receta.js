"use strict";
var Entidades;
(function (Entidades) {
    var Receta = /** @class */ (function () {
        function Receta(id, nombre, ingredientes, tipo, foto) {
            this.id = id;
            this.nombre = nombre;
            this.ingredientes = ingredientes;
            this.tipo = tipo;
            this.foto = foto;
        }
        Receta.prototype.ToJSON = function () {
            var auxJson = JSON.parse("{" + "id:" + this.id + ",nombre:" + this.nombre + ",ingredientes:" + this.ingredientes + ",tipo:" + this.tipo + ",foto:" + this.foto + "}");
            return auxJson;
        };
        return Receta;
    }());
    Entidades.Receta = Receta;
})(Entidades || (Entidades = {}));
//# sourceMappingURL=receta.js.map