<?php
// 1. AKTIFKAN ERROR REPORTING (Penting biar gak blank putih)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// 2. Include Library
include "class/Database.php";
include "class/Form.php";

// 3. Buat Koneksi Database Global (PENTING: Biar list.php gak error)
$db = new Database();

// --- LOGIKA ROUTING ---
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));

$mod = isset($segments[0]) ? $segments[0] : 'home';
$page = isset($segments[1]) ? $segments[1] : 'index';

// --- CEK LOGIN ---
$public_pages = ['home', 'user']; 
if (!in_array($mod, $public_pages)) {
    if (!isset($_SESSION['is_login'])) {
        header('Location: ' . '/lab11_php_oop/project/user/login');
        exit();
    }
}

// --- LOAD MODULE ---
$file = "module/{$mod}/{$page}.php";

if (file_exists($file)) {
    // Jangan load header/footer di halaman login
    if ($mod == 'user' && $page == 'login') {
        include $file;
    } else {
        include "template/header.php";
        include $file;
        include "template/footer.php";
    }
} else {
    // Tampilkan error jika file tidak ketemu
    echo "<h3>Error: Modul tidak ditemukan!</h3>";
    echo "<p>File yang dicari: $file</p>";
}
?>