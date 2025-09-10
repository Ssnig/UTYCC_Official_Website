<?php
session_start();
date_default_timezone_set('Asia/Yangon');
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
            $stmt = $pdo->prepare("
                SELECT * FROM pre_approved_students 
                WHERE sequence_no = :sequence_no AND seat_no = :seat_no AND student_name_mm = :student_name_mm AND nrc = :nrc AND dob = :dob
            ");
            $stmt->execute([
                ':sequence_no' => $sequence_no,
                ':seat_no' => $seat_no,
                ':student_name_mm' => $student_name_mm,
                ':nrc' => $nrc,
                ':dob' => $dob
            ]);
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($student) {
                if ($student['is_enrolled']) {
                    $errors[] = 'သင်သည် ကျောင်းအပ်နှံခြင်းလုပ်ငန်းစဉ်ကို ပြီးမြောက်ပြီးဖြစ်ပါသည်။';
                } else {
                    // Verification successful, store pre-approved data in session
                    $_SESSION['pre_approved_data'] = [
                        'id' => $student['id'],
                        'sequence_no' => $student['sequence_no'],
                        'seat_no' => $student['seat_no'],
                        'student_name_mm' => $student['student_name_mm'],
                        'nrc' => $student['nrc'],
                        'dob' => $student['dob']
                    ];

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
                <label for="nrc_group" class="block text-sm font-medium text-gray-700 mb-1">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</label>
                <div id="nrc_group" class="mt-1"></div>
                <input type="hidden" name="nrc" id="nrc_hidden">
            </div>

            <div>
                <label for="dob" class="block text-sm font-medium text-gray-700 mb-1">မွေးသက္ကရာဇ်</label>
                <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
            if (hiddenInput) {
                const state = stateSelect.value;
                const township = townshipSelect.value;
                const type = typeSelect.value;
                const number = numberInput.value;
                if (state && township && type && number.match(/^[၀-၉]{6}$/)) {
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

    createNrcInputGroup('nrc_group', 'nrc');
});
</script>

</body>
</html>

