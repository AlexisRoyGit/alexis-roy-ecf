<?php 

require_once 'controller-database.php';

//Recuperation du champ rentré dans le formulaire
$limitRestaurant = $_POST['limit'];

if(isset($limitRestaurant) && $limitRestaurant !== '' ) {
    //Modification de la limite d'accueil du restaurant
    $database->capacityRestaurantModification($limitRestaurant); 
} else {
    throw new Exception('Les données indiquées sont incorrectes, veuillez les vérifier et réessayer');
}