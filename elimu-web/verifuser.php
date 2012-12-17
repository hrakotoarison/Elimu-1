<?php   session_start();
include"all_function.php";
$login=$_POST['Login1'];
$pwd=$_POST['Mot_de_Passe7'];
$agence=$_POST['Statut5'];
$pas="";
$matricule="";
	  $aca=annee_academique();
		$datejour=date("Y")."-".date("m")."-".date("d");
		
		$d=substr($datejour,0,7);

$_SESSION["annee"]=$aca;
if(@$_POST["Statut5"]=="Administrateur"){
$rsl=verif_connexion("administrateurs","connex_reussie.php");
$etr=explode("/",$rsl);
	if ($etr[0]=="error") {
	//echo"$etr[0]";
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php?idr=fff"
</SCRIPT>';
    //  header("location: accueil.php?idr=fff");
	}
	else {
	//echo"$rsl<br>";
	/*include"dao/user_db.php";
 dumpMySQL_end("elimu",3);*/
	$row=explode(";",$etr[1]);
	$_SESSION["login1"]=$row[1];
	$_SESSION["menu"]="menu.php";
	$_SESSION["agence"]=$agence;
    //echo $_SESSION["login1"]."/";
	// header("location: connex_reussie.php");
	 echo'<SCRIPT LANGUAGE="JavaScript">
location.href="connex_reussie.php"
</SCRIPT>';
	}
}

elseif(@$_POST["Statut5"]<>"Administrateur"){


	 $affiche="select motdepasse7,cdeetud from user where login1='$login' and profile5='$agence' and cdeetud in (select distinct matricule from personnels where enable8='1') ";
$executer=mysql_query($affiche);
while($ligne=mysql_fetch_array($executer))
{
	$pas= $ligne['motdepasse7'];//echo'<br/>';
	$matricule= $ligne['cdeetud'];
}
	 $affichec="select max(date_connect) dc from connecter where personnel='$matricule' and profile='$agence' ";
$executerc=mysql_query($affichec);
$lignec=mysql_fetch_array($executerc);
	$date_c= $lignec['dc'];
$a=substr($date_c,0,4);
$m=substr($date_c,5,2);
$j=substr($date_c,8);
$today = mktime(0,0,0, $m,$j,$a);
$today += (3600 * 24 * 7 );
// 1h * 24 = 1 jour
$ladate = date("Y-m-d ", $today);
if($pas==$pwd){

if (($agence=='CENSEUR') or($agence=='PRINCIPAL'))// header("Location:accueil1.html");
{
	$_SESSION["matricule"]=$matricule;
	$_SESSION["login1"]=$login;
	$_SESSION["agence"]=$agence;
	$_SESSION["menu"]="menu0.php";
	if(mysql_num_rows($executerc)==0 or $datejour >= $ladate) {
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="perso.php"
</SCRIPT>';
}
else{
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="connex_reussie.php"
</SCRIPT>';
	//header("location: connex_reussie.php");
	}
}


	elseif ($agence=='PROFESSEUR') //header("Location:accueil2.html");
	{
		$_SESSION["matricule"]=$matricule;
		$_SESSION["login1"]=$login;
		$_SESSION["agence"]=$agence;
		$_SESSION["menu"]="menu2.php";
		if(mysql_num_rows($executerc)==0 or $datejour >= $ladate) {
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="perso.php"
</SCRIPT>';
}
else{
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="emploisprof.php"
</SCRIPT>';
			//header("location: emploisprof.php");
			}
	}
	elseif ($agence=='SURVEILLANT') //header("Location:accueil2.html");
	{
		$_SESSION["matricule"]=$matricule;
		$_SESSION["login1"]=$login;
		$_SESSION["agence"]=$agence;
		$_SESSION["menu"]="menu1.php";
		if(mysql_num_rows($executerc)==0 or $datejour >= $ladate) {
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="perso.php"
</SCRIPT>';
															}
else{
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="connex_reussie.php"
</SCRIPT>';
		}
	}
	elseif ($agence=='ENSEIGNANT') //header("Location:accueil2.html");
	{
		$_SESSION["matricule"]=$matricule;
		$_SESSION["login1"]=$login;
		$_SESSION["agence"]=$agence;
		$_SESSION["menu"]="menu3.php";
		if(mysql_num_rows($executerc)==0 or $datejour >= $ladate) {
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="perso.php"
</SCRIPT>';
}
else{
		//header("location: connex_reussie.php");
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="connex_reussie.php"
</SCRIPT>';
		}
	}elseif ($agence=='COMPTABLE') //header("Location:accueil2.html");
	{
		$_SESSION["matricule"]=$matricule;
		$_SESSION["login1"]=$login;
		$_SESSION["agence"]=$agence;
		$_SESSION["menu"]="menu4.php";
		if(mysql_num_rows($executerc)==0 or $datejour >= $ladate) {
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="perso.php"
</SCRIPT>';
}
else{
		//header("location: connex_reussie.php");
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="connex_reussie.php"
</SCRIPT>';
		}
	}
	else
	{
	
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php?idr=fff"
</SCRIPT>';

	}
}
else
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php?idr=fff"
</SCRIPT>';


   	}



	else {
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php?idr=fff"
</SCRIPT>';

	}


?>
