function toggleProfileMenu() {
    // Mengambil elemen menu berdasarkan ID-nya
    const menu = document.getElementById('profile-menu');
    
    // Menambah atau menghapus kelas 'hidden'
    menu.classList.toggle('hidden');
}

// Opsional: Menutup menu jika pengguna mengklik di luar area menu
document.addEventListener('click', function(event) {
    const profileContainer = document.querySelector('.profile-container');
    const isClickInside = profileContainer.contains(event.target);

    if (!isClickInside) {
        document.getElementById('profile-menu').classList.add('hidden');
    }
});