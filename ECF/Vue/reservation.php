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
    <meta name="description" content="Venez ici reserver votre table dans notre restaurant en amont afin d'être assuré de pouvoir déguster notre cuisine !">
    <title>Réserver une table</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/reservation.css">
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
    <h1 class="title">Réserver</h1>
    <p class="warning">Il est possible de réserver jusqu'à une heure avant la fermeture du restaurant <b>(voir les horaires visibles en bas de page)</b></p>
    <fieldset>
    <legend>Réservation d'une table</legend>
        <form method="post" action="../Back/makeReservation.php" id="form">
            <label for="date">Date *</label>
            <input type="date" name="date" id="date" required>
            <label for="guests">Nombre de personnes (10 maximum) *</label>
            <input type="number" name="guests" id="guests" value="<?= $_SESSION['guests'] ?? null ?>" required>
            <label for="allergies">Allergies</label>
            <input type="text" name="allergies" id="allergies" value="<?= $_SESSION['allergies']  ?? null ?>">
            <p>Heures :</p>
            <p class="period">Midi</p>
            <?php require_once '../Back/controller-database.php'; 
                //Affichage des boutons radio correspondant aux horaires disponibles pour le midi
                $database->displayButtonsReservation(1);
            ?>
            <p class="period">Soir</p>
            <?php
                //Affichage des boutons radio correspondant aux horaires disponibles pour le soir
                $database->displayButtonsReservation(0); 
            ?>
            <p>Nombre de places restantes :  <span id="places"></span></p>
            <div class="button">
            <button type="submit">Réserver</button>
            </div>
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
            <?php
                //Affichage des horaires  
                $database->hoursDisplay(); 
            ?>
        </div>
    </footer>
        <script src="JS/side-navigation.js"></script>
        <script src="JS/places.js"></script>
</body>
</html>