let burger = document.querySelector(".burger");
let menu = document.querySelector("header .right");

if (burger != null) {
  burger.addEventListener("click", () => {
    menu.classList.toggle("show");
  });
}

// const itemList = document.querySelector('.item-list');
// const gridViewBtn = document.getElementById('grid-active-btn');
// const detailsViewBtn = document.getElementById('details-active-btn');

// gridViewBtn.classList.add('active-btn');

// gridViewBtn.addEventListener('click', () => {
//     gridViewBtn.classList.add('active-btn');
//     detailsViewBtn.classList.remove('active-btn');
//     itemList.classList.remove('details-active');
// });

// detailsViewBtn.addEventListener('click', () => {
//     detailsViewBtn.classList.add('active-btn');
//     gridViewBtn.classList.remove("active-btn");
//     itemList.classList.add("details-active");
// });
// console.log("itemList", itemList)
// const ItemsPerPage = 20;
// for (let i = 0; i < ItemsPerPage; i++) {

//     const item = document.createElement("div")
//     item.classList.add("item")
//     item.innerHTML = `
//         <div class = "item-img">
//             <img src = "Photos/category/3bb98c43d9fa2f7a560256cdb76244f1.jpg">
//             <div class = "icon-list">
//                 <button type = "button">
//                     <i class = "fas fa-sync-alt"></i>
//                 </button>
//                 <button type = "button">
//                     <i class = "fas fa-shopping-cart"></i>
//                 </button>
//                 <button type = "button">
//                     <i class = "far fa-heart"></i>
//                 </button>
//             </div>
//         </div>
//         <div class = "item-detail">
//             <div class = "item-price">
//                 <span class = "new-price">220.000 DT</span>
//                 <span class = "old-price">275.60 DT</span>
//             </div>
//             <a href = "#" class = "item-name">Z750</a>
//             <a href = "#" class = "item-location">Bizerte</a>
//             <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore fugiat quod corporis delectus sequi laudantium molestias vero distinctio, qui numquam dolore, corrupti, enim consectetur cum?</p>
//             <button type = "button" class = "add-btn">add to cart</button>
//         </div>

//     `
//     itemList.append(item)
// }
