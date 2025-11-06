<?php
    // Start a new session or resume an existing one
    session_start();
    // Set the default timezone to Myanmar time
    date_default_timezone_set('Asia/Yangon');

    // If the user is starting a new application (e.g., by visiting form1.php?new=1),
    // clear any previously saved form data from the session.
    if (isset($_GET['new']) && $_GET['new'] == '1') {
        unset($_SESSION['form1_data']);
        unset($_SESSION['form1_errors']); // Also clear any leftover errors
        // Redirect to remove the "?new=1" from the URL, so a page refresh doesn't clear the form again.
        header('Location: data_add.php');
        exit;
    }

    // require_once __DIR__ . '/../config.php';

    // --- Academic Year Calculation ---
    $current_month = date('n');
    $current_year  = date('Y');
    // The academic year is assumed to change in June.
    if ($current_month >= 6) {
        $academic_year_value = $current_year . '-' . ($current_year + 1);
    } else {
        $academic_year_value = ($current_year - 1) . '-' . $current_year;
    }

    // --- Define Available Majors (Added from data_add2.php) ---
    $available_majors = [
        'IST' => 'သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာအင်ဂျင်နီယာဘာသာရပ်(IST)',
        'CE'  => 'ကွန်ပျူတာအင်ဂျင်နီယာ ဘာသာရပ်(CE)',
        'EcE' => 'အီလက်ထရောနစ် အင်ဂျင်နီယာ ဘာသာရပ်(EcE)',
        'PrE' => 'တိကျပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ ဘာသာရပ်(PrE)',
        'AME' => 'အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ ဘာသာရပ်(AME)',
    ];

    // --- Retrieve errors from session if they exist, then clear them ---
    $errors = $_SESSION['form1_errors'] ?? [];
    unset($_SESSION['form1_errors']);

    // Define variables and initialize with empty values
    $year               = $academic_year        = $seat_no              = $student_email           = $entry_year           = "";
    $student_name_mm    = $father_name_mm       = $mother_name_mm       = "";
    $student_name_en    = $father_name_en       = $mother_name_en       = "";
    $student_race       = $father_race          = $mother_race          = "";
    $student_religion   = $father_religion      = $mother_religion      = "";
    $student_nrc        = $father_nrc           = $mother_nrc           = "";
    $student_dob        = $student_birthplace   = "";
    $father_info        = $mother_info          = "";
    $father_deceased_year = $mother_deceased_year = "";
    $student_address    = $date = "";
    $state_region       = $township       = ""; // Added for birthplace dropdowns
    $photo_url          = "";
    $date               = date('d-m-Y');
    $selected_major     = ""; // Added for major selection
    
    // --- Repopulate fields from session data ---
    function getValue($fieldName, $default = '')
    {
        // Data is always retrieved from the session now
        if (isset($_SESSION['form1_data'][$fieldName])) {
            // Special handling for date to display it in d-m-Y format
            if ($fieldName === 'date') {
                try {
                    // It might be in Y-m-d H:i:s format, so we parse and reformat
                    $date_obj = new DateTime($_SESSION['form1_data']['date']);
                    return htmlspecialchars(trim($date_obj->format('d-m-Y')));
                } catch (Exception $e) {
                    return htmlspecialchars(trim($_SESSION['form1_data'][$fieldName]));
                }
            }
            return htmlspecialchars(trim($_SESSION['form1_data'][$fieldName]));
        }
        return $default;
    }

    // --- Helper function and data for repopulating NRC dropdowns ---
    $repopulate_nrc = [
        'student' => ['state' => '', 'township' => '', 'type' => '', 'number' => ''],
        'father'  => ['state' => '', 'township' => '', 'type' => '', 'number' => ''],
        'mother'  => ['state' => '', 'township' => '', 'type' => '', 'number' => ''],
    ];

    function parseNrc($nrc_string, &$repopulate_array)
    {
        // Myanmar to English digit mapping for parsing
        $myanmar_to_english = [
            '၀' => '0', '၁' => '1', '၂' => '2', '၃' => '3', '၄' => '4',
            '၅' => '5', '၆' => '6', '၇' => '7', '၈' => '8', '၉' => '9'
        ];

        if (! empty($nrc_string)) {
            // Check if the NRC string contains Myanmar digits in state part
            if (preg_match('/^([၀-၉]+)\/([^\(]+)(\(\S+\))([၀-၉]+)$/', $nrc_string, $matches)) {
                // Convert Myanmar state to English for internal processing
                $state_myanmar = $matches[1];
                $state_english = strtr($state_myanmar, $myanmar_to_english);
                
                $repopulate_array['state']    = $state_english;
                $repopulate_array['township'] = $matches[2];
                $repopulate_array['type']     = $matches[3];
                $repopulate_array['number']   = $matches[4];
            }
            // Fallback for English digit format
            elseif (preg_match('/^(\d+)\/([^\(]+)(\(\S+\))(\d+)$/', $nrc_string, $matches)) {
                $repopulate_array['state']    = $matches[1];
                $repopulate_array['township'] = $matches[2];
                $repopulate_array['type']     = $matches[3];
                $repopulate_array['number']   = $matches[4];
            }
        }
    }

    parseNrc(getValue('student_nrc'), $repopulate_nrc['student']);
    parseNrc(getValue('father_nrc'), $repopulate_nrc['father']);
    parseNrc(getValue('mother_nrc'), $repopulate_nrc['mother']);

    // Processing form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $existing_photo_url = $_SESSION['form1_data']['photo_url'] ?? '';
        $_SESSION['form1_data'] = $_POST;
        $_SESSION['form1_data']['photo_url'] = $existing_photo_url;

        $validation_errors = [];

        // --- Handle Photo Upload ---
        $original_photo_on_load = $_SESSION['form1_data']['photo_url']; // Now it gets the correct existing path
        $is_new_upload_attempt = isset($_FILES["photo_upload"]) && $_FILES["photo_upload"]["error"] != UPLOAD_ERR_NO_FILE;
        $is_removal_request = !empty($_POST['remove_photo']) && $_POST['remove_photo'] == '1';

        if ($is_new_upload_attempt && $_FILES["photo_upload"]["error"] == UPLOAD_ERR_OK) {
            $target_dir ="../uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $imageFileType = strtolower(pathinfo($_FILES["photo_upload"]["name"], PATHINFO_EXTENSION));
            $unique_name = uniqid('photo_', true) . '.' . $imageFileType;
            $target_file = $target_dir . $unique_name;
            $uploadOk = 1;

            $check = getimagesize($_FILES["photo_upload"]["tmp_name"]);
            if ($check === false) {
                $validation_errors['photo_upload'] = "File is not an image.";
                $uploadOk = 0;
            }
            if ($_FILES["photo_upload"]["size"] > 5000000) {
                $validation_errors['photo_upload'] = "Sorry, your file is too large (Max 5MB).";
                $uploadOk = 0;
            }
            if (!in_array($imageFileType, ["jpg", "png", "jpeg"])) {
                $validation_errors['photo_upload'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $target_file)) {
                    // If a new photo is uploaded, delete the old one
                    if (!empty($original_photo_on_load) && file_exists($original_photo_on_load)) {
                        unlink($original_photo_on_load);
                    }
                    $_SESSION['form1_data']['photo_url'] = $target_file; // Save new path to session
                } else {
                    $validation_errors['photo_upload'] = "Sorry, there was an error uploading your file.";
                }
            }
        } elseif ($is_removal_request) {
            // If photo removal is requested
            if (!empty($original_photo_on_load) && file_exists($original_photo_on_load)) {
                unlink($original_photo_on_load);
            }
            $_SESSION['form1_data']['photo_url'] = ''; // Clear photo URL from session
        }

        // Explicitly save the student's NRC data to the session to ensure it persists.
        if (isset($_POST['student_nrc'])) {
            $_SESSION['form1_data']['student_nrc'] = trim($_POST['student_nrc']);
        }


        // --- Validate Required Fields ----
        // We validate based on the session data which now includes the latest POST and photo info
        if (empty($_SESSION['form1_data']['photo_url'])) {
            $validation_errors['photo_upload'] = "ကျေးဇူးပြု၍ ဓာတ်ပုံထည့်သွင်းပါ။";
        }
        
        if (empty($_POST['academic_year'])) $validation_errors['academic_year'] = "သင်တန်းနှစ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_email'])) $validation_errors['student_email'] = "emailထည့်ပေးပါရန်";
        if (empty($_POST['seat_no'])) $validation_errors['seat_no'] = "ခုံအမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_name_mm'])) $validation_errors['student_name_mm'] = "ကျောင်းသား/သူ၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_name_en'])) $validation_errors['student_name_en'] = "ကျောင်းသား/သူ၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_race'])) $validation_errors['student_race'] = "ကျောင်းသား/သူ၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_religion'])) $validation_errors['student_religion'] = "ကိုးကွယ်သည့်ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        // Validate against the session value which is now guaranteed to be set
        if (empty($_SESSION['form1_data']['student_nrc'])) $validation_errors['student_nrc'] = "ကျောင်းသား/သူ၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_dob'])) $validation_errors['student_dob'] = "ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_birthplace'])) $validation_errors['student_birthplace'] = "မွေးဖွားရာဇာတိထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_phone'])) $validation_errors['student_phone'] = "ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_address'])) $validation_errors['student_address'] = "ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['date'])) $validation_errors['date'] = "ရက်စွဲထည့်သွင်းရန်လိုအပ်ပါသည်။";
        
        // --- Validate Major Selection (Added from data_add2.php) ---
        if (empty($_POST['selected_major'])) {
            $validation_errors['selected_major'] = "ကျေးဇူးပြု၍ ဘာသာရပ်ရွေးချယ်ပါ။";
        } elseif (!array_key_exists($_POST['selected_major'], $available_majors)) {
            $validation_errors['selected_major'] = "သင်ရွေးချယ်လိုက်သော ဘာသာရပ်သည် ရွေးချယ်ခွင့်မရှိပါ။";
        }
        
        // --- Conditional Parent Validation ---
        if (empty($_POST['father_deceased_year'])) {
            if (empty($_POST['father_name_mm'])) $validation_errors['father_name_mm'] = "အဘ(အရင်း)၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_name_en'])) $validation_errors['father_name_en'] = "အဘ(အရင်း)၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_religion'])) $validation_errors['father_religion'] = "အဘ(အရင်း)၏ ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_race'])) $validation_errors['father_race'] = "အဘ(အရင်း)၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_info'])) $validation_errors['father_info'] = "အဘ(အရင်း)၏ အလုပ်အကိုင်/ပညာအရည်အချင်း ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_nrc'])) $validation_errors['father_nrc'] = "အဘ(အရင်း)၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_address'])) $validation_errors['father_address'] = "အဘ(အရင်း)၏ ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['father_phone'])) $validation_errors['father_phone'] = "အဘ(အရင်း)၏ ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        } else {
            // If father is deceased, clear any errors for father fields since they're not required
            unset($validation_errors['father_name_mm'], $validation_errors['father_name_en'], $validation_errors['father_religion'], 
                $validation_errors['father_race'], $validation_errors['father_info'], $validation_errors['father_nrc'], 
                $validation_errors['father_address'], $validation_errors['father_phone']);
        }
        
        if (empty($_POST['mother_deceased_year'])) {
            if (empty($_POST['mother_name_mm'])) $validation_errors['mother_name_mm'] = "အမိ(အရင်း)၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_name_en'])) $validation_errors['mother_name_en'] = "အမိ(အရင်း)၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_religion'])) $validation_errors['mother_religion'] = "အမိ(အရင်း)၏ ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_race'])) $validation_errors['mother_race'] = "အမိ(အရင်း)၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_info'])) $validation_errors['mother_info'] = "အမိ(အရင်း)၏ အလုပ်အကိုင်/ပညာအရည်အချင်း ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_nrc'])) $validation_errors['mother_nrc'] = "အမိ(အရင်း)၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_address'])) $validation_errors['mother_address'] = "အမိ(အရင်း)၏ ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            if (empty($_POST['mother_phone'])) $validation_errors['mother_phone'] = "အမိ(အရင်း)၏ ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        } else {
            // If mother is deceased, clear any errors for mother fields since they're not required
            unset($validation_errors['mother_name_mm'], $validation_errors['mother_name_en'], $validation_errors['mother_religion'], 
                $validation_errors['mother_race'], $validation_errors['mother_info'], $validation_errors['mother_nrc'], 
                $validation_errors['mother_address'], $validation_errors['mother_phone']);
        }


        // --- PRG Pattern Step 2: Redirect based on validation result ---
        if (empty($validation_errors)) {
            // --- Date Conversion for MySQL (Only when moving to next page) ---
            $date_from_form = $_SESSION['form1_data']['date'];
            $date_obj = DateTime::createFromFormat('d-m-Y', $date_from_form);
            if ($date_obj) {
                $mysql_datetime = $date_obj->format('Y-m-d') . ' ' . date('H:i:s');
                $_SESSION['form1_data']['date'] = $mysql_datetime;
            } else {
                $_SESSION['form1_data']['date'] = date('Y-m-d H:i:s');
            }

            // No errors, proceed to form2.php
            header("location: option1.php");
            exit;
        } else {
            // Errors found, store them in the session
            $_SESSION['form1_errors'] = $validation_errors;

            // Redirect back to the same page to show errors and repopulated data
            header("Location: data_add.php");
            exit;
        }
    }
