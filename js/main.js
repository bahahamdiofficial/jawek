let tabs = document.querySelectorAll(".tabs li");
let tabsArray = Array.from(tabs);
let divs = document.querySelectorAll(".container > div");
let divsArray = Array.from(divs);


// console.log(tabsArray);


tabsArray.forEach((ele) => {
    ele.addEventListener("click", function (e) {
        // console.log(ele);
        tabsArray.forEach((ele) => {
            ele.classList.remove("active");
        });
        e.currentTarget.classList.add("active");
        divsArray.forEach((div) => {
            div.style.display = "none";
        });
        // console.log(e.currentTarget.dataset.cont);
        // document.querySelector(e.currentTarget.dataset.cont).style.display = "";
        document.querySelector(e.currentTarget.dataset.cont).style.display = "grid";

    });
});