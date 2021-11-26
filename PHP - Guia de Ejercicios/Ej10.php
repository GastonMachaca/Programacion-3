<?php 

$contador = 0;
$j = 0;
$array = array();
$auxArray = array();

for($i= 0;$i<=20;$i++)
{
    if ($i%2!=0)
    {
        $array[$j] = $i;
        $j++;
    }
    else
    {
        if($j === 10)
        {
            break;
        }
    }

}

echo('<pre>');
print_r($array);
echo('</pre>');

for($i= 0;$i<=9;$i++)
{
    echo $array[$i];
    echo '<br/>';
}

echo '<br/>';

while($contador < 10)
{
    echo $array[$contador];
    echo '<br/>';
    $contador++;
}

echo '<br/>';

foreach( $array as $auxArray)
{
    echo "{$auxArray}";
    echo '<br/>';
}
?>