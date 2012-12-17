<?php

  function audit_modifier_after($table,$champ,$idchamp,$avantchp,$nomfichier,$actionmod){        $all_pre="";
        $i=0;
        $exe_req_champs=mysql_query("select * from $table where $champ='".$idchamp."'");
        $exe_req_champs1=mysql_query("select * from $table");
        //echo mysql_num_rows($exe_req_champs);
        $rw=mysql_fetch_array($exe_req_champs);
        $fichier = fopen($nomfichier, 'a');
        if($actionmod!="Apres Modification"){
  	    $contents = file_get_contents($nomfichier);
  	    }
  	    else{
  	    $contents ="";
  	    }

        if($avantchp<>""){	        while($row = mysql_fetch_field($exe_req_champs1)){	        	//echo "szzz".$rw[2];
	            if($champ!=$row->name){
		            if($row->name=="idPro"){
		                $tab="proprietaire";
		               // ECHO"<br /> $rw[$i]</b><br />";		            	$exereq=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){
		            	  if(($m==1) or ($m==2)){		            		$all_pre=$all_pre.$lign->name." proprietaire=".$rwe[$m]."\n\r";
		            	  }
		            		$m++;		            	}		            }
		            elseif($row->name=="idNat"){
		                $tab="nature";
		              //  ECHO"<br /> $rw[$i]</b><br />";
		            	$exereq=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){
       	            	 if($m==1  or $m==2){
		            		$all_pre=$all_pre.$lign->name." nature = ".$rwe[$m]."\n\r";
		            	 }
		            		$m++;
		            	}
		            }
		            elseif($row->name=="idCl"){
		                $tab="classeur";
		               // ECHO"<br /> $rw[$i]</b><br />";
		            	$exereq=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){
		            	   if($m==1){
		            		$all_pre=$all_pre.$lign->name." classeur=".$rwe[$m]."\n\r";
		            		}
		            		$m++;
		            	}
		            }
		            elseif($row->name=="idGest"){
		                $tab="gestionnaire";
		                //ECHO"<br /> $rw[$i]</b><br />";
		            	$exereq=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where $row->name='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){
		            	    if(($m==1) or ($m==2) or ($m==6)){
		            		$all_pre=$all_pre.$lign->name." gestionnaire=".$rwe[$m]."\n\r";
		            		}
		            		$m++;
		            	}
		            }
		            elseif($row->name=="departement5"){
		                $tab="departement5";
		                //ECHO"<br /> $rw[$i]</b><br />";
		            	$exereq=mysql_query("select * from  $tab where idDep='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where idDep='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){
		            	    if($m==1){
		            		$all_pre=$all_pre.$lign->name." département=".$rwe[$m]."\n\r";
		            		}
		            		$m++;
		            	}
		            }
		            elseif($row->name=="idRa"){
		             $tab="rayon";
		                //ECHO"<br /> $rw[$i]</b><br />";
		            	$exereq=mysql_query("select * from  $tab where idRa='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where idRa='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){
		            	    if($m==1){
		            		$all_pre=$all_pre.$lign->name." $tab=".$rwe[$m]."\n\r";
		            		}
		            		$m++;
		            	}
		              /*  $tab="rayon";
		                //ECHO"<br /> $rw[$i]</b><br />";
		            	$exereq=mysql_query("select * from  $tab where idRa='".$rw[$i]."'");
		            	$exereq1=mysql_query("select * from  $tab where idRa='".$rw[$i]."'") or die(mysql_error());
		            	$rwe=mysql_fetch_array($exereq);
		            	$m=0;
		            	while($lign=mysql_fetch_field($exereq1)){		            		if($m==1){
		            		$all_pre=$all_pre.$lign->name." $tab =".$rwe[$m]."\n\r";
		            		}
                            else{                            	//                            }
		            		$m++;
		            	}  */
		            }
		            else{		            $all_pre=$all_pre.''.$row->name." $table='".$rw[$i]."'\n\r";		            }
                }

		       	$i++;

		    }
        }
        else{
	        while($row = mysql_fetch_field($exe_req_champs)){
	            if($champ<>$row->name){
		       	 $all_pre=$all_pre.$row->name."='".$_POST[$row->name]."'\n\r";
		       	}
		    }

	    }
	    $contents="\n\r";
	    $contenu=$contents."$actionmod Table : ".$table."\n\r".$all_pre;
	    fwrite($fichier,$contenu);
  	    fclose($fichier);        return $all_pre;   /*	ggg*/  }
?>