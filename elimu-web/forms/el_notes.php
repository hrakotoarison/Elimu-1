<?php
$classe=securite_bdd($_GET['num']);
$eleve=securite_bdd($_GET['matricule']);
$annee=annee_academique();
$sqlstmel="SELECT prenom8,nom8 FROM eleves WHERE matricule='$eleve'";
$reqel=mysql_query($sqlstmel);
$ligneel=mysql_fetch_array($reqel);
$prenom=$ligneel['prenom8'];
$nom=$ligneel['nom8'];
//vérifier sil ya note de conduite
	$exess1=mysql_query("select count(*) nb  from conduite where conduite.cycle =(select cycle from etudes where libelle=(select etude from classes where libelle='".htmlentities($classe)."'))");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $val=$roi1["nb"];
				 }
//nbre evaluation absent htmlentities
$sqlstmelea="select count(distinct eleve) cde from notes where notes.eleve='$eleve' and evaluation in(select id from evaluations where annee='$annee'and classe='".htmlentities($classe)."') ";
$reqelea=mysql_query($sqlstmelea);
$ligneelea=mysql_fetch_array($reqelea);
	$nbea=$ligneelea['cde'];
	//vérifier sil a des notes de composition pour le premier semestre
	$sqlstmelesem1="select count(distinct eleve) cde from notes where notes.eleve='$eleve' and evaluation in(select id from evaluations where annee='$annee'and classe='".htmlentities($classe)."' and semestre='S1' and type='COMPOSITION') ";
$reqelesem1=mysql_query($sqlstmelesem1);
$sem1=mysql_fetch_array($reqelesem1);
	$nb1=$sem1['cde'];
	//vérifier sil a des notes de composition pour le SECOND semestre
	$sqlstmelesem1="select count(distinct eleve) cde from notes where notes.eleve='$eleve' and evaluation in(select id from evaluations where annee='$annee'and classe='".htmlentities($classe)."' and semestre='S2' and type='COMPOSITION') ";
$reqelesem1=mysql_query($sqlstmelesem1);
$sem1=mysql_fetch_array($reqelesem1);
	$nb2=$sem1['cde'];
// recup info établissement
$req9=findByAll("etablissements");
$ligne9=mysql_fetch_array($req9);
	$eta=$ligne9['libelle'];
	$ia=$ligne9['ia'];
	$iden=$ligne9['iden'];
	//connaitre le cycle de la classe de lélève
	$sq="select cycle from etudes where libelle=(select etude from classes where libelle='".htmlentities($classe)."' ) ";
$re=mysql_query($sq);
$lig=mysql_fetch_array($re);
	$cycle=$lig['cycle'];
 ?>

<form name="inscription_form" action="<?php echo 'el_notes.php?matricule='.$eleve.'&num='.$classe;?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody><tr>
			<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200">&nbsp;Notes <SELECT NAME="libelle1" id="libelle1" required
