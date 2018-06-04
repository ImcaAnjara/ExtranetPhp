<?php 
session_start();

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

$url2 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getPeriode";
$data2 = "&refcommande=" . urlencode($numstage);
$urlEncode2 = $url2.$data2;

$response2 = \Httpful\Request::get($urlEncode2)->send();

$jsonResp2 = $response2->body;

if(isset($jsonResp2) && '200' == $jsonResp2->code) {
    
    if(($jsonResp2->data)==[]){
        header('Location: index.php');
        
    }else if(($jsonResp2->data)!=[]){
        $deb = $jsonResp2->data[0]->DateDébutS;
        $fin = $jsonResp2->data[0]->DateFinS;
    }else {
        header('Location: index.php');
    }
}

$datedebut = trim($deb, " 00:00:00");
$datefin = trim($fin, " 00:00:00");
$db = new DateTime($datedebut);
$datedebut = $db->format('d/m/Y');
$df = new DateTime($datefin);
$datefin = $df->format('d/m/Y');
$periode = "Du ".$datedebut. " Au ".$datefin;

$url3 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getNameProfFAF";
$data3 = "&codestage=" . urlencode($numstage);
$urlEncode3 = $url3.$data3;

$response3 = \Httpful\Request::get($urlEncode3)->send();

$jsonResp3 = $response3->body;

if(isset($jsonResp3) && '200' == $jsonResp3->code) {
    
    if(($jsonResp3->data)==[]){
        $civ = "";
        $nom = "";
        $prenom = "";
        
    }else if(($jsonResp3->data)!=[]){
        $civ = $jsonResp3->data[0]->Civilité;
        $nom = $jsonResp3->data[0]->NomFamille;
        $prenom = $jsonResp3->data[0]->Prénom;
    }else {
        $civ = "";
        $nom = "";
        $prenom = "";
    }
}

$proffaf= $civ." ".$nom." ".$prenom;

$url4 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getNameProfTUT";
$data4 = "&codestage=" . urlencode($numstage);
$urlEncode4 = $url4.$data4;

$response4 = \Httpful\Request::get($urlEncode4)->send();

$jsonResp4 = $response4->body;

if(isset($jsonResp4) && '200' == $jsonResp4->code) {
    
    if(($jsonResp4->data)==[]){
        $civ1 = "";
        $nom1 = "";
        $prenom1 = "";
        
    }else if(($jsonResp4->data)!=[]){
        $civ1 = $jsonResp4->data[0]->Civilité;
        $nom1 = $jsonResp4->data[0]->NomFamille;
        $prenom1 = $jsonResp4->data[0]->Prénom;
    }else {
        $civ1 = "";
        $nom1 = "";
        $prenom1 = "";
    }
}

$proftut= $civ1." ".$nom1." ".$prenom1;

$url5 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getNameProfTEL";
$data5 = "&codestage=" . urlencode($numstage);
$urlEncode5 = $url5.$data5;

$response5 = \Httpful\Request::get($urlEncode5)->send();

$jsonResp5 = $response5->body;

if(isset($jsonResp5) && '200' == $jsonResp5->code) {
    
    if(($jsonResp5->data)==[]){
        $civ2 = "";
        $nom2 = "";
        $prenom2 = "";
        
    }else if(($jsonResp5->data)!=[]){
        $civ2 = $jsonResp5->data[0]->Civilité;
        $nom2 = $jsonResp5->data[0]->NomFamille;
        $prenom2 = $jsonResp5->data[0]->Prénom;
    }else {
        $civ2 = "";
        $nom2 = "";
        $prenom2 = "";
    }
}

$proftel= $civ2." ".$nom2." ".$prenom2;


