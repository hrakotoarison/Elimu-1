<?php
include 'all_function.php';
if(isset($_POST['CYCLE_ID']))
{
$cycle =securite_bdd($_POST['CYCLE_ID']);
$sqlstm2d="select iddis,libelle from disciplines where iddis in(select discipline from credit_horaire where etude in (select idetude from etudes where etudes.cycle='$cycle'))   ORDER BY libelle";

echo'<B>&nbsp;Liste des Disciplines *</B><select name="discipline" id="discipline" onchange="go1()" required>
<OPTION value=""></OPTION>';

$req2d=mysql_query($sqlstm2d);

while($ligne2d=mysql_fetch_array($req2d))
{
$code_uv=$ligne2d['iddis'];
$slib2d=$ligne2d['libelle'];
 echo' <OPTION value="'.$code_uv.'">'.UcFirstAndToLower($slib2d);
 }
 echo'</OPTION></select></TD>';
				
}

?>