<?php
//save profile
function save_profile(){
	if(isset($_POST["libelle1"])){

	//$nom = addslashes($_POST['libelle1']);
	$cycle = addslashes($_POST['cycle']);
	$choix=@$_POST["choix"];

$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun profile !!";
//exit;
}
else{
 while ($monchoix = array_shift($choix)) 
{
	   $exereq=mysql_query("select * from profiles where libelle= '$monchoix' and cycle='$cycle'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO profiles VALUES ( '$monchoix','$cycle')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
						}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Profile  ".$monchoix." d�ja enregistr� pour le cycle".$cycle;
     }
    }
}
}
}
//save nideau d'�tude
function save_etude(){
$niveau="";
$cycle="";
$status="";
//$filiere="";
$serie="";
//$mensualite=0;

if(isset($_POST["cycle"])){
	//$niveau = addslashes($_POST['niveau']);
	$cycle = addslashes($_POST['cycle']);
	$choix=@$_POST["choix"];

$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun niveau d'�tude !!";
//exit;
}
else{

	if($cycle <>'SECONDAIRE' and $cycle <>'PROFESSIONNEL'){
	
	 while ($niveau = array_shift($choix)) 
{

 $exereq=mysql_query("select * from etudes where libelle='$niveau' ");
    if(mysql_num_rows($exereq)==0){

$sql_ajout="INSERT INTO etudes(idetude,niveau,libelle,cycle) VALUES ('','".htmlentities($niveau)."','".htmlentities($niveau)."','".htmlentities($cycle)."')";
$query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
				//$sql_ajoutm="INSERT INTO mensualites VALUES ('', '$mensualite','$inscription', '$niveau')";

    //$query_ajoutm=mysql_query($sql_ajoutm) or die(mysql_error);
				echo"<div align=center class=imp>Niveau Etude ".$niveau." Enregistr�!</div>";
			}
else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{
    	echo "<br>Niveau d'etude ".$niveau." existe d�ja";
    }
	}
	}

	elseif($cycle =='SECONDAIRE'){
	$serie = addslashes($_POST['serie']);
	 while ($niveau = array_shift($choix)) 
{
if ($niveau=='2nd'){
	
if($serie!="S" && $serie!="L"&& $serie!="G"&& $serie!="T"){
echo 'la serie doit etre S ou L ou G ou T';
}
else{

 $exereq=mysql_query("select * from etudes where libelle=concat('$niveau','$serie') ");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO etudes VALUES ('','$niveau', '$serie', concat('$niveau','$serie'),'$cycle')";

    $query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
			
		//		$sql_ajoutm="INSERT INTO mensualites VALUES ('', '$mensualite','$inscription', concat('$niveau','$serie'))";
   // $query_ajoutm=mysql_query($sql_ajoutm) or die(mysql_error);
			  
			echo"<div align=center class=imp>".$niveau.$serie." Enregistr�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{
    	echo "<br>Niveau d'etude ".$niveau.$serie." existe d�ja";
    }
}
 }
 elseif(($niveau=='1er') ){
 if($serie=='S' || $serie=='L'){
echo 'la serie doit etre diff�rent de S et de L';
}
else{
$niv=htmlentities($niveau);
$se=htmlentities($serie);
 $exereq=mysql_query("select * from etudes where libelle=concat('$niv','$se') ");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO etudes VALUES ('','$niv', '$se', concat('$niv','$se'),'$cycle')";

    $query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
			
				//$sql_ajoutm="INSERT INTO mensualites VALUES ('', '$mensualite','$inscription', concat('$niveau','$serie'))";

 //   $query_ajoutm=mysql_query($sql_ajoutm) or die(mysql_error);
			  
			echo"<div align=center class=imp>".$niveau.$serie." Enregistr�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{
    	echo "<br>Niveau d'etude ".$niveau.$serie."  existe d�ja";
    }
}
 }
elseif(($niveau=='Tle')){
 if($serie=='S' or $serie=='L'){
echo 'la serie doit etre diff�rent de S et de L';
}
else{
$niv=htmlentities($niveau);
$se=htmlentities($serie);
//$libel=$niv.se
 $exereq=mysql_query("select * from etudes where libelle=concat('$niv','$se') ");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO etudes VALUES ('','$niv', '$se', concat('$niv','$se'),'$cycle')";

    $query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
			
	//		$sql_ajoutm="INSERT INTO mensualites VALUES ('', '$mensualite','$inscription', concat('$niveau','$serie'))";
   // $query_ajoutm=mysql_query($sql_ajoutm) or die(mysql_error);
			  
			echo"<div align=center class=imp>".$niveau.$serie." Enregistr�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{
    	echo "<br>Niveau d'etude ".$niveau.$serie." existe d�ja";
    }
}
 }

}
	}
	elseif( $cycle =='PROFESSIONNEL'){
	
	$serie = addslashes($_POST['filiere']);
	 while ($niveau = array_shift($choix)) 
{
$niv=htmlentities($niveau);
$se=htmlentities($serie);
 $exereq=mysql_query("select * from etudes where libelle=concat('$niv','$se')");
    if(mysql_num_rows($exereq)==0){

$sql_ajout="INSERT INTO etudes VALUES ('','$niv', '$se', concat('$niv','$se'),'$cycle')";
$query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			//	$sql_ajoutm="INSERT INTO mensualites VALUES ('', '$mensualite','$inscription', concat('$niveau','$serie'))";
    //$query_ajoutm=mysql_query($sql_ajoutm) or die(mysql_error);
				echo"<div align=center class=imp>Niveau Etude  Enregistr�!</div>";
			}
else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{
    	echo "<br>Niveau d'etude ".$niveau." existe d�ja";
    }
	}
	}
}
	}
	}
