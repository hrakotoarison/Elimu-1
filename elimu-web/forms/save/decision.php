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
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody><tr>
			<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200">&nbsp;D�cision Conseil</TD>
<TD width="30" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="1"><SELECT NAME="libelle" id="libelle1" required
placeholder="Selectionner" autofocus/ >
<OPTION  value="Admis(e) en classe sup�rieure">Admis(e) en classe sup�rieure</OPTION>
<OPTION value="Autoris�(e) � redoubler en cas d`echec">Autoris�(e) � redoubler en cas d`echec</OPTION>
<OPTION value="Redouble">Redouble</OPTION>
<OPTION value="Propos�(e) pour l'exclusion  en cas d`echec">Propos�(e) pour l'exclusion  en cas d`echec</OPTION>
<OPTION value="Propos�(e) pour l'exclusion"> Propos�(e) pour l'exclusion</OPTION>
<OPTION value="Doit subir un examen de passage"> Doit subir un examen de passage</OPTION>

</OPTION>

</SELECT></TD>
</TR>

<TR><TD class=petit>&nbsp;</TD></TR>
<tr>
	 <TD width="200" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2">Niveau Etude</TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr>       
  <?php $sqlstm2d="select  distinct idetude,libelle from etudes where cycle='MOYEN' or cycle='SECONDAIRE' ORDER BY libelle";
$req2d=mysql_query($sqlstm2d);

while($ligne2d=mysql_fetch_array($req2d))
{
$slib2d=$ligne2d['libelle'];
$idetude=$ligne2d['idetude'];
//$stock2=$ligne2['qtestock'];

?>
<td>
<INPUT type="checkbox" name="choix[]" value="<?php echo $idetude;?>"> <?php echo $slib2d;?>
</td>

  <?php
}
?></tr>
 <tr>
		              <td width="200">Note Minimale*</td><td>
		              <input name="mini" type="text" size="10"   onkeyup="verif_nombre(this);" required></td>
		            </tr>

<TR><TD class=petit>&nbsp;</TD></TR>
 <tr>
		              <td width="200">Note Maximale*</td><td>
		              <input name="maxi" type="text" size="10" onkeyup="verif_nombre(this);" required></td>
		            </tr>


	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td>&nbsp; </td><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
save_decision();

?>