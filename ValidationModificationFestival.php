<?php
session_start();

use DAO\FestivalDAO;
use DAO\UserDAO;
use models\Festival;

require_once 'models/Festival.php';
require_once 'DAO/FestivalDAO.php';

if (isset($_POST['enregistrer'])) {
    $oldNom = trim($_GET['nom']);
    $newNom = trim($_POST['nom']);
    $dateDebut = trim($_POST['dateDebut']);
    $dateFin = trim($_POST['dateFin']);
    $ville = trim($_POST['ville']);
    $cheminPhoto = trim($_POST['cheminPhoto']);
    if ($newNom === '' || $dateDebut === '' || $dateFin === '' || $ville === '' || $cheminPhoto === '') {
        header('Location:ModificationFestival.php?erreur=1'); //champs vides
    } 
    else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=retxaqbg_festicovoit', 'retxaqbg_evan', 'Evan.Mateo1234');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $oldfestival = new Festival($oldNom, "" , "", "", "");
            $newfestival = new Festival($newNom, $dateDebut, $dateFin, $ville, $cheminPhoto);

            $festivalDAO = new FestivalDAO($pdo);

            $existsold = $festivalDAO->exists($oldfestival);
            $existsnew = $festivalDAO->exists($newfestival);

            if($existsold){
                if($existsnew && $existsold != $existsnew){
                    header('Location:ModificationFestival.php?erreur=2'); // Ce festival est déjà existat
                } else {
                    $update = $festivalDAO->update($newfestival, $oldNom);
                }
            } else {
                header('Location:ModificationFestival.php?erreur=3'); //l'ancien nom n'existe pas mais théoriquement impossible
            }
            if (!$update) {
                header('Location:AdminFestivals.php'); // aucune info n'a été modifiée
            } else {
                header("Location:AdminFestivals.php?update=".$newNom."");
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
?>