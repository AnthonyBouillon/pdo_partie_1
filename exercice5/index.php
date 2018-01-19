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
 * Je sélectionne les colonnes qui contient nom et prénom de la table clients dont le nom commencent par un "M" par ordre alphabétique
 * Et je demande de récupérer chaque ligne de ceci
 */
$answer = $database->query('SELECT lastName, firstName FROM clients WHERE lastName LIKE  "M%" ORDER BY lastName ASC');
$data = $answer->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <title>Afficher les clients qui commencent par la lettre "M"</title>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="../exercice1/">Exercice 1</a></li>
                    <li><a href="../exercice2/">Exercice 2</a></li>
                    <li><a href="../exercice4/">Exercice 3</a></li>
                    <li><a href="../exercice4/">Exercice 4</a></li>
                    <li class="active"><a href="#">Exercice 5</a></li>
                    <li><a href="../exercice6/">Exercice 6</a></li>
                    <li><a href="../exercice7/">Exercice 7</a></li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">La liste des clients dont les noms commencent part la lettre "M"</h1><hr/>
        <div class="container">
            <div class="row">     
                <?php
                /* J'affiche tous les noms et prénoms commencant part "M" */
                foreach ($data as $clients) {
                    ?>
                    <p class="col-lg-offset-1 col-lg-3">
                        <span class="bold">Nom : </span><?= $clients['lastName'] ?>
                        <br/>
                        <span class="bold">Prénom : </span><?= $clients['firstName'];
                        ?>
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

