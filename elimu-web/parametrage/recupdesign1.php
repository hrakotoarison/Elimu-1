<?php
include"../dao/connection.php";
//base("gescosen");
//if (isset($_POST["$choix"])) {
    	$choix=$_POST["choix"];
    	$req=mysql_query("truncate table series");
  while ($monchoix = array_shift($choix)) 
{
	
	$req_insert="insert into series values('$monchoix')";
	$exe_req_insert=mysql_query($req_insert) or die(mysql_error());
	header("Location:profile.php");
	}
//}
/*else {
   header("Location:design1.php");
}*/

?>