placeholder="Selectionner" autofocus/  onchange="submit();" >
<OPTION >Selectionner</OPTION>
 <?php
 if($nbea<>0)
{
 echo' <OPTION value="CARNET"> CARNET DE NOTES</OPTION>';
 }
  if($nb1<>0)
{
 echo' <OPTION value="BULLETINS1"> BULLETIN DU PREMIER SEMESTRE</OPTION>';
 }
  if($nb2<>0)
{
 echo' <OPTION value="BULLETINS2"> BULLETIN DU SECOND SEMESTRE</OPTION>';
 }

  if(@$_POST["libelle1"]<>"") {
 $choix_notes=$_POST["libelle1"];
  $nomfichier="impression/impression.txt";
      				
 if($choix_notes=="CARNET"){ 
 	touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
 ?>
 <tr><TD class=petit>&nbsp;</TD></tr>
 <tr><td>
<table border="1" cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=left>


<TR>
<TD align=center colspan=5 NOWRAP  ><B>&nbsp; Carnet de Notes de l'éléve <?php echo $prenom.' '.$nom;?>&nbsp;</B></TD>
</tr>
<TR>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date Evaluation&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Type&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Note&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Semestre&nbsp;</B></FONT></TH>
</TR>

<?php
$sqlstm1="select id,date_format(date_prevue,'%d/%m/%Y') affi,discipline,type,semestre from evaluations where id in (select evaluation from notes where eleve='$eleve') and annee='$annee' and classe='".htmlentities($classe)."'
order by discipline,semestre,type desc ,date_prevue  ";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
$eva=$ligne['id'];
$date_af=$ligne['affi'];
$dis=$ligne['discipline'];
$type=$ligne['type'];
$se=$ligne['semestre'];
//note evaluation
$sq="SELECT note FROM notes WHERE eleve='$eleve' and evaluation='$eva'";
$re=mysql_query($sq);
$li=mysql_fetch_array($re);
	$note=$li['note'];
	//libelle du semestre
$sq1="SELECT libelle FROM semestres WHERE id='$se'";
$re1=mysql_query($sq1);
$li1=mysql_fetch_array($re1);
	$semestre=$li1['libelle'];
//discipline composée
$sqd="SELECT upper(libelle1) uplib FROM disciplines WHERE iddis='$dis'";
$red=mysql_query($sqd);
$lid=mysql_fetch_array($red);
	$discipline=UcFirstAndToLower(accents($lid['uplib']));

?>
<TD ALIGN=left ROWSPAN=1 NOWRAP><?php echo $date_af;?>&nbsp;</a></TD>

<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo $discipline;?>&nbsp;</a></TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo $type;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo $note;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo $semestre;?>&nbsp;</TD>
</TR>

<?php
$b="$date_af;$discipline;$type;$note;$semestre;\r\n";
              				 fwrite($fichier,$b);
}
  fclose($fichier);
?>

</TABLE>
<div>&nbsp;&nbsp;&nbsp;</div>
<div>          
<a href="impression/impression.php?id=<?php echo $classe;?>&dates=<?php echo $annee;?>&eleve=<?php echo $eleve;?>&page=<?php echo 'CARNET';?>" target="_blank" class=imp>Apper&ccedil;u</a>
</div>
 <?php
 }
 //bulletin du premier semestre
 elseif($choix_notes=="BULLETINS1"){
 	touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
 $se="S1";
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
//journée début  
$sqse="select libelle from semestres where id='S1'   ";
$reqse=mysql_query($sqse);
while($lignese=mysql_fetch_array($reqse))
{
	$semestre=$lignese['libelle'];
	}
$exess1=findByNbreValue("conduite","cycle='$cycle'");
$val=mysql_num_rows($exess1);
				// $val=$roi1["nb"];
				
	//nbre absence
	$sqseab="select count(eleve) nbre from cahier_absence where eleve='$eleve' and annee='$annee' and semestre='S1'";
$reqseab=mysql_query($sqseab);
while($ligneseab=mysql_fetch_array($reqseab))
{
	$absence=$ligneseab['nbre'];
	}
	//nombre retard
		$sqseabr="select count(eleve) nbre from cahier_retard where eleve='$eleve' and annee='$annee' and semestre='S1'  ";
$reqseabr=mysql_query($sqseabr);
while($ligneseabr=mysql_fetch_array($reqseabr))
{
	$retard=$ligneseabr['nbre'];
	}



		$sqe="select count(eleve) nbrel from inscription where classe='".htmlentities($classe)."' and annee='$annee'  ";
$ree=mysql_query($sqe);
while($lige=mysql_fetch_array($ree))
{
	$nombreel=$lige['nbrel'];
	}

$sqlstmel="SELECT prenom8,nom8,date_format(date_nais8,'%d/%m/%Y') dtn,lieu_nais8 FROM eleves WHERE matricule='$eleve'";
$reqel=mysql_query($sqlstmel);
while($ligneel=mysql_fetch_array($reqel))
{
	$prenom=$ligneel['prenom8'];
$nom=$ligneel['nom8'];
$date_n=$ligneel['dtn'];
$lieu=$ligneel['lieu_nais8'];
//$redoublant=$ligneel['redoublant']; '".htmlentities($classe)."'
}
$sql1="SELECT redoublant FROM inscription WHERE eleve='$eleve' and classe='".htmlentities($classe)."' and annee='$annee'";
$req1=mysql_query($sql1);
$ligne1=mysql_fetch_array($req1);
$redoublant=$ligne1['redoublant'];
?>
 <TR>
<TD>
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100% ALIGN=center border="0">
<tr><TD class=petit>&nbsp;</TD></tr>
<TR align=center>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><b><?php echo'MINISTERE DE L\'EDUCATION NATIONALE';?></b></TD>
</tr>
<tr><TD class=petit>&nbsp;</TD></tr>
<TR>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><b><?php echo'IA : '. $ia;?></b></TD><TD ROWSPAN=1  ALIGN=LEFT NOWRAP><b><?php echo'IEF : '. $iden;?></b></TD>
</tr>
<tr><TD class=petit>&nbsp;</TD></tr>
<TR>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><b><?php echo 'ETABLISSEMENT : '.$eta;?></b></TD>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><b><?php echo 'Cycle : '.$cycle;?></b></TD>
</tr>
<tr><TD class=petit>&nbsp;</TD></tr>
<tr>

<TD colspan=30><b>&nbsp;BULLETIN DE NOTES DU <?php echo $semestre." DE L'ANNEE ACADEMIQUE ".$annee?></b></TD>
</tr><tr>
<TD class=petit>&nbsp;</TD>
</TR>
<!--
<TR>

<TD><b><?php echo $cycle;?></b></TD>

<TD class=petit>&nbsp;</TD>
<TD class=petit>&nbsp;</TD>

</TR>!-->

<TR>
<TD  ROWSPAN=1  ALIGN=LEFT NOWRAP colspan=1>&nbsp;Prénom:<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $prenom?></b></TD>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP colspan=5>&nbsp;Nom:<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $nom?></b></TD>


</TR>

<TD ROWSPAN=1  ALIGN=LEFT NOWRAP colspan=20>&nbsp;Date et lieu de Naissance:<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date_n.' à '.accents($lieu);?></b></TD>
<TD class=petit>&nbsp;</TD>
<TD class=petit>&nbsp;</TD>
<TD class=petit>&nbsp;</TD>
<TD class=petit>&nbsp;</TD>
</tr>

<TR>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;Classe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $classe?></b></TD>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;Effectif :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><?php echo $nombreel;?></b></TD>

<TD class=petit>&nbsp;</TD></tr>

<TR>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;Nbre Absence:&nbsp;&nbsp;&nbsp;<b><?php echo $absence?></b></TD>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;Nbre Retard:&nbsp;&nbsp;&nbsp;<b><?php echo $retard?></b></TD>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;Redoublant :&nbsp;&nbsp;&nbsp;<b><?php echo $redoublant;?></b></TD>

</TR>
<tr>
<TD>&nbsp;</TD>
<TD></TD>
 </tr>
</TABLE>

<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width=100 ALIGN=CENTER>
<TR>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Devoir&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Comp&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;M : S&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Coef&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Total Points&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Appréciations&nbsp;</B></FONT></TH>
</TR>
<TR>
<?php
$nc=0;
$div1=1;
//connaitre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where libelle='".htmlentities($classe)."' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where libelle='".htmlentities($classe)."' )");

//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
$discipline=$lignecoef['discipline'];
$coef=$lignecoef['coef'];
$soc=$soc+$coef;

$sqlstm1ds="SELECT upper(libelle1) uplib FROM disciplines WHERE iddis='$discipline'";
$req1ds=mysql_query($sqlstm1ds);
$ligneds=mysql_fetch_array($req1ds);
$dis=$ligneds['uplib'];

?>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo UcFirstAndToLower(accents($dis));?>&nbsp;</A></TD>

<?php
//total devoir + moyenne devoir
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='".htmlentities($classe)."' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$r=mysql_query($s);
$l=mysql_fetch_array($r);
$dv=$l['dv'];
$nt=$l['nt'];
$md=$l['md'];

//note composition

$sc="SELECT note FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='".htmlentities($classe)."' and evaluations.annee='$annee'and
 evaluations.type='COMPOSITION' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
//note conduite

//moyenne semestrielle + total points
/*if($dv=='')
$div1=1;
else
$div1=$dv;*/
$ms=($md+$nc)/2;
$tp=$ms*$coef;
$son=$son+$tp;
//gestion remarque
$sqere="select libelle   from apreciation_prof where eleve='$eleve' and semestre='$se' and discipline='$discipline'
and annee='$annee' ";
$reere=mysql_query($sqere);
$ligere=mysql_fetch_array($reere);
	$rem=$ligere['libelle'];
//gestion appréciation	
$sqeap="select libelle1   from apreciations where mini<='$ms' and maxi>'$ms' ";
$reeap=mysql_query($sqeap);
$ligeap=mysql_fetch_array($reeap);
	$apr=$ligeap['libelle1'];

?>

<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $md;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $nc;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $ms;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $coef;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $tp;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo accents($rem);?>&nbsp;</TD> 
</TR>
<?php
$b="$dis;$md;$nc;$ms;$coef;$tp;$rem;\r\n";
              				 fwrite($fichier,$b);
}
if($val<>0){
$sct="SELECT sum(note),count(personnel),round(sum(note)/count(personnel),3) nt FROM note_conduite WHERE annee='$annee'and semestre='$se'and eleve='$eleve'";
$rct=mysql_query($sct);
$lct=mysql_fetch_array($rct);
$conduite=$lct['nt'];
?><TR>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?phpecho 'CONDUITE';?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?phpecho '';?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?phpecho '';?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?phpecho $conduite;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?phpecho 1;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<?phpecho $conduite;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?phpecho '';?>&nbsp;</TD> 
</TR>
<?php
$tpoint=$son+$conduite;
$tcoef=$soc+1;
$b="CONDUITE;;;$conduite;1;$conduite;;\r\n";
              				 fwrite($fichier,$b);
}
else{
$tpoint=$son;
$tcoef=$soc;
}
$fi=round($tpoint/$tcoef,3);
$sqserang="select count(eleve) nbre from moyennes where  annee='$annee' and semestre='$se' and moyenne>'$fi'  ";
$reqserang=mysql_query($sqserang);
while($rang=mysql_fetch_array($reqserang))
{
	$rg=$rang['nbre']+1;
	}
