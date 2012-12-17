<?php
 include"../dao/connection.php";
//base("gescosen");
if (isset($_POST["choix"])) {
   /*$libelle=$_POST["annee"];
   $cycle=$_POST["cycle"];*/
   $choix=$_POST["choix"];
    $req=mysql_query("truncate table categories");
    	
	//$req=mysql_query("delete from cycles ");
  while ($monchoix = array_shift($choix)) 
{
	
	$req_insert="insert into categories values('$monchoix')";
	$exe_req_insert=mysql_query($req_insert) or die(mysql_error());
//	header("Location:admin.php");
	}
	$exess1=mysql_query("select count(*)nb from categories where cycle='MOYEN' OR cycle='SECONDAIRE'");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $nb=$roi1["nb"];
				 }
 /*   
   $req_insert='insert into categories values("'.$libelle.'","'.$cycle.'")';
   $exe_req_insert=mysql_query($req_insert) or die(mysql_error());
   */
   if($nb <> 0) 
  // header("Location:profile.php");
      echo'<SCRIPT LANGUAGE="JavaScript">
location.href="profile.php"
</SCRIPT>';
//}
	else
	//header("Location:users.php");
	
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="users.php"
</SCRIPT>';
	}
	

else {
   //header("Location:config1.php");
   echo'<SCRIPT LANGUAGE="JavaScript">
location.href="config.php"
</SCRIPT>';
}


?>
