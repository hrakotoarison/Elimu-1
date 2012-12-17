<?php
include 'all_function.php';
if(isset($_POST['PROF_ID']))
{
$idsel =$_POST['PROF_ID'];

echo'	<BUTTON TITLE="Confirmer l\'ajout de cet Distributeur" TYPE="submit" id="flashit" name="enregistrer"><b>Enregistrer</b></BUTTON>
&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON>

';
}
?>