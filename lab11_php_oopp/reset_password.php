<?php
include "class/database.php";
$db = new Database();

// Password yang mau kamu pakai
$password_plaintext = "admin123";

// Enkripsi password (Hashing)
$password_hash = password_hash($password_plaintext, PASSWORD_DEFAULT);

// Update ke database dengan versi yang sudah di-hash
$sql = "UPDATE users SET password = '$password_hash' WHERE username = 'admin'";

if ($db->query($sql)) {
    echo "<h3>✅ BERHASIL!</h3>";
    echo "Database sudah diupdate.<br>";
    echo "Password Asli: <b>$password_plaintext</b><br>";
    echo "Password di Database (Hash): <b>$password_hash</b><br>";
    echo "<hr>Sekarang coba login lagi.";
} else {
    echo "Gagal update database.";
}
?>