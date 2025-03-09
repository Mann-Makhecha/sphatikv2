const mobileMenu = document.querySelector(".mobile-menu-btn");
const navLinks = document.querySelector(".nav");

mobileMenu.addEventListener("click", (e) => {
  console.log("clicked", e);
  navLinks.classList.toggle("active");
  console.log(navLinks);
});
