<?php
require_once 'connexionAdminDB.php';


session_start();
if (!(isset($_SESSION['user_id']))) {
    header("Location: ../login/index.php");
} else {
    $con = Database::getInstance();
    $query = $con->prepare('SELECT is_admin FROM utilisateur WHERE id = ?');
    $query->bind_param('i', $_SESSION['user_id']);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();
    if ($row['is_admin'] == 1) {
        header("Location: ../login/index.php");
    }
}
exit;
