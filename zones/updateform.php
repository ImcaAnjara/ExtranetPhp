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
<?php 
session_start ();
?>

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
                                                                        <input type="checkbox" name="jsouhait1" id="jsouhait1" value=" lundi " {if $joursouhait1Stagiaire == lundi} checked="checked"} >Lundi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                <label>
                                                                	<input type="checkbox" name="jsouhait2" id="jsouhait2" value=" mardi " {if $joursouhait2Stagiaire==mardi} checked="checked"}{/if} >Mardi
                                                                	</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait3" id="jsouhait3" value=" mercredi " {if $joursouhait3Stagiaire==mercredi} checked="checked"}{/if}>Mercredi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait4" id="jsouhait4" value=" jeudi " {if $joursouhait4Stagiaire==jeudi} checked="checked"}{/if}>Jeudi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait5" id="jsouhait5" value=" vendredi " {if $joursouhait5Stagiaire==vendredi} checked="checked"}{/if}>Vendredi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait6" id="jsouhait6" value=" samedi " {if $joursouhait6Stagiaire==samedi} checked="checked"}{/if}>Samedi
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="jsouhait7" id="jsouhait7" value=" dimanche " {if $joursouhait7Stagiaire==dimanche} checked="checked"}{/if}>Dimanche
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <span><input type="text" class="form-control" readonly value="{$joursouhait1Stagiaire} {$joursouhait2Stagiaire} {$joursouhait3Stagiaire} {$joursouhait4Stagiaire} {$joursouhait5Stagiaire} {$joursouhait6Stagiaire} {$joursouhait7Stagiaire}" /></span>
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
                                                                <label><input type="radio" name="Internet_pro" value="1" {if $internetproStagiaire == 1 } checked="checked" {/if}> OUI </label>
                                                                <label><input type="radio" name="Internet_pro" value="0" {if $internetproStagiaire == 0 } checked="checked" {/if}> NON</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <font>personnel</font>
                                                                <label><input type="radio"  name="Internet_perso" value="1" {if $internetpersoStagiaire == 1 } checked="checked" {/if}> OUI</label>
                                                                <label><input type="radio"  name="Internet_perso" value="0"  {if $internetpersoStagiaire == 0 } checked="checked" {/if}> NON</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div align="center">
                                                        <font><strong> Souhaitez vous faire du &laquo; e learning &raquo; ?</strong></font>
                                                        <font> (travail personnalis&eacute; sur internet, <br> en compl&eacute;ment de vos cours) </font>
                                                        <div class="form-group">
                                                            <label> <input type="radio" value="1" name="e_learning" {if $elarnStagiaire == 1 } checked="checked" {/if}> OUI</label>
                                                            <label><input type="radio" name="e_learning" value="0" {if $elarnStagiaire == 0 } checked="checked" {/if}> NON</label>
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
                                                                    <label><input type="radio" name="x_niveausco" value="1" {if $niveausco == 1 } checked="checked" {/if} >OUI</label>
                                                                    <label><input type="radio" name="x_niveausco" value="0" {if $niveausco == 0 } checked="checked" {/if}>NON</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Bac+</label>
                                                                <div class="col-md-6">
                                                                    <input type="number" name="x_nbansbac" id="x_nbansbac" class="form-control" maxlength="4" value="<?php echo($_SESSION['nbansbac']);?>" >
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Langue maternelle : </label>
                                                            <input type="text" name="x_languemat" id="x_languemat" class="form-control" value="<?php echo($_SESSION['languemat']);?>" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label>1ère langue : </label>
                                                            <input type="text" name="x_premlang" id="x_premlang" class="form-control" value="<?php echo($_SESSION['premlang']);?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Formation antérieure : </label>
                                                            <input type="text" name="x_formatAnt" id="x_formatAnt" class="form-control" value="<?php echo($_SESSION['formatAnt']);?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label>Séjours dans les pays anglophones : </label>
                                                            <input type="text" name="x_paysAnglo" id="x_paysAnglo" class="form-control" value="<?php echo($_SESSION['paysanglo']);?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <h4><label>Utilisation de la langue sur le plan<span>*</span> </label></h4>
                                                        <div class="col-md-6">
                                                            <h5>Général:</h5>
                                                            <label> <input type="radio" name="x_LangGen" value="1" {if $LangGen == 1 } checked="checked" {/if} >OUI </label>
                                                            <label><input type="radio" name="x_LangGen" value="0" {if $LangGen == 0 } checked="checked" {/if} > NON</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5>Professionnel:</h5>
                                                            <label><input type="radio" name="x_LangPro" value="1" {if $LangPro == 1 } checked="checked" {/if} >OUI</label>
                                                            <label><input type="radio" name="x_LangPro" value="0" {if $LangPro == 0 } checked="checked" {/if} >NON</label>
                                                        </div>

                                                    </div>
                                                    <div>
                                                        <h4><label>Type d'interlocuteurs <span> *</span>:</label></h4>
                                                        <div class="form-group">
                                                            <label>Leur nationalité<span>*</span>:</label>
                                                            <input type="text" name="x_NationInterloc" id="x_NationInterloc" class="form-control" data-error="Veuillez saisir leur nationalité" value="<?php echo($_SESSION['NationInterloc']);?>" required>
															<div class="help-block with-errors"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Leur fonction <span>*</span></label>
                                                            <input type="text" name="x_FonctInterloc" id="x_FonctInterloc" class="form-control" data-error="Veuillez saisir leur fonction" value="<?php echo($_SESSION['FonctInterloc']);?>" required>
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
                                                        
                                                            <label><input type="checkbox" name="y_1" value="1" {if $AttentesGramm == 1 } checked="checked" {/if} id="y_1">Grammaire</label>
                                                            <label><input  type="checkbox" name="y_2" value="1" {if $AttentesCompreh == 1 } checked="checked" {/if} id="y_2">Compréhension</label>
                                                            <label><input  type="checkbox" name="y_3" value="1" {if $AttentesVocab == 1 } checked="checked" {/if} id="y_3">Vocabulaire</label>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="checkbox" name="y_4" value="1" {if $ConfrOral == 1 } checked="checked" {/if} id="y_4">Oral</label>
                                                            <label><input type="checkbox" name="y_5" value="1" {if $ConfrLecture == 1 } checked="checked" {/if} id="y_5">Lecture</label>
                                                            <label><input type="checkbox" name="y_6" value="1" {if $ConfrCorrespond == 1 } checked="checked" {/if} id="y_6">Correspondance</label>
                                                            <label><input type="checkbox" name="y_7" value="1" {if $ConfrRedact == 1 } checked="checked" {/if} id="y_7">Rédaction</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="checkbox" name="y_8" value="1" {if $ConfrTel == 1 } checked="checked" {/if} id="y_8">Téléphone</label>
                                                            <label><input type="checkbox" name="y_9" value="1" {if $ConfrReunion == 1 } checked="checked" {/if} id="y_9">Réunions</label>
                                                            <label><input type="checkbox" name="y_10" value="1" {if $ConfrNegoc == 1 } checked="checked" {/if} id="y_10">Négociation</label>
                                                            <label> <input type="checkbox" name="y_11" value="1" {if $ConfrPresent == 1 } checked="checked" {/if} id="y_11">Présentations</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><input type="checkbox" name="y_12" value="1" {if $ConfrDeplace == 1 } checked="checked" {/if} id="y_12"> Déplacements</label>
                                                            <label><input type="checkbox" name="y_13" value="1" {if $ConfrAccueilVisite == 1 } checked="checked" {/if} id="y_13">Accueillir des visiteurs</label>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <h4>Domaines spécifiques :</h4>
                                                    <div class="form-group">
                                                        <textarea name="x_AttentesSpec" id="x_AttentesSpec" cols="40" rows="5" class="form-control"><?php echo($_SESSION['AttentesSpec']);?></textarea></div>
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
                                                        	<textarea name="x_BesoinsSpecif" id="x_BesoinsSpecif" cols="85" rows="7" class="form-control" data-error="Veuillez remplir ce champ" required><?php echo($_SESSION['BesoinsSpecif']);?></textarea>
                                                        	<div class="help-block with-errors"></div>
                                                        </div>

                                            </div>
                                            <!-- centre d'interêt -->
                                            <div class="col-md-8">

                                                <h4><label>QUELS SONT VOS CENTRES D'INTÉRÊTS EN DEHORS DU TRAVAIL ?<span> * 2 champs minimum</span></label></h4>
                                                <div class="col-md-8">
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_1" value="1" {if $Lecture == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_lectured');" id="x_1" > Lecture</label>
                                                    </span>
                                                            <span id=""x_lectured_span" ><input id="x_lectured" name="x_lectured" maxlength="49" {if $Lecture == 1 } style="display:block;" {/if} {if $Lecture == 0 } style="display:none;" {/if}  placeholder="Détail de la lecture..." value="<?php echo($_SESSION['lecture_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_2" value="1" {if $arts == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_artsd');" id="x_2" > Arts</label> 
                                                    </span>
                                                        <span id="x_arts_span" ><input id="x_artsd" name="x_artsd" maxlength="49" {if $arts == 1 } style="display:block;" {/if}{if $arts == 0 } style="display:none;" {/if} placeholder="Détail de l'art..." value="<?php echo($_SESSION['arts_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_3" value="1" {if $sport == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_sportd');" id="x_3" > Sport</label>
                                                    </span><span id="x_sport_span" ><input  id="x_sportd" name="x_sportd" maxlength="49" {if $sport == 1 } style="display:block;" {/if}{if $sport == 0 } style="display:none;" {/if} placeholder="Détail du sport..." value="<?php echo($_SESSION['sport_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_4" value="1" {if $cuisine == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_cuisined');" id="x_4" > Cuisine</label>
                                                    </span><span id="x_cuisine_span" ><input id="x_cuisined" name="x_cuisined" maxlength="49" {if $cuisine== 1 } style="display:block;" {/if}{if $cuisine== 0 } style="display:none;" {/if} placeholder="Détail du cuisine..." value="<?php echo($_SESSION['cuisine_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_5" value="1" {if $jardin == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_jardind');" id="x_5" > Jardin</label> 
                                                    </span><span id="x_jardin_span" ><input   id="x_jardind" name="x_jardind" maxlength="49" {if $jardin == 1 } style="display:block;" {/if}{if $jardin == 0 } style="display:none;" {/if} placeholder="Détail du jardin..." value="<?php echo($_SESSION['jardin_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_6" value="1" {if $sciences == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_sciencesd');" id="x_6" > Sciences</label> 
                                                    </span><span id="x_sciences_span" ><input   id="x_sciencesd" name="x_sciencesd" maxlength="49" {if $sciences == 1 } style="display:block;" {/if}{if $sciences == 0 } style="display:none;" {/if} placeholder="Détail de la sciences..." value="<?php echo($_SESSION['sciences_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_7" value="1" {if $musique == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_musiqued');" id="x_7" > Musique</label>
                                                    </span><span id="x_musique_span" ><input   id="x_musiqued" name="x_musiqued" maxlength="49" {if $musique == 1 } style="display:block;" {/if}{if $musique == 0 } style="display:none;" {/if} placeholder="Détail de la musique..." value="<?php echo($_SESSION['musique_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                        <label><input type="checkbox" name="x_8" value="1" {if $litterature == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_litteratured');" id="x_8" > Littérature</label> 
                                                    </span><span id="x_litterature_span" ><input  id="x_litteratured" name="x_litteratured" maxlength="49" {if $litterature == 1 } style="display:block;" {/if}{if $litterature == 0 } style="display:none;" {/if} placeholder="Détail du litérature..." value="<?php echo($_SESSION['litterature_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_9" value="1" {if $theatre == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_theatred');" id="x_9" > Théatre</label>
                                                    </span><span id="x_theatre_span" ><input  id="x_theatred" name="x_theatred" maxlength="49" {if $theatre == 1 } style="display:block;" {/if}{if $theatre == 0 } style="display:none;" {/if} placeholder="Détail du théatre..." value="<?php echo($_SESSION['theatre_text']);?>"></span>
                                                    </div>
                                                    <div>
                                                        <span>
                                                         <label><input type="checkbox" name="x_10" value="1" {if $bricolage == 1 } checked="checked" {/if} onClick="AfficherMasquer('x_bricolaged');" id="x_10" > Bricolage</label>
                                                    </span><span id="x_bricolage_span" ><input  id="x_bricolaged" name="x_bricolaged" maxlength="49" {if $bricolage == 1 } style="display:block;" {/if}{if $bricolage == 0 } style="display:none;" {/if} placeholder="Détail du bricolage ..." value="<?php echo($_SESSION['bricolage_text']);?>"></span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group">
                                                        <label>Autres :</label>
                                                        <input type="text" name="x_autres_interets" id="x_autres_interets" class="form-control" value="<?php echo($_SESSION['autres_interets']);?>">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="form-group">
                                                        <label>Quel journal ou magazine aimez-vous lire en français?</label>
                                                        <input name="x_journal_text" id="x_journal_text" class="form-control" value="<?php echo($_SESSION['journal_text']);?>" >
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