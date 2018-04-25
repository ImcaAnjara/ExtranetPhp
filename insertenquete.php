<?php 
session_start();
include('httpful.phar');

echo($_SESSION['compteur']);
$q1="Etes-vous satisfait des informations transmises préalablement à votre formation?";
$q1c1= "Organisation du stage";
$q1c1r= isset($_POST['101'])? 	$_POST['101'] : "";
$q1c1r1= isset($_POST['101i'])? 	$_POST['101i'] : "";
$q1c2= "Consignes administratives";
$q1c2r= isset($_POST['102'])? 	$_POST['102'] : "";
$q1c2r2= isset($_POST['102i'])? 	$_POST['102i'] : "";

$q2="La formation vous a-t-elle permis d\%27atteindre les objectifs fixés?";
$q2c1= "Expression écrite";
$q2c1r= isset($_POST['103'])? 	$_POST['103'] : "";
$q2c1r1= isset($_POST['103i'])? 	$_POST['103i'] : "";
$q2c2= "Expression orale";
$q2c2r= isset($_POST['104'])? 	$_POST['104'] : "";
$q2c2r2= isset($_POST['104i'])? 	$_POST['104i'] : "";
$q2c3= "Progression grammaire";
$q2c3r= isset($_POST['105'])? 	$_POST['105'] : "";
$q2c3r3= isset($_POST['105i'])? 	$_POST['105i'] : "";
$q2c4= "Progression vocabulaire";
$q2c4r= isset($_POST['106'])? 	$_POST['106'] : "";
$q2c4r4= isset($_POST['106i'])? 	$_POST['106i'] : "";

$q3="La formation dispensée répond -elle globalement à vos attentes? ";
$q3c1= "Lien avec activité professionnelle";
$q3c1r= isset($_POST['1103'])? 	$_POST['1103'] : "";
$q3c1r1= isset($_POST['1103i'])? 	$_POST['1103i'] : "";
$q3c2= "Planning";
$q3c2r= isset($_POST['1104'])? 	$_POST['1104'] : "";
$q3c2r2= isset($_POST['1104i'])? 	$_POST['1104i'] : "";
$q3c3= "Rythme des cours";
$q3c3r= isset($_POST['1105'])? 	$_POST['1105'] : "";
$q3c3r3= isset($_POST['1105i'])? 	$_POST['1105i'] : "";
$q3c4= "Structure";
$q3c4r= isset($_POST['1106'])? 	$_POST['1106'] : "";
$q3c4r4= isset($_POST['1106i'])? 	$_POST['1106i'] : "";

$q4="Etes-vous satisfait des conditions d\%27accueil lors de vos cours Face à Face à Forma2+ ? ";
$q4c1= "Equipements et matériels";
$q4c1r= isset($_POST['107'])? 	$_POST['107'] : "";
$q4c1r1= isset($_POST['107i'])? 	$_POST['107i'] : "";
$q4c2= "Locaux";
$q4c2r= isset($_POST['108'])? 	$_POST['108'] : "";
$q4c2r2= isset($_POST['108i'])? 	$_POST['108i'] : "";

$q5="Etes-vous satisfait des méthodes pédagogiques interactives? ";
$q5c1= "Mises en situation et jeux de rôle";
$q5c1r= isset($_POST['109'])? 	$_POST['109'] : "";
$q5c1r1= isset($_POST['109i'])? 	$_POST['109i'] : "";
$q5c2= "Variété et qualité des activités";
$q5c2r= isset($_POST['110'])? 	$_POST['110'] : "";
$q5c2r2= isset($_POST['110i'])? 	$_POST['110i'] : "";

$q6="Etes-vous satisfait des supports pédagogiques? ";
$q6c1= "Pertinence des termes du glossaire";
$q6c1r= isset($_POST['111'])? 	$_POST['111'] : "";
$q6c1r1= isset($_POST['111i'])? 	$_POST['111i'] : "";
$q6c2= "Qualité du contenu (Livre et cahier d\%27exercices)";
$q6c2r= isset($_POST['112'])? 	$_POST['112'] : "";
$q6c2r2= isset($_POST['112i'])? 	$_POST['112i'] : "";
$q6c3= "Audio/Vidéo";
$q6c3r= isset($_POST['113'])? 	$_POST['113'] : "";
$q6c3r3= isset($_POST['113i'])? 	$_POST['113i'] : "";
$q6c4= "Plateforme E-learning";
$q6c4r= isset($_POST['114'])? 	$_POST['114'] : "";
$q6c4r4= isset($_POST['114i'])? 	$_POST['114i'] : "";

