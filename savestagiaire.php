<?php 
session_start ();
include('httpful.phar');


$civilite = $_POST["client_iCivilite"];
$nom = $_POST["client_zNom"];
$prenom = $_POST["client_zPrenom"];
$societe = $_POST["client_iSociete"];
$telephone = $_POST["client_zTel"];
$mail = $_POST["client_zMail"];


$url = "http://extranet.forma2plus.com:808/php/stagiaires/stagiaires.php?func=insert";
$date_creation = date('Y-m-d H:i:s');
$data = "&civilite=" . urlencode(utf8_decode($civilite));
$data .= "&nom=" . urlencode(utf8_decode($nom));
$data .= "&prenom=" . urlencode(utf8_decode($prenom));
$data .= "&societe=" . urlencode(utf8_decode($societe));
$data .= "&telephone=" . urlencode(utf8_decode($telephone));
$data .= "&mail=" . urlencode(utf8_decode($mail)) ;
$data .= "&date_creation=" . urlencode($date_creation) ;

$urlEncode = $url.$data;

$response = \Httpful\Request::get($urlEncode)->send();

$jsonResp = $response->body;


if(isset($jsonResp) && '200' == $jsonResp->code){
    
    
    $url1 = "http://extranet.forma2plus.com:808/php/stagiaires/stagiaires.php?func=checkByNomPrenomOrMail";
    $data1 = "&nom=" . urlencode(utf8_decode($nom));
    $data1 .= "&prenom=" . urlencode(utf8_decode($prenom));
    $response1 = \Httpful\Request::get($url1.$data1)->send();
    
    $jsonResp1 = $response1->body;
    $_SESSION['numero']  = $jsonResp1->data[0]->numero;
	header('Location: insertsuccess.php');
} else {
	header('Location: insertfailed.php');
}
	
	
?>