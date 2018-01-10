<?php 
session_start();

if(!isset($_SESSION['note'.$numtest])){
$_SESSION['note'.$numtest] = 0;
}
$numtest=$_POST["numerotest"];
$nomtest=$_POST["testnom"];
$num = $_POST["numquestion"];
$temps= $_POST["time"];
$_SESSION["time"] = $temps;
$_SESSION['iteration'.$numtest] = $_SESSION['iteration'.$numtest] + 1;

if($_POST["choix"]==$_SESSION["reponse"]){
    $_SESSION['note'.$numtest] = $_SESSION['note'.$numtest] +1 ;
}
if($num==50){
    header("Location: note.php?numerodossiertest=$numtest&nomtest=$nomtest");
}
else{    
header("Location: question.php?numerodossiertest=$numtest&nomtest=$nomtest");
}


?>