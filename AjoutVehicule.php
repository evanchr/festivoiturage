<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
	header('Location:Connexion.php');
	exit();
}

use DAO\FestivalDAO;

require_once 'DAO/FestivalDAO.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Style.php" media="all">
    <title>Festi'Covoit - Ajout d'un véhicule</title>
</head>

<body>
    <h1>Ajout d'une annonce véhicule</h1>

    <div class="menu">
        <a href="Home.php">
            <h4>Accueil</h4>
        </a>
        <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
            echo '<a href="AdminVehicules.php">
                    <h4>Gérer</h4>
                  </a>';
        }
        ?>
    </div>

    <form action="ValidationCreationVehicule.php" method="POST">
        <fieldset>
            <legend>Informations de l'annonce</legend>

            <label for="festival" class="inscription">Festival : </label>
            <select id="festival" name="festival" class="champ" required>
            <option value="">Sélectionnez un festival</option>
                <?php
                $festivals = FestivalDAO::listeAll();
                foreach ($festivals as $festival) {
                    echo '<option value="'.$festival['nom'].'">'.$festival['nom'].'</option>';
                }
                ?>
            </select>
            <br>

            <label for="type" class="inscription">Modèle de véhicule : </label>
            <input id="type" type="text" name="type" minlength="2" placeholder="Peugeot 208" class="champ" required autofocus><br>

            <label for="places" class="inscription">Nombre de places disponibles : </label>
            <input id="places" type="number" name="places" minlength="2" min="1" max="5" size="10" class="champ" required><br>

            <label for="ville" class="inscription">Ville de départ : </label>
            <input id="ville" type="text" name="ville" minlength="2" placeholder="Rennes (35)" class="champ" required><br>

            <label for="dateAller" class="inscription">Date de départ : </label>
            <input id="dateAller" type="date" name="dateAller" minlength="2" class="champ" required><br>

            <label for="dateRetour" class="inscription">Date de retour (facultatif) : </label>
            <input id="dateRetour" type="date" name="dateRetour" minlength="2" class="champ"><br>

            <label for="description" class="inscription"> Description : </label>
            <textarea id="description" name="description" maxlength="500" rows="5" cols="100" placeholder="Nous vous proposons un trajet entre rennes et paris pour se rendre au festival solidays..." class="champ" required></textarea><br>

            <?php
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
                    echo '<i>Les 2 dates ne correspondent pas, vous ne pouvez pas mettre une date de retour plus tôt que la date d\'aller.</i>';
                } else if ($_GET['erreur'] == 2) {
                    echo '<i>Cette annonce existe déjà sur Festi\'Covoit</i>';
                } else if ($_GET['erreur'] == 3) {
                    echo '<i>Erreur inconnue</i>';
                }
            }
            ?>
        </fieldset>

        <input class="envoi" type="submit" name="envoyer" value="Publier mon annonce">
    </form>
</body>

</html>