
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
  				 <tr bgcolor="white">
                    <th width="120"> D�cision</th>
  				 	<th width="150">Note Minimale</th>
  				 	<th width="150">Note Maximale</th>
  				 	<th width="150">Niveau Etude</th>
                </tr>
				<tbody><tr>
				<?
              		$selection = findByAll('decisions');
              		while($row1 = mysql_fetch_row($selection))
				 	{
				 		/*echo"<tr>";
                       for($j = 0 ; $j<5 ; $j++){
                       echo"<td align='center'>".$row[$j]."</td>";
                       }
                       echo"</tr>";*/
                       	$p1=$row1[1];
						$p2=$row1[2];
						$p3=$row1[3];
						$p4=$row1[4];
						/*$p5=$row1[4];*/
						//$p6=$row1[5];
						//$p7=$row1[6];
						echo"<tr>
							<td  align=center>$p1</td>
							<td  align=center>$p2</td>
							<td  align=center>$p3</td>
							<td  align=center>$p4</td>
							";
						/*$etagiaire = findByValue('rayon','idRa',$p2);
						$champ = mysql_fetch_row($etagiaire);
						$p8=$champ[1];
						//$p9=$champ[2];
						//$p10=$champ[3];
						//$p11=$champ[4];
						echo"
							<td  align=center>$p8</td></tr>";*/
        			}
  				 ?>
</tr></tbody>
</table>
<BR>