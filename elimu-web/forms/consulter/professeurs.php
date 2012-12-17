<?php
function separationord($page,$id,$table,$long){
$annee=annee_academique();
	 if(@($_GET[$id])=="")
	$compt=0;
	else
	$compt=$_GET[$id] ;
	
	if($compt==0)
	 $sql="select * from $table    limit $compt,".($long);
	else
	 $sql="select * from $table   limit ".($long+$long*($compt-1)).",".($long);
	//}
	 //echo"<br>".$sql;
    return $sql;

}
function afficheseparationord($page,$id,$table,$compt,$cols,$long){
$annee=annee_academique();   
   $sql1="select * from $table ";
	$exe1=mysql_query($sql1) or die(mysql_error());
	$nb=mysql_num_rows($exe1);
	$nbpage=$nb/$long;
	    echo'<tr bgcolore=blue><td colspan='.$cols.' align=center>';
                   if($compt<>0)
                   echo'<a href="'.$page.''.$id.'='.($compt-1).'"> << Précédent</a>';
                   echo'&nbsp; &nbsp;';
                   if(($compt+1)<$nbpage AND $nbpage<>1)
                   echo'<a href="'.$page.''.$id.'='.($compt+1).'">Suivant >> </a></td>';

                   echo'</tr>';
}
function affiche_dossier(){
 $annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
  $j=1;
  //$exe=mysql_query("select * from dossier limit $nbstart,$long");
   $exe=mysql_query(separationord("professeurs.php?vis=1&","compt","specialites",2));
  echo'<br><table border="0" cellpadding="0" cellspacing="5" width="800" BGcolore=yellow align=center>
       						';
					    while($row1=mysql_fetch_row($exe)) { 
						$b='';
						$p1=$row1[1];
                          	$p2=$row1[2];
						$perso = findByValue('personnels','matricule',$p1);
						$per = mysql_fetch_row($perso);
						$p3=$per[1];
						$prenom=$per[2]; 
						$nom=$per[3];
						$etag = findByValue('titre5','id',$p3);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];				
						$etagiaire = findByValue('fonction','personnel',$p1);
						$champ = mysql_fetch_row($etagiaire);
						$p18=$champ[1];
						//specialité
						$etagiai = findByValue('disciplines','iddis',$p2);
						$cham = mysql_fetch_row($etagiai);
						$uv=$cham[1];
//classe enseigner
$etage = findByNValuelib('enseigner','classe',"personnel='$p1' and discipline='$p2'");
						while($chae = mysql_fetch_row($etage)){
						$p=$chae[0];
						$b=$b.' '.$p;
						}
						
                              if($j==1)
							   echo"<tr>";
                             
						                                 $bgcolor="#00FF00";
							    echo'<td width="280" valign="top" HEIGHT=100%>
							    <table border="1" cellpadding="2" cellspacing="0"  bordercolor=white width="280" bgcolorE="red" HEIGHT=100%>
							       <tr>

							            <td  height="25" align="center" bgcolor="#CCFFFF">
							                      <div align="center" class="titre">Professeur '.$titre.' '.$prenom.' '.$nom;
							                  echo'    </div> </td></tr>
							       <tr>
							            <td  align="left" valign=top class=kc2 Bgcolor='.$bgcolor.'>
                                             <b><i><u>Discipline : </u></i></b>'.$uv.'
                                             <br><b><i><u>Classes Enseignées : </u></i></b>'.$b.'
                                             <br><b><i><u>Annee Académique : </u></i></b>'.$annee;
                                                                      echo'
							            </td>

							       </tr>
								</table>
								</td>';
							      if($j==3){
							   		echo"</tr>";
							        $j=0;
							     }
							     $j++;


					    }
					   // closedir($dir); // fermeture du dossier
					    echo"</tr>";
		afficheseparationord("professeurs.php?vis=1&","compt","specialites",@$_GET["compt"],1,2);
					    echo"
						</table>";

}
@affiche_dossier(0,2);
?>
<!--</tr></tbody>
</table>
</div>-->

