<?php
session_start();
require_once "db.php";

$success_message = null;

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required session variables exist.
    if (!isset($_SESSION['form1_data']) || !isset($_SESSION['form2_data']) || !isset($_SESSION['option_data'])) {
        // Redirect if session data is missing.
        header("Location: form1.php");
        exit;
    }

    try {
        $form1 = $_SESSION['form1_data'];
        $form2 = $_SESSION['form2_data'];
        $option = $_SESSION['option_data'];

        // Insert data into table1.
        $stmt = $pdo->prepare("
            INSERT INTO table1 
            (student_name, seat_no, nrc, dob, father_name, mother_name, address, phone, preferences, dormitory) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $form1['student_name_mm'],
            $form1['seat_no'],
            $form1['student_nrc'],
            $form1['student_dob'],
            $form1['father_name_mm'],
            $form1['mother_name_mm'],
            $form1['student_address'],
            $form1['student_phone'],
            json_encode($form2['preferences']),
            $option['dormitory_preference']
        ]);

        $main_form_id = $pdo->lastInsertId();

        // If hostel option = 1, insert into table2.
        if ($option['dormitory_preference'] == '1' && isset($_SESSION['student_photo'])) {
            $stmt2 = $pdo->prepare("INSERT INTO table2 (main_form_id, student_photo) VALUES (?, ?)");
            $stmt2->execute([$main_form_id, $_SESSION['student_photo']]);
        }

        // Clear session data after successful submission.
        session_destroy();
        
        // Set success message to be displayed.
        $success_message = "✅ ကျောင်းလျှောက်ခြင်း အောင်မြင်ပါသည်။\n\nရတနာပုံဆိုက်ဘာစီးတီး တက္ကသိုလ်မှ နွေးထွေးစွာကြိုဆိုပါသည်။";
        
    } catch (PDOException $e) {
        // In a real application, you would handle this gracefully.
        // For this example, we'll just show an error.
        error_log("Database error: " . $e->getMessage());
        $success_message = "❌ Submission failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review & Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #1e293b;
        }

        .container {
            max-width: 700px;
        }
        
        .disk {
            width: 80%;
            margin: auto;
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .staggered-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    </style>
</head>
<body>

  <div class="disk">

<div class="container w-full bg-white rounded-3xl shadow-2xl p-8 md:p-12 space-y-8 animate-fade-in">
    <!-- Progress Header -->
    <div class="text-center space-y-2">
        <div style="display: flex; justify-content: center; align-items: center;">
             <!-- Placeholder for the logo to ensure the form is self-contained -->
                    <div style="display: flex; justify-content: center; align-items: center;">
            <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" style="display: block; margin: 0 auto; width: 80px; height: 80px;" />
        </div>
        </div>
        <h2 class="text-4xl font-extrabold">UTYCC</h2>
        <p class="text-gray-500">You are at the final step of your submission.</p>
    </div>
    
    <!-- Progress Bar -->
    <!-- The progress bar is commented out as the user requested a static final form -->
    <div class="text-right text-gray-500 text-sm">100% Complete</div>

    <!-- Review Section -->
    <div class="space-y-6">        
        <!-- Example field to be reviewed -->
        <a href="form1.php" class="bg-gray-50 p-6 rounded-xl flex justify-between items-center shadow-sm staggered-fade-in transition-transform duration-200 hover:scale-[1.01] no-underline" style="animation-delay: 0.2s;">
            <div>
                <p class="text-gray-400 text-sm font-medium">Personal Details</p>
                <p class="font-semibold text-lg">Form 1 was completed</p>
            </div>
            <div class="text-green-500 font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Complete
            </div>
        </a>

        <!-- Another example field -->
        <a href="form2.php" class="bg-gray-50 p-6 rounded-xl flex justify-between items-center shadow-sm staggered-fade-in transition-transform duration-200 hover:scale-[1.01] no-underline" style="animation-delay: 0.4s;">
            <div>
                <p class="text-gray-400 text-sm font-medium">Preferences Majors</p>
                <p class="font-semibold text-lg">Form 2 was completed</p>
            </div>
            <div class="text-green-500 font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Complete
            </div>
        </a>

        <!-- Add more review items here as needed -->
 <a href="option.php" class="bg-gray-50 p-6 rounded-xl flex justify-between items-center shadow-sm staggered-fade-in transition-transform duration-200 hover:scale-[1.01] no-underline" style="animation-delay: 0.4s;">
            <div>
                <p class="text-gray-400 text-sm font-medium"></p>
                <p class="font-semibold text-lg">Choosing Accommodation</p>
            </div>
            <div class="text-green-500 font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                Complete
            </div>
        </a>


    </div>
    
    <!-- Action Buttons -->
    <div class="flex justify-between items-center gap-4 pt-4">
        <a href="option.php" class="w-auto px-6 py-3 rounded-full border border-gray-300 font-medium text-gray-700 transition-all duration-200 btn-hover-effect">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back
        </a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w-auto">
            
            <button type="submit" class="w-auto px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-all duration-200 shadow-md btn-hover-effect">
                Submit
            </button>
        </form>
    </div>
</div>

  </div>

  <!-- Confirmation Modal -->
  <div id="confirmation-modal" class="modal-overlay hidden">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-11/12 max-w-md mx-auto text-center animate-fade-in">
        <div class="flex flex-col items-center space-y-4">
            <!-- Checkmark Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-green-500">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
            <!-- Title -->
            <h3 class="text-2xl font-bold mb-2">လျှောက်လွှာတင်ပြီးပါပြီ</h3>
            <!-- Message -->
            <p class="text-gray-600">လျှောက်လွှာတင်ခြင်း အောင်မြင်ပါသည်။ ကျေးဇူးပြု၍ သင့်အီးမေးလ်သို့ ပေးပို့ထားသော အကြောင်းကြားစာကို စစ်ဆေးပါ။</p>
            <!-- OK Button -->
            <button id="okay-btn" class="w-full mt-4 px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-all duration-200 shadow-md">
                Okay
            </button>
        </div>
    </div>
  </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const successMessage = "<?php echo $success_message; ?>";
        const modal = document.getElementById('confirmation-modal');
        const okayBtn = document.getElementById('okay-btn');

        if (successMessage.length > 0) {
            modal.classList.remove('hidden');
        }

        okayBtn.addEventListener('click', () => {
            window.location.href = "home.php";
        });
    });
</script>

</body>
</html>
