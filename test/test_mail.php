<?php
require('../phpmailer/class.phpmailer.php');

$mail = new PHPMailer();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Port = 587; // Par d�faut

// Authentification
$mail->Username = "antsiresy@gmail.com";
$mail->Password = "2017tsiresy";

// Exp�diteur
$mail->SetFrom('antsiresy@gmail.com', 'Nom Pr�nom');
// Destinataire
$mail->AddAddress('antsiresy2@gmail.com', 'Nom Pr�nom');
// Objet
$mail->Subject = 'Objet du message';

// Votre message
$mail->MsgHTML('Contenu du message en HTML');

// Envoi du mail avec gestion des erreurs
if(!$mail->Send()) {
    echo 'Erreur : ' . $mail->ErrorInfo;
} else {
    echo 'Message sent !';
} 
      
 ?>