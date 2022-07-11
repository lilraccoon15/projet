// affichage du menu mobile dans la partie administation

let menuMobile;
let navMenu;
let body;

function showMenu()
{
    // au click sur le menu Mobile, on affiche le menu, on transforme le fontawesome hamburger en crois, on désactive le scroll
    navMenu.classList.toggle("activeAdminNav");
    menuMobile.classList.toggle("fa-times");
    body.classList.toggle("disableScroll");
}

document.addEventListener("DOMContentLoaded", function(){
    menuMobile = document.getElementById("adminMenuMobile");
    navMenu = document.getElementById("adminNav");
    body = document.body;

    menuMobile.addEventListener("click", showMenu);
});