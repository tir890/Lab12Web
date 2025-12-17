<?php
// Ambil data
$sql = "SELECT * FROM data_barang";
$result = $db->query($sql); 
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="text-secondary">Daftar Barang</h4>
    <a href="../artikel/add" class="btn btn-primary rounded-1 px-3">
        + Tambah Data
    </a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover border shadow-sm">
        <thead class="table-primary"> <tr>
                <th class="py-3">GAMBAR</th>
                <th class="py-3">NAMA BARANG</th>
                <th class="py-3">KATEGORI</th>
                <th class="py-3">HARGA</th>
                <th class="py-3">STOK</th>
                <th class="py-3">AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php if($result): ?>
            <?php while($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td class="align-middle">
                    <?php 
            
        // Ambil nama file gambar saja (hilangkan path folder lama dari database jika ada)
        $nama_file = basename($row['gambar']);
        
        // Tentukan path gambar yang benar (Absolute Path)
        // Sesuaikan '/lab11_php_oop/project/' dengan nama folder kamu di htdocs
        $path_gambar = "/lab11_php_oop/project/assets/img/" . $nama_file;
        
        // Cek apakah nama file kosong
        if (!empty($nama_file)) {
            echo '<img src="' . $path_gambar . '" alt="Gambar" width="50" class="rounded border bg-white p-1">';
        } else {
            echo '<span class="text-muted small">No IMG</span>';
        }
    ?>
</td>
                </td>
                <td class="align-middle fw-bold"><?= $row['nama'];?></td>
                <td class="align-middle"><?= $row['kategori'];?></td>
                <td class="align-middle">Rp <?= number_format($row['harga_jual'],0,',','.');?></td>
                <td class="align-middle"><?= $row['stok'];?></td>
                <td class="align-middle">
                    <a href="../artikel/edit?id=<?= $row['id_barang'];?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <a href="../artikel/delete?id=<?= $row['id_barang'];?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data barang.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>