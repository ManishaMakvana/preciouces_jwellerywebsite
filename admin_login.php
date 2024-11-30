<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewelry_shop"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect form data
    $email = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Validate email format
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo "<script>alert('Invalid email format');</script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert user
    $sql = "INSERT INTO admin_login (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to home.html after successful registration
        header("Location:admin_dispaly.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="post">
        <div id="log">
            <h1>Admin login</h1>
            <table>
                <tr>
                    <td><label>Email Address</label></td>
                    <td><input class="form-input" id="txt-input" type="email" placeholder="Email Address" name="username" required></td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input class="form-input" type="password" placeholder="Password" id="pwd" name="password" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button class="log-in" name="submit">Submit</button></td>
                </tr>
            </table>
        </div>
    </form>
    <br>
    
</body>
</html>




