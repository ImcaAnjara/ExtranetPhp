<?php
require('../phpmailer/class.phpmailer.php');
$mail = new PHPMailer();

$mail             = new PHPMailer(); // defaults to using php "mail()"

$mail->IsSendmail(); // telling the class to use SendMail transport


$mail->SetFrom('antsiresy@gmail.com', 'First Last');

$mail->AddReplyTo("antsiresy@gmail.com","First Last");

$address = "antsiresy2@gmail.com";
$mail->AddAddress($address, "John Doe");

$mail->Subject    = "PHPMailer Test Subject via Sendmail, basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML("<h1>Tet</h1>");


if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
      
 ?>