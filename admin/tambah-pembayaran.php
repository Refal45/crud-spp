<?php 
// Cek dan mulai session hanya jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../koneksi.php";

// Ambil data dari URL
$nisn = isset($_GET['nisn']) ? $_GET['nisn'] : '';
$kekurangan = isset($_GET['kekurangan']) ? $_GET['kekurangan'] : 0;

// Ambil data siswa dari database
$sql = mysqli_query($koneksi, "SELECT * FROM siswa 
                                JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
                                JOIN spp ON siswa.id_spp = spp.id_spp 
                                WHERE nisn = '$nisn'");
$data = mysqli_fetch_array($sql);
?>

<h5>Halaman Pembayaran SPP</h5>
<a href="?url=pembayaran" class="btn btn-primary">Kembali</a>
<hr>

<form method="post" action="?url=tambah-pembayaran&nisn=<?= $nisn ?>&kekurangan=<?= $kekurangan ?>">
    <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>" class="form-control">
    <input type="hidden" name="id_petugas" value="<?= $_SESSION['id_petugas'] ?>">
    
    <div class="form-group mb-2">
        <label>Nama Petugas</label>
        <input value="<?= $_SESSION['id_petugas'] ?>" type="text" class="form-control" disabled>
    </div>
    
    <div class="form-group mb-2">
        <label>NISN</label>
        <input value="<?= $data['nisn'] ?>" type="number" name="nisn" class="form-control" readonly>
    </div>
    
    <div class="form-group mb-2">
        <label>Nama Siswa</label>
        <input value="<?= $data['nama'] ?>" type="text" class="form-control" disabled>
    </div>
    
    <div class="form-group mb-2">
        <label>Tanggal Bayar</label>
        <input type="date" name="tgl_bayar" class="form-control" required>
    </div>
    
    <div class="form-group mb-2">
        <label>Bulan Dibayar</label>
        <select name="bulan_dibayar" class="form-control" required>
            <option value="">Pilih Bulan Dibayar</option>
            <?php 
            $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            foreach($bulan as $b){
                echo "<option value='$b'>$b</option>";
            }
            ?>
        </select>
    </div>
    
    <div class="form-group mb-2">
        <label>Tahun Bayar</label>
        <select name="tahun_dibayar" class="form-control" required>
            <option value="">Pilih Tahun</option>
            <?php 
            for($i = 2010; $i <= date('Y'); $i++){
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
    </div>
    
    <div class="form-group mb-2">
        <label>Jumlah Bayar (Jumlah yang harus dibayar adalah <b><?= "Rp. " . number_format($kekurangan, 2, ',', '.') ?></b>)</label>
        <input type="number" name="jumlah_bayar" max="<?= $kekurangan ?>" class="form-control" required>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        <button type="reset" class="btn btn-warning">Kosongkan</button>
    </div>
</form>

<?php 
if(isset($_POST['submit'])){
    // Ambil data dari POST
    $id_petugas     = $_POST['id_petugas'];
    $nisn           = $_POST['nisn'];
    $tgl_bayar      = $_POST['tgl_bayar'];
    $bulan_dibayar  = $_POST['bulan_dibayar'];
    $tahun_dibayar  = $_POST['tahun_dibayar'];
    $id_spp         = $_POST['id_spp'];
    $jumlah_bayar   = $_POST['jumlah_bayar'];

    // Simpan ke database
    $sql = mysqli_query($koneksi, "INSERT INTO pembayaran 
        (id_petugas, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar) 
        VALUES ('$id_petugas', '$nisn', '$tgl_bayar', '$bulan_dibayar', '$tahun_dibayar', '$id_spp', '$jumlah_bayar')");

    if($sql){
        echo "<script>
        alert('Data berhasil ditambahkan!');
        window.location.assign('?url=pembayaran');
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        </script>";
    }
}
?>
