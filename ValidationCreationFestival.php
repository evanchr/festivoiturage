<?php

use DAO\FestivalDAO;
use models\Festival;

require_once 'models/Festival.php';
require_once 'DAO/FestivalDAO.php';

if (isset($_POST['envoyer'])) {
    $nom = trim($_POST['nom']);
    $dateDebut = trim($_POST['dateDebut']);
    $dateFin = trim($_POST['dateFin']);
    $ville = trim($_POST['ville']);
    $cheminPhoto = trim($_POST['cheminPhoto']);
    if ($nom === '' || $dateDebut === '' || $dateFin === '' || $ville === '' || $cheminPhoto === '') {
        header('Location:AjoutFestival.php?erreur=1');
    }
    if ($dateDebut >= $dateFin) {
        header('Location:AjoutFestival.php?erreur=2');
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=fhgnrcck_festicovoit; charset=utf8mb4', 'fhgnrcck_evan', 'Evan.Mateo1234'); //connexion serveur hébergé
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root'); //connexion serveur perso

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $festival = new Festival($nom, $dateDebut, $dateFin, $ville, $cheminPhoto);
            $festivalDAO = new FestivalDAO($pdo);
            $exists = $festivalDAO->exists($festival);

            if ($exists) {
                header('Location:AjoutFestival.php?erreur=3'); //festival déjà existant
            } else {
                $create = $festivalDAO->create($festival);
            }
            if (!$create) {
                header('Location:AjoutFestival.php?erreur=4'); //pas réussi à rentrer infos dans la bd sans raison
            } else {
                header('Location:AdminFestivals.php?ajout=' . $nom);
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
?>