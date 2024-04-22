<?php
include 'session_check.php';

require_once 'connexionAdminDB.php';
$con = Database::getInstance();
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
