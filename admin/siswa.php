<h5>Halaman Data Siswa</h5>
<a href="?url=tambah-siswa" class="btn btn-primary">Tambah Siswa</a>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>NISN</th>
			<th>NIS</th>
            <th>Nama</th>
            <th>ID Kelas</th>
			<th>Alamat</th>
            <th>No Telp</th>
            <th>ID Spp</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		include "../koneksi.php";
		$sql = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nisn ASC");
		$no = 1;

		while($data = mysqli_fetch_array($sql)){
		 ?>
		 <tr>
		 	<td><?php echo $no ?></td>
		 	<td><?php echo $data['nisn']; ?></td>
		 	<td><?php echo $data['nis']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['id_kelas']; ?></td>
		 	<td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['no_telp']; ?></td>
            <th><?php echo $data['id_spp']; ?></td>
		 	<td><a href="?url=edit-siswa&nisn=<?= $data['nisn'] ?>" class='btn btn-primary'>Edit</a></td>
		 	<td><a href="?url=hapus-siswa&nisn=<?= $data['nisn'] ?>" class='btn btn-warning' onClick="return confirm('Apakah anda ingin menghapus data Siswa Nisn <?php echo $data['nisn'] ?>?')">Hapus</a></td>
		 </tr>
		<?php $no++; }?>
	</tbody>
</table>