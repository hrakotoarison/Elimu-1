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
// D�terminer l'ann�e acad�mique pr�c�dente
function preannee_academique(){
 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")-1;
		if( $mois>=10){
		 $aca=$annee1 .'/'. $annee;
		}
		else{
		 $aca=date("Y")-2 .'/'.$annee1;
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
//libelle semestre
function libelle_semestre($semestre){
	$reqse=findByNValue("semestres","id='$semestre'");
	$lignese=mysql_fetch_array($reqse);
	$lisemestre=$lignese['libelle'];
	return $lisemestre;
}
//libelle classe
function libclasse($classe){
$t_classe = findByValue('classes','idclasse',$classe);
	$ch_classe = mysql_fetch_array($t_classe);
	$liclasse=$ch_classe['libelle'];
	return $liclasse;
}
//connaitre le cycle de la classe de l�l�ve
function lcycle($classe){
	$sqletude=findByNValuelib("etudes","cycle","idetude=(select etude from classes where idclasse='$classe')");
	$lig=mysql_fetch_array($sqletude);
	$cycle=$lig['cycle'];
	return $cycle;
	}
// connaitre le niveau �tude de la classe
function niveauE($classe){
	$sqletude=findByNValuelib("classes","etude","idclasse='$classe'");
	$lig=mysql_fetch_array($sqletude);
	$etude=$lig['etude'];
	return $etude;
	}
//v�rifier sil ya note de conduite findByNbreValue
function Econduite($cycle){
	$exess1=findByNValue("conduite","cycle='$cycle'");
	$val=mysql_num_rows($exess1);	
	return $val;
	}
//nbre absence pour le semestre choisi
function absenceeleve($eleve,$annee,$semestre){
	$reqseab=findByNbreValue("cahier_absence","eleve='$eleve' and annee='$annee' and semestre='$semestre'");
	$absence_el = mysql_fetch_row($reqseab);
	$absence=$absence_el[0];
	return $absence;
	}
//nombre retard pour le semestre choisi
function retardeleve($eleve,$annee,$semestre){
	$reqseabr=findByNbreValue("cahier_retard","eleve='$eleve' and annee='$annee' and semestre='$semestre'");
	$retard_el = mysql_fetch_row($reqseabr);
	$retard=$retard_el[0];
	return $retard;
	}
//Effectif de la clase pour l'ann�e en cours
function Effectifclasse($classe,$annee){
	$sqlefclasse=findByNbreValue("inscription","classe='$classe' and annee='$annee' ");
	$ef_classe = mysql_fetch_row($sqlefclasse);
	$nombreel=$ef_classe[0];
	return $nombreel;
	}
//moyenne Semestrielle
function moyennesem($eleve,$annee,$semestre){
	$ss1="select moyenne FROM moyennes WHERE eleve='$eleve' and annee='$annee'and semestre='$semestre'";
	$rs1=mysql_query($ss1);
	$ls1=mysql_fetch_array($rs1);
	$moy=$ls1['moyenne'];
	return $moy;
	}
//v�rifier si l'�l�ve est un redoublant de la classe 
function redoublant($eleve,$classe,$annee){
	$sql1="SELECT redoublant FROM inscription WHERE eleve='$eleve' and classe='$classe' and annee='$annee'";
	$req1=mysql_query($sql1);
	$ligne1=mysql_fetch_array($req1);
	$redouble=$ligne1['redoublant'];	
	return $redouble;
}	
	//v�rifier sil a des notes de composition pour le premier semestre
function verifNcomposotion($eleve,$annee,$classe,$semestre){	
	$reqelesem1=findByNValue("moyennes","moyennes.eleve='$eleve' and semestre='$semestre' and annee='$annee'");
	$nb=mysql_num_rows($reqelesem1);
	return $nb;
	}
//moyenne des controles continus
function moyennecontrole($se,$discipline,$eleve,$classe,$annee){
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$r=mysql_query($s);
$l=mysql_fetch_array($r);
$dv=$l['dv'];
$nt=$l['nt'];
$md=$l['md'];
return $md;
}
//note composition
function notecomposition($classe,$annee,$se,$discipline,$eleve){
$sc="SELECT note FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='COMPOSITION' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
return $nc;
}
// moyenne semestrielle suivant une mati�re donn�e de l'�l�ve
function moyenneuveleve($moyennedevoir,$notecompo){
$ms=($moyennedevoir+$notecompo)/2;
return $ms;
}
//coordonn�es  tuteur suivant la classe	
function coordonneetuteurclasse($classe,$annee){
$sql_selection="SELECT tel_tuteur8,email_tuteur8 FROM eleves WHERE matricule in(select eleve from inscription where classe='$classe' and annee='$annee')";
 	$selection = mysql_query($sql_selection) or die(mysql_error());
 	return $selection;
}
//coordonn�es  tuteur suivant l'annee en cours	
function coordonneetuteur($annee){
$sql_selection="SELECT tel_tuteur8,email_tuteur8 FROM eleves WHERE matricule in(select eleve from inscription where  annee='$annee')";
 	$selection = mysql_query($sql_selection) or die(mysql_error());
 	return $selection;
}
//rang 
function rangeleveDiscipline($annee,$semestre,$moyenne,$discipline){
$sqserang ="select count(eleve) nbre from moyennediscipline where  annee='$annee' and semestre='$semestre' and note>'$moyenne' and discipline='$discipline'  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$rg=$rang['nbre']+1;
return $rg;
}
//connaitre le nombr� compos� � une mati�re donn�e
function nombreeleveDiscipline($annee,$semestre,$classe,$discipline){
$sqserang ="select count(eleve) nbre from moyennediscipline where  annee='$annee' and semestre='$semestre'  and discipline='$discipline'and eleve
 in(select eleve from inscription where classe='$classe' and annee='$annee')  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$nbre=$rang['nbre'];
return $nbre;
}
	?>