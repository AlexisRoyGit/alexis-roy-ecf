<?php

require_once 'Models/Database.php';
require_once 'functions.php';

//Récupération des informations envoyées par le formulaire
$imageTitle = trim(htmlspecialchars($_POST['titleImageAdd'])); 
$file = $_FILES['imageAdd'];
//Remplacement des espaces par des tirets avec dashSeparator()
$name = dashSeparator($file['name']);
$path = $file['tmp_name'];

$database = new Database();

if(isset($imageTitle) && $imageTitle !== '' && isset($file)) {
    //Verification de l'image importée (code d'erreur, taile, type, extension)
    if(imageError($file) && fileWeight($file) && fileMimeType($file) && fileExtension($file)) 
    {
        $database->addImage($imageTitle, $name);
        //Enregistrement de l'image dans le dossier Images
        move_uploaded_file($path, '../Vue/Images/'.$name.'');

    } else {
        unset($_FILES['image']);
        throw new Exception('Le fichier que vous avez ajouté est invalide !');
    }

} else {
    throw new Exception('Veuillez remplir les champs du formulaires');
}