// ajout classe
function save_classe(){

	//echo "<br>bienvenu pour ajouter un utilisateur <br>";
	if(isset($_POST["nbre_classe"]))
	$nbre = addslashes($_POST['nbre_classe']);
	
	if(isset($_POST["niveau"]))
	$niveau = addslashes($_POST['niveau']);
	
	if(isset($_POST["annee"]))
	$annee = addslashes($_POST['annee']);
	$v="";
	if(@$nbre==1){
	//$v=""; 
	$exereq=mysql_query("select * from classes where etude= '".htmlentities($niveau)."'");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO classes(etude,numero,libelle) VALUES ( '".htmlentities($niveau)."','','".htmlentities($niveau)."')";

   $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Cette Classe existe d�ja";
     }

	}
	else{

for ($i=1;$i<=@$nbre;$i++) 
{
if($i==1){
$v='A';}
elseif($i==2){
$v='B';}
elseif($i==3){
$v='C';}
elseif($i==4){
$v='D';}
elseif($i==5){
$v='E';}
elseif($i==6){
$v='F';}
elseif($i==7){
$v='G';}
elseif($i==8){
$v='H';}
elseif($i==9){
$v='I';}
elseif($i==10){
$v='J';}
//echo "classe ( ".$niveau.",".@$annee.",".$v." )";
$niv=htmlentities($niveau);

$exereq=mysql_query("select * from classes where libelle= concat('$niv','$v') ");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO classes(etude,numero,libelle) VALUES ( '".htmlentities($niveau)."','".$v."',concat('$niv','$v'))";

   $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Cette Classe existe d�ja";
     }
}
}
}
//save discipline
function save_discipline(){
if(isset($_POST["libelle"])){
	$nom = addslashes($_POST['libelle']);
$choix=@$_POST["choix"];
 $ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun cycle !!";
//exit;
}
else{
  while ($monchoix = array_shift($choix)) 
{
$ch= htmlspecialchars($monchoix, ENT_QUOTES);
$uv= htmlspecialchars($nom, ENT_QUOTES);
            // ("select * from disciplines where libelle= '".$uv."' and etude='".$ch."'");
			// echo ("select * from disciplines where libelle= '".htmlentities($nom)."' and cycle='".htmlentities($monchoix)."'");
	    $exereq=mysql_query("select * from disciplines where libelle= '".htmlentities($nom)."' and cycle='".htmlentities($monchoix)."'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO disciplines VALUES ( '','".htmlentities($nom)."','".htmlentities($monchoix)."')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
							}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  
      	  }
     else{
    	echo "<br>Discipline   ".htmlentities($nom)." d�ja enregistr�e pour le cycle ".htmlentities($monchoix);
		}
	 }
	 } 
						}
}
//save personnel
function save_personnel(){
if(isset($_POST["matricule"])){

	$matricule = addslashes($_POST['matricule']);
	$titre = addslashes($_POST['titre']);
	$nom = addslashes($_POST['nom']);
	$prenom = addslashes($_POST['prenom']);
	$sexe = addslashes($_POST['sexe']);
	$tel = addslashes($_POST['tel']);
	$adresse = addslashes($_POST['adresse']);	
	$matrimonial = addslashes($_POST['matrimonial']);
	$mail = addslashes($_POST['mail']);
	$corps = addslashes($_POST['corps']);
	$echelon = addslashes($_POST['echelon']);
	$grade = addslashes($_POST['grade']);
	$date_c = addslashes($_POST['date_c']);
	$date_nais = addslashes($_POST['date_nais']);
	$lieu_nais = addslashes($_POST['lieu_nais']);
	$profile = addslashes($_POST['classe']);
	$enable='1';
		$choix=@$_POST["choix"];
if($profile=='AUTRES'){
	$login ="";
	$password ="";
	}
	else{
	$result = mysql_query("SELECT * FROM etablissements") or die(mysql_error()); 
	$row = mysql_fetch_array( $result );
 $etablissement=$row['libelle'];
	$login = addslashes($_POST['pseudo']);
	$password = addslashes($_POST['passe']);
	//parametrage d'envoie de message
}
$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun cycle !!";
//exit;
}
else{
	
		if($_FILES['photo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['photo']['name'];
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
	$dir=$stock."/photos/";
	$mynb=$nb-1;
	$p=str_replace('/', '-', $matricule);
	$logo ="perso". $p.".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	else
	$chemin="";
		
    $exereq=mysql_query("select * from personnels where matricule='$matricule'");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO personnels VALUES ('$matricule', '$titre', '$prenom','$nom' ,'$matrimonial','$sexe','$date_nais','$lieu_nais', '$tel', '$adresse','$mail','$chemin','$enable','$corps','$grade','$echelon','$date_c')";
    $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			  while ($monchoix = array_shift($choix)) 
{
	   $exereqa=mysql_query("select * from fonction where personnel='$matricule' and profile= '$profile' and cycle='$monchoix' ");
     if(mysql_num_rows($exereqa)==0){
 	$sql_ajouta="INSERT INTO fonction VALUES ( '$matricule','$profile','$monchoix')";
   $query_ajouta=mysql_query($sql_ajouta) ;
			  }
			  else{
    	echo "<br>Existe d�ja";
     }
			  }
			  if($profile<>'AUTRES')
			{
				$sql1_ajout="INSERT INTO user VALUES ('$matricule','$login', '$password', '$profile')";
              $query_ajoutad=mysql_query($sql1_ajout) ;	
			}
	$CONFIG_KANNEL_HOST="localhost";
$CONFIG_KANNEL_PORT="8011";
$in_phoneNumber="$tel";  

$in_msg = "Bienvenue � l'application Elimu de l'�tablissement ".$etablissement." voici vos infos Login:".$login." Motpasse:".$password." Profil:".$profile." Veuiller ne pas repondre � ce message";	
	

	function sendSmsMessage($in_phoneNumber,$in_msg)
 {
   $url = '/send/sms/'.$in_phoneNumber.'/'.urlencode(utf8_encode($in_msg));

   $results = file('http://localhost:8011'.$url);
 }
 sendSmsMessage($in_phoneNumber, $in_msg);
 
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{

    	echo "<br>Matricule ".$matricule."   existe d�ja";
    }
    }
	}
}
//save semestre
function save_semestre(){
	if(isset($_POST["code"])){

	$code = addslashes($_POST['code']);
	$libelle= addslashes($_POST['libelle']);
	$debut= addslashes($_POST['date_d']);
	$fin= addslashes($_POST['date_f']);
	$annee= addslashes($_POST['annee']);
	$cycle="SUPERIEURE";
	$dannee= explode("/", $annee); 
	$pres=$dannee[0];
	$suiv=$dannee[1];
	if($code =='S1'){
	$ddebut = explode("-", $debut); 
	$dfin = explode("-", $fin); 
	
	$debutab = $ddebut[0].$ddebut[1].$ddebut[2];
	$finab = $dfin[0].$dfin[1].$dfin[2];
	if($pres >$ddebut[0])
	echo"<div align=center class=imp>l'anne� debut du premier semestre doit �tre >= � ".$pres."</div>";
	elseif($ddebut[0]> $suiv )
	echo"<div align=center class=imp>l'anne� debut du premier semestre ne doit pas d�passer ".$suiv."</div>";
else{
	if($finab<=$debutab)
	echo"<div align=center class=imp>la date fin du premier semestre doit �tre sup�rieure � la date de d�but !</div>";
	elseif($dfin[0]> $suiv )
	echo"<div align=center class=imp>l'anne� fin du premier semestre ne doit pas d�passer ".$suiv."</div>";
	
	else{
	
	
	    $exereq=mysql_query("select * from semestres where id= '$code' and annee='$annee'");
     if(mysql_num_rows($exereq)==0){
 	
	$sql_ajout="INSERT INTO semestres VALUES ( '$code','$libelle','$debut','$fin','$cycle','$annee')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>Premier Semestre Enregistr�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre le premier semestre</div>";

     		}  

      }
     else{
	 $newdebut="0000-00-00";
	 $exereqs1=mysql_query("select date_debut from semestres where id= 'S2' and annee='$annee'");
	while($ligne2s1=mysql_fetch_array($exereqs1))
{
$newdebut=$ligne2s1['date_debut'];// mise a jour du premier semestre
}
//$finab = $dfin[2].$dfin[1].$dfin[0];
	$finabnew = $dfin[0].'-'.$dfin[1].'-'.$dfin[2];
	if( ($newdebut<>'0000-00-00')and ($finabnew >=$newdebut)){
	echo$finabnew .'>='.$newdebut;
			echo"<div align=center class=imp>Le premier semestre ne pas etre inclu dans le second semestre, Changer le second semestre d'abord</div>";
			}
			else{
  	$mise="update semestres set libelle=upper('$libelle'),date_debut='$debut',date_fin='$fin' where id='$code' and annee='$annee'";
	$req2=mysql_query($mise);
	
	if($req2){
		
			echo"<div align=center class=imp>Premier Semestre Modifi�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre la modification du premier semestre</div>";

     		}
		}	
     }
	
	}
	}
	}
//fin premier semestre
//debut second semestre
if($code =='S2'){

$exereqs2=mysql_query("select date_fin from semestres where id= 'S1' and annee='$annee'");
     if(mysql_num_rows($exereqs2)==0){
	 echo"<div align=center class=imp>Premier Semestre doit �tre d�fini le premier!</div>";
	 }
	 else{
	 
	 //$req2=mysql_query($sqlstm2);

while($ligne2s2=mysql_fetch_array($exereqs2))
{
$fins1=$ligne2s2['date_fin'];
}
$dfins = explode("-", $fins1);
	$ddebut = explode("-", $debut); 
	$dfin = explode("-", $fin); 
	$fins = $dfins[0].$dfins[1].$dfins[2];//fin  semestre
	$debutab = $ddebut[0].$ddebut[1].$ddebut[2];
	$finab = $dfin[0].$dfin[1].$dfin[2];
	if($pres >=$ddebut[0])
	echo"<div align=center class=imp>l'anne� debut du second semestre doit �tre >= � ".$pres."</div>";
	elseif($ddebut[0]> $suiv )
	echo"<div align=center class=imp>l'anne� debut du second semestre ne doit pas d�passer ".$suiv."</div>";
	elseif($dfin[0]> $suiv )
	echo"<div align=center class=imp>l'anne� fin du second semestre ne doit pas d�passer ".$suiv."</div>";
else{
	if($fins>=$debutab)
	echo"<div align=center class=imp>la date de d�but du Second semestre doit �tre sup�rieure � la date de fin du premier semestre ! qui est ".$fins."</div>";
	
	elseif($finab<=$debutab)
	echo"<div align=center class=imp>la date fin du Second semestre doit �tre sup�rieure � la date de d�but du second semestre !</div>";
	
	else{
	    $exereq=mysql_query("select * from semestres where id= '$code' and annee='$annee'");
     if(mysql_num_rows($exereq)==0){
 $sql_ajout="INSERT INTO semestres VALUES ( '$code',upper('$libelle'),'$debut','$fin','$cycle','$annee')";


   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
		//	echo  $i = mysql_insert_id();
 	        //mkdir("docuser/".$i, 0700);
			echo"<div align=center class=imp>Second Semestre Enregistr�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre le second semestre</div>";

     		}  

      }
     else{
  $mise="update semestres set libelle=upper('$libelle'),date_debut='$debut',date_fin='$fin' where id='$code' and annee='$annee'";
$req2=mysql_query($mise);
	
	if($req2){
			echo"<div align=center class=imp>Second Semestre Modifi�!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre la modification du second semestre</div>";

     		}
			
     }
	
	}
	}
	}
	}
	
//fin second semestre	
}

}
// save coefficient
function save_coef(){
	if(isset($_POST["discipline"])){

	//$etude = addslashes($_POST['etude']);
$discipline = addslashes($_POST['discipline']);
$coef = addslashes($_POST['coef']);
//$cycle = addslashes($_POST['cycle']);
$choix=@$_POST["choix"];

$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun niveau d'�tude !!";
//exit;
}
else{
 while ($monchoix = array_shift($choix)) 
{
	   $exereq=mysql_query("select * from coefficients where discipline= '".$discipline."' and etude='".htmlentities($monchoix)."' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO coefficients VALUES ('', '$coef','".$discipline."','".htmlentities($monchoix)."')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			
		
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Co�f d�ja attribu� � ".$discipline." pour la".htmlentities($monchoix);
     }
    }
}
}
}
// save surveillant
function save_surveillant(){
	if(isset($_POST["classe"])){
	$matricule = addslashes($_POST['classe']);
$annee = addslashes($_POST['annee']);
 $choix=@$_POST["choix"];
 $ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucune classe !!";
}
elseif($ctrl>4){
echo' Chaque surveillant ne peut avoir  au maximum que 4 classes';
}
else{
$miseu="delete from surveiller where personnel= '$matricule'  and annee='$annee'";
	$req2u=mysql_query($miseu);
	
  while ($monchoix = array_shift($choix)) 
{             
	   $exereq=mysql_query("select * from surveiller where personnel= '$matricule' and classe='".htmlentities($monchoix)."' and annee='$annee' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO surveiller VALUES ( '$matricule','".htmlentities($monchoix)."','$annee')";

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
									}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      
	  }
     else{
    	echo "<br> Impossible";
     }
	 }
	 }
    }


}
// save professeur
function save_prof(){
if(isset($_POST["prof"])){
$prof = addslashes($_POST['prof']);
$discipline = addslashes($_POST['discipline']);
$annee = addslashes($_POST['annee']);
 $choix=@$_POST["choix"];
 $ctrl=sizeof($choix);
if($ctrl==0 ){
$sql_selection =" select count(*) nb from specialites where professeur= '$prof' and discipline='".$discipline."'";
$executer=mysql_query($sql_selection);
$ligne0=mysql_fetch_array($executer);
	$cy= $ligne0['nb'];//echo'<br/>';
	//$matricule= $ligne['cdeetud'];
if($cy<>0){
$miseue="delete from enseigner where personnel= '$prof'  and annee='$annee' and discipline ='$discipline'";
	$req2ue=mysql_query($miseue);
	$miseus="delete from specialites where professeur= '$prof' and discipline='$discipline'";
	$req2us=mysql_query($miseus);
echo"Attention vous venez de supprimer la sp�cialit� du professeur !!";
}
else{

echo"Attention vous n'avez coch� aucune classe !!";
}
//exit;
}
else{
$exereq0=mysql_query("select * from specialites where professeur='$prof' and discipline='".$discipline."' ");
//$n=mysql_num_rows($exereq0);
     if(mysql_num_rows($exereq0)==0){
 	$sql_ajout0="INSERT INTO specialites VALUES ( '','$prof','$discipline')";
   $query_ajout0=mysql_query($sql_ajout0) ;
			if($query_ajout0){
  while ($monchoix = array_shift($choix)) 
{         
/*$sqlstm2d="select  iddis from disciplines where disciplines.etude=(select etude from classes where libelle='".htmlentities($monchoix)."') and libelle='".$discipline."'";
$req2d=mysql_query($sqlstm2d);
$ligne2d=mysql_fetch_array($req2d);
$iddis=htmlentities($ligne2d['iddis']);*/
   
$exereq=mysql_query("select * from enseigner where classe= '".htmlentities($monchoix)."' and discipline='$discipline' and annee='$annee' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO enseigner VALUES ( '$prof','".htmlentities($monchoix)."','$discipline','$annee')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}
								}
     else{
    	echo "<br>mati�re d�ja attribu�e � ".htmlentities($monchoix)." pour cette ann�e acad�mique ".$annee;
     }
	 }
}	 
}
else{
$miseu="delete from enseigner where personnel= '$prof'  and annee='$annee' and discipline in(select  iddis from disciplines where  libelle='".$discipline."')";
	$req2u=mysql_query($miseu);
  while ($monchoix = array_shift($choix)) 
{         
$sqlstm2d="select  iddis from disciplines where disciplines.etude=(select etude from classes where libelle='".htmlentities($monchoix)."') and libelle='".$discipline."'";
$req2d=mysql_query($sqlstm2d);
$ligne2d=mysql_fetch_array($req2d);
$iddis=htmlentities($ligne2d['iddis']);
   
$exereq=mysql_query("select * from enseigner where classe= '".htmlentities($monchoix)."' and discipline='$iddis' and annee='$annee' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO enseigner VALUES ( '$prof','".htmlentities($monchoix)."','$iddis','$annee')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}
								}
     else{
    	echo "<br>mati�re d�ja attribu�e � ".htmlentities($monchoix)." pour cette ann�e acad�mique ".$annee;
     }
	 }
}
	 }	
}}
// save enseignant
function save_enseignant(){
	if(isset($_POST["classe"])){

	$matricule = addslashes($_POST['classe']);
$classe = addslashes($_POST['classes']);
$annee = addslashes($_POST['annee']);

$miseu="delete from enseignant where personnel= '$matricule'  and annee='$annee'";
	$req2u=mysql_query($miseu);
 	$sql_ajout="INSERT INTO enseignant VALUES ( '$matricule','".htmlentities($classe)."','$annee')";

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			
				echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
	echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  

	 }	 
    }
