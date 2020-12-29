<?php

require_once __DIR__ . '/vendor/autoload.php';

$filename = "BOLETA";
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output("Boleta", "D");