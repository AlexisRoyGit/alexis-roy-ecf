<?php
    require_once 'functions.php';
    require_once 'Models/Hours.php';
    require_once 'Models/Reservation.php';
    require_once 'Models/Database.php';

    $database = new Database();

    //Récupération des données rentrées dans le formulaire
    $date = $_POST['date'];
    $guests = intval(trim(htmlspecialchars($_POST['guests'])));
    $allergies = trim(htmlspecialchars($_POST['allergies']));
    $hour = $_POST['hour'];

    //Vérification que les champs sont non vides et que le nombre d'invités sélectionné est autorisé (voir functions.php)
    if(emptyFieldsReservation($date, $guests, $hour) && limitGuests($guests)) {

        //Récupération du jour correspondant à la date choisie
        $day = $database->dayOfReservation($date);
        //Récupération des heures disponibles du jour récupéré
        $hoursAuthorized = $database->hourReservationDay($day);

        //Découpage des heures récupérées en séparant les heures et minutes minimales/maximales pour le midi et le soir
        $hourStartNoon = substr($hoursAuthorized[0], -13 , 2);
        $minuteStartNoon = substr($hoursAuthorized[0], -10 , 2);
        $hourEndNoon = substr($hoursAuthorized[0], -5, 2 );
        $minuteEndNoon = substr($hoursAuthorized[0], -2, 2 );

        $hourStartEvening = substr($hoursAuthorized[1], -13 , 2);
        $minuteStartEvening = substr($hoursAuthorized[1], -10 , 2);
        $hourEndEvening = substr($hoursAuthorized[1], -5, 5 );
        $minuteEndEvening = substr($hoursAuthorized[1], -2, 5 );

        //On récupère les heures disponibles pour le midi et le soir du jour choisi (voir functions.php)
        $arrayNoon = verifyHours($hourStartNoon, $minuteStartNoon, $hourEndNoon, $minuteEndNoon); 
        $arrayEvening =  verifyHours($hourStartEvening, $minuteStartEvening, $hourEndEvening, $minuteEndEvening); 

        //Si aucune heure n'est retournée par verifyHours()
        if($arrayNoon == null && $arrayEvening == null) {
            throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
          //Si verifyHours() retourne uniquement des heures pour le soir
        } elseif($arrayNoon == null && $arrayEvening !== null){
            //Si l'heure sélectionnée par l'utilisateur correspond à une des heures disponibles du soir à la date chosie
            if(in_array($hour, $arrayEvening)){
                //On récupère la limite de place à la date choisie
                $limitGuest = $database->getLimitReservationDate($date);
                /*Si cette limite n'existe pas, on récupère celle par défaut, on envoie à la base de données 
                la réservation puis on modifie la limite en y soustreyant le nombre de convives sélectionné*/
                if($limitGuest == null) {
                    $limitGuest =  $database->limitCapacityDefault(); 
                    $database->submitReservation($date,$hour,$guests,$allergies);
                    $database->modificationLimitWithNumberGuests($date,$guests,$limitGuest);
                /*Sinon on modifie la limite de place en y soustreyant le nombre de convives sélectionné puis on 
                envoie à la base la réservation*/
                } elseif($limitGuest !== null && $limitGuest > 0) {
                    $database->modificationLimitWithNumberGuests($date,$guests,$limitGuest);
                    $database->submitReservation($date,$hour,$guests,$allergies);
                } else {
                    throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
                }
            } else {
                throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
            }
          //Si verifyHours() retourne uniquement des heures pour le midi
        } elseif($arrayNoon !== null && $arrayEvening == null){
            //Si l'heure sélectionnée par l'utilisateur correspond à une des heures disponibles du midi à la date chosie
            if(in_array($hour, $arrayNoon)){
                //On récupère la limite de place à la date choisie
                $limitGuest = $database->getLimitReservationDate($date);
                /*Si cette limite n'existe pas, on récupère celle par défaut, on envoie à la base de données 
                la réservation puis on modifie la limite en y soustreyant le nombre de convives sélectionné*/
                if($limitGuest == null) {
                    $limitGuest =  $database->limitCapacityDefault(); 
                    $database->submitReservation($date,$hour,$guests,$allergies);
                    $database->modificationLimitWithNumberGuests($date,$guests,$limitGuest);
                /*Sinon on modifie la limite de place en y soustreyant le nombre de convives sélectionné puis on 
                envoie à la base la réservation*/
                } elseif($limitGuest !== null && $limitGuest > 0) {
                    $database->modificationLimitWithNumberGuests($date,$guests,$limitGuest);
                    $database->submitReservation($date,$hour,$guests,$allergies);
                } else {
                    throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
                }
            } else {
                throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
            }
          //Si verifyHours() retourne des heures pour le midi et le soir
        } elseif($arrayNoon !== null && $arrayEvening !== null) {
            //Si l'heure sélectionnée par l'utilisateur correspond à une des heures disponibles du soir ou du midi à la date chosie
            if(in_array($hour, $arrayNoon) || in_array($hour, $arrayEvening)){
                //On récupère la limite de place à la date choisie
                $limitGuest = $database->getLimitReservationDate($date);
                /*Si cette limite n'existe pas, on récupère celle par défaut, on envoie à la base de données 
                la réservation puis on modifie la limite en y soustreyant le nombre de convives sélectionné*/
                if($limitGuest == null) {
                    $limitGuest =  $database->limitCapacityDefault(); 
                    $database->submitReservation($date,$hour,$guests,$allergies);
                    $database->modificationLimitWithNumberGuests($date,$guests,$limitGuest);
                /*Sinon on modifie la limite de place en y soustreyant le nombre de convives sélectionné puis on 
                envoie à la base la réservation*/
                } elseif($limitGuest !== null && $limitGuest > 0) {
                    $database->modificationLimitWithNumberGuests($date,$guests,$limitGuest);
                    $database->submitReservation($date,$hour,$guests,$allergies);
                } else {
                    throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
                }
            } else {
                throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
            }
        }
    } else {
        throw new Exception('Les champs saisis sont erronés, veuillez vérifier les données entreés');
    }
?>