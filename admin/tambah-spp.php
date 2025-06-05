<h5>Halaman Data SPP</h5>
<a href="?url=spp" class="btn btn-primary">Kembali</a>
<hr>
<form method="post" action="?url=tambah-spp">
	<div class="form-group mb-2">
		<label>Tahun</label>
		<input type="number" name="tahun" maxlength="4" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Nominal</label>
		<input type="number" name="nominal" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
		<button type="reset" class="btn btn-warning">Kosongkan</button>
	</div>
</form>

<?php 
include "../koneksi.php";
if(isset($_POST['submit'])){
	$tahun = $_POST['tahun'];
	$nominal = $_POST['nominal'];

$sql = mysqli_query($koneksi,"INSERT INTO spp (tahun, nominal) VALUES('$tahun','$nominal')");

if($sql){
	echo "<script>
	alert('Data berhasil ditambahkan!')
	window.location.assign('?url=spp')
	</script>";
}else{
	echo "<script>
	alert('Data gagal ditambahkan!')
	</script>";
}
}
 ?>
