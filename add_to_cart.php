<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product details
    $product_id = htmlspecialchars($_POST['product_id']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_price = htmlspecialchars($_POST['product_price']);
    $product_image = htmlspecialchars($_POST['product_image']);

    // Create a cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the product to the cart
    $_SESSION['cart'][$product_id] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
    ];

    // Redirect to the confirm_order.php page
    header('Location: confirm_order.php');
    exit();
}
