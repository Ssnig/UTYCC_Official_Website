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

<!DOCTYPE html>
<html lang="my">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../CSS/footer.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/font.css" />
    <title>Student's Registration Form 1</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Padauk:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="form.css">
    <style>
        body {
            font-family: 'Padauk', 'Inter', sans-serif;
        }

        /* Custom styles for better table borders */
        table,
        th,
        td {
            border: 1px solid #e5e7eb;
            /* gray-200 */
        }

        th,
        td {
            padding: 0.75rem;
            /* p-3 */
            text-align: left;
            white-space: nowrap;
            /* Prevent text wrapping in table cells */
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            /* gray-300 */
            border-radius: 0.375rem;
            /* rounded-md */
            padding: 0.5rem;
            /* p-2 */
            transition: border-color 0.2s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            /* blue-500 */
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        #photo-preview-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        #photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.375rem;
        }

        #remove-photo-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 9999px;
            width: 1.75rem;
            height: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center space-x-3">
                <div class="p-2 rounded-lg">
                    <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
                </div>
                <div>
                    <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
                    <span class="text-xs text-gray-500" data-lang-key="utycc_full_name">University of Technology (Yatanarpon Cyber
                        City)</span>
                </div>
            </a>
            <div class="hidden md:flex items-center space-x-6">
                <a href="#about" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_about">About Us</a>
                <a href="#programs" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_programs">Academic Programs</a>
                <a href="#collaboration" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_collaboration">Collaboration</a>
                <a href="#contact" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_contact">Contact</a>

                <div class="relative ml-4">
                    <div class="relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                        <i class="fas fa-globe text-gray-500 absolute left-3 z-10 pointer-events-none"></i>
                        <select id="language-switcher"
                            class="cursor-pointer appearance-none bg-transparent text-gray-700 font-medium rounded-full py-1.5 pl-9 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="my">မြန်မာ</option>
                            <option value="en">English</option>
                        </select>
                        <i
                            class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 z-10 pointer-events-none"></i>
                    </div>
                </div>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-blue-900">
                <i class="fas fa-bars text-2xl" id="menu-icon"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden px-6 pb-4 border-t md:hidden">
            <a href="#about" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_about_mobile">About Us</a>
            <a href="#programs" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_programs_mobile">Academic Programs</a>
            <a href="#collaboration" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_collaboration_mobile">Collaboration</a>
            <a href="#contact" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_contact_mobile">Contact</a>
        </div>
    </div>

    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
        <div class="max-w-4xl mx-auto bg-white p-3 py-3 sm:p-6 md:p-8 rounded-lg shadow-lg">

            <div class="flex justify-between items-start mb-4 ">
                <p class="text-sm">Form No. UTYCC-20</p>
                <div class="text-right">
                    <label for="year" class="block text-sm font-medium text-gray-700">ခုနှစ်</label>
                    <input type="text" id="year" name="year" class="mt-1 w-24 text-center" value="<?php echo $year; ?>">
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
                        <input type="text" id="academic_year" name="academic_year" class="mt-1" value="<?php echo $academic_year; ?>">
                        <?php if (isset($errors['academic_year'])): ?>
                            <p class="error-message"><?php echo $errors['academic_year']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">အထူးပြုဘာသာ</label>
                        <input type="text" id="major" name="major" class="mt-1" value="<?php echo $major; ?>">
                        <?php if (isset($errors['major'])): ?>
                            <p class="error-message"><?php echo $errors['major']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="seat_no" class="block text-sm font-medium text-gray-700">ခုံအမှတ်</label>
                        <input type="text" id="seat_no" name="seat_no" class="mt-1" value="<?php echo $seat_no; ?>">
                        <?php if (isset($errors['seat_no'])): ?>
                            <p class="error-message"><?php echo $errors['seat_no']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label for="uni_reg_no" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်မှတ်ပုံတင်အမှတ်</label>
                        <input type="text" id="uni_reg_no" name="uni_reg_no" class="mt-1" value="<?php echo $uni_reg_no; ?>">
                        <?php if (isset($errors['uni_reg_no'])): ?>
                            <p class="error-message"><?php echo $errors['uni_reg_no']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="entry_year" class="block text-sm font-medium text-gray-700">တက္ကသိုလ်ဝင်ရောက်သည့်နှစ်</label>
                        <input type="text" id="entry_year" name="entry_year" class="mt-1" value="<?php echo $entry_year; ?>">
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
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_name_mm" value="<?php echo $student_name_mm; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_name_mm" value="<?php echo $father_name_mm; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_name_mm" value="<?php echo $mother_name_mm; ?>"></td>
                        </tr>
                        <tr>
                            <td>အမည် (အင်္ဂလိပ်စာဖြင့်)</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_name_en" value="<?php echo $student_name_en; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_name_en" value="<?php echo $father_name_en; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_name_en" value="<?php echo $mother_name_en; ?>"></td>
                        </tr>
                        <tr>
                            <td class="text-center">၂</td>
                            <td>လူမျိုး</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_race" value="<?php echo $student_race; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_race" value="<?php echo $father_race; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_race" value="<?php echo $mother_race; ?>"></td>
                        </tr>
                        <tr>
                            <td class="text-center">၃</td>
                            <td>ကိုးကွယ်သည့်ဘာသာ</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_religion" value="<?php echo $student_religion; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_religion" value="<?php echo $father_religion; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_religion" value="<?php echo $mother_religion; ?>"></td>
                        </tr>
                        <tr>
                            <td class="text-center">၄</td>
                            <td>နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_nrc" value="<?php echo $student_nrc; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_nrc" value="<?php echo $father_nrc; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_nrc" value="<?php echo $mother_nrc; ?>"></td>
                        </tr>
                        <tr>
                            <td class="text-center">၅</td>
                            <td>အမျိုးသားမှတ်ပုံတင်အမှတ်</td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="student_nat_reg" value="<?php echo $student_nat_reg; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="father_nat_reg" value="<?php echo $father_nat_reg; ?>"></td>
                            <td><input type="text" placeholder="_________________" class="border-0" name="mother_nat_reg" value="<?php echo $mother_nat_reg; ?>"></td>
                        </tr>
                        <tr>
                            <td class="text-center">၆</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_dob" class="font-medium">ကျောင်းသား/သူ၏ မွေးသက္ကရာဇ်
                                    (တက္ကသိုလ်ဝင်တန်းစာမေးပွဲဖြေဆိုစဉ်က ဖော်ပြသည့် အတိုင်းရေးရန်)</label>
                                <input type="text" id="student_dob" name="student_dob" class="mt-1"
                                    placeholder="ဥပမာ - 01-01-2000" value="<?php echo $student_dob; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">၇</td>
                            <td colspan="4" style="white-space: normal;">
                                <label for="student_birthplace"
                                    class="font-medium">မွေးဖွားရာဇာတိမြို့/ပြည်နယ်/ဖုန်းနံပါတ်</label>
                                <input type="text" id="student_birthplace" name="student_birthplace" class="mt-1" value="<?php echo $student_birthplace; ?>">
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
                                    name="father_deceased_year" value="<?php echo $father_deceased_year; ?>"></td>
                            <td><input type="text" placeholder="_______________________" class="border-0"
                                    name="mother_deceased_year" value="<?php echo $mother_deceased_year; ?>"></td>
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
                        <input type="text" id="date" name="date" class="mt-1" placeholder="ဥပမာ - 16-08-2024" value="<?php echo $date; ?>">
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

    <footer id="contact" class="bg-blue-900 text-white ">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4">
                        <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
                            Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay
                            Region, Myanmar
                        </a>
                    </p>
                    <div class="mt-4 text-sm text-blue-200">
                        <p>Email: info@utycc.edu.mm (example)</p>
                        <p>Phone: +95 (XX) XXX XXX (example)</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">
                        Faculties
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="../Majors/ist.html" data-lang-key="footer_faculty_ist">Information Science Technology</a>
                        </li>
                        <li>
                            <a href="../Majors/ce.html" data-lang-key="footer_faculty_ce">Computer Engineering</a>
                        </li>
                        <li>
                            <a href="../Majors/ece.html" data-lang-key="footer_faculty_ece">Electronics Engineering</a>
                        </li>
                        <li><a data-lang-key="footer_faculty_pre" href="../Majors/pre.html">Precision Engineering</a></li>
                        <li><a data-lang-key="footer_faculty_ame" href="../Majors/ame.html">
                                Advanced Materials Engineering
                            </a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
                        Quick Links
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="../term.html" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a>
                        </li>
                        <li>
                            <a href="../FAQs.html" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
                        </li>
                        <li>
                            <a href="../about.html" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
                        </li>
                        <li>
                            <a href="../r&r.html" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">
                        Follow Us
                    </h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="https://mm.linkedin.com/school/university-of-technology-yatanarpon-cyber-city/" class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                    <br />
                    <br />
                    <div>
                        <div class="newtons-cradle">
                            <div class="newtons-cradle__dot"></div>
                            <div class="newtons-cradle__dot"></div>
                            <div class="newtons-cradle__dot"></div>
                            <div class="newtons-cradle__dot"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300"
                data-lang-key="footer_copyright">
                © 2025 University of Technology - Yatanarpon Cyber City. All
                Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        // JavaScript for Photo Upload Preview and Remove
        const photoUploadInput = document.getElementById('photo_upload');
        const photoPlaceholder = document.getElementById('photo-placeholder');
        const photoPreviewContainer = document.getElementById('photo-preview-container');
        const photoPreview = document.getElementById('photo-preview');
        const removePhotoBtn = document.getElementById('remove-photo-btn');

        photoUploadInput.addEventListener('change', function (event) {
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    photoPreview.setAttribute('src', e.target.result);
                    photoPlaceholder.classList.add('hidden');
                    photoPreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        removePhotoBtn.addEventListener('click', function () {
            photoUploadInput.value = ''; // Clear the file input
            photoPreview.setAttribute('src', '#');
            photoPlaceholder.classList.remove('hidden');
            photoPreviewContainer.classList.add('hidden');
        });
    </script>

    <script>
        // --- Menu toggle ---
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuIcon = document.getElementById("menu-icon");

        if (mobileMenuButton && mobileMenu && menuIcon) {
            mobileMenuButton.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
                if (mobileMenu.classList.contains("hidden")) {
                    menuIcon.classList.remove("fa-times");
                    menuIcon.classList.add("fa-bars");
                } else {
                    menuIcon.classList.remove("fa-bars");
                    menuIcon.classList.add("fa-times");
                }
            });
        }

        // --- Translation Script ---
        const translations = {
            my: {
                utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
                nav_about: "ကျွန်ုပ်တို့အကြောင်း",
                nav_programs: "ပညာရေးအစီအစဉ်များ",
                nav_collaboration: "ပူးပေါင်းဆောင်ရွက်မှု",
                nav_contact: "ဆက်သွယ်ရန်",
                nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
                nav_programs_mobile: "ပညာရေးအစီအစဉ်များ",
                nav_collaboration_mobile: "ပူးပေါင်းဆောင်ရွက်မှု",
                nav_contact_mobile: "ဆက်သွယ်ရန်",
                footer_address:
                    "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
                footer_faculties_title: "မဟာဌာနများ",
                footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                footer_contact_title: "ဆက်သွယ်ရန်",
                footer_follow_title: "Follow Us",
                footer_copyright:
                    "© ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
                footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
                footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ",
                footer_link_faq: "အမေးများသော မေးခွန်းများ",
                footer_link_about: "ကျွန်ုပ်တို့အကြောင်း",
                footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
            },
            en: {
                utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
                nav_about: "About Us",
                nav_programs: "Academic Programs",
                nav_collaboration: "Collaboration",
                nav_contact: "Contact",
                nav_about_mobile: "About Us",
                nav_programs_mobile: "Academic Programs",
                nav_collaboration_mobile: "Collaboration",
                nav_contact_mobile: "Contact",
                footer_address:
                    "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
                footer_faculties_title: "Faculties",
                footer_faculty_ist: "Information Science Technology",
                footer_faculty_ce: "Computer Engineering",
                footer_faculty_ece: "Electronics Engineering",
                footer_faculty_ame: "Advanced Materials Engineering",
                footer_faculty_pre: "Precision Engineering",
                footer_contact_title: "Contact Us",
                footer_follow_title: "Follow Us",
                footer_copyright:
                    "© 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
                footer_quick_links_title: "Quick Links",
                footer_link_terms: "Terms & Policies",
                footer_link_faq: "FAQs",
                footer_link_about: "About Us",
                footer_link_rules: "Rules & Regulations",
            },
        };

        const languageSwitcher = document.getElementById("language-switcher");

        const changeLanguage = (lang) => {
            localStorage.setItem("language", lang);
            languageSwitcher.value = lang;

            document.querySelectorAll("[data-lang-key]").forEach((element) => {
                const key = element.dataset.langKey;
                const translation = translations[lang][key];
                if (translation) {
                    element.innerHTML = translation.replace(/\n/g, "<br>");
                }
            });
        };

        languageSwitcher.addEventListener("change", (event) => {
            changeLanguage(event.target.value);
        });

        document.addEventListener("DOMContentLoaded", () => {
            const savedLang = localStorage.getItem("language") || "en";
            changeLanguage(savedLang);
        });
    </script>
</body>
</html>