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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home</title>

    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
    />

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
        <a href="home.php" class="logo"> <b>GL-icious </b> 😋</a>

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

    <section class="home">
      <div class="swiper home-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide slide">
            <div class="content">
              <span>order online</span>
              <h3>delicious pizza</h3>
              <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
              <img src="images/home-img-1.png" alt="" />
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="content">
              <span>order online</span>
              <h3>double hamburger</h3>
              <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
              <img src="images/home-img-2.png" alt="" />
            </div>
          </div>

          <div class="swiper-slide slide">
            <div class="content">
              <span>order online</span>
              <h3>roasted chicken</h3>
              <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
              <img src="images/home-img-3.png" alt="" />
            </div>
          </div>
        </div>

        <div class="swiper-pagination"></div>
      </div>
    </section>

    <section class="category">
      <h1 class="title">food category</h1>

      <div class="box-container">
        <a href="fast_food.php" class="box">
          <img src="images/cat-1.png" alt="" />
          <h3>fast food</h3>
        </a>

        <a href="dishes.php" class="box">
          <img src="images/cat-2.png" alt="" />
          <h3>main dishes</h3>
        </a>

        <a href="drink.php " class="box">
          <img src="images/cat-3.png" alt="" />
          <h3>drinks</h3>
        </a>

        <a href="dessert.php" class="box">
          <img src="images/cat-4.png" alt="" />
          <h3>desserts</h3>
        </a>
      </div>
    </section>

    <section class="products">
      <h1 class="title">latest dishes</h1>

     
      <div class="box-container">
        <form action = "cart.php"  method="post" class="box">
          
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="uploaded_img/pizza-1.png" alt="" />
          <a href="fast_food.php" class="cat">fast food</a>
          <div class="name"> Pizza </div>
          <div class="flex">
            <div class="price"><span>$</span>3<span>/-</span></div>
            <input hidden name="id" value = "1">
            <input hidden name="name" value = "Pizza">
            <input hidden name="price" value = "3">
            <input hidden name="imglink" value = "uploaded_img/pizza-1.png">
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
        </form>

        <form action = "cart.php" accept="" method="post" class="box">
         
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="images/spaghetti.jpg" />
          <a href="dishes.php" class="cat">dishes</a>
          <div class="name">Spaghetti</div>
          <div class="flex">
            <div class="price"><span>$</span>4.5<span>/-</span></div>
            <input hidden name="id" value = "2">
            <input hidden name="name" value = "Spaghetti">
            <input hidden name="price" value = "4.5">
            <input hidden name="imglink" value = "images/spaghetti.jpg">

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
        </form>

        <form action = "cart.php" accept="" method="post" class="box">
          
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="uploaded_img/burger-1.png" alt="" />
          <a href="fast_food.php" class="cat">fast food</a>
          <div class="name"> Hamburger </div>
          <div class="flex">
            <div class="price"><span>$</span>11<span>/-</span></div>
            <input hidden name="id" value = "3">
            <input hidden name="name" value = "Hamburger">
            <input hidden name="price" value = "11">
            <input hidden name="imglink" value = "uploaded_img/burger-1.png">
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
        </form>

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
            <div class="price"><span>$</span>5<span>/-</span></div>
            <input hidden name="id" value = "4">
            <input hidden name="name" value = "Cheese Cake">
            <input hidden name="price" value = "5">
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
        </form>

        <form action = "cart.php" accept="" method="post" class="box">
         
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="uploaded_img/drink-1.png" alt="" />
          <a href="drink.php" class="cat">drinks</a>
          <div class="name">Orange Juice</div>
          <div class="flex">
            <div class="price"><span>$</span>7<span>/-</span></div>
            <input hidden name="id" value = "5">
            <input hidden name="name" value = "Orange Juice">
            <input hidden name="price" value = "7">
            <input hidden name="imglink" value = "uploaded_img/drink-1.png">
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
        </form>

        <form action = "cart.php" accept="" method="post" class="box">
         
          <button
            class="fas fa-shopping-cart"
            type="submit"
            name="add_to_cart"
          ></button>
          <img src="images/chawarma.avif" alt="" />
          <a href="dishes.php" class="cat">dishes</a>
          <div class="name">Chawarma</div>
          <div class="flex">
            <div class="price"><span>$</span>14<span>/-</span></div>
            <input hidden name="id" value = "6">
            <input hidden name="name" value = "Chawarma">
            <input hidden name="price" value = "14">
            <input hidden name="imglink" value = "images/chawarma.avif">
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
        </form>
      </div>

      <div class="more-btn">
        <a href="menu.php" class="btn">veiw all</a>
      </div>
    </section>

    <div class="loader">
      <img src="images/loader.gif" alt="" />
    </div>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

    <script>
      var swiper = new Swiper(".home-slider", {
        loop: true,
        grabCursor: true,
        effect: "flip",
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      });
    </script>
  </body>
</html>
