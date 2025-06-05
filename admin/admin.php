<?php 
session_start();
if ($_SESSION['level'] != 'admin') {
    echo "<script>
        alert('Maaf, Anda bukan Admin! Silakan Login terlebih dahulu!');
        window.location.assign('../index2.php');
    </script>";
    exit;
}
include "../koneksi.php";

$sql = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas = '$_SESSION[id_petugas]'");
$data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Pembayaran SPP</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            width: 220px;
            background-color: #343a40;
            padding-top: 20px;
            overflow-y: auto;
        }
        .sidebar h5 {
            color: #fff;
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            font-weight: 500;
            transition: background-color 0.2s ease-in-out;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
        .sidebar a.text-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
        .main-content {
            margin-left: 230px;
            padding: 30px 20px;
            min-height: 100vh;
        }
        #paymentChart {
            width: 100% !important;
            max-width: 1000px;
            height: 450px !important;
            margin: 20px auto;
        }
        @media (max-width: 767.98px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding-top: 10px;
            }
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
        .payment-info {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }
        .payment-info strong {
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h5>ADMIN SPP</h5>
    <a href="admin.php" class="<?= !isset($_GET['url']) ? 'active' : '' ?>">🏠 Dashboard</a>
    <a href="admin.php?url=spp" class="<?= @$_GET['url'] == 'spp' ? 'active' : '' ?>">💸 Data SPP</a>
    <a href="admin.php?url=kelas" class="<?= @$_GET['url'] == 'kelas' ? 'active' : '' ?>">🏫 Data Kelas</a>
    <a href="admin.php?url=siswa" class="<?= @$_GET['url'] == 'siswa' ? 'active' : '' ?>">👩‍🎓 Data Siswa</a>
    <a href="admin.php?url=petugas" class="<?= @$_GET['url'] == 'petugas' ? 'active' : '' ?>">🧑‍💼 Data Petugas</a>
    <a href="admin.php?url=pembayaran" class="<?= @$_GET['url'] == 'pembayaran' ? 'active' : '' ?>">💰 Pembayaran</a>
    <a href="admin.php?url=laporan" class="<?= @$_GET['url'] == 'laporan' ? 'active' : '' ?>">📄 Laporan</a>
    <a href="admin.php?url=logout" class="text-danger">🚪 Logout</a>
</div>

<div class="main-content">
    <div class="container-fluid">
        <h3 class="mb-3">Aplikasi Pembayaran SPP</h3>
        <div class="alert alert-info" role="alert">
            Selamat Datang <strong><?= htmlspecialchars($_SESSION['nama_petugas']) ?></strong>! Anda login sebagai <strong>ADMINISTRATOR</strong> Aplikasi Pembayaran SPP.
        </div>

        <div class="card mt-3 shadow-sm">
            <div class="card-body">
                <?php 
                $file = @$_GET['url'];
                if (empty($file)) {
                    echo "<h4>Selamat Datang di Halaman Administrator</h4>";
                    echo "<p>Gunakan menu di samping untuk mengelola data.</p>";

                    // Siapkan data chart dan detail pembayaran
                    $labels = [];
                    $sudahBayarData = [];
                    $kekuranganData = [];

                    // Ambil data siswa lengkap dengan kelas dan nominal spp
                    $sqlChart = mysqli_query($koneksi, "SELECT siswa.*, kelas.nama_kelas, spp.nominal FROM siswa 
                        INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
                        INNER JOIN spp ON siswa.id_spp = spp.id_spp 
                        ORDER BY siswa.nama ASC");

                    echo '<div class="mb-4">';
                    while ($dataChart = mysqli_fetch_array($sqlChart)) {
                        $nama = $dataChart['nama'];
                        $nisn = $dataChart['nisn'];
                        $nominal = $dataChart['nominal'];

                        // Hitung total pembayaran yang sudah dilakukan
                        $pembayaranQuery = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS jumlah_bayar FROM pembayaran WHERE nisn = '$nisn'");
                        $pembayaranData = mysqli_fetch_array($pembayaranQuery);
                        $sudah_bayar = $pembayaranData['jumlah_bayar'] ?? 0;

                        // Kalkulasi kekurangan, pastikan minimal 0
                        $kekurangan = max(0, $nominal - $sudah_bayar);

                        $labels[] = $nama;
                        $sudahBayarData[] = $sudah_bayar;
                        $kekuranganData[] = $kekurangan;

                        // Tampilkan detail pembayaran siswa dengan format rupiah walau kecil
                        echo '<div class="payment-info">';
                        echo '<strong>' . htmlspecialchars($nama) . '</strong> - Sudah Dibayar: <span>Rp ' . number_format($sudah_bayar, 0, ',', '.') . '</span>, Kekurangan: <span>Rp ' . number_format($kekurangan, 0, ',', '.') . '</span>';
                        echo '</div>';
                    }
                    echo '</div>';
                ?>
                    <hr />
                    <h5 class="mb-4">Grafik Pembayaran Siswa</h5>
                    <canvas id="paymentChart"></canvas>
                <?php
                } else {
                    include $file . ".php";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php if (empty($_GET['url'])): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('paymentChart').getContext('2d');

    // Fungsi bantu untuk memastikan bar minimal panjangnya tetap terlihat walau data kecil
    // Karena Chart.js versi 3+ tidak punya properti minBarLength default
    // Maka kita pakai plugin untuk menyesuaikan height bar minimal
    const minBarHeight = 10; // Minimal 10px supaya tetap kelihatan

    const paymentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [
                {
                    label: 'Sudah Dibayar',
                    data: <?= json_encode($sudahBayarData) ?>,
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Kekurangan',
                    data: <?= json_encode($kekuranganData) ?>,
                    backgroundColor: 'rgba(220, 53, 69, 0.7)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    borderWidth: 1,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    min: 0,
                    ticks: {
                        callback: function(value) {
                            return 'Rp. ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        borderDash: [5, 5]
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp. ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                },
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            barPercentage: 0.6,
            categoryPercentage: 0.7
        },
        plugins: [{
            // Plugin untuk mengatur tinggi bar minimal supaya bar kecil tetap terlihat
            id: 'minBarHeightPlugin',
            afterDatasetsDraw(chart) {
                const {ctx, chartArea: {top, bottom, left, right}, scales: {x, y}} = chart;
                chart.data.datasets.forEach((dataset, datasetIndex) => {
                    chart.getDatasetMeta(datasetIndex).data.forEach((bar, index) => {
                        const model = bar;
                        const barHeight = Math.abs(model.y - model.base);
                        if(barHeight < minBarHeight && barHeight > 0) {
                            const direction = model.base > model.y ? -1 : 1;
                            const newY = model.base + direction * minBarHeight;
                            ctx.save();
                            ctx.fillStyle = dataset.backgroundColor;
                            ctx.fillRect(model.x - model.width / 2, newY, model.width, -direction * minBarHeight);
                            ctx.restore();
                        }
                    });
                });
            }
        }]
    });
});
</script>
<?php endif; ?>

</body>
</html>
