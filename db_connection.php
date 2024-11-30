<?php
// db_connection.php

// Database connection details
$host = 'localhost'; // Replace with your host
$username = 'root';  // Replace with your DB username
$password = '';      // Replace with your DB password
$dbname = 'jewelry_shop'; // Replace with your DB name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
