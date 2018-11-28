<?php 
session_start ();

// if (!isset($_SESSION['numero'])){
//     header('Location: index.php');
// }
$_SESSION['numero'] = $_GET['numero'];
$_SESSION['numerodossier'] = $_GET['numero'];
$_SESSION['nomStagiaire'] = $_GET['nom'];
$_SESSION['prenomStagiaire'] = $_GET['prenom'];
?>

<?php 
$title="Forma 2+: Stagiaire trouvé";

include ("zones/header.php");
include ("zones/fiche.php");
include ("zones/footer.php");

?>