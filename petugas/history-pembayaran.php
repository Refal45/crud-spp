<?php 
include "../koneksi.php";

$nisn = isset($_GET['nisn']) ? mysqli_real_escape_string($koneksi, $_GET['nisn']) : '';

if(empty($nisn)) {
    echo "<script>alert('NISN tidak ditemukan!'); window.location.href='?url=pembayaran';</script>";
    exit;
}
?>

<h5>History Pembayaran</h5>
<a href="?url=pembayaran" class="btn btn-primary">Kembali</a>
<hr>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Tahun SPP</th>
            <th>Nominal</th>
            <th>Sudah Dibayar</th>
            <th>Tanggal Bayar</th>
            <th>Nama Petugas</th>
            <th>Proses</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = mysqli_query($koneksi,"
            SELECT 
                pembayaran.id_pembayaran,
                pembayaran.jumlah_bayar,
                pembayaran.tgl_bayar,
                siswa.nisn,
                siswa.nama AS nama_siswa,
                kelas.nama_kelas,
                spp.tahun,
                spp.nominal,
                petugas.nama_petugas
            FROM pembayaran
            JOIN siswa ON pembayaran.nisn = siswa.nisn
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            JOIN spp ON pembayaran.id_spp = spp.id_spp
            JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
            WHERE pembayaran.nisn = '$nisn'
            ORDER BY pembayaran.tgl_bayar DESC
        ");

        $no = 1;
        while($data = mysqli_fetch_assoc($sql)) {
        ?>
         <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['nisn']); ?></td>
            <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
            <td><?= htmlspecialchars($data['nama_kelas']); ?></td>
            <td><?= htmlspecialchars($data['tahun']); ?></td>
            <td><?= "Rp." . number_format($data['nominal'], 2, ',', '.'); ?></td>
            <td><?= "Rp." . number_format($data['jumlah_bayar'], 2, ',', '.'); ?></td>
            <td><?= htmlspecialchars($data['tgl_bayar']); ?></td>
            <td><?= htmlspecialchars($data['nama_petugas']); ?></td>
            <td>
                <a href="?url=hapus-pembayaran&id_pembayaran=<?= $data['id_pembayaran']; ?>" 
                   class="btn btn-danger" 
                   onclick="return confirm('Yakin ingin hapus data pembayaran ini?');">Hapus</a>
            </td>
         </tr>
        <?php } ?>
    </tbody>
</table>
