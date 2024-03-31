<?php
$serveur = 'localhost';
$utilisateur = 'root';
$motdepasse = '';
$base_de_donnees = 'if0_36253541_glicious';
$con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM produit order by vendu desc limit 3 ";
$result = mysqli_query($con, $sql);
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}
mysqli_close($con);
echo json_encode($data);
?>