$_SESSION['compteur']= $compteur;
$q1="Etes-vous satisfait des informations transmises préalablement à votre formation?";
$q1c1= "Organisation du stage";
$q1c2= "Consignes administratives";
$q2= "La formation vous a-t-elle permis d'atteindre les objectifs fixés?";
$q2c1= "Expression écrite";
$q2c2= "Expression orale";
$q2c3= "Progression grammaire";
$q2c4= "Progression vocabulaire";
$q3="La formation dispensée répond -elle globalement à vos attentes? ";
$q3c1= "Lien avec activité professionnelle";
$q3c2= "Planning";
$q3c3= "Rythme des cours";
$q3c4= "Structure";
$q4="Etes-vous satisfait des conditions d'accueil lors de vos cours Face à Face à Forma2+ ? ";
$q4c1= "Equipements et matériels";
$q4c2= "Locaux";
$q5="Etes-vous satisfait des méthodes pédagogiques interactives? ";
$q5c1= "Mises en situation et jeux de rôle";
$q5c2= "Variété et qualité des activités";
$q6= "Etes-vous satisfait des supports pédagogiques? ";
$q6c1= "Pertinence des termes du glossaire";
$q6c2= "Qualité du contenu (Livre et cahier d'exercices)";
$q6c3= "Audio/Vidéo";
$q6c4= "Plateforme E-learning";
$q7= "Etes-vous satisfait de votre accès personnalisé à notre serveur de cours en ligne ?";
$q7c1= "Complémentarité avec les cours en Face à Face et par Télephone";
$q8= "Etes-vous satisfait de votre professeur en Face à Face? ";
$q8c1= "Animation";
$q8c2= "Choix des exercices";
$q8c3= "Pédagogie";
$q8c4= "Ponctualité";
$q9 = "Etes-vous satisfait de votre professeur par Téléphone? ";
$q9c1= "Animation";
$q9c2= "Choix des exercices";
$q9c3= "Pédagogie";
$q10 = "Etes-vous globalement satisfait de votre formation?";
$q10c1= "Globalement";

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
                <form action="insertenquete.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
						<section>
                            <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4>ENQUÊTE DE SATISFACTION </h4></div>
    					</div>
                            
                            </div>
                        </section>
                        
                        <section class="content-section bg-light" id="about">
                              <div class="container text-left">
                                <div class="row">
                                	<div class="col-sm-4">
                                	  <label style="font-size: 16px;color:#337ab7;">Nom : </label> <label style="font-size: 16px;"><?php echo($coord);?></label><br>
                                      <label style="font-size: 16px;color:#337ab7;">Société : </label> <label style="font-size: 16px;"><?php echo($societe);?></label><br>
								      <label style="font-size: 16px;color:#337ab7;">Date : </label> <label style="font-size: 16px;"><?php  echo(date("d/m/Y"));?></label><br>
								    </div>
								    <div class="col-sm-4">
								    	<label style="font-size: 16px;color:#337ab7;">Intitulé de la formation : </label> <label style="font-size: 16px;"><?php echo($formation);?></label><br>
								    	<label style="font-size: 16px;color:#337ab7;">N° stage : </label> <label style="font-size: 16px;"><?php echo($numstage);?></label><br>
                                		<label style="font-size: 16px;color:#337ab7;">Module : </label> <label style="font-size: 16px;"><?php echo($module);?></label><br>
								    </div>
                                	<div class="col-sm-4">
                                		  
                                		  <label style="font-size: 16px;color:#337ab7;">Prof FAF :</label> <label style="font-size: 16px;"><?php echo($proffaf);?></label><br>
                                          <label style="font-size: 16px;color:#337ab7;">Prof TEL :</label> <label style="font-size: 16px;"><?php echo($proftut." ".$proftel);?></label><br>
                                          <label style="font-size: 16px;color:#337ab7;">Période : </label> <label style="font-size: 16px;"><?php echo($periode);?></label><br>
                                          
								    </div>
                                </div>
                              </div>
    					</section>
    					<br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>1. <?php echo($q1);?></strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q1c1);?></td>
                                            <td> <input name="101" value="Pas concerné" type="radio" class="with-gap" id="radio100"></td>
                                            <td> <input name="101" value="Insatisfait" type="radio" class="with-gap" id="radio101" ></td>
                                            <td> <input name="101" value="Peu satisfait" type="radio" class="with-gap" id="radio102"></td>
                                            <td> <input name="101" value="Satisfait" type="radio" class="with-gap" id="radio103"></td>
                                            <td> <input name="101" value="Très satisfait" type="radio" class="with-gap" id="radio104"></td>
