<?php
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>Book Catalog</h1>
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="cart.php">View Cart</a> | <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> | <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <h1>Book Catalog</h1>
    <div class="book-list">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM books");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='book-item'>
                        <img src='" . $row['image_url'] . "' alt='" . $row['title'] . "' class='book-cover'>
                        <h3>" . $row['title'] . "</h3>
                        <p>Author: " . $row['author'] . "</p>
                        <p>Price: $" . number_format($row['price'], 2) . "</p>
                        <p>Available: " . $row['quantity'] . " copies</p>
                        <a href='add_to_cart.php?id=" . $row['id'] . "'>Add to Cart</a>
                    </div>";
            }
        } else {
            echo "<p>No books available.</p>";
        }
        ?>
    </div>
</body>
</html>