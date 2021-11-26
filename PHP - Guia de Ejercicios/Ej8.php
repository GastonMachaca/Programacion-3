<?php 

$num = 44;
$decimal = "";
$unidad = "";
$numTexto = "";

for($i= 2;$i<=6;$i++)
{
    $auxNum = (string)$num;
    $aux= (string)$i;

    if($auxNum[0] == $aux)
    {
        $decimal = $aux;
    }
}

for($i= 0;$i<=9;$i++)
{
    $auxNum = (string)$num;
    $aux= (string)$i;

    if($auxNum[1] == $aux)
    {
        $unidad = $aux;
    }
}

switch($decimal)
{
    case "2":
        $numTexto = "veinte";
        break;
    case "3":
        $numTexto = "treinta";
        break;
    case "4":
        $numTexto = "cuarenta";
        break;
    case "5":
        $numTexto = "cincuenta";
        break;
    case "6":
        $numTexto = "sesenta";
        break;
}

switch($unidad)
{
    case "1":
        echo $numTexto . "\ny uno";
        break;
    case "2":
        echo $numTexto . "\ny dos";
        break;
    case "3":
        echo $numTexto . "\ny tres";
        break;
    case "4":
        echo $numTexto . "\ny cuatro";
        break;
    case "5":
        echo $numTexto . "\ny cinco";
        break;
    case "6":
        echo $numTexto . "\ny seis";
        break;
    case "7":
        echo $numTexto . "\ny siete";
        break;
    case "8":
        echo $numTexto . "\ny ocho";
        break;
    case "9":
        echo $numTexto . "\ny nueve";
        break;
    default:
        echo $numTexto;
        break;
}

?>