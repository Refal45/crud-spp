<?php 
$nisn = $_GET['nisn']; // Ambil NISN dari parameter URL
include "../koneksi.php";

// Hapus data dari tabel siswa berdasarkan NISN
$sql = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn = '$nisn'");

if($sql){
	echo "<script>
	alert('Data berhasil dihapus!');
	window.location.assign('?url=siswa');
	</script>";
} else {
	echo "<script>
	alert('Data gagal dihapus!');
	window.location.assign('?url=siswa');
	</script>";
}
?>
