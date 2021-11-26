function mensaje(numero : number, texto? : string) : void
{
    if(texto == null)
    {
        let invertido = 0
        let resto = numero
        do 
        {
          invertido = invertido * 10 + (resto % 10)
          resto = Math.floor(resto / 10)
        } while ( resto > 0 )

        console.log(invertido);
    }
    else
    {
        for(let i=0;i<numero;i++)
        {
            console.log(texto);
        }
    }
}

mensaje(12,"Hola");
