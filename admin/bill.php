<?php
require '../vendor/autoload.php';
use \Mpdf\Mpdf;
$mpdf = new Mpdf();

$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->WriteHTML('');

$mpdf->Output('bill.pdf', 'I');
exit;
?>