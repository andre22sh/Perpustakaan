<form method="post" action="<?php echo site_url('mahasiswa/insert_submit/');?>">
	<table class="table table-striped">
		<tr>
			<td>NIM</td>
			<td><input type="text" name="nim" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Nama Mahasiswa</td>
			<td><input type="text" name="nama_mhs" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td><input type="text" name="alamat_mhs" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td><input type="text" name="jurusan_mhs" value="" required="" class="form-control"></td>
		</tr>
        <tr>
			<td>No. Telpon</td>
			<td><input type="text" name="notelp_mhs" value="" required="" class="form-control"></td>
		</tr>
		
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>