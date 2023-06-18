<?php
session_start();

use DAO\FestivalierDAO;
use models\Festivalier;

require_once 'models/Festivalier.php';
require_once 'DAO/FestivalierDAO.php';

if (isset($_POST['enregistrer'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $genre = $_POST['genre'];
    $festival = $_POST['festival'];
    $ville = $_POST['ville'];
    $dateAller = $_POST['dateAller'];
    $dateRetour = $_POST['dateRetour'];
    $description = $_POST['description'];
    if ($nom === '' || $prenom === '' || $age === '' || $genre === '' || $festival === '' || $ville === '' || $dateAller === '' || $dateRetour === '' || $description === '') {
        header('Location:ModificationFestivalier.php?erreur=1'); //champs vides
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $festivalier = new Festivalier($id, $nom, $prenom, $age, $genre, $festival, $ville, $dateAller, $dateRetour, $description, "");
            $festivalierDAO = new FestivalierDAO($pdo);
            $update = $festivalierDAO->update($festivalier, $id);

            if (!$update) {
                header('Location:Membre.php'); // aucune info n'a été modifiée
                exit();
            } else {
                header("Location:Membre.php?updateF=".$id."");
                exit();
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }           
    }
}
?>