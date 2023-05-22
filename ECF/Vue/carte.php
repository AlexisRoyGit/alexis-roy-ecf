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
    <meta name="description" content="Vous trouverez sur cette page la carte de notre restaurant présentant la liste de tous nos plats concoctés par le Chef Arnaud Michant en partenariat avec des producteurs locaux">
    <title>Notre carte</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/carte.css">
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
                    <a href="#" class="list">Notre carte</a>
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
        <a href="#" class="nav-link carte-link">Notre carte</a>
        <?php  
            //Affichage des liens de navigation tablette/desktop selon l'utilisateur en question
            $session->linkSessionNav();
        ?>
    </nav>
    <h1 class="title">Notre carte</h1>
    <main class="carte">

        <div class="starter">
            <h2 class="subheading">Nos entrées :</h2>
            <h3 class="name">Le foie gras de canard frais maison</h3>
            <p>(Foie gras maison accompagné d'un chutney de figues)</p>
            <p class="price">18 €</p>
            <h3 class="name">Velouté d'automne</h3>
            <p>(Velouté de céleri, maïs sautés, sommités de brocolis et croûtons au beurre)</p>
            <p class="price">10 €</p>
            <h3 class="name">Le saumon fumé par nos soins</h3>
            <p>(Artichaud poivrade, vinaigrette mangue et chantilly raifort)</p>
            <p class="price">14 €</p>
        </div>

        <div class="course">
            <h2 class="subheading">Nos plats :</h2>
            <h3 class="name">Hampe de bœuf grillée</h3>
            <p>(Bœuf de Chambéry AOP, frites allumettes, béarnaise ou beurre maître d'hôtel)</p>
            <p class="price">24 €</p>
            <h3 class="name">Le filet de daurade royale rôti</h3>
            <p>(Wok de légumes croquants aux senteurs d'Asie et son pesto de coriandre)</p>
            <p class="price">22 €</p>
            <h3 class="name">Le tournedos de bœuf “Rossini”</h3>
            <p>(Foie gras poêlé, jus court à la truffe)</p>
            <p class="price">26 €</p>
        </div>

        <div class="dessert">
            <h2 class="subheading">Nos desserts :</h2>
            <h3 class="name">Les profiterolles maison</h3>
            <p>(Glace vanille et sa sauce chocolat maison)</p>
            <p class="price">12 €</p>
            <h3 class="name">Mille-Feuille</h3>
            <p>(Feuilletage croustillant et crème à la vanille Bourbon de Madagascar)</p>
            <p class="price">10 €</p>
            <h3 class="name">La tarte tatin pomme/figues</h3>
            <p>(Pomme généreusement confite et glace yaourt)</p>
            <p class="price">11 €</p>
        </div>

    </main>

    <div class="drinks">
            <h2 class="subheading">Nos boissons :</h2>
            <h3 class="name">Marsannay vielles vignes 2014 (Le verre)</h3>
            <p>(Vin blanc AOP parfait pour accompagner un poisson)</p>
            <p class="price">17 €</p>
            <h3 class="name">Pinot noir Faiveley 2016 (Le verre)</h3>
            <p>(Vin rouge délicat idéal pour accompagner une viande rouge)</p>
            <p class="price">15 €</p>
            <h3 class="name">Champagne De Castelnau 2000</h3>
            <p>(Un champagne de qualité pour un heureux événement)</p>
            <p class="price">65 €</p>
            <h3 class="name">Digestif ou café</h3>
            <p>(Au choix, pour finir votre repas)</p>
            <p class="price">5 €</p>
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
            <?php require_once '../Back/controller-database.php';  
                //Affichage des horaires
                $database->hoursDisplay();
            ?>
        </div>
    </footer>
    <script src="JS/side-navigation.js"></script>
</body>
</html>