<?php
include 'session_check.php';
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
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span><?php echo isset($_SESSION['cart']) ? '(' . count($_SESSION['cart']) . ')' : 0; ?></span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
         </div>

         <div class="profile">
            <p class="name"><?php echo $user['prenom'] . ' ' . $user['nom'] ?></p>
            <div class="flex">
               <a href="profile.php" class="btn">profile</a>
               <a href="logout.php" class="delete-btn">logout</a>
            </div>

      </section>

   </header>

   <section class="search-form">
      <form action="searchResult.php" method="post">
         <input type="text" class="box" name="search_box" placeholder="search here..." maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>
   </section>

   <section class="products" style="padding-top: 0; min-height: 100vh;"></section>



   <div class="loader">
      <img src="images/loader.gif" alt="">
   </div>

   <script src="js/script.js"></script>

</body>

</html>