<?php 

function getPhone($numero){
	$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getBynumero";
	$data = "&numero=" . urlencode($numero);
	$urlEncode = $url.$data;
	$response = \Httpful\Request::get($urlEncode)->send();
	$jsonResp = $response->body;
	if(isset($jsonResp) && '200' == $jsonResp->code) {
		$telephone = $jsonResp->data[0]->Telephone;
	}
	return $telephone;
}

function getSociete($numero){
	$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getBynumero";
	$data = "&numero=" . urlencode($numero);
	$urlEncode = $url.$data;
	$response = \Httpful\Request::get($urlEncode)->send();
	$jsonResp = $response->body;
	if(isset($jsonResp) && '200' == $jsonResp->code) {
		$societe = $jsonResp->data[0]->societe;
	}
	return $societe;
}



?>