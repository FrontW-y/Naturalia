document.addEventListener('DOMContentLoaded', function() {
  // Initialise les boutons en fonction de l'état actuel de la commande
  updateButtonStates();
  
  // Écouteur pour les changements de sélection ou de contenu
  document.addEventListener("selectionchange", updateButtonStates);
  document.querySelector(".textArea").addEventListener("input", updateButtonStates);
});

function toggleBold() {
    toggleStyle('bold', '[B]', '[/B]');
}

function toggleUnderline() {
    toggleStyle('underline', '[U]', '[/U]');
}

function toggleItalic() {
    toggleStyle('italic', '[I]', '[/I]');
}

function toggleStyle(style, startTag, endTag) {
    var textArea = document.querySelector('.textArea');
    var selection = window.getSelection();

    if (!selection.rangeCount) return false;

    var range = selection.getRangeAt(0);
    var selectedText = range.toString();

    

    var styledText = document.createElement('span');
    styledText.innerHTML = `${startTag}${selectedText}${endTag}`;

    range.deleteContents();
    range.insertNode(styledText);

    // Mettre à jour la sélection pour inclure le nouveau nœud
    selection.removeAllRanges();
    selection.addRange(range);

    updateButtonStates();
}

function updateButtonStates() {
  updateButtonState('bold', 'btnBold');
  updateButtonState('underline', 'btnUnderline');
  updateButtonState('italic', 'btnItalic');
}

function updateButtonState(command, buttonId) {
  var button = document.getElementById(buttonId);
  var isActive = document.queryCommandState(command);
  button.classList.toggle('active', isActive);
}

document.addEventListener('DOMContentLoaded', (event) => {
  var editableDiv = document.getElementById('editableDiv');
  var htmlContentInput = document.getElementById('htmlContent');

  // Lorsque le contenu de la div éditable change, mettez à jour l'input caché.
  editableDiv.addEventListener('input', function() {
    htmlContentInput.value = editableDiv.innerHTML;
  });
});


