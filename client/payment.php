<?php 
Session_start();
if(!isset($_POST['order']) and !isset($_SESSION['payment_message']) ){
    
    header("Location: checkout.php");
    exit();
    
} else {
    if(empty($_SESSION['cart'])){
        $_SESSION['payment_message'] = "Your cart is empty.";
        header("Location: cart.php");
        exit();
    }
      
    
    $total=$_SESSION['total'];
}
if(isset($_POST['address'])){
$_SESSION['address']=$_POST['address'];
}
// $total=$_SESSION['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <p>Total Price: $<span id="totalPrice"><?php echo $total ?></span></p>
        
        <form action = "confirmation.php"  method="post" >
            <label for="creditCardNumber">Number of Credit Cards:</label>
            <input type="text" id="creditCardNumber" name="creditCardNumber" min="1" placeholder="credit card number">
            <br>
            <label for="securityCode">Security Code:</label>
            <input type="text" id="securityCode" name="securityCode" placeholder="credit card code">
            <br>
            <button type="submit">Order</button>
        </form>
        <br>
        <button onclick="location.href='cart.php'">Return to cart</button>
        <?php
        if (isset($_SESSION['payment_message'])) {
            echo '<p color="red">' . $_SESSION['payment_message'] . '</p>';
            unset($_SESSION['payment_message']);
        }
        ?>
    </div>


    
</body>
</html>
