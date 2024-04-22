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

         </div>

      </section>

   </header>

   <div class="heading">
      <h3>about us</h3>
      <p><a href="home.php">home </a> <span> / about</span></p>
   </div>

   <section class="about">

      <div class="row">

         <div class="image">
            <img src="images/about-img.svg" alt="">
         </div>

         <div class="content">
            <h3>why choose us?</h3>
            <p>Easy Online Ordering: Our user-friendly website makes ordering your favorite dishes quick and effortless. With just a few clicks, you can browse our menu, customize your order, and have it delivered straight to your doorstep.</br>
               24/7 Accessibility: Craving your favorite dish late at night? No problem! Our website is available 24/7, so you can place an order whenever hunger strikes, day or night.
            </p>
            <a href="menu.php" class="btn">our menu</a>
         </div>

      </div>

   </section>

   <section class="steps">
      <div class="box-container">

         <div class="box">
            <img src="images/step-1.png" alt="">
            <h3>select food</h3>
            <p>Easy access to the whole menu</p>
         </div>

         <div class="box">
            <img src="images/step-3.png" alt="">
            <h3>Enjoy Your Meal!</h3>
            <p>Good Food Is Good Mood</p>
         </div>

      </div>

   </section>






   <footer class="footer">

      <section class="box-container">

         <div class="box">
            <img src="images/clock-icon.png" alt="">
            <h3>Open</h3>
            <p>24/7</p>
         </div>

         <div class="box">
            <img src="images/map-icon.png" alt="">
            <h3>our address</h3>
            <a href="https://www.google.com/maps/place/National+Institute+of+Applied+Science+and+Technology/@36.8429603,10.1830144,15z/data=!4m10!1m2!2m1!1s+676+Centre+Urbain+Nord+BP,+Tunis+1080!3m6!1s0x12fd34c6d1e93bef:0x4153c4733f285343!8m2!3d36.8429605!4d10.1970209!15sCiU2NzYgQ2VudHJlIFVyYmFpbiBOb3JkIEJQLCBUdW5pcyAxMDgwIgOIAQGSARFwdWJsaWNfdW5pdmVyc2l0eeABAA!16s%2Fm%2F0h52xyw?entry=ttu">676 Centre Urbain Nord BP, Tunis 1080</a>
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
         loop: true,
         grabCursor: true,
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