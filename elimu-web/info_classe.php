<?php
session_start();
include 'all_function.php';
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
$titre="  Classe ".$classe." >> INFOS CLASSE" ;
$pageint="forms/info_classe.php";
$p="";
$uno=0;
$dos=0;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
include 'include.php';
?>
