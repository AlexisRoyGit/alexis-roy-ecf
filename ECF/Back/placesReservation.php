<?php

//Recuperation de la date choisie par l'utilisateur sur le formulaire de réservation
$date = $_GET['date'];

require_once 'Models/Reservation.php';
require_once 'controller-database.php';

//Affichage de la limite d'accueil correspondant à la date choisie
$limitedispo = $database->getLimitReservationDate($date); 

echo $limitedispo;