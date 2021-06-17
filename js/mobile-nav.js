let menuOpened = false;

function MenuToggle() {
    menuOpened = !menuOpened;
    const menuToggle = document.getElementById("menu-toggle");
    const menu = document.getElementById("menu");
    
    if (menuOpened) {
        menuToggle.innerHTML = "close";
        menu.classList.add("menu-opened");
    } else {
        menuToggle.innerHTML = "menu";
        menu.classList.remove("menu-opened");
    }
}


// Navbar
window.onscroll = function () {MobileHeader()};
const header = document.getElementById("header");
let sticky = header.offsetTop;

function MobileHeader() {
    if (window.pageYOffset > sticky) {
        header.classList.add("mobile-head");
    } else {
        header.classList.remove("mobile-head");
    }
}