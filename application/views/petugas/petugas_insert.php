<form method="post" action="<?php echo site_url('petugas/insert_submit/');?>">
	<table class="table table-striped">
		<tr>
			<td>NIP</td>
			<td><input type="text" name="nip" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama_petugas" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><input type="text" name="alamat_petugas" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>No. Telpon</td>
			<td><input type="text" name="notelp_petugas" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Password Akun</td>
			<td><input type="password" name="password" value="" required="" class="form-control"></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>