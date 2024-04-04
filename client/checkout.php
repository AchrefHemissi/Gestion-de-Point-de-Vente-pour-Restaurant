<?php 
session_start();
if(empty($_SESSION['cart'])){
   $_SESSION['cart_message'] = "Your cart is empty.";
   
   header("Location: cart.php");
   exit();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
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
   <title>checkout</title>

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
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><?php echo isset($_SESSION['cart']) ? '('.count($_SESSION['cart']).')' : 0; ?></a>
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
   <h3>checkout</h3>
   <p><a href="home.php">home </a> <span> / checkout</span></p>
</div>

<section class="checkout">

   <h1 class="title">order summary</h1>

   <form action="payment.php" method="post">
      <div class="cart-items">
         <h3>cart items</h3>
        <?php

        foreach($cart as $id => $item): 
        ?>
            <p><span class="name"><?php echo $item['name'].'  '.$item['quantity'] ?></span><span class="price"><?php echo ($item['quantity']*$item['price']).'$'?></span></p>
        <?php endforeach; ?>
         <p class="grand-total"><span class="name">grand total :</span> <span class="price"><?php echo $total.'$'?></span></p>
         <a href="cart.php" class="btn">view cart</a>
      </div>
      <div class="user-info">
         <h3>your info</h3>
         <p><i class="fas fa-user"></i> <span><?php echo $user['nom'].' '.$user['prenom'] ?></span></p>
         <p><i class="fas fa-phone"></i> <span><?php echo $user['num_tel'] ?></span></p>
         <p><i class="fas fa-envelope"></i> <span><?php echo $user['email'] ?></span></p>
         
         <h3>delivery address</h3>
         <p class="address"><i class="fas fa-map-marker-alt"></i> <input class="textaddress" type="text" required placeholder="Write Address Here" name="address"></p>
        
         <select name="method" class="box"  required>
            <option value="" disabled selected>select payment method</option>
            <!-- <option value="cash on delivery">cash on delivery</option> -->
            <option selected value="credit card">credit card</option>
            
        </select>
      </div>
      <input type="submit" value="place order" name="order" class="btn order-btn">
   </form>

</section>



<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>