//save salle de classe
function save_salle(){
	if(isset($_POST["libelle"])){

	$nom = addslashes($_POST['libelle']);
	$capacite = addslashes($_POST['capacite']);

	   $exereq=mysql_query("select * from salles where libelle1= '$nom'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO salles VALUES ( '','$nom','$capacite')";


   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>la salle de classe ".$nom."  existe d�ja";
     }
    }


}
//save s�rie
function save_serie(){
	if(isset($_POST["libelle"])){

	$nom = addslashes($_POST['libelle']);
	$exereq=mysql_query("select * from series where libelle1= '".htmlentities($nom)."'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO series VALUES ( '','".htmlentities($nom)."')";


   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>La S�rie".$nom." existe d�ja";
     }
    }


}
//save fili�re
function save_filiere(){
	if(isset($_POST["sigle"])){
	$sigle = addslashes($_POST['sigle']);
	$nom = addslashes($_POST['libelle']);
	$exereq=mysql_query("select * from filieres where sigle1= '".htmlentities($sigle)."'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO filieres VALUES ( '".htmlentities($sigle)."','".htmlentities($nom)."')";


   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>La fili�re".$sigle." existe d�ja";
     }
    }


}
//save horaire
function save_horaire(){
	if(isset($_POST["libelle1"])){

	$debut = addslashes($_POST['libelle1']);
	$duree = addslashes($_POST['duree']);
	
	
function add_heures($heure1,$heure2){
	$secondes1=heure_to_secondes($heure1);
	$secondes2=heure_to_secondes($heure2);
	$somme=$secondes1+$secondes2;
	//transfo en h:i:s
	$s=$somme % 60; //reste de la division en minutes => secondes
	$m1=($somme-$s) / 60; //minutes totales
	$m=$m1 % 60;//reste de la division en heures => minutes
	$h=($m1-$m) / 60; //heures
	//$resultat=$h."H ".$m."mn ".$s."s";
	$resultat=$h.":".$m;
	return $resultat;
}
function heure_to_secondes($heure){
	$array_heure=explode(":",$heure);
	$secondes=3600*$array_heure[0]+60*$array_heure[1];
	return $secondes;
}


$fin=add_heures($debut,$duree);
	$exereq=mysql_query("select * from horaires where debut= '$debut' and fin= '$fin'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO horaires VALUES ( '','$debut','$fin')";

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Horaire".$debut."-".$fin." existe d�ja";
     }
    }


}
// save �l�ve
function save_eleve(){
if(isset($_POST["matricule"])){
	$matricule = addslashes($_POST['matricule']);
	$prenom = addslashes($_POST['prenom']);
	$nom = addslashes($_POST['nom']);
	$sexe = addslashes($_POST['sexe']);
	$date_nais = addslashes($_POST['date_nais']);
	$lieu_nais = addslashes($_POST['lieu_nais']);
	$tel_eleve = addslashes($_POST['tel_eleve']);
	$email_eleve = addslashes($_POST['email_eleve']);
	$tuteur = addslashes($_POST['tuteur']);
	$tel_tuteur = addslashes($_POST['tel_tuteur']);
	$email_tuteur = addslashes($_POST['email_tuteur']);
	$adresse = addslashes($_POST['adresse']);
	$redoublant = addslashes($_POST['redoublant']);
	$annee = annee_academique();
	$sclasse = addslashes($_POST['classe']);
	$datejour=date("Y")."-".date("m")."-".date("d");
	$agent = addslashes($_POST["agent"]);
	$enable='true';
	
	if($_FILES['photo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['photo']['name'];
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
	$dir=$stock."/photos/";
	$mynb=$nb-1;
	$p=str_replace('/', '-', $matricule);
	$logo ="eleve". $p.".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	else
	$chemin="";
	
    $exereq=mysql_query("select * from eleves where matricule='$matricule' ");
    if(mysql_num_rows($exereq)==0){
 	 $sql_ajout="INSERT INTO eleves VALUES ('$matricule','$prenom', '$nom', '$sexe','$date_nais','$lieu_nais','$tuteur','$email_tuteur','$tel_tuteur','$tel_eleve', '$email_eleve', '$adresse','$chemin','$enable')";
    $query_ajout=mysql_query($sql_ajout);
	$numero=mysql_insert_id();
			if($query_ajout){
				$sql1_ajout="INSERT INTO inscription VALUES ('$matricule','".htmlentities($sclasse)."', '$redoublant','$datejour','$annee','$agent')";
              $query_ajoutad=mysql_query($sql1_ajout) ;
			 
				echo"<div align=center class=imp>Inscription Valid�e!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre l'inscription</div>";
     		}
     }

    else{
    	echo "<br> ".$matricule."   d�ja attribu�e";
    }
    }
}
//salle emploi du temps
function save_emploi(){
	if(isset($_POST["classe"])){

	$classe = addslashes($_POST['classe']);
	$annee = addslashes($_POST['annee']);
	$semestre = addslashes($_POST['semestre']);
	$jour = addslashes($_POST['jour']);
	$debut = addslashes($_POST['debut']);
	$fin = addslashes($_POST['fin']);
	$disciple = addslashes($_POST['discipline']);
	$dannee= explode("*", $disciple); 
	$discipline=$dannee[0];
	$prof=$dannee[1];
	$salle = addslashes($_POST['salle']);
	$exereq=mysql_query("select * from emploi_temps where jour= '$jour' and debut= '$debut' and fin= '$fin' and classe= '".htmlentities($classe)."' and annee= '$annee' and semestre= '$semestre' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO emploi_temps VALUES ('','$jour', '$debut', '$fin','$discipline','$prof' ,'$annee', '$salle', '$semestre','".htmlentities($classe)."')";
 	
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo'Emploi du temps enregistr�	';
						}
			else
			{
				echo'Echec!Veuillez reprendre';
     		}
     }

    else{
	echo'd�ja enregistr� pour le semestre en cours';		
		}
    }
	}
	//save evaluation
function save_evaluation(){

	if(isset($_POST["type"])){

	$type = addslashes($_POST['type']);
	$dp = addslashes($_POST['date_p']);
	/*$array_date=explode("/",$date_prevue);
	$dp=$array_date[2]."-".$array_date[1]."-".$array_date[0];*/
	
	$discipline = addslashes($_POST['discipline']);
	$debutc = addslashes($_POST['debut']);
	$duree = addslashes($_POST['duree']);
	$salle = addslashes($_POST['salle']);
	$sclasse = addslashes($_POST['classe']);
	$annee =annee_academique();
	$semestre = addslashes($_POST['semestre']);
$status=$_SESSION["profil"];

if($status=='PROFESSEUR')
	$matricule = addslashes($_POST['matricule']);

$finc=addslashes($_POST['fin']);
if($type=='COMPOSITION'){
	$ex=mysql_query("select * from evaluations where  discipline= '$discipline' and classe='".htmlentities($sclasse)."' and type='$type' and annee='$annee' and semestre='$semestre'");
     if(mysql_num_rows($ex)==0){
     
	$exereq=mysql_query("select * from evaluations where date_prevue= '$dp' and discipline= '$discipline' and classe='".htmlentities($sclasse)."' and type='$type' and annee='$annee' and semestre='$semestre' ");
     if(mysql_num_rows($exereq)==0){
 	echo$sql_ajout="INSERT INTO evaluations VALUES ('','$dp', '$debutc', '$finc','$discipline', '".htmlentities($sclasse)."', '$type', '$semestre','$annee','$salle')";


   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo'<script Language="JavaScript">
							{
							alert ("enregistrement valide");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';	

			}
else{
				echo'<script Language="JavaScript">
							{
							alert ("Echec!Veuillez reprendre");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';	
     		}
     }
    else{
	echo'<script Language="JavaScript">	{
    	alert( "Evaluation d�ja enregistr�e");
		}</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';	
		
    }	 
	}
else{
  echo'<script Language="JavaScript">
							{
							alert ("Une discipline ne peut pas avoir 2 notes de composition pour un meme semestre");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';

}
	
}
else{
	
	$exereq=mysql_query("select * from evaluations where date_prevue= '$dp' and discipline= '$discipline' and classe='".htmlentities($sclasse)."' and type='$type' and annee='$annee' and semestre='$semestre'");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO evaluations VALUES ('','$dp', '$debutc', '$finc','$discipline', '".htmlentities($sclasse)."', '$type', '$semestre','$annee','$salle')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo'<script Language="JavaScript">
							{
							alert ("Evaluation Enregistr�e");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';	

			}
			else
			{
				echo'<script Language="JavaScript">
							{
							alert ("Echec!Veuillez reprendre");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';	

     		}
     }

    else{
	echo'<script Language="JavaScript">
							{
    	alert( "Evaluation d�ja enregistr�e");
		}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php?ajout=1"
</SCRIPT>';	
		
    }
	 
	
	}
	 
	 
    }
}
// save appr�ciations
function save_appreciation(){
	if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$minis= addslashes($_POST['mini']);
	$maxi= addslashes($_POST['maxi']);
	

	if($minis >= $maxi)
	echo"<div align=center class=imp>la note minimale ne doit �tre < � la note maximale</div>";
else{
	    $exereq=mysql_query("select * from apreciations where libelle1='$libelle'");
     if(mysql_num_rows($exereq)==0){
 	
 	$sql_ajout="INSERT INTO apreciations VALUES ('',upper('$libelle'),$minis,'$maxi')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){				
		echo"<div align=center class=imp>Donn�es Enregistr�es</div>";
			}
			else
			{
		echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
			
     		}  

      }
     else{
echo "<br>l'appr�ciation  ".$libelle."  existe d�ja";
     }
	
	}
}

}
//save honneur
function save_honneur(){
	if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$minis= addslashes($_POST['mini']);
	$maxi= addslashes($_POST['maxi']);
	

	if($minis >= $maxi)
	echo"<div align=center class=imp>la note minimale ne doit �tre < � la note maximale</div>";
else{
	    $exereq=mysql_query("select * from honneurs where libelle1='$libelle'");
     if(mysql_num_rows($exereq)==0){
 	
 	$sql_ajout="INSERT INTO honneurs VALUES ('',upper('$libelle'),$minis,'$maxi')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			echo"<div align=center class=imp>Donn�es Enregistr�es</div>";
			}
			else
			{
		echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
					}  

      }
     else{
    echo "<br>Honneur ".$libelle."  existe d�ja";
			
     }
	
	}
}

}
// save remarque
function save_remarque(){
	if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$minis= addslashes($_POST['mini']);
	$maxi= addslashes($_POST['maxi']);
	

	if($minis >= $maxi)
	echo"<div align=center class=imp>la note minimale ne doit �tre < � la note maximale</div>";
else{
	    $exereq=mysql_query("select * from remarques where libelle1='$libelle'");
     if(mysql_num_rows($exereq)==0){
 	
 	$sql_ajout="INSERT INTO remarques VALUES ('',upper('$libelle'),'$minis','$maxi')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
				
	echo"<div align=center class=imp>Donn�es Enregistr�es</div>";}
			else
			{
			echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  

      }
     else{
  echo "<br>Remarque ".$libelle."  existe d�ja";
			
     }
	
	}
}

}
// save d�cision
function save_decision(){
	if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$minis= addslashes($_POST['mini']);
	$maxi= addslashes($_POST['maxi']);
	 $choix=@$_POST["choix"];
 $ctrl=sizeof($choix);
 if($minis >= $maxi)
	echo"<div align=center class=imp>la note minimale ne doit �tre < � la note maximale</div>";
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun Niveau d'etude !!";
//exit;
}
else{
  while ($monchoix = array_shift($choix)) 
{

	

	    $exereq=mysql_query("select * from decisions where libelle='$libelle' and etude='$monchoix'");
     if(mysql_num_rows($exereq)==0){
 	
 	$sql_ajout="INSERT INTO decisions VALUES ('',upper('$libelle'),'$minis','$maxi','$monchoix')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
				
				echo'<script Language="JavaScript">
							{
    	alert( "D�cision Enregistr�e");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="decision.php"
</SCRIPT>';
			}
			else
			{
				echo'<script Language="JavaScript">
							{
    	alert( "Echec!Veuillez reprendre");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajdecision.php"
</SCRIPT>';
				

     		}  

      }
     else{
    	$mise="update decisions set mini=$minis,maxi=$maxi where libelle='$libelle' and etude='$monchoix'";
	$req2=mysql_query($mise);
	
	if($req2){
	echo'<script Language="JavaScript">
							{
    	alert( "D�cision Modifi�e");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="decision.php"
</SCRIPT>';
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre la modification de la d�cision</div>";

     		}
			
     }
	
	}
	}
}

}
// save evaluation prof
function save_evaluation2(){
	if(isset($_POST["type"])){

	$type = addslashes($_POST['type']);
	$date_prevue = addslashes($_POST['date_p']);
	$array_date=explode("/",$date_prevue);
	$dp=$array_date[2]."-".$array_date[1]."-".$array_date[0];
	
	$matricule = addslashes($_POST['matricule']);
	$discipline = addslashes($_POST['discipline']);
	$debutc = addslashes($_POST['debutc']);
	$duree = addslashes($_POST['duree']);
	$salle = addslashes($_POST['salle']);
	$sclasse = addslashes($_POST['classe']);
	$annee = addslashes($_POST['annee']);
	$semestre = addslashes($_POST['semestre']);
	//date semestre en cours
	$debuts = addslashes($_POST['debuts']);
	$fins = addslashes($_POST['fins']);
function add_heures($heure1,$heure2){
	$secondes1=heure_to_secondes($heure1);
	$secondes2=heure_to_secondes($heure2);
	$somme=$secondes1+$secondes2;
	//transfo en h:i:s
	$s=$somme % 60; //reste de la division en minutes => secondes
	$m1=($somme-$s) / 60; //minutes totales
	$m=$m1 % 60;//reste de la division en heures => minutes
	$h=($m1-$m) / 60; //heures
	//$resultat=$h."H ".$m."mn ".$s."s";
	$resultat=$h.":".$m;
	return $resultat;
}
function heure_to_secondes($heure){
	$array_heure=explode(":",$heure);
	$secondes=3600*$array_heure[0]+60*$array_heure[1];
	return $secondes;
}

//$heure_1='12:00';
//$heure_2='14:30';
//echo 'La somme de '.$heure_1.' et de '.$heure_2.' est: '.add_heures($heure_1,$heure_2); 

$finc=add_heures($debutc,$duree);
if($type=='COMPOSITION'){
	$ex=mysql_query("select * from evaluations where  discipline= '$discipline' and classe='$sclasse' and type='$type' and annee='$annee' and semestre='$semestre'");
     if(mysql_num_rows($ex)==0){
     
	if($debuts<=$dp and $dp<=$fins)
{
	$exereq=mysql_query("select * from evaluations where date_prevue= '$dp' and discipline= '$discipline' and classe='$sclasse' and type='$type' and annee='$annee' and semestre='$semestre' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO evaluations VALUES ('',STR_TO_DATE('$date_prevue','%d/%m/%Y'), '$debutc', '$finc','$discipline', '$sclasse', '$type', '$semestre','$annee','$salle')";
 	

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo'<script Language="JavaScript">
							{
							alert ("enregistrement valide");
							}
</SCRIPT>';
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php"
</SCRIPT>';
			}
			else
			{
				echo'<script Language="JavaScript">
							{
							alert ("Echec!Veuillez reprendre");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
     		}
     }

    else{
	echo'<script Language="JavaScript">
							{
    	alert( "Evaluation d�ja enregistr�e");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
		
    }
	 
	 }
	 else{
		 echo'<script Language="JavaScript">
							{
    	alert( "la date doit �tre une date incluse dans le semestre en cours");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
		
	 }
	 
	}
	else
{
  echo'<script Language="JavaScript">
							{
							alert ("Une discipline ne peut pas avoir 2 notes de composition pour un meme semestre");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
}
	
}
else{
	
	    
    
	if($debuts<=$dp and $dp<=$fins)
{
	$exereq=mysql_query("select * from evaluations where date_prevue= '$dp' and discipline= '$discipline' and classe='$sclasse' and type='$type' and annee='$annee' and semestre='$semestre' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO evaluations VALUES ('',STR_TO_DATE('$date_prevue','%d/%m/%Y'), '$debutc', '$finc','$discipline', '$sclasse', '$type', '$semestre','$annee','$salle')";

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
						echo'<script Language="JavaScript">
							{
							alert ("enregistrement valide");
							}
</SCRIPT>';
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php"
</SCRIPT>';
			}
			else
			{
				echo'<script Language="JavaScript">
							{
							alert ("Echec!Veuillez reprendre");
							}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
     		}
     }

    else{
	echo'<script Language="JavaScript">
							{
    	alert( "Evaluation d�ja enregistr�e");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
		
    }
	 
	 }
	 else{
	 	
		 echo'<script Language="JavaScript">
							{
    	alert( "la date doit �tre une date incluse dans le semestre en cours1");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="ajevaluationprof.php?num='. $sclasse.'&annee='.$annee.'&matricule='.$matricule.'"
</SCRIPT>';
		
	//	echo $debuts.'<='.$dp .'and '.$dp.'<='.$fins;
	 }
	 
	 
	}
	 
	 
    }


}
//save notes
function save_note(){
if(isset($_POST["matricule"])){

		$matricule=addslashes($_POST['matricule']);
		$evaluation = addslashes($_POST['evaluation']);
	$note=addslashes($_POST['note']);
	$classe=addslashes($_POST['classe']);
$annee=addslashes($_POST['annee']);
	$mise="insert into notes values('$matricule','$note','$evaluation','')";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("note Ajout�e");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="el_notes.php?matricule='.$matricule.'&num='.$classe.'&annee='.$annee.'"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="el_notes.php?matricule='.$matricule.'&num='.$classe.'&annee='.$annee.'"
</SCRIPT>';
	}
}
}
//save fonction
function save_fonction(){
	if(isset($_POST["discipline"])){

	//$etude = addslashes($_POST['etude']);
$discipline = addslashes($_POST['discipline']);
$matricule = addslashes($_POST['matricule']);
if($discipline=='AUTRES'){
	$login ="";
	$password ="";
	}
	else{
	$login = addslashes($_POST['pseudo']);
	$password = addslashes($_POST['passe']);
	}	
$status = addslashes($_POST['status']);
if($status=='PRIVE'){
	$paiement =addslashes($_POST['paiement']);
	$montant =addslashes($_POST['montant']);
	}
$choix=@$_POST["choix"];

$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun cycle !!";
//exit;
}
else{
 while ($monchoix = array_shift($choix)) 
{
	   $exereq=mysql_query("select * from fonction where personnel='$matricule' and profile= '$discipline' and cycle='$monchoix' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO fonction VALUES ( '$matricule','$discipline','$monchoix')";

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			if($discipline<>'AUTRES')
			{
				$sql1_ajout="INSERT INTO user VALUES ('$matricule','$login', '$password', '$discipline')";
              $query_ajoutad=mysql_query($sql1_ajout) ;	
			}
			if($status=='PRIVE'){
			$sql1_ajoutr="INSERT INTO salaire VALUES ( '$discipline','$matricule','$paiement', '$montant')";
              $query_ajoutadr=mysql_query($sql1_ajoutr) ;	
			}
			if($discipline=='PROFESSEUR'){
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="specialite.php?num='. $matricule.'"
</SCRIPT>';
			}
			else{
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="fichepersonnel.php?num='. $matricule.'"
</SCRIPT>';
}
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Existe d�ja";
     }
    }
}
}
}
//save cahier texte
function save_cahiertexte(){
if(isset($_POST["matricule"])){

		$matricule=addslashes($_POST['matricule']);
		$emploi = addslashes($_POST['cours']);
	$titre=addslashes($_POST['titre']);
	$semestre=addslashes($_POST['semestre']);
	$lesson=addslashes($_POST['lesson']);
	$classe=addslashes($_POST['classe']);
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");

		$mise="insert into cours values('".htmlentities($classe)."','$emploi','$datejour','$titre','$lesson','$annee','$semestre')";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Cours Ajout�e");
 }</SCRIPT>';
	echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="cahiertexte.php?ajout=1&num='.$classe.'"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }
 </script>';
		echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="cahiertexte.php?ajout=1&num='.$classe.'"
</SCRIPT>';
	}
}
}
// paiement mensualit� �l�ve
function save_paiement(){
	if(isset($_POST["eleve"])){
	
		$eleve = addslashes($_POST["eleve"]);
		$agent = addslashes($_POST["agent"]);
		$classe = addslashes($_POST["classe"]);
		$cout = addslashes($_POST["montant"]);
		$mois = addslashes($_POST["mois"]);
		$annee = addslashes($_POST["annee"]);
		$mensuel = addslashes($_POST["paies"]);
		 $choix=@$_POST["choix"];
 $ctrl=sizeof($choix);
		
		$datejour=date("Y")."-".date("m")."-".date("d");

		  while ($monchoix = array_shift($choix)) 
{

			$sql_ajout="INSERT INTO paiements values('$eleve','$mensuel','$datejour','$monchoix','$annee','$agent')";

			$query_ajout=mysql_query($sql_ajout);
			if($query_ajout){

				
				echo'<SCRIPT LANGUAGE="JavaScript">
location.href="facture.php?num='.$classe.'&matricule='.$eleve.'&annee='.$annee.'"

</SCRIPT>';
			}
			else
			{
			
				echo'<script Language="JavaScript">
				{alert ("Echec! Veuillez reprendre SVP!!!");
				}
</SCRIPT>';
				
				echo'<SCRIPT LANGUAGE="JavaScript">
location.href="saisie_paiement.php?num='.$sclasse.'&matricule='.$eleve.'&annee='.$annee.'"

</SCRIPT>';
			}
		}

	


	}
}
//save depenses journali�re
function save_depensej(){
	if(isset($_POST["libelle"])){

		//$code = addslashes($_POST['code']);
		$datejour=date("Y")."-".date("m")."-".date("d");
		$libelle = addslashes($_POST['libelle']);
		$agence = addslashes($_POST['agent']);
		$smontant=addslashes($_POST['montant']);
		$sdepense=addslashes($_POST['depense']);
		$mois=date("n");
		$annee=date("Y");
 $aca="";
		$annee1=date("Y")+1;
		if( $mois>=10){
		 $aca=$annee .'/'. $annee1;
		}
		else{
		 $aca=date("Y")-1 .'/'.$annee;
		}
if ($mois=='1')
	$smois="Janvier";
		else
if ($mois=='2')
	$smois="Fevrier";
		else
if ($mois=='3')
	$smois="Mars";
		else
if ($mois=='4')
	$smois="Avril";
		else
if ($mois=='5')
	$smois="Mai";
		else
if ($mois=='6')
	$smois="Juin";
		else
if ($mois=='7')
	$smois="Juillet";
		else
if ($mois=='8')
	$smois="Aout";
		else
if ($mois=='9')
	$smois="Septembre";
		else
if ($mois=='10')
	$smois="Octobre";
		else
if ($mois=='11')
	$smois="Novembre";
		else
if ($mois=='12')
	$smois="Decembre";

			$sql_ajout ="insert into depenses(codejournee,libelle,montant,agent,nature,datejour,mois,annee) values(' ','$libelle','$smontant','$agence','$sdepense','$datejour','$smois','$aca')";
		
			$query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
	

				echo'<script Language="JavaScript">
							{
							alert ("D�pense Enregistr�e");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="lidepenses.php"

</SCRIPT>';

			}
			else
			{

				echo'<script Language="JavaScript">
				{alert ("Echec ! veuillez reprendre SVP");
				}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="depensesj.php"

</SCRIPT>';
			} 



	}



}
// save d�pense mensuelle
function save_depensemensuel(){
	if(isset($_POST["libelle"])){

		//$code = addslashes($_POST['code']);
		$datejour=date("Y")."-".date("m")."-".date("d");
		$libelle = addslashes($_POST['libelle']);
		$smois = addslashes($_POST['periode']);
		$smontant=addslashes($_POST['montant']);
		$sdepense=addslashes($_POST['depense']);
		$aca=addslashes($_POST['annee']);
		$agence='';
			$sql_ajout ="insert into depenses(codejournee,libelle,montant,agent,nature,datejour,mois,annee) values(' ','$libelle','$smontant','$agence','$sdepense','$datejour','$smois','$aca')";
		

			$query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
				

				echo'<script Language="JavaScript">
							{
							alert ("D�pense Enregistr�e");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="lidepens_mensuel.php"

</SCRIPT>';

			}
			else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! veuillez reprendre SVP");
				}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="depensesm.php"

</SCRIPT>';
			}  /* */
	}
}
 // save versement � la banque
