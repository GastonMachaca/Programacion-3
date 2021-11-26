<?php 

$num = 0;
$promedio = 0.0;

$array = array(rand(1,10),rand(1,10),rand(1,10),rand(1,10),rand(1,10));
var_dump($array);

for($i= 0;$i<=4;$i++)
{
    $num = $num + $array[$i];
}

$promedio = $num / 5;

echo '<br/>';

if($promedio > 6)
{
    echo "Numero mayor que 6";
}
else if($promedio < 6)
{
    echo "Numero menor que 6";
}else
{
    echo "Numero igual a 6";
}

echo '<br/>';
echo "Numero total de Array: $num";
echo '<br/>';
echo "Promedio de los 5 numeros: $promedio";

?>