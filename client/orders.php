<?php
session_start();


if (!isset($_SESSION['user_id'])) {
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

$querycom = "select * from commande where id_client=" . $_SESSION['user_id'] . "";
$stmtcom = $conn->prepare($querycom);
$stmtcom->execute();
$resultcom = $stmtcom->fetchall(PDO::FETCH_ASSOC);

$queryuser = "select * from utilisateur where id = " . $_SESSION['user_id'];
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
        <a href="cart.php"><i class="fas fa-shopping-cart"></i><?php echo isset($_SESSION['cart']) ? '(' . count($_SESSION['cart']) . ')' : 0; ?></a>
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
    <h3>your orders</h3>
    <p><a href="home.php">home </a> <span> / orders</span></p>
  </div>

  <section class="orders">
    <h1 class="title">placed orders</h1>

    <div class="box-container">
      <?php

      foreach ($resultcom as $row) :
        $prix = 0;
        $query1 = "select * from ordproduit where id_commande=" . $row['id'] . "";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute();
        $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        $query2 = "select name,prix , quantite from produit , ordproduit 
            where id_commande=  " . $row['id'] . " and id_produit=produit.id";
        $stmt2 = $conn->prepare($query2);
        $stmt2->execute();
        $result2 = $stmt2->fetchall(PDO::FETCH_ASSOC);

      ?>

        <div class="orderbox box">
          <p><b>Placed on :</b> <span><?php echo $row['date_commande'] ?></span></p>
          <p><b>Full Name : </b></span><span><?php echo $resultuser['prenom'] ?>&nbsp;</span><span><?php echo $resultuser['nom'] ?></p></b>
          <p><b>Email :</b> <span><?php echo $resultuser['email'] ?></span></p>
          <p><b>Address :</b> <span><?php echo $row['lieu'] ?></span></p>
          <p><b>Your Orders :</b> <span><?php
                                        foreach ($result2 as $row2) {
                                          echo $row2['name'] . '(' . $row2['quantite'] . ') -';
                                          $prix += $row2['prix'] * $row2['quantite'];
                                        }
                                        ?></span></p>
          <p><b>total price : </b><span><?php echo $prix . '$' ?></span></p>
          <p><b>payment method :</b> <span> Master Card</span></p>
          <button class="pdfbutton">Save as PDF</button>
        </div>

      <?php endforeach; ?>

    </div>
  </section>

  <div class="loader">
    <img src="images/loader.gif" alt="" />
  </div>
  <script src="js/script.js"></script>
  <script>
    var buttons = document.querySelectorAll('.pdfbutton');
    buttons.forEach(function(button) {
      button.addEventListener('click', function() {
        var parentDiv = this.parentElement;
        var clone = parentDiv.cloneNode(true); // Clone the parent div
        var button = clone.querySelector('.pdfbutton'); // Select the button from the clone
        button.parentNode.removeChild(button); // Remove the button from the clone

        clone.style.fontFamily = 'Montserrat, sans-serif';
        var wrapper = document.createElement('div');
        wrapper.style.display = 'flex';
        wrapper.style.justifyContent = 'center';
        wrapper.style.alignItems = 'center';
        wrapper.style.height = '100vh';
        wrapper.appendChild(clone);

        var html = wrapper.innerHTML; // Get the HTML of the clone

        var formData = new FormData();
        formData.append('html', html);

        fetch('generate_pdf.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(data => {
            // The PDF was generated successfully
            window.location.href = data;
          })
          .catch((error) => {
            console.error('Error:', error);
          });
      });
    });
  </script>



</body>

</html>