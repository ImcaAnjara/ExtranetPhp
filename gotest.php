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