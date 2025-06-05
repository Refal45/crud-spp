<?php
// Cek apakah id_petugas dikirim lewat URL (GET)
if (!isset($_GET['id_petugas'])) {
    echo "<script>
        alert('ID Petugas tidak ditemukan!');
        window.location.href='?url=petugas';
    </script>";
    exit;
}

$id_petugas = $_GET['id_petugas'];

include "../koneksi.php";

// Ambil data petugas dari database
$sql = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'");
$data = mysqli_fetch_array($sql);

// Jika data tidak ditemukan
if (!$data) {
    echo "<script>
        alert('Data petugas tidak ditemukan!');
        window.location.href='?url=petugas';
    </script>";
    exit;
}
?>

<h5>Halaman Edit Data Petugas</h5>
<a href="?url=petugas" class="btn btn-primary">Kembali</a>
<hr>

<form method="post" action="?url=edit-petugas&id_petugas=<?= $id_petugas; ?>">
    <div class="form-group mb-2">
        <label>ID Petugas</label>
        <input value="<?= $data['id_petugas'] ?>" type="text" name="id_petugas" class="form-control" readonly>
    </div>
    <div class="form-group mb-2">
        <label>Username</label>
        <input value="<?= $data['username'] ?>" type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>Password</label>
        <input value="<?= $data['password'] ?>" type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>Nama Petugas</label>
        <input value="<?= $data['nama_petugas'] ?>" type="text" name="nama_petugas" class="form-control" required>
    </div>
    <div class="form-group mb-2">
        <label>Level</label>
        <select name="level" class="form-control" required>
            <option value="admin" <?= $data['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="petugas" <?= $data['level'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
        <button type="reset" class="btn btn-warning">Kosongkan</button>
    </div>
</form>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama_petugas = $_POST['nama_petugas'];
    $level = $_POST['level'];

    $update = mysqli_query($koneksi, "UPDATE petugas SET 
        username = '$username',
        password = '$password',
        nama_petugas = '$nama_petugas',
        level = '$level'
        WHERE id_petugas = '$id_petugas'");

    if ($update) {
        echo "<script>
            alert('Data berhasil diubah!');
            window.location.href='?url=petugas';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah!');
        </script>";
    }
}
?>
