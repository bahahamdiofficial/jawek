let tableActions = document.querySelectorAll(".table-actions");
tableActions.forEach((tableAction) => {
  let dropDown = tableAction.querySelector(".drop-down");
  let expandIcon = tableAction.querySelector(".expand");
  tableAction.addEventListener("click", () => {
    dropDown.classList.toggle("dropped");
    expandIcon.classList.toggle("turn");
  });
});