$q7= "Etes-vous satisfait de votre accès personnalisé à notre serveur de cours en ligne ?";
$q7c1= "Complémentarité avec les cours en Face à Face et par Télephone";
$q7c1r= isset($_POST['115'])? 	$_POST['115'] : "";
$q7c1r1= isset($_POST['115i'])? 	$_POST['115i'] : "";

$q8= "Etes-vous satisfait de votre professeur en Face à Face? ";
$q8c1= "Animation";
$q8c1r= isset($_POST['116'])? 	$_POST['116'] : "";
$q8c1r1= isset($_POST['116i'])? 	$_POST['116i'] : "";
$q8c2= "Choix des exercices";
$q8c2r= isset($_POST['117'])? 	$_POST['117'] : "";
$q8c2r2= isset($_POST['117i'])? 	$_POST['117i'] : "";
$q8c3= "Pédagogie";
$q8c3r= isset($_POST['118'])? 	$_POST['118'] : "";
$q8c3r3= isset($_POST['118i'])? 	$_POST['118i'] : "";
$q8c4= "Ponctualité";
$q8c4r= isset($_POST['119'])? 	$_POST['119'] : "";
$q8c4r4= isset($_POST['119i'])? 	$_POST['119i'] : "";

$q9 = "Etes-vous satisfait de votre professeur par Téléphone? ";
$q9c1= "Animation";
$q9c1r= isset($_POST['120'])? 	$_POST['120'] : "";
$q9c1r1= isset($_POST['120i'])? 	$_POST['120i'] : "";
$q9c2= "Choix des exercices";
$q9c2r= isset($_POST['121'])? 	$_POST['121'] : "";
$q9c2r2= isset($_POST['121i'])? 	$_POST['121i'] : "";
$q9c3= "Pédagogie";
$q9c3r= isset($_POST['122'])? 	$_POST['122'] : "";
$q9c3r3= isset($_POST['122i'])? 	$_POST['122i'] : "";

$q10 = "Etes-vous globalement satisfait de votre formation?";
$q10c1= "Globalement";
$q10c1r= isset($_POST['123'])? 	$_POST['123'] : "";
$q10c1r1= isset($_POST['123i'])? 	$_POST['123i'] : "";

$suggestions= isset($_POST['comment'])? 	$_POST['comment'] : "";

$qs1="Question 1";
$qs2="Question 2";
$qs3="Question 3";
$qs4="Question 4";
$qs5="Question 5";
$qs6="Question 6";
$qs7="Question 7";
$qs8="Question 8";
$qs9="Question 9";
$qs10="Question 10";


$date_enregistrement = date('Y-m-d H:i:s');


$url = "http://extranet.forma2plus.com:808/php/stagiaires/enquete.php?func=insertEnquetedetails";

