<?php  
    //Appel de session_start si l'utilisateur est connecté
    if(isset($_COOKIE['PHPSESSID'])) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Le Quai Antique est le troisième restaurant de l'excellent Chef Arnaud Michant. Venez dans ce lieu déguster des plats inimitables avec des produits de Savoie en partenariat avec les producteurs locaux !">
    <title>Le Quai Antique</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <nav class="navigation">
        <a href="#" class="logo">
            <img src="Logos/Quai Antique Logo.png" alt="Logo du restaurant">
        </a>

        <div class="side-menu" id="side-nav">
            <a href="#" class="close" id="close-button">X</a>
            <ul>
                <li>
                    <a class="list" href="carte.php">Notre carte</a>
                </li>
                <li>
                    <a class="list" href="menus.php">Nos menus</a>
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

        <a href="#" class="burger" id="burger-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="75" fill="white" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </a>
        <a href="carte.php" class="nav-link carte-link">Notre carte</a>
        <?php  
             //Affichage des liens de navigation tablette/desktop selon l'utilisateur en question
            $session->linkSessionNav();
        ?>
    </nav>
    <h1 class="title">Bienvenue au Quai Antique</h1>
    <?php
        //Affichage des images de plats
        require_once '../Back/controller-database.php';
        $database->imageDisplay();
    ?>
    <div class="button">
        <a href="reservation.php">
            <button>Réserver</button>
        </a>
    </div>
   
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
        <?php
            //Affichage des horaires 
            $database->hoursDisplay(); 
        ?>
        </div>
    </footer>
        <script src="JS/side-navigation.js"></script>
</body>
</html>