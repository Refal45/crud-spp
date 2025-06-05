<?php 
include "../koneksi.php";

$id_pembayaran = $_GET['id_pembayaran'];

$sql = mysqli_query($koneksi,"DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");

if($sql){
	echo "<script>
	alert('Data berhasil dihapus!')
	window.location.assign('?url=pembayaran')
	</script>";
}else{
	echo "<script>
	alert('Data gagal dihapus!')
	</script>";
}
 ?>
