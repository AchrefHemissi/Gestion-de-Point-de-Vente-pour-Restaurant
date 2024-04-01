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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>food menu</title>

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
            ><i class="fas fa-shopping-cart"></i><span><?php echo isset($_SESSION['cart']) ? '('.count($_SESSION['cart']).')' : 0; ?></span></a
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
      <h3>our dessert</h3>
      <p><a href="home.php">home </a> <span> / category</span></p>
    </div>

    <section class="products">
      <h1 class="title">dessert</h1>

      <div class="box-container">
        

        

        <form action = "cart.php" accept="" method="post" class="box">
          
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="images/cheesecake.jpg" alt="" />
          <a href="dessert.php" class="cat">dessert</a>
          <div class="name">Cheese Cake </div>
          <div class="flex">
            <div class="price"><span>$</span>5</div>
            <input hidden name="id" value = "4">
            <input hidden name="name" value = "Cheese Cake">
            <input hidden name="price" value = "5" class="unit-price">
            <input hidden name="imglink" value = "images/cheesecake.jpg">
            <input
              type="number"
              name="qty"
              class="qty"
              min="1"
              max="99"
              value="1"
              onkeypress="if(this.value.length == 2) return false;"
            />
          </div>
          <div class="sub-total">total : $ <span>5</span></div>
        </form>

        

        

        


        <form action = "cart.php" accept="" method="post" class="box">
        
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="uploaded_img/dessert-2.png" alt="" />
          <a href="dessert.php" class="cat">dessert</a>
          <div class="name">Tiramisu</div>
          <div class="flex">
            <div class="price"><span>$</span>10</div>
            <input hidden name="id" value = "10">
            <input hidden name="name" value = "Tiramisu">
            <input hidden name="price" value = "10" class="unit-price">
            <input hidden name="imglink" value = "uploaded_img/dessert-2.png">
            <input
              type="number"
              name="qty"
              class="qty"
              min="1"
              max="99"
              value="1"
              onkeypress="if(this.value.length == 2) return false;"
            />
          </div>
          <div class="sub-total">total : $ <span>10</span></div>
        </form>
      </div>
    </section>

    <div class="loader">
      <img src="images/loader.gif" alt="" />
    </div>

    <script src="js/script.js"></script>
    <script src="js/total_price.js"></script>
  </body>
</html>