$data = "&numero=" . urlencode($_SESSION['compteur']);
$data .= "&dateEnregistrement=" . urlencode($date_enregistrement);
$data .= "&q1=" . urlencode(utf8_decode($qs1));
$data .= "&q1c1=" . urlencode(utf8_decode($q1c1));
$data .= "&q1c1r=" . urlencode(utf8_decode($q1c1r));
$data .= "&q1c1r1=" . urlencode(utf8_decode($q1c1r1));
$data .= "&q1c2=" . urlencode(utf8_decode($q1c2));
$data .= "&q1c2r=" . urlencode(utf8_decode($q1c2r));
$data .= "&q1c2r2=" . urlencode(utf8_decode($q1c2r2));
$data .= "&q2=" . urlencode(utf8_decode($qs2));
$data .= "&q2c1=" . urlencode(utf8_decode($q2c1));
$data .= "&q2c1r=" . urlencode(utf8_decode($q2c1r));
$data .= "&q2c1r1=" . urlencode(utf8_decode($q2c1r1));
$data .= "&q2c2=" . urlencode(utf8_decode($q2c2));
$data .= "&q2c2r=" . urlencode(utf8_decode($q2c2r));
$data .= "&q2c2r2=" . urlencode(utf8_decode($q2c2r2));
$data .= "&q2c3=" . urlencode(utf8_decode($q2c3));
$data .= "&q2c3r=" . urlencode(utf8_decode($q2c3r));
$data .= "&q2c3r3=" . urlencode(utf8_decode($q2c3r3));
$data .= "&q2c4=" . urlencode(utf8_decode($q2c4));
$data .= "&q2c4r=" . urlencode(utf8_decode($q2c4r));
$data .= "&q2c4r4=" . urlencode(utf8_decode($q2c4r4));
$data .= "&q3=" . urlencode(utf8_decode($qs3));
$data .= "&q3c1=" . urlencode(utf8_decode($q3c1));
$data .= "&q3c1r=" . urlencode(utf8_decode($q3c1r));
$data .= "&q3c1r1=" . urlencode(utf8_decode($q3c1r1));
$data .= "&q3c2=" . urlencode(utf8_decode($q3c2));
$data .= "&q3c2r=" . urlencode(utf8_decode($q3c2r));
$data .= "&q3c2r2=" . urlencode(utf8_decode($q3c2r2));
$data .= "&q3c3=" . urlencode(utf8_decode($q3c3));
$data .= "&q3c3r=" . urlencode(utf8_decode($q3c3r));
$data .= "&q3c3r3=" . urlencode(utf8_decode($q3c3r3));
$data .= "&q3c4=" . urlencode(utf8_decode($q3c4));
$data .= "&q3c4r=" . urlencode(utf8_decode($q3c4r));
$data .= "&q3c4r4=" . urlencode(utf8_decode($q3c4r4));
$data .= "&q4=" . urlencode(utf8_decode($qs4));
$data .= "&q4c1=" . urlencode(utf8_decode($q4c1));
$data .= "&q4c1r=" . urlencode(utf8_decode($q4c1r));
$data .= "&q4c1r1=" . urlencode(utf8_decode($q4c1r1));
$data .= "&q4c2=" . urlencode(utf8_decode($q4c2));
$data .= "&q4c2r=" . urlencode(utf8_decode($q4c2r));
$data .= "&q4c2r2=" . urlencode(utf8_decode($q4c2r2));
$data .= "&q5=" . urlencode(utf8_decode($qs5));
$data .= "&q5c1=" . urlencode(utf8_decode($q5c1));
$data .= "&q5c1r=" . urlencode(utf8_decode($q5c1r));
$data .= "&q5c1r1=" . urlencode(utf8_decode($q5c1r1));
$data .= "&q5c2=" . urlencode(utf8_decode($q5c2));
$data .= "&q5c2r=" . urlencode(utf8_decode($q5c2r));
$data .= "&q5c2r2=" . urlencode(utf8_decode($q5c2r2));
$data .= "&q6=" . urlencode(utf8_decode($qs6));
$data .= "&q6c1=" . urlencode(utf8_decode($q6c1));
$data .= "&q6c1r=" . urlencode(utf8_decode($q6c1r));
$data .= "&q6c1r1=" . urlencode(utf8_decode($q6c1r1));
$data .= "&q6c2=" . urlencode(utf8_decode($q6c2));
$data .= "&q6c2r=" . urlencode(utf8_decode($q6c2));
$data .= "&q6c2r2=" . urlencode(utf8_decode($q6c2r2));
$data .= "&q6c3=" . urlencode(utf8_decode($q6c3));
$data .= "&q6c3r=" . urlencode(utf8_decode($q6c3r));
$data .= "&q6c3r3=" . urlencode(utf8_decode($q6c3r3));
$data .= "&q6c4=" . urlencode(utf8_decode($q6c4));
$data .= "&q6c4r=" . urlencode(utf8_decode($q6c4r));
$data .= "&q6c4r4=" . urlencode(utf8_decode($q6c4r4));
$data .= "&q7=" . urlencode(utf8_decode($qs7));
$data .= "&q7c1=" . urlencode(utf8_decode($q7c1));
$data .= "&q7c1r=" . urlencode(utf8_decode($q7c1r));
$data .= "&q7c1r1=" . urlencode(utf8_decode($q7c1r1));
$data .= "&q8=" . urlencode(utf8_decode($qs8));
$data .= "&q8c1=" . urlencode(utf8_decode($q8c1));
$data .= "&q8c1r=" . urlencode(utf8_decode($q8c1r));
$data .= "&q8c1r1=" . urlencode(utf8_decode($q8c1r1));
$data .= "&q8c2=" . urlencode(utf8_decode($q8c2));
$data .= "&q8c2r=" . urlencode(utf8_decode($q8c2r));
$data .= "&q8c2r2=" . urlencode(utf8_decode($q8c2r2));
$data .= "&q8c3=" . urlencode(utf8_decode($q8c3));
$data .= "&q8c3r=" . urlencode(utf8_decode($q8c3r));
$data .= "&q8c3r3=" . urlencode(utf8_decode($q8c3r3));
$data .= "&q8c4=" . urlencode(utf8_decode($q8c4));
$data .= "&q8c4r=" . urlencode(utf8_decode($q8c4r));
$data .= "&q8c4r4=" . urlencode(utf8_decode($q8c4r4));
$data .= "&q9=" . urlencode(utf8_decode($qs9));
$data .= "&q9c1=" . urlencode(utf8_decode($q9c1));
$data .= "&q9c1r=" . urlencode(utf8_decode($q9c1r));
$data .= "&q9c1r1=" . urlencode(utf8_decode($q9c1r1));
$data .= "&q9c2=" . urlencode(utf8_decode($q9c2));
$data .= "&q9c2r=" . urlencode(utf8_decode($q9c2r));
$data .= "&q9c2r2=" . urlencode(utf8_decode($q9c2r2));
$data .= "&q9c3=" . urlencode(utf8_decode($q9c3));
$data .= "&q9c3r=" . urlencode(utf8_decode($q9c3r));
$data .= "&q9c3r3=" . urlencode(utf8_decode($q9c3r3));
$data .= "&q10=" . urlencode(utf8_decode($qs10));
$data .= "&q10c1=" . urlencode(utf8_decode($q10c1));
$data .= "&q10c1r=" . urlencode(utf8_decode($q10c1r));
$data .= "&q10c1r1=" . urlencode(utf8_decode($q10c1r1));
$data .= "&suggestions=" . urlencode(utf8_decode($suggestions));


