<?php 
session_start();
if (empty($_SESSION['nisn'])) {
    echo "<script>
        alert('Maaf, Anda bukan Siswa! Silakan Login terlebih dahulu!');
        window.location.assign('../index.php');
    </script>";
    exit;
}

include "../koneksi.php";

$sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$_SESSION[nisn]'");
$data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Siswa Pembayaran SPP</title>
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
            background-color: #007bff;
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
            background-color: #0056b3;
        }
        .main-content {
            margin-left: 230px;
            padding: 30px 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h5>SPP SISWA</h5>
    <a href="siswa.php" class="<?= !isset($_GET['url']) ? 'active' : '' ?>">🏠 Dashboard</a>
    <a href="siswa.php?url=history-pembayaran" class="<?= @$_GET['url'] == 'history-pembayaran' ? 'active' : '' ?>">📜 History Pembayaran</a>
    <a href="siswa.php?url=logout" class="text-danger">🚪 Logout</a>
</div>

<div class="main-content">
    <div class="container-fluid">
        <h3 class="mb-3">Aplikasi Pembayaran SPP</h3>
        <div class="alert alert-primary">
            Selamat Datang <b><?= htmlspecialchars($_SESSION['nama']) ?></b>! Anda login sebagai <b>SISWA</b>.
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <?php 
                $file = @$_GET['url'];
                $path = $file . ".php";

                // Pastikan file ada dan berada di direktori yang benar
                if (empty($file)) {
                    echo "<h4>Selamat Datang di Halaman Siswa</h4>";
                    echo "Gunakan menu di samping untuk melihat histori pembayaran atau logout.";
                } elseif (file_exists($path)) {
                    include $path;
                } else {
                    echo "<div class='alert alert-danger'>Halaman tidak ditemukan!</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
