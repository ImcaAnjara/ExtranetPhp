<script type="text/javascript">
    jQuery(document).ready(function($){
        
    $('form#formnumero #valider').click(function(e){

    	e.preventDefault();

		if($('#nomprof').val() == "" && $('#codeprof').val() == "007"){
			window.location.replace("AcceuilProf_ancien.php"); 
		}
		else{
	        $.getJSON(
	        	'http://extranet.forma2plus.com:808/php/stagiaires/professeur.php?func=checkByNomProflogin',	
	            {Nomfamille: $('#nomprof').val(), RefInd: $('#codeprof').val()},
	            function(data){
					
	            		if('200' == data.code){
		            		if(data.message == "1" ){
		            			$('#formnumero').submit();
		                	}
		            		else if (data.message == "0" ){
		            			$('#myModal1').modal('show');
		                	}
		            		else {
		            			$('#myModal').modal('show');
		                	} 
	            		}else{
	            			e.isDefaultPrevented();
	            		}
	            		
	            }
	        );

			}
    });
});


</script>



<section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                        <div class="col-md-6">
                            <h1 class="title">ACCÈS PROFESSEURS ET FORMA2+</h1>

                        </div>
                        <div class="col-md-6"></div>
                        <div class="breadcrumb-box pull-right">
                            <div class="breadcrum_inner"><a class="home" href="">Accueil</a> > Accès Professeur et Forma2+</div>
                        </div>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
                        <!-- .content -->
                        <section>
                            <div class="col-md-6 col-md-offset-3">
                                <h4>Saisir login et votre mot de passe: </h4>

                                <form id="formnumero" action="searchprofesseur.php" method="POST" enctype="multipart/form-data" data-toggle="validator">
                                    <div class="row ">
                                        <div class="form-group">
                                            <label class="col-md-4">Login: </label>
                                            <div class="col-md-8">
                                                <input name="nomprof" type="text" id="nomprof" tabindex="1" class="form-control" >
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Mot de passe: </label>
                                            <div class="col-md-8">
                                                <input name="codeprof" type="password" id="codeprof" class="form-control"  required>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="btn-group-lg text-center">
                                                <input class="btn btn-primary  special fit small" id="valider" type="submit" value="Valider">
                                                <a href="index.php" class="btn btn-default btn-lg active" role="button" >Annuler</a>
                                                </a>
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
												        <p>Vous n'avez mal renseigné vos identifiant de connexion.</p>
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
												      </div>
												    </div>
												
												  </div>
					  </div>
					  <div id="myModal1" class="modal fade" role="dialog">
												  <div class="modal-dialog">
												
												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Informations1</h4>
												      </div>
												      <div class="modal-body">
												        <p>L'identifiant ou/et le mot de passe est/sont incorrect.</p>
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
												      </div>
												    </div>
												
												  </div>
					  </div>
                                

                            </div>
                        </section>

                    </div>
                </div>
            </section>
        </div>
    </div>