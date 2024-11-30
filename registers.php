
<?php
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['Password']);

    // Check if the username or email already exists
    $checkSql = "SELECT * FROM register WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
      echo "<script>alert('Username or Email already exists. Please choose another.');</script>";
  } else {
      // Hash the password before storing
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
      // SQL query to insert data
      $sql = "INSERT INTO register(username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashedPassword')";
  
      if ($conn->query($sql) === TRUE) {
          // Redirect to login page after successful registration
          header("Location: account.php");
          exit();
      } else {
          echo "<script>alert('Error: " . $conn->error . "');</script>";
      }
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
    <link rel="stylesheet" href="register.css">
    <style>
        body{
    background-color: #F3B9CD;
}
        </style>
</head>
<body>
<form action="" method="post">
    <div class="container">
        <div class="box form-box">
            <header id="header">Registration</header>
            <div class="field-input">
                <label>Username</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>

            <div class="field-input">
                <label>Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="field-input">
                <label>Phone</label>
                <input type="number" name="phone" id="phone" placeholder="Phone" required>
            </div>

            <div class="field-input">
                <label>Password</label>
                <input type="password" name="Password" id="password" placeholder="Password" required>
            </div>

            <div class="field">
                <input type="submit" name="submit" value="Submit" id="btn1">
            </div>

            <div class="back">
                <a href="account.php">Next</a>
            </div>
        </div>
    </div>
</form>
<br>
</body>
</html>