<?php
// Start the session to store user login state.
session_start();

// If the user is already logged in, redirect them to the home page.
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: Admin/admin_dashboard.php");
    exit;
}

// --- CONFIGURATION ---
// In a real application, you would get this from a database.
// For this example, we'll use hardcoded values.
$correct_admin_id = 'UTYCC_Admin';
$correct_email = 'admin@utycc.edu.mm';
// IMPORTANT: Never store plain text passwords. Use a hash.
// The hash for 'SecurePassword123' is generated below.
$correct_password_hash = password_hash('SecurePassword123', PASSWORD_DEFAULT);


// --- LOGIN LOGIC ---
$error_message = '';
// Check if the form was submitted using the POST method.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and remove whitespace.
    $admin_id = trim($_POST['admin_id'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // --- VALIDATION ---
    if (empty($admin_id) || empty($email) || empty($password)) {
        $error_message = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // --- AUTHENTICATION ---
        // Check if Admin ID, Email match and if the password is correct.
        if ($admin_id === $correct_admin_id && $email === $correct_email && password_verify($password, $correct_password_hash)) {
            // Login successful.
            session_regenerate_id(true); // Regenerate session ID for security.
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_id'] = $admin_id;
            header("Location: Admin/admin_dashboard.php"); // Redirect to a protected page.
            exit;
        } else {
            // Login failed.
            $error_message = 'Invalid Admin ID, Email, or Password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-light: #ecf0f1;
            --bg-dark: #34495e;
            --card-bg: #ffffff;
            --text-primary: #2c3e50;
            --text-muted: #7f8c8d;
            --border-color: #bdc3c7;
            --accent-color: #3498db;
            --accent-hover: #2980b9;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.08);
            --shadow-dark: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            color: var(--text-primary);
            background: var(--bg-light);
            display: grid;
            place-items: center;
            padding: 16px;
        }

        .auth-wrapper {
            width: min(900px, 95vw);
            display: flex;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            animation: fadeIn .4s ease-out both;
        }

        .shell {
            flex: 1 1 50%;
            padding: 32px 28px;
        }

        .image-panel {
            flex: 1 1 50%;
            display: block;
        }

        .image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .g-head {
            display: grid;
            justify-items: center;
            gap: 8px;
            text-align: center;
            margin-bottom: 8px;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.1);
        }

        h1 {
            margin: 8px 0 4px;
            font-size: 28px;
            font-weight: 700;
        }

        .sub {
            color: var(--text-muted);
            font-size: 15px;
        }

        form {
            display: grid;
            gap: 20px;
            margin-top: 24px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }

        .input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-primary);
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .input::placeholder {
            color: var(--text-muted);
        }

        .input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .link:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }

        .btn {
            appearance: none;
            border: 0;
            cursor: pointer;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 700;
            color: #fff;
            background: var(--accent-color);
            box-shadow: var(--shadow-dark);
            transition: background-color 0.2s ease, transform .1s ease;
        }

        .btn:hover {
            background-color: var(--accent-hover);
        }

        .btn:active {
            transform: translateY(1px);
        }

        footer {
            margin-top: 24px;
            text-align: center;
            font-size: 14px;
        }

        .term-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
        }

        .toast-wrap {
            position: fixed;
            top: 20px;
            right: 20px;
            width: min(360px, 92vw);
            display: grid;
            gap: 12px;
            z-index: 50;
            pointer-events: none;
        }

        .toast {
            pointer-events: auto;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 10px;
            color: var(--card-bg);
            background: var(--text-primary);
            box-shadow: var(--shadow-dark);
            border-left: 4px solid var(--accent-color);
            animation: toastIn .3s ease forwards, toastOut .3s ease 4.2s forwards;
        }

        .toast.error {
            border-left-color: var(--error-color);
        }

        .toast.success {
            border-left-color: var(--success-color);
        }

        .toast .close-btn {
            appearance: none;
            border: 0;
            background: transparent;
            color: #fff;
            opacity: .7;
            cursor: pointer;
            font-size: 20px;
            line-height: 1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @media (max-width: 800px) {
            .auth-wrapper {
                width: min(450px, 92vw);
                flex-direction: column;
            }

            .image-panel {
                display: none;
            }

            .shell {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="toast-wrap"></div>

    <div class="auth-wrapper">

        <div class="shell">
            <header class="g-head">
                <a href="./home.html">
                    <img src="Img/logo/utycc_logo_favicon/logo.png" alt="UTYCC Logo" class="brand-logo" />
                </a>
                <h1>Sign in</h1>
                <p class="sub">to continue to UTYCC</p>
            </header>

            <!-- The form now submits to itself (this PHP file) -->
            <form id="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="field">
                    <label for="login-id">Admin ID</label>
                    <!-- The 'name' attribute is added for PHP to read the value -->
                    <!-- The 'value' attribute helps to keep user input after a failed attempt -->
                    <input type="text" id="login-id" name="admin_id" class="input" placeholder="e.g., UTYCC_Admin" 
                           value="<?php echo isset($_POST['admin_id']) ? htmlspecialchars($_POST['admin_id']) : ''; ?>" required>
                </div>
                <div class="field">
                    <label for="login-email">Email</label>
                    <input type="email" id="login-email" name="email" class="input" placeholder="e.g., admin@utycc.edu.mm"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>
                <div class="field">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" class="input" placeholder="Your password" required>
                </div>
                <div class="row">
                    <button type="submit" class="btn w-full">Sign In</button>
                </div>
            </form>
        </div>

        <div class="image-panel">
            <img src="./Img/hero-carousel/3.JPG" style="opacity: 85%" alt="UTYCC Students Photo">
        </div>

    </div>

    <script>
        // This script is now only for showing toast notifications.
        // The form submission and validation are handled by PHP.
        (function() {
            const toastWrap = document.querySelector('.toast-wrap');

            // Make this function global so PHP can call it
            window.showToast = function(message, type = 'success', duration = 4000) {
                const toast = document.createElement('div');
                toast.className = `toast ${type}`;
                toast.innerHTML = `<span>${message}</span><button class="close-btn" aria-label="Close">×</button>`;
                const closer = toast.querySelector('.close-btn');
                const removeToast = () => toast.remove();
                closer.addEventListener('click', removeToast);
                toastWrap.appendChild(toast);
                setTimeout(removeToast, duration);
            }
        })();
    </script>

    <?php
    // If there was a login error, call the JavaScript function to show a toast.
    if (!empty($error_message)) {
        // We use addslashes to make sure the message doesn't break the JS string.
        echo "<script>window.showToast('" . addslashes($error_message) . "', 'error');</script>";
    }
    ?>
</body>

</html>
