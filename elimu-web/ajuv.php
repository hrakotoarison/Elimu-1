<?php
header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=iso-8859-1');
include 'all_function.php';
if(isset($_POST['PROF_ID']) and isset($_POST['MAT']) )
{
$discipline =$_POST['MAT'];
$matricule =$_POST['PROF_ID'];
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'	<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Classes *&nbsp; </B></TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr>       '; 
	   //echo'dis '.utf8_encode('Ç');
$sqlstm2d="select  distinct libelle from classes where 
  classes.etude in(select etude from credit_horaire where  discipline='".$discipline."' and credit_horaire.etude in 
  (select libelle from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='PROFESSEUR')) and credit_horaire>0) and
  libelle not in(select classe from enseigner where personnel<>'$matricule'and annee='$annee' and discipline='".$discipline."')  ORDER BY libelle";
$req2d=mysql_query($sqlstm2d);

while($ligne2d=mysql_fetch_array($req2d))
{
$slib2d=$ligne2d['libelle'];
/*
$sqls="select * from disciplines where  libelle='".accents($discipline)."' and disciplines.etude=(select etude from classes where libelle='".$slib2d."') ";
$req=mysql_query($sqls);
$ligne=mysql_fetch_row($req);
$sss=$ligne[0];*/
//echo'teste  '.$slib2d;


//$table1 = 'enseigner';
$sql_selection =" select count(*) nb from enseigner where annee='$annee' and personnel='$matricule' and classe='".$slib2d."' and discipline ='".$discipline."'";
$executer=mysql_query($sql_selection);
while($ligne0=mysql_fetch_array($executer))
{
	$cy= $ligne0['nb'];//echo'<br/>';
	//$matricule= $ligne['cdeetud'];
}
				//	echo'enseigner'.$cy;
						if($cy==0)
						$valu='';
						else
						$valu='checked';

echo'<tr><td><INPUT type="checkbox" name="choix[]" value="'.$slib2d.'" '.$valu.'>'.$slib2d.'
</td></tr>';
}
}
?>