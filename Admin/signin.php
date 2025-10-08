<?php
// Session ကိုစတင်ပါ။
session_start();

// Database ချိတ်ဆက်မှုဖိုင်ကို ထည့်သွင်းပါ။
require_once '../Rform/db.php'; // သင်၏ db.php ဖိုင် path ကိုသေချာစစ်ဆေးပါ။

// အကယ်၍ အသုံးပြုသူသည် login ဝင်ပြီးသားဖြစ်ပါက admin dashboard သို့ redirect လုပ်ပါ။
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}

$error_message = '';

// Form မှ POST request ဖြင့် data များရောက်လာခြင်းရှိမရှိ စစ်ဆေးပါ။
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = trim($_POST['admin_user'] ?? '');
    $password = $_POST['password'] ?? '';

    // Field များအားလုံး ဖြည့်ထားခြင်းရှိမရှိ စစ်ဆေးပါ။
    if (empty($admin_user) || empty($password)) {
        $error_message = 'Admin Username နှင့် Password ကိုဖြည့်ပါ။';
    } else {
        try {
            // Database မှ admin အချက်အလက်ကို username ဖြင့် ရှာဖွေပါ။
            $sql = "SELECT id, admin_user, password FROM admins WHERE admin_user = :admin_user";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':admin_user', $admin_user, PDO::PARAM_STR);
            
            $stmt->execute();
            
            // အကယ်၍ admin account ရှိပါက password ကိုစစ်ဆေးပါ။
            if ($stmt->rowCount() == 1) {
                $admin = $stmt->fetch();
                if (password_verify($password, $admin['password'])) {
                    // Password မှန်ကန်ပါက session ကို အသစ်ပြန်လည်သတ်မှတ်ပြီး login အောင်မြင်ကြောင်း မှတ်သားပါ။
                    session_regenerate_id(true);
                    $_SESSION['admin_loggedin'] = true;
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_user'] = $admin['admin_user'];
                    
                    // Admin dashboard သို့ redirect လုပ်ပါ။
                    header("Location: admin_dashboard.php");
                    exit;
                } else {
                    // Password မှားယွင်းနေပါက error message ပြပါ။
                    $error_message = 'Admin Username သို့မဟုတ် Password မှားယွင်းနေပါသည်။';
                }
            } else {
                // Admin account မရှိပါက error message ပြပါ။
                $error_message = 'Admin Username သို့မဟုတ် Password မှားယွင်းနေပါသည်။';
            }
        } catch (PDOException $e) {
            // Database error ဖြစ်ပါက message ပြပါ။
            $error_message = "An error occurred. Please try again later.";
            // error_log($e->getMessage()); // For debugging
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In - UTYCC</title>
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            display: flex;
            width: 100%;
            max-width: 960px;
            margin: 1.5rem;
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-form-panel {
            flex: 1;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-image-panel {
            flex: 1.2;
            display: none;
        }
        @media (min-width: 768px) {
            .login-image-panel {
                display: block;
            }
        }
        .login-image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .toast-container {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            display: grid;
            gap: 0.75rem;
        }
        .toast {
            width: 100%;
            max-width: 350px;
            padding: 1rem 1.25rem;
            border-radius: 0.5rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            animation: slideIn 0.3s ease-out, fadeOut 0.3s ease-in 4.7s forwards;
        }
        .toast.error {
            background-color: #ef4444; /* red-500 */
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
</head>
<body>

    <div class="toast-container" id="toast-container"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-form-panel">
                <div class="text-center md:text-left mb-8">
                    <a href="../index.php" class="inline-flex items-center gap-3 mb-4">
                        <img src="../Img/logo/utycc_logo_favicon/logo.png" alt="UTYCC Logo" class="h-12 w-12">
                        <div>
                             <h1 class="text-2xl font-bold text-gray-800">Admin Panel</h1>
                             <p class="text-sm text-gray-500">University of Technology (YCC)</p>
                        </div>
                    </a>
                    <!-- <h2 class="text-xl font-semibold text-gray-700 mt-2">Welcome Back</h2>
                    <p class="text-sm text-gray-500">Please sign in to continue</p> -->
                </div>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-6">
                    <div>
                        <label for="admin_user" class="block text-sm font-medium text-gray-700 mb-1">Admin Username</label>
                        <input type="text" id="admin_user" name="admin_user" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                               placeholder="e.g., UTYCC_Admin" 
                               value="<?php echo isset($_POST['admin_user']) ? htmlspecialchars($_POST['admin_user']) : ''; ?>" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                               placeholder="••••••••" required>
                    </div>
                    <div>
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-105 active:scale-100">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
            <div class="login-image-panel">
                <img src="../Img/hero-carousel/3.jpg" alt="UTYCC Campus">
            </div>
        </div>
    </div>

    <script>
        function showToast(message, type = 'error') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }
    </script>

    <?php
    if (!empty($error_message)) {
        echo "<script>showToast('" . addslashes($error_message) . "');</script>";
    }
    ?>
</body>
</html>

