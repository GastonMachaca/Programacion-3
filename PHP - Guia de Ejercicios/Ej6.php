<?php 

$operador = '*';
$op1 = 10;
$op2 = 5;

switch($operador)
{
    case '+':
        echo $op1 + $op2;
        break;
    case '-':
        echo $op1 - $op2;    
        break;
    case '*':
        echo $op1 * $op2;   
        break;
    case '/':
        echo $op1 / $op2;  
        break;
}

?>