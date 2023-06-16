<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Style.php" media="all">
	<title>Festi'Coivoit - Connexion</title>
</head>

<body>
	<h1>Connexion</h1>

	<div class="menu">
		<a href="Home.php">
			<h4>Accueil</h4>
		</a>
	</div>

	<form action="ValidationConnexion.php" method="post">

		<fieldset>
			<legend>Identifiant et mot de passe</legend>

			<label for="login" class="inscription"> Pseudo : </label>
			<input id="login" type="text" name="login" minlength="2" placeholder="Pseudo" pattern="[a-zA-Z0-9]{2,}" class="champ" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>" required autofocus><br>
			<label for="password" class="inscription"> Mot de passe* : </label>
			<input type="password" name="password" id="password" pattern="[a-zA-Z0-9\.\-#]{4,16}" class="champ" value="<?php if (isset($_POST['password'])) echo htmlentities(trim($_POST['password'])); ?>" required><br>
			<p class="conditions">
				Si vous n'êtes pas encore inscrit(e) sur Festi'Covoit, cliquez ici : <a href="AjoutUser.php">
					<h4>S'inscrire</h4>
				</a>
			</p>
			<?php
			if (isset($_GET['erreur'])) {
				if ($_GET['erreur'] == 1) {
					echo '<i>Veuillez saisir un login et un mot de passe.</i>';
				} else if ($_GET['erreur'] == 2) {
					echo '<i>Ce pseudo n\'existe pas.</i>';
				} else if ($_GET['erreur'] == 3) {
					echo '<i>Erreur de correspondance pseudo/mot de passe.</i>';
				}
			}
			if (isset($_GET['supp'])) {
				echo '<script>alert("Votre compte a bien été supprimé.");</script>';
			}
			?>
		</fieldset>

		<input class="envoi" type="submit" name="envoyer" value="Connexion">
	</form>
</body>
</html>