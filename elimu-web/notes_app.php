<?php
include 'all_function.php';
if(isset($_POST['CL_ID']) and isset($_POST['PROF_ID']))
{
//$semestre =$_POST['SEM_ID'];
//$classe=$_POST['CL_ID'];
$personnel=$_POST['PROF_ID'];
$sclasse=accents($_POST['CL_ID']);
$annee=annee_academique();
 $table = 'disciplines';
				 $lib = 'cycle';
				 $selection = findByNValue($table,"iddis in (select discipline from enseigner where
				 personnel='$personnel' and classe='$sclasse' and annee='$annee')");
echo'<TD>
<B>&nbsp;Liste des Disciplines *</B><select name="uv" id="uv" onchange="go1()" required>
<OPTION value=""></OPTION>';

				
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				echo'
					</select></TD>';
				
}
?>