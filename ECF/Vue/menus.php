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
    <meta name="description" content="Venez jeter un œuil à notre sélection de menus. Ici, vous est proposé plusieurs formules selon vos goûts ou envie.">
    <title>Menus</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/menus.css">
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
                    <a href="#" class="list">Nos menus</a>
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
    <h1 class="title">Nos menus</h1>

    <h2 class="subheading">Menu découverte</h2>
    <h3 class="name">Formule déjeuner</h3>
    <p>Entrée + Plat + Dessert choisis par le chef + Verre de vin au choix</p>
    <p class="price">60 €</p>
    <h3 class="name">Formule dîner</h3>
    <p>Entrée + Plat + Dessert choisis par le chef + Digestif</p>
    <p class="price">70 €</p>

    <h2 class="subheading">Menu Terre</h2>
    <h3 class="name">Formule déjeuner / dîner</h3>
    <p>Velouté d'automne + Hampe de bœuf grillée + Mille-Feuille (Boissons non comprises) </p>
    <p class="price">50 €</p>
    <h2 class="subheading">Menu Mer</h2>

    <h3 class="name">Formule déjeuner / dîner</h3>
    <p>Le saumon fumé par nos soins + Le filet de daurade royale rôti + La tarte tatin pomme/figues (Boissons non comprises)</p>
    <p class="price">55 €</p>
    <h2 class="subheading">Menu enfant</h2>
    
    <h3 class="name">Formule déjeuner / dîner</h3>
    <p>Entrée + Plat + Dessert + Jus de fruit (au choix)</p>
    <p class="price">25 €</p>
    
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
</body>
</html>