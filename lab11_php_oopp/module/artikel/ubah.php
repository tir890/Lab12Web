<?php
$id = $_GET['id'];
$db = new Database();
$data = $db->get("artikel", "id=" . $id);

$form = new Form("", "Update Data");

if ($_POST) {
    $updateData = [
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi']
    ];
    if ($db->update('artikel', $updateData, "id=" . $id)) {
        header('Location: /lab11_php_oop/artikel/index');
    } else {
        echo "Gagal mengupdate data";
    }
}
?>

<h3>Ubah Data Artikel</h3>
<?php
if ($data) {
    $form->addField("judul", "Judul Artikel", "text", $data['judul']);
    $form->addField("isi", "Konten", "textarea", $data['isi']);
    $form->displayForm();
}
?>
<p><a href="/lab11_php_oop/artikel/index">Kembali</a></p>