<?php
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$selection = findByNValue('cahier_retard',"cahier_retard.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and datejour='$datejour'");

?>
<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="250"> El�ves</th>
  				 	<th width="150">Datejour</th>
  				 	<th width="150">Discipline</th>
  				 	<th width="150">Cours</th>
  				 	<th width="100">Arriv�e</th>
  				 	<th width="100">Tuteur</th>
                </tr>
				<tbody><tr>
				<?php
            
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$ideleve=$row1[0];
						$datejour=$row1[1];
						$arrivee=$row1[2];//heure d'arriv�e a l'�cole
						$idemploi=$row1[3];
						$semestre=$row1[5];
						// infos sur les �l�ves
						$t_eleves =  findByNValue("eleves","matricule='$ideleve'");
              		$row = mysql_fetch_row($t_eleves);
				 	
                       	//$p1=$row1[0];
						$prenom=$row[1];
						$nom=$row[2];
						$date_nais=$row[4];
						$lieu_nais=$row[5];
						$tel_t=$row[8];
						$tuteur=$row[6];
						$eleve=$prenom.' '.$nom;
						$dlnais=$date_nais.' � '.$lieu_nais;
						//r�cup infos sur l'emploi du temps
							$t_emploi =  findByNValue("emploi_temps","id='$idemploi'");
              		$emp = mysql_fetch_row($t_emploi);
					$idjour=$emp[1];
					$debut=$emp[2];
					$fin=$emp[3];
					$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];
					$cours=$d.' - '.$fi;
					$iddis=$emp[4];
						//libelle etudes
						$t_etude = findByValue('disciplines','iddis',$iddis);
						$champ_dis = mysql_fetch_row($t_etude);
						$libelle_dis=$champ_dis[1];
						
						
						echo"<tr>
							<td  align=center>$eleve</td>
							<td  align=center>$datejour</td>	
							<td  align=center>$libelle_dis</td>							
							<td  align=center>$cours</td>
							<td  align=center>$arrivee</td>
							<td  align=center>$tuteur</td>";
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
