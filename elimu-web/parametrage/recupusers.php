<?php session_start();

  include"../dao/connection.php";
 // base("gescosen");

if (isset($_POST["pseudo"])) {
   //$nom_complet=$_POST["nom_complet"];
   $passe=$_POST["passe"];
   $cpasse=$_POST["cpasse"];
   $pseudo=$_POST["pseudo"];
   $d="admin";
   //echo $passe."--".$pseudo."*/-".$d;
   $req=mysql_query("truncate table administrateurs");
   $req_insert='insert into administrateurs values("","'.$pseudo.'","'.$passe.'")';
   $exe_req_insert=mysql_query($req_insert) or die(mysql_error());
   header("Location:../accueil.php");
}
else {
   header("Location:../accueil.php");
}
?>

