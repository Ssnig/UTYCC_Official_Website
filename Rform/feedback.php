<?php
// Start the session to store CSRF token and messages.
session_start();
include "db.php"; // Include your database connection.

// Generate a CSRF token if one doesn't exist.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$message = '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. CSRF Token Validation
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        // CSRF token mismatch
        $message_html = generateMessage("Invalid request. Please try submitting the form again.", "error");
    } else {
        // 2. Input Validation
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['comments'])) {
            $message_html = generateMessage("Please fill out all required fields.", "warning");
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $message_html = generateMessage("Please provide a valid university email address.", "warning");
        } else {
            // 3. Database Insertion
            try {
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $comments = trim($_POST['comments']);

                $sql = "INSERT INTO feedback (student_name, student_email, message) VALUES (:name, :email, :comments)";
                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    // Redirect on success to prevent form resubmission (Post-Redirect-Get pattern)
                    header("Location: " . $_SERVER['PHP_SELF'] . "?status=success");
                    exit();
                } else {
                    $message_html = generateMessage("Database error: Could not save your inquiry.", "error");
                }
            } catch (PDOException $e) {
                error_log("PDO Error: " . $e->getMessage());
                $message_html = generateMessage("A database error occurred. Please try again later.", "error");
            }
        }
        $message = $message_html;
    }
}

// Display success message after redirect
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $message = generateMessage("Thank you! Your inquiry has been submitted. We will get back to you shortly.", "success");
}

function generateMessage($text, $type) {
    $bgColor = '';
    $textColor = '';
    $icon = '';

    if ($type === 'success') {
        $bgColor = 'bg-green-100 border-green-400';
        $textColor = 'text-green-700';
        $icon = '<i class="fa-solid fa-circle-check fa-lg mr-3"></i>';
    } elseif ($type === 'warning') {
        $bgColor = 'bg-yellow-100 border-yellow-400';
        $textColor = 'text-yellow-700';
        $icon = '<i class="fa-solid fa-triangle-exclamation fa-lg mr-3"></i>';
    } else { // error
        $bgColor = 'bg-red-100 border-red-400';
        $textColor = 'text-red-700';
        $icon = '<i class="fa-solid fa-circle-xmark fa-lg mr-3"></i>';
    }

    return "
        <div class='{$bgColor} {$textColor} font-bold px-4 py-3 rounded-md shadow-lg flex items-center justify-between mb-4 animate-fade-down' role='alert'>
            <div class='flex items-center'>
                {$icon}
                <span>{$text}</span>
            </div>
            <button type='button' onclick='this.parentElement.remove()' class='-mr-1 ml-2 p-1 rounded-md hover:bg-white/30 transition'>
               <i class='fa-solid fa-xmark'></i>
            </button>
        </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Support - University Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
      /* Base animation classes */
      .animate-fade-in { animation: fadeIn 0.6s ease-out forwards; }
      .animate-fade-up { animation: fadeUp 0.6s ease-out forwards; }
      .animate-fade-down { animation: fadeDown 0.5s ease-out forwards; }
      .animate-scale-in { animation: scaleIn 0.5s ease-out forwards; }

      @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
      @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
      @keyframes fadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
      @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen font-sans opacity-0 animate-fade-in">
    
    <?php include 'feedPartials/header.php'; ?>

    <header class="text-center mb-12 opacity-0 animate-fade-up py-10" style="animation-delay: 0.2s">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-3">Contact Support</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Have a question or facing an issue? We're here to help.</p>
    </header>

    <div class="bg-white rounded-xl shadow-2xl p-8 max-w-3xl mx-auto mb-16 opacity-0 animate-scale-in" style="animation-delay: 0.4s">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Submit an Inquiry</h2>

        <!-- Message container for PHP responses -->
        <div id="message-container" class="mb-4">
            <?php echo $message; ?>
        </div>

        <form id="supportForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-6">
            <!-- CSRF Token -->
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

            <!-- Name Field -->
            <div class="opacity-0 animate-fade-up" style="animation-delay: 0.6s">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-user text-gray-400"></i>
                    </div>
                    <input type="text" id="name" name="name" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Your Full Name" required />
                </div>
            </div>

            <!-- Email Field -->
            <div class="opacity-0 animate-fade-up" style="animation-delay: 0.7s">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                       <i class="fa-solid fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="yourmail@email.com" required/>
                </div>
            </div>

            <!-- Comments Field -->
            <div class="opacity-0 animate-fade-up" style="animation-delay: 0.8s">
                <label for="comments" class="block text-sm font-medium text-gray-700 mb-1">Please describe your issue</label>
                <textarea id="comments" name="comments" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Please provide as much detail as possible..." required></textarea>
            </div>
            
            <div class="pt-2 opacity-0 animate-fade-up" style="animation-delay: 0.9s">
                <button type="submit" id="submitBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center relative overflow-hidden transform hover:scale-105">
                    <span id="button-text" class="flex items-center">
                        <i class="fa-solid fa-paper-plane mr-2"></i>
                        Send Message
                    </span>
                </button>
            </div>
        </form>
    </div>

    <?php include 'feedPartials/footer.php'; ?> 

    <script>
        // This script cleans the URL after a successful submission so if the user reloads, 
        // they don't see the "?status=success" message again.
        if (window.location.search.includes('status=success')) {
            history.replaceState(null, '', window.location.pathname);
        }
    </script>
</body>
</html>

