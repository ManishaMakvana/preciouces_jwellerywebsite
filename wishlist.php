
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "jewelry_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data is received via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
    $product_price = floatval($_POST['product_price']);
    $product_image = base64_decode($_POST['product_image']); // Decode the base64 image
    $user_id = 1; // Replace with actual logged-in user ID or session value

    // Insert data into the wishlist table
    $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id, product_name, product_price, product_image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisds", $user_id, $product_id, $product_name, $product_price, $product_image);

    if ($stmt->execute()) {
        echo "Product added to wishlist!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Redirect back to the wishlist display page
header("Location: display_wishlist.php");
exit;
?>
