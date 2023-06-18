<?php

use DAO\FestivalDAO;
use models\Festival;

require_once 'models/Festival.php';
require_once 'DAO/FestivalDAO.php';

session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location:Connexion.php');
    exit();
}
if (isset($_GET['nom'])){
    try {
        //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
        $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $festival = new Festival($_GET['nom'], "", "", "", "");
        $festivalDAO = new FestivalDAO($pdo);
        $exists = $festivalDAO->exists($festival);
    
        if (!$exists) {
            header('Location:AdminFestivals.php?erreur=1'); //festival non existant (théoriquement impossible)
        } else {
            $festivalInfos = $festivalDAO->getFestival($festival);
        }
        if ($festivalInfos->rowCount() == 0) {
            header('Location:AdminFestivals.php?erreur=2'); //erreur inconnue
        } else {
            foreach ($festivalInfos->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                $nom = $ligne['nom'];
                $dateDebut = $ligne['dateDebut'];
                $dateFin = $ligne['dateFin'];
                $ville = $ligne['localisation'];
                $cheminPhoto = $ligne['cheminPhoto'];
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
    <title>Festi'Covoit - Modification de festival</title>
    <link href="Style.php" rel="stylesheet" media="all" type="text/css">
</head>

<body>
    <h1>Festival <?php echo htmlentities(trim($_GET['nom'])); ?></h1>

    <div class="menu">
        <a href="Home.php">
            <h4>Accueil</h4>
        </a>
        <?php
		if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
			echo '<a href="AdminFestivals.php">
                    <h4>Gérer</h4>
                  </a>';
		}
		?>
    </div>

    <fieldset>
        <legend>Informations du festival :</legend>
        <form method="POST" action="ValidationModificationFestival.php?nom= <?php echo htmlentities(trim($_GET['nom'])); ?>">
        <label for="nom" class="inscription">Nom : </label>
            <input id="nom" type="text" name="nom" minlength="2" class="champ" value="<?php echo htmlentities(trim($nom)); ?>" required autofocus><br>

            <label for="dateDebut" class="inscription">Date de début : </label>
            <input id="dateDebut" type="date" name="dateDebut" minlength="2" class="champ" value="<?php echo htmlentities(trim($dateDebut)); ?>" required><br>

            <label for="dateFin" class="inscription">Date de fin : </label>
            <input id="dateFin" type="date" name="dateFin" minlength="2" class="champ" value="<?php echo htmlentities(trim($dateFin)); ?>" required><br>

            <label for="ville" class="inscription">Ville : </label>
            <input id="ville" type="text" name="ville" minlength="2" placeholder="Paris (75)" class="champ" value="<?php echo htmlentities(trim($ville)); ?>" required><br>

            <label for="cheminPhoto" class="inscription"> Chemin d'accès à la photo du festival : </label>
            <input id="cheminPhoto" type="text" name="cheminPhoto" placeholder="Images/Solidays.jpg" class="champ" value="<?php echo htmlentities(trim($cheminPhoto)); ?>" required><br>

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