/* Récupération de respectivement le bouton de fermeture du menu latéral en mobile,
son bouton d'ouverture (bouton burger) et le menu latéral en question */
let buttonClose = document.getElementById('close-button');
let buttonOpen = document.getElementById('burger-button');
let sideMenu = document.getElementById('side-nav');

/*Fonction d'ouverture du menu latéral mobile en ajoutant la classe "active" à ce dernier*/
function openSideNav() {
    sideMenu.classList.add('active');
}

/*Fonction de fermeture du menu latéral mobile en retirant la classe "active" à ce dernier*/
function closeSidenav() {
    sideMenu.classList.remove('active');
}

/*Appel de openSideNav() au clic de l'utilisateur sur le bouton burger*/
buttonOpen.addEventListener('click', openSideNav);
/*Appel de cloeSideNav() au clic de l'utilisateur sur le bouton de fermeture du menu latéral*/
buttonClose.addEventListener('click', closeSidenav);