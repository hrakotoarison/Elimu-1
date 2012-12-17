<?php
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
$idsel =$_POST['CLASSE_ID'];
echo'<TD>
<B>&nbsp;Liste des Disciplines *</B><select name="uv" id="uv" onchange="go1()" required>
<OPTION value=""></OPTION>';

				 $table = 'disciplines';
				 $lib = 'cycle';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".htmlentities($ro[1])."</option>";
    			}
				echo'
					</select></TD>';
				
}

?>