function save_versementb(){
	if(isset($_POST["bordereau"])){

		//$code = addslashes($_POST['code']);
		//$datejour=date("Y")."-".date("m")."-".date("d");
		$bordereau = addslashes($_POST['bordereau']);
		$banque = addslashes($_POST['banque']);
		$smontant=addslashes($_POST['montant']);
		$datev=addslashes($_POST['datev']);
		
$donnee = explode("/", $datev); 
$jour=$donnee[0];
$moi=$donnee[1];
$annee=$donnee[2];
$datejour=$annee."-".$moi."-".$jour;
		$sqls="SELECT mois FROM periodes WHERE   numero='$moi' ";
		$req74=mysql_query($sqls);
while($ligne74=mysql_fetch_array($req74))
{
	$mois=$ligne74['mois'];

}
$exereq=mysql_query("select * from versement_banque where bordereau= '$bordereau'");
		if(mysql_num_rows($exereq)==0){

			$sql_ajout ="insert into versement_banque values('$bordereau','$smontant','$banque','$datejour','$mois','$annee')";
	

			$query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
				

				echo'<script Language="JavaScript">
							{
							alert ("enregistrement valide");
							}
</SCRIPT>';

				echo'<SCRIPT LANGUAGE="JavaScript">
location.href="saisie_versementb.php"
</SCRIPT>';

			}
			else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! veuillez reprendre SVP");
				}
</SCRIPT>';

			}
}			
	else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! Ce bordereau existe d�ja");
				}
