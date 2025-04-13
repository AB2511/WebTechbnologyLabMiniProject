<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Query to fetch cart items
$query = "SELECT c.book_id, c.quantity, b.title, b.price 
          FROM cart c 
          JOIN books b ON c.book_id = b.id 
          WHERE c.user_id = $user_id";
$result = mysqli_query($conn, $query);

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="cart_export.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Add CSV headers
fputcsv($output, ['Title', 'Price', 'Quantity', 'Subtotal']);

// Write cart data to CSV
while ($row = mysqli_fetch_assoc($result)) {
    $subtotal = $row['price'] * $row['quantity'];
    fputcsv($output, [$row['title'], $row['price'], $row['quantity'], $subtotal]);
}

fclose($output);
exit;
?>