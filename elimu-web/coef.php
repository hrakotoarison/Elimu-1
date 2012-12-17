<script>
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
/*if(champ.value.charAt(x) == "."){points++;}  Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>

<?php
//header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=iso-8859-1');
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
//=$_POST['MAT'];
$discipline =$_POST['CLASSE_ID'];
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=white align=center >
			<th width=100>Niveau Etude</th>
            <th width=200>Co&eacute;fficients</th>            
                     </tr>';



$sqlstm4="select  distinct etude from credit_horaire where discipline='$discipline' and credit_horaire >0 and credit_horaire.etude not in
(select etude from coefficients where discipline='$discipline' )  ORDER BY etude";
$req4=mysql_query($sqlstm4);
$nb=mysql_num_rows($req4);
                  $i=1;
if($nb==0){
echo'insertion impossible car donn&eacute;es d&eacute;ja enregistr&eacute;es';
}
else{				  
while($ligne4=mysql_fetch_array($req4))
{
$niveau=$ligne4['etude'];
$niv=htmlentities($niveau);
  echo" <input name=nbart type=hidden value=$nb>";

      echo"<tr>
			            <td align=center><b>$niveau</b></td>
							<td  align=center>
			            		  <input size=9 name=nbre_classe$i type=number min=1 max=20 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		</td>
							"; 
 echo" <input name=niveau$i type=hidden value='$niv'>";



			       
                     $i++;
}
//echo"<input type=hidden name=discipline value='$discipline'>";

echo'
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';

}
}
?>