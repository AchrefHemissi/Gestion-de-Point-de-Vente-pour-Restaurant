<?php
require_once 'connexionBD.php';


session_start();
if (!(isset($_SESSION['user_id']))) {
    header("Location: ../login/index.php");
} else {
    $con = ConnexionBD::getInstance();
    $query = $con->prepare('SELECT is_admin FROM utilisateur WHERE id = ?');
    $query->execute([$_SESSION['user_id']]);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row['is_admin'] == 1) {
        header("Location: ../login/index.php");
    }
}
