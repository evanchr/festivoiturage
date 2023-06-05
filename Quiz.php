<?php 
header("Content-type: text/css");
?>
/* CSS General */
body{
	background-color: #acdfff;
	font-family: Poppins, sans-serif;
}

h1{
	text-align: center;
	font-size: 50px;
	margin: 50px 0;
	color: #ff3c50;
}

.menu{
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 30px;
	border-style: solid;
	border-width: 2px;
	border-radius: 10px;
	border-color: #0aa1ff;
	width: 60%;
	height: 30px;
	margin: auto;
}

a{
	text-align: center;
	color: #ee0019;
	font-size: 15px;
	text-decoration : none;
}

a:hover {
	text-decoration: underline;
}

p{
	font-size: 25px;
	font-weight: 450;
}

fieldset{
	margin: auto;
	border-color: #0aa1ff;
	width: 500px;
	border-radius: 10px;
	background-color: #BCE5FF;
}

.envoi{
	margin: 0 auto;
	display: block;
	margin-top: 10px;
	background-color: #ff3c50;
	border-radius: 8px;
	padding: 10px;
	color: white;
	margin-bottom: 5px;
	font-size: 15px;
	font-family: Poppins, sans-serif;
}

.envoi:hover{
	transform: scale(1.05);
}

hr{
	width: 30%;
	height: 3px;
	background-color: #ee0019;
	border-radius: 5px;
	border-style: none;
}

/* CSS Homepage */

.head{
	display: flex;
	justify-content: center;
	align-items: center;
	width: 90%;
	gap: 35%;
	margin: auto;
}

.connexion{
	display: flex;
	justify-content: center;
	align-items: center;
	gap: 10px;
}

.connexion img{
	height: 40px;
}

.intro{
	font-size: 14px;
	color: black;
	width: 60%;
	text-align: justify;
	margin: auto;
	margin-top: 10px;
}

.infos{
	font-size: 18px;
	color: black;
	width: 90%;
	text-align: justify;
	margin: auto;
	margin-top: 10px;
}

.resultat{
	font-size: 18px;
	color: black;
	width: 90%;
	text-align: center;
	margin: auto;
	margin-top: 10px;
}

.galerie {
    max-width: 1000px;
    width: 80%;
    height: auto;
    margin: 30px auto;
    display: flex;
    flex-wrap: wrap;
    display: flex;
	align-items: center;
	justify-content: center;
    gap: 10px;
}

.card{
	height: 200px;
	width: 300px;
}

.card img{
	position: absolute;
	height: 200px;
	width: 300px;
	border-radius: 10px;
}

.card input{
	position: absolute;
	height: 200px;
	width: 300px;
	color: transparent;
	border-radius: 10px;
	background-color: transparent;
	border-color: transparent;
}

.content{
	position: relative;
	color: #ee0019;
	display: flex;
	align-items: center;
    justify-content: center;
}

.nom_theme{
	margin-left: auto;
	margin-right: auto;
	background: rgba(227, 227, 227, 0.75);
	border-radius: 15px;
	padding: 5px;
	width: 70%;
	outline: solid;
    outline-color: white;
    outline-width: 1px;
}

.card:hover{
	opacity: 75%;
	transform: scale(1.05);
}

/* CSS Thème */

.quiz{
	width: 50%;
	margin: auto;
	margin-top: 30px;
}

h2{
	text-align: center;
	font-size: 40px;
	color: #ee0019
}

.titre_question{
 	font-size: 30px;
 	text-decoration: underline;
 	font-weight: 500;
}

.propositions{
	max-width: 1000px;
	width: 90%;
    height: auto;
    margin: 30px auto;
    display: flex;
    flex-wrap: wrap;
    display: flex;
	align-items: center;
	justify-content: center;
    gap: 30px;
}

.propositions input:checked+label{
	background-color: #ff3c50;
	border-radius: 5px;
	color: white;
}

.reponse{
	height: 100px;
	width: 45%;
	border-style: solid;
	border-width: 2px;
	border-color: #ff3c50;
	border-radius: 10px;
	font-size: 20px;
	display: flex;
	justify-content: center;
	align-items: center;
}

.reponse input{
	display: none;
}

.reponse label{
	width: 100%;
	height: 100%;
	font-weight: 500;
	text-align: center;
	display: flex;
	align-items: center;
	justify-content: center;
}

.reponse label:hover{
	transform: scale(1.05);
}

.reponse:hover{
	transform: scale(1.05);
}
/* CSS Classement */

table{
	margin: auto;
	width: 90%;
	margin-top: 15px;
	background-color: #BCE5FF;
}

th{
	border-style: solid;
	border-width: 2px;
	border-radius: 5px;
	border-color: black;
	text-align: center;
	color:  #ff3c50;
	height: 30px;
}

td{
	border-style: solid;
	border-width: 2px;
	border-radius: 5px;
	border-color: black;
	text-align: center;
}

.place{
	width: 10%;
}

.joueur{
	width: 30%;
}

.theme{
	width: 20%;
}

/* CSS Inscription & Connexion*/

legend{
	color: #ff3c50;
	font-size: 20px;
}

.champ{
	border-radius: 5px;
	border-color: transparent;
}

.conditions{
	font-style: italic;
	font-size: 12px;
}

.choix{
	font-size: 14px;
}

#boutonsMembre{
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 30px;
	width: 60%;
	margin: auto;
}