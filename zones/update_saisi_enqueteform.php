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



$url6 = "http://extranet.forma2plus.com:808/php/stagiaires/enquete.php?func=checkEnquetebyNumeros";
$data6 = "&numero=" . urlencode($compteur);
$urlEncode6 = $url6.$data6;

$response6 = \Httpful\Request::get($urlEncode6)->send();

$jsonResp6 = $response6->body;

if(isset($jsonResp6) && '200' == $jsonResp6->code) {
    
    if(($jsonResp6->data)==[]){
//         header('Location: enqueteInterne.php');
echo("");
        
    }else if(($jsonResp6->data)!=[]){
//         var_dump($jsonResp6->data);
        $q1c1r = $jsonResp6->data[0]->q1c1r;
        $q1c1r1= $jsonResp6->data[0]->q1c1r1;
        $q1c2r = $jsonResp6->data[0]->q1c2r;
        $q1c2r2 = $jsonResp6->data[0]->q1c2r2;
        $q2c1r = $jsonResp6->data[0]->q2c1r;
        $q2c1r1 = $jsonResp6->data[0]->q2c1r1;
        $q2c2r = $jsonResp6->data[0]->q2c2r;
        $q2c2r2 = $jsonResp6->data[0]->q2c2r2;
        $q2c3r = $jsonResp6->data[0]->q2c3r;
        $q2c3r3 = $jsonResp6->data[0]->q2c3r3;
        $q2c4r = $jsonResp6->data[0]->q2c4r;
        $q2c4r4 = $jsonResp6->data[0]->q2c4r4;
        $q3c1r = $jsonResp6->data[0]->q3c1r;
        $q3c1r1 = $jsonResp6->data[0]->q3c1r1;
        $q3c2r = $jsonResp6->data[0]->q3c2r;
        $q3c2r2 = $jsonResp6->data[0]->q3c2r2;
        $q3c3r = $jsonResp6->data[0]->q3c3r;
        $q3c3r3 = $jsonResp6->data[0]->q3c3r3;
        $q3c4r = $jsonResp6->data[0]->q3c4r;
        $q3c4r4 = $jsonResp6->data[0]->q3c4r4;
        $q4c1r = $jsonResp6->data[0]->q4c1r;
        $q4c1r1 = $jsonResp6->data[0]->q4c1r1;
        $q4c2r = $jsonResp6->data[0]->q4c2r;
        $q4c2r2 = $jsonResp6->data[0]->q4c2r2;
        $q5c1r = $jsonResp6->data[0]->q5c1r;
        $q5c1r1 = $jsonResp6->data[0]->q5c1r1;
        $q5c2r = $jsonResp6->data[0]->q5c2r;
        $q5c2r2 = $jsonResp6->data[0]->q5c2r2;
        $q6c1r = $jsonResp6->data[0]->q6c1r;
        $q6c1r1 = $jsonResp6->data[0]->q6c1r1;
        $q6c2r = $jsonResp6->data[0]->q6c2r;
        $q6c2r2 = $jsonResp6->data[0]->q6c2r2;
        $q6c3r = $jsonResp6->data[0]->q6c3r;
        $q6c3r3 = $jsonResp6->data[0]->q6c3r3;
        $q6c4r = $jsonResp6->data[0]->q6c4r;
        $q6c4r4 = $jsonResp6->data[0]->q6c4r4;
        $q7c1r = $jsonResp6->data[0]->q7c1r;
        $q7c1r1 = $jsonResp6->data[0]->q7c1r1;
        $q8c1r = $jsonResp6->data[0]->q8c1r;
        $q8c1r1 = $jsonResp6->data[0]->q8c1r1;
        $q8c2r = $jsonResp6->data[0]->q8c2r;
        $q8c2r2 = $jsonResp6->data[0]->q8c2r2;
        $q8c3r = $jsonResp6->data[0]->q8c3r;
        $q8c3r3 = $jsonResp6->data[0]->q8c3r3;
        $q8c4r = $jsonResp6->data[0]->q8c4r;
        $q8c4r4 = $jsonResp6->data[0]->q8c4r4;
        $q9c1r = $jsonResp6->data[0]->q9c1r;
        $q9c1r1 = $jsonResp6->data[0]->q9c1r1;
        $q9c2r = $jsonResp6->data[0]->q9c2r;
        $q9c2r2 = $jsonResp6->data[0]->q9c2r2;
        $q9c3r = $jsonResp6->data[0]->q9c3r;
        $q9c3r3 = $jsonResp6->data[0]->q9c3r3;
        $q10c1r = $jsonResp6->data[0]->q10c1r;
        $q10c1r1 = $jsonResp6->data[0]->q10c1r1;
        
        
    }else {
        echo("");
    }
    
}


