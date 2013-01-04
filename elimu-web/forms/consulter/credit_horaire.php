<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Disciplines</th>
  				 	<th width="150">Niveau Etude</th>
  				 	<th width="150">Crédit Horaire</th>
  				 	<th width="100">Nbre Leçon</th>
                </tr>
				<tbody><tr>
				<?php
								$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('credit_horaire');
}
else{
	$selection = findByNValue('credit_horaire',"etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
            
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$iddis=$row1[1];
						//libelle discipline
						$t_discipline = findByValue('disciplines','iddis',$iddis);
						$champ = mysql_fetch_row($t_discipline);
						$discipline=accents($champ[1]);
						
						$idetude=$row1[4];
						
						//libelle etudes
						$t_etude = findByValue('etudes','idetude',$idetude);
						$champ_etud = mysql_fetch_row($t_etude);
						$libelle_etude=$champ_etud[1];
						$p3=$row1[2];
						$lesson=$row1[3];
						/*$p4=$row1[4];
						$p5=$row1[4];*/
						//$p6=$row1[5];
						//$p7=$row1[6];
						echo"<tr>
							<td  align=center>$discipline</td>
							<td  align=center>$libelle_etude</td>							
							<td  align=center>$p3". 'H'."</td>
							<td  align=center>$lesson</td>";
						/*$etagiaire = findByValue('rayon','idRa',$idetude);
						$champ = mysql_fetch_row($etagiaire);
						$p8=$champ[1];
						//$p9=$champ[2];
						//$iddis0=$champ[3];
						//$iddis1=$champ[4];
						echo"
							<td  align=center>$p8</td></tr>";*/
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
