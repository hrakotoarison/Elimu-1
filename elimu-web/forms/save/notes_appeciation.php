<?php
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];
		$profile=$_SESSION["profil"];
			 $table = 'etudes';
				 $lib = 'cycle';
				
$selection="SELECT id,libelle FROM semestres WHERE annee ='$annee' and id not in(select semestre from moyennes where annee='$annee' and  moyennes.eleve in (select eleve from inscription where classe='$sclasse' and annee='$annee'))
and id in (select semestre from evaluations where classe='$sclasse' and annee='$annee' )";

 ?>

<form name="inscription_form" action="<?php echo 'notes_appeciation.php?ajout=1&num='.$sclasse;?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<script language="Javascript">
//Fonction n�cessaire : ne rien modifier ici...
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
	{ // XMLHttpRequest non support� par le navigateur 
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
		xhr = false; 
	} 
            
	return xhr;
}
//Fonction de liste dynamique
function go(){
	var xhr = getXhr();
			
	// On d�fini ce qu'on va faire quand on aura la r�ponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout re�u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des �l�ves
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requ�te ajax vers le fichier de traitement
	xhr.open("POST","notes_app.php",true);
	
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		//sel1 = document.getElementById('cycle');
		//semestre = sel1.options[sel1.selectedIndex].value;
		sel = document.getElementById('cl');
		classe = sel.value;	
		sel2 = document.getElementById('personnel');
		personnel = sel2.value;		
		//On met la s�lection dans la variable que l'on va poster
		xhr.send("CL_ID=" +classe+ "&PROF_ID=" +personnel);
}
function go1(){
	var xhr = getXhr();
			
	// On d�fini ce qu'on va faire quand on aura la r�ponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout re�u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des �l�ves
			document.getElementById('etude').innerHTML = leselect;
		}
	}

	// On poste la requ�te ajax vers le fichier de traitement
	xhr.open("POST","app_notes.php",true);
	
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On s�lectionne le prof
			sel1 = document.getElementById('cycle');
		cycle = sel1.options[sel1.selectedIndex].value;
		sel = document.getElementById('uv');
		discipline = sel.options[sel.selectedIndex].value;
sel3 = document.getElementById('cl');
		classe = sel3.value;			
		//On met la s�lection dans la variable que l'on va poster
		xhr.send("PROF_ID="+cycle+ "&MAT=" +discipline+ "&CL=" +classe);
}

</script>
<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>

<TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD>
<B>&nbsp;Liste des Semestres *</B><select name="cycle" id="cycle" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
			$rs=mysql_query($selection);
				while($ro=mysql_fetch_array($rs)){
				$codes=$ro[0];
                            echo"<option value='".$codes."'>".$ro[1]."</option>";
    			}?>
					</select></TD>
</TR>
<tr colspan=2 bgcolore="red" id="eleve" align="left">

			</tr>
			
<tr>
			<td  colspan=2 bgcolore="red" id="etude" align="left">

			</td>
			</tr>
	<tr>
				<td>  <input name=cl type=hidden value="<?php echo $sclasse;?>" id="cl"></td>
				  <td> <input name=an type=hidden value="<?php echo $annee;?>"></td>
				 <td> <input name=matricule type=hidden value="<?php echo $personnel;?>" id="personnel">";
</tr>	
</tbody>
</table>
<?php

if (isset($_POST["enregistrer"]) and isset($_POST["cycle"]) ) {
$nbart=addslashes($_POST['nbart']);
if($nbart==0){
echo'insertion impossible';
}
else{
$semestre=addslashes($_POST['cycle']);
$annee=addslashes($_POST['an']);
$personnel=addslashes($_POST['matricule']);
$uv=addslashes($_POST['uv']);
for ($i=1; $i<=$nbart; $i++) {
	   $eleve= addslashes($_POST['code'.$i.'']);
	   $appreciation= addslashes($_POST['appreciation'.$i.'']);	   
	 //  $lesson= addslashes($_POST['nbre_lesson'.$i.'']);
	  $exereq=mysql_query("select * from apreciation_prof where eleve='$eleve' and discipline='$uv' and semestre='$semestre' and annee='$annee'");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO apreciation_prof VALUES ( '','$eleve','$appreciation','$uv','$annee','$semestre','$personnel')";

   $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
			echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  
      }
	  
     else{
    	echo "<br>D�ja enregistr�";
     }

}
}
}