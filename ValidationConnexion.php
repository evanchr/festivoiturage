<?php

use DAO\UserDAO;
use models\User;
require_once 'models/User.php';
require_once 'DAO/UserDAO.php';

if (isset($_POST['envoyer'])) {
    if (isset($_POST['login']) && isset($_POST['password'])){
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        if ($login === '' || $password === ''){
            header('Location:login.php?erreur=1');
        } else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=festicovoit', 'root', 'root');
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $user = new User("", "", 0, $login, $password);
            $userDAO = new UserDAO($pdo);
            $exists = $userDAO->exists($user);
            
            if($exists->rowCount()==0){
                header('Location:Connexion.php?erreur=2');
            } else {
                foreach ($exists->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                    session_start();
                    $_SESSION['pseudo'] = $ligne['pseudo'];
                    header('Location:Home.php');
                }
            }
        } 
        catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
        }
    }
}
?>