<?php
header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");


$fieldList = array(
    'idenquete',
    'numero',
    'dateEnregistrement',
//     'nom_prenom',
//     'societe',
//     'formation',
//     'numerostage',
//     'module',
//     'prof_faf',
//     'prof_tel_tut',
//     'periode',
//     'dateEnregistrement',
//     'question',
//     'critere',
//     'observation',
//     'raison_insatisfaction',
    'q1',
    'q1c1',
    'q1c1r',
    'q1c1r1',
    'q1c2',
    'q1c2r',
    'q1c2r2',
    'q2',
    'q2c1',
    'q2c1r',
    'q2c1r1',
    'q2c2',
    'q2c2r',
    'q2c2r2',
    'q2c3',
    'q2c3r',
    'q2c3r3',
    'q2c4',
    'q2c4r',
    'q2c4r4',
    'q3',
    'q3c1',
    'q3c1r',
    'q3c1r1',
    'q3c2',
    'q3c2r',
    'q3c2r2',
    'q3c3',
    'q3c3r',
    'q3c3r3',
    'q3c4',
    'q3c4r',
    'q3c4r4',
    'q4',
    'q4c1',
    'q4c1r',
    'q4c1r1',
    'q4c2',
    'q4c2r',
    'q4c2r2',
    'q5',
    'q5c1',
    'q5c1r',
    'q5c1r1',
    'q5c2',
    'q5c2r',
    'q5c2r2',
    'q6',
    'q6c1',
    'q6c1r',
    'q6c1r1',
    'q6c2',
    'q6c2r',
    'q6c2r2',
    'q6c3',
    'q6c3r',
    'q6c3r3',
    'q6c4',
    'q6c4r',
    'q6c4r4',
    'q7',
    'q7c1',
    'q7c1r',
    'q7c1r1',
    'q8',
    'q8c1',
    'q8c1r',
    'q8c1r1',
    'q8c2',
    'q8c2r',
    'q8c2r2',
    'q8c3',
    'q8c3r',
    'q8c3r3',
    'q8c4',
    'q8c4r',
    'q8c4r4',
    'q9',
    'q9c1',
    'q9c1r',
    'q9c1r1',
    'q9c2',
    'q9c2r',
    'q9c2r2',
    'q9c3',
    'q9c3r',
    'q9c3r3',
    'q10',
    'q10c1',
    'q10c1r',
    'q10c1r1',
    'suggestions'
);


require('Connexion.php');
$connexion = new Connexion();
$con = $connexion->openConnexion("stagiaires");
$common = new Common();
$aParams = $_GET;
if(empty($aParams['func'])) {
    return json_encode(array('code' => 403, 'message' => "Aucune fonction  à appeler sur votre demande", 'data' =>  null));
    die;
}
$func = $aParams['func'];
echo $func($aParams);


function checkEnquetedetailByNumeros($aParams = array()) {
    global $con, $common, $connexion;
    $sql = "select * from Enquete_details where 1 ";
//     if(empty($aParams['numero'])){
//         return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
//     }
//     if(!empty($aParams['numero'])) {
        
//         $sql .= "and numero = ".$aParams['numero'];
//     }
    
    $res = odbc_exec($con,$sql);
    $aData = $common->fetch2DArray($res, true);
    //var_dump(json_encode($aData), json_last_error_msg ());die;
    $connexion->closeConnexion($con);
    
    return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
}

