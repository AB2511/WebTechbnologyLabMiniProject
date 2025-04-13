<?php
include '../db.php';
include 'admin_helper.php';

if (!isAdmin()) {
    header("Location: ../login.php");
    exit;
}

$message = '';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id) {
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "<div class='delete-message'>✅ Book deleted. <a href='../catalog.php'>Back to Catalog</a></div>";
    } else {
        $message = "<div class='delete-message'>❌ Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
} elseif ($id) {
    // Display confirmation form
    $stmt = $conn->prepare("SELECT title FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    $stmt->close();

    if (!$book) {
        $message = "<div class='delete-message'>❌ Book not found.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Book</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
    if ($message) {
        echo $message;
    } elseif ($id && $book) {
        echo "<div class='admin-container'>
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete '{$book['title']}'?</p>
                <form method='POST' class='admin-form'>
                    <button type='submit'>Yes, Delete</button>
                </form>
                <a href='../catalog.php' class='back-button'>No, Cancel</a>
              </div>";
    } else {
        echo "<div class='delete-message'>❌ No book ID provided or invalid ID.</div>";
    }
    ?>
</body>
</html>