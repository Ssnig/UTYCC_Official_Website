<?php
// db.php - Database connection using PDO

$host = "localhost";            // Database host
<<<<<<< HEAD
$port = 3306;                   // Database port (default is 3306, change if necessary)
=======
$port = 3360;                   // Database port (default is 3306, change if necessary)
>>>>>>> 0cbc19c9b6846725117f96b0abda5435310f924c
$host = "localhost";           // Database host
$dbname = "registration_db";   // Database name
$user = "root";                // MySQL username
$pass = "root";                // MySQL password

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: show success message (comment out if not needed)
    // echo "✅ Connected to database successfully!";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>
