<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <meta name="description" content="Veuillez entrer votre identifiant et mot de passe afin de vous connecter. Si vous ne disposez pas de compte, il est possible de vous inscrire">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/connexion.css">
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
                    <a href="#" class="list">Se connecter</a>
                </li>
            </ul>
        </div>
        <div class="burger" id="burger-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="85" height="75" fill="white" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </div>
        <a href="carte.php" class="nav-link carte-link">Notre carte</a>
        <a href="menus.php" class="nav-link menus-link">Nos menus</a>
        <a href="connexion.php" class="nav-link connexion-link">Se connecter</a>
    </nav>
    <h1 class="title">Connexion / Inscription</h1>

    <form>
        <label for="connect">Formulaire de connexion</label>
        <input type="radio" name="typeForm" id="connect" class="radioleft" checked>
        <label for="suscribe" class="radioright">Formulaire d'inscription</label>
        <input type="radio" name="typeForm" id="suscribe">
    </form>
    
    <fieldset class="connexion" id="formConnect">
        <legend>Connectez-vous</legend>
        <form method="post" action="../Back/connexion.php">
            <label for="mailConnexion">Votre email</label>
            <input type="email" name="mail" id="mailConnexion" placeholder="Veuillez entrer votre adresse mail" required>
            <label id="mdp">Votre mot de passe</label>
            <input type="password" name="password" id="passwordConnexion" placeholder="Veuillez entrer votre mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </fieldset>
    
    <fieldset class="inscription undisplayed" id="formSuscribe">
        <legend>Inscrivez-vous</legend>
        <form method="post" action="../Back/inscription.php">
            <label for="mailInscription">Votre email *</label>
            <input type="email" name="mail" id="mailInscription" placeholder="Veuillez entrer votre adresse mail" required>
            <label id="mdp">Votre mot de passe *</label>
            <input type="password" name="password" id="passwordInscription" placeholder="Veuillez entrer votre mot de passe" required>
            <label>Nombre de convives par défaut (10 maximum) *</label>
            <input type="number" name="guests" id="guests" placeholder="Définissez votre nombre moyen de convives" required>
            <label>Allergies</label>
            <input type="text" name="allergies" id="allergies" placeholder="Indiquez d'éventuelles allergies">
            <button type="submit">S'inscrire</button>
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
    <script src="JS/form-connection.js"></script>
</body>
</html>