// grand slider dans la page d'accueil

let images;
let array;
let timer;
let previous;
let next;
let tourName;
let artist;
let date;
let year;
let month;
let intervalID;

images = document.getElementsByClassName("imgSlider");
date = document.getElementsByClassName("sliderDay");
month = document.getElementsByClassName("sliderMonth");
year = document.getElementsByClassName("sliderYear");
artist = document.getElementsByClassName("sliderArtist");
tourName = document.getElementsByClassName("sliderName"); 
infoButton = document.getElementsByClassName("infoSlider"); 

array = images.length;
number = 0;
timer = 0;
// console.log(images);
// console.log(images[number]);

function lancerSlider()
{
    // au lancement du slider, on donne une classe active à tous les éléments qui doivent être affichés en premier
    images[number].classList.add("active");
    date[number].classList.add("active");
    year[number].classList.add("active");
    month[number].classList.add("active");
    tourName[number].classList.add("active");
    artist[number].classList.add("active");
    infoButton[number].classList.add("active");

    // si le timer est à 0, on lance un interval avec la slide suivante et on incrémente le timer
    if(timer === 0)
    {
        intervalID = setInterval(nextSlide, 5000);
        timer++;
    }
    // si le timer n'est pas à 0, on remet l'interval à 0 ainsi que le timer
    else
    {
        clearInterval(intervalID);
        timer = 0;
    }
}

function nextSlide()
{
    // au click sur slide suivante, on enlève la classe active des éléments
    images[number].classList.remove("active");
    date[number].classList.remove("active");
    year[number].classList.remove("active");
    month[number].classList.remove("active");
    tourName[number].classList.remove("active");
    artist[number].classList.remove("active");
    infoButton[number].classList.remove("active");

    // si number est inférieur au nombre d'éléments, on incrémente number et on ajoute la classe active aux élements suivants
    if(number < array -1)
    {
        number++;
        images[number].classList.add("active");
        date[number].classList.add("active");
        month[number].classList.add("active");
        year[number].classList.add("active");
        tourName[number].classList.add("active");
        artist[number].classList.add("active");
        infoButton[number].classList.add("active");
    }
    // si number est supérieur au nombre d'éléments, on le réinitialise à 0 et on ajoute la classe active aux 1ers éléments de la liste
    else
    {
        number = 0;
        images[number].classList.add("active");
        date[number].classList.add("active");
        month[number].classList.add("active");
        year[number].classList.add("active");
        tourName[number].classList.add("active");
        artist[number].classList.add("active");
        infoButton[number].classList.add("active");
    }
}

function previousSlide()
{
    // au click sur slide précédente, on enlève la classe active des éléments
    images[number].classList.remove("active");
    date[number].classList.remove("active");
    month[number].classList.remove("active");
    year[number].classList.remove("active");
    tourName[number].classList.remove("active");
    artist[number].classList.remove("active");
    infoButton[number].classList.remove("active");

    // si number est supérieur à 0, on décrémente number et on ajoute la classe active à l'élément précédent
    if(number > 0)
    {
        number--;
        images[number].classList.add("active");
        date[number].classList.add("active");
        month[number].classList.add("active");
        year[number].classList.add("active");
        tourName[number].classList.add("active");
        artist[number].classList.add("active");
        infoButton[number].classList.add("active");
    }
    // si number est inférieur à 0, on lui donne le nombre d'éléments à slider et on ajoute la classe active à l'élément correspondant
    else
    {
        number = array - 1;
        images[number].classList.add("active");
        date[number].classList.add("active");
        month[number].classList.add("active");
        year[number].classList.add("active");
        tourName[number].classList.add("active");
        artist[number].classList.add("active");
        infoButton[number].classList.add("active");
    }
}

// éléments suivant et précédent
next = document.getElementById("next");
previous = document.getElementById("previous");

// au chargement de la page, on lance automatiquement le slider avec son intervale
document.addEventListener("DOMContentLoaded", lancerSlider);

// au click sur suivant ou précédent
next.addEventListener("click", nextSlide);
previous.addEventListener("click", previousSlide);
