
    let currentQuestionIndex = 0; // Indice de la question actuelle
    let score = 0; // Initialise le score à 0

    // Tableau de questions et réponses
    let questions = [
        { question: "Quel est le nom français de cette espèce ?", reponses: ["Jaguar", "Chat Margay", "Tigre rouge"], reponseCorrecte: "Chat Margay" },
        { question: "Quel est l'habitat de cette espèce ?", reponses: ["Marin et terrestre", "Eau saumâtre", "Terrestre"], reponseCorrecte: "Terrestre" },
        { question: "Ou se situe cette espèce ?", reponses: ["Guyane française", "Réunion", "Martinique"], reponseCorrecte: "Guyane française"},
        { question: "Quel est le nom scientifique de cette espèce ?", reponses: ["Leopardus wiedii", "Puma concolor", "Leopardus pardalis"], reponseCorrecte: "Leopardus wiedii"},
        { question: "Qui a découvert cette espèce ?", reponses: ["Linnæus", "J. E. Gray", "Schinz"], reponseCorrecte: "Schinz"}
        // Ajoutez d'autres questions ici
    ];

    window.onload = startQuiz; // Démarre le quiz lorsque la page est chargée

    function showQuiz() {
        document.getElementById('info-box').style.display = 'none';
        document.getElementById('quiz-box').style.display = 'block';
        document.getElementById('résultat-box').style.display = 'none';
        displayQuestion();
    }

// Définition de displayQuestion en dehors de window.onload
function displayQuestion() {
    let questionContainer = document.getElementById('question-container');
    let answersContainer = document.querySelector('.answers');

    if (currentQuestionIndex < questions.length) {
        let currentQuestion = questions[currentQuestionIndex];
        questionContainer.textContent = currentQuestion.question;
        answersContainer.innerHTML = ""; // Vider les réponses précédentes

        currentQuestion.reponses.forEach((reponse, index) => {
            let button = document.createElement('button');
            button.className = 'réponses';
            button.textContent = `${String.fromCharCode(97 + index)}. ${reponse}`;
            button.onclick = function() { selectAnswer(button); };
            answersContainer.appendChild(button);
        });
    } else {
        document.getElementById('info-box').style.display = 'none';
        document.getElementById('quiz-box').style.display = 'none';
        document.getElementById('résultat-box').style.display = 'block';
        document.getElementById('scoreFinale').textContent = score; // Afficher le score final
        calculerResultats();
    }
}

// Fonction pour redémarrer le quiz
function restartQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    displayQuestion();
}

    function nextQuestion() {
        currentQuestionIndex++;
        displayQuestion();
    }

    function selectAnswer(selectedButton) {
        let reponseUtilisateur = selectedButton.textContent.trim().slice(3);
        let reponseCorrecte = questions[currentQuestionIndex].reponseCorrecte;

        if (reponseUtilisateur === reponseCorrecte) {
            score++;
        }

        let allReponses = document.querySelectorAll('.réponses');
        allReponses.forEach(reponse => {
            reponse.style.backgroundColor = '';
            reponse.style.color = '';
            reponse.classList.remove('selected');
        });

        selectedButton.style.backgroundColor = '#4CAF50';
        selectedButton.style.color = 'white';
        selectedButton.classList.add('selected');
    }

    function calculerResultats() {
    let selectedButton = document.querySelector('.réponses.selected');
    let scoreFinalContainer = document.getElementById('scoreFinale');

    if (selectedButton) {
        // Mise à jour du score ici si nécessaire (en fonction de votre logique)
    } else {
        alert("Veuillez sélectionner une réponse avant de voir les résultats.");
    }

    let scoreFinal = parseInt(scoreFinalContainer.textContent); // Récupérer la valeur du score

    if (scoreFinal >= 0 && scoreFinal < 3) {
        document.getElementById('MauvaisScore').style.display = 'block';
        document.getElementById('ScoreNeutre').style.display = 'none';
        document.getElementById('BonScore').style.display = 'none';
 
        console.log("Dommage, n'hésitez pas à relire l'info du jour et à recommencer le test pour augmenter votre score ! ")
    }

    else if (scoreFinal == 3) {
        document.getElementById('ScoreNeutre').style.display = 'block';
        document.getElementById('MauvaisScore').style.display = 'none';
        document.getElementById('BonScore').style.display = 'none';


    }
    else {
        document.getElementById('BonScore').style.display = 'block';
        document.getElementById('ScoreNeutre').style.display = 'none';
        document.getElementById('MauvaisScore').style.display = 'none';

    }
}

    function startQuiz() {
        document.getElementById('info-box').style.display = 'block';
        document.getElementById('résultat-box').style.display = 'none';
    }


