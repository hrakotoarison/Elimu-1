<?php
$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];
		$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
$sqlstm2d="select iddis,libelle from disciplines where iddis in(select discipline from credit_horaire)   ORDER BY libelle";
}
else{

$sqlstm2d="select iddis,libelle from disciplines where iddis in(select discipline from credit_horaire where etude in (select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile')))   ORDER BY libelle";

//	$selection = findByNValue('credit_horaire',"etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
 ?>
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
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
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
	xhr.open("POST","coef.php",true);
	
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('discipline');
		discipline = sel.options[sel.selectedIndex].value;
		xhr.send("DISCIPLINE_ID="+discipline);
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
	xhr.open("POST","niveau.php",true);
	
	// ne pas oublier �a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On s�lectionne le prof
			sel1 = document.getElementById('cycle');
		//On s�lectionne la value de la prof (cad : CLASSE_ID)
		cycle = sel1.options[sel1.selectedIndex].value;
		sel = document.getElementById('uv');
		//On s�lectionne la value de la prof (cad : CLASSE_ID)
		discipline = sel.options[sel.selectedIndex].value;		
		//On met la s�lection dans la variable que l'on va poster
		xhr.send("PROF_ID="+cycle+ "&MAT=" +discipline);
}

</script>
	<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
		<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TR><TD>
<B>&nbsp;Liste des Disciplines *</B><select name="discipline" id="discipline" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
$req2d=mysql_query($sqlstm2d);

while($ligne2d=mysql_fetch_array($req2d))
{
$code_uv=$ligne2d['iddis'];
$slib2d=$ligne2d['libelle'];
 echo' <OPTION value="'.$code_uv.'">'.$slib2d;
 }
 echo'</OPTION>';?>
					</select></TD>
</TR>
 <tr colspan=2 bgcolore="red" id="eleve" align="left">

			</tr>
</tbody>
</table>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["discipline"]) ) {
$nbart=addslashes($_POST['nbart']);
if($nbart==0){
echo'insertion impossible car donn�es d�ja enregistr�es';
}
else{
$uv=addslashes($_POST['discipline']);
for ($i=1; $i<=$nbart; $i++) {
	   $niveau= addslashes($_POST['niveau'.$i.'']);
	   $nbr= addslashes($_POST['nbre_classe'.$i.'']);
	   
	   $exereq=mysql_query("select * from coefficients where etude= '$niveau' and discipline='$uv'  ");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO coefficients VALUES ( '','$nbr','$uv','$niveau')";

   $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			echo"<div align=center class=imp>Donn�es enregistr�es !</div>";
			}
			else
			{
			echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  
      }
	  
     else{
    	echo "<br>coefficient d�ja enregistr�";
     }

}
}
}