$url7 = "http://extranet.forma2plus.com:808/php/stagiaires/enquete.php?func=checkEnquetesuggestionsbyNumero";
$data7 = "&numero=" . urlencode($compteur);
$urlEncode7 = $url7.$data7;

$response7 = \Httpful\Request::get($urlEncode7)->send();

$jsonResp7 = $response7->body;

if(isset($jsonResp7) && '200' == $jsonResp7->code) {
    
    if(($jsonResp7->data)==[]){
        //         header('Location: enqueteInterne.php');
        echo("");
        
    }else if(($jsonResp7->data)!=[]){
        $suggestions = $jsonResp7->data->suggestions;
    }else {
        echo("");
    }
    
}


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
                <form action="updatenquete.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
						<section>
                            <div class="col-md-6 col-md-offset-3">
                            <div class="panel panel-primary">
                          <div class="panel-heading text-center"><h4>LECTURE ET MISE A JOUR ENQUÊTE DE SATISFACTION </h4></div>
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
                                            <td> <input name="101" value="Pas concerné" type="radio" class="with-gap" id="radio100" <?php if($q1c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="101" value="Insatisfait" type="radio" class="with-gap" id="radio101" <?php if($q1c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="101" value="Peu satisfait" type="radio" class="with-gap" id="radio102"<?php if($q1c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="101" value="Satisfait" type="radio" class="with-gap" id="radio103" <?php if($q1c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="101" value="Très satisfait" type="radio" class="with-gap" id="radio104" <?php if($q1c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="101i"  type="texte" class="with-gap" id="radio104i" value="<?php if(isset($q1c1r1)) echo($q1c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q1c2);?></td>
                                            <td> <input name="102" value="Pas concerné" type="radio" class="with-gap" id="radio105" <?php if($q1c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="102" value="Insatisfait" type="radio" class="with-gap" id="radio106" <?php if($q1c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="102" value="Peu satisfait" type="radio" class="with-gap" id="radio107" <?php if($q1c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="102" value="Satisfait" type="radio" class="with-gap" id="radio108" <?php if($q1c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="102" value="Très satisfait" type="radio" class="with-gap" id="radio109" <?php if($q1c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="102i"  type="texte" class="with-gap" id="radio109i" value="<?php if(isset($q1c2r2)) echo($q1c2r2);?>"></td>
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
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q2c1);?></td>
                                            <td> <input name="103" value="Pas concerné" type="radio" class="with-gap" id="radio110" <?php if($q2c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="103" value="Insatisfait" type="radio" class="with-gap" id="radio111" <?php if($q2c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="103" value="Peu satisfait" type="radio" class="with-gap" id="radio112" <?php if($q2c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="103" value="Satisfait" type="radio" class="with-gap" id="radio113" <?php if($q2c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="103" value="Très satisfait" type="radio" class="with-gap" id="radio114" <?php if($q2c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="103i" type="texte" class="with-gap" id="radio114i" value="<?php if(isset($q2c1r1)) echo($q2c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q2c2);?></td>
                                            <td> <input name="104" value="Pas concerné" type="radio" class="with-gap" id="radio115" <?php if($q2c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="104" value="Insatisfait" type="radio" class="with-gap" id="radio116" <?php if($q2c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="104" value="Peu satisfait" type="radio" class="with-gap" id="radio117" <?php if($q2c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="104" value="Satisfait" type="radio" class="with-gap" id="radio118" <?php if($q2c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="104" value="Très satisfait" type="radio" class="with-gap" id="radio119" <?php if($q2c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="104i" type="texte" class="with-gap" id="radio119i" value="<?php if(isset($q2c2r2)) echo($q2c2r2);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q2c3);?></td>
                                            <td> <input name="105" value="Pas concerné" type="radio" class="with-gap" id="radio120" <?php if($q2c3r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="105" value="Insatisfait" type="radio" class="with-gap" id="radio121" <?php if($q2c3r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="105" value="Peu satisfait" type="radio" class="with-gap" id="radio122" <?php if($q2c3r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="105" value="Satisfait" type="radio" class="with-gap" id="radio123" <?php if($q2c3r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="105" value="Très satisfait" type="radio" class="with-gap" id="radio124" <?php if($q2c3r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="105i" type="texte" class="with-gap" id="radio124i" value="<?php if(isset($q2c2r3)) echo($q2c2r3);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q2c4);?></td>
                                            <td> <input name="106" value="Pas concerné" type="radio" class="with-gap" id="radio125" <?php if($q2c4r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="106" value="Insatisfait" type="radio" class="with-gap" id="radio126" <?php if($q2c4r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="106" value="Peu satisfait" type="radio" class="with-gap" id="radio127" <?php if($q2c4r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="106" value="Satisfait" type="radio" class="with-gap" id="radio128" <?php if($q2c4r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="106" value="Très satisfait" type="radio" class="with-gap" id="radio129" <?php if($q2c4r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="106i" type="texte" class="with-gap" id="radio129i" value="<?php if(isset($q2c2r4)) echo($q2c2r4);?>"></td>
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
                                            <th>Insatisfait</th>
                                            <th>Peu satisfait</th>
                                            <th>Satisfait</th>
                                            <th>Très satisfait</th>
                                            <th>Raison si insatisfait</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td><?php echo($q3c1);?></td>
                                            <td> <input name="1103" value="Pas concerné" type="radio" class="with-gap" id="radioq110" <?php if($q3c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="1103" value="Insatisfait"  type="radio" class="with-gap" id="radioq111" <?php if($q3c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1103" value="Peu satisfait" type="radio" class="with-gap" id="radioq112" <?php if($q3c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1103" value="Satisfait" type="radio" class="with-gap" id="radioq113" <?php if($q3c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1103" value="Très satisfait" type="radio" class="with-gap" id="radioq114" <?php if($q3c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1103i"  type="texte" class="with-gap" id="radioq114i" value="<?php if(isset($q3c1r1)) echo($q3c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q3c2);?></td>
                                            <td> <input name="1104" value="Pas concerné" type="radio" class="with-gap" id="radioq115" <?php if($q3c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="1104" value="Insatisfait"  type="radio" class="with-gap" id="radioq116" <?php if($q3c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1104" value="Peu satisfait" type="radio" class="with-gap" id="radioq117" <?php if($q3c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1104" value="Satisfait" type="radio" class="with-gap" id="radioq118" <?php if($q3c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1104" value="Très satisfait" type="radio" class="with-gap" id="radioq119" <?php if($q3c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1104i"  type="texte" class="with-gap" id="radioq119i" value="<?php if(isset($q3c2r2)) echo($q3c2r2);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q3c3);?></td>
                                            <td> <input name="1105" value="Pas concerné" type="radio" class="with-gap" id="radioq120" <?php if($q3c3r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="1105" value="Insatisfait"  type="radio" class="with-gap" id="radioq121" <?php if($q3c3r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1105" value="Peu satisfait" type="radio" class="with-gap" id="radioq122" <?php if($q3c3r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1105" value="Satisfait" type="radio" class="with-gap" id="radioq123" <?php if($q3c3r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1105" value="Très satisfait" type="radio" class="with-gap" id="radioq124" <?php if($q3c3r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1105i"  type="texte" class="with-gap" id="radioq124i" value="<?php if(isset($q3c3r3)) echo($q3c3r3);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q3c4);?></td>
                                            <td> <input name="1106" value="Pas concerné" type="radio" class="with-gap" id="radioq125" <?php if($q3c4r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="1106" value="Insatisfait"  type="radio" class="with-gap" id="radioq126" <?php if($q3c4r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1106" value="Peu satisfait" type="radio" class="with-gap" id="radioq127" <?php if($q3c4r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1106" value="Satisfait" type="radio" class="with-gap" id="radioq128" <?php if($q3c4r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1106" value="Très satisfait" type="radio" class="with-gap" id="radioq129" <?php if($q3c4r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="1106i"  type="texte" class="with-gap" id="radioq129i" value="<?php if(isset($q3c4r4)) echo($q3c4r4);?>"></td>
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
                                            <td> <input name="107" value="Pas concerné" type="radio" class="with-gap" id="radio130" <?php if($q4c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="107" value="Insatisfait"  type="radio" class="with-gap" id="radio131" <?php if($q4c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="107" value="Peu satisfait" type="radio" class="with-gap" id="radio132" <?php if($q4c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="107" value="Satisfait" type="radio" class="with-gap" id="radio133" <?php if($q4c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="107" value="Très satisfait" type="radio" class="with-gap" id="radio134" <?php if($q4c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="107i"  type="texte" class="with-gap" id="radio134i" value="<?php if(isset($q4c1r1)) echo($q4c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q4c2);?></td>
                                            <td> <input name="108" value="Pas concerné" type="radio" class="with-gap" id="radio135" <?php if($q4c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="108" value="Insatisfait"  type="radio" class="with-gap" id="radio136" <?php if($q4c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="108" value="Peu satisfait" type="radio" class="with-gap" id="radio137" <?php if($q4c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="108" value="Satisfait" type="radio" class="with-gap" id="radio138" <?php if($q4c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="108" value="Très satisfait" type="radio" class="with-gap" id="radio139" <?php if($q4c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="108i"  type="texte" class="with-gap" id="radio139i" value="<?php if(isset($q4c2r2)) echo($q4c2r2);?>"></td>
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
                                            <td> <input name="109" value="Pas concerné" type="radio" class="with-gap" id="radio140" <?php if($q5c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="109" value="Insatisfait" type="radio" class="with-gap" id="radio141" <?php if($q5c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="109" value="Peu satisfait" type="radio" class="with-gap" id="radio142" <?php if($q5c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="109" value="Satisfait" type="radio" class="with-gap" id="radio143" <?php if($q5c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="109" value="Très satisfait" type="radio" class="with-gap" id="radio144" <?php if($q5c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="109i"  type="texte" class="with-gap" id="radio144i" value="<?php if(isset($q5c1r1)) echo($q5c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q5c2);?></td>
                                            <td> <input name="110" value="Pas concerné" type="radio" class="with-gap" id="radio145" <?php if($q5c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="110" value="Insatisfait" type="radio" class="with-gap" id="radio146" <?php if($q5c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="110" value="Peu satisfait" type="radio" class="with-gap" id="radio147" <?php if($q5c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="110" value="Satisfait" type="radio" class="with-gap" id="radio148" <?php if($q5c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="110" value="Très satisfait" type="radio" class="with-gap" id="radio149" <?php if($q5c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="110i"  type="texte" class="with-gap" id="radio149i" value="<?php if(isset($q5c2r2)) echo($q4c2r2);?>"></td>
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
                                            <td> <input name="111" value="Pas concerné" type="radio" class="with-gap" id="radio150" <?php if($q6c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="111" value="Insatisfait" type="radio" class="with-gap" id="radio151" <?php if($q6c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="111" value="Peu satisfait" type="radio" class="with-gap" id="radio152" <?php if($q6c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="111" value="Satisfait" type="radio" class="with-gap" id="radio153" <?php if($q6c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="111" value="Très satisfait" type="radio" class="with-gap" id="radio154" <?php if($q6c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="111i" type="texte" class="with-gap" id="radio154i" value="<?php if(isset($q6c1r1)) echo($q6c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q6c2);?></td>
                                            <td> <input name="112" value="Pas concerné" type="radio" class="with-gap" id="radio155" <?php if($q6c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="112" value="Insatisfait" type="radio" class="with-gap" id="radio156" <?php if($q6c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="112" value="Peu satisfait" type="radio" class="with-gap" id="radio157" <?php if($q6c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="112" value="Satisfait" type="radio" class="with-gap" id="radio158" <?php if($q6c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="112" value="Très satisfait" type="radio" class="with-gap" id="radio159" <?php if($q6c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="112i" type="texte" class="with-gap" id="radio159i" value="<?php if(isset($q6c2r2)) echo($q6c2r2);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q6c3);?></td>
                                            <td> <input name="113" value="Pas concerné" type="radio" class="with-gap" id="radio160" <?php if($q6c3r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="113" value="Insatisfait" type="radio" class="with-gap" id="radio161" <?php if($q6c3r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="113" value="Peu satisfait" type="radio" class="with-gap" id="radio162" <?php if($q6c3r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="113" value="Satisfait" type="radio" class="with-gap" id="radio163" <?php if($q6c3r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="113" value="Très satisfait" type="radio" class="with-gap" id="radio164" <?php if($q6c3r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="113i"  type="texte" class="with-gap" id="radio164i" value="<?php if(isset($q6c3r3)) echo($q6c3r3);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q6c4);?></td>
                                            <td> <input name="114" value="Pas concerné" type="radio" class="with-gap" id="radio165" <?php if($q6c4r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="114" value="Insatisfait" type="radio" class="with-gap" id="radio166" <?php if($q6c4r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="114" value="Peu satisfait" type="radio" class="with-gap" id="radio167" <?php if($q6c4r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="114" value="Satisfait" type="radio" class="with-gap" id="radio168" <?php if($q6c4r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="114" value="Très satisfait" type="radio" class="with-gap" id="radio169" <?php if($q6c4r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="114i"  type="texte" class="with-gap" id="radio169i" value="<?php if(isset($q6c4r4)) echo($q6c4r4);?>"></td>
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
                                            <td> <input name="115" value="Pas concerné" type="radio" class="with-gap" id="radio170" <?php if($q7c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="115" value="Insatisfait" type="radio" class="with-gap" id="radio171" <?php if($q7c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="115" value="Peu satisfait" type="radio" class="with-gap" id="radio172" <?php if($q7c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="115" value="Satisfait" type="radio" class="with-gap" id="radio173" <?php if($q7c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="115" value="Très satisfait" type="radio" class="with-gap" id="radio174" <?php if($q7c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="115i" type="texte" class="with-gap" id="radio174i" value="<?php if(isset($q7c1r1)) echo($q7c1r1);?>"></td>
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
                                            <td> <input name="116" value="Pas concerné" type="radio" class="with-gap" id="radio175" <?php if($q8c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="116" value="Insatisfait" type="radio" class="with-gap" id="radio176" <?php if($q8c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="116" value="Peu satisfait" type="radio" class="with-gap" id="radio177" <?php if($q8c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="116" value="Satisfait" type="radio" class="with-gap" id="radio178" <?php if($q8c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="116" value="Très satisfait" type="radio" class="with-gap" id="radio179" <?php if($q8c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="116i"  type="texte" class="with-gap" id="radio179i" value="<?php if(isset($q8c1r1)) echo($q7c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q8c2);?></td>
                                            <td> <input name="117" value="Pas concerné" type="radio" class="with-gap" id="radio180" <?php if($q8c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="117" value="Insatisfait" type="radio" class="with-gap" id="radio181" <?php if($q8c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="117" value="Peu satisfait" type="radio" class="with-gap" id="radio182" <?php if($q8c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="117" value="Satisfait" type="radio" class="with-gap" id="radio183" <?php if($q8c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="117" value="Très satisfait" type="radio" class="with-gap" id="radio184" <?php if($q8c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="117i"  type="texte" class="with-gap" id="radio184i" value="<?php if(isset($q8c2r2)) echo($q8c2r2);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q8c3);?></td>
                                            <td> <input name="118" value="Pas concerné" type="radio" class="with-gap" id="radio185" <?php if($q8c3r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="118" value="Insatisfait" type="radio" class="with-gap" id="radio186" <?php if($q8c3r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="118" value="Peu satisfait" type="radio" class="with-gap" id="radio187" <?php if($q8c3r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="118" value="Satisfait" type="radio" class="with-gap" id="radio188" <?php if($q8c3r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="118" value="Très satisfait" type="radio" class="with-gap" id="radio189" <?php if($q8c3r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="118i"  type="texte" class="with-gap" id="radio189i" value="<?php if(isset($q8c3r3)) echo($q8c3r3);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q8c4);?></td>
                                            <td> <input name="119" value="Pas concerné" type="radio" class="with-gap" id="radio190" <?php if($q8c4r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="119" value="Insatisfait" type="radio" class="with-gap" id="radio191" <?php if($q8c4r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="119" value="Peu satisfait" type="radio" class="with-gap" id="radio192" <?php if($q8c4r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="119" value="Satisfait" type="radio" class="with-gap" id="radio193" <?php if($q8c4r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="119" value="Très satisfait" type="radio" class="with-gap" id="radio194" <?php if($q8c4r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="119i"  type="texte" class="with-gap" id="radio194i" value="<?php if(isset($q8c4r4)) echo($q8c4r4);?>"></td>
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
                                            <td> <input name="120" value="Pas concerné" type="radio" class="with-gap" id="radio195" <?php if($q9c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="120" value="Insatisfait" type="radio" class="with-gap" id="radio196" <?php if($q9c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="120" value="Peu satisfait" type="radio" class="with-gap" id="radio197" <?php if($q9c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="120" value="Satisfait" type="radio" class="with-gap" id="radio198" <?php if($q9c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="120" value="Très satisfait" type="radio" class="with-gap" id="radio199" <?php if($q9c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="120i"  type="texte" class="with-gap" id="radio199i" value="<?php if(isset($q9c1r1)) echo($q9c1r1);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q9c2);?></td>
                                            <td> <input name="121" value="Pas concerné" type="radio" class="with-gap" id="radio200" <?php if($q9c2r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="121" value="Insatisfait" type="radio" class="with-gap" id="radio201" <?php if($q9c2r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="121" value="Peu satisfait" type="radio" class="with-gap" id="radio202" <?php if($q9c2r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="121" value="Satisfait" type="radio" class="with-gap" id="radio203" <?php if($q9c2r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="121" value="Très satisfait" type="radio" class="with-gap" id="radio204" <?php if($q9c2r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="121i"  type="texte" class="with-gap" id="radio204i" value="<?php if(isset($q9c2r2)) echo($q9c2r2);?>"></td>
                                          </tr>
                                          <tr>
                                            <td><?php echo($q9c3);?></td>
                                            <td> <input name="122" value="Pas concerné" type="radio" class="with-gap" id="radio205" <?php if($q9c3r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="122" value="Insatisfait" type="radio" class="with-gap" id="radio206" <?php if($q9c3r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="122" value="Peu satisfait" type="radio" class="with-gap" id="radio207" <?php if($q9c3r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="122" value="Satisfait" type="radio" class="with-gap" id="radio208" <?php if($q9c3r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="122" value="Très satisfait" type="radio" class="with-gap" id="radio209" <?php if($q9c3r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="122i"  type="texte" class="with-gap" id="radio209i" value="<?php if(isset($q9c3r3)) echo($q9c3r3);?>"></td>
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
                                            <td> <input name="123" value="Pas concerné" type="radio" class="with-gap" id="radio210" <?php if($q10c1r == " Pas concerné"){ echo("checked");}?>></td>
                                            <td> <input name="123" value="Insatisfait" type="radio" class="with-gap" id="radio211" <?php if($q10c1r == " Insatisfait"){ echo("checked");}?>></td>
                                            <td> <input name="123" value="Peu satisfait" type="radio" class="with-gap" id="radio212" <?php if($q10c1r == " Peu satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="123" value="Satisfait" type="radio" class="with-gap" id="radio213" <?php if($q10c1r == " Satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="123" value="Très satisfait" type="radio" class="with-gap" id="radio214" <?php if($q10c1r == " Très satisfait"){ echo("checked");}?>></td>
                                            <td> <input name="123i" type="texte" class="with-gap" id="radio214i" value="<?php if(isset($q10c1r1)) echo($q10c1r1);?>"></td>
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
                          <textarea class="form-control" rows="5" name="comment"><?php echo($suggestions)?></textarea>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-primary active center-block">Mettre à jour</button>
                    </form>
                </div>
            </section>
        </div>
        
        

