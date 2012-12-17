<?php

  include"../dao/connection.php";
 // base("gescosen");

if (isset($_POST["code"])) {
   //$nom_complet=$_POST["nom_complet"];
   $code=$_POST["code"];
   $libelle=$_POST["libelle"];
   $dd=$_POST["date_d"];
   $df=$_POST["date_f"];
    $annee=$_POST["annee_a"];
	//echo $code."--".  $libelle."**-".$dd."//". $df.  $annee;
   //include"connect.php";
   $req=mysql_query("truncate table semestres");
   $req_insert="insert into semestres values('$code','$libelle',STR_TO_DATE( '$dd','%d/%m/%Y'),STR_TO_DATE( '$df','%d/%m/%Y'),'$annee')";
   $exe_req_insert=mysql_query($req_insert) or die(mysql_error());
   header("Location:profile.php");
}
else {
   header("Location:design1.php");
}
?>

