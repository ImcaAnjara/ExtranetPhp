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
	
	function listByPortefeuilleProf($aParams = array()) {
		global $con, $common, $connexion;
		if(!empty($aParams['idprof'])) {
			//filter by Nom prenom etc ..
			$filterCriteria = "";
			if(!empty($aParams['nom'])) {
				$filterCriteria .= " and prs.Nomfamille like '%" . addslashes($aParams['nom']) . "%' " ;
			}
			if(!empty($aParams['prenom'])) {
				$filterCriteria .= " and prs.[Prénom] like '%" . addslashes($aParams['prenom']) . "%' " ;
			}																							
			$sql = "SELECT prs.civilité & ' '& prs.Nomfamille as nomStagiare, p.LibelleStagiaire, p.NomProduit, p.Production, p.TypeProduction, Stage.RéfSociété AS client, p.encourcompteur,
				p.[CycleDurée de cours], p.dateaffectation, p.SoldeHeure,
				p.stagiaireID, p.Stage, p.heures_commandees, Sum(Agenda.Duree) AS SommeDeDuree, prs.Nomfamille, prs.[Prénom],
				cs.compteur as compteur_suivi, cs.code, cs.date_1er_cours_prev
				FROM (((portefeuilleprof p
				INNER JOIN Individus prs ON p.StagiaireID = prs.[RéfIndividu])
				LEFT JOIN Agenda ON (Agenda.Compteurencours = p.encourcompteur  AND Agenda.transfert_production is null ))
				LEFT JOIN code_suivi cs on cs.compteur_encours = p.encourcompteur)
				LEFT JOIN Stage ON p.Stage = Stage.RéfCommande
				WHERE ((Producteur)=". $aParams['idprof'] .")  " . $filterCriteria . 
				" GROUP BY p.TypeProduction, Stage.RéfSociété, p.[CycleDurée de cours], p.dateaffectation, p.SoldeHeure, p.Production, p.NomProduit, 
				prs.civilité & ' '& prs.Nomfamille,p.LibelleStagiaire, p.client, p.encourcompteur, p.stagiaireID, p.Stage, p.heures_commandees, prs.Nomfamille, prs.[Prénom],
				cs.compteur, cs.code, cs.date_1er_cours_prev
				ORDER BY p.LibelleStagiaire ASC, prs.civilité & ' '& prs.Nomfamille ASC, p.client ASC ";
			
			
			$res = odbc_exec($con, utf8_decode ($sql));	
			$result = $common->fetch2DArray($res, true);
			$aData = array();
			foreach($result as $oListe){
				if(trim($oListe['LibelleStagiaire']) == 'Cours de groupe'){
					$sqlGrp = "select Individus.RéfIndividu, Civilité as titre,NomFamille,Prénom from (encours 
						INNER JOIN Individus ON Individus.RéfIndividu=encours.stagiaire)
						where stageCode = ".$oListe['Stage']." and Groupe='Grp'";
						//var_dump($sqlGrp);die;
					$resGrp = odbc_exec($con, utf8_decode ($sqlGrp));	
					$oListe['stagiaireList'] = $common->fetch2DArray($resGrp, true);
				}
				$aData[] = $oListe;
			}
			$connexion->closeConnexion($con);
			
			return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
		} else {
		
			return json_encode(array('code' => 400, 'message' => "Le numero Individus du prof (idprof) est obligatoire", 'data' =>  null));
		}
	}
	
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
		
		$res = odbc_exec($con,  utf8_decode ($sql));	
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
		
		$res = odbc_exec($con, utf8_decode ($sql));	
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
			$fieldChange .= " nom = '" . $aParams['nom'] . "' ";
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
			$res = odbc_exec($con,  utf8_decode ($sql));
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
			$res = odbc_exec($con,  utf8_decode ($sql));
		}
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => " Suppression ok", 'data' =>  null));
	}
	
	function insert($aParams){
		global $con, $common, $connexion, $fieldList;
	
		$sql = "INSERT into STAGIAIRE_Profil  ";
		$valueClause = array();
		$fieldChange = array();
		if(empty($aParams) || count($aParams) < 6){
			return json_encode(array('code' => 400, 'message' => "Des parametres sont necessaires", 'data' =>  null));
			die;
		}
		
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
			echo $sql;die;
			//$res = odbc_exec($con, $sql);
		}
		
		
		$connexion->closeConnexion($con);
		return json_encode(array('code' => 200, 'message' => "Ajout ok", 'data' =>  null)); 
	}
	
	
	
	function VerifieSolde(){
		global $con, $common, $connexion;
		
		if(!empty($_GET['stageID'])){
			$stageID = $_GET['stageID'];
			$vsql2 = "SELECT Encours.RéfProduit, Produits.NomProduit, ([factureqtéheure]-[Avoirqté])-Sum(IIf([ConsoQuantité] Is Null,0,[ConsoQuantité])) AS Soldeheure
				FROM ((Produits 
				LEFT JOIN Encours ON Produits.RéfProduit = Encours.RéfProduit)
				LEFT JOIN Production ON Encours.Compteur = Production.EncoursVentilation)
				WHERE (((Encours.[CycleDurée de cours])<>0) AND ((Encours.Stagiaire)<>0)) AND
				EnCours.StageCode= " . $stageID . "
				GROUP BY Produits.NomProduit, Encours.FactureQtéHeure, Encours.RéfProduit,  AvoirQté";
			//echo $vsql2;die;
			$res = odbc_exec($con, utf8_decode($vsql2));
			
			$aData = $common->fetch2DArray($res, true);
			$aCours = array();
			foreach($aData as $cours){
				$aCours[$cours['NomProduit']] = $cours['Soldeheure'];
			}
			$connexion->closeConnexion($con);
			return json_encode(array('code' => 200, 'message' => count($aData) . " Cours trouvés", 'data' =>  $aCours));
		} else {
			return json_encode(array('code' => 400, 'message' => "Le parametre stageID est obligatoire", 'data' =>  null));
		}
	}
	
	function getNoteStagiaire(){
		global $con, $common, $connexion;
		
		if(!empty($_GET['stage'])) {
			$query = "select [TestDébutNoteQCM], [TestDébutNoteConv], [TestDébutNoteMes], TestFinNoteQCM, TestFinNoteConv, TestFinNoteMes, TestFinObservationsConv, [TestFinCodeRéf1] from stagiaire  WHERE stage = " . $_GET['stage'] ;
			
			$res = odbc_exec($con, utf8_decode($query));
			
			$aData = $common->fetch2DArray($res, true);
			$connexion->closeConnexion($con);
			
			return json_encode(array('code' => 200, 'message' => count($aData) . " Enregstrement trouvés", 'data' =>  $aData));
		} else {
			
			return json_encode(array('code' => 400, 'message' => "Le parametre stage est obligatoire", 'data' =>  null));
		}
	}

	function updateNote(){
		global $con, $common, $connexion;
		$sql = "UPDATE stagiaire ";
		$setClause = "set";
		if(!empty($_GET['stage'])) {
		
			if(!empty($_GET['note_qcm'])) {
				$setClause .= " TestFinNoteQCM = " . $_GET['note_qcm'];
			}
			if(!empty($_GET['note_conv'])) {
				$noteCONV = $_GET['note_conv'];
				$setClause .= ($setClause == "set" ? " " : ", ") . "TestFinNoteConv = " . $noteCONV;
			}
			if(!empty($_GET['note_mes'])) {
				$setClause .=  ($setClause == "set" ? " " : ", ") . "TestFinNoteMes = " .$_GET['note_mes'];
			}
			
			$sql .= $setClause . " WHERE stage = " . $_GET['stage'] ;
			if($setClause == "set"){
				
				return json_encode(array('code' => 400, 'message' => "Aucun data à metre à jours", 'data' =>  null));
			} else {
				$res = odbc_exec($con,  utf8_decode ($sql));
				$connexion->closeConnexion($con);
				return json_encode(array('code' => 200, 'message' => "Mis a jours de note réussit", 'data' =>  null));
			}
		} else {
			
			return json_encode(array('code' => 400, 'message' => "Les parametres stage et compteur sont obligatoire", 'data' =>  null));
		}
	}
	
	function getCodeAnomalie(){
		global $con, $common, $connexion;
		if(!empty($_GET['compteur'])) {
			$sqlList = "select * from Code_annomalie_stage";
			$res = odbc_exec($con, utf8_decode($sqlList));
			$codeList = $common->fetch2DArray($res, true);
			
			$sqlCode = "select * from code_suivi where compteur_encours = ". $_GET['compteur'] . "";
			$res = odbc_exec($con, utf8_decode($sqlCode));
			$codeSuivi = $common->fetch2DArray($res, true);
			
			return json_encode(array('code' => 200, 'message' => "Operation reussit", 'data' =>  array('list'=>$codeList, 'codeSuivi'=>$codeSuivi)));
			
		} else {
			
			return json_encode(array('code' => 400, 'message' => "Les parametres compteur sont obligatoire", 'data' =>  null));
		}
	}
	
	function saveCodeAnomalie(){
		global $con, $common, $connexion;
		//Si la code n'est pas encore creer il faut creer
		$codeSuivi = $_GET['compteur_suivi'];
		$fieldChange = " (" ;
		$valueClause = " (";
		if($codeSuivi <= 0) {
			$query = "insert into code_suivi ";
			
			$fieldChange .= " compteur_encours" ;
			$valueClause .= " '" . $_GET['compteurencours'] . "'";
			
			if(!empty($_GET['code_suivi'])) {
				$fieldChange .= ", code" ;
				$valueClause .= ", '" . $_GET['code_suivi'] . "'";
			}
			
			if(!empty($_GET['date_creation_code'])) {
				$fieldChange .= ($fieldChange == " (" ? "" : ", ") . "date_creation";
				$valueClause .= ($valueClause == " (" ? "" : ", '") . $_GET['date_creation_code'] . "'";
			} else{
				$fieldChange .= ($fieldChange == " (" ? "" : ", ") . "date_creation";
				$valueClause .= $valueClause == " (" ? " now()" : ", now()";
			}
			if(!empty($_GET['date_reprise_stage'])) {
				$fieldChange .= ($fieldChange == " (" ? "" : ", ") . "date_reprise_stage";
				$valueClause .= ($valueClause == " (" ? "" : ", '") . $_GET['date_reprise_stage']. "'";
			}
			if(!empty($_GET['date_1er_cours'])) {
				$fieldChange .= ($fieldChange == " (" ? "" : ", ") . "date_1er_cours_prev";
				$valueClause .= ($valueClause == " (" ? "" : ", '") . $_GET['date_1er_cours']. "'";
			}
			if(!empty($_GET['date_last_cours'])) {
				$fieldChange .= ($fieldChange == " (" ? "" : ", ") . "date_last_cours_prev";
				$valueClause .= ($valueClause == " (" ? "" : ", '") . $_GET['date_last_cours']. "'";
			}
			if(!empty($_GET['detail'])) {
				$fieldChange .= ($fieldChange == " (" ? "" : ", ") . "detail";
				$valueClause .= ($valueClause == " (" ? "" : ", '") . $_GET['detail']. "'";
			}
			$query .= $fieldChange .") values " . $valueClause .")";
			
			odbc_exec($con, utf8_decode($query));
			$connexion->closeConnexion($con);
			return json_encode(array('code' => 200, 'message' => "Insertion code suivi réussit", 'data' =>  null));
		} else {		
			$query = "UPDATE code_suivi ";
			$setClause = "set";
			if(!empty($_GET['code_suivi'])) {
				$setClause .= " code = '" . $_GET['code_suivi'] . "'";
			}
			if(!empty($_GET['date_creation_code'])) {
				$setClause .= ($setClause == "set" ? " " : ", ") . " date_creation='" . $_GET['date_creation_code']."'";
			}
			if(!empty($_GET['date_reprise_stage'])) {
				$setClause .= ($setClause == "set" ? " " : ", ") . " date_reprise_stage='" . $_GET['date_reprise_stage']."'";
			}
			if(!empty($_GET['date_1er_cours'])) {
				$setClause .= ($setClause == "set" ? " " : ", ") . " date_1er_cours_prev='" . $_GET['date_1er_cours']."'";
			}
			if(!empty($_GET['date_last_cours'])) {
				$setClause .= ($setClause == "set" ? " " : ", ") . " date_last_cours_prev='" . $_GET['date_last_cours']."'";
			}
			if(!empty($_GET['detail'])) {
				$setClause .= ($setClause == "set" ? " " : ", ") . " detail='" . $_GET['detail'] ."'";
			}
			if($setClause == "set" || empty($_GET['compteur_suivi'])){
				
			return json_encode(array('code' => 400, 'message' => "Parametre insufisant", 'data' =>  null));
		} else {
			$sql = $query . $setClause . " where compteur=".$codeSuivi;
			//var_dump($sql);die;
			$res = odbc_exec($con,  utf8_decode($sql));
			$connexion->closeConnexion($con);
			return json_encode(array('code' => 200, 'message' => "Mis a jours de note réussit", 'data' =>  null));
		}
		}
		
	}
	
	
?>