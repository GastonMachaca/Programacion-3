<?php 

$numero = 0;
$contador = 0;

for($i= 1;$i<=1000;$i++)
{
    if($numero > 1000)
    {        
        break;
    }
    else
    {        
        $numero = $numero + $i;
        
        if($numero > 1000)
        {
            break;
        }

        echo $numero;
        echo '<br/>';

        $contador++;
    }
}

echo '<br/>';
echo "Se sumaron $contador numeros.";

?>