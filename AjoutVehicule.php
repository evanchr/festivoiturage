<?php
session_start();

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
    </div>

    <form action="ValidationCreationVehicule.php" method="POST">
        <fieldset>
            <legend>Informations de l'annonce</legend>

            <label for="type" class="inscription">Modèle de véhicule : </label>
            <input id="type" type="text" name="nom" minlength="2" placeholder="Peugeot 208" class="champ" value="<?php if (isset($_POST['type'])) echo htmlentities(trim($_POST['type'])); ?>" required autofocus><br>

            <label for="places" class="inscription">Nombre de places disponibles : </label>
            <input id="places" type="text" name="places" minlength="2" class="champ" value="<?php if (isset($_POST['dateDebut'])) echo htmlentities(trim($_POST['dateDebut'])); ?>" required><br>

            <label for="dateAller" class="inscription">Date de départ : </label>
            <input id="dateAller" type="date" name="dateFin" minlength="2" class="champ" value="<?php if (isset($_POST['dateFin'])) echo htmlentities(trim($_POST['dateFin'])); ?>" required><br>

            <label for="ville" class="inscription">Ville : </label>
            <input id="ville" type="text" name="ville" minlength="2" placeholder="Paris (75)" class="champ" value="<?php if (isset($_POST['ville'])) echo htmlentities(trim($_POST['ville'])); ?>" required><br>

            <label for="cheminPhoto" class="inscription"> Chemin d'accès à la photo du festival : </label>
            <input id="cheminPhoto" type="text" name="cheminPhoto" placeholder="Images/Solidays.jpg" class="champ" value="<?php if (isset($_POST['cheminPhoto'])) echo htmlentities(trim($_POST['cheminPhoto'])); ?>" required><br>

            <?php
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
                    echo '<i>Veuillez bien remplir tous les champs</i>';
                } else if ($_GET['erreur'] == 2) {
                    echo '<i>Les 2 dates ne correspondent pas, vous ne pouvez pas mettre une date de fin plus tôt que la date de début.</i>';
                } else if ($_GET['erreur'] == 3) {
                    echo '<i>Ce festival existe déjà sur Festi\'Covoit</i>';
                } else if ($_GET['erreur'] == 4) {
                    echo '<i>Erreur inconnue</i>';
                }
            }
            ?>
        </fieldset>

        <input class="envoi" type="submit" name="envoyer" value="Ajouter">
    </form>
</body>
</html>