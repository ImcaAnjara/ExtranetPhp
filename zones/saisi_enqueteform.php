<?php 
include('httpful.phar');

$compteur = $_GET['compteur'];

$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=checkStagiaireByCompteur";
$data = "&compteur=" . urlencode($compteur);
$urlEncode = $url.$data;

$response = \Httpful\Request::get($urlEncode)->send();

$jsonResp = $response->body;

if(isset($jsonResp) && '200' == $jsonResp->code) {
    
    if(($jsonResp->data)==[]){
        header('Location: enqueteInterne.php');
        
    }else if(($jsonResp->data)!=[]){
        $numstage = $jsonResp->data[0]->Stage;
        $numcompteur = $jsonResp->data[0]->compteur;
        $numindividu = $jsonResp->data[0]->Individu;
        $module = $jsonResp->data[0]->StageModulePédagogique;
    }else {
        header('Location: enqueteInterne.php');
    }
}


$url1 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=checkStagiaireBynumIndividu";
$data1 = "&numindividu=" . urlencode($numindividu);
$urlEncode1 = $url1.$data1;

$response1 = \Httpful\Request::get($urlEncode1)->send();

$jsonResp1 = $response1->body;

if(isset($jsonResp1) && '200' == $jsonResp1->code) {
    
    if(($jsonResp1->data)==[]){
        header('Location: index.php');
        
    }else if(($jsonResp1->data)!=[]){
        $civilite = $jsonResp1->data[0]->Civilite;
        $nom = $jsonResp1->data[0]->nom;
        $prenom = $jsonResp1->data[0]->prenom;
        $societe = $jsonResp1->data[0]->societe;
        $formation = $jsonResp1->data[0]->Formation;
    }else {
        header('Location: index.php');
    }
}

$coord = $civilite ." ".$nom." ".$prenom ;


?>



