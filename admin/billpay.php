<?php
require '../vendor/autoload.php';
require '../Model/AreaModel.php';
use Picqer\Barcode\BarcodeGeneratorPNG;
date_default_timezone_set("Asia/Bangkok");
$area = new AreaModel();
$areaData = json_decode($area->getItemBookByiD($_GET['b_id']),true)['data'];
$receiptData = $area->get_receiptId($_GET['b_id']);
// รับข้อมูลจาก JavaScript
$customerName = $areaData['b_firstname'] . ' ' . $areaData['b_lastname'];
$rentalAmount = $receiptData['r_total'];
$shopName = $areaData['b_shop_name'];
$zone = $areaData['area_name'];

$mpdf = new \Mpdf\Mpdf(['fontDir' => '../fonts/', 'fontdata' => [
    'thsarabun' => [
        'R' => 'THSarabun.ttf',
        'B' => 'THSarabun Bold.ttf',
        'I' => 'THSarabun Italic.ttf',
        'BI' => 'THSarabun BoldItalic.ttf'
    ]
], 'default_font' => 'thsarabun']);

// สร้างรหัสบาร์โค้ด
$generator = new BarcodeGeneratorPNG();
$barcodeData = $receiptData['r_id'];
$barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128);

$html = '
<html>
<head>
    <style>
    body {
        font-family: "THSarabun", Helvetica, Arial, sans-serif;
    }
    .container {
        width: 80%;
        margin: auto;
        padding: 20px;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .invoice-details {
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 8px;
        text-align: left;
        font-family: "THSarabun", Helvetica, Arial, sans-serif;
    }
    .total {
        font-weight: bold;
        font-family: "THSarabun Bold", Helvetica, Arial, sans-serif;
    }
    .signature {
        margin-top: 50px;
        text-align: center;
    }
    .signature img {
        width: 150px;
    }
    /* ส่วนที่เพิ่มเติม */
    .barcode {
        text-align: center;
        margin-top: 20px;
    }
    .barcode img {
        width: 150px;
    }
    .barcode-number {
        margin-top: 10px;
        font-size: 14px;
        font-family: "THSarabun", Helvetica, Arial, sans-serif;
    }
    .logo {
        text-align: center;
    }
    .logo > img {
        width: 50px;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img style="width: 70px" src="https://i.imgur.com/gzvkzoJ.png" alt="Logo">
            </div>
            <h2>ใบเสร็จรับเงิน</h2>
        </div>
        <div class="invoice-details">
            <p><strong>วันที่:</strong> ' . date('d/m/Y',strtotime($receiptData['r_month'])) . '</p>
            <p><strong>ชื่อลูกค้า:</strong> ' . $customerName . '</p>
            <p><strong>ชื่อร้าน:</strong> ' . $shopName . '</p>
            <p><strong>โซน:</strong> ' . $zone . '</p>
        </div>
        <table>
            <tr>
                <th>รายการ</th>
                <th>จำนวนเงิน</th>
            </tr>
            <tr>
                <td>ค่าเช่าร้านค้า</td>
                <td>' . number_format($rentalAmount, 2) . ' บาท</td>
            </tr>
        </table>
        <p class="total"><strong>รวมทั้งสิ้น: ' . number_format($rentalAmount, 2) . ' บาท</strong></p>
        <div class="barcode">
            <img src="data:image/png;base64,' . base64_encode($barcodeImage) . '" alt="Barcode">
            <p class="barcode-number">Barcode Number: ' . $barcodeData . '</p>
        </div>
    </div>
</body>
</html>
';

$mpdf->WriteHTML($html);

$thaimonth = [
    '01' => 'มกราคม',
    '02' => 'กุมภาพันธ์',
    '03' => 'มีนาคม',
    '04' => 'เมษายน',
    '05' => 'พฤษภาคม',
    '06' => 'มิถุนายน',
    '07' => 'กรกฎาคม',
    '08' => 'สิงหาคม',
    '09' => 'กันยายน',
    '10' => 'ตุลาคม',
    '11' => 'พฤศจิกายน',
    '12' => 'ธันวาคม'
];
$pdfFileName = 'ใบเสร็จรับเงิน_' . $shopName . '_' . $thaimonth[date('m')] . '_' . date('Y')+543 . '.pdf';

// ส่งคำขอดาวน์โหลด PDF ไปยังเบราว์เซอร์
$mpdf->Output($pdfFileName, 'D');