$place=$rg.'éme/ '.$nombreel.' Eléves';
$b=";;;;;;;\r\n";
 fwrite($fichier,$b);
	$b="Total;;;;$tcoef;$tpoint;;\r\n";
              				 fwrite($fichier,$b);
	
$b="Moyenne Semestrielle;;;;;$fi;;\r\n";
              				 fwrite($fichier,$b);	
 $b=";;;;;RANG;$place;\r\n";
              				 fwrite($fichier,$b);
							 //  fclose($fichier);
?>
<TR >
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo "Total ";?>&nbsp;</A></TD>

<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo '' ;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo'' ;?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<?php echo'' ;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo $tcoef;?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo $tpoint;?>&nbsp;</TD>
</TR>
<TR >
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo "Moyenne Semestrielle ";?>&nbsp;</A></TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo '';?>&nbsp;</TD>
<TD ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo $fi;?>&nbsp;</TD>
</TR>
<TR >

<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo '';?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo "RANG ";?>&nbsp;</TD>
<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;<big><?php echo $rg.'éme/ '.$nombreel.' Eléves';?>&nbsp;</TD>
</TR>
<TR >
<?php
$b=";;;;;;;\r\n";
 fwrite($fichier,$b);
$sqere="select libelle1   from honneurs where mini<='$fi' and maxi>'$fi' ";
$reere=mysql_query($sqere);
while($ligere=mysql_fetch_array($reere)){
	$ho=$ligere['libelle1'];
	
$b="$ho;;;;;;;\r\n";
              				 fwrite($fichier,$b);

echo'<TD ALIGN=left ROWSPAN=1 colspan=2 NOWRAP>&nbsp;<b><big>'. $ho.'</big&nbsp;</A></TD>';
}
$b=";;;;;;;\r\n";
 fwrite($fichier,$b);
