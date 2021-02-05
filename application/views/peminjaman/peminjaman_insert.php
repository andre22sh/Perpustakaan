<form method="post" action="<?php echo site_url('peminjaman/insert_submit/');?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>Nama Peminjam</td>
			<td>
				<select name="mahasiswa" id="mahasiswa" class="form-control">
                    <?php foreach($data_mahasiswa as $mhs): ?>
                        <option value="<?php echo $mhs['nim']; ?>"><?php echo $mhs['nama_mhs']; ?></option>
                    <?php endforeach; ?>
                </select>      
			</td>
		</tr>
		<tr>
			<td>Petugas yang Melayani</td>
			<td>
				<select name="petugas" id="petugas" class="form-control">
                    <?php foreach($data_petugas as $petugas): ?>
                        <option value="<?php echo $petugas['nip']; ?>"><?php echo $petugas['nama_petugas']; ?></option>
                    <?php endforeach; ?>
                </select>      
			</td>
		</tr>
		<tr>
			<td>Nama Buku yang Dipinjam</td>
			<td>
                <select name="buku" id="buku" class="form-control">
                    <?php foreach($data_buku as $buku): ?>
                        <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['nama_buku']; ?></option>
                    <?php endforeach; ?>
                </select>      
            </td>
		</tr>
		<tr>
			<td>jumlah peminjaman</td>
			<td><input type="text" name="jumlah_peminjaman" value="" required="" class="form-control"></td>
		</tr>
        <tr>
			<td>Tanggal peminjaman</td>
			<td><input type="date" name="tgl_peminjaman" value="" required="" class="form-control"></td>
		</tr>	
        <tr>
			<td>Batas Peminjaman</td>
			<td><input type="date" name="batas_peminjaman" size="20" value="" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<select name="status" id="status" required="" class="form-control">
					<option value="Belum Dikembalikan">Belum Dikembalikan</option>
					<option value="Telah Dikembalikan">Telah Dikembalikan</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>

