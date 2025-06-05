<h5>Halaman Data SPP</h5>
<a href="?url=tambah-spp" class="btn btn-primary">Tambah SPP</a>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Tahun</th>
			<th>Nominal</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		include "../koneksi.php";
		$sql = mysqli_query($koneksi,"SELECT * FROM spp ORDER BY tahun ASC");
		$no = 1;

		while($data = mysqli_fetch_array($sql)){
		 ?>
		 <tr>
		 	<td><?php echo $no ?></td>
		 	<td><?php echo $data['tahun']; ?></td>
		 	<td><?php echo "Rp.".number_format($data['nominal'],2,',','.'); ?></td>
		 	<td><a href="?url=edit-spp&id_spp=<?= $data['id_spp'] ?>" class='btn btn-primary'>Edit</a></td>
		 	<td><a href="?url=hapus-spp&id_spp=<?= $data['id_spp'] ?>" class='btn btn-warning' onClick="return confirm('Apakah anda ingin menghapus data SPP Tahun <?php echo $data['tahun'] ?>?')">Hapus</a></td>
		 </tr>
		<?php $no++; }?>
	</tbody>
</table>