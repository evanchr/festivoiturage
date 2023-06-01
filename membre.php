<?php
session_start();
if (!isset($_SESSION['pseudo'])) {
	header ('Location:Connexion.php');
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
	<a href="Home.php"><h4>Accueil</h4></a> 
	<a href="Classement.php"><h4>Classement</h4></a>
</div>

	<fieldset><legend>Vos informations :</legend>
		
		<p class="infos">Pseudo : <?php echo htmlentities(trim($_SESSION['pseudo'])); ?> </p>

	</fieldset> 
<a href="Deconnexion.php"><input class="envoi" type="submit" value="Deconnexion"></a>

<?php
if (isset( $erreur ))
	echo '<div class="erreur" id="error">'.$erreur.'</div>';
?>
	<hr>
</body>
</html>