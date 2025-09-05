<?php
session_start();
// Set the default timezone to Myanmar time for consistency
date_default_timezone_set('Asia/Yangon');

// URL မှ တိုက်ရိုက်ဝင်ရောက်ခြင်းကို ပြန်လည်ခွင့်ပြုရန် session data စစ်ဆေးခြင်းကို ဖယ်ရှားလိုက်ပါပြီ။
// ၎င်းကို အောက်တွင် UI ပြသမှုအတွက်သာ အသုံးပြုထားပါသည်။

// Use require_once for database connection to prevent multiple inclusions and ensure it's present.
require_once "db.php"; 

$success_message = null;

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Session data မရှိသေးရင် submit လုပ်လို့မရအောင် စစ်ဆေးပါ။
    if (!isset($_SESSION['form1_data']) || !isset($_SESSION['form2_data']) || !isset($_SESSION['option_data'])) {
        // data မရှိပါက error message ပြသပြီး ပြန်လည် redirect လုပ်ရန်
        echo "<script>
            alert('Your session has expired or data is incomplete. Please start over. အချက်အလက်ပြည့်စုံစွာ ဖြည့်စွက်ထားခြင်းမရှိသေးပါ!');
            window.location.href = 'form1.php?new=1';
        </script>";
        exit;
    }

    // Use a transaction to ensure all data is inserted successfully.
    try {
        // 1. Begin the transaction.
        $pdo->beginTransaction();

        // Assign session data to variables with null fallback for safety.
        $form1 = $_SESSION['form1_data'] ?? [];
        $form2 = $_SESSION['form2_data'] ?? [];
        $option = $_SESSION['option_data'] ?? [];

        // Encode preferences as JSON to store in the students table.
        $preferences_json = json_encode($form2['preferences'] ?? []);

        // --- Safety Check for Date ---
        // Re-validate and ensure the date is in the correct format before inserting.
        $submission_date = null;
        if (!empty($form1['date'])) {
            try {
                // The date should already be in 'Y-m-d H:i:s' format from form1.php
                $date_obj = new DateTime($form1['date']);
                $submission_date = $date_obj->format('Y-m-d H:i:s');
            } catch (Exception $e) {
                // If it's invalid for some reason, fallback to the current time.
                $submission_date = date('Y-m-d H:i:s');
            }
        } else {
            // If it's missing entirely from the session, use the current time.
            $submission_date = date('Y-m-d H:i:s');
        }


        // =================================================================
        // Step 1: Insert into the 'students' table.
        // =================================================================
        $stmt_student = $pdo->prepare("
            INSERT INTO students
            (year, academic_year, seat_no, entry_year, student_email, dormitory_preference, preferences,
             student_name_mm, student_name_en, student_race, student_religion, student_nrc,
             student_dob, student_birthplace, state_region, township, student_phone, student_address,
             date, photo_url)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt_student->execute([
            $form1['year'] ?? null,
            $form1['academic_year'] ?? null,
            $form1['seat_no'] ?? null,
            $form1['entry_year'] ?? null,
            $form1['student_email'] ?? null,
            $option['dormitory_preference'] ?? null,
            $preferences_json,
            $form1['student_name_mm'] ?? null,
            $form1['student_name_en'] ?? null,
            $form1['student_race'] ?? null,
            $form1['student_religion'] ?? null,
            $form1['student_nrc'] ?? null,
            $form1['student_dob'] ?? null,
            $form1['student_birthplace'] ?? null,
            $form1['state_region'] ?? null,
            $form1['township'] ?? null,
            $form1['student_phone'] ?? null,
            $form1['student_address'] ?? null,
            $submission_date, // Use the validated and formatted date
            $form1['photo_url'] ?? null
        ]);

        // Get the ID of the student just inserted.
        $student_id = $pdo->lastInsertId();

        // =================================================================
        // Step 2: Insert into the 'fathers' table with the student_id.
        // =================================================================
        $stmt_father = $pdo->prepare("
            INSERT INTO fathers
            (student_id, father_name_mm, father_name_en, father_race, father_religion,
             father_nrc, father_phone, father_info, father_deceased_year, father_address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt_father->execute([
            $student_id,
            $form1['father_name_mm'] ?? null,
            $form1['father_name_en'] ?? null,
            $form1['father_race'] ?? null,
            $form1['father_religion'] ?? null,
            $form1['father_nrc'] ?? null,
            $form1['father_phone'] ?? null,
            $form1['father_info'] ?? null,
            $form1['father_deceased_year'] ?? null,
            $form1['father_address'] ?? null
        ]);
        
        // =================================================================
        // Step 3: Insert into the 'mothers' table with the student_id.
        // =================================================================
        $stmt_mother = $pdo->prepare("
            INSERT INTO mothers
            (student_id, mother_name_mm, mother_name_en, mother_race, mother_religion,
             mother_nrc, mother_phone, mother_info, mother_deceased_year, mother_address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt_mother->execute([
            $student_id,
            $form1['mother_name_mm'] ?? null,
            $form1['mother_name_en'] ?? null,
            $form1['mother_race'] ?? null,
            $form1['mother_religion'] ?? null,
            $form1['mother_nrc'] ?? null,
            $form1['mother_phone'] ?? null,
            $form1['mother_info'] ?? null,
            $form1['mother_deceased_year'] ?? null,
            $form1['mother_address'] ?? null
        ]);

        // =================================================================
        // Step 4: Insert into the 'preferences' table.
        // =================================================================

        // 2. If everything is successful, commit the transaction.
        $pdo->commit();

        // Clear all session data after successful submission.
        session_destroy();
        
        // Show success message and redirect.
        echo "<script>
            alert('Registration is successful!');
            window.location.href = '../home.php';
        </script>";
        exit;

    } catch (PDOException $e) {
        // 3. If an error occurs, roll back the transaction.
        $pdo->rollBack();

        // Prepare the error message for JavaScript alert
        $raw_error_message = $e->getMessage();
        // Sanitize the message to prevent breaking the script tag
        $sanitized_error_message = str_replace(["'", "\n", "\r"], ["\\'", "\\n", "\\r"], $raw_error_message);

        // Check for specific duplicate entry error code (SQLSTATE 23000).
        if ($e->getCode() == '23000') {
            $error_message = "အချက်အလက် မှတ်ပုံတင်ခြင်း မအောင်မြင်ပါ ❌\\n";
            if (strpos($raw_error_message, 'seat_no') !== false) {
                $error_message .= "သင်၏ ထိုင်ခုံနံပါတ် (Seat No) သည် မှတ်ပုံတင်ပြီးသားဖြစ်ပါသည်။";
            } else if (strpos($raw_error_message, 'student_nrc') !== false) {
                $error_message .= "သင်၏ မှတ်ပုံတင်အမှတ် (NRC) သည် မှတ်ပုံတင်ပြီးသားဖြစ်ပါသည်။";
            } else {
                $error_message .= "အချက်အလက်ထည့်သွင်းမှုတွင် ထပ်နေသော အချက်အလက်များ ရှိနေပါသည်။";
            }
             echo "<script>alert('{$error_message}'); window.history.back();</script>";
        } else {
            // Log the detailed error for server-side debugging.
            error_log("Database submission error: " . $raw_error_message);

            // Display a detailed, user-friendly error message in an alert.
            $error_message = "❌ Submission failed due to a system error.\\nPlease contact support.\\n\\nError Details: " . $sanitized_error_message;
            echo "<script>alert('{$error_message}'); window.history.back();</script>";
        }
        exit; // Stop script execution after handling the error
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Submission</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
    </style>
</head>
<body class="p-4 bg-gray-50 flex flex-col items-center justify-center min-h-screen">

<div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl py-12 px-8 md:px-12 space-y-8">
    <div class="text-center space-y-2 mb-6">
        <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-20 h-20"/>
        <h2 class="text-4xl font-extrabold text-gray-800">Your Application</h2>
        <p class="text-gray-500">You're one step away from completing your submission.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Card 1: Personal Details -->
        <a href="form1.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <?php if (isset($_SESSION['form1_data'])): ?>
                <span class="text-3xl text-green-500 mb-2">✔</span>
            <?php else: ?>
                <span class="text-3xl text-red-500 mb-2">❌</span>
            <?php endif; ?>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 1</p>
            <p class="font-semibold text-lg text-gray-700 text-center">Personal Details</p>
        </a>
        <!-- Card 2: Major Preferences -->
        <a href="form2.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <?php if (isset($_SESSION['form2_data'])): ?>
                <span class="text-3xl text-green-500 mb-2">✔</span>
            <?php else: ?>
                <span class="text-3xl text-red-500 mb-2">❌</span>
            <?php endif; ?>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 2</p>
            <p class="font-semibold text-lg text-gray-700 text-center">Major Preferences</p>
        </a>
        <!-- Card 3: Accommodation -->
        <a href="option.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <?php if (isset($_SESSION['option_data'])): ?>
                <span class="text-3xl text-green-500 mb-2">✔</span>
            <?php else: ?>
                <span class="text-3xl text-red-500 mb-2">❌</span>
            <?php endif; ?>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 3</p>
            <p class="font-semibold text-lg text-gray-700 text-center">Accommodation</p>
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
        <a href="option.php" class="w-full sm:w-auto px-6 py-3 rounded-full border border-gray-300 font-medium text-gray-700 hover:bg-gray-50 transition-colors text-center shadow-sm hover:shadow-md">Back</a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w-full sm:w-auto">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-transform transform hover:scale-105 shadow-md">Submit Application</button>
        </form>
    </div>
</div>

</body>
</html>

