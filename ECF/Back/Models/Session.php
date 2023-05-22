<?php
//Classe répresentant la gestion de la session une fois les identifiants rentrés par le visiteur du site

class Session 
{

    //Affichage des différents liens dans le menu latéral mobile selon l'utilisateur (Client, Admin ou non connecté)
    public function linkSessionSideNav() 
    {
        if(isset($_SESSION['guests'])) {
            echo '<a class="list" href="../Back/deconnexion.php">Se déconnecter</a>';
        } elseif(isset($_SESSION['adminIdentity'])) {
            echo '<a class="list" href="administration.php">Plateforme administration</a>';
            echo '<a class="list" href="../Back/deconnexion.php">Se déconnecter</a>';
        } else {
            echo '<a class="list" href="connexion.php">Se connecter</a>';
        }
    }

    //Affichage des différents liens dans la barre de navigation en tablette/desktop selon l'utilisateur (Client, Admin ou non connecté)
    public function linkSessionNav() 
    {
        if(isset($_SESSION['guests'])) {
            echo '<a href="menus.php" class="nav-link menus-link">Nos menus</a>';
            echo '<a href="../Back/deconnexion.php" class="nav-link connexion-link">Se déconnecter</a>';
        } elseif(isset($_SESSION['adminIdentity'])) {
            echo '<a href="menus.php" class="nav-link menus-link-admin">Nos menus</a>';
            echo '<a href="administration.php" class="nav-link admin">Plateforme admin</a>';
            echo '<a href="../Back/deconnexion.php" class="nav-link connexion-link">Se déconnecter</a>';
        } else {
            echo '<a href="menus.php" class="nav-link menus-link">Nos menus</a>';
            echo '<a href="connexion.php" class="nav-link connexion-link">Se connecter</a>';
        }
    }

    //Fin de la session via la suppression du cookie PHPSESSID
    public function deleteCookie() 
    {
        setcookie('PHPSESSID', '', time() - 3600, '/');
        unset($_COOKIE['PHPSESSID']);
    }

    //Suppression des variables de Session correspondant à un client 
    public function unsetSessionClient() 
    {
        unset($_SESSION['guests']);
        unset($_SESSION['allergies']);
    }

    //Suppression de la variable de Session correspondant à un administrateur 
    public function unsetSessionAdmin() 
    {
        unset($_SESSION['adminIdentity']);
    }
}