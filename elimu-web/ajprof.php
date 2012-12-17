<?php
//header('Content-Type: text/html; charset=iso-8859-1');
//header('Content-Type: text/html; charset=UTF-8');
include 'all_function.php';
if(isset($_POST['PROF_ID']))
{
$matricule =$_POST['PROF_ID'];
$annee=annee_academique();	
$table='credit_horaire';
$libelle='discipline';
$table1 = 'specialites';
//findByNValue($table1,"annee='$annee' and personnel='$matricule' and classe='$slib2d'")
$prof = findByNbreValue($table1,"professeur='$matricule'");
						$pval = mysql_fetch_row($prof);
						$n=$pval[0];
						//findByNValuelib($table,$libelle,$condition)
						if($n<2)
$selection =findByNValuelib($table,$libelle,"etude in( select libelle from etudes where  etudes.cycle in(select cycle from fonction where personnel='$matricule' and profile='PROFESSEUR'))");
						else 
$selection =findByNValuelib($table1,$libelle,"professeur='$matricule'");

						
echo'<tr><td align="left">
 <B>&nbsp;Liste des Disciplines *</B><select name="discipline" id="discipline"  required onchange="go1()">
<OPTION value=""></OPTION>';    
					
				 while($ro=mysql_fetch_row($selection)){
				 $etagiaire = findByValue('disciplines','iddis',$ro[0]);
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $disci=htmlentities($row[1]);
						   
                            echo"<option value='".$ro[0]."'>".$disci."</option>";
    			}
				
ECHO'</SELECT ></td>


<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</td></TR>';

				
}
?>