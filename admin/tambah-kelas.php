<h5>Halaman Tambah Data Kelas</h5>
<a href="?url=kelas" class="btn btn-primary">Kembali</a>
<hr>
<form method="post" action="?url=tambah-kelas">
	<div class="form-group mb-2">
		<label>Nama Kelas</label>
		<input type="text" name="nama_kelas" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Kompetensi Keahlian</label>
		<input type="text" name="kompetensi_keahlian" class="form-control" required>
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

	$sql = mysqli_query($koneksi,"INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES('$nama_kelas','$kompetensi_keahlian')");

	if($sql){
		echo "<script>
		alert('Data berhasil ditambahkan!')
		window.location.assign('?url=kelas')
		</script>";
	}else{
		echo "<script>
		alert('Data gagal ditambahkan!')
		</script>";
	}
}
?>
