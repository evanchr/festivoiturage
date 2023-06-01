<?php
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

            $pdostat = $pdo->prepare("SELECT * FROM user WHERE pseudo = :login");
            $pdostat->bindValue(':login', $login);
            $pdostat->execute();
            if ($pdostat->rowCount() == 0) {
                //inscrire dans la base de donnée (pas fait)
                foreach ($pdostat->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                    session_start();
                    $_SESSION['pseudo'] = $ligne['pseudo'];
                    header('Location:Home.php');
                }
            } else {
                header('Location:Inscription.php?erreur=3');
            }
        } catch (PDOException $e) {
            echo "<p>Erreur: " . $e->getMessage();
            die();
        }
    }
}
