// système de tri dans la billetterie

let buttons;
let body;
let background;
let date;
let artist;
let cat;
let artists;
let category;
let form;
let sorting;
let closing;
let sortByArtist;
let sortByCat;
let sortByDate;
let sortByPrice;
let x;

function showButtons()
{
    // quand on clique sur montrer les boutons, on ajoute la classe showFilters pour afficher les boutons
    buttons.classList.add("showFilters");
    // on désactive le scroll
    body.classList.add("disableScroll");
    // on ajoute un background foncé sur le reste de la page
    background.classList.add("showDarkBackground");
}

function hideButtons()
{
    // quand on clique sur cacher les boutons, on cache les filtres (si ils étaient affichés)
    buttons.classList.add("hideFilters");
    // on cache les boutons
    buttons.classList.remove("showFilters");
    // on réactive le scroll
    body.classList.remove("disableScroll");
    // on retire le background foncé
    background.classList.remove("showDarkBackground");
}

function showSortingByDate()
{
    // quand on clique sur trier par date, on affiche le filtre date et on cache les autres
    date.classList.toggle("show");
    price.classList.remove("show");
    artist.classList.remove("show");
    cat.classList.remove("show");
}

function showSortingByPrice()
{
    // quand on clique sur trier par prix, on affiche le filtre prix et on cache les autres
    price.classList.toggle("show");
    date.classList.remove("show");
    artist.classList.remove("show");
    cat.classList.remove("show");
}

function showSortingByArtist()
{
    // quand on clique sur trier par artiste, on affiche le filtre artiste et on cache les autres
    artist.classList.toggle("show");
    date.classList.remove("show");
    price.classList.remove("show");
    cat.classList.remove("show");
}

function showSortingByCat()
{
    // quand on clique sur trier par categorie, on affiche le filtre categorie et on cache les autres
    cat.classList.toggle("show");
    date.classList.remove("show");
    price.classList.remove("show");
    artist.classList.remove("show");
}

function callAjax()
{  
    // console.log("test changement");
    // si le bouton prix croissant est coché
    if($("#priceUp").is(":checked"))
    {
            $.getJSON(("index.php"), ("action=showBy&price="+$('#priceUp').val()), showEvents);
    }
    // si le bouton prix décroissant est coché
    else if($("#priceDown").is(":checked"))
    {
            $.getJSON(("index.php"), ("action=showBy&price="+$('#priceDown').val()), showEvents);
    }
    // si le bouton date croissante est coché
    else if($("#dateUp").is(":checked"))
    {
            $.getJSON(("index.php"), ("action=showBy&date="+$('#dateUp').val()), showEvents);
    }
    // si le bouton date décroissante est coché
    else if($("#dateDown").is(":checked"))
    {
            $.getJSON(("index.php"), ("action=showBy&date="+$('#dateDown').val()), showEvents);
    }

    artists = $(".radioArtist");
    category = $(".radioCategory");

    for (let i = 0; i < artists.length; i++)
    {
        // si on clique sur un artiste
        if($(artists[i]).is(":checked"))
        {
            // console.log("test");
            $.getJSON(("index.php"), ("action=showBy&artist="+$(artists[i]).val()), showEvents);
        }
    }
    for (let j = 0; j < category.length; j++)
    {
        // si on clique sur une catégorie
        if($(category[j]).is(":checked"))
        {
            $.getJSON(("index.php"), ("action=showBy&cat="+$(category[j]).val()), showEvents);
        }
    }
}

function showEvents(events)
{
    // console.log(events);
    $("#list").empty();
    events.forEach(element => {
        // console.log(element);
        $("#list").append("<div class='parent'><a href='index.php?action=event&id="+element[0]+"'><img src='www/images/posters/"+element[6]+"' class='poster' alt='"+element[1]+"'><div class='posterArtist infoPoster'>"+element[1]+"</div><div class='posterDay infoPoster'>"+element[5]+"</div><div class='posterMonth infoPoster'>"+element[4]+"</div><div class='posterYear infoPoster'>"+element[3]+"</div><div class='posterName infoPoster'>"+element[8]+"</div><div class='posterCat infoPoster'>"+element[9]+"</div></a></div>");
    });
}

document.addEventListener("DOMContentLoaded", function(){
    // le formulaire
    form = document.getElementById("sortingForm");
    // le bouton trier
    sorting = document.getElementById("sort");
    // le bouton fermer les tris
    closing = document.getElementById("closeButtons");
    // la zone de boutons
    buttons = document.getElementById("buttons");
    // les boutons de tri
    sortByDate = document.getElementById("sortByDate");
    sortByPrice = document.getElementById("sortByPrice");
    sortByArtist = document.getElementById("sortByArtist");
    sortByCat = document.getElementById("sortByCat");
    // les filtres concernés par les boutons de tri
    date = document.getElementById("date");
    price = document.getElementById("price");
    artist = document.getElementById("artist");
    cat = document.getElementById("cat");
    // bloquer le scroll
    body = document.body;
    x = window.matchMedia("(min-width: 780px)");
    // fond foncé
    background = document.getElementById("darkBackground");

    if(sorting)
    {
    // montrer les boutons quand je clique sur trier
    sorting.addEventListener("click", showButtons);
    }

    if(closing)
    {
    // cacher les boutons de tri
    closing.addEventListener("click", hideButtons);
    }

    if(background)
    {
        background.addEventListener("click", hideButtons);
    }

    // montrer les tris possibles quand je choisi comment trier
    if(sortByDate)
    {
        sortByDate.addEventListener("click", showSortingByDate);
    }
    if(sortByPrice)
    {
        sortByPrice.addEventListener("click", showSortingByPrice);
    }
    if(sortByArtist)
    {
        sortByArtist.addEventListener("click", showSortingByArtist);
    }
    if(sortByCat)
    {
        sortByCat.addEventListener("click", showSortingByCat);
    }

    // appel ajax à chaque changement de radio dans formulaire
    form.addEventListener("change", callAjax);
});