// Tambahkan kode berikut untuk mengaktifkan dropdown saat foto profil diklik
const profileButton = document.querySelector('.profile-button');
const profile = document.querySelector('.profile');

profileButton.addEventListener('click', () => {
    profile.classList.toggle('active');

});

const dashButton = document.querySelector('.dash-button');
const dash = document.querySelector('.dash_container');

dashButton.addEventListener('click', () => {
    dash.classList.toggle('active');
});


// Event listener untuk menutup dropdown ketika mengklik di luar elemen profil
document.addEventListener('click', (event) => {
    const targetElement = event.target;
    // Periksa apakah elemen yang diklik berada di luar elemen profil
    if (!profile.contains(targetElement)) {
        profile.classList.remove('active');
    }
    
    if(!dash.contains(targetElement)) {
        dash.classList.remove('active');
    }

});