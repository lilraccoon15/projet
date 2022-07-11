// ajout au panier et gestion du panier

let basket = [];
let quantities;
let product;
let choice = [];
let price;
let final;
let id_price;

function addBasket()
{
    // récupération des valeurs des tarifs
    let quantity = $("select option:selected");
    let products = $("select");
    let id_event = $("#id_event").val();
    let event = $("#event").val();
    let poster = $("#poster").val();
    let date = $("#date").val();
    let time = $("#time").val();
    let artist_name = $("#artist").val();
    let prices = document.getElementsByName("price_event");
    let id_prices = document.getElementsByName("id_price");
    // console.log(event);
    // console.log(products);
    // console.log(quantity);
    // console.log(prices);
    for(let i = 0; i < quantity.length; i++) // boucle car les tarifs sont affichés dans un foreach
    {
        quantities = parseInt(quantity[i].value);
        price = parseInt(prices[i].value);
        product = products[i].getAttribute('name');
        id_price = parseInt(id_prices[i].value);
        // console.log(price);
        // console.log(quantities);
        // console.log(product);  
        if(quantities !== 0) // si les quantités sont autres que 0, on prend en compte les valeurs
        {
            // console.log(quantities);
            // console.log("test");
            choice.push([quantities,product,event,price, id_price, poster, artist_name, id_event, date, time]); // on crée un tableau à partir des valeurs récupérées, pour chaque tarif sélectionné
        }
    }
    // console.log(basket);
    if(basket.length < 1)
    {
        basket.push(choice); // on envoie le/les tableaux des valeurs dans un tableau global
        // console.log("test");
    }
    else
    {
        for(let a = 0; a < basket.length; a++)
        {
        // console.log(basket[a]);
            for(let b = 0, c = 0; b < basket[a].length && c < choice.length; b++, c++)
            {
                // console.log(basket[a][b][4]);
                // console.log(choice[c][4]);
                switch(basket[a][b][4])
                {
                    case choice[c][4] :
                        // console.log("égal");
                        basket[a][b][0] += choice[c][0];
                        break;
                    default :
                        // console.log("différent");
                        basket[a].push(choice[c]);
                        break;
                }
            }
        }
    }
    saveBasket(); // enregistrer le tableau global dans le local storage
    loadStorage(); // récupération du localStorage
    showBasket(); // affichage du localStorage dans le pannier
    // console.log(basket);
    window.location.href = "https://camillelefort.sites.3wa.io/projet/index.php?action=basket"; // renvoyer vers le panier après l'ajout d'un article
}

function saveBasket() // enregistrer le tableau global dans le local storage
{
    basket = JSON.stringify(basket);
    localStorage.setItem("list", basket);
    // console.log(basket);
}

function loadStorage() // récupération du localStorage
{
    basket = localStorage.getItem("list");
    if(basket != null){
        basket = JSON.parse(basket);
    }
    else {
        basket = [];
    }
}

function showBasket() // affichage du localStorage dans le panier
{   
    // console.log(choice);
    let quant = 0;
    let total = 0;
    let totalPrice = 0;
    final = 0;
    // console.log(choice.length);
    $("#basket").empty();
    $("#showTotal").empty();
    $("#numberBasket").empty();
    if(basket.length === 0)
    {
        $("#messageBasket").append("<div class='message'>Votre panier est vide</div>");
        $("#fullBasket").addClass("hidden");
        $("#basket").addClass("hidden");
        $("#basketTotal").addClass("hidden");
        $("#numberBasket").append("0");
    }
    else 
    {
        for(let i = 0; i < basket.length; i++) // on boucle le tableau global
        {
            for(let j = 0; j < basket[i].length; j++) // on boucle les tableaux dans le tableau global
            {
                quant += basket[i][j][0];
                totalPrice = basket[i][j][0]*basket[i][j][3];
                final += totalPrice;
                $("#basket").append("<div class='article clearfix'><img src='www/images/posters/"+basket[i][j][5]+"' alt='"+basket[i][j][5]+"' class='basketPoster'><div class='infoArticle'><a href='index.php?action=event&id="+basket[i][j][7]+"'><p>"+basket[i][j][6]+"</p><p>"+basket[i][j][2]+"</p></a><p>"+basket[i][j][8]+" à "+basket[i][j][9]+"</p><p>"+basket[i][j][1]+"</p><p>Quantité : "+basket[i][j][0]+"</p><p>Total : "+(totalPrice).toFixed(2)+"€ </p><button type='button' data-id='"+j+"' class='btn-del suppArticle'><i class='fas fa-trash-alt'></i></button></div></div>"); // pour chaque tableau dans le tableau global, on affiche les informations dans le panier
            }
        }
        $("#basket .btn-del").on("click", removeItem); // retirer un élément du panier
        $("#showTotal").append("<table><tr><td>Total articles :</td><td>"+quant+"</td></tr><tr><td>Prix total :</td><td>"+(final).toFixed(2)+"€</td></tr></table>"); // affichage du total du panier
        $("#numberBasket").empty(); // on remet à 0 le nombre d'articles dans le pannier sur le header
        $("#numberBasket").append(quant); // on additionne le nombre d'articles pour le mettre à jour sur le header
        // console.log(quant);
    }
    // console.log(basket[0]);  
}

function removeItem() // retirer un élément du pannier
{
    // console.log("test");
    let id = $(this).data('id');
    // console.log(id);
    // console.log(basket);
    basket[0].splice(id, 1);
    saveBasket(); // enregistrer le tableau global mis à jour
    loadStorage(); // récupérer le tableau global mis à jour
    showBasket(); // afficher le pannier mis à jour

    if(basket[0].length < 1)
    {
        localStorage.clear();
        $("#messageBasket").append("<div class='message'>Votre panier est vide</div>");
        $("#basketTotal").addClass("hidden");
    }
}

function emptyBasket() // vider le panier 
{
    // console.log("test");
    $("#basket").empty(); // on vide l'espace panier 
    $("#messageBasket").append("<div class='message'>Votre panier est vide</div>");
    $("#fullBasket").addClass("hidden");
    $("#basket").addClass("hidden");
    $("#basketTotal").addClass("hidden");
    $("#numberBasket").empty();
    $("#numberBasket").append("0");
    basket = []; // on vide le tableau global
    localStorage.clear(); // on vide le local storage
}

function validBasket() // validation du pannier 
{
    basket = JSON.stringify(basket[0]);
    final = parseFloat(final);
    // console.log(basket);
    // console.log(final);
    $.get(('index.php'), ('action=sendOrder&order='+basket+'&total='+final), ordering); // création de la commande dans la bdd via php
}

function ordering(response) // envoi de la commande
{
    // console.log("test");
    $('#basket').empty();
    $("#numberBasket").empty();
    $("#basketTotal").addClass("hidden");
    basket=[];
    localStorage.clear();
    $("#messageBasket").html("<div class='message'>Votre commande a bien été enregistrée !</div>");
}

document.addEventListener("DOMContentLoaded", function(){
    loadStorage(); // chargement du local storage
    showBasket(); // affichage du panier

    button = document.getElementById("add");
    btnempty = document.getElementById("empty");
    btnvalid = document.getElementById("valid");

    if(button) // technique pour empêcher le conflit lorsque l'élément n'existe pas sur la page où on se trouve
    {
        button.addEventListener("click", addBasket);
    }
    if(btnempty)
    {
        btnempty.addEventListener("click", emptyBasket);
    }
    if(btnvalid)
    {
        btnvalid.addEventListener("click", validBasket);
    }
});