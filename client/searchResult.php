<?php

include 'session_check.php';

if (!isset($_POST['search_box'])) {
  header("Location: search.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

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
    <h3>Result</h3>
    <p><a href="home.php">home </a> <span> / menu</span></p>
  </div>

  <section class="products">
    <h1 class="title">latest dishes</h1>

    <div class="box-container">
      <form action="cart.php" method="post" class="box" id="pizza" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="uploaded_img/pizza-1.png" alt="" />
        <a href="fast_food.php" class="cat">fast food</a>
        <div class="name"> Pizza </div>
        <div class="flex">
          <div class="price"><span>$</span>3</div>
          <input hidden name="id" value="1">
          <input hidden name="name" value="Pizza">
          <input hidden name="price" value="3" class="unit-price">
          <input hidden name="imglink" value="uploaded_img/pizza-1.png">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />


        </div>
        <div class="sub-total">total : $ <span>3</span></div>

      </form>

      <form action="cart.php" accept="" method="post" class="box" id="spaghetti" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="images/spaghetti.jpg" />
        <a href="dishes.php" class="cat">dishes</a>
        <div class="name">Spaghetti</div>
        <div class="flex">
          <div class="price"><span>$</span>4.5 </div>
          <input hidden name="id" value="2">
          <input hidden name="name" value="Spaghetti">
          <input hidden name="price" value="4.5" class="unit-price">
          <input hidden name="imglink" value="images/spaghetti.jpg">

          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>4.5</span></div>

      </form>

      <form action="cart.php" accept="" method="post" class="box" id="hamburger" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="uploaded_img/burger-1.png" alt="" />
        <a href="fast_food.php" class="cat">fast food</a>
        <div class="name"> Hamburger </div>
        <div class="flex">
          <div class="price"><span>$</span>11 </div>
          <input hidden name="id" value="3">
          <input hidden name="name" value="Hamburger">
          <input hidden name="price" value="11" class="unit-price">
          <input hidden name="imglink" value="uploaded_img/burger-1.png">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>11</span></div>
      </form>

      <form action="cart.php" accept="" method="post" class="box" id="cheese_cake" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="images/cheesecake.jpg" alt="" />
        <a href="dessert.php" class="cat">dessert</a>
        <div class="name">Cheese Cake </div>
        <div class="flex">
          <div class="price"><span>$</span>5 </div>
          <input hidden name="id" value="4">
          <input hidden name="name" value="Cheese Cake">
          <input hidden name="price" value="5" class="unit-price">
          <input hidden name="imglink" value="images/cheesecake.jpg">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>5</span></div>

      </form>

      <form action="cart.php" accept="" method="post" class="box" id="orange_juice" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="uploaded_img/drink-1.png" alt="" />
        <a href="drink.php" class="cat">drinks</a>
        <div class="name">Orange Juice</div>
        <div class="flex">
          <div class="price"><span>$</span>7 </div>
          <input hidden name="id" value="5">
          <input hidden name="name" value="Orange Juice">
          <input hidden name="price" value="7" class="unit-price">
          <input hidden name="imglink" value="uploaded_img/drink-1.png">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>7</span></div>
      </form>

      <form action="cart.php" accept="" method="post" class="box" id="chawarma" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="images/chawarma.avif" alt="" />
        <a href="dishes.php" class="cat">dishes</a>
        <div class="name">Chawarma</div>
        <div class="flex">
          <div class="price"><span>$</span>14 </div>
          <input hidden name="id" value="6">
          <input hidden name="name" value="Chawarma">
          <input hidden name="price" value="14" class="unit-price">
          <input hidden name="imglink" value="images/chawarma.avif">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>14</span></div>
      </form>

      <form action="cart.php" accept="" method="post" class="box" id="fries" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="images/fries.jpg" alt="" />
        <a href="fast_food.php" class="cat">fast food</a>
        <div class="name">Fries</div>
        <div class="flex">
          <div class="price"><span>$</span>7 </div>
          <input hidden name="id" value="7">
          <input hidden name="name" value="Fries">
          <input hidden name="price" value="7" class="unit-price">
          <input hidden name="imglink" value="images/fries.jpg">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>7</span></div>
      </form>

      <form action="cart.php" accept="" method="post" class="box" id="fried_chicken" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="images/FriedChicken.jpg" alt="" />
        <a href="fast_food.php" class="cat">fast food</a>
        <div class="name">Fried Chicken</div>
        <div class="flex">
          <div class="price"><span>$</span>13 </div>
          <input hidden name="id" value="8">
          <input hidden name="name" value="Fried Chicken">
          <input hidden name="price" value="13" class="unit-price">
          <input hidden name="imglink" value="images/FriedChicken.jpg">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>13</span></div>
      </form>

      <form action="cart.php" accept="" method="post" class="box" id="mojito" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="images/mojito.avif" alt="" />
        <a href="drink.php" class="cat">drinks</a>
        <div class="name">Mojito </div>
        <div class="flex">
          <div class="price"><span>$</span>7 </div>
          <input hidden name="id" value="9">
          <input hidden name="name" value="Mojito">
          <input hidden name="price" value="7" class="unit-price">
          <input hidden name="imglink" value="images/mojito.avif">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>7</span></div>
      </form>


      <form action="cart.php" accept="" method="post" class="box" id="tiramisu" hidden>

        <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
        <img src="uploaded_img/dessert-2.png" alt="" />
        <a href="dessert.php" class="cat">dessert</a>
        <div class="name">Tiramisu</div>
        <div class="flex">
          <div class="price"><span>$</span>10 </div>
          <input hidden name="id" value="10">
          <input hidden name="name" value="Tiramisu">
          <input hidden name="price" value="10" class="unit-price">
          <input hidden name="imglink" value="uploaded_img/dessert-2.png">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;" />

        </div>
        <div class="sub-total">total : $ <span>10</span></div>
      </form>
    </div>
  </section>


  <script>
    const ele = document.querySelector("#<?php echo strtolower(str_replace(' ', '_', $_POST['search_box'])) ?>");

    if (!ele) {
      document.querySelector("section.products").innerHTML = "<p class=\"erreur\">No result found for <?php echo $_POST['search_box'] ?></p>";


    } else {
      ele.style.display = "block";
    }
  </script>

  <div class="loader">
    <img src="images/loader.gif" alt="" />
  </div>

  <script src="js/total_price.js"></script>
  <script src="js/script.js"></script>
</body>

</html>