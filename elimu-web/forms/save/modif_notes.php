<?php
//$_SESSION['classe']=;
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$type='';
$hd='';
$hf='';
$datejour=date("Y")."-".date("m")."-".date("d");
$sqlstm1e="SELECT count(*) ns FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1e=mysql_query($sqlstm1e);
while($lignee=mysql_fetch_array($req1e))
{
	$ns=$lignee['ns'];
	}
	// r�cup�ration des �valuations d�ja enregistr�es
$sql1="select distinct evaluation from notes where notes.eleve in(select eleve from inscription where  classe='$sclasse' and annee='$annee')and evaluation in(select id from evaluations where annee='$annee' and classe='$sclasse' and 
evaluations.discipline in(select discipline from enseigner where personnel='$personnel' and annee='$annee' and classe='$sclasse' )) order by evaluation desc";
$req1=mysql_query($sql1);
?>
<script language="Javascript">
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9/.]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
if(champ.value.charAt(x) == "."){points++;}  /*Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>

<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
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
			document.getElementById('notes').innerHTML = leselect;
		}
	}

	// On poste la requ�te ajax vers le fichier de traitement
	xhr.open("POST","evaluer.php",true);
	
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('evaluation');
		evaluation = sel.options[sel.selectedIndex].value;
		xhr.send("EVA_ID="+evaluation);
}

</script>

<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<TR>
<B>&nbsp;Evaluation &nbsp;*&nbsp;</B><SELECT NAME="evaluation" id="evaluation" required onchange="go()">
<OPTION value=""></OPTION>
 <?php

while($ligne1=mysql_fetch_array($req1))
{
$eva=$ligne1['evaluation'];
$sqlst="select date_prevue,discipline,type from evaluations where   id='$eva' order by type ,date_prevue desc ";
$req=mysql_query($sqlst);
while($lig=mysql_fetch_array($req))
{
$datep=$lig['date_prevue'];
$discipline=$lig['discipline'];
$type=$lig['type'];
}

$table = 'disciplines';
				 $selection = findByValue($table,'iddis',$discipline);
				$ro=mysql_fetch_row($selection);
                            //echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			
?>
  <OPTION value="<?php echo $eva;?>"><?php echo $type.' de '.$ro[1].' du '.$datep;?>
  <?php
}
?>
 </OPTION></SELECT></TD></TR>
 <tr colspan=2 bgcolore="red" id="notes" align="left">

			</tr>
 <?php
   echo" <input name=cl type=hidden value='$sclasse'>";
				  echo" <input name=an type=hidden value='$annee'>";
				   echo" <input name=matricule type=hidden value='$personnel'>";
 ?>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=95%></TD></TR>


	</tbody><table>
<TR><TD class=petit>&nbsp;</TD>
	<TR><TD><BUTTON TITLE="Confirmer Notes"name="enregistrer" TYPE="submit" id="flashit"><b>Noter</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["cl"]) ) {

	if(isset($_POST["evaluation"])){
		$evaluation=addslashes($_POST['evaluation']);
$classe=addslashes($_POST['cl']);
$annee=addslashes($_POST['an']);
$matricule=addslashes($_POST['matricule']);
$nbart=addslashes($_POST['nbart']);
$mise="delete from notes where evaluation='$evaluation'";
	$req2=mysql_query($mise);
   		for ($i=1; $i<=$nbart; $i++) {
	   $code= addslashes($_POST['code'.$i.'']);
	   $note= addslashes($_POST['note'.$i.'']);
if($note<=20){
	
		           $sql="insert into notes values('$code','$note','$evaluation','')";

		            $exe=mysql_query($sql) or die(mysql_error());
		            if (@$exe) {
		             	echo'<script Language="JavaScript">
							{
							alert ("Notes Modifi�es");
							}
</SCRIPT>';
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="modif_notes.php?ajout=1&num='. $classe.'"
</SCRIPT>';
					
					}
		            else {
		               echo'<script Language="JavaScript">
							{
							alert ("Veuillez reprendre");
							}
</SCRIPT>';
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="modif_notes.php?ajout=1&num='. $classe.'"
</SCRIPT>';
			
		            }
		  		 //}
	      }
	      else{
		  echo'<script Language="JavaScript">
							{
							alert ("la note doit �tre comprise entre 0 et 20");
							}
</SCRIPT>';
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="modif_notes.php?ajout=1&num='. $classe.'"
</SCRIPT>';
		  }


 	}
 
	}
}
//}
//}
?>