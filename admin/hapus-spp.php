<?php 
include "../koneksi.php";

$id_spp = $_GET['id_spp'];

$sql = mysqli_query($koneksi,"DELETE FROM spp WHERE id_spp='$id_spp'");

if($sql){
	echo "<script>
	alert('Data berhasil dihapus!')
	window.location.assign('?url=spp')
	</script>";
}else{
	echo "<script>
	alert('Data gagal dihapus!')
	</script>";
}
 ?>
