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
const nav = document.getElementById("nav");
const totop = document.getElementById("to-top");
let sticky = header.offsetTop;

function MobileHeader() {
    if (window.pageYOffset > sticky) {
        nav.classList.add("mobile-head");
        totop.classList.add("to-top");
    } else {
        nav.classList.remove("mobile-head");
        totop.classList.remove("to-top");
    }
}