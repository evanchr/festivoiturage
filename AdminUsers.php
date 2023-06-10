<?php
session_start();

use DAO\UserDAO;

require_once 'DAO/UserDAO.php';

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
            <li class="active"><a href="AdminUsers.php">Utilisateurs</a></li>
            <li><a href="AdminAdmins.php">Administrateurs</a></li>
            <li><a href="AdminVehicules.php">Annonces véhicules</a></li>
            <li><a href="AdminFestivaliers.php">Annonces festivaliers</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="table">
            <table>
                <caption>Liste des utilisateurs</caption>
                <?php
                if (isset($_GET['erreur'])) {
                    if ($_GET['erreur'] == 1) {
                        echo '<i>Ce compte n\'existe pas donc vous ne pouvez pas le supprimer.</i>'; //impossible en théorie
                    } else if ($_GET['erreur'] == 2) {
                        echo '<i>Vous ne pouvez pas supprimer un compte administrateur.</i>';
                    } else if ($_GET['erreur'] == 3) {
                        echo '<i>La suppression a échoué pour une raison inconnue.</i>';
                    }
                }
                if (isset($_GET['pseudo'])) { //message de confirmation de la suppression du festival
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le compte " . $_GET['pseudo'] . " a bien été supprimé.</p>
                                <button class='close-button' onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['ajout'])) {
                    echo "<div id='idBox' class='messageBox'>
                            <div class='messageBoxContent'>
                                <p class='messageText'>Le compte " . $_GET['ajout'] . " a bien été ajouté.</p>
                                <button class='close-button' onclick='closeBox()'>Fermer</button>
                            </div>
                        </div>";
                }
                if (isset($_GET['confirmer'])) {
                    echo "<div class='messageBoxContent'>
                    <p class='messageText'>Voulez-vous vraiment supprimer le compte " . $_GET['confirmer'] . " ?</p>
                    <a href='ValidationSuppressionUser.php?pseudo=" . $_GET['confirmer'] . "&confirmer=oui'>Oui</a>
                    <a href='AdminUsers.php'>Annuler</a>
                  </div>";
                }
                ?>
                <tr>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                    <th>Supprimer</th>
                </tr>
                <?php
                $users = UserDAO::listeAllUser();
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['pseudo'] . "</td>";
                    echo "<td>" . $user['nom'] . "</td>";
                    echo "<td>" . $user['prenom'] . "</td>";
                    echo "<td>" . $user['age'] . "</td>";
                    echo "<td><a href='ValidationSuppressionUser.php?pseudo=" . $user['pseudo'] . "'><img src='Images/Supp.png' alt='bouton supprimer' class='modifier'></a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div id="boutonsMembre">
            <a href="Inscription.php?"><input class="envoi" type="submit" value="Ajouter un utilisateur"></a>
        </div>
    </div>
</body>