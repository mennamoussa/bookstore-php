<?php

require 'db.php';


$sql = "SELECT title, author, isbn, description, price, genre, cover_image, status FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="view-book-style.css">
</head>
<body>
    <h1>Available Books</h1>
    <div class="book-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <!-- Wrap each card in a link to book_details.php with the ISBN as a parameter -->
                <a href="book_details.php?isbn=<?php echo urlencode($row['isbn']); ?>" class="book-link">
                    <div class="book-card">
                        <div class="card-inner">
                            <div class="card-front">
                                <?php if (!empty($row['cover_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($row['cover_image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?> Cover" class="book-cover">
                                <?php endif; ?>
                            </div>
                            <div class="card-back">
                                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                                <p class="author"><?php echo htmlspecialchars($row['author']); ?></p>
                                <p class="price"><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No books are available at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
