<?php
// 1. NYALAKAN SESSION & ERROR REPORTING
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Config & Helpers
include "config.php";
include "class/database.php";
include "class/form.php";

// 2. ROUTING LOGIC
$request = isset($_GET['path']) ? $_GET['path'] : 'home/index';
$parts = explode('/', rtrim($request, '/'));

$modul = isset($parts[0]) ? $parts[0] : 'home';
$act   = isset($parts[1]) ? $parts[1] : 'index';

// 3. CEK LOGIN (GATEKEEPER)
// Halaman yang boleh diakses tanpa login
$public_pages = ['home', 'user']; 

// Jika modul yang diakses BUKAN public page, dan belum ada session login
if (!in_array($modul, $public_pages)) {
    if (!isset($_SESSION['is_login'])) {
        header('Location: /lab11_php_oop/user/login');
        exit();
    }
}

// Path File Module
$pageFile = "module/{$modul}/{$act}.php";

// 4. RENDER TEMPLATE
// Khusus halaman login, jangan tampilkan Header & Sidebar & Footer biar bersih
if ($modul == 'user' && $act == 'login') {
    
    if (file_exists($pageFile)) {
        include $pageFile;
    } else {
        echo "<h3>File Login tidak ditemukan!</h3>";
    }

} else {
    // Tampilan Normal (Header + Sidebar + Content)
    include "template/header.php";
    ?>
    
    <div class="main-wrapper">
        <div class="main-content">
            <?php
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                echo "<div class='alert-error'>404 Not Found: Modul $pageFile tidak ditemukan.</div>";
            }
            ?>
        </div>
        
        <?php include "template/sidebar.php"; ?>
    </div>

    <?php
    include "template/footer.php";
}
?>