let reportSellerBtn = document.querySelector("a.report-seller");
let reportSellerPopup = document.querySelector(".popup.report-seller");

reportSellerBtn.addEventListener("click", (e) => {
  e.preventDefault();

  reportSellerPopup.classList.toggle("show");

  let cancelBtn = reportSellerPopup.querySelector(".cancel");
  let continueBtn = reportSellerPopup.querySelector(".continue");
  let closePopupBtn = reportSellerPopup.querySelector(".close-popup-btn");

  cancelBtn.addEventListener("click", (e) => {
    e.preventDefault();
    reportSellerPopup.classList.remove("show");
  });
  closePopupBtn.addEventListener("click", (e) => {
    e.preventDefault();

    reportSellerPopup.classList.remove("show");
  });

  let userId = reportSellerBtn.getAttribute("data-user-id");

  document.querySelector("input#user-id").value = userId;
});
