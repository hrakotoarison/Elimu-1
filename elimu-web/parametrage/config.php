<html lang="fr">
<head>
<script>
function ChangeTitle(title, step){
	if(step==undefined || step > title.length)step=0;
	document.title=title.substr(step) + title.substr(0, step);
	step++;
	setTimeout('ChangeTitle("' + title + '", ' + step + ');', 100);
}

// C'est ici que ça se passe. Ecrivez le titre que vous voulez
ChangeTitle("ELIMU: GESTION SCOLAIRE & COLLABOTION PARENTS ET ADMINISTRATION VIA SYSTEME SMS ");
</script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
<?php
include"../dao/connection.php";
 include "style.php";
   $titre="ELIMU >> Paramétrage Partie I";
   
   
   $requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
   $b=mysql_fetch_object($resultat);
$a=$b->logo;

$query = "SELECT * FROM etablissements";
   $result = mysql_query ($query)or die (mysql_error());
   $ligne=mysql_fetch_row($result);
?>
<body>   <form name="" action="recupconfig.php"  method="post" onsubmit='return (conform(this));' enctype="multipart/form-data" >

<table border=10 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top"  style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;">

		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="50">
                   <tr class="titr">
		              <td COLSPAN=2 align=center height="90"><b><big>Configuration</big><b> </td>
		              <?
                    	if($a <>""){
                    	?>
					  <td> <img <? echo" <img src='logos/". $a."' align='right'  height='100%' width='30%' >";?></td>
					  <?
					}
					
					?>
		            </tr>
		</table>
			
		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>
		              <td align="right" height="30"><b><?echo $titre;?></td>
		            </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		 	 <tr>
		              <td>&nbsp;<b>IA : *&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</br><input name="ia" type="text" id="IA"size="30" value="<? echo @$ligne[0];?>" ONCHANGE="this.value=this.value.toUpperCase()" placeholder="IA de dakar par exemple" required autofocus>
					  </td>  <td>&nbsp;<b>IDEN : *</br><input name="iden" type="text" id="IDEN"size="40" ONCHANGE="this.value=this.value.toUpperCase()" value="<? echo $ligne[1];?>" placeholder="IDEN de Pikine par exemple" required></td>
</tr>
<TR><TD class=petit>&nbsp;</TD></TR>

	 <tr>
<td>&nbsp;<b>Etablissement</b> :*</br><input name="libelle" type="text" id="Etablissement"size="50" ONCHANGE="this.value=this.value.toUpperCase()" value="<? echo $ligne[2];?>" placeholder="Nom Etablissement"required></td>
<TD>&nbsp;<b>Statut: *</br><SELECT NAME="status"><OPTION SELECTED><? echo $ligne[12];?></OPTION>
<?
if ($ligne[12]=="PUBLIC"){

	echo "<OPTION>PRIVE</OPTION>";
	}
elseif ($ligne[12]=="PRIVE"){

echo "<OPTION>PUBLIC</OPTION>";
	}
	
else{

	echo "<OPTION>PUBLIC</OPTION>";
	echo "<OPTION>PRIVE</OPTION>";
}
?>
</td>
		            </tr>
					<tr><td><TD class=petit>&nbsp; </td></tr>
					<tr><td><b>Logo :</b></br>
					<? if( $ligne[3]==""){?>


<input name="logo" id="logo"type="file" >
<?
}
else{
?>
<input name="chemin" type="text" value="<? echo $ligne[3];?>" readonly>
<input name="logo" id="logo"type="file" >
<?
}
?></td>
   <td><b>Date Ouverture :*</b></BR><input name="ouverture" id="Date Ouverture" type="date" size="20"  value="<? echo @$ligne[5];?>" placeholder="<?echo date("Y")."-".date("m")."-".date("d");?>" required lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:date;erreur:champ Obligatoire'></td>
		           

</tr>
		</table>
         <table border=0 cellpadding=0 cellspacing=0 width=100% height="90">
		             <tr>
		              <td><b>Slogan :</b><BR><input name="slogan" type="text" size="40" value="<? echo $ligne[4];?>" placeholder="Travail,Discipline, Reussite" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		           
		              <td><b>Adresse **</b><br><input name="adresse" id="Adresse" type="text" size="50" value="<? echo $ligne[6];?>" placeholder="Adresse Etablissement"  required></td>
		            </tr>
         </table>
         <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>

		  		     <td><b>Téléphone :*</b><br>  <input name="tel" id="t&eacute;l&eacute;phone" type="text" size="20" value="<? echo $ligne[7];?>" placeholder="Numéro Téléphone" required></td>
					    <td><b>BP</b> :<br> <input name="bp" id="Boite Postale" type="text" size="20"  value="<? echo $ligne[8];?>" placeholder="Boite Postale" ></td>
 <td><b>Fax :</b><br> <input name="fax" type="text" size="20" value="<? echo $ligne[9];?>"  ></td>
		             
		            </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>
					<td><b>Site :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br> <input name="site" type="text" size="30" value="<? echo $ligne[9];?>" placeholder="http://www.coders4africa.org" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		              <td><b>Email :*</b><br> <input name="email" id="email" type="email" size="40"  value="<? echo @$ligne[11];?>" required  placeholder="votre@dresse.fr"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:mail;'></td>

		             </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		             <tr>
		              <td width=100>&nbsp;</td>
		              <td align=right>
		              <?
		              
                          echo'<input type="image" src="img/suiv.jpg" >';
		               

		              ?>
		              </td>
		            </tr>
		 </table>
          <table border=0 cellpadding=0 cellspacing=0 width=100%  height="20">
		             <tr>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	     <img src="images/c4a.jpg"" alt="" title=""/> 
	  
					  </td>
		            </tr>
		 </table>

		   </td>
		 </tr>
		 </table>
	  </td>
	</tr>
		 </table>


</form>


</body>

</html>