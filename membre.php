<?php
session_start();

use DAO\VehiculeDAO;
use DAO\UserDAO;
use DAO\FestivalierDAO;

require_once 'DAO/VehiculeDAO.php';
require_once 'DAO/UserDAO.php';
require_once 'DAO/FestivalierDAO.php';

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

	<br>
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
			} else if ($_GET['erreur'] == 4) {
				echo '<i>Ce festivalier n\'existe pas donc vous ne pouvez pas le supprimer.</i>'; //impossible en théorie
			} else if ($_GET['erreur'] == 5) {
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
		if (isset($_GET['supp'])) { //message de confirmation de la suppression du festival
			echo "<div id='idBox' class='messageBox'>
					<div class='messageBoxContent'>
						<p class='messageText'>L'annonce " . $_GET['supp'] . " a bien été supprimé.</p>
						<button onclick='closeBox()'>Fermer</button>
					</div>
				</div>";
		}
		if (isset($_GET['confirmer'])){
			echo "<div class='messageBoxContent'>
			<p class='messageText'>Voulez-vous vraiment supprimer le festivalier ".$_GET['confirmer']." ?</p>
			<a href='ValidationSuppressionFestivalier.php?id=".$_GET['confirmer']."&confirmer=oui&membre=oui'>Oui</a>
			<a href='Membre.php'>Annuler</a>
		  </div>";
		}
		?>
	</fieldset>

	<div id="boutonsMembre">
		<a href="ModificationUser.php"><input class="envoi" type="submit" value="Modifier mes informations"></a>
		<a href="ValidationSuppressionUser.php"><input class="envoi" type="submit" name="supprimer" value="Supprimer mon compte"></a>
	</div>
	<br>
	<hr>

	<h2>Mes annonces :</h2>

	<div class="grid-container">
		<?php
		$vehicules = VehiculeDAO::listeAllFromUser($_SESSION['pseudo']);
		foreach ($vehicules as $vehicule) {
			echo "<div class='card'>";
			echo "<div class='card-info'>";
			echo "<img src='Images/Voiture.png' alt='icone voiture'>";
			echo "<h3>" . $vehicule['type'] . "</h3>";
			echo "<h4>Festival concerné : " . $vehicule['festival'] . "</h4>";
			echo "<p><b>Départ : </b>" . $vehicule['ville'] . " le " . $vehicule['dateAller'] . "</p>";
			if ($vehicule['dateRetour'] != "0000-00-00") {
				echo "<p><b>Retour le : </b>" . $vehicule['dateRetour'] . "</p>";
			}
			echo "<p><b>Nombre de places disponibles : </b>" . $vehicule['places'] . "</p>";
			echo "<p><b>Propriétaire du véhicule : </b>" . $vehicule['proprietaire'] . "</p>";
			echo "<p><b>Détails de l'annonce : </b>" . $vehicule['description'] . "</p><br>";
			echo "<div class='boutonsannonce'>";
			echo "<a href='ValidationModificationVehicule.php'><input class='envoi' type='submit' value='Modifier'></a>";
			echo "<a href='ValidationSuppressionVehicule.php?id=".$vehicule['id']."'><input class='envoi' type='submit' value='Supprimer'></a>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
		$festivaliers = FestivalierDAO::listeAllFromUser($_SESSION['pseudo']);
        foreach ($festivaliers as $festivalier) {
            echo "<div class='card'>";
            echo "<div class='card-info'>";
            echo "<img src='Images/Festivaliers.png' alt='icone festivalier'>";
            echo "<h3>". $festivalier['prenom'] ." ". $festivalier['nom'] . "</h3>";
            echo "<h4>Festival concerné : " . $festivalier['festival'] . "</h4>";
            echo "<p><b>Âge : </b>" .$festivalier['age']." ans</p>";
            echo "<p><b>Genre : </b>" .$festivalier['genre']."</p>";
            echo "<p><b>Départ : </b>" . $festivalier['ville'] . " le " . $festivalier['dateAller'] . "</p>";
            if ($festivalier['dateRetour'] != "0000-00-00") {
                echo "<p><b>Retour le : </b>" . $festivalier['dateRetour'] . "</p>";
            }
            echo "<p><b>Détails de l'annonce : </b>" . $festivalier['description'] . "</p>";
			echo "<div class='boutonsannonce'>";
			echo "<a href='ValidationModificationFestivalier.php'><input class='envoi' type='submit' value='Modifier'></a>";
			echo "<a href='ValidationSuppressionFestivalier.php?id=".$festivalier['id']."&membre=oui'><input class='envoi' type='submit' value='Supprimer'></a>";
			echo "</div>";
            echo "</div>";
            echo "</div>";
        }
		?>
	</div>
</body>

</html>