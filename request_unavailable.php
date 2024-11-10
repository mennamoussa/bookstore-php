<?php

require 'db.php';

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];

    // Increment the request count for unavailable books
    $sql = "UPDATE books SET request_count = request_count + 1 WHERE isbn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $isbn);

    if ($stmt->execute()) {
        echo "Request recorded successfully! We'll notify you if this book becomes available.";
    } else {
        echo "Error recording request.";
    }

    $stmt->close();
    $conn->close();
}
?>
