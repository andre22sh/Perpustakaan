<?php
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=export_data_peminjaman.xls" );
?>

<table border="1">
	<thead>
		<tr>
			<th>Nama Peminjam</th>
			<th>Petugas yang Melayani</th>
            <th>Buku yang Dipinjam</th>
            <th>Jumlah Peminjaman</th>
			<th>Tanggal Peminjaman</th>
            <th>Batas Pengembalian</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<!--looping data provinsi-->
		<?php foreach($data_peminjaman as $pinjam):?>

		<!--cetak data per baris-->
		<tr>
			<td><?php echo $pinjam['nama_mhs'];?></td>
			<td><?php echo $pinjam['nama_petugas'];?></td>
            <td><?php echo $pinjam['nama_buku'];?></td>
			<td><?php echo $pinjam['jumlah_peminjaman'];?></td>
            <td><?php echo $pinjam['tgl_peminjaman'];?></td>
            <td><?php echo $pinjam['batas_peminjaman'];?></td>
			<td><?php echo $pinjam['status'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>