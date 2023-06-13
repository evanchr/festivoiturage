<?php

session_start();

use DAO\UserDAO;
use models\User;

require_once 'models/User.php';
require_once 'DAO/UserDAO.php';

if (isset($_GET['pseudo'])) {
    $pseudo = $_GET['pseudo'];
    if (!isset($_GET['confirmer'])) {
        header('Location:AdminUsers.php?confirmer=' . $pseudo);
        exit();
    }
} else {
    $pseudo = $_SESSION["pseudo"];
}
try {
    //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
    $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user = new User("", "", 0, $pseudo, "", "");
    $userDAO = new UserDAO($pdo);
    $exists = $userDAO->exists($user);
    $admin = $userDAO->admin($user);

    if (!$exists) {
        header('Location:Membre.php?erreur=1'); //erreur théoriquement impossible
    } else if ($admin) {
        header('Location:Membre.php?erreur=2'); //il s'agit d'un compte administrateur
        exit();
    } else {
        $delete = $userDAO->delete($user);
    }

    if (!$delete) {
        header('Location:Membre.php?erreur=3'); //pas réussi à supprimer sans raison
    } else {
        if (isset($_GET['pseudo'])) {
            header('Location:AdminUsers.php?pseudo=' . $pseudo);
        } else {
            header('Location:Deconnexion.php?supp=oui');
            exit();
        }
    }
} catch (PDOException $e) {
    echo "<p>Erreur: " . $e->getMessage();
    die();
}
