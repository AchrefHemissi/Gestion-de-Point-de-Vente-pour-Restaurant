<?php
$orderId = $_POST['id'];
$serveur = 'localhost';
$utilisateur = 'root';
$motdepasse = '';
$base_de_donnees = 'if0_36253541_glicious';
$con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
$query = $con->prepare('UPDATE commande SET etat = 1 WHERE id = ?');
$query->bind_param("i", $orderId);
$query->execute();
?>