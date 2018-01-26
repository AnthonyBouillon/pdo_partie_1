<?php
// Je crée une variable query dans laquelle je mets ma requête SQL
$query = 'SELECT `clients`.`id`, `clients`.`lastName`, `clients`.`firstName`, DATE_FORMAT(`clients`.`birthDate`,"%d/%m/%Y") AS `birthDate`, `clients`.`card`, `clients`.`cardNumber` 
FROM `clients` 
INNER JOIN `cards`
ON `clients`.`cardNumber` = `cards`.`cardNumber`
INNER JOIN `cardTypes`
ON `cards`.`cardTypesId` = `cardTypes`.`id`
WHERE `cardTypes`.`id` = 1;';
// On fait un try catch pour être sûr que la connexion à mysql se fasse
try {
    // On instancie un objet PDO. Le host est l'adresse locale sur laquelle on se connecte. dbname correspond au nom de la base de données.
    $db = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '789789');
} catch (Exception $ex) { // On attrape l'exception, qui est une erreur de PHP
    // Die arrête le script PHP en cas d'erreur et affiche ce qu'on lui met en paramètre
    die('Erreur : ' . $ex->getMessage());
}
// Gràce à ->query($query) on éxécute la requête SQL et on récupère un objet PDO Statement
$customersResult = $db->query($query);
/* fetchAll() va retourner le résultat sous la forme du paramètre demandé
 * PDO::FETCH_ASSOC est le paramètre qui permet d'avoir un tableau associatif. Les clés sont les noms des colonnes de la table
 */
$customersList = $customersResult->fetchAll(PDO::FETCH_ASSOC);
//on affecte NULL à l'objet PDO pour fermer la conexion à la base de donnée. 
$db = NULL;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <title>N'afficher que les clients possédant une carte de fidélité</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="../exercice1/">Exercice 1</a></li>
                    <li><a href="../exercice2/">Exercice 2</a></li>
                    <li><a href="../exercice4/">Exercice 3</a></li>
                    <li class="active"><a href="#">Exercice 4</a></li>
                    <li><a href="../exercice5/">Exercice 5</a></li>
                    <li><a href="../exercice6/">Exercice 6</a></li>
                    <li><a href="../exercice7/">Exercice 7</a></li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">La liste des clients possédant une carte de fidélité</h1><hr/>
        <div class="container">
            <div class="row">     
                <?php
                /* J'affiche tous les noms et prénoms des 20 premiers clients */
                foreach ($data as $clients) {
                    ?>
                    <p class="col-lg-4">
                        <?php
                        echo $clients['lastName'] . ' ' . $clients['firstName'] . ' ' . ':' . ' ' . 'possède la carte de fidélité';
                        ?>
                    </p>
                    <?php
                }
                /* Ferme la requête */
                $answer->closeCursor();
                ?>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>

