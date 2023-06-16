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
color: #ff9f10;
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
width: 70%;
max-width: 1300px;
height: 30px;
margin: auto;
}

a{
text-align: center;
color: #ff9f10;
font-size: 15px;
text-decoration : none;
}

.menu a:hover {
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
background-color: #ceecff;
padding: 10px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
border-radius: 10px;
}

.envoi{
margin: 0 auto;
display: block;
margin-top: 10px;
background-color: #ff9f10;
border-radius: 8px;
padding: 10px;
color: white;
margin-bottom: 5px;
font-size: 15px;
font-family: Poppins, sans-serif;
}

.envoi:hover{
transform: scale(1.05);
text-decoration: none;
}

hr{
width: 30%;
height: 3px;
background-color: #ff9f10;
border-radius: 5px;
border-style: none;
}

/* CSS Homepage */

.head{
display: flex;
justify-content: center;
align-items: center;
width: 90%;
max-width: 1300px;
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
width: 65%;
max-width: 1200px;
text-align: justify;
margin: auto;
margin-top: 10px;
}

.outro{
font-size: 14px;
color: black;
width: 65%;
max-width: 1200px;
text-align: center;
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

.grid-container {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
grid-gap: 20px;
max-width: 1000px;
width: 80%;
height: auto;
margin: 30px auto;
}

.card {
background-color: #f5f5f5;
padding: 10px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
border-radius: 10px;
}

.card img {
width: 100%;
height: auto;
border-radius: 5px;
}

.card-info {
margin-top: 10px;
}

.card-info h3 {
font-size: 22px;
font-style : none;
margin: 0px;
}

.card-info h4 {
font-size: 17px;
margin : 0px;
}

.card-info p {
font-size: 15px;
margin: 5px 0;
}

.card-info img {
width : 150px;
}

.content{
position: relative;
color: #ff9f10;
display: flex;
align-items: center;
justify-content: center;
}

.card:hover{
transform: scale(1.05);
}

/* CSS Thème */
select{
background-color : white;
}

h2{
text-align: center;
font-size: 28px;
color: #ff9f10;
}

table{
margin: auto;
width: 95%;
margin-top: 15px;
background-color: #BCE5FF;
}

th{
border-style: solid;
border-width: 2px;
border-radius: 5px;
border-color: black;
text-align: center;
color: #ff9f10;
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
color: #ff9f10;
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

/* CSS Admin */
.sidebar {
width: auto;
height: 100%;
background-color: white;
float: left;
border-radius: 10px;
box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
padding : 5px;
}

.sidebar h3 {
padding: 10px;
font-size : 25px;
color: #ff9f10;
}

.sidebar a {
color : #000;
text-decoration: none;
}

.sidebar ul {
list-style-type: none;
padding: 0;
}

.sidebar li {
padding: 10px;
}

.sidebar li.active {
background-color : #dcdcdc;
border-radius: 5px;
}

.sidebar li.active a {
color: #ff9f10; /* Couleur de police par défaut */
}

.content {
margin-left: 200px; /* Ajuster en fonction de la largeur de la barre latérale */
padding: 20px;
display: block;
}

.photosFestivals {
height: 125px;
}

caption {
font-size : 30px;
}

.modifier {
padding-top: 5px;
height : 50px;
}

.box {
display: none;
position: fixed;
z-index: 1;
left: 0;
top: 0;
width: 100%;
height: 100%;
overflow: auto;
background-color: rgba(0, 0, 0, 0.4);
}

.messageBoxContent {
background-color: white;
margin: auto;
padding: 10px;
border: 1px solid #ccc;
border-radius: 5px;
width: auto;
text-align: center;
position: fixed;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
z-index: 9999;
}

.messageText {
font-size: 18px;
color: #333;
margin-top: 5px;
margin-bottom: 15px;
}

.messageBoxContent ul {
text-align : left;
}

.messageBoxContent button, .messageBoxContent a {
background-color: #ddd;
border: none;
color: #333;
padding: 5px 10px;
font-size: 16px;
border-radius: 3px;
cursor: pointer;
}

.messageBoxContent button:hover, .messageBoxContent a:hover {
background-color: #ccc;
}

.creation-annonce {
background-color: #f5f5f5;
padding: 20px;
border: 1px solid #ccc;
border-radius: 5px;
width: auto;
text-align: center;
position: fixed;
top: 92%;
left: 92%;
transform: translate(-50%, -50%);
z-index: 9999;
background-color: #ff9f10;
border-radius: 8px;
font-size : 15px;
color: white;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.creation-annonce:hover{
background-color: #ccc;
}

.boutonsannonce {
  display: flex;
  justify-content: center;
  gap : 10px;
  margin: auto;
}

.recherche{
  width: 65%;
}