<?php
session_start();

use DAO\VehiculeDAO;

use models\Vehicule;

require_once 'models/Festival.php';
require_once 'models/Vehicule.php';
require_once 'models/User.php';

require_once 'DAO/FestivalDAO.php';
require_once 'DAO/VehiculeDAO.php';
require_once 'DAO/UserDAO.php';

if (isset($_POST['envoyer'])) {
    $id = "";
    $type = $_POST['type'];
    $places = trim($_POST['places']);
    $ville = $_POST['ville'];
    $festival = $_POST['festival'];
    $dateAller = $_POST['dateAller'];
    if (isset($_POST['dateRetour'])) {
        $dateRetour = $_POST['dateRetour'];
    } else {
        $dateRetour = NULL;
    }
    $description = $_POST['description'];
    $proprietaire = $_SESSION['pseudo'];
    if ($_POST['dateRetour'] && $dateAller >= $dateRetour) {
        header('Location:AjoutVehicule.php?erreur=1'); //erreur de dates
        exit();
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $vehicule = new Vehicule("", $type, $places, $ville, $festival, $dateAller, $dateRetour, $description, $proprietaire);
            $vehiculeDAO = new VehiculeDAO($pdo);
            $exists = $vehiculeDAO->exists($vehicule);

            if ($exists) {
                header('Location:AjoutVehicule.php?erreur=2'); //vehicule déjà existant
                exit();
            } else {
            $create = $vehiculeDAO->create($vehicule);
            }
            if (!$create) {
                header('Location:AjoutVehicule.php?erreur=3'); //pas réussi à rentrer infos dans la bd sans raison
                exit();
            } else {
                header('Location:PageVehicules.php?ajout='.$type);
                exit();
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
