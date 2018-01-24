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
$jsonRespcheck = $responsecheck->body;


if(isset($jsonRespcheck) && '200' == $jsonRespcheck->code ) {
	if($jsonRespcheck->data!=[]){
		$_SESSION["go"] = 0;
	}else if(isset($jsonRespcheck) && $jsonRespcheck->data==[]){
		$_SESSION["go"] = 1;
		
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