<?php 
session_start ();
include('httpful.phar');


$client_iCivilite        = $_POST["civilite"];
$client_iSociete        = $_POST["societe"];
$client_zNom       = $_POST["nom"];
$client_zPrenom      = $_POST["prenom"];
$client_zMail     = $_POST["mail"];
$client_zTel     = $_POST["telephone"];
$client_zfonc     = $_POST["fonction"];
$client_zdepart     = $_POST["departement"];
$client_zportable     = $_POST["portable"];
$client_zrue     = $_POST["RueDuStage"];
$client_zville     = $_POST["VilleDuStage"];
$client_zcp     = $_POST["CPDuStage"];
$client_horairesouhait     = $_POST["horaisouhait"];
$client_tempperso     = $_POST["Tempsperso"];
$client_tempprof     = $_POST["Tempsprof"];
$client_abs     = $_POST["Absprevues"];
$client_elearning     = $_POST["e_learning"];
$client_internetpro     = $_POST["Internet_pro"];
$client_internetperso     = $_POST["Internet_perso"];
if(isset($_POST["jsouhait1"])){
$client_joursouhait1 = $_POST["jsouhait1"];
$client_joursouhait = $client_joursouhait1;
}
if(isset($_POST["jsouhait2"])){
$client_joursouhait2 = $_POST["jsouhait2"];
$client_joursouhait .= ' '.$client_joursouhait2;
}
if(isset($_POST["jsouhait3"])){
$client_joursouhait3 = $_POST["jsouhait3"];
$client_joursouhait .= ' '.$client_joursouhait3;
}
if(isset($_POST["jsouhait4"])){
$client_joursouhait4 = $_POST["jsouhait4"];
$client_joursouhait .= ' '.$client_joursouhait4;
}
if(isset($_POST["jsouhait5"])){
$client_joursouhait5 = $_POST["jsouhait5"];
$client_joursouhait .= ' '.$client_joursouhait5;
}
if(isset($_POST["jsouhait6"])){
$client_joursouhait6 = $_POST["jsouhait6"];
$client_joursouhait .= ' '.$client_joursouhait6;
}
if(isset($_POST["jsouhait7"])){
$client_joursouhait7 = $_POST["jsouhait7"];
$client_joursouhait .= ' '.$client_joursouhait7;
}



$client_niveausco = $_POST["x_niveausco"];
$client_nbansbac = $_POST["x_nbansbac"];
$client_languemat = $_POST["x_languemat"];
$client_premlang = $_POST["x_premlang"];
$client_formatAnt = $_POST["x_formatAnt"];
$client_paysAnglo = $_POST["x_paysAnglo"];
$client_LangGen = $_POST["x_LangGen"];
$client_LangPro = $_POST["x_LangPro"];
$client_NationInterloc = $_POST["x_NationInterloc"];
$client_FonctInterloc = $_POST["x_FonctInterloc"];

if(isset($_POST["y_1"])){
$client_AttentesGramm = $_POST["y_1"];
}else{$client_AttentesGramm = 0;}
if(isset($_POST["y_2"])){
$client_AttentesCompreh = $_POST["y_2"];
}else{$client_AttentesCompreh = 0;}
if(isset($_POST["y_3"])){
$client_AttentesVocab = $_POST["y_3"];
}else{$client_AttentesVocab = 0;}
if(isset($_POST["y_4"])){
$client_ConfrOral = $_POST["y_4"];
}else{$client_ConfrOral = 0;}
if(isset($_POST["y_5"])){
$client_ConfrLecture = $_POST["y_5"];
}else{$client_ConfrLecture = 0;}
if(isset($_POST["y_6"])){
$client_ConfrCorrespond = $_POST["y_6"];
}else{$client_ConfrCorrespond = 0;}
if(isset($_POST["y_7"])){
$client_ConfrRedact = $_POST["y_7"];
}else{$client_ConfrRedact = 0;}
if(isset($_POST["y_8"])){
$client_ConfrTel = $_POST["y_8"];
}else{$client_ConfrTel = 0;}
if(isset($_POST["y_9"])){
$client_ConfrReunion = $_POST["y_9"];
}else{$client_ConfrReunion = 0;}
if(isset($_POST["y_10"])){
$client_ConfrNegoc = $_POST["y_10"];
}else{$client_ConfrNegoc = 0;}
if(isset($_POST["y_11"])){
$client_ConfrPresent= $_POST["y_11"];
}else{$client_ConfrPresent = 0;}
if(isset($_POST["y_12"])){
$client_ConfrDeplace = $_POST["y_12"];
}else{$client_ConfrDeplace = 0;}
if(isset($_POST["y_13"])){
$client_ConfrAccueilVisite= $_POST["y_13"];
}else{$client_ConfrAccueilVisite = 0;}
if(isset($_POST["x_AttentesSpec"])){
$client_AttentesSpec= $_POST["x_AttentesSpec"];
}
if(isset($_POST["x_BesoinsSpecif"])){
$client_BesoinsSpecif= $_POST["x_BesoinsSpecif"];
}

