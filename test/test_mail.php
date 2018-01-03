<?php

require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 25; // or 587
$mail->IsHTML(true);
$mail->Username = "antsiresy@gmail.com";
$mail->Password = "2017tsiresy";

$mail->setFrom('antsiresy@gmail.com', 'support');
$mail->addAddress('antsiresy2@gmail.com', 'Uma');
$mail->addReplyTo('antsiresy@gmail.com', 'Support');
$mail->isHTML(true);

$mail->Subject = 'Subject';
$mail->Body = 'Body';
$mail->AltBody = 'Dear Uma, Thank you for your interest.';


if(!$mail->send()) {
    echo "Opps! For some technical reasons we couldn't able to sent you an email. We will shortly get back to you with download details.";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message has been sent";
}
      
 ?>