<section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                    
                    <div class="container-fluid bg-1 text-center">
   						 <br><img src="design/extranet/images/logo.jpg" alt="Forma2+">
  					</div>
                    
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6"></div>
                        <br>
                    </div>
                </header>
                <div class="container">
                <form action="">
                    <div class="row">
						<section>
                            <div class="col-md-6 col-md-offset-3">
                            <h4>ENQUÊTE DE SATISFACTION </h4>
                            </div>
                        </section>
                        
                        <section class="content-section bg-light" id="about">
                              <div class="container text-left">
                                <div class="row">
                                  <div class="col-lg-10 mx-auto">
                                  <label style="font-size: 18px;color:#337ab7;">Nom et prénom de l'apprenant : </label> <label><?php echo($coord);?></label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Société : </label> <label><?php echo($societe);?></label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Intitulé de la formation : </label> <label><?php echo($formation);?></label><br>
                                  <label style="font-size: 18px;color:#337ab7;">N° stage : </label> <label><?php echo($numstage);?></label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Module : </label> <label><?php echo($module);?></label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Prof FAF :</label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Prof TEL :</label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Prof TUT :</label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Période :</label><br>
                                  <label style="font-size: 18px;color:#337ab7;">Date : </label> <label><?php  echo(date("d/m/Y"));?></label><br>
                                  
                                  </div>
                                </div>
                              </div>
    					</section>
    					<br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>1. Etes-vous satisfait des informations transmises préalablement à votre formation?</strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Organisation du stage</td>
                                            <td> <input name="101" value="Pas concerné" type="radio" class="with-gap" id="radio100"></td>
                                            <td> <input name="101" value=Insatisfait" type="radio" class="with-gap" id="radio101"></td>
                                            <td> <input name="101" value="Peu satisfait" type="radio" class="with-gap" id="radio102"></td>
                                            <td> <input name="101" value="Satisfait" type="radio" class="with-gap" id="radio103"></td>
                                            <td> <input name="101" value="Très satisfait" type="radio" class="with-gap" id="radio104"></td>
                                          </tr>
                                          <tr>
                                            <td>Consignes administratives</td>
                                            <td> <input name="102" value="Pas concerné" type="radio" class="with-gap" id="radio105"></td>
                                            <td> <input name="102" value=Insatisfait" type="radio" class="with-gap" id="radio106"></td>
                                            <td> <input name="102" value="Peu satisfait" type="radio" class="with-gap" id="radio107"></td>
                                            <td> <input name="102" value="Satisfait" type="radio" class="with-gap" id="radio108"></td>
                                            <td> <input name="102" value="Très satisfait" type="radio" class="with-gap" id="radio109"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>2. La formation vous a-t-elle permis d'atteindre les objectifs fixés? </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Expression écrite</td>
                                            <td> <input name="103" value="Pas concerné" type="radio" class="with-gap" id="radio110"></td>
                                            <td> <input name="103" value=Insatisfait" type="radio" class="with-gap" id="radio111"></td>
                                            <td> <input name="103" value="Peu satisfait" type="radio" class="with-gap" id="radio112"></td>
                                            <td> <input name="103" value="Satisfait" type="radio" class="with-gap" id="radio113"></td>
                                            <td> <input name="103" value="Très satisfait" type="radio" class="with-gap" id="radio114"></td>
                                          </tr>
                                          <tr>
                                            <td>Expression orale</td>
                                            <td> <input name="104" value="Pas concerné" type="radio" class="with-gap" id="radio115"></td>
                                            <td> <input name="104" value=Insatisfait" type="radio" class="with-gap" id="radio116"></td>
                                            <td> <input name="104" value="Peu satisfait" type="radio" class="with-gap" id="radio117"></td>
                                            <td> <input name="104" value="Satisfait" type="radio" class="with-gap" id="radio118"></td>
                                            <td> <input name="104" value="Très satisfait" type="radio" class="with-gap" id="radio119"></td>
                                          </tr>
                                          <tr>
                                            <td>Progression grammaire</td>
                                            <td> <input name="105" value="Pas concerné" type="radio" class="with-gap" id="radio120"></td>
                                            <td> <input name="105" value=Insatisfait" type="radio" class="with-gap" id="radio121"></td>
                                            <td> <input name="105" value="Peu satisfait" type="radio" class="with-gap" id="radio122"></td>
                                            <td> <input name="105" value="Satisfait" type="radio" class="with-gap" id="radio123"></td>
                                            <td> <input name="105" value="Très satisfait" type="radio" class="with-gap" id="radio124"></td>
                                          </tr>
                                          <tr>
                                            <td>Progression vocabulaire</td>
                                            <td> <input name="106" value="Pas concerné" type="radio" class="with-gap" id="radio125"></td>
                                            <td> <input name="106" value=Insatisfait" type="radio" class="with-gap" id="radio126"></td>
                                            <td> <input name="106" value="Peu satisfait" type="radio" class="with-gap" id="radio127"></td>
                                            <td> <input name="106" value="Satisfait" type="radio" class="with-gap" id="radio128"></td>
                                            <td> <input name="106" value="Très satisfait" type="radio" class="with-gap" id="radio129"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>3. La formation dispensée répond -elle globalement à vos attentes? </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Lien avec activité professionnelle</td>
                                            <td> <input name="1103" value="Pas concerné" type="radio" class="with-gap" id="radio110"></td>
                                            <td> <input name="1103" value=Insatisfait"  type="radio" class="with-gap" id="radio111"></td>
                                            <td> <input name="1103" value="Peu satisfait" type="radio" class="with-gap" id="radio112"></td>
                                            <td> <input name="1103" value="Satisfait" type="radio" class="with-gap" id="radio113"></td>
                                            <td> <input name="1103" value="Très satisfait" type="radio" class="with-gap" id="radio114"></td>
                                          </tr>
                                          <tr>
                                            <td>Planning</td>
                                            <td> <input name="1104" value="Pas concerné" type="radio" class="with-gap" id="radio115"></td>
                                            <td> <input name="1104" value=Insatisfait"  type="radio" class="with-gap" id="radio116"></td>
                                            <td> <input name="1104" value="Peu satisfait" type="radio" class="with-gap" id="radio117"></td>
                                            <td> <input name="1104" value="Satisfait" type="radio" class="with-gap" id="radio118"></td>
                                            <td> <input name="1104" value="Très satisfait" type="radio" class="with-gap" id="radio119"></td>
                                          </tr>
                                          <tr>
                                            <td>Rythme des cours</td>
                                            <td> <input name="1105" value="Pas concerné" type="radio" class="with-gap" id="radio120"></td>
                                            <td> <input name="1105" value=Insatisfait"  type="radio" class="with-gap" id="radio121"></td>
                                            <td> <input name="1105" value="Peu satisfait" type="radio" class="with-gap" id="radio122"></td>
                                            <td> <input name="1105" value="Satisfait" type="radio" class="with-gap" id="radio123"></td>
                                            <td> <input name="1105" value="Très satisfait" type="radio" class="with-gap" id="radio124"></td>
                                          </tr>
                                          <tr>
                                            <td>Structure</td>
                                            <td> <input name="1106" value="Pas concerné" type="radio" class="with-gap" id="radio125"></td>
                                            <td> <input name="1106" value=Insatisfait"  type="radio" class="with-gap" id="radio126"></td>
                                            <td> <input name="1106" value="Peu satisfait" type="radio" class="with-gap" id="radio127"></td>
                                            <td> <input name="1106" value="Satisfait" type="radio" class="with-gap" id="radio128"></td>
                                            <td> <input name="1106" value="Très satisfait" type="radio" class="with-gap" id="radio129"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>4. Etes-vous satisfait des conditions d'accueil lors de vos cours Face à Face à Forma2+? </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Equipements et matériels</td>
                                            <td> <input name="107" value="Pas concerné" type="radio" class="with-gap" id="radio130"></td>
                                            <td> <input name="107" value=Insatisfait"  type="radio" class="with-gap" id="radio131"></td>
                                            <td> <input name="107" value="Peu satisfait" type="radio" class="with-gap" id="radio132"></td>
                                            <td> <input name="107" value="Satisfait" type="radio" class="with-gap" id="radio133"></td>
                                            <td> <input name="107" value="Très satisfait" type="radio" class="with-gap" id="radio134"></td>
                                          </tr>
                                          <tr>
                                            <td>Locaux</td>
                                            <td> <input name="108" value="Pas concerné" type="radio" class="with-gap" id="radio135"></td>
                                            <td> <input name="108" value=Insatisfait"  type="radio" class="with-gap" id="radio136"></td>
                                            <td> <input name="108" value="Peu satisfait" type="radio" class="with-gap" id="radio137"></td>
                                            <td> <input name="108" value="Satisfait" type="radio" class="with-gap" id="radio138"></td>
                                            <td> <input name="108" value="Très satisfait" type="radio" class="with-gap" id="radio139"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>5. Etes-vous satisfait des méthodes pédagogiques interactives? </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Mises en situation et jeux de rôle</td>
                                            <td> <input name="109" value="Pas concerné" type="radio" class="with-gap" id="radio140"></td>
                                            <td> <input name="109" value=Insatisfait" type="radio" class="with-gap" id="radio141"></td>
                                            <td> <input name="109" value="Peu satisfait" type="radio" class="with-gap" id="radio142"></td>
                                            <td> <input name="109" value="Satisfait" type="radio" class="with-gap" id="radio143"></td>
                                            <td> <input name="109" value="Très satisfait" type="radio" class="with-gap" id="radio144"></td>
                                          </tr>
                                          <tr>
                                            <td>Variété et qualité des activités</td>
                                            <td> <input name="110" value="Pas concerné" type="radio" class="with-gap" id="radio145"></td>
                                            <td> <input name="110" value=Insatisfait" type="radio" class="with-gap" id="radio146"></td>
                                            <td> <input name="110" value="Peu satisfait" type="radio" class="with-gap" id="radio147"></td>
                                            <td> <input name="110" value="Satisfait" type="radio" class="with-gap" id="radio148"></td>
                                            <td> <input name="110" value="Très satisfait" type="radio" class="with-gap" id="radio149"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>6. Etes-vous satisfait des supports pédagogiques? </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Pertinence des termes du glossaire</td>
                                            <td> <input name="111" value="Pas concerné" type="radio" class="with-gap" id="radio150"></td>
                                            <td> <input name="111" value=Insatisfait" type="radio" class="with-gap" id="radio151"></td>
                                            <td> <input name="111" value="Peu satisfait" type="radio" class="with-gap" id="radio152"></td>
                                            <td> <input name="111" value="Satisfait" type="radio" class="with-gap" id="radio153"></td>
                                            <td> <input name="111" value="Très satisfait" type="radio" class="with-gap" id="radio154"></td>
                                          </tr>
                                          <tr>
                                            <td>Qualité du contenu (Livre et cahier d'exercices)</td>
                                            <td> <input name="112" value="Pas concerné" type="radio" class="with-gap" id="radio155"></td>
                                            <td> <input name="112" value=Insatisfait" type="radio" class="with-gap" id="radio156"></td>
                                            <td> <input name="112" value="Peu satisfait" type="radio" class="with-gap" id="radio157"></td>
                                            <td> <input name="112" value="Satisfait" type="radio" class="with-gap" id="radio158"></td>
                                            <td> <input name="112" value="Très satisfait" type="radio" class="with-gap" id="radio159"></td>
                                          </tr>
                                          <tr>
                                            <td>Audio/Vidéo</td>
                                            <td> <input name="113" value="Pas concerné" type="radio" class="with-gap" id="radio160"></td>
                                            <td> <input name="113" value=Insatisfait" type="radio" class="with-gap" id="radio161"></td>
                                            <td> <input name="113" value="Peu satisfait" type="radio" class="with-gap" id="radio162"></td>
                                            <td> <input name="113" value="Satisfait" type="radio" class="with-gap" id="radio163"></td>
                                            <td> <input name="113" value="Très satisfait" type="radio" class="with-gap" id="radio164"></td>
                                          </tr>
                                          <tr>
                                            <td>Plateforme E-learning</td>
                                            <td> <input name="114" value="Pas concerné" type="radio" class="with-gap" id="radio165"></td>
                                            <td> <input name="114" value=Insatisfait" type="radio" class="with-gap" id="radio166"></td>
                                            <td> <input name="114" value="Peu satisfait" type="radio" class="with-gap" id="radio167"></td>
                                            <td> <input name="114" value="Satisfait" type="radio" class="with-gap" id="radio168"></td>
                                            <td> <input name="114" value="Très satisfait" type="radio" class="with-gap" id="radio169"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>7. Etes-vous satisfait de votre accès personnalisé à notre serveur de cours en ligne ? </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Complémentarité avec les cours en Face à Face et par Télephone</td>
                                            <td> <input name="115" value="Pas concerné" type="radio" class="with-gap" id="radio170"></td>
                                            <td> <input name="115" value=Insatisfait" type="radio" class="with-gap" id="radio171"></td>
                                            <td> <input name="115" value="Peu satisfait" type="radio" class="with-gap" id="radio172"></td>
                                            <td> <input name="115" value="Satisfait" type="radio" class="with-gap" id="radio173"></td>
                                            <td> <input name="115" value="Très satisfait" type="radio" class="with-gap" id="radio174"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					    <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>8. Etes-vous satisfait de votre professeur en Face à Face?</strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Animation</td>
                                            <td> <input name="116" value="Pas concerné" type="radio" class="with-gap" id="radio175"></td>
                                            <td> <input name="116" value=Insatisfait" type="radio" class="with-gap" id="radio176"></td>
                                            <td> <input name="116" value="Peu satisfait" type="radio" class="with-gap" id="radio177"></td>
                                            <td> <input name="116" value="Satisfait" type="radio" class="with-gap" id="radio178"></td>
                                            <td> <input name="116" value="Très satisfait" type="radio" class="with-gap" id="radio179"></td>
                                          </tr>
                                          <tr>
                                            <td>Choix des exercices</td>
                                            <td> <input name="117" value="Pas concerné" type="radio" class="with-gap" id="radio180"></td>
                                            <td> <input name="117" value=Insatisfait" type="radio" class="with-gap" id="radio181"></td>
                                            <td> <input name="117" value="Peu satisfait" type="radio" class="with-gap" id="radio182"></td>
                                            <td> <input name="117" value="Satisfait" type="radio" class="with-gap" id="radio183"></td>
                                            <td> <input name="117" value="Très satisfait" type="radio" class="with-gap" id="radio184"></td>
                                          </tr>
                                          <tr>
                                            <td>Pédagogie</td>
                                            <td> <input name="118" value="Pas concerné" type="radio" class="with-gap" id="radio185"></td>
                                            <td> <input name="118" value=Insatisfait" type="radio" class="with-gap" id="radio186"></td>
                                            <td> <input name="118" value="Peu satisfait" type="radio" class="with-gap" id="radio187"></td>
                                            <td> <input name="118" value="Satisfait" type="radio" class="with-gap" id="radio188"></td>
                                            <td> <input name="118" value="Très satisfait" type="radio" class="with-gap" id="radio189"></td>
                                          </tr>
                                          <tr>
                                            <td>Ponctualité</td>
                                            <td> <input name="119" value="Pas concerné" type="radio" class="with-gap" id="radio190"></td>
                                            <td> <input name="119" value=Insatisfait" type="radio" class="with-gap" id="radio191"></td>
                                            <td> <input name="119" value="Peu satisfait" type="radio" class="with-gap" id="radio192"></td>
                                            <td> <input name="119" value="Satisfait" type="radio" class="with-gap" id="radio193"></td>
                                            <td> <input name="119" value="Très satisfait" type="radio" class="with-gap" id="radio194"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>9. Etes-vous satisfait de votre professeur par Téléphone?</strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Animation</td>
                                            <td> <input name="120" value="Pas concerné" type="radio" class="with-gap" id="radio195"></td>
                                            <td> <input name="120" value=Insatisfait" type="radio" class="with-gap" id="radio196"></td>
                                            <td> <input name="120" value="Peu satisfait" type="radio" class="with-gap" id="radio197"></td>
                                            <td> <input name="120" value="Satisfait" type="radio" class="with-gap" id="radio198"></td>
                                            <td> <input name="120" value="Très satisfait" type="radio" class="with-gap" id="radio199"></td>
                                          </tr>
                                          <tr>
                                            <td>Choix des exercices</td>
                                            <td> <input name="121" value="Pas concerné" type="radio" class="with-gap" id="radio200"></td>
                                            <td> <input name="121" value=Insatisfait" type="radio" class="with-gap" id="radio201"></td>
                                            <td> <input name="121" value="Peu satisfait" type="radio" class="with-gap" id="radio202"></td>
                                            <td> <input name="121" value="Satisfait" type="radio" class="with-gap" id="radio203"></td>
                                            <td> <input name="121" value="Très satisfait" type="radio" class="with-gap" id="radio204"></td>
                                          </tr>
                                          <tr>
                                            <td>Pédagogie</td>
                                            <td> <input name="122" value="Pas concerné" type="radio" class="with-gap" id="radio205"></td>
                                            <td> <input name="122" value=Insatisfait" type="radio" class="with-gap" id="radio206"></td>
                                            <td> <input name="122" value="Peu satisfait" type="radio" class="with-gap" id="radio207"></td>
                                            <td> <input name="122" value="Satisfait" type="radio" class="with-gap" id="radio208"></td>
                                            <td> <input name="122" value="Très satisfait" type="radio" class="with-gap" id="radio209"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>10. Etes-vous globalement satisfait de votre formation?</strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Globalement</td>
                                            <td> <input name="123" value="Pas concerné" type="radio" class="with-gap" id="radio210"></td>
                                            <td> <input name="123" value=Insatisfait" type="radio" class="with-gap" id="radio211"></td>
                                            <td> <input name="123" value="Peu satisfait" type="radio" class="with-gap" id="radio212"></td>
                                            <td> <input name="123" value="Satisfait" type="radio" class="with-gap" id="radio213"></td>
                                            <td> <input name="123" value="Très satisfait" type="radio" class="with-gap" id="radio214"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
					  
					  <div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>11. Vos suggestions, vos commentaires ou vos remarques éventuelles</strong></h4></div>
    					</div>
					  
					  <div class="form-group">
                          <label for="comment">Vos suggestions: </label>
                          <textarea class="form-control" rows="5" id="comment"></textarea>
                       </div>
                    </div>
                    <div class="alert alert-success">
 						 <h6><strong>Nous vous remercions d’avoir pris le temps de répondre à notre questionnaire. Vos réponses nous sont utiles pour améliorer notre service.</strong></h6> 
					</div>
                    <button type="button" class="btn btn-primary active center-block">Envoyer</button>
                    </form>
                </div>
            </section>
        </div>

