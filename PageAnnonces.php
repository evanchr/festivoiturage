<?php
session_start();

use DAO\FestivalierDAO;
use DAO\VehiculeDAO;

require_once 'DAO/FestivalierDAO.php';
require_once 'DAO/VehiculeDAO.php';

// Obtention de toutes les annonces de festivaliers et de véhicules
$festivaliers = FestivalierDAO::listeAll();
$vehicules = VehiculeDAO::listeAll();

// Fusion des deux tableaux en un seul
$annonces = array_merge($festivaliers, $vehicules);

// Mélange aléatoire des annonces
shuffle($annonces);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="Style.php">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Festi'Covoit - Accueil</title>
</head>

<body>

    <div class="head">
        <h1>Festi'Covoit</h1>
        <div class="connexion">
            <?php if (isset($_SESSION['pseudo'])) {
                echo "<a href='Membre.php'><h4>";
                echo htmlentities(trim($_SESSION['pseudo']));
                if (isset($_SESSION['admin'])) {
                    echo " (admin)";
                }
                echo "</a></h4>";
            }
            if (!isset($_SESSION['pseudo'])) {
                echo '<a href="AjoutUser.php"><h4>S\'inscrire</h4></a>';
                echo '<h4> - </h4>';
                echo "<a href='Connexion.php'><h4>Connexion</h4></a>";
            }
            ?>
            <img src="Images/User.png" alt="bouton connexion">
        </div>
    </div>

    <div class="menu">
        <a href="Home.php">
            <h4>Accueil</h4>
        </a>
        <a href="PageFestivaliers.php">
            <h4>Trouver un festivalier</h4>
        </a>
        <a href="PageVehicules.php">
            <h4>Trouver un véhicule</h4>
        </a>
        <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
            echo '<a href="AdminFestivals.php">
                    <h4>Gérer</h4>
                  </a>';
        }
        ?>
    </div>

    <p class="intro">Vous pouvez retrouver ici toutes les annonces disponibles sur Festi'Covoit. Vous pouvez également affiner vos recherches en fonction de vos critères !<br>
        Si vous souhaitez consulter toutes vos annonces, cliquez sur votre pseudo en haut à droite.</p>

    <div class="grid-container">
        <?php
        foreach ($annonces as $annonce) {
            echo "<div class='card'>";
            echo "<div class='card-info'>";
            if (isset($annonce['type'])) {
                // C'est une annonce de véhicule
                echo "<img src='Images/Voiture.png' alt='icone voiture'>";
                echo "<h3>" . $annonce['type'] . "</h3>";
                echo "<h4>Festival concerné : " . $annonce['festival'] . "</h4>";
                echo "<p><b>Départ : </b>" . $annonce['ville'] . " le " . $annonce['dateAller'] . "</p>";
                if ($annonce['dateRetour'] != "0000-00-00") {
                    echo "<p><b>Retour le : </b>" . $annonce['dateRetour'] . "</p>";
                }
                echo "<p><b>Nombre de places disponibles : </b>" . $annonce['places'] . "</p>";
                echo "<p><b>Propriétaire du véhicule : </b>" . $annonce['proprietaire'] . "</p>";
                echo "<p><b>Détails de l'annonce : </b>" . $annonce['description'] . "</p>";
            } else {
                // C'est une annonce de festivalier
                echo "<img src='Images/Festivaliers.png' alt='icone festivalier'>";
                echo "<h3>" . $annonce['prenom'] . " " . $annonce['nom'] . "</h3>";
                echo "<h4>Festival concerné : " . $annonce['festival'] . "</h4>";
                echo "<p><b>Âge : </b>" . $annonce['age'] . " ans</p>";
                echo "<p><b>Genre : </b>" . $annonce['genre'] . "</p>";
                echo "<p><b>Départ : </b>" . $annonce['ville'] . " le " . $annonce['dateAller'] . "</p>";
                if ($annonce['dateRetour'] != "0000-00-00") {
                    echo "<p><b>Retour le : </b>" . $annonce['dateRetour'] . "</p>";
                }
                echo "<p><b>Détails de l'annonce : </b>" . $annonce['description'] . "</p>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>
