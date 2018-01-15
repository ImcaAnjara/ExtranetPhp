<?php 
session_start();


$numtest=$_GET["numerodossiertest"];
// echo($_SESSION['note'.$numtest]);
// echo "<br>";
$tps = $_SESSION["tpssec"];
if($tps>=60){
    $min = (int)($tps/60);
    $sec = $tps%60;
}else{
    $min = 0;
    $sec = $tps;
}
// echo("temps passé: $min et $sec");
$title="Note d'évaluation langue";
include ("zones/header.php");
?>


<section id="main" class="no-padding">
<header class="page-header">
<div class="container">
<h1 class="title">Résultat test</h1>
</div>
</header>
<div class="container">
<div class="row">
<div class="button-group">
<div class="panel panel-default">
<div class="panel-heading">
<p class="lead alert alert-info text-center"><b>Résultat - EVALUATION LANGUE.</b></p>

<h5>Nous vous remercions du temps que vous nous avez accordé pour la réalisation de ce test.<br>
We thank you for having taken the time to complete this test.</h5>
<br>
<p style="font-size: 18px; color: #7996b7; text-align: center"><b>Votre score: <?php echo($_SESSION['note'.$numtest]);?> bonnes réponses sur 50 questions.<br>
Your score: <?php echo($_SESSION['note'.$numtest]);?> out of 50 questions</br>
Durée totale / Duration of test: <?php echo($min);?> minutes et <?php echo($sec);?> secondes.</p><br>

<br>

<p style="font-size: 18px; color: #7996b7; text-align: center">Pour toute aide vous pouvez nous contacter au 01 47 31 13 13.<br>
For further assistance, please contact us on +33(0)1 47 31 13 13.</p>
					
					<br><br><br><h4 style=" text-align: center">Allez sur le site 
					<a href="http://www.forma2plus.com/" target=blank>www.forma2plus.com</a></h4>
				</div>
				</div>
					</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php 
include ("zones/footer.php");
session_unset ();
?>