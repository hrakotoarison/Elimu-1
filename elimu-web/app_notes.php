<?php
include 'all_function.php';
if(isset($_POST['PROF_ID']) and isset($_POST['MAT']) and isset($_POST['CL']) )
{
$discipline =$_POST['MAT'];
$semestre =$_POST['PROF_ID'];
$classe =accents($_POST['CL']);
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=white align=center >
			<th width=100>Matricule</th>
			<th width=100>El&eacute;ve</th>
            <th width=100>Date Naissance</th>
            <th width=150>Moyenne Semestre</th>
            <th width=250>Appr&eacute;ciations</th>            
                     </tr>';
$sql="select * from eleves where matricule in(  select eleve from inscription where classe='$classe' and annee='$annee')";
                  $exec=mysql_query($sql) or die(mysql_error());
                  $nb=mysql_num_rows($exec);
                  $i=1;
                 echo" <input name=nbart type=hidden value=$nb>";
                  while($ligne=mysql_fetch_row($exec)){
                               $code=$ligne['0'];
							      $prenom=htmlentities($ligne['1']);
                               $nom=htmlentities($ligne['2']);
                               $mode=$ligne['3'];
							   $date_n=$ligne['4'];
                               $lieu=htmlentities($ligne['5']);
							   
					//total devoir + moyenne devoir
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$semestre' and evaluations.discipline='$discipline' and notes.eleve='$code'";
$r=mysql_query($s);
$l=mysql_fetch_array($r);
$dv=$l['dv'];
$nt=$l['nt'];
$md=$l['md'];

//note composition

$sc="SELECT note FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='COMPOSITION' and evaluations.semestre='$semestre' and evaluations.discipline='$discipline' and notes.eleve='$code'";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
$ms=($md+$nc)/2;		   
echo"<tr bgcolor=#CCFFFF>
     <td align=center>$code</td>
	 <td align=center>$prenom $nom</td>
	<td align=center>$date_n &agrave; $lieu</td>
	<td align=center>$ms</td>
	<td  align=center>
	<input size='35' name=appreciation$i type=text MAXLENGTH='40' id='Libelle Appr&eacute;ciaion' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;type:obligatoire;erreur: CV obligatoire' autofocus>
	<script type=text/javascript>      //
	new SUC( document.frm.nbptotal$i );       //
	</script></td>";
						
			                       echo" <input name=code$i type=hidden value='$code'>
			        
			          ";
                     $i++;
                  }
				  echo'
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';

//}
}
?>