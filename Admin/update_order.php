<?php

require_once 'connexionAdminDB.php';
$con = Database::getInstance();

$orderId = $_POST['id'];

$query = $con->prepare('UPDATE commande SET etat = 1 WHERE id = ?');
$query->bind_param("i", $orderId);
$query->execute();
?>