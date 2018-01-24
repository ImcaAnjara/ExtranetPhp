<form id="gowebcal" action="" method="POST" enctype="multipart/form-data" >
			
			<input type="hidden" name="numerodossiertest" id="numerodossiertest" value="<?php echo($_SESSION['numerodossier']);?>">
					<input type="hidden" name="nomtest" id="nomtest" value="<?php echo($_SESSION['nomStagiaire']);?>">
							
			
			
			<a href="http://s371880604.onlinehome.fr/webcalendar/srcs/www/auto.php?module=jauth&action=login:formLight" class="btn btn-primary btn-lg center-block active" role="button" title="Connexion" target="blank">Cliquez  ici  pour  planifier  votre  rendez-vous  avec  un  professeur  pour  votre  évaluation  orale  par  téléphone.</a>
									<br><h5 style="text-align: center;">Votre Login/Identifiant: <span style="color: #2e5481;"><?php echo($_SESSION['nomStagiaire']);?></span></h5>
								<h5 style="text-align: center;">Votre mot de passe: <span style="color: #2e5481;"><?php echo($_SESSION['numerodossier']);?></span></h5>	
</form>