<?php 
include "../koneksi.php";

// Ambil filter dari URL jika ada
$tahun_filter = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$bulan_filter = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$level_filter = isset($_GET['level']) ? $_GET['level'] : '';

// Query dasar
$query = "SELECT pembayaran.*, siswa.nama, kelas.nama_kelas, spp.tahun, spp.nominal, petugas.nama_petugas, petugas.level 
          FROM pembayaran 
          JOIN siswa ON pembayaran.nisn = siswa.nisn 
          JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
          JOIN spp ON pembayaran.id_spp = spp.id_spp 
          JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
          WHERE 1=1";

if($tahun_filter != ''){
    $query .= " AND YEAR(pembayaran.tgl_bayar) = '$tahun_filter'";
}
if($bulan_filter != ''){
    $query .= " AND MONTH(pembayaran.tgl_bayar) = '$bulan_filter'";
}
if($level_filter != ''){
    $query .= " AND petugas.level = '$level_filter'";
}

$query .= " ORDER BY pembayaran.tgl_bayar DESC";
$sql = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { margin: 2cm; font-size: 12pt; }
            table { width: 100%; border-collapse: collapse; font-size: 11pt; }
            th, td { border: 1px solid #000; padding: 6px; text-align: left; }
            h5 { text-align: center; margin-bottom: 20px; }
        }
        @page {
            size: A4 portrait;
            margin: 2cm;
        }
    </style>
    <script>
        function cetakLaporan() {
            window.print();
        }

        function exportToPDF() {
            const element = document.getElementById("laporan-content");
            html2pdf().from(element).set({
                margin: 1,
                filename: 'laporan_pembayaran.pdf',
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'cm', format: 'a4', orientation: 'portrait' }
            }).save();
        }

        function exportToExcel() {
            const table = document.getElementById("tabel-laporan");
            const html = table.outerHTML.replace(/ /g, '%20');

            const filename = 'laporan_pembayaran.xls';
            const dataType = 'application/vnd.ms-excel';

            const a = document.createElement('a');
            a.href = 'data:' + dataType + ', ' + html;
            a.download = filename;
            a.click();
        }
    </script>
</head>
<body>

<div class="container mt-4" id="laporan-content">
    <h5>LAPORAN PEMBAYARAN SPP</h5>

    <div class="no-print">
        <a href="?url=laporan" class="btn btn-primary mb-3">Reset Filter</a>
        <button onclick="cetakLaporan()" class="btn btn-secondary mb-3">🖨️ Print</button>
        <button onclick="exportToPDF()" class="btn btn-danger mb-3">📄 Export PDF</button>
        <button onclick="exportToExcel()" class="btn btn-success mb-3">📊 Export Excel</button>

        <form method="get" action="" class="mb-3">
            <input type="hidden" name="url" value="laporan">
            <div class="row g-2 align-items-end">
                <div class="col-auto">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" placeholder="Tahun" value="<?= htmlspecialchars($tahun_filter) ?>">
                </div>
                <div class="col-auto">
                    <label for="bulan" class="form-label">Bulan</label>
                    <select name="bulan" id="bulan" class="form-select">
                        <option value="">-- Semua Bulan --</option>
                        <?php 
                        for($m=1; $m<=12; $m++){
                            $selected = ($bulan_filter == $m) ? 'selected' : '';
                            $bulanNama = date('F', mktime(0,0,0,$m,10));
                            echo "<option value='$m' $selected>$bulanNama</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="level" class="form-label">Level</label>
                    <select name="level" id="level" class="form-select">
                        <option value="">-- Semua Level --</option>
                        <option value="admin" <?= ($level_filter == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= ($level_filter == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped table-bordered" id="tabel-laporan">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Jumlah Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Nama Petugas</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total_bayar = 0;
            while($data = mysqli_fetch_array($sql)){
                $total_bayar += $data['jumlah_bayar'];
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= htmlspecialchars($data['nisn']) ?></td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
                <td><?= htmlspecialchars($data['nama_kelas']) ?></td>
                <td><?= htmlspecialchars($data['tahun']) ?></td>
                <td><?= "Rp.".number_format($data['nominal'],2,',','.') ?></td>
                <td><?= "Rp.".number_format($data['jumlah_bayar'],2,',','.') ?></td>
                <td><?= htmlspecialchars($data['tgl_bayar']) ?></td>
                <td><?= htmlspecialchars($data['nama_petugas']) ?></td>
                <td><?= htmlspecialchars($data['level']) ?></td>
            </tr>
            <?php $no++; } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total Pembayaran:</th>
                <th colspan="4"><?= "Rp.".number_format($total_bayar,2,',','.') ?></th>
            </tr>
        </tfoot>
    </table>
</div>

</body>
</html>
