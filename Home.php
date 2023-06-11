<?php
session_start();

use DAO\FestivalDAO;

require_once 'DAO/FestivalDAO.php';

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
			<?php if (isset($_SESSION['pseudo'])) {
				echo "<a href='Membre.php'><h4>";
				echo htmlentities(trim($_SESSION['pseudo']));
				if (isset($_SESSION['admin'])) {
					echo " (admin)";
				}
				echo "</a></h4>";
			}
			if (!isset($_SESSION['pseudo'])) {
				echo '<a href="Inscription.php"><h4>S\'inscrire</h4></a>';
				echo '<h4> - </h4>';
				echo "<a href='Connexion.php'><h4>Connexion</h4></a>";
			}
			?>
			<img src="Images/User.png" alt="bouton connexion">
		</div>

	</div>

	<div class="menu">
		<a href="PageVehicules.php">
			<h4>Trouver un véhicule</h4>
		</a>
		<a href="PageFestivaliers.php">
			<h4>Trouver un festivalier</h4>
		</a>
		<a href="PageAnnonces.php">
			<h4>Toutes les annonces</h4>
		</a>
		<?php
		if (isset($_SESSION['pseudo']) && isset($_SESSION['admin'])) {
			echo '<a href="AdminFestivals.php">
                    <h4>Gérer</h4>
                  </a>';
		}

		?>
	</div>

	<p class="intro">Bienvenue sur Festi'Covoit ! Si vous souhaitez vous rendre à un festival de manière plus écologique et plus économique vous êtes au bon endroit ! <br>
		Ici, vous pouvez réserver une place dans le véhicule d'un autre festivalier qui se rend au même festival que vous. Cela vous permettra d'économiser sur le prix du trajet,
		de vous déplacer de manière plus écologique et surtout de rencontrer de super personnes. <br>A l'inverse, s'il vous reste de la place dans votre véhicule, vous pouvez créer une annonce
		avec le nombre de personnes que vous pouvez emmener, le festival où vous vous rendez et à quelles dates. Il ne vous reste plus qu'à attendre la reservation de festivaliers ! </p>

		<h2>Nos festivals partenaires :</h2>
	<div class="grid-container">
		<?php
		$festivals = FestivalDAO::listeAll();
		foreach ($festivals as $festival) {
			echo "<div class='card'>";
			echo "<img src='" . $festival['cheminPhoto'] . "' alt='" . $festival['nom'] . "'>";
			echo "<div class='card-info'>";
			echo "<h3>" . $festival['nom'] . "</h3>";
			echo "<p>" . $festival['localisation'] . "</p>";
			echo "<p>" . $festival['dateDebut'] . " au " . $festival['dateFin'] . "</p>";
			echo "</div>";
			echo "</div>";
		}
		?>
	</div>
</body>
</html>