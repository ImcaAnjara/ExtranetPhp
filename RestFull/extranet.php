<?php
	header('Content-type: application/json; charset=utf-8');
	header("Access-Control-Allow-Origin: *");
	$fieldList = array(
		'numero',
		'societe',
		'nom',
		'prenom',
		'fonction',
		'telephone',
		'mail',
		'nbhdisposem',
		'joursouhait',
		'horaisouhait',
		'tempsperso',
		'tempsprof',
		'nbabscprevue',
		'accesnetperso',
		'accesnetpro',
		'datedermodif',
		'portable',
		'ruedustage',
		'villedustage',
		'cpdustage',
		'civilite',
		'e_learning',
		'numindividu',
		'stage',
		'code stagiaire miracle',
		'code_soc',
		'date_creation',
		'departement',
		'date_email_rel',
		'date_email',
		'authorise',
		'rf_email',
		'rf_nomfamille',
		'rf_prénom',
		'date_test_oral',
		'notes_conv_debut',
		'notes_mes_debut',
		'evaluation_debut',
		'type_mail',
		'formation',
		'date_mail_attestation_demarrage',
		'date_passage_elearning',
		'doublon',
		'date_email_glossaire',
		'adressesupport'
	);
	
	$fieldList2 = array(
	    'numero',
	    'niveausco',
	    'nbansbac',
	    'languemat',
	    'premlang',
	    'formatAnt',
	    'paysanglo',
	    'LangGen',
	    'LangPro',
	    'NationInterloc',	
	    'FonctInterloc',	
	    'AttentesGramm',	
	    'AttentesCompreh',	
	    'AttentesVocab',	
	    'AttentesSpec',	
	    'ConfrAccueilVisite',
	    'ConfrTel',	
	    'ConfrReunion',	
	    'ConfrCorrespond',	
	    'ConfrLecture',	
	    'ConfrOral',	
	    'ConfrRedact',	
	    'ConfrDeplace',	
	    'ConfrPresent',	
	    'ConfrNegoc',	
	    'BesoinsSpecif',	
	    'ObjStage',	
	    'sport',	
	    'jardin',	
	    'musique',	
	    'theatre',	
	    'arts',	
	    'sciences',	
	    'litterature',
	    'bricolage',	
	    'cuisine',	
	    'autres_interets',	
	    'CasVideo1',	
	    'CasVideo2',	
	    'CasVideo3',	
	    'CasVideo4',	
	    'CasVideo5',	
	    'CasVideo6',	
	    'CasVideo7',
	    'CasetteAudio1',	
	    'CasetteAudio2',	
	    'CasetteAudio3',	
	    'CasetteAudio4',	
	    'CdAudio1',	
	    'CdAudio2',	
	    'CdAudio3',	
	    'PC',	
	    'MAC',	
	    'DVD',	
	    'Anglaisgene',	
	    'Anglaisaffaires',
	    'Anglaiscommunication',	
	    'Anglaisjeux',	
	    'Lecture',	
	    'Livres_romans',	
	    'Livres_policiers',	
	    'Livres_sciencefi',	
	    'BD_asterix',	
	    'BD_calvin',	
	    'Jeuxcartes',	
	    'Jeuxscrabble',	
	    'JeuxMotscroises',	
	    'Livrespedago_grammaire',	
	    'Livresped_expidiomatiques',	
	    'DateDerModif',	
	    'lecture1',	
	    'lecture_text',	
	    'sport_text',	
	    'jardin_text',	
	    'musique_text',	
	    'theatre_text',	
	    'arts_text',	
	    'sciences_text',	
	    'litterature_text',	
	    'bricolage_text',	
	    'cuisine_text',	
	    'journal_text'
	);
	
	$fieldList3 = array(
			'compteur_test',
			'question',
			'reponse1',
			'val_r1',
			'reponse2',
			'val_r2',
			'reponse3',
			'val_r3',
			'reponse4',
			'val_r4',
			'Note_Quest',
			'numero'
	);
	
	$fieldList4 = array(
			'compteur_test',
			'numero_idbase',
			'debutfin',
			'nom',
			'prenom',
			'societe',
			'tel',
			'date_actuelle',
			'date_passation',
			'heure_passation',
			'temps_passation',
			'Note_globale'
	);
	
	
	
	require('Connexion.php');
	$connexion = new Connexion();
	$con = $connexion->openConnexion("data");
	$common = new Common();
	$aParams = $_GET;
	if(empty($aParams['func'])) { 
		return json_encode(array('code' => 403, 'message' => "Aucune fonction  à appeler sur votre demande", 'data' =>  null));
		die;
	}
	$func = $aParams['func'];
	echo $func($aParams);
	
	function checkByNomPrenomOrMail($aParams = array()) {
		global $con, $common, $connexion;
		$sql = "select * from STAGIAIRE_Profil where 1 ";
		if(empty($aParams['nom']) && empty($aParams['prenom']) && empty($aParams['mail'])){
			return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
		}
		if(!empty($aParams['nom'])) {
			$sql .= "and nom = '" . addslashes($aParams['nom']) . "' " ;
		}
		if(!empty($aParams['prenom'])) {
			$sql .= "and prenom = '" . addslashes($aParams['prenom']) . "' " ;
		}
		if(!empty($aParams['mail'])) {
			$sql .= "and mail = '" . addslashes($aParams['mail']) . "' " ;
		}
		
		$res = odbc_exec($con,$sql);	
		$aData = $common->fetch2DArray($res, true);
		//var_dump(json_encode($aData), json_last_error_msg ());die;
		$connexion->closeConnexion($con);
		
		return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	function getByRefIndividu($aParams = array()) {
		global $con, $common, $connexion;
	
		$sql = "select * from STAGIAIRE_Profil where 1 ";
		if(empty($aParams['refIndividu'])) {
			return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
			die;
		}
		if(!empty($aParams['refIndividu'])) {
			$sql .= "and `numindividu` = " . addslashes($aParams['refIndividu']) . " " ;
		}
		
		$res = odbc_exec($con,$sql);	
		$aData = $common->fetch2DArray($res, true);
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	function getBynumero($aParams = array()) {
		global $con, $common, $connexion;
	
		$sql = "select * from STAGIAIRE_Profil where 1 ";
		if(empty($aParams['numero'])) {
			return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
			die;
		}
		if(!empty($aParams['numero'])) {
			$sql .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
		}
	
		$res = odbc_exec($con,$sql);
		$aData = $common->fetch2DArray($res, true);
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	function update($aParams){
		global $con, $common, $connexion;
	
		$sql = "update STAGIAIRE_Profil set ";
		$whereClause = " where 1 ";
		$fieldChange = "";
		if(empty($aParams['refIndividu']) ){
			return json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
			die;
		}
		if(!empty($aParams['refIndividu'])) {
			$whereClause .= "and `numindividu` = " . addslashes($aParams['refIndividu']) . " " ;
		}
		if(isset($aParams['nom']) && "" != $aParams['nom']){
			$fieldChange .= " nom = '" . utf8_decode($aParams['nom']) . "' ";
		}
		if(isset($aParams['prenom']) && "" != $aParams['prenom']){
			$fieldChange .= $fieldChange == "" ? " prenom = '" . $aParams['prenom'] . "' " : ", prenom = '" . $aParams['prenom'] . "' ";
		}
		if(isset($aParams['fonction']) && "" != $aParams['fonction']){
			$fieldChange .= $fieldChange == "" ? " fonction = '" . $aParams['fonction'] . "' " : ", fonction = '" . $aParams['fonction'] . "' ";
		}
		if(isset($aParams['mail']) && "" != $aParams['mail']){
			$fieldChange .= $fieldChange == "" ? " mail = '" . $aParams['mail'] . "' " : ", mail = '" . $aParams['mail'] . "' ";
		}
		if(isset($aParams['Telephone']) && "" != $aParams['Telephone']){
			$fieldChange .= $fieldChange == "" ? " Telephone = '" . $aParams['Telephone'] . "' " : ", Telephone = '" . $aParams['Telephone'] . "' ";
		}
		if(isset($aParams['Portable']) && "" != $aParams['Portable']){
			$fieldChange .= $fieldChange == "" ? " Portable = '" . $aParams['Portable'] . "' " : ", Portable = '" . $aParams['Portable'] . "' ";
		}
		if(isset($aParams['RueDuStage']) && "" != $aParams['RueDuStage']){
			$fieldChange .= $fieldChange == "" ? " RueDuStage = '" . $aParams['RueDuStage'] . "' " : ", RueDuStage = '" . $aParams['RueDuStage'] . "' ";
		}
		if(isset($aParams['VilleDuStage']) && "" != $aParams['VilleDuStage']){
			$fieldChange .= $fieldChange == "" ? " VilleDuStage = '" . $aParams['VilleDuStage'] . "' " : ", VilleDuStage = '" . $aParams['VilleDuStage'] . "' ";
		}
		if(isset($aParams['CPDuStage']) && "" != $aParams['CPDuStage']){
			$fieldChange .= $fieldChange == "" ? " CPDuStage = '" . $aParams['CPDuStage'] . "' " : ", CPDuStage = '" . $aParams['CPDuStage'] . "' ";
		}
		if(isset($aParams['Departement']) && "" != $aParams['Departement']){
			$fieldChange .= $fieldChange == "" ? " Departement = '" . $aParams['Departement'] . "' " : ", Departement = '" . $aParams['Departement'] . "' ";
		}
		
		if($fieldChange != "" ){
			$fieldChange .= ", DateDerModif = now()"; 
			$sql .= $fieldChange . " " . $whereClause;
			$res = odbc_exec($con, $sql);
		}
		
		
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Mis à jour ok", 'data' =>  null));
	}
	
	function delete($aParams){
		global $con, $common, $connexion;
		$sql = "delete from STAGIAIRE_Profil ";
		$whereClause = " where 1 ";
		if(empty($aParams['refIndividu']) ){
			return  json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
			die;
		}
		if(!empty($aParams['refIndividu'])) {
			$whereClause .= "and `numindividu` = " . addslashes($aParams['refIndividu']) . " " ;
			$sql .= $whereClause;
			$res = odbc_exec($con, $sql);
		}
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Suppression ok", 'data' =>  null));
	}
	
	function insert($aParams){
		global $con, $common, $connexion, $fieldList;
		//recuperqtion du mqx numero
		$sqlNumero = "select max(numero) as lastnum from STAGIAIRE_Profil ";
		$numero = null;
		
		$res = odbc_exec($con, $sqlNumero);	
		while(odbc_fetch_array($res)) {
			$numero = odbc_result($res, 'lastnum') + 1;
		}
		
		$sql = "INSERT into STAGIAIRE_Profil  ";
		$valueClause = array();
		$fieldChange = array();
		if(empty($aParams) || count($aParams) < 6 || empty($numero)) {
			return json_encode(array('code' => 400, 'message' => "Des parametres sont necessaires", 'data' =>  null));
			die;
		}
		$valueClause[] = "`numero`";
		$fieldChange[] = " '" . $numero . "' ";
		//unset($aParams['func']);
		foreach($aParams as $field => $value){
			if(!empty($value) && in_array($field, $fieldList)){
				$valueClause[] = "`" . $field . "`";
				$fieldChange[] = " '" . $value . "' ";
			}
		}
		
		if(!empty($fieldChange)){
			$sValueClause = "(" . implode(', ', $valueClause) .")";
			$sFieldChange = " (" . implode(', ', $fieldChange) .")";
			$sql .= $sValueClause . " values " . $sFieldChange;
			//echo $sql;die;
			$res = odbc_exec($con, $sql);
		}
		
		
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => "Ajout ok", 'data' =>  null)); 
	}
	
	function updateMdpWebcal(){
		ini_set('max_execution_time', -1);
		global $con, $common, $connexion;
		$sql = "select * from STAGIAIRE_Profil where numindividu > 23000";
		
		$res = odbc_exec($con, $sql);	
		$aData = $common->fetch2DArray($res, true);
		foreach($aData as $stagiaire){
			$nom = $stagiaire["nom"];
			$prenom = $stagiaire["prenom"];
			$mail = $stagiaire["mail"];
			$numero = $stagiaire["numero"];
			$url = "http://s371880604.onlinehome.fr/webcalendar_salle/srcs/www/auto.php?module=auto&action=import:updateStagiaire&mdp=".$numero."&refIndividu=".$numero;
			$url .= "&nom=".urlencode($nom);
			$url .= "&prenom=".urlencode($prenom);
			$url .= "&mail=".urlencode($mail);
			
			$response = file_get_contents($url);
			echo $nom. " ". $prenom. " " . $numero;
		}
		$connexion->closeConnexion($con);
		
		return json_encode(array('code' => 200, 'message' => "Mis a jour ok", 'data' =>  null)); 
	}
	
	function update2($aParams){
		global $con, $common, $connexion;
	
		$sql = "update STAGIAIRE_Profil set ";
		$whereClause = " where 1 ";
		$fieldChange = "";
		if(empty($aParams['numero']) ){
			return json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
			die;
		}
		if(!empty($aParams['numero'])) {
			$whereClause .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
		}
		if(isset($aParams['nom']) && "" != $aParams['nom']){
			$fieldChange .= " nom = '" . $aParams['nom'] . "' ";
		}
		if(isset($aParams['prenom']) && "" != $aParams['prenom']){
			$fieldChange .= $fieldChange == "" ? " prenom = '" . $aParams['prenom'] . "' " : ", prenom = '" . $aParams['prenom'] . "' ";
		}
		if(isset($aParams['societe']) && "" != $aParams['societe']){
			$fieldChange .= $fieldChange == "" ? " societe = '" . $aParams['societe'] . "' " : ", societe = '" . $aParams['societe'] . "' ";
		}
		if(isset($aParams['fonction']) && "" != $aParams['fonction']){
			$fieldChange .= $fieldChange == "" ? " fonction = '" . $aParams['fonction'] . "' " : ", fonction = '" . $aParams['fonction'] . "' ";
		}
		if(isset($aParams['mail']) && "" != $aParams['mail']){
			$fieldChange .= $fieldChange == "" ? " mail = '" . $aParams['mail'] . "' " : ", mail = '" . $aParams['mail'] . "' ";
		}
		if(isset($aParams['Telephone']) && "" != $aParams['Telephone']){
			$fieldChange .= $fieldChange == "" ? " Telephone = '" . $aParams['Telephone'] . "' " : ", Telephone = '" . $aParams['Telephone'] . "' ";
		}
		if(isset($aParams['Portable']) && "" != $aParams['Portable']){
			$fieldChange .= $fieldChange == "" ? " Portable = '" . $aParams['Portable'] . "' " : ", Portable = '" . $aParams['Portable'] . "' ";
		}
		if(isset($aParams['RueDuStage']) && "" != $aParams['RueDuStage']){
			$fieldChange .= $fieldChange == "" ? " RueDuStage = '" . $aParams['RueDuStage'] . "' " : ", RueDuStage = '" . $aParams['RueDuStage'] . "' ";
		}
		if(isset($aParams['VilleDuStage']) && "" != $aParams['VilleDuStage']){
			$fieldChange .= $fieldChange == "" ? " VilleDuStage = '" . $aParams['VilleDuStage'] . "' " : ", VilleDuStage = '" . $aParams['VilleDuStage'] . "' ";
		}
		if(isset($aParams['CPDuStage']) && "" != $aParams['CPDuStage']){
			$fieldChange .= $fieldChange == "" ? " CPDuStage = '" . $aParams['CPDuStage'] . "' " : ", CPDuStage = '" . $aParams['CPDuStage'] . "' ";
		}
		if(isset($aParams['Departement']) && "" != $aParams['Departement']){
			$fieldChange .= $fieldChange == "" ? " Departement = '" . $aParams['Departement'] . "' " : ", Departement = '" . $aParams['Departement'] . "' ";
		}
		if(isset($aParams['joursouhait']) && "" != $aParams['joursouhait']){
			$fieldChange .= $fieldChange == "" ? " joursouhait = '" . $aParams['joursouhait'] . "' " : ", joursouhait = '" . $aParams['joursouhait'] . "' ";
		}
		if(isset($aParams['horaisouhait']) && "" != $aParams['horaisouhait']){
			$fieldChange .= $fieldChange == "" ? " horaisouhait = '" . $aParams['horaisouhait'] . "' " : ", horaisouhait = '" . $aParams['horaisouhait'] . "' ";
		}
		if(isset($aParams['tempsperso']) && "" != $aParams['tempsperso']){
			$fieldChange .= $fieldChange == "" ? " tempsperso = '" . $aParams['tempsperso'] . "' " : ", tempsperso = '" . $aParams['tempsperso'] . "' ";
		}
		if(isset($aParams['tempsprof']) && "" != $aParams['tempsprof']){
			$fieldChange .= $fieldChange == "" ? " tempsprof = '" . $aParams['tempsprof'] . "' " : ", tempsprof = '" . $aParams['tempsprof'] . "' ";
		}
		if(isset($aParams['nbabscprevue']) && "" != $aParams['nbabscprevue']){
			$fieldChange .= $fieldChange == "" ? " nbabscprevue = '" . $aParams['nbabscprevue'] . "' " : ", nbabscprevue = '" . $aParams['nbabscprevue'] . "' ";
		}
		if(isset($aParams['accesnetpro']) && "" != $aParams['accesnetpro']){
			$fieldChange .= $fieldChange == "" ? " accesnetpro = '" . $aParams['accesnetpro'] . "' " : ", accesnetpro = '" . $aParams['accesnetpro'] . "' ";
		}
		if(isset($aParams['accesnetperso']) && "" != $aParams['accesnetperso']){
			$fieldChange .= $fieldChange == "" ? " accesnetperso = '" . $aParams['accesnetperso'] . "' " : ", accesnetperso = '" . $aParams['accesnetperso'] . "' ";
		}
		if(isset($aParams['e_learning']) && "" != $aParams['e_learning']){
			$fieldChange .= $fieldChange == "" ? " e_learning= '" . $aParams['e_learning'] . "' " : ", e_learning = '" . $aParams['e_learning'] . "' ";
		}
		
	
		if($fieldChange != "" ){
			$fieldChange .= ", DateDerModif = now()";
			$sql .= $fieldChange . " " . $whereClause;
			$res = odbc_exec($con, $sql);
		}
	
	
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Mis à jour ok", 'data' =>  null));
	}
	
	
	
	
	function getByProfil($aParams = array()) {
	    global $con, $common, $connexion;
	    
	    $sql = "select * from PROFIL where 1 ";
	    if(empty($aParams['numero'])) {
	        return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
	        die;
	    }
	    if(!empty($aParams['numero'])) {
	        $sql .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
	    }
	    
	    $res = odbc_exec($con,$sql);
	    $aData = $common->fetch2DArray($res, true);
	    $connexion->closeConnexion($con);
	    return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	function getByProfilSpec($aParams = array()) {
	    global $con, $common, $connexion;
	    
	    $sql = "select AttentesSpec,BesoinsSpecif from PROFIL where 1 ";
	    if(empty($aParams['numero'])) {
	        return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
	        die;
	    }
	    if(!empty($aParams['numero'])) {
	        $sql .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
	    }
	    
	    $res = odbc_exec($con,$sql);
// 	    $aData = $common->fetch2DArray($res, true);
	    $AttentesSpec1=odbc_result($res,"AttentesSpec");
	    $BesoinsSpecif1=odbc_result($res,"BesoinsSpecif");
	    
	    $AttentesSpec = utf8_encode($AttentesSpec1);
	    $BesoinsSpecif= utf8_encode($BesoinsSpecif1);
	    
	    $adata=array('AttentesSpec' => $AttentesSpec, 'BesoinsSpecif' => $BesoinsSpecif);
	    
	    $connexion->closeConnexion($con);
	    return json_encode(array('code' => 200, 'message' => "Profil specifique" , 'data' =>  $adata));
	}
	
	
	function insertProfil($aParams){
	    global $con, $common, $connexion, $fieldList2;
	    
	    $sql = "INSERT into PROFIL  ";
	    $valueClause = array();
	    $fieldChange = array();
	    if(empty($aParams) || count($aParams) < 2 ) {
	        return json_encode(array('code' => 400, 'message' => "Des parametres sont necessaires", 'data' =>  null));
	        die;
	    }
	    
	    //unset($aParams['func']);
	    foreach($aParams as $field => $value){
	        if(!empty($value) && in_array($field, $fieldList2)){
	            $valueClause[] = "`" . $field . "`";
	            $fieldChange[] = " '" . $value . "' ";
	        }
	    }
	    
	    if(!empty($fieldChange)){
	        $sValueClause = "(" . implode(', ', $valueClause) .")";
	        $sFieldChange = " (" . implode(', ', $fieldChange) .")";
	        $sql .= $sValueClause . " values " . $sFieldChange;
	        //echo $sql;die;
	        $res = odbc_exec($con, $sql);
	    }
	    
	    
	    $connexion->closeConnexion($con);
	    return json_encode(array('code' => 200, 'message' => "Ajout ok", 'data' =>  null));
	}
	
	
	function updateToProfil($aParams){
	    global $con, $common, $connexion;
	    
	    $sql = "update PROFIL set ";
	    $whereClause = " where 1 ";
	    $fieldChange = "";
	    if(empty($aParams['numero']) ){
	        return json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
	        die;
	    }
	    
	    if(!empty($aParams['numero'])) {
	        $whereClause .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
	    }
	    if(isset($aParams['NationInterloc']) && "" != $aParams['NationInterloc']){
	        $fieldChange .= " NationInterloc = '" . $aParams['NationInterloc'] . "' ";
	    }
	    if(isset($aParams['FonctInterloc']) && "" != $aParams['FonctInterloc']){
	        $fieldChange .= $fieldChange == "" ? " FonctInterloc = '" . $aParams['FonctInterloc'] . "' " : ", FonctInterloc = '" . $aParams['FonctInterloc'] . "' ";
	    }
	    if(isset($aParams['niveausco']) && "" != $aParams['niveausco']){
	        $fieldChange .= $fieldChange == "" ? " niveausco = '" . $aParams['niveausco'] . "' " : ", niveausco = '" . $aParams['niveausco'] . "' ";
	    }
	    if(isset($aParams['nbansbac']) && "" != $aParams['nbansbac']){
	        $fieldChange .= $fieldChange == "" ? " nbansbac = '" . $aParams['nbansbac'] . "' " : ", nbansbac = '" . $aParams['nbansbac'] . "' ";
	    }
	    if(isset($aParams['languemat']) && "" != $aParams['languemat']){
	        $fieldChange .= $fieldChange == "" ? " languemat = '" . $aParams['languemat'] . "' " : ", languemat = '" . $aParams['languemat'] . "' ";
	    }
	    if(isset($aParams['premlang']) && "" != $aParams['premlang']){
	        $fieldChange .= $fieldChange == "" ? " premlang = '" . $aParams['premlang'] . "' " : ", premlang = '" . $aParams['premlang'] . "' ";
	    }
	    if(isset($aParams['formatAnt']) && "" != $aParams['formatAnt']){
	        $fieldChange .= $fieldChange == "" ? " formatAnt = '" . $aParams['formatAnt'] . "' " : ", formatAnt = '" . $aParams['formatAnt'] . "' ";
	    }
	    if(isset($aParams['paysanglo']) && "" != $aParams['paysanglo']){
	        $fieldChange .= $fieldChange == "" ? " paysanglo = '" . $aParams['paysanglo'] . "' " : ", paysanglo = '" . $aParams['paysanglo'] . "' ";
	    }
	    if(isset($aParams['LangGen']) && "" != $aParams['LangGen']){
	        $fieldChange .= $fieldChange == "" ? " LangGen = '" . $aParams['LangGen'] . "' " : ", LangGen = '" . $aParams['LangGen'] . "' ";
	    }
	    if(isset($aParams['LangPro']) && "" != $aParams['LangPro']){
	        $fieldChange .= $fieldChange == "" ? " LangPro = '" . $aParams['LangPro'] . "' " : ", LangPro = '" . $aParams['LangPro'] . "' ";
	    }
	    if(isset($aParams['AttentesGramm']) && "" != $aParams['AttentesGramm']){
	        $fieldChange .= $fieldChange == "" ? " AttentesGramm = '" . $aParams['AttentesGramm'] . "' " : ", AttentesGramm = '" . $aParams['AttentesGramm'] . "' ";
	    }
	    if(isset($aParams['AttentesCompreh']) && "" != $aParams['AttentesCompreh']){
	        $fieldChange .= $fieldChange == "" ? " AttentesCompreh = '" . $aParams['AttentesCompreh'] . "' " : ", AttentesCompreh = '" . $aParams['AttentesCompreh'] . "' ";
	    }
	    if(isset($aParams['AttentesVocab']) && "" != $aParams['AttentesVocab']){
	        $fieldChange .= $fieldChange == "" ? " AttentesVocab = '" . $aParams['AttentesVocab'] . "' " : ", AttentesVocab = '" . $aParams['AttentesVocab'] . "' ";
	    }
	    if(isset($aParams['ConfrOral']) && "" != $aParams['ConfrOral']){
	        $fieldChange .= $fieldChange == "" ? " ConfrOral = '" . $aParams['ConfrOral'] . "' " : ", ConfrOral = '" . $aParams['ConfrOral'] . "' ";
	    }
	    if(isset($aParams['ConfrLecture']) && "" != $aParams['ConfrLecture']){
	        $fieldChange .= $fieldChange == "" ? " ConfrLecture = '" . $aParams['ConfrLecture'] . "' " : ", ConfrLecture = '" . $aParams['ConfrLecture'] . "' ";
	    }
	    if(isset($aParams['ConfrCorrespond']) && "" != $aParams['ConfrCorrespond']){
	        $fieldChange .= $fieldChange == "" ? " ConfrCorrespond = '" . $aParams['ConfrCorrespond'] . "' " : ", ConfrCorrespond = '" . $aParams['ConfrCorrespond'] . "' ";
	    }
	    if(isset($aParams['ConfrRedact']) && "" != $aParams['ConfrRedact']){
	        $fieldChange .= $fieldChange == "" ? " ConfrRedact = '" . $aParams['ConfrRedact'] . "' " : ", ConfrRedact = '" . $aParams['ConfrRedact'] . "' ";
	    }
	    if(isset($aParams['ConfrTel']) && "" != $aParams['ConfrTel']){
	        $fieldChange .= $fieldChange == "" ? " ConfrTel = '" . $aParams['ConfrTel'] . "' " : ", ConfrTel = '" . $aParams['ConfrTel'] . "' ";
	    }
	    if(isset($aParams['ConfrReunion']) && "" != $aParams['ConfrReunion']){
	        $fieldChange .= $fieldChange == "" ? " ConfrReunion = '" . $aParams['ConfrReunion'] . "' " : ", ConfrReunion = '" . $aParams['ConfrReunion'] . "' ";
	    }
	    if(isset($aParams['ConfrNegoc']) && "" != $aParams['ConfrNegoc']){
	        $fieldChange .= $fieldChange == "" ? " ConfrNegoc = '" . $aParams['ConfrNegoc'] . "' " : ", ConfrNegoc = '" . $aParams['ConfrNegoc'] . "' ";
	    }
	    if(isset($aParams['ConfrPresent']) && "" != $aParams['ConfrPresent']){
	        $fieldChange .= $fieldChange == "" ? " ConfrPresent = '" . $aParams['ConfrPresent'] . "' " : ", ConfrPresent = '" . $aParams['ConfrPresent'] . "' ";
	    }
	    if(isset($aParams['ConfrDeplace']) && "" != $aParams['ConfrDeplace']){
	        $fieldChange .= $fieldChange == "" ? " ConfrDeplace = '" . $aParams['ConfrDeplace'] . "' " : ", ConfrDeplace = '" . $aParams['ConfrDeplace'] . "' ";
	    }
	    if(isset($aParams['ConfrAccueilVisite']) && "" != $aParams['ConfrAccueilVisite']){
	        $fieldChange .= $fieldChange == "" ? " ConfrAccueilVisite = '" . $aParams['ConfrAccueilVisite'] . "' " : ", ConfrAccueilVisite = '" . $aParams['ConfrAccueilVisite'] . "' ";
	    }
	    if(isset($aParams['AttentesSpec']) && "" != $aParams['AttentesSpec']){
	        $fieldChange .= $fieldChange == "" ? " AttentesSpec = '" . $aParams['AttentesSpec'] . "' " : ", AttentesSpec = '" . $aParams['AttentesSpec'] . "' ";
	    }
	    if(isset($aParams['Lecture']) && "" != $aParams['Lecture']){
	        $fieldChange .= $fieldChange == "" ? " Lecture = '" . $aParams['Lecture'] . "' " : ", Lecture = '" . $aParams['Lecture'] . "' ";
	    }
	    if(isset($aParams['arts']) && "" != $aParams['arts']){
	        $fieldChange .= $fieldChange == "" ? " arts = '" . $aParams['arts'] . "' " : ", arts = '" . $aParams['arts'] . "' ";
	    }
	    if(isset($aParams['sport']) && "" != $aParams['sport']){
	        $fieldChange .= $fieldChange == "" ? " sport = '" . $aParams['sport'] . "' " : ", sport = '" . $aParams['sport'] . "' ";
	    }
	    if(isset($aParams['cuisine']) && "" != $aParams['cuisine']){
	        $fieldChange .= $fieldChange == "" ? " cuisine = '" . $aParams['cuisine'] . "' " : ", cuisine = '" . $aParams['cuisine'] . "' ";
	    }
	    if(isset($aParams['jardin']) && "" != $aParams['jardin']){
	        $fieldChange .= $fieldChange == "" ? " jardin = '" . $aParams['jardin'] . "' " : ", jardin = '" . $aParams['jardin'] . "' ";
	    }
	    if(isset($aParams['sciences']) && "" != $aParams['sciences']){
	        $fieldChange .= $fieldChange == "" ? " sciences = '" . $aParams['sciences'] . "' " : ", sciences = '" . $aParams['sciences'] . "' ";
	    }
	    if(isset($aParams['musique']) && "" != $aParams['musique']){
	        $fieldChange .= $fieldChange == "" ? " musique = '" . $aParams['musique'] . "' " : ", musique = '" . $aParams['musique'] . "' ";
	    }
	    if(isset($aParams['litterature']) && "" != $aParams['litterature']){
	        $fieldChange .= $fieldChange == "" ? " litterature = '" . $aParams['litterature'] . "' " : ", litterature = '" . $aParams['litterature'] . "' ";
	    }
	    if(isset($aParams['theatre']) && "" != $aParams['theatre']){
	        $fieldChange .= $fieldChange == "" ? " theatre = '" . $aParams['theatre'] . "' " : ", theatre = '" . $aParams['theatre'] . "' ";
	    }
	    if(isset($aParams['bricolage']) && "" != $aParams['bricolage']){
	        $fieldChange .= $fieldChange == "" ? " bricolage = '" . $aParams['bricolage'] . "' " : ", bricolage = '" . $aParams['bricolage'] . "' ";
	    }
	    if(isset($aParams['lecture_text']) && "" != $aParams['lecture_text']){
	        $fieldChange .= $fieldChange == "" ? " lecture_text = '" . $aParams['lecture_text'] . "' " : ", lecture_text = '" . $aParams['lecture_text'] . "' ";
	    }
	    if(isset($aParams['arts_text']) && "" != $aParams['arts_text']){
	        $fieldChange .= $fieldChange == "" ? " arts_text = '" . $aParams['arts_text'] . "' " : ", arts_text = '" . $aParams['arts_text'] . "' ";
	    }
	    if(isset($aParams['sport_text']) && "" != $aParams['sport_text']){
	        $fieldChange .= $fieldChange == "" ? " sport_text = '" . $aParams['sport_text'] . "' " : ", sport_text = '" . $aParams['sport_text'] . "' ";
	    }
	    if(isset($aParams['cuisine_text']) && "" != $aParams['cuisine_text']){
	        $fieldChange .= $fieldChange == "" ? " cuisine_text = '" . $aParams['cuisine_text'] . "' " : ", cuisine_text = '" . $aParams['cuisine_text'] . "' ";
	    }
	    if(isset($aParams['jardin_text=']) && "" != $aParams['jardin_text=']){
	        $fieldChange .= $fieldChange == "" ? " jardin_text= = '" . $aParams['jardin_text='] . "' " : ", jardin_text= = '" . $aParams['jardin_text='] . "' ";
	    }
	    if(isset($aParams['sciences_text']) && "" != $aParams['sciences_text']){
	        $fieldChange .= $fieldChange == "" ? " sciences_text = '" . $aParams['sciences_text'] . "' " : ", sciences_text = '" . $aParams['sciences_text'] . "' ";
	    }
	    if(isset($aParams['musique_text']) && "" != $aParams['musique_text']){
	        $fieldChange .= $fieldChange == "" ? " musique_text = '" . $aParams['musique_text'] . "' " : ", musique_text = '" . $aParams['musique_text'] . "' ";
	    }
	    if(isset($aParams['litterature_text']) && "" != $aParams['litterature_text']){
	        $fieldChange .= $fieldChange == "" ? " litterature_text = '" . $aParams['litterature_text'] . "' " : ", litterature_text = '" . $aParams['litterature_text'] . "' ";
	    }
	    if(isset($aParams['theatre_text']) && "" != $aParams['theatre_text']){
	        $fieldChange .= $fieldChange == "" ? " theatre_text = '" . $aParams['theatre_text'] . "' " : ", theatre_text = '" . $aParams['theatre_text'] . "' ";
	    }
	    if(isset($aParams['bricolage_text']) && "" != $aParams['bricolage_text']){
	        $fieldChange .= $fieldChange == "" ? " bricolage_text= '" . $aParams['bricolage_text'] . "' " : ", bricolage_text = '" . $aParams['bricolage_text'] . "' ";
	    }
	    if(isset($aParams['autres_interets']) && "" != $aParams['autres_interets']){
	        $fieldChange .= $fieldChange == "" ? " autres_interets = '" . $aParams['autres_interets'] . "' " : ", autres_interets = '" . $aParams['autres_interets'] . "' ";
	    }
	    if(isset($aParams['journal_text']) && "" != $aParams['journal_text']){
	        $fieldChange .= $fieldChange == "" ? " journal_text = '" . $aParams['journal_text'] . "' " : ", journal_text = '" . $aParams['journal_text'] . "' ";
	    }
	    if(isset($aParams['BesoinsSpecif']) && "" != $aParams['BesoinsSpecif']){
	        $fieldChange .= $fieldChange == "" ? " BesoinsSpecif = '" . $aParams['BesoinsSpecif'] . "' " : ", BesoinsSpecif = '" . $aParams['BesoinsSpecif'] . "' ";
	    }
	    
	    
	    if($fieldChange != "" ){
	        $fieldChange .= ", DateDerModif = now()";
	        $sql .= $fieldChange . " " . $whereClause;
	        $res = odbc_exec($con, $sql);
	    }
	    
	    
	    $connexion->closeConnexion($con);
	    return json_encode(array('code' => 200, 'message' => " Update ok", 'data' =>  null));
	}
	
	function deleteStagiaire($aParams){
	    global $con, $common, $connexion;
	    $sql = "delete from STAGIAIRE_Profil ";
	    $whereClause = " where 1 ";
	    if(empty($aParams['numero']) ){
	        return  json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
	        die;
	    }
	    if(!empty($aParams['numero'])) {
	        $whereClause .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
	        $sql .= $whereClause;
	        $res = odbc_exec($con, $sql);
	    }
	    $connexion->closeConnexion($con);
	    return json_encode(array('code' => 200, 'message' => " Suppression ok", 'data' =>  null));
	}
	
	function deleteProfil($aParams){
	    global $con, $common, $connexion;
	    $sql = "delete from Profil ";
	    $whereClause = " where 1 ";
	    if(empty($aParams['numero']) ){
	        return  json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
	        die;
	    }
	    if(!empty($aParams['numero'])) {
	        $whereClause .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
	        $sql .= $whereClause;
	        $res = odbc_exec($con, $sql);
	    }
	    $connexion->closeConnexion($con);
	    return json_encode(array('code' => 200, 'message' => " Suppression ok", 'data' =>  null));
	}
	
	function checkResultByNumeroIdBase($aParams = array()) {
		global $con, $common, $connexion;
	
		$sql = "select * from test_en_ligne where 1 ";
		if(empty($aParams['numero_idbase'])) {
			return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
			die;
		}
		if(!empty($aParams['numero_idbase'])) {
			$sql .= "and `numero_idbase` = " . addslashes($aParams['numero_idbase']) . " " ;
		}
	
		$res = odbc_exec($con,$sql);
		$aData = $common->fetch2DArray($res, true);
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	function checkResultByNumero($aParams = array()) {
		global $con, $common, $connexion;
	
		$sql = "select * from resultat_test where 1 ";
		if(empty($aParams['compteur_test'])) {
			return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
			die;
		}
		if(!empty($aParams['compteur_test'])) {
			$sql .= "and `compteur_test` = " . addslashes($aParams['compteur_test']) . " " ;
		}
	
		$res = odbc_exec($con,$sql);
		$aData = $common->fetch2DArray($res, true);
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	
	function GetMaxcompteurTest($aParams = array()) {
		global $con, $common, $connexion;
	
		$sql = "select max(compteur_test) as lastnum from resultat_test  ";
		
		$res = odbc_exec($con,$sql);
		$aData = $common->fetch2DArray($res, true);
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
	}
	
	
	function Insertresultat($aParams = array()) {
		global $con, $common, $connexion, $fieldList3;
	
		$sql = "INSERT into resultat_test  ";
		$valueClause = array();
		$fieldChange = array();
		if(empty($aParams) || count($aParams) < 2 ) {
			return json_encode(array('code' => 400, 'message' => "Des parametres sont necessaires", 'data' =>  null));
			die;
		}
		 
		//unset($aParams['func']);
		foreach($aParams as $field => $value){
			if(!empty($value) && in_array($field, $fieldList3)){
				$valueClause[] = "`" . $field . "`";
				$fieldChange[] = " '" . $value . "' ";
			}
		}
		 
		if(!empty($fieldChange)){
			$sValueClause = "(" . implode(', ', $valueClause) .")";
			$sFieldChange = " (" . implode(', ', $fieldChange) .")";
			$sql .= $sValueClause . " values " . $sFieldChange;
			//echo $sql;die;
			$res = odbc_exec($con, $sql);
		}
		 
		 
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => "Ajout ok", 'data' =>  null));
		
	}
	
	function InsertresultTest($aParams = array()) {
		global $con, $common, $connexion, $fieldList4;
	
		$sql = "INSERT into test_en_ligne  ";
		$valueClause = array();
		$fieldChange = array();
		if(empty($aParams) || count($aParams) < 2 ) {
			return json_encode(array('code' => 400, 'message' => "Des parametres sont necessaires", 'data' =>  null));
			die;
		}
			
		//unset($aParams['func']);
		foreach($aParams as $field => $value){
			if(!empty($value) && in_array($field, $fieldList4)){
				$valueClause[] = "`" . $field . "`";
				$fieldChange[] = " '" . $value . "' ";
			}
		}
			
		if(!empty($fieldChange)){
			$sValueClause = "(" . implode(', ', $valueClause) .")";
			$sFieldChange = " (" . implode(', ', $fieldChange) .")";
			$sql .= $sValueClause . " values " . $sFieldChange;
			//echo $sql;die;
			$res = odbc_exec($con, $sql);
		}
			
			
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => "Ajout ok", 'data' =>  null));
	
	}
	
	function UpdateresultTest($aParams = array()) {
		global $con, $common, $connexion;
		
		$sql = "update test_en_ligne set ";
		$whereClause = " where 1 ";
		$fieldChange = "";
		if(empty($aParams['compteur_test']) ){
			return json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
			die;
		}
		if(!empty($aParams['compteur_test'])) {
			$whereClause .= "and `compteur_test` = " . addslashes($aParams['compteur_test']) . " " ;
		}
		if(isset($aParams['temps_passation']) && "" != $aParams['temps_passation']){
			$fieldChange .= " temps_passation = '" . utf8_decode($aParams['temps_passation']) . "' ";
		}
		if(isset($aParams['Note_globale']) && "" != $aParams['Note_globale']){
			$fieldChange .= $fieldChange == "" ? " Note_globale = '" . $aParams['Note_globale'] . "' " : ", Note_globale = '" . $aParams['Note_globale'] . "' ";
		}
		
		if($fieldChange != "" ){
			$sql .= $fieldChange . " " . $whereClause;
			$res = odbc_exec($con, $sql);
		}
		
		
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Mis à jour ok", 'data' =>  null));
	
	}
	
	function deleteresultat($aParams){
		global $con, $common, $connexion;
		$sql = "delete from resultat_test ";
		$whereClause = " where 1 ";
		if(empty($aParams['numero']) ){
			return  json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
			die;
		}
		if(!empty($aParams['numero'])) {
			$whereClause .= "and `numero` = " . addslashes($aParams['numero']) . " " ;
			$sql .= $whereClause;
			$res = odbc_exec($con, $sql);
		}
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Suppression ok", 'data' =>  null));
	}
	
	function deleteresulttest($aParams){
		global $con, $common, $connexion;
		$sql = "delete from test_en_ligne ";
		$whereClause = " where 1 ";
		if(empty($aParams['compteur_test']) ){
			return  json_encode(array('code' => 400, 'message' => "Les parametres doivent renseignés", 'data' =>  null));
			die;
		}
		if(!empty($aParams['compteur_test'])) {
			$whereClause .= "and `compteur_test` = " . addslashes($aParams['compteur_test']) . " " ;
			$sql .= $whereClause;
			$res = odbc_exec($con, $sql);
		}
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Suppression ok", 'data' =>  null));
	}
	
	
	
?>