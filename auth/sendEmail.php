<?php
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once "../Model/UserModel.php";
$mail = new PHPMailer(true);
$userEmail = $_POST['user_email'];
$Username = explode('@', $userEmail)[0];

$user = new UserModel();
$checkmal = $user->check_email($userEmail);
if($checkmal == 0){
    echo json_encode(["status" => "error", "msg" => "อีเมลไม่ถูกต้อง"]);
    exit();
}
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
    $randomverifly = rand(100000,999999);
    $user->user_verifly($userEmail,$randomverifly);
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Verification Code';
    
    $mail->Body = "
    <html>
    <head>
      <style>
        .email-container {
          font-family: 'Arial', sans-serif;
          color: #333;
          background-color: #f2f2f2;
          padding: 20px;
          text-align: center;
        }
        .email-header {
          font-size: 22px;
          color: #333;
        }
        .verification-code {
          font-size: 32px;
          color: #4CAF50;
          padding: 20px;
          margin: 20px 0;
          border: dashed 2px #4CAF50;
          display: inline-block;
        }
      </style>
    </head>
    <body>
      <div class='email-container'>
        <h1 class='email-header'>Your Verification Code</h1>
        <div class='verification-code'>$randomverifly</div>
        <p>Enter this code in the app to continue.</p>
      </div>
    </body>
    </html>
    ";
    
    $mail->AltBody = 'Your verification code is: ' . $randomverifly;

    $mail->send();
    $_SESSION['user_emailverifly'] = $userEmail;
    echo json_encode(["status" => "success", "msg" => "send email success"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "msg" => "send email error"]);
}

?>