<?php  
    require_once '../Back/controller-database.php';
    session_start();
    if(isset($_COOKIE['PHPSESSID']) && $database->verifyAccessAdmin($_SESSION['adminIdentity'])) {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme administrateur</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/administration.css">
</head>
<body>
    <nav class="navigation">
        <a href="index.php" class="logo">
            <img src="Logos/Quai Antique Logo.png" alt="Logo du restaurant">
        </a>
        <div class="side-menu" id="side-nav">
            <a href="#" class="close" id="close-button">X</a>
            <ul>
                <li>
                    <a href="carte.php" class="list">Notre carte</a>
                </li>
                <li>
                    <a href="menus.php" class="list">Nos menus</a>
                </li>
                <li>
                    <?php  
                        //Affichage des liens de navigation mobile selon l'utilisateur en question
                        require_once '../Back/controller-session.php';
                        $session->linkSessionSidenav();
                    ?>
                </li>
            </ul>
        </div>
        <div class="burger" id="burger-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="75" fill="white" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </div>
        <a href="carte.php" class="nav-link carte-link">Notre carte</a>
        <?php  
             //Affichage des liens de navigation tablette/desktop selon l'utilisateur en question
            $session->linkSessionNav();
        ?>
    </nav>
    <h1 class="title">Plateforme de modification des données</h1>
    
    <form>
        <label for="addImage">Ajout d'une image</label>
        <input type="radio" name="imageForms" id="addImage" class="radioAddImage" checked>
        <label for="modifyImage" class="radioModifyImage">Modification d'une image</label>
        <input type="radio" name="imageForms" id="modifyImage">
    </form>

    <fieldset class="modificationImages" id="formAddImage">
        <legend>Ajouter une image à la galerie</legend>
        <form method="post" action="../Back/addImage.php" enctype="multipart/form-data">
            <label for="titleImage">Titre de l'image</label>
            <input type="text" name="titleImageAdd" id="titleImageAdd" placeholder="Entrez le titre de l'image à ajouter" required>
            <label for="image">Image à importer</label>
            <input type="file" name="imageAdd" id="imageAdd" class="imageInput" required>
            <button type="submit">Ajouter</button>
        </form>
    </fieldset>

    <fieldset class="undisplayed modificationImages" id="formModifyImage">
        <legend>Modifier une image de la galerie</legend>
        <form method="post" action="../Back/modifyImage.php" enctype="multipart/form-data">
            <label for="titleImage">Titre de l'image à modifier</label>
            <input type="text" name="titleImageModify" id="titleImageModify" placeholder="Entrez le titre de l'image à modifier" required>
            <label for="image">Nouvelle image</label>
            <input type="file" name="imageModify" id="imageModify" class="imageInput" required>
            <button type="submit">Modifier</button>
        </form>
    </fieldset>

    <fieldset class="deleteImage">
        <legend>Suppression d'une image</legend>
        <form method="post" action="../Back/deleteImage.php">
            <label>Titre de l'image</label>
            <input type="text" name="titleDelete" id="titleDelete" placeholder="Titre de l'image à supprimer de la galerie" required>
            <button type="submit">Supprimer</button>
        </form>
    </fieldset>

    <fieldset class="modifyHours">
        <legend>Modifier les horaires (Exemple: <b>10:00-13:30</b>)</legend>
        <form method="post" action="../Back/changeHours.php">
            <label for="mondayNoon">Lundi Midi</label>
            <input type="text" name="mondayNoon" id="mondayNoon">
            <label for="mondayEvening">Lundi Soir</label>
            <input type="text" name="mondayEvening" id="mondayEvening">
            <label for="mondayClosed">Lundi Fermé</label>
            <input type="checkbox" id="mondayClosed" name="mondayClosed">

            <label for="tuesdayNoon">Mardi Midi</label>
            <input type="text" name="tuesdayNoon" id="tuesdayNoon">
            <label for="tuesdayEvening">Mardi Soir</label>
            <input type="text" name="tuesdayEvening" id="tuesdayEvening">
            <label for="tuesdayClosed">Mardi Fermé</label>
            <input type="checkbox" id="tuesdayClosed" name="tuesdayClosed">

            <label for="wednesdayNoon">Mercredi Midi</label>
            <input type="text" name="wednesdayNoon" id="wednesdayNoon">
            <label for="wednesdayEvening">Mercredi Soir</label>
            <input type="text" name="wednesdayEvening" id="wednesdayEvening">
            <label for="wednesdayClosed">Mercredi Fermé</label>
            <input type="checkbox" id="wednesdayClosed" name="wednesdayClosed">

            <label for="thursdayNoon">Jeudi Midi</label>
            <input type="text" name="thursdayNoon" id="thursdayNoon">
            <label for="thursdayEvening">Jeudi Soir</label>
            <input type="text" name="thursdayEvening" id="thursdayEvening">
            <label for="thursdayClosed">Jeudi Fermé</label>
            <input type="checkbox" id="thursdayClosed" name="thursdayClosed">

            <label for="fridayNoon">Vendredi Midi</label>
            <input type="text" name="fridayNoon" id="fridayNoon">
            <label for="fridayEvening">Vendredi Soir</label>
            <input type="text" name="fridayEvening" id="fridayEvening">
            <label for="fridayClosed">Vendredi Fermé</label>
            <input type="checkbox" id="fridayClosed" name="fridayClosed">

            <label for="saturdayNoon">Samedi Midi</label>
            <input type="text" name="saturdayNoon" id="saturdayNoon">
            <label for="saturdayEvening">Samedi Soir</label>
            <input type="text" name="saturdayEvening" id="saturdayEvening">
            <label for="saturdayClosed">Samedi Fermé</label>
            <input type="checkbox" id="saturdayClosed" name="saturdayClosed">

            <label for="sundayNoon">Dimanche Midi</label>
            <input type="text" name="sundayNoon" id="sundayNoon">
            <label for="sundayEvening">Dimanche Soir</label>
            <input type="text" name="sundayEvening" id="sundayEvening">
            <label for="sundayClosed">Dimanche Fermé</label>
            <input type="checkbox" id="sundayClosed" name="sundayClosed">
           
           
            <button type="submit">Modifier</button>
        </form>
    </fieldset>

    <fieldset class="customersLimit">
        <legend>Limite de convives lors du service</legend>
        <form method="post" action="../Back/modifyCapacity.php">
            <label for="limit">Nombre de convives maximum</label>
            <input type="number" id="limit" name="limit">
            <button type="submit">Confirmer</button>
        </form>
    </fieldset>

    <footer class="time">
        <h2 class="timetitle">Nos horaires</h2>
        <div class="days">
            <p>Lundi</p>
            <p>Mardi</p>
            <p>Mercredi</p>
            <p>Jeudi</p>
            <p>Vendredi</p>
            <p>Samedi</p>
            <p>Dimanche</p>
        </div>
        <div class="hours">
        <?php require_once '../Back/controller-database.php'; 
                //Affichage des horaires
                $database->hoursDisplay();
            ?>
        </div>
    </footer>
    <script src="JS/side-navigation.js"></script>
    <script src="JS/form-image.js"></script>
</body>
</html>

<?php
    /*Affichage de cette page si un client non administrateur essaie d'y accéder*/
    } else { 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1 class="title">Cette page n'existe pas veuillez retouner en arrière</h1>
</body>
</html>
<?php } ?>