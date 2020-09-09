<?php

$errorMSG = '';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('phpmailer/src/Exception.php');
require_once('phpmailer/src/PHPMailer.php');
require_once('phpmailer/src/SMTP.php');

// open session
session_start();

// processing only ajax requests (for other requests we terminate the script)
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
  exit();
}

// processing of data sent only by the POST method (for the remaining methods we complete the execution of the script)
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  exit();
}

// NAME
if (isset($_POST['name'])) {
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
} else {
    $errorMSG = 'Name is required';
}

// EMAIL
if (isset($_POST['email'])) {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  } else {
	$email = $_POST['email'];
  }
} else {
    $errorMSG .= 'Email is required';
}

// PHONE
if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];
} else {
    $errorMSG .= 'Phone is required';
}

// MESSAGE
if (isset($_POST['message'])) {
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
} else {
	$errorMSG .= 'Message is required';
}

// Curren year
$current_year = date ( 'Y' );

// email template
$body = "
<html>
<body>
    <div style='background:#f9f9f9; padding:1px;'>
        <div style='text-align: center; margin-top: 20px;'><h2>ARTEM.</h2></div>
        <div style='background:#fff; width:600px; margin:20px auto; padding:35px 60px 25px; box-sizing:border-box; border-radius:4px; box-shadow: 0 15px 40px rgba(141, 153, 167, 0.05);'>
            <div style='color:#8d99a7;'>Name:</div>
            <div style='margin-bottom:10px;'>$name</div>
            <div style='color:#8d99a7;'>Phone:</div>
            <div style='margin-bottom:10px;'>$phone</div>
            <div style='color:#8d99a7;padding-top:13px;border-top:1px solid #f3f5f6;'>Email sender:</div>
            <div style='margin-bottom:10px;'>$email</div>
            <div style='color:#8d99a7;padding-top:13px;border-top:1px solid #f3f5f6;'>Comment:</div>
            <div style='margin-bottom:10px;'>$message</div>
        </div>
        <div style='color:#8d99a7; font-size:12px; text-align:center; padding-bottom:20px;'>Copyright $current_year ARTEM. All rights reserved.</div>
    </div>
</body>
</html>
";

//send email using PHPMailer
$mail = new PHPMailer(true);

//Recipients
$mail->setFrom('no-reply@mydomain.com', 'Company Name');  // which email will be sent from
$mail->addAddress('stephtakesphotos@gmail.com', 'Steph Test');  // who needs to send a letter

//Server settings
$mail->isSMTP();                                            // Send using SMTP
$mail->Host       = 'email-smtp.us-west-2.amazonaws.com';   // Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
$mail->Username   = 'AKIAXFSLSILZV4WV2LVL';                 // SMTP username
$mail->Password   = 'secret';                               // SMTP password
$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

// Content
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true);
$mail->Subject = 'Contact Form';  // subject of the letter
$mail->Body = $body;
$mail->AltBody = 'Name: $name, Email sender: $email, Phone: $phone, Comment: $message';

if ($mail->send() && $errorMSG == ''){
   echo 'success';
} else {
    if($errorMSG == ''){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    } else {
        echo $errorMSG;
    }
}
