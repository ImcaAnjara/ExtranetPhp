<?php 
session_start ();
include('httpful.phar');

$numerodossier = $_POST["numerodossier"] ;
$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getBynumero";
$data = "&numero=" . urlencode($numerodossier);

$urlEncode = $url.$data;

$response = \Httpful\Request::get($urlEncode)->send();
$jsonResp = $response->body;

if(isset($jsonResp) && '200' == $jsonResp->code) {
    $client_Numero = $jsonResp->data[0]->numero;
    $client_Nom = $jsonResp->data[0]->nom;
    $client_Prenom = $jsonResp->data[0]->prenom;
    
    
    if(($jsonResp->data)==[]){
        header('Location: index.php');
    }else if(($jsonResp->data)!=[]){
        $_SESSION['numero'] = $client_Numero;
        $_SESSION['nom'] = $client_Nom;
        $_SESSION['prenom'] = $client_Prenom;
        $client_Prenom1 = $jsonResp->data[0]->prenom;
        
        header('Location: prefichestagiaire.php');
        
    }
    
}



?>