<!--                                             <td> <input name="101i"  type="texte" class="with-gap" id="radio104i"></td> -->
                                            <td> <input name="101i" type="texte" class="with-gap" id="radio104i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q1c2);?></td>
                                            <td> <input name="102" value="Pas concerné" type="radio" class="with-gap" id="radio105"></td>
                                            <td> <input name="102" value="Insatisfait" type="radio" class="with-gap" id="radio106"></td>
                                            <td> <input name="102" value="Peu satisfait" type="radio" class="with-gap" id="radio107"></td>
                                            <td> <input name="102" value="Satisfait" type="radio" class="with-gap" id="radio108"></td>
                                            <td> <input name="102" value="Très satisfait" type="radio" class="with-gap" id="radio109"></td>
<!--                                             <td> <input name="102i"  type="texte" class="with-gap" id="radio109i"></td> -->
                                            <td> <input name="102i" type="texte" class="with-gap" id="radio109i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>2. <?php echo($q2);?> </strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Pas du tout</th>
                                            <th>En partie</th>
                                            <th>Oui</th>
                                            <th>Tout à fait</th>
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q2c1);?></td>
                                            <td> <input name="103" value="Pas concerné" type="radio" class="with-gap" id="radio110"></td>
                                            <td> <input name="103" value="Insatisfait" type="radio" class="with-gap" id="radio111"></td>
                                            <td> <input name="103" value="Peu satisfait" type="radio" class="with-gap" id="radio112"></td>
                                            <td> <input name="103" value="Satisfait" type="radio" class="with-gap" id="radio113"></td>
                                            <td> <input name="103" value="Très satisfait" type="radio" class="with-gap" id="radio114"></td>
<!--                                             <td> <input name="103i" type="texte" class="with-gap" id="radio114i"></td> -->
											<td> <input name="103i" type="texte" class="with-gap" id="radio114i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q2c2);?></td>
                                            <td> <input name="104" value="Pas concerné" type="radio" class="with-gap" id="radio115"></td>
                                            <td> <input name="104" value="Insatisfait" type="radio" class="with-gap" id="radio116"></td>
                                            <td> <input name="104" value="Peu satisfait" type="radio" class="with-gap" id="radio117"></td>
                                            <td> <input name="104" value="Satisfait" type="radio" class="with-gap" id="radio118"></td>
                                            <td> <input name="104" value="Très satisfait" type="radio" class="with-gap" id="radio119"></td>
<!--                                             <td> <input name="104i" type="texte" class="with-gap" id="radio119i"></td> -->
                                            <td> <input name="104i" type="texte" class="with-gap" id="radio119i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q2c3);?></td>
                                            <td> <input name="105" value="Pas concerné" type="radio" class="with-gap" id="radio120"></td>
                                            <td> <input name="105" value="Insatisfait" type="radio" class="with-gap" id="radio121"></td>
                                            <td> <input name="105" value="Peu satisfait" type="radio" class="with-gap" id="radio122"></td>
                                            <td> <input name="105" value="Satisfait" type="radio" class="with-gap" id="radio123"></td>
                                            <td> <input name="105" value="Très satisfait" type="radio" class="with-gap" id="radio124"></td>
<!--                                             <td> <input name="105i" type="texte" class="with-gap" id="radio124i"></td> -->
                                            <td> <input name="105i" type="texte" class="with-gap" id="radio124i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q2c4);?></td>
                                            <td> <input name="106" value="Pas concerné" type="radio" class="with-gap" id="radio125"></td>
                                            <td> <input name="106" value="Insatisfait" type="radio" class="with-gap" id="radio126"></td>
                                            <td> <input name="106" value="Peu satisfait" type="radio" class="with-gap" id="radio127"></td>
                                            <td> <input name="106" value="Satisfait" type="radio" class="with-gap" id="radio128"></td>
                                            <td> <input name="106" value="Très satisfait" type="radio" class="with-gap" id="radio129"></td>
