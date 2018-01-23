<?php 
session_start();


$numtest=$_POST["numerotest"];
$nomtest=$_POST["testnom"];
$num = $_POST["numquestion"];
$temps= $_POST["time"];
$qst= $_POST["quest"];
$rp1= $_POST["r1"];
$rp2= $_POST["r2"];
$rp3= $_POST["r3"];
$rp4= $_POST["r4"];

$_SESSION['Compteur']  = $_POST["cptest"];
$_SESSION["time"] = $temps;
$_SESSION['iteration'.$numtest] = $_SESSION['iteration'.$numtest] + 1;
if(!isset($_SESSION['note'.$numtest])){
    $_SESSION['note'.$numtest] = 0;
}

if($_POST["choix"]==$_SESSION["reponse"]){
    $_SESSION['note'.$numtest] = $_SESSION['note'.$numtest] +1 ;
    
    if($_POST["choix"]==$rp1){
    	$val1=1;
    }
    if($_POST["choix"]==$rp2){
    	$val2=1;
    }
    if($_POST["choix"]==$rp3){
    	$val3=1;
    }
    if($_POST["choix"]==$rp4){
    	$val4=1;
    }
    $notesquest = 1;
}



include('httpful.phar');


$url = "http://extranet.forma2plus.com:808/php/stagiaires/extranet.php?func=Insertresultat";
$data = "&compteur_test=" . urlencode($_SESSION['Compteur']);
$data .= "&question=" . urlencode(($qst));
$data .= "&reponse1=" . urlencode(($rp1));
$data .= "&val_r1=" . urlencode(($val1));
$data .= "&reponse2=" . urlencode(($rp2));
$data .= "&val_r2=" . urlencode(($val2));
$data .= "&reponse3=" . urlencode(($rp3));
$data .= "&val_r3=" . urlencode(($val3));
$data .= "&reponse4=" . urlencode(($rp4));
$data .= "&val_r4=" . urlencode(($val4));
$data .= "&Note_Quest=" . urlencode(($notesquest));
$numeroquest = 100 + $num;
$data .= "&numero=" . urlencode($numeroquest);
$urlEncode = $url.$data;
$response = \Httpful\Request::get($urlEncode)->send();
$jsonResp = $response->body;


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