<?php
include"../dao/connection.php";
//base("gescosen");configuration
/*function copilogo(){
if(@$_FILES["logo"]['name']!="")
{
	copy($_FILES['logo']['tmp_name'],"logos/".$_FILES['logo']['name']);
}
}
*/
if (isset($_POST["libelle"])) {
   $libelle=$_POST["libelle"];
   $ia=$_POST["ia"];
     $iden=$_POST["iden"];
  $adresse=$_POST["adresse"];
   //$logo=$_POST["logo"];
   $slogan=$_POST["slogan"];
   $ouverture=$_POST["ouverture"];
   $fax=$_POST["fax"];
   $tel=$_POST["tel"];
   $email=$_POST["email"];
   $site=$_POST["site"];
   $bp=$_POST["bp"];
   	$datejour=date("Y")."-".date("m")."-".date("d");
    $status=$_POST["status"];
    $lien=$_POST["chemin"];
	  if(@$_FILES['logo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['logo']['name'];
$extension_upload = strtolower(  substr(  strrchr($photo, '.')  ,1)  );
//if ( in_array($extension_upload,$extensions_valides) ){
     //echo "Extension correcte";
      $tab=explode(".",$photo);
      $nb=0;
      for($i=0;$i<strlen($photo);$i++){
		  	if(isset($tab[$i])){
		        $nb+=1;
		  	}

	   }
	$stock=getcwd();
	$dir=$stock."/logos/";
	$mynb=$nb-1;
	$logo = "logo".".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['logo']['tmp_name'], $dir.$_FILES['logo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	elseif($lien<>"")
	$chemin=$lien;
	else
	$chemin="";
	//echo "insert into etablissements values('$libelle','$logo','$slogan',STR_TO_DATE( '$ouverture','%d/%m/%Y'),'$adresse','$tel','$bp','$site','$fax','$email')";

   $req_vide="truncate table etablissements";
   $exe_req_vide =mysql_query($req_vide) or die(mysql_error());
   
$req_insert="insert into etablissements values(upper('$ia'),upper('$iden'),upper('$libelle'),'$chemin',upper('$slogan'),'$ouverture','$adresse','$tel','$bp','$site','$fax','$email','$status','$datejour')";
   $exe_req_insert=mysql_query($req_insert) or die(mysql_error());
   header("Location:design.php");
   }
//}
else {
   header("Location:config.php");
}
?>

