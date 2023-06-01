<?php
// compatibilite php8.1 -> php7
mysqli_report(MYSQLI_REPORT_OFF);

//focntion de connexion à la base de données
function bdconnexion() { 
	$link = mysqli_connect('localhost', 'root', '', 'QuizTime', 3306);
	if (!$link) {
		die ("Erreur d'accès à la base de données - FIN");
	}
	mysqli_set_charset($link, 'utf8');
	return $link;
}

// renvoie true si login et password OK
function connexion($login, $password) {

	// connexion 
	$link = bdconnexion();
		
	// on cherche l'entrée correspondant au login
	$sql = 'SELECT * FROM utilisateur WHERE pseudo="'.mysqli_real_escape_string($link, $login ).'";';

	// exécution
	$result = mysqli_query($link, $sql);

	// alors on teste le mot de passe dans le cas où il n'y a qu'une entrée
	$row = mysqli_fetch_assoc($result);
		
	return ((mysqli_num_rows($result)==1)&&$password==$row['password'] );
}

//fonction pour savoir si un login est déja pris
function demande_ins($login) {
	
	// connexion 
	$link = bdconnexion();

	// prépation de la requete n°1 : login dejà pris ?
	$sql = 'SELECT count(*) as num FROM utilisateur WHERE pseudo="'.
			mysqli_real_escape_string($link, $login).'";';
	$result = mysqli_query($link, $sql);
	if (!$result) 
		$nb=0;
	else {
		$row = mysqli_fetch_assoc($result);
		$nb= $row['num'];
	}
	return ($nb);
}

//fonction pour enregistrer l'inscription d'un utilisateur
function enregistre_ins($login, $password) {

	// connexion 
	$link = bdconnexion();

	// préparation de la requete
	$sql = 'INSERT INTO utilisateur (id_user, pseudo, password) VALUES("", "'.
	  	   mysqli_real_escape_string($link, $login).'", "'.
		   mysqli_real_escape_string($link, $password).'");';
	$result = mysqli_query($link, $sql);
}

//retoune l'id d'un utilisateur en fonction de son pseudo
function iduser($pseudo){

	$link = bdconnexion();

	$sql = 'SELECT * FROM utilisateur WHERE pseudo = "'.$pseudo.'";';

	$result = mysqli_query($link,$sql);

	if ($result)
		{
			if ($row = mysqli_fetch_assoc($result))
				{
					return ($row['id_user']);
				}
			mysqli_free_result($result);
		}
}

//retounr le pseudo d'un utilisateur en fonction de son id
function pseudo($iduser){

	$link = bdconnexion();

	$sql = 'SELECT * FROM utilisateur WHERE id_user = "'.$iduser.'";';

	$result = mysqli_query($link,$sql);

	if ($result)
		{
			if ($row = mysqli_fetch_assoc($result))
				{
					return ($row['pseudo']);
				}
			mysqli_free_result($result);
		}
}

//retourne le nom du theme en fonction de son id
function theme($id){

	$link = bdconnexion();

	$sql = 'SELECT * FROM theme WHERE id_theme = "'.$id.'";';

	$result = mysqli_query($link,$sql);

	if ($result)
		{
			if ($row = mysqli_fetch_assoc($result))
				{
					return ($row['nom']);
				}
			mysqli_free_result($result);
		}
}

//fonction pour choisir un questionnaire au hasard en fonction du thème choisi
function questionnaire($theme){
	$link = bdconnexion();
								
	$sql  = 'SELECT * FROM questionnaire WHERE id_theme = "'.$theme.'" ORDER BY RAND() LIMIT 1;'; 
							
	$result = mysqli_query($link,$sql);

	if ($result)
		{
			if ($row = mysqli_fetch_assoc($result))
				{
					return ($row['id_questionnaire']);
				}
			mysqli_free_result($result);
		}
}

//fonction qui affiche toutes les questions du questionnaire
function enonce($id){
	$link = bdconnexion();
								
	$sql = 'SELECT * FROM questions WHERE id_questionnaire = "'.$id.'";';
								
	$result = mysqli_query($link,$sql);

	if ($result)
		{
			//num question
			$q=1;
			while ($row = mysqli_fetch_assoc($result))
				{
					echo '<h3 class="titre_question">Question ', $q,' :</h3>';
					echo '<p>',$row['enonce'],'</p>';
					reponse($row['id_question'],$q);
					echo '<br>';
					$q++;
				}
			mysqli_free_result($result);
		}
}

//fonction qui affiche les propositions pour chaque questions
function reponse($id,$q){
	$link = bdconnexion();
								
	$sql = 'SELECT * FROM propositions WHERE id_question = "'.$id.'" ORDER BY RAND() LIMIT 4;';
								
	$result = mysqli_query($link,$sql);

	if ($result)
		{
			echo '<div class="propositions">';
			while ( $row = mysqli_fetch_assoc($result))
				{
  			        echo '<div class="reponse"><input type="radio" name="question',$q,'" id="',$row['id_proposition'],'" value="',$row['id_proposition'],'"required><label for="',$row['id_proposition'],'">',$row['enonce'],'</label></div>';
				}
			echo '</div>';
			mysqli_free_result($result);
		}
}

//fonction qui vérifie si la proposition coché est la bonne réponse
function correction($value){
	$link = bdconnexion();

	$sql = 'SELECT * FROM propositions WHERE id_proposition = "'.$value.'";';

	$result = mysqli_query($link,$sql);

	if ($result)
	{
		while ($row = mysqli_fetch_assoc($result))
		{
			return $row['est_reponse'];
		}
	}

}

//teste si un record est battu, nouveau ou imbattu
function record($user,$score,$theme){
	$link = bdconnexion();

	$sql = 'SELECT * FROM record WHERE id_user = "'.$user.'";';

	$result = mysqli_query($link, $sql);

	if ($result){

		if ($row = mysqli_fetch_assoc($result))
		{
			if ($score > $row['record']){
				$text = "<div class='resultat'>Bravo, votre record a été battu !</div>";
				updaterecord($score,$user,$theme);
				return $text;
			}
			else{
				$text = "<div class='resultat'>Votre record n'a pas été battu</div>";
				return $text;
			}
		}
	else{
		$text = "<div class='resultat'>Félicitations vous avez un nouveau record !</div>";
		newrecord($score,$user,$theme);
		return $text;
	}
	}
}

//crée un nouveau record
function newrecord($record,$user,$theme){
	$link = bdconnexion();

	$sql = 'INSERT INTO record (id_record , record, id_user, id_theme) VALUES ("",'.$record.','.$user.','.$theme.');';

	$result = mysqli_query($link, $sql);
}

//met à jour un record
function updaterecord($record,$user,$theme){
	$link = bdconnexion();

	$sql = 'UPDATE record SET record = '.$record.', id_theme = '.$theme.' WHERE id_user = "'.$user.'";';

	$result = mysqli_query($link, $sql);
}

//retourne le classement général de tous les records
function classement(){
	$link = bdconnexion();
								
	$sql = 'SELECT * FROM record ORDER BY record DESC';
								
	$result = mysqli_query($link,$sql);

	if ($result)
		{
			//place
			$p=1;
			while ($row = mysqli_fetch_assoc($result))
				{
					echo "<tbody>";
     				echo "<tr><td class='place'>",$p,"</td><td class='joueur'>",pseudo($row['id_user']),"</td><td>",$row['record'],"</td><td class='theme'>",theme($row['id_theme']),"</td></tr>";
					$p++;
				}
			mysqli_free_result($result);
		}
}
?>