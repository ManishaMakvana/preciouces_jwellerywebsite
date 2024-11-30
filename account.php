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
    $sql = "INSERT INTO logins (email, password) VALUES ('$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to home.html after successful registration
        header("Location: home.php");
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
    <title>login</title>
    <style>
        /* General styling */
body {
    font-family: 'Roboto', sans-serif;
    background: #F3B9CD;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

/* Form container */
#log {
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

/* Form heading */
#log h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color:rgb(242, 104, 132);
    font-weight: bold;
}

/* Form table */
table {
    width: 100%;
    margin: 0 auto;
    border-spacing: 10px;
}

/* Input labels */
label {
    font-size: 14px;
    color: #666;
}

/* Input fields */
.form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    box-sizing: border-box;
    transition: 0.3s;
}

/* Input focus styling */
.form-input:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
    outline: none;
}

/* Submit button */
.log-in {
    background-color: rgb(242, 104, 132);
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Submit button hover */
.log-in:hover {
    background-color: #45a049;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

/* Responsive adjustments */
@media (max-width: 480px) {
    #log {
        padding: 20px;
    }

    table td {
        padding: 5px;
    }

    .log-in {
        font-size: 14px;
    }

    .form-input {
        font-size: 12px;
    }
}

        </style>
</head>
<body>
    <form action="" method="post">
        <div id="log">
            <h1>login</h1>
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




