/* Récupération de respectivement le formulaire de connexion, le formulaire d'inscription, 
le bouton radio "Formulaire de connexion" et le bouton radio "Formulaire d'inscription" */
let formConnexion = document.getElementById('formConnect');
let formSuscribe = document.getElementById('formSuscribe');
let buttonConnexion = document.getElementById('connect');
let buttonSuscribe = document.getElementById('suscribe');

/*Affichage du formulaire d'inscription et masquage du formulaire de connexion*/
function displayFormSuscribe() {
    formConnexion.classList.add('undisplayed');
    formSuscribe.classList.remove('undisplayed');
}

/*Affichage du formulaire de connexion et masquage du formulaire d'inscription*/
function displayFormConnection() {
    formConnexion.classList.remove('undisplayed');
    formSuscribe.classList.add('undisplayed');
}

/*Affichage et masquage de formulaires selon le bouton radio choisi*/
buttonConnexion.addEventListener('change', displayFormConnection);
buttonSuscribe.addEventListener('change', displayFormSuscribe);