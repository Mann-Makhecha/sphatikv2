document.addEventListener("DOMContentLoaded", () => {
  const loader = document.getElementById("loader");

  anime({
    targets: ".letter",
    opacity: [0, 1],
    translateY: [-50, 0],
    scale: [0.5, 1],
    rotateZ: [-30, 0],
    duration: 200,
    delay: anime.stagger(30),
    easing: "easeOutElastic(1, .5)",
    complete: () => {
      setTimeout(() => {
        anime({
          targets: "#loader",
          opacity: 0,
          duration: 800,
          easing: "easeOutQuad",
          complete: () => {
            loader.style.display = "none";
          },
        });
      }, 300);
    },
  });
});
