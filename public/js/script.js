// Navbar toggler
let navToggler = document.getElementById("nav-toggler");
let navCollapse = document.getElementById("nav-dropdown");

navToggler?.addEventListener('click', () => {
    if (navCollapse.classList.contains("toggle-collapse")) {
        navCollapse.classList.remove("toggle-collapse");
    } else {
        navCollapse.classList.add("toggle-collapse");
    }
});