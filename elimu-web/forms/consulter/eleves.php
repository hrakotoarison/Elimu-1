<?php 
$sclasse=$_GET['num'];
$annee=annee_academique();
$selection =findByNbreValue("inscription","classe='".htmlentities($sclasse)."' and annee='$annee'");
$el = mysql_fetch_row($selection);
$nbre_eleve=$el[0];
?>
<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div align=left><B>&nbsp;Effectif de la classe : <? echo @$nbre_eleve;?>&nbsp;</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<A HREF="#" OnClick="window.open('liste_eleve.php?classe=<?echo $sclasse;?>&annee=<?echo $annee;?>','icfenetre','toolbar=no,status=nomenubar=yes,scrollbars=yes,dependant=yes,resizeable=yes,location=no,width=500,height=400,top=10,left=300');return(true)">
	&nbsp;<?echo " Liste Alphab�tique des El�ves";?>&nbsp;</A>
</div><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

  				 <tr bgcolor="white">
                    <th width="60"> Matricule</th>
  				 	<th width="300">El�ve</th>
  				 	<th width="500">Date & Lieu de Naissance</th>
  				 	<th width="600">Tuteur</th>
					<th width="600">Coordonn�es Tuteur</th>					
					<th width="100">Coordonn�es El�ve</th>
                </tr>
				<tbody><tr>
				<?php
				$datejour=date("Y")."-".date("m")."-".date("d");
              		$selection =  findByNValue("eleves","matricule in(select eleve from inscription where classe='".htmlentities($sclasse)."' and annee='$annee')");
              		while($row1 = mysql_fetch_row($selection))
				 	{
				 		/*echo"<tr>";
                       for($j = 0 ; $j<5 ; $j++){
                       echo"<td align='center'>".$row[$j]."</td>";
                       }
                       echo"</tr>";*/
                       	$p1=$row1[0];
						$prenom=$row1[1];
						$nom=$row1[2];
						$date_nais=$row1[4];
						$lieu_nais=$row1[5];
						$tuteur=$row1[6];
						$email_t=$row1[7];
						$tel_t=$row1[8];
						$tel_e=$row1[9];
						$adresse=$row1[11];

						
						echo"<tr>
							<td  align=center><a HREF='el_notes.php?matricule=".$p1."&num=".$sclasse."'>$p1</a></td>
							<td  align=center>$prenom".' '.$nom."</td>
							<td  align=center>$date_nais".' � '. $lieu_nais."</td>
							";
										
						echo"
							<td  align=center>$tuteur</td>
							<td  align=left>Adresse :".$adresse."</br> T�l :".$tel_t."</br>E-mail :".$email_t."</td>
							<td  align=center>$tel_e</td>
							
							</tr>";/**/
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
