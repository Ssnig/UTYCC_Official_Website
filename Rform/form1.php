<?php
// Start a new session or resume an existing one
session_start();

// Define variables and initialize with empty values
$year = $academic_year = $major = $seat_no = $uni_reg_no = $entry_year = "";
$student_name_mm = $father_name_mm = $mother_name_mm = "";
$student_name_en = $father_name_en = $mother_name_en = "";
$student_race = $father_race = $mother_race = "";
$student_religion = $father_religion = $mother_religion = "";
$student_nrc = $father_nrc = $mother_nrc = "";
$student_nat_reg = $father_nat_reg = $mother_nat_reg = "";
$student_dob = $student_birthplace = "";
$father_info = $mother_info = "";
$father_deceased_year = $mother_deceased_year = "";
$student_address = $date = "";
$errors = [];

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Validate and sanitize input fields ---

    // Validate Academic Year
    if (empty(trim($_POST["academic_year"]))) {
        $errors['academic_year'] = "သင်တန်းနှစ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    } else {
        $academic_year = htmlspecialchars(trim($_POST["academic_year"]));
    }
    
    // Validate Major
    if (empty(trim($_POST["major"]))) {
        $errors['major'] = "အထူးပြုဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
    } else {
        $major = htmlspecialchars(trim($_POST["major"]));
    }
    
    // Validate Seat Number
    if (empty(trim($_POST["seat_no"]))) {
        $errors['seat_no'] = "ခုံအမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    } else {
        $seat_no = htmlspecialchars(trim($_POST["seat_no"]));
    }
    
    // Validate University Registration Number
    if (empty(trim($_POST["uni_reg_no"]))) {
        $errors['uni_reg_no'] = "မှတ်ပုံတင်အမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    } else {
        $uni_reg_no = htmlspecialchars(trim($_POST["uni_reg_no"]));
    }

    // Validate Student's Name (Myanmar)
    if (empty(trim($_POST["student_name_mm"]))) {
        $errors['student_name_mm'] = "အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
    } else {
        $student_name_mm = htmlspecialchars(trim($_POST["student_name_mm"]));
    }

    // Sanitize all other fields (no required validation for them, but it's good practice to clean the data)
    $year = htmlspecialchars(trim($_POST["year"] ?? ''));
    $entry_year = htmlspecialchars(trim($_POST["entry_year"] ?? ''));
    $father_name_mm = htmlspecialchars(trim($_POST["father_name_mm"] ?? ''));
    $mother_name_mm = htmlspecialchars(trim($_POST["mother_name_mm"] ?? ''));
    $student_name_en = htmlspecialchars(trim($_POST["student_name_en"] ?? ''));
    $father_name_en = htmlspecialchars(trim($_POST["father_name_en"] ?? ''));
    $mother_name_en = htmlspecialchars(trim($_POST["mother_name_en"] ?? ''));
    $student_race = htmlspecialchars(trim($_POST["student_race"] ?? ''));
    $father_race = htmlspecialchars(trim($_POST["father_race"] ?? ''));
    $mother_race = htmlspecialchars(trim($_POST["mother_race"] ?? ''));
    $student_religion = htmlspecialchars(trim($_POST["student_religion"] ?? ''));
    $father_religion = htmlspecialchars(trim($_POST["father_religion"] ?? ''));
    $mother_religion = htmlspecialchars(trim($_POST["mother_religion"] ?? ''));
    $student_nrc = htmlspecialchars(trim($_POST["student_nrc"] ?? ''));
    $father_nrc = htmlspecialchars(trim($_POST["father_nrc"] ?? ''));
    $mother_nrc = htmlspecialchars(trim($_POST["mother_nrc"] ?? ''));
    $student_nat_reg = htmlspecialchars(trim($_POST["student_nat_reg"] ?? ''));
    $father_nat_reg = htmlspecialchars(trim($_POST["father_nat_reg"] ?? ''));
    $mother_nat_reg = htmlspecialchars(trim($_POST["mother_nat_reg"] ?? ''));
    $student_dob = htmlspecialchars(trim($_POST["student_dob"] ?? ''));
    $student_birthplace = htmlspecialchars(trim($_POST["student_birthplace"] ?? ''));
    $father_info = htmlspecialchars(trim($_POST["father_info"] ?? ''));
    $mother_info = htmlspecialchars(trim($_POST["mother_info"] ?? ''));
    $father_deceased_year = htmlspecialchars(trim($_POST["father_deceased_year"] ?? ''));
    $mother_deceased_year = htmlspecialchars(trim($_POST["mother_deceased_year"] ?? ''));
    $student_address = htmlspecialchars(trim($_POST["student_address"] ?? ''));
    $date = htmlspecialchars(trim($_POST["date"] ?? ''));

    // If no errors, store all data in the session and redirect
    if (empty($errors)) {
        $_SESSION['form1_data'] = [
            'year' => $year,
            'academic_year' => $academic_year,
            'major' => $major,
            'seat_no' => $seat_no,
            'uni_reg_no' => $uni_reg_no,
            'entry_year' => $entry_year,
            'student_name_mm' => $student_name_mm,
            'father_name_mm' => $father_name_mm,
            'mother_name_mm' => $mother_name_mm,
            'student_name_en' => $student_name_en,
            'father_name_en' => $father_name_en,
            'mother_name_en' => $mother_name_en,
            'student_race' => $student_race,
            'father_race' => $father_race,
            'mother_race' => $mother_race,
            'student_religion' => $student_religion,
            'father_religion' => $father_religion,
            'mother_religion' => $mother_religion,
            'student_nrc' => $student_nrc,
            'father_nrc' => $father_nrc,
            'mother_nrc' => $mother_nrc,
            'student_nat_reg' => $student_nat_reg,
            'father_nat_reg' => $father_nat_reg,
            'mother_nat_reg' => $mother_nat_reg,
            'student_dob' => $student_dob,
            'student_birthplace' => $student_birthplace,
            'father_info' => $father_info,
            'mother_info' => $mother_info,
            'father_deceased_year' => $father_deceased_year,
            'mother_deceased_year' => $mother_deceased_year,
            'student_address' => $student_address,
            'date' => $date
        ];
        
        header("location: form2.php");
        exit;
       
    }
}
?>