<!--                                             <td> <input name="106i" type="texte" class="with-gap" id="radio129i"></td> -->
                                            <td> <input name="106i" type="texte" class="with-gap" id="radio129i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>3. <?php echo($q3);?></strong></h4></div>
    					</div>
                      <div class="row">
                          <div class="col-sm-12">
                          	<div class="table-responsive">
                                 <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th>Critères</th>
                                            <th>Pas concerné</th>
                                            <th>Pas du tout</th>
                                            <th>En partie</th>
                                            <th>Oui</th>
                                            <th>Tout à fait</th>
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q3c1);?></td>
                                            <td> <input name="1103" value="Pas concerné" type="radio" class="with-gap" id="radioq110"></td>
                                            <td> <input name="1103" value="Insatisfait"  type="radio" class="with-gap" id="radioq111"></td>
                                            <td> <input name="1103" value="Peu satisfait" type="radio" class="with-gap" id="radioq112"></td>
                                            <td> <input name="1103" value="Satisfait" type="radio" class="with-gap" id="radioq113"></td>
                                            <td> <input name="1103" value="Très satisfait" type="radio" class="with-gap" id="radioq114"></td>
<!--                                             <td> <input name="1103i"  type="texte" class="with-gap" id="radioq114i"></td> -->
                                            <td> <input name="1103i" type="texte" class="with-gap" id="radioq114i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q3c2);?></td>
                                            <td> <input name="1104" value="Pas concerné" type="radio" class="with-gap" id="radioq115"></td>
                                            <td> <input name="1104" value="Insatisfait"  type="radio" class="with-gap" id="radioq116"></td>
                                            <td> <input name="1104" value="Peu satisfait" type="radio" class="with-gap" id="radioq117"></td>
                                            <td> <input name="1104" value="Satisfait" type="radio" class="with-gap" id="radioq118"></td>
                                            <td> <input name="1104" value="Très satisfait" type="radio" class="with-gap" id="radioq119"></td>
<!--                                             <td> <input name="1104i"  type="texte" class="with-gap" id="radioq119i"></td> -->
                                            <td> <input name="1104i" type="texte" class="with-gap" id="radioq119i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q3c3);?></td>
                                            <td> <input name="1105" value="Pas concerné" type="radio" class="with-gap" id="radioq120"></td>
                                            <td> <input name="1105" value="Insatisfait"  type="radio" class="with-gap" id="radioq121"></td>
                                            <td> <input name="1105" value="Peu satisfait" type="radio" class="with-gap" id="radioq122"></td>
                                            <td> <input name="1105" value="Satisfait" type="radio" class="with-gap" id="radioq123"></td>
                                            <td> <input name="1105" value="Très satisfait" type="radio" class="with-gap" id="radioq124"></td>
<!--                                             <td> <input name="1105i"  type="texte" class="with-gap" id="radioq124i"></td> -->
                                            <td> <input name="1105i" type="texte" class="with-gap" id="radioq124i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q3c4);?></td>
                                            <td> <input name="1106" value="Pas concerné" type="radio" class="with-gap" id="radioq125"></td>
                                            <td> <input name="1106" value="Insatisfait"  type="radio" class="with-gap" id="radioq126"></td>
                                            <td> <input name="1106" value="Peu satisfait" type="radio" class="with-gap" id="radioq127"></td>
                                            <td> <input name="1106" value="Satisfait" type="radio" class="with-gap" id="radioq128"></td>
                                            <td> <input name="1106" value="Très satisfait" type="radio" class="with-gap" id="radioq129"></td>
<!--                                             <td> <input name="1106i"  type="texte" class="with-gap" id="radioq129i"></td> -->
                                            <td> <input name="1106i" type="texte" class="with-gap" id="radioq129i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>4. <?php echo($q4);?> </strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q4c1);?></td>
                                            <td> <input name="107" value="Pas concerné" type="radio" class="with-gap" id="radio130"></td>
                                            <td> <input name="107" value="Insatisfait"  type="radio" class="with-gap" id="radio131"></td>
                                            <td> <input name="107" value="Peu satisfait" type="radio" class="with-gap" id="radio132"></td>
                                            <td> <input name="107" value="Satisfait" type="radio" class="with-gap" id="radio133"></td>
                                            <td> <input name="107" value="Très satisfait" type="radio" class="with-gap" id="radio134"></td>
