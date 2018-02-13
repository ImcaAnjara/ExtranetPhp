<?php 

session_start ();

function test($var) {
    $var=trim($var);
    $var=strtolower($var);
    $var=str_replace(" or ","",$var);
    $var=str_replace("=","",$var);
    $var=str_replace(" and ","",$var);
    $var=str_replace("select","",$var);
    $var=str_replace("insert","",$var);
    $var=str_replace("update","",$var);
    $var=str_replace("delete","",$var);
    $var=str_replace("(","",$var);
    $var=str_replace(")","",$var);
    $var=str_replace(";","",$var);
    return $var;
}


// $_SESSION["codeprof"] = "";

$login = test($_POST["nomprof"]);
$password = test($_POST["codeprof"]);

// L'identifiant du tuteur au cas ou il accede par la plateforme Elearning
if(isset($_GET["user_id"]) && $_GET["nom"]){
    $extranet_id = $_GET["user_id"];
    $extranet_nom = $_GET["nom"];
    
    if (($extranet_id != "") && ($extranet_nom != "")) {
        
        $login = $extranet_nom;
        $password = $extranet_id;
        $_SESSION["sso"] = "True";
        
    }
}

$_SESSION['nomprof'] = $login;
$_SESSION['codeprof'] = $password;

header("Location: StagiaireList.php");


?>