function insertEnquetedetails($aParams){
    global $con, $common, $connexion, $fieldList;
    //recuperation du max idenquete
    $sqlNumero = "select max(idenquete) as lastid from Enquete_details ";
    $idenquete = null;
    
    $res = odbc_exec($con, $sqlNumero);
    while(odbc_fetch_array($res)) {
        $idenquete = odbc_result($res, 'lastid') + 1;
    }
    
    $sql = "INSERT into Enquete_details  ";
    $valueClause = array();
    $fieldChange = array();
    if(empty($aParams) || empty($idenquete)) {
        return json_encode(array('code' => 400, 'message' => "Des parametres sont necessaires", 'data' =>  null));
        die;
    }
    $valueClause[] = "`idenquete`";
    $fieldChange[] = " '" . $idenquete . "' ";
    //unset($aParams['func']);
    foreach($aParams as $field => $value){
        if(!empty($value) && in_array($field, $fieldList)){
            $valueClause[] = "`" . $field . "`";
//             $value = str_replace("'" , "''", $value);
            $fieldChange[] = "' " . $value . "' ";
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


function deleteEnquete($aParams){
    global $con, $common, $connexion;
    $sql = "delete from Enquete_details ";
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

function checkEnquetebyNumeros($aParams = array()) {
    global $con, $common, $connexion;
    
    $sql = "select * from Enquete_details where 1 ";
    if(empty($aParams['numero'])){
        return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
    }
    if(!empty($aParams['numero'])) {
        $sql .= "and numero = " . $aParams['numero'];
    }
    
    //$sql = "select * from Enquete where numero = 169205 ";
    
    
    $res = odbc_exec($con,$sql);
    $aData = $common->fetch2DArray($res, true);
    //var_dump(json_encode($aData), json_last_error_msg ());die;
    $connexion->closeConnexion($con);
    
    return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));
    
}

function checkEnquetebyNumero($aParams = array()) {
    global $con, $common, $connexion;
    
    $sql = "select * from Enquete where 1 ";
    if(empty($aParams['numero'])){
        return json_encode(array('code' => 400, 'message' => "Veuillez renseigner les parametres necessaires", 'data' =>  null));
    }
    if(!empty($aParams['numero'])) {
        $sql .= "and numero = " . $aParams['numero'];
    }
    
    //$sql = "select * from Enquete where numero = 169205 ";
    
    
    $res = odbc_exec($con,$sql);
    $aData = $common->fetch2DArray($res, true);
    //var_dump(json_encode($aData), json_last_error_msg ());die;
    $connexion->closeConnexion($con);
    
    return json_encode(array('code' => 200, 'message' => count($aData) . " enregistrement trouvé", 'data' =>  $aData));

}

function AddAllcolumnsEnquetedetails($aParams = array()) {
    global $con, $common, $connexion;
    
    $sql = "ALTER TABLE Enquete_details ADD COLUMN q1 TEXT(225),
q1c1 TEXT(225),
q1c1r TEXT(225),
q1c1r1 TEXT(225),
q1c2 TEXT(225),
q1c2r TEXT(225),
q1c2r2 TEXT(225),
q2 TEXT(225),
q2c1 TEXT(225),
q2c1r TEXT(225),
q2c1r1 TEXT(225),
q2c2 TEXT(225),
q2c2r TEXT(225),
q2c2r2 TEXT(225),
q2c3 TEXT(225),
q2c3r TEXT(225),
q2c3r3 TEXT(225),
q2c4 TEXT(225),
q2c4r TEXT(225),
q2c4r4 TEXT(225),
q3 TEXT(225),
q3c1 TEXT(225),
q3c1r TEXT(225),
q3c1r1 TEXT(225),
q3c2 TEXT(225),
q3c2r TEXT(225),
q3c2r2 TEXT(225),
q3c3 TEXT(225),
q3c3r TEXT(225),
q3c3r3 TEXT(225),
q3c4 TEXT(225),
q3c4r TEXT(225),
q3c4r4 TEXT(225),
q4 TEXT(225),
q4c1 TEXT(225),
q4c1r TEXT(225),
q4c1r1 TEXT(225),
q4c2 TEXT(225),
q4c2r TEXT(225),
q4c2r2 TEXT(225),
q5 TEXT(225),
q5c1 TEXT(225),
q5c1r TEXT(225),
q5c1r1 TEXT(225),
q5c2 TEXT(225),
q5c2r TEXT(225),
q5c2r2 TEXT(225),
q6 TEXT(225),
q6c1 TEXT(225),
q6c1r TEXT(225),
q6c1r1 TEXT(225),
q6c2 TEXT(225),
q6c2r TEXT(225),
q6c2r2 TEXT(225),
q6c3 TEXT(225),
q6c3r TEXT(225),
q6c3r3 TEXT(225),
q6c4 TEXT(225),
q6c4r TEXT(225),
q6c4r4 TEXT(225),
q7 TEXT(225),
q7c1 TEXT(225),
q7c1r TEXT(225),
q7c1r1 TEXT(225),
q8 TEXT(225),
q8c1 TEXT(225),
q8c1r TEXT(225),
q8c1r1 TEXT(225),
q8c2 TEXT(225),
q8c2r TEXT(225),
q8c2r2 TEXT(225),
q8c3 TEXT(225),
q8c3r TEXT(225),
q8c3r3 TEXT(225),
q8c4 TEXT(225),
q8c4r TEXT(225),
q8c4r4 TEXT(225),
q9 TEXT(225),
q9c1 TEXT(225),
q9c1r TEXT(225),
q9c1r1 TEXT(225),
q9c2 TEXT(225),
q9c2r TEXT(225),
q9c2r2 TEXT(225),
q9c3 TEXT(225),
q9c3r TEXT(225),
q9c3r3 TEXT(225),
q10 TEXT(225),
q10c1 TEXT(225),
q10c1r TEXT(225),
q10c1r1 TEXT(225) ";
    
    $res = odbc_exec($con,$sql);
    $aData ="ok";
    $connexion->closeConnexion($con);
    
    return json_encode(array('code' => 200, 'message' => count($aData) . " Colonnes ajoutés", 'data' =>  $aData));
    
}






?>