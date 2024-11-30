<?php
session_start();

if (isset($_GET['product_id'])) {
    $product_id = htmlspecialchars($_GET['product_id']);

    // Remove the product from the cart
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Redirect back to the confirm_order.php page
header('Location: confirm_order.php');
exit();
