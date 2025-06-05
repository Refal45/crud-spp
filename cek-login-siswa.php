<?php 
include "koneksi.php";

// Tangkap data dari form
$nisn = $_POST['nisn'];
$nis  = $_POST['nis'];

// Gunakan prepared statement untuk keamanan
$stmt = $koneksi->prepare("SELECT * FROM siswa WHERE nisn = ? AND nis = ?");
$stmt->bind_param("ss", $nisn, $nis);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    session_start();
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['nisn'] = $data['nisn'];

    // Redirect langsung ke halaman siswa
    header("Location: transisi-login-siswa.html");
    exit();
} else {
    // Jika data tidak ditemukan
    header("Location: index.php?pesan=gagal");
    exit();
}
?>
