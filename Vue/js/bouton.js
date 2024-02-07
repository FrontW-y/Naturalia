// Obtenir les boutons like et dislike
const likeButton = document.getElementById('like');
const dislikeButton = document.getElementById('dislike');

// Obtenir le paragraphe pour le message de retour
const feedbackMessage = document.getElementById('feedback-message');

// Écouteur d'événement pour le bouton like
likeButton.addEventListener('click', function() {
  feedbackMessage.textContent = 'Heureux que cela vous plaise!';
  feedbackMessage.style.color = 'green'; // Optionnel : Changer la couleur en vert
});

// Écouteur d'événement pour le bouton dislike
dislikeButton.addEventListener('click', function() {
  feedbackMessage.textContent = 'Désolé si cela ne vous a pas plus.';
  feedbackMessage.style.color = 'red'; 
});
