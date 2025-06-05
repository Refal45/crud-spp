<h5>Halaman Data Kelas</h5>
<a href="?url=tambah-kelas" class="btn btn-primary">Tambah Kelas</a>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Kelas</th>
            <th>Kompetensi Keahlian</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		include "../koneksi.php";
		$sql = mysqli_query($koneksi,"SELECT * FROM kelas ORDER BY id_kelas ASC");
		$no = 1;

		while($data = mysqli_fetch_array($sql)){
		 ?>
		 <tr>
		 	<td><?php echo $no ?></td>
		 	<td><?php echo $data['nama_kelas']; ?></td>
            <td><?php echo $data['kompetensi_keahlian']; ?></td>
		 	<td><a href="?url=edit-kelas&id_kelas=<?= $data['id_kelas'] ?>" class='btn btn-primary'>Edit</a></td>
		 	<td><a href="?url=hapus-kelas&id_kelas=<?= $data['id_kelas'] ?>" class='btn btn-warning' onClick="return confirm('Apakah anda ingin menghapus data Kelas ID Kelas <?php echo $data['id_kelas'] ?>?')">Hapus</a></td>
		 </tr>
		<?php $no++; }?>
	</tbody>
</table>