<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="300"> Surveillants</th>
  				 	<th width="300">classes</th>
  				 	
                </tr>
				<tbody><tr>
				<?php
				$annee=annee_academique();
				//liste des surveillants
				 $table = 'surveiller';
				 $lib = 'personnel';
			
              		
					$profile=$_SESSION["profil"];
				
				if($profile=="Administrateur"){
				
	 $selection = findByNValuelib($table,$lib,"annee='$annee'");				
}
else{
	 $selection = findByNValuelib($table,$lib,"annee='$annee' and classe in (select libelle from classes where classes.etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile')))");
				
	//$selection = findByNValuelib($table,$lib," $table.cycle in(select cycle from fonction where profile='$profile')");
}
					
					while($row1 = mysql_fetch_row($selection))
				 	{ $b='';
						$p1=$row1[0];
						$perso = findByValue('personnels','matricule',$p1);
						$per = mysql_fetch_row($perso);
						$p3=$per[1];
						$p4=$per[2];
						$p8=$per[3];
						$etag = findByValue('titre5','id',$p3);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
		//liste des classes à surveiller pour l'année académique en cours
		$table1 = 'surveiller';
$prof = findByNValue($table1,"annee='$annee' and personnel='$p1'");
while($row = mysql_fetch_row($prof))
				 	{
						$idclasse=$row[1];
						$t_classe = findByValue('classes','idclasse',$idclasse);
						$val_classe = mysql_fetch_row($t_classe);
						$classe=$val_classe[3];
						
						$b=$b.' '.$classe;
						}
						echo"<tr>
							<td  align=center>".' '.$titre.' ' .$p4.' '.$p8."</td>
							<td  align=center>$b</td>";
						/*$etagiaire = findByValue('fonction','personnel',$p1);
						$champ = mysql_fetch_row($etagiaire);
						$p8=$champ[1];
						//$p9=$champ[2];
						//$p10=$champ[3];
						//$p11=$champ[4];
						echo"
							<td  align=center>$p8</td>
							<td  align=center>$ans</td></tr>";*/
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
