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
            <li><a href="AdminUsers.php">Utilisateurs</a></li>
            <li class="active"><a href="AdminAdmins.php">Administrateurs</a></li>
            <li><a href="AdminVehicules.php">Annonces véhicules</a></li>
            <li><a href="AdminFestivaliers.php">Annonces festivaliers</a></li>
        </ul>
    </div>
    <div class="content">
        <table>
            <caption>Liste des administrateurs</caption>
            <?php
            if (isset($_GET['ajout'])) {
                echo "<div id='idBox' class='messageBox'>
                        <div class='messageBoxContent'>
                            <p class='messageText'>Le compte " . $_GET['ajout'] . " a bien été ajouté en tant qu'administrateur.</p>
                            <button class='close-button' onclick='closeBox()'>Fermer</button>
                        </div>
                    </div>";
            }
            ?>
            <tr>
                <th>Pseudo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
            </tr>
            <?php
            $users = UserDAO::listeAllAdmin();
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $user['pseudo'] . "</td>";
                echo "<td>" . $user['nom'] . "</td>";
                echo "<td>" . $user['prenom'] . "</td>";
                echo "<td>" . $user['age'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <div id="boutonsMembre">
        <a href="AjoutUser.php?admin=oui"><input class="envoi" type="submit" value="Ajouter un administrateur"></a>
    </div>
    </div>
</body>

</html>