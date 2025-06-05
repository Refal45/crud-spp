<?php 
include "koneksi.php";
$username 	= $_POST['username'];
$password	= $_POST['password'];
 
$login = mysqli_query($koneksi,
	"SELECT * FROM petugas WHERE username = '$username' 
	AND password = '$password'
	");

$cek = mysqli_num_rows($login);
if($cek>0){
	$data = mysqli_fetch_array($login);
	session_start();
		$_SESSION['id_petugas'] = $data['id_petugas'];
		$_SESSION['nama_petugas'] = $data['nama_petugas'];
		$_SESSION['level'] = $data['level'];

	if($data['level'] == 'admin'){
		header("location:transisi-login-admin.html");
	}else if($data['level'] == 'petugas'){
		header("location:transisi-login-petugas.html");
	}else {
		header("location:index2.php?pesan=gagal");
	}
}else {
	header("location:index2.php?pesan=gagal");
}
?>
