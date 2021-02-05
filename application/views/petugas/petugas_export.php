<?php
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=export_data_petugas.xls" );
?>

<table border="1">
	<thead>
		<tr>
			<th>NIP</th>
			<th>Nama Petugas</th>
            <th>Alamat Petugas</th>
            <th>No.telpon</th>
		</tr>
	</thead>
	<tbody>
		<!--looping data provinsi-->
		<?php foreach($data_petugas as $petugas):?>

		<!--cetak data per baris-->
		<tr>
			<td><?php echo $petugas['nip'];?></td>
			<td><?php echo $petugas['nama_petugas'];?></td>
            <td><?php echo $petugas['alamat_petugas'];?></td>
            <td><?php echo $petugas['notelp_petugas'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>