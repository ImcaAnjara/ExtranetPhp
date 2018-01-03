<?php
require('../phpmailer/class.phpmailer.php');

$mail             = new PHPMailer();


$mail->SetFrom('antsiresy@gmail.com', 'First Last');

$mail->AddReplyTo("antsiresy@gmail.com","First Last");

$address = "antsiresy2@gmail.com";
$mail->AddAddress($address, "John Doe");

$mail->Subject    = "PHPMailer Test Subject via mail(), basic";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 

$mail->MsgHTML("<h1>Test</h1>");


if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
      
 ?>