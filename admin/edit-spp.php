<?php 
$id_spp = $_GET['id_spp'];
include "../koneksi.php";
$sql = mysqli_query($koneksi,"SELECT * FROM spp WHERE id_spp = '$id_spp'");
$data = mysqli_fetch_array($sql);
 ?>
<h5>Halaman Data SPP</h5>
<a href="?url=spp" class="btn btn-primary">Kembali</a>
<hr>
<form method="post" action="?url=edit-spp&id_spp=<?= $id_spp; ?>">
	<div class="form-group mb-2">
		<label>Tahun</label>
		<input value ="<?= $data['tahun'] ?>" type="number" name="tahun" maxlength="4" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Nominal</label>
		<input value ="<?= $data['nominal'] ?>" type="number" name="nominal" maxlength="13" class="form-control" required>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
		<button type="reset" class="btn btn-warning">Kosongkan</button>
	</div>
</form>

<?php 
include "../koneksi.php";
if(isset($_POST['submit'])){
	$tahun 	 = $_POST['tahun'];
	$nominal = $_POST['nominal'];

$sql = mysqli_query($koneksi,"UPDATE spp SET tahun = '$tahun', nominal = '$nominal' WHERE id_spp='$id_spp'");

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
