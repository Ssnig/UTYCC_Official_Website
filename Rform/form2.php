<?php
// Start the session to access data from previous forms.
session_start();
// Set the default timezone to Myanmar time to ensure correct date formatting
date_default_timezone_set('Asia/Yangon');

// Ensure form1_data exists, otherwise redirect back to form1.
// This prevents users from accessing this page directly.
if (!isset($_SESSION['form1_data'])) {
    header("location: form1.php");
    exit;
}

$form1_data = $_SESSION['form1_data'];

// --- Date Formatting for Display ---
// The date from session is now a full timestamp (e.g., '2025-09-04 13:30:00').
// For display purposes, we only want to show the date part in the user-friendly 'd-m-Y' format.
$display_date = '';
if (!empty($form1_data['date'])) {
    try {
        $date_obj = new DateTime($form1_data['date']);
        $display_date = $date_obj->format('d-m-Y');
    } catch (Exception $e) {
        // If the date is somehow invalid, just show the raw data to avoid errors.
        $display_date = $form1_data['date'];
    }
}


// --- Configuration ---
// echo '<pre>';
// print_r($form1_data);

// Define the list of available majors. This makes the code easier to maintain.
$available_majors = [
    'IST' => 'သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာအင်ဂျင်နီယာဘာသာရပ်(IST)',
    'CE'  => 'ကွန်ပျူတာအင်ဂျင်နီယာ ဘာသာရပ်(CE)',
    'EcE' => 'အီလက်ထရောနစ် အင်ဂျင်နီယာ ဘာသာရပ်(EcE)',
    'PrE' => 'တိကျပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ ဘာသာရပ်(PrE)',
    'AME' => 'အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ ဘာသာရပ်(AME)',
];

// --- Variable Initialization ---

// MODIFICATION: Initialize preferences from session if available (for 'back' navigation).
// If not, create a default empty array.
// This will be overwritten by POST data if the form is submitted.
if (isset($_SESSION['form2_data']['preferences'])) {
    $preferences = $_SESSION['form2_data']['preferences'];
} else {
    $preferences = array_fill(1, 5, '');
}

// Initialize an array to hold validation errors.
$errors = [];

// --- Form Submission Handling ---

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // MODIFICATION: First, populate preferences from POST data to preserve user input on validation error.
    for ($i = 1; $i <= 5; $i++) {
        $key = 'preference' . $i;
        $preferences[$i] = isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
    }

    // --- Data Validation ---

    // 1. Validate Major Preferences
    $submitted_preferences = [];
    for ($i = 1; $i <= 5; $i++) {
        $key = 'preference' . $i;
        if (empty($_POST[$key])) {
            $errors[$key] = "ဦးစားပေး ဘာသာရပ် ရွေးချယ်ရန်လိုအပ်ပါသည်။"; // "Preference is required."
        } elseif (!array_key_exists($_POST[$key], $available_majors)) {
            $errors[$key] = "သင်ရွေးချယ်လိုက်သော ဘာသာရပ်သည် ရွေးချယ်ခွင့်မရှိပါ။"; // "Invalid major selected."
        } else {
            // Add to a temporary array for duplicate checking
            $submitted_preferences[] = $_POST[$key];
        }
    }

    // 2. Check for Duplicate Preferences
    // This check runs only if all 5 preferences have been submitted.
    if (count($submitted_preferences) === 5 && count(array_unique($submitted_preferences)) !== 5) {
        $errors['preferences_duplicate'] = "ဦးစားပေး ဘာသာရပ်များ တူညီနေ၍မရပါ။ ကျေးဇူးပြု၍ မတူညီသော ဘာသာရပ်များကို ရွေးချယ်ပါ။"; // "Preferences cannot be the same. Please choose different majors."
    }


    // --- Process Data ---

    // If there are no validation errors, store data in session and redirect.
    if (empty($errors)) {
        // Store the validated data in the session.
        // We only store data relevant to this form.
        $_SESSION['form2_data'] = [
            'preferences' => $preferences, // $preferences is now populated from the valid POST data
        ];

        // Redirect to the next form.
        header("location: option.php");
        exit;
    }
}

// Include the header partial.
include 'formPartial/header.php';
?>

