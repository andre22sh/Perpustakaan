<form method="post" action="<?php echo site_url('kategori/update_submit/'.$data_kategori_single['id_kategori']);?>">
	<table class="table table-striped">
		<tr>
			<td>Nama Kategori</td>
			<td><input type="text" name="kategori" value="<?php echo $data_kategori_single['nama_kategori']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>