<?php

use DAO\UserDAO;
use models\User;

require_once 'models/User.php';
require_once 'DAO/UserDAO.php';

session_start();

if (isset($_POST['envoyer'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $age = trim($_POST['age']);
    $login = trim($_POST['pseudo']);
    $password1 = trim($_POST['pass1']);
    $password2 = trim($_POST['pass2']);
    if ($nom === '' || $prenom === '' || $age === '' || $login === '' || $password1 === '' || $password2 === '') {
        if (isset($_GET['admin'])) {
            header('Location:Inscription.php?erreur=1&admin=oui'); //il manque des champs
            exit();
        } else {
            header('Location:Inscription.php?erreur=1');
            exit();
        }
    }
    if ($password1 != $password2) {
        if (isset($_GET['admin'])) {
            header('Location:Inscription.php?erreur=2&admin=oui'); //mots de passe différents
            exit();
        } else {
            header('Location:Inscription.php?erreur=2');
            exit();
        }
    } else {
        try {
            //$pdo = new PDO('mysql:servername=localhost; dbname=retxaqbg_festicovoit; charset=utf8mb4', 'retxaqbg_evan', 'Evan.Mateo1234');
            $pdo = new PDO('mysql:host=localhost; dbname=festicovoit; charset=utf8mb4', 'root', 'root');

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_SESSION['admin'])) {
                $user = new User($nom, $prenom, $age, $login, $password1, 1);
            } else {
                $user = new User($nom, $prenom, $age, $login, $password1, 0);
            }
            $userDAO = new UserDAO($pdo);
            $exists = $userDAO->exists($user);

            if ($exists) {
                if (isset($_GET['admin'])) {
                    header('Location:Inscription.php?erreur=3&admin=oui'); //pseudo existe deja dans la base
                    exit();
                } else {
                    header('Location:Inscription.php?erreur=3');
                    exit();
                }
            } else {
                $create = $userDAO->create($user);
            }
            if (!$create) {
                if (isset($_GET['admin'])) {
                    header('Location:Inscription.php?erreur=4&admin=oui'); //pas réussi à rentrer infos dans la bd sans raison
                    exit();
                } else {
                    header('Location:Inscription.php?erreur=4');
                    exit();
                }
            } else {
                if (isset($_SESSION['pseudo'])) {
                    /*si le session pseudo existe cela signifie que l'inscription s'est faite par un utilisateur déjà connecté
                    c'est à dire qu'il s'agit d'un admin qui inscit un nouveau user à partir du bouton "ajout utilisateur" 
                    dans l'interface d'AdminUsers. Il faut donc le renvoyer sur cette page en lui confirmant que l'ajout à réussi.*/
                    if (isset($_GET['admin'])) {
                        header('Location:AdminAdmins.php?ajout=' . $login);
                        exit();
                    } else {
                        header('Location:AdminUsers.php?ajout=' . $login);
                        exit();
                    }
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
