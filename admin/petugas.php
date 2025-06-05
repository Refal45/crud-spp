<h5>Halaman Data Petugas</h5>
<a href="?url=tambah-petugas" class="btn btn-primary">Tambah Petugas</a>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>ID</th>
			<th>Username</th>
			<th>Password</th>
			<th>Nama Petugas</th>
            <th>Level</th>
            <th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		include "../koneksi.php";
		$sql = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY id_petugas ASC");
		$no = 1;

		while($data = mysqli_fetch_array($sql)){
		 ?>
		 <tr>
		 	<td><?php echo $no ?></td>
		 	 <td><?php echo $data['id_petugas']; ?></td>
            <td><?php echo $data['username']; ?></td>
            <td><?php echo $data['password']; ?></td>
            <td><?php echo $data['nama_petugas']; ?></td>
            <td><?php echo $data['level']; ?></td>
		 	<td><a href="?url=edit-petugas&id_petugas=<?= $data['id_petugas'] ?>" class='btn btn-primary'>Edit</a></td>
		 </tr>
		<?php $no++; }?>
	</tbody>
</table>