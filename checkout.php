<?php
session_start();

// Check if a product exists in the cart
if (!isset($_SESSION['cart'])) {
    // Redirect to the product list if no cart exists
    header('Location: home.php');
    exit();
}

// Retrieve product details from the session
$product = $_SESSION['cart'];
$total_price = $product['sale_price'] ?? $product['price'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <div class="product-details">
            <div class="image-container">
                <img src="data:image/jpeg;base64,<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="300" height="300">
            </div>
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p>Price: ₹<?= htmlspecialchars($product['price']) ?></p>
            <?php if (!empty($product['sale_price'])): ?>
                <p>Sale Price: ₹<?= htmlspecialchars($product['sale_price']) ?></p>
            <?php endif; ?>
            <p><strong>Total Price: ₹<?= htmlspecialchars($total_price) ?></strong></p>
        </div>

        <form action="finalize_order.php" method="POST" class="checkout-form">
            <h3>Billing Details</h3>
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Shipping Address</label>
            <textarea id="address" name="address" rows="4" required></textarea>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>

            <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
            <input type="hidden" name="total_price" value="<?= htmlspecialchars($total_price) ?>">

            <button type="submit" class="button">Confirm Order</button>
        </form>

        <a href="home.php" class="button">Return to Products</a>
    </div>
</body>
</html>
