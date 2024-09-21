let burger = document.querySelector(".burger");

let sideNav = document.querySelector(".sidenav");
let mainContent = document.querySelector(".main-content-container");

burger.addEventListener("click", closeSideNav);

function closeSideNav() {
  sideNav.classList.toggle("close");
  mainContent.classList.toggle("expand");
}

const dropToggle = document.querySelectorAll(".list-item.drop-btn");

dropToggle.forEach((toggleBtn) => {
  let link = toggleBtn.querySelector(".link");
  link.addEventListener("click", (e) => {
    e.preventDefault();
    let dropDown = toggleBtn.querySelector("ul.drop-down");
    let expandIcon = toggleBtn.querySelector(".expand");
    expandIcon.classList.toggle("turn");
    dropDown.classList.toggle("dropped");
    link.classList.toggle("dropped");
  });
});

// USER PROFILE TOGGLE
let userProfile = document.querySelector(".user-profile");
let arrow = userProfile.querySelector(".expand");
let userProfileDropDown = userProfile.querySelector(".drop-down");

userProfile.addEventListener("click", () => {
  userProfileDropDown.classList.toggle("dropped");
  arrow.classList.toggle("turn");
});

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

if (urlParams.get("error") != "" && urlParams.get("error") != null) {
  Notiflix.Notify.failure(urlParams.get("error"));
}
if (urlParams.get("success") != "" && urlParams.get("success") != null) {
  Notiflix.Notify.success(urlParams.get("success"));
}
