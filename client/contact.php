<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
   <title>contact us</title>

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

   <div class="heading">
      <h3>contact us</h3>
      <p><a href="home.php">home </a> <span> / contact</span></p>
   </div>
   <section class="contact">

      <div class="row">
         <div class="image">
            <img src="images/contact-img.svg" alt="">
         </div>

         <form action="sendmail.php" method="post">
            <h3>tell us something!</h3>
            <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box" id="email">
            <textarea name="msg" placeholder="enter your message" required class="box" cols="30" rows="10" maxlength="500" id="msg"></textarea>
            <input type="submit" value="send message" class="btn" name="send">
         </form>

      </div>

   </section>

   <footer class="footer">

      <section class="box-container">

         <div class="box">
            <img src="images/email-icon.png" alt="">
            <h3>our email</h3>
            <a href="mailto:gl.icious.team@gmail.com">gl.icious.team@gmail.com</a>
         </div>

         <div class="box">
            <img src="images/phone-icon.png" alt="">
            <h3>our number</h3>
            <a href="tel: +216 0000 0000">+216 0000 0000</a>
         </div>

      </section>

      <div class="credit"><span></span></div>

   </footer>

   <div class="loader">
      <img src="images/loader.gif" alt="">
   </div>

   <script src="js/script.js"></script>

</body>

</html>