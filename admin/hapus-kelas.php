<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../koneksi.php";

if (!isset($_GET['id_kelas']) || empty($_GET['id_kelas'])) {
    echo "<script>
    alert('ID Kelas tidak ditemukan!');
    window.location.assign('?url=kelas');
    </script>";
    exit;
}

$id_kelas = $_GET['id_kelas'];

$result = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'");
if (mysqli_num_rows($result) == 0) {
    echo "<script>
    alert('Data tidak ditemukan!');
    window.location.assign('?url=kelas');
    </script>";
    exit;
}

$stmt = mysqli_prepare($koneksi, "DELETE FROM kelas WHERE id_kelas = ?");
mysqli_stmt_bind_param($stmt, "i", $id_kelas);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
    alert('Data berhasil dihapus!');
    window.location.assign('?url=kelas');
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus!');
    </script>";
}

mysqli_stmt_close($stmt);
?>
