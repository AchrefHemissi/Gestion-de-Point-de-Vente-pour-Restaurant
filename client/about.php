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
   <title>about us</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

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
         <a href="home.html">home</a>
         <a href="about.html">about</a>
         <a href="menu.html">menu</a>
         <a href="orders.html">orders</a>
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
            <a href="#" class="delete-btn">logout</a>
         </div>
         <p class="account"><a href="login.html">login</a> or <a href="register.html">register</a></p>
      </div>

   </section>

</header>

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.html">home </a> <span> / about</span></p>
</div>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quis non odit nihil, doloremque sunt aut placeat culpa. Adipisci minima, neque necessitatibus incidunt nemo eveniet mollitia quis facere vel consectetur culpa?</p>
         <a href="menu.html" class="btn">our menu</a>
      </div>

   </div>

</section>

<section class="steps">

   <h1 class="title">3 simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>select food</h3>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, hic.</p>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>30 minutes delivery</h3>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, hic.</p>
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food!</h3>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, hic.</p>
      </div>

   </div>

</section>






<footer class="footer">

   <section class="box-container">

      <div class="box">
         <img src="images/clock-icon.png" alt="">
         <h3>Opening Hours</h3>
         <p>09:00 to 20:00 </p>
      </div>

      <div class="box">
         <img src="images/map-icon.png" alt="">
         <h3>our address</h3>
         <a href="https://www.google.com/maps">676 Centre Urbain Nord BP, Tunis 1080</a>
      </div>


   </section>

   <div class="credit"></div>

</footer>






<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor:true,
            spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
   },
   breakpoints: {
      550: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>