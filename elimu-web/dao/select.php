<?php
 function add_heures($heure1,$heure2){	
$secondes1=heure_to_secondes($heure1);
	$secondes2=heure_to_secondes($heure2);
	$somme=$secondes1+$secondes2;
	//transfo en h:i:s
	$s=$somme % 60; //reste de la division en minutes => secondes
	$m1=($somme-$s) / 60; //minutes totales
	$m=$m1 % 60;//reste de la division en heures => minutes
	$h=($m1-$m) / 60; //heures
	//$resultat=$h."H ".$m."mn ".$s."s";
	$resultat=$h.":".$m;
	return $resultat;
}
function heure_to_secondes($heure){
	$array_heure=explode(":",$heure);
	$secondes=3600*$array_heure[0]+60*$array_heure[1];
	return $secondes;
}

function findByAll($table){

	$sql_selection = "select * from ".$table." ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//compter le nombre de données
function findByNbreValue($table,$condition){

	$sql_selection = "select count(*) from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection du libellé
function findBylib($table,$libelle){

	$sql_selection = "select distinct $libelle from ".$table." ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
 // select disitinct $libelle 	avec condition <>
 function findNBylib($table,$libelle,$champ,$condition){

	$sql_selection =  "select distinct $libelle from ".$table." where ".$champ." <> '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection libelle avec plusieurs conditions
function findByNValuelib($table,$libelle,$condition){
$sql_selection = "select  distinct $libelle from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection  avec un seul parametre
function findByValue($table,$champ,$condition){

	$sql_selection = "select * from ".$table." where ".$champ." = '".$condition."' ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//select avec plusieurs parametres
function findByNValue($table,$condition){
$sql_selection = "select * from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}

function findNByValue($table,$champ,$condition){

	$sql_selection = "select * from ".$table." where ".$champ." <> '".$condition."' ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}

//selection multiple de dossier

function findByAll_dossier(){

	$sql_selection = "select * from dossier ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}

//selection d'un dossier

function findByValue_dossier(){
	$sql_selection = "select * from dossier ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;}


//selection user


function findByAll_user(){

	$sql_selection = "select * from user ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;


}


//selection classeur


function findByAll_classeur(){

	$sql_selection = "select * from classeur ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;

}



//selection etagiaire


function findByAll_etagiare(){

	$sql_selection = "select * from etagiare ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;

}


//selection rayon


function findByAll_rayon(){
	$sql_selection = "select * from rayon ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;

}


//selection nature


function findByAll_nature(){
	$sql_selection = "select * from nature ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;

}


//selection gestionnaire


function findByAll_gestionnaire(){

	$sql_selection = "select * from gestionnaire ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;

}


//selection proprietaire


function findByAll_proprietaire(){

	$sql_selection = "select * from proprietaire ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;

}

function findByAll_migration(){

	$sql_selection = "select * from migration ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}



?>