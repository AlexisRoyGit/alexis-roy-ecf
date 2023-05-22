<?php

require_once 'functions.php';
require_once 'Models/Clients.php';
require_once 'Models/Admins.php';
require_once 'Models/Database.php';


$database = new Database();

//Recuperation des donnes entrées dans le formulaire de connexion
$mail = trim(htmlspecialchars($_POST['mail'])); 
$password = trim(htmlspecialchars($_POST['password']));

//Appel a la fonction connexionVerifications pour vérifier les champs entrées (voir functions.php)
if(connexionVerifications($mail, $password)) {
    //Appel de connexionClient et connexionAdmin selon si les identifiants rentrés correspondent à l'un ou à l'autre
    if($database->connexionClient($mail, $password) || $database->connexionAdmin($mail, $password)) {

    } else {
        throw new Exception('Vos champs sont invalides, veuillez réessayer');
    }
}