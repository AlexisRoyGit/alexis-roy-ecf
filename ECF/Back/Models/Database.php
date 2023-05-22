<?php
//Classe représentant les différentes interactions avec la base de données

class Database 
{
    private $pdo;

    //Déclaration du PDO utilisé dans tout le code
    public function __construct()
    {
      $this->pdo = new PDO('mysql:host=localhost;port=8889;dbname=restaurant', 'root', 'root'); 
    }

    /*Vérification de l'email et mot de passe rentré pour la connexion d'un client, si succès, 
    ses informations sont enregistrées dans des variables de Session et il sera redirigé vers la page d'accueil*/
    public function connexionClient(string $email, string $password) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM clients WHERE email_client = :email');
            $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Clients');
            if($pdoStatement->execute()) {
                while($client = $pdoStatement->fetch()) {
                    $pass = $client->getPasswordClient();
                    if(password_verify($password, $pass)) {
                        session_start();
                        $_SESSION['guests'] = $client->getNumberGuests();
                        $_SESSION['allergies'] = $client->getAllergies();
                        header('Location: ../Vue/index.php');
                    }
                }
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier les identifiants rentrés et réessayez');
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
        }
    }

    /*Vérification de l'email et mot de passe rentré pour la connexion d'un administrateur, si succès, 
    son id est enregistré dans une variable de Session et il sera redirigé vers la page d'accueil*/
    public function connexionAdmin(string $email, string $password) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM admins WHERE email_admin = :email');
            $pdoStatement->bindValue(':email', $email, PDO::PARAM_STR);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Admins');
            if($pdoStatement->execute()) {
                while($admin = $pdoStatement->fetch()) {
                    $pass = $admin->getPasswordAdmin();
                    if(password_verify($password, $pass)) {
                        session_start();
                        $_SESSION['adminIdentity'] = $admin->getIdAdmin();
                        header('Location: ../Vue/index.php');
                    }
                }
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier les identifiants rentrés et réessayez');
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    //On vérifie que l'id administrateur correspond bien à un id existant dans la base (voir page administration.php)
    public function verifyAccessAdmin(string $id) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM admins WHERE id_admin = ?');
            $pdoStatement->bindValue(1, $id, PDO::PARAM_STR);
            if($pdoStatement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /*Création d'un client via les données rentrées dans le formulaire d'inscription et insérées dans la base. Le client 
    devra ensuite se connecter en rentrant ses identifiants dans le formulaire de connexion*/
    public function creationClient(string $email, string $password, int $guests, string $allergies) 
    {

        try {
            $pdoStatement = $this->pdo->prepare('INSERT INTO clients VALUES (UUID(), ?, ?, ?, ?)');
            $newPass = password_hash($password, PASSWORD_BCRYPT);
            $pdoStatement->bindValue(1, $email, PDO::PARAM_STR);
            $pdoStatement->bindValue(2, $newPass, PDO::PARAM_STR);
            $pdoStatement->bindValue(3, $guests, PDO::PARAM_INT);
            if(isset($allergies) && $allergies !== '') {
                $pdoStatement->bindValue(4, $allergies, PDO::PARAM_STR);
            } else {
                $pdoStatement->bindValue(4, null, PDO::PARAM_NULL);
            }
            if($pdoStatement->execute()) {
                echo "Félicitation votre compte client a bien été créé ! <br>";
                echo "Connectez-vous maintenant avec vos identifiants <br>";
                echo "<a href='../Vue/connexion.html'>Se connecter</a>";
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier les infos rentrées et réessayez');
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Vérifie lors d'une inscription si l'email rentrée ne correspond pas déjà à un compte client existant
    public function preventDuplicationCreation(string $email) 
    {

        try {
                $pdoStatement = $this->pdo->prepare('SELECT id_client FROM clients WHERE email_client = ?');
                $pdoStatement->bindValue(1, $email, PDO::PARAM_STR);
                if($pdoStatement->execute()) {
                    $test = $pdoStatement->fetch(PDO::FETCH_ASSOC);
                    $mail = $test['id_client'] ?? null;
                    if($mail) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    echo "Une erreur est survenue, veuillez vérifier les données entrées";
                }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Ajout des informations d'une image en base de données via le formulaire d'ajout d'image disponible pour les administrateurs 
    public function addImage(string $title, string $name) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('INSERT INTO images_courses(title, name) VALUES (?,?)');
            $pdoStatement->bindValue(1, $title, PDO::PARAM_STR);
            $pdoStatement->bindValue(2, $name, PDO::PARAM_STR);
            if( $pdoStatement->execute()) {
                echo 'Image insérée avec succès';
            } else {
                throw new Exception('Une erreur est survenue, veuillez réessayer ultérieurement');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification des informations d'une image en base de données via le formulaire de modification disponible pour les administrateurs 
    public function modifyImage(string $title, string $name) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE images_courses SET name = ? WHERE title = ?');
            $pdoStatement->bindValue(1, $name, PDO::PARAM_STR);
            $pdoStatement->bindValue(2, $title, PDO::PARAM_STR);
            if( $pdoStatement->execute()) {
                echo "Modification réussie";
            } else {
                throw new Exception('Une erreur est survenue, veuillez réessayer ultérieurement');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Suppression des informations d'une image en base de données via le formulaire de suppression disponible pour les administrateurs 
    public function deleteImageDatabase(string $title) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('DELETE FROM images_courses WHERE title = ?');
            $pdoStatement->bindValue(1, $title, PDO::PARAM_STR);
            if( $pdoStatement->execute()) {
                echo 'Image supprimée de la base de données avec succès';
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier le titre de l\' image rentrée');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Récupération en base de données du nom de l'image à supprimer puis suppression de celle-ci du répertoire Images via unlink()
    public function deleteImageRepertory(string $titleImage) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT name FROM images_courses WHERE title = ?');
            $pdoStatement->bindValue(1, $titleImage, PDO::PARAM_STR);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Images_courses');
            if( $pdoStatement->execute()) {
                $image = $pdoStatement->fetch();
                unlink('../Vue/Images/'.$image->getImageName().'');
                echo 'Image supprimée avec succès du répertoire d\' images <br>';
            } else {
                throw new Exception('Une erreur est survenue,  veuillez vérifier le titre de l\' image rentrée');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification du booleen isClosed de la table hours en base de données pour indiquer que le restaurant est fermé le jour sélectionné
    public function restaurantClose(int $day) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE hours SET isClosed = 1 WHERE days = ?');
            $pdoStatement->bindValue(1, $day, PDO::PARAM_INT);
            if($pdoStatement->execute()) {
                echo 'Modifications prises en compte';
            } else {
                throw new Exception('Une erreur est survenue, veuillez réessayer');
            }
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification du booleen isClosed de la table hours en base de données pour indiquer que le restaurant est ouvert le jour sélectionné
    public function restaurantOpen(int $day) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE hours SET isClosed = 0 WHERE days = ?');
            $pdoStatement->bindValue(1, $day, PDO::PARAM_INT);
            if($pdoStatement->execute()) {
                echo 'Modifications prises en compte';
            } else {
                throw new Exception('Une erreur est survenue, veuillez réessayer');
            }
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification en base de données des horaires du midi selon le jour choisi via le formulaire disponible aux administrateurs
    public function hoursModificationNoon(string $hour, int $day)
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE hours SET hoursNoon = ? WHERE days = ?');
            $pdoStatement->bindValue(1, $hour, PDO::PARAM_STR);
            $pdoStatement->bindValue(2, $day, PDO::PARAM_INT);
            if($pdoStatement->execute()) {
                echo 'Changement d\'heures effectué';
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier les champs remplis');
            }
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification en base de données des horaires du soir selon le jour choisi via le formulaire disponible aux administrateurs
    public function hoursModificationEvening(string $hour, int $day)
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE hours SET hoursEvening = ? WHERE days = ?');
            $pdoStatement->bindValue(1, $hour, PDO::PARAM_STR);
            $pdoStatement->bindValue(2, $day, PDO::PARAM_INT);
            if($pdoStatement->execute()) {
                echo 'Changement d\'heures effectué';
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier les champs remplis');
            }
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification en base de données de la limite par défaut du restaurant via le formulaire disponible aux administrateurs
    public function capacityRestaurantModification(int $limit) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE reservation SET limit_capacity = ?;
            ALTER TABLE reservation MODIFY limit_capacity INT(3) NOT NULL DEFAULT ?;');
            $pdoStatement->bindValue(1, $limit, PDO::PARAM_INT);
            $pdoStatement->bindValue(2, $limit, PDO::PARAM_INT);

            if($pdoStatement->execute()) {
                echo 'La modification de la limite de capacité du restaurant a bien été prise en compte';
            } else {
                throw new Exception('Une erreur est survenue, veuillez vérifier les champs remplis');
            }
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Affichage en bas de page des horaires du restaurant
    public function hoursDisplay()
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM hours ORDER BY days');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Hours');
            if($pdoStatement->execute()) {
                while($hour = $pdoStatement->fetch()) {
                    if($hour->getIsClosed() !== true) {
                        echo '<p>'.$hour->getHoursNoon().'<br>'.$hour->getHoursEvening().'</p>';
                    } else {
                        echo '<p>Fermé</p>';
                    }      
                }
            }
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Affichage des images de plats via les informations en base de données permettant d'interagir avec le dossier Images
    public function imageDisplay() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT * FROM images_courses ORDER BY id_image');
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Images_courses');
            if( $pdoStatement->execute()) {
                while($image = $pdoStatement->fetch()) {
                    $title = $image->getImageTitle();
                    $newTitle = str_replace(' ', '&#32', $title);
                    echo '<a href=./Images/'.$image->getImageName().' target="_blank" ><img title='.$newTitle.' alt="Image des différents plats du restaurant" src=./Images/'.$image->getImageName().' class="plate-image"></a>';
                }
            } else {
                throw new Exception('Un erreur est survenue lors de l\'affichage des images, veuillez réessayer');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Récupération du jour correspondant à la date choisie
    public function dayOfReservation(string $date) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT WEEKDAY(?) as DAY');
            $pdoStatement->bindValue(1, $date, PDO::PARAM_STR);
            if( $pdoStatement->execute()) {
                $day = $pdoStatement->fetch(PDO::FETCH_ASSOC);
                return $day['DAY'] + 1;
            } else {
                throw new Exception('Une erreur est survenue veuillez réessayer');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Récupération en base de données des horaires du midi et du soir d'un jour donné
    public function hourReservationDay(int $day) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT hoursNoon, hoursEvening FROM hours WHERE days = ?');
            $pdoStatement->bindValue(1, $day, PDO::PARAM_INT);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Hours');
            if( $pdoStatement->execute()) {
                $hours = $pdoStatement->fetch();
                return [$hours->getHoursNoon(), $hours->getHoursEvening()];
            } else {
                throw new Exception('Une erreur est survenue veuillez réessayer');
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Affichage des boutons radio du formulaire de réservation allant de la plus petite à la plus grande heure possible pour la semaine
    public function displayButtonsReservation(int $dayOrNight) 
    {
        //Boutons correspondant aux heures du midi
        if($dayOrNight === 1) {
            try {
                $pdoStatement = $this->pdo->prepare('SELECT MIN(SUBSTR(hoursNoon, 1, 5)) as minimalHour, MAX(SUBSTR(hoursNoon,9, 5)) as maximalHour FROM hours WHERE hoursNoon IS NOT NULL');
                if($pdoStatement->execute()) {
                    $hours = $pdoStatement->fetch(PDO::FETCH_ASSOC);

                            //Découpage des données pour récuperer séparément l'heure minimale et maximale,la minute minimale et maximale
                            $min = $hours['minimalHour'];
                            $max = $hours['maximalHour'];

                            $hourMin = substr($min, -5 , 2);
                            $minuteMin = substr($min, -2, 2);
                            
                            $hourMax = substr($max, -5, 2);
                            $minuteMax = substr($max, -2, 2);
                        
                            //Boucle permettant de créer un bouton radio par tranche de 15 minutes jusqu'à l'heure maximale (voir fichier functions.php)
                            loopReservationHours($hourMin, $hourMax, $minuteMin, $minuteMax);   
                        
                } else {
                    throw new Exception('Une erreur est survenue veuillez réessayer');
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            //Boutons correspondant aux heures du soir
            try {
                $pdoStatement = $this->pdo->prepare('SELECT MIN(SUBSTR(hoursEvening, 1, 5)) as minimalHour, MAX(SUBSTR(hoursEvening,9, 5)) as maximalHour FROM hours WHERE hoursEvening IS NOT NULL');
                if( $pdoStatement->execute()) {
                    $hours = $pdoStatement->fetch(PDO::FETCH_ASSOC);

                            //Découpage des données pour récuperer séparément l'heure minimale et maximale,la minute minimale et maximale
                            $min = $hours['minimalHour'];
                            $max = $hours['maximalHour'];

                            $hourMin = substr($min, -5, 2);
                            $minuteMin = substr($min, -2, 2);
                            
                            $hourMax = substr($max, -5, 2);
                            $minuteMax = substr($max, -2, 2);

                            
                            //Boucle permettant de créer un bouton radio par tranche de 15 minutes jusqu'à l'heure maximale (voir fichier functions.php)
                            loopReservationHours($hourMin, $hourMax, $minuteMin, $minuteMax);
                } else {
                    throw new Exception('Une erreur est surveue veuillez réessayer');
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        
    }

    //Récupération de la limite de capacité en fonction de la date choisie
    public function getLimitReservationDate(string $date) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT MIN(limit_capacity) as limit_capacity FROM reservation WHERE date = ?');
            $pdoStatement->bindValue(1, $date, PDO::PARAM_STR);
            $pdoStatement->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
            if($pdoStatement->execute()) {
                $limit = $pdoStatement->fetch();

                if($limit !== false) {
                    return $limit->getLimitReservation();
                } else {
                    return null;
                }
                
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Récupération de la limite de capacité par défaut du restaurant
    public function limitCapacityDefault() 
    {
        try {
            $pdoStatement = $this->pdo->prepare('SELECT MAX(limit_capacity) AS limit_max FROM reservation');
            
            if($pdoStatement->execute()) {
                $limit = $pdoStatement->fetch(PDO::FETCH_ASSOC);
                return $limit['limit_max'];
            } 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Modification de la limite de capacité du restaurant à une date donnée en fonction du nombre de convives sélectionné
    public function modificationLimitWithNumberGuests(string $date, int $guests, int $limit) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('UPDATE reservation SET limit_capacity = ? WHERE date = ?');
            $pdoStatement->bindValue(1, $limit - $guests, PDO::PARAM_INT);
            $pdoStatement->bindValue(2, $date, PDO::PARAM_STR);
            
            if($pdoStatement->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //Enregistrement d'une réservation en base de données via le formlaire de réservation
    public function submitReservation(string $date, string $hour, int $guests, string $allergies) 
    {
        try {
            $pdoStatement = $this->pdo->prepare('INSERT INTO reservation(id_reservation, date, hour, guests, allergies) VALUES(UUID(),?,?,?,?)');
            $pdoStatement->bindValue(1, $date, PDO::PARAM_STR);
            $pdoStatement->bindValue(2, $hour, PDO::PARAM_STR);
            $pdoStatement->bindValue(3, $guests, PDO::PARAM_INT);
            
            if(isset($allergies) && $allergies !== '') {
                $pdoStatement->bindValue(4, $allergies, PDO::PARAM_STR);
            } else {
                $pdoStatement->bindValue(4, null, PDO::PARAM_STR);
            }

            if($pdoStatement->execute()) {
                echo 'Votre réservation a bien été enregistrée. Nous vous attendons avec impatience dans notre restaurant !';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}