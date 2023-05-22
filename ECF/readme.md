Création d'un administrateur :
-Création de la table 'admins' dans la base de données.
-Création d'un fichier php.
-Connexion à la base de données via PDO.
-Insertion des données dans la table 'admins' => 'INSERT INTO admins VALUE (UUID(), :email, :password)'.
-UUID(): Génération de l'id de l'administrateur par la base de données via cette commande disponible avec MySql.
-:email : Ajout de l'email de l'utilisateur.
-:password : Mot de passe de l'utilisateur auquel on applique un hachage via 'password_hash' avant de le stocker dans la base de données.
-On lie ces différents paramètres à la requête via 'bindValue'.
-Envoi de l'instruction sql à la base de données via 'execute()'.


Exécution en local:
-Mise en route du serveur local.
-Création et alimentation des tables de la base de données via les scripts SQL fournis.
-Dans le fichier Database.php placé dans le dossier 'Models', modifier l'objet PDO dans le __construct() avec les informations correspondant à sa base de données locale.
-Dans le fichier javascript places.js, modifier si nécessaire l'adresse de la requete XML
-Une fois ceci fait, le site est prêt. 