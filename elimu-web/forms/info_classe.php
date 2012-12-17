<? //require("dao/connection.php");
$sclasse=$_GET['num'];
$annee=annee_academique();
//$agence=$_SESSION["agence"];

?>
<form name="inscription_form" action="<?php echo 'info_classe.php';?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">

<table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=left>
<tbody>

<TR>
<TD align=center colspan=3 NOWRAP  bgcolor="yellow"><FONT COLOR="#033155"><B>&nbsp;Les Matiéres Enseignées&nbsp;</B></FONT></TD>
</tr>
<TR>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Disciplines&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Professeur&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Coéfficient&nbsp;</B></FONT></TH>
</TR>
<?php
$sqlstm1="SELECT personnel,discipline FROM enseigner WHERE classe='".htmlentities($sclasse)."' and annee='$annee'";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
$prof=$ligne['personnel'];
$mati=$ligne['discipline'];

 $uvs = findByValue('disciplines','iddis',$mati);
						$mat = mysql_fetch_row($uvs);
						$uv=$mat[1];


$sqlstm3="select titre8,prenom,nom from personnels where matricule='$prof'";
$req3=mysql_query($sqlstm3);
$ligne3=mysql_fetch_array($req3);

$titre=$ligne3['titre8'];
$prenom=$ligne3['prenom'];
$nom=$ligne3['nom'];
 $titres = findByValue('titre5','id',$titre);
						$tit = mysql_fetch_row($titres);
						$tre=$tit[1];
$sqlstm3e="select etude from classes where libelle='".htmlentities($sclasse)."'";
$req3e=mysql_query($sqlstm3e);
$ligne3e=mysql_fetch_array($req3e);
$etude=$ligne3e['etude'];

$sqlstm3c="select coef from coefficients where discipline='$mati' and etude='$etude'";
$req3c=mysql_query($sqlstm3c);
$ligne3c=mysql_fetch_array($req3c);
$coef=$ligne3c['coef'];

?>


<TR>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP><?echo $uv;?>&nbsp;</TD>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP>&nbsp;<?echo $tre.' '.$prenom.' '.$nom;?>&nbsp;</TD>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP>&nbsp;<?echo $coef;?>&nbsp;</TD>
</TR>

<?
}
$sqlstm3u8="select count(eleve) effectif from inscription where classe='".htmlentities($sclasse)."' and annee='$annee'";
$req3u8=mysql_query($sqlstm3u8);
$ligne3u8=mysql_fetch_array($req3u8);

$effect=$ligne3u8['effectif'];
?>
</TABLE>
<table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=center>
<TR>
<?
if(mysql_num_rows($req3u8)==0){
echo'<TD align=center colspan=2 NOWRAP  bgcolor="yellow"><FONT COLOR="#80FF00"><B>&nbsp;Effectid de la classe:-</TD>';
}//$svent=$svent+@$nombre;
else{

?>
<TD align=center colspan=2 NOWRAP  bgcolor="yellow"><FONT COLOR="blue"><B>&nbsp;Effectif de la classe: <?echo $effect?>&nbsp;</B></FONT></TD>
<?
}
$sqlstmm="select count(eleve) effectif from inscription where classe='".htmlentities($sclasse)."' and annee='$annee' and eleve in ( select matricule from eleves where sexe8='1')";
$reqm=mysql_query($sqlstmm);
$lignem=mysql_fetch_array($reqm);

$effectm=$lignem['effectif'];

$sqlstmf="select count(eleve) effectif from inscription where classe='".htmlentities($sclasse)."' and annee='$annee'and eleve in ( select matricule from eleves where sexe8='2')";
$reqf=mysql_query($sqlstmf);
$lignef=mysql_fetch_array($reqf);

$effectf=$lignef['effectif'];
if($effect==0)
$div=1;
else 
$div=$effect;
?>

</tr>
<TR>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Filles&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Garçons&nbsp;</B></FONT></TH>
</TR>
<tr>
<td align=center ROWSPAN=1 NOWRAP>&nbsp;<?echo $effectf?>&nbsp; Soit <?echo round($effectf/ $div*100) .'%'?> </td>
<td align=center ROWSPAN=1 NOWRAP>&nbsp;<?echo $effectm?>&nbsp; Soit <?echo round($effectm/ $div*100) .'%'?> </td>
</tr>

</TABLE>
