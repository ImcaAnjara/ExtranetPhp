<?php 
session_start();
// session_unset ();
$numtest=$_GET["numerodossiertest"];
echo($_SESSION['note'.$numtest]);
?>