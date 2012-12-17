<?php
  function form_insert($table,$titre,$j,$dd){
  	$req_champs="select* from ".$table;
  	$exe_req_champs=mysql_query($req_champs) or die("erreur selection");
    //echo $req_champs;
    if ($j=="ide") {
      echo"<form name='frm' action='verifuser.php?$j=sss&' onsubmit='return (conform(this));'   method='POST'>";
    }
    else {
     echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."$dd$j=sss&' onsubmit='return (conform(this));'  enctype='multipart/form-data'   method='POST'>";
    }



  	$all_values="";
  	$i=0;
  	$mysss="";
  	$mynbt="";
     //ECHO @$_POST["sss"];
  	echo '	<legend class="kc">'.$titre.'</legend>';
  	echo"<table border=0 cellpadding=0 cellspacing=10 >";
     while($row = mysql_fetch_field($exe_req_champs)){
     $result = mysql_query("SELECT $row->name FROM $table");
	 $length = mysql_field_len($result, 0) or die();
	 //echo $length;
       $len=strlen($row->name);
       $en=$row->name;

       $n1=substr($row->name,0,1);
        $a=$en{$len-1};
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
								$type="file";
								$name=substr($row->name,0,$len-1);
                            }
                            elseif($a==5) 	{
									$type="select";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==6) 	{
									$type="mail";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==7) 	{
									$type="password";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==8) 	{
									$type="mask";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==9) 	{
									$type="radio";
									$name=substr($row->name,0,$len-1);

	        				}



           if($row->type=='int'){
             echo"<input type='hidden' name='".$row->name."'";
           }
           elseif($row->type=='string'){

            	if ($type=="numeric") {
            		//ECHO"deiee";
	           		echo "<tr>
	           		   <td>"
	           		   .str_replace("_"," ",$name).
	           		   "</td><td><input class='kc1' type=text name='".$row->name."' size='".$length."' value=''/></td></tr>";
	                  echo"
						 <script type=text/javascript>      //
		            			new SUC( document.frm.".$row->name.");       //
	    				</script>
						";
                }
	            elseif($type=="date") {
		            //echo "<tr><td>".str_replace("_"," ",$name)." </td><td> <input class=kc1 type=text name='".$row->name."' size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme' /></td></tr>";

                   	 echo "<tr><td>".str_replace("_"," ",$name).' </td><td> ';
                   	 echo ' <input type="text" id="'.str_replace("_"," ",$name).'" name="'.$row->name.'" class="kc1" value="'.date("d/m/Y").'" onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
	                lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" />
			        </td></tr> ';
	            }

	            elseif($type=="obligatoire") {


		             	 echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name=".$row->name." size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire' /></td></tr>";


	            }
	            elseif($type=="file"){

							echo "<tr><td>".str_replace("_"," ",$name)."</td><td>


							<input class=kc1  id='".str_replace("_"," ",$name)."' type=file name='".$row->name."' size='".$length."' /></td></tr>";


						//IF(isset($_POST["nature5"])){echo $_POST["nature5"];}
	                  // echo @$_POST["nature5"];
	            }
	            elseif($type=="mail") {

                      echo "<tr><td>".str_replace("_"," ",$name).' </td><td> ';

	                echo ' <input value="" type="text" id="'.str_replace("_"," ",$name).'" size="'.$length.'" name="'.$row->name.'" class="kc1"
	                lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: mail;erreur:Email non conforme" />
			   </td></tr> ';



	             //echo'<input class=kc1 type="text" name="'.$row->name.'"  size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
	             $date_ref=$row->name;
	         }
	            elseif($type=="select"){
	                     if($table!="user"){
	                          $tabsel=$name."_5";
	                          $req_sel="select * from $tabsel" ;
	                          //echo "cc ".$tabsel;
	                          $eex=mysql_query($req_sel) or die(mysql_error());


	                         //ajouter par Wa_Darou


	                     echo "<tr><td> ".str_replace("_"," ",$name).'</td><td>
	                     <select class=kc1  id="'.str_replace("_"," ",$name).'" type="text" name="'.$row->name.'" size="1" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire" />

	                     <option value=></option>
	                     ';
	                        while($ro=mysql_fetch_row($eex)){
	                            echo"<option value='".$ro[0]."' >".$ro[0]."</option>";
	                          }

	                     echo'
	                     </select>
	                     </td></tr>';
	                     }
	                     else{                           echo '<input type="hidden" class=kc1  id="'.str_replace("_"," ",$name).'"  name="'.$row->name.'" value='.$_SESSION["zone"].' size="1" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire" />';
	                     }

	               }
	            elseif($type=="password"){
     	          echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type='password' name=".$row->name." size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:Mot de Passe Obligatoire' /></td></tr>";

	            }
	            elseif($type=="radio"){
	                       $tabsel=$name."9";
	                       $req_sel="select * from $tabsel" ;
	                       //echo "cc ".$tabsel;
	                       $eex=mysql_query($req_sel) or die(mysql_error());
	                      echo" <tr><td colspan=1>".str_replace("_"," ",$name)."</td></tr>";
	                     echo"<input name=".$tabsel." type=hidden value=>";
	                     while($ro=mysql_fetch_row($eex)){
	                     	  echo "<tr><td style=padding-left:20px;>".$ro[1]."</td><td>";
	                         echo"<INPUT TYPE='radio' name='".$tabsel."' VALUE='".$ro[0]."'></td></tr>";
	                       }

	            }
	            elseif ($type=="mask"){
	              echo"<input type=hidden name='".$row->name."'";
	            }
	            else{
	           	echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type=text name="'.$row->name.'" size="'.$length.'" /></td></tr>';
	            }




           }
           elseif($row->type=='blob'){
             if($type=="obligatoire"){
               echo "<tr><td VALIGN='top'>".str_replace("_"," ",$name)."</td><td>  <textarea name='".$row->name."'  id='".str_replace("_"," ",$name)."' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;'  class=kc1 cols='70' rows='3'></textarea></td></tr>";
               }
             else{
               echo"<tr><td VALIGN='top'>".str_replace("_"," ",$name)."</td><td>  <textarea name='".$row->name."'  class=kc1 cols='70' rows='3'></textarea></td></tr>";             }
           }


            			if ($i==0) {
                              $all_values = $row->name;
		               }
		               else {
                         $all_values = $all_values.",".$row->name;
		               }
		               $i++;
    }

    echo'<tr><td>&nbsp; </td><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" /></table>
    </fieldset>
  </form> ';
     //return $all_values;
  // echo $all_values;
  }
 
 function insert_table($tab)  {
    if(isset($_GET["kct"])){

     //echo "sssm".$_GET["kct"];
     $ajout_uniq=0;
     $req_champs="select * from ".$tab;
         $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
         $ligchamps=mysql_fetch_row($exe_req_champs);
         $recup_champs="";
  	 $i=0;
  	//recuperation des champs du formulaire


         //prepa champs pour insert
         $recup_champspolice="";
                 $all_champs="";
                 $pos="";
          	for($i=0;$i<mysql_num_fields($exe_req_champs);$i++)  {
          	       $pos=$pos;
          			  $colchamps  = mysql_field_name($exe_req_champs, $i);

                             if ($all_champs=="") {
		                              if (isset($_POST["".$colchamps.""])) {
		                              $all_champs = $colchamps;
		                              $a=$colchamps{strlen($colchamps)-1};
		                              //echo $a .'/'.$colchamps;
       	                               if ($a==2 or $a==6) {
       	                                $re=str_replace(".","/",$_POST["$colchamps"]);
                                        $recup_champs =str_replace("-","/",$re);
                                       }
                                       elseif($a==4) {
                                       $stock = getcwd();
                                       $dir=$stock."/allfichiers/";
                                       move_uploaded_file($_FILES["$colchamps"]['tmp_name'], $dir.$_FILES["$colchamps"]['name']);
                                         $recup_champs ="'".addslashes($_FILES["$colchamps"]['name']);
                                       }
                                       else {
                                         $recup_champs ="'".addslashes($_POST["$colchamps"]);
                                       }

		                              }

                             }
                             else {
                              $all_champs = $all_champs.",".$colchamps;
                              $a=$colchamps{strlen($colchamps)-1};
                                       if ($a==2 or $a==6) {
                                        $re=str_replace(".","/",$_POST["$colchamps"]);
                                        $recup_champs1 = str_replace("-","/",$re);
                                         $recup_champs = $recup_champs."','".$recup_champs1;
                                       }
                                       elseif ( $a==7){
                                        $recup_champs = $recup_champs."','".($_POST["$colchamps"]);
                                       }
                                       elseif($a==4) {
                                          $stock = getcwd();
                                          $dir=$stock."/allfichiers/";
                                          move_uploaded_file($_FILES["$colchamps"]['tmp_name'], $dir.$_FILES["$colchamps"]['name']);
                                          $recup_champs = $recup_champs."','".($_FILES["$colchamps"]['name']);

                                       }
                                       else {
                                          $recup_champs = $recup_champs."','".addslashes($_POST["$colchamps"]);

                                       }

                             }

  			}

            $recup_champs="".$recup_champs."'";

            $j=0;
            for ($i=0; $i<strlen($all_champs); $i++) {
                 $tab1=explode(",",$all_champs);
                 if(isset($tab1[$i])){
                     $j++;
                  }
            }
           // echo  "j : ".$j;
            $tab2=explode(",",$recup_champs);
            $where="";
            $chp="";
            for ($d=1; $d<$j - 1; $d++) {
               $where=$where." ".$tab1[$d]." = ".$tab2[$d]." AND ";
                if($tab1[$d]=="Police1" or $tab1[$d]=="Numéro_Demande_Abonnement1")
                 $chp=$tab1[$d];
            }
           // echo $d." :d<br>";
            if(isset($tab1[$d])){
            $where=$where." ".$tab1[$d]." = ".$tab2[$d];

            if ($pos=="sss") {
              $req_sel="select * from $tab where $chp=".$recup_champspolice."'";
            }
            else {
             $req_sel="select * from $tab where ". $where;
            }


  			//echo "$tab<br>".$req_sel;

  			$ex=mysql_query($req_sel) or die(mysql_error());
			    if(mysql_num_rows($ex)==0){
  						//echo  $ajout_uniq;
	  					$req_insert='insert into '.$tab.' ('.$all_champs.') values ('.$recup_champs.')';
	  					$ajout_uniq=1;
	  					//echo $req_insert;
	  					$exe_req_insert=mysql_query($req_insert) or die (mysql_error());
	  				if($exe_req_insert){
				           	  echo"<div align=center><table><tr><td bgcolor='red'>Ajout Réussi</td></tr></table></div>";
				           	  $mykc="dd";
				           	  //form_insert($tab,"");
					}
				}
				else{
					echo"<div align=center><table><tr><td bgcolor='red'>Ajout déja Effectué</td></tr></table></div>";
					$mykc="ggg";
					 //form_insert($tab,"");
				}
				// return  $ajout_uniq;


     }
   }
    else{
     // echo"sss";
    }
 }

?>