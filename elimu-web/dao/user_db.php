<?php
function get_nb_open_days($date_start, $date_stop, $compare) {
	$arr_bank_holidays = array(); // Tableau des jours feriés
    if($compare == 'central'){
    	 //echo "comparaison ".$compare;
     	$samedi = array(0,6);
    }
    else{
    	$samedi = array(0);
    }
	// On boucle dans le cas où l'année de départ serait différente de l'année d'arrivée
	$diff_year = date('Y', $date_stop) - date('Y', $date_start);
	$j=0;
	for ($i = 0; $i <= $diff_year; $i++) {
		$year = (int)date('Y', $date_start) + $i;
		// Liste des jours feriés
		$arr_bank_holidays[] = '1_1_'.$year; // Jour de l'an
		$arr_bank_holidays[] = '1_5_'.$year; // Fete du travail
		//$arr_bank_holidays[] = '8_5_'.$year; // Victoire 1945
		$arr_bank_holidays[] = '4_4_'.$year; // Fete nationale
		$arr_bank_holidays[] = '15_8_'.$year; // Assomption
		$arr_bank_holidays[] = '1_11_'.$year; // Toussaint
		//$arr_bank_holidays[] = '11_11_'.$year; // Armistice 1918
		$arr_bank_holidays[] = '25_12_'.$year; // Noel
		$arr_bank_holidays[] = '2_12_'.$year; // Noel

			$reeq="select * from fmuslim where Date_fête2 like '%".$year."'";
			$exreeq=mysql_query($reeq) or die(mysql_error());
			while($rrow=mysql_fetch_row($exreeq)){
                 $dd=$rrow[1] ;
                 $ttab=explode("/",$dd);
                 $t1=$ttab[0];
                 $t2=$ttab[1];
                 $t3=$ttab[2];
                 if($t1<10){
                   $t1=str_replace("0","",$t1);
                 }
                 if($t2<10){
                   $t2=str_replace("0","",$t2);
                 }

   				 $arr_bank_holidays[]=$t1."_".$t2."_".$t3;
			}
			//echo "<br>NB".str_replace("/","_",$dd);

		// Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote
		$easter = easter_date($year);
		$arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
		$arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
		$arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote

	}
	//print_r($arr_bank_holidays);
	$nb_days_open = 0;
	while ($date_start < $date_stop) {
		// Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés
		// Si le jour suivant n'est ni un dimanche (0) , ni un jour férié, on incrémente les jours ouvrés
		if (!in_array(date('w', $date_start), $samedi)
		&& !in_array(date('j_n_'.date('Y', $date_start), $date_start), $arr_bank_holidays)) {
			$nb_days_open++;
		}
		$date_start += 86400;
	}
	return $nb_days_open;
}


//Fonction Recupere la base de données
function mysql_structure($base) {

  $tables = mysql_list_tables($base);
  while ($donnees = mysql_fetch_array($tables))
    {
    $table = $donnees[0];
    $res = mysql_query("SHOW CREATE TABLE $table");
    if ($res)
      {
      $insertions = "";
      $tableau = mysql_fetch_array($res);
      $tableau[1] .= ";";
      $dumpsql[] = str_replace("\n", "", $tableau[1]);
      $req_table = mysql_query("SELECT * FROM $table");
      $nbr_champs = mysql_num_fields($req_table);
      while ($ligne = mysql_fetch_array($req_table))
        {
        $insertions .= "INSERT INTO $table VALUES(";
        for ($i=0; $i<=$nbr_champs-1; $i++)
          {
          $insertions .= "'" . mysql_real_escape_string($ligne[$i]) . "', ";
          }
        $insertions = substr($insertions, 0, -2);
        $insertions .= ");\n";
        }
      if ($insertions != "")
        {
        $dumpsql[] = $insertions;
        }
      }
    }
  return implode("\r", $dumpsql);
  }


