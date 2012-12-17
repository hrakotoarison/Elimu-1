<?php
//include"css/conform.js";
  function form_action($table,$titre,$kce)
  {
     //if(!isset($_GET["id"] )){

  	  $req_champs="select * from ".$table;
      $exe_req_champs=mysql_query($req_champs) or die(mysql_error());

  	  echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."$kce id=0' onsubmit='return (conform(this));'   enctype='multipart/form-data'  method='POST'>";
  	  $all_values="";
  	  $i=0;
  	  $numpol="";
  	  $mar="ssmk";

//  	echo @$_POST["my_id"].$_GET["id"];
  	echo'
  	<legend class=top>'.$titre.'</legend>
  	<table border=0 cellpadding=0 cellspacing=1>
  	   			<tr><td  valign="top"><table border=0 cellpadding=0 cellspacing=10 > ';

  	   $i=0;
  	   if(!isset($_POST["my_id"])){

	      while($row = mysql_fetch_field($exe_req_champs)){
	        $i++;

	      	$result = mysql_query("SELECT $row->name FROM $table");
	      	//echo $row->name."<br>";
	       	$length = mysql_field_len($result, 0);
	       //	echo $length;
	       	$len=strlen($row->name);
	       	$en=$row->name;

	      // $n=substr($row->name,$len-2,$len-1);
	        $a=$en{$len-1};
	        //echo"a = $a <br>";
	        $type="";

	        			//  if(is_numeric($a)) {
	          $name=substr($row->name,0,$len);
	                            if($a==1) {
	                                 $type="obligatoire";
	                                 $name=substr($row->name,0,$len-1);
	                                // echo"sss";
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
									$mar="m";

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



	                       // }


	      // echo "<br>type : $type<br>"  ;


	       //echo $row->type."<br>";

	            if($row->type=='string'){



	               if ($type=="numeric") {

	               	//	Wa_Darou Conception

              				echo "<tr>
              		  		 <td>"
              		 		  .str_replace("_"," ",$name).
              		  		 "</td><td><input class='kc1' type=text name='".$row->name."' size='".$length."' /></td></tr>";
                     echo"
								 <script type=text/javascript>      //
				            			new SUC( document.frm.".$row->name.");       //
			    				</script>
								";


	               }
	               elseif($type=="date") {
	               echo "<tr><td>".str_replace("_"," ",$name).' </td><td> <input class=kc1 type="text" name="'.$row->name.'" size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
	               }
	               elseif($type=="mail") {
	               echo "<tr><td>".str_replace("_"," ",$name).' </td><td> <input class=kc1 type="text" name="'.$row->name.'" size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
	               $date_ref=$row->name;
	               }
	               elseif($type=="obligatoire") {


		               		echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name=".$row->name." size='".$length."'  lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire' /></td></tr>";


	               }
	               elseif($type=="file"){

						echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class=kc1  id='".str_replace("_"," ",$name)."' type=file name='".$row->name."' size='".$length."' /></td></tr>";

	               }
	               elseif($type=="select"){
                     if(!isset($_SESSION["zone"])){
                     echo "<tr><td> ".str_replace("_"," ",$name).'</td><td>

                     <select class=kc1 type="text" name="'.$row->name.'" size="1" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire" />

                     <option></option>
                     ';


                     echo'
                     </select>
                     </td></tr>';
                     }
	               }
	               elseif ($type=="mask"){
                   echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type="text" name="'.$row->name.'" size="5" readonly /></td></tr>';
                   }
	               elseif($type=="password"){
                        	  echo "<tr><td align=> ".str_replace("_"," ",$name)."</td><td>";
                            echo"<INPUT TYPE='password' name='".$row->name."' VALUE=''></td></tr>";


	               }
	               elseif($type=="radio"){

	                         $tabsel=$name."9";
                          $req_sel="select * from $tabsel" ;
                          //echo "cc ".$tabsel;
                          $eex=mysql_query($req_sel) or die(mysql_error());

                        while($ro=mysql_fetch_row($eex)){
                        	  echo "<tr><td align=> ".$ro[1]."</td><td>";
                            echo"<INPUT TYPE='radio' name='".$row->name."' VALUE='".$ro[0]."'></td></tr>";
                          }

	               }
	               else{
	              	echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type="text" name="'.$row->name.'" size="'.$length.'" /></td></tr>';
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

	    }
	 else{

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
	                       // }


	      // echo "<br>type : $type<br>"  ;


	       //echo $row->type."<br>";
	         if($row->type=='int'){
                  $kc=  $row->name;
             }

              $reqt="select $row->name from $table where $kc = ".$_POST["my_id"];
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
					            			new SUC( document.frm.".$row->name.");       //
				    				</script>
									";

	               }
	               elseif($type=="date") {
	              // echo "<tr><td>".str_replace("_"," ",$name).' </td><td> <input class=kc1 type="text" name="'.$row->name.'" value="'.$donnee.'" size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';

                    echo "<tr><td>".str_replace("_"," ",$name).' </td><td> ';

	                  echo ' <input class="kc1" type="text" id="'.$row->name.'" name="'.$row->name.'"  value="'.$donnee.'" onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
	                  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" />
					   <div id="microcal" name="microcal" style="visibility:hidden;position:absolute;border:1px gray dashed;background:#ffffff; margin-left: 30px;"  >
					   </div></td></tr> ';
	               }
	                elseif($type=="obligatoire") {

	               	 echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name=".$row->name." size='".$length."' value='".$donnee."' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire' /></td></tr>";


	               //wa_darou

               }


	               elseif($type=="mail") {
	               //echo "<tr><td>".str_replace("_"," ",$name).' </td><td> <input class=kc1 type="text" name="'.$row->name.'" value="'.$donnee.'" size="'.$length.'" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
	               echo "<tr><td>".str_replace("_"," ",$name).' </td><td> ';

	                  echo ' <input class="kc1" type="text" id="'.$row->name.'" name="'.$row->name.'"  value="'.$donnee.'"
	                  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: mail;erreur:Date non conforme" />
					   </td></tr> ';
	               $date_ref=$row->name;
	               }
	               elseif($type=="file"){

	              					echo "<tr><td>".str_replace("_"," ",$name).'<input name="sss" type="hidden" value="'.$donnee.'"></td><td>  <input class=kc1 type="file" name="'.$row->name.'" size="'.$length.'" value="'.$donnee.'" />';

	              					$mar=$donnee;
	              					 if($donnee<>'')
	              					  echo'<br><a href="allfichiers/'.$donnee.'" target="_blank">Visualiser la PJ</a>';
	              					echo'</td></tr>';

	               }
	               elseif ($type=="mask"){
                   echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type="text" name="'.$row->name.'" value="'.$donnee.'" size="5" readonly /></td></tr>';
                   }
	               elseif($type=="select"){
	               if(!isset($_SESSION["zone"])){
	                   $tabsel=$name."5";
	                   $req_sel="select * from $tabsel ";
                       $eex=mysql_query($req_sel) or die(mysql_error());
                       $champs = mysql_fetch_field($eex);
                       //$ro=mysql_fetch_row($eex);

                          $req_sel1="select * from $tabsel where $champs->name ='".$donnee."'" ;
                       //   echo  $req_sel1;
                          $eex1=mysql_query($req_sel1) or die(mysql_error());
                          $rew=mysql_fetch_row($eex1);
                          //ECHO ;
                     echo "<tr><td valign='top' bgcolore='red'> ".str_replace("_"," ",$name).'</td>
                     <td> ';


                          echo'
                          <select class=kc1 type="text" name="'.$row->name.'" size="1"  lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire" />
                          ';

							   if (mysql_num_fields($eex1)==1) {
                                   echo'
	                         	     <option value="'.$rew[0].'">'.$rew[0].'</option>
	                     			';

			                        while($ro=mysql_fetch_row($eex)){
			                        	if($rew[0]<>$ro[0]){
			                            echo"<option value='".$ro[0]."' >".$ro[0]."</option>";
			                            }
			                        }
						       }
						       else {
                                  echo'
	                         	     <option value="'.$rew[0].'">'.$rew[1].'</option>
	                     			';

			                        while($ro=mysql_fetch_row($eex)){
			                        	if($rew[0]<>$ro[0]){
			                            echo"<option value='".$ro[0]."' >".$ro[1]."</option>";
			                            }
			                        }
		                       }





                     echo'
                     </td></tr>';


	               }
	               else{	               	echo'
                          <input type="hidden" name="'.$row->name.'" value='.$_SESSION["zone"].' />
                          ';	               }
	               }
	               elseif($type=="password"){
	                  echo "<tr><td>".str_replace("_"," ",$name).'</td><td>   <input class=kc1 type="password" name="'.$row->name.'" size="'.$length.'"  value="'.$donnee.'" /></td></tr>';
	               }
	               elseif($type=="radio"){
	                   $tabsel=$name."9";
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

                     echo'

                     </td></tr>';
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
                	echo'<input class=kc1 type="hidden" name='.$row->name.'  value="'.$donnee.'"/>';
                }

	            			if ($i==0) {
	                              $all_values = $row->name;
			               }
			               else {
	                         $all_values = $all_values.",".$row->name;
			               }
			               $i++;
	    }

	   echo'<tr><td>&nbsp;<input class=kc1 name="id_action" type="hidden" value='.$_POST["my_id"].'></td><td>';
	   if(@$_GET["mod"]<>"")
	   echo'<input class=kc1 type="submit" name="modif" value="Modifier">';
       if(@$_GET["sup"]<>"")
	   echo'<input class=kc1 type="submit" name="supprim" value="Supprimer">';

	   echo'</td></tr>';
	   }



       echo"
        </table></td>
  	   ";

  	  // }

  	   $dd= date("m");
  	   $an=date("Y");
  	   $jj=date("d");
  	   $dp= $dd - 1;
  	   $anp=$an;
  	   $contp= $dp."/".$anp;
  	   $cont=$dd."/".$an;
  	      if ($dd==1) {
  	      	$dp=12;
  	      	$anp=$an - 1;
            $contp= $dp."/".$anp;
	      }


  	   //$cont=$an;
  	   if(isset($date_ref)){
  	   $d=retourne_mois($dd);
  	   $dpp=retourne_mois($dp);
  	  // ECHO $date_ref.''.$contp;
             $req_selectA="select * from $table where $date_ref like  '%".$cont."%'";
             $exec=mysql_query($req_selectA) or die(mysql_error());
        echo'
           <td valign="top" bgcolor="#BAE3BA">
             <table border=0 cellpadding=0 cellspacing=0  width=250>
  	   			<tr><td align=center>
  	   			Listes des Enregistrement du mois en Cours :'.$d." ".$an.'<br>
             <select class="kc1" size="9" name="my_id" onchange="submit();">
                 ';



             while($lig=mysql_fetch_row($exec)){
                   echo"<option value='".$lig[0]."'><div align=center>".$lig[1]."</div></option>";

             }
             echo'</select><br>';
           if($jj<=5 && $dd==date("m")){
                //echo "date passée";
                $req_selectB="select * from $table where $date_ref like  '%".$contp."%'";
             $execB=mysql_query($req_selectB) or die(mysql_error());

            echo'
           	Listes des Enregistrement du mois précedent:'.$dpp." ".$anp.'<br>
             <select class="kc1" size="9" name="my_id" onchange="frm.submit();">
                 ';



             while($lige=mysql_fetch_row($execB)){
                   echo"<option value='".$lige[0]."'><div align=center>".$lige[1]."</div></option>";

             }
             echo'</select>
             <br>';

           }


            echo' </td></tr>

            </table>';


		echo'</TD></TR>
  		 </table> ';

        }
       else{
            $req_selectA="select * from $table";
             $exec=mysql_query($req_selectA) or die(mysql_error());
        echo'
           <td valign="top" bgcolor="#BAE3BA">
             <table border=0 cellpadding=0 cellspacing=0  width=250>
  	   			<tr><td align=center>
  	   			Listes des Enregistrements<br>
             <select class="kc1" size="9" name="my_id" onchange="frm.submit();">
                 ';



             while($lig=mysql_fetch_row($exec)){
                   echo"<option value='".$lig[0]."'><div align=center>".$lig[1]."</div></option>";

             }
             echo'</select>';


            echo' </td></tr></table>';


		echo'</TD></TR>
  		 </table> ';

  		}

  		echo' </fieldset></form>';
   //return $all_values;
  // echo $all_values;
	  if (isset($_POST["supprim"]) and isset($_POST["id_action"]) ) {
	          $req_champs="select * from ".$table;
	    	  $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
	    	  $row = mysql_fetch_field($exe_req_champs);
	    	  if($row->type =="int"){
	    	 // echo audit_modifier_after($table,$row->name,@$_POST["id_action"],"sss",$_SESSION["cheminfich"],"Suppression");
	    	   $req="delete from $table where ".$row->name. " = ".$_POST["id_action"]." ";
	    	   $exer=mysql_query($req) or die(mysql_error());
	    	   if($exer){
	    	    	echo"<table><tr><td bgcolor='red'>Suppression Réussie</td></tr></table>";

	    	    }
	    	  }
	  }
	  elseif(isset($_POST["modif"]) and isset($_POST["id_action"])) {
            if(isset($_GET["id"])){
            // echo "saliou";

              $req_champs="select * from ".$table;
	    	  $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
	    	  $row = mysql_fetch_field($exe_req_champs);
			  if($row->type =="int"){
			             //   echo audit_modifier_after($table,$row->name,@$_POST["id_action"],"sss",$_SESSION["cheminfich"],"Avant Modification");
				    	    $req_champs="select * from $table where ".$row->name. " = ".$_POST["id_action"]." ";
				    	    $basreq="where ".$row->name. " = ".$_POST["id_action"]." ";
			    	      // $req_champs="select * from ".$tab ;
			                $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
			                $ligchamps=mysql_fetch_row($exe_req_champs);
			                $recup_champs="";
			  		        $i=0;
			  	//recuperation des champs du formulaire

			         //prepa champs pour insert
			            $all_champs="";
			          	for($i=0;$i<mysql_num_fields($exe_req_champs);$i++)  {
			          	$kc=$i;
			          	//echo $kc."<br>";
			          			  $colchamps  = mysql_field_name($exe_req_champs, $i);
                                  $len=strlen($colchamps);
						       	  $en=$colchamps;
					              $a=$en{$len-1};
			                             if ($all_champs=="") {
					                              if (isset($_POST["".$colchamps.""])) {
					                              $all_champs = $colchamps;
					                              //$recup_champs ="'".$_POST["".$colchamps.""];
					                                   if ($a==2 || $a==6) {
				       	                                $re=str_replace(".","/",$_POST["$colchamps"]);
				                                        $recup_champs =str_replace("-","/",$re);
				                                        $modtab="SET $colchamps = '".$recup_champs."',";
				                                       }
				                                       else {
				                                        $modtab="SET $colchamps = '" .addslashes($_POST["".$colchamps.""])."',";
				                                       }


					                              }

			                             }
			                             else {

			                             // $all_champs = $all_champs.",".$colchamps;
					                      //$recup_champs = $recup_champs."','".$_POST["".$colchamps.""];
					                       if (($kc+1)==mysql_num_fields($exe_req_champs)) {
					                         if ($a==2 || $a==6) {
					                          			//Echo "sa<BR>";
				       	                                $re=str_replace(".","/",$_POST["$colchamps"]);
				                                        $recup_champs =str_replace("-","/",$re);
				                                        $modtab=$modtab." $colchamps = '" .$recup_champs."'";
				                                       }
				                             elseif($a==4){
				                              // echo $mar."/ gg".$_FILES["$colchamps"]['name'];
				                                          $mar=$_FILES["$colchamps"]['name'].' / '.$_POST["sss"];
				                                        if($_FILES["$colchamps"]['name']<>'' AND $_FILES["$colchamps"]['name']<>$_POST["sss"]){
	                                                 	    $stock = getcwd();
	                                       					$dir=$stock."/allfichiers/";
	                                       					move_uploaded_file($_FILES["$colchamps"]['tmp_name'], $dir.$_FILES["$colchamps"]['name']);
	                                         				//$recup_champs ="'".addslashes($_FILES["$colchamps"]['name']);
	                                         				$modtab=$modtab." $colchamps = '" .addslashes($_FILES["$colchamps"]['name'])."',";
                                         				}
                                         				else{

                                         				  $modtab=$modtab." $colchamps = '" .addslashes($_POST["sss"])."',";
                                         				}

				                             }
				                             else {
				                             			//Echo "sa1<BR>";
				                                        $modtab=$modtab." $colchamps = '" .addslashes($_POST["$colchamps"])."'";
				                             }

				                           }
				                           else {
				                           	 if (($a==2) || ($a==6)) {

				       	                                $re=str_replace(".","/",$_POST["$colchamps"]);
				                                        $recup_champs =str_replace("-","/",$re);
				                                        $modtab=$modtab." $colchamps = '".$recup_champs."',";
				                             }
				                             elseif($a==4){
				                                 	   $mar=$_FILES["$colchamps"]['name'].' / '.$_POST["sss"];
				                                        if($_FILES["$colchamps"]['name']<>'' AND $_FILES["$colchamps"]['name']<>$_POST["sss"]){
	                                                 	    $stock = getcwd();
	                                       					$dir=$stock."/allfichiers/";
	                                       					move_uploaded_file($_FILES["$colchamps"]['tmp_name'], $dir.$_FILES["$colchamps"]['name']);
	                                         				//$recup_champs ="'".addslashes($_FILES["$colchamps"]['name']);
	                                         				$modtab=$modtab." $colchamps = '" .addslashes($_FILES["$colchamps"]['name'])."',";
                                         				}
                                         				else{

                                         				  $modtab=$modtab." $colchamps = '" .addslashes($_POST["sss"])."',";
                                         				}

				                             }
				                             else {
				                             		//Echo "sa3<BR>";
				                                    $modtab=$modtab." $colchamps = '".addslashes($_POST["".$colchamps.""])."',";
				                             }


				                           }

			                             }



			  			}

			          // $recup_champs="".$recup_champs."'";
			        $req_mod=" update $table ".$modtab." ".$basreq."";
			       //echo $req_mod;
			         $exe_req_mod=mysql_query($req_mod) or die(mysql_error());
			         // if($exe_req_mod){			          	audit_modifier_after($table,$row->name,@$_POST["id_action"],"sss",$_SESSION["cheminfich"],"Apres Modification");			          }
			          echo"<table><tr><td bgcolor='red'> Modification réussie</td></tr></table>";
                    
		  		}



	        }

      }

 }

?>