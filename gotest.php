<?php 

$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=GetMaxcompteurTest";

$response = \Httpful\Request::get($url)->send();
$jsonResp = $response->body;

if(isset($jsonResp) && '200' == $jsonResp->code) {
	$Compteur_test = $jsonResp->data[0]->lastnum;
}
$_SESSION['Compteur_test'] = $Compteur_test+1;

$url0 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=InsertresultTest";
$data0 = "&compteur_test=" . urlencode($_SESSION['Compteur_test']);
$data0 .= "&numero_idbase=" . urlencode(($_SESSION['numero']));
$data0 .= "&nom=" . urlencode(utf8_decode($_SESSION['nomStagiaire']));
$data0 .= "&prenom=" . urlencode(utf8_decode($_SESSION['prenomStagiaire']));
$tel = getPhone($_SESSION['numero']);
$societe = getSociete($_SESSION['numero']);
$data0 .= "&tel=" . urlencode(($tel));
$data0 .= "&societe=" . urlencode(utf8_decode($societe));
$data0 .= "&debutfin=" . urlencode("D");
$data0 .= "&date_actuelle=" . urlencode(date("d/m/Y"));
$data0 .= "&date_passation=" . urlencode(date("d/m/Y"));
$data0 .= "&heure_passation=" . urlencode(date("H:i:s"));
$urlEncode0 = $url0.$data0;

$response0 = \Httpful\Request::get($urlEncode0)->send();
$jsonResp1 = $response0->body;

$url1 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=Insertresultat";
$data1 = "&compteur_test=" . urlencode($_SESSION['Compteur_test']);
$numeroko = 101;
$data1 .= "&numero=" . urlencode(($numeroko));
$urlEncode1 = $url1.$data1;

$response1 = \Httpful\Request::get($urlEncode1)->send();
$jsonResp1 = $response->body;

?>



<form id="questionform" action="question.php" method="GET" enctype="multipart/form-data" >
		<p class="lead text-left">Bonjour / Dear <b><?php echo($_SESSION['nomStagiaire'].' '.$_SESSION['prenomStagiaire']);?></b><br>
		Numéro: <b><?php echo($_SESSION['numerodossier']);?></b></p>
		
		<p class="lead alert alert-danger text-center"><b>Attention: Le test nécessite 20 à 30 minutes, il est impossible de le quitter après l'avoir commencé, il est donc impératif de vous consacrer pleinement à cette évaluation.</b></p> 
		<p class="lead text-left"><u><b>Utilisation du Quizz en ligne</b></u>:  cocher la bonne réponse puis cliquer sur <b>"SUIVANTE"</b>. Une réponse est obligatoire pour chaque question, vous ne pourrez passer à la suivante qu'après avoir répondu. </p>
		
		<p class="lead alert alert-danger text-center"><b>Attention: This test takes 20 to 30 minutes and it is impossible to quit once you have started. Therefore, make sure you have enough time to complete this evaluation.</b></p> 
		<p class="lead text-left"><u><b>Using the online quiz</b></u>: tick the right answer then clicl on <b>"NEXT"</b>. In order to get the next question, you must choose and tick one answer. </p>
		
		<input type="hidden" name="numerodossiertest" id="numerodossiertest" value="<?php echo($_SESSION['numerodossier']);?>">
		<input type="hidden" name="nomtest" id="nomtest" value="<?php echo($_SESSION['nomStagiaire']);?>">
		<input class="btn btn-success  center-block" id="valider" type="submit" value="Lancer le test / Run the test">
</form>