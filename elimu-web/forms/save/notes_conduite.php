<?php
//$_SESSION['classe']=;
$sclasse=$_GET['num'];
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$val=str_replace(utf8_encode('é'), '&eacute;', $sclasse);
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
$sqlstm1="SELECT id,libelle,date_format(date_debut,'%d/%m/%Y') debut,date_format(date_fin,'%d/%m/%Y') fin FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($lignes=mysql_fetch_array($req1))
{
	$codes=$lignes['id'];
	$libelle=$lignes['libelle'];
	$debut=$lignes['debut'];
	$fin=$lignes['fin'];
	}
/*	echo	$sqlstm1pa = "select eleve from inscription where annee='$annee' and classe='$val')";
$RSU1=mysql_query($sqlstm1pa);
while($ligne=mysql_fetch_array($RSU1))
{
$nconduite=$ligne['nb'];
}*/
?>
<form name="inscription_form" action="<?php echo 'notes_conduite.php?ajout=1&num='.$sclasse;?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<?php
		if($ns==0){
echo $datejour .' n\'est dans  aucun semestre donc impossible de faire un traitement  pour cette date';
}
/*elseif	($nconduite<>0) {

}*/

else{
?>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=#033155 align=center >
            <th width=100><b><font color="white">Matricule</th>
            <th width=300><b><font color="white">Eleve</th>
            <th width=300><b><font color="white">Date et lieu de Naissance</th>
            <th width=100><b><font color="white">Conduite</th>
                     </tr>
                <?php
                  //include"connect.php";
                  $sql="select * from eleves where matricule in(  select eleve from inscription where classe='".htmlentities($sclasse)."' and annee='$annee')";
                  $exec=mysql_query($sql) or die(mysql_error());
                  $nb=mysql_num_rows($exec);
                  $i=1;
                 echo" <input name=nbart type=hidden value=$nb>";
                  while($ligne=mysql_fetch_row($exec)){
                               $code=$ligne['0'];
							      $prenom=$ligne['1'];
                               $nom=$ligne['2'];
                               $mode=$ligne['3'];
							   $date_n=$ligne['4'];
                               $lieu=$ligne['5'];
		              echo"<tr >
			            <td align=center><b>$code</td>
			            <td align=center><b>$prenom $nom</td>
							<td align=center><b>$date_n à $lieu</td>
							<td  align=center>
			            		  <input size=9 name=note$i  type=text id='Note Eléve'  onkeyup='verif_nombre(this);' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;type:obligatoire2;erreur: CV obligatoire'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		</td>
							";
						
			                       echo" <input name=code$i type=hidden value='$code'>
			        
			          ";
                     $i++;
                  }
				   echo" <input name=semestre type=hidden value='$codes'>";
				  echo" <input name=cl type=hidden value='$sclasse'>";
				  echo" <input name=an type=hidden value='$annee'>";
				  echo" <input name=matricule type=hidden value='$personnel'>";

				?>
		</table>
	</td>
  </tr>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=95%></TD></TR>


	</tbody>
<TR><TD class=petit>&nbsp;</TD>

</TR>
	<TR><TD><BUTTON TITLE="Confirmer la note de conduite"name="enregistrer" TYPE="submit" id="flashit"><b>Noter</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["cl"]) ) {
	if(isset($_POST["cl"])){
$classe=addslashes($_POST['cl']);
$annee=addslashes($_POST['an']);
$matricule=addslashes($_POST['matricule']);
$semestre=addslashes($_POST['semestre']);
$nbart=addslashes($_POST['nbart']);

   		for ($i=1; $i<=$nbart; $i++) {
	   $code= addslashes($_POST['code'.$i.'']);
	   $note= addslashes($_POST['note'.$i.'']);
if($note>=0 and $note<=20){
 $exereq=mysql_query("select * from note_conduite where eleve='$code' and semestre='$semestre' and annee='$annee' and personnel='$matricule' ");
    if(mysql_num_rows($exereq)==0){
		  echo $sql="insert into note_conduite values('$code','$note','$semestre','$annee','','$matricule')";
		           
		            $exe=mysql_query($sql) or die(mysql_error());
		            if (@$exe) {
		             	echo'<script Language="JavaScript">
							{
							alert ("Notes de conduite Enregistrées");
							}
</SCRIPT>';
		echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
					
					}
		            else {
		               echo'<script Language="JavaScript">
							{
							alert ("Veuillez reprendre");
							}
</SCRIPT>';
			echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
			
		            }
		  		 }
				  else {
		               echo'<script Language="JavaScript">
							{
							alert ("Déja enregistrée");
							}
</SCRIPT>';
			echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
			
		            }
	      }
	      else{
		  echo'<script Language="JavaScript">
							{
							alert ("la note doit être comprise entre 0 et 20");
							}
</SCRIPT>';
			echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
		  }


 	}
 
	}
}
}

?>