<?php include 'formPartial/header.php'; ?>

    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
        <div class="max-w-4xl mx-auto bg-white p-3 py-3 sm:p-6 md:p-8 rounded-lg shadow-lg">

            <div class="flex justify-between items-start mb-4 ">
                <p class="text-sm">Form No. UTYCC-20</p>
                <div class="text-right">
                    <label for="year" class="block text-sm font-medium text-gray-700">ခုနှစ်</label>
                    <input type="text" id="year" name="year" class="mt-1 w-24 text-center" value="<?php echo $_SESSION['form1_data']['year'] ?? ''; ?>">
                </div>
            </div>

            <div class="text-center mb-6">
                <h1 class="text-lg sm:text-xl md:text-2xl font-bold">ကျောင်းသားအဖြစ်မှ မှတ်ပုံတင်ခွင့်တောင်းခံလွှာ</h1>
                <h2 class="text-base sm:text-lg md:text-xl font-semibold text-gray-700 mt-1">
                    နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="academic_year" class="block text-sm font-medium text-gray-700">သင်တန်းနှစ်</label>
                        <input type="text" id="academic_year" name="academic_year" class="mt-1" value="<?php echo $_SESSION['form1_data']['academic_year'] ?? ''; ?>">
                        <?php if (isset($errors['academic_year'])): ?>
                            <p class="error-message"><?php echo $errors['academic_year']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">အထူးပြုဘာသာ</label>
                        <input type="text" id="major" name="major" class="mt-1" value="<?php echo $_SESSION['form1_data']['major'] ?? ''; ?>">
                        <?php if (isset($errors['major'])): ?>
                            <p class="error-message"><?php echo $errors['major']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="seat_no" class="block text-sm font-medium text-gray-700">ခုံအမှတ်</label>
                        <input type="text" id="seat_no" name="seat_no" class="mt-1" value="<?php echo $_SESSION['form1_data']['seat_no'] ?? ''; ?>">
                        <?php if (isset($errors['seat_no'])): ?>
                            <p class="error-message"><?php echo $errors['seat_no']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="uni_reg_no" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်မှတ်ပုံတင်အမှတ်</label>
                        <input type="text" id="uni_reg_no" name="uni_reg_no" class="mt-1" value="<?php echo $_SESSION['form1_data']['uni_reg_no'] ?? ''; ?>">
                        <?php if (isset($errors['uni_reg_no'])): ?>
                            <p class="error-message"><?php echo $errors['uni_reg_no']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="entry_year" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်ဝင်ရောက်သည့်နှစ်</label>
                        <input type="text" id="entry_year" name="entry_year" class="mt-1" value="<?php echo $_SESSION['form1_data']['entry_year'] ?? ''; ?>">
                    </div>
                </div>
                <div id="photo-upload-area"
                    class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-2 h-48">
                    <div id="photo-placeholder" class="text-center">
                        <span class="text-gray-500">ဓါတ်ပုံကပ်ရန်</span>
                        <button type="button" onclick="document.getElementById('photo_upload').click()"
                            class="mt-2 block mx-auto px-3 py-1 text-sm bg-gray-200 rounded-md hover:bg-gray-300">Upload</button>
                    </div>
                    <div id="photo-preview-container" class="hidden w-full h-full">
                        <img id="photo-preview" src="#" alt="Photo Preview">
                        <div id="remove-photo-btn" title="Remove Photo">×</div>
                    </div>
                    <input type="file" class="hidden" id="photo_upload" name="photo_upload" accept="image/*">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-base">
                        <tr>
                            <th class="w-12 text-center">စဉ်</th>
                            <th>အကြောင်းအရာ</th>
                            <th>ကျောင်းသား/သူ</th>
                            <th>အဘ(အရင်း)</th>
                            <th>အမိ(အရင်း)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="2" class="text-center align-middle">၁</td>
                            <td>အမည် (မြန်မာစာဖြင့်)</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_name_mm" value="<?php echo $_SESSION['form1_data']['student_name_mm'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_name_mm" value="<?php echo $_SESSION['form1_data']['father_name_mm'] ?? ''; ?>"required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_name_mm" value="<?php echo $_SESSION['form1_data']['mother_name_mm'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td>အမည် (အင်္ဂလိပ်စာဖြင့်)</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_name_en" value="<?php echo $_SESSION['form1_data']['student_name_en'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_name_en" value="<?php echo $_SESSION['form1_data']['father_name_en'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_name_en" value="<?php echo $_SESSION['form1_data']['mother_name_en'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၂</td>
                            <td>လူမျိုး</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_race" value="<?php echo $_SESSION['form1_data']['student_race'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_race" value="<?php echo $_SESSION['form1_data']['father_race'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_race" value="<?php echo $_SESSION['form1_data']['mother_race'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၃</td>
                            <td>ကိုးကွယ်သည့်ဘာသာ</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_religion" value="<?php echo $_SESSION['form1_data']['student_religion'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_religion" value="<?php echo $_SESSION['form1_data']['father_religion'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_religion" value="<?php echo $_SESSION['form1_data']['mother_religion'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၄</td>
                            <td>နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_nrc" value="<?php echo $_SESSION['form1_data']['student_nrc'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_nrc" value="<?php echo $_SESSION['form1_data']['father_nrc'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_nrc" value="<?php echo $_SESSION['form1_data']['mother_nrc'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၅</td>
                            <td>အမျိုးသားမှတ်ပုံတင်အမှတ်</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_nat_reg" value="<?php echo $_SESSION['form1_data']['student_nat_reg'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_nat_reg" value="<?php echo $_SESSION['form1_data']['father_nat_reg'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_nat_reg" value="<?php echo $_SESSION['form1_data']['mother_nat_reg'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၆</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_dob" class="font-medium">ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ်
                                    (တက္ကသိုလ်ဝင်တန်းစာမေးပွဲဖြေဆိုစဉ်က ဖော်ပြသည့် အတိုင်းရေးရန်)</label>
                                <input type="text" id="student_dob" name="student_dob" class="mt-1"
                                    placeholder="ဥပမာ - 01-01-2000" value="<?php echo $_SESSION['form1_data']['student_dob'] ?? ''; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">၇</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_birthplace"
                                    class="font-medium">မွေးဖွားရာဇာတိမြို့/ပြည်နယ်/ဖုန်းနံပါတ်</label>
                                <input type="text" id="student_birthplace" name="student_birthplace" class="mt-1" value="<?php echo $_SESSION['form1_data']['student_birthplace'] ?? ''; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">၈</td>
                            <td class="align-top font-medium" style="white-space: normal;">
                                မိဘအလုပ်အကိုင်နှင့်<br>နေရပ်လိပ်စာအပြည့်အစုံ/<br>ဖုန်းနံပါတ်</td>
                            <td></td>
                            <td><textarea name="father_info" rows="3"
                                    placeholder="အဘ(အရင်း)၏ အချက်အလက်များ_________________" class="border-0"
                                    style="white-space: normal;"><?php echo $father_info; ?></textarea></td>
                            <td><textarea name="mother_info" rows="3"
                                    placeholder="အမိ(အရင်း)၏ အချက်အလက်များ___________________" class="border-0"
                                    style="white-space: normal;"><?php echo $mother_info; ?></textarea></td>
                        </tr>
                        <tr>
                            <td class="text-center">၉</td>
                            <td>ကွယ်လွန်ခဲ့လျှင်ကွယ်လွန်ခဲ့သည့်ခုနှစ်</td>
                            <td></td>
                            <td><input type="text" placeholder="_______________________" class="border-0"
                                    name="father_deceased_year" value="<?php echo $_SESSION['form1_data']['father_deceased_year'] ?? ''; ?>" required></td>
                            <td><input type="text" placeholder="_______________________" class="border-0"
                                    name="mother_deceased_year" value="<?php echo $_SESSION['form1_data']['mother_deceased_year'] ?? ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၁၀</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_address" class="font-medium">ကျောင်းသား/သူထံအမြဲတမ်း ဆက်သွယ်ရန်လိပ်စာ
                                    အပြည့်အစုံ/ဖုန်းနံပါတ်</label>
                                <textarea id="student_address" name="student_address" rows="3" class="mt-1"
                                    style="white-space: normal;"><?php echo $student_address; ?></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                <p class="text-sm">ဖော်ပြပါအချက်အလက်များမှန်ကန်ကြောင်း ခံဝန်ကတိပြုပါသည်။ တစ်စုံတစ်ရာမှားယွင်းချက်ရှိပါက
                    ကျွန်တော်/ကျွန်မ တာဝန်သာ ဖြစ်ပါသည်။</p>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end mt-12 gap-8 sm:gap-4">
                    <div class="w-full sm:w-auto">
                        <label for="date" class="block text-sm">ရက်စွဲ</label>
                        <input type="text" id="date" name="date" class="mt-1" placeholder="ဥပမာ - 16-08-2024" value="<?php echo $_SESSION['form1_data']['date'] ?? ''; ?>" required>
                    </div>
                    <div class="w-full sm:w-1/3">
                        <div class="border-t border-gray-400 pt-1 text-center text-sm">(ကျောင်းသား/သူ၏ထိုးမြဲလက်မှတ်)</div>
                    </div>
                </div>
            </div>

            <div class="nav-buttons">
                <a href="#" class="nav-button disabled-button">Back</a>
                <button type="submit" class="nav-button">Next</button>
            </div>

            <div class="text-right text-xs text-gray-400 mt-6">
                <p>UTYCC/ SA/ F-20/ Rev-0/31-10-2022</p>
            </div>
        </div>
    </form>
    <br>

    <?php include 'formPartial/footer.php'; ?>   