/*function dumpMySQL($base, $mode)
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
            $donnees = mysql_query("SELECT * FROM  ".$table[0]);
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
    $fichiers="sauvegarde_db/base".date("d-M-Y H.i.s").".sql";
    touch($fichiers);
     $fichierDump= fopen($fichiers, "wb+");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);
 //   echo "Sauvegarde réalisée avec succès !!";
}*/
function dumpMySQL_end($base, $mode)
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

    //mysql_close();   $fichiers="D:/sauvegarde_db/base_end".date("d-M-Y H.i.s").".sql";
    $fichiers="sauvegarde_db/base_end".date("d-M-Y H.i.s").".sql";
    touch($fichiers);
    $fichierDump= fopen($fichiers, "wb+");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);
 //   echo "Sauvegarde réalisée avec succès !!";
}

function retour_suivi($table,$champ,$titre){
$b			=  $champ{strlen($champ)-1};
$len		=  strlen($champ);
//echo $b;
 	if (is_numeric($b)) {
 		   //  echo"if";
        $name=str_replace("_"," ",substr($champ,0,$len - 1));

       // echo $name;
    }
    else {
    // echo "else";
        $name=str_replace("_"," ",$champ);
    }
echo"<fieldset>
  	<legend class=top>".$titre."</legend>";

echo'<form name="frm" action="" method="POST"  onsubmit="return (conform(this));">
   <table>
   	<tr>
   		<td> ' .$name.'</td>
   		<td>
   		<input id="'.$name.'"  type="text" size=12 class="kc1" name="rech" value=""  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; maxi:10; type: obligatoire1"> <input type="submit" class=kc1 value="ok">
         ';
if(is_numeric($b)){
  	echo "<script type=text/javascript>      //
				            			new SUC( document.frm.rech);       //
			    				</script> ";
  }

  echo "</td>
   	</tr>
   </table>
</form>";
  if (isset($_POST["rech"]) AND strlen($_POST["rech"])==10) {
      $rech 	= addslashes($_POST["rech"]);
      $rechfont	="<font  COLOR=red><B>".$_POST["rech"]."</B></font>";
      //echo"$rechfont";
         $req_champs="select * from $table where $champ like '".$rech."%'";
         //$req_champs1="select * from $table where $champs like '%".$rech."%'";
         $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
          $exe_req_champs1=mysql_query($req_champs) or die(mysql_error());
          $rod=mysql_fetch_row($exe_req_champs1);
         $champs=array();
         $chsel=array();
         $all_values="";
          $i=0;
          if (mysql_num_rows($exe_req_champs1)<>0) {
          echo"<form name='frm1' action='".$_SERVER['REQUEST_URI']."?id=0' onsubmit='return (conform(this));'   method='POST'>";
          	echo'<table border=1 cellpadding=10 cellspacing=0>';
			while($row = mysql_fetch_field($exe_req_champs)){

		        $i++;

		      	$result = mysql_query("SELECT $row->name FROM $table");
		       	$length = mysql_field_len($result, 0);

		       //	echo $length;

		       	$len=strlen($row->name);
		       	$en=$row->name;
	             $a=$en{$len-1};
		      // $n=substr($row->name,$len-2,$len-1);

		        //echo"a = $a <br>";
		        $type="";

		        			//  if(is_numeric($a)) {
		          $name=substr($row->name,0,$len);
		                            if($a==1) {
		                                 $type="obligatoire";
		                                 $name=substr($row->name,0,$len-1);
		                      		}
		                      		elseif($a==2) 	{
										$type="date";
										$name=substr($row->name,0,$len-1);
		                            }
		                            elseif($a==3) 	{
										$type="numeric";
										$name=substr($row->name,0,$len-1);
		                            }
		                             elseif($a==4) 	{
										$type="numeric_obli";
										$name=substr($row->name,0,$len-1);
		                            }
		                             elseif($a==5) 	{
										$type="select";
										$name=substr($row->name,0,$len-1);

		                            }
		                            elseif($a==6) 	{
										$type="dateoblig";
										$name=substr($row->name,0,$len-1);

		                            }

	                                 elseif($a==7) 	{
										$type="radio";
										$name=substr($row->name,0,$len-1);

		                            }
		                            elseif($a==8) 	{
										$type="mask";
										$name=substr($row->name,0,$len-1);

		        				    }
		                       // }


		      // echo "<br>type : $type<br>"  ;


		       //echo $row->type."<br>";
		         if($row->type=='int'){
	                  $kc=  $row->name;
	             }
	             $reqt="select $row->name from $table where $kc = ".$rod[0];
	             //echo $reqt;
	             $exet=mysql_query($reqt) or die(mysql_error());
	             $rww=mysql_fetch_array($exet);
	          	 $donnee=$rww["".$row->name.""];
	              // $donnee="kc" ;

		            if($row->type=='string'){

		              	if ($type=="numeric") {
		              		echo "<tr><td>".str_replace("_"," ",$name).'</td><td>  <input class=kc1 type="text" name="'.$row->name.'" size="'.$length.'" value="'.$donnee.'" /></td></tr>';
		                     echo"
										 <script type=text/javascript>      //
						            			new SUC( document.frm1.".$row->name.");       //
					    				</script>
										";
		               }
		               elseif($type=="date") {
		              // echo "<tr><td>".str_replace("_"," ",$name).' </td><td> <input class=kc1 type="text" name="'.$row->name.'" value="'.$donnee.'" size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
                        if ($row->name=="Date_Visite2") {
                           $idaba="Date Revisite";
                        }
                        else{
                          $idaba=str_replace("_"," ",$name);
                        }


	                    echo "<tr><td>".$idaba.' </td><td>';
	                    if ($table=="controle") {
                          echo' <input name="pre_visite" type="hidden" value="'.$donnee.'">';
                        echo ' <input class="kc1" type="text" id="'.$row->name.'" name="'.$row->name.'"  value="" onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
		                  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" />
						   <div id="microcal" name="microcal" style="visibility:hidden;position:absolute;border:1px gray dashed;background:#ffffff; margin-left: 30px;"  >
						   </div></td></tr> ';
                        }
                        else{
                        	 echo ' <input class="kc1" type="text" id="'.$row->name.'" name="'.$row->name.'"  value="'.$donnee.'" onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
		                  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" />
						   <div id="microcal" name="microcal" style="visibility:hidden;position:absolute;border:1px gray dashed;background:#ffffff; margin-left: 30px;"  >
						   </div></td></tr> ';
                        }
		               }
			           elseif($type=="obligatoire") {

			               if($row->name=="Police1" or $row->name=="Numéro_Demande_Abonnement1"){
			                    echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name='".$row->name."' value=".$donnee."  size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;mini:10;maxi:10; type:obligatoire1;erreur:champ Incorrect dddd sss' /></td></tr>";
			                     echo"
											 <script type=text/javascript>      //
							            			new SUC( document.frm1.".$row->name." );       //
						    				</script>
											";
						   }
			               elseif($row->name=="Numéro_Compteur1" or $row->name=="Compteur_Pose1"){
			                    echo "<tr><td>".str_replace("_"," ",$name)."</td><td>
			                    <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name=".$row->name." value=".$donnee."  size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;maxi:8;type:obligatoire_sc1' /></td></tr>";
			                     echo"
											 <script type=text/javascript>      //
							            			new SUC( document.frm.".$row->name." );       //
						    				</script>
											";
						   }
			               else{
			               	 echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name=".$row->name." size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire' /></td></tr>";
			               }

		               }


		               elseif($type=="dateoblig") {
		               //echo "<tr><td>".str_replace("_"," ",$name).' </td><td> <input class=kc1 type="text" name="'.$row->name.'" value="'.$donnee.'" size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
		                if ($row->name=="Date_Abonnement6") {
                         $idaba="Date Retour";
                        }
                        else{
                          $idaba=str_replace("_"," ",$name);
                        }
                        echo "<tr><td>".$idaba.' </td><td> ';

                        if ($table=="controle") {
                          echo' <input name="pre_abo" type="hidden" value="'.$donnee.'">';
                          echo ' <input class="kc1" type="text" id="'.$idaba.'" name="'.$row->name.'"  value="" onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
		                  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" />
						   <div id="microcal" name="microcal" style="visibility:hidden;position:absolute;border:1px gray dashed;background:#ffffff; margin-left: 30px;"  >
						   </div></td></tr> ';
                        }
                        else{
                        	 echo ' <input class="kc1" type="text" id="'.$row->name.'" name="'.$row->name.'"  value="'.$donnee.'" onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
		                  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" />
						   <div id="microcal" name="microcal" style="visibility:hidden;position:absolute;border:1px gray dashed;background:#ffffff; margin-left: 30px;"  >
						   </div></td></tr> ';
                        }




		               $date_ref=$row->name;
		               }
		               elseif($type=="numeric_obli"){
		              	echo "<tr><td>".str_replace("_"," ",$name).'</td><td>  <input class=kc1 type="text" name="'.$row->name.'" size="'.$length.'" value="'.$donnee.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire" /></td></tr>';
		              	 echo"
										 <script type=text/javascript>      //
						            			new SUC( document.frm1.".$row->name." );       //
					    				</script>
										";
		               }
		               elseif ($type=="mask"){
	                   echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type="text" name="'.$row->name.'" value="'.$donnee.'" size="5" readonly /></td></tr>';
	                   }
		               elseif($type=="select"){
		                   $tabsel=$name."_5";
		                   $req_sel="select * from $tabsel ";
	                       $eex=mysql_query($req_sel) or die(mysql_error());
	                       $champs = mysql_fetch_field($eex);
	                       //$ro=mysql_fetch_row($eex);

	                          $req_sel1="select * from $tabsel where $champs->name ='".$donnee."'" ;
	                       //   echo  $req_sel1;
	                          $eex1=mysql_query($req_sel1) or die(mysql_error());
	                          $rew=mysql_fetch_row($eex1);
	                          // ECHO mysql_num_rows($eex1);
	                   /*  echo "<tr><td> ".str_replace("_"," ",$name)."</td>
	                     <td>
	                     <select class=kc1 type='text' name='".$row->name."' size='1' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire' >
	                      <option value='".$rew[0]."'>'".$rew[1]."'</option>";
	                        while($ro=mysql_fetch_row($eex))
	                        {
	                        	if($rew[0]<>$ro[0]){
	                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
	                            }
	                        }

	                     echo"</select>
	                     </td></tr>"; */

		               }
		               elseif($type=="radio"){
		                   $tabsel=$name."7";
		                   $req_sel="select * from $tabsel ";
	                       $eex=mysql_query($req_sel) or die(mysql_error());
	                       $champs = mysql_fetch_field($eex);
	                       //$ro=mysql_fetch_row($eex);

	                          $req_sel1="select * from $tabsel where $champs->name ='".$donnee."'" ;
	                        // echo  $req_sel1;
	                          $eex1=mysql_query($req_sel1) or die(mysql_error());
	                          $rew=mysql_fetch_row($eex1);
	                          if(mysql_num_rows($eex1)<>0){
	                          echo "<tr><td align=> ".$rew[1]."</td><td>";
	                            echo"<INPUT TYPE='radio' name='".$tabsel."' VALUE='".$rew[0]."' CHECKED></td></tr>";
	                          // ECHO mysql_num_rows($eex1);
	                           }
	                        while($ro=mysql_fetch_row($eex)){
	                        	if($rew[0]<>$ro[0]){
	                            echo "<tr><td align=> ".$ro[1]."</td><td>";
	                            echo"<INPUT TYPE='radio' name='".$row->name."' VALUE='".$ro[0]."'></td></tr>";
	                            }
	                          }


		               }


		               else{
		              	echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type="text" name="'.$row->name.'" size="'.$length.'"  value="'.$donnee.'" /></td></tr>';
		               }


		            }
		            elseif($row->type=='blob'){
		                 if($type=="obligatoire"){
			               echo "<tr><td VALIGN='top'>".str_replace("_"," ",$name)."</td><td>  <textarea name='".$row->name."' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:".str_replace("_"," ",$name)." Obligatoire'  class=kc1 cols='50' rows='3'>".$donnee."</textarea></td></tr>";
			             }
			             else{
			               echo"<tr><td VALIGN='top'>".str_replace("_"," ",$name)."</td><td>  <textarea name='".$row->name."'  class=kc1 cols='50' rows='3'>".$donnee."</textarea></td></tr>";             }

		            }
	                elseif($row->type=='int'){
	                	echo'<input class=kc1 name="id_action" type="hidden" value='.$rod[0].'><input class=kc1 type="hidden" name='.$row->name.'  value="'.$donnee.'"/>';

	                }


                  // echo  $row->type;
		    }
           echo'</table><table border=0 height=40 BGCOLORe=red>
           <tr><td>&nbsp;</td><td><input class=kc1 type="submit" name="modif" value="Modifier"></td></tr>
           </table>
           </form>';
		  }
		  else {
               echo "Aucun Résultat pour : ".$_POST["rech"];
		  }
     //return $_POST["rech"];
  }
  else {
    echo'<SCRIPT>
       // alert("Veuillez au moins renseigner le champs","Erreur");
    </SCRIPT>';
     $idtest="ssm";
   // return $idtest;
  }
  if (isset($_POST["modif"]) AND $table=="perte_anomalie") {
       $requpd="UPDATE $table
       		set Police1=".$_POST["Police1"].",
       		Durée_en_jours4= ".$_POST["Durée_en_jours4"].",
       		KWH_Facture4=".$_POST["KWH_Facture4"].",
       		Date6=".$_POST["Date6"].",
       		Numéro_Facture4=".$_POST["Numéro_Facture4"].",
       		Montant4= ".$_POST["Montant4"].",
       		motif_suivi5=".$_POST["motif_suivi5"]."
       		where idperte=".$_POST["idperte"]."
       		";
       if( @mysql_query($requpd))
       echo"<table><tr><td bgcolor='red'>Modification réussie</td></tr></table>";
  }
  else if (isset($_POST["modif"]) AND $table=="controle") {
   $police=$_POST["Numéro_Demande_Abonnement1"];
   $date_abo=$_POST["pre_abo"];
   $date_visite=$_POST["pre_visite"];
   $date_retour=$_POST["Date_Abonnement6"];
   $date_revisite=$_POST["Date_Visite2"];
       $requpd="UPDATE $table
       		set Date_Abonnement6 =".$_POST["Date_Abonnement6"].",
       		Observations1 = ".$_POST["Observations1"].",
       		 Date_Visite2 =".$_POST["Date_Visite2"]."
       		where idcontrole=".$_POST["idcontrole"]."
       		";
       if( @mysql_query($requpd))
       echo"<table><tr><td bgcolor='red'>Modification réussie</td></tr></table>";
       $requete2 = "select * from visite where Police1 = ".$police." AND   Date_abonnement2='".$date_abo."'
       AND Date_visite2 ='".$date_visite."' AND  Date_retour2='".$date_retour."' AND Date_revisite2='".$date_revisite."'";
       $exe_request2 = mysql_query($requete2) or die(mysql_error());

        if(mysql_num_rows($exe_request2)==0){
       			$requete = "select nbre_visite from visite where Police1 = ".$police;
				$exe_request = mysql_query($requete) or die(mysql_error());
				if(mysql_num_rows($exe_request) <> 0){
					$tete = mysql_fetch_row($exe_request);
					$nbre_visite = $tete[0];
					$nbre_visite = $nbre_visite + 1 ;
					$ajout_visite = "insert into visite values ('','$police','$date_abo','$date_visite',";
					$ajout_visite.="'$date_retour','$date_revisite','$nbre_visite')";
					$save = mysql_query($ajout_visite) or die(mysql_error());
						if($save){
							//    echo "<br><b>OK</b>";
						}
                }
                else{
                    $nbre_visite = 1 ;
					$ajout_visite = "insert into visite values ('','$police','$date_abo','$date_visite',";
					$ajout_visite.="'$date_retour','$date_revisite','$nbre_visite')";
					$save = mysql_query($ajout_visite) or die(mysql_error());
						if($save){
						//    echo "<br><b>OK</b>";
						}
				}
         }
 }

echo'
   </fieldset>';
  //
  }
