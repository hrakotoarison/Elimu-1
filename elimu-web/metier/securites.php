<?php
     function verif_connexion($tab)
  {
		      if(isset($_GET["ide"])){
		     //echo "ss";
		     $req_champs="select * from ".$tab;
		         $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
		         $ligchamps=mysql_fetch_row($exe_req_champs);
		         $recup_champs="";
		  	$i=0;

		                 $all_champs="";
		                 $guey="";

		          	for($i=1;$i<mysql_num_fields($exe_req_champs)-1;$i++)  {
		          			  $colchamps  = mysql_field_name($exe_req_champs, $i);
                               $all_champs=$all_champs."$colchamps ='".$_POST["$colchamps"]."' AND ";
                               $guey=$guey.";".$_POST["$colchamps"];
                                // echo "<br>$colchamps";
                                //$_SESSION[$i]=$_POST["$colchamps"];

		  			}

		  			$colchamps  = mysql_field_name($exe_req_champs, $i);
                     //$_SESSION[$i]=$_POST["$colchamps"];
                     $guey=$guey.";".$_POST["$colchamps"];
		            $recup_champs=" ".$all_champs." $colchamps ='".$_POST["$colchamps"]."'";;

		           $req_sel="select * from $tab where ". $recup_champs;
		          // echo $req_sel;
		  			$ex=mysql_query($req_sel) or die(mysql_error());
		            if(mysql_num_rows($ex)<>0){
		  			 // echo  "connexion Réussie";
		  			  $mykc="sss";

                     // header("location: $page_connect.php");
					}
					else{
						//form_insert($tab);
					//	echo"<table><tr><td bgcolor='red'>Nom d'utilisateur ou Mot de Passe Incorrect</td></tr></table>";
						$mykc="error";
					} /* */

                    $mu=1;
		            /*
		          //  $where=$where." ".$tab1[$d]." = ".$tab2[$d];
		          // echo "<br>".$where;

					*/
					 return  "$mykc/$guey";
		    }
	    }

function dumpMySQL($base, $mode)
{


    $entete = "-- ----------------------\n";
    $entete .= "-- dump de la base ".$base." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";

    $listeTables = mysql_query("show tables");
    while($table = mysql_fetch_array($listeTables))
    {
        // si l'utilisateur a demandé la structure ou la totale
        if($mode == 1 || $mode == 3)
        {
            $creations .= "-- -----------------------------\n";
            $creations .= "-- creation de la table ".$table[0]."\n";
            $creations .= "-- -----------------------------\n";
            $listeCreationsTables = mysql_query("show create table ".$table[0]);
            while($creationTable = mysql_fetch_array($listeCreationsTables))
            {
              $creations .= $creationTable[1].";\n\n";
            }
        }
        // si l'utilisateur a demandé les données ou la totale
        if($mode > 1)
        {
            $donnees = mysql_query("SELECT * FROM ".$table[0]);
            $insertions .= "-- -----------------------------\n";
            $insertions .= "-- insertions dans la table ".$table[0]."\n";
            $insertions .= "-- -----------------------------\n";
            while($nuplet = mysql_fetch_array($donnees))
            {
                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
                for($i=0; $i < mysql_num_fields($donnees); $i++)
                {
                  if($i != 0)
                     $insertions .=  ", ";
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                     $insertions .=  "'";
                  $insertions .= addslashes($nuplet[$i]);
                  if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")
                    $insertions .=  "'";
                }
                $insertions .=  ");\n";
            }
            $insertions .= "\n";
        }
    }

    //mysql_close();
   // $fichiers="sauvegarde_db/base".date("d-M-Y").".sql";
    $fichiers="bd/base".date("d-M-Y H.i.s").".sql";
    touch($fichiers);
     $fichierDump= fopen($fichiers, "wb+");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);
 //   echo "Sauvegarde réalisée avec succès !!";
}
 function login_connection($nomfichier,$date,$heure,$fichtest){
  	touch($nomfichier);
  	touch($fichtest);
  	$fichier = fopen($nomfichier, 'a');
  	$contents = file_get_contents($fichtest);
  	if ($contents!="Date : $date") {
      $contenu="Date : $date \r\n
  	 Heure Connection : $heure";
  	fwrite($fichier,$contenu);
  	fclose($fichier);
  	$fichiertest = fopen($fichtest, 'wb+');
  	fwrite($fichiertest,"Date : $date");
  	fclose($fichiertest);
   }
   else {
      fwrite($fichier,"
      \r Heure Connection : $heure \n");
  	  fclose($fichier);
   }

  }
?>