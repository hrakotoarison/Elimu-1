<?php
session_start();
$rechtab="notes_eleveabsent";
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
if (isset($_GET["sup"])) {
  $titre="  Le Cahier d'Absence de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/notes_eleveabsent.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Modification" ;
   $pageint="forms/update/notes_eleveabsent.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Le Cahier d'Absence de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/notes_eleveabsent.php";
}
else {
      $titre=" Notes Evaluation ELéves Absents pour la ".$classe."  >> Ajout" ;	 
         $pageint="forms/save/notes_eleveabsent.php";
		}

$p="";
$uno=0;
$dos=1;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
