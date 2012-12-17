<?php
 include"../dao/connection.php";
//base("gescosen");
if (isset($_POST["formule"])) {
   $libelle=$_POST["formule"];
   $array_heure=explode("/",$libelle);
	$val=$array_heure[1];

    $conduite=@$_POST["conduite"];
    $req=mysql_query("truncate table formules");
   $req_insert="insert into formules values('$libelle','$val')";
   $exe_req_insert=mysql_query($req_insert) or die(mysql_error());
   if($conduite<>'NON' and $conduite<>''){
   $cycle='MOYEN';
    $reqc=mysql_query("truncate table conduite");
   $req_insertc='insert into conduite values("'.$cycle.'")';
   $exe_req_insertc=mysql_query($req_insertc) or die(mysql_error());
   }
   
   header("Location:users.php");
	}
	

else {
   header("Location:admin.php");
}


?>
