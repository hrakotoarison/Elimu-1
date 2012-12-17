<?php
include 'all_function.php';
//include "metier/stats.php";
if(isset($_POST['PROF_ID']) and isset($_POST['SEMESTRE_ID']) )
{
$code=$_POST['SEMESTRE_ID'];
$sclasse=accents($_POST['PROF_ID']);
$annee=annee_academique();
$nb=0;
$nomfichier="impression/impression.txt";
      					touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><B>&nbsp;HORAIRE&nbsp;</B></TD>
';
 $sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;

echo'

<Td align=center colspan=1 NOWRAP ><FONT color="black" ><B>&nbsp;'. $libellec0.' &nbsp;</B></FONT></Td>';
 
}

echo'</tr>';
 $sqlstm1mel100="select distinct debut ,fin  from emploi_temps where classe='$sclasse' and semestre='$code' and annee='$annee' order by debut";
$req10mu14mel100=mysql_query($sqlstm1mel100);
while($ligne10u14mel100=mysql_fetch_array($req10mu14mel100))
{
$debut=$ligne10u14mel100['debut'];
$fin=$ligne10u14mel100['fin'];

$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];




echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$d.' - '.$fi.'&nbsp;</B></FONT></TD>';

$horaire=$d.' - '.$fi;
 $sqlstm1gaz100="select id from jours  order by id";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$jour=$ligne10u14gaz100['id'];
$sqlstm11000="select discipline,salle  from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and classe='$sclasse' and semestre='$code' and annee='$annee'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$dis=$ligne10u141000['discipline'];
$sal=$ligne10u141000['salle'];
 $naturee = findByValue('salles','id',$sal);
						$entitee = mysql_fetch_row($naturee);
						$salle=$entitee[1];
 $nature = findByValue('disciplines','iddis',$dis);
						$entite = mysql_fetch_row($nature);
						$discipline=htmlentities($entite[1]);
$cours= $discipline.'<br/>'.$salle;
if(mysql_num_rows($req10mu141000)==0){
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
}
else{
echo'
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP ><A HREF="emplois_classes.php?sup=1'.'&j='. $jour.'&hd='. $debut.'&hf='.$fin.'&num='. $sclasse.'&se='. $code.'"><FONT color= "black" >&nbsp;'. $discipline.'<br/>'.$salle.'&nbsp;</TD>';
}
 $b="$horaire;$cours\r\n";
		                    fwrite($fichier,$b);
							
}

echo"</tr>";
}

echo'</table>';
?>
<div>          
<a href="impression/impression.php?id=<?echo $sclasse;?>&dates=<?echo $annee;?>&page=<?echo 'BILANMENSUEL';?>" target="_blank" class=imp>Apper&ccedil;u</a>
</div>
<?php
}
?>