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
    <div class="sidebar">
        <a href="Home.php">
            <h3>Festi'Covoit</h3>
        </a>
        <ul>
            <li><a href="AdminFestivals.php">Festivals</a></li>
            <li class="active"><a href="AdminUsers.php">Utilisateurs</a></li>
            <li><a href="AdminAdmins.php">Administrateurs</a></li>
        </ul>
    </div>
    <div class="content">
        <table>
            <caption>Liste des utilisateurs</caption>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Âge</th>
                <th>Pseudo</th>
            </tr>
            <?php
            $users = UserDAO::listeAllUser();
            foreach ($users as $user) {
                echo "<tr>";
                    echo "<td>".$user['nom']."</td>";
                    echo "<td>".$user['prenom']."</td>";
                    echo "<td>".$user['age']."</td>";
                    echo "<td>".$user['pseudo']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>