$urlEncode = $url.$data;
$response = \Httpful\Request::get($urlEncode)->send();
$jsonResp = $response->body;

if(isset($jsonResp) && '200' == $jsonResp->code){
	header('Location: enquetesuccess.php');
} else {
	header('Location: enquetefailed.php');
}


// $date_enregistrement = date('Y-m-d H:i:s');
// $data = "&civilite=" . urlencode(utf8_decode($civilite));
// $data .= "&nom=" . urlencode(utf8_decode($nom));
// $data .= "&prenom=" . urlencode(utf8_decode($prenom));
// $data .= "&societe=" . urlencode(utf8_decode($societe));
// $data .= "&telephone=" . urlencode(utf8_decode($telephone));
// $data .= "&mail=" . urlencode(utf8_decode($mail)) ;
// $data .= "&date_creation=" . urlencode($date_creation) ;

// $urlEncode = $url.$data;

// $response = \Httpful\Request::get($urlEncode)->send();

// $jsonResp = $response->body;


// if(isset($jsonResp) && '200' == $jsonResp->code){
    
    
//     $url1 = "http://extranet.forma2plus.com:808/php/stagiaires/stagiaires.php?func=checkByNomPrenomOrMail";
//     $data1 = "&nom=" . urlencode(utf8_decode($nom));
//     $data1 .= "&prenom=" . urlencode(utf8_decode($prenom));
//     $response1 = \Httpful\Request::get($url1.$data1)->send();
    
//     $jsonResp1 = $response1->body;
//     $numero  = $jsonResp1->data[0]->numero;
// 	header('Location: insertsuccess.php?numero='.$numero);
// } else {
// 	header('Location: insertfailed.php');
// }
	
	
?>