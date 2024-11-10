<?php
session_start();
require 'db.php';

// Check if the user is logged in and has an email set in the session
if (!isset($_SESSION['user_email'])) {
    echo "You need to log in to submit a request.";
    exit();
}

$requester_email = $_SESSION['user_email']; // Get email from session
$book_title = $_POST['book_title'];
$author = $_POST['author'];
$requester_name = $_POST['requester_name'];

$sql = "INSERT INTO requests (book_title, author, requester_name, requester_email, request_date) 
        VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $book_title, $author, $requester_name, $requester_email);

if ($stmt->execute()) {
    echo "Request submitted successfully! We will make sure to add it soon!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
