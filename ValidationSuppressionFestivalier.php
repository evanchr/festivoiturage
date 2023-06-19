<?php

session_start();

use DAO\FestivalierDAO;
use models\Festivalier;

require_once 'models/Festivalier.php';
require_once 'DAO/FestivalierDAO.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!isset($_GET['confirmer'])) {
        if (isset($_GET['membre'])) {
            header('Location:Membre.php?membre=oui&confirmerF=' . $id);
            exit();
        } else {
            header('Location:AdminFestivaliers.php?confirmer=' . $id);
            exit();
        }
    }
    try {
        //$pdo = new PDO('mysql:servername=localhost; dbname=fhgnrcck_festicovoit; charset=utf8mb4', 'fhgnrcck_evan', 'Evan.Mateo1234'); //connexion serveur hébergé
        $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root'); //connexion serveur perso

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $festivalier = new Festivalier($id, "", "", "", "", "", "", "", "", "", "");
        $festivalierDAO = new FestivalierDAO($pdo);
        $exists = $festivalierDAO->exists($festivalier);

        if (!$exists) {
            if (isset($_GET['membre'])) {
                header('Location:Membre.php?erreur=4'); //erreur théoriquement impossible
                exit();
            } else {
                header('Location:AdminFestivaliers.php?erreur=1'); //erreur théoriquement impossible
                exit();
            }
        } else {
            $delete = $festivalierDAO->delete($festivalier);
        }
        if (!$delete) {
            if (isset($_GET['membre'])) {
                header('Location:Membre.php?erreur=5'); //pas réussi à supprimer sans raison
                exit();
            } else {
                header('Location:AdminFestivaliers.php?erreur=2'); //pas réussi à supprimer sans raison
                exit();
            }
        } else {
            if (isset($_GET['membre'])) {
                header('Location:Membre.php?supp=' . $id); //suppression réussie
                exit();
            } else {
                header('Location:AdminFestivaliers.php?supp=' . $id);
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage();
        die();
    }
}
?>