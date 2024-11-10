<?php
session_start();

require 'db.php';

$isbn = $_GET['isbn'];

// Fetch the book details based on ISBN
$sql = "SELECT * FROM books WHERE isbn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $isbn);
$stmt->execute();
$book = $stmt->get_result()->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Book Details</title>
    <link rel="stylesheet" href="book-details-style.css">
</head>
<body>
    <div class="book-details-container">
        <!-- Left Side: Cover and Purchase Info -->
        <div class="book-cover-section">
            <img src="<?php echo htmlspecialchars($book['cover_image']); ?>" alt="Book Cover">
            <p class="price">$<?php echo htmlspecialchars($book['price']); ?></p>
            
            <!-- Display "Order" if available, otherwise "Request" if unavailable -->
            <?php if ($book['status'] === 'Available'): ?>
                <button onclick="showOrderForm('<?php echo $book['isbn']; ?>')">Order</button>
            <?php else: ?>
                <button onclick="requestBook('<?php echo $book['isbn']; ?>')">Request</button>
            <?php endif; ?>
        </div>
        
        <!-- Right Side: Book Information -->
        <div class="book-info-section">
            <h1><?php echo htmlspecialchars($book['title']); ?></h1>
            <h2>By <?php echo htmlspecialchars($book['author']); ?></h2>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
            <p><strong>ISBN:</strong> <?php echo htmlspecialchars($book['isbn']); ?></p>
        </div>
    </div>

    <!-- Order Form -->
    <div id="orderFormModal" class="order-form-modal">
    <div class="order-form-content">
        <h2>Confirm Your Order</h2>
        <form action="process_order.php" method="POST">
            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>"> 
            <input type="hidden" name="isbn" value="<?php echo $book['isbn']; ?>"> 
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="address">Your Address:</label>
            <textarea id="address" name="address" required></textarea>
            <div class="button-container">
                <button type="button" onclick="closeOrderForm()">Cancel</button>
                <button type="submit">Confirm</button>
            </div>
        </form>
        
    </div>
</div>

    <script>
        // Show the order form modal when "Order" button is clicked
        function showOrderForm(isbn) {
            document.getElementById("orderFormModal").style.display = "block";
        }

        // Close the order form modal
        function closeOrderForm() {
            document.getElementById("orderFormModal").style.display = "none";
        }

        // Request a book if it's unavailable
        function requestBook(isbn) {
            fetch(`request_unavailable.php?isbn=${isbn}`)
                .then(response => response.text())
                .then(message => alert(message))
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
