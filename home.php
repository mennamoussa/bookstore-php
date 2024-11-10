<?php
// home.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Bookstore App</title>
    <link rel="stylesheet" href="home-style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Bookstore App!</h1>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        
        <div class="section view-books">
            <h2>Discover Our Collection</h2>
            <p>Browse through our collection of books from various genres and find your next read!</p>
            <button onclick="window.location.href='view_books.php'">View Books</button>
        </div>

        <div class="section request-book">
            <h2>Request a Book</h2>
            <p>Looking for a book that isn't in our collection? Request it here, and we'll do our best to add it!</p>
            <button onclick="window.location.href='request_book.php'">Request a Book</button>
        </div>

        <div class="section logout">
            <h2>Logout</h2>
            <p>Ready to leave? Click below to log out of your account.</p>
            <button onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>
</body>
</html>