</SCRIPT>';

			}

	}



}
//save retrait
function save_retrait(){
	if(isset($_POST["cheque"])){

		//$code = addslashes($_POST['code']);
		//$datejour=date("Y")."-".date("m")."-".date("d");
		$cheque = addslashes($_POST['cheque']);
		$banque = addslashes($_POST['banque']);
		$nom=addslashes($_POST['nom']);
		$smontant=addslashes($_POST['montant']);
		$datev=addslashes($_POST['dater']);
		
$donnee = explode("/", $datev); 
$jour=$donnee[0];
$moi=$donnee[1];
$annee=$donnee[2];
$datejour=$annee."-".$moi."-".$jour;
		$sqls="SELECT mois FROM periodes WHERE   numero='$moi' ";
		$req74=mysql_query($sqls);
while($ligne74=mysql_fetch_array($req74))
{
	$mois=$ligne74['mois'];

}
/*
$sqlsv="SELECT sum(montant) smv FROM versement_banque WHERE   datejour<='$datejour' ";
		$req74v=mysql_query($sqlsv);
$ligne74v=mysql_fetch_array($req74v);
	$verse=$ligne74v['smv'];
	
$sqlsr="SELECT sum(montant) smr FROM retrait WHERE   datejour<='$datejour' ";
		$req74r=mysql_query($sqlsr);
$ligne74r=mysql_fetch_array($req74r);
	$retrait=$ligne74r['smr'];
	$solde=$verse-$retrait;
	if($solde<$smontant){
	
	echo'<script Language="JavaScript">
							{
							alert ("Retrait impossible car la demande est > Montant Disponible");
							}
</SCRIPT>';


	}
	
else{*/
$exereq=mysql_query("select * from retrait where num_cheque= '$cheque'");
		if(mysql_num_rows($exereq)==0){

			$sql_ajout ="insert into retrait values('$cheque','$smontant','$banque','$nom','$datejour','$mois','$annee')";
		//$req1=mysql_query($sql_ajout);

			$query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
				//	$_SESSION["code"]=$code;

				echo'<script Language="JavaScript">
							{
							alert ("enregistrement valide");
							}
</SCRIPT>';

				echo'<SCRIPT LANGUAGE="JavaScript">
location.href="retrait.php"
</SCRIPT>';

			}
			else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! veuillez reprendre SVP");
				}
</SCRIPT>';

			}
}			
	else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! Ce bordereau existe d�ja");
				}
