<h5>Halaman Data Siswa</h5>
<a href="?url=tambah-siswa" class="btn btn-primary mb-3">Tambah Siswa</a>
<hr>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>ID Kelas</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>ID Spp</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include "../koneksi.php";
        $sql = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nisn ASC");
        $no = 1;

        while($data = mysqli_fetch_array($sql)){
         ?>
         <tr>
            <td><?= $no ?></td>
            <td><?= htmlspecialchars($data['nisn']) ?></td>
            <td><?= htmlspecialchars($data['nis']) ?></td>
            <td><?= htmlspecialchars($data['nama']) ?></td>
            <td><?= htmlspecialchars($data['id_kelas']) ?></td>
            <td><?= htmlspecialchars($data['alamat']) ?></td>
            <td><?= htmlspecialchars($data['no_telp']) ?></td>
            <td><?= htmlspecialchars($data['id_spp']) ?></td>
         </tr>
        <?php $no++; }?>
    </tbody>
</table>
