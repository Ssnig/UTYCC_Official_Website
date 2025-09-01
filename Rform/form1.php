<?php
    // Start a new session or resume an existing one
    session_start();

    // --- Academic Year Calculation ---
    $current_month = date('n');
    $current_year  = date('Y');
    // The academic year is assumed to change in June.
    if ($current_month >= 6) {
        $academic_year_value = $current_year . '-' . ($current_year + 1);
    } else {
        $academic_year_value = ($current_year - 1) . '-' . $current_year;
    }

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
    $errors             = [];

    // --- Repopulate fields from POST data if available, otherwise from session ---
    function getValue($fieldName, $default = '')
    {
        // Prioritize POST data first, as it's the most recent user submission.
        if (isset($_POST[$fieldName])) {
            return htmlspecialchars(trim($_POST[$fieldName]));
        }
        // If not in POST (e.g., after a refresh/GET request), check the session data from a previous submission.
        if (isset($_SESSION['form1_data'][$fieldName])) {
            return htmlspecialchars(trim($_SESSION['form1_data'][$fieldName]));
        }
        // If in neither, return the default value.
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

        // --- Handle Photo Upload ---
        $original_photo_on_load = $_POST['original_photo_url'] ?? '';
        $is_new_upload_attempt = isset($_FILES["photo_upload"]) && $_FILES["photo_upload"]["error"] != UPLOAD_ERR_NO_FILE;
        $is_removal_request = !empty($_POST['remove_photo']) && $_POST['remove_photo'] == '1';

        if ($is_new_upload_attempt && $_FILES["photo_upload"]["error"] == UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $imageFileType = strtolower(pathinfo($_FILES["photo_upload"]["name"], PATHINFO_EXTENSION));
            $unique_name = uniqid('photo_', true) . '.' . $imageFileType;
            $target_file = $target_dir . $unique_name;
            $uploadOk = 1;

            $check = getimagesize($_FILES["photo_upload"]["tmp_name"]);
            if ($check === false) {
                $errors['photo_upload'] = "File is not an image.";
                $uploadOk = 0;
            }
            if ($_FILES["photo_upload"]["size"] > 5000000) {
                $errors['photo_upload'] = "Sorry, your file is too large (Max 5MB).";
                $uploadOk = 0;
            }
            if (!in_array($imageFileType, ["jpg", "png", "jpeg"])) {
                $errors['photo_upload'] = "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["photo_upload"]["tmp_name"], $target_file)) {
                    if (!empty($original_photo_on_load) && file_exists($original_photo_on_load)) {
                        unlink($original_photo_on_load);
                    }
                    $_POST['photo_url'] = $target_file;
                } else {
                    $errors['photo_upload'] = "Sorry, there was an error uploading your file.";
                    $_POST['photo_url'] = $original_photo_on_load;
                }
            } else {
                $_POST['photo_url'] = $original_photo_on_load;
            }
        } elseif ($is_removal_request) {
            if (!empty($original_photo_on_load) && file_exists($original_photo_on_load)) {
                unlink($original_photo_on_load);
            }
            $_POST['photo_url'] = '';
        }


        $sanitized_post = [];
        foreach ($_POST as $key => $value) {
            $sanitized_post[$key] = htmlspecialchars(trim($value));
        }

        // --- Assign sanitized values to variables ---
        $year               = $sanitized_post["year"] ?? '';
        $academic_year      = $sanitized_post["academic_year"] ?? '';
        $student_email      = $sanitized_post["student_email"] ?? '';
        $seat_no            = $sanitized_post["seat_no"] ?? '';
        $entry_year         = $sanitized_post["entry_year"] ?? '';
        $student_name_mm    = $sanitized_post["student_name_mm"] ?? '';
        $father_name_mm     = $sanitized_post["father_name_mm"] ?? '';
        $mother_name_mm     = $sanitized_post["mother_name_mm"] ?? '';
        $student_name_en    = $sanitized_post["student_name_en"] ?? '';
        $father_name_en     = $sanitized_post["father_name_en"] ?? '';
        $mother_name_en     = $sanitized_post["mother_name_en"] ?? '';
        $student_race       = $sanitized_post["student_race"] ?? '';
        $father_race        = $sanitized_post["father_race"] ?? '';
        $mother_race        = $sanitized_post["mother_race"] ?? '';
        $student_religion   = $sanitized_post["student_religion"] ?? '';
        $father_religion    = $sanitized_post["father_religion"] ?? '';
        $mother_religion    = $sanitized_post["mother_religion"] ?? '';
        $student_nrc        = $sanitized_post["student_nrc"] ?? '';
        $father_nrc         = $sanitized_post["father_nrc"] ?? '';
        $mother_nrc         = $sanitized_post["mother_nrc"] ?? '';
        $student_dob        = $sanitized_post["student_dob"] ?? '';
        $student_birthplace = $sanitized_post["student_birthplace"] ?? '';
        $state_region       = $sanitized_post["state_region"] ?? '';
        $township           = $sanitized_post["township"] ?? '';
        $student_phone      = $sanitized_post["student_phone"] ?? '';
        $father_phone       = $sanitized_post["father_phone"] ?? '';
        $mother_phone       = $sanitized_post["mother_phone"] ?? '';
        $father_info        = $sanitized_post["father_info"] ?? '';
        $mother_info        = $sanitized_post["mother_info"] ?? '';
        $father_deceased_year = $sanitized_post["father_deceased_year"] ?? '';
        $mother_deceased_year = $sanitized_post["mother_deceased_year"] ?? '';
        $student_address    = $sanitized_post["student_address"] ?? '';
        $father_address     = $sanitized_post["father_address"] ?? '';
        $mother_address     = $sanitized_post["mother_address"] ?? '';
        $date               = $sanitized_post["date"] ?? date('d-m-Y');
        $photo_url          = $sanitized_post["photo_url"] ?? '';

        // --- Validate Required Fields ----
        if (empty($photo_url)) {
            $errors['photo_upload'] = "ကျေးဇူးပြု၍ ဓာတ်ပုံထည့်သွင်းပါ။";
        }

        if (empty($academic_year)) {
            $errors['academic_year'] = "သင်တန်းနှစ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_email)) {
            $errors['student_email'] = "emailထည့်ပေးပါရန်";
        }

        if (empty($seat_no)) {
            $errors['seat_no'] = "ခုံအမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_name_mm)) {
            $errors['student_name_mm'] = "ကျောင်းသား/သူ၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_name_en)) {
            $errors['student_name_en'] = "ကျောင်းသား/သူ၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_race)) {
            $errors['student_race'] = "ကျောင်းသား/သူ၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_religion)) {
            $errors['student_religion'] = "ကိုးကွယ်သည့်ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_nrc)) {
            $errors['student_nrc'] = "ကျောင်းသား/သူ၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_dob)) {
            $errors['student_dob'] = "ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_birthplace)) {
            $errors['student_birthplace'] = "မွေးဖွားရာဇာတိထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_phone)) {
            $errors['student_phone'] = "ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_address)) {
            $errors['student_address'] = "ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($date)) {
            $errors['date'] = "ရက်စွဲထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        // --- Conditional Parent Validation ---
        if (empty($father_deceased_year)) {
            if (empty($father_name_mm)) {
                $errors['father_name_mm'] = "အဘ(အရင်း)၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_name_en)) {
                $errors['father_name_en'] = "အဘ(အရင်း)၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_religion)) {
                $errors['father_religion'] = "အဘ(အရင်း)၏ ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_race)) {
                $errors['father_race'] = "အဘ(အရင်း)၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_info)) {
                $errors['father_info'] = "အဘ(အရင်း)၏ အလုပ်အကိုင်/ပညာအရည်အချင်း ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_nrc)) {
                $errors['father_nrc'] = "အဘ(အရင်း)၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_address)) {
                $errors['father_address'] = "အဘ(အရင်း)၏ ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($father_phone)) {
                $errors['father_phone'] = "အဘ(အရင်း)၏ ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
        }
        if (empty($mother_deceased_year)) {
            if (empty($mother_name_mm)) {
                $errors['mother_name_mm'] = "အမိ(အရင်း)၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_name_en)) {
                $errors['mother_name_en'] = "အမိ(အရင်း)၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_religion)) {
                $errors['mother_religion'] = "အမိ(အရင်း)၏ ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_race)) {
                $errors['mother_race'] = "အမိ(အရင်း)၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_info)) {
                $errors['mother_info'] = "အမိ(အရင်း)၏ အလုပ်အကိုင်/ပညာအရည်အချင်း ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_nrc)) {
                $errors['mother_nrc'] = "အမိ(အရင်း)၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် အပြည့်အစုံထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_address)) {
                $errors['mother_address'] = "အမိ(အရင်း)၏ ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
            if (empty($mother_phone)) {
                $errors['mother_phone'] = "အမိ(အရင်း)၏ ဖုန်းနံပါတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
            }
        }

        $_SESSION['form1_data'] = $_POST;

        if (empty($errors)) {
            header("location: form2.php");
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
                        <input type="text" placeholder="ဉပမာ-ပထမနှစ်" id="academic_year" name="academic_year" class="mt-1" value="<?php echo getValue('academic_year'); ?>">
                        <?php if (isset($errors['academic_year'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['academic_year']; ?></p><?php endif; ?>
                    </div>
                    <div class="relative pb-5">
                        <label for="major" class="block text-sm font-medium text-gray-700">ခုံအမှတ်</label>
                        <input type="text" placeholder="တက္ကသိုလ်ဝင်တန်း ခုံအမှတ်" id="seat_no" name="seat_no" class="mt-1" value="<?php echo getValue('seat_no'); ?>">
                        <?php if (isset($errors['seat_no'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['seat_no']; ?></p><?php endif; ?>
                    </div>
                  
                    <div class="sm:col-span-2">
                        <label for="entry_year" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်ဝင်ရောက်သည့်နှစ်</label>
                        <input type="text" id="entry_year" name="entry_year" class="mt-1" value="<?php echo getValue('entry_year'); ?>">
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
                    <input type="hidden" name="original_photo_url" value="<?php echo getValue('photo_url'); ?>">
                    <input type="hidden" name="photo_url" id="photo_url_hidden" value="<?php echo getValue('photo_url'); ?>">
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
                            <input type="text" id="student_name_mm" name="student_name_mm" class="mt-1" value="<?php echo getValue('student_name_mm'); ?>" required>
                            <?php if (isset($errors['student_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['student_name_mm']; ?></p><?php endif; ?>
                        </div>
                        <!-- Name EN -->
                        <div class="relative pb-5">
                            <label for="student_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                            <input type="text" id="student_name_en" name="student_name_en" class="mt-1" value="<?php echo getValue('student_name_en'); ?>" required>
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
                            <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
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
                                <input type="text" id="father_name_mm" name="father_name_mm" class="mt-1 father-field" value="<?php echo getValue('father_name_mm'); ?>" required>
                                <?php if (isset($errors['father_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['father_name_mm']; ?></p><?php endif; ?>
                            </div>
                            <!-- Father Name EN -->
                            <div class="relative pb-5">
                                <label for="father_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                                <input type="text" id="father_name_en" name="father_name_en" class="mt-1 father-field" value="<?php echo getValue('father_name_en'); ?>" required>
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
                                <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
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
                                <input type="text" id="mother_name_mm" name="mother_name_mm" class="mt-1 mother-field" value="<?php echo getValue('mother_name_mm'); ?>" required>
                                <?php if (isset($errors['mother_name_mm'])): ?><p class="error-message absolute bottom-0 left-0"><?php echo $errors['mother_name_mm']; ?></p><?php endif; ?>
                            </div>
                            <!-- Mother Name EN -->
                            <div class="relative pb-5">
                                <label for="mother_name_en" class="block text-sm font-medium text-gray-700">အမည် (အင်္ဂလိပ်စာဖြင့်)</label>
                                <input type="text" id="mother_name_en" name="mother_name_en" class="mt-1 mother-field" value="<?php echo getValue('mother_name_en'); ?>" required>
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
                                <label class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
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
                <a href="#" class="nav-button-back text-gray-600 hover:text-gray-900 font-medium">Back</a>
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
    ?>

<script>
    // Pass PHP values to JavaScript
    const previouslySelectedState = '<?php echo $repopulate_state; ?>';
    const previouslySelectedTownship = '<?php echo $repopulate_township; ?>';
    const repopulateNrcData =                                           <?php echo json_encode($repopulate_nrc); ?>;
    const photoUrlFromServer = '<?php echo getValue('photo_url', ''); ?>';


    document.addEventListener('DOMContentLoaded', function() {
        // --- Photo Upload & Preview Logic ---
        const photoUploadInput = document.getElementById('photo_upload');
        const photoPreview = document.getElementById('photo-preview');
        const previewContainer = document.getElementById('photo-preview-container');
        const placeholder = document.getElementById('photo-placeholder');
        const removeBtn = document.getElementById('remove-photo-btn');
        const photoUrlHidden = document.getElementById('photo_url_hidden');
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
            photoUrlHidden.value = ''; // Clear the hidden URL field
            removePhotoFlag.value = '1'; // Set flag to remove on server
        }

        // On page load, check for an existing photo from the server
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
                // The server will handle required validation, so we don't need a client-side message for it.
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

        // The 'submit' event listener that prevented server-side validation has been removed.
        // The form will now submit, and the PHP code will return all validation errors as intended.
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
            "ရှမ်းပြည်နယ်": ["တောင်ကြီး", "ဆီဆိုင်", "ကလော", "ရပ်စောက်", "ညောင်ရွှေ", "ပင်းတယ", "ပင်လောင်း", "ရွာငံ", "ဖယ်ခုံ", "ဟိုပုံး", "ကျိုင်းတုံ", "မိုင်းခတ်", "မိုင်းယန်း", "မိုင်းပျဉ်း", "တာချီလိတ်", "မိုင်းဖြတ်", "မိုင်းယောင်း", "မက်မန်း", "မိုးမိတ်", "မဘိမ်း", "မိုင်းဆတ်", "မိုင်းတုံ", "မူဆယ်", "ကွတ်ခိုင်", "နမ့်ခမ်း", "လင်းခေး", "မိုးနဲ", "မိုင်းပန်", "မောက်မယ်", "လွိုင်လင်", "ကွန်ဟိန်း", "လဲချား", "မိုင်းကိုင်", "မိုင်းရှူး", "ကျေးသီး", "နမ့်စန်", "လားရှိုး", "သိန္နီ", "ကွမ်းလုံ", "မိုင်းရယ်", "တန့်ယန်း", "ကျောက်မဲ", "သီပေါ", "မန်တုံ", "နမ့်ဆန်", "နမ္မတူ", "နောင်ချို", "လောက်ကိုင်", "ကုန်းကြမ်း", "ဟိုပန်"],
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
            1: ["ကစန", "ခဘဒ", "ဂမန", "ဟပန", "အလန", "မကန", "မခဘ", "မဂန", "မညန", "မစန", "မမန", "ပတအ", "ရကန", "ဆပဘ", "ဆလန", "တနန", "ဝမန"],
            2: ["ဒမဆ", "ဖရဆ", "လကန", "မစန"],
            3: ["ဘအန", "ဖပန", "ကကရ", "လဘန", "မဝတ", "သတန"],
            4: ["ဟခန", "ဖလန", "မတပ", "ပလဝ", "တတန", "ထတလ"],
            5: ["စကန", "ဘမန", "ကနလ", "ကလဝ", "ကလဟ", "ကသ", "ခဥန", "လရန", "မလန", "မငန", "စလင", "ရမဘ", "တဇန", "ဝန်းသို"],
            6: ["တငန", "ဘလန", "ကပက", "ကတခ", "လရန", "မဘန", "မမန", "မတရ", "နလန", "ပဖန", "သပက"],
            7: ["ပခက", "ဂဂန", "မကန", "ငဖန", "ပတန", "စလန", "သရန", "တငန"],
            8: ["မကန", "အလန", "မငလ", "မနန", "ပကခ", "စတရ", "တငန", "သရက"],
            9: ["မလမ", "ကမရ", "ဥကမ", "ဒဂမ", "ဒလန", "ကခက", "လမန", "မဂတ", "ပဘတ", "စခန", "သကတ", "တမန", "ရကန"],
            10: ["မအန", "ဘကလ", "ဒနဘ", "ဟသတ", "ဟငသ", "လပတ", "မအန", "မမက", "ပသန", "ဖပန", "ဝခမ"],
            11: ["စတန", "ကမန", "ကပန", "လယန", "မခန", "မညန", "ပလန", "သစန"],
            12: ["ဥတသ", "ဒခသ", "ပဗသ", "ဇယသ", "လဝန", "ပမန", "တကန", "ဇမသ"],
            13: ["ကလန", "ညဥန", "ပပဏ", "ရစက", "တသန", "ဝတလ", "မထလ", "မကင"],
            14: ["တကန", "ကတန", "ကမန", "ကမတ", "ဒဂန", "ဒပန", "လသန", "မဘန", "မရန", "ပစတ", "ဖနန", "ရပန", "သလန", "သဃက"]
        };
        const nrcTypes = ["နိုင်", "ဧည့်", "ပြု", "သာ", "ယာယီ"];

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
            for (let i = 1; i <= 14; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
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

                // Repopulate township if default value exists
                if (defaults.township && stateSelect.value == defaults.state) {
                    townshipSelect.value = defaults.township;
                }

                updateHiddenNrcInput();
            };

            // Set default values
            if(defaults.state) stateSelect.value = defaults.state;
            if(defaults.type) typeSelect.value = defaults.type;
            if(defaults.number) numberInput.value = defaults.number;

            stateSelect.addEventListener('change', updateNrcTownships);
            townshipSelect.addEventListener('change', updateHiddenNrcInput);
            typeSelect.addEventListener('change', updateHiddenNrcInput);
            numberInput.addEventListener('input', updateHiddenNrcInput);

            // Initial population of townships
            updateNrcTownships();
        }

        createNrcInputGroup('student_nrc_group', 'student_nrc', repopulateNrcData.student);
        createNrcInputGroup('father_nrc_group', 'father_nrc', repopulateNrcData.father);
        createNrcInputGroup('mother_nrc_group', 'mother_nrc', repopulateNrcData.mother);

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

        // --- Name Input Validation ---
        function setupNameValidation(inputId, isMyanmar) {
            const inputElement = document.getElementById(inputId);
            if (!inputElement) return;

            const regex = isMyanmar ? /^[\u1000-\u109F\s]*$/ : /^[a-zA-Z\s]*$/;
            const message = isMyanmar ? "မြန်မာအက္ခရာများသာ ထည့်သွင်းပါ။" : "English letters only.";
            
            inputElement.addEventListener('input', function(e) {
                if (!regex.test(e.target.value)) {
                    // Find the last character that is invalid and remove it
                    e.target.value = e.target.value.slice(0, -1);
                }
            });
             // Add pattern for form submission validation
            inputElement.setAttribute('pattern', regex.source.slice(1,-1));
            inputElement.setAttribute('title', message);
        }

        // Student
        setupNameValidation('student_name_mm', true);
        setupNameValidation('student_name_en', false);
        // Father
        setupNameValidation('father_name_mm', true);
        setupNameValidation('father_name_en', false);
        // Mother
        setupNameValidation('mother_name_mm', true);
        setupNameValidation('mother_name_en', false);

    });
</script>

</body>
</html>

