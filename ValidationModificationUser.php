<?php
session_start();

use DAO\UserDAO;
use models\User;

require_once 'models/User.php';
require_once 'DAO/UserDAO.php';

if (isset($_POST['enregistrer'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $age = trim($_POST['age']);
    $oldlogin = trim($_SESSION['pseudo']);
    $newlogin = trim($_POST['pseudo']);
    $password1 = trim($_POST['pass1']);
    $password2 = trim($_POST['pass2']);
    if ($nom === '' || $prenom === '' || $age === '' || $newlogin === '' || $password1 === '' || $password2 === '') {
        header('Location:ModificationUser.php?erreur=1'); //champs vides
    }
    if ($password1 != $password2) {
        header('Location:ModificationUser.php?erreur=2'); //mdp différents
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=fhgnrcck_festicovoit; charset=utf8mb4', 'fhgnrcck_evan', 'Evan.Mateo1234'); //connexion serveur hébergé
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root'); //connexion serveur perso

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $olduser = new User("", "", 0, $oldlogin, "", 0);
            $newuser = new User($nom, $prenom, $age, $newlogin, $password1, 0);

            $userDAO = new UserDAO($pdo);

            $existsold = $userDAO->exists($olduser);
            $existsnew = $userDAO->exists($newuser);

            if ($existsold) {
                if ($existsnew && $existsold != $existsnew) {
                    header('Location:ModificationUser.php?erreur=3'); // Ce pseudo est déjà pris
                } else {
                    $update = $userDAO->update($newuser, $oldlogin);
                }
            } else {
                header('Location:ModificationUser.php?erreur=4'); //l'ancien pseudo n'existe pas mais théoriquement impossible
            }
            if (!$update) {
                header('Location:Membre.php'); // aucune infos n'a été modifiées
            } else {
                $connexion = $userDAO->connexion($newuser);

                if ($connexion->rowCount() == 0) {
                    header('Location:Connexion.php?erreur=5'); //erreur pseudo/mot de passe
                } else {
                    foreach ($connexion->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                        session_start();
                        $_SESSION['nom'] = $ligne['nom'];
                        $_SESSION['prenom'] = $ligne['prenom'];
                        $_SESSION['age'] = $ligne['age'];
                        $_SESSION['pseudo'] = $ligne['pseudo'];
                        $_SESSION['password'] = $ligne['password'];
                        header('Location:Membre.php?update=oui');
                    }
                }
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
?>