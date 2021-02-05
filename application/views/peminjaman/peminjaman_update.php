<form method="post" action="<?php echo site_url('peminjaman/update_submit/'.$data_peminjaman_single['id_peminjaman']);?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>Mahasiswa Peminjam</td>
			<td>
				<select name="mahasiswa" id="mahasiswa" class="form-control">
                    <?php foreach($data_mahasiswa as $mhs): ?>
                        <?php if($mhs['nim'] == $data_peminjaman_single['nim']): ?>
                            <option value="<?php echo $mhs['nim']; ?>" selected><?php echo $mhs['nama_mhs']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $mhs['nim']; ?>"><?php echo $mhs['nama_mhs']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>      
			</td>
		</tr>
		<tr>
			<td>Petugas yang Melayani</td>
			<td>
				<select name="petugas" id="petugas" class="form-control">
                    <?php foreach($data_petugas as $petugas): ?>
                        <?php if($petugas['nip'] == $data_peminjaman_single['nip']): ?>
                            <option value="<?php echo $petugas['nip']; ?>" selected><?php echo $petugas['nama_petugas']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $petugas['nip']; ?>"><?php echo $petugas['nama_petugas']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>      
			</td>
		</tr>
		<tr>
			<td>Nama Buku yang Dipinjam</td>
			<td>
                <select name="buku" id="buku" class="form-control">
                    <?php foreach($data_buku as $buku): ?>
                        <?php if($buku['id_buku'] == $data_peminjaman_single['id_buku']): ?>
                            <option value="<?php echo $buku['id_buku']; ?>" selected><?php echo $buku['nama_buku']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $buku['id_buku']; ?>"><?php echo $buku['nama_buku']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>      
            </td>
		</tr>
        <tr>
			<td>Jumlah peminjaman</td>
			<td><input type="text" name="jumlah_peminjaman" value="<?php echo $data_peminjaman_single['jumlah_peminjaman']?>" required="" class="form-control"></td>
		</tr>
		
        <tr>
			<td>Tanggal peminjaman</td>
			<td><input type="date" name="tgl_peminjaman" value="<?php echo $data_peminjaman_single['tgl_peminjaman']?>" required="" class="form-control"></td>
		</tr>
		
        <tr>
			<td>Batas Peminjaman</td>
			<td><input type="date" name="batas_peminjaman" size="20" value="<?php echo $data_peminjaman_single['batas_peminjaman']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<select name="status" id="status" required="" class="form-control">
					<?php foreach($status as $status): ?>
                        <?php if($status ==$data_peminjaman_single['status']):?>
                        	 <option value="<?= $status; ?>" selected><?= $status; ?></option>
                        <?php else: ?>
                            <option value="<?= $status; ?>"><?= $status; ?></option>
                       <?php endif; ?>
                    <?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>

