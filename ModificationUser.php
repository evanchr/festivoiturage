<?php

namespace DAO;
require_once 'DAO/DAO.php';

session_start();
if (!isset($_SESSION['pseudo'])) {
    header('Location:Connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Espace membre</title>
    <link href="Style.php" rel="stylesheet" media="all" type="text/css">
</head>

<body>
    <h1>Espace de <?php echo htmlentities(trim($_SESSION['pseudo'])); ?></h1>

    <div class="menu">
        <a href="Home.php">
            <h4>Accueil</h4>
        </a>
        <a href="Classement.php">
            <h4>Classement</h4>
        </a>
    </div>

    <fieldset>
        <legend>Informations du compte :</legend>
        <form method="POST" action="ValidationModificationUser.php">
            <label for="nom" class="inscription">Nom : </label>
            <input id="nom" type="text" name="nom" minlength="2" placeholder="Dupont" pattern="[a-zA-Z]{2,}" class="champ" value="<?php if (isset($_SESSION['nom'])) echo htmlentities(trim($_SESSION['nom'])); ?>" required autofocus><br>

            <label for="prenom" class="inscription">Prénom : </label>
            <input id="prenom" type="text" name="prenom" minlength="2" placeholder="Jean" pattern="[a-zA-Z]{2,}" class="champ" value="<?php if (isset($_SESSION['prenom'])) echo htmlentities(trim($_SESSION['prenom'])); ?>" required><br>

            <label for="age" class="inscription">Âge : </label>
            <input id="age" type="number" name="age" minlength="2" placeholder="25" class="champ" min="0" max="100" pattern="[0-9]{0,3}" value="<?php if (isset($_SESSION['age'])) echo htmlentities(trim($_SESSION['age'])); ?>" required><br>

            <label for="pseudo" class="inscription">Pseudo : </label>
            <input id="pseudo" type="text" name="pseudo" minlength="2" placeholder="Jean35" class="champ" pattern="[a-zA-Z0-9]{2,}" value="<?php if (isset($_SESSION['pseudo'])) echo htmlentities(trim($_SESSION['pseudo'])); ?>" required><br>

            <label for="mdp1" class="inscription"> Nouveau mot de passe* : </label>
            <input type="password" name="pass1" id="mdp1" pattern="[a-zA-Z0-9\.\-#]{4,16}" class="champ" value="<?php if (isset($_SESSION['password'])) echo htmlentities(trim($_SESSION['password'])); ?>"><br>

            <label for="mdp2" class="inscription"> Confirmation du nouveau mot de passe : </label>
            <input type="password" name="pass2" id="mdp2" pattern="[a-zA-Z0-9\.\-#]{4,16}" class="champ" value="<?php if (isset($_SESSION['password'])) echo htmlentities(trim($_SESSION['password'])); ?>"><br>
            <p class="conditions">
                *Le mot de passe doit faire entre 4 et 16 caractères, ne comporter que des chiffres, lettres, ou signes tels que le point, le tiret ou le signe #.
            </p>
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
    <div id="boutonsMembre">
        <a href="ValidationSuppression.php"><input class="envoi" type="submit" name="supprimer" value="Supprimer mon compte"></a>
    </div>
</body>

</html>