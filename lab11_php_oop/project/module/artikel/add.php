<?php
// Proses simpan data
if (isset($_POST['submit'])) { // Pastikan name tombol submit di form adalah 'submit'
    
    // Logika upload file tetap sama (atau bisa dibuatkan class sendiri jika mau advanced)
    $filename = null;
    $file_gambar = $_FILES['file_gambar'];
    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        move_uploaded_file($file_gambar['tmp_name'], 'assets/img/' . $filename);
    }

    // Persiapkan data untuk insert class Database
    $data = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga_jual' => $_POST['harga_jual'],
        'harga_beli' => $_POST['harga_beli'],
        'stok' => $_POST['stok'],
        'gambar' => $filename
    ];

    // Panggil method insert
    $insert = $db->insert('data_barang', $data);

    if ($insert) {
        header('location: index.php?page=user/list');
        exit;
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>

<h2>Tambah Barang</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="input">
        <label>Nama Barang</label>
        <input type="text" name="nama" required />
    </div>
    <div class="input">
        <label>Kategori</label>
        <select name="kategori">
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
        </select>
    </div>
    <div class="input">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" required />
    </div>
    <div class="input">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" required />
    </div>
    <div class="input">
        <label>Stok</label>
        <input type="number" name="stok" required />
    </div>
    <div class="input">
        <label>File Gambar</label>
        <input type="file" name="file_gambar" />
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Simpan" />
    </div>
</form>