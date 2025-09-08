<?php
// db.php - Database connection using PDO

$host = "localhost";            // Database host
<<<<<<< HEAD
$port = 3306;                   // Database port (default is 3306, change if necessary)
$host = "localhost";           // Database host
=======
$port = 3307;                   // Database port (default is 3306, change if necessary)
>>>>>>> 5deee5ce5a801a2db26949addb3991b70a012bd8
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
