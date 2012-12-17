<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Disciplines</th>
  				 	<th width="150">Niveau Etude</th>
  				 	<th width="100">Crédit Horaire</th>
  				 	<th width="100">Nbre Leçon</th>
                </tr>
				<tbody><tr>
				<?
								$profile=$_SESSION["agence"];
				if($profile=="Administrateur"){
	$selection = findByAll('credit_horaire');
}
else{
	$selection = findByNValue('credit_horaire',"etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
              //		$selection = findByAll('credit_horaire');
              		while($row1 = mysql_fetch_row($selection))
				 	{
				 		/*echo"<tr>";
                       for($j = 0 ; $j<5 ; $j++){
                       echo"<td align='center'>".$row[$j]."</td>";
                       }
                       echo"</tr>";*/
                       	$p1=$row1[1];
						$etagiaire = findByValue('disciplines','iddis',$p1);
						$champ = mysql_fetch_row($etagiaire);
						$discipline=$champ[1];
						
						$p2=$row1[4];
						$p3=$row1[2];
						$lesson=$row1[3];
						/*$p4=$row1[4];
						$p5=$row1[4];*/
						//$p6=$row1[5];
						//$p7=$row1[6];
						echo"<tr>
							<td  align=center>$discipline</td>
							<td  align=center>$p2</td>							
							<td  align=center>$p3". 'H'."</td>
							<td  align=center>$lesson</td>";
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
