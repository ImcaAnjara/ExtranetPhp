<script type="text/javascript">
function Correction() {
	
	var reponses = document.getElementById('reponse').value;
	if(document.getElementById('choix_1').checked){
		var valeur = document.getElementById('choix_1').value;
		if( reponses == valeur){
		alert("Bonne réponse");
		}else{
		alert("Mauvaise réponse");
			}
	} 
	else if(document.getElementById('choix_2').checked){
		var valeur = document.getElementById('choix_2').value;
		if( reponses == valeur){
			alert("Bonne réponse");
			}else{
			alert("Mauvaise réponse");
				}
	}else if(document.getElementById('choix_3').checked){
		var valeur = document.getElementById('choix_3').value;
		if( reponses == valeur){
			alert("Bonne réponse");
			}else{
			alert("Mauvaise réponse");
				}
	}
	else if(document.getElementById('choix_4').checked){
		var valeur = document.getElementById('choix_4').value;
		if( reponses == valeur){
			alert("Bonne réponse");
			}else{
			alert("Mauvaise réponse");
				}
	}
	else {
		var valeur = document.getElementById('choix_5').value;
		if( reponses == valeur){
			alert("Bonne réponse");
			}else{
			alert("Mauvaise réponse");
				}
	}
	
}
</script>

<?php 

$title="Test évaluation langue";
include ("zones/header.php");

session_start();


if (!isset($_SESSION['numero'])){
	header('Location: index.php');
}else{
	$_SESSION['numero'] = $_POST["numerodossiertest"];
	$_SESSION['nomtest'] = $_POST["nomtest"];
}

?>
      
      <section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container ">
                        <h1 class="title">Test en ligne de : <?php echo($_SESSION['nomtest']);?></h1>
                        <!-- <div class="breadcrumb-box breadcrumb-none"></div>-->
                    </div>
                </header>
                <div class="container">
                    <div class="row">
					<div class="button-group">
					<div class="panel panel-default">
					<div class="panel-heading">
					<p class="lead alert alert-success text-center"><b>Test en ligne / ONLINE TEST</p>
					<p class="text-center"><b>Sélectionner une réponse / Select an answer</b></p>
					
					<?php 
$json = file_get_contents("json/questionnaire.php.json");
$parsed_json = json_decode($json);

$limit=10;

for($i=0; $i<$limit; $i++){
	$q= $parsed_json->data[$i]->Question;
	$r1= $parsed_json->data[$i]->reponse_a;
	$r2= $parsed_json->data[$i]->reponse_b;
	$r3= $parsed_json->data[$i]->reponse_c;
	$r4= $parsed_json->data[$i]->reponse_d;
	if((int)$parsed_json->data[$i]->reponse == 1){
		$rep = $r1;
	}
	elseif((int)$parsed_json->data[$i]->reponse == 2)
	{
		$rep = $r2;
	}
	elseif((int)$parsed_json->data[$i]->reponse == 3)
	{
		$rep = $r3;
	}
	elseif((int)$parsed_json->data[$i]->reponse == 4)
	{
		$rep = $r4;
	}
	$nb =$i+1;
// 	echo("Question ".$nb. ": ".$q.'<br>');
// 	echo(" ***** Choix: ".$r1. " - ".$r2. " - ".$r3." - ".$r4. '<br>');
// 	echo(" ----- Réponse: ".$rep. '<br>');

	
}
					
					
?>
					
<form name="questionform" id="questionform"  >
<p class="text-left">Question <span style="color: red;"><?php echo($nb); ?></span> sur 50: <span style="color: red;"><?php echo($q); ?></span></p>
  <table class="table table-striped">
    <tbody>
      <tr>
      <div class="radio center-block">
        <td class="text-left">
        <div class="col-md-8">
             <div><span><label><input type="radio" name="choix" id="choix_1" value="<?php echo($r1); ?>" > <?php echo($r1); ?></label></span></div>
             <div><span><label><input type="radio" name="choix" id="choix_2" value="<?php echo($r2); ?>" > <?php echo($r2); ?></label></span></div>
             <div><span><label><input type="radio" name="choix" id="choix_3" value="<?php echo($r3); ?>" > <?php echo($r3); ?></label></span></div>
             <div><span><label><input type="radio" name="choix" id="choix_4" value="<?php echo($r4); ?>" > <?php echo($r4); ?></label></span></div>
             <div><span><label><input type="radio" name="choix" id="choix_5" value="Ne sait pas" ><span style="color: red;"> Ne sais pas / I don't know</span></label></span></div>                                       
        </td>
      </tr>
      </div>
    </tbody>
  </table>
  <input type="hidden" name="reponse" id="reponse" value="<?php echo($rep); ?>">
  <input type="hidden" name="numerotest" id="numerotest" value="<?php echo($_SESSION['numero']);?>">
  <input type="hidden" name="testnom" id="testnom" value="<?php echo($_SESSION['nomtest']);?>">
  <input class="btn btn-success  center-block" id="valider" type="button" value=">>> Passez à la question suivante / Next question >>>" onclick="Correction();">
 </form> 
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

?>