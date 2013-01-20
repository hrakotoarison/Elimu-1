<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Disciplines</th>
					   <th width="300"> Cycle</th>
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByAll('disciplines');
              		while($row1 = mysql_fetch_row($selection))
				 	{
				 		                    	$libelle=accents($row1[1]);
												$cycle=accents($row1[2]);
						
						echo"<tr>
							<td  align=center>$libelle</td>
							<td  align=center>$cycle</td>
							";
					
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
