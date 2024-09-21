let locationOptions = document.querySelector("#location");
let city = document.querySelector("#city");

locationOptions.addEventListener("change", (e) => {
  let optionSelected = e.target.value;

  getCityData(optionSelected);
});

function getCityData(id) {
  console.log(id);
  let xhr = new XMLHttpRequest();

  let formData = new FormData();

  formData.append("loc_id", id);
  formData.append("fetch_city", "");

  xhr.open("POST", "./ajax/products.php", true);

  xhr.onload = function () {
    if (this.status == 200 && this.readyState == 4) {
      console.log(xhr);
      if (JSON.parse(this.responseText) != false) {
        city.innerHTML = "";
        JSON.parse(this.responseText).forEach((subcat) => {
          city.appendChild(
            elementFromHtml(`
                      <option value="${subcat.id}">${subcat.name}</option>
                `)
          );
        });
      } else {
        city.innerHTML = "";
        city.appendChild(
          elementFromHtml(`
                      <option selected  value="">0  villes disponibles</option>
                `)
        );
      }
    }
  };

  xhr.send(formData);
}

let category = document.querySelector("#category");
let subcategory = document.querySelector("#subcategory");

category.addEventListener("change", (e) => {
  let optionSelected = e.target.value;

  getSubCategoryData(optionSelected);
});

function getSubCategoryData(id) {
  let xhr = new XMLHttpRequest();

  let formData = new FormData();

  formData.append("id", id);
  formData.append("fetch_subcategories", "");

  xhr.open("POST", "./ajax/products.php", true);

  xhr.onload = function () {
    if (this.status == 200 && this.readyState == 4) {
      console.log(xhr);
      if (JSON.parse(this.responseText) != false) {
        subcategory.innerHTML = "";
        JSON.parse(this.responseText).forEach((subcat) => {
          subcategory.appendChild(
            elementFromHtml(`
                      <option value="${subcat.id}">${subcat.name}</option>
                `)
          );
        });
      } else {
        subcategory.innerHTML = "";
        subcategory.appendChild(
          elementFromHtml(`
                      <option selected  value="">0  sous-catégories disponibles</option>
                `)
        );
      }
    }
  };

  xhr.send(formData);
}

let isNumberChecked = document.querySelector("#is-number-checked");
let altPhone = document.querySelector("#alt-phone");

isNumberChecked.addEventListener("change", (e) => {
  if (isNumberChecked.checked == false) {
    altPhone.classList.add("show");
  } else if (isNumberChecked.checked == true) {
    altPhone.classList.remove("show");
  }
});

function elementFromHtml(html) {
  let template = document.createElement("template");

  template.innerHTML = html.trim();

  return template.content.firstElementChild;
}
