<?php
session_start();
date_default_timezone_set('Asia/Yangon');

require_once "db.php";

$modal_data = null; 

// This variable will be used to disable the submit button if documents are missing.
$all_documents_uploaded = isset($_SESSION['document_files']) && count($_SESSION['document_files']) === 11;

// Define available majors for display
$available_majors = [
    'IST' => 'သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာအင်ဂျင်နီယာဘာသာရပ်(IST)',
    'CE'  => 'ကွန်ပျူတာအင်ဂျင်နီယာ ဘာသာရပ်(CE)',
    'EcE' => 'အီလက်ထရောနစ် အင်ဂျင်နီယာ ဘာသာရပ်(EcE)',
    'PrE' => 'တိကျပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ ဘာသာရပ်(PrE)',
    'AME' => 'အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ ဘာသာရပ်(AME)',
];

// Get selected major from session
$selected_major_code = $_SESSION['form1_data']['selected_major'] ?? '';
$selected_major_name = '';
if ($selected_major_code && isset($available_majors[$selected_major_code])) {
    $selected_major_name = $available_majors[$selected_major_code];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['form1_data']) || !isset($_SESSION['option_data']) || !isset($_SESSION['document_files'])) {
        $modal_data = [
            'type' => 'error',
            'title' => 'Session Expired',
            'message' => 'Your session has expired. Please start the process again.',
            'buttonText' => 'Start Over',
            'redirectUrl' => isset($_SESSION['student_id']) ? 'verify_student.php' : 'data_add.php?new=1'
        ];
    } elseif (!$all_documents_uploaded) {
        // Double-check on the server side
        $modal_data = [
            'type' => 'error',
            'title' => 'Missing Documents',
            'message' => 'Please upload all 11 required documents before submitting.',
            'buttonText' => 'Go Back to Upload',
            'redirectUrl' => 'documents1.php'
        ];
    } else {
        try {
            $pdo->beginTransaction();

            $form1 = $_SESSION['form1_data'];
            $option = $_SESSION['option_data'];
            $documents = $_SESSION['document_files'];

            $is_old_student = isset($_SESSION['student_id']);

            // Get selected major for both old and new students
            $selected_major_db = $form1['selected_major'] ?? null;

            if ($is_old_student) {
                // --- LOGIC FOR OLD STUDENT (UPDATE existing record) ---
                $student_id = $_SESSION['student_id'];

                // Check for duplicate seat number (excluding current student)
                if (isset($form1['seat_no']) && !empty($form1['seat_no'])) {
                    $stmt_check_seat = $pdo->prepare("SELECT COUNT(*) FROM students WHERE seat_no = ? AND student_id != ?");
                    $stmt_check_seat->execute([$form1['seat_no'], $student_id]);
                    if ($stmt_check_seat->fetchColumn() > 0) {
                        throw new Exception("This Seat Number '{$form1['seat_no']}' has already been registered by another student.");
                    }
                }

                $stmt_update = $pdo->prepare("
                    UPDATE students 
                    SET 
                        academic_year = :academic_year,
                        seat_no = :seat_no,
                        selected_major = :selected_major,
                        status = 'pending',
                        date = :submission_date,
                        doc_recommendation = :doc_recommendation,
                        doc_medical = :doc_medical,
                        doc_certificate = :doc_certificate,
                        doc_grades = :doc_grades,
                        doc_household = :doc_household,
                        doc_student_nrc_front = :doc_student_nrc_front,
                        doc_student_nrc_back = :doc_student_nrc_back,
                        doc_father_nrc_front = :doc_father_nrc_front,
                        doc_father_nrc_back = :doc_father_nrc_back,
                        doc_mother_nrc_front = :doc_mother_nrc_front,
                        doc_mother_nrc_back = :doc_mother_nrc_back
                    WHERE student_id = :student_id
                ");

                $stmt_update->execute([
                    ':academic_year' => $form1['academic_year'] ?? null,
                    ':seat_no' => $form1['seat_no'] ?? null,
                    ':selected_major' => $selected_major_db,
                    ':submission_date' => date('Y-m-d H:i:s'),
                    ':student_id' => $student_id,
                    ':doc_recommendation' => $documents['doc_recommendation'] ?? null,
                    ':doc_medical' => $documents['doc_medical'] ?? null,
                    ':doc_certificate' => $documents['doc_certificate'] ?? null,
                    ':doc_grades' => $documents['doc_grades'] ?? null,
                    ':doc_household' => $documents['doc_household'] ?? null,
                    ':doc_student_nrc_front' => $documents['doc_student_nrc_front'] ?? null,
                    ':doc_student_nrc_back' => $documents['doc_student_nrc_back'] ?? null,
                    ':doc_father_nrc_front' => $documents['doc_father_nrc_front'] ?? null,
                    ':doc_father_nrc_back' => $documents['doc_father_nrc_back'] ?? null,
                    ':doc_mother_nrc_front' => $documents['doc_mother_nrc_front'] ?? null,
                    ':doc_mother_nrc_back' => $documents['doc_mother_nrc_back'] ?? null
                ]);

            } else {
                // --- LOGIC FOR NEW STUDENT (INSERT new record) ---
                // FIX: Removed dependency on form2_data, set preferences to empty array
                $preferences_json = json_encode([]);
                
                $submission_date = date('Y-m-d H:i:s');
                if (!empty($form1['date'])) {
                    try {
                        $date_obj = new DateTime($form1['date']);
                        $submission_date = $date_obj->format('Y-m-d H:i:s');
                    } catch (Exception $e) { /* Keep current datetime */ }
                }

                // Debug: Log the data being submitted
                error_log("Submitting data - Seat No: " . ($form1['seat_no'] ?? 'NULL') . ", NRC: " . ($form1['student_nrc'] ?? 'NULL') . ", Major: " . ($selected_major_db ?? 'NULL'));

                // Check for duplicate NRC only if it's not empty and not 'လျှောက်ထားဆဲ'
                $student_nrc_to_check = (isset($form1['student_nrc']) && ($form1['student_nrc'] === 'လျှောက်ထားဆဲ' || trim($form1['student_nrc']) === '')) ? null : ($form1['student_nrc'] ?? null);
                
                if ($student_nrc_to_check !== null) {
                    $stmt_check_nrc = $pdo->prepare("SELECT student_id, student_name_en FROM students WHERE student_nrc = ?");
                    $stmt_check_nrc->execute([$student_nrc_to_check]);
                    $existing_nrc = $stmt_check_nrc->fetch();
                    if ($existing_nrc) {
                        throw new Exception("This NRC number '{$student_nrc_to_check}' has already been registered by student: {$existing_nrc['student_name_en']} (ID: {$existing_nrc['student_id']}).");
                    }
                }
                
                // Check for duplicate seat number
                if (isset($form1['seat_no']) && !empty($form1['seat_no'])) {
                    $stmt_check_seat = $pdo->prepare("SELECT student_id, student_name_en FROM students WHERE seat_no = ?");
                    $stmt_check_seat->execute([$form1['seat_no']]);
                    $existing_seat = $stmt_check_seat->fetch();
                    if ($existing_seat) {
                        throw new Exception("This Seat Number '{$form1['seat_no']}' has already been registered by student: {$existing_seat['student_name_en']} (ID: {$existing_seat['student_id']}).");
                    }
                }

                // Prepare NRC values: convert 'လျှောက်ထားဆဲ' or empty strings to NULL for DB insertion
                $student_nrc_db = $student_nrc_to_check;
                $father_nrc_db = (isset($form1['father_nrc']) && ($form1['father_nrc'] === 'လျှောက်ထားဆဲ' || trim($form1['father_nrc']) === '')) ? null : ($form1['father_nrc'] ?? null);
                $mother_nrc_db = (isset($form1['mother_nrc']) && ($form1['mother_nrc'] === 'လျှောက်ထားဆဲ' || trim($form1['mother_nrc']) === '')) ? null : ($form1['mother_nrc'] ?? null);

                $stmt_student = $pdo->prepare("
                    INSERT INTO students
                    (year, academic_year, seat_no, entry_year, student_email, dormitory_preference, preferences, selected_major,
                     student_name_mm, student_name_en, student_race, student_religion, student_nrc,
                     student_dob, student_birthplace, state_region, township, student_phone, student_address,
                     date, photo_url, status,
                     doc_recommendation, doc_medical, doc_certificate, doc_grades, doc_household,
                     doc_student_nrc_front, doc_student_nrc_back, doc_father_nrc_front, doc_father_nrc_back,
                     doc_mother_nrc_front, doc_mother_nrc_back)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                
                $insert_result = $stmt_student->execute([
                    $form1['year'] ?? null, $form1['academic_year'] ?? null, $form1['seat_no'] ?? null,
                    $form1['entry_year'] ?? null, $form1['student_email'] ?? null, $option['dormitory_preference'] ?? null,
                    $preferences_json, $selected_major_db,
                    $form1['student_name_mm'] ?? null, $form1['student_name_en'] ?? null,
                    $form1['student_race'] ?? null, $form1['student_religion'] ?? null, $student_nrc_db,
                    $form1['student_dob'] ?? null, $form1['student_birthplace'] ?? null, $form1['state_region'] ?? null,
                    $form1['township'] ?? null, $form1['student_phone'] ?? null, $form1['student_address'] ?? null,
                    $submission_date, $form1['photo_url'] ?? null,
                    $documents['doc_recommendation'] ?? null,
                    $documents['doc_medical'] ?? null,
                    $documents['doc_certificate'] ?? null,
                    $documents['doc_grades'] ?? null,
                    $documents['doc_household'] ?? null,
                    $documents['doc_student_nrc_front'] ?? null,
                    $documents['doc_student_nrc_back'] ?? null,
                    $documents['doc_father_nrc_front'] ?? null,
                    $documents['doc_father_nrc_back'] ?? null,
                    $documents['doc_mother_nrc_front'] ?? null,
                    $documents['doc_mother_nrc_back'] ?? null
                ]);

                if (!$insert_result) {
                    $errorInfo = $stmt_student->errorInfo();
                    throw new Exception("Database insertion failed: " . ($errorInfo[2] ?? 'Unknown error'));
                }

                $student_id = $pdo->lastInsertId();

                $stmt_father = $pdo->prepare("
                    INSERT INTO fathers
                    (student_id, father_name_mm, father_name_en, father_race, father_religion,
                     father_nrc, father_phone, father_info, father_deceased_year, father_address)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt_father->execute([
                    $student_id, $form1['father_name_mm'] ?? null, $form1['father_name_en'] ?? null,
                    $form1['father_race'] ?? null, $form1['father_religion'] ?? null, $father_nrc_db,
                    $form1['father_phone'] ?? null, $form1['father_info'] ?? null,
                    $form1['father_deceased_year'] ?? null, $form1['father_address'] ?? null
                ]);
                
                $stmt_mother = $pdo->prepare("
                    INSERT INTO mothers
                    (student_id, mother_name_mm, mother_name_en, mother_race, mother_religion,
                     mother_nrc, mother_phone, mother_info, mother_deceased_year, mother_address)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt_mother->execute([
                    $student_id, $form1['mother_name_mm'] ?? null, $form1['mother_name_en'] ?? null,
                    $form1['mother_race'] ?? null, $form1['mother_religion'] ?? null, $mother_nrc_db,
                    $form1['mother_phone'] ?? null, $form1['mother_info'] ?? null,
                    $form1['mother_deceased_year'] ?? null, $form1['mother_address'] ?? null
                ]);
            }

            $pdo->commit();
            
            $student_email = htmlspecialchars($form1['student_email'] ?? 'your email');
            $success_message = "သင်၏ကျောင်းဝင်ခွင့်လျှောက်လွှာကို အောင်မြင်စွာလက်ခံရရှိပါသည်။သင့်အချက်အလက်များအားစစ်ဆေးပြီးပါက ".$student_email." သို့ပြန်လည်အကြောင်းကြားပေးပါမည်။";
            
            // Clear session data after successful submission
            session_destroy();
            
            $modal_data = [
                'type' => 'success', 'title' => 'Success', 'message' => $success_message,
                'buttonText' => 'Go to Homepage', 'redirectUrl' => '../index.php'
            ];
        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log("Database submission error: " . $e->getMessage());
            
            $error_message_user = "Could not save data due to a system error. Please try again later.";
            
            if ($e->getCode() == '23000') {
                $mysqlError = $e->getMessage();
                if (strpos($mysqlError, 'seat_no') !== false) { 
                    $error_message_user = "This Seat Number has already been registered. Please check your seat number."; 
                } else if (strpos($mysqlError, 'student_nrc') !== false) { 
                    $error_message_user = "This NRC number has already been registered. Please check your NRC details."; 
                } else { 
                    $error_message_user = "A record with this information already exists. Please check your details.";
                }
            }
            
            $modal_data = [
                'type' => 'error', 'title' => 'Submission Failed', 'message' => $error_message_user,
                'buttonText' => 'Go Back', 'redirectUrl' => 'javascript:window.history.back()'
            ];
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log("General submission error: " . $e->getMessage());
            
            $modal_data = [
                'type' => 'error', 'title' => 'Error', 'message' => $e->getMessage(),
                'buttonText' => 'Go Back', 'redirectUrl' => 'javascript:window.history.back()'
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
        .disabled-button {
            background-color: #9ca3af;
            cursor: not-allowed;
        }
        .disabled-button:hover {
            background-color: #9ca3af;
        }
    </style>
</head>
<body class="p-4 bg-gray-50 flex flex-col items-center justify-center min-h-screen">

<?php
// FIX: Using SVG icons like in final.php
$check_icon = '<div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-green-100 text-green-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></div>';
$cross_icon = '<div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-red-100 text-red-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></div>';
?>

<div class="w-full max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl py-12 px-8 md:px-12 space-y-8">
    <div class="text-center space-y-2 mb-6">
        <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-20 h-20"/>
        <h2 class="text-4xl font-extrabold text-gray-800">Final Submission</h2>
        <p class="text-gray-500">Please review your details carefully.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <a href="<?php echo isset($_SESSION['student_id']) ? 'cur_form.php' : 'data_add.php'; ?>" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <?php echo isset($_SESSION['form1_data']) ? $check_icon : $cross_icon; ?>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 1</p>
            <p class="font-semibold text-lg text-gray-700 text-center h-14 flex items-center justify-center">Personal Information</p>
        </a>
        
        <a href="option1.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <?php echo isset($_SESSION['option_data']) ? $check_icon : $cross_icon; ?>
            <p class="text-xs font-medium text-gray-400 mb-1">Step 2</p>
            <p class="font-semibold text-lg text-gray-700 text-center h-14 flex items-center justify-center">Accommodation</p>
        </a>

        <?php // FIX: Logic for displaying documents status like in final.php ?>
        <?php if (!$all_documents_uploaded): ?>
            <a href="javascript:void(0);" onclick="showModal('error', 'Missing Documents', 'Please upload all 11 required documents before submitting.', 'Go to Uploads', 'documents1.php')" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-red-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                <?php echo $cross_icon; ?>
                <p class="text-xs font-medium text-gray-400 mb-1">Step 3</p>
                <p class="font-semibold text-lg text-gray-700 text-center h-14 flex items-center justify-center">Required Documents</p>
            </a>
        <?php else: ?>
            <a href="documents1.php" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                <?php echo $check_icon; ?>
                <p class="text-xs font-medium text-gray-400 mb-1">Step 3</p>
                <p class="font-semibold text-lg text-gray-700 text-center h-14 flex items-center justify-center">Required Documents</p>
            </a>
        <?php endif; ?>
    </div>

    <!-- Review Details Section -->
    <div class="border-t border-gray-200 pt-8 mt-8 space-y-6">
        <h3 class="text-2xl font-bold text-gray-800 text-center">Your Details</h3>
        
        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-lg text-gray-700">Personal Information</h4>
                <a href="<?php echo isset($_SESSION['student_id']) ? 'cur_form.php' : 'data_add.php'; ?>" class="text-sm font-semibold text-indigo-600 hover:underline">Edit</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-600">
                <p><strong>Name (EN):</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_name_en'] ?? 'N/A'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_email'] ?? 'N/A'); ?></p>
                <p><strong>Seat No:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['seat_no'] ?? 'N/A'); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_phone'] ?? 'N/A'); ?></p>
                <p><strong>Selected Major:</strong> <?php echo htmlspecialchars($selected_major_name ?: 'N/A'); ?></p>
                <p><strong>NRC:</strong> <?php echo htmlspecialchars($_SESSION['form1_data']['student_nrc'] ?? 'N/A'); ?></p>

            </div>
        </div>

        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-lg text-gray-700">Accommodation</h4>
                <a href="option1.php" class="text-sm font-semibold text-indigo-600 hover:underline">Edit</a>
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

    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
        <a href="documents1.php" class="w-full sm:w-auto px-6 py-3 rounded-full border border-gray-300 font-medium text-gray-700 hover:bg-gray-50 transition-colors text-center shadow-sm hover:shadow-md">Back</a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w-full sm:w-auto">
            <button type="submit" id="submitBtn" class="w-full sm:w-auto px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-transform transform hover:scale-105 shadow-md <?php if (!$all_documents_uploaded) echo 'disabled-button'; ?>">
                <?php // FIX: Changed button text logic
                echo $all_documents_uploaded ? 'Submit Application' : 'Documents Incomplete'; ?>
            </button>
        </form>
    </div>
</div>

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
            if (redirectUrl.startsWith('javascript:')) { 
                eval(redirectUrl.substring(11)); 
            } else { 
                window.location.href = redirectUrl; 
            }
        };
    }

    <?php if ($modal_data): ?>
        document.addEventListener('DOMContentLoaded', function() {
            showModal(
                '<?php echo $modal_data['type']; ?>', 
                '<?php echo addslashes($modal_data['title']); ?>',
                '<?php echo addslashes($modal_data['message']); ?>', 
                '<?php echo addslashes($modal_data['buttonText']); ?>',
                '<?php echo $modal_data['redirectUrl']; ?>'
            );
        });
    <?php endif; ?>

    <?php // FIX: JavaScript logic updated to match final.php ?>
    document.addEventListener('DOMContentLoaded', function() {
        const allDocumentsUploaded = <?php echo $all_documents_uploaded ? 'true' : 'false'; ?>;
        const submitBtn = document.getElementById('submitBtn');

        if (!allDocumentsUploaded) {
            submitBtn.title = 'Please upload all 11 required documents.';
        }
        
        const finalForm = document.querySelector('form[action*="final1.php"]');
        if (finalForm) {
            finalForm.addEventListener('submit', function(e) {
                // Prevent submission and show modal if documents are incomplete
                if (!allDocumentsUploaded) {
                   e.preventDefault(); 
                   showModal(
                       'error', 
                       'Missing Documents', 
                       'Please upload all 11 required documents before submitting.', 
                       'Go to Uploads', 
                       'documents1.php'
                   );
                   return;
                }

                // If documents are complete, show submitting state
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Submitting...';
            });
        }
    });
</script>

</body>
</html>
