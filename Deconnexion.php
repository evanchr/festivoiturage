<?php
session_start();
session_unset();
session_destroy();
if(isset($_GET['supp'])){
    header('Location:Connexion.php?supp=oui');
    exit();
} else {
    header('Location:Connexion.php');
    exit();
}
?>