<?php
session_start(); // Start the session
if (isset($_POST['id'])) {
    $productId = $_POST['id'];
    // Remove the product from the session cart
    unset($_SESSION['cart'][$productId]);
    // Return a success response
    http_response_code(200);
} else {
    // Return an error response if the product ID is not provided
    http_response_code(400);
}
?>

