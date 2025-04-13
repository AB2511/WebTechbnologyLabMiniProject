<?php
function isAdmin() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT is_admin FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user && $user['is_admin'] == 1;
}
?>