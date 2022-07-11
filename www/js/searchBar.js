// affichage des menus (version mobile) et barre de recherche 

let search;
let result;
let glass;
let menuMobile;
let navMenu;
let closeSearch;

function showBar()
{
    // quand je clique sur l'icone barre de recherche, on affiche le formulaire, on affiche la croix pour fermer la barre de recherche, on cache l'icone menu mobile et on désactive le scroll
    form.classList.add("activeSearch");
    closeSearch.classList.add("show");
    menuMobile.classList.add("hidden");
    body.classList.add("disableScroll");
}

function hideBar()
{
    // quand on clique sur la croix pour cacher la barre de recherche, on cache la recherche, la croix pour cacher la recherche, et on retourne au menu mobile. si le media query est supérieur à 780px on réactive le scroll
    form.classList.remove("activeSearch");
    closeSearch.classList.remove("show");
    menuMobile.classList.remove("hidden");
    if(x.matches)
    {
        body.classList.remove("disableScroll");
    } 
}

function callAjaxSearch()
{
    // result est égal à la valeur de la recherche
    result = search.value;
    // si result comporte des éléments, on lance l'ajax pour afficher les résultats 
    if(result.length > 0)
    {
        $.get("index.php", "action=searchBar&result="+result, showResults);
    }
    // sinon on laisse la partie des résultats vide
    else
    {
        $("#searchResults").empty();
    }
}

function showResults(results)
{
    // affichage des résultats de la recherche, on vide et on rerempli avec la nouvelle recherche
    $("#searchResults").empty();
    $("#searchResults").append(results);
}

function showMenu()
{
    // quand on clique sur l'icone du menu, ça lui ajoute ou enlève la classe activeNav qui montre le menu
    navMenu.classList.toggle("activeNav");
    // modifier le font awesome hamburger en croix
    menuMobile.classList.toggle("fa-times");
    // lorsque le menu est ouvert, j'empêche le scroll sur la page pour qu'il prenne toute la place
    body.classList.toggle("disableScroll");
}

function blockSubmit(event)
{
    // je veux que les résultats de la recherche soient seulement affichés en ajax. Si je ne bloque pas la touche entrée, l'utilisateur est redirigé ailleurs et cela ne me convient pas.
    let keyPressed = event.keyCode;
    if(keyPressed === 13)
    {
        event.preventDefault();
    }
}

document.addEventListener("DOMContentLoaded", function(){

    glass = document.getElementById("searchGlass");

    form = document.getElementById("searchForm");
    search = document.getElementById("search");
    closeSearch = document.getElementById("closeSearch");

    menuMobile = document.getElementById("menuMobile");
    navMenu = document.getElementById("navMenu");
    body = document.body;
    x = window.matchMedia("(min-width: 780px)");

    // click sur l'icone barre de recherche
    glass.addEventListener("click", showBar);
    // click sur l'icone fermer barre de recherche
    closeSearch.addEventListener("click", hideBar);
    // quand on écrit dans la barre de recherche
    search.addEventListener("input", callAjaxSearch);
    // click sur l'icone menu mobile
    menuMobile.addEventListener("click", showMenu);
    // bloquer la soumission du formulaire avec la touche entrée
    form.addEventListener("keypress", blockSubmit);
});