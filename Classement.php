<?php

// bibliothèques
include('dbfunction.inc.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Quiz.php">
	<title>QuizTime - Classement</title>
</head>
<body>
<h1>Classement</h1>

<div class="menu">
	<a href="Home.php"><h4>Accueil</h4></a> 
	<a href="Inscription.php"><h4>S'inscrire</h4></a>
</div>

<div>
	<table>
      <thead>
        <tr><th colspan="4" id="un">Classement général</th></tr>
        <tr><th>Place</th><th>Pseudo</th><th>Record</th><th>Thème</th></tr>
      </thead>

      <?php classement() ?>
      
</table>
</div>
<hr>
</body>
</html>