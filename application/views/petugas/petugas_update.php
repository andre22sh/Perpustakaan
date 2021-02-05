<form method="post" action="<?php echo site_url('petugas/update_submit/'.$data_petugas_single['nip']);?>">
    <table class="table table-striped">
        <tr>
            <td>NIP</td>
            <td><input type="text" name="nip" value="<?php echo $data_petugas_single['nip'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama_petugas" value="<?php echo $data_petugas_single['nama_petugas'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="alamat_petugas" value="<?php echo $data_petugas_single['alamat_petugas'];?>" required="" class="form-control"></td>
        </tr>
        <tr>
            <td>No. Telpon</td>
            <td><input type="text" name="notelp_petugas" value="<?php echo $data_petugas_single['notelp_petugas'];?>" required="" class="form-control"></td>
        </tr>       
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="Simpan" class="btn btn-primary"></td>
        </tr>
    </table>
</form>