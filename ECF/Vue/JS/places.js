/*Récupération de respectivement le champ date du formulaire de reservation, le champ correspondant au nombre de convives, 
le champ d'affichage des places restantes et le formulaire de reservation */

let date = document.getElementById('date');
let guests = document.getElementById('guests');
let places = document.getElementById('places');
let form = document.getElementById('form');

/*Quand l'utilisateur sélectionne une date, la fonction XMLDatabaseIntercation est appelée , prenant en paramètre la date choisie */
date.addEventListener('change', () => {
    let dateChoose = date.value;
    XMLDatabaseIntercation(dateChoose);
})

function XMLDatabaseIntercation(date) {
    /*Création d'un objet XMLHttpRequest*/
    const xhr = new XMLHttpRequest();
    /*Appel asynchrone du script php présent dans placesReservation.php avec la date en paramètre*/
    xhr.open('GET', `http://localhost:8888/ECF/Back/placesReservation.php?date=${encodeURIComponent(date)}`);
    /*Attente de la réponse*/
    xhr.addEventListener('readystatechange', () => {
        /*Vérification du succès de la requête*/
        if(xhr.status === 200 && xhr.readyState === 4) {
            if(xhr.response > 0 || xhr.response == '' || xhr.response == null) {
                /*On affiche la réponse dans le champ d'affichage des places restantes*/
                places.innerText = xhr.response;

            } else {
                /*Si il ne reste plus aucune place, on affiche le message suivant et on empêche la soumission du formulaire*/
                places.innerText = 'Plus aucune place n\'est disponible à cette date, veuillez sélectionner une autre période';

                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                })
            }
        }
    })
    /*Envoi de la requête*/
    xhr.send();
}