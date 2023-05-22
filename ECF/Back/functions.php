<?php

//Vérification du format de l'email en paramètre
function emailVerify(string $email) :bool 
{
    $pattern = '/^[A-z0-9_.+-]+@[A-z0-9-]+\.[A-z0-9-.]+$/';
    if(preg_match($pattern, $email)) {
        return true;
    } else {
       return false;
    }
}

//Vérifie que les champs en paramètres sont non vides et non null
function emptyFieldsConnexion(string $log, string $pass) :bool 
{
    if(!isset($log) || !isset($pass)) {
        return false;
    } elseif ($log === '' || $pass === '') {
        return false;
    } else {
        return true;
    }
}

//Vérifie que le mot de passe en paramètre ne fasse pas plus de 25 caractères
function passwordLength(string $pass): bool
{
    if(strlen($pass) < 25) {
        return true;
    } else {
        return false;
    }
}

//Verifications des champs de connexion via les 3 fonctions ci-dessus
function connexionVerifications(string $log, string $pass):bool 
{
    if(emptyFieldsConnexion($log, $pass) && emailVerify($log) && passwordLength($pass)) {
        return true;
    } else {
        return false;
    }
}

//Vérifie que les champs en paramètres sont non vides et non null
function emptyFieldsInscription(string $log, string $pass, int $guests) :bool 
{
    if(!isset($log) || !isset($pass) || !isset($guests)) {
        return false;
    } elseif ($log === '' || $pass === '') {
        return false;
    } else {
        return true;
    }
}

//Vérifie que le chiffre en paramètres en est bien un et qu'il est compris entre 1 et 10
function typeGuestsVerify(int $guests): bool
{
    $pattern = '/^([1-9]|10)$/';
    if(preg_match($pattern, $guests)) {
        return true;
    } else {
        return false;
    }
}

//Vérifie que la chaîne de caractère en paramètre n'aille pas au delà de 150 caractères
function allergiesLength(string $allergy): bool 
{
    if(strlen($allergy) <= 150) {
        return true;
    } else {
        return false;
    }
}

//Vérification des champs d'inscriptions via les 3 fonctions ci-dessus ainsi que passwordLength()
function inscriptionVerifications(string $log, string $pass, int $guests, string $allergies): bool 
{
    if(emptyFieldsInscription($log,$pass,$guests) && passwordLength($pass) && typeGuestsVerify($guests) && allergiesLength($allergies) && emailVerify($log)) {
        return true;
    } else {
        return false;
    }
}

//Vérification du poids du fichier en paramètres (pas plus de 3Mo)
function fileWeight(array $file): bool 
{
    if($file['size'] <= 3145728){
        return true;
    } else {
        return false;
    }
}

//Vérification du type Mime de l'image en paramètre
function fileMimeType(array $file): bool 
{
    if($file['type'] == "image/gif" 
    || $file['type'] == "image/jpeg"
    || $file['type'] == "image/jpg"
    || $file['type'] == "image/png") 
    {
        return true;
    } else {
        return false;
    }
}

//Vérification de l'extension de l'image en paramètre
function fileExtension(array $file): bool
{
    if(preg_match('/\.(jpg|gif|png|jpeg)$/',$file['name'])) 
    {
        return true;
    } else {
        return false;
    }
}

//Vérification de la présence du code d'erreur de l'image en paramètre
function imageError(array $file): bool 
{
    if($file['error'] == 0) {
        return true;
    } else {
        return false;
    }
}

//Remplacement des espaces par un tiret
function dashSeparator(string $title): string
{
    $finaltitle = str_replace(" ", "-", $title);
    return $finaltitle;
}

//Vérifie que les heures en paramètres correspondent au format voulu
function checkRegexHour(string $text): bool 
{
    $pattern = '/^[0-9]{2}:[0-9]{2}-[0-9]{2}:[0-9]{2}$/';
    if(preg_match($pattern, $text)) {
       return true;
    } else {
        return false;
    }
}

//Espacement du tiret de séparation des heures
function spaceSeparator(string $text): string 
{
    $finalhour = str_replace("-", " - ", $text);
    return $finalhour;
}

