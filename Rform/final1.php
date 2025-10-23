<?php
session_start();
date_default_timezone_set('Asia/Yangon');

// Handle payment choice selection from final.php
if (isset($_GET['payment_choice'])) {
    $choice = $_GET['payment_choice'];
    if ($choice === 'later') {
        $_SESSION['payment_choice'] = 'later';
        unset($_SESSION['payment_receipt_path']); 
    } elseif ($choice === 'reset') {
        unset($_SESSION['payment_choice']);
        unset($_SESSION['payment_receipt_path']);
    }
    header('Location: final1.php'); // Redirect to clean the URL
    exit();
}

require_once "db.php";
// echo '<pre>';
// print_r($_SESSION);
$modal_data = null; 

// This variable will be used to disable the submit button if documents are missing.
$all_documents_uploaded = isset($_SESSION['document_files']) && count($_SESSION['document_files']) === 11;
// This variable checks if the user has selected a payment option.
$payment_choice_made = isset($_SESSION['payment_choice']) && in_array($_SESSION['payment_choice'], ['later', 'paid']);

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
    
    // --- FIXED: ADDED THIS CHECK ---
    // This page is for OLD students. If student_id is missing, it's a critical session error.
    if (!isset($_SESSION['student_id']) || empty($_SESSION['student_id'])) {
        $modal_data = [
            'type' => 'error',
            'title' => 'Session Error',
            'message' => 'Your session is missing the Student ID. Please log in or verify again.',
            'buttonText' => 'Go to Verification',
            'redirectUrl' => 'verify_student.php' // Send them back to the start for old students
        ];
    } 
    // --- END FIX ---
    
    elseif (!isset($_SESSION['form1_data']) || !isset($_SESSION['option_data']) || !isset($_SESSION['document_files'])) {
        $modal_data = [
            'type' => 'error',
            'title' => 'Session Expired',
            'message' => 'Your session has expired. Please start the process again.',
            'buttonText' => 'Start Over',
            'redirectUrl' => isset($_SESSION['student_id']) ? 'verify_student.php' : 'data_add.php?new=1'
        ];
    } elseif (!$all_documents_uploaded) {
        $modal_data = [
            'type' => 'error',
            'title' => 'Missing Documents',
            'message' => 'Please upload all 11 required documents before submitting.',
            'buttonText' => 'Go Back to Upload',
            'redirectUrl' => 'documents1.php'
        ];
    } elseif (!$payment_choice_made) { // Added payment check
        $modal_data = [
            'type' => 'error',
            'title' => 'Payment Option Required',
            'message' => 'Please select a payment option in Step 4 before submitting.',
            'buttonText' => 'OK',
            'redirectUrl' => 'javascript:void(0)'
        ];
    } else {
        try {
            $pdo->beginTransaction();

            $form1 = $_SESSION['form1_data'];
            $option = $_SESSION['option_data'];
            $documents = $_SESSION['document_files'];
            $student_id = $_SESSION['student_id']; // This is safe now because of the check above

            $stmt_update = $pdo->prepare("
                UPDATE students 
                SET 
                    academic_year = :academic_year,
                    seat_no = :seat_no,
                    selected_major = :selected_major,
                    status = 'pending',
                    date = :submission_date,
                    payment_status = :payment_status,
                    payment_receipt_path = :payment_receipt_path,
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
                ':selected_major' => $form1['selected_major'] ?? null,
                ':submission_date' => date('Y-m-d H:i:s'),
                ':payment_status' => $_SESSION['payment_choice'] ?? 'pending',
                ':payment_receipt_path' => $_SESSION['payment_receipt_path'] ?? null,
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

            $pdo->commit();
            
            $student_email = htmlspecialchars($form1['student_email'] ?? 'your email');
            $success_message = "သင်၏ကျောင်းဝင်ခွင့်လျှောက်လွှာကို အောင်မြင်စွာလက်ခံရရှိပါသည်။သင့်အချက်အလက်များအားစစ်ဆေးပြီးပါက ".$student_email." သို့ပြန်လည်အကြောင်းကြားပေးပါမည်။";
            
            session_destroy();
            
            $modal_data = [
                'type' => 'success', 'title' => 'Success', 'message' => $success_message,
                'buttonText' => 'Go to Homepage', 'redirectUrl' => '../index.php'
            ];
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log("Submission error: " . $e->getMessage());
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
$check_icon = '<div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-green-100 text-green-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></div>';
$cross_icon = '<div class="w-12 h-12 mb-3 flex items-center justify-center rounded-full bg-red-100 text-red-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></div>';
?>

<div class="w-full max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl py-12 px-8 md:px-12 space-y-8">
    <div class="text-center space-y-2 mb-6">
        <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-20 h-20"/>
        <h2 class="text-4xl font-extrabold text-gray-800">Final Submission</h2>
        <p class="text-gray-500">Please review your details carefully.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
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
        
        <div id="paymentStep" class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center shadow-md border border-gray-200 min-h-[180px] cursor-pointer hover:border-indigo-400 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
            <div id="paymentInfo" class="text-center flex-grow flex flex-col items-center justify-center">
                <?php echo $payment_choice_made ? $check_icon : $cross_icon; ?>
                <p class="text-xs font-medium text-gray-400 mb-1">Step 4</p>
                <p class="font-semibold text-lg text-gray-700 text-center h-14 flex items-center justify-center">
                    <?php 
                        if (isset($_SESSION['payment_choice'])) {
                            if ($_SESSION['payment_choice'] === 'paid') echo 'Payment Complete';
                            else if ($_SESSION['payment_choice'] === 'later') echo 'Pay on Arrival';
                        } else {
                            echo 'Payment';
                        }
                    ?>
                </p>
                <!-- <a href="final1.php?payment_choice=reset" class="text-xs text-indigo-600 hover:underline">Change selection</a> -->
            </div>
            
           <div id="paymentOptions" class="hidden w-full text-center">
                 <p class="font-semibold text-lg text-gray-700 mb-4">Choose Payment</p>
                <a href="../paymentGuide.php?return_to=final1" class="block w-full px-4 py-3 text-base font-medium text-indigo-600 bg-indigo-100 rounded-lg hover:bg-indigo-200 transition-colors">Pay Now</a>
                <div class="my-2 text-xs text-gray-500">OR</div>
                <a href="final1.php?payment_choice=later" class="block w-full px-4 py-3 text-base font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">Pay on Arrival</a>
            </div>
        </div>
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
        
        <div class="bg-gray-50 p-4 sm:p-6 rounded-xl border">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-semibold text-lg text-gray-700">Payment Status</h4>
                <a href="final1.php?payment_choice=reset" class="text-sm font-semibold text-indigo-600 hover:underline">Edit</a>
            </div>
            <p class="text-gray-600">
                <?php 
                if (isset($_SESSION['payment_choice'])) {
                    if ($_SESSION['payment_choice'] === 'paid') {
                        echo 'Payment has been completed.';
                        if(isset($_SESSION['payment_receipt_path'])) {
                            $receipt_path = htmlspecialchars($_SESSION['payment_receipt_path']);
                            $link_path = '../' . $receipt_path;
                            echo ' <a href="' . $link_path . '" target="_blank" class="text-sm font-semibold text-indigo-600 hover:underline ml-2">View Receipt</a>';
                        }
                    } elseif ($_SESSION['payment_choice'] === 'later') {
                        echo 'You have chosen to pay on arrival.';
                    }
                } else {
                    echo 'No payment option selected.';
                }
                ?>
            </p>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
        <a href="documents1.php" class="w-full sm:w-auto px-6 py-3 rounded-full border border-gray-300 font-medium text-gray-700 hover:bg-gray-50 transition-colors text-center shadow-sm hover:shadow-md">Back</a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w-full sm:w-auto">
            <button type="submit" id="submitBtn" class="w-full sm:w-auto px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-transform transform hover:scale-105 shadow-md <?php if (!$all_documents_uploaded || !$payment_choice_made) echo 'disabled-button'; ?>">
                 <?php 
                    if (!$all_documents_uploaded) {
                        echo 'Documents Incomplete';
                    } elseif (!$payment_choice_made) {
                        echo 'Select Payment';
                    } else {
                        echo 'Submit Application';
                    }
                ?>
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
             if (redirectUrl === 'javascript:void(0)') {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modalContent.classList.add('scale-95');
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

    document.addEventListener('DOMContentLoaded', function() {
        const allDocumentsUploaded = <?php echo $all_documents_uploaded ? 'true' : 'false'; ?>;
        const paymentChoiceMade = <?php echo $payment_choice_made ? 'true' : 'false'; ?>;
        const submitBtn = document.getElementById('submitBtn');

        if (!allDocumentsUploaded || !paymentChoiceMade) {
            submitBtn.title = 'Please complete all steps before submitting.';
        }
        
        const finalForm = document.querySelector('form[action*="final1.php"]');
        if (finalForm) {
            finalForm.addEventListener('submit', function(e) {
                // This client-side check is just for UI, the server-side check is the real guard
                if (!allDocumentsUploaded) {
                   e.preventDefault(); 
                   showModal('error', 'Missing Documents', 'Please upload all 11 required documents.', 'Go to Uploads', 'documents1.php');
                   return;
                }
                if (!paymentChoiceMade) {
                   e.preventDefault(); 
                   showModal('error', 'Payment Option Required', 'Please select a payment option in Step 4.', 'OK', 'javascript:void(0)');
                   return;
                }
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Submitting...';
            });
        }
        
        const paymentStep = document.getElementById('paymentStep');
        const paymentInfo = document.getElementById('paymentInfo');
        const paymentOptions = document.getElementById('paymentOptions');
        
        paymentInfo.classList.remove('hidden');
        paymentOptions.classList.add('hidden');

        if (paymentStep) {
            paymentStep.addEventListener('click', function(event) {
                if (event.target.closest('a')) {
                    return;
                }
                event.stopPropagation();
                
                paymentInfo.classList.toggle('hidden');
                paymentOptions.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', function(event) {
            if (!paymentOptions.classList.contains('hidden') && !paymentStep.contains(event.target)) {
                paymentInfo.classList.remove('hidden');
                paymentOptions.classList.add('hidden');
            }
        });
    });
</script>

</body>
</html>

