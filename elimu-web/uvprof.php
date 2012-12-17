<?php
include 'all_function.php';
if(isset($_POST['CLASSE_ID']) and isset($_POST['MAT']))
{
$matricule=$_POST['MAT'];
$discipline =$_POST['CLASSE_ID'];
$annee=annee_academique();
if($discipline<>""){
$selection =findByNValuelib('enseigner','classe',"personnel='$matricule' and discipline='$discipline' and annee='$annee'");

echo'<tr><td align="left">
 <B>&nbsp;Classes *</B><select name="classe" id="classe"  required >
<OPTION value=""></OPTION>';    
								 while($ro=mysql_fetch_row($selection)){
				    // $disci=htmlentities($row[1]);
						   
                            echo"<option value='".$ro[0]."'>".$ro[0]."</option>";
    			}
				
ECHO'</SELECT ></td></tr><tr><td><B>Date Pr&eacute;vue:</B></td>
<td><input type="date" name="date_p"  size=10 MAXLENGTH=10 id="date_p" required>//('. date("Y-m-d").')</td></tr>';

echo'<tr><TD ><B>&nbsp;D&eacute;but </B><SELECT NAME="debut" id="debut" required>
 <OPTION value=""></OPTION>
<OPTION value="08:00" >8H00</OPTION>
<OPTION value="08:30">8H30</OPTION>
<OPTION value="09:00" >9H00</OPTION>
<OPTION value="9:30">9H30</OPTION>
<OPTION value="10:00" >10H00</OPTION>
<OPTION value="10:30">10H30</OPTION>
<OPTION value="11:00" >11H00</OPTION>
<OPTION value="11:30">11H30</OPTION>
<OPTION value="12:00" >12H00</OPTION>
<OPTION value="12:30">12H30</OPTION>
<OPTION value="13:00" >13H00</OPTION>
<OPTION value="13:30">13H30</OPTION>
<OPTION value="14:00" >14H00</OPTION>
<OPTION value="14:30">14H30</OPTION>
<OPTION value="15:00" >15H00</OPTION>
<OPTION value="15:30">15H30</OPTION>
<OPTION value="16:00" >16H00</OPTION>
<OPTION value="16:30">16H30</OPTION>
<OPTION value="17:00" >17H00</OPTION>
</SELECT ></TD></tr>';
echo'<tr><TD><B>&nbsp;Dur&eacute;e </FONT></B><SELECT NAME="duree" id="duree"  required onchange="go1()" >
<OPTION  value=""></OPTION>
<OPTION value="01:00" >1H00</OPTION>
<OPTION value="02:00" >2H00</OPTION>
<OPTION value="03:00" >3H00</OPTION>
<OPTION value="04:00" >4H00</OPTION>
</OPTION></SELECT></td>
</tr>';
}
}
?>