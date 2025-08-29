<?php
    // Start a new session or resume an existing one
    session_start();

    // Define variables and initialize with empty values
    $year                 = $academic_year                 = $major                 = $seat_no                 = $uni_reg_no                 = $entry_year                 = "";
    $student_name_mm      = $father_name_mm      = $mother_name_mm      = "";
    $student_name_en      = $father_name_en      = $mother_name_en      = "";
    $student_race         = $father_race         = $mother_race         = "";
    $student_religion     = $father_religion     = $mother_religion     = "";
    $student_nrc          = $father_nrc          = $mother_nrc          = "";
    $student_nat_reg      = $father_nat_reg      = $mother_nat_reg      = "";
    $student_dob          = $student_birthplace          = "";
    $father_info          = $mother_info          = "";
    $father_deceased_year = $mother_deceased_year = "";
    $student_address      = $date      = "";
    $date                 = date('d-m-Y');
    $errors               = [];

    // --- Repopulate fields from POST data if available, otherwise from session ---
    // This ensures that on a validation error, the user's input is kept.
    function getValue($fieldName, $default = '')
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            return htmlspecialchars(trim($_POST[$fieldName] ?? $default));
        }
        return $_SESSION['form1_data'][$fieldName] ?? $default;
    }

    // Processing form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // --- Sanitize all POST data first ---
        $sanitized_post = [];
        foreach ($_POST as $key => $value) {
            $sanitized_post[$key] = htmlspecialchars(trim($value));
        }

        // --- Assign sanitized values to variables ---
        $year                 = $sanitized_post["year"] ?? '';
        $academic_year        = $sanitized_post["academic_year"] ?? '';
        $major                = $sanitized_post["major"] ?? '';
        $seat_no              = $sanitized_post["seat_no"] ?? '';
        $uni_reg_no           = $sanitized_post["uni_reg_no"] ?? '';
        $entry_year           = $sanitized_post["entry_year"] ?? '';
        $student_name_mm      = $sanitized_post["student_name_mm"] ?? '';
        $father_name_mm       = $sanitized_post["father_name_mm"] ?? '';
        $mother_name_mm       = $sanitized_post["mother_name_mm"] ?? '';
        $student_name_en      = $sanitized_post["student_name_en"] ?? '';
        $father_name_en       = $sanitized_post["father_name_en"] ?? '';
        $mother_name_en       = $sanitized_post["mother_name_en"] ?? '';
        $student_race         = $sanitized_post["student_race"] ?? '';
        $father_race          = $sanitized_post["father_race"] ?? '';
        $mother_race          = $sanitized_post["mother_race"] ?? '';
        $student_religion     = $sanitized_post["student_religion"] ?? '';
        $father_religion      = $sanitized_post["father_religion"] ?? '';
        $mother_religion      = $sanitized_post["mother_religion"] ?? '';
        $student_nrc          = $sanitized_post["student_nrc"] ?? '';
        $father_nrc           = $sanitized_post["father_nrc"] ?? '';
        $mother_nrc           = $sanitized_post["mother_nrc"] ?? '';
        $student_nat_reg      = $sanitized_post["student_nat_reg"] ?? '';
        $father_nat_reg       = $sanitized_post["father_nat_reg"] ?? '';
        $mother_nat_reg       = $sanitized_post["mother_nat_reg"] ?? '';
        $student_dob          = $sanitized_post["student_dob"] ?? '';
        $student_birthplace   = $sanitized_post["student_birthplace"] ?? '';
        $father_info          = $sanitized_post["father_info"] ?? '';
        $mother_info          = $sanitized_post["mother_info"] ?? '';
        $father_deceased_year = $sanitized_post["father_deceased_year"] ?? '';
        $mother_deceased_year = $sanitized_post["mother_deceased_year"] ?? '';
        $student_address      = $sanitized_post["student_address"] ?? '';
        $date                 = $sanitized_post["date"] ?? date('d-m-Y');

        // --- Validate Required Fields ---

        if (empty($academic_year)) {
            $errors['academic_year'] = "သင်တန်းနှစ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($major)) {
            $errors['major'] = "အထူးပြုဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($seat_no)) {
            $errors['seat_no'] = "ခုံအမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($uni_reg_no)) {
            $errors['uni_reg_no'] = "မှတ်ပုံတင်အမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        // Student, Father, Mother Info Validation
        if (empty($student_name_mm)) {
            $errors['student_name_mm'] = "ကျောင်းသား/သူ၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($father_name_mm)) {
            $errors['father_name_mm'] = "အဘ(အရင်း)၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($mother_name_mm)) {
            $errors['mother_name_mm'] = "အမိ(အရင်း)၏ အမည် (မြန်မာ) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_name_en)) {
            $errors['student_name_en'] = "ကျောင်းသား/သူ၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($father_name_en)) {
            $errors['father_name_en'] = "အဘ(အရင်း)၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($mother_name_en)) {
            $errors['mother_name_en'] = "အမိ(အရင်း)၏ အမည် (အင်္ဂလိပ်) ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_race)) {
            $errors['student_race'] = "ကျောင်းသား/သူ၏ လူမျိုးထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_religion)) {
            $errors['student_religion'] = "ကျောင်းသား/သူ၏ ကိုးကွယ်သည့်ဘာသာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_nrc)) {
            $errors['student_nrc'] = "ကျောင်းသား/သူ၏ နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        // Other required fields
        if (empty($student_dob)) {
            $errors['student_dob'] = "ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ်ထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_birthplace)) {
            $errors['student_birthplace'] = "မွေးဖွားရာဇာတိထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($student_address)) {
            $errors['student_address'] = "ဆက်သွယ်ရန်လိပ်စာထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        if (empty($date)) {
            $errors['date'] = "ရက်စွဲထည့်သွင်းရန်လိုအပ်ပါသည်။";
        }

        // If no errors, store all data in the session and redirect
        if (empty($errors)) {
            $_SESSION['form1_data'] = [
                'year'                 => $year,
                'academic_year'        => $academic_year,
                'major'                => $major,
                'seat_no'              => $seat_no,
                'uni_reg_no'           => $uni_reg_no,
                'entry_year'           => $entry_year,
                'student_name_mm'      => $student_name_mm,
                'father_name_mm'       => $father_name_mm,
                'mother_name_mm'       => $mother_name_mm,
                'student_name_en'      => $student_name_en,
                'father_name_en'       => $father_name_en,
                'mother_name_en'       => $mother_name_en,
                'student_race'         => $student_race,
                'father_race'          => $father_race,
                'mother_race'          => $mother_race,
                'student_religion'     => $student_religion,
                'father_religion'      => $father_religion,
                'mother_religion'      => $mother_religion,
                'student_nrc'          => $student_nrc,
                'father_nrc'           => $father_nrc,
                'mother_nrc'           => $mother_nrc,
                'student_nat_reg'      => $student_nat_reg,
                'father_nat_reg'       => $father_nat_reg,
                'mother_nat_reg'       => $mother_nat_reg,
                'student_dob'          => $student_dob,
                'student_birthplace'   => $student_birthplace,
                'father_info'          => $father_info,
                'mother_info'          => $mother_info,
                'father_deceased_year' => $father_deceased_year,
                'mother_deceased_year' => $mother_deceased_year,
                'student_address'      => $student_address,
                'date'                 => $date,
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
                    <input type="text" id="year" name="year" class="mt-1 w-24 text-center" value="<?php echo getValue('year'); ?>">
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
                        <input type="text" id="academic_year" name="academic_year" class="mt-1" value="<?php echo getValue('academic_year'); ?>">
                        <?php if (isset($errors['academic_year'])): ?>
                            <p class="error-message"><?php echo $errors['academic_year']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">အထူးပြုဘာသာ</label>
                        <input type="text" id="major" name="major" class="mt-1" value="<?php echo getValue('major'); ?>">
                        <?php if (isset($errors['major'])): ?>
                            <p class="error-message"><?php echo $errors['major']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="seat_no" class="block text-sm font-medium text-gray-700">ခုံအမှတ်</label>
                        <input type="text" id="seat_no" name="seat_no" class="mt-1" value="<?php echo getValue('seat_no'); ?>">
                        <?php if (isset($errors['seat_no'])): ?>
                            <p class="error-message"><?php echo $errors['seat_no']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="uni_reg_no" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်မှတ်ပုံတင်အမှတ်</label>
                        <input type="text" id="uni_reg_no" name="uni_reg_no" class="mt-1" value="<?php echo getValue('uni_reg_no'); ?>">
                        <?php if (isset($errors['uni_reg_no'])): ?>
                            <p class="error-message"><?php echo $errors['uni_reg_no']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="entry_year" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်ဝင်ရောက်သည့်နှစ်</label>
                        <input type="text" id="entry_year" name="entry_year" class="mt-1" value="<?php echo getValue('entry_year'); ?>">
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
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_name_mm" value="<?php echo getValue('student_name_mm'); ?>" required>
                                <?php if (isset($errors['student_name_mm'])): ?><p class="error-message"><?php echo $errors['student_name_mm']; ?></p><?php endif; ?>
                            </td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_name_mm" value="<?php echo getValue('father_name_mm'); ?>"required>
                                <?php if (isset($errors['father_name_mm'])): ?><p class="error-message"><?php echo $errors['father_name_mm']; ?></p><?php endif; ?>
                            </td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_name_mm" value="<?php echo getValue('mother_name_mm'); ?>" required>
                                <?php if (isset($errors['mother_name_mm'])): ?><p class="error-message"><?php echo $errors['mother_name_mm']; ?></p><?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>အမည် (အင်္ဂလိပ်စာဖြင့်)</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_name_en" value="<?php echo getValue('student_name_en'); ?>" required>
                                <?php if (isset($errors['student_name_en'])): ?><p class="error-message"><?php echo $errors['student_name_en']; ?></p><?php endif; ?>
                            </td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_name_en" value="<?php echo getValue('father_name_en'); ?>" required>
                                <?php if (isset($errors['father_name_en'])): ?><p class="error-message"><?php echo $errors['father_name_en']; ?></p><?php endif; ?>
                            </td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_name_en" value="<?php echo getValue('mother_name_en'); ?>" required>
                                <?php if (isset($errors['mother_name_en'])): ?><p class="error-message"><?php echo $errors['mother_name_en']; ?></p><?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">၂</td>
                            <td>လူမျိုး</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_race" value="<?php echo getValue('student_race'); ?>" required>
                                <?php if (isset($errors['student_race'])): ?><p class="error-message"><?php echo $errors['student_race']; ?></p><?php endif; ?>
                            </td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_race" value="<?php echo getValue('father_race'); ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_race" value="<?php echo getValue('mother_race'); ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၃</td>
                            <td>ကိုးကွယ်သည့်ဘာသာ</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_religion" value="<?php echo getValue('student_religion'); ?>" required>
                                <?php if (isset($errors['student_religion'])): ?><p class="error-message"><?php echo $errors['student_religion']; ?></p><?php endif; ?>
                            </td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_religion" value="<?php echo getValue('father_religion'); ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_religion" value="<?php echo getValue('mother_religion'); ?>" required></td>
                        </tr>
                        <tr>
                        <td class="text-center">၁</td>
                        <td>နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</td>
                        <!-- Student NRC Input -->
                        <td>
                            <div id="student_nrc_group" class="flex items-center space-x-1">
                                <!-- NRC fields will be generated by JavaScript -->
                            </div>
                            <!-- Hidden input to store concatenated NRC value -->
                            <input type="hidden" name="student_nrc" id="student_nrc_hidden">
                        </td>
                        <!-- Father NRC Input -->
                        <td>
                            <div id="father_nrc_group" class="flex items-center space-x-1">
                                <!-- NRC fields will be generated by JavaScript -->
                            </div>
                             <input type="hidden" name="father_nrc" id="father_nrc_hidden">
                        </td>
                        <!-- Mother NRC Input -->
                        <td>
                           <div id="mother_nrc_group" class="flex items-center space-x-1">
                                <!-- NRC fields will be generated by JavaScript -->
                           </div>
                            <input type="hidden" name="mother_nrc" id="mother_nrc_hidden">
                        </td>
                    </tr>
                        <tr>
                            <td class="text-center">၅</td>
                            <td>အမျိုးသားမှတ်ပုံတင်အမှတ်</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_nat_reg" value="<?php echo getValue('student_nat_reg'); ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_nat_reg" value="<?php echo getValue('father_nat_reg'); ?>" required></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_nat_reg" value="<?php echo getValue('mother_nat_reg'); ?>" required></td>
                        </tr>
                        <tr>
                    <td class="text-center align-top pt-5 w-16">၆</td>
                    <td colspan="4" class="whitespace-normal">
                        <!-- Label for the input field -->
                        <label for="student_dob" class="font-medium">
                            ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ် (တက္ကသိုလ်ဝင်တန်းစာမေးပွဲဖြေဆိုစဉ်က ဖော်ပြသည့် အတိုင်းရေးရန်)
                        </label>

                        <!-- Date input field. Type="date" provides a native calendar picker. -->
                        <input type="date" id="student_dob" name="student_dob"
                               value="<?php echo getValue('student_dob'); ?>" required>

                        <!-- Container for client-side JavaScript validation error messages -->
                        <p id="dob_error_client" class="error-message" style="display: none;"></p>

                        <!-- Container for server-side PHP validation error messages -->
                        <?php if (isset($errors['student_dob'])): ?>
                            <p class="error-message"><?php echo $errors['student_dob']; ?></p>
                        <?php endif; ?>
                    </td>
                </tr>
                        <tr>
                        <td class="text-center align-top w-16">၇</td>
                        <td colspan="4">
                            <label for="state_region" class="font-medium">မွေးဖွားရာဇာတိ (တိုင်းဒေသကြီး/ပြည်နယ်)</label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- State/Region Dropdown -->
                                <div>
                                    <select id="state_region" name="state_region" required>
                                        <option value="" disabled selected>တိုင်းဒေသကြီး/ပြည်နယ် ရွေးချယ်ပါ</option>
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>

                                <!-- Township Dropdown -->
                                <div>
                                    <select id="township" name="township" required>
                                        <option value="" disabled selected>မြို့နယ် ရွေးချယ်ပါ</option>
                                        <!-- Options will be populated based on state/region selection -->
                                    </select>
                                </div>
                            </div>

                            <!-- Example of how you might show an error message -->
                            <?php if (isset($errors['student_birthplace'])): ?>
                                <p class="error-message"><?php echo $errors['student_birthplace']; ?></p>
                            <?php endif; ?>
                        </td>
                    </tr>
                        <tr>
                            <td class="text-center">၈</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_phone"
                                    class="font-medium">ဆက်သွယ်ရန်ဖုန်းနံပါတ်</label>
                                <input 
            type="tel" 
            id="student_phone" 
            name="student_phone"
            class="mt-1" 
            value="<?php echo getValue('student_phone'); ?>" 
            required
            pattern="09\d{7,9}"
            maxlength="11"
            placeholder="09xxxxxxxxx"
            title="Please enter a valid Myanmar phone number starting with 09." required>
                                <?php if (isset($errors['student_phone'])): ?><p class="error-message"><?php echo $errors['student_phone']; ?></p><?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">၉</td>
                            <td class="align-top font-medium" style="white-space: normal;">
                                မိဘအလုပ်အကိုင်</td>
                            <td></td>
                            <td><textarea name="father_info" rows="3"
                                    placeholder="အဘ(အရင်း)၏ အချက်အလက်များ" class="border-0"
                                    style="white-space: normal;"><?php echo getValue('father_info'); ?></textarea></td>
                            <td><textarea name="mother_info" rows="3"
                                    placeholder="အမိ(အရင်း)၏ အချက်အလက်များ" class="border-0"
                                    style="white-space: normal;"><?php echo getValue('mother_info'); ?></textarea></td>
                        </tr>
                        <tr>
                            <td class="text-center">၁၀</td>
                            <td class="align-top font-medium" style="white-space: normal;">
                                မိဘနေရပ်လိပ်စာအပြည့်အစုံ</td>
                            <td></td>
                            <td><textarea name="father_address" rows="3"
                                    placeholder="အဘ(အရင်း)၏ အချက်အလက်များ" class="border-0"
                                    style="white-space: normal;"><?php echo getValue('father_info'); ?></textarea></td>
                            <td><textarea name="mother_info" rows="3"
                                    placeholder="အမိ(အရင်း)၏ အချက်အလက်များ" class="border-0"
                                    style="white-space: normal;"><?php echo getValue('mother_info'); ?></textarea></td>
                        </tr>
                        <tr>
                            <td class="text-center">၁၁</td>
                            <td class="align-top font-medium" style="white-space: normal;">
                                မိဘဖုန်းနံပါတ်</td>
                            <td></td>
                            <td><input type="number" name="father_phone" rows="3"
                                    placeholder="အဘ(အရင်း)၏ အချက်အလက်များ" class="border-0"
                                    style="white-space: normal;"><?php echo getValue('father_phone'); ?></input type="number"></td>
                            <td><input type="number" name="mother_phone" rows="3"
                                    placeholder="အမိ(အရင်း)၏ အချက်အလက်များ" class="border-0"
                                    style="white-space: normal;"><?php echo getValue('mother_phone'); ?></input type="number"></td>
                        </tr>
                        <tr>
                            <td class="text-center">၁၂</td>
                            <td>ကွယ်လွန်ခဲ့လျှင်ကွယ်လွန်ခဲ့သည့်ခုနှစ်</td>
                            <td></td>
                            <td><input type="text" placeholder="_______________________" class="border-0"
                                    name="father_deceased_year" value="<?php echo getValue('father_deceased_year'); ?>" required></td>
                            <td><input type="text" placeholder="_______________________" class="border-0"
                                    name="mother_deceased_year" value="<?php echo getValue('mother_deceased_year'); ?>" required></td>
                        </tr>
                        <tr>
                            <td class="text-center">၁၃</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_address" class="font-medium">ကျောင်းသား/သူထံအမြဲတမ်း ဆက်သွယ်ရန်လိပ်စာ
                                    အပြည့်အစုံ</label>
                                <textarea id="student_address" name="student_address" rows="3" class="mt-1"
                                    style="white-space: normal;"><?php echo getValue('student_address'); ?></textarea>
                                <?php if (isset($errors['student_address'])): ?><p class="error-message"><?php echo $errors['student_address']; ?></p><?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">၁၄</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_address" class="font-medium">
                                    ဖုန်းနံပါတ်</label>
                                <input type="number" id="student_phone2" name="student_phone2" rows="3" class="mt-1"
                                    style="white-space: normal;"><?php echo getValue('student_phone2'); ?></input type="number">
                                <?php if (isset($errors['student_phone2'])): ?><p class="error-message"><?php echo $errors['student_phone2']; ?></p><?php endif; ?>
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
                        <input type="text" id="date" name="date" class="mt-1" placeholder="ဥပမာ - 16-08-2024" value="<?php echo getValue('date', date('d-m-Y')); ?>" required>
                        <?php if (isset($errors['date'])): ?><p class="error-message"><?php echo $errors['date']; ?></p><?php endif; ?>
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
<script>
        // Wait for the document to be fully loaded before running the script
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('student-form');
            const dobInput = document.getElementById('student_dob');
            const errorContainer = document.getElementById('dob_error_client');

            // --- Set min and max selectable dates ---
            const today = new Date();
            // Set the latest selectable date to today
            const maxDate = today.toISOString().split('T')[0];
            dobInput.setAttribute('max', maxDate);

            // Set the earliest selectable date to 100 years ago
            const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate()).toISOString().split('T')[0];
            dobInput.setAttribute('min', minDate);

            // --- Validation Function ---
            const validateDateOfBirth = () => {
                // Hide previous error messages
                errorContainer.style.display = 'none';
                errorContainer.textContent = '';

                const dobValue = dobInput.value;
                // Check if a date is selected
                if (!dobValue) {
                    errorContainer.textContent = 'မွေးသက္ကရာဇ်ထည့်သွင်းရန်လိုအပ်ပါသည်။';
                    errorContainer.style.display = 'block';
                    return false;
                }

                const birthDate = new Date(dobValue);
                const currentDate = new Date();

                // This check is redundant due to the 'max' attribute but good for robustness
                if (birthDate > currentDate) {
                    errorContainer.textContent = 'မွေးသက္ကရာဇ်သည် ယနေ့ထက်နောက်ကျ၍မရပါ။';
                    errorContainer.style.display = 'block';
                    return false;
                }

                // --- Age Calculation ---
                let age = currentDate.getFullYear() - birthDate.getFullYear();
                const monthDifference = currentDate.getMonth() - birthDate.getMonth();
                // Adjust age if the birth month/day hasn't occurred yet this year
                if (monthDifference < 0 || (monthDifference === 0 && currentDate.getDate() < birthDate.getDate())) {
                    age--;
                }

                // --- Age Validation Rules ---
                // Example: Ensure the student is at least 16 years old
                if (age < 16) {
                    errorContainer.textContent = 'အသက် ၁၆ နှစ်ပြည့်ပြီးသူဖြစ်ရပါမည်။';
                    errorContainer.style.display = 'block';
                    return false;
                }

                // This check is redundant due to the 'min' attribute but good for robustness
                if (age > 100) {
                    errorContainer.textContent = 'ထည့်သွင်းထားသော အသက်သည် မှန်ကန်မှုမရှိပါ။';
                    errorContainer.style.display = 'block';
                    return false;
                }

                // If all checks pass, validation is successful
                return true;
            };

            // --- Event Listeners ---
            if (form) {
                // Validate before the form is submitted
                form.addEventListener('submit', function(event) {
                    if (!validateDateOfBirth()) {
                        // Prevent the form from submitting if validation fails
                        event.preventDefault();
                    }
                });
            }

            // Provide immediate feedback when the user changes the date
            dobInput.addEventListener('input', validateDateOfBirth);
        });

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

        // Get the select elements from the DOM
        const stateRegionSelect = document.getElementById('state_region');
        const townshipSelect = document.getElementById('township');

        // Function to populate the state/region dropdown
        function populateStates() {
            // Get all state/region names from our data
            const states = Object.keys(locationData);

            // Create an option element for each state/region and add it to the select box
            states.forEach(state => {
                const option = document.createElement('option');
                option.value = state;
                option.textContent = state;
                stateRegionSelect.appendChild(option);
            });
        }

        // Function to update the township dropdown based on the selected state/region
        function updateTownships() {
            // Get the selected state/region value
            const selectedState = stateRegionSelect.value;

            // Clear previous township options
            townshipSelect.innerHTML = '<option value="" disabled selected>မြို့နယ် ရွေးချယ်ပါ</option>';

            // If a valid state/region is selected
            if (selectedState && locationData[selectedState]) {
                // Get the list of townships for the selected state
                const townships = locationData[selectedState];

                // Create and add an option for each township
                townships.forEach(township => {
                    const option = document.createElement('option');
                    option.value = township;
                    option.textContent = township;
                    townshipSelect.appendChild(option);
                });
                // Enable the township dropdown
                townshipSelect.disabled = false;
            } else {
                // If no state is selected, disable the township dropdown
                townshipSelect.disabled = true;
            }
        }

        // Add an event listener to the state/region dropdown.
        // When the user changes the selection, the updateTownships function will run.
        stateRegionSelect.addEventListener('change', updateTownships);

        // Initial setup when the page loads
        window.onload = function() {
            populateStates(); // Fill the state/region dropdown
            updateTownships(); // Set the initial state of the township dropdown (which will be disabled)
        };

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

        // NRC types
        const nrcTypes = ["နိုင်", "ဧည့်", "ပြု", "သာ", "ယာယီ"];

        /**
         * Creates and initializes a set of NRC input fields.
         * @param {string} containerId - The ID of the container element for the NRC inputs.
         * @param {string} namePrefix - The prefix for the input names.
         */
        function createNrcInputGroup(containerId, namePrefix) {
            const container = document.getElementById(containerId);
            if (!container) return;

            // 1. State/Region Dropdown
            const stateSelect = document.createElement('select');
            stateSelect.name = `${namePrefix}_state`;
            stateSelect.className = 'nrc-select w-1/4';
            for (let i = 1; i <= 14; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                stateSelect.appendChild(option);
            }

            // 2. Township Dropdown
            const townshipSelect = document.createElement('select');
            townshipSelect.name = `${namePrefix}_township`;
            townshipSelect.className = 'nrc-select w-1/3';

            // 3. Type Dropdown
            const typeSelect = document.createElement('select');
            typeSelect.name = `${namePrefix}_type`;
            typeSelect.className = 'nrc-select w-1/4';
            nrcTypes.forEach(type => {
                const option = document.createElement('option');
                option.value = `(${type})`;
                option.textContent = `(${type})`;
                typeSelect.appendChild(option);
            });

            // 4. Number Input
            const numberInput = document.createElement('input');
            numberInput.type = 'text';
            numberInput.name = `${namePrefix}_number`;
            numberInput.className = 'nrc-number w-1/2';
            numberInput.placeholder = '123456';
            numberInput.maxLength = 6;
            numberInput.pattern = '\\d{6}'; // Ensures 6 digits
            numberInput.required = true;

            // Add all elements to the container
            container.append(stateSelect, townshipSelect, typeSelect, numberInput);
            
            // Function to update townships based on selected state
            const updateTownships = () => {
                const selectedState = stateSelect.value;
                const townships = nrcTownships[selectedState] || [];
                
                // Clear existing options
                townshipSelect.innerHTML = '';

                // Populate new options
                townships.forEach(township => {
                    const option = document.createElement('option');
                    option.value = township;
                    option.textContent = township;
                    townshipSelect.appendChild(option);
                });
                updateHiddenInput(); // Update hidden field when township changes
            };
            
            // Function to update the hidden input with the full NRC string
            const updateHiddenInput = () => {
                const hiddenInput = document.getElementById(`${namePrefix}_hidden`);
                if (hiddenInput) {
                    const state = stateSelect.value;
                    const township = townshipSelect.value;
                    const type = typeSelect.value;
                    const number = numberInput.value;
                    if (state && township && type && number.length === 6) {
                         hiddenInput.value = `${state}/${township}${type}${number}`;
                    } else {
                        hiddenInput.value = ''; // Clear if not complete
                    }
                }
            };

            // Event Listeners
            stateSelect.addEventListener('change', updateTownships);
            townshipSelect.addEventListener('change', updateHiddenInput);
            typeSelect.addEventListener('change', updateHiddenInput);
            numberInput.addEventListener('input', updateHiddenInput);

            // Initial population of townships
            updateTownships();
        }

        // Initialize all NRC input groups when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            createNrcInputGroup('student_nrc_group', 'student_nrc');
            createNrcInputGroup('father_nrc_group', 'father_nrc');
            createNrcInputGroup('mother_nrc_group', 'mother_nrc');
        });
        
        // Handle form submission for demonstration
        document.getElementById('nrc-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent actual submission
            const studentNrc = document.getElementById('student_nrc_hidden').value;
            const fatherNrc = document.getElementById('father_nrc_hidden').value;
            const motherNrc = document.getElementById('mother_nrc_hidden').value;
            
            alert(`
                ကျောင်းသား/သူ NRC: ${studentNrc || 'မပြည့်စုံပါ'}
                အဘ NRC: ${fatherNrc || 'မပြည့်စုံပါ'}
                အမိ NRC: ${motherNrc || 'မပြည့်စုံပါ'}
            `);
        });
    </script>