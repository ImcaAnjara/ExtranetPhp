<?php
require('../phpmailer/class.phpmailer.php');

$mail = new PHPMailer();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Port = 587; // Par défaut

// Authentification
$mail->Username = "antsiresy@gmail.com";
$mail->Password = "2017tsiresy";

// Expéditeur
$mail->SetFrom('antsiresy@gmail.com', 'Nom Prénom');
// Destinataire
$mail->AddAddress('antsiresy2@gmail.com', 'Nom Prénom');
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