<?php 
session_start();
$title="Test évaluation langue";
include ("zones/header.php");
if (!isset($_GET['numerodossiertest'])){
	header('Location: index.php');
}else{
	$numtest = $_GET["numerodossiertest"];
	$nomtest = $_GET["nomtest"];
}
if (!isset($_SESSION["time"])){
    $_SESSION["time"] = "30:00";
}
$temps = explode(":",$_SESSION["time"]);
$minutes = (int)$temps[0];
$secondes = (int)$temps[1];
if(!isset($_SESSION['note'.$numtest])){
    $_SESSION['note'.$numtest] = 0;
}
if(!isset($_SESSION["tpssec"])){
    $_SESSION["tpssec"] = 30 * 60;
    
}

?>

<script type="text/javascript">
function Correction() {
	var check = false;
	$("input[name='choix']").each(function(){
		if($(this).is(":checked")){
			check = true;
		}
		});
	if(check==false){
alert("Veuillez sélectionner une réponse");
		}
	return check;
}


$(document).ready(function(){
	var Tmn = <?php echo($minutes);?>;
	var sc = <?php echo($secondes);?>;
	var tm = '';
	var mn = Tmn;
	//Compteur
	function Go(){
		setTimeout(function(){
			sc--;
			if(sc<0){sc=59; mn--;}
	
			tm=((mn<10)?"0":" ") + mn +":";
			tm+=((sc<10)?"0":" ") + sc +"";
			var x = mn/3;
			if(x<=1 && x>=2/3)
				$('#time').css('color', 'green');
			else if(x<=2/3 && x>=1/3)
				$('#time').css('color', 'orange');
			else
				$('#time').css('color', 'red');

			$('#time').val(tm);
			if(mn == 0 && sc == 0)
				{resultatQCM(); }
			Go();
		}, 1000);
	}

	Go();
	function resultatQCM(){
		var time = $('#time').val();
	document.location.href="<?php echo("note.php?numerodossiertest=$numtest&nomtest=$nomtest");?>&time="+time;
		}
});

</script>

<form name="questionform" id="questionform" action="traiter.php" method="post">
      
      <section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container ">
                        <h1 class="title">Test en ligne de : <?php echo($nomtest);?></h1>
                        <!-- <div class="breadcrumb-box breadcrumb-none"></div>-->
                    </div>
                </header>
                <div class="container">
                    <div class="row">
					<div class="button-group">
					<div class="panel panel-default">
					<div class="panel-heading">
					<p class="lead alert alert-success text-center"><b><span style="float:left"> Test en ligne / ONLINE TEST</span> -||- <span style="float:right">Temps restant: <input type="text" id="time" name="time" readonly="yes" style="font-size:20px; background-color: #dff0d8"/></span> </p>
					<p class="text-center"><b>Sélectionner une réponse / Select an answer</b></p>
					
					<?php 
$json = file_get_contents("json/questionnaire.php.json");
$parsed_json = json_decode($json);

if(!isset($_SESSION['iteration'.$numtest])){
    $_SESSION['iteration'.$numtest] = 1;
}


$limit=$_SESSION['iteration'.$numtest];
if(!isset($_SESSION['note'.$numtest])){
    $_SESSION['note'.$numtest]=0;
}

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
	

	
}
					
$_SESSION["reponse"] = $rep;
?>
					
<p>Compteur_test: <?php echo($_SESSION['Compteur_test']);?></p>
<p class="text-left">Question <span style="color: red;"><?php echo($nb); ?></span> sur 50: <span style="color: red;font-size:20px;margin-left:40px"><?php echo($q); ?></span></p>
  <input type="hidden" name="numquestion" id="numquestion" value="<?php echo($nb); ?>" >
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
             <div><span><label><input type="radio" name="choix" id="choix_5" value="Ne sait pas"><span style="color: red;"> Ne sais pas / I don't know</span></label></span></div>                                       
        </td>
      </tr>
      </div>
    </tbody>
  </table>
  <input type="hidden" name="numerotest" id="numerotest" value="<?php echo($numtest);?>">
  <input type="hidden" name="testnom" id="testnom" value="<?php echo($nomtest);?>">
  <input class="btn btn-success  center-block" id="valider" type="submit" value=">>> Passez à la question suivante / Next question >>>" onclick="return Correction();">
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