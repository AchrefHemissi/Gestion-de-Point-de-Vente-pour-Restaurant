<?php
    $serveur = 'localhost';
    $utilisateur = 'root';
        $motdepasse = '';
        $base_de_donnees = 'if0_36253541_glicious';
        $con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT count(*) as total FROM utilisateur";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row['total'];