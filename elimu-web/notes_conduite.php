<?php
session_start();
$rechtab="notes_conduite";
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
if (isset($_GET["sup"])) {
  $titre="  Le Cahier d'Absence de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/notes_conduite.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Modification" ;
   $pageint="forms/update/notes_conduite.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Notes de Conduite pour le Semestre en cours pour la ".$classe." >> Consultation" ;
      $pageint="forms/consulter/notes_conduite.php";
}
else {
      $titre="Notes de Conduite pour le Semestre en cours pour la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/notes_conduite.php";
		}

$p="";
$uno=1;
$dos=1;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>