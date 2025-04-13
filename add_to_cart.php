<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    // Check if the book is already in the user's cart
    $query = "SELECT * FROM cart WHERE user_id = $user_id AND book_id = $book_id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Increment quantity
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND book_id = $book_id";
    } else {
        // Add new entry
        $query = "INSERT INTO cart (user_id, book_id, quantity) VALUES ($user_id, $book_id, 1)";
    }
    mysqli_query($conn, $query);
    
    // Update session cart (optional, for immediate display)
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    $_SESSION['cart'][$book_id] = isset($_SESSION['cart'][$book_id]) ? $_SESSION['cart'][$book_id] + 1 : 1;
    
    header("Location: catalog.php");
    exit;
}
?>