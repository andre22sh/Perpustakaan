<form method="post" action="<?php echo site_url('mahasiswa/update_submit/'.$data_mahasiswa_single['nim']);?>">
    <table class="table table-striped">
        <tr>
            <td>NIM</td>
            <td><input type="text" name="nim" value="<?php echo $data_mahasiswa_single['nim'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>Nama Mahasiswa</td>
            <td><input type="text" name="nama_mhs" value="<?php echo $data_mahasiswa_single['nama_mhs'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat_mhs" value="<?php echo $data_mahasiswa_single['alamat_mhs'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td><input type="text" name="jurusan_mhs" value="<?php echo $data_mahasiswa_single['prodi_mhs'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>No. Telpon</td>
            <td><input type="text" name="notelp_mhs" value="<?php echo $data_mahasiswa_single['notelp_mhs'];?>" required="" class="form-control"></td>
        </tr>       
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
        </tr>
    </table>
</form>