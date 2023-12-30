<?php
require '../vendor/autoload.php';
require '../Model/AreaModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$area = new AreaModel();

$mail = new PHPMailer(true);
$userEmail = $_POST['email'];
$ShopName = $_POST['shopname'];
$b_id = $_POST['b_id'];
$Username = $_POST['username'];

try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->CharSet = "utf-8";                                    // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'hentai.srisunan4@gmail.com';                    // SMTP username
    $mail->Password   = 'fzebiwgxtqhytbal';                             // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('hentai.srisunan4@gmail.com', 'ADMIN'); // อีเมลผู้ส่ง
    $mail->addAddress($userEmail, $Username);     // Add a recipient

    // Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'อนุมัติการจองร้านค้า';

    // HTML Message Body in Thai
    $mail->Body = "
    <!DOCTYPE html>
    <html>
    <head>
    <title>การจองได้รับการอนุมัติ</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }
      .container {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        padding: 20px;
      }
      .header {
        background-color: #48D1CC;
        color: white;
        padding: 10px;
        text-align: center;
      }
      .content {
        padding: 20px;
        text-align: center;
      }
      .footer {
        background-color: #f4f4f4;
        text-align: center;
        padding: 10px;
        font-size: 12px;
      }
    </style>
    </head>
    <body>
      <div class='container'>
        <div class='header'>
          <h1>การจองได้รับการอนุมัติ</h1>
        </div>
        <div class='content'>
          <p>สวัสดี <strong>$Username</strong>,</p>
          <p>เรายินดีที่จะแจ้งให้คุณทราบว่าการจองร้าน $ShopName ของคุณได้รับการอนุมัติแล้ว!</p>
          <p>เราตั้งตารอการมาเยือนของคุณและหวังว่าคุณจะมีประสบการณ์ที่ดี หากคุณมีคำถามใดๆ หรือต้องการเปลี่ยนแปลงการจองโปรดอย่าลังเลที่จะติดต่อเรา</p>
          <p>ขอแสดงความนับถือ,<br>ADMIN</p>
        </div>
        <div class='footer'>
          ข้อความนี้ถูกส่งโดยอัตโนมัติ โปรดอย่าตอบกลับโดยตรงทางอีเมลนี้ หากคุณมีคำถามหรือต้องการความช่วยเหลือ กรุณาติดต่อ support ที่ [อีเมลสนับสนุน]
        </div>
      </div>
    </body>
    </html>
    ";

    $mail->AltBody = 'เรายินดีที่จะแจ้งให้คุณทราบว่าการจองร้านค้าของคุณได้รับการอนุมัติแล้ว!';
    $mail->send();
    date_default_timezone_set("Asia/Bangkok");
    if ($area->update_book_area($b_id,date("Y-m-d H:i:s"))) {
        echo json_encode(["status" => "success", "msg" => "send email success"]);
    }else{
        echo json_encode(["status" => "error", "msg" => "send email error"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "msg" => "send email error"]);
}
