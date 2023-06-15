<?php

session_start();

use DAO\VehiculeDAO;
use models\Vehicule;

require_once 'models/Vehicule.php';
require_once 'DAO/VehiculeDAO.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!isset($_GET['confirmer'])){
        header('Location:AdminVehicules.php?confirmer='.$id);
        exit();
    } 
    try {
        //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
        $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $vehicule = new Vehicule($id,"","","","","","","","","","","");
        $vehiculeDAO = new VehiculeDAO($pdo);
        $exists = $vehiculeDAO->exists($vehicule);

        if (!$exists) {
            header('Location:AdminVehicules.php?erreur=1'); //erreur théoriquement impossible
            exit();
        } else {
            $delete = $vehiculeDAO->delete($vehicule);
        }
        if (!$delete) {
            header('Location:AdminVehicules.php?erreur=2'); //pas réussi à supprimer sans raison
        } else {
            header('Location:AdminVehicules.php?supp='.$id);
            exit();
        }
    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage();
        die();
    }
}
