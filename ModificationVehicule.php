<?php

use DAO\VehiculeDAO;
use DAO\FestivalDAO;
use models\Vehicule;
use models\Festival;

require_once 'models/Vehicule.php';
require_once 'models/Festival.php';
require_once 'DAO/VehiculeDAO.php';
require_once 'DAO/FestivalDAO.php';


session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location:Connexion.php');
    exit();
}
if (isset($_GET['id'])) {
    try {
        //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
        $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $vehicule = new Vehicule($_GET['id'], "", "", "", "", "", "", "", "", "", "");
        $vehiculeDAO = new VehiculeDAO($pdo);
        $exists = $vehiculeDAO->exists($vehicule);

        if (!$exists) {
            header('Location:Membre.php?erreur=6'); //Vehicule non existant (théoriquement impossible)
        } else {
            $vehiculeInfos = $vehiculeDAO->getVehicule($vehicule);
        }
        if ($vehiculeInfos->rowCount() == 0) {
            header('Location:Membre.php?erreur=7'); //erreur inconnue
        } else {
            foreach ($vehiculeInfos->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                $type = $ligne['type'];
                $places = $ligne['places'];
                $ville = $ligne['ville'];
                $festival = $ligne['festival'];
                $dateAller = $ligne['dateAller'];
                $dateRetour = $ligne['dateRetour'];
                $description = $ligne['description'];
            }
        }
    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage();
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Modification de Vehicule</title>
    <link href="Style.php" rel="stylesheet" media="all" type="text/css">
</head>

<body>
    <h1>Vehicule <?php echo $type; ?></h1>

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

    <fieldset>
        <legend>Informations du Vehicule :</legend>
        <form method="POST" action="ValidationModificationVehicule.php?id=<?php echo $_GET['id']; ?>">

            <label for="type" class="inscription">Modèle : </label>
            <input id="type" type="text" name="type" minlength="2" placeholder="Peugeot 208" class="champ" value="<?php echo $type; ?>" required autofocus><br>

            <label for="places" class="inscription">Nombre de places disponibles : </label>
            <input id="places" type="number" name="places" size="10" class="champ" value="<?php echo $places; ?>" required><br>

            <label for="ville" class="inscription">Ville de départ : </label>
            <input id="ville" type="text" name="ville" minlength="2" placeholder="Paris (75)" class="champ" value="<?php echo $ville; ?>" required><br>

            <label for="festival" class="inscription">Festival : </label>
            <select id="festival" name="festival" class="champ" required>
                <option value="">Sélectionnez un festival</option>
                <?php
                $festivals = FestivalDAO::listeAll();
                foreach ($festivals as $festival) {
                    echo '<option value="' . $festival['nom'] . '">' . $festival['nom'] . '</option>';
                }
                ?>
            </select>
            <br>

            <label for="dateAller" class="inscription">Date de départ : </label>
            <input id="dateAller" type="date" name="dateAller" class="champ" value="<?php echo $dateAller; ?>" required><br>

            <label for="dateRetour" class="inscription">Date de retour (facultatif) : </label>
            <input id="dateRetour" type="date" name="dateRetour" class="champ" value="<?php echo $dateRetour; ?>"><br>

            <label for="description" class="inscription">Description : </label>
            <textarea id="description" name="description" maxlength="500" rows="5" cols="100" placeholder="Je suis à la recherche d'un trajet entre rennes et paris pour me rendre au festival solidays..." class="champ" required><?php echo $description; ?> </textarea><br>

            <input class="envoi" type="submit" name="enregistrer" value="Enregistrer les modifications">
        </form>
        <?php
        if (isset($_GET['erreur'])) {
            if ($_GET['erreur'] == 1) {
                echo '<i>Veuillez bien remplir tous les champs</i>';
            } else if ($_GET['erreur'] == 2) {
                echo '<i>Les 2 mots de passe sont différents</i>';
            } else if ($_GET['erreur'] == 3) {
                echo '<i>Ce pseudo est déjà pris !</i>';
            } else if ($_GET['erreur'] == 4) {
                echo '<i>Votre ancien pseudo n\'existe pas</i>';
            } else if ($_GET['erreur'] == 5) {
                echo '<i>Le pseudo et le mot de passe ne corresponde pas.</i>';
            }
        }
        ?>
    </fieldset>
</body>

</html>