//Modification des heures du midi après avoir vérifié le format de celles-ci et augmenté leurs espacement
function hoursNoon(string $hours, object $database, int $day) 
{
    if(checkRegexHour($hours)) {
        $hourFinal = spaceSeparator($hours);
        $database->hoursModificationNoon($hourFinal, $day);
    } else {
        echo 'Champ vides';
    }
}

//Modification des heures du soir après avoir vérifié le format de celles-ci et augmenté leurs espacement
function hoursEvening(string $hours, object $database, int $day) 
{
    if(checkRegexHour($hours)) {
        $hourFinal = spaceSeparator($hours);
        $database->hoursModificationEvening($hourFinal, $day);
    } else {
        echo 'champs vides';
    }
}

//Ajout d'un zéro au chiffre en paramètre s'il coreespond à 00 car sinon à l'affichage cela donne par exemple 13:0 et non 13:00
function addZero(string $number)
{
    if($number == 00) {
      $newNumber = str_pad($number, 2, '0', STR_PAD_RIGHT);
      return $newNumber;
    } else {
      return $number;
    }
}

//Affichage des boutons radio correspondant aux heures disponibles pour la page de réservation
function loopReservationHours(string $hourMin, string $hourMax, string $minuteMin, string $minuteMax) 
{
    $loop = true;
    //On enlève 1 heure à l'heure maximum car on ne peut que réserver jusqu'à 1 heure avant la fermeture 
    $limit = intval($hourMax) - 1;

    while($loop) {
        //On vérifie si l'heure maximale a été atteinte
        if($hourMin == $limit && $minuteMin == $minuteMax) {
            $loop = false;
        } 

        //On affiche pour chaque heure son label et son bouton radio
        echo '<label>'.$hourMin.':'.addZero($minuteMin).'</label>';
        echo '<input type="radio" name="hour" required value='.$hourMin.':'.addZero($minuteMin).'>';
        
        //On incrémente les minutes de 15 en 15
        $minuteMin += 15;

        //Arrivé à 60 minutes, on change d'heure
        if($minuteMin == 60) {
            $hourMin += 1;
            $minuteMin = 00;
        } 

    
    }
}

//Vérifie que les champs donnés ne sont ni vides ni null
function emptyFieldsReservation(string $date, int $guests, string $hour) {
    if(!isset($date) || !isset($guests) || !isset($hour)) {
        return false;
    } elseif($date == '' || $guests == '' || $hour == '') {
        return false;
    } else {
        return true;
    }
}

//Vérifie que le nombre de convives récupérés est supérieur à 1 et inférieur à 10
function limitGuests(int $guests) 
{
    if($guests > 10 || $guests < 1) {
        return false;
    } else {
        return true;
    }
}

//On récupère les heures disponibles par tranche de 15 min en partant d'une heure de début à une heure de fin
function verifyHours(string $hourStart, string $minuteStart, string $hourEnd, string $minuteEnd)
{
  $loop = 1;
  //On enlève 1 heure à l'heure maximum car on ne peut que réserver jusqu'à 1 heure avant la fermeture 
  $hourEndLimit = intval($hourEnd) - 1;
  $startMin = intval($minuteStart);
  $hourMin = intval($hourStart);

  //Par défaut, on fait au maximum 20 tours de boucle afin d'éviter une boucle infinie si on ne trouve pas l'heure souhaitée
  while($loop < 20) {

    $hourStartComplete = $hourMin.':'.addZero($startMin);
    $hourEndComplete = $hourEndLimit.':'.$minuteEnd;
   
    //On récupère dans un tableau les heures récupérées
    $hours[] = $hourStartComplete;

    //On incrémente les minutes de 15 en 15
    $startMin += 15;

    //Arrivé à 60 minutes, on change d'heure
    if($startMin == 60) {
      $startMin = 0;
      $hourMin += 1;
    }

    //On arrête la boucle au bout de 20 tours ou si l'heure maximale a été atteinte
    if($hourStartComplete == $hourEndComplete || $loop == 20)     {
      return $hours;
    }

    //Incrémentation de la boucle
    $loop += 1;
  }
}