//fclose($fichier);
?>
</TR>
<tr>

<td colspan=7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?phpecho  ;?>&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
	<?php
$sqlstm1rq="SELECT libelle1,mini,maxi FROM remarques ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	
	$libellerq=$lignerq['libelle1'];
	$debutrq=$lignerq['mini'];
	$finrq=$lignerq['maxi'];
?>
<td align=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $libellerq?>&nbsp;</FONT></TD>

<?php
$val="X";
$sqlstm11000="select libelle1 quant from remarques where  mini<='$fi' and maxi>'$fi' and libelle1='$libellerq'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$nombre1000=$ligne10u141000['quant'];
if(mysql_num_rows($req10mu141000)==0){
$val="-";
}
?>
<TD ALIGN=left ROWSPAN=1 NOWRAP ><B><big>&nbsp;<?php echo $val;?>&nbsp;</TD>

<?php
//}

echo"</tr>";
$b="$libellerq;$val;;;;;;\r\n";
 fwrite($fichier,$b);

}fclose($fichier);
?>

</TR>
</table>
<div>          
<a href="impression/impression.php?id=<?php echo $classe;?>&dates=<?php echo $annee;?>&eleve=<?php echo $eleve;?>&page=<?php echo 'BULLETINS1';?>" target="_blank" class=imp>Apper&ccedil;u</a>
</div>
 
 <?php
 }
 elseif($discipline=="BULLETINS2"){
 
 }
}
?>


</SELECT></TD>
</TR>

<TR><TD class=petit>&nbsp;</TD></TR>

	</tbody>
	</table>
</div>

</form>
