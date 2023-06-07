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
    <div class="sidebar">
    <a href="Home.php"><h3>Festi'Covoit</h3></a>
        <ul>
            <li class="active"><a href="AdminFestivals.php">Festivals</a></li>
            <li><a href="AdminUsers.php">Utilisateurs</a></li>
            <li><a href="AdminAdmins.php">Administrateurs</a></li>
        </ul>
    </div>
    <div class="content">
    <table>
            <caption>Liste des festivals</caption>
            <tr>
                <th>Nom</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Ville</th>
                <th>Photo</th>
            </tr>
            <?php
            $festivals = FestivalDAO::listeAll();
            foreach ($festivals as $festival) {
                echo "<tr>";
                    echo "<td>".$festival['nom']."</td>";
                    echo "<td>".$festival['dateDebut']."</td>";
                    echo "<td>".$festival['dateFin']."</td>";
                    echo "<td>".$festival['localisation']."</td>";
                    echo "<td><img src='".$festival['cheminPhoto']."' alt='".$festival['nom']."' class='photosFestivals'></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>