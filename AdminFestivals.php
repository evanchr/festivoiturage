<?php
session_start();

use DAO\FestivalDAO;

require_once 'DAO/FestivalDAO.php';

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
            <li class="active"><a href="AdminFestivals.php">Festivals</a></li>
            <li><a href="AdminUsers.php">Utilisateurs</a></li>
            <li><a href="AdminAdmins.php">Administrateurs</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="table">
            <table>
                <caption>Liste des festivals</caption>
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
                                <p class='messageText'>Le festival " . $_GET['supp'] . " a bien été supprimé.</p>
                                <button class='close-button' onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['ajout'])) {
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le festival " . $_GET['ajout'] . " a bien été ajouté.</p>
                                <button class='close-button' onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                ?>
                <tr>
                    <th>Nom</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Ville</th>
                    <th>Photo</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                $festivals = FestivalDAO::listeAll();
                foreach ($festivals as $festival) {
                    echo "<tr>";
                    echo "<td>" . $festival['nom'] . "</td>";
                    echo "<td>" . $festival['dateDebut'] . "</td>";
                    echo "<td>" . $festival['dateFin'] . "</td>";
                    echo "<td>" . $festival['localisation'] . "</td>";
                    echo "<td><img src='" . $festival['cheminPhoto'] . "' alt='" . $festival['nom'] . "' class='photosFestivals'></td>";
                    echo "<td><a href='ModificationFestival.php?nom=" . $festival['nom'] . "'><img src='Images/Stylo.png' alt='bouton modifier' class='modifier'></a></td>";
                    echo "<td><a href='ValidationSuppressionFestival.php?nom=" . $festival['nom'] . "'><img src='Images/Supp.png' alt='bouton supprimer' class='modifier'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div id="boutonsMembre">
            <a href="AjoutFestival.php"><input class="envoi" type="submit" value="Ajouter un festival"></a>
        </div>
        <hr>
    </div>
</body>