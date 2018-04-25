<?php
session_start();
$title="Forma 2+: Enquete erreur";
include ("zones/headerFO.php");
$url="http://vps483915.ovh.net/extranet/premiersaisi_enquete.php?compteur=".$_SESSION['compteur'];
// $url="http://127.0.0.1/natif/extranetphp/premiersaisi_enquete.php?compteur=".$_SESSION['compteur'];
?>

<section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                    
                    <div class="container-fluid bg-1 text-center">
   						 <br><img src="design/extranet/images/logo.jpg" alt="Forma2+">
  					</div>
                    
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                        <br>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
                        <div class="alert alert-danger">
 						 <h6><strong>Une erreur s'est produite, nous vous prions de recommencer. Merci </strong></h6> 
						<a href=<?php echo($url);?> class="btn btn-primary btn-lg btn-block active" >Recommencer</a>
					</div>
					
					 
                </div>
            </section>
