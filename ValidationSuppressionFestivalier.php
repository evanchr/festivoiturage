<?php

session_start();

use DAO\FestivalierDAO;
use models\Festivalier;

require_once 'models/Festivalier.php';
require_once 'DAO/FestivalierDAO.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!isset($_GET['confirmer'])){
        header('Location:AdminFestivaliers.php?confirmer='.$id);
        exit();
    } 
    try {
        //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
        $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $festivalier = new Festivalier($id,"","","","","","","","","","");
        $festivalierDAO = new FestivalierDAO($pdo);
        $exists = $festivalierDAO->exists($festivalier);

        if (!$exists) {
            header('Location:AdminFestivaliers.php?erreur=1'); //erreur théoriquement impossible
            exit();
        } else {
            $delete = $festivalierDAO->delete($festivalier);
        }
        if (!$delete) {
            header('Location:AdminFestivaliers.php?erreur=2'); //pas réussi à supprimer sans raison
        } else {
            header('Location:AdminFestivaliers.php?supp='.$id);
            exit();
        }
    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage();
        die();
    }
}
