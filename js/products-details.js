$(".product-imgs").owlCarousel({
  loop: false,
  margin: 10,
  nav: false,
  dots: true,

  responsive: {
    900: {
      items: 4,
    },

    1500: {
      items: 5,
    },
  },
});

let carouselImages = [...document.querySelectorAll(".img")];

carouselImages.forEach((img) => {
  img.addEventListener("click", (e) => {
    changeImages(img);
  });
});

function changeImages(img) {
  let imgSource = img.querySelector("img").getAttribute("src");
  let mainImgContainer = document.querySelector(".main-img");

  mainImgContainer.innerHTML = "";

  let newImg = document.createElement("img");

  newImg.setAttribute("src", imgSource);
  // newImg.setAttribute("data-gallery", "gallery1");
  newImg.classList.add("animate-in");
  // newImg.classList.add("mklbItem");

  mainImgContainer.appendChild(newImg);
}

let confirmDeleteBtn = document.querySelector("a.confirm-delete");
let confrimDeletePopup = document.querySelector(".popup.confirm-delete");

confirmDeleteBtn.addEventListener("click", (e) => {
  e.preventDefault();

  confrimDeletePopup.classList.toggle("show");

  let cancelBtn = confrimDeletePopup.querySelector(".cancel");
  let continueBtn = confrimDeletePopup.querySelector(".continue");
  let closePopupBtn = confrimDeletePopup.querySelector(".close-popup-btn");
  let productImg = confrimDeletePopup.querySelector(".product-img img");
  let productContent = confrimDeletePopup.querySelector(".product-name");

  continueBtn.setAttribute("href", confirmDeleteBtn.getAttribute("href"));
  productImg.setAttribute(
    "src",
    `./uploaded_img/${confirmDeleteBtn.getAttribute("data-product-image")}`
  );
  productContent.innerHTML = confirmDeleteBtn.getAttribute("data-product-name");

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault();
    confrimDeletePopup.classList.remove("show");
  });
  closePopupBtn.addEventListener("click", (e) => {
    e.preventDefault();

    confrimDeletePopup.classList.remove("show");
  });
});