<!--                                             <td> <input name="107i"  type="texte" class="with-gap" id="radio134i"></td> -->
                                            <td> <input name="107i" type="texte" class="with-gap" id="radio134i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q4c2);?></td>
                                            <td> <input name="108" value="Pas concerné" type="radio" class="with-gap" id="radio135"></td>
                                            <td> <input name="108" value="Insatisfait"  type="radio" class="with-gap" id="radio136"></td>
                                            <td> <input name="108" value="Peu satisfait" type="radio" class="with-gap" id="radio137"></td>
                                            <td> <input name="108" value="Satisfait" type="radio" class="with-gap" id="radio138"></td>
                                            <td> <input name="108" value="Très satisfait" type="radio" class="with-gap" id="radio139"></td>
<!--                                             <td> <input name="108i"  type="texte" class="with-gap" id="radio139i"></td> -->
                                            <td> <input name="108i" type="texte" class="with-gap" id="radio139i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>5. <?php echo($q5);?> </strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q5c1);?></td>
                                            <td> <input name="109" value="Pas concerné" type="radio" class="with-gap" id="radio140"></td>
                                            <td> <input name="109" value="Insatisfait" type="radio" class="with-gap" id="radio141"></td>
                                            <td> <input name="109" value="Peu satisfait" type="radio" class="with-gap" id="radio142"></td>
                                            <td> <input name="109" value="Satisfait" type="radio" class="with-gap" id="radio143"></td>
                                            <td> <input name="109" value="Très satisfait" type="radio" class="with-gap" id="radio144"></td>
<!--                                             <td> <input name="109i"  type="texte" class="with-gap" id="radio144i"></td> -->
                                            <td> <input name="109i" type="texte" class="with-gap" id="radio144i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q5c2);?></td>
                                            <td> <input name="110" value="Pas concerné" type="radio" class="with-gap" id="radio145"></td>
                                            <td> <input name="110" value="Insatisfait" type="radio" class="with-gap" id="radio146"></td>
                                            <td> <input name="110" value="Peu satisfait" type="radio" class="with-gap" id="radio147"></td>
                                            <td> <input name="110" value="Satisfait" type="radio" class="with-gap" id="radio148"></td>
                                            <td> <input name="110" value="Très satisfait" type="radio" class="with-gap" id="radio149"></td>
