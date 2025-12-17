<?php
// Cek login
if (!isset($_SESSION['is_login'])) {
    header('Location: /lab11_php_oop/user/login');
    exit;
}

$db = new Database();
$message = "";

// Ambil data user yang sedang login
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $db->query($sql);
$data = $result->fetch_assoc();

// LOGIKA GANTI PASSWORD
if ($_POST) {
    $password_baru = $_POST['password_baru'];
    $password_konfirmasi = $_POST['password_konfirmasi'];

    if ($password_baru == $password_konfirmasi) {
        // Enkripsi password baru
        $hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        
        // Update database
        $updateSql = "UPDATE users SET password = '$hash_baru' WHERE username = '$username'";
        if ($db->query($updateSql)) {
            $message = "<div style='color:green; font-weight:bold;'>✅ Password berhasil diubah!</div>";
        } else {
            $message = "<div style='color:red;'>❌ Gagal mengubah password.</div>";
        }
    } else {
        $message = "<div style='color:red;'>❌ Konfirmasi password tidak cocok!</div>";
    }
}
?>

<div class="content">
    <h3>👤 Profil Pengguna</h3>
    
    <?php if ($message) echo $message; ?>

    <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-top: 20px;">
        <table border="0" width="100%">
            <tr>
                <td width="150px"><b>Nama Lengkap</b></td>
                <td>: <?= htmlspecialchars($data['nama']); ?></td>
            </tr>
            <tr>
                <td><b>Username</b></td>
                <td>: <?= htmlspecialchars($data['username']); ?></td>
            </tr>
        </table>
    </div>

    <br>

    <div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h4>🔐 Ganti Password</h4>
        <form method="POST" action="" class="custom-form">
            <label>Password Baru</label>
            <input type="password" name="password_baru" required placeholder="Masukkan password baru..." style="width: 100%; margin-bottom: 10px; padding: 8px;">
            
            <label>Konfirmasi Password</label>
            <input type="password" name="password_konfirmasi" required placeholder="Ulangi password baru..." style="width: 100%; margin-bottom: 10px; padding: 8px;">
            
            <button type="submit" class="btn-submit">Simpan Password</button>
        </form>
    </div>
</div>