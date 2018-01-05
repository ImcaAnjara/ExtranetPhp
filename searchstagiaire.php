<?php 
session_start ();
include('httpful.phar');

$numerodossier = $_POST["numerodossier"] ;
$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getBynumero";
$data = "&numero=" . urlencode($numerodossier);

$urlEncode = $url.$data;

$response = \Httpful\Request::get($urlEncode)->send();
$jsonResp = $response->body;

$url1 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getByProfil";
$data1 = "&numero=" . urlencode($numerodossier);

$urlEncode1 = $url1.$data1;

$response1 = \Httpful\Request::get($urlEncode1)->send();
$jsonResp1 = $response1->body;

if(isset($jsonResp) && '200' == $jsonResp->code) {
    $client_Numero = $jsonResp->data[0]->numero;
    $client_Nom = $jsonResp->data[0]->nom;
    $client_Prenom = $jsonResp->data[0]->prenom;
    
    
    if(($jsonResp->data)==[]){
        header('Location: index.php');
    }else if(($jsonResp->data)!=[]){
//         $_SESSION['numero'] = $client_Numero;
//         $_SESSION['nom'] = $client_Nom;
//         $_SESSION['prenom'] = $client_Prenom;
        
        if(isset($jsonResp1) && $jsonResp1->data!=[]) {
        	$affiche = 1;
        }else if(isset($jsonResp1) && $jsonResp1->data==[]){
        	$affiche = 0;
        }
        
        
        header('Location: prefichestagiaire.php?numero='.$client_Numero.'&nom='.$client_Nom.'&prenom='.$client_Prenom.'&affiche='.$affiche);
        
    }
    
}



?>