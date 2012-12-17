<html>

<head>
  <title></title>
</head>

<body>

<?php
  function affiche_dossier($table,$nbstart,$long){
  $exe=mysql_query("select * from $table limit $nbstart,$long");
echo'<table border="0" cellpadding="0" cellspacing="5" width="750" BGcolore=yellow>
       						';

					    while($row=mysql_fetch_row($exe)) { // lecture d'une entrée
					      $theme=$row[2];
					      $ref=$row[3];
					      $idPro=$row[1];
					      $idNat=$row[4];
					      $idCl=$row[5];
					      $idGest=$row[6];
					      $daenr=$row[7];
					        //création d'un tableau à 2 colonnes : nom + date fichiers
					        // bb$file = readdir($dir)
                            // bb    $path_parts = pathinfo($file);
							 // Affiche Array ( [dirname] => /forum [basename] => index.php [extension] => php )
							// bb $aa=$path_parts;

							//echo @$aa["extension"];
							//if(@$aa["extension"]=="JPG"  or @$aa["extension"]=="jpg" or @$aa["extension"]=="GIF"  or @$aa["extension"]=="gif"){


                              if($i==1)
							   echo"<tr>";

							    echo'<td width="250" valign="top" HEIGHT=100%>
							    <table border="0" cellpadding="0" cellspacing="0" width="250" bgcolorE="red" HEIGHT=100%>
							       <tr>

							            <td  height="25" align="center" bgcolorE="#CCFFFF">
							                      <div align="center" class="titre">Dossier '.
							                           $theme.'
							                      </div>
							            </td>

							       </tr>
							       <tr>
							            <td  align="center" valign=top>
                                             Réf :'.$ref.'
							            </td>

							       </tr>
								</table>
								</td>';
							      if($i==3){
							   		echo"</tr>";
							        $i=0;
							     }
							     $i++;


					    }
					   // closedir($dir); // fermeture du dossier
					    echo"</tr>
						</table>";
}

?>

</body>

</html>