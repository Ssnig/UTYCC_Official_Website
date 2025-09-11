<?php
session_start();
date_default_timezone_set('Asia/Yangon');

// If already verified, redirect to form1 to prevent re-verification
// if (isset($_SESSION['pre_approved_data'])) {
//     header('Location: form1.php');
//     exit;
// }

require_once "db.php"; // Make sure your DB connection file is included

$errors = [];
$sequence_no = $seat_no = $student_name_mm = $nrc = $dob = '';

// If user tries to go back to verification after starting the form, clear the session.
if (isset($_GET['new']) && $_GET['new'] == '1') {
    session_destroy();
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sequence_no = trim($_POST['sequence_no'] ?? '');
    $seat_no = trim($_POST['seat_no'] ?? '');
    $student_name_mm = trim($_POST['student_name_mm'] ?? '');
    $nrc = trim($_POST['nrc'] ?? ''); // NRC from hidden input
    $dob = trim($_POST['dob'] ?? '');

    if (empty($sequence_no)) {
        $errors[] = 'စဉ် (ကျောင်းဝင်အမှတ်) ဖြည့်သွင်းရန် လိုအပ်ပါသည်။';
    }
    if (empty($seat_no)) {
        $errors[] = 'တက္ကသိုလ်ဝင်တန်း ခုံအမှတ်ဖြည့်သွင်းရန် လိုအပ်ပါသည်။';
    }
    if (empty($student_name_mm)) {
        $errors[] = 'ကျောင်းသား/သူ အမည် (မြန်မာ) ဖြည့်သွင်းရန် လိုအပ်ပါသည်။';
    }
    if (empty($nrc)) {
        $errors[] = 'နိုင်ငံသားစိစစ်ရေးကတ်အမှတ် ဖြည့်သွင်းရန် လိုအပ်ပါသည်။';
    }
    if (empty($dob)) {
        $errors[] = 'မွေးသက္ကရာဇ် ဖြည့်သွင်းရန် လိုအပ်ပါသည်။';
    }

    if (empty($errors)) {
        try {
            // Base query and parameters
            $sql = "SELECT * FROM pre_approved_students 
                    WHERE sequence_no = :sequence_no AND seat_no = :seat_no AND student_name_mm = :student_name_mm AND dob = :dob";
            
            $params = [
                ':sequence_no' => $sequence_no,
                ':seat_no' => $seat_no,
                ':student_name_mm' => $student_name_mm,
                ':dob' => $dob
            ];

            // If NRC is not 'လျှောက်ထားဆဲ', add it to the query for stricter verification.
            // Otherwise, we verify based on the other 4 unique fields.
            if ($nrc !== 'လျှောက်ထားဆဲ') {
                $sql .= " AND nrc = :nrc";
                $params[':nrc'] = $nrc;
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($student) {
                if ($student['is_enrolled']) {
                    $errors[] = 'သင်သည် ကျောင်းအပ်နှံခြင်းလုပ်ငန်းစဉ်ကို ပြီးမြောက်ပြီးဖြစ်ပါသည်။';
                } else {
                    // Verification successful, store pre-approved data in session.
                    // Storing the whole record is better.
                    $_SESSION['pre_approved_data'] = $student;

                    // Clear any old form data before starting new
                    unset($_SESSION['form1_data']);
                    unset($_SESSION['form2_data']);
                    unset($_SESSION['option_data']);

                    header("Location: form1.php");
                    exit;
                }
            } else {
                $errors[] = 'သင်ဖြည့်သွင်းလိုက်သော အချက်အလက်များသည် မှတ်တမ်းများနှင့် ကိုက်ညီမှုမရှိပါ။ ကျေးဇူးပြု၍ ကျောင်းသားရေးရာဌာနသို့ ဆက်သွယ်ပါ။';
            }
        } catch (PDOException $e) {
            error_log("Verification Error: " . $e->getMessage());
            $errors[] = "An error occurred. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f0f4f8; }
        .card {
            background-color: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

<div class="w-full max-w-md">
    <div class="card p-8 md:p-12">
        <div class="text-center mb-8">
            <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-20 h-20 mb-4"/>
            <h1 class="text-3xl font-extrabold text-gray-800">Enrollment Verification</h1>
            <p class="text-gray-500 mt-2">ကျောင်းအပ်ရန် သင်၏အချက်အလက်များကို စစ်ဆေးပါ။</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="space-y-6">
            <div>
                <label for="student_name_mm" class="block text-sm font-medium text-gray-700 mb-1">ကျောင်းသား/သူ အမည် (မြန်မာ)</label>
                <input type="text" id="student_name_mm" name="student_name_mm" value="<?php echo htmlspecialchars($student_name_mm); ?>" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g., မောင်အောင်အောင်">
            </div>

             <div>
                <label for="sequence_no" class="block text-sm font-medium text-gray-700 mb-1">စဉ် (ကျောင်းဝင်အမှတ်)</label>
                <input type="text" id="sequence_no" name="sequence_no" value="<?php echo htmlspecialchars($sequence_no); ?>" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g., ၁၂၃">
            </div>

            <div>
                <label for="seat_no" class="block text-sm font-medium text-gray-700 mb-1">တက္ကသိုလ်ဝင်တန်း ခုံအမှတ်</label>
                <input type="text" id="seat_no" name="seat_no" value="<?php echo htmlspecialchars($seat_no); ?>" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="e.g., ဆပလ ၃၇၉၉">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="nrc_group" class="block text-sm font-medium text-gray-700">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                    <div class="flex items-center">
                        <input type="checkbox" id="nrc_applying" name="nrc_applying" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="nrc_applying" class="ml-2 block text-sm text-gray-900">လျှောက်ထားဆဲ</label>
                    </div>
                </div>
                <div id="nrc_group" class="mt-1"></div>
                <input type="hidden" name="nrc" id="nrc_hidden" value="<?php echo htmlspecialchars($nrc); ?>">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">မွေးသက္ကရာဇ်</label>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <select id="dob_year" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">ခုနှစ်</option>
                        </select>
                    </div>
                    <div>
                        <select id="dob_month" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">လ</option>
                        </select>
                    </div>
                    <div>
                        <select id="dob_day" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">ရက်</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>">
            </div>


            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-indigo-700 transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Verify & Proceed
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- Date of Birth Dropdown Logic ---
    const yearSelect = document.getElementById('dob_year');
    const monthSelect = document.getElementById('dob_month');
    const daySelect = document.getElementById('dob_day');
    const dobHiddenInput = document.getElementById('dob');

    const currentYear = new Date().getFullYear();
    const startYear = currentYear - 100; // Allow ages up to 100

    // Populate years
    for (let i = currentYear - 16; i >= startYear; i--) { // Must be at least 16
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        yearSelect.appendChild(option);
    }

    // Populate months with numbers
    for (let i = 1; i <= 12; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        monthSelect.appendChild(option);
    }

    function populateDays() {
        const year = parseInt(yearSelect.value, 10);
        const month = parseInt(monthSelect.value, 10);
        const currentDay = daySelect.value;
        daySelect.innerHTML = '<option value="">ရက်</option>'; // Clear existing days

        if (year && month) {
            const daysInMonth = new Date(year, month, 0).getDate();
            for (let i = 1; i <= daysInMonth; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                daySelect.appendChild(option);
            }
            if (currentDay && currentDay <= daysInMonth) {
                daySelect.value = currentDay;
            }
        }
    }

    function updateHiddenDob() {
        const year = yearSelect.value;
        const month = monthSelect.value;
        const day = daySelect.value;

        if (year && month && day) {
            // Pad month and day with leading zero if needed
            const monthPadded = String(month).padStart(2, '0');
            const dayPadded = String(day).padStart(2, '0');
            dobHiddenInput.value = `${year}-${monthPadded}-${dayPadded}`;
        } else {
            dobHiddenInput.value = '';
        }
    }

    // Repopulate from hidden input value on page load (if form fails)
    const initialDob = dobHiddenInput.value;
    if (initialDob) {
        const dateParts = initialDob.split('-');
        if (dateParts.length === 3) {
            yearSelect.value = parseInt(dateParts[0], 10);
            monthSelect.value = parseInt(dateParts[1], 10);
            populateDays(); // Important to populate days before setting day value
            daySelect.value = parseInt(dateParts[2], 10);
        }
    }
    
    // Event Listeners
    yearSelect.addEventListener('change', () => { populateDays(); updateHiddenDob(); });
    monthSelect.addEventListener('change', () => { populateDays(); updateHiddenDob(); });
    daySelect.addEventListener('change', updateHiddenDob);


    // --- NRC Input Group Logic ---
    function convertToMyanmarNumber(str) {
        const english_numerals = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g];
        const myanmar_numerals = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
        let newStr = String(str);
        for (let i = 0; i < english_numerals.length; i++) {
            newStr = newStr.replace(english_numerals[i], myanmar_numerals[i]);
        }
        return newStr;
    }

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

    function createNrcInputGroup(containerId, namePrefix) {
        const container = document.getElementById(containerId);
        if (!container) return;

        container.innerHTML = ''; 
        const wrapper = document.createElement('div');
        wrapper.className = 'flex flex-col space-y-2';

        const dropdownContainer = document.createElement('div');
        dropdownContainer.className = 'grid grid-cols-3 gap-2';
        
        const inputClass = 'w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500';

        const stateSelect = document.createElement('select');
        stateSelect.name = `${namePrefix}_state`;
        stateSelect.className = inputClass;
        for (let i = 1; i <= 14; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = convertToMyanmarNumber(i);
            stateSelect.appendChild(option);
        }

        const townshipSelect = document.createElement('select');
        townshipSelect.name = `${namePrefix}_township`;
        townshipSelect.className = inputClass;

        const typeSelect = document.createElement('select');
        typeSelect.name = `${namePrefix}_type`;
        typeSelect.className = inputClass;
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
        numberInput.className = inputClass + ' mt-2';
        numberInput.placeholder = '၁၂၃၄၅၆';
        numberInput.maxLength = 6;
        numberInput.pattern = '[၀-၉]{6}';
        numberInput.title = 'မြန်မာဂဏန်း ၆ လုံး ထည့်သွင်းပါ။';

        wrapper.append(dropdownContainer, numberInput);
        container.append(wrapper);

        const updateHiddenNrcInput = () => {
            const hiddenInput = document.getElementById(`${namePrefix}_hidden`);
            const checkbox = document.getElementById(`${namePrefix}_applying`);
            if (hiddenInput && checkbox && checkbox.checked) {
                hiddenInput.value = 'လျှောက်ထားဆဲ';
                return; // Stop here if applying
            }

            if (hiddenInput) {
                const state = stateSelect.value;
                const township = townshipSelect.value;
                const type = typeSelect.value;
                const number = numberInput.value;
                if (state && township && type && number.match(/^[၀-၉]{6}$/)) {
                    hiddenInput.value = `${convertToMyanmarNumber(state)}/${township}${type}${number}`;
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
            updateHiddenNrcInput();
        };

        stateSelect.addEventListener('change', updateNrcTownships);
        townshipSelect.addEventListener('change', updateHiddenNrcInput);
        typeSelect.addEventListener('change', updateHiddenNrcInput);
        
        numberInput.addEventListener('input', function() {
            const myanmarValue = convertToMyanmarNumber(this.value);
            const sanitizedValue = myanmarValue.replace(/[^၀-၉]/g, '');
            if (this.value !== sanitizedValue) {
               this.value = sanitizedValue;
            }
            updateHiddenNrcInput();
        });
        
        updateNrcTownships();
    }
    
    function setupNrcApplyingLogic(prefix) {
        const checkbox = document.getElementById(`${prefix}_applying`);
        const nrcGroup = document.getElementById(`${prefix}_group`);
        const hiddenInput = document.getElementById(`${prefix}_hidden`);
        if (!checkbox || !nrcGroup || !hiddenInput) return;

        const nrcInputs = nrcGroup.querySelectorAll('select, input');

        const toggleNrcFields = (isApplying) => {
            nrcInputs.forEach(input => {
                input.disabled = isApplying;
                 if(isApplying) {
                    input.classList.add('bg-gray-100', 'cursor-not-allowed');
                } else {
                    input.classList.remove('bg-gray-100', 'cursor-not-allowed');
                }
            });

            if (isApplying) {
                hiddenInput.value = 'လျှောက်ထားဆဲ';
            } else {
                // When unchecking, trigger an input event on the number field
                // to force the hidden field's value to be recalculated by its existing listener.
                const numberInput = nrcGroup.querySelector(`input[name="${prefix}_number"]`);
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
        
        // Initial state on page load
        if (hiddenInput.value === 'လျှောက်ထားဆဲ') {
            checkbox.checked = true;
        }
        toggleNrcFields(checkbox.checked);
    }

    createNrcInputGroup('nrc_group', 'nrc');
    setupNrcApplyingLogic('nrc');
});
</script>

</body>
</html>

