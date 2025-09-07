<?php
session_start();
date_default_timezone_set('Asia/Yangon');

require_once "db.php";

$modal_data = null; // To hold data for our custom alert modal

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['form1_data']) || !isset($_SESSION['form2_data']) || !isset($_SESSION['option_data'])) {
        $modal_data = [
            'type' => 'error',
            'title' => 'Session သက်တမ်းကုန်ဆုံးသွားပါပြီ',
            'message' => 'သင်၏ session หมดอายุแล้ว กรุณาเริ่มใหม่อีกครั้ง',
            'buttonText' => 'အစမှပြန်စမည်',
            'redirectUrl' => 'form1.php?new=1'
        ];
    } else {
        try {
            $pdo->beginTransaction();

            $form1 = $_SESSION['form1_data'] ?? [];
            $form2 = $_SESSION['form2_data'] ?? [];
            $option = $_SESSION['option_data'] ?? [];
            $preferences_json = json_encode($form2['preferences'] ?? []);
            
            $submission_date = date('Y-m-d H:i:s');
            if (!empty($form1['date'])) {
                try {
                    $date_obj = new DateTime($form1['date']);
                    $submission_date = $date_obj->format('Y-m-d H:i:s');
                } catch (Exception $e) {
                    $submission_date = date('Y-m-d H:i:s');
                }
            }

            // Step 1: Insert into 'students' table
            $stmt_student = $pdo->prepare("
                INSERT INTO students
                (year, academic_year, seat_no, entry_year, student_email, dormitory_preference, preferences,
                 student_name_mm, student_name_en, student_race, student_religion, student_nrc,
                 student_dob, student_birthplace, state_region, township, student_phone, student_address,
                 date, photo_url)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt_student->execute([
                $form1['year'] ?? null, $form1['academic_year'] ?? null, $form1['seat_no'] ?? null,
                $form1['entry_year'] ?? null, $form1['student_email'] ?? null, $option['dormitory_preference'] ?? null,
                $preferences_json, $form1['student_name_mm'] ?? null, $form1['student_name_en'] ?? null,
                $form1['student_race'] ?? null, $form1['student_religion'] ?? null, $form1['student_nrc'] ?? null,
                $form1['student_dob'] ?? null, $form1['student_birthplace'] ?? null, $form1['state_region'] ?? null,
                $form1['township'] ?? null, $form1['student_phone'] ?? null, $form1['student_address'] ?? null,
                $submission_date, $form1['photo_url'] ?? null
            ]);
            $student_id = $pdo->lastInsertId();

            // Step 2: Insert into 'fathers' table
            $stmt_father = $pdo->prepare("
                INSERT INTO fathers
                (student_id, father_name_mm, father_name_en, father_race, father_religion,
                 father_nrc, father_phone, father_info, father_deceased_year, father_address)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt_father->execute([
                $student_id, $form1['father_name_mm'] ?? null, $form1['father_name_en'] ?? null,
                $form1['father_race'] ?? null, $form1['father_religion'] ?? null, $form1['father_nrc'] ?? null,
                $form1['father_phone'] ?? null, $form1['father_info'] ?? null,
                $form1['father_deceased_year'] ?? null, $form1['father_address'] ?? null
            ]);
            
            // Step 3: Insert into 'mothers' table
            $stmt_mother = $pdo->prepare("
                INSERT INTO mothers
                (student_id, mother_name_mm, mother_name_en, mother_race, mother_religion,
                 mother_nrc, mother_phone, mother_info, mother_deceased_year, mother_address)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt_mother->execute([
                $student_id, $form1['mother_name_mm'] ?? null, $form1['mother_name_en'] ?? null,
                $form1['mother_race'] ?? null, $form1['mother_religion'] ?? null, $form1['mother_nrc'] ?? null,
                $form1['mother_phone'] ?? null, $form1['mother_info'] ?? null,
                $form1['mother_deceased_year'] ?? null, $form1['mother_address'] ?? null
            ]);

            $pdo->commit();
            $student_email = htmlspecialchars($form1['student_email'] ?? 'your email');
            $success_message = "သင်၏ကျောင်းဝင်ခွင့်လျှောက်လွှာကို အောင်မြင်စွာလက်ခံရရှိပါသည်။ သင့်အချက်အလက်များအားစစ်ဆေးပြီးပါက " . $student_email . " သို့ပြန်လည်အကြောင်းကြားပေးပါမည်။";
            session_destroy();
            
            $modal_data = [
                'type' => 'success', 'title' => 'အောင်မြင်ပါသည်', 'message' => $success_message,
                'buttonText' => 'ပင်မစာမျက်နှာသို့', 'redirectUrl' => '../home.php'
            ];

        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log("Database submission error: " . $e->getMessage());
            $error_message_user = "System error တစ်ခုကြောင့် အချက်အလက်များ မသိမ်းဆည်းနိုင်ပါ။";
            if ($e->getCode() == '23000') {
                 if (strpos($e->getMessage(), 'seat_no') !== false) { $error_message_user = "သင်၏ ထိုင်ခုံနံပါတ် (Seat No) သည် မှတ်ပုံတင်ပြီးသားဖြစ်နေပါသည်။"; } 
                 else if (strpos($e->getMessage(), 'student_nrc') !== false) { $error_message_user = "သင်၏ မှတ်ပုံတင်အမှတ် (NRC) သည် မှတ်ပုံတင်ပြီးသားဖြစ်နေပါသည်။"; } 
                 else { $error_message_user = "သင်ဖြည့်သွင်းလိုက်သော အချက်အလက်များထဲတွင် ထပ်နေသောအချက်အလက်များ ပါဝင်နေပါသည်။"; }
            }
            $modal_data = [
                'type' => 'error', 'title' => 'မှတ်ပုံတင်ခြင်း မအောင်မြင်ပါ', 'message' => $error_message_user,
                'buttonText' => 'နောက်သို့ပြန်သွားမည်', 'redirectUrl' => 'javascript:window.history.back()'
            ];
        }
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
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .modal-overlay { transition: opacity 0.3s ease; }
        .modal-content { transition: all 0.3s ease; }
    </style>
</head>
<body class="p-4 bg-gray-50 flex flex-col items-center justify-center min-h-screen">

<div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl py-12 px-8 md:px-12 space-y-8">
    <div class="text-center space-y-2 mb-6">
        <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-20 h-20"/>
        <h2 class="text-4xl font-extrabold text-gray-800">Final submittion</h2>
        <p class="text-gray-500">Please check carefully.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <a href="form1.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <span class="text-3xl mb-2"><?php echo isset($_SESSION['form1_data']) ? '✔️' : '❌'; ?></span>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 1</p>
            <p class="font-semibold text-lg text-gray-700 text-center">Personal Details</p>
        </a>
        <a href="form2.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <span class="text-3xl mb-2"><?php echo isset($_SESSION['form2_data']) ? '✔️' : '❌'; ?></span>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 2</p>
            <p class="font-semibold text-lg text-gray-700 text-center">Major Preferences</p>
        </a>
        <a href="option.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <span class="text-3xl mb-2"><?php echo isset($_SESSION['option_data']) ? '✔️' : '❌'; ?></span>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 3</p>
            <p class="font-semibold text-lg text-gray-700 text-center">Accommodation</p>
        </a>
    </div>

    <!-- Review Details Section -->
    <div class="border-t border-gray-200 pt-8 mt-8 space-y-6">
        <h3 class="text-2xl font-bold text-gray-800 text-center">Review Your Details</h3>
        
        <!-- Personal Info -->
        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-lg text-gray-700">Personal Information</h4>
                <a href="form1.php" class="text-sm font-semibold text-indigo-600 hover:underline">Edit</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-600">
                <p><strong>Name (EN):</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_name_en'] ?? 'N/A'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_email'] ?? 'N/A'); ?></p>
                <p><strong>Seat No:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['seat_no'] ?? 'N/A'); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_phone'] ?? 'N/A'); ?></p>
            </div>
        </div>

        <!-- Preferences & Accommodation -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-semibold text-lg text-gray-700">Major Choices</h4>
                    <a href="form2.php" class="text-sm font-semibold text-indigo-600 hover:underline">Edit</a>
                </div>
                <ul class="list-decimal list-inside text-gray-600 space-y-1">
                    <?php if (!empty($_SESSION['form2_data']['preferences'])): ?>
                        <?php foreach ($_SESSION['form2_data']['preferences'] as $pref): ?>
                            <li><?php echo htmlspecialchars($pref); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No preferences selected.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-semibold text-lg text-gray-700">Accommodation</h4>
                    <a href="option.php" class="text-sm font-semibold text-indigo-600 hover:underline">Edit</a>
                </div>
                <p class="text-gray-600">
                    <?php 
                    if (isset($_SESSION['option_data']['dormitory_preference'])) {
                        echo $_SESSION['option_data']['dormitory_preference'] == '1' 
                            ? 'Applying for dormitory' 
                            : 'Not applying for dormitory';
                    } else {
                        echo 'No selection made.';
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>


    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
        <a href="option.php" class="w-full sm:w-auto px-6 py-3 rounded-full border border-gray-300 font-medium text-gray-700 hover:bg-gray-50 transition-colors text-center shadow-sm hover:shadow-md">Back</a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w-full sm:w-auto">
            <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-transform transform hover:scale-105 shadow-md">Submit</button>
        </form>
    </div>
</div>

<!-- Custom Modal HTML -->
<div id="customModal" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 opacity-0 pointer-events-none">
    <div class="modal-content bg-white w-full max-w-md rounded-2xl shadow-xl p-8 text-center transform scale-95">
        <div id="modalIcon" class="mx-auto flex items-center justify-center h-20 w-20 rounded-full mb-6"></div>
        <h3 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-2"></h3>
        <p id="modalMessage" class="text-gray-600 mb-8"></p>
        <button id="modalButton" class="w-full px-6 py-3 rounded-full text-white font-semibold transition-transform transform hover:scale-105 shadow-md"></button>
    </div>
</div>

<script>
    const modal = document.getElementById('customModal');
    const modalContent = modal.querySelector('.modal-content');
    const modalIcon = document.getElementById('modalIcon');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalButton = document.getElementById('modalButton');

    function showModal(type, title, message, buttonText, redirectUrl) {
        modalIcon.innerHTML = '';
        if (type === 'success') {
            modalIcon.className = 'mx-auto flex items-center justify-center h-20 w-20 rounded-full mb-6 bg-green-100';
            modalIcon.innerHTML = `<svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`;
            modalButton.className = 'w-full px-6 py-3 rounded-full text-white font-semibold transition-transform transform hover:scale-105 shadow-md bg-green-600 hover:bg-green-700';
        } else {
            modalIcon.className = 'mx-auto flex items-center justify-center h-20 w-20 rounded-full mb-6 bg-red-100';
            modalIcon.innerHTML = `<svg class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>`;
            modalButton.className = 'w-full px-6 py-3 rounded-full text-white font-semibold transition-transform transform hover:scale-105 shadow-md bg-red-600 hover:bg-red-700';
        }
        modalTitle.textContent = title;
        modalMessage.textContent = message;
        modalButton.textContent = buttonText;
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-95');
        modalButton.onclick = () => {
            if (redirectUrl.startsWith('javascript:')) { eval(redirectUrl.substring(11)); } 
            else { window.location.href = redirectUrl; }
        };
    }

    <?php if ($modal_data): ?>
        document.addEventListener('DOMContentLoaded', function() {
            showModal(
                '<?php echo $modal_data['type']; ?>', '<?php echo addslashes($modal_data['title']); ?>',
                '<?php echo addslashes($modal_data['message']); ?>', '<?php echo addslashes($modal_data['buttonText']); ?>',
                '<?php echo $modal_data['redirectUrl']; ?>'
            );
        });
    <?php endif; ?>

    const finalForm = document.querySelector('form[action*="final.php"]');
    if (finalForm) {
        finalForm.addEventListener('submit', function(e) {
            const submitButton = e.target.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Submitting...';
        });
    }
</script>

</body>
</html>

