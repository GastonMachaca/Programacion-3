<?php 

//Aplicación No 12 (Arrays asociativos)
//Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
//contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
//lapiceras.

$colores = array("rojo","verde","azul");
$marcas = array("toyota","jeep","honda");
$trazo = array("grueso","fino","ondulado");
$precio = array("$1000","$2000","$3000");

$keys = array("color","marca","trazo","precio");

$i = 0;
$j = 0;

do
{
    $reemplazos[$i] = array($keys[$j] => $colores[$i],$keys[$j+1] => $marcas[$i],$keys[$j+2] => $trazo[$i],$keys[$j+3] => $precio[$i]);

    $lapicera = array_replace($reemplazos);

    $i++;

}while($i != 3);

echo('<pre>');
print_r($lapicera);
echo('</pre>');

?>