<?php
// Tidak perlu include config/database lagi karena sudah dilakukan oleh index.php utama
// Langsung panggil class Database
$db = new Database();
$data = $db->query("SELECT * FROM artikel ORDER BY id DESC");
?>

<div class="content">
    <a href="/lab11_php_oop/artikel/tambah" class="btn-add">+ Tambah Artikel Baru</a>
    
    <table border="0">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Judul</th>
                <th width="45%">Isi Artikel</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            // Cek apakah data ada isinya sebelum di-looping
            if ($data && $data->num_rows > 0) :
                while ($row = $data->fetch_assoc()) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><b><?= htmlspecialchars($row['judul']); ?></b></td>
                    <td><?= substr(htmlspecialchars($row['isi']), 0, 100) . '...'; ?></td>
                    <td>
                        <a href="/lab11_php_oop/artikel/ubah?id=<?= $row['id']; ?>">Edit</a> | 
                        <a href="#" style="color:red;">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; 
            else: ?>
                <tr>
                    <td colspan="4" align="center">Belum ada data artikel.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>