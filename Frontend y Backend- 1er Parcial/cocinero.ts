
namespace Entidades
{    
    export class Cocinero extends Persona
    {
        private especialidad : string;

        public constructor(email:string,clave:string,cadena:string)
        {
            super(email,clave);
            this.especialidad = cadena;
        }

        public ToJSON() : JSON
        {
            let auxJson : JSON = JSON.parse( "{" + super.ToString() + ",cadena" + ":" + this.especialidad + "}");

            return auxJson;
        }   
    }
}