<?php 
session_start ();
$title="Mise à jour profil stagiare";
include ("zones/header.php");

?>

<script type="text/javascript">
function AfficherMasquer(x){
    divInfo = document.getElementById(x);
    
    if (divInfo.style.display == 'none')
        divInfo.style.display = 'block';
        else
            divInfo.style.display = 'none';
}

function checkboxall(){
    allunchecked = false;
    for (i=1;i<=7; i++) {
        if (document.getElementById("jsouhait" + i).checked == true) {
            allunchecked = true;
            break;
        }
    }
    if(allunchecked==false)
    {
        alert("Veuillez indiquer les jours souhaités pour effectuer la formation svp!");
        return false;
    }
    
    
    nbcheck =0;
    for (i=1;i<=13; i++){
        if (document.getElementById("y_"+ i).checked == true) {
            nbcheck++;
        }
    }
    if(nbcheck<=1)
    {
        alert("Veuillez choisir au moins deux attentes en terme de progression svp!");
        return false;
    }
    
    nbcheck1 =0;
    for (i=1;i<=10; i++){
        if (document.getElementById("x_"+ i).checked == true) {
            nbcheck1++;
        }
    }
    if(nbcheck1<=1)
    {
        alert("Veuillez choisir au moins deux centre interets svp!");
        return false;
    }
    
}
</script>
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
}
</style>

<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>

<div style="display:none;" id="myDiv" class="animate-bottom">

