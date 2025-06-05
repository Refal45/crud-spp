<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../koneksi.php";

// Ambil NISN dari session
if (!isset($_SESSION['nisn'])) {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

$nisn = $_SESSION['nisn'];

// Ambil data siswa dan info SPP
$data_siswa = mysqli_query($koneksi, "SELECT * FROM siswa 
    INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
    INNER JOIN spp ON siswa.id_spp = spp.id_spp 
    WHERE nisn = '$nisn'");
$siswa = mysqli_fetch_array($data_siswa);
?>

<h5>History Pembayaran Siswa</h5>
<hr>

<div class="card">
    <div class="card-body">
        <p><strong>NISN:</strong> <?= htmlspecialchars($siswa['nisn']); ?></p>
        <p><strong>Nama:</strong> <?= htmlspecialchars($siswa['nama']); ?></p>
        <p><strong>Kelas:</strong> <?= htmlspecialchars($siswa['nama_kelas']) . " - " . htmlspecialchars($siswa['kompetensi_keahlian']); ?></p>
        <p><strong>Tahun SPP:</strong> <?= htmlspecialchars($siswa['tahun']); ?></p>
        <p><strong>Nominal SPP:</strong> Rp.<?= number_format($siswa['nominal'], 2, ',', '.'); ?></p>
    </div>
</div>

<hr>

<h6>Riwayat Pembayaran</h6>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Dibayar</th>
            <th>Tahun Dibayar</th>
            <th>Jumlah Bayar</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $pembayaran = mysqli_query($koneksi, "SELECT * FROM pembayaran 
            INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
            WHERE nisn = '$nisn' ORDER BY tgl_bayar ASC");

        $total_bayar = 0;

        while ($data = mysqli_fetch_array($pembayaran)) {
            $total_bayar += $data['jumlah_bayar'];
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['tgl_bayar']); ?></td>
                <td><?= htmlspecialchars($data['bulan_dibayar']); ?></td>
                <td><?= htmlspecialchars($data['tahun_dibayar']); ?></td>
                <td>Rp.<?= number_format($data['jumlah_bayar'], 2, ',', '.'); ?></td>
                <td><?= htmlspecialchars($data['nama_petugas']); ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total Dibayar</th>
            <th colspan="2">Rp.<?= number_format($total_bayar, 2, ',', '.'); ?></th>
        </tr>
    </tfoot>
</table>

<a href="siswa.php" class="btn btn-secondary">Kembali</a>
