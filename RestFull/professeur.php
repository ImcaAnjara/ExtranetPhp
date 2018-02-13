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

function checkByNomProflogin($aParams = array()) {
    global $con, $common, $connexion;
    
    $ref = utf8_decode('RéfIndividu');
    $sql = "select * from Individus where 1 ";
    if(empty($aParams) || count($aParams) < 3){
        return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
    }
    if(!empty($aParams["Nomfamille"])) {
        $sql .= "and Nomfamille = '" . addslashes($aParams["Nomfamille"]) . "' " ;
    }
    if(!empty($aParams["RefInd"])) {
        $refinf = $aParams["RefInd"];
        $sql .= "and  ".$ref." = " .$refinf;
    }
    
    // 		$sql = "select * from Individus where 1 and Nomfamille = '".$nom."' and  ".$ref." = " .$refinf;
    
    $res = odbc_exec($con,$sql);
    $aData = $common->fetch2DArray($res, true);
    //var_dump(json_encode($aData), json_last_error_msg ());die;
    $connexion->closeConnexion($con);
    
    return json_encode(array('code' => 200, 'message' => count($aData) , 'data' =>  $aData));
}



?>