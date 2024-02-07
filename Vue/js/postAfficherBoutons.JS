// Fonction pour masquer les boutons
function hideButtons() {
  document.getElementById("like-btn").style.display = 'none';
  document.getElementById("dislike-btn").style.display = 'none';
}

// Fonction pour démarrer l'animation d'emojis
function startEmojiRain(isPositive) {
  const container = document.createElement('div');
  container.className = 'emoji-rain-container';
  document.body.appendChild(container);

  for (let i = 0; i < 30; i++) {
    const emoji = document.createElement('span');
    emoji.className = 'emoji';
    emoji.textContent = isPositive ? '🎉' : '😢';
    const xPos = Math.random() * window.innerWidth;
    emoji.style.left = `${xPos}px`;
    emoji.style.animationDuration = `${Math.random() * 3 + 2}s`;
    container.appendChild(emoji);
  }

  setTimeout(() => {
    document.body.removeChild(container);
  }, 4000);
}

// Gestionnaires d'événements pour les boutons
document.getElementById("like-btn").addEventListener("click", () => {
  document.getElementById("feedback-message").textContent = "Merci pour votre retour positif !";
  startEmojiRain(true);
  hideButtons();
});

document.getElementById("dislike-btn").addEventListener("click", () => {
  document.getElementById("feedback-message").textContent = "Une prochaine fois !";
  startEmojiRain(false);
  hideButtons();
});
