<?php
session_start();

use DAO\FestivalierDAO;

require_once 'DAO/FestivalierDAO.php';

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
    <title>Festi'Covoit - Annonces</title>
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
            if (isset($_GET['ajout'])) {
                echo "<div id='idBox' class='messageBox'>
                        <div class='messageBoxContent'>
                            <p class='messageText'>L'annonce de " . $_GET['ajout'] . " a bien été publiée.</p>
                            <button onclick='closeBox()'>Fermer</button>
                        </div>
                    </div>";
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
        <a href="PageVehicules.php">
            <h4>Trouver un véhicule</h4>
        </a>
        <a href="PageAnnonces.php">
            <h4>Toutes les annonces</h4>
        </a>
        <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
            echo '<a href="AdminFestivals.php">
                    <h4>Gérer</h4>
                  </a>';
        }
        ?>
    </div>

    <p class="intro">Ici vous pouvez poster une annonce indiquant que vous êtes à la recherche d'un véhicule et les propriétaires de véhicules peuvent alors vous contacter en sélectionnant votre annonce. </br>
        Sur Festi'Covoit, la réservation est complétement gratuite, mais vous pouvez bien-sûr préciser dans votre annonce si vous souhaitez diviser les frais entre tous les passagers.<br>
        Si vous souhaitez consulter toutes vos annonces, cliquez sur votre pseudo en haut à droite.</p>

    <h2>Liste des annonces de festivaliers :</h2>
    <div class="grid-container">
        <?php
        $festivaliers = FestivalierDAO::listeAll();
        foreach ($festivaliers as $festivalier) {
            echo "<div class='card'>";
            echo "<div class='card-info'>";
            echo "<img src='Images/Festivaliers.png' alt='icone festivalier'>";
            echo "<h3>" . $festivalier['prenom'] . " " . $festivalier['nom'] . "</h3>";
            echo "<h4>Festival concerné : " . $festivalier['festival'] . "</h4>";
            echo "<p><b>Âge : </b>" . $festivalier['age'] . " ans</p>";
            echo "<p><b>Genre : </b>" . $festivalier['genre'] . "</p>";
            echo "<p><b>Départ : </b>" . $festivalier['ville'] . " le " . $festivalier['dateAller'] . "</p>";
            if ($festivalier['dateRetour'] != "0000-00-00") {
                echo "<p><b>Retour le : </b>" . $festivalier['dateRetour'] . "</p>";
            }
            echo "<p><b>Détails de l'annonce : </b>" . $festivalier['description'] . "</p>";
            echo "<div class='boutonsannonce'>";
		    echo "<a href='PageFestivaliers.php?reserver=oui'><input class='envoi' type='submit' value='Réserver'></a>";
			echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <a href="AjoutFestivalier.php"><input class="creation-annonce" type="submit" name="supprimer" value="Créer une annonce festivalier"></a>

</body>

</html>