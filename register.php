<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script src="validate.js"></script>
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Register</h2>
            <form name="regForm" method="POST" action="register.php" onsubmit="return validateForm()">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="mobile" placeholder="Mobile (10 digits)" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Register">
            </form>
            <a href="index.php" class="back-button">Back to Welcome</a>
        </div>
    </div>
</body>
</html>

<?php
session_start();
include 'db.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, email, mobile, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $mobile, $password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        header("Location: catalog.php");
        exit;
    } else {
        echo "Registration failed: " . $stmt->error;
    }

    $stmt->close();
}
?>