if(isset($_POST["x_1"])){
$client_x_1= $_POST["x_1"];
}else{$client_x_1 = 0;}
if(isset($_POST["x_2"])){
$client_x_2= $_POST["x_2"];
}else{$client_x_2 = 0;}
if(isset($_POST["x_3"])){
$client_x_3= $_POST["x_3"];
}else{$client_x_3 = 0;}
if(isset($_POST["x_4"])){
$client_x_4= $_POST["x_4"];
}else{$client_x_4= 0;}
if(isset($_POST["x_5"])){
$client_x_5= $_POST["x_5"];
}else{$client_x_5 = 0;}
if(isset($_POST["x_6"])){
$client_x_6= $_POST["x_6"];
}else{$client_x_6 = 0;}
if(isset($_POST["x_7"])){
$client_x_7= $_POST["x_7"];
}else{$client_x_7 = 0;}
if(isset($_POST["x_8"])){
$client_x_8= $_POST["x_8"];
}else{$client_x_8 = 0;}
if(isset($_POST["x_9"])){
$client_x_9= $_POST["x_9"];
}else{$client_x_9 = 0;}
if(isset($_POST["x_10"])){
$client_x_10= $_POST["x_10"];
}else{$client_x_10 = 0;}
if(isset($_POST["x_lectured"])){
$client_lectured= $_POST["x_lectured"];
}if(isset($_POST["x_artsd"])){
$client_artsd= $_POST["x_artsd"];
}if(isset($_POST["x_sportd"])){
$client_sportd= $_POST["x_sportd"];
}if(isset($_POST["x_cuisined"])){
$client_cuisined= $_POST["x_cuisined"];
}if(isset($_POST["x_jardind"])){
$client_jardind= $_POST["x_jardind"];
}if(isset($_POST["x_sciencesd"])){
$client_sciencesd= $_POST["x_sciencesd"];
}if(isset($_POST["x_musiqued"])){
$client_musiqued= $_POST["x_musiqued"];
}if(isset($_POST["x_litteratured"])){
$client_litteratured= $_POST["x_litteratured"];
}if(isset($_POST["x_theatred"])){
$client_theatred= $_POST["x_theatred"];
}if(isset($_POST["x_bricolaged"])){
$client_bricolaged= $_POST["x_bricolaged"];
}if(isset($_POST["x_autres_interets"])){
$client_autres_interets= $_POST["x_autres_interets"];
}if(isset($_POST["x_journal_text"])){
$client_journal_text= $_POST["x_journal_text"];
}


$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=update2";

$datemodif = date('Y-m-d H:i:s');

