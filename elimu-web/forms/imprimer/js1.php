<?php
include '/../../dao/connection.php';
include '/../../dao/select.php';
$sclasse=securite_bdd($_GET["classe"]);
$code=securite_bdd($_GET["semestre"]);//code du semestre choisi

$annee=annee_academique();
$nb=0;
$t_print='emploi du temps '.$sclasse.$code;
$t_print.='<table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN="center">
<TR>
<td align="center" colspan="1" NOWRAP ><B>HORAIRE</B></td>';

$sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;

$t_print.='<Td align="center" colspan="1" NOWRAP ><FONT color="black" ><B>'. $libellec0.'</B></FONT></Td>';
 
}

$t_print.='</tr>';

 $sqlstm1mel100="select distinct debut ,fin  from emploi_temps where classe='$sclasse' and semestre='$code' and annee='$annee' order by debut";
$req10mu14mel100=mysql_query($sqlstm1mel100);
while($ligne10u14mel100=mysql_fetch_array($req10mu14mel100))
{
$t_print.='<tr>';
	$debut=$ligne10u14mel100['debut'];
	$fin=$ligne10u14mel100['fin'];

	$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];
	$t_print.='<td align="center" ROWSPAN="1" NOWRAP >'.$d.' - '.$fi.'</td>';

	$horaire=$d.' - '.$fi;
	// $sqlstm1gaz100="select id from jours  order by id";
	//choisir les jours
	$req10mu14gaz100=findBylib("jours","id");
	while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
	{
		$jour=$ligne10u14gaz100['id'];
		//selectionner le planning pr�vu suivant le jour choisi
		$req10mu141000=findByNValue("emploi_temps","jour='$jour' and debut='$debut' and fin='$fin' and classe='$sclasse' and semestre='$code' and annee='$annee'");
		$ligne10u141000=mysql_fetch_array($req10mu141000);
		$dis=$ligne10u141000['discipline'];
		$sal=$ligne10u141000['salle'];
		$naturee = findByValue('salles','id',$sal);
		$entitee = mysql_fetch_row($naturee);
		$salle=$entitee[1];
		$nature = findByValue('disciplines','iddis',$dis);
		$entite = mysql_fetch_row($nature);
		$discipline=accents($entite[1]);

		if(mysql_num_rows($req10mu141000)==0){
			$t_print.='<td ALIGN="center" ROWSPAN="1" NOWRAP >-</td>';
			$cours="-";
		}
		else{
			$cours= $discipline.'<br/>'.$salle;
			$t_print.='<td ALIGN="center" ROWSPAN="1" ><FONT color= "black" >'. UcFirstAndToLower($discipline).'<br/>'.$salle.'&nbsp;</FONT></td>';
		}							
	}

	$t_print.="</tr>";
}

$t_print.='</table>';
//echo $t_print;


  require_once(dirname(__FILE__).'/../../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
		$html2pdf->pdf->IncludeJS("print(true);");
        $html2pdf->writeHTML($t_print	);
        $html2pdf->Output('uno.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	