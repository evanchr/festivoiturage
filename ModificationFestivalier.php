<?php

use DAO\FestivalierDAO;
use DAO\FestivalDAO;
use models\Festivalier;
use models\Festival;

require_once 'models/Festivalier.php';
require_once 'models/Festival.php';
require_once 'DAO/FestivalierDAO.php';
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

        $festivalier = new Festivalier($_GET['id'], "", "", "", "", "", "", "", "", "", "");
        $festivalierDAO = new FestivalierDAO($pdo);
        $exists = $festivalierDAO->exists($festivalier);

        if (!$exists) {
            header('Location:Membre.php?erreur=6'); //festivalier non existant (théoriquement impossible)
        } else {
            $festivalierInfos = $festivalierDAO->getFestivalier($festivalier);
        }
        if ($festivalierInfos->rowCount() == 0) {
            header('Location:Membre.php?erreur=7'); //erreur inconnue
        } else {
            foreach ($festivalierInfos->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                $nom = $ligne['nom'];
                $prenom = $ligne['prenom'];
                $age = $ligne['age'];
                $genre = $ligne['genre'];
                $festival = $ligne['festival'];
                $ville = $ligne['ville'];
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
    <title>Modification de festivalier</title>
    <link href="Style.php" rel="stylesheet" media="all" type="text/css">
</head>

<body>
    <h1>Festivalier <?php echo $prenom . " " . $nom; ?></h1>

    <div class="menu">
        <a href="Home.php">
            <h4>Accueil</h4>
        </a>
        <?php
        if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
            echo '<a href="AdminFestivaliers.php">
                    <h4>Gérer</h4>
                  </a>';
        }
        ?>
    </div>

    <fieldset>
        <legend>Informations du festivalier :</legend>
        <form method="POST" action="ValidationModificationFestivalier.php?id=<?php echo $_GET['id']; ?>">

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

            <label for="nom" class="inscription">Nom : </label>
            <input id="nom" type="text" name="nom" minlength="2" placeholder="Dupont" class="champ" value="<?php echo $nom; ?>" required autofocus><br>

            <label for="prenom" class="inscription">Prénom : </label>
            <input id="prenom" type="text" name="prenom" minlength="2" placeholder="Jean" class="champ" value="<?php echo $prenom; ?>" required><br>

            <label for="age" class="inscription">Âge : </label>
            <input id="age" type="number" name="age" size="10" min="10" max="100" class="champ" value="<?php echo $age; ?>" required><br>

            <label for="genre" class="inscription">Genre : </label>
            <select id="genre" name="genre" class="champ" required>
                <option value="">Sélectionnez un genre</option>
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
                <option value="Autre">Autre</option>
            </select>
            <br>

            <label for="ville" class="inscription">Ville de départ : </label>
            <input id="ville" type="text" name="ville" minlength="2" placeholder="Paris (75)" class="champ" value="<?php echo $ville; ?>" required><br>

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