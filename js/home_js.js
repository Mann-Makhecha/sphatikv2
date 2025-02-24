const mobileMenu = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-list');

mobileMenu.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});