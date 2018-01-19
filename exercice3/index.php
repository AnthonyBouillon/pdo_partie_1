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
 * Je sélectionne les colonnes qui contient l'id nom et prénom de la table clients par ordre id limité au 20 premiers
 * Et je demande de récupérer chaque ligne de ceci
 */
$answer = $database->query('SELECT id, lastName, firstName FROM clients ORDER BY id LIMIT 20');
$data = $answer->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <title>Afficher les 20 premiers clients</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="../exercice1/">Exercice 1</a></li>
                    <li><a href="../exercice2/">Exercice 2</a></li>
                    <li class="active"><a href="#">Exercice 3</a></li>
                    <li><a href="../exercice4/">Exercice 4</a></li>
                    <li><a href="../exercice5/">Exercice 5</a></li>
                    <li><a href="../exercice6/">Exercice 6</a></li>
                    <li><a href="../exercice7/">Exercice 7</a></li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">La liste des 20 premiers clients</h1><hr/>
        <div class="container">
            <div class="row">     
                <?php
                /* J'affiche tous les noms et prénoms des 20 premiers clients */
                foreach ($data as $clients) {
                    ?>
                    <p class="col-lg-2">
                        <?php
                        echo $clients['id'] . ' ' . $clients['lastName'] . ' ' . $clients['firstName'];
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

