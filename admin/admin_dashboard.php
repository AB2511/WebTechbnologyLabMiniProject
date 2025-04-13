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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="admin-container">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="add_book.php">Add Book</a></li>
            <?php
            $result = mysqli_query($conn, "SELECT id, title FROM books");
            while ($book = mysqli_fetch_assoc($result)) {
                echo "<li><a href='edit_book.php?id={$book['id']}'>Edit {$book['title']}</a></li>";
                echo "<li><a href='delete_book.php?id={$book['id']}'>Delete {$book['title']}</a></li>";
            }
            ?>
        </ul>
        <a href="../logout.php">Logout</a>
    </div>
</body>
</html>