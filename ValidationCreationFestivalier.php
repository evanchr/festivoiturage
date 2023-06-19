<?php
session_start();

use DAO\FestivalierDAO;

use models\Festivalier;

require_once 'models/Festival.php';
require_once 'models/Festivalier.php';
require_once 'models/User.php';

require_once 'DAO/FestivalDAO.php';
require_once 'DAO/FestivalierDAO.php';
require_once 'DAO/UserDAO.php';

if (isset($_POST['envoyer'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $genre = $_POST['genre'];
    $festival = $_POST['festival'];
    $ville = $_POST['ville'];
    $dateAller = $_POST['dateAller'];
    if (isset($_POST['dateRetour'])) {
        $dateRetour = $_POST['dateRetour'];
    } else {
        $dateRetour = NULL;
    }
    $description = $_POST['description'];
    $createur = $_SESSION['pseudo'];
    if ($_POST['dateRetour'] && $dateAller >= $dateRetour) {
        header('Location:AjoutFestivalier.php?erreur=1'); //erreur de dates
        exit();
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=fhgnrcck_festicovoit; charset=utf8mb4', 'fhgnrcck_evan', 'Evan.Mateo1234'); //connexion serveur hébergé
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root'); //connexion serveur perso

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $festivalier = new Festivalier("", $nom, $prenom, $age, $genre, $festival, $ville, $dateAller, $dateRetour, $description, $createur);
            $festivalierDAO = new FestivalierDAO($pdo);
            $exists = $festivalierDAO->exists($festivalier);

            if ($exists) {
                header('Location:AjoutFestivalier.php?erreur=2'); //festivalier déjà existant
                exit();
            } else {
            $create = $festivalierDAO->create($festivalier);
            }
            if (!$create) {
                header('Location:AjoutFestivalier.php?erreur=3'); //pas réussi à rentrer infos dans la bd sans raison
                exit();
            } else {
                header('Location:PageFestivaliers.php?ajout='.$prenom);
                exit();
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
?>