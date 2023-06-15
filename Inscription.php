<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Style.php" media="all">
	<title>Festi'Covoit - Inscription</title>
</head>

<body>
	<h1>Inscription</h1>

	<div class="menu">
		<a href="Home.php">
			<h4>Accueil</h4>
		</a>
		<?php 
		if (!isset($_SESSION['pseudo'])){
			echo "<a href='Connexion.php'>
					<h4>Connexion</h4>
				  </a>";
		}
        if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
            echo '<a href="AdminUsers.php">
                    <h4>Gérer</h4>
                  </a>';
        }
        ?>
	</div>

	<?php
	if(isset($_GET['admin'])){
		echo "<form action='ValidationInscription.php?admin=oui' method='post'>";
	} else {
		echo "<form action='ValidationInscription.php' method='post'>";
	}
	?>
		<fieldset>
			<legend>Informations personnelles</legend>

			<label for="nom" class="inscription">Nom : </label>
			<input id="nom" type="text" name="nom" minlength="2" placeholder="Dupont" pattern="[a-zA-Z]{2,}" class="champ" value="<?php if (isset($_POST['nom'])) echo htmlentities(trim($_POST['nom'])); ?>" required autofocus><br>

			<label for="prenom" class="inscription">Prénom : </label>
			<input id="prenom" type="text" name="prenom" minlength="2" placeholder="Jean" pattern="[a-zA-Z]{2,}" class="champ" value="<?php if (isset($_POST['prenom'])) echo htmlentities(trim($_POST['prenom'])); ?>" required><br>

			<label for="age" class="inscription">Âge : </label>
			<input id="age" type="number" name="age" minlength="2" placeholder="25" class="champ" min="0" max="100" pattern="[0-9]{0,3}" value="<?php if (isset($_POST['age'])) echo htmlentities(trim($_POST['age'])); ?>" required><br>

		</fieldset>

		<fieldset>
			<legend>Informations de connexion</legend>

			<label for="pseudo" class="inscription">Pseudo : </label>
			<input id="pseudo" type="text" name="pseudo" minlength="2" placeholder="Jean35" class="champ" pattern="[a-zA-Z0-9]{2,}" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>" required><br>

			<label for="mdp1" class="inscription"> Mot de passe* : </label>
			<input type="password" name="pass1" id="mdp1" pattern="[a-zA-Z0-9\.\-#]{4,16}" class="champ" value="<?php if (isset($_POST['pass1'])) echo htmlentities(trim($_POST['pass1'])); ?>" required><br>
			
			<label for="mdp2" class="inscription"> Confirmation du mot de passe : </label>
			<input type="password" name="pass2" id="mdp2" pattern="[a-zA-Z0-9\.\-#]{4,16}" class="champ" value="<?php if (isset($_POST['pass2'])) echo htmlentities(trim($_POST['pass2'])); ?>" required><br>
			<p class="conditions">
				*Le mot de passe doit faire entre 4 et 16 caractères, ne comporter que des chiffres, lettres, ou signes tels que le point, le tiret ou le signe #.
			</p>
			<?php
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur'] == 1) {
					echo '<i>Veuillez bien remplir tous les champs</i>';
				} else if ($_GET['erreur'] == 2) {
					echo '<i>Les 2 mots de passe sont différents</i>';
				} else if ($_GET['erreur'] == 3) {
					echo '<i>Un membre possède déjà ce pseudo</i>';
				} else if ($_GET['erreur'] == 4) {
					echo '<i>Erreur inconnue</i>';
				}
			}
			?>
		</fieldset>

		<input class="envoi" type="submit" name="envoyer" value="Inscription">
	</form>
</body>
</html>