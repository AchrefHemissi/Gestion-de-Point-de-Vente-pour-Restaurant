<?php
require_once 'connexionAdminDB.php';
$con = Database::getInstance();
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
};

$sql = "SELECT * FROM produit";
$res = mysqli_query($con, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($res)) {
  $data[] = $row['vendu'];
}

mysqli_close($con);

echo json_encode($data);
?>