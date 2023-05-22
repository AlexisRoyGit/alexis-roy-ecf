<?php

require_once 'functions.php';
require_once 'Models/Hours.php';
require_once 'Models/Database.php';

//Récupération des données entrées dans le formulaire de modification des heures

$mondayNoon = trim($_POST['mondayNoon']);
$mondayEvening = trim($_POST['mondayEvening']);
$mondayClosed = trim($_POST['mondayClosed']);

$tuesdayNoon = trim($_POST['tuesdayNoon']);
$tuesdayEvening = trim($_POST['tuesdayEvening']);
$tuesdayClosed = trim($_POST['tuesdayClosed']);

$wednesdayNoon = trim($_POST['wednesdayNoon']);
$wednesdayEvening = trim($_POST['wednesdayEvening']);
$wednesdayClosed = trim($_POST['wednesdayClosed']);

$thursdayNoon = trim($_POST['thursdayNoon']);
$thursdayEvening = trim($_POST['thursdayEvening']);
$thursdayClosed = trim($_POST['thursdayClosed']);

$fridayNoon = trim($_POST['fridayNoon']);
$fridayEvening = trim($_POST['fridayEvening']);
$fridayClosed = trim($_POST['fridayClosed']);

$saturdayNoon = trim($_POST['saturdayNoon']);
$saturdayEvening = trim($_POST['saturdayEvening']);
$saturdayClosed = trim($_POST['saturdayClosed']);

$sundayNoon = trim($_POST['sundayNoon']);
$sundayEvening = trim($_POST['sundayEvening']);
$sundayClosed = trim($_POST['sundayClosed']);

$database = new Database();

/*Fonctions pour chacun des jours qui verifie si la case correspondant au jour fermé est cochée, si oui, 
on le signifie a la base de données via restaurantClose(),sinon on signifie que le restaurant est ouvert et 
modifient les heures en passant par les fonctions hoursNoon() et housrEvening() (voir functions.php)*/

function mondayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(1);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(1);
        hoursNoon($hoursNoon, $database, 1);
        hoursEvening($hoursEvening, $database, 1);
    }
}


function tuesdayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(2);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(2);
        hoursNoon($hoursNoon, $database, 2);
        hoursEvening($hoursEvening, $database, 2);
    }
}


function wednesdayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(3);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(3);
        hoursNoon($hoursNoon, $database, 3);
        hoursEvening($hoursEvening, $database, 3);
    }
}


function thursdayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(4);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(4);
        hoursNoon($hoursNoon, $database, 4);
        hoursEvening($hoursEvening, $database, 4);
    }
}


function fridayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(5);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(5);
        hoursNoon($hoursNoon, $database, 5);
        hoursEvening($hoursEvening, $database, 5);
    }
}

function saturdayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(6);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(6);
        hoursNoon($hoursNoon, $database, 6);
        hoursEvening($hoursEvening, $database, 6);
    }
}


function sundayHours(string $hoursNoon, string $hoursEvening, string $isClosed , object $database) 
{
    if($isClosed !== '') {
        $database->restaurantClose(7);
    } elseif((isset($hoursNoon) || isset($hoursEvening)) && ($hoursNoon !== '' || $hoursEvening !== '')) {
        $database->restaurantOpen(7);
        hoursNoon($hoursNoon, $database, 7);
        hoursEvening($hoursEvening, $database, 7);
    }
}


mondayHours($mondayNoon, $mondayEvening, $mondayClosed, $database);
tuesdayHours($tuesdayNoon, $tuesdayEvening, $tuesdayClosed, $database);
wednesdayHours($wednesdayNoon, $wednesdayEvening, $wednesdayClosed, $database);
thursdayHours($thursdayNoon, $thursdayEvening, $thursdayClosed, $database);
fridayHours($fridayNoon, $fridayEvening, $fridayClosed, $database);
saturdayHours($saturdayNoon, $saturdayEvening, $saturdayClosed, $database);
sundayHours($sundayNoon, $sundayEvening, $sundayClosed, $database);