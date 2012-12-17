<center>
<form name="inscription_form" action="<?php echo 'serie.php?ajout=1';?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">

	<table border="0" cellpadding="3" cellspacing="0" width="600"  align="center">
		<tbody align="center"><tr>
			<td width="200" ><B>Libellé Série *
				<input name="libelle" id="Nom" value=""size=10 class="inputbig" type="text" autofocus required  ONCHANGE="this.value=this.value.toUpperCase()">
			</td>
			</tr>

<tr><td>&nbsp; </td></tr>


	</tbody>

	<tr><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
save_serie();
?>