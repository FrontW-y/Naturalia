var champsTexte;

document.addEventListener("DOMContentLoaded", function() {
champsTexte = document.querySelectorAll(".textarea");
champsTexte.forEach(function(champ) {
    champ.readOnly = true;})

// Ajouter un gestionnaire d'événements sur le bouton "Modifier"
var boutonModifier = document.querySelector(".fas");
boutonModifier.addEventListener("click", function(event) {
    event.preventDefault(); // Empêcher le formulaire de soumettre (à ajuster selon vos besoins)
    modifiable();
});

// Ajouter un gestionnaire d'événements sur le bouton "Enregistrer"
var boutonEnregistrer = document.querySelector(".enregistrer");
boutonEnregistrer.addEventListener("click", function(event) {
    event.preventDefault(); // Empêcher le formulaire de soumettre (à ajuster selon vos besoins)
    enregistrer();
});
});

function modifiable() {
champsTexte.forEach(function(champ) {
    champ.readOnly = false;
    champ.style.backgroundColor = "white";
    champ.style.opacity = "1";
    champ.style.cursor = "pointer";


});
}

function enregistrer() {
champsTexte.forEach(function(champ) {
    champ.readOnly = true;
    champ.style.opacity = "0.7";
    champ.style.cursor = "not-allowed";

});
}
