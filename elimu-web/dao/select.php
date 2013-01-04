<?php
// r�cup�ration du  lien des fichiers
function lien(){
 $url = $_SERVER['REQUEST_URI'];
    if (substr($url, 0, 7)!=='http://') {
        $url = 'http://'.$_SERVER['HTTP_HOST'];
        if (ISSET($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!=80) $url.= ':'.$_SERVER['SERVER_PORT'];
        $url.= $_SERVER['REQUEST_URI'];
    }
	return $url;
}
// fonction de conversion des accents 
function accents($valeur){ 
$val=str_replace(utf8_encode('�'), '&Ccedil;', $valeur);
$val=str_replace(utf8_encode('�'), '&Eacute;', $val);
$val=str_replace(utf8_encode('�'), '&Agrave;', $val);
$val=str_replace(utf8_encode('�'), '&Acirc;', $val);
$val=str_replace(utf8_encode('�'), '&Icirc;', $val);
$val=str_replace(utf8_encode('�'), '&Egrave;', $val);
$val=str_replace(utf8_encode('�'), '&Ecirc;', $val);
$val=str_replace(utf8_encode('�'), '&Ocirc;', $val);
$val=str_replace(utf8_encode('�'), '&Ucirc;', $val);
$val=str_replace(utf8_encode('�'), '&Ugrave', $val);
$val=str_replace(utf8_encode('�'), '&Iuml;', $val);

$val=str_replace(utf8_encode('�'), '&ccedil;', $valeur);
$val=str_replace(utf8_encode('�'), '&eacute;', $val);
$val=str_replace(utf8_encode('�'), '&agrave;', $val);
$val=str_replace(utf8_encode('�'), '&acirc;', $val);
$val=str_replace(utf8_encode('�'), '&icirc;', $val);
$val=str_replace(utf8_encode('�'), '&egrave;', $val);
$val=str_replace(utf8_encode('�'), '&Ecirc;', $val);
$val=str_replace(utf8_encode('�'), '&ocirc;', $val);
$val=str_replace(utf8_encode('�'), '&ucirc;', $val);
$val=str_replace(utf8_encode('�'), '&ugrave', $val);
$val=str_replace(utf8_encode('�'), '&iuml;', $val);

return $val;
}
//D�terminer l'ann�e acad�mique en cours 
function annee_academique(){
 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")+1;
		if( $mois>=10){
		 $aca=$annee .'/'. $annee1;
		}
		else{
		 $aca=date("Y")-1 .'/'.$annee;
		}
		return $aca;
}

function findByAll($table){

	$sql_selection = "select * from ".$table." ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//compter le nombre de donn�es
function findByNbreValue($table,$condition){

	$sql_selection = "select count(*) from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection du libell�
function findBylib($table,$libelle){

	$sql_selection = "select distinct $libelle from ".$table." order by $libelle ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
 // select disitinct $libelle 	avec condition <>
 function findNBylib($table,$libelle,$champ,$condition){

	$sql_selection =  "select distinct $libelle from ".$table." where ".$champ." <> '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
 // select disitinct $libelle 	avec condition =
 function findCBylib($table,$libelle,$champ,$condition){

	$sql_selection =  "select distinct $libelle from ".$table." where ".$champ." = '".$condition."' ;";
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
//selection *  avec un seul parametre
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
//fonction de cotrole des donn�es r�cup�r�es
function securite_bdd($string)	{
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		// Pour tous les autres types
		else
		{
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		
		return $string;
	}
//fonction de connection des utilisateurs
function user_connect($login,$profil){
$executer=findByNValue("user","login1='$login' and profile5='$profil' and cdeetud in (select distinct matricule from personnels where enable8='1')");
$ligne=mysql_fetch_array($executer);
	$pas= $ligne['motdepasse7'];
	$matricule= $ligne['cdeetud'];
$perso=$pas.'*'.$matricule;
return $perso;
}
//connaitre le dernier jour de mise a jour des infos de l'utilisateur
function user_miseinfo($matricule,$profil){
$affichec="select max(date_connect) dc from connecter where personnel='$matricule' and profile='$profil' ";
$executerc=mysql_query($affichec);
$n=mysql_num_rows($executerc);
$lignec=mysql_fetch_array($executerc);
	$date_c= $lignec['dc'];
$a=substr($date_c,0,4);
$m=substr($date_c,5,2);
$j=substr($date_c,8);
$today = mktime(0,0,0, $m,$j,$a);
$today += (3600 * 24 * 7 );
// 1h * 24 = 1 jour
$ladate = date("Y-m-d ", $today);
$info_con=$ladate.'/'.$n;
return $info_con;
}
//metre la 1er lettre en Majuscule
function UcFirstAndToLower($str){     
return ucfirst(strtolower(trim($str)));}	

	
	?>