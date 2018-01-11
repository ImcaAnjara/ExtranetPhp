<?php 
session_start();


$numtest=$_POST["numerotest"];
$nomtest=$_POST["testnom"];
$num = $_POST["numquestion"];
$temps= $_POST["time"];
$_SESSION["time"] = $temps;
$_SESSION['iteration'.$numtest] = $_SESSION['iteration'.$numtest] + 1;
if(!isset($_SESSION['note'.$numtest])){
    $_SESSION['note'.$numtest] = 0;
}

if($_POST["choix"]==$_SESSION["reponse"]){
    $_SESSION['note'.$numtest] = $_SESSION['note'.$numtest] +1 ;
}
$temps = explode(":",$_SESSION["time"]);
$minutes = (int)$temps[0];
$secondes = (int)$temps[1];

$_SESSION["tpssec"] = (30 * 60 ) - (($minutes *60) + $secondes);
if($num>49){
    header("Location: note.php?numerodossiertest=$numtest&nomtest=$nomtest");
}
else{    
header("Location: question.php?numerodossiertest=$numtest&nomtest=$nomtest");
}


?>