<aside class="sidebar">
    <div class="widget">
        <h3>Menu Navigasi</h3>
        <ul class="sidebar-menu">
            <li><a href="/lab11_php_oop/home/index">🏠 Beranda</a></li>
            
            <?php if (isset($_SESSION['is_login'])): ?>
                <li><a href="/lab11_php_oop/artikel/index">📄 Data Artikel</a></li>
                <li><a href="/lab11_php_oop/artikel/tambah">➕ Tambah Artikel</a></li>
                <li><a href="/lab11_php_oop/user/profile">👤 Profil Saya</a></li>
                <li><a href="/lab11_php_oop/user/logout" style="color: red;">🚪 Logout</a></li>
            
            <?php else: ?>
                <li><a href="/lab11_php_oop/user/login">🔐 Login Admin</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="widget">
        <?php if (isset($_SESSION['is_login'])): ?>
            <h3>Halo, <?= $_SESSION['nama']; ?>!</h3>
            <p>Selamat datang kembali di panel admin.</p>
        <?php else: ?>
            <h3>Info Praktikum</h3>
            <p>Website ini disusun menggunakan konsep <b>PHP OOP</b> dan <b>Modular Routing</b>.</p>
        <?php endif; ?>
        
        <p style="font-size:12px; margin-top:10px; color:#aaa;">&copy; 2025 Lab 11 Web</p>
    </div>
</aside>