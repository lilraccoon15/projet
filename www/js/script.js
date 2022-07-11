// dans ma partie admin, sur la page modification d'un évènement, possibilité d'afficher un champs pour ajouter une image de slider au click sur le checkbox

let addSlider;
let bannSlider;

function showAdd()
{
    // console.log("test");
    bannSlider.classList.toggle("show");
}

document.addEventListener("DOMContentLoaded", function(){
    addSlider = document.getElementById("checkboxSlider");
    bannSlider = document.getElementById("bannSlider");

    addSlider.addEventListener("click", showAdd);
});