//function Recherche

function recherche($table,$champ,$titre){
$b			=  $champ{strlen($champ)-1};
$len		=  strlen($champ);
//echo $b;
 	if (is_numeric($b)) {
 		   //  echo"if";
        $name=str_replace("_"," ",substr($champ,0,$len - 1));

       // echo $name;
    }
    else {
    // echo "else";
        $name=str_replace("_"," ",$champ);
    }

echo'<form name="frm" action="" method="POST"  onsubmit="return (conform(this));">
   <table>
   	<tr>
   		<td>Recherche '.$name.'</td>
   		<td>
   		<input name="rech" CLASS="kc1" id="'.$name.'" type="text" value="" onblur="if(this.value<>""){submit();}" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;mini:3; type: obligatoire2"> <input type="submit" value="ok">
         ';


  echo 		'</td>
   	</tr>
   </table>
</form>';
  if (isset($_POST["rech"]) AND $_POST["rech"]<>"") {
      $rech 	= addslashes($_POST["rech"]);
      $rechfont	="<font  COLOR=red><B>".$_POST["rech"]."</B></font>";
      //echo"$rechfont";
         $req_champs="select * from $table where $champ like '".$rech."%'";
         //$req_champs1="select * from $table where $champs like '%".$rech."%'";
         $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
         $exe_req_champs1=mysql_query($req_champs) or die(mysql_error());
         $champs=array();
         $chsel=array();
        // $i=0;
        ECHO '
        <FIELDSET class="set" style="width:800px;border-style:yes;text-align : center; border-color:green;padding-bottom:10px;"><legend>'.$titre.' '.mysql_num_rows($exe_req_champs).'Résultat(s) pour '.$_POST["rech"].'</legend>';


          if (mysql_num_rows($exe_req_champs)<>0) {
        //$lig=mysql_fetch_array($exe_req_champs);
          //$d=1;
                 // echo "<br>dd ".$req_champs1[$d];
           while($lig=mysql_fetch_row($exe_req_champs)){
            echo'<table border=1 cellpadding=10 cellspacing=0>';
            //for ($d=1; $d<=mysql_num_rows($exe_req_champs); $d++) {
              $i=0;
              //echo"avt champs $d";
             while($row = mysql_fetch_field($exe_req_champs1)){
             //	echo"apr champs $d";
               //ECHO mysql_num_rows($exe_req_champs);
            	$recupcle   =  $row->primary_key;
           	 	$colchamps  =  mysql_field_name($exe_req_champs1, $i);
          		$a			=  $colchamps{strlen($colchamps)-1};
          		$len		=  strlen($colchamps);
               // echo 'kc';
               //echo "$colchamps  : $champ<br>";
                if ($colchamps==$champ) {
                  $mytest="sal";
                  $dev=$i;
                  //echo"voici $dev <br>";
                }
	                if ($recupcle  != 1){

	                        if (is_numeric($a)) {
	                            $name=str_replace("_"," ",substr($colchamps,0,$len-1));
	                            if($a=="5"){
                                    $chsel[$i]= substr($colchamps,0,$len-1).'_5';

	                            }
	                            elseif($a=="7"){
                                    $chsel[$i]= substr($colchamps,0,$len-1).'7';

	                            }
	                        }
	                        else {
	                            $name=str_replace("_"," ",$colchamps);
	                        }
	                    //  echo'
	  	   				//<tr><td  valign="top">'.$name.'</td><td  valign="top"></td></tr>';
	  	   				$champs[$i]=$name;


	                }
	                else{
	                $testmy="kc";
	                // echo $recupcle;

	                }

	                $i++;
             }

             if (isset($testmy)) {
               for ($ii=1; $ii<mysql_num_fields($exe_req_champs1); $ii++){
                if (isset($mytest) AND $ii==$dev) {
                   echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200>".str_replace($_POST["rech"],$rechfont,$lig[''.$ii.''])."</td></tr>";
                }
                else {
                   if (isset($chsel[$ii])) {
                    // echo" <BR>voici".$chsel[$ii];
                        $req_="select * from  ".$chsel[$ii];
                        $exe_=mysql_query($req_)or die (mysql_error());
                        $z=1;
                        while($rw=mysql_fetch_field($exe_)){
	                        if ($rw->primary_key ) {
	                            if($lig[''.$ii.'']<>""){
		                        $req_1="select * from  ".$chsel[$ii]." where $rw->name = ".$lig[''.$ii.'']."";
		                        $exe_1=mysql_query($req_1)or die (mysql_error());
		                       // echo" <BR>voici :".$req_." <BR> :".$req_1." <BR> :".$lig[''.$ii.''];

		                        $rww=mysql_fetch_row($exe_1);
		                        echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200>".$rww[1]."</td></tr>";
		                        }
		                        else{
		                        	echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200 align=center>-</td></tr>";
		                        }
	                        }
	                        else {

	                        }
                         }
                   }
                   else {
                       echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200>".$lig[''.$ii.'']."</td></tr>";
                   }

                }

               }

             // echo"<br>";
             }
             else {
               for ($ii=0; $ii<mysql_num_fields($exe_req_champs1); $ii++) {
                if (isset($mytest) AND $ii==$dev) {
                   echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200>".str_replace($_POST["rech"],$rechfont,$lig[''.$ii.''])."</td></tr>";
                }
                else {
                   if (isset($chsel[$ii])) {
                       //echo "saliou";
                        $req_="select * from  ".$chsel[$ii];
                        $exe_=mysql_query($req_)or die (mysql_error());
                        while($rw=mysql_fetch_field($exe_)){
	                        if ($rw->primary_key ) {
	                        $req_1="select * from  ".$chsel[$ii]." where $rw->name = ".$lig[''.$ii.''];
	                        $exe_1=mysql_query($req_1)or die (mysql_error());
	                        $rww=mysql_fetch_row($exe_1);
	                         echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200>".$rww[1]."</td></tr>";
	                        }
	                        else {

	                        }
                         }
                   }
                   else {
                       echo  "<tr><td width=200>".$champs[$ii]." </td><td width=200>".$lig[''.$ii.'']."</td></tr>";
                   }

                }

               }

             }

              if (strlen($_POST["rech"])==10) {
                    if($table=="controle"){
		              $sreq="select * from visite where Police1='".$_POST["rech"]."'";
		              $eexe=mysql_query($sreq);
		              if (mysql_num_rows($eexe)<>0) {
		              	$nbre=mysql_num_rows($eexe)+1;
		                echo  "<tr><td width=200>Nombre de Visite</td><td width=200>".$nbre."</td></tr>";
		              }
		              else{
		              	echo  "<tr><td width=200>Nombre de Visite(s)</td><td width=200>1</td></tr>";
		              }

		            }


                }

             echo"<br>";

           //  $d++;
             // $exe_req_champs1="";
             //echo $i;
            //}
            }
         // mysql_close();



            echo'</table>';

            //echo"<br> d : ".$d;
         // }

		  }
		  else {
               echo "Aucun Résultat pour : ".$_POST["rech"];
		  }
		  echo'</fieldset>';
     return $_POST["rech"];
  }
  else {
     $idtest="ssm";
    return $idtest;
  }



  }

//fin Recherche
?>
