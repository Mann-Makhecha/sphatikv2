const sidebar = document.querySelector(".sidebar");
const mobileButton = document.querySelector(".mobile-button");

const compProBtn = document.querySelector(".compProfile");
const accSett = document.querySelector(".accountSett");
const addCourBtn = document.querySelector(".addCour");
const formCon = document.querySelector(".form-container");
const proCon = document.querySelector(".profile-container");

document.addEventListener("DOMContentLoaded", init);
function init() {
  mobileButton.addEventListener("click", () => {
    sidebar.classList.toggle("s-active");
    mobileButton.classList.toggle("m-active");
  });
  try {
    compProBtn.addEventListener("click", showCom);
    accSett.addEventListener("click", showACC);
  } catch (error) {
    return;
  }
}

function showCom() {
  formCon.classList.toggle("hide");
  proCon.classList.toggle("hide");
}

function showACC() {
  formCon.classList.toggle("hide");
  proCon.classList.toggle("hide");
}
