<?php
include '../db.php';
include 'admin_helper.php';

if (!isAdmin()) {
    header("Location: ../login.php");
    exit;
}

$book = null;
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    echo "Debug: ID received = $id<br>";
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    echo "Debug: Query executed, book found = " . ($book ? "Yes" : "No") . "<br>";
    $stmt->close();

    if (!$book) {
        die("<div class='admin-container'><div class='feedback'>❌ Book not found. Debug: ID checked = $id</div></div>");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="admin-container">
        <h2>Edit Book</h2>
        <?php if ($book): ?>
            <form method="POST" class="admin-form">
                Title: <input type="text" name="title" value="<?= htmlspecialchars($book['title'] ?? '') ?>"><br>
                Author: <input type="text" name="author" value="<?= htmlspecialchars($book['author'] ?? '') ?>"><br>
                Price: <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($book['price'] ?? '') ?>"><br>
                Quantity: <input type="number" name="quantity" value="<?= htmlspecialchars($book['quantity'] ?? '') ?>"><br>
                Image URL: <input type="text" name="image_url" value="<?= htmlspecialchars($book['image_url'] ?? '') ?>" placeholder="e.g., https://example.com/images/book-cover.jpg"><br>
                <button type="submit">Update</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $_POST["title"];
                $author = $_POST["author"];
                $price = $_POST["price"];
                $quantity = $_POST["quantity"];
                $image_url = $_POST["image_url"];

                $update = "UPDATE books SET title = ?, author = ?, price = ?, quantity = ?, image_url = ? WHERE id = ?";
                $stmt = $conn->prepare($update);
                $stmt->bind_param("ssdssi", $title, $author, $price, $quantity, $image_url, $id);

                if ($stmt->execute()) {
                    echo "<div class='feedback'>✅ Book updated. <a href='../catalog.php'>Back to Catalog</a></div>";
                } else {
                    echo "<div class='feedback'>❌ Error: " . $stmt->error . "</div>";
                }
                $stmt->close();
            }
            ?>
        <?php else: ?>
            <div class='feedback'>❌ No book ID provided or invalid ID.</div>
        <?php endif; ?>
    </div>
</body>
</html>