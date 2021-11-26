namespace Entidades
{
    export class Receta
    {
        private id : number;
        private nombre : string;
        private ingredientes : string;
        private tipo : string;
        private foto : string;

        public constructor(id : number,nombre : string,ingredientes : string,tipo : string,foto : string)
        {
            this.id = id;
            this.nombre = nombre;
            this.ingredientes = ingredientes;
            this.tipo = tipo;
            this.foto = foto;
        }

        public ToJSON() : JSON
        {
            let auxJson : JSON = JSON.parse( "{" + "id:" + this.id + ",nombre:" + this.nombre + ",ingredientes:" + this.ingredientes + ",tipo:" + this.tipo + ",foto:" + this.foto + "}");

            return auxJson;
        }   
    }
}