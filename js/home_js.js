const mobileMenu = document.querySelector(".mobile-menu-btn");
const navLinks = document.querySelector(".nav");

mobileMenu.addEventListener("click", (e) => {
  navLinks.classList.toggle("active");
});
