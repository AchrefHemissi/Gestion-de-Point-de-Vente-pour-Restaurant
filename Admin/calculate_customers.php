<?php
require_once 'connexionAdminDB.php';
    $con = Database::getInstance();
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT count(*) as total FROM utilisateur";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row['total'];