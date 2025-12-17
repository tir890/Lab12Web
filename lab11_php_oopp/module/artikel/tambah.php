<?php
// Inisialisasi Form
$form = new Form("", "Simpan Data"); 

if ($_POST) {
    $db = new Database();
    
    $data = [
        'judul' => $_POST['judul'],
        'isi'   => $_POST['isi']
    ];
    
    if ($db->insert('artikel', $data)) {
        header('Location: /lab11_php_oop/artikel/index');
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<div class="content">
    <h3>Form Tambah Artikel</h3>
    
    <?php
    $form->addField("judul", "Judul Artikel");
    $form->addField("isi", "Konten Artikel", "textarea");
    $form->displayForm();
    ?>
    
    <br>
    <p><a href="/lab11_php_oop/artikel/index">← Kembali ke Daftar Artikel</a></p>
</div>