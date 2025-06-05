<h5>Pilih Siswa Untuk  Pembayaran</h5>
<hr>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>NISN</th>
			<th>Nama Siswa</th>
			<th>Kelas</th>
			<th>Tahun</th>
			<th>Nominal</th>
			<th>Sudah Dibayar</th>
			<th>Kekurangan</th>
			<th>Status</th>
			<th>History</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		include "../koneksi.php";
		$sql = mysqli_query($koneksi,"SELECT * FROM siswa, kelas, spp WHERE siswa.id_kelas=kelas.id_kelas AND siswa.id_spp=spp.id_spp ORDER BY nama ASC");	
		$no = 1;
		while($data = mysqli_fetch_array($sql)){

			$data_pembayaran = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) as jumlah_bayar FROM pembayaran WHERE nisn = '$data[nisn]'");
			
			$data_pembayaran = mysqli_fetch_array($data_pembayaran);
			$sudah_bayar = $data_pembayaran['jumlah_bayar'];
			$kekurangan = $data['nominal'] - $data_pembayaran['jumlah_bayar'];
		 ?>
		 <tr>
		 	<td><?php echo $no ?></td>
		 	<td><?php echo $data['nisn']; ?></td>
		 	<td><?php echo $data['nama']; ?></td>
		 	<td><?php echo $data['nama_kelas']; ?></td>
		 	<td><?php echo $data['tahun']; ?></td>
		 	<th><?php echo "Rp.".number_format($data['nominal'],2,',','.'); ?></th>
		 	<td><?php echo "Rp.".number_format($sudah_bayar,2,',','.'); ?></td>
		 	<td><?php echo "Rp.".number_format($kekurangan,2,',','.'); ?></td>
		 	<td>
		 	<?php 
		 	if($kekurangan==0){
		 		echo "<span class='badge text-bg-success'>Sudah Lunas</span>";
		 	}else{?>
				<a href="?url=tambah-pembayaran&nisn=<?= $data['nisn'] ?>&kekurangan=<?= $kekurangan ?>" class="btn btn-danger">Pilih & Bayar</a>
		 	<?php } ?>
		 	</td>

		 	<td><a href="?url=history-pembayaran&nisn=<?= $data['nisn'] ?>" class='btn btn-info'>History</a></td>
		 </tr>
		<?php $no++; }?>
	</tbody>
</table>
