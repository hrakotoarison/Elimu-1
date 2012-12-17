<?php
/*
$first_name = $_POST['first_name'];
$first_name = htmlentities($first_name);
echo $first_name;

header('Content-Type: text/html; charset=iso-8859-1');*/

header('Content-Type: text/html; charset=UTF-8');
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
$matricule =$_POST['CLASSE_ID'];
$annee=annee_academique();
echo'	<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Classes *&nbsp; </B></TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr> ';      
 $table = 'classes';
				 
				 $selection = findByNValue($table,"etude in(select libelle from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='SURVEILLANT')) and
				 libelle not in(select classe from surveiller where personnel<>'$matricule'and annee='$annee')");
				while($ligne2d=mysql_fetch_row($selection))
{
$slib2d=$ligne2d['2'];
$cl=$slib2d;
$table1 = 'surveiller';
$prof = findByNValue($table1,"annee='$annee' and personnel='$matricule' and classe='$slib2d'");
						$pval = mysql_fetch_row($prof);
						$cy=$pval[1];
						if($cy=="")
						$valu='';
						else
						$valu='checked';

echo'
<td>
<INPUT type="checkbox" name="choix[]" value="'.$cl.'" '.$valu.'>'.$slib2d.'
</td>';
 
}

ECHO'

<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</tr></TR>';
				
}
/*if ($idsel<>"AUTRES") {
ECHO'</tr></TR>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Pseudo * </B><input name="pseudo" type="text"  id="pseudo" required>
<B>&nbsp;PassWord *</FONT></B><input name="passe" type="password" id="password" required>';
$titre="Emetteur";	
}$etagiaire = findByValue('fonction','personnel',$p1);
						$champ = mysql_fetch_row($etagiaire);
						$p8=$champ[1];

$other="Expéditeur";*/

?>