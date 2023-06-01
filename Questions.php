<?php
	
// bibliothèques
include('dbfunction.inc.php');

session_start();

if (!isset($_SESSION['pseudo'])) {
	header ('Location:Connexion.php');
	exit();
}

$_SESSION['theme'] = $_POST['theme'];

if (isset($_POST) && count($_POST)>0){
	// arrivée des données : trop ou pas assez de paramètres
	if (count($_POST )!= 1)
		$erreur = 'Erreur dans le nombre de paramètres';
	if (    ( isset( $_POST['theme'] ) && empty( $_POST['theme']  ) ) )
		$erreur = 'Données incomplètes';
		else{
			$idtheme = $_POST['theme'];
			$theme = theme($idtheme);
		}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="Quiz.php">
	<title>QuizTime - Questionniaire</title>
</head>

<body>
 <h1>Questionnaire <?php echo $theme?></h1>
 <div class="menu">
	 <a href="Home.php"><h4>Accueil</h4></a>
	 <a href="Inscription.php"><h4>S'inscrire</h4></a> 
	 <a href="Classement.php"><h4>Classement</h4></a>
	 <a href="Deconnexion.php"><h4>Déconnexion</h4></a>
 </div>
  
  <form action="Resultats.php" method="post">
  	<fieldset class="quiz">
  
  		<h2>Questions</h2>
  		
  		<?php enonce(questionnaire($idtheme))?>

  	</fieldset>
  	<input class="envoi" type="submit" value="Valider mes réponses">
  </form>

<?php
if (isset( $erreur ))
	echo '<div id="error">'.$erreur.'</div>';
?>

<hr>
</body>
</html>