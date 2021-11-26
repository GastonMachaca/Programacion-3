<?php 

$dia = date("d");
$mes = date("m");
$año = date("y");

echo "$dia/$mes/$año";

echo '<br/>';

switch($mes)
{
    case "1":
        echo "Estacion verano";
        break;
    case "2":
        echo "Estacion verano";
        break;
    case "3":
        echo "Estacion verano";
        break;
    case "4":
        echo "Estacion otoño";
        break;
    case "5":
        echo "Estacion otoño";
        break;
    case "6":
        echo "Estacion invierno";
        break;
    case "7":
        echo "Estacion invierno";
        break;
    case "8":
        echo "Estacion invierno";
        break;
    case "9":
        echo "Estacion primavera";
        break;
    case "10":
        echo "Estacion primavera";
        break;
    case "11":
        echo "Estacion primavera";
        break;      
    case "12":
        echo "Estacion verano";
        break; 
}

?>