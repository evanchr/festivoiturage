<?php

session_start();

use DAO\VehiculeDAO;
use models\Vehicule;

require_once 'models/Vehicule.php';
require_once 'DAO/VehiculeDAO.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!isset($_GET['confirmer'])) {
        if (isset($_GET['membre'])) {
            header('Location:Membre.php?membre=oui&confirmerV=' . $id);
            exit();
        } else {
            header('Location:AdminVehicules.php?confirmer=' . $id);
            exit();
        }
    }
    try {
        //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234'); //connexion serveur hébergé
        $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root'); //connexion serveur perso

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $vehicule = new Vehicule($id, "", "", "", "", "", "", "", "", "", "");
        $vehiculeDAO = new VehiculeDAO($pdo);
        $exists = $vehiculeDAO->exists($vehicule);

        if (!$exists) {
            if (isset($_GET['membre'])) {
                header('Location:Membre.php?erreur=4'); //erreur théoriquement impossible
                exit();
            } else {
                header('Location:AdminVehicules.php?erreur=1'); //erreur théoriquement impossible
                exit();
            }
        } else {
            $delete = $vehiculeDAO->delete($vehicule);
        }
        if (!$delete) {
            if (isset($_GET['membre'])) {
                header('Location:Membre.php?erreur=5'); //pas réussi à supprimer sans raison
                exit();
            } else {
                header('Location:AdminVehicules.php?erreur=2'); //pas réussi à supprimer sans raison
                exit();
            }
        } else {
            if (isset($_GET['membre'])) {
                header('Location:Membre.php?supp=' . $id); //suppression réussie
                exit();
            } else {
                header('Location:AdminVehicules.php?supp=' . $id);
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage();
        die();
    }
}
?>