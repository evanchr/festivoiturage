<?php
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
	<script>
		// Fonction pour fermer les fenêtres de messages
		function closeBox() {
			var box = document.getElementById('idBox');
			box.style.display = 'none';
		}
	</script>
	<h1>Espace de <?php echo htmlentities(trim($_SESSION['pseudo'])); ?></h1>

	<div class="menu">
		<a href="Home.php">
			<h4>Accueil</h4>
		</a>
	</div>

	<fieldset>
		<legend>Informations du compte :</legend>

		<p class="infos"><b>Pseudo : </b><?php echo htmlentities(trim($_SESSION['pseudo'])); ?> </p>
		<p class="infos"><b>Nom : </b><?php echo htmlentities(trim($_SESSION['nom'])); ?> </p>
		<p class="infos"><b>Prénom : </b><?php echo htmlentities(trim($_SESSION['prenom'])); ?> </p>
		<p class="infos"><b>Âge : </b><?php echo htmlentities(trim($_SESSION['age'])); ?> </p>

		<a href="Deconnexion.php"><input class="envoi" type="submit" value="Deconnexion"></a>
		<?php
		if (isset($_GET['erreur'])) {
			if ($_GET['erreur'] == 1) {
				echo '<i>Votre compte n\'existe pas donc vous ne pouvez pas le supprimer.</i>'; //impossible en théorie
			} else if ($_GET['erreur'] == 2) {
				echo '<i>Vous ne pouvez pas supprimer un compte administrateur.</i>';
			} else if ($_GET['erreur'] == 3) {
				echo '<i>La suppression a échoué pour une raison inconnue.</i>';
			}
		}
		if (isset($_GET['update'])) {
			echo "<div id='idBox' class='messageBox'>
					<div class='messageBoxContent'>
						<p class='messageText'>Votre compte a bien été modifié.</p>
						<button class='close-button' onclick='closeBox()'>Fermer</button>
					</div>
				</div>";
		}
		?>
	</fieldset>

	<div id="boutonsMembre">
		<a href="ModificationUser.php"><input class="envoi" type="submit" value="Modifier mes informations"></a>
		<a href="ValidationSuppressionUser.php"><input class="envoi" type="submit" name="supprimer" value="Supprimer mon compte"></a>
	</div>
</body>

</html>