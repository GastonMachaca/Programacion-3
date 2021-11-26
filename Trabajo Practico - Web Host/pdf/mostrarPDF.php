<?php
    include "../php/validarSesion.php";
    include "../php/fabrica.php";
    require '../vendor/vendor/autoload.php';

    header('content-type:application/pdf');

    $mifabrica = new Fabrica("PDF");
    $mifabrica -> TraerDeArchivo("empleados.txt");

    $array = $mifabrica->GetEmpleados();
    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
    
    ob_start();

    $tabla = '<table style="background: black;padding: auto;margin-top: 50px;color: white;border: 1px solid black;border-collapse: separate;">';
    $tabla .= "<caption>Listado de Empleados</caption>";

    foreach($array as $lista)
    {
        $tabla .= '<tr>';
            $tabla .= "<td>".$lista->ToString();
            $tabla .= '<td><img src="'.$lista->GetPathFoto().'"width="120" height="120"></td>';
        $tabla .= '</tr>';
    }
    $tabla .= '</table>';

    ob_end_clean();

    $mpdf->SetProtection(array(), $_SESSION["DNIEmpleado"], '004');

    $mpdf->SetHeader('Machaca Gaston PAGINA {PAGENO} DE {nbpg}');

    $mpdf->WriteHTML($tabla);

    $mpdf->SetFooter('https://gastonmachaca.000webhostapp.com/ajax/ajaxMenu.php');
    
    $mpdf->Output();
?>