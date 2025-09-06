<?php
// db.php - Database connection using PDO

$host = "localhost";           // Database host
<<<<<<< HEAD
$port = 3360;                // Database port (default is 3306, change if necessary)
=======
// $port = 3307;                // Database port (default is 3306, change if necessary)
// $port = 3306;                // Database port (default is 3306, change if necessary)
$port = "3360";                // Database port (default is 3306, change if necessary)
>>>>>>> ba040016e8e47a311c504f85b47388600c9465f6
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
