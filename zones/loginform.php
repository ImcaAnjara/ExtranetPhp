<script type="text/javascript">
    jQuery(document).ready(function($){
    $('form#formnumero #valider').click(function(e){
        e.preventDefault();
         
        $.getJSON(
        	'http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getBynumero',	
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
        	'http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=checkByNomPrenomOrMail',	
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
                            <h1 class="title">Evaluation d'anglais</h1>

                        </div>
                        <div class="col-md-6"></div>
                        <div class="breadcrumb-box pull-right">
                            <div class="breadcrum_inner"><a class="home" href="">Accueil</a> > Accès Stagiaire : Avec identifiant</div>
                        </div>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
                        <!-- .content -->
                        <section class="login-form">
                              <div class="step-outter">
                                    <div class="step">
                                <h4>Saisissez votre numéro de dossier pour avoir accès à vos données personelles: </h4>

                                <form id="formnumero" action="searchstagiaire.php" method="POST" enctype="multipart/form-data" data-toggle="validator">
                                    <div class="row ">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                            <label >Numéro dossier</label>
                                           
                                                <input type="number" name="numerodossier" id="numerodossier" class="form-control" onkeypress="return isNumber(event)">
                                       </div>

                                        </div>
                                        <div class="form-group text-center">
                                            <div class="btn-group-lg ">
                                                <input class="btn btn-primary  special fit small" id="valider" type="submit" value="Connexion">
                                                <a href="index.php" class="btn btn-default btn-lg active" role="button" >Annuler</a>
                                                </a>
                                            </div>
<a  href="#" class="recover-password" data-toggle="modal" data-target="#recover_password"> Identifiant oublié</a>
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
<div id="recover_password" class="modal fade" role="dialog">
                  <div class="modal-dialog"> <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button> 
<h4>Identifiant oublié: </h4>
</div>
<div class="modal-body">
<form name="formmail" id="formmail" action="sendmailrecup.php" method="POST" enctype="multipart/form-data" data-toggle="validator">
    <div class="form-group">

        <label>E-mail</label>
       
            <input type="email" name="email" id="email" class="form-control" data-error="Veuillez entrer une adresse email valide" required>
        	<div class="help-block with-errors"></div>
       
        <div class="btn-group-lg text-center">
            <input class="btn btn-primary" type="submit" id="envoyer" value="Renvoyer">
            </a>
        </div>
    </div>
</form>
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
        <h4 class="modal-title">Informations</h4>
      </div>
      <div class="modal-body">
       <p>Ce mail n'est pas enregistré dans la base de données.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Mail envoyé</h4>
	      </div>
	      <div class="modal-body">
	        <p>Un mail de récupération est envoyé à votre adresse éléctronique.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
	      </div>
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