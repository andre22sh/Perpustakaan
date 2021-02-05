<form method="post" action="<?php echo site_url('pengembalian/update_submit/'.$data_pengembalian_single['id_pengembalian']);?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>ID Peminjaman</td>
			<td>
				<select name="id_peminjaman" id="id_peminjaman" class="form-control">
                    <?php foreach($data_peminjaman as $pinjam): ?>
                        <?php if($pinjam['id_peminjaman'] == $data_pengembalian_single['id_peminjaman']): ?>
                            <option value="<?php echo $pinjam['id_peminjaman']; ?>" selected><?php echo $pinjam['id_peminjaman']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $pinjam['id_peminjaman']; ?>"><?php echo $pinjam['id_peminjaman']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>      
			</td>
		</tr>
		<tr>
			<td>Buku yang Dipinjam</td>
			<td>
                <select name="buku" id="buku" class="form-control">
                    <?php foreach($data_buku as $buku): ?>
                        <?php if($buku['id_pengembalian'] == $data_pengembalian_single['id_buku']): ?>
                            <option value="<?php echo $buku['id_buku']; ?>" selected><?php echo $buku['nama_buku']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['nama_buku']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>      
            </td>
		</tr>
        <tr>
			<td>Tanggal Pengembalian</td>
			<td><input type="date" name="tgl_pengembalian" value="<?php echo $data_pengembalian_single['tgl_pengembalian']?>" required="" class="form-control"></td>
		</tr>	
		<tr>
			<td>jumlah Pengembalian</td>
			<td><input type="text" name="jumlah_pengembalian" value="<?php echo $data_pengembalian_single['jumlah_pengembalian']?>" required="" class="form-control"></td>
		</tr>
		<tr>
		<tr>
			<td>Denda Telat</td>
			<td><input type="text" name="denda_telat" value="<?php echo $data_pengembalian_single['denda_telat']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Denda Hilang</td>
			<td><input type="text" name="denda_hilang" value="<?php echo $data_pengembalian_single['denda_hilang']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Denda Rusak</td>
			<td><input type="text" name="denda_rusak" value="<?php echo $data_pengembalian_single['denda_rusak']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>