<!--                                             <td> <input name="110i"  type="texte" class="with-gap" id="radio149i"></td> -->
                                            <td> <input name="110i" type="texte" class="with-gap" id="radio149i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>6. <?php echo($q6);?> </strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q6c1);?></td>
                                            <td> <input name="111" value="Pas concerné" type="radio" class="with-gap" id="radio150"></td>
                                            <td> <input name="111" value="Insatisfait" type="radio" class="with-gap" id="radio151"></td>
                                            <td> <input name="111" value="Peu satisfait" type="radio" class="with-gap" id="radio152"></td>
                                            <td> <input name="111" value="Satisfait" type="radio" class="with-gap" id="radio153"></td>
                                            <td> <input name="111" value="Très satisfait" type="radio" class="with-gap" id="radio154"></td>
                                            <td> <input name="111i" type="texte" class="with-gap" id="radio154i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q6c2);?></td>
                                            <td> <input name="112" value="Pas concerné" type="radio" class="with-gap" id="radio155"></td>
                                            <td> <input name="112" value="Insatisfait" type="radio" class="with-gap" id="radio156"></td>
                                            <td> <input name="112" value="Peu satisfait" type="radio" class="with-gap" id="radio157"></td>
                                            <td> <input name="112" value="Satisfait" type="radio" class="with-gap" id="radio158"></td>
                                            <td> <input name="112" value="Très satisfait" type="radio" class="with-gap" id="radio159"></td>
                                            <td> <input name="112i" type="texte" class="with-gap" id="radio159i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q6c3);?></td>
                                            <td> <input name="113" value="Pas concerné" type="radio" class="with-gap" id="radio160"></td>
                                            <td> <input name="113" value="Insatisfait" type="radio" class="with-gap" id="radio161"></td>
                                            <td> <input name="113" value="Peu satisfait" type="radio" class="with-gap" id="radio162"></td>
                                            <td> <input name="113" value="Satisfait" type="radio" class="with-gap" id="radio163"></td>
                                            <td> <input name="113" value="Très satisfait" type="radio" class="with-gap" id="radio164"></td>
                                            <td> <input name="113i"  type="texte" class="with-gap" id="radio164i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q6c4);?></td>
                                            <td> <input name="114" value="Pas concerné" type="radio" class="with-gap" id="radio165"></td>
                                            <td> <input name="114" value="Insatisfait" type="radio" class="with-gap" id="radio166"></td>
                                            <td> <input name="114" value="Peu satisfait" type="radio" class="with-gap" id="radio167"></td>
                                            <td> <input name="114" value="Satisfait" type="radio" class="with-gap" id="radio168"></td>
                                            <td> <input name="114" value="Très satisfait" type="radio" class="with-gap" id="radio169"></td>
                                            <td> <input name="114i"  type="texte" class="with-gap" id="radio169i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>7. <?php echo($q7);?> </strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q7c1);?></td>
                                            <td> <input name="115" value="Pas concerné" type="radio" class="with-gap" id="radio170"></td>
                                            <td> <input name="115" value="Insatisfait" type="radio" class="with-gap" id="radio171"></td>
                                            <td> <input name="115" value="Peu satisfait" type="radio" class="with-gap" id="radio172"></td>
                                            <td> <input name="115" value="Satisfait" type="radio" class="with-gap" id="radio173"></td>
                                            <td> <input name="115" value="Très satisfait" type="radio" class="with-gap" id="radio174"></td>
                                            <td> <input name="115i" type="texte" class="with-gap" id="radio174i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					    <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>8. <?php echo($q8);?></strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q8c1);?></td>
                                            <td> <input name="116" value="Pas concerné" type="radio" class="with-gap" id="radio175"></td>
                                            <td> <input name="116" value="Insatisfait" type="radio" class="with-gap" id="radio176"></td>
                                            <td> <input name="116" value="Peu satisfait" type="radio" class="with-gap" id="radio177"></td>
                                            <td> <input name="116" value="Satisfait" type="radio" class="with-gap" id="radio178"></td>
                                            <td> <input name="116" value="Très satisfait" type="radio" class="with-gap" id="radio179"></td>
                                            <td> <input name="116i"  type="texte" class="with-gap" id="radio179i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q8c2);?></td>
                                            <td> <input name="117" value="Pas concerné" type="radio" class="with-gap" id="radio180"></td>
                                            <td> <input name="117" value="Insatisfait" type="radio" class="with-gap" id="radio181"></td>
                                            <td> <input name="117" value="Peu satisfait" type="radio" class="with-gap" id="radio182"></td>
                                            <td> <input name="117" value="Satisfait" type="radio" class="with-gap" id="radio183"></td>
                                            <td> <input name="117" value="Très satisfait" type="radio" class="with-gap" id="radio184"></td>
                                            <td> <input name="117i"  type="texte" class="with-gap" id="radio184i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q8c3);?></td>
                                            <td> <input name="118" value="Pas concerné" type="radio" class="with-gap" id="radio185"></td>
                                            <td> <input name="118" value="Insatisfait" type="radio" class="with-gap" id="radio186"></td>
                                            <td> <input name="118" value="Peu satisfait" type="radio" class="with-gap" id="radio187"></td>
                                            <td> <input name="118" value="Satisfait" type="radio" class="with-gap" id="radio188"></td>
                                            <td> <input name="118" value="Très satisfait" type="radio" class="with-gap" id="radio189"></td>
                                            <td> <input name="118i"  type="texte" class="with-gap" id="radio189i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q8c4);?></td>
                                            <td> <input name="119" value="Pas concerné" type="radio" class="with-gap" id="radio190"></td>
                                            <td> <input name="119" value="Insatisfait" type="radio" class="with-gap" id="radio191"></td>
                                            <td> <input name="119" value="Peu satisfait" type="radio" class="with-gap" id="radio192"></td>
                                            <td> <input name="119" value="Satisfait" type="radio" class="with-gap" id="radio193"></td>
                                            <td> <input name="119" value="Très satisfait" type="radio" class="with-gap" id="radio194"></td>
                                            <td> <input name="119i"  type="texte" class="with-gap" id="radio194i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>9. <?php echo($q9);?></strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q9c1);?></td>
                                            <td> <input name="120" value="Pas concerné" type="radio" class="with-gap" id="radio195"></td>
                                            <td> <input name="120" value="Insatisfait" type="radio" class="with-gap" id="radio196"></td>
                                            <td> <input name="120" value="Peu satisfait" type="radio" class="with-gap" id="radio197"></td>
                                            <td> <input name="120" value="Satisfait" type="radio" class="with-gap" id="radio198"></td>
                                            <td> <input name="120" value="Très satisfait" type="radio" class="with-gap" id="radio199"></td>
                                            <td> <input name="120i"  type="texte" class="with-gap" id="radio199i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q9c2);?></td>
                                            <td> <input name="121" value="Pas concerné" type="radio" class="with-gap" id="radio200"></td>
                                            <td> <input name="121" value="Insatisfait" type="radio" class="with-gap" id="radio201"></td>
                                            <td> <input name="121" value="Peu satisfait" type="radio" class="with-gap" id="radio202"></td>
                                            <td> <input name="121" value="Satisfait" type="radio" class="with-gap" id="radio203"></td>
                                            <td> <input name="121" value="Très satisfait" type="radio" class="with-gap" id="radio204"></td>
                                            <td> <input name="121i"  type="texte" class="with-gap" id="radio204i"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q9c3);?></td>
                                            <td> <input name="122" value="Pas concerné" type="radio" class="with-gap" id="radio205"></td>
                                            <td> <input name="122" value="Insatisfait" type="radio" class="with-gap" id="radio206"></td>
                                            <td> <input name="122" value="Peu satisfait" type="radio" class="with-gap" id="radio207"></td>
                                            <td> <input name="122" value="Satisfait" type="radio" class="with-gap" id="radio208"></td>
                                            <td> <input name="122" value="Très satisfait" type="radio" class="with-gap" id="radio209"></td>
                                            <td> <input name="122i"  type="texte" class="with-gap" id="radio209i"></td>
                                          </tr>
                                        </tbody>
                                      </table>
                         	 </div>
                          </div>
					  </div>
					  
					  <br>
    					<div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4><strong>10. <?php echo($q10);?></strong></h4></div>
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
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q10c1);?></td>
                                            <td> <input name="123" value="Pas concerné" type="radio" class="with-gap" id="radio210"></td>
                                            <td> <input name="123" value="Insatisfait" type="radio" class="with-gap" id="radio211"></td>
                                            <td> <input name="123" value="Peu satisfait" type="radio" class="with-gap" id="radio212"></td>
                                            <td> <input name="123" value="Satisfait" type="radio" class="with-gap" id="radio213"></td>
                                            <td> <input name="123" value="Très satisfait" type="radio" class="with-gap" id="radio214"></td>
                                            <td> <input name="123i" type="texte" class="with-gap" id="radio214i"></td>
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
                          <textarea class="form-control" rows="5" name="comment" id="comment"></textarea>
                       </div>
                    </div>
                    <div class="alert alert-success">
 						 <h6><strong>Nous vous remercions d’avoir pris le temps de répondre à notre questionnaire. Vos réponses nous sont utiles pour améliorer notre service.</strong></h6> 
					</div>
                    <button type="submit" class="btn btn-primary active center-block">Envoyer</button>
                    </form>
                </div>
            </section>
        </div>
        
        

