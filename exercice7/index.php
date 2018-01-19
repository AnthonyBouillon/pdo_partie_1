<?php
/*
 * Connexion à la base de donnée colyseum
 * Récupère les erreurs dans catch pour plus de sécurité
 */
try {
    $database = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '789789');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
/*
 * Selectionne les colonnes voulu dans la table client
 */
$answer = $database->query('SELECT lastName, firstName,  DATE_FORMAT(birthDate, \'%d/%m/%Y\') AS birthDate_fr, card, cardNumber FROM clients;');
$data = $answer->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <title>Dernier exercice de la partie 1</title>
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
                    <li><a href="../exercice6/">Exercice 6</a></li>
                    <li class="active"><a href="#">Exercice 7</a></li>
                    <li><a href="../../pdo_partie_2/exercice1/">Partie 2</a></li>
                </ul>
            </div>
        </nav>
        <h1 class="text-center">Afficher les données : Nom, Prénom, date de naissance, carte, numéro de carte</h1><hr/>
        <div class="container-fluid">
            <div class="row">     
                <?php
                /*
                 * Si la carte existe (1) donc afficher Oui. Sinon (0) afficher Non.
                 * Affiches les données des colonnes voulu
                 */
                foreach ($data as $identity) {
                    if($identity['card'] == 1){
                        $identity['card'] =  'Oui';
                    } else{
                        $identity['card'] = 'Non';
                    }
                    ?>
                    <p class="col-lg-2">
                        <span class="bold">Nom : </span><?= $identity['lastName']; ?><br/>
                        <span class="bold">Prénom : </span><?= $identity['firstName']; ?><br/>
                        <span class="bold">Date de naissance : </span><?= $identity['birthDate_fr']; ?><br/>
                        <span class="bold">Carte de fidélité : </span><?= $identity['card']; ?><br/>
                        <span class="bold">Numéro de carte : </span><?= $identity['cardNumber']; ?>
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
