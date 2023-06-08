<?php

use DAO\UserDAO;
use models\User;

require_once 'models/User.php';
require_once 'DAO/UserDAO.php';

if (isset($_POST['envoyer'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $age = trim($_POST['age']);
    $login = trim($_POST['pseudo']);
    $password1 = trim($_POST['pass1']);
    $password2 = trim($_POST['pass2']);
    if ($nom === '' || $prenom === '' || $age === '' || $login === '' || $password1 === '' || $password2 === '') {
        header('Location:Inscription.php?erreur=1');
    }
    if ($password1 != $password2) {
        header('Location:Inscription.php?erreur=2');
    } else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=festicovoit', 'root', 'root');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $user = new User($nom, $prenom, $age, $login, $password1, 0);
            $userDAO = new UserDAO($pdo);
            $exists = $userDAO->exists($user);

            if ($exists) {
                header('Location:Inscription.php?erreur=3'); //pseudo déjà existant
            } else {
                $create = $userDAO->create($user);
            }

            if (!$create) {
                header('Location:Inscription.php?erreur=4'); //pas réussi à rentrer infos dans la bd sans raison
            } else {
                if (isset($_GET['connecte'])) {
                    /*si connecté existe cela signifie que l'inscription s'est faite par un utilisateur déjà connecté
                    c'est à dire qu'il s'agit d'un admin qui inscit un nouveau user à partir du bouton "ajout utilisateur" 
                    dans l'interface d'AdminUsers. Il faut donc le renvoyer sur cette page en lui confirmant que l'ajout à réussi.*/
                    header('Location:AdminUsers.php?ajout='.$login);
                    exit();
                } else {
                    $connexion = $userDAO->connexion($user);

                    if ($connexion->rowCount() == 0) {
                        header('Location:Connexion.php?erreur=3');
                    } else {
                        foreach ($connexion->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                            session_start();
                            $_SESSION['nom'] = $ligne['nom'];
                            $_SESSION['prenom'] = $ligne['prenom'];
                            $_SESSION['age'] = $ligne['age'];
                            $_SESSION['pseudo'] = $ligne['pseudo'];
                            $_SESSION['password'] = $ligne['password'];
                            header('Location:Home.php');
                        }
                    }
                }
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
