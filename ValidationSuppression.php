<?php

session_start();

use DAO\UserDAO;
use models\User;

require_once 'models/User.php';
require_once 'DAO/UserDAO.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=festicovoit', 'root', 'root');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user = new User("", "", 0, $_SESSION["pseudo"], "");
    $userDAO = new UserDAO($pdo);
    $exists = $userDAO->exists($user);

    if (!$exists) {
        header('Location:membre.php?erreur=1'); //erreur théoriquement impossible
    } else {
        $delete = $userDAO->delete($user);
    }

    if (!$delete) {
        header('Location:membre.php?erreur=2'); //pas réussi à supprimer sans raison
    } else {
        header('Location:Deconnexion.php?supp=oui');
    }
} catch (PDOException $e) {
    echo "<p>Erreur: " . $e->getMessage();
    die();
}

?>