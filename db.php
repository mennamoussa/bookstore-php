<?php
// db.php

$servername = "localhost"; // Usually localhost
$username = "root"; // Your MySQL username, typically 'root'
$password = ""; // Your MySQL password, often empty for local setups
$dbname = "bookstore_db"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
