<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Quiz.php">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
	<title>Festi'Covoit - Accueil</title>
</head>
<body>

<div class="head"> 
	<h1>Festi'Covoit</h1>
	<div class="connexion">
		<h4><?php if (isset($_SESSION['pseudo'])) {
					echo "<a href='membre.php'>";
				    echo htmlentities(trim($_SESSION['pseudo']));
				    echo"</a>";} 
				  if (!isset($_SESSION['pseudo'])) 
				  	echo "<a href='Connexion.php'>Connexion</a>";?>
		</h4><img src="Images/User.png" alt="bouton connexion">
	</div>
</div>

<div class="menu">
	<a href="Classement.php"><h4>Classement</h4></a>
	<h4><?php if (!isset($_SESSION['pseudo'])) echo '<a href="Inscription.php">S\'inscrire</a>';?></h4>
   	<h4><?php if (isset($_SESSION['pseudo'])) echo '<a href="Deconnexion.php">Déconnexion</a>';?></h4>
</div>
<p class="intro">Bienvenue sur QuizTime ! Si vous souhaitez tester votre culture générale ou tout simplement enrichir votre savoir, vous êtes au bon endroit ! Sur QuizTime vous pouvez répondre à différentes questions sur vos thèmes favoris. Pour commencer veuillez sélectionner un thème :</p>

<form action="Questions.php" method="post">
<div class="galerie">	
	
	<div class="card">
		<img alt="Theme Géographie" src="Images/Géographie.jpg">
		<input type="submit" name="theme" value="1">
			<div class="content">
				<h3 class="nom_theme">Géographie</h3>
			</div>
	</div>
	<div class="card">
		<img alt="Theme Histoire" src="Images/Histoire.jpg">
		<input type="submit" name="theme" value="2">
			<div class="content">
				<h3 class="nom_theme">Histoire</h3>
			</div>
	</div>
	<div class="card">
		<img alt="Theme Nature" src="Images/Nature.jpg">
		<input type="submit" name="theme" value="3">
			<div class="content">
				<h3 class="nom_theme">Nature</h3>
			</div>
	</div>
	
	<div class="card">
		<img alt="Theme France" src="Images/France.jpg">
		<input type="submit" name="theme" value="4">
			<div class="content">
				<h3 class="nom_theme">France</h3>
			</div>
	</div>
	<div class="card">
		<img alt="Theme Sport" src="Images/Sport.jpg">
		<input type="submit" name="theme" value="5">
			<div class="content">
				<h3 class="nom_theme">Sport</h3>
			</div>
	</div>
	<div class="card">
		<img alt="Theme Célébrités" src="Images/Célébrités.jpg">
		<input type="submit" name="theme" value="6">
			<div class="content">
				<h3 class="nom_theme">Célébrités</h3>
			</div>
	</div>

	<div class="card">
		<img alt="Theme Musique" src="Images/Musique.jpg">
		<input type="submit" name="theme" value="7">
			<div class="content">
				<h3 class="nom_theme">Musique</h3>
			</div>
	</div>
	<div class="card">
		<img alt="Theme Cinéma" src="Images/Cinéma.jpg">
		<input type="submit" name="theme" value="8">
			<div class="content">
				<h3 class="nom_theme">Cinéma</h3>
			</div>
	</div>
	<div class="card">
		<img alt="Theme Jeux-Vidéos" src="Images/Jeux.jpg">
		<input type="submit" name="theme" value="9">
			<div class="content">
				<h3 class="nom_theme">Jeux Vidéos</h3>
			</div>
	</div>
</form>
</div>
<hr>
</body>
</html>