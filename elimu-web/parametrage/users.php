<?php session_start();
 // if(@$_SESSION["login1"]=="")
 //     header("location:accueil.php");
?>
<html>
<html lang="fr">
<head>
<script>
function ChangeTitle(title, step){
	if(step==undefined || step > title.length)step=0;
	document.title=title.substr(step) + title.substr(0, step);
	step++;
	setTimeout('ChangeTitle("' + title + '", ' + step + ');', 100);
}

// C'est ici que �a se passe. Ecrivez le titre que vous voulez
ChangeTitle("ELIMU: GESTION SCOLAIRE & COLLABOTION PARENTS ET ADMINISTRATION VIA SYSTEME SMS ");
</script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
<?php
include"../dao/connection.php";
 include "style.php";
   $titre="ELIMU >> Param�trage Termin�";
		
$d=date("Y")-1;
$req=mysql_query("select * from administrateurs");
$rw=mysql_fetch_row($req);
		$requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
   $b=mysql_fetch_object($resultat);
$a=$b->logo;

?>
<body>
<form name="" action="recupusers.php" method="POST" enctype="multipart/form-data"  onsubmit='return (conform(this));'>

<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top"  style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;">
		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
                   <tr  class="titr">  
				   <td COLSPAN=2 align=center height="50"><b><big>Configuration  </big></b></td>
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
		            <tr class="legend">
		              <td align="right" height="30"  ><b> <?echo $titre;?></b></td>
		            </tr>

		 </table>
		 		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
		      
 <tr>
 <td><b> Pseudo *:</b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <input name="pseudo" type="text" value="<?echo @$rw[1];?>" required  autofocus></td></tr>
<tr><td><b>Mot de Passe *</b>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><input name="passe" type="password"  value="<?echo @$rw[2];?>" required></td></tr>
<tr></td><b>Confirmation Mot de Passe *:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="cpasse" type="password" value="<?echo @$rw[2];?>"required></td></tr>
		         
					
		   </table>
		              
					   <table border=0 cellpadding=0 cellspacing=0 width=100% height=100>
					   <tr>      <td>&nbsp;</td><td>
					  <br><a href="design.php"><img src="img/prec.jpg" alt="" border="0"></a>
		              &nbsp;&nbsp;<input type="image" src="img/suiv.jpg">
					   </td>
         
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="20">
		             <tr>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	    <img src="images/c4a.jpg"" alt="" title=""/> 
					  </td>
		            </tr>
		 </table>

</form>


</body>

</html>