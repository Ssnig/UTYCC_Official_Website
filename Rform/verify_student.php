<?php
session_start();
date_default_timezone_set('Asia/Yangon');

// Include your database connection file
require_once "db.php";

$errors = [];
$student_name_mm = '';
$previous_seat_no = '';
$current_seat_no = '';
$student_nrc = '';
$academic_year = '';
$major = '';

// Helper function and data for repopulating NRC dropdowns
$repopulate_nrc = [
    'student' => ['state' => '', 'township' => '', 'type' => '', 'number' => '']
];

function parseNrc($nrc_string, &$repopulate_array)
{
    // Myanmar to English digit mapping for parsing
    $myanmar_to_english = [
        '၀' => '0', '၁' => '1', '၂' => '2', '၃' => '3', '၄' => '4',
        '၅' => '5', '၆' => '6', '၇' => '7', '၈' => '8', '၉' => '9'
    ];

    if (!empty($nrc_string)) {
        // Check if the NRC string contains Myanmar digits in state part
        if (preg_match('/^([၀-၉]+)\/([^\(]+)(\(\S+\))([၀-၉]+)$/', $nrc_string, $matches)) {
            // Convert Myanmar state to English for internal processing
            $state_myanmar = $matches[1];
            $state_english = strtr($state_myanmar, $myanmar_to_english);
            
            $repopulate_array['state']    = $state_english;
            $repopulate_array['township'] = $matches[2];
            $repopulate_array['type']     = $matches[3];
            $repopulate_array['number']   = strtr($matches[4], $myanmar_to_english);
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve POST data
    $student_name_mm = trim($_POST['student_name_mm'] ?? '');
    $previous_seat_no = trim($_POST['previous_seat_no'] ?? '');
    $current_seat_no = trim($_POST['current_seat_no'] ?? '');
    $student_nrc = trim($_POST['student_nrc'] ?? '');
    $academic_year = trim($_POST['academic_year'] ?? '');
    $major = trim($_POST['major'] ?? '');

    // Repopulate NRC dropdowns on postback
    parseNrc($student_nrc, $repopulate_nrc['student']);

    // Basic validation
    if (empty($student_name_mm)) $errors[] = "ကျောင်းသား/သူ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    if (empty($previous_seat_no)) $errors[] = "အရင်နှစ် ခုံအမှတ် ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    if (empty($current_seat_no)) $errors[] = "အခုနှစ် ခုံအမှတ် ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    if (empty($student_nrc)) $errors[] = "နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    if (empty($academic_year)) $errors[] = "ယခုသင်တန်းနှစ် ရွေးချယ်ရန်လိုအပ်ပါသည်။";
    if (empty($major)) $errors[] = "အထူးပြုဘာသာ ရွေးချယ်ရန်လိုအပ်ပါသည်။";

    if (empty($errors)) {
        try {
            // Prepare a statement to find the student using the previous seat number
            $stmt = $pdo->prepare("
                SELECT student_id FROM students 
                WHERE student_name_mm = :student_name_mm 
                AND seat_no = :seat_no 
                AND student_nrc = :student_nrc
            ");
            $stmt->execute([
                ':student_name_mm' => $student_name_mm,
                ':seat_no' => $previous_seat_no,
                ':student_nrc' => $student_nrc
            ]);

            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($student) {
                // --- Student Found ---
                // Clear any old session data first and set the student ID
                session_unset();
                $_SESSION['student_id'] = $student['student_id'];
                
                // Store the new academic data to be merged in cur_form.php
                $_SESSION['new_data'] = [
                    'seat_no'       => $current_seat_no,
                    'academic_year' => $academic_year,
                    'major'         => $major
                ];

                // Redirect to the form for review and editing
                header("Location: cur_form.php");
                exit;

            } else {
                // --- Student Not Found ---
                $errors[] = "သင်ဖြည့်သွင်းလိုက်သော အချက်အလက်များသည် မှတ်တမ်းများနှင့် ကိုက်ညီမှုမရှိပါ။ ကျေးဇူးပြု၍ ပြန်လည်စစ်ဆေးပါ။";
            }

        } catch (PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Student Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
        }
        .error-message {
            color: #D32F2F;
            font-size: 0.875rem;
        }
        .nrc-number.border-red-500 {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2) !important;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-xl">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">ကျောင်းသားဟောင်း အချက်အလက် စစ်ဆေးခြင်း</h1>
            <p class="text-gray-500 mt-2">သင်၏ အချက်အလက်များကို ဖြည့်စွက်၍ အတည်ပြုပါ။</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
            <div class="space-y-6">
                <div>
                    <label for="student_name_mm" class="block text-sm font-medium text-gray-700">အမည် (မြန်မာစာဖြင့်)</label>
                    <input type="text" id="student_name_mm" name="student_name_mm" value="<?php echo htmlspecialchars($student_name_mm); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                
                <div>
                    <label for="previous_seat_no" class="block text-sm font-medium text-gray-700">အရင်နှစ် ခုံအမှတ်</label>
                    <input type="text" id="previous_seat_no" name="previous_seat_no" value="<?php echo htmlspecialchars($previous_seat_no); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="current_seat_no" class="block text-sm font-medium text-gray-700">အခုနှစ် ခုံအမှတ်</label>
                    <input type="text" id="current_seat_no" name="current_seat_no" value="<?php echo htmlspecialchars($current_seat_no); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="student_nrc_group" class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                    <div id="student_nrc_group" class="mt-1"></div>
                    <input type="hidden" name="student_nrc" id="student_nrc_hidden" value="<?php echo htmlspecialchars($student_nrc); ?>">
                </div>

                <hr class="border-gray-200">

                <div>
                    <label for="academic_year" class="block text-sm font-medium text-gray-700">ယခုသင်တန်းနှစ်</label>
                    <select id="academic_year" name="academic_year" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled <?php echo ($academic_year == '') ? 'selected' : ''; ?>>သင်တန်းနှစ်ကို ရွေးချယ်ပါ</option>
                        <option value="Second Year" <?php echo ($academic_year == 'Second Year') ? 'selected' : ''; ?>>Second Year</option>
                        <option value="Third Year" <?php echo ($academic_year == 'Third Year') ? 'selected' : ''; ?>>Third Year</option>
                        <option value="Fourth Year" <?php echo ($academic_year == 'Fourth Year') ? 'selected' : ''; ?>>Fourth Year</option>
                        <option value="Fifth Year" <?php echo ($academic_year == 'Fifth Year') ? 'selected' : ''; ?>>Fifth Year</option>
                        <option value="Final Year" <?php echo ($academic_year == 'Final Year') ? 'selected' : ''; ?>>Final Year</option>
                    </select>
                </div>

                <div>
                    <label for="major" class="block text-sm font-medium text-gray-700">အထူးပြုဘာသာ</label>
                    <select id="major" name="major" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled <?php echo ($major == '') ? 'selected' : ''; ?>>အထူးပြုဘာသာ ရွေးချယ်ပါ</option>
                        <option value="IST" <?php echo ($major == 'IST') ? 'selected' : ''; ?>>Information Science Technology (IST)</option>
                        <option value="CE" <?php echo ($major == 'CE') ? 'selected' : ''; ?>>Computer Engineering (CE)</option>
                        <option value="EcE" <?php echo ($major == 'EcE') ? 'selected' : ''; ?>>Electronics Engineering (EcE)</option>
                        <option value="PrE" <?php echo ($major == 'PrE') ? 'selected' : ''; ?>>Precision Engineering (PrE)</option>
                        <option value="AME" <?php echo ($major == 'AME') ? 'selected' : ''; ?>>Advanced Materials Engineering (AME)</option>
                    </select>
                </div>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform transform hover:scale-105">
                    အချက်အလက် စစ်ဆေးရန်
                </button>
            </div>
        </form>
    </div>
    
<script>
    const repopulateNrcData = <?php echo json_encode(['student' => $repopulate_nrc['student']]); ?>;

    document.addEventListener('DOMContentLoaded', function() {
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

        const myanmarDigits = {
            1: '၁', 2: '၂', 3: '၃', 4: '၄', 5: '၅', 
            6: '၆', 7: '၇', 8: '၈', 9: '၉', 10: '၁၀',
            11: '၁၁', 12: '၁၂', 13: '၁၃', 14: '၁၄'
        };

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
            12: ["အလန", "အစန", "ဥကမ", "ဥကတ", "ဗဟန", "ဗတထ", "ဒဂမ", "ဒဂန", "ဒဂဆ", "ဒဂရ", "ဒလန", "ဒပန", "ထတပ", "ကကက", "ကခက", "ကမန", "က�မတ", "ကမရ", "ကတန", "ကတတ", "ခရန", "လကန" , "လမန", "လမတ", "လသန", "လသယ", "လယန", "လယရ", "မဥက", "မဘန","မဂဒ", "မဂတ", "မရက", "ပဘတ", "ပဇတ", "ဆကခ", "စခန", "တဥက", "တကန", "တမန", "တတန", "တတတ", "သဃက", "သကတ", "သခန", "သလန","ရကန","ရပသ"],
            13: ["အပန", "အသရ", "အတန", "ဟမန", "ဟပန", "ဟပတ", "ကဟန", "ကကန", "ကခန", "ကလဒ", "ကလထ", "ကလန", "ကလတ", "ကမန", "ကတလ", "ကတန", "ကတတ", "ကသန", "ခလန", "ခရဟ", "လကန", "လခန", "လခတ", "လလန" ,"လရန", "မဘန", "မဟရ", "မထထ", "မကထ", "မကန", "မကတ", "မခန", "မခတ", "မလန", "မလတ", "မမထ", "မမန", "မနန", "မနတ", "မငန", "မပထ", "မပန", "မပတ", "မဖန", "မဖတ", "မရန", "မရတ", "မဆန", "မဆတ", "မတန", "မတတ", "မယထ", "မယန", "မယတ", "နခန", "နခတ" ,"နမတ", "နဖန", "နစန", "နတန", "နတရ", "ညရန" , "ပဆတ", "ပလထ", "ပလန", "ပလတ", "ပပက", "ပဆန", "ပဝန", "ပယန", "ဖခန", "ဆဆန", "တကန" ,"တခလ", "တလန", "တမည", "တတန", "တယန", "သနန",  "သပန", "ဝကန","ရငန","ရညန" ,"ရစန"],
            14: ["အမတ", "အဂပ", "အမန", "အပန", "အစန", "ဘကလ", "ဒဒရ", "ဓနဖ", "ဟကက", "ဟသတ", "ကကထ", "ကကန", "ကခန", "ကလန" , "ကမန", "ကမသ", "ကပန", "လမန", "လပတ", "မအန", "မအပ", "မမက", "မမန", "မရက", "ငပတ", "ငဆန", "ငသခ" , "ငရက", "ညတန", "ပကခ", "မပလ", "ပတန", "ပသန", "ပသရ", "ဖပန", "တမန", "သပန" ,"ဝခမ", "ရကန", "ရသယ", "ဇလန"]
        };
        const nrcTypes = ["နိုင်", "ဧည့်", "ပြု", "သာ", "ယာယီ"];

        // Myanmar numerals mapping for NRC states
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

        function createNrcInputGroup(containerId, namePrefix, defaults) {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.innerHTML = ''; 

            const commonClasses = 'block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500';

            const wrapper = document.createElement('div');
            wrapper.className = 'flex flex-col space-y-2';

            const dropdownContainer = document.createElement('div');
            dropdownContainer.className = 'grid grid-cols-3 gap-2';

            const stateSelect = document.createElement('select');
            stateSelect.name = `${namePrefix}_state`;
            stateSelect.className = commonClasses;
            
            // Add default option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'တိုင်းဒေသကြီး/ပြည်နယ်';
            defaultOption.disabled = true;
            stateSelect.appendChild(defaultOption);
            
            // Add state options with Myanmar digits
            for (let i = 1; i <= 14; i++) {
                const option = document.createElement('option');
                option.value = myanmarNumerals[i]; // Store Myanmar digit as value
                option.textContent = myanmarNumerals[i];
                stateSelect.appendChild(option);
            }

            const townshipSelect = document.createElement('select');
            townshipSelect.name = `${namePrefix}_township`;
            townshipSelect.className = commonClasses;

            const typeSelect = document.createElement('select');
            typeSelect.name = `${namePrefix}_type`;
            typeSelect.className = commonClasses;
            
            // Add default option for type
            const typeDefaultOption = document.createElement('option');
            typeDefaultOption.value = '';
            typeDefaultOption.textContent = 'အမျိုးအစား';
            typeDefaultOption.disabled = true;
            typeSelect.appendChild(typeDefaultOption);
            
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
            numberInput.className = commonClasses + ' nrc-number';
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
                } else {
                    numberInput.classList.remove('border-red-500');
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
                
                townshipSelect.innerHTML = '<option value="" disabled selected>မြို့နယ်</option>';
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

        createNrcInputGroup('student_nrc_group', 'student_nrc', repopulateNrcData.student);
    });
</script>

</body>
</html>