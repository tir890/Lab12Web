# Lab12Web: Autentikasi & Session (Login System)

**Nama:** Tiara Hayatul Khoir

**NIM:** 312410474

**Kelas:** TI.24.A5

**Mata Kuliah:** Pemrograman Web

---

## 📝 Deskripsi
Project ini adalah kelanjutan dari **Lab11Web**. Pada praktikum ini, ditambahkan fitur **Autentikasi User** (Login & Logout) dan **Session Management**.

Sistem ini memastikan bahwa hanya pengguna yang sudah login (Admin) yang dapat mengakses fitur pengelolaan artikel (Tambah, Ubah, Hapus). Selain itu, terdapat fitur tambahan **Profil User** untuk mengubah password dengan keamanan enkripsi hash.

---

## 📂 Struktur Folder (Update)
Penambahan modul baru `user` di dalam struktur folder:

```text
lab11_php_oop/
├── index.php              <-- Update: Menambahkan Logic Cek Session
├── module/
│   ├── artikel/           <-- (Modul Artikel)
│   └── user/              <-- (Modul Baru: User)
│       ├── login.php      <-- Form & Proses Login
│       ├── logout.php     <-- Proses Logout (Hapus Session)
│       └── profile.php    <-- Halaman Profil & Ganti Password
└── template/
    └── sidebar.php        <-- Update: Menu Dinamis (Login/Logout)

```

---

## 🛠️ Langkah Implementasi

### 1. Persiapan Database (Tabel Users)

Membuat tabel `users` untuk menyimpan data administrator. Password disimpan dalam bentuk **Hash Encrypted** (bukan text biasa) menggunakan algoritma `bcrypt`.

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100)
);

```

### 2. Konfigurasi Routing & Session (index.php)

File `index.php` dimodifikasi untuk menyalakan `session_start()` dan berfungsi sebagai **Gatekeeper**. Jika user mencoba mengakses halaman admin tanpa login, sistem akan otomatis me-redirect ke halaman Login.

```php
// Cuplikan Logic Gatekeeper
session_start();

if (!in_array($modul, ['home', 'user'])) {
    if (!isset($_SESSION['is_login'])) {
        header('Location: /lab11_php_oop/user/login');
        exit();
    }
}

```

### 3. Fitur Login (Enkripsi Password)

Pada `module/user/login.php`, sistem tidak membandingkan password secara langsung, melainkan menggunakan fungsi `password_verify()` untuk mencocokkan inputan user dengan hash di database.

```php
if (password_verify($password, $data['password'])) {
    $_SESSION['is_login'] = true;
    // ... set session data lainnya
}

```

### 4. Menu Navigasi Dinamis (Sidebar)

File `template/sidebar.php` diupdate menggunakan logika `if(isset($_SESSION['is_login']))` untuk menampilkan menu yang berbeda antara user biasa (Tamu) dan Admin.

### 5. Fitur Profil & Ganti Password (Tugas Praktikum)

Menambahkan halaman `profile.php` dimana user bisa melihat informasi akun dan mengganti password. Password baru akan di-hash ulang menggunakan `password_hash()` sebelum disimpan ke database.

---

## 📸 Hasil Tampilan (Screenshots)

### 1. Halaman Login

Form login dengan validasi username dan password.

> ![Halaman Login](https://github.com/tir890/Lab12Web/blob/ae21f25c4dd7301ed574c6b149d89a51ef92b5df/dashboard-lab12web.png)

### 2. Halaman Dashboard Admin (Setelah Login)

Sidebar menampilkan menu lengkap (Data Artikel, Tambah Artikel, Profil, Logout) dan menyapa nama user.

> ![Dashboard Admin]([Masukkan Link Screenshot Dashboard di sini])

### 3. Menu Sidebar Dinamis

Perbedaan tampilan sidebar saat belum login vs sudah login.

> ![Sidebar Dinamis]([Masukkan Link Screenshot Sidebar di sini])

### 4. Halaman Profil & Ganti Password

Fitur untuk mengubah password admin secara aman.

> ![Halaman Profil]([Masukkan Link Screenshot Profil di sini])

---

## 🏁 Kesimpulan

Dari praktikum ini, telah dipelajari:

1. **Session:** Cara menyimpan status login pengguna antar halaman.
2. **Security:** Pentingnya tidak menyimpan password dalam bentuk *plain text*, melainkan menggunakan Hashing (`password_hash`).
3. **Access Control:** Membatasi akses ke halaman tertentu (Middleware sederhana) melalui routing.