?>

<?php include 'formPartial/header.php';?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f0f4f8; /* Lighter blue-gray background */
    }
    .error-message {
        color: #D32F2F; /* Red color for errors */
        font-size: 0.75rem; /* 12px */
    }
    .form-container {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-radius: 1rem; /* More rounded corners */
        border: 1px solid #e2e8f0;
    }
    .form-title {
        color: #1e3a8a; /* Dark blue */
    }
    .form-subtitle {
        color: #3b82f6; /* Medium blue */
    }
    input[type="text"],
    input[type="date"],
    input[type="tel"],
    select,
    textarea {
        transition: all 0.3s ease-in-out;
        border-color: #cbd5e1;
    }
    input:focus, select:focus, textarea:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4) !important;
        outline: none;
    }
    select[readonly] {
        background-color: #f1f5f9;
        pointer-events: none;
    }
    select[readonly]:focus {
        box-shadow: none !important;
        border-color: #cbd5e1 !important;
    }
    .section-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        transition: box-shadow 0.3s ease;
    }
    .section-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .section-header {
        color: #1e3a8a; /* Dark blue */
        border-bottom: 2px solid #93c5fd; /* Light blue underline */
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .nav-button-next {
        background-image: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        border: none;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease;
    }
    .nav-button-next:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }
    #photo-upload-area {
        border-color: #93c5fd;
        background-color: #eff6ff;
    }
    /* Style for highlighting the first error field */
    .error-highlight {
        background-color: #fef3c7 !important; /* Light yellow */
        transition: background-color 0.5s ease-out;
        border-radius: 0.5rem;
        box-shadow: 0 0 0 2px #fcd34d;
    }
    /* NRC number validation styles */
    .nrc-number.border-red-500 {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2) !important;
    }
    /* Language restriction styles */
    .language-error {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2) !important;
    }
