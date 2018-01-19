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
 * Je sélectionne les colonnes qui contient le titre, l'artiste et la date qui est au format français de la table shows dont le titre est par ordre alphabétique
 * Et je demande de récupérer chaque ligne de ceci
 */
$answer = $database->query('SELECT title, performer, DATE_FORMAT(date, \'%d/%m/%Y\') AS date_fr, startTime FROM shows ORDER BY title ASC;');
$data = $answer->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <title>Afficher le titre de tous les spectacles</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="../exercice1/">Exercice 1</a></li>
                    <li><a href="../exercice2/">Exercice 2</a></li>
                    <li><a href="../exercice4/">Exercice 3</a></li>
                    <li><a href="../exercice4/">Exercice 4</a></li>
                    <li><a href="../exercice5/">Exercice 5</a></li>
                    <li class="active"><a href="#">Exercice 6</a></li>
                    <li><a href="../exercice7/">Exercice 7</a></li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">Afficher le titre de tous les spectacles ainsi que l'artiste et la date complète</h1><hr/>
        <div class="container">
            <div class="row">     
                <?php
                /* J'affiche les titres, artistes, la date et l'heure au format français */
                foreach ($data as $identity) {
                    ?>
                    <p class="col-lg-offset-1 col-lg-5">
                        <?= $identity['title'] . '  ' . 'par' . ' ' . $identity['performer'] . ', ' . 'le' . ' ' . $identity['date_fr'] . ' ' . 'à' .  ' ' . $identity['startTime'];     ?>
                    </p>
                    <?php
                }
                /* Ferme la requête */
                $answer->closeCursor();
                ?>
            </div>
        </div>
        <style>
            .bold{
                font-weight: bold;
            }
        </style>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>

