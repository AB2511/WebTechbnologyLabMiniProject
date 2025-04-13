<?php
include '../db.php';
include 'admin_helper.php';

if (!isAdmin()) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="admin-container">
        <h2>Add New Book</h2>
        <form method="POST" class="admin-form">
            Title: <input type="text" name="title" required><br>
            Author: <input type="text" name="author" required><br>
            Price: <input type="number" step="0.01" name="price" required><br>
            Quantity: <input type="number" name="quantity" required><br>
            Image URL: <input type="text" name="image_url" placeholder="e.g., https://example.com/images/book-cover.jpg" required><br>
            <button type="submit">Add Book</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $author = $_POST["author"];
            $price = $_POST["price"];
            $quantity = $_POST["quantity"];
            $image_url = $_POST["image_url"];

            $sql = "INSERT INTO books (title, author, price, quantity, image_url) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdss", $title, $author, $price, $quantity, $image_url);

            if ($stmt->execute()) {
                echo "<div class='feedback'>✅ Book added successfully. <a href='../catalog.php'>View Catalog</a></div>";
            } else {
                echo "<div class='feedback'>❌ Error: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
        ?>
    </div>
</body>
</html>