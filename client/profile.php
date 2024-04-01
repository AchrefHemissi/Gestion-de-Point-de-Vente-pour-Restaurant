<?php
session_start();
if(!isset($_SESSION['user_id'])){
   header("Location: ../login/index.php");
   exit;
}

require_once 'connexionBD.php';
$conn = ConnexionBD::getInstance();
$query = "SELECT * FROM utilisateur WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>my profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="shortcut icon" type="x-icon" href="images/logo.png" />
   
</head>
<body>
   
<header class="header">

   <section class="flex">

      <a href="home.html" class="logo"><b>GL-icious </b> 😋</a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="menu.php">menu</a>
         <a href="orders.php">orders</a>
         <a href="contact.html">contact</a>
      </nav>

      <div class="icons">
         <a href="search.html"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span><?php echo isset($_SESSION['cart']) ? '('.count($_SESSION['cart']).')' : 0; ?></span></a>
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
   <h3>my profile</h3>
   <p><a href="home.php">home </a> <span> / profile</span></p>
</div>

<section class="user-details">

   <div class="user">
      <img src="images/user-icon.png" alt="">
      <p><i class="fas fa-user"></i> <span><?php echo $user['prenom'].' '.$user['nom'] ?></span></p>
      <p><i class="fas fa-envelope"></i> <span><?php echo $user['email'] ?></span></p>
      <p><i class="fas fa-phone"></i> <span><?php echo $user['num_tel'] ?></span></p>
      
      
   </div>

</section>

