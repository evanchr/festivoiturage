<?php
session_start();

use DAO\FestivalDAO;
use DAO\FestivalierDAO;
use DAO\VehiculeDAO;



require_once 'DAO/FestivalDAO.php';
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
    <script>
        // Fonction pour fermer les fenêtres de messages
        function closeBox() {
            var box = document.getElementById('idBox');
            box.style.display = 'none';
        }
    </script>

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
            if (isset($_GET['reserver'])) {
                echo "<div id='idBox' class='messageBox'>
                        <div class='messageBoxContent'>
                            <p class='messageText'>Ce site étant fictif, cette action ne peut être réalisée.</p>
                            <button class='close-button' onclick='closeBox()'>Fermer</button>
                        </div>
                    </div>";
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

    <form action="PageAnnonces.php" method="POST">
        <fieldset class="recherche">
            <legend>Critères de recherches</legend>
            <table>
                <tr>
                    <td width="50%">
                        <label for="festival" class="inscription">Festival : </label>
                        <select id="festival" name="festival" class="champ">
                            <option value="tous">Tous les festivals</option>
                            <?php
                            $festivals = FestivalDAO::listeAll();
                            foreach ($festivals as $festival) {
                                echo '<option value="' . $festival['nom'] . '">' . $festival['nom'] . '</option>';
                            }
                            ?>
                        </select>
                        <br>

                        <label for="ville" class="inscription">Ville de départ : </label>
                        <input id="ville" type="text" name="ville" minlength="2" placeholder="Rennes (35)" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" class="champ"><br>
                    </td>
                    <td>
                        <label for="vehicule" class="inscription">Annonces de véhicules : </label>
                        <input id="vehicule" type="radio" name="vehicule" class="champ" value="Oui" <?php if (isset($_POST['vehicule']) && $_POST['vehicule'] == "Oui") echo "checked"; ?>>Oui
                        <input id="vehicule" type="radio" name="vehicule" class="champ" value="Non" <?php if (isset($_POST['vehicule']) && $_POST['vehicule'] == "Non") echo "checked"; ?>>Non<br>

                        <label for="festivalier" class="inscription">Annonces de festivaliers : </label>
                        <input id="festivalier" type="radio" name="festivalier" class="champ" value="Oui" <?php if (isset($_POST['festivalier']) && $_POST['festivalier'] == "Oui") echo "checked"; ?>>Oui
                        <input id="festivalier" type="radio" name="festivalier" class="champ" value="Non" <?php if (isset($_POST['festivalier']) && $_POST['festivalier'] == "Non") echo "checked"; ?>>Non<br>
                    </td>
                </tr>
            </table>

            <input class="envoi" type="submit" name="envoyer" value="Rechercher">
        </fieldset>
    </form>

    <div class="grid-container">
        <?php
        foreach ($annonces as $annonce) {
            if (!isset($_POST['festival'])|| !isset($_POST['ville']) || $_POST['festival'] == "tous" || $_POST['festival'] == $annonce['festival'] && $_POST['ville'] == $annonce['ville']) {
                if (isset($annonce['type']) && (!isset($_POST['vehicule']) || $_POST['vehicule'] == "Oui")) {
                    // C'est une annonce de véhicule
                    echo "<div class='card'>";
                    echo "<div class='card-info'>";
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
                    echo "<div class='boutonsannonce'>";
                    echo "<a href='PageAnnonces.php?reserver=oui'><input class='envoi' type='submit' value='Réserver'></a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else if (isset($annonce['nom']) && (!isset($_POST['festivalier']) || $_POST['festivalier'] == "Oui")) {
                    // C'est une annonce de festivalier
                    echo "<div class='card'>";
                    echo "<div class='card-info'>";
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
                    echo "<div class='boutonsannonce'>";
                    echo "<a href='PageAnnonces.php?reserver=oui'><input class='envoi' type='submit' value='Réserver'></a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>
</body>

</html>