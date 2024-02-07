
// Ajouter un écouteur d'événements pour le téléchargement d'images
document.getElementById('imageUpload').addEventListener('change', function(event){
    const fileList = event.target.files;
    console.log(fileList); // Traiter les fichiers sélectionnés ici
});


// Écouteur d'événements pour le téléchargement d'images
document.getElementById('imageUpload').addEventListener('change', function(event) {
    const files = event.target.files;
    for (const file of files) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('image-container');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px'; // Modifier selon vos besoins
                img.style.height = '100px'; // Modifier selon vos besoins
                imgContainer.appendChild(img);

                const deleteBtn = document.createElement('button');
                deleteBtn.classList.add('delete-btn');
                deleteBtn.innerText = 'X';
                deleteBtn.onclick = function() {
                    imgContainer.remove();
                };
                imgContainer.appendChild(deleteBtn);

                document.getElementById('imagePreview').appendChild(imgContainer);
            };
            reader.readAsDataURL(file);
        }
    }
});
