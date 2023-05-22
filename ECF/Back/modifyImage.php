<?php

require_once 'Models/Database.php';
require_once 'Models/Images_courses.php';
require_once 'functions.php';

//Récupération des informations envoyées par le formulaire
$title = trim(htmlspecialchars($_POST['titleImageModify']));
$file = $_FILES['imageModify'];
$name = dashSeparator($_FILES['imageModify']['name']);
$path = $_FILES['imageModify']['tmp_name'];

$database = new Database();


if(isset($title) && $title !== '' && isset($file)) 
{
    //Verification de l'image importée (code d'erreur, taile, type, extension)
    if(imageError($file) && fileWeight($file) && fileMimeType($file) && fileExtension($file)) 
    {
        //Suppression de l'ancienne image du répertoire Images
        $database->deleteImageRepertory($title);
        //Modification des informations de l'image dans la base et enregistrement de la nouvelle image dans le dossier Images
        $database->modifyImage($title, $name);
        move_uploaded_file($path, '../Vue/Images/'.$name.'');
    } else {
        throw new Exception('Une erreur est survenue, vérifiez les données entrées');
    }
}