/*Récupération de respectivement le formulaire d'ajout d'images, le formulaire de modification d'images, 
le bouton radio "Ajout d'une image" et le bouton radio "Modification d'une image" */
let formAddImage = document.getElementById('formAddImage');
let formModifyImage = document.getElementById('formModifyImage');
let buttonAddImage = document.getElementById('addImage');
let buttonModifyImage = document.getElementById('modifyImage');

/*Affichage du formulaire d'ajout d'image et masquage du formulaire de modification d'image*/
function displayFormAddImage() {
    formAddImage.classList.remove('undisplayed');
    formModifyImage.classList.add('undisplayed');
}

/*Affichage du formulaire de modification d'image et masquage du formulaire d'ajout d'image*/
function displayFormModifyImage() {
    formAddImage.classList.add('undisplayed');
    formModifyImage.classList.remove('undisplayed');
}

/*Affichage et masquage de formulaires selon le bouton radio choisi*/
buttonAddImage.addEventListener('change', displayFormAddImage);
buttonModifyImage.addEventListener('change', displayFormModifyImage);