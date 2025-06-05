<?php 
$nisn = $_GET['nisn'];
include "../koneksi.php";
$sql = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nisn = '$nisn'");
$data = mysqli_fetch_array($sql);
?>
<h5>Halaman Edit Data Siswa</h5>
<a href="?url=siswa" class="btn btn-primary">Kembali</a>
<hr>
<form method="post" action="?url=edit-siswa&nisn=<?= $nisn; ?>">
	<div class="form-group mb-2">
		<label>NISN</label>
		<input value="<?= $data['nisn'] ?>" type="number" name="nisn" class="form-control" readonly>
	</div>
	<div class="form-group mb-2">
		<label>NIS</label>
		<input value="<?= $data['nis'] ?>" type="number" name="nis" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Nama</label>
		<input value="<?= $data['nama'] ?>" type="text" name="nama" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Kelas</label>
		<select name="id_kelas" class="form-control" required>
			<?php 
			$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
			while($row = mysqli_fetch_array($kelas)){
				$selected = $row['id_kelas'] == $data['id_kelas'] ? 'selected' : '';
				echo "<option value='$row[id_kelas]' $selected>$row[nama_kelas] - $row[kompetensi_keahlian]</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group mb-2">
		<label>Alamat</label>
		<textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
	</div>
	<div class="form-group mb-2">
		<label>No Telepon</label>
		<input value="<?= $data['no_telp'] ?>" type="text" name="no_telp" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>SPP</label>
		<select name="id_spp" class="form-control" required>
			<?php 
			$spp = mysqli_query($koneksi, "SELECT * FROM spp");
			while($row = mysqli_fetch_array($spp)){
				$selected = $row['id_spp'] == $data['id_spp'] ? 'selected' : '';
				echo "<option value='$row[id_spp]' $selected>$row[tahun] - Rp. $row[nominal]</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
		<button type="reset" class="btn btn-warning">Kosongkan</button>
	</div>
</form>

<?php 
if(isset($_POST['submit'])){
	$nis = $_POST['nis'];
	$nama = $_POST['nama'];
	$id_kelas = $_POST['id_kelas'];
	$alamat = $_POST['alamat'];
	$no_telp = $_POST['no_telp'];
	$id_spp = $_POST['id_spp'];

	$sql = mysqli_query($koneksi,"UPDATE siswa SET 
		nis = '$nis',
		nama = '$nama',
		id_kelas = '$id_kelas',
		alamat = '$alamat',
		no_telp = '$no_telp',
		id_spp = '$id_spp'
		WHERE nisn = '$nisn'");

	if($sql){
		echo "<script>
		alert('Data berhasil diubah!')
		window.location.assign('?url=siswa')
		</script>";
	}else{
		echo "<script>
		alert('Data gagal diubah!')
		</script>";
	}
}
?>
