<?php
include 'all_function.php';
if(isset($_POST['CLASSE_ID']) and isset($_POST['MAT']) )
{
$matricule =$_POST['MAT'];
$idsel =$_POST['CLASSE_ID'];
$table = 'fonction';
				 
 $selection10 = findByNbreValue($table,"profile='$idsel' and personnel='$matricule'");
				$nombre=mysql_fetch_row($selection10);
$nbre=$nombre['0'];
if($nbre==0){

$login='';
$passe='';
$n='1';
}
else{
 /*$table = 'fonction';
$selection = findByNValue($table,"profile='$idsel' and personnel='$matricule'");*/
 $table0 = 'user';
$nature = findByNValue($table0,"profile5='$idsel' and cdeetud='$matricule'");
						$entite = mysql_fetch_row($nature);
						$login=$entite[1];
						$passe=$entite[2];
						$n='2';
}

echo'	<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Cycle *&nbsp; </B></TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr> ';      
 $table = 'profiles';
$selection = findByValue($table,'libelle',$idsel);
				while($ligne2d=mysql_fetch_row($selection))
{
$slib2d=$ligne2d['1'];
$table1 = 'fonction';
$prof = findByNValue($table1,"profile='$idsel' and personnel='$matricule' and cycle='$slib2d'");
						$pval = mysql_fetch_row($prof);
						$cy=$pval[1];
						if($cy=="")
						$valu='';
						else
						$valu='checked';


//echo'******************'.$valu.'</b>';
echo'
<td>
<INPUT type="checkbox" name="choix[]" value="'.$slib2d.'" '.$valu.'>'.$slib2d.'
</td>';

  
}
ECHO'</tr></TR>';
if ($idsel<>"AUTRES") {
ECHO'</tr></TR>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Pseudo * </B><input name="pseudo" type="text"  id="pseudo" value="'.$login.'" required>
<B>&nbsp;PassWord *</FONT></B><input name="passe" type="password" id="password"  value="'.$passe.'"required>';
}	
			
}
?>