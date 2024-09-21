let sideNavLinks = document.querySelectorAll(".side-nav a");
let inlineSections = document.querySelectorAll(".inline-section");

sideNavLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();

    let sectionToBeLoaded = link.getAttribute("data-section");

    let section = document.querySelector("." + sectionToBeLoaded);

    if (section != null) {
      // hide all sections except the one to be loaded

      inlineSections.forEach((thisSection) => {
        thisSection.classList.remove("active");
      });

      section.classList.add("active");
    }
  });
});
