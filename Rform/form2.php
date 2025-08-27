<?php
// Start the session to carry data across pages
session_start();
$form1= $_SESSION['form1_data'] ?? [];
echo "<pre>";
print_r($form1);
// Define variables and initialize with empty values
$student_name = $student_id = $parent_name = $parent_address = $parent_phone = "";
$errors = [];

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate Student Name
    if (empty(trim($_POST["student_name"]))) {
        $errors['student_name'] = "Student's name is required.";
    } else {
        $student_name = htmlspecialchars(trim($_POST["student_name"]));
    }

    // Sanitize and validate Student ID/Roll Number
    if (empty(trim($_POST["student_id"]))) {
        $errors['student_id'] = "Student's roll number is required.";
    } else {
        $student_id = htmlspecialchars(trim($_POST["student_id"]));
    }
    
    // Sanitize and validate Parent Name
    if (empty(trim($_POST["parent_name"]))) {
        $errors['parent_name'] = "Parent's/Guardian's name is required.";
    } else {
        $parent_name = htmlspecialchars(trim($_POST["parent_name"]));
    }

    // Sanitize and validate Parent Address
    if (empty(trim($_POST["parent_address"]))) {
        $errors['parent_address'] = "Parent's/Guardian's address is required.";
    } else {
        $parent_address = htmlspecialchars(trim($_POST["parent_address"]));
    }

    // Sanitize and validate Parent Phone
    if (empty(trim($_POST["parent_phone"]))) {
        $errors['parent_phone'] = "Parent's/Guardian's phone number is required.";
    } elseif (!preg_match('/^[0-9\-\+\s\(\)]*$/', trim($_POST["parent_phone"]))) {
         $errors['parent_phone'] = "Please enter a valid phone number.";
    } else {
        $parent_phone = htmlspecialchars(trim($_POST["parent_phone"]));
    }

    // If there are no errors, store data in session and redirect to the next form
    if (empty($errors)) {
        // Store the validated data in a session variable
        $_SESSION['form2_data'] = [
            'student_name' => $student_name,
            'student_id' => $student_id,
            'parent_name' => $parent_name,
            'parent_address' => $parent_address,
            'parent_phone' => $parent_phone
        ];

        // Redirect to the next step of the registration
        header("location: form3.php"); // Make sure form3.php exists
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/font.css" />
    <title>Student's Registration Form 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Padauk:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="form.css">
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
                <a href="#about" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about">About Us</a>
                <a href="#programs" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_programs">Academic Programs</a>
                <a href="#collaboration" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_collaboration">Collaboration</a>
                <a href="#contact" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_contact">Contact</a>

                <div class="relative ml-4">
                    <div class="relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                        <i class="fas fa-globe text-gray-500 absolute left-3 z-10 pointer-events-none"></i>
                        <select id="language-switcher" class="cursor-pointer appearance-none bg-transparent text-gray-700 font-medium rounded-full py-1.5 pl-9 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="my">မြန်မာ</option>
                            <option value="en">English</option>
                        </select>
                        <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 z-10 pointer-events-none"></i>
                    </div>
                </div>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-blue-900">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
            <a href="#about" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_about_mobile">About Us</a>
            <a href="#programs" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_programs_mobile">Academic Programs</a>
            <a href="#collaboration" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_collaboration_mobile">Collaboration</a>
            <a href="#contact" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_contact_mobile">Contact</a>
        </div>
    </div>
    <br>

    <div class="max-w-4xl mx-auto">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>

            <section class="form-section" id="parent-pledge">
                <h2 class="form-title">မိဘ/အုပ်ထိန်းသူ၏ ကတိခံဝန်ချက်</h2>
                <div class="space-y-4 pledge-text">
                    <p>၁။ နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)တွင် ပညာသင်ယူလျက်ရှိသော မောင်/မ 
                        <input type="text" name="student_name" placeholder="_______________________" class="border-0 form-input inline-block w-64" value="<?php echo $student_name; ?>"> ခုံအမှတ် 
                        <input type="text" name="student_id" placeholder="__________________________" class="border-0 form-input inline-block w-48" value="<?php echo $student_id; ?>"> သည် နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)က ချမှတ်ထားသော စည်းမျဥ်း စည်းကမ်းများကို ရိုသေလေးစားစွာ လိုက်နာပါမည်ဟု ခံဝန်ကတိပြုပါသည်။
                    </p>
                    <span class="text-red-500 text-sm block"><?php echo $errors['student_name'] ?? ''; ?></span>
                    <span class="text-red-500 text-sm block"><?php echo $errors['student_id'] ?? ''; ?></span>

                    <p>၂။ တစ်ခုခုကျူးလွန်ဖောက်ဖျက်ပါက အုပ်ချုပ်ရေးအဖွဲ့၏ ချမှတ်ထားသော အပြစ်ဒဏ်စည်းမျဥ်းစည်းကမ်းကို ခံယူပါမည်ဟု လက်မှတ်ရေးထိုးပါသည်။</p>
                </div>
                <div class="mt-12 ml-auto w-full md:w-1/2">
                    <div class="input-group flex items-center">
                        <label class="w-48">မိဘ/ အုပ်ထိန်းသူလက်မှတ်:</label>
                        <div class="signature-line flex-grow"></div>
                    </div>
                    <div class="input-group flex items-center">
                        <label for="parent-name" class="w-48">မိဘ/ အုပ်ထိန်းသူအမည်:</label>
                        <input type="text" id="parent-name" name="parent_name" class="form-input flex-grow" value="<?php echo $parent_name; ?>">
                    </div>
                    <span class="text-red-500 text-sm block ml-48"><?php echo $errors['parent_name'] ?? ''; ?></span>

                    <div class="input-group flex items-center">
                        <label for="parent-address" class="w-48">နေရပ်လိပ်စာအပြည့်အစုံ:</label>
                        <input type="text" id="parent-address" name="parent_address" class="form-input flex-grow" value="<?php echo $parent_address; ?>">
                    </div>
                    <span class="text-red-500 text-sm block ml-48"><?php echo $errors['parent_address'] ?? ''; ?></span>
                    
                    <div class="input-group flex items-center">
                        <label for="parent-phone" class="w-48">ဖုန်းနံပါတ်:</label>
                        <input type="tel" id="parent-phone" name="parent_phone" class="form-input flex-grow" value="<?php echo $parent_phone; ?>">
                    </div>
                    <span class="text-red-500 text-sm block ml-48"><?php echo $errors['parent_phone'] ?? ''; ?></span>

                </div>
                <div class="form-footer">UTYCC/ SA/ F-20/ Rev-0/31-10-2022</div>
            </section>

            <div class="nav-buttons">
                <a href="form1.php" class="nav-button ">Back</a>
                <button type="submit" class="nav-button">Next</button>
            </div>
            
        </form> </div>
    <br>

    <footer id="contact" class="bg-blue-900 text-white py-2">
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
                        <li data-lang-key="footer_faculty_ist">
                            Information Science Technology
                        </li>
                        <li data-lang-key="footer_faculty_ce">Computer Engineering</li>
                        <li data-lang-key="footer_faculty_ece">
                            Electronics Engineering
                        </li>
                        <li data-lang-key="footer_faculty_ame">
                            Advanced Materials Engineering
                        </li>
                        <li data-lang-key="footer_faculty_pre">Precision Engineering</li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
                        Quick Links
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="#" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">
                        Follow Us
                    </h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
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
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300" data-lang-key="footer_copyright">
                © 2025 University of Technology - Yatanarpon Cyber City. All
                Rights Reserved.
            </div>
        </div>
    </footer>
    <script>
        // --- Your existing JavaScript for language translation and mobile menu ---
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
                footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
                footer_faculties_title: "မဟာဌာနများ",
                footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                footer_contact_title: "ဆက်သွယ်ရန်",
                footer_follow_title: "Follow Us",
                footer_copyright: "© ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
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
                footer_address: "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
                footer_faculties_title: "Faculties",
                footer_faculty_ist: "Information Science Technology",
                footer_faculty_ce: "Computer Engineering",
                footer_faculty_ece: "Electronics Engineering",
                footer_faculty_ame: "Advanced Materials Engineering",
                footer_faculty_pre: "Precision Engineering",
                footer_contact_title: "Contact Us",
                footer_follow_title: "Follow Us",
                footer_copyright: "© 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
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
                    element.innerHTML = translation.replace(/\\n/g, "<br>");
                }
            });
        };

        languageSwitcher.addEventListener("change", (event) => {
            changeLanguage(event.target.value);
        });

        document.addEventListener("DOMContentLoaded", () => {
            const savedLang = localStorage.getItem("language") || "my";
            changeLanguage(savedLang);
        });
    </script>
</body>

</html>