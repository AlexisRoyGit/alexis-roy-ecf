<?php 

require_once 'Models/Database.php';
require_once 'Models/Images_courses.php';

//Recuperation du titre entré dans le formulaire
$titleImage = trim(htmlspecialchars($_POST['titleDelete'])); 

$database = new Database();

if(isset($titleImage) && $titleImage !== '') {
    //Suppression de l'image dans la base de données et dans le répertoire Images
    $database->deleteImageRepertory($titleImage);
    $database->deleteImageDatabase($titleImage);

} else {
    throw new Exception('Veuillez remplir le champ');
}