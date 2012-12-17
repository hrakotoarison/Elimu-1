<?php
$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];
$profile=$_SESSION["agence"];
if($profile=="Administrateur"){
$sqlstm2d="select  distinct cycle from categories  ORDER BY cycle";
}
else{
$sqlstm2d="select  distinct cycle from fonction where profile='$profile'  ORDER BY cycle";
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
<form name="inscription_form" action="<?php echo 'classes.php?ajout=1';?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
			
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200"><B>&nbsp;Liste Des Cycles <SELECT NAME="libelle1" id="libelle1" required
placeholder="Selectionner" autofocus/  onchange="submit();" >
<OPTION >Selectionner</OPTION>
 <?php
 // $sqlstm2d="select  distinct cycle from etudes  ORDER BY cycle";
$req2d=mysql_query($sqlstm2d);

while($ligne2d=mysql_fetch_array($req2d))
{
$slib2d=$ligne2d['cycle'];
 echo' <OPTION value="'.$slib2d.'">'.$slib2d;
 }
 echo'</OPTION>';
  if(@$_POST["libelle1"]<>"") {
 $discipline=$_POST["libelle1"];
 
  echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
  <tr>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP>&nbsp;<B>Cycle *&nbsp;<INPUT id="Le Stock de Départ" name="stock"   value="'.$discipline.' " SIZE="50" MAXLENGTH="100" disabled="disabled" ></TD>
</TR>';
?>
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1>
	   	    <tr bgcolor=white align=center >
			<th width=100>Niveau Etude</th>
            <th width=200>Nombre de classe</th>
            
                     </tr>
<?


$sqlstm4="select distinct libelle from etudes where cycle='$discipline'";
$req4=mysql_query($sqlstm4);
$nb=mysql_num_rows($req4);
                  $i=1;
while($ligne4=mysql_fetch_array($req4))
{
$niveau=$ligne4['libelle'];
$niv=htmlentities($niveau);
  echo" <input name=nbart type=hidden value=$nb>";

      echo"<tr>
			            <td align=center>$niveau</td>
							<td  align=center>
			            		  <input size=9 name=nbre_classe$i type=number min=1 max=26 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		</td>
							"; 
 echo" <input name=niveau$i type=hidden value='$niv'>";



			       
                     $i++;
}
echo"
<input type=hidden name=cycle value='$discipline'>";
?>

  <TR><TD class=petit>&nbsp;</TD></TR>


<table>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>


<?

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
$nbart=addslashes($_POST['nbart']);

   		for ($i=1; $i<=$nbart; $i++) {
	   $niveau= addslashes($_POST['niveau'.$i.'']);
	   $nbr= addslashes($_POST['nbre_classe'.$i.'']);
	   $sqlstm1="select count(*) nb from classes where etude='$niveau'";
		$req1=mysql_query($sqlstm1);
		while($ligne=mysql_fetch_array($req1))
			{
			$nb=$ligne['nb'];
			}

if($nb<>0){
$nbre=$nbr+$nb;
$mise="delete from classes where etude='$niveau'";
	$req2=mysql_query($mise);
		}
		else{
		$nbre=$nbr;
		}
	//	echo$nbre;
	   $v='';
if($nbre==1){
	//$v=""; 
	$exereq=mysql_query("select * from classes where libelle= '$niveau'");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO classes VALUES ( '$niveau','','$niveau')";

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
    	echo "<br>Cette Classe existe déja";
     }

	}
elseif($nbre>1){

for ($j=1;$j<=$nbre;$j++) 
{
if($j==1){
$v='A';}
elseif($j==2){
$v='B';}
elseif($j==3){
$v='C';}
elseif($j==4){
$v='D';}
elseif($j==5){
$v='E';}
elseif($j==6){
$v='F';}
elseif($j==7){
$v='G';}
elseif($j==8){
$v='H';}
elseif($j==9){
$v='I';}
elseif($j==10){
$v='J';}
if($j==11){
$v='K';}
elseif($j==12){
$v='L';}
elseif($j==13){
$v='M';}
elseif($j==14){
$v='N';}
elseif($j==15){
$v='O';}
elseif($j==16){
$v='P';}
elseif($j==17){
$v='Q';}
elseif($j==18){
$v='R';}
elseif($j==19){
$v='S';}
elseif($j==20){
$v='T';}
elseif($j==21){
$v='U';}
elseif($j==22){
$v='V';}
elseif($j==23){
$v='W';}
elseif($j==24){
$v='X';}
elseif($j==25){
$v='Y';}
elseif($j==26){
$v='Z';}
//echo "classe ( ".$niveau.",".@$annee.",".$v." )";
$exereq=mysql_query("select * from classes where libelle= concat('$niveau','$v') ");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO classes VALUES ( '$niveau','$v',concat('$niveau','$v'))";

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
    	echo "<br>Cette Classe existe déja";
     }
}
}
//echo $niveau.' '.$nbre.'</br>';

 	}
 
	//}
	}
?>


