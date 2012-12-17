<?php
	$profile=$_SESSION["agence"];
		 $table = 'personnels';
				 $lib = 'libelle';
				
				if($profile=="Administrateur"){
				
				 $selection =  findByNValue($table,"enable8='1' and matricule in(select personnel from fonction where profile='PROFESSEUR')");
				
}
else{
$selection =  findByNValue($table,"enable8='1' and matricule in(select personnel from fonction where profile='PROFESSEUR' and fonction.cycle in(select cycle from fonction where profile='$profile'))");
				
	//$selection = findByNValuelib($table,$lib," $table.cycle in(select cycle from fonction where profile='$profile')");
}
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
<form name="inscription_form" action="<?php echo 'professeurs.php?ajout=1';?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data" >
<input name="action" value="submit" type="hidden">
<div class="formbox">
<script language="Javascript">
//Fonction nécessaire : ne rien modifier ici...
function getXhr(){
    var xhr = null; 
			
	if(window.XMLHttpRequest) // Firefox et autres
		xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject)
	{ // Internet Explorer 
		try 
		{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else 
	{ // XMLHttpRequest non supporté par le navigateur 
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
		xhr = false; 
	} 
            
	return xhr;
}

//Fonction de liste dynamique
function go(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","ajprof.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
		sel = document.getElementById('prof');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		prof = sel.options[sel.selectedIndex].value;
		//On met la sélection dans la variable que l'on va poster
		xhr.send("PROF_ID="+prof);
}
//liste des disciplines dynamique
function go1(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('uv').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","ajuv.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
			sel1 = document.getElementById('prof');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		prof = sel1.options[sel1.selectedIndex].value;
		sel = document.getElementById('discipline');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		discipline = sel.options[sel.selectedIndex].value;		
		//On met la sélection dans la variable que l'on va poster
		xhr.send("PROF_ID="+prof+ "&MAT=" +discipline);
}


</script>


	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
<TR><TD>
<B>&nbsp;Liste des Professeurs *</B><select name="prof" id="prof" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
				while($ro=mysql_fetch_row($selection)){
				$etag = findByValue('titre5','id',$ro[1]);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
                            echo"<option value='".$ro[0]."'>".$titre." ".$ro[2]." ".$ro[3]."</option>";
    			}?>
					</select></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>

			<tr>
			
			<td  colspan=2 bgcolore="red" id="eleve" align="left">

			</td>
			</tr>
			<tr>
			<td  colspan=2 bgcolore="red" id="uv" align="left">

			</td>
			</tr>
	</tbody>
<TR><TD class=petit>&nbsp;</TD>

</TR>
	<tr><td><input class=kc1 type="submit"  name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["prof"]) ) {
save_prof();
}
?>