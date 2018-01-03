<?php

require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->setFrom('antsiresy@gmail.com', 'First Last');
$mail->addReplyTo('antsiresy@gmail.com', 'First Last');
$mail->addAddress('antsiresy2@gmail.com', 'John Doe');
$mail->Subject = 'PHPMailer mail() test';
// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->Body = 'This is a plain-text message body';
// $mail->addAttachment('images/phpmailer_mini.png');

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
      
 ?>