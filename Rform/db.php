<?php
// db.php - Database connection using PDO

<<<<<<< HEAD
$host = "localhost";            // Database host
$port = 3306;                   // Database port (default is 3306, change if necessary)
=======
$host = "localhost";           // Database host
$port = 3307;                // Database port (default is 3306, change if necessary)           // Database port (default is 3306, change if necessary)
>>>>>>> 3c70ff12775f3ee0dd61f00942bd42d7ecd409e8
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
