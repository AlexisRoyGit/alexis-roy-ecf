<?php

session_start();
require_once 'controller-session.php';


//Au clic sur deconnexion, destruction des variables de sessions et du cookie PHPSESSID
if($_SESSION['guests']) {
    $session->unsetSessionClient();
} else {
    $session->unsetSessionAdmin();
}

$session->deleteCookie();

//Redirection vers la page d'accueil
header('Location: ../Vue/index.php');