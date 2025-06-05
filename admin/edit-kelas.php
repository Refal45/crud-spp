<?php 
$id_kelas = $_GET['id_kelas'];
include "../koneksi.php";
$sql = mysqli_query($koneksi,"SELECT * FROM kelas WHERE id_kelas = '$id_kelas'");
$data = mysqli_fetch_array($sql);
?>
<h5>Halaman Edit Data Kelas</h5>
<a href="?url=kelas" class="btn btn-primary">Kembali</a>
<hr>
<form method="post" action="?url=edit-kelas&id_kelas=<?= $id_kelas; ?>">
	<div class="form-group mb-2">
		<label>Nama Kelas</label>
		<input value="<?= $data['nama_kelas'] ?>" type="text" name="nama_kelas" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Kompetensi Keahlian</label>
		<input value="<?= $data['kompetensi_keahlian'] ?>" type="text" name="kompetensi_keahlian" class="form-control" required>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
		<button type="reset" class="btn btn-warning">Kosongkan</button>
	</div>
</form>

<?php 
include "../koneksi.php";
if(isset($_POST['submit'])){
	$nama_kelas = $_POST['nama_kelas'];
	$kompetensi_keahlian = $_POST['kompetensi_keahlian'];

	$sql = mysqli_query($koneksi,"UPDATE kelas SET nama_kelas = '$nama_kelas', kompetensi_keahlian = '$kompetensi_keahlian' WHERE id_kelas = '$id_kelas'");

	if($sql){
		echo "<script>
		alert('Data berhasil diubah!')
		window.location.assign('?url=kelas')
		</script>";
	}else{
		echo "<script>
		alert('Data gagal diubah!')
		</script>";
	}
}
?>
