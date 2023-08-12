const hamburgerMenu = document.getElementById('hamburger-menu');
const headerNav = document.getElementById('header-nav');

hamburgerMenu.addEventListener('click', () => {
    hamburgerMenu.classList.toggle('animate-bars');
    headerNav.classList.toggle('animate-header-nav');
});	