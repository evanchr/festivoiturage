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
    if ($password1 != $password2){
        header('Location:Inscription.php?erreur=2');
    }
    else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=festicovoit', 'root', 'root');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $user = new User($nom, $prenom, $age, $login, $password1);
            $userDAO = new UserDAO($pdo);
            $exists = $userDAO->exists($user);

            if($exists){
                header('Location:Inscription.php?erreur=3'); //pseudo déjà existant
            } else {
                $create = $userDAO->create($user);
            }
        
            if (!$create) {
                header('Location:Inscription.php?erreur=4'); //pas réussi à rentrer infos dans la bd sans raison
            } else {
                $connexion = $userDAO->connexion($user);

                if ($connexion->rowCount() == 0) {
                    header('Location:Connexion.php?erreur=3');
                } else {
                    foreach ($connexion->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                        session_start();
                        $_SESSION['pseudo'] = $ligne['pseudo'];
                        header('Location:Home.php');
                    }
                }
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
