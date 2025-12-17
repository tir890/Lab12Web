<?php
// Pakai koneksi manual biar kita yakin tidak ada salah di Class Database
include "config.php";

$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['db_name']);

if ($conn->connect_error) {
    die("❌ Koneksi Database Gagal: " . $conn->connect_error);
}

echo "<h3>🕵️‍♂️ Debugging Login User: admin</h3>";

// 1. Cek User Ada atau Tidak
$username_input = 'admin';
$password_input = 'admin123';

$sql = "SELECT * FROM users WHERE username = '$username_input'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo "✅ User 'admin' DITEMUKAN di database.<br><hr>";
    
    echo "<b>Data di Database:</b><br>";
    echo "ID: " . $data['id'] . "<br>";
    echo "Username: " . $data['username'] . "<br>";
    echo "Password Hash (Tersimpan): <br><code style='background:#eee;padding:5px;display:block;'>" . $data['password'] . "</code><br>";
    
    // 2. Cek Validasi Password
    echo "<hr><b>Testing Password:</b><br>";
    echo "Input Password: <b>$password_input</b><br>";
    
    $is_valid = password_verify($password_input, $data['password']);
    
    if ($is_valid) {
        echo "<h2 style='color:green;'>✅ PASSWORD COCOK!</h2>";
        echo "Artinya: Database sudah benar. Masalahmu mungkin ada di session atau file login.php";
    } else {
        echo "<h2 style='color:red;'>❌ PASSWORD TIDAK COCOK!</h2>";
        echo "Artinya: Hash di database SALAH/RUSAK. Reset password belum berhasil.";
        
        // AUTO FIX JIKA SALAH
        echo "<hr><h3>🛠️ Mencoba Memperbaiki Otomatis...</h3>";
        $new_hash = password_hash($password_input, PASSWORD_DEFAULT);
        $update = $conn->query("UPDATE users SET password = '$new_hash' WHERE username = 'admin'");
        if ($update) {
            echo "✅ Database berhasil diupdate paksa! <br>";
            echo "Hash Baru: $new_hash <br>";
            echo "<b>SILAKAN COBA LOGIN SEKARANG!</b>";
        } else {
            echo "❌ Gagal update database: " . $conn->error;
        }
    }

} else {
    echo "<h2 style='color:red;'>❌ User 'admin' TIDAK DITEMUKAN!</h2>";
    echo "Cek phpMyAdmin, apakah username-nya benar-benar 'admin'?";
}
?>