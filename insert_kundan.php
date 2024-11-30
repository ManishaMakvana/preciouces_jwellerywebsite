
<?php
// Database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewelry_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];

    // Path to the image file
    $imagePath = $_FILES['image']['tmp_name']; // Get the temporary file path

    // Read the image file into a variable
    $imageData = file_get_contents($imagePath);
    $imageData = $conn->real_escape_string($imageData); // Escape the binary data for safe insertion

    // Prepare the SQL statement to insert the product with image
    $sql = "INSERT INTO kundanproduct (name, category, price, sale_price, image_data) 
            VALUES ('$name', '$category', '$price', '$sale_price', '$imageData')";

    if ($conn->query($sql) === TRUE) {
        echo " kundan Product uploaded successfully.";
    } else {
        echo "Error uploading product: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
