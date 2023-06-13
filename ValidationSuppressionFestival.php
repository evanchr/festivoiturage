<?php

session_start();

use DAO\FestivalDAO;
use models\Festival;

require_once 'models/Festival.php';
require_once 'DAO/FestivalDAO.php';

if (isset($_GET['nom'])) {
    $nom = $_GET['nom'];
    if (!isset($_GET['confirmer'])){
        header('Location:AdminFestivals.php?confirmer='.$nom);
        exit();
    } 
    try {
        $pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $festival = new Festival($nom,"","","","");
        $festivalDAO = new FestivalDAO($pdo);
        $exists = $festivalDAO->exists($festival);

        if (!$exists) {
            header('Location:AdminFestivals.php?erreur=1'); //erreur théoriquement impossible
            exit();
        } else {
            $delete = $festivalDAO->delete($festival);
        }
        if (!$delete) {
            header('Location:AdminFestivals.php?erreur=2'); //pas réussi à supprimer sans raison
        } else {
            header('Location:AdminFestivals.php?supp='.$nom);
            exit();
        }
    } catch (PDOException $e) {
        echo "<p>Erreur: " . $e->getMessage();
        die();
    }
}
?>