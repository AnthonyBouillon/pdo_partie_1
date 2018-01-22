<?php
/**
 * On essaie de se connecter  MySQL
 * Si il y a erreur, le script s'arrete et affiche un message d'erreur inexploitable pour l'utilisateur
 */
try {
    $database = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '789789');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
/**
 * Query : requête
 * fetch : rapporter
 * La variable $answer contient la réponse de MySQL ci-dessus
 * Je sélectionne les colonnes qui contient nom et prénom de la table clients qui possédent une carte de fidélité
 * Et je demande de récupérer chaque ligne de ceci
 */
$answer = $database->query('SELECT id, lastName, firstName FROM clients WHERE card = 1');
$data = $answer->fetchAll();
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

