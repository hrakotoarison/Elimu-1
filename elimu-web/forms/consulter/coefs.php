<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Disciplines</th>
  				 	<th width="150">Niveau Etude</th>
  				 	<th width="100">Co�fficient</th>
                </tr>
				<tbody><tr>
				<?php
				$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('coefficients');
}
else{
	$selection = findByNValue('coefficients',"etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];
						$p2=$row1[2];
						$p3=$row1[3];
					 $titres = findByValue('disciplines','iddis',$p2);
						$tit = mysql_fetch_row($titres);
						$discipline=accents($tit[1]);
						
						
$t_etude = findByValue('etudes','idetude',$p3);
						$val_etude = mysql_fetch_row($t_etude);
						$niv=$val_etude[1];
						echo"<tr>
							<td  align=center>$discipline</td>
							<td  align=center>$niv</td>							
							<td  align=center>$p1</td>";
						
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
