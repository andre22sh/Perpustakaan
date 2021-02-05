<?php
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=export_data_buku.xls" );
?>

<table border="1">
	<thead>
		<tr>
			<th>ID Buku</th>
			<th>Nama Buku</th>
            <th>Kategori</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Jumlah Buku</th>
            <th>Cover Buku</th>
		</tr>
	</thead>
	<tbody>
		<!--looping data provinsi-->
		<?php foreach($data_buku as $buku):?>

		<!--cetak data per baris-->
		<tr>
			<td><?php echo $buku['id_buku'];?></td>
			<td><?php echo $buku['nama_buku'];?></td>
            <td><?php echo $buku['nama_kategori'];?></td>
            <td><?php echo $buku['nama_pengarang'];?></td>
            <td><?php echo $buku['nama_penerbit'];?></td>
            <td><?php echo $buku['jumlah_buku'];?></td>
            <td><?php echo $buku['cover_buku'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>