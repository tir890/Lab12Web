<?php
// FILE: module/user/login.php

// Cek session, kalau sudah login lempar ke admin
if (isset($_SESSION['is_login'])) {
    header('Location: /lab11_php_oop/artikel/index');
    exit;
}

$message = "";

if ($_POST) {
    $db = new Database();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cari user
    $sql = "SELECT * FROM users WHERE username = '{$username}' LIMIT 1";
    $result = $db->query($sql);

    // Cek user ada atau tidak
    if ($result && $result->num_rows > 0) {
        $data = $result->fetch_assoc();
        
        // Cek password hash
        if (password_verify($password, $data['password'])) {
            // Login Berhasil
            $_SESSION['is_login'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama']     = $data['nama'];
            
            // Redirect ke halaman artikel
            header('Location: /lab11_php_oop/artikel/index');
            exit;
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>
    <link rel="stylesheet" href="/lab11_php_oop/assets/css/style.css">
</head>
<body style="background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div class="login-box">
        <h2 style="text-align: center; color: #10b981;">🔐 Login User</h2>
        <hr>
        
        <?php if ($message): ?>
            <div class="alert-error" style="background: #fee2e2; color: #b91c1c; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="custom-form">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Masukkan username..." style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px;">
            
            <label>Password</label>
            <input type="password" name="password" required placeholder="Masukkan password..." style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px;">
            
            <button type="submit" class="btn-submit" style="width: 100%; padding: 10px; background: #10b981; color: white; border: none; border-radius: 5px; cursor: pointer;">Masuk</button>
        </form>

        <p style="text-align: center; margin-top: 20px; font-size: 14px;">
            <a href="/lab11_php_oop/home/index" style="color: #666; text-decoration: none;">Kembali ke Beranda</a>
        </p>
    </div>

</body>
</html>