</SCRIPT>';

			}

	//}
}


}
// avance sur salaire
function save_avance_sal(){
	if(isset($_POST["libelle"])){

		//$code = addslashes($_POST['code']);
		$datejour=date("Y")."-".date("m")."-".date("d");
		$libelle = addslashes($_POST['libelle']);
		$smois = addslashes($_POST['periode']);
		$smontant=addslashes($_POST['montant']);
		$sdepense='';
		$aca=addslashes($_POST['annee']);
		$agence='';
			$sql_ajout ="insert into depenses(codejournee,libelle,montant,agent,nature,datejour,mois,annee) values(' ','$libelle','$smontant','$agence','$sdepense','$datejour','$smois','$aca')";
		//$req1=mysql_query($sqlstm1);
		//	$scode=mysql_insert_id();


			// echo "<br> requete : ".$sql_ajout;

			$query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
				//	$_SESSION["code"]=$code;

				echo'<script Language="JavaScript">
							{
							alert ("Avance sur Salaire Enregistr�e");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="avanace_salaire.php"

</SCRIPT>';

			}
			else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! veuillez reprendre SVP");
				}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="avanace_salaire.php"

</SCRIPT>';
			}  /* */
	}
}
//save salaire personnel
function save_salaire(){
	if(isset($_POST["perso"])){
		//$code = addslashes($_POST['code']);
		$datejour=date("Y")."-".date("m")."-".date("d");
		$perso = addslashes($_POST['perso']);
		$smois = addslashes($_POST['mois']);
		$salbrut=addslashes($_POST['salbrut']);
		$avancesal=addslashes($_POST['avancesal']);
		$salnet=addslashes($_POST['salnet']);
		$aca=addslashes($_POST['annee']);
		
			$sql_ajout ="insert into salaireagent values('$perso','$smois','$aca','$salnet','$salbrut','$avancesal','$datejour')";


			$query_ajout=mysql_query($sql_ajout) or die(mysql_error);
			if($query_ajout){
				

				echo'<script Language="JavaScript">
							{
							alert ("Salaire Enregistr�");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="salaire_mensuel.php"

</SCRIPT>';

			}
			else
			{
				//echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

				echo'<script Language="JavaScript">
				{alert ("Echec ! veuillez reprendre SVP");
				}
</SCRIPT>';
echo'<SCRIPT LANGUAGE="JavaScript">
location.href="salaire_mensuel.php"

</SCRIPT>';
			}  /* */
	}
}
// save absence professeur
function save_absenceperso(){
	if(isset($_POST["type"])){

	$type = addslashes($_POST['type']);
	$personnel= addslashes($_POST['personnel']);
	$annee= addslashes($_POST['annee']);
	$debut= addslashes($_POST['date_debut']);
	$motif= addslashes($_POST['motif']);
	if($type == "HORAIRE"){
	$fin=$debut;
	$hf= addslashes($_POST['hf']);
	$hd= addslashes($_POST['hd']);
	}
	elseif($type == "JOURNEE"){
	$jour= addslashes($_POST['date_f']);
	
$array_date=explode("/",$jour);
	$fin=$array_date[2]."-".$array_date[1]."-".$array_date[0];
	$hf='';
	$hd='';
	}
	
	    $exereq=mysql_query("select * from absence_personnel where personnel='$personnel' and date_debut='$debut' and annee='$annee'");
     if(mysql_num_rows($exereq)==0){
 	
	$sql_ajout="INSERT INTO absence_personnel VALUES ('$personnel','$debut','$hd','$hf','$fin','$motif','$annee','$type')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
				
				echo'<script Language="JavaScript">
							{
    	alert( "Absence professeur Enregistr�e");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="absencepersonnel.php"
</SCRIPT>';
			}
			else
			{
				echo'<script Language="JavaScript">
							{
    	alert( "Echec!Veuillez reprendre");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="saisie_absenceperso.php"
</SCRIPT>';
				

     		}  

      }
     else{
				echo'<script Language="JavaScript">
							{
    	alert( "Absence professeur D�ja Enregistr�e � cette date");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="absencepersonnel.php"
</SCRIPT>';

			
     }
	
	//}
}

}
// save specialite
function save_specialite(){
	if(isset($_POST["prof"])){

	//$etude = addslashes($_POST['etude']);
$annee = addslashes($_POST['annee']);
$matricule = addslashes($_POST['prof']);

$choix=@$_POST["choix"];

$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucune discipline !!";
//exit;
}
else{
 while ($monchoix = array_shift($choix)) 
{
	echo   $exereq=mysql_query("select * from specialites where professeur='$matricule' and discipline='$monchoix' ");
     if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO specialites VALUES ( '','$matricule','$monchoix')";

   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
			
			echo'<SCRIPT LANGUAGE="JavaScript">
location.href="personnels.php"
</SCRIPT>';

			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  

      }
     else{
    	echo "<br>Existe d�ja";
     }
    }
}
}
}
// saisie absence eleve
function save_absenceleve(){
	if(isset($_POST["type"])){

	$type = addslashes($_POST['type']);
	$personnel= addslashes($_POST['personnel']);
	$annee= addslashes($_POST['annee']);
	$sclasse= addslashes($_POST['classe']);
	$debut= addslashes($_POST['date_debut']);
	$motif= addslashes($_POST['motif']);
	if($type == "HORAIRE"){
	$fin=$debut;
	$hf= addslashes($_POST['hf']);
	$hd= addslashes($_POST['hd']);
	}
	elseif($type == "JOURNEE"){
	$jour= addslashes($_POST['date_f']);
	
$array_date=explode("/",$jour);
	$fin=$array_date[2]."-".$array_date[1]."-".$array_date[0];
	$hf='';
	$hd='';
	}
	
	    $exereq=mysql_query("select * from absence_eleve where personnel='$personnel' and date_debut='$debut' and annee='$annee'");
     if(mysql_num_rows($exereq)==0){
 	
	$sql_ajout="INSERT INTO absence_eleve VALUES ('$personnel','$debut','$hd','$hf','$fin','$motif','$annee','$type')";
   $query_ajout=mysql_query($sql_ajout) ;
			if($query_ajout){
				
				echo'<script Language="JavaScript">
							{
    	alert( "Absence El�ve Enregistr�e");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="absenceeleve.php?num='.$sclasse.'&annee='.$annee.'";
</SCRIPT>';
			}
			else
			{
				echo'<script Language="JavaScript">
							{
    	alert( "Echec!Veuillez reprendre");
		}
</SCRIPT>';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="absenceeleve.php?num='.$sclasse.'&annee='.$annee.'";
</SCRIPT>';
				

     		}  

      }
     else{
				echo'<script Language="JavaScript">
							{
    	alert( "Absence El�ve D�ja Enregistr�e � cette date");
		}
</SCRIPT>';
	echo'<SCRIPT LANGUAGE="JavaScript">
location.href="absenceeleve.php?num='.$sclasse.'&annee='.$annee.'";
</SCRIPT>';

			
     }
	
	//}
}

}


