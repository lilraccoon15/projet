// montrer les prix dans la page réserver ma place de chaque concert

let div;
let button;

// bouton correspondant au tarif
button = document.getElementsByClassName("toggle");

// div permettant de choisir le nombre de places à ajouter au panier
div = document.getElementsByClassName("priceForm");

for(let i = 0; i < button.length; i++)
{
    // on cache les div de chaque tarif
    div[i].classList.add("hidden");

    // lorsqu'on clique sur un des boutons
    button[i].addEventListener("click", function(){
        for(let j = 0; j < div.length; j++ )
        {
            // on cache les div qui ne lui correspondent pas
            div[j].classList.remove("show");
            div[j].classList.add("hidden");
        }
        // on affiche la div qui lui correspond
        div[i].classList.toggle("show");
    });
}

