<?php
include 'session_check.php';

if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    unset($_SESSION['cart'][$productId]);

    http_response_code(200);
} else {

    http_response_code(400);
}
