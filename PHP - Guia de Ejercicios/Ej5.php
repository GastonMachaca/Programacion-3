<?php 


$cadena = "";
$validacion = 1;
$numero = 0;
$a = 1;
$b = 1;
$c = 7;


if($a > $b && $a < $c)
{
    $numero = $a;
}else if($b > $a && $b < $c)
{
    $numero = $b;
}else if($c > $a && $c < $b)
{
    $numero = $c;
}else
{
    $cadena = "No hay valor medio";
    $validacion = 0;
}

echo '<br/>';

if($validacion === 0)
{
    echo $cadena;
}
else
{
    echo "Numero: $numero";
}

?>