<?php
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
$matricule =$_POST['CLASSE_ID'];
$annee=annee_academique();
$table1 = 'enseignant';
$table = 'classes';	
$prof = findByNValue($table1,"annee='$annee' and personnel='$matricule'");
						$pval = mysql_fetch_row($prof);
						$cy=$pval[1];
				
				if($cy==""){
					$selection = findByNValue($table,"etude in(select libelle from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='ENSEIGNANT'))");
						}
						else{
						$selection = findByNValue($table,"etude in(select libelle from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='ENSEIGNANT')) and libelle<>'$cy'");
					
						}
						
						
echo'<tr><td align="left">
<B>&nbsp;Liste des Classes *</B><select name="classes" id="classes"  required>
<OPTION value="'.$cy.'">'.$cy.'</OPTION>';    

				 
				 while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[2]."'>".$ro[2]."</option>";
    			}
				
ECHO'</SELECT ></td>


<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</td></TR>';
				
}
/*if ($idsel<>"AUTRES") {
ECHO'</tr></TR>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Pseudo * </B><input name="pseudo" type="text"  id="pseudo" required>
<B>&nbsp;PassWord *</FONT></B><input name="passe" type="password" id="password" required>';
$titre="Emetteur";	
}$etagiaire = findByValue('fonction','personnel',$p1);
						$champ = mysql_fetch_row($etagiaire);
						$p8=$champ[1];

$other="Expéditeur";*/

?>