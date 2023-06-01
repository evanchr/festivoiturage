<?php

// bibliothèques
include('dbfunction.inc.php');

session_start();

// arrivée des données : la page a reçu des données
if (isset($_POST) && count($_POST)>0){
	// arrivée des données : trop ou pas assez de paramètres
	if (count($_POST )!= 3)
		$erreur = 'Erreur dans le nombre de paramètres';
	else	
	// arrivée des données : incomplètes
	if (    ( isset( $_POST['pseudo'] ) && empty( $_POST['pseudo'] ) ) 
	     || ( isset( $_POST['pass1'] ) && empty( $_POST['pass1']  ) )
	     || ( isset( $_POST['pass2'] ) && empty( $_POST['pass2']  ) ) )
		$erreur = 'Données incomplètes';
	else {	
	// tout est ok
		// on teste les deux mots de passe
		if ( $_POST['pass1'] != $_POST['pass2'] ){
			$erreur = 'Les 2 mots de passe sont différents.';
		}
		else {
			$login = $_POST['pseudo'];
			$pass = $_POST['pass1'];

			$numuser = demande_ins($login);
			if ( $numuser  == 0 ) {		
				enregistre_ins($login, $pass);
				// on connecte l'utilisateur en le mettant en session
				session_start();
				$_SESSION['pseudo'] = $login;
				header('Location:membre.php');
				die();
			}
			else {
				$erreur = 'Un membre possède déjà ce login.';
			}
		}
	}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Quiz.php" media="all">
	<title>QuizTime - Inscription</title>
</head>
<body>
<h1>Inscription</h1>

<div class="menu">
	<a href="Home.php"><h4>Accueil</h4></a> 
	<a href="Classement.php"><h4>Classement</h4></a>
	<a href="Connexion.php"><h4>Connexion</h4></a>
</div>

	<form action="Inscription.php" method="post">

		<fieldset><legend>Identité</legend>
			
			<label for="pseudo" class="inscription">Pseudo : </label>
			<input id="pseudo" type="text" name="pseudo" minlength="2" placeholder="Pseudo" pattern="[a-zA-Z0-9]{2,}" class="champ" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])); ?>" required autofocus><br>
			
		</fieldset>

		<fieldset><legend>Mot de passe</legend>
			
			<label for="mdp1" class="inscription">	Mot de passe* : </label>
			<input type="password" name="pass1" id="mdp1" pattern="[a-zA-Z0-9\.\-#]{8,16}" class="champ" value="<?php if (isset($_POST['pass1'])) echo htmlentities(trim($_POST['pass1'])); ?>" required><br>
			<label for="mdp2" class="inscription">	Confirmation du mot de passe : </label>
			<input type="password" name="pass2" id="mdp2" pattern="[a-zA-Z0-9\.\-#]{8,16}" class="champ" value="<?php if (isset($_POST['pass2'])) echo htmlentities(trim($_POST['pass2'])); ?>" required><br>
				<p class="conditions">
					*Le mot de passe doit faire entre 8 et 16 caractères, ne comporter que des chiffres, lettres, ou signes tels que le point, le tiret ou le signe #.
				</p>
		
		</fieldset>

		<input class="envoi" type="submit" value="Inscription">
	</form>
<?php
if (isset( $erreur ))
	echo '<div id="error">'.$erreur.'</div>';
?>
	<hr>
</body>
</html>