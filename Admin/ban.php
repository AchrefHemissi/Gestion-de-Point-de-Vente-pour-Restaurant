<?php
// Get the customer ID from the request
require_once 'connexionAdminDB.php';
$customerId = $_POST['id'];

// Connect to the database
$con = Database::getInstance();

$query = $con->prepare('SELECT etat FROM utilisateur WHERE id = ?');
$query->bind_param('i', $customerId);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$currentStatus = $row['etat'];

// Toggle the ban status
$newStatus = $currentStatus == 0 ? 1 : 0;

$query = $con->prepare('UPDATE utilisateur SET etat = ? WHERE id = ?');
$query->bind_param('ii', $newStatus, $customerId);
$query->execute();
echo $newStatus;
?>