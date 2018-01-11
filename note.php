<?php 
session_start();

$numtest=$_GET["numerodossiertest"];
echo($_SESSION['note'.$numtest]);
echo "<br>";
$tps = $_SESSION["tpssec"];
if($tps>=60){
    $min = (int)($tps/60);
    $sec = $tps%60;
}else{
    $min = 0;
    $sec = $tps;
}
echo("temps passé: $min et $sec");
session_unset ();
?>