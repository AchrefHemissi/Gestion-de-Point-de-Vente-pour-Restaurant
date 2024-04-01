    <?php
    $serveur = 'localhost';
    $utilisateur = 'root';
    $motdepasse = '';
    $base_de_donnees = 'if0_36253541_glicious';
    $con = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    };
    $sql = "SELECT c.id as cid,c.date_commande as cdate,c.lieu as clieu, u.nom as lname, u.prenom as fname,u.num_tel as unum_tel, p.name as prod, o.quantite as quan FROM commande c
                Join utilisateur u on u.id=c.id_client
                Join ordproduit o on o.id_commande=c.id
                Join produit p on p.id=o.id_produit 
                where c.etat=0
                order by c.id asc";
    $res = mysqli_query($con, $sql);

    $orders = [];
    while ($row = mysqli_fetch_assoc($res)) {
      $orders[$row["cid"]][] = $row;
    }

    echo json_encode($orders);
    ?>