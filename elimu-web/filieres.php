<?php
session_start();
@$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" S�rie >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" Fili�res >> Modification" ;
   $pageint="forms/update/filieres.php";
}
elseif(isset($_GET["ajout"])) {
     $titre=" Fili�res >> Ajout" ;
	/* $table="series";
//$titre="Saisie Agence";
$j="kct";
$sss="ajout";*/
     $pageint="forms/save/filieres.php";
}

else {
       $titre=" Fili�res >> Consultation" ;
         $pageint="forms/consulter/filieres.php";
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
