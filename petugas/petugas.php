<?php 
session_start();
if ($_SESSION['level'] != 'petugas') {
    echo "<script>
        alert('Maaf, Anda bukan Petugas! Silakan Login terlebih dahulu!');
        window.location.assign('../index2.php');
    </script>";
    exit;
}
include "../koneksi.php";
$sql = mysqli_query($koneksi,"SELECT * FROM petugas WHERE id_petugas = '$_SESSION[id_petugas]'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Petugas Pembayaran SPP</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar h5 {
            color: white;
            text-align: center;
            margin-bottom: 1rem;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .main-content {
            margin-left: 230px;
            padding: 30px 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h5>PETUGAS SPP</h5>
    <a href="petugas.php" class="<?= !isset($_GET['url']) ? 'active' : '' ?>">🏠 Dashboard</a>
    <a href="petugas.php?url=siswa" class="<?= @$_GET['url'] == 'siswa' ? 'active' : '' ?>">👩‍🎓 Data Siswa</a>
    <a href="petugas.php?url=pembayaran" class="<?= @$_GET['url'] == 'pembayaran' ? 'active' : '' ?>">💰 Pembayaran</a>
    <a href="petugas.php?url=history-pembayaran" class="<?= @$_GET['url'] == 'history-pembayaran' ? 'active' : '' ?>">🕘 History Pembayaran</a>
    <a href="petugas.php?url=logout" class="text-danger">🚪 Logout</a>
</div>

<div class="main-content">
    <div class="container-fluid">
        <h3 class="mb-3">Aplikasi Pembayaran SPP</h3>
        <div class="alert alert-info">
            Selamat Datang <b><?= $_SESSION['nama_petugas'] ?></b>! Anda login sebagai <b>PETUGAS</b> Aplikasi Pembayaran SPP.
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <?php 
                $file = @$_GET['url'];
                if (empty($file)) {
                    echo "<h4>Selamat Datang di Halaman Petugas</h4>";
                    echo "Gunakan menu di samping untuk mengelola data siswa dan pembayaran.";
                } else {
                    $allowed_pages = ['siswa', 'pembayaran', 'history-pembayaran', 'hapus-pembayaran', 'tambah-pembayaran', 'tambah-siswa', 'logout'];
                    if (in_array($file, $allowed_pages) && file_exists($file . '.php')) {
                        include $file . ".php";
                    } else {
                        echo "<h5>Halaman tidak ditemukan!</h5>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
