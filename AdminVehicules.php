<?php
session_start();

use DAO\VehiculeDAO;

require_once 'DAO/VehiculeDAO.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style.php" media="all">
    <title>Festi'Covoit - Admin</title>
</head>

<body>
    <script>
        // Fonction pour fermer les fenêtres de messages
        function closeBox() {
            var box = document.getElementById('idBox');
            box.style.display = 'none';
        }
    </script>
    <div class="sidebar">
        <a href="Home.php">
            <h3>Festi'Covoit</h3>
        </a>
        <ul>
            <li><a href="AdminFestivals.php">Festivals</a></li>
            <li><a href="AdminUsers.php">Utilisateurs</a></li>
            <li><a href="AdminAdmins.php">Administrateurs</a></li>
            <li class="active"><a href="AdminVehicules.php">Annonces véhicules</a></li>
            <li><a href="AdminFestivaliers.php">Annonces festivaliers</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="table">
            <table>
                <caption>Liste des annonces de véhicules</caption>
                <?php
                if (isset($_GET['erreur'])) {
                    if ($_GET['erreur'] == 1) {
                        echo '<i>Ce festival n\'existe pas donc vous ne pouvez pas le supprimer.</i>'; //impossible en théorie
                    } else if ($_GET['erreur'] == 2) {
                        echo '<i>La suppression a échoué pour une raison inconnue.</i>';
                    }
                }
                if (isset($_GET['supp'])) { //message de confirmation de la suppression du festival
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le véhicule " . $_GET['supp'] . " a bien été supprimé.</p>
                                <button onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['ajout'])) {
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le véhicule " . $_GET['ajout'] . " a bien été ajouté.</p>
                                <button onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['confirmer'])){
                    echo "<div class='messageBoxContent'>
                    <p class='messageText'>Voulez-vous vraiment supprimer le véhicule ".$_GET['confirmer']." ?</p>
                    <a href='ValidationSuppressionVehicule.php?id=".$_GET['confirmer']."&confirmer=oui'>Oui</a>
                    <a href='AdminVehicules.php'>Annuler</a>
                  </div>";
                }
                ?>
                <tr>
                    <th>ID</th>
                    <th>Modèle</th>
                    <th>Places</th>
                    <th>Ville</th>
                    <th>Festival</th>
                    <th>Date aller</th>
                    <th>Date retour</th>
                    <th>Description</th>
                    <th>Propriétaire</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                $vehicules = VehiculeDAO::listeAll();
                foreach ($vehicules as $vehicule) {
                    echo "<tr>";
                    echo "<td>" . $vehicule['id'] . "</td>";
                    echo "<td>" . $vehicule['type'] . "</td>";
                    echo "<td>" . $vehicule['places'] . "</td>";
                    echo "<td>" . $vehicule['ville'] . "</td>";
                    echo "<td>" . $vehicule['festival'] . "</td>";
                    echo "<td>" . $vehicule['dateAller'] . "</td>";
                    echo "<td>" . $vehicule['dateRetour'] . "</td>";
                    echo "<td>" . $vehicule['description'] . "</td>";
                    echo "<td>" . $vehicule['proprietaire'] . "</td>";
                    echo "<td><a href='ValidationSuppressionVehicule.php?id=" . $vehicule['id'] . "'><img src='Images/Supp.png' alt='bouton supprimer' class='modifier'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div id="boutonsMembre">
            <a href="AjoutVehicule.php"><input class="envoi" type="submit" value="Ajouter un vehicule"></a>
        </div>
    </div>
</body>