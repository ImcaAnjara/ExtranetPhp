
<script type="text/javascript">
    jQuery(document).ready(function($){
    $('form#insertform #valider').click(function(e){
        e.preventDefault();
         
        $.getJSON(
        	'http://extranet.forma2plus.com:808/php/stagiaires/stagiaires.php?func=checkByNomPrenomOrMail',	
            {nom: $('#client_zNom').val(), prenom: $('#client_zPrenom').val() },
            function(data){
            		if('200' == data.code){
	            		if(data.data[0] ==undefined ){
	                		$('#insertform').submit();
	                	}else{
	                		$('#myModal').modal('show');
	                	} 
            		}else{
            			e.isDefaultPrevented();
            		}
            }
        );
    });
});

</script>


           <section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                        <div class="col-md-6">
                            <h1 class="title">Evaluation d'anglais</h1>

                        </div>
                        <div class="col-md-6"></div>
                        <div class="breadcrumb-box pull-right">
                            <div class="breadcrum_inner">Accueil > Accès Stagiaire : Premier accès</div>
                        </div>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
                        <!-- .content -->
                            <form id="insertform" action="savestagiaire.php" method="POST" enctype="multipart/form-data" data-toggle="validator" >
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Civilité<span>*</span></label>
                                            <div class="col-md-8">
                                                <div class="radio">
                                                        <label><input type="radio" name="client_iCivilite" id="client_iCivilite" value="Mr" checked>Mr</label>
                                                        <label><input type="radio" name="client_iCivilite" id="client_iCivilite" value="Mme">Mme</label>
                                                        <label><input type="radio" name="client_iCivilite" id="client_iCivilite" value="Mlle">Mlle</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Nom<span>*</span></label>
                                            <div class="col-md-8">
                                                <input type="text" name="client_zNom"" id="client_zNom" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Prénom<span>*</span></label>
                                            <div class="col-md-8"><input type="text" name="client_zPrenom" id="client_zPrenom" class="form-control" required></div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Société<span>*</span></label>
                                            <div class="col-md-8"><input type="text" name="client_iSociete" id="client_iSociete" class="form-control" required></div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">Téléphone<span>*</span></label>
                                            <div class="col-md-8"><input type="text" name="client_zTel" id="client_zTel" class="form-control" required></div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">

                                            <label class="control-label col-md-4">E-mail<span>*</span></label>
                                            <div class="col-md-8"><input type="email" name="client_zMail" id="client_zMail" class="form-control" data-error="Veuillez entrer une adresse email valide" required>
                                            <div class="help-block with-errors"></div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="btn-group-lg text-center">
                                            <input class="btn btn-primary  special fit small" id="valider" type="submit" value="Enregister">
                                            <a href="index.php" class="btn btn-default btn-lg active" role="button" >Annuler</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        
                        <div id="myModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">
							
							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title">Informations</h4>
							      </div>
							      <div class="modal-body">
							        <p>Le Nom et le Prénom saisis sont déjà enregistrés dans la base.</p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
							      </div>
							    </div>
							
							  </div>
					  </div>
                    </div>
                </div>
                <!-- .container -->
            </section>

            <!-- #main -->

        </div>
        <!-- .page-box-content -->
    </div>