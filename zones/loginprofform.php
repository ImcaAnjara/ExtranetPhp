<script type="text/javascript">
    jQuery(document).ready(function($){
    $('form#formnumero #valider').click(function(e){
        e.preventDefault();
         
        $.getJSON(
        	'http://extranet.forma2plus.com:808/php/stagiaires/stagiaires.php?func=getBynumero',	
            {numero: $('#numerodossier').val()},
            function(data){
            		if('200' == data.code){
	            		if(data.data[0] ==undefined ){
	            			$('#myModal').modal('show');
	                	}else{
	                		$('#formnumero').submit();
	                	} 
            		}else{
            			e.isDefaultPrevented();
            		}
            }
        );
    });
});

    
jQuery(document).ready(function($){
    $('form#formmail #envoyer').click(function(e){
        e.preventDefault();
         
        $.getJSON(
        	'http://extranet.forma2plus.com:808/php/stagiaires/stagiaires.php?func=checkByNomPrenomOrMail',	
            {mail: $('#email').val()},
            function(data){
            		if('200' == data.code){
	            		if(data.data[0] ==undefined ){
	            			$('#myModal1').modal('show');
	                	}else{
	                		$('#myModal2').modal('show');
	                		$('#formmail').submit();
	                	} 
            		}else{
            			e.isDefaultPrevented();
            		}
            }
        );
    });
});


function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
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

                                <form id="formnumero" action="searchstagiaire.php" method="POST" enctype="multipart/form-data" data-toggle="validator">
                                    <div class="row ">
                                        <div class="form-group">
                                            <label class="col-md-4">Login: </label>
                                            <div class="col-md-8">
                                                <input type="text" name="numerodossier" id="numerodossier" class="form-control" onkeypress="return isNumber(event)">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4">Mot de passe: </label>
                                            <div class="col-md-8">
                                                <input type="text" name="numerodossier" id="numerodossier" class="form-control" onkeypress="return isNumber(event)">
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
												        <p>Utilisateur non enregistré.</p>
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