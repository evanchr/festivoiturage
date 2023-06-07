<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Style.php">
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
					echo "<a href='Membre.php'>";
				    echo htmlentities(trim($_SESSION['pseudo']));
					if (isset($_SESSION['admin'])){
						echo " (admin)";
					}
				    echo "</a>";} 
				  if (!isset($_SESSION['pseudo'])) 
				  	echo "<a href='Connexion.php'>Connexion</a>";?>
		</h4><img src="Images/User.png" alt="bouton connexion">
	</div>
</div>

<div class="menu">
	<h4><?php if (!isset($_SESSION['pseudo'])) echo '<a href="Inscription.php">S\'inscrire</a>';?></h4>
	<h4><?php if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) echo '<a href="AdminFestivals.php">Gérer</a>';?></h4>
   	<h4><?php if (isset($_SESSION['pseudo'])) echo '<a href="Deconnexion.php">Déconnexion</a>';?></h4>
</div>
<p class="intro">Bienvenue sur Festi'Covoit ! Si vous souhaitez vous rendre à un festival de manière plus écologique et plus économique vous êtes au bon endroit ! <br>
				Ici, vous pouvez réserver une place dans le véhicule d'un autre festivalier qui se rend au même festival que vous. Cela vous permettra d'économiser sur le prix du trajet,
				de vous déplacer de manière plus écologique et surtout de rencontrer de super personnes. <br>A l'inverse, s'il vous reste de la place dans votre véhicule, vous pouvez créer une annonce 
				avec le nombre de personnes que vous pouvez emmener, le festival où vous vous rendez et à quelles dates. Il ne vous reste plus qu'à attendre la reservation de festivaliers ! </p>
</div>
<hr>
</body>
</html>