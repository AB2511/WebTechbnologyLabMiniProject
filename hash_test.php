<?php
$plain_password = 'admin1234'; // Use the password you intend to log in with
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
echo $hashed_password;
?>