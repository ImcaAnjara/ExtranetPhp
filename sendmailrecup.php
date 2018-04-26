<?php 
include('httpful.phar');
$email  = $_POST["email"];

$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=checkByNomPrenomOrMail";
$data = "&mail=" . urlencode($email);

$urlEncode = $url.$data;

$response = \Httpful\Request::get($urlEncode)->send();
$jsonResp = $response->body;

if(isset($jsonResp) && '200' == $jsonResp->code) {
    $client_Numero = $jsonResp->data[0]->numero;
    $client_Nom = $jsonResp->data[0]->nom;
    $client_Prenom = $jsonResp->data[0]->prenom;
    $client_Mail = $jsonResp->data[0]->mail;
    $client_Civilite = $jsonResp->data[0]->Civilite;
}


$to      = $email;

$subject = 'Recuperation d\'identifiant';

$message = 'Bonjour ,<br>';
$message .= 'Vos identifiants sont: <br>';
$message .= '<b>'.$client_Civilite.' '.$client_Nom.' '.$client_Prenom.' : '.$client_Numero.'</b><br><br><br>';
$message .= 'Pour accéder au test de début en ligne, cliquez sur le lien suivant :<br><br>';
$message .= '<a href="http://www.forma2plus.com/extranet/stagiaires/" target="blank">http://www.forma2plus.com/extranet/stagiaires/ <br><br></a>';
$message .= 'Cordialement,<br><br>';
$message .= 'Service Accueil<br><br>';
$message .= 'Société : Forma 2 PLUS Forma2+  Plus de Services, plus de Résultats<br>';
$message .='<a href="https://www.google.com/maps/place/3+Rue+Bellanger,+92300+Levallois-Perret,+France/@48.8957482,2.2932211,17z/data=!3m1!4b1!4m5!3m4!1s0x47e66f9db99bf595:0x1afeefd0b6ef8574!8m2!3d48.8957482!4d2.2954098?hl=en" target="blank">3 rue Bellanger<br></a>';
$message .='<ahref="https://www.google.com/maps/place/3+Rue+Bellanger,+92300+Levallois-Perret,+France/@48.8957482,2.2932211,17z/data=!3m1!4b1!4m5!3m4!1s0x47e66f9db99bf595:0x1afeefd0b6ef8574!8m2!3d48.8957482!4d2.2954098?hl=en" target="blank" >92300 Levallois Perret<br></a>';
$message .='Paris - France<br>';
$message .='Tel : 01 47 31 13 13<br>';
$message .='Fax: 01 47 31 34 28';


$headers = 'MIME-Version: 1.0'."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

$headers .= 'From: "Administrateur"<administrateur@forma2plus.com>'."\n";

if(mail($to, $subject, $message, $headers)){
    header('Location: index.php');
}else{
    header('Location: login.php');
}




?>