<?php
//r�cup�ration l'adresse navigateur
 $url = $_SERVER['REQUEST_URI'];
    if (substr($url, 0, 7)!=='http://') {
        $url = 'http://'.$_SERVER['HTTP_HOST'];
        if (ISSET($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!=80) $url.= ':'.$_SERVER['SERVER_PORT'];
        $url.= $_SERVER['REQUEST_URI'];
    }
$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];
$profile=$_SESSION["profil"];
if($profile=="Administrateur"){
$req2d=findBylib("categories","cycle");
}
else{
$req2d=findCBylib("fonction","cycle","profile",$profile);
}
  $req2=findBylib("series","libelle1");
$req22=findByAll("filieres");
 ?>
<script>
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9\.]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
if(champ.value.charAt(x) == "."){points++;} /* Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>
<form name="inscription_form" action="<?php echo $url?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody>
			<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200">&nbsp;Liste Des Cycles <SELECT NAME="libelle1" id="libelle1" required
placeholder="Selectionner" autofocus/  onchange="submit();" >
<OPTION >Selectionner</OPTION>
 <?php
while($ligne2d=mysql_fetch_array($req2d))
{
$slib2d=$ligne2d['cycle'];
 echo' <OPTION value="'.$slib2d.'">'.$slib2d;
 }
 echo'</OPTION>';
  if(@$_POST["libelle1"]<>"") {
 $discipline=$_POST["libelle1"];
 
  echo'
  <TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR>
  <tr>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP>&nbsp;Cycle&nbsp;<INPUT id="Le Stock de D�part" name="stock"   value="'.$discipline.' " SIZE="50" MAXLENGTH="100" disabled="disabled" ></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
';

if($discipline=='PRESCOLAIRE'){
echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="GARDERIE ENFANTS" checked> GARDERIE ENFANTS
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="PETITE SECTION" > PETITE SECTION
</td></TR>
<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="MOYENNE SECTION" > MOYENNE SECTION
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="GRANDE SECTION" > GRANDE SECTION
</td></TR>
';
}
elseif($discipline=='ELEMENTAIRE'){
echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CI" checked> CI</td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>Classe de D�part
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CP"> CP</td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>Classe Sup�rieure de CI
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CE1" > CE1</td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>Classe Sup�rieure de CP
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CE2" > CE2</td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>Classe Sup�rieure de CE1
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CM1" > CM1</td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>Classe Sup�rieure de CE2
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CM2" > CM2</td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>Classe Sup�rieure de CM1
</td></TR>
';
}
elseif($discipline=='MOYEN'){

echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="6i�me" checked> 6i�me
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="5i�me" > 5i�me
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="4i�me" > 4i�me
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="3i�me" > 3i�me
</td></TR>';
}
elseif($discipline=='SECONDAIRE'){
echo'
<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP><INPUT type="checkbox" name="choix[]" value="2nd" checked> 2nd
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP><INPUT type="checkbox" name="choix[]" value="1er" > 1er
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP><INPUT type="checkbox" name="choix[]" value="Tle"> Tle
</td></TR>

<TR>
<TD width="70" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2">S�rie * <SELECT NAME="serie" required>
<OPTION value=""></OPTION>';
  


while($ligne2=mysql_fetch_array($req2))
{
$slib2=$ligne2['libelle1'];
echo'
  <OPTION value="'.$slib2.'">'.$slib2;
  }
echo'

 </OPTION>

</SELECT></TD>

</TR>
';
}
elseif($discipline=='PROFESSIONNEL'){
echo'</TR><td>
<INPUT type="checkbox" name="choix[]" value="L1" checked> L1
</td></TR><TR><td>
<INPUT type="checkbox" name="choix[]" value="L2" > L2
</td></TR><TR><td>
<INPUT type="checkbox" name="choix[]" value="L3" > L3
</td></TR><TR><td>
<INPUT type="checkbox" name="choix[]" value="M1" > M1
</td></TR><TR><td>
<INPUT type="checkbox" name="choix[]" value="M2" > M2
</td></TR><TR><td>
<INPUT type="checkbox" name="choix[]" value="DOCTORAT" > DOCTORAT
</td></TR>
<TR><TD class=petit>&nbsp;</TD></TR> <TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD width="70" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2">Fili�res * &nbsp;&nbsp;&nbsp;&nbsp;<SELECT NAME="filiere"  id="Fili�re" required>

<OPTION  value=""></OPTION>';


while($ligne2=mysql_fetch_array($req22))
{
$slib2=$ligne2[1];
$code=$ligne2[0];
//$stock2=$ligne2['qtestock'];
echo'
  <OPTION value="'.$code.'">'.$slib2;
  
}
echo'

 </OPTION>

</SELECT></TD>

</TR>
';
}
echo'</TR>
<TD class=petit>&nbsp;<input type=hidden name="cycle" value="'. $discipline.'"></TD>
 <TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />';
}
?>


</SELECT></TD>
</TR>

<TR><TD class=petit>&nbsp;</TD></TR>

	</tbody>
	</table>
</div>

</form>

<?php
if (isset($_POST["enregistrer"]) and isset($_POST["cycle"]) ) {
save_etude();
}
?>