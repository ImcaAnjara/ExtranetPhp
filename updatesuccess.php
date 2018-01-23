<?php

$title="Mise à jour éffectué";
include ("zones/header.php");


session_start ();
include('httpful.phar');
include ("fonctions/script.php");
if (!isset($_SESSION['numero'])){
	header('Location: index.php');
}

$urlcheck = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=checkResultByNumeroIdBase";
$datacheck = "&numero_idbase=" . urlencode($_SESSION['numero']);
$urlEncodecheck = $urlcheck.$datacheck;

$responsecheck = \Httpful\Request::get($urlEncodecheck)->send();
$jsonRespcheck = $response->body;


if(isset($jsonRespcheck) && '200' == $jsonRespcheck->code ) {
	if($jsonRespcheck->data!=[]){
		$_SESSION["go"] = 0;
	}else if(isset($jsonRespcheck) && $jsonRespcheck->data==[]){
		$_SESSION["go"] = 1;
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
		$data0 .= "&nom=" . urlencode(($_SESSION['nomStagiaire']));
		$data0 .= "&prenom=" . urlencode(($_SESSION['prenomStagiaire']));
		$tel = getPhone($_SESSION['numero']);
		$societe = getSociete($_SESSION['numero']);
		$data0 .= "&tel=" . urlencode(($tel));
		$data0 .= "&societe=" . urlencode(($societe));
		$data0 .= "&debutfin=" . urlencode("D");
		$data0 .= "&date_actuelle=" . urlencode(date("d/m/Y"));
		$data0 .= "&date_passation=" . urlencode(date("d/m/Y"));
		$data0 .= "&heure_passation=" . urlencode(date("H:i:s"));
		$urlEncode0 = $url0.$data0;
		
		$response0 = \Httpful\Request::get($urlEncode0)->send();
		$jsonResp1 = $response->body;
		
		$url1 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=Insertresultat";
		$data1 = "&compteur_test=" . urlencode($_SESSION['Compteur_test']);
		$numeroko = 101;
		$data1 .= "&numero=" . urlencode(($numeroko));
		$urlEncode1 = $url1.$data1;
		
		$response1 = \Httpful\Request::get($urlEncode1)->send();
		$jsonResp1 = $response->body;
	}
	
}




?>
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>

<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">

      <section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                        <h1 class="title">Test en ligne</h1>
                        <!-- <div class="breadcrumb-box breadcrumb-none"></div>-->
                    </div>
                </header>
                <div class="container">
                    <div class="row">
					<div class="button-group">
					<div class="panel panel-default">
					<div class="panel-heading">
					<p class="lead alert alert-success text-center"><b>Test en ligne / ONLINE TEST</b></p>
					
					<p class="lead alert alert-info text-center">Bienvenue sur le serveur Forma2+,<br>
					Welcome on the Forma2plus server,<br><br>
					
					Test de niveau / Beginning of course test<br>
					QCM de début / MCQ test</br>
					<?php 
					if($_SESSION["go"] == 1){
					include("gotest.php");
					}else{
						include("nogotest.php");
					}
					?>
				</div>
				</div>
					</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    </div>
 
 <script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 600);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

</body>


<?php 
include ("zones/footer.php");

?>