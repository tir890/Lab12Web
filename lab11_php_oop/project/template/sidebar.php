<div class="col-md-4 sidebar-column">
    
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white border-bottom fw-bold text-custom">
            MENU NAVIGASI
        </div>
        <div class="list-group list-group-flush">
            <a href="../home/index" class="list-group-item list-group-item-action border-0">
                🏠 Beranda
            </a>
            <a href="../artikel/list" class="list-group-item list-group-item-action border-0">
                📦 Data Barang
            </a>
            <a href="../artikel/add" class="list-group-item list-group-item-action border-0">
                ➕ Tambah Barang
            </a>
            
            <?php if (isset($_SESSION['is_login'])): ?>
                <a href="../user/profile" class="list-group-item list-group-item-action border-0">
                    👤 Profil (<?= $_SESSION['nama'] ?>)
                </a>
                <a href="../user/logout" class="list-group-item list-group-item-action border-0 text-danger">
                    🚪 Logout
                </a>
            <?php else: ?>
                <a href="../user/login" class="list-group-item list-group-item-action border-0">
                    🔐 Login
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="card border-0 shadow-sm bg-light">
        <div class="card-body text-muted small">
            <h6 class="fw-bold text-custom">INFO PRAKTIKUM</h6>
            <p class="mb-0">
                Aplikasi ini disusun untuk memenuhi tugas <strong>Pemrograman Web 2</strong>.
            </p>
        </div>
    </div>
</div>