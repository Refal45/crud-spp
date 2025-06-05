<h5>Halaman Tambah Petugas</h5>
<a href="?url=petugas" class="btn btn-secondary">Kembali</a>
<hr>

<form action="" method="post">
    <div class="form-group mb-2">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="form-group mb-2">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group mb-2">
        <label>Nama Petugas</label>
        <input type="text" name="nama_petugas" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Level</label>
        <select name="level" class="form-control" required>
            <option value="">-- Pilih Level --</option>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>

    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
</form>

<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $nama_petugas = $_POST['nama_petugas'];
    $level        = $_POST['level'];

    $query = "INSERT INTO petugas (username, password, nama_petugas, level) 
              VALUES ('$username', '$password', '$nama_petugas', '$level')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil disimpan'); window.location='?url=petugas';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
