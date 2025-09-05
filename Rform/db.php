<?php
// db.php - Database connection using PDO

$host = "localhost";           // Database host
<<<<<<< HEAD
$port = 3306;                // Database port (default is 3306, change if necessary)
=======
<<<<<<< HEAD
$port = 3360;                // Database port (default is 3306, change if necessary)
=======
$port = 3307;                // Database port (default is 3306, change if necessary)
>>>>>>> 4cf54e5d1190742eaec87d42ef47ff12774c3b1d
>>>>>>> ddc507c7343646d5f8aa8824abb7ab4f0e8409c9
$dbname = "registration_db";   // Database name
$user = "root";                // MySQL username
$pass = "root";                    // MySQL password

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
