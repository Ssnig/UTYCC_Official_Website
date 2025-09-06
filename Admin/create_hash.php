<?php
// Replace 'YourSecurePassword' with the password you want to use.
$passwordToHash = 'YourSecurePassword'; 

$hashedPassword = password_hash($passwordToHash, PASSWORD_DEFAULT);

echo "Username: admin<br>";
echo "Hashed Password: " . $hashedPassword;
?>