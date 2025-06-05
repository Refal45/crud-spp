<h5>Halaman Tambah Data Siswa</h5>
<a href="?url=siswa" class="btn btn-primary">Kembali</a>
<hr>
<form method="post" action="?url=tambah-siswa">
	<div class="form-group mb-2">
		<label>NISN</label>
		<input type="number" name="nisn" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>NIS</label>
		<input type="number" name="nis" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>Kelas</label>
		<select name="id_kelas" class="form-control" required>
			<option value="">-- Pilih Kelas --</option>
			<?php
			include "../koneksi.php";
			$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
			while($row = mysqli_fetch_array($kelas)){
				echo "<option value='$row[id_kelas]'>$row[nama_kelas] - $row[kompetensi_keahlian]</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group mb-2">
		<label>Alamat</label>
		<textarea name="alamat" class="form-control" required></textarea>
	</div>
	<div class="form-group mb-2">
		<label>No Telepon</label>
		<input type="text" name="no_telp" class="form-control" required>
	</div>
	<div class="form-group mb-2">
		<label>SPP</label>
		<select name="id_spp" class="form-control" required>
			<option value="">-- Pilih SPP --</option>
			<?php
			$spp = mysqli_query($koneksi, "SELECT * FROM spp");
			while($row = mysqli_fetch_array($spp)){
				echo "<option value='$row[id_spp]'>$row[tahun] - Rp. $row[nominal]</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
		<button type="reset" class="btn btn-warning">Kosongkan</button>
	</div>
</form>

<?php 
if(isset($_POST['submit'])){
	$nisn     = $_POST['nisn'];
	$nis      = $_POST['nis'];
	$nama     = $_POST['nama'];
	$id_kelas = $_POST['id_kelas'];
	$alamat   = $_POST['alamat'];
	$no_telp  = $_POST['no_telp'];
	$id_spp   = $_POST['id_spp'];

	$sql = mysqli_query($koneksi,"INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp) 
	VALUES ('$nisn', '$nis', '$nama', '$id_kelas', '$alamat', '$no_telp', '$id_spp')");

	if($sql){
		echo "<script>
		alert('Data berhasil ditambahkan!')
		window.location.assign('?url=siswa')
		</script>";
	}else{
		echo "<script>
		alert('Data gagal ditambahkan!')
		</script>";
	}
}
?>
