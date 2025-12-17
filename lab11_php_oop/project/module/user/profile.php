<?php
// Cek apakah user sudah login
if (!isset($_SESSION['is_login'])) {
    header('Location: ../user/login');
    exit;
}

// Ambil data user dari database berdasarkan session username
$db = new Database();
$username = $_SESSION['username'];

// Ambil data user terbaru
$sql = "SELECT * FROM users WHERE username = '{$username}'";
$result = $db->query($sql);
$data = $result->fetch_assoc();

$message = "";

// LOGIKA GANTI PASSWORD
if (isset($_POST['submit'])) {
    $password_baru = $_POST['password_baru'];
    
    // Validasi sederhana
    if (!empty($password_baru)) {
        // Enkripsi Password Baru
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
        
        // Update ke Database
        $update_sql = "UPDATE users SET password = '{$password_hash}' WHERE username = '{$username}'";
        $update = $db->query($update_sql);
        
        if ($update) {
            $message = "<div style='color:green; margin-bottom:10px;'>Password berhasil diubah!</div>";
        } else {
            $message = "<div style='color:red; margin-bottom:10px;'>Gagal mengubah password.</div>";
        }
    } else {
        $message = "<div style='color:red; margin-bottom:10px;'>Password tidak boleh kosong.</div>";
    }
}
?>

<div class="container" style="max-width: 500px; margin: 30px auto;">
    <h2>Profil Pengguna</h2>
    
    <?= $message; ?>

    <form method="post" action="">
        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold;">Nama Lengkap</label>
            <input type="text" value="<?= $data['nama']; ?>" readonly 
                   style="width:100%; padding:8px; background-color:#eee; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold;">Username</label>
            <input type="text" value="<?= $data['username']; ?>" readonly 
                   style="width:100%; padding:8px; background-color:#eee; border:1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold;">Ganti Password Baru</label>
            <input type="password" name="password_baru" placeholder="Masukkan password baru..." required
                   style="width:100%; padding:8px; border:1px solid #ccc;">
            <small style="color:#666;">Biarkan kosong jika tidak ingin mengganti password.</small>
        </div>

        <button type="submit" name="submit" 
                style="padding:10px 20px; background-color:#007bff; color:white; border:none; cursor:pointer;">
            Simpan Perubahan
        </button>
    </form>
</div>