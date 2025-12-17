<?php
// Hapus semua session
session_unset();
session_destroy();

// Redirect kembali ke halaman login
header('location: index.php?page=auth/login');
exit;
?>