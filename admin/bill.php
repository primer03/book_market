<?php
require '../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

// รับข้อมูลจาก JavaScript
$customerName = "นาย สมชาย ใจดี";
$address = "123 หมู่ 1 ต. บ้านใหม่ อ. เมือง จ. สมุทรปราการ 10280";
$rentalAmount = 5000;
$shopName = "ร้านค้า สมชาย";

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
$barcodeData = '123456789';  // แทนที่ด้วยข้อมูลที่ต้องการสร้างบาร์โค้ด
$barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128);

$html = '
<html>
<head>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
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
        }
        .total {
            font-weight: bold;
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
            <h2>ใบแจ้งชำระค่าเช่าร้านค้ารายเดือน</h2>
        </div>
        <div class="invoice-details">
            <p><strong>วันที่:</strong> ' . date('d/m/Y') . '</p>
            <p><strong>ชื่อลูกค้า:</strong> ' . $customerName . '</p>
            <p><strong>ชื่อร้าน:</strong> ' . $shopName . '</p>
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
        <!-- <div class="barcode">
            <img src="data:image/png;base64,' . base64_encode($barcodeImage) . '" alt="Barcode">
            <p class="barcode-number">Barcode Number: ' . $barcodeData . '</p>
        </div> -->
    </div>
</body>
</html>
';

$mpdf->WriteHTML($html);

// สร้างชื่อไฟล์ PDF ที่ไม่ซ้ำกัน
$pdfFileName = 'invoice_' . uniqid() . '.pdf';

// ส่งคำขอดาวน์โหลด PDF ไปยังเบราว์เซอร์
$mpdf->Output($pdfFileName, 'I');
