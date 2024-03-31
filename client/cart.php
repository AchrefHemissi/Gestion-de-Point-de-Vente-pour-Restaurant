<?php
session_start();
function addToCart($id,$name,$price ,$quantity,$imagelink) {
    $_SESSION['cart'][$id] = array(
        'id' => $id,
        'quantity' => $quantity,
        'name' => $name,
        'price' => $price,
        'imagelink' => $imagelink
    );
    // Remove an item from the cart
function removeFromCart($id) {
        unset($_SESSION['cart'][$id]);
    }
}   // Calculate total price of items in the cart
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
// Initialize the shopping cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
}


if(isset($_POST['id']) && isset($_POST['qty'])) {
    $id= $_POST['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $quantity=$_POST['qty'];
    $imagelink=$_POST['imglink'];
    addToCart($id,$name,$price, $quantity,$imagelink);
}
// Add an item to the cart


if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $item) {
        echo "Product ID: " . $id . " - Quantity: " . $item['quantity'] . "<br>";
    }

}    
 else {
    echo "No data submitted.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>my cart</title>

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
         <a href="menu.html">menu</a>
         <a href="orders.php">orders</a>
         <a href="contact.html">contact</a>
      </nav>

      <div class="icons">
         <a href="search.html"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><?php echo isset($_SESSION['cart']) ? '('.count($_SESSION['cart']).')' : 0; ?>
</span></a>
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
   <h3>shopping cart</h3>
   <p><a href="home.html">home </a> <span> / cart</span></p>
</div>

<section class="products">

   <h1 class="title">your cart</h1>

   

   <div class="box-container">
   <style>
    .message {
        font-size: 25px;
        color: red;
    }
</style>

   <?php

if (isset($_SESSION['cart_message'])) {
    echo '<p class="message">' . $_SESSION['cart_message'] . '</p>';
    unset($_SESSION['cart_message']);
}

$cart = $_SESSION['cart'];
$total = 0; 
foreach ($cart as $id=>$item):
?>
<div class="box">
    <a href="quick_view.html" class="fas fa-eye"></a>
    <button class="fas fa-times delete-btn" type="button" data-product-id='<?php echo $id; ?>'></button>
    <img src='<?php echo $item['imagelink'] ?>' alt="">
    <div class="name"><?php echo $item['name']; ?></div>
    <div class="flex">
        <div class="price"><span><?php echo $item['price']?> $</span></div>
        <input type="number" readonly name="qty" class="qty" min="1" max="99" value='<?php echo intval($item['quantity']) ?>'>
    </div>
    <div class="sub-total">total : <span><?php echo (intval($item['quantity']) * ($item['price'])).'$'; ?></span></div>
</div>
<?php
$total += intval($item['quantity']) * ($item['price']);
endforeach;
$_SESSION['total'] = $total;
?>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const productId = btn.getAttribute('data-product-id');
                // Send AJAX request to delete_item.php with productId
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Remove the product box from the DOM if deletion is successful
                            btn.parentElement.remove();
                            //auto reload the page
                            window.location.href = 'cart.php';
                            
                        } else {
                            console.error('Failed to delete product.');
                        }
                    }
                };
                xhr.open('POST', 'delete_product.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + encodeURIComponent(productId));
                
            });
        });
    });
</script>




      
</div>
<div class="cart-total">
      <p>grand total : <span> <?php echo $total.'$' ?> </span></p>
      <a href="checkout.php" class="btn">checkout orders</a>
      </div>
   </div>

   

</section>


<footer class="footer">

   <section class="box-container">

      <div class="box">
         <img src="images/email-icon.png" alt="">
         <h3>our email</h3>
         <a href="mailto:shaikhanas@gmail.com">shaikhanas@gmail.com</a>
         <a href="mailto:anasbhai@gmail.com">anasbhai@gmail.com</a>
      </div>

      <div class="box">
         <img src="images/clock-icon.png" alt="">
         <h3>opening hours</h3>
         <p>00:07am to 00:10pm </p>
      </div>

      <div class="box">
         <img src="images/map-icon.png" alt="">
         <h3>our address</h3>
         <a href="https://www.google.com/maps">mumbai, india - 400104</a>
      </div>

      <div class="box">
         <img src="images/phone-icon.png" alt="">
         <h3>our number</h3>
         <a href="tel:1234567890">+123-456-7890</a>
         <a href="tel:1112223333">+111-222-3333</a>
      </div>

   </section>

   <div class="credit">&copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!</div>

</footer>

<div class="loader">
   <img src="images/loader.gif" alt="">
</div>

<script src="js/script.js"></script>

</body>
</html>