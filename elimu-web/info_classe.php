<?php
session_start();
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$titre="  Classe ".$_SESSION["classe"]." >> INFOS CLASSE" ;
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