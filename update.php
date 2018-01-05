<?php 
session_start ();
include('httpful.phar');

//$_SESSION['numero'] = $client_Numero;


$numero = $_GET["numerodossier"];



$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getBynumero";
$url2 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getByProfil";
$url3 = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=getByProfilSpec";

$data = "&numero=" . urlencode($numero);
$data2 = "&numero=" . urlencode($numero);
$data3 = "&numero=" . urlencode($numero);

$urlEncode = $url.$data;
$urlEncode2 = $url2.$data2;
$urlEncode3 = $url3.$data3;

$response = \Httpful\Request::get($urlEncode)->send();
$jsonResp = $response->body;

$response2 = \Httpful\Request::get($urlEncode2)->send();
$jsonResp2 = $response2->body;


$response3 = \Httpful\Request::get($urlEncode3)->send();
$jsonResp3 = $response3->body;

if(isset($jsonResp) && '200' == $jsonResp->code) {
    
    if(($jsonResp->data)==[]){
        header('Location: index.php');
        
    }else if(($jsonResp->data)!=[]){
        $client_Numero = $jsonResp->data[0]->numero;
        $client_Nom = $jsonResp->data[0]->nom;
        $client_Prenom = $jsonResp->data[0]->prenom;
        $client_Mail = $jsonResp->data[0]->mail;
        $client_Societe = $jsonResp->data[0]->societe;
        $client_Civilite = $jsonResp->data[0]->Civilite;
        $client_telephone = $jsonResp->data[0]->Telephone;
        $client_fonction = $jsonResp->data[0]->fonction;
        $client_portable = $jsonResp->data[0]->Portable;
        $client_rue = $jsonResp->data[0]->RueDuStage;
        $client_ville = $jsonResp->data[0]->VilleDuStage;
        $client_cp = $jsonResp->data[0]->CPDuStage;
        $client_departement = $jsonResp->data[0]->Departement;
        $client_horaisouhait = $jsonResp->data[0]->horaisouhait;
        $client_tempsperso = $jsonResp->data[0]->tempsperso;
        $client_tempsprof = $jsonResp->data[0]->tempsprof;
        $client_nbabscprevue = $jsonResp->data[0]->nbabscprevue;
        $client_elearning = $jsonResp->data[0]->e_learning;
        $client_inetrnetpro = $jsonResp->data[0]->accesnetpro;
        $client_inetrnetperso = $jsonResp->data[0]->accesnetperso;
        $client_joursouhait = $jsonResp->data[0]->joursouhait;
        
        
        $_SESSION['numeroStagiaire']= $client_Numero;
        $_SESSION['nomStagiaire']= $client_Nom;
        $_SESSION['prenomStagiaire']= $client_Prenom;
        $_SESSION['mailStagiaire']= $client_Mail;
        $_SESSION['societeStagiaire']= $client_Societe;
        $_SESSION['civiliteStagiaire']= $client_Civilite;
        $_SESSION['telephoneStagiaire']= $client_telephone;
        $_SESSION['fonctionStagiaire']= $client_fonction;
        $_SESSION['portableStagiaire']= $client_portable;
        $_SESSION['rueStagiaire']= $client_rue;
        $_SESSION['villeStagiaire']= $client_ville;
        $_SESSION['cpStagiaire']= $client_cp;
        $_SESSION['departementStagiaire']= $client_departement;
        $_SESSION['horaireStagiaire']= $client_horaisouhait;
        $_SESSION['tempspersoStagiaire']= $client_tempsperso;
        $_SESSION['tempsproStagiaire']= $client_tempsprof;
        $_SESSION['abscStagiaire']= $client_nbabscprevue;
        $_SESSION['elarnStagiaire']= $client_elearning;
        $_SESSION['internetproStagiaire']= $client_inetrnetpro;
        $_SESSION['internetpersoStagiaire']= $client_inetrnetperso;
        $_SESSION['client_joursouhait']= $client_joursouhait;
        
        
        if(($jsonResp2->data)!=[]){
        $client_niveausco = $jsonResp2->data[0]->niveausco;
        $client_nbansbac = $jsonResp2->data[0]->nbansbac;
        $client_languemat = $jsonResp2->data[0]->languemat;
        $client_premlang = $jsonResp2->data[0]->premlang;
        $client_formatAnt = $jsonResp2->data[0]->formatAnt;
        $client_paysanglo = $jsonResp2->data[0]->paysanglo;
        $client_LangGen = $jsonResp2->data[0]->LangGen;
        $client_LangPro = $jsonResp2->data[0]->LangPro;
        $client_NationInterloc = $jsonResp2->data[0]->NationInterloc;
        $client_FonctInterloc = $jsonResp2->data[0]->FonctInterloc;
        $client_AttentesGramm = $jsonResp2->data[0]->AttentesGramm;
        $client_AttentesCompreh = $jsonResp2->data[0]->AttentesCompreh;
        $client_AttentesVocab = $jsonResp2->data[0]->AttentesVocab;
        $client_AttentesSpec = $jsonResp3->data->AttentesSpec;
        $client_ConfrAccueilVisite = $jsonResp2->data[0]->ConfrAccueilVisite;
        $client_ConfrTel = $jsonResp2->data[0]->ConfrTel;
        $client_ConfrReunion = $jsonResp2->data[0]->ConfrReunion;
        $client_ConfrCorrespond = $jsonResp2->data[0]->ConfrCorrespond;
        $client_ConfrLecture = $jsonResp2->data[0]->ConfrLecture;
        $client_ConfrOral = $jsonResp2->data[0]->ConfrOral;
        $client_ConfrRedact = $jsonResp2->data[0]->ConfrRedact;
        $client_ConfrDeplace = $jsonResp2->data[0]->ConfrDeplace;
        $client_ConfrPresent = $jsonResp2->data[0]->ConfrPresent;
        $client_ConfrNegoc = $jsonResp2->data[0]->ConfrNegoc;
        $client_BesoinsSpecif = $jsonResp3->data->BesoinsSpecif;
        $client_ObjStage = $jsonResp2->data[0]->ObjStage;
        $client_sport = $jsonResp2->data[0]->sport;
        $client_jardin = $jsonResp2->data[0]->jardin;
        $client_musique = $jsonResp2->data[0]->musique;
        $client_theatre = $jsonResp2->data[0]->theatre;
        $client_arts = $jsonResp2->data[0]->arts;
        $client_sciences = $jsonResp2->data[0]->sciences;
        $client_litterature = $jsonResp2->data[0]->litterature;
        $client_bricolage = $jsonResp2->data[0]->bricolage;
        $client_cuisine= $jsonResp2->data[0]->cuisine;
        $client_autres_interets = $jsonResp2->data[0]->autres_interets;
        $client_Lecture = $jsonResp2->data[0]->lecture1;
        $client_lecture_text = $jsonResp2->data[0]->lecture_text;
        $client_sport_text = $jsonResp2->data[0]->sport_text;
        $client_jardin_text = $jsonResp2->data[0]->jardin_text;
        $client_musique_text = $jsonResp2->data[0]->musique_text;
        $client_theatre_text = $jsonResp2->data[0]->theatre_text;
        $client_arts_text = $jsonResp2->data[0]->arts_text;
        $client_sciences_text = $jsonResp2->data[0]->sciences_text;
        $client_litterature_text = $jsonResp2->data[0]->litterature_text;
        $client_bricolage_text = $jsonResp2->data[0]->bricolage_text;
        $client_cuisine_text = $jsonResp2->data[0]->cuisine_text;
        $client_journal_text = $jsonResp2->data[0]->journal_text;
        
        $_SESSION['niveausco']=$client_niveausco;
        $_SESSION['nbansbac']=$client_nbansbac ;
        $_SESSION['premlang']=$client_premlang ;
        $_SESSION['languemat']=$client_languemat;
        $_SESSION['formatAnt']=$client_formatAnt;
        $_SESSION['paysanglo']=$client_paysanglo;
        $_SESSION['LangGen']=$client_LangGen;
        $_SESSION['LangPro']=$client_LangPro;
        $_SESSION['NationInterloc']=$client_NationInterloc;
        $_SESSION['FonctInterloc']=$client_FonctInterloc;
        $_SESSION['AttentesGramm']=$client_AttentesGramm;
        $_SESSION['AttentesCompreh']=$client_AttentesCompreh;
        $_SESSION['AttentesVocab']=$client_AttentesVocab;
        $_SESSION['AttentesSpec']=$client_AttentesSpec;
        $_SESSION['ConfrAccueilVisite']=$client_ConfrAccueilVisite;
        $_SESSION['ConfrTel']=$client_ConfrTel;
        $_SESSION['ConfrReunion']=$client_ConfrReunion;
        $_SESSION['ConfrCorrespond']=$client_ConfrCorrespond;
        $_SESSION['ConfrLecture']=$client_ConfrLecture;
        $_SESSION['ConfrOral']=$client_ConfrOral;
        $_SESSION['ConfrRedact']=$client_ConfrRedact;
        $_SESSION['ConfrDeplace']=$client_ConfrDeplace;
        $_SESSION['ConfrPresent']=$client_ConfrPresent;
        $_SESSION['ConfrNegoc']=$client_ConfrNegoc;
        $_SESSION['BesoinsSpecif']=$client_BesoinsSpecif;
        $_SESSION['ObjStage']=$client_ObjStage;
        $_SESSION['sport']=$client_sport;
        $_SESSION['jardin']=$client_jardin;
        $_SESSION['musique']=$client_musique;
        $_SESSION['theatre']=$client_theatre;
        $_SESSION['arts']=$client_arts;
        $_SESSION['sciences']=$client_sciences;
        $_SESSION['litterature']=$client_litterature;
        $_SESSION['bricolage']=$client_bricolage;
        $_SESSION['cuisine']=$client_cuisine;
        $_SESSION['autres_interets']=$client_autres_interets;
        $_SESSION['lecture1']=$client_Lecture;
        $_SESSION['lecture_text']=$client_lecture_text;
        $_SESSION['sport_text']=$client_sport_text;
        $_SESSION['jardin_text']=$client_jardin_text;
        $_SESSION['musique_text']=$client_musique_text;
        $_SESSION['theatre_text']=$client_theatre_text;
        $_SESSION['arts_text']=$client_arts_text;
        $_SESSION['sciences_text']=$client_sciences_text;
        $_SESSION['litterature_text']=$client_litterature_text;
        $_SESSION['bricolage_text']=$client_bricolage_text;
        $_SESSION['cuisine_text']=$client_cuisine_text;
        $_SESSION['journal_text']=$client_journal_text;
        
        }
       
        header('Location: updateprofil.php?numero='.$numero);
    }
    
} else {
    header('Location: index.php');
}


?>