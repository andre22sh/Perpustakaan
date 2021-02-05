<?php
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=export_data_pengembalian.xls" );
?>

        <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Peminjam</th>
                        <th>Buku yang Dipinjam</th>
                        <th>Batas Peminjamanan</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Jumlah Pengembalian</th>
                        <th>Denda Telat</th>
                        <th>Denda Hilang</th>
                        <th>Denda Rusak</th>
                        <th>Total Denda</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!--looping data provinsi-->
                    <?php foreach($data_pengembalian as $kembali):?>

                    <!--cetak data per baris-->
                    <tr>
                        <td><?php echo $kembali['id_pengembalian'];?></td>
                        <td><?php echo $kembali['nama_mhs'];?></td>
                        <td><?php echo $kembali['nama_buku']; ?></td>
                        <td><?php echo $kembali['batas_peminjaman']; ?></td>
                        <td><?php echo $kembali['tgl_pengembalian']; ?></td>
                        <td><?php echo $kembali['jumlah_pengembalian']; ?></td>
                        <td><?php echo $kembali['denda_telat']; ?></td>
                        <td><?php echo $kembali['denda_hilang']; ?></td>
                        <td><?php echo $kembali['denda_rusak']; ?></td>
                        <td><?php echo $kembali['total_denda'] <= 0?  ' - ' : $kembali['total_denda'] ?></td>
                        <?php endforeach?>
                    </tr>		
	            </tbody>
        </table>