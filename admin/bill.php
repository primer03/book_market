<?php
require '../vendor/autoload.php';
use Picqer\Barcode\BarcodeGeneratorPNG;

// รับข้อมูลจาก JavaScript
$customerName = "นาย สมชาย ใจดี";
$address = "123 หมู่ 1 ต. บ้านใหม่ อ. เมือง จ. สมุทรปราการ 10280";
$rentalAmount = 5000;

$mpdf = new \Mpdf\Mpdf();

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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>ใบเสร็จค่าเช่าร้านค้ารายเดือน</h2>
        </div>
        <div class="invoice-details">
            <p><strong>วันที่:</strong> ' . date('Y-m-d') . '</p>
            <p><strong>ชื่อลูกค้า:</strong> ' . $customerName . '</p>
            <p><strong>ที่อยู่:</strong> ' . $address . '</p>
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
            <!-- แสดงรูปบาร์โค้ด -->
            <img src="data:image/png;base64,' . base64_encode($barcodeImage) . '" alt="Barcode">
        </div>
        <div class="signature">
            <img src="path/to/signature.png" alt="ลายเซ็น">
            <p>ลายเซ็น .......................................</p>
        </div>
    </div>
</body>
</html>
';

$mpdf->WriteHTML($html);

// สร้างชื่อไฟล์ PDF ที่ไม่ซ้ำกัน
$pdfFileName = 'invoice_' . uniqid() . '.pdf';

// ส่งคำขอดาวน์โหลด PDF ไปยังเบราว์เซอร์
$mpdf->Output($pdfFileName, 'D');
?>
