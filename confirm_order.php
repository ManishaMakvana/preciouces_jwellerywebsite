<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product details from POST
    $product_id = htmlspecialchars($_POST['product_id']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_price = htmlspecialchars($_POST['product_price']);
    $product_image = htmlspecialchars($_POST['product_image']);
    $sale_price = !empty($_POST['sale_price']) ? htmlspecialchars($_POST['sale_price']) : null; // Sale price if available

    // Store product in session for persistence
    $_SESSION['cart'] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'sale_price' => $sale_price,
        'image' => $product_image
    ];
} elseif (isset($_GET['remove']) && $_GET['remove'] === 'true') {
    // Remove product from cart
    unset($_SESSION['cart']);
    header('Location: confirm_order.php');
    exit();
}

// Check if the cart exists
$is_cart_empty = !isset($_SESSION['cart']);
if (!$is_cart_empty) {
    $product = $_SESSION['cart'];
    $total_price = $product['sale_price'] ?? $product['price'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function confirmRemoval() {
            return confirm("Are you sure you want to remove this product?");
        }
    </script>
</head>
<body>
    <div class="confirmation-container">
        <h1>Order Confirmation</h1>

        <?php if ($is_cart_empty): ?>
            <!-- Display message if cart is empty -->
            <p>Your order is empty.</p>
            <a href="home.php" class="button">Return to Products</a>
        <?php else: ?>
            <!-- Display product details -->
            <div class="product-details">
                <div class="image-container">
                    <img src="data:image/jpeg;base64,<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="300" height="300">
                </div>
                <h2><?= $product['name'] ?></h2>
                <p>Price: ₹<?= $product['price'] ?></p>
                <?php if (!empty($product['sale_price'])): ?>
                    <p>Sale Price: ₹<?= $product['sale_price'] ?></p>
                <?php endif; ?>
                <p><strong>Total Price: ₹<?= $total_price ?></strong></p>
            </div>
            <div class="actions">
                <a href="home.php" class="button">Continue Shopping</a>
                <a href="checkout.php?product_id=<?= $product['id'] ?>" class="button">Proceed to Checkout</a>
                <a href="confirm_order.php?remove=true" class="button remove-button" onclick="return confirmRemoval();">Remove</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