</style>
    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
        <div class="max-w-4xl mx-auto bg-white p-3 py-3 sm:p-6 md:p-8 form-container">

            <!-- Form Header -->
            <div class="flex justify-between items-start mb-4 ">
                <p class="text-sm text-gray-400">Form No. UTYCC-20</p>
                <div class="text-right">
                    <label for="year" class="block text-sm font-medium text-gray-500">ခုနှစ်</label>
                    <input type="text" id="year" name="year" class="mt-1 w-24 text-center bg-gray-100 rounded-md border-gray-200" value="<?php echo $academic_year_value; ?>" readonly>
                </div>
            </div>

            <div class="text-center mb-8">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold form-title">ကျောင်းသားအဖြစ်မှ မှတ်ပုံတင်ခွင့်တောင်းခံလွှာ</h1>
                <h2 class="text-md sm:text-lg md:text-xl font-semibold form-subtitle mt-2">
                    နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)</h2>
            </div>

            <!-- Top Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="relative pb-5">
                    <label for="academic_year" class="block text-sm font-medium text-gray-700">သင်တန်းနှစ်</label>
                    <select id="academic_year" name="academic_year" class="mt-1" required>
                        <option value="">-- Select Academic Year --</option>
                        <option value="Second Year" <?php echo (getValue('academic_year') == 'Second Year') ? 'selected' : ''; ?>>Second Year</option>
                        <option value="Third Year" <?php echo (getValue('academic_year') == 'Third Year') ? 'selected' : ''; ?>>Third Year</option>
                        <option value="Fourth Year" <?php echo (getValue('academic_year') == 'Fourth Year') ? 'selected' : ''; ?>>Fourth Year</option>
                        <option value="Fifth Year" <?php echo (getValue('academic_year') == 'Fifth Year') ? 'selected' : ''; ?>>Fifth Year</option>
                        <option value="Final Year" <?php echo (getValue('academic_year') == 'Final Year') ? 'selected' : ''; ?>>Final Year</option>
                    </select>
                    <?php if (isset($errors['academic_year'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['academic_year']; ?></p><?php endif; ?>
                </div>
                    <div class="relative pb-5">
                        <label for="seat_no" class="block text-sm font-medium text-gray-700">ခုံအမှတ်</label>
                        <input type="text" placeholder="Roll No" id="seat_no" name="seat_no" class="mt-1" value="<?php echo getValue('seat_no'); ?>">
                        <?php if (isset($errors['seat_no'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['seat_no']; ?></p><?php endif; ?>
                    </div>
                
                    <!-- Major Selection Field (Added from data_add2.php) -->
                    <div class="sm:col-span-2 relative pb-5">
                        <label for="selected_major" class="block text-sm font-medium text-gray-700">ဘာသာရပ်ရွေးချယ်ရန်</label>
                        <select id="selected_major" name="selected_major" class="mt-1" required>
                            <option value="">ကျေးဇူးပြု၍ ဘာသာရပ်ရွေးချယ်ပါ</option>
                            <?php foreach ($available_majors as $major_code => $major_full_name) : ?>
                                <option value="<?php echo $major_code; ?>" <?php if (getValue('selected_major') == $major_code) echo 'selected'; ?>>
                                    <?php echo $major_full_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['selected_major'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['selected_major']; ?></p><?php endif; ?>
                    </div>
                
                    <div class="sm:col-span-2">
                        <label for="entry_year" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်ဝင်ရောက်သည့်နှစ်</label>
                        <input type="text" id="entry_year" value="2025" name="entry_year" class="mt-1" value="<?php echo getValue('entry_year'); ?>" readonly>
                    </div>
                </div>
                <div id="photo-upload-area" class="flex flex-col items-center justify-center border-2 border-dashed rounded-lg p-2 h-48">
                    <div id="photo-placeholder" class="text-center">
                        <span class="text-gray-500">ဓါတ်ပုံကပ်ရန်</span>
                        <button type="button" onclick="document.getElementById('photo_upload').click()" class="mt-2 block mx-auto px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">Upload</button>
                    </div>
                    <div id="photo-preview-container" class="hidden w-full h-full">
                        <img id="photo-preview" src="#" alt="Photo Preview">
                        <div id="remove-photo-btn" title="Remove Photo">×</div>
                    </div>
                    <input type="file" class="hidden" id="photo_upload" name="photo_upload" accept="image/*">
                    <input type="hidden" name="remove_photo" id="remove_photo_flag" value="0">
                    <?php if (isset($errors['photo_upload'])): ?><p class="error-message mt-2 server-error-message"><?php echo $errors['photo_upload']; ?></p><?php endif; ?>
                </div>
            </div>

            <!-- Main Information Sections -->
            <div class="space-y-8 mt-8">

                <!-- Student Information Section -->
                <section class="section-card p-4 sm:p-6">
                    <h3 class="text-lg font-semibold mb-6 section-header pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span>ကျောင်းသား/သူ၏ ကိုယ်ရေးအချက်အလက်</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        <!-- Name MM -->
                        <div class="relative pb-5">
                            <label for="student_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                            <input type="text" id="student_name_mm" name="student_name_mm" class="mt-1 myanmar-field" value="<?php echo getValue('student_name_mm'); ?>" required>
                            <p class="error-message mt-1" id="student_name_mm_error" style="display: none;">မြန်မာစာသာရိုက်ထည့်ပါ။</p>
                            <?php if (isset($errors['student_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_name_mm']; ?></p><?php endif; ?>
                        </div>
                        <!-- Name EN -->
                        <div class="relative pb-5">
                            <label for="student_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                            <input type="text" id="student_name_en" name="student_name_en" class="mt-1 english-field" value="<?php echo getValue('student_name_en'); ?>" required>
                            <p class="error-message mt-1" id="student_name_en_error" style="display: none;">အင်္ဂလိပ်စာသာရိုက်ထည့်ပါ။</p>
                            <?php if (isset($errors['student_name_en'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_name_en']; ?></p><?php endif; ?>
                        </div>
                        <!-- Race -->
                        <div class="relative pb-5">
                            <label for="student_race" class="block text-sm font-medium text-gray-700">လူမျိုး</label>
                            <input type="text" id="student_race" name="student_race" class="mt-1" value="<?php echo getValue('student_race'); ?>" required>
                            <?php if (isset($errors['student_race'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_race']; ?></p><?php endif; ?>
                        </div>
                        <!-- Religion -->
                        <div class="relative pb-5">
                            <label for="student_religion" class="block text-sm font-medium text-gray-700">ကိုးကွယ်သည့်ဘာသာ</label>
                            <input type="text" id="student_religion" name="student_religion" class="mt-1" value="<?php echo getValue('student_religion'); ?>" required>
                            <?php if (isset($errors['student_religion'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_religion']; ?></p><?php endif; ?>
                        </div>
                        <!-- NRC -->
                        <div class="relative pb-5 md:col-span-2">
                            <div class="flex justify-between items-center">
                                <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                                <div class="flex items-center">
                                    <input type="checkbox" id="student_nrc_applying" name="student_nrc_applying" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="student_nrc_applying" class="ml-2 block text-sm text-gray-900">လျှောက်ထားဆဲ</label>
                                </div>
                            </div>
                            <div id="student_nrc_group" class="mt-1"></div>
                            <input type="hidden" name="student_nrc" id="student_nrc_hidden" value="<?php echo getValue('student_nrc'); ?>">
                            <?php if (isset($errors['student_nrc'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_nrc']; ?></p><?php endif; ?>
                        </div>
                        <!-- DOB -->
                        <div class="relative pb-5">
                            <label for="student_dob" class="block text-sm font-medium text-gray-700">မွေးသက္ကရာဇ်</label>
                            <input type="date" id="student_dob" name="student_dob" class="mt-1" value="<?php echo getValue('student_dob'); ?>" required>
                            <p id="dob_error_client" class="error-message absolute bottom-0 left-0" style="display: none;"></p>
                            <?php if (isset($errors['student_dob'])): ?><p id="dob_error_server" class="error-message absolute bottom-0 left-0"><?php echo $errors['student_dob']; ?></p><?php endif; ?>
                        </div>
                        <!-- Birthplace -->
                        <div class="relative pb-5">
                            <label for="student_birthplace" class="block text-sm font-medium text-gray-700">မွေးဖွားရာဇာတိ</label>
                            <div class="grid grid-cols-2 gap-2 mt-1">
                                <div>
                                    <select id="state_region" name="state_region" required>
                                        <option value="" disabled selected>တိုင်း/ပြည်နယ်</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="township" name="township" required>
                                        <option value="" disabled selected>မြို့နယ်</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="student_birthplace" name="student_birthplace" value="<?php echo getValue('student_birthplace'); ?>">
                            <?php if (isset($errors['student_birthplace'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_birthplace']; ?></p><?php endif; ?>
                        </div>
                        <!-- Phone -->
                        <div class="relative pb-5">
                            <label for="student_phone" class="block text-sm font-medium text-gray-700">ဆက်သွယ်ရန်ဖုန်းနံပါတ်</label>
                            <input type="tel" id="student_phone" name="student_phone" class="mt-1" value="<?php echo getValue('student_phone'); ?>" pattern="09\d{7,9}" maxlength="11" placeholder="09xxxxxxxxx" title="Please enter a valid Myanmar phone number starting with 09." required>
                            <?php if (isset($errors['student_phone'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_phone']; ?></p><?php endif; ?>
                        </div>
                        <!-- email -->
                        <div class="relative pb-5">
                            <label for="student_email" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" id="student_email" name="student_email" class="mt-1" value="<?php echo getValue('student_email'); ?>" placeholder="example@gmail.com" title="Please enter a valid email address." required>
                            <?php if (isset($errors['student_email'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_email']; ?></p><?php endif; ?>
                        </div>
                        <!-- Address -->
                        <div class="relative pb-5 md:col-span-2">
                            <label for="student_address" class="block text-sm font-medium text-gray-700">အမြဲတမ်း ဆက်သွယ်ရန်လိပ်စာ အပြည့်အစုံ</label>
                            <textarea id="student_address" name="student_address" rows="3" class="mt-1"><?php echo getValue('student_address'); ?></textarea>
                            <?php if (isset($errors['student_address'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_address']; ?></p><?php endif; ?>
                        </div>
                    </div>
                </section>

                <!-- Parent Information Section -->
                <section class="section-card p-4 sm:p-6">
                    <h3 class="text-lg font-semibold mb-6 section-header pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-500"><path d="M18 22a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M12 18h.01"/><path d="M12 14h.01"/><path d="M12 10h.01"/></svg>
                        <span>မိဘ၏ ကိုယ်ရေးအချက်အလက်</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                        <!-- Father's Column -->
                        <div class="space-y-2">
                            <h4 class="font-semibold text-gray-700 mt-2">အဘ (အရင်း)</h4>
                            <!-- Father Deceased -->
                            <div class="relative pb-5">
                                <label for="father_deceased_year" class="block text-sm font-medium text-gray-700">ကွယ်လွန်သည့်ခုနှစ် (ကွယ်လွန်ပါက)</label>
                                <input type="text" id="father_deceased_year" name="father_deceased_year" class="mt-1" placeholder="ဥပမာ - 2010" value="<?php echo getValue('father_deceased_year'); ?>">
                            </div>
                            <!-- Father Name MM -->
                            <div class="relative pb-5">
                                <label for="father_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                                <input type="text" id="father_name_mm" name="father_name_mm" class="mt-1 father-field myanmar-field" value="<?php echo getValue('father_name_mm'); ?>" required>
                                <p class="error-message mt-1" id="father_name_mm_error" style="display: none;">မြန်မာစာသာရိုက်ထည့်ပါ။</p>
                                <?php if (isset($errors['father_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_name_mm']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Name EN -->
                            <div class="relative pb-5">
                                <label for="father_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                                <input type="text" id="father_name_en" name="father_name_en" class="mt-1 father-field english-field" value="<?php echo getValue('father_name_en'); ?>" required>
                                <p class="error-message mt-1" id="father_name_en_error" style="display: none;">အင်္ဂလိပ်စာသာရိုက်ထည့်ပါ။</p>
                                <?php if (isset($errors['father_name_en'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_name_en']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Race -->
                            <div class="relative pb-5">
                                <label for="father_race" class="block text-sm font-medium text-gray-700">လူမျိုး</label>
                                <input type="text" id="father_race" name="father_race" class="mt-1 father-field" value="<?php echo getValue('father_race'); ?>">
                                <?php if (isset($errors['father_race'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_race']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Religion -->
                            <div class="relative pb-5">
                                <label for="father_religion" class="block text-sm font-medium text-gray-700">ကိုးကွယ်သည့်ဘာသာ</label>
                                <input type="text" id="father_religion" name="father_religion" class="mt-1 father-field" value="<?php echo getValue('father_religion'); ?>" required>
                                <?php if (isset($errors['father_religion'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_religion']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father NRC -->
                            <div class="relative pb-5">
                                <div class="flex justify-between items-center">
                                    <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                                </div>
                                <div id="father_nrc_group" class="mt-1 father-field-group"></div>
                                <input type="hidden" name="father_nrc" id="father_nrc_hidden" value="<?php echo getValue('father_nrc'); ?>">
                                <?php if (isset($errors['father_nrc'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_nrc']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Occupation -->
                            <div class="relative pb-5">
                                <label for="father_info" class="block text-sm font-medium text-gray-700">အလုပ်အကိုင်</label>
                                <textarea id="father_info" name="father_info" rows="2" class="mt-1 father-field disable-on-deceased"><?php echo getValue('father_info'); ?></textarea>
                                <?php if (isset($errors['father_info'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_info']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Address -->
                            <div class="relative pb-5">
                                <label for="father_address" class="block text-sm font-medium text-gray-700">နေရပ်လိပ်စာ</label>
                                <textarea id="father_address" name="father_address" rows="2" class="mt-1 father-field disable-on-deceased"><?php echo getValue('father_address'); ?></textarea>
                                <?php if (isset($errors['father_address'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_address']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Phone -->
                            <div class="relative pb-5">
                                <label for="father_phone" class="block text-sm font-medium text-gray-700">ဖုန်းနံပါတ်</label>
                                <input type="tel" id="father_phone" name="father_phone" class="mt-1 father-field disable-on-deceased" value="<?php echo getValue('father_phone'); ?>">
                                <?php if (isset($errors['father_phone'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_phone']; ?></p><?php endif; ?>
                            </div>
                        </div>

                        <!-- Mother's Column -->
                        <div class="space-y-2">
                            <h4 class="font-semibold text-gray-700 mt-2">အမိ (အရင်း)</h4>
                            <!-- Mother Deceased -->
                            <div class="relative pb-5">
                                <label for="mother_deceased_year" class="block text-sm font-medium text-gray-700">ကွယ်လွန်သည့်ခုနှစ် (ကွယ်လွန်ပါက)</label>
                                <input type="text" id="mother_deceased_year" name="mother_deceased_year" class="mt-1" placeholder="ဥပမာ - 2010" value="<?php echo getValue('mother_deceased_year'); ?>">
                            </div>
                            <!-- Mother Name MM -->
                            <div class="relative pb-5">
                                <label for="mother_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                                <input type="text" id="mother_name_mm" name="mother_name_mm" class="mt-1 mother-field myanmar-field" value="<?php echo getValue('mother_name_mm'); ?>" required>
                                <p class="error-message mt-1" id="mother_name_mm_error" style="display: none;">မြန်မာစာသာရိုက်ထည့်ပါ။</p>
                                <?php if (isset($errors['mother_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_name_mm']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Name EN -->
                            <div class="relative pb-5">
                                <label for="mother_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                                <input type="text" id="mother_name_en" name="mother_name_en" class="mt-1 mother-field english-field" value="<?php echo getValue('mother_name_en'); ?>" required>
                                <p class="error-message mt-1" id="mother_name_en_error" style="display: none;">အင်္ဂလိပ်စာသာရိုက်ထည့်ပါ။</p>
                                <?php if (isset($errors['mother_name_en'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_name_en']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Race -->
                            <div class="relative pb-5">
                                <label for="mother_race" class="block text-sm font-medium text-gray-700">လူမျိုး</label>
                                <input type="text" id="mother_race" name="mother_race" class="mt-1 mother-field" value="<?php echo getValue('mother_race'); ?>">
                                <?php if (isset($errors['mother_race'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_race']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Religion -->
                            <div class="relative pb-5">
                                <label for="mother_religion" class="block text-sm font-medium text-gray-700">ကိုးကွယ်သည့်ဘာသာ</label>
                                <input type="text" id="mother_religion" name="mother_religion" class="mt-1 mother-field" value="<?php echo getValue('mother_religion'); ?>" required>
                                <?php if (isset($errors['mother_religion'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_religion']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother NRC -->
                            <div class="relative pb-5">
                                <div class="flex justify-between items-center">
                                    <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                                </div>
                                <div id="mother_nrc_group" class="mt-1 mother-field-group"></div>
                                <input type="hidden" name="mother_nrc" id="mother_nrc_hidden" value="<?php echo getValue('mother_nrc'); ?>">
                                <?php if (isset($errors['mother_nrc'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_nrc']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Occupation -->
                            <div class="relative pb-5">
                                <label for="mother_info" class="block text-sm font-medium text-gray-700">အလုပ်အကိုင်</label>
                                <textarea id="mother_info" name="mother_info" rows="2" class="mt-1 mother-field disable-on-deceased"><?php echo getValue('mother_info'); ?></textarea>
                                <?php if (isset($errors['mother_info'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_info']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Address -->
                            <div class="relative pb-5">
                                <label for="mother_address" class="block text-sm font-medium text-gray-700">နေရပ်လိပ်စာ</label>
                                <textarea id="mother_address" name="mother_address" rows="2" class="mt-1 mother-field disable-on-deceased"><?php echo getValue('mother_address'); ?></textarea>
                                <?php if (isset($errors['mother_address'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_address']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Phone -->
                            <div class="relative pb-5">
                                <label for="mother_phone" class="block text-sm font-medium text-gray-700">ဖုန်းနံပါတ်</label>
                                <input type="tel" id="mother_phone" name="mother_phone" class="mt-1 mother-field disable-on-deceased" value="<?php echo getValue('mother_phone'); ?>">
                                <?php if (isset($errors['mother_phone'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_phone']; ?></p><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Declaration and Signature -->
            <div class="mt-8">
                <p class="text-sm text-red-600 bg-red-50 p-3 rounded-lg">ဖော်ပြပါအချက်အလက်များမှန်ကန်ကြောင်း ခံဝန်ကတိပြုပါသည်။ တစ်စုံတစ်ရာမှားယွင်းချက်ရှိပါက ကျွန်တော်/ကျွန်မ တာဝန်သာ ဖြစ်ပါသည်။</p>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end mt-12 gap-8 sm:gap-4">
                    <div class="w-full sm:w-auto relative pb-5">
                        <label for="date" class="block text-sm font-medium text-gray-700">ရက်စွဲ</label>
                        <input type="text" id="date" name="date" class="mt-1" placeholder="ဥပမာ - 16-08-2024" value="<?php echo getValue('date', date('d-m-Y')); ?>" required>
                        <?php if (isset($errors['date'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['date']; ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="nav-buttons mt-8 flex justify-between items-center">
                <a href="data_add.php?new=1" class="nav-button-back text-gray-600 hover:text-gray-900 font-medium">Start Over</a>
                <button type="submit" class="nav-button-next">Next Step</button>
            </div>

            <div class="text-right text-xs text-gray-400 mt-6">
                <p>UTYCC/ SA/ F-20/ Rev-0/31-10-2022</p>
            </div>
        </div>
    </form>
    <br>

    <?php
        include 'formPartial/footer.php';
        $repopulate_state    = getValue('state_region');
        $repopulate_township = getValue('township');
        $first_error_key = !empty($errors) ? array_key_first($errors) : '';
        
        // Prepare the photo URL for JS preview.
        $photo_url_for_js = '';
        $stored_photo_url = getValue('photo_url');
        if ($stored_photo_url) {
            $photo_url_for_js = 'uploads/' . basename($stored_photo_url);
        }
    ?>

<script>
    // Pass PHP values to JavaScript
    const previouslySelectedState = '<?php echo $repopulate_state; ?>';
    const previouslySelectedTownship = '<?php echo $repopulate_township; ?>';
    const repopulateNrcData = <?php echo json_encode($repopulate_nrc); ?>;
    const photoUrlFromServer = '<?php echo $photo_url_for_js; ?>';
    const firstErrorKeyFromServer = '<?php echo $first_error_key; ?>';

    // English to Myanmar digit mapping
    const digitMap = {
        '0': '၀',
        '1': '၁',
        '2': '၂',
        '3': '၃',
        '4': '၄',
        '5': '၅',
        '6': '၆',
        '7': '၇',
        '8': '၈',
        '9': '၉'
    };

    // Myanmar to English digit mapping (for validation)
    const myanmarDigitMap = {
        '၀': '0',
        '၁': '1',
        '၂': '2',
        '၃': '3',
        '၄': '4',
        '၅': '5',
        '၆': '6',
        '၇': '7',
        '၈': '8',
        '၉': '9'
    };

    // Function to convert English digits to Myanmar digits
    function convertToMyanmarDigits(input) {
        return input.replace(/[0-9]/g, function(match) {
            return digitMap[match];
        });
    }

    // Function to convert Myanmar digits to English digits (for validation)
    function convertToEnglishDigits(input) {
        return input.replace(/[၀၁၂၃၄၅၆၇၈၉]/g, function(match) {
            return myanmarDigitMap[match];
        });
    }

    // Function to validate NRC number (accepts both English and Myanmar digits)
    function isValidNrcNumber(number) {
        // Convert to English digits for validation
        const englishNumber = convertToEnglishDigits(number);
        return /^\d{6}$/.test(englishNumber);
    }

    // --- Input Language Restrictions ---
    function setupLanguageRestriction(inputId, allowedLanguage) {
        const inputElement = document.getElementById(inputId);
        if (!inputElement) return;

        // Define language patterns
        const patterns = {
            myanmar: /[\u1000-\u109F\uAA60-\uAA7F\uA9E0-\uA9FF]/g, // Myanmar Unicode ranges
            english: /[a-zA-Z]/g
        };

        // Define error messages
        const messages = {
            myanmar: "မြန်မာစာသာရိုက်ထည့်ပါ။",
            english: "အင်္ဂလိပ်စာသာရိုက်ထည့်ပါ။"
        };

        // Create error message element
        const errorElement = document.getElementById(inputId + '_error');
        
        inputElement.addEventListener('input', function(e) {
            const value = e.target.value;
            let isValid = true;

            if (allowedLanguage === 'myanmar') {
                // For Myanmar fields: allow only Myanmar characters and spaces
                const nonMyanmarChars = value.replace(patterns.myanmar, '').replace(/\s/g, '');
                if (nonMyanmarChars.length > 0) {
                    isValid = false;
                    // Remove non-Myanmar characters
                    e.target.value = value.replace(/[^\u1000-\u109F\uAA60-\uAA7F\uA9E0-\uA9FF\s]/g, '');
                }
            } else if (allowedLanguage === 'english') {
                // For English fields: allow only English letters and spaces
                const nonEnglishChars = value.replace(patterns.english, '').replace(/\s/g, '');
                if (nonEnglishChars.length > 0) {
                    isValid = false;
                    // Remove non-English characters
                    e.target.value = value.replace(/[^a-zA-Z\s]/g, '');
                }
            }

            // Show/hide error message
            if (!isValid && value.length > 0) {
                errorElement.textContent = messages[allowedLanguage];
                errorElement.style.display = 'block';
                inputElement.classList.add('language-error');
            } else {
                errorElement.style.display = 'none';
                inputElement.classList.remove('language-error');
            }
        });

        // Also validate on blur
        inputElement.addEventListener('blur', function(e) {
            const value = e.target.value;
            if (value.length > 0) {
                let isValid = true;
                
                if (allowedLanguage === 'myanmar') {
                    const nonMyanmarChars = value.replace(patterns.myanmar, '').replace(/\s/g, '');
                    isValid = nonMyanmarChars.length === 0;
                } else if (allowedLanguage === 'english') {
                    const nonEnglishChars = value.replace(patterns.english, '').replace(/\s/g, '');
                    isValid = nonEnglishChars.length === 0;
                }

                if (!isValid) {
                    errorElement.textContent = messages[allowedLanguage];
                    errorElement.style.display = 'block';
                    inputElement.classList.add('language-error');
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // --- Academic Year from Settings (ADDED) ---
        const savedAcademicYear = localStorage.getItem('academicYear');
        const yearInput = document.getElementById('year');

        if (savedAcademicYear && yearInput) {
            yearInput.value = savedAcademicYear;
        }
        
        // Apply language restrictions
        // Myanmar name fields
        setupLanguageRestriction('student_name_mm', 'myanmar');
        setupLanguageRestriction('father_name_mm', 'myanmar');
        setupLanguageRestriction('mother_name_mm', 'myanmar');
        
        // English name fields
        setupLanguageRestriction('student_name_en', 'english');
        setupLanguageRestriction('father_name_en', 'english');
        setupLanguageRestriction('mother_name_en', 'english');
        
        // --- Photo Upload & Preview Logic ---
        const photoUploadInput = document.getElementById('photo_upload');
        const photoPreview = document.getElementById('photo-preview');
        const previewContainer = document.getElementById('photo-preview-container');
        const placeholder = document.getElementById('photo-placeholder');
        const removeBtn = document.getElementById('remove-photo-btn');
        const removePhotoFlag = document.getElementById('remove_photo_flag');

        // Create a dedicated container for client-side photo validation messages
        const photoClientErrorContainer = document.createElement('p');
        photoClientErrorContainer.className = 'error-message mt-2';
        photoUploadInput.parentElement.appendChild(photoClientErrorContainer);

        function showPhotoPreview(url) {
            if (!url) return;
            photoPreview.src = url;
            placeholder.style.display = 'none';
            previewContainer.style.display = 'block';
        }

        function hidePhotoPreview() {
            photoPreview.src = '#';
            placeholder.style.display = 'block';
            previewContainer.style.display = 'none';
            photoUploadInput.value = ''; // Clear the file input
            removePhotoFlag.value = '1'; // Set flag to remove on server
        }

        // On page load, check for an existing photo from the server session
        if (photoUrlFromServer) {
            showPhotoPreview(photoUrlFromServer);
        }

        photoUploadInput.addEventListener('change', function() {
            // Clear previous client-side errors
            photoClientErrorContainer.textContent = '';
            
            // Hide any server-side error when a new file is chosen
            const serverError = this.parentElement.querySelector('.server-error-message');
            if (serverError) {
                serverError.style.display = 'none';
            }

            if (this.files && this.files[0]) {
                const file = this.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (!allowedTypes.includes(file.type)) {
                    photoClientErrorContainer.textContent = 'Sorry, only JPG, JPEG, & PNG files are allowed.';
                    hidePhotoPreview();
                    return;
                }

                if (file.size > maxSize) {
                    photoClientErrorContainer.textContent = 'Sorry, your file is too large (Max 5MB).';
                    hidePhotoPreview();
                    return;
                }

                removePhotoFlag.value = '0'; // If a new file is selected, don't remove it
                const reader = new FileReader();
                reader.onload = function(e) {
                    showPhotoPreview(e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        removeBtn.addEventListener('click', function() {
            hidePhotoPreview();
        });


        // --- Date of Birth Validation ---
        const dobInput = document.getElementById('student_dob');
        const clientErrorContainer = document.getElementById('dob_error_client');
        const serverErrorContainer = document.getElementById('dob_error_server');

        if (dobInput) {
            const today = new Date();
            const maxDate = today.toISOString().split('T')[0];
            dobInput.setAttribute('max', maxDate);
            const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate()).toISOString().split('T')[0];
            dobInput.setAttribute('min', minDate);
        }

        const validateDateOfBirth = () => {
            if (!dobInput) return true;

            // Hide server error on new input
            if(serverErrorContainer) {
                serverErrorContainer.style.display = 'none';
            }

            clientErrorContainer.style.display = 'none';
            clientErrorContainer.textContent = '';
            const dobValue = dobInput.value;
            if (!dobValue) {
                return true;
            }
            const birthDate = new Date(dobValue);
            const currentDate = new Date();
            if (birthDate > currentDate) {
                clientErrorContainer.textContent = 'မွေးသက္ကရာဇ်သည် ယနေ့ထက်နောက်ကျ၍မရပါ။';
                clientErrorContainer.style.display = 'block';
                return false;
            }
            let age = currentDate.getFullYear() - birthDate.getFullYear();
            const monthDifference = currentDate.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && currentDate.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age < 16) {
                clientErrorContainer.textContent = 'အသက် ၁၆ နှစ်ပြည့်ပြီးသူဖြစ်ရပါမည်။';
                clientErrorContainer.style.display = 'block';
                return false;
            }
            if (age > 100) {
                clientErrorContainer.textContent = 'ထည့်သွင်းထားသော အသက်သည် မှန်ကန်မှုမရှိပါ။';
                clientErrorContainer.style.display = 'block';
                return false;
            }
            return true;
        };

        if (dobInput) {
            dobInput.addEventListener('input', validateDateOfBirth);
        }

        // --- Birthplace Dropdown Logic ---
        const locationData = {
            "ကချင်ပြည်နယ်": ["မြစ်ကြီးနား", "ဝိုင်းမော်", "ချီဖွေ", "ဆော့လော်", "တနိုင်း", "အင်ဂျန်းယန်", "မိုးညှင်း", "မိုးကောင်း", "ဖားကန့်", "ဗန်းမော်", "ရွှေကူ", "မံစီ", "မိုးမောက်", "ပူတာအို", "ဆွမ်ပရာဘွမ်", "မချမ်းဘော", "ခေါင်းလန်းဖူး", "နောင်မွန်း"],
            "ကယားပြည်နယ်": ["လွိုင်ကော်", "ဒီးမော့ဆို", "ဖရူဆို", "ရှားတော", "ဘော်လခဲ", "မယ်စဲ့", "ဖာဆောင်း"],
            "ကရင်ပြည်နယ်": ["ဘားအံ", "လှိုင်းဘွဲ", "သံတောင်ကြီး", "ကော့ကရိတ်", "ကြာအင်းဆိပ်ကြီး", "မြဝတီ", "ဖာပွန်"],
            "ချင်းပြည်နယ်": ["ဟားခါး", "ထန်တလန်", "မင်းတပ်", "ပလက်ဝ", "မတူပီ", "ကန်ပက်လက်", "ဖလမ်း", "တီးတိန်", "တွန်းဇံ"],
            "စစ်ကိုင်းတိုင်းဒေသကြီး": ["မုံရွာ", "အရာတော်", "ချောင်းဦး", "ဘုတလင်", "စစ်ကိုင်း", "မြောင်", "မြင်းမူ", "ကလေး", "ကလေးဝ", "မင်းကင်း", "ကသာ", "အင်းတော်", "ဗန်းမောက်", "ကောလင်း", "ပင်လည်ဘူး", "ဝန်းသို", "ထီးချိုင့်", "ခန္တီး", "ဟုမ္မလင်း", "လေရှီး", "နန်းယွန်း", "လဟယ်", "မော်လိုက်", "ဖောင်းပြင်", "ယင်းမာပင်", "ဆားလင်းကြီး", "ပုလဲ", "ကနီ", "ရွှေဘို", "ဒီပဲယင်း", "ကန့်ဘလူ", "ခင်ဦး", "ကျွန်းလှ", "တန့်ဆည်", "ရေဦး", "ဝက်လက်", "တမူး"],
            "တနင်္သာရီတိုင်းဒေသကြီး": ["ထားဝယ်", "လောင်းလုံး", "သရက်ချောင်း", "ရေဖြူ", "မြိတ်", "တနင်္သာရီ", "ကျွန်းစု", "ပုလော", "ကော့သောင်း", "ဘုတ်ပြင်း"],
            "ပဲခူးတိုင်းဒေသကြီး": ["ပဲခူး", "ဒိုက်ဦး", "ကျောက်တံခါး", "ကဝ", "ညောင်လေးပင်", "ရွှေကျင်", "သနပ်ပင်", "ဝေါ", "ပြည်", "ပန်းတောင်း", "သဲကုန်း", "ပေါက်ခေါင်း", "ပေါင်းတည်", "ရွှေတောင်", "သာယာဝတီ", "မိုးညို", "အုတ်ဖို", "လက်ပံတန်း", "မင်းလှ", "နတ်တလင်း", "ဇီးကုန်း", "ကြို့ပင်ကောက်", "တောင်ငူ", "ထန်းတပင်", "ဖြူး", "အုတ်တွင်း", "ရေတာရှည်", "ကျောက်ကြီး"],
            "မကွေးတိုင်းဒေသကြီး": ["မကွေး", "နတ်မောက်", "မြို့သစ်", "တောင်တွင်းကြီး", "ရေနံချောင်း", "ချောက်", "မင်းဘူး(စကု)", "ပွင့်ဖြူ", "ငဖဲ", "စလင်း", "စေတုတ္တရာ", "ဂန့်ဂေါ", "ထီးလင်း", "ဆော", "သရက်", "ဆင်ပေါင်ဝဲ", "မင်းတုန်း", "အောင်လံ", "မင်းလှ", "ကံမ", "ပခုက္ကူ", "ဆိပ်ဖြူ", "ပေါက်", "မြိုင်", "ရေစကြို"],
            "မန္တလေးတိုင်းဒေသကြီး": ["အောင်မြေသာဇံ", "ချမ်းအေးသာဇံ", "ချမ်းမြသာစည်", "မဟာအောင်မြေ", "ပြည်ကြီးတံခွန်", "ပုသိမ်ကြီး", "အမရပူရ", "ကျောက်ဆည်", "မြစ်သား", "စဉ့်ကိုင်", "တံတားဦး", "မိတ္ထီလာ", "မလှိုင်", "သာစည်", "ဝမ်းတွင်း", "မြင်းခြံ", "နွားထိုးကြီး", "ငါန်းဇွန်", "တောင်သာ", "ညောင်ဦး", "ကျောက်ပန်းတောင်း", "ပြင်ဦးလွင်", "မိုးကုတ်", "စဉ့်ကူး", "သပိတ်ကျင်း", "မတ္တရာ", "ရမည်းသင်း", "ပျော်ဘွယ်"],
            "မွန်ပြည်နယ်": ["မော်လမြိုင်", "ရေး", "ချောင်းဆုံ", "ကျိုက်မရော", "မုဒုံ", "သံဖြူဇရပ်", "သထုံ", "ဘီးလင်း", "ကျိုက်ထို", "ပေါင်"],
            "ရခိုင်ပြည်နယ်": ["စစ်တွေ", "ပေါက်တော", "ပုဏ္ဏားကျွန်း", "ရသေ့တောင်", "ကျောက်ဖြူ", "ရမ်းဗြဲ", "အမ်း", "မာန်အောင်", "မြောက်ဦး", "မြေပုံ", "မင်းပြား", "ကျောက်တော်", "သံတွဲ", "တောင်ကုတ်", "ဂွ", "မောင်တော", "ဘူးသီးတောင်"],
            "ရန်ကုန်တိုင်းဒေသကြီး": ["တာမွေ", "တောင်ဥက္ကလာပ", "ဒဂုံမြို့သစ်(ဆိပ်ကမ်း)", "ဒဂုံမြို့သစ်(တောင်ပိုင်း)", "ဒဂုံမြို့သစ်(မြောက်ပိုင်း)", "ဒဂုံမြို့သစ်(အရှေ့ပိုင်း)", "ဒေါပုံ", "ပုဇွန်တောင်", "ဗိုလ်တထောင်", "မြောက်ဥက္ကလာပ", "ရန်ကင်း", "သင်္ဃန်းကျွန်း", "သာကေတ", "မင်္ဂလာတောင်ညွန့်", "တိုက်ကြီး", "ထန်းတပင်", "မင်္ဂလာဒုံ", "မှော်ဘီ", "ရွှေပြည်သာ", "လှည်းကူး", "လှိုင်သာယာ", "အင်းစိန်", "ကျောက်တန်း", "ကွမ်းခြံကုန်း", "ကိုကိုးကျွန်း", "ကော့မှူး", "ခရမ်း", "ဆိပ်ကြီးခနောင်တို", "တွံတေး", "ဒလ", "သန်လျင်", "သုံးခွ", "ကမာရွတ်", "ကျောက်တံတား", "ကြည့်မြင်တိုင်", "စမ်းချောင်း", "ဆိပ်ကမ်း", "ဒဂုံ", "ဗဟန်း", "မရမ်းကုန်း", "လမ်းမတော်", "လသာ", "လှိုင်", "အလုံ", "ပန်းဘဲတန်း"],
            "ရှမ်းပြည်နယ်": ["တောင်ကြီး", "ဆီဆိုင်", "ကလော", "ရပ်စောက်", "ညောင်ရွှေ", "ပင်းတယ", "ပင်လောင်း", "ရွာငံ", "ဖယ်ခုံ", "ဟိုပုံး", "ကျိုင်းတုံ", "မိုင်းခတ်", "မိုင်းယန်း", "မိုင်းပျဉ်း", "တာချီလိတ်", "မိုင်းဖြတ်", "မိုင်းယောင်း", "မက်မန်း", "မိုးမိတ်", "မဘိမ်း", "မိုင်းဆတ်", "မိုင်းတုံ", "မူဆယ်", "ကွတ်ခိုင်", "နမ့်ခမ်း", "လင်းခေး", "မိုးနဲ", "မိုင်းပန်", "မောက်မယ်", "လွိုင်လင်", "ကွန်ဟိန်း", "လဲချား", "မိုင်းကိုင်", "မိုင်းရှူး", "ကျေးသီး", "နမ့်စန", "လားရှိုး", "သိန္နီ", "ကွမ်းလုံ", "မိုင်းရယ်", "တန့်ယန်း", "ကျောက်မဲ", "သီပေါ", "မန်တုံ", "နမ့်ဆန", "နမ္မတူ", "နောင်ချို", "လောက်ကိုင်", "ကုန်းကြမ်း", "ဟိုပန်"],
            "ဧရာဝတီတိုင်းဒေသကြီး": ["ပုသိမ်", "ကန်ကြီးထောင့်", "ကျုံပျော်", "ငပုတော", "သာပေါင်း", "ကျောင်းကုန်း", "ရေကြည်", "မအူပင်", "ဓနုဖြူ", "ပန်းတနော်", "ညောင်တုန်း", "ဟင်္သာတ", "ဇလွန်", "ကြံခင်း", "မြန်အောင်", "အင်္ဂပူ", "လေးမျက်နှာ", "မြောင်းမြ", "ဝါးခယ်မ", "အိမ်မဲ", "ဖျာပုံ", "ဘိုကလေး", "ဒေးဒရဲ", "ကျိုက်လတ်", "လပွတ္တာ", "မော်လမြိုင်ကျွန်း"],
            "နေပြည်တော် ပြည်ထောင်စုနယ်မြေ": ["ဒက္ခိဏသီရိ", "လယ်ဝေး", "ပျဉ်းမနား", "ဇမ္ဗူသီရိ", "ဥတ္တရသီရိ", "ပုဗ္ဗသီရိ", "တပ်ကုန်း", "ဇေယျာသီရိ"]
        };
        const stateRegionSelect = document.getElementById('state_region');
        const townshipSelect = document.getElementById('township');
        const birthplaceHiddenInput = document.getElementById('student_birthplace');

        function populateStates() {
            if (!stateRegionSelect) return;
            const states = Object.keys(locationData);
            states.forEach(state => {
                const option = document.createElement('option');
                option.value = state;
                option.textContent = state;
                stateRegionSelect.appendChild(option);
            });
        }

        function updateHiddenBirthplace() {
            if (!stateRegionSelect || !townshipSelect || !birthplaceHiddenInput) return;
            const state = stateRegionSelect.value;
            const township = townshipSelect.value;
            if (state && township) {
                birthplaceHiddenInput.value = `${state}, ${township}`;
            } else {
                birthplaceHiddenInput.value = '';
            }
        }

        function updateTownships() {
            if (!stateRegionSelect || !townshipSelect) return;
            const selectedState = stateRegionSelect.value;
            townshipSelect.innerHTML = '<option value="" disabled selected>မြို့နယ်</option>';
            if (selectedState && locationData[selectedState]) {
                const townships = locationData[selectedState];
                townships.forEach(township => {
                    const option = document.createElement('option');
                    option.value = township;
                    option.textContent = township;
                    townshipSelect.appendChild(option);
                });
                townshipSelect.disabled = false;
            } else {
                townshipSelect.disabled = true;
            }
            updateHiddenBirthplace();
        }

        if (stateRegionSelect) stateRegionSelect.addEventListener('change', updateTownships);
        if (townshipSelect) townshipSelect.addEventListener('change', updateHiddenBirthplace);

        populateStates();
        if (previouslySelectedState) stateRegionSelect.value = previouslySelectedState;
        updateTownships();
        if (previouslySelectedTownship) townshipSelect.value = previouslySelectedTownship;
        updateHiddenBirthplace();


        // --- NRC Input Group Logic ---
        const nrcTownships = {
            1: ["အဂယ", "အတန", "ဗကန", "ဗမန", "ဒဖယ", "ဟပန", "ဆဒန", "ဆပဘ", "ကမန", "ကမတ", "ကပတ", "ခဘဒ", "ခလဖ", "ခဖန", "လဂန", "မဂဒ", "မကန","မကတ", "မကသ", "မခဘ", "မလန", "မမန", "မညန", "မစန","မတန","နမန","ပမန","ပနဒ","ပတအ","ပဝန","ဖကန","ရဗယ", "ဆဘန", "ဆဘတ", "စကန", "ဆလန", "စပဘ", "တနန","ဝမန","သဝတ","ဝမန","ရကန"],
            2: ["ဘလခ", "ဒမဆ", "ဖဆန", "ထတပ","ခစန", "လကန", "မစန", "ဖလဆ", "ဖရဆ", "ရသန","စစန","ရတန"],
            3: ["ဘအန", "ဘဂလ", "ဘသဆ", "ကဒန", "ကကရ", "ကမမ","ကဆက", "ကတခ", "လဘန", "လသန","မဆလ", "မဝတ", "ပကန", "ဖအန", "ဖပန", "စကလ","သတက","သတန","ဝလမ","ရရသ"],
            4: ["ဟခန", "ဖလန", "ဆမန", "ထတလ", "ကခန", "ကပလ","မတန", "မတပ", "ပလဝ", "ရခဒ","ရဇန", "တတန", "တဇန"],
            5: ["အထန", "အမဇ", "အတန", "အရတ", "ဗမန", "ဘတလ", "ဒဟန", "ဓကန", "ဒပယ", "ဟမလ", "ထခန", "ထပခ", "ကဘလ", "ကလထ","ကလန", "ကလတ", "ကလသ", "ကလဝ", "ကနန", "ကဆလ", "ကသန", "ခဥန", "ခပန", "ခတန", "ခဥတ","လဟန", "လရန", "မကန", "မလန", "မမန", "မမတ","မပလ", "မသန", "မရန", "နယန", "ငစန", "ငဇန", "ပလဘ", "ပလန", "ပဆန", "ဖပန","စကန", "ဆလက", "ဆမရ", "တဥန", "တမန", "တဆန","ဝလန", "ဝသန", "ရဥန", "ရဘန", "ယမပ"],
            6: ["အမရ", "ဘပန", "ဟသတ", "ထဝန", "ကလအ", "ကပန", "ကစန", "ကသမ", "ကသန", "ကရရ", "ခမက","လလန", "မအန", "မအရ", "မမလ", "မမန","မတန", "ပကမ", "ပလန", "ပလတ", "တသရ", "သရခ", "ရဖန"],
            7: ["အဖန", "အတန", "ဘသရ", "ဒဥန", "ထတပ", "ကကန", "ကပက", "ကတခ","ကဝန", "လပတ", "မလန", "မညန", "မဝတ", "နတလ", "ညလပ", "ပခန","ပခတ", "ပမန", "ပစတ", "ပတန", "ပတတ", "ဖမန", "တငန", "သကန","သနပ","သဝတ","ဝမန","ရကန","ရတန","ရတရ","ဇကန"],
            8: ["အလန", "ဘကလ", "ဂဂန", "ဆမန", "ထလန", "ကထန", "ကမန", "ခမန","မဘန", "မဂဒ", "မထလ", "မထန", "မကန", "မလန", "မမန", "မတန", "မသန", "မရဆ", "နမန", "ငဖန", "ပခက", "ပမန" , "ပဖန", "စလန","ဆပဝ","ဆဖန", "စတရ", "တတက", "သရန", "ရနခ", "ရစက"],
            9: ["အခန", "အမဘ", "အမရ", "အမဇ", "အစန", "အရတ", "ဥတသ", "ဒခသ", "ကမန", "ကပတ", "ကဆန", "ခအဇ", "ခမခ","ခမမ", "ခမန", "ခမစ", "ခမသ", "ခမဇ", "လကန", "လဝန", "မဟမ", "မထလ", "မကခ", "မကန","မခန", "မလန", "မမန", "မနမ", "မနတ", "မစန","မတလ", "မတန", "မတရ", "မသန", "မရမ", "မရတ", "နထက", "နမန", "နနမ", "နတက", "ငသရ","ငဇန", "ညဉန", "ပဥလ", "ပဘန", "ပဗသ", "ပကခ","ပခက", "ပခမ", "ပမန", "ပသက", "စကန", "စကတ", "တကတ" , "တတဥ", "တသန", "သပက", "သစန", "သတရ", "သဝန", "ဝတန", "ရဥန","ရမသ","ဇဗသ","ဇယသ"],
            10: ["ဘအန", "ဘလန", "ထထန", "ကထန", "ကမလ", "ကမရ", "ခဆန", "ခဇန", "လမန", "မဒန", "မလမ","မစန", "ပမန", "ဖပန", "သထန", "သဖရ", "ရမန"],
            11: ["အမန", "ဘသတ", "ဂမန", "ကဖန", "ကတလ", "ကတန", "လမတ", "မအတ","မအန", "မဥန", "မမန", "မပန", "မပတ", "မတန", "ပဏက", "ပတန", "စတန", "တကန", "တပဝ", "သတန", "ရဗန", "ရတန" , "ရတသ", "ရသတ"],
            12: ["အလန", "အစန", "ဥကမ", "ဥကတ", "ဗဟန", "ဗတထ", "ဒဂမ", "ဒဂန", "ဒဂဆ", "ဒဂရ", "ဒလန", "ဒပန", "ထတပ", "ကကက", "ကခက", "ကမန", "ကမတ", "ကမရ", "ကတန", "ကတတ", "ခရန", "လကန" , "လမန", "လမတ", "လသန", "လသယ", "လယန", "လယရ", "မဥက", "မဘန","မဂဒ", "မဂတ", "မရက", "ပဘတ", "ပဇတ", "ဆကခ", "စခန", "တဥက", "တကန", "တမန", "တတန", "တတတ", "သဃက", "သကတ", "သခန", "သလန","ရကန","ရပသ"],
            13: ["အပန", "အသရ", "အတန", "ဟမန", "ဟပန", "ဟပတ", "ကဟန", "ကကန", "ကခန", "ကလဒ", "ကလထ", "ကလန", "ကလတ", "ကမန", "ကတလ", "ကတန", "ကတတ", "ကသန", "ခလန", "ခရဟ", "လကန", "လခန", "လခတ", "လလန" ,"လရန", "မဘန", "မဟရ", "မထထ", "မကထ", "မကန", "မကတ", "မခန", "မခတ", "မလန", "မလတ", "မမထ", "မမန", "မနန", "မနတ", "မငန", "မပထ", "မပန", "မပတ", "မဖန", "မဖတ", "မရန", "မရတ", "မဆန", "မဆတ", "မတန", "မတတ", "မယထ", "မယန", "မယတ", "နခန", "နခတ" ,"နမတ", "နဖန", "နစန", "နတန", "နတရ", "ညရန" , "ပဆတ", "ပလထ", "ပလန", "ပလတ", "ပပက", "ပဆန", "ပဝန", "ပယန", "ဖခန", "ဆဆန", "တကန" ,"တခလ", "တလန", "တမည", "တတန", "တယန", "သနန",  "သပန", "ဝကန","ရငန","ရညန" ,"ရစန"],
            14: ["အမတ", "အဂပ", "အမန", "အပန", "အစန", "ဘကလ", "ဒဒရ", "ဓနဖ", "ဟကက", "ဟသတ", "ကကထ", "ကကန", "ကခန", "ကလန" , "ကမန", "ကမသ", "ကပန", "လမန", "လပတ", "မအန", "မအပ", "မမက", "မမန", "မရက", "ငပတ", "ငဆန", "ငသခ" , "ငရက", "ညတန", "ပကခ", "မပလ", "ပတန", "ပသန", "ပသရ", "ဖပန", "တမန", "သပန" ,"ဝခမ", "ရကန", "ရသယ", "ဇလန"]
        };
        const nrcTypes = ["နိုင်", "ဧည့်", "ပြု", "သာ", "ယာယီ"];

        // Myanmar numerals mapping for NRC states - Updated to use Myanmar digits
        const myanmarNumerals = {
            1: '၁',
            2: '၂', 
            3: '၃',
            4: '၄',
            5: '၅',
            6: '၆',
            7: '၇',
            8: '၈',
            9: '၉',
            10: '၁၀',
            11: '၁၁',
            12: '၁၂',
            13: '၁၃',
            14: '၁၄'
        };

        // Function to create NRC input group with enhanced validation
        function createNrcInputGroup(containerId, namePrefix, defaults) {
            const container = document.getElementById(containerId);
            if (!container) return;

            container.innerHTML = ''; // Clear previous content

            const wrapper = document.createElement('div');
            wrapper.className = 'flex flex-col';

            const dropdownContainer = document.createElement('div');
            dropdownContainer.className = 'grid grid-cols-3 gap-2';

            const stateSelect = document.createElement('select');
            stateSelect.name = `${namePrefix}_state`;
            stateSelect.className = 'nrc-select border rounded p-1';
            
            // Populate state dropdown with Myanmar numerals
            for (let i = 1; i <= 14; i++) {
                const option = document.createElement('option');
                option.value = myanmarNumerals[i]; // Store Myanmar digit as value
                option.textContent = myanmarNumerals[i];
                stateSelect.appendChild(option);
            }

            const townshipSelect = document.createElement('select');
            townshipSelect.name = `${namePrefix}_township`;
            townshipSelect.className = 'nrc-select border rounded p-1';

            const typeSelect = document.createElement('select');
            typeSelect.name = `${namePrefix}_type`;
            typeSelect.className = 'nrc-select border rounded p-1';
            nrcTypes.forEach(type => {
                const option = document.createElement('option');
                option.value = `(${type})`;
                option.textContent = `(${type})`;
                typeSelect.appendChild(option);
            });

            dropdownContainer.append(stateSelect, townshipSelect, typeSelect);

            const numberInput = document.createElement('input');
            numberInput.type = 'text';
            numberInput.name = `${namePrefix}_number`;
            numberInput.className = 'nrc-number w-full border rounded p-1 mt-1';
            numberInput.placeholder = '၁၂၃၄၅၆';
            numberInput.maxLength = 6;

            // Add event listener for automatic digit conversion
            numberInput.addEventListener('input', function(e) {
                // Convert any English digits to Myanmar digits
                const convertedValue = convertToMyanmarDigits(e.target.value);
                
                // Only update if conversion actually happened
                if (convertedValue !== e.target.value) {
                    e.target.value = convertedValue;
                }
                
                // Validate the number (after conversion)
                const currentValue = e.target.value;
                const isValid = isValidNrcNumber(currentValue);
                
                // Visual feedback
                if (currentValue && !isValid) {
                    numberInput.classList.add('border-red-500');
                } else {
                    numberInput.classList.remove('border-red-500');
                }
                
                updateHiddenNrcInput();
            });

            // Also validate on blur
            numberInput.addEventListener('blur', function(e) {
                const currentValue = e.target.value;
                const isValid = isValidNrcNumber(currentValue);
                
                if (currentValue && !isValid) {
                    numberInput.classList.add('border-red-500');
                    showNrcNumberError(containerId, 'NRC number must be exactly 6 digits');
                } else {
                    numberInput.classList.remove('border-red-500');
                    clearNrcNumberError(containerId);
                }
            });

            wrapper.append(dropdownContainer, numberInput);
            container.append(wrapper);

            const updateHiddenNrcInput = () => {
                const hiddenInput = document.getElementById(`${namePrefix}_hidden`);
                if (hiddenInput) {
                    const state = stateSelect.value; // This is now Myanmar digit
                    const township = townshipSelect.value;
                    const type = typeSelect.value;
                    const number = numberInput.value;
                    
                    // Validate number before setting hidden value
                    if (state && township && type && isValidNrcNumber(number)) {
                        // Store in Myanmar digits format - state is already Myanmar digit
                        hiddenInput.value = `${state}/${township}${type}${number}`;
                    } else {
                        hiddenInput.value = '';
                    }
                }
            };

            const updateNrcTownships = () => {
                const selectedState = stateSelect.value;
                
                // Convert Myanmar state back to English for township lookup
                const englishState = convertToEnglishDigits(selectedState);
                const townships = nrcTownships[englishState] || [];
                
                townshipSelect.innerHTML = '';
                townships.forEach(township => {
                    const option = document.createElement('option');
                    option.value = township;
                    option.textContent = township;
                    townshipSelect.appendChild(option);
                });

                // Repopulate township if default value exists
                if (defaults.township) {
                    // Convert default state to Myanmar for comparison
                    const defaultStateMyanmar = convertToMyanmarDigits(defaults.state);
                    if (stateSelect.value == defaultStateMyanmar) {
                        townshipSelect.value = defaults.township;
                    }
                }

                updateHiddenNrcInput();
            };

            // Set default values - ensure both state and number are in Myanmar digits
            if(defaults.state) {
                stateSelect.value = convertToMyanmarDigits(defaults.state);
            }
            if(defaults.type) typeSelect.value = defaults.type;
            if(defaults.number) {
                // Convert default number to Myanmar digits if it's in English
                numberInput.value = convertToMyanmarDigits(defaults.number);
            }

            stateSelect.addEventListener('change', updateNrcTownships);
            townshipSelect.addEventListener('change', updateHiddenNrcInput);
            typeSelect.addEventListener('change', updateHiddenNrcInput);

            // Initial population of townships
            updateNrcTownships();
        }

        // Helper functions for showing/hiding NRC number errors
        function showNrcNumberError(containerId, message) {
            let errorElement = document.getElementById(`${containerId}_error`);
            if (!errorElement) {
                errorElement = document.createElement('p');
                errorElement.id = `${containerId}_error`;
                errorElement.className = 'error-message mt-1';
                document.getElementById(containerId).appendChild(errorElement);
            }
            errorElement.textContent = message;
        }

        function clearNrcNumberError(containerId) {
            const errorElement = document.getElementById(`${containerId}_error`);
            if (errorElement) {
                errorElement.remove();
            }
        }

        createNrcInputGroup('student_nrc_group', 'student_nrc', repopulateNrcData.student);
        createNrcInputGroup('father_nrc_group', 'father_nrc', repopulateNrcData.father);
        createNrcInputGroup('mother_nrc_group', 'mother_nrc', repopulateNrcData.mother);
        
        // --- NRC Applying Logic ---
        function setupNrcApplyingLogic(prefix) {
            const checkbox = document.getElementById(`${prefix}_nrc_applying`);
            const nrcGroup = document.getElementById(`${prefix}_nrc_group`);
            const hiddenInput = document.getElementById(`${prefix}_nrc_hidden`);
            if (!checkbox || !nrcGroup || !hiddenInput) return;

            const nrcInputs = nrcGroup.querySelectorAll('select, input');

            const toggleNrcFields = (isApplying) => {
                nrcInputs.forEach(input => {
                    input.disabled = isApplying;
                });

                if (isApplying) {
                    hiddenInput.value = 'လျှောက်ထားဆဲ';
                } else {
                    // When unchecking, trigger an input event on the number field
                    // to force the hidden field's value to be recalculated by its existing listener.
                    const numberInput = nrcGroup.querySelector(`input[name="${prefix}_nrc_number"]`);
                    if (numberInput) {
                        numberInput.dispatchEvent(new Event('input', { 'bubbles': true }));
                    } else {
                        hiddenInput.value = ''; // fallback
                    }
                }
            };

            checkbox.addEventListener('change', function() {
                toggleNrcFields(this.checked);
            });

            // Initial state on page load based on session data
            if (hiddenInput.value === 'လျှောက်ထားဆဲ') {
                checkbox.checked = true;
                toggleNrcFields(true);
            }
        }
        
        setupNrcApplyingLogic('student');
        setupNrcApplyingLogic('father');
        setupNrcApplyingLogic('mother');


        // --- Deceased Parent Logic ---
        const fatherDeceasedInput = document.getElementById('father_deceased_year');
        const motherDeceasedInput = document.getElementById('mother_deceased_year');

        function toggleParentFields(prefix, isDeceased) {
            // Select only the fields that should be disabled if a parent is deceased.
            const fieldsToDisable = document.querySelectorAll(`.${prefix}-field.disable-on-deceased`);

            fieldsToDisable.forEach(field => {
                field.disabled = isDeceased;
                if (isDeceased) {
                    // Clear the value only if it's deceased
                    if (field.tagName.toLowerCase() !== 'select') {
                        field.value = '';
                    }
                    field.classList.add('bg-gray-100', 'cursor-not-allowed');
                } else {
                    // Re-enable the field
                    field.classList.remove('bg-gray-100', 'cursor-not-allowed');
                }
            });
        }


        if (fatherDeceasedInput) {
            fatherDeceasedInput.addEventListener('input', (e) => {
                toggleParentFields('father', e.target.value.trim() !== '');
            });
            // Initial check on page load
            toggleParentFields('father', fatherDeceasedInput.value.trim() !== '');
        }

        if (motherDeceasedInput) {
            motherDeceasedInput.addEventListener('input', (e) => {
                toggleParentFields('mother', e.target.value.trim() !== '');
            });
            // Initial check on page load
            toggleParentFields('mother', motherDeceasedInput.value.trim() !== '');
        }

        // --- Auto-scroll to first error on page load ---
        if (firstErrorKeyFromServer) {
            let errorElement;
            
            // Use a switch for cleaner special case handling
            switch (firstErrorKeyFromServer) {
                case 'photo_upload':
                    errorElement = document.getElementById('photo-upload-area');
                    break;
                case 'student_nrc':
                case 'father_nrc':
                case 'mother_nrc':
                    const prefix = firstErrorKeyFromServer.split('_')[0]; // 'student', 'father', or 'mother'
                    errorElement = document.getElementById(`${prefix}_nrc_group`);
                    break;
                case 'student_birthplace':
                    // Target the first dropdown for birthplace
                    errorElement = document.getElementById('state_region');
                    break;
                case 'selected_major':
                    // Target the major selection dropdown
                    errorElement = document.getElementById('selected_major');
                    break;
                default:
                    // Default behavior for simple inputs
                    errorElement = document.querySelector(`[name="${firstErrorKeyFromServer}"]`);
            }

            if (errorElement) {
                // A short delay can help ensure the page is fully rendered before scrolling
                setTimeout(() => {
                    errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Try to focus the element if it's focusable
                    if (typeof errorElement.focus === 'function') {
                        errorElement.focus({ preventScroll: true }); // preventScroll avoids a second jump
                    }
                    
                    // Find a good parent container to add a temporary highlight
                    const fieldContainer = errorElement.closest('.relative.pb-5, #photo-upload-area');
                    if (fieldContainer) {
                        fieldContainer.classList.add('error-highlight');
                        setTimeout(() => {
                            fieldContainer.classList.remove('error-highlight');
                        }, 2500); // Highlight lasts for 2.5 seconds
                    }
                }, 100); // 100ms delay
            }
        }

    });
</script>
</body>
</html>