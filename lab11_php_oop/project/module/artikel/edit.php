<?php
$id = $_GET['id'];

// Mengambil data barang berdasarkan ID menggunakan Class Database
// Logika di class: SELECT * FROM data_barang WHERE id_barang = '$id'
$data_barang = $db->get('data_barang', "id_barang = '$id'");

if (isset($_POST['submit'])) {
    // Logika upload gambar (jika ada gambar baru)
    $filename = $data_barang['gambar']; // Default gambar lama
    if ($_FILES['file_gambar']['error'] == 0) {
        $file_gambar = $_FILES['file_gambar'];
        $filename = str_replace(' ', '_', $file_gambar['name']);
        move_uploaded_file($file_gambar['tmp_name'], 'assets/img/' . $filename);
    }

    $data = [
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga_jual' => $_POST['harga_jual'],
        'harga_beli' => $_POST['harga_beli'],
        'stok' => $_POST['stok'],
        'gambar' => $filename
    ];

    // Panggil method update
    $update = $db->update('data_barang', $data, "id_barang = '$id'");

    if ($update) {
        header('location: index.php?page=user/list');
        exit;
    } else {
        echo "Gagal mengubah data.";
    }
}
?>

<h2>Ubah Barang</h2>
<form method="post" action="" enctype="multipart/form-data">
    <div class="input">
        <label>Nama Barang</label>
        <input type="text" name="nama" value="<?= $data_barang['nama'] ?>" />
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Simpan" />
    </div>
</form>