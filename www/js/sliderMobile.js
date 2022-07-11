// slider des concerts à l'affiche sur la page d'accueil en version mobile

let highlight;
let highlights;
let nextHighlight;
let previousHighlight;
let nb;

// on récupère tous les éléments à faire slider
highlight = document.getElementsByClassName("parent");

highlights = highlight.length;
nb = 0;

function nextSlid()
{
    // quand on clique sur suivant, on enlève la classe active sur le premier élément de la liste
    highlight[nb].classList.remove("activeHighlight");

    // si nb est moins élevé que le nombre d'éléments, on incrémente nb et on ajoute la classe active sur l'élement suivant
    if(nb < highlights -1)
    {
        nb++;
        highlight[nb].classList.add("activeHighlight");
    }
    // sinon, on réinitialise nb à 0 et on ajoute la classe active au premier élément de la liste
    else
    {
        nb = 0;
        highlight[nb].classList.add("activeHighlight");
    }
}

function previousSlid()
{
    // quand on clique sur précédent, on enlève la classe active sur le premier élément de la liste
    highlight[nb].classList.remove("activeHighlight");

    // si nb est supérieur à 0, on décrémente nb et on ajoute la classe active sur l'élément précédent
    if(nb > 0)
    {
        nb--;
        highlight[nb].classList.add("activeHighlight");
    }
    // sinon on donne à nb le nombre d'éléments à slider (le tableau -1 car le premier est à la position 0), et on ajoute la classe active sur l'élément correspondant 
    else
    {
        nb = highlights - 1;
        highlight[nb].classList.add("activeHighlight");
    }
}

document.addEventListener("DOMContentLoaded", function(){
    // au chargement de la page, on donne la classe active au premier élément de la liste à slider
    highlight[nb].classList.add("activeHighlight");

    // les éléments suivant et précédent
    nextHighlight = document.getElementById("nextHighlight");
    previousHighlight = document.getElementById("previousHighlight");

    // action à faire au click sur les deux éléments
    nextHighlight.addEventListener("click", nextSlid);
    previousHighlight.addEventListener("click", previousSlid);
});