<?php
session_start();
@$menu=$_SESSION["menu"];
$profile=$_SESSION["profil"];
if (isset($_GET["sup"])) {
  $titre="  co�ffcients des Disciplines  >> Suppression" ;
  $pageint="forms/delete/coefs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="co�ffcients des Disciplines  >> Modification" ;
   $pageint="forms/update/coefs.php";
}
elseif(isset($_GET["vis"])) {
$titre=" co�ffcients des Disciplines    >> Consultation" ;
      $pageint="forms/consulter/coefs.php";
}
else {
      $titre="co�ffcients des Disciplines >> Ajout" ;
	 
         $pageint="forms/save/coefs.php";
		}

$p="";
$uno=1;
$dos=1;
if($profile=="Administrateur")
$trois=1;
else
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
