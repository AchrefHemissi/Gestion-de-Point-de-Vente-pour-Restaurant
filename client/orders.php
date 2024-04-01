<?php 
session_start();


if(!isset($_SESSION['user_id'])){
    header("Location: ../login/index.php");
    exit();
    
}


 // Database connection parameters
 require_once 'connexionBD.php';

 // Create connection
 $conn = connexionBD::getInstance();


 // Check connection
 if (!$conn) {
     die("Connection failed: " . $conn->connect_error);
 }
 $query = "SELECT * FROM utilisateur WHERE id = ?";
 $stmt = $conn->prepare($query);
 $stmt->execute([$_SESSION['user_id']]);
 $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $querycom="select * from commande where id_client=".$_SESSION['user_id']."";
    $stmtcom = $conn->prepare($querycom);
    $stmtcom->execute();
    $resultcom = $stmtcom->fetchall(PDO::FETCH_ASSOC);

    $queryuser="select * from utilisateur where id = ".$_SESSION['user_id'];
    $stmtuser = $conn->prepare($queryuser);
    $stmtuser->execute();
    $resultuser = $stmtuser->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>my orders</title>

    <!-- font awesome cdn link  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css" />

    <link rel="shortcut icon" type="x-icon" href="images/logo.png" />
    
  </head>
  <body>
    <header class="header">
      <section class="flex">
        <a href="home.php" class="logo"><b>GL-icious </b> 😋</a>

        <nav class="navbar">
          <a href="home.php">home</a>
          <a href="about.php">about</a>
          <a href="menu.php">menu</a>
          <a href="orders.php">orders</a>
          <a href="contact.php">contact</a>
    
        </nav>

        <div class="icons">
          <a href="search.php"><i class="fas fa-search"></i></a>
          <a href="cart.php"
            ><i class="fas fa-shopping-cart"></i><?php echo isset($_SESSION['cart']) ? '('.count($_SESSION['cart']).')' : 0; ?></a
          >
          <div id="user-btn" class="fas fa-user"></div>
          <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <div class="profile">
         <p class="name"><?php echo $user['prenom'].' '.$user['nom']?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>
      
      </div>
      </section>
    </header>

    <div class="heading">
      <h3>your orders</h3>
      <p><a href="home.php">home </a> <span> / orders</span></p>
    </div>

    <section class="orders">
      <h1 class="title">placed orders</h1>

      <div class="box-container">
        <?php 
        
        foreach($resultcom as $row):
            $prix=0;
            $query1="select * from ordproduit where id_commande=".$row['id']."";
            $stmt1 = $conn->prepare($query1);
            $stmt1->execute();
            $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
            $query2="select name,prix , quantite from produit , ordproduit 
            where id_commande=  ".$row['id']." and id_produit=produit.id";
            $stmt2 = $conn->prepare($query2);
            $stmt2->execute();
            $result2 = $stmt2->fetchall(PDO::FETCH_ASSOC);
    
            ?>
        
        <div class="box">
          <p>placed on : <span><?php echo $row['date_commande'] ?></span></p>
          <p>name : <span><?php echo $resultuser['prenom'] ?></span></p>
          <p>email : <span><?php echo $resultuser['email'] ?></span></p>
          <p>address : <span><?php echo $row['lieu'] ?></span></p>
          <p>your orders : <span><?php
                                        foreach($result2 as $row2 ){            
                                                    echo $row2['name'].'('.$row2['quantite'].') -';
                                                   $prix+=$row2['prix']*$row2['quantite'];
                                                }
                                ?></span></p>
          <p>total price : <span><?php echo $prix.'$' ?></span></p>
          <p>payment method : <span> master carte</span></p>
          <p>payment status : <span>pending</span></p>
        </div>
<?php endforeach; ?>
       
      </div>
    </section>

    <div class="loader">
      <img src="images/loader.gif" alt="" />
    </div>

    <script src="js/script.js"></script>
  </body>
</html>
