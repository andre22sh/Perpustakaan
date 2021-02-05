<form method="post" action="<?php echo site_url('pengembalian/insert_submit/');?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>ID Peminjaman</td>
			<td>
				<select name="id_peminjaman" id="id_peminjaman" class="form-control">
                    <?php foreach($data_peminjaman as $pinjman): ?>
                        <option value="<?php echo $pinjman['id_peminjaman']; ?>"><?php echo $pinjman['id_peminjaman']; ?></option>
                    <?php endforeach; ?>
                </select>      
			</td>
		</tr>
		<tr>
			<td>Buku yang Dipinjam</td>
			<td>
                <select name="buku" id="buku" class="form-control">
                    <?php foreach($data_buku as $buku): ?>
                        <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['nama_buku']; ?></option>
                    <?php endforeach; ?>
                </select>      
            </td>
		</tr>
        <tr>
			<td>Tanggal Pengembalian</td>
			<td><input type="date" name="tgl_pengembalian" value="" required="" class="form-control"></td>
		</tr>	
		<tr>
			<td>jumlah Pengembalian</td>
			<td><input type="text" name="jumlah_pengembalian" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Denda Telat</td>
			<td><input type="text" name="denda_telat" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Denda Hilang</td>
			<td><input type="text" name="denda_hilang" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Denda Rusak</td>
			<td><input type="text" name="denda_rusak" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>

