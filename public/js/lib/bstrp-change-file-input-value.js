/**
 * Petit bout de code pout que la valeur du champ file affiche le nom de l'image lors d'un changement
 * afin d'avoir un retour visuel pour l'utilisateur
 */
function bootstrapIF() {

    if (document.querySelector("[data-bsfileupload]")) {

        var inputFile = document.querySelector("[data-bsfileupload] input");
        var labelFile = document.querySelector("[data-bsfileupload] label");
        inputFile.addEventListener('change', function() {
            labelFile.innerText = inputFile.files[0].name;
        });
    }
}
bootstrapIF();