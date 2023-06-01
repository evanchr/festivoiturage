<?php
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
        
            $pdostat = $pdo->prepare("SELECT * FROM user WHERE pseudo = :login AND password = :password");
            $pdostat->bindValue(':login', $login);
            $pdostat->bindValue(':password', $password);
            $pdostat->execute();
            if($pdostat->rowCount()==0){
                header('Location:Connexion.php?erreur=2');
            } else {
                foreach ($pdostat->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
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