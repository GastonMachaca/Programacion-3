namespace Entidades
{    
    export class Persona
    {
        private email : string;
        private clave : string;

        public constructor(email:string,clave:string)
        {
            this.email = email;
            this.clave = clave;
        }

        public ToString() : string
        {
            let mensaje : string  = "email:" + this.email + ",clave:" + this.clave + ",";

            return mensaje;
        }   
    }
}