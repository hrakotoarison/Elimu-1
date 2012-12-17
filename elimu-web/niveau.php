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
if(isset($_POST['PROF_ID']) and isset($_POST['MAT']) )
{
$discipline =$_POST['MAT'];
$cycle =$_POST['PROF_ID'];
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=white align=center >
			<th width=100>Niveau Etude</th>
            <th width=100>Cr&eacute;dit Horaire</th>
            <th width=100>Nbre le&ccedil;on</th>
            
                     </tr>';



$sqlstm4="select distinct libelle from etudes where cycle='$cycle' and libelle not in(select etude from credit_horaire where discipline='$discipline')";
$req4=mysql_query($sqlstm4);
$nb=mysql_num_rows($req4);
                  $i=1;
if($nb==0){
echo'insertion impossible';
}
else{				  
while($ligne4=mysql_fetch_array($req4))
{
$niveau=$ligne4['libelle'];
$niv=htmlentities($niveau);
  echo" <input name=nbart type=hidden value=$nb>";

      echo"<tr>
			            <td align=center><b>$niveau</b></td>
							<td  align=center>
			            		  <input size=9 name=nbre_classe$i type=number min=0 max=500 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
								<td  align=center>
			            		  <input size=9 name=nbre_lesson$i type=number min=0 max=500 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbre_lesson$i );       //
				             	      </script>
			            		</td>
			            		</td>
							"; 
 echo" <input name=niveau$i type=hidden value='$niv'>";



			       
                     $i++;
}
echo"
<input type=hidden name=cycle value='$cycle'>";

echo'
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';

}
}
?>