<?php
session_start();

// Database connection
$host = 'localhost';
$db = 'jewelry_shop';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the cart exists
if (!isset($_SESSION['cart'])) {
    // Redirect to the product list if no cart exists
    header('Location: index.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $product_id = htmlspecialchars($_POST['product_id']);
    $product_name = htmlspecialchars($_POST['product_name']);
    $total_price = htmlspecialchars($_POST['total_price']);

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, address, email, phone, product_id, product_name, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisd", $name, $address, $email, $phone, $product_id, $product_name, $total_price);

    if ($stmt->execute()) {
        unset($_SESSION['cart']); // Clear the cart after the order is placed

        // Create an order confirmation message
        $order_confirmation = [
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'product_name' => $product_name,
            'total_price' => $total_price,
        ];
    } else {
        echo "Error: " . $stmt->error;
        exit();
    }

    $stmt->close();
} else {
    // Redirect to the checkout page if the form was not submitted
    header('Location: checkout.php');
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="confirmation-container">
        <h1>Order Confirmed!</h1>
        
        <div class="order-summary">
            <h2>Order Details</h2>
            <p><strong>Customer Name:</strong> <?= $order_confirmation['name'] ?></p>
            <p><strong>Shipping Address:</strong> <?= $order_confirmation['address'] ?></p>
            <p><strong>Email:</strong> <?= $order_confirmation['email'] ?></p>
            <p><strong>Phone:</strong> <?= $order_confirmation['phone'] ?></p>
            <p><strong>Product:</strong> <?= $order_confirmation['product_name'] ?></p>
            <p><strong>Total Price:</strong> ₹<?= $order_confirmation['total_price'] ?></p>
        </div>

        <div class="actions">
            <a href="home.php" class="button">Back to Home</a>
            <a href="order_history.php" class="button">View Order History</a>
        </div>
    </div>
</body>
</html>
