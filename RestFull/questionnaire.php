<?php
	header('Content-type: application/json; charset=utf-8');
	header("Access-Control-Allow-Origin: *");
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
	
	function getallQuestions($aParams = array()) {
		global $con, $common, $connexion;
				
		$sql = "select * from Questionnaires where type = 'Debut' ";
		
		$res = odbc_exec($con,$sql);	
		$aData = $common->fetch2DArray($res, true);
		//var_dump(json_encode($aData), json_last_error_msg ());die;
		$connexion->closeConnexion($con);
		
		$tab = array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData);
		var_dump($tab);
		return $tab;
	}
	
?>