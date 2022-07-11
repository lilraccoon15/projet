// tuto trouvé sur youtube pour un affichage progressif des éléments de la page au scroll

// ratio d'affichage d'un élément, on l'affiche entièrement lorsqu'on atteint sa moitié (threshold = le pallier de 0.5 de l'image)
const ratio = 0.5;

const options = {
    root: null,
    rootMargin: '0px',
    threshold: ratio
}

// pour chaque élément, contenant la classe reveal, on lui ajoute la classe reveal-visible
const handleIntersect = function(entries, observer) {
    entries.forEach(function(entry) {
        if(entry.intersectionRatio > ratio) {
            entry.target.classList.add("reveal-visible");
            observer.unobserve(entry.target);
        }
    })
}

const observer = new IntersectionObserver(handleIntersect, options);
document.querySelectorAll(".reveal").forEach(function(r) {
    observer.observe(r);
})

