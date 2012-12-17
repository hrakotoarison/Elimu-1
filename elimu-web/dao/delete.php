<?php
//require_once('connection.php');
//fonction pour supprimer des enregistrements de toutes sortes
function delete_enregistrement($table, $champ, $condition){
	$sql_selection = "delete from ".$table." where ".$champ." = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";}


//supprimer d'un dossier

function delete_dossier($condition){
	$sql_selection = "delete from dossier where idDos = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}



//supprimer user


function delete_user($condition){
	$sql_selection = "delete from user where id = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}


//supprimer classeur


function delete_classeur($condition){

	$sql_selection = "delete from classeur where idCl = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}



//supprimer etagiaire


function delete_etagiare($condition){
	$sql_selection = "delete from  etagiare where idEt = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}


//supprimer rayon


function delete_rayon($condition){

	$sql_selection = "delete from rayon where idRa = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}


//supprimer nature


function delete_nature($condition){
	$sql_selection = "delete from nature where idNat = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}


//supprimer gestionnaire


function delete_gestionnaire($condition){
	$sql_selection = "delete from gestionnaire where idGest = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}


//supprimer proprietaire


function delete_proprietaire($condition){

	$sql_selection = "delete from proprietaire where idPro = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

 	//echo "suppression effectuee!";

}
function delete_suivi(){
 if(isset($_POST["valider"])){
  echo
  $idDos=$_POST["idDos"];
  $suivi=findByValue("suivi","idDos",$idDos);
  while($ow=mysql_fetch_row($suivi)){
  	    // echo
  	    $iduser=$ow[2];

        // echo
         $chamcoche=@$_POST["sup$iduser"];

          if($chamcoche<>""){
        // echo "<br>delete from suivi     where idDos='$idDos' AND idUser='$iduser'";
         $exe=mysql_query("delete from suivi  where idDos='$idDos' AND idUser='$iduser'");

         }
  }
}
}


?>