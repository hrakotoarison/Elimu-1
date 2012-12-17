<?php
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
$idsel =$_POST['CLASSE_ID'];

echo'	<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Cycle *&nbsp; </B></TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr> ';      
 $table = 'profiles';
				 
				 $selection = findByValue($table,'libelle',$idsel);
				while($ligne2d=mysql_fetch_row($selection))
{
$slib2d=$ligne2d['1'];
//$code=$ligne['codearticle'];
//$stock2=$ligne2['qtestock'];

echo'
<td>
<INPUT type="checkbox" name="choix[]" value="'.$slib2d.'" checked>'.$slib2d.'
</td>';

  
}
ECHO'</tr></TR>';
if ($idsel<>"AUTRES") {
ECHO'</tr></TR>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Pseudo * </B><input name="pseudo" type="text"  id="pseudo" required>
<B>&nbsp;PassWord *</FONT></B><input name="passe" type="password" id="password" required>';
$titre="Emetteur";	
}				
}
/*$etagiaire = findByValue('fonction','personnel',$p1);
						$champ = mysql_fetch_row($etagiaire);
						$p8=$champ[1];

$other="Expéditeur";*/

?>