if(!isset($_POST["numerodossier"])){
    header('Location: index.php');
}else{
    
    
    $_SESSION['numero'] = $_POST["numerodossier"] ;
//     $client_numero  = $_POST["numerodossier"] ;
    
    
    $data = "&numero=" . urlencode($_SESSION['numero']);
    $data .= "&nom=" . urlencode($client_zNom);
    $data .= "&prenom=" . urlencode($client_zPrenom);
    $data .= "&societe=" . urlencode($client_iSociete);
    $data .= "&Telephone=" . urlencode($client_zTel);
    $data .= "&mail=" . urlencode($client_zMail) ;
    $data .= "&datedermodif=" . urlencode($datemodif) ;
    $data .= "&fonction=" . urlencode($client_zfonc) ;
    $data .= "&Departement=" . urlencode($client_zdepart) ;
    $data .= "&Portable=" . urlencode($client_zportable) ;
    $data .= "&RueDuStage=" . urlencode($client_zrue) ;
    $data .= "&VilleDuStage=" . urlencode($client_zville) ;
    $data .= "&CPDuStage=" . urlencode($client_zcp) ;
    $data .= "&horaisouhait=" . urlencode($client_horairesouhait) ;
    $data .= "&tempsperso=" . urlencode($client_tempperso) ;
    $data .= "&tempsprof=" . urlencode($client_tempprof) ;
    $data .= "&nbabscprevue=" . urlencode($client_abs) ;
    $data .= "&e_learning=" . urlencode($client_elearning) ;
    $data .= "&accesnetperso=" . urlencode($client_internetperso) ;
    $data .= "&accesnetpro=" . urlencode($client_internetpro) ;
    $data .= "&joursouhait=" . urlencode($client_joursouhait) ;
    
    
    $url2 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getByProfil";
    $data2 = "&numero=" . urlencode($_SESSION['numero']);
    $urlEncode2 = $url2.$data2;
    $response2 = \Httpful\Request::get($urlEncode2)->send();
    $jsonResp2 = $response2->body;
    
    if(isset($jsonResp2) && '200' == $jsonResp2->code){
        if(($jsonResp2->data)==[]){
            $url3 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=insertProfil";
            $datemodif = date('Y-m-d H:i:s');
            $data3 = "&numero=" . urlencode($_SESSION['numero']);
            $data3 .= "&niveausco=" . urlencode($client_niveausco);
            $data3 .= "&nbansbac=" . urlencode($client_nbansbac);
            $data3 .= "&languemat=" . urlencode($client_languemat);
            $data3 .= "&premlang=" . urlencode($client_premlang);
            $data3 .= "&formatAnt=" . urlencode($client_formatAnt);
            $data3 .= "&paysanglo=" . urlencode($client_paysAnglo);
            $data3 .= "&LangGen=" . urlencode($client_LangGen);
            $data3 .= "&LangPro=" . urlencode($client_LangPro);
            $data3 .= "&NationInterloc=" . urlencode($client_NationInterloc);
            $data3 .= "&FonctInterloc=" . urlencode($client_FonctInterloc);
            $data3 .= "&AttentesGramm=" . urlencode($client_AttentesGramm);
            $data3 .= "&AttentesCompreh=" . urlencode($client_AttentesCompreh);
            $data3 .= "&AttentesVocab=" . urlencode($client_AttentesVocab);
            $data3 .= "&ConfrOral=" . urlencode($client_ConfrOral);
            $data3 .= "&ConfrLecture=" . urlencode($client_ConfrLecture);
            $data3 .= "&ConfrCorrespond=" . urlencode($client_ConfrCorrespond);
            $data3 .= "&ConfrRedact=" . urlencode($client_ConfrRedact);
            $data3 .= "&ConfrTel=" . urlencode($client_ConfrTel);
            $data3 .= "&ConfrReunion=" . urlencode($client_ConfrReunion);
            $data3 .= "&ConfrNegoc=" . urlencode($client_ConfrNegoc);
            $data3 .= "&ConfrPresent=" . urlencode($client_ConfrPresent);
            $data3 .= "&ConfrDeplace=" . urlencode($client_ConfrDeplace);
            $data3 .= "&ConfrAccueilVisite=" . urlencode($client_ConfrAccueilVisite);
            $data3 .= "&AttentesSpec=" . urlencode($client_AttentesSpec);
            $data3 .= "&BesoinsSpecif=" . urlencode($client_BesoinsSpecif);
            $data3 .= "&lecture1=" . urlencode($client_x_1);
            $data3 .= "&arts=" . urlencode($client_x_2);
            $data3 .= "&sport=" . urlencode($client_x_3);
            $data3 .= "&cuisine=" . urlencode($client_x_4);
            $data3 .= "&jardin=" . urlencode($client_x_5);
            $data3 .= "&sciences=" . urlencode($client_x_6);
            $data3 .= "&musique=" . urlencode($client_x_7);
            $data3 .= "&litterature=" . urlencode($client_x_8);
            $data3 .= "&theatre=" . urlencode($client_x_9);
            $data3 .= "&bricolage=" . urlencode($client_x_10);
            $data3 .= "&lecture_text=" . urlencode($client_lectured);
            $data3 .= "&arts_text=" . urlencode($client_artsd);
            $data3 .= "&sport_text=" . urlencode($client_sportd);
            $data3 .= "&cuisine_text=" . urlencode($client_cuisined);
            $data3 .= "&jardin_text=" . urlencode($client_jardind);
            $data3 .= "&sciences_text=" . urlencode($client_sciencesd);
            $data3 .= "&musique_text=" . urlencode($client_musiqued);
            $data3 .= "&litterature_text=" . urlencode($client_litteratured);
            $data3 .= "&theatre_text=" . urlencode($client_theatred);
            $data3 .= "&bricolage_text=" . urlencode($client_bricolaged);
            $data3 .= "&autres_interets=" . urlencode($client_autres_interets);
            $data3 .= "&journal_text=" . urlencode($client_journal_text);
            $data3 .= "&DateDerModif=" . urlencode($datemodif);
            
            $urlEncode3 = $url3.$data3;
            $response3 = \Httpful\Request::get($urlEncode3)->send();
            $jsonResp3 = $response3->body;
            
        }if(($jsonResp2->data)!=[]){
            $url3 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=updateToProfil";
            $datemodif = date('Y-m-d H:i:s');
            $data3 = "&numero=" . urlencode($_SESSION['numero']);
            $data3 .= "&niveausco=" . urlencode($client_niveausco);
            $data3 .= "&nbansbac=" . urlencode($client_nbansbac);
            $data3 .= "&languemat=" . urlencode($client_languemat);
            $data3 .= "&premlang=" . urlencode($client_premlang);
            $data3 .= "&formatAnt=" . urlencode($client_formatAnt);
            $data3 .= "&paysanglo=" . urlencode($client_paysAnglo);
            $data3 .= "&LangGen=" . urlencode($client_LangGen);
            $data3 .= "&LangPro=" . urlencode($client_LangPro);
            $data3 .= "&NationInterloc=" . urlencode($client_NationInterloc);
            $data3 .= "&FonctInterloc=" . urlencode($client_FonctInterloc);
            $data3 .= "&AttentesGramm=" . urlencode($client_AttentesGramm);
            $data3 .= "&AttentesCompreh=" . urlencode($client_AttentesCompreh);
            $data3 .= "&AttentesVocab=" . urlencode($client_AttentesVocab);
            $data3 .= "&ConfrOral=" . urlencode($client_ConfrOral);
            $data3 .= "&ConfrLecture=" . urlencode($client_ConfrLecture);
            $data3 .= "&ConfrCorrespond=" . urlencode($client_ConfrCorrespond);
            $data3 .= "&ConfrRedact=" . urlencode($client_ConfrRedact);
            $data3 .= "&ConfrTel=" . urlencode($client_ConfrTel);
            $data3 .= "&ConfrReunion=" . urlencode($client_ConfrReunion);
            $data3 .= "&ConfrNegoc=" . urlencode($client_ConfrNegoc);
            $data3 .= "&ConfrPresent=" . urlencode($client_ConfrPresent);
            $data3 .= "&ConfrDeplace=" . urlencode($client_ConfrDeplace);
            $data3 .= "&ConfrAccueilVisite=" . urlencode($client_ConfrAccueilVisite);
            $data3 .= "&AttentesSpec=" . urlencode($client_AttentesSpec);
            $data3 .= "&BesoinsSpecif=" . urlencode($client_BesoinsSpecif);
            $data3 .= "&lecture1=" . urlencode($client_x_1);
            $data3 .= "&arts=" . urlencode($client_x_2);
            $data3 .= "&sport=" . urlencode($client_x_3);
            $data3 .= "&cuisine=" . urlencode($client_x_4);
            $data3 .= "&jardin=" . urlencode($client_x_5);
            $data3 .= "&sciences=" . urlencode($client_x_6);
            $data3 .= "&musique=" . urlencode($client_x_7);
            $data3 .= "&litterature=" . urlencode($client_x_8);
            $data3 .= "&theatre=" . urlencode($client_x_9);
            $data3 .= "&bricolage=" . urlencode($client_x_10);
            $data3 .= "&lecture_text=" . urlencode($client_lectured);
            $data3 .= "&arts_text=" . urlencode($client_artsd);
            $data3 .= "&sport_text=" . urlencode($client_sportd);
            $data3 .= "&cuisine_text=" . urlencode($client_cuisined);
            $data3 .= "&jardin_text=" . urlencode($client_jardind);
            $data3 .= "&sciences_text=" . urlencode($client_sciencesd);
            $data3 .= "&musique_text=" . urlencode($client_musiqued);
            $data3 .= "&litterature_text=" . urlencode($client_litteratured);
            $data3 .= "&theatre_text=" . urlencode($client_theatred);
            $data3 .= "&bricolage_text=" . urlencode($client_bricolaged);
            $data3 .= "&autres_interets=" . urlencode($client_autres_interets);
            $data3 .= "&journal_text=" . urlencode($client_journal_text);
            $data3 .= "&DateDerModif=" . urlencode($datemodif);
            
            $urlEncode3 = $url3.$data3;
            $response3 = \Httpful\Request::get($urlEncode3)->send();
            $jsonResp3 = $response3->body;
        }
    }
    
    
    $urlEncode = $url.$data;
    
    $response = \Httpful\Request::get($urlEncode)->send();
    $jsonResp = $response->body;
    
    
    
    if(isset($jsonResp) && '200' == $jsonResp->code){
        $_SESSION['numerodossier'] = $_SESSION['numero'];
        $_SESSION['civiliteStagiaire'] = $client_iCivilite;
        $_SESSION['nomStagiaire'] = $client_zNom;
        $_SESSION['prenomStagiaire'] = $client_zPrenom;
        header('Location: updatesuccess.php');
        
    } 
    else {
        header('Location: updatefailed.php');
    }
    
}


?>