<?php
$id = $_GET['id'];

// Panggil method delete
// Perhatikan format filter sesuai class: "WHERE id_barang = ..."
$delete = $db->delete('data_barang', "WHERE id_barang = '$id'");

if ($delete) {
    header('location: index.php?page=user/list');
} else {
    echo "Gagal menghapus data.";
}
?>