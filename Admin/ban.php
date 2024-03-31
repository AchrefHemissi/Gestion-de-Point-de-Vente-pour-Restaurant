<?php
// Get the customer ID from the request
$customerId = $_POST['id'];

// Connect to the database
$serveur = 'localhost';
$utilisateur = 'root';
$motdepasse = '';
$base_de_donnees = 'if0_36253541_glicious';
$con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

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