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
					<form class="center-block">
<p class="text-left">Question <span style="color: red;">1</span> sur 50: <span style="color: red;">This machine has been able to improve production in ways not possible ... with the old system.</span></p>
  <table class="table table-striped">
    <tbody>
      <tr>
      <div class="radio center-block">
        <td class="text-left">
        <div class="col-md-8">
             <div><span><label><input type="radio" name="x_1" value="1" id="x_1" > to keep</label></span></div>
             <div><span><label><input type="radio" name="x_1" value="1" id="x_1" > to have kept</label></span></div>
             <div><span><label><input type="radio" name="x_1" value="1" id="x_1" > should we keeping</label></span></div>
             <div><span><label><input type="radio" name="x_1" value="1" id="x_1" > had we keeping</label></span></div>
             <div><span><label><input type="radio" name="x_1" value="1" id="x_1" > <span style="color: red;">Ne sais pas / I don't know</span></label></span></div>                                       
        </td>
      </tr>
      </div>
    </tbody>
  </table>
  <input class="btn btn-primary  special fit small center-block" id="valider" type="submit" value=">>> Passez à la question suivante / Next question >>>"
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