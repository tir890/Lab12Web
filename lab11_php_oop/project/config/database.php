<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "latihan_oop";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn == false) {
    die("Koneksi ke server gagal.");
}
?>