<!-- The body content starts here -->
<div class="max-w-4xl mx-auto p-4">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
        <section class="form-section" id="major-application">
            <!-- Form Header -->
            <div class="form-header text-center">
                <p>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်အစိုးရ</p>
                <p>သိပ္ပံနှင့်နည်းပညာဝန်ကြီးဌာန</p>
                <p>အဆင့်မြင့်သိပ္ပံနှင့်နည်းပညာဦးစီးဌာန</p>
                <h2 class="form-title mt-2">နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)</h2>
                <div class="flex justify-between items-center mt-4 text-sm">
                    <span>သင်တန်းရေးရာ- 09445767834</span>
                    <!-- Displaying the date from the first form's session data -->
                    <span>ရက်စွဲ: <?php echo htmlspecialchars($display_date); ?></span>
                </div>
            </div>

            <h3 class="form-subtitle text-center my-4">ပထမနှစ် ကျောင်းသား/ ကျောင်းသူများ၏ အင်ဂျင်နီယာဘာသာရပ် ဆန္ဒပြုလျှောက်လွှာ</h3>

            <!-- Student Pledge Text -->
            <p class="pledge-text mb-6 leading-loose">
                ကျွန်တော်/ ကျွန်မ မောင်/မ
                <input type="text" name="student_name_and_roll" class="form-input border-0 border-b-2 border-dotted inline-block w-auto" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_name_mm']); ?>" readonly>
                သည် ၂၀၂၅ ခုနှစ် ဒီဇင်ဘာလ ၂၁ရက် နေ့တွင် စတင်ဖွင့်လှစ်သင်ကြားမည့် ဤတက္ကသိုလ်၏ အင်ဂျင်နီယာသင်တန်းတွင် အောက်ပါ ဦးစားပေး အစီအစဥ်အရ ရရှိလိုပြီး အင်ဂျင်နီယာဘာသာရပ်ဖြင့် တက်ရောက်ခွင့်ပြုပါရန် လျှောက်ထားအပ်ပါသည်-
            </p>

            <!-- Main Content Grid -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column: List of Available Courses -->
                <div>
                    <h4 class="font-semibold mb-2">ဤတက္ကသိုလ်တွင် တက်ရောက်နိုင်သောသင်တန်းများ</h4>
                    <ol class="list-decimal list-inside space-y-2">
                        <?php foreach ($available_majors as $major_full_name) : ?>
                            <li><?php echo $major_full_name; ?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <!-- Right Column: User's Preferences -->
                <div>
                    <h4 class="font-semibold mb-2">တက်ရောက်လိုသောဦးစားပေးအစီအစဥ်</h4>
                    <div class="space-y-2">
                        <?php if (!empty($errors['preferences_duplicate'])) : ?>
                            <p class="text-red-500 text-sm"><?php echo $errors['preferences_duplicate']; ?></p>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <div class="flex items-center gap-2">
                                <span><?php echo $i; ?>။</span>
                                <select name="preference<?php echo $i; ?>" class="form-input flex-grow">
                                    <option value="">ဦးစားပေး ဘာသာရပ် ရွေးချယ်ပါ</option>
                                    <?php foreach ($available_majors as $major_code => $major_full_name) : ?>
                                        <option value="<?php echo $major_code; ?>" <?php if ($preferences[$i] == $major_code) echo 'selected'; ?>>
                                            <?php echo $major_full_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Display validation error for each preference -->
                            <?php if (!empty($errors['preference' . $i])) : ?>
                                <span class="text-red-500 text-sm block pl-6"><?php echo $errors['preference' . $i]; ?></span>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <!-- Note Section -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-800 rounded-r-lg">
                <p class="font-bold">မှတ်ချက်</p>
                <p class="text-sm">သင်ကြားခွင့်ပြုမည့် ဦးစားပေးအဓိက ဘာသာရပ်ကို ကျောင်းသား၊ကျောင်းသူ၏ တက္ကသိုလ်ဝင် စာမေးပွဲတွင် ရူပဗေဒ၊ ဓာတုဗေဒ၊ သင်္ချာနှင့် အင်္ဂလိပ်စာ (၄) ဘာသာပေါင်းရမှတ်၊ ကျောင်းသား၊ ကျောင်းသူ၏ ဦးစားပေး လျှောက်ထားမှုနှင့် သက်ဆိုင်ရာပညာရပ်အတွက် ကျောင်းသား၊ကျောင်းသူ လက်ခံနိုင်မှုဦးရေ ကန့်သတ်ချက်အပေါ်တွင် မူတည်၍ အချိုးကျခွဲဝေ သတ်မှတ်ပေးမည်ဖြစ်ပြီး ပြည့်စုံစွာ ဖြည့်စွက်ခြင်းမရှိပါက ရွေးချယ်ရေး အဖွဲ့က သတ်မှတ်ပေးသော သင်တန်းကိုသာ တက်ရောက်ရမည် ဖြစ်သည်။</p>
            </div>
        </section>

        <!-- Navigation Buttons -->
        <div class="nav-buttons mt-8 flex justify-between">
            <a href="form1.php" class="nav-button bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Back</a>
            <button type="submit" class="nav-button bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Next</button>
        </div>
    </form>
</div>

<!-- Include the footer partial -->
<?php include 'formPartial/footer.php'; ?>

