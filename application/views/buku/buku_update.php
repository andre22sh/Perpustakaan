<form method="post" action="<?php echo site_url('buku/update_submit/'.$data_buku_single['id_buku']);?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>ID Buku</td>
			<td><input type="text" name="id_buku" value="<?php echo $data_buku_single['id_buku']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Nama Buku</td>
			<td><input type="text" name="nama_buku" value="<?php echo $data_buku_single['nama_buku']?>" required="" class="form-control"></td>
		</tr>
		<tr>
			<td>Kategori</td>
			<td>
                <select name="kategori" id="kategori" class="form-control">
                    <?php foreach($data_kategori as $kategori) : ?>
                       <?php if($kategori['id_kategori'] == $data_buku_single['id_kategori']): ?>
                            <option value="<?php echo $kategori['id_kategori']; ?>" selected><?php echo $kategori['nama_kategori']; ?></option>
                        <?php else:?>
                              <option value="<?php echo $kategori['id_kategori']; ?>"><?php echo $kategori['nama_kategori']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>      
            </td>
		</tr>
		<tr>
			<td>Pengarang</td>
			<td>
                <select name="pengarang" id="pengarang" class="form-control">
                    <?php foreach($data_pengarang as $pengarang): ?>
                        <?php if($pengarang['id_pengarang'] == $data_buku_single['id_pengarang']): ?>
                            <option value="<?php echo $pengarang['id_pengarang']; ?>" selected><?php echo $pengarang['nama_pengarang']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $pengarang['id_pengarang']; ?>"><?php echo $pengarang['nama_pengarang']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </td>
		</tr>
        <tr>
			<td>Penerbit</td>
			<td>
                <select name="penerbit" id="penerbit" class="form-control">
                    <?php foreach($data_penerbit as $penerbit): ?>
                        <?php if($penerbit['id_penerbit'] == $data_buku_single['id_penerbit']): ?>
                            <option value="<?php echo $penerbit['id_penerbit']; ?>" selected><?php echo $penerbit['nama_penerbit']; ?></option>
                        <?php else:?>
                            <option value="<?php echo $penerbit['id_penerbit']; ?>"><?php echo $penerbit['nama_penerbit']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </td>
		</tr>

        <tr>
			<td>Jumlah Buku</td>
			<td><input type="text" name="jumlah_buku" value="<?php echo $data_buku_single['jumlah_buku']?>" required="" class="form-control"></td>
		</tr>
		
        <tr>
			<td>Cover Buku</td>
			<td><input type="file" name="gambar" size="20" value="<?php echo $data_buku_single['cover_buku']?>" required="" class="form-control"></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
		</tr>
	</table>
</form>

<?php if(!empty($response)):?>
	<?php echo $response ;?>
<?php endif ;?>
