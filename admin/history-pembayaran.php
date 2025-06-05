<?php 
$nisn = $_GET['nisn'];
 ?>
 <h5>History Pembayaran</h5>
 <a href="?url=pembayaran" 
 class="btn btn-primary">Kembali</a>
 <hr>
 <table class="table table-stripped
 table-bordered">
 	<thead>
 		<th>No</th>
 		<th>NISN</th>
 		<th>Nama Siswa</th>
 		<th>Kelas</th>
 		<th>Tahun SPP</th>
 		<th>Nominal</th>
 		<th>Sudah Dibayar</th>
 		<th>Tanggal Bayar</th>
 		<th>Nama Petugas</th>
 		<th>Proses</th>
 	</thead>
 	<tbody>
 		<?php 
 		include "../koneksi.php";
 		$sql = mysqli_query($koneksi,"SELECT *FROM pembayaran, siswa, kelas, spp, petugas WHERE pembayaran.nisn = siswa.nisn AND siswa.id_kelas = kelas.id_kelas AND pembayaran.id_spp = spp.id_spp AND pembayaran.id_petugas = petugas.id_petugas AND pembayaran.nisn = '$nisn' ORDER BY tgl_bayar DESC");
 		$no = 1;
 		while($data = mysqli_fetch_array($sql)){
 		 ?>
 		 <tr>
 		 	<td><?php echo $no; ?></td>
 		 	<td><?php echo $data['nisn'];?></td>
 		 	<td><?php echo $data['nama'];?></td>
 		 	<td><?php echo $data['nama_kelas']; ?></td>
 		 	<td><?= $data['tahun'];?></td>
 		 	<th><?php echo "Rp.".number_format($data['nominal'],2,',','.'); ?></th>
 		 	<td><?php echo "Rp.".number_format($data['jumlah_bayar'],2,',','.'); ?></td>
 		 	<td><?= $data['tgl_bayar']; ?></td>
 		 	<td><?= $data['nama_petugas']; ?></td>
 		 	<td><a href="?url=hapus-pembayaran&id_pembayaran=<?php echo $data['id_pembayaran']; ?>" class="btn btn-danger">Hapus</a></td>
 		 </tr>
 		 <?php $no++;} ?>
 	</tbody>
 </table>
