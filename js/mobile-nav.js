let menuOpened = false;
const menuToggle = document.getElementById("menu-toggle");
const menu = document.getElementById("menu");
const menuLinks = menu.getElementsByTagName("a");

function MenuToggle() {
    menuOpened = !menuOpened;
    if (menuOpened) {
        MenuOpen();
    } else {
        MenuClose();
    }
}

function MenuOpen() {
    menuToggle.innerHTML = "close";
    menu.classList.add("menu-opened");
    for (let i = 0; i < menuLinks.length; i++) {
        menuLinks[i].addEventListener("click", function() { MenuClose(); menuOpened = false; });
    }
}

function MenuClose() {
    menuToggle.innerHTML = "menu";
    menu.classList.remove("menu-opened");
    for (let i = 0; i < menuLinks.length; i++) {
        menuLinks[i].removeEventListener("click", function() { MenuClose(); menuOpened = false; });
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