<form method="post" action="<?php echo site_url('penerbit/update_submit/'.$data_penerbit_single['id_penerbit']);?>">
	<table class="table table-striped">
		<tr>
			<td>Nama Penerbit</td>
			<td><input type="text" name="penerbit" value="<?php echo $data_penerbit_single['nama_penerbit']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>