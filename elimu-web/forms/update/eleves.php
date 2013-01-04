<?php
$eleve=$_GET['eleve'];
$sclasse=$_GET['num'];
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
//$matricule=$_SESSION["matricule"];
$etagiaire = findByNValue('eleves',"matricule in (select eleve from inscription where annee='$annee' and classe='".htmlentities($sclasse)."')");
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $matricule=$row[0];
					      $prenom=$row[1];
					      $nom=$row[2];
					      $sexe=$row[3];
					      $date_nais=$row[4];
					      $lieu_nais=$row[5];
					      $tuteur=$row[6];
					      $email_tuteur=$row[7];
					      $tel_tuteur=$row[8];
					      $tel_eleve=$row[9];
					      $email_eleve=$row[10];
						  $adresse=$row[11];	
						  $photo=$row[12];	
						  $enable=$row[13];	
						 $age=$datejour-$date_nais;
						//sexe en cours
						 $se = findByValue('sexe5','id',$sexe);
						$sex = mysql_fetch_row($se);
						$sx=$sex[1];
						//matrimonial en cours
						 $incription = findByNValue('inscription',"eleve='$eleve' and annee='$annee' and classe='".htmlentities($sclasse)."'");
						$incript = mysql_fetch_row($incription);
						$transport=$incript[2];
						  
?>
<script language="Javascript">
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
<form name="inscription_form" action="<?php echo lien();?> "method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">

	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
<tr><td rowspan="19">
<?php
if($photo<>"")
echo'<img src="photos/'.$photo.'" align=center width="250" height="400">';
?>
</b></B><INPUT TYPE="file"  NAME="photo">
</td> 
    <td><B>&nbsp;Matricule :&nbsp;&nbsp;&nbsp;</B><?php echo $matricule;?>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Eléve Redoublant :*</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<SELECT NAME="redoublant">
<OPTION SELECTED><?php echo $transport;?></OPTION>
<?php
if ($transport=="OUI"){

	echo "<OPTION>NON</OPTION>";
	}
elseif ($transport=="NON"){

echo "<OPTION>OUI</OPTION>";
	}
?>


</SELECT></TD>
</TD></td> 
  
<tr><td><B>&nbsp;Prénom :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT type="text" SIZE=30 MAXLENGTH="50" NAME="prenom" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $prenom;?>" required>
</td></tr>
<tr><td><B>&nbsp;Nom :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="nom"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $nom?>" required></td>    </tr>
<tr><td><B>&nbsp;Date Naissance :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT type="date" SIZE=10 MAXLENGTH="20" NAME="date_nais"  required value="<?php echo $date_nais;?>"> <b>&nbsp;&nbsp;&nbsp;Age :&nbsp;&nbsp;&nbsp;<?php echo $age.' ans';?></b></td></tr>
<tr><td>
<B>&nbsp;Lieu Naissance :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="lieu_nais"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $lieu_nais;?>" required>
</td></tr>
<tr><td><B>&nbsp;Sexe :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<SELECT NAME="sexe" id="Sexe" required><OPTION value="<?php echo $sexe?>"><?php echo $sx?></OPTION>
<?php
$table = 'sexe5';
				 $selection = findNByValue('sexe5','id',$sexe);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				?>			
					</select></td></tr>
				<tr><td>
<B>&nbspTuteur :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="tuteur"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $tuteur?>" required>
</td></tr>
<tr><td><B>&nbsp;Teléphone Tuteur :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel_tuteur" id="téléphone" value="<?php echo $tel_tuteur?>" required>
</td></tr>

<tr><td>
<B>&nbsp;Email-Tuteur :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="email" SIZE=30 MAXLENGTH="50" NAME="email_tuteur"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $email_tuteur?>" required>
</td></tr>
<tr><td>
<B>&nbsp;Téléphone Eléve :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="text" SIZE=12 MAXLENGTH="12" NAME="tel_eleve"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $tel_eleve?>" >
</td></tr>
<tr><td><B>&nbsp;Email-Eléve :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT TYPE="email" SIZE=30 MAXLENGTH="50" NAME="email_eleve" id="email_eleve" value="<?php echo $email_eleve;?>"></td>    </tr>
<tr><td></td>    </tr>
<tr><td><B>&nbsp;Adresse :*&nbsp;</B>
<INPUT TYPE="text" SIZE=60 MAXLENGTH="100" NAME="adresse" id="adresse" ONCHANGE="this.value=this.value.toUpperCase()" required value="<?php echo $adresse?>"></td>    </tr>


<tr><td><input type="hidden" name="eleve" value="<?php echo $eleve;?>"></td>
<td><input type="hidden" name="classe" value="<?php echo $sclasse;?>"></td>
<td><input type="hidden" name="lien" value="<?php echo $photo;?>"></td>
	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><BUTTON TITLE="Confirmer la Modification de vos Données" TYPE="submit" id="flashit" name="modif">Modifier</BUTTON>
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["eleve"]) ) {
update_eleve();
}
?>