<section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                        <h1 class="title">Dossier personnel</h1>
                        <!-- <div class="breadcrumb-box breadcrumb-none"></div>-->
                    </div>
                </header>
                <div class="container">
                    <div class="row">
                        <!-- .content -->
                        <section id="forms">
                            <form name="validprofil" id="validprofil" action="updateall.php" method="POST" enctype="multipart/form-data" data-toggle="validator" onsubmit="return true">
                                <div class="col-md-12">
                                    <h3>Signalétique<span size="2">(*) champs obligatoires</span></h3>
                                    <input type="hidden" name="date_modif" size="15" value="">
                                    <input type="hidden" name="numero1" size="20" value="">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <!--
                                                -->
                                                <div class="form-group">
                                                    <input type="hidden" name="numerodossier" id="numerodossier" class="form-control col-md-6"  value="<?php echo($_SESSION['numeroStagiaire']);?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="societe">Société<span>*</span></label>
                                                    <input type="text" name="societe" id="societe" class="form-control col-md-6" data-error="Veuillez saisir votre société"  value="<?php echo($_SESSION['societeStagiaire']);?>" required>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="form-group">
                                                    <label for="civilite">Civilit&eacute;<span>*</span></label>
                                                    <select name="civilite" id="civilite" size="1" class="form-control">
                                        <option value="<?php echo($_SESSION['civiliteStagiaire']);?>"><?php echo($_SESSION['civiliteStagiaire']);?></option>
                                        </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nom">Nom<span>*</span></label>
                                                            <input type="text" id="nom" class="form-control" data-error="Veuillez saisir votre nom" name="nom" value="<?php echo($_SESSION['nomStagiaire']);?>" required>
                                                        	<div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="prenom">Prénom <span>*</span></label>
                                                            <input type="text" name="prenom" id="prenom" class="form-control" data-error="Veuillez saisir votre prénom" maxlength="256" value="<?php echo($_SESSION['prenomStagiaire']);?>" required>
                                                        	<div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fonction">Fonction <span>*</span></label>
                                                        <input type="text" name="fonction" id="fonction" class="form-control" data-error="Veuillez saisir votre fonction" maxlength="40" value="<?php echo($_SESSION['fonctionStagiaire']);?>" required>
                                                    	<div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="department">Département / Service  </label>
                                                        <input type="text" name="departement" id="departement" class="form-control" maxlength="40" value="<?php echo($_SESSION['departementStagiaire']);?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="telephone">Téléphone<span>*</span></label>
                                                                <input type="text" name="telephone" id="telephone" data-error="Veuillez saisir votre numero de téléphone" class="form-control" maxlength="40" value="<?php echo($_SESSION['telephoneStagiaire']);?>" required>
                                                            	<div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="portable">Portable</label>
                                                                <input type="text" name="portable" id="portable" class="form-control" maxlength="40" value="<?php echo($_SESSION['portableStagiaire']);?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mail">E-mail<span>*</span></label>
                                                        <input type="email" name="mail" id="mail" class="form-control" data-error="Veuillez entrer une adresse email valide" required value="<?php echo($_SESSION['mailStagiaire']);?>">
                                                    	<div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Lieu du stage</h5>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="RueDuStage">Rue<span>*</span> :  </label>
                                                                <input type="text" name="RueDuStage" id="RueDuStage" class="form-control" data-error="Veuillez entrer la rue" required maxlength="256" value="<?php echo($_SESSION['rueStagiaire']);?>">
                                                            <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="VilleDuStage">Ville<span>*</span> :  </label>
                                                                <input type="text" name="VilleDuStage" id="VilleDuStage" class="form-control" data-error="Veuillez entrer la ville" required maxlength="256" value="<?php echo($_SESSION['villeStagiaire']);?>">
                                                            <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="CPDuStage"> Code Postal<span>*</span>: </label>
                                                                <input type="text" name="CPDuStage" id="CPDuStage" class="form-control" data-error="Veuillez entrer la code postal" required size="8" maxlength="5" value="<?php echo($_SESSION['cpStagiaire']);?>">
                                                            <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- disponibilité-->
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>DISPONIBILITES :<span>* Jours souhaités</span></label>
                                                    <font size="2" face="Century Gothic">dans le cas o&ugrave; votre service formation valide votre stage, merci de nous indiquer ci-dessous combien de temps vous pouvez consacrer &agrave; vos cours (temps professionnel et personnel) :</font>
                                                    <div>
                                                        <ul class="jsouhait">
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait1" id="jsouhait1" value=" lundi " <?php 
                                                                        
                                                                        if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "lundi"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?> >Lundi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                <label>
                                                                	<input type="checkbox" name="jsouhait2" id="jsouhait2" value=" mardi " <?php 
                                                                        
                                                                	if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "mardi"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                	 >Mardi
                                                                	</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait3" id="jsouhait3" value=" mercredi " <?php 
                                                                        
                                                                        if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "mercredi"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                        >Mercredi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait4" id="jsouhait4" value=" jeudi " <?php 
                                                                        
                                                                        if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "jeudi"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                        >Jeudi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait5" id="jsouhait5" value=" vendredi " <?php 
                                                                        
                                                                        if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "vendredi"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                        >Vendredi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait6" id="jsouhait6" value=" samedi " <?php 
                                                                        
                                                                        if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "samedi"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                        >Samedi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait7" id="jsouhait7" value=" dimanche " <?php 
                                                                        
                                                                        if(isset($_SESSION['client_joursouhait']) && strstr($_SESSION['client_joursouhait'], "dimanche"))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                        >Dimanche
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <span><input type="text" class="form-control" readonly value="<?php 
                                                        if(isset($_SESSION['client_joursouhait'])){
                                                            echo($_SESSION['client_joursouhait']);
                                                        }
                                                        ?>" /></span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="horsouhait">Horaires souhaités :</label>
                                                                <input type="text" name="horaisouhait" id="horaisouhait" class="form-control" size="50" maxlength="80" value="<?php echo($_SESSION['horaireStagiaire']);?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Tempsperso">Temps personnel :</label>
                                                                <input type="text" name="Tempsperso" id="Tempsperso" class="form-control" maxlength="50" value="<?php echo($_SESSION['tempspersoStagiaire']);?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="Tempsprof">Temps professionnel :</label>
                                                                <input type="text" name="Tempsprof" id="Tempsprof" class="form-control" maxlength="50" value="<?php echo($_SESSION['tempsproStagiaire']);?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Absprevues">Absences prévues
                                                            <br> pour les 6 mois à venir :</label>
                                                            <input type="text" name="Absprevues" id="Absprevues" class="form-control" maxlength=100 value="<?php echo($_SESSION['abscStagiaire']);?>">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label>Accès à Internet :</label>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <font>professionnel </font>
                                                                <label><input type="radio" name="Internet_pro" value="1" 
                                                                <?php 
                                                                        
                                                                        if(isset($_SESSION['internetproStagiaire']) && ($_SESSION['internetproStagiaire']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                
                                                                > OUI </label>
                                                                <label><input type="radio" name="Internet_pro" value="0" 
                                                                <?php 
                                                                        
                                                                        if(isset($_SESSION['internetproStagiaire']) && ($_SESSION['internetproStagiaire']==0))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                > NON</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <font>personnel</font>
                                                                <label><input type="radio"  name="Internet_perso" value="1" 
                                                                <?php 
                                                                        
                                                                        if(isset($_SESSION['internetpersoStagiaire']) && ($_SESSION['internetpersoStagiaire']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                > OUI</label>
                                                                <label><input type="radio"  name="Internet_perso" value="0"  
                                                                <?php 
                                                                        
                                                                        if(isset($_SESSION['internetpersoStagiaire']) && ($_SESSION['internetpersoStagiaire']==0))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                > NON</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div align="center">
                                                        <font><strong> Souhaitez vous faire du &laquo; e learning &raquo; ?</strong></font>
                                                        <font> (travail personnalis&eacute; sur internet, <br> en compl&eacute;ment de vos cours) </font>
                                                        <div class="form-group">
                                                            <label> <input type="radio" value="1" name="e_learning" 
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['elarnStagiaire']) && ($_SESSION['elarnStagiaire']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            > OUI</label>
                                                            <label><input type="radio" name="e_learning" value="0" 
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['elarnStagiaire']) && ($_SESSION['elarnStagiaire']==0))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            > NON</label>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- / disponibilité-->

                                    <!-- profillinguistique -->
                                    <h3><label>VOTRE PROFIL LINGUISTIQUE<span>(*) champs obligatoires</span></label></h3>
                                    <div class="row">

                                        <h4>Langue</h4>
                                        <div class="row">
                                            <div class="col-md-6">

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <label>Niveau scolaire : </label>
                                                        <div class="col-md-4">
                                                            <div class="row">
                                                                <div class="radio">
                                                                    <label><input type="radio" name="x_niveausco" value="1" 
                                                                    <?php 
                                                                        
                                                                        if(isset($_SESSION['niveausco']) && ($_SESSION['niveausco']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                    >OUI</label>
                                                                    <label><input type="radio" name="x_niveausco" value="0" 
                                                                    <?php 
                                                                        
                                                                        if(isset($_SESSION['niveausco']) && ($_SESSION['niveausco']==0))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                                    >NON</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Bac+</label>
                                                                <div class="col-md-6">
                                                                    <input type="number" name="x_nbansbac" id="x_nbansbac" class="form-control" maxlength="4" value="<?php 
                                                                    if(isset($_SESSION['nbansbac'])) echo($_SESSION['nbansbac']);
                                                                    ?>" >
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Langue maternelle : </label>
                                                            <input type="text" name="x_languemat" id="x_languemat" class="form-control" value="<?php if(isset($_SESSION['languemat'])) echo($_SESSION['languemat']);?>" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label>1ère langue : </label>
                                                            <input type="text" name="x_premlang" id="x_premlang" class="form-control" value="<?php if(isset($_SESSION['premlang'])) echo($_SESSION['premlang']);?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Formation antérieure : </label>
                                                            <input type="text" name="x_formatAnt" id="x_formatAnt" class="form-control" value="<?php if(isset($_SESSION['formatAnt'])) echo($_SESSION['formatAnt']);?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Séjours dans les pays anglophones : </label>
                                                            <input type="text" name="x_paysAnglo" id="x_paysAnglo" class="form-control" value="<?php if(isset($_SESSION['paysanglo'])) echo($_SESSION['paysanglo']);?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h4><label>Utilisation de la langue sur le plan<span>*</span> </label></h4>
                                                        <div class="col-md-6">
                                                            <h5>Général:</h5>
                                                            <label> <input type="radio" name="x_LangGen" value="1" 
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['LangGen']) && ($_SESSION['LangGen']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >OUI </label>
                                                            <label><input type="radio" name="x_LangGen" value="0" 
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['LangGen']) && ($_SESSION['LangGen']==0))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            > NON</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5>Professionnel:</h5>
                                                            <label><input type="radio" name="x_LangPro" value="1"  
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['LangPro']) && ($_SESSION['LangPro']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >OUI</label>
                                                            <label><input type="radio" name="x_LangPro" value="0" 
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['LangPro']) && ($_SESSION['LangPro']==0))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >NON</label>
                                                        </div>

                                                    </div>
                                                    <div>
                                                        <h4><label>Type d'interlocuteurs <span> *</span>:</label></h4>
                                                        <div class="form-group">
                                                            <label>Leur nationalité<span>*</span>:</label>
                                                            <input type="text" name="x_NationInterloc" id="x_NationInterloc" class="form-control" data-error="Veuillez saisir leur nationalité" value="<?php if(isset($_SESSION['NationInterloc'])) echo($_SESSION['NationInterloc']);?>" required>
															<div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Leur fonction <span>*</span></label>
                                                            <input type="text" name="x_FonctInterloc" id="x_FonctInterloc" class="form-control" data-error="Veuillez saisir leur fonction" value="<?php if(isset($_SESSION['FonctInterloc'])) echo($_SESSION['FonctInterloc']);?>" required>
                                                        	<div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <h4><label>Attentes en terme de progression :<span>* 2 champs minimum</span></label></h4>
                                                    <div class="checkbox">
                                                        <div class="col-md-3">
                                                        
                                                            <label><input type="checkbox" name="y_1" value="1"  id="y_1"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['AttentesGramm']) && ($_SESSION['AttentesGramm']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Grammaire</label>
                                                            <label><input  type="checkbox" name="y_2" value="1"  id="y_2"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['AttentesCompreh']) && ($_SESSION['AttentesCompreh']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Compréhension</label>
                                                            <label><input  type="checkbox" name="y_3" value="1"  id="y_3"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['AttentesVocab']) && ($_SESSION['AttentesVocab']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Vocabulaire</label>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="checkbox" name="y_4" value="1" id="y_4"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrOral']) && ($_SESSION['ConfrOral']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Oral</label>
                                                            <label><input type="checkbox" name="y_5" value="1"  id="y_5"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrLecture']) && ($_SESSION['ConfrLecture']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>>Lecture</label>
                                                            
                                                            <label><input type="checkbox" name="y_6" value="1"  id="y_6"
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrCorrespond']) && ($_SESSION['ConfrCorrespond']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Correspondance</label>
                                                            <label><input type="checkbox" name="y_7" value="1"  id="y_7"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrRedact']) && ($_SESSION['ConfrRedact']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Rédaction</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="checkbox" name="y_8" value="1" id="y_8"
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrTel']) && ($_SESSION['ConfrTel']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Téléphone</label>
                                                            <label><input type="checkbox" name="y_9" value="1" id="y_9"
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrReunion']) && ($_SESSION['ConfrReunion']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Réunions</label>
                                                            <label><input type="checkbox" name="y_10" value="1"  id="y_10"
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrNegoc']) && ($_SESSION['ConfrNegoc']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Négociation</label>
                                                            <label> <input type="checkbox" name="y_11" value="1"  id="y_11"
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrPresent']) && ($_SESSION['ConfrPresent']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Présentations</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="checkbox" name="y_12" value="1"  id="y_12"
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrDeplace']) && ($_SESSION['ConfrDeplace']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            > Déplacements</label>
                                                            <label><input type="checkbox" name="y_13" value="1" id="y_13"
                                                             <?php 
                                                                        
                                                                        if(isset($_SESSION['ConfrAccueilVisite']) && ($_SESSION['ConfrAccueilVisite']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                            >Accueillir des visiteurs</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <h4>Domaines spécifiques :</h4>
                                                    <div class="form-group">
                                                        <textarea name="x_AttentesSpec" id="x_AttentesSpec" cols="40" rows="5" class="form-control"><?php if(isset($_SESSION['AttentesSpec'])) echo($_SESSION['AttentesSpec']);?></textarea></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                
                                                <div class="form-group">
                                                            <label>VOS BESOINS LINGUISTIQUES SPÉCIFIQUES A VOTRE FONCTION
                                                    <span>*</span></label>
                                                    <h5><i>(par
                                                        exemple faire passer un entretien de recrutement dans une langue étrangère
                                                        si vous êtes DRH, etc.)</i></h5>
                                                        	<textarea name="x_BesoinsSpecif" id="x_BesoinsSpecif" cols="85" rows="7" class="form-control" data-error="Veuillez remplir ce champ" required><?php if(isset($_SESSION['BesoinsSpecif'])) echo($_SESSION['BesoinsSpecif']);?></textarea>
                                                        	<div class="help-block with-errors"></div>
                                                        </div>

                                            </div>
                                            <!-- centre d'interêt -->
                                            <div class="col-md-8">

                                                <h4><label>QUELS SONT VOS CENTRES D'INTÉRÊTS EN DEHORS DU TRAVAIL ?<span> * 2 champs minimum</span></label></h4>
                                                <div class="col-md-8">
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_1" value="1"  onClick="AfficherMasquer('x_lectured');" id="x_1" 
                                                        
                                                         <?php 
                                                                        
                                                                        if(isset($_SESSION['lecture1']) && ($_SESSION['lecture1']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                        > Lecture</label>
                                                    </span>
                                                            <span id=""x_lectured_span" ><input id="x_lectured" name="x_lectured" maxlength="49" 
                                                            <?php 
                                                                        
                                                                        if(isset($_SESSION['lecture1']) && ($_SESSION['lecture1']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['lecture1']) && ($_SESSION['lecture1']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                            
                                                             placeholder="Détail de la lecture..." value="<?php if(isset($_SESSION['lecture_text'])) echo($_SESSION['lecture_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_2" value="1" 
                                                        <?php 
                                                                        
                                                                        if(isset($_SESSION['arts']) && ($_SESSION['arts']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                        onClick="AfficherMasquer('x_artsd');" id="x_2" > Arts</label> 
                                                    </span>
                                                        <span id="x_arts_span" ><input id="x_artsd" name="x_artsd" maxlength="49"  
                                                        <?php 
                                                                        
                                                                        if(isset($_SESSION['arts']) && ($_SESSION['arts']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['arts']) && ($_SESSION['arts']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                        placeholder="Détail de l'art..." value="<?php if(isset($_SESSION['arts_text'])) echo($_SESSION['arts_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_3" value="1" 
                                                         <?php 
                                                                        
                                                                        if(isset($_SESSION['sport']) && ($_SESSION['sport']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                         onClick="AfficherMasquer('x_sportd');" id="x_3" > Sport</label>
                                                    </span><span id="x_sport_span" ><input  id="x_sportd" name="x_sportd" maxlength="49" 
                                                    <?php 
                                                                        
                                                                        if(isset($_SESSION['sport']) && ($_SESSION['sport']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['sport']) && ($_SESSION['sport']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail du sport..." value="<?php if(isset($_SESSION['sport_text'])) echo($_SESSION['sport_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_4" value="1"  
                                                         <?php 
                                                                        
                                                                        if(isset($_SESSION['cuisine']) && ($_SESSION['cuisine']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                         onClick="AfficherMasquer('x_cuisined');" id="x_4" > Cuisine</label>
                                                    </span><span id="x_cuisine_span" ><input id="x_cuisined" name="x_cuisined" maxlength="49" 
                                                    <?php 
                                                                        
                                                                        if(isset($_SESSION['cuisine']) && ($_SESSION['cuisine']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['cuisine']) && ($_SESSION['cuisine']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail du cuisine..." value="<?php if(isset($_SESSION['cuisine_text'])) echo($_SESSION['cuisine_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_5" value="1"  
                                                        <?php 
                                                                        
                                                                        if(isset($_SESSION['jardin']) && ($_SESSION['jardin']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                        onClick="AfficherMasquer('x_jardind');" id="x_5" > Jardin</label> 
                                                    </span><span id="x_jardin_span" ><input   id="x_jardind" name="x_jardind" maxlength="49"  
                                                     <?php 
                                                                        
                                                                        if(isset($_SESSION['jardin']) && ($_SESSION['jardin']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['jardin']) && ($_SESSION['jardin']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail du jardin..." value="<?php if(isset($_SESSION['jardin_text'])) echo($_SESSION['jardin_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_6" value="1" 
                                                        <?php 
                                                                        
                                                                        if(isset($_SESSION['sciences']) && ($_SESSION['sciences']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                        onClick="AfficherMasquer('x_sciencesd');" id="x_6" > Sciences</label> 
                                                    </span><span id="x_sciences_span" ><input   id="x_sciencesd" name="x_sciencesd" maxlength="49"  
                                                     <?php 
                                                                        
                                                                        if(isset($_SESSION['sciences']) && ($_SESSION['sciences']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['sciences']) && ($_SESSION['sciences']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail de la sciences..." value="<?php if(isset($_SESSION['sciences_text'])) echo($_SESSION['sciences_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_7" value="1"
                                                         <?php 
                                                                        
                                                                        if(isset($_SESSION['musique']) && ($_SESSION['musique']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                         onClick="AfficherMasquer('x_musiqued');" id="x_7" > Musique</label>
                                                    </span><span id="x_musique_span" ><input   id="x_musiqued" name="x_musiqued" maxlength="49"  
                                                    <?php 
                                                                        
                                                                        if(isset($_SESSION['musique']) && ($_SESSION['musique']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['musique']) && ($_SESSION['musique']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail de la musique..." value="<?php if(isset($_SESSION['musique_text'])) echo($_SESSION['musique_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_8" value="1"  
                                                         <?php 
                                                                        
                                                                        if(isset($_SESSION['litterature']) && ($_SESSION['litterature']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                        onClick="AfficherMasquer('x_litteratured');" id="x_8" > Littérature</label> 
                                                    </span><span id="x_litterature_span" ><input  id="x_litteratured" name="x_litteratured" maxlength="49"  
                                                     <?php 
                                                                        
                                                                        if(isset($_SESSION['litterature']) && ($_SESSION['litterature']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['litterature']) && ($_SESSION['litterature']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail du litérature..." value="<?php if(isset($_SESSION['litterature_text'])) echo($_SESSION['litterature_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_9" value="1" 
                                                          <?php 
                                                                        
                                                                        if(isset($_SESSION['theatre']) && ($_SESSION['theatre']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                         onClick="AfficherMasquer('x_theatred');" id="x_9" > Théatre</label>
                                                    </span><span id="x_theatre_span" ><input  id="x_theatred" name="x_theatred" maxlength="49"  
                                                    <?php 
                                                                        
                                                                        if(isset($_SESSION['theatre']) && ($_SESSION['theatre']==1))
                                                                        {
                                                                            echo('style="display:block;"');
                                                                        }
                                                                        if(isset($_SESSION['theatre']) && ($_SESSION['theatre']==0))
                                                                        {
                                                                            echo('style="display:none;"');
                                                                        }
                                                                        ?>
                                                    placeholder="Détail du théatre..." value="<?php if(isset($_SESSION['theatre_text'])) echo($_SESSION['theatre_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_10" value="1" 
                                                                        <?php
                                                                        
                                                                        if(isset($_SESSION['bricolage']) && ($_SESSION['bricolage']==1))
                                                                        {
                                                                            echo("checked");
                                                                        }
                                                                        ?>
                                                         onClick="AfficherMasquer('x_bricolaged');" id="x_10" > Bricolage</label>
                                                    </span><span id="x_bricolage_span" ><input  id="x_bricolaged" name="x_bricolaged" maxlength="49"  
                                                    style="display:<?php 
                                                    if(isset($_SESSION['bricolage']))
                                                        if($_SESSION['bricolage']==1)
                                                    {
                                                        echo("block");
                                                    }
                                                    elseif ($_SESSION['bricolage']==0)
                                                    {
                                                        echo("none");
                                                    }
                                                    
                                                    ?>;"
                                                    placeholder="Détail du bricolage ..." value="<?php if(isset($_SESSION['bricolage_text'])) echo($_SESSION['bricolage_text']);?>"></span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group">
                                                        <label>Autres :</label>
                                                        <input type="text" name="x_autres_interets" id="x_autres_interets" class="form-control" value="<?php if(isset($_SESSION['autres_interets'])) echo($_SESSION['autres_interets']);?>">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group">
                                                        <label>Quel journal ou magazine aimez-vous lire en français?</label>
                                                        <input name="x_journal_text" id="x_journal_text" class="form-control" value="<?php if(isset($_SESSION['journal_text'])) echo($_SESSION['journal_text']);?>" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span>Vous pouvez maintenant valider le formulaire en cliquant sur le bouton ci-dessous :</span><br>
                                </div>
                                <input class="btn btn-primary center-block" type="submit" value="Valider la fiche stagiaire" onclick="return checkboxall();"></br>
                            </form>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    
     </div>
 
 <script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 600);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>

</body>
<?php 

include ("zones/footer.php");

?>