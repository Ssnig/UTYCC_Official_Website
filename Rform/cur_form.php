<?php
    // Start a new session or resume an existing one
    session_start();
    // Set the default timezone to Myanmar time
    date_default_timezone_set('Asia/Yangon');

    // If the user is starting a new application (e.g., by visiting cur_form.php?new=1),
    // clear any previously saved form data from the session.
    if (isset($_GET['new']) && $_GET['new'] == '1') {
        unset($_SESSION['form1_data']);
        unset($_SESSION['form2_data']);
        unset($_SESSION['form1_errors']); // Also clear any leftover errors
        // Redirect to remove the "?new=1" from the URL, so a page refresh doesn't clear the form again.
        header('Location: cur_form.php');
        exit;
    }

    // --- Academic Year Calculation ---
    $current_month = date('n');
    $current_year  = date('Y');
    // The academic year is assumed to change in June.
    if ($current_month >= 6) {
        $academic_year_value = $current_year . '-' . ($current_year + 1);
    } else {
        $academic_year_value = ($current_year - 1) . '-' . $current_year;
    }

    // --- Retrieve errors from session if they exist, then clear them ---
    $errors = $_SESSION['form1_errors'] ?? [];
    unset($_SESSION['form1_errors']);
    
    // --- Repopulate fields from session data ---
    function getValue($fieldName, $default = '')
    {
        if (isset($_SESSION['form1_data'][$fieldName])) {
            // Special handling for date to display it in d-m-Y format
            if ($fieldName === 'date') {
                try {
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
        if (! empty($nrc_string) && preg_match('/^(\d+)\/([^\(]+)(\(\S+\))(\d{6})$/', $nrc_string, $matches)) {
            $repopulate_array['state']    = $matches[1];
            $repopulate_array['township'] = $matches[2];
            $repopulate_array['type']     = $matches[3];
            $repopulate_array['number']   = $matches[4];
        }
    }

    parseNrc(getValue('student_nrc'), $repopulate_nrc['student']);
    parseNrc(getValue('father_nrc'), $repopulate_nrc['father']);
    parseNrc(getValue('mother_nrc'), $repopulate_nrc['mother']);

    // Processing form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // --- PRG Pattern Step 1: Preserve existing data and process new data ---
        
        $existing_photo_url = $_SESSION['form1_data']['photo_url'] ?? '';
        $_SESSION['form1_data'] = $_POST;
        $_SESSION['form1_data']['photo_url'] = $existing_photo_url;

        $validation_errors = [];

        // --- Handle Photo Upload ---
        $original_photo_on_load = $_SESSION['form1_data']['photo_url'] ?? '';
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
                    if (!empty($original_photo_on_load) && file_exists($original_photo_on_load)) {
                        unlink($original_photo_on_load);
                    }
                    $_SESSION['form1_data']['photo_url'] = $target_file;
                } else {
                    $validation_errors['photo_upload'] = "Sorry, there was an error uploading your file.";
                }
            }
        } elseif ($is_removal_request) {
            if (!empty($original_photo_on_load) && file_exists($original_photo_on_load)) {
                unlink($original_photo_on_load);
            }
            $_SESSION['form1_data']['photo_url'] = '';
        }

        // --- Validate Required Fields ----
        if (empty($_SESSION['form1_data']['photo_url'])) $validation_errors['photo_upload'] = "ကျေးဇူးပြု၍ ဓာတ်ပုံထည့်သွင်းပါ။";
        if (empty($_POST['academic_year'])) $validation_errors['academic_year'] = "သင်တန်းနှစ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['major'])) $validation_errors['major'] = "အထူးပြုဘာသာရပ် ရွေးချယ်ရန် လိုအပ်ပါသည်။";
        if (empty($_POST['student_email'])) $validation_errors['student_email'] = "emailထည့်ပေးပါရန်";
        if (empty($_POST['seat_no'])) $validation_errors['seat_no'] = "ခုံအမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_name_mm'])) $validation_errors['student_name_mm'] = "ကျောင်းသား/သူ၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_name_en'])) $validation_errors['student_name_en'] = "ကျောင်းသား/သူ၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_race'])) $validation_errors['student_race'] = "ကျောင်းသား/သူ၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_religion'])) $validation_errors['student_religion'] = "ကိုးကွယ်သည့်ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_nrc'])) $validation_errors['student_nrc'] = "ကျောင်းသား/သူ၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_dob'])) $validation_errors['student_dob'] = "ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_birthplace'])) $validation_errors['student_birthplace'] = "မွေးဖွားရာဇာတိထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_phone'])) $validation_errors['student_phone'] = "ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['student_address'])) $validation_errors['student_address'] = "ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        if (empty($_POST['date'])) $validation_errors['date'] = "ရက်စွဲထည့်သွင်းရန်လိုအပ်ပါသည်။";
        
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
        }

        // --- PRG Pattern Step 2: Redirect based on validation result ---
        if (empty($validation_errors)) {
            // --- Date Conversion for MySQL ---
            $date_from_form = $_SESSION['form1_data']['date'];
            $date_obj = DateTime::createFromFormat('d-m-Y', $date_from_form);
            if ($date_obj) {
                $_SESSION['form1_data']['date'] = $date_obj->format('Y-m-d') . ' ' . date('H:i:s');
            } else {
                 $_SESSION['form1_data']['date'] = date('Y-m-d H:i:s');
            }
            
            // Set major selection to be compatible with final.php (which expects form2_data)
            $_SESSION['form2_data'] = [
                'preferences' => [1 => $_POST['major']]
            ];

            // No errors, proceed to option.php, skipping form2
            header("location: option.php");
            exit;
        } else {
            $_SESSION['form1_errors'] = $validation_errors;
            header("Location: cur_form.php");
            exit;
        }
    }
