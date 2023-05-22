<?php

require_once 'functions.php';
require_once 'Models/Clients.php';
require_once 'Models/Database.php';


$database = new Database();

//Récuperation des champs rentrés dans le formulaire
$mail = trim(htmlspecialchars($_POST['mail'])); 
$password = trim(htmlspecialchars($_POST['password']));
$numberGuests = trim(htmlspecialchars($_POST['guests']));
$allergies = trim(htmlspecialchars($_POST['allergies']));

//Vérification des champs via la fonction inscriptionVerifications()  (voir functions.php)
if(inscriptionVerifications($mail, $password, $numberGuests, $allergies)) {
    //On verifie que le client n'existe pas déjà
    if($database->preventDuplicationCreation($mail)) {
        //Creation du client
        $database->creationClient($mail, $password, $numberGuests, $allergies);
    } else {
        throw new Exception("L'adresse email rentrée correspond déjà à un client enregistré. Veuillez vous connecter au compte associé ou utiliser une autre adresse");
    }
} else {
    throw new Exception('Les champs rentrés sont invalides');
}