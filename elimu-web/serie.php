<?php
session_start();
@$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" S�rie >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" S�rie >> Modification" ;
   $pageint="forms/update/serie.php";
}
elseif(isset($_GET["ajout"])) {
     $titre=" S�rie >> Ajout" ;
	/* $table="series";
//$titre="Saisie Agence";
$j="kct";
$sss="ajout";*/
     $pageint="forms/save/serie.php";
}

else {
       $titre=" S�rie >> Consultation" ;
         $pageint="forms/consulter/serie.php";
}
$p="";
$uno=1;
$dos=1;
$trois=1;
$quatre=0;
$cinq=0;
$six=0;
include 'include.php';
?>
