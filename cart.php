<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$total = 0;

$query = "SELECT c.book_id, c.quantity, b.title, b.price 
          FROM cart c 
          JOIN books b ON c.book_id = b.id 
          WHERE c.user_id = $user_id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cart-container">
        <h2>Your Cart</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php $subtotal = $row['price'] * $row['quantity']; $total += $subtotal; ?>
                <div class="cart-item">
                    <p><?php echo $row['title']; ?></p>
                    <p>Quantity: <?php echo $row['quantity']; ?></p>
                    <p>Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
                    <a href="remove_from_cart.php?book_id=<?php echo $row['book_id']; ?>&user_id=<?php echo $user_id; ?>" class="remove-button">Remove</a>
                </div>
            <?php endwhile; ?>
            <div class="cart-total">
                <h3>Total: $<?php echo number_format($total, 2); ?></h3>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
        <div class="cart-links">
            <a href="catalog.php">Back to Catalog</a>
            <a href="export_cart.php">Export Cart to Excel</a>
        </div>
    </div>
</body>
</html>