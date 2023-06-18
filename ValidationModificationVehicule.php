<?php
session_start();

use DAO\VehiculeDAO;
use models\Vehicule;

require_once 'models/Vehicule.php';
require_once 'DAO/VehiculeDAO.php';

if (isset($_POST['enregistrer'])) {
    $id = $_GET['id'];
    $type = $_POST['type'];
    $places = $_POST['places'];
    $ville = $_POST['ville'];
    $festival = $_POST['festival'];
    $dateAller = $_POST['dateAller'];
    $dateRetour = $_POST['dateRetour'];
    $description = $_POST['description'];
    if ($type === '' || $places === '' || $ville === '' || $festival === '' || $dateAller === '' || $description === '') {
        header('Location:ModificationVehicule.php?erreur=1&id='.$id); //champs vides
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $vehicule = new Vehicule($id, $type, $places, $ville, $festival, $dateAller, $dateRetour, $description, "");
            $vehiculeDAO = new VehiculeDAO($pdo);
            $update = $vehiculeDAO->update($vehicule, $id);

            if (!$update) {
                header('Location:Membre.php'); // aucune info n'a été modifiée
                exit();
            } else {
                header("Location:Membre.php?updateV=".$id."");
                exit();
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }           
    }
}
?>