?>

<?php include 'formPartial/header.php'; ?>
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
    input[type="email"],
    select,
    textarea {
        transition: all 0.3s ease-in-out;
        border-color: #cbd5e1;
        width: 100%;
        padding: 0.5rem;
        border-radius: 0.375rem;
        border-width: 1px;
    }
    input:focus, select:focus, textarea:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4) !important;
        outline: none;
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
</style>
    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
        <div class="max-w-4xl mx-auto bg-white p-3 py-3 sm:p-6 md:p-8 form-container">

            <!-- Form Header -->
            <div class="text-center mb-8">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold form-title">ကျောင်းသားအဖြစ်မှ မှတ်ပုံတင်ခွင့်တောင်းခံလွှာ (ကျောင်းသားဟောင်း)</h1>
                <h2 class="text-md sm:text-lg md:text-xl font-semibold form-subtitle mt-2">
                    နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)</h2>
            </div>

            <!-- Top Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div class="relative pb-5">
                    <label for="academic_year" class="block text-sm font-medium text-gray-700">သင်တန်းနှစ်</label>
                    <select id="academic_year" name="academic_year" class="mt-1">
                        <option value="" disabled <?php echo (getValue('academic_year') == '') ? 'selected' : ''; ?>>သင်တန်းနှစ်ကို ရွေးချယ်ပါ</option>
                        <option value="Second Year" <?php echo (getValue('academic_year') == 'Second Year') ? 'selected' : ''; ?>>Second Year</option>
                        <option value="Third Year" <?php echo (getValue('academic_year') == 'Third Year') ? 'selected' : ''; ?>>Third Year</option>
                        <option value="Fourth Year" <?php echo (getValue('academic_year') == 'Fourth Year') ? 'selected' : ''; ?>>Fourth Year</option>
                        <option value="Fifth Year" <?php echo (getValue('academic_year') == 'Fifth Year') ? 'selected' : ''; ?>>Fifth Year</option>
                        <option value="Final Year" <?php echo (getValue('academic_year') == 'Final Year') ? 'selected' : ''; ?>>Final Year</option>
                    </select>
                    <?php if (isset($errors['academic_year'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['academic_year']; ?></p><?php endif; ?>
                  </div>
                  
                  <div class="relative pb-5">
                        <label for="major" class="block text-sm font-medium text-gray-700">အထူးပြုဘာသာ</label>
                        <select id="major" name="major" class="mt-1">
                            <option value="" disabled <?php echo (getValue('major') == '') ? 'selected' : ''; ?>>အထူးပြုဘာသာ ရွေးချယ်ပါ</option>
                            <option value="IST" <?php echo (getValue('major') == 'IST') ? 'selected' : ''; ?>>Information Science Technology (IST)</option>
                            <option value="CE" <?php echo (getValue('major') == 'CE') ? 'selected' : ''; ?>>Computer Engineering (CE)</option>
                            <option value="EcE" <?php echo (getValue('major') == 'EcE') ? 'selected' : ''; ?>>Electronics Engineering (EcE)</option>
                            <option value="PrE" <?php echo (getValue('major') == 'PrE') ? 'selected' : ''; ?>>Precision Engineering (PrE)</option>
                            <option value="AME" <?php echo (getValue('major') == 'AME') ? 'selected' : ''; ?>>Advanced Materials Engineering (AME)</option>
                        </select>
                        <?php if (isset($errors['major'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['major']; ?></p><?php endif; ?>
                    </div>
                  
                    <div class="relative pb-5">
                        <label for="seat_no" class="block text-sm font-medium text-gray-700">ခုံအမှတ်</label>
                        <input type="text" placeholder="မနှစ်ကခုံနံပါတ်" id="seat_no" name="seat_no" class="mt-1" value="<?php echo getValue('seat_no'); ?>">
                        <?php if (isset($errors['seat_no'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['seat_no']; ?></p><?php endif; ?>
                    </div>
                  
                    <div class="relative pb-5">
                        <label for="entry_year" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်ဝင်ရောက်သည့်နှစ်</label>
                        <input type="text" id="entry_year" name="entry_year" class="mt-1" value="<?php echo getValue('entry_year'); ?>">
                    </div>
                </div>
                <div id="photo-upload-area" class="flex flex-col items-center justify-center border-2 border-dashed rounded-lg p-2 h-48">
                    <div id="photo-placeholder" class="text-center">
                        <span class="text-gray-500">ဓါတ်ပုံကပ်ရန်</span>
                        <button type="button" onclick="document.getElementById('photo_upload').click()" class="mt-2 block mx-auto px-3 py-1 text-sm bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200">Upload</button>
                    </div>
                    <div id="photo-preview-container" class="hidden w-full h-full relative">
                        <img id="photo-preview" src="#" alt="Photo Preview" class="w-full h-full object-contain">
                        <div id="remove-photo-btn" title="Remove Photo" class="absolute top-0 right-1 text-2xl cursor-pointer text-red-500">&times;</div>
                    </div>
                    <input type="file" class="hidden" id="photo_upload" name="photo_upload" accept="image/*">
                    <input type="hidden" name="remove_photo" id="remove_photo_flag" value="0">
                    <?php if (isset($errors['photo_upload'])): ?><p class="error-message mt-2 server-error-message"><?php echo $errors['photo_upload']; ?></p><?php endif; ?>
                </div>
            </div>

            <!-- Student Information Section -->
            <section class="section-card p-4 sm:p-6">
                <h3 class="text-lg font-semibold mb-6 section-header pb-2">
                    <span>ကျောင်းသား/သူ၏ ကိုယ်ရေးအချက်အလက်</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                    <div class="relative pb-5">
                        <label for="student_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                        <input type="text" id="student_name_mm" name="student_name_mm" class="mt-1" value="<?php echo getValue('student_name_mm'); ?>" required>
                        <?php if (isset($errors['student_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_name_mm']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                        <input type="text" id="student_name_en" name="student_name_en" class="mt-1" value="<?php echo getValue('student_name_en'); ?>" required>
                        <?php if (isset($errors['student_name_en'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_name_en']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_race" class="block text-sm font-medium text-gray-700">လူမျိုး</label>
                        <input type="text" id="student_race" name="student_race" class="mt-1" value="<?php echo getValue('student_race'); ?>" required>
                        <?php if (isset($errors['student_race'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_race']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_religion" class="block text-sm font-medium text-gray-700">ကိုးကွယ်သည့်ဘာသာ</label>
                        <input type="text" id="student_religion" name="student_religion" class="mt-1" value="<?php echo getValue('student_religion'); ?>" required>
                        <?php if (isset($errors['student_religion'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_religion']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                        <div id="student_nrc_group" class="mt-1"></div>
                        <input type="hidden" name="student_nrc" id="student_nrc_hidden" value="<?php echo getValue('student_nrc'); ?>">
                        <?php if (isset($errors['student_nrc'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_nrc']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_dob" class="block text-sm font-medium text-gray-700">မွေးသက္ကရာဇ်</label>
                        <input type="date" id="student_dob" name="student_dob" class="mt-1" value="<?php echo getValue('student_dob'); ?>" required>
                        <?php if (isset($errors['student_dob'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_dob']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_birthplace" class="block text-sm font-medium text-gray-700">မွေးဖွားရာဇာတိ</label>
                        <input type="text" id="student_birthplace" name="student_birthplace" class="mt-1" value="<?php echo getValue('student_birthplace'); ?>">
                        <?php if (isset($errors['student_birthplace'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_birthplace']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_phone" class="block text-sm font-medium text-gray-700">ဆက်သွယ်ရန်ဖုန်းနံပါတ်</label>
                        <input type="tel" id="student_phone" name="student_phone" class="mt-1" value="<?php echo getValue('student_phone'); ?>" required>
                        <?php if (isset($errors['student_phone'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_phone']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="student_email" class="block text-sm font-medium text-gray-700">E-mail</label>
                        <input type="email" id="student_email" name="student_email" class="mt-1" value="<?php echo getValue('student_email'); ?>" required>
                        <?php if (isset($errors['student_email'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_email']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5 md:col-span-2">
                        <label for="student_address" class="block text-sm font-medium text-gray-700">အမြဲတမ်း ဆက်သွယ်ရန်လိပ်စာ အပြည့်အစုံ</label>
                        <textarea id="student_address" name="student_address" rows="3" class="mt-1"><?php echo getValue('student_address'); ?></textarea>
                        <?php if (isset($errors['student_address'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_address']; ?></p><?php endif; ?>
                    </div>
                </div>
            </section>
            
            <!-- Parent Information Section -->
            <section class="section-card p-4 sm:p-6 mt-8">
                <h3 class="text-lg font-semibold mb-6 section-header pb-2">
                    <span>မိဘ၏ ကိုယ်ရေးအချက်အလက်</span>
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8">
                    <!-- Father's Column -->
                    <div class="space-y-2">
                        <h4 class="font-semibold text-gray-700 mt-2">အဘ (အရင်း)</h4>
                        <div class="relative pb-5">
                            <label for="father_deceased_year" class="block text-sm font-medium text-gray-700">ကွယ်လွန်သည့်ခုနှစ် (ကွယ်လွန်ပါက)</label>
                            <input type="text" id="father_deceased_year" name="father_deceased_year" class="mt-1 father-field" placeholder="ဥပမာ - 2010" value="<?php echo getValue('father_deceased_year'); ?>">
                        </div>
                        <div class="relative pb-5">
                            <label for="father_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                            <input type="text" id="father_name_mm" name="father_name_mm" class="mt-1 father-field" value="<?php echo getValue('father_name_mm'); ?>">
                            <?php if (isset($errors['father_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_name_mm']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="father_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                            <input type="text" id="father_name_en" name="father_name_en" class="mt-1 father-field" value="<?php echo getValue('father_name_en'); ?>">
                             <?php if (isset($errors['father_name_en'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_name_en']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="father_race" class="block text-sm font-medium text-gray-700">လူမျိုး</label>
                            <input type="text" id="father_race" name="father_race" class="mt-1 father-field" value="<?php echo getValue('father_race'); ?>">
                            <?php if (isset($errors['father_race'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_race']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="father_religion" class="block text-sm font-medium text-gray-700">ကိုးကွယ်သည့်ဘာသာ</label>
                            <input type="text" id="father_religion" name="father_religion" class="mt-1 father-field" value="<?php echo getValue('father_religion'); ?>">
                            <?php if (isset($errors['father_religion'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_religion']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                            <div id="father_nrc_group" class="mt-1 father-field-group"></div>
                            <input type="hidden" name="father_nrc" id="father_nrc_hidden" value="<?php echo getValue('father_nrc'); ?>">
                            <?php if (isset($errors['father_nrc'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_nrc']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="father_info" class="block text-sm font-medium text-gray-700">အလုပ်အကိုင်</label>
                            <textarea id="father_info" name="father_info" rows="2" class="mt-1 father-field disable-on-deceased"><?php echo getValue('father_info'); ?></textarea>
                            <?php if (isset($errors['father_info'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_info']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="father_address" class="block text-sm font-medium text-gray-700">နေရပ်လိပ်စာ</label>
                            <textarea id="father_address" name="father_address" rows="2" class="mt-1 father-field disable-on-deceased"><?php echo getValue('father_address'); ?></textarea>
                            <?php if (isset($errors['father_address'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_address']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="father_phone" class="block text-sm font-medium text-gray-700">ဖုန်းနံပါတ်</label>
                            <input type="tel" id="father_phone" name="father_phone" class="mt-1 father-field disable-on-deceased" value="<?php echo getValue('father_phone'); ?>">
                            <?php if (isset($errors['father_phone'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['father_phone']; ?></p><?php endif; ?>
                        </div>
                    </div>
                    <!-- Mother's Column -->
                    <div class="space-y-2">
                         <h4 class="font-semibold text-gray-700 mt-2">အမိ (အရင်း)</h4>
                        <div class="relative pb-5">
                            <label for="mother_deceased_year" class="block text-sm font-medium text-gray-700">ကွယ်လွန်သည့်ခုနှစ် (ကွယ်လွန်ပါက)</label>
                            <input type="text" id="mother_deceased_year" name="mother_deceased_year" class="mt-1 mother-field" placeholder="ဥပမာ - 2010" value="<?php echo getValue('mother_deceased_year'); ?>">
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                            <input type="text" id="mother_name_mm" name="mother_name_mm" class="mt-1 mother-field" value="<?php echo getValue('mother_name_mm'); ?>">
                            <?php if (isset($errors['mother_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_name_mm']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                            <input type="text" id="mother_name_en" name="mother_name_en" class="mt-1 mother-field" value="<?php echo getValue('mother_name_en'); ?>">
                             <?php if (isset($errors['mother_name_en'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_name_en']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_race" class="block text-sm font-medium text-gray-700">လူမျိုး</label>
                            <input type="text" id="mother_race" name="mother_race" class="mt-1 mother-field" value="<?php echo getValue('mother_race'); ?>">
                            <?php if (isset($errors['mother_race'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_race']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_religion" class="block text-sm font-medium text-gray-700">ကိုးကွယ်သည့်ဘာသာ</label>
                            <input type="text" id="mother_religion" name="mother_religion" class="mt-1 mother-field" value="<?php echo getValue('mother_religion'); ?>">
                            <?php if (isset($errors['mother_religion'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_religion']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                            <div id="mother_nrc_group" class="mt-1 mother-field-group"></div>
                            <input type="hidden" name="mother_nrc" id="mother_nrc_hidden" value="<?php echo getValue('mother_nrc'); ?>">
                            <?php if (isset($errors['mother_nrc'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_nrc']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_info" class="block text-sm font-medium text-gray-700">အလုပ်အကိုင်</label>
                            <textarea id="mother_info" name="mother_info" rows="2" class="mt-1 mother-field disable-on-deceased"><?php echo getValue('mother_info'); ?></textarea>
                            <?php if (isset($errors['mother_info'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_info']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_address" class="block text-sm font-medium text-gray-700">နေရပ်လိပ်စာ</label>
                            <textarea id="mother_address" name="mother_address" rows="2" class="mt-1 mother-field disable-on-deceased"><?php echo getValue('mother_address'); ?></textarea>
                            <?php if (isset($errors['mother_address'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_address']; ?></p><?php endif; ?>
                        </div>
                        <div class="relative pb-5">
                            <label for="mother_phone" class="block text-sm font-medium text-gray-700">ဖုန်းနံပါတ်</label>
                            <input type="tel" id="mother_phone" name="mother_phone" class="mt-1 mother-field disable-on-deceased" value="<?php echo getValue('mother_phone'); ?>">
                            <?php if (isset($errors['mother_phone'])): ?><p class="error-message bottom-0 left-0"><?php echo $errors['mother_phone']; ?></p><?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

             <!-- Declaration and Signature -->
            <div class="mt-8">
                <p class="text-sm text-red-600 bg-red-50 p-3 rounded-lg">ဖော်ပြပါအချက်အလက်များမှန်ကန်ကြောင်း ခံဝန်ကတိပြုပါသည်။ တစ်စုံတစ်ရာမှားယွင်းချက်ရှိပါက ကျွန်တော်/ကျွန်မ တာဝန်သာ ဖြစ်ပါသည်။</p>
                <div class="relative pb-5 mt-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">ရက်စွဲ</label>
                    <input type="text" id="date" name="date" class="mt-1" placeholder="ဥပမာ - 07-09-2025" value="<?php echo getValue('date', date('d-m-Y')); ?>" required>
                    <?php if (isset($errors['date'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['date']; ?></p><?php endif; ?>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="nav-buttons mt-8 flex justify-between items-center">
                <a href="cur_form.php?new=1" class="text-gray-600 hover:text-gray-900 font-medium">Start Over</a>
                <button type="submit" class="nav-button-next">Next Step</button>
            </div>
        </div>
    </form>
    <br>

<?php 
    include 'formPartial/footer.php';
    $first_error_key = !empty($errors) ? array_key_first($errors) : '';    
?>
<script>
    // Pass PHP values to JavaScript
    const repopulateNrcData = <?php echo json_encode($repopulate_nrc); ?>;
    const photoUrlFromServer = '<?php echo getValue('photo_url', ''); ?>';
    const firstErrorKeyFromServer = '<?php echo $first_error_key; ?>';

    document.addEventListener('DOMContentLoaded', function() {
        // --- Photo Upload Logic ---
        const photoUploadInput = document.getElementById('photo_upload');
        const photoPreview = document.getElementById('photo-preview');
        const previewContainer = document.getElementById('photo-preview-container');
        const placeholder = document.getElementById('photo-placeholder');
        const removeBtn = document.getElementById('remove-photo-btn');
        const removePhotoFlag = document.getElementById('remove_photo_flag');
        
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
            photoUploadInput.value = '';
            removePhotoFlag.value = '1';
        }

        if (photoUrlFromServer) {
            showPhotoPreview(photoUrlFromServer);
        }

        photoUploadInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                removePhotoFlag.value = '0';
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

        function createNrcInputGroup(containerId, namePrefix, defaults) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = ''; 

            const wrapper = document.createElement('div');
            wrapper.className = 'flex flex-col';

            const dropdownContainer = document.createElement('div');
            dropdownContainer.className = 'grid grid-cols-3 gap-2';

            const stateSelect = document.createElement('select');
            stateSelect.name = `${namePrefix}_state`;
            for (let i = 1; i <= 14; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                stateSelect.appendChild(option);
            }

            const townshipSelect = document.createElement('select');
            townshipSelect.name = `${namePrefix}_township`;

            const typeSelect = document.createElement('select');
            typeSelect.name = `${namePrefix}_type`;
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
            numberInput.className = 'mt-1';
            numberInput.placeholder = '123456';
            numberInput.maxLength = 6;
            numberInput.pattern = '\\d{6}';

            wrapper.append(dropdownContainer, numberInput);
            container.append(wrapper);

            const updateHiddenNrcInput = () => {
                const hiddenInput = document.getElementById(`${namePrefix}_hidden`);
                if (hiddenInput) {
                    const state = stateSelect.value;
                    const township = townshipSelect.value;
                    const type = typeSelect.value;
                    const number = numberInput.value;
                    if (state && township && type && number.match(/^\d{6}$/)) {
                        hiddenInput.value = `${state}/${township}${type}${number}`;
                    } else {
                        hiddenInput.value = '';
                    }
                }
            };

            const updateNrcTownships = () => {
                const selectedState = stateSelect.value;
                const townships = nrcTownships[selectedState] || [];
                townshipSelect.innerHTML = '';
                townships.forEach(township => {
                    const option = document.createElement('option');
                    option.value = township;
                    option.textContent = township;
                    townshipSelect.appendChild(option);
                });
                if (defaults.township && stateSelect.value == defaults.state) {
                    townshipSelect.value = defaults.township;
                }
                updateHiddenNrcInput();
            };

            if(defaults.state) stateSelect.value = defaults.state;
            if(defaults.type) typeSelect.value = defaults.type;
            if(defaults.number) numberInput.value = defaults.number;

            stateSelect.addEventListener('change', updateNrcTownships);
            townshipSelect.addEventListener('change', updateHiddenNrcInput);
            typeSelect.addEventListener('change', updateHiddenNrcInput);
            numberInput.addEventListener('input', updateHiddenNrcInput);

            updateNrcTownships();
        }

        createNrcInputGroup('student_nrc_group', 'student_nrc', repopulateNrcData.student);
        createNrcInputGroup('father_nrc_group', 'father_nrc', repopulateNrcData.father);
        createNrcInputGroup('mother_nrc_group', 'mother_nrc', repopulateNrcData.mother);
        
        // --- Deceased Parent Logic ---
        function toggleParentFields(prefix, isDeceased) {
            const fieldsToDisable = document.querySelectorAll(`.${prefix}-field.disable-on-deceased`);
            fieldsToDisable.forEach(field => {
                field.disabled = isDeceased;
                if (isDeceased) {
                    field.value = '';
                    field.classList.add('bg-gray-100');
                } else {
                    field.classList.remove('bg-gray-100');
                }
            });
        }

        const fatherDeceasedInput = document.getElementById('father_deceased_year');
        const motherDeceasedInput = document.getElementById('mother_deceased_year');

        if(fatherDeceasedInput) {
            fatherDeceasedInput.addEventListener('input', (e) => toggleParentFields('father', e.target.value.trim() !== ''));
            toggleParentFields('father', fatherDeceasedInput.value.trim() !== '');
        }
        if(motherDeceasedInput) {
            motherDeceasedInput.addEventListener('input', (e) => toggleParentFields('mother', e.target.value.trim() !== ''));
            toggleParentFields('mother', motherDeceasedInput.value.trim() !== '');
        }

        // --- Auto-scroll to first error ---
        if (firstErrorKeyFromServer) {
            const errorElement = document.querySelector(`[name="${firstErrorKeyFromServer}"]`);
            if (errorElement) {
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                errorElement.focus();
            }
        }
    });
</script>
</body>
</html>

