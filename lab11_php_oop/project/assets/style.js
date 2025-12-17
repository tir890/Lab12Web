// Menunggu dokumen HTML selesai dimuat
document.addEventListener("DOMContentLoaded", function() {
    
    // Ambil semua elemen <a> yang memiliki teks "Hapus" atau class delete
    // Asumsi di view, link hapus kamu beri onclick atau kita tangkap href-nya
    
    const deleteLinks = document.querySelectorAll('a[href*="delete"]');

    deleteLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Tampilkan dialog konfirmasi
            const confirmDelete = confirm("Apakah Anda yakin ingin menghapus data ini?");
            
            // Jika user klik Cancel (Batal), cegah aksi default (link tidak akan jalan)
            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    });

});