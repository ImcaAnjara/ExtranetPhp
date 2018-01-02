<?php 
session_start ();
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
                        <h1 class="title">Numéro dossier</h1>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
					<div class="button-group">
					<div class="panel panel-default">
					<div class="panel-heading">
					<p class="lead text-center">Votre numéro de dossier est le :<b><?php 
					if(isset($_SESSION['numero'])){
					    echo($_SESSION['numero']);
					}else {
					    header('Location: index.php');
					}
					   ?>
					</b><br>Merci de retenir ce numéro pour le test de démarrage.</p>
					<form id="insertform" action="update.php" method="POST" enctype="multipart/form-data" >
					<input type="hidden" name="numerodossier" id="numerodossier" value="<?php echo($_SESSION['numero']);?>">
					<input class="btn btn-primary  special fit small center-block" id="valider" type="submit" value="Continuer">
					</form>
				</div>
				</div>
					</div>
                    </div>
                </div>
            </section>
            
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
session_unset ();
session_destroy ();
?>