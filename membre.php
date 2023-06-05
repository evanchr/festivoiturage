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
	<link href="Quiz.php" rel="stylesheet" media="all" type="text/css">
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
		<legend>Vos informations :</legend>

		<p class="infos">Pseudo : <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> </p>
		<p class="infos">Nom : <?php echo htmlentities(trim($_SESSION['nom'])); ?> </p>
		<p class="infos">Prénom : <?php echo htmlentities(trim($_SESSION['prenom'])); ?> </p>
		<p class="infos">Âge : <?php echo htmlentities(trim($_SESSION['age'])); ?> </p>

		<a href="Deconnexion.php"><input class="envoi" type="submit" value="Deconnexion"></a>

	</fieldset>

	<div id="boutonsMembre">

		<a href="Modification.php"><input class="envoi" type="submit" value="Modifier mes informations"></a>
		<a href="ValidationSuppression.php"><input class="envoi" type="submit" name="supprimer" value="Supprimer mon compte"></a>
	</div>
	<?php
	if (isset($_GET['update'])) {
		echo '<script>alert("Votre compte a bien été mis à jour.");</script>';
	}
	?>
	<hr>
</body>

</html>