<?php

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $isbn = $_POST['isbn']; 
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    
    $sql = "INSERT INTO orders (book_id, user_id, name, address, order_date) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $book_id, $user_id, $name, $address);
    
    if ($stmt->execute()) {
        // Redirect back to the book details page using the ISBN
        header("Refresh: 3; url=book_details.php?isbn=" . $isbn); // Use the ISBN in the redirect URL
        echo "Your order has been placed successfully! You will be redirected shortly.";
    } else {
        echo "Error placing the order. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
