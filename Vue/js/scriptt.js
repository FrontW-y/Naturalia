// Fonction pour vérifier si les mots de passe correspondent
function checkPasswordMatch() {
    var password = document.getElementById("motdepasse").value;
    var confirmPassword = document.getElementById("confirmation").value;
    var passwordMatchIndicator = document.getElementById("password-match-indicator");
    var confirmPasswordField = document.getElementById("confirmation");

    if (password === confirmPassword) {
        passwordMatchIndicator.textContent = "Les mots de passe correspondent";
        passwordMatchIndicator.classList.remove("no-match");
        passwordMatchIndicator.classList.add("match");
        confirmPasswordField.style.border = "1px solid #ccc"; // Réinitialise la bordure
    } else {
        passwordMatchIndicator.textContent = "Les mots de passe ne correspondent pas";
        passwordMatchIndicator.classList.remove("match");
        passwordMatchIndicator.classList.add("no-match");
        confirmPasswordField.style.border = "1px solid red"; // Applique une bordure rouge
    }
    checkFormValidity(); // Vérifier la validité du formulaire
}

// Fonction pour vérifier la présence de caractères spéciaux, majuscules et minuscules dans le mot de passe
function checkPasswordRequirements() {
    var password = document.getElementById("motdepasse").value;
    var passwordRequirementsIndicator = document.getElementById("password-requirements-indicator");
    var specialChars = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;
    var hasLowercase = /[a-z]/;
    var hasUppercase = /[A-Z]/;

    if (specialChars.test(password) && hasLowercase.test(password) && hasUppercase.test(password)) {
        passwordRequirementsIndicator.textContent = "Mot de passe conforme aux exigences";
        passwordRequirementsIndicator.classList.remove("requirements-invalid");
        passwordRequirementsIndicator.classList.add("requirements-valid");
    } else {
        passwordRequirementsIndicator.textContent = "Mot de passe doit contenir au moins un caractère spécial, une lettre minuscule et une lettre majuscule";
        passwordRequirementsIndicator.classList.remove("requirements-valid");
        passwordRequirementsIndicator.classList.add("requirements-invalid");
    }
    checkFormValidity(); // Vérifier la validité du formulaire
}

// Fonction pour vérifier la validité globale du formulaire
function checkFormValidity() {
    var password = document.getElementById("motdepasse").value;
    var confirmPassword = document.getElementById("confirmation").value;
    var conditionsAccepted = document.getElementById("conditions").checked;
    var submitButton = document.getElementById("submit");

    if (password === confirmPassword && conditionsAccepted) {
        submitButton.disabled = false; // Activer le bouton
        submitButton.classList.remove("disabled-button"); // Supprimer la classe de désactivation
    } else {
        submitButton.disabled = true; // Désactiver le bouton
        submitButton.classList.add("disabled-button"); // Ajouter la classe de désactivation
    }
}

// Attacher les fonctions aux événements
document.getElementById("motdepasse").addEventListener("keyup", function () {
    checkPasswordMatch();
    checkPasswordRequirements();
});

document.getElementById("confirmation").addEventListener("keyup", checkPasswordMatch);
document.getElementById("conditions").addEventListener("change", checkFormValidity);

// Appel initial pour vérifier la validité du formulaire au chargement de la page
document.addEventListener("DOMContentLoaded", function () {
    checkFormValidity();
});
