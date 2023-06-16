<?php
session_start();

use DAO\FestivalierDAO;

require_once 'DAO/FestivalierDAO.php';

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
            <li><a href="AdminVehicules.php">Annonces véhicules</a></li>
            <li class="active"><a href="AdminFestivaliers.php">Annonces festivaliers</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="table">
            <table>
                <caption>Liste des annonces de festivaliers</caption>
                <?php
                if (isset($_GET['erreur'])) {
                    if ($_GET['erreur'] == 1) {
                        echo '<i>Ce festivalier n\'existe pas donc vous ne pouvez pas le supprimer.</i>'; //impossible en théorie
                    } else if ($_GET['erreur'] == 2) {
                        echo '<i>La suppression a échoué pour une raison inconnue.</i>';
                    }
                }
                if (isset($_GET['supp'])) { //message de confirmation de la suppression du festival
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le festivalier " . $_GET['supp'] . " a bien été supprimé.</p>
                                <button onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['ajout'])) {
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le festivalier " . $_GET['ajout'] . " a bien été ajouté.</p>
                                <button onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['confirmer'])){
                    echo "<div class='messageBoxContent'>
                    <p class='messageText'>Voulez-vous vraiment supprimer le festivalier ".$_GET['confirmer']." ?</p>
                    <a href='ValidationSuppressionFestivalier.php?id=".$_GET['confirmer']."&confirmer=oui'>Oui</a>
                    <a href='AdminFestivaliers.php'>Annuler</a>
                  </div>";
                }
                ?>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Age</th>
                    <th>Genre</th>
                    <th>Festival</th>
                    <th>Ville</th>
                    <th>Date aller</th>
                    <th>Date retour</th>
                    <th>Description</th>
                    <th>Créateur</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                $festivaliers = FestivalierDAO::listeAll();
                foreach ($festivaliers as $festivalier) {
                    echo "<tr>";
                    echo "<td>" . $festivalier['id'] . "</td>";
                    echo "<td>" . $festivalier['nom'] . "</td>";
                    echo "<td>" . $festivalier['prenom'] . "</td>";
                    echo "<td>" . $festivalier['age'] . "</td>";
                    echo "<td>" . $festivalier['genre'] . "</td>";
                    echo "<td>" . $festivalier['festival'] . "</td>";
                    echo "<td>" . $festivalier['ville'] . "</td>";
                    echo "<td>" . $festivalier['dateAller'] . "</td>";
                    echo "<td>" . $festivalier['dateRetour'] . "</td>";
                    echo "<td>" . $festivalier['description'] . "</td>";
                    echo "<td>" . $festivalier['createur'] . "</td>";
                    echo "<td><a href='ValidationSuppressionFestivalier.php?id=" . $festivalier['id'] . "'><img src='Images/Supp.png' alt='bouton supprimer' class='modifier'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div id="boutonsMembre">
            <a href="AjoutFestivalier.php"><input class="envoi" type="submit" value="Ajouter un festivalier"></a>
        </div>
    </div>
</body>