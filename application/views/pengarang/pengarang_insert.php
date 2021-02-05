<form method="post" action="<?php echo site_url('pengarang/insert_submit/');?>">
	<table class="table table-striped">
		<tr>
			<td>Nama Pengarang</td>
			<td><input type="text" name="pengarang" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>