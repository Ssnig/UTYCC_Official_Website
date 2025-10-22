<?php
session_start();
date_default_timezone_set('Asia/Yangon');

$upload_message = null;
$upload_type = 'error';
$show_js_redirect = false;
// Check for essential session data instead of just the seat number.
$form_data_exists = isset($_SESSION['form1_data']['student_name_en']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['receipt'])) {
    
    if (!$form_data_exists) {
        $upload_message = "Error: Your session has expired or is missing information. Please start the application process again.";
    } else {
        $target_dir = "Rform/payment_receipt/";
        if (!is_dir($target_dir)) {
            if (!mkdir($target_dir, 0777, true)) {
                $upload_message = 'Error: Failed to create payment_receipt folder on the server.';
            }
        }

        if ($upload_message === null) {
            // Use student's name for the filename to make it identifiable.
            $student_name = preg_replace("/[^a-zA-Z0-9_-]/", "", $_SESSION['form1_data']['student_name_en'] ?? 'student');
            $original_filename = basename($_FILES["receipt"]["name"]);
            $file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
            $timestamp = time();
            $safe_filename = $student_name . "_" . $timestamp . "." . $file_extension;
            $target_file = $target_dir . $safe_filename;
            
            $uploadOk = 1;
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

            if ($_FILES['receipt']['error'] !== UPLOAD_ERR_OK) {
                $upload_message = "An error occurred during file upload. Error code: " . $_FILES['receipt']['error'];
                $uploadOk = 0;
            }
            
            if ($uploadOk && $file_extension !== 'pdf') {
                $check = getimagesize($_FILES["receipt"]["tmp_name"]);
                if($check === false) {
                    $upload_message = "File is not a valid image.";
                    $uploadOk = 0;
                }
            }

            if ($uploadOk && $_FILES["receipt"]["size"] > 5000000) {
                $upload_message = "Sorry, your file is too large. Maximum size is 5MB.";
                $uploadOk = 0;
            }

            if($uploadOk && !in_array($file_extension, $allowed_types)) {
                $upload_message = "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1 && move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
                $_SESSION['payment_choice'] = 'paid';
                $_SESSION['payment_receipt_path'] = $target_file;
                $upload_message = "Receipt uploaded successfully! You will be redirected back to the final step.";
                $upload_type = 'success';
                $show_js_redirect = true;
            } else {
                 if ($uploadOk == 1) { // move_uploaded_file failed
                    $upload_message = "Sorry, there was a server error uploading your file. Please try again.";
                 }
            }
        }
    }
} elseif (!$form_data_exists) {
    $upload_message = "Your session is missing required information. Please fill out your personal details first before uploading a payment receipt.";
    $upload_type = 'error';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./CSS/star-layout.css" />
    <link rel="stylesheet" href="./CSS/footer.css" />
    <script src="./JS/star-layout.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>University of Technology - Yatanarpon Cyber City (UTYCC)</title>
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            font-family: 'Padauk', 'Inter', sans-serif;

        }

        h1,
        h2,
        h3 {
            font-family: 'Oswald', sans-serif;
        }

        .content-card {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .step {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            align-items: center;
        }

        .step.reverse {
            direction: rtl;
        }

        .step.reverse>* {
            direction: ltr;
        }

        .step-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .step-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 1rem;
        }

        .step.reverse .step-text {
            text-align: center;
        }

        .step-image {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .payment-guide-screenshot {
            width: auto;
            max-width: 100%;
            border-radius: 0.5rem;
            height: auto;
            max-height: 400px;
        }
        
        .file-drop-area { transition: background-color 0.2s ease-in-out; }

        @media (min-width: 768px) {
            .content-card {
                background-color: #ffffff;
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                padding-left: 150px;
                padding-right: 150px;
            }

            .step-header {
                font-size: 2.5rem;
            }

            .payment-guide-screenshot {
                max-height: 60vh;
            }

            .step {
                gap: 0;
            }

            .step-text {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <div class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="../index.php" class="flex items-center space-x-3">
                <div class="p-2 rounded-lg">
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" loading="lazy" />
                </div>
                <div>
                    <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
                    <span class="text-xs text-gray-500" data-lang-key="utycc_full_name">University of Technology (Yatanarpon Cyber
                        City)</span>
                </div>
            </a>
            <div class="hidden md:flex items-center space-x-6">
                <a href="../about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_about">About Us</a>
                <a href="../activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_activity">Activities</a>
                <a href="examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_examresult">Exam Results</a>
                <!-- Language Switcher Dropdown - Updated Style -->
                <div class="relative ml-4">
                    <div id="lang-switcher-container-desktop">
                        <!-- Custom Button -->
                        <button
                            class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
                            <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
                                class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
                            <span id="selected-lang-text-desktop" class="ml-2">မြန်မာ</span>
                            <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 pointer-events-none"></i>
                        </button>
                        <!-- Custom Dropdown Menu -->
                        <div
                            class="lang-switcher-menu hidden absolute mt-1 w-auto min-w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
                            <a href="#"
                                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                data-lang="my">
                                <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                                    class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
                                <span>မြန်မာ</span>
                            </a>
                            <a href="#"
                                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                data-lang="en">
                                <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
                                <span>English</span>
                            </a>
                        </div>
                    </div>
                    <!-- Hidden original select to maintain JS compatibility -->
                    <select id="language-switcher-desktop" class="hidden">
                        <option value="my">မြန်မာ</option>
                        <option value="en" selected>English</option>
                    </select>
                </div>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-blue-900">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
            <a href="../about.php" class="block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_about_mobile">About Us</a>
            <a href="../activity.php" class="block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_activity_mobile">Activities</a>
            <a href="examResults.php" class="block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_examresult_mobile">Exam Results</a>
            <div class="relative mt-4 pt-4 border-t">
                <!-- Language Switcher for Mobile -->
                <div id="lang-switcher-container-mobile" class="relative">
                    <!-- Custom Button -->
                    <button
                        class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
                        <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
                            class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
                        <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
                        <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
                    </button>
                    <!-- Custom Dropdown Menu -->
                    <div
                        class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
                        <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            data-lang="my">
                            <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                                class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
                            <span>မြန်မာ</span>
                        </a>
                        <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                            data-lang="en">
                            <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
                            <span>English</span>
                        </a>
                    </div>
                </div>
                <!-- Hidden original select to maintain JS compatibility -->
                <select id="language-switcher-mobile" class="hidden">
                    <option value="my">မြန်မာ</option>
                    <option value="en" selected>English</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <main class="py-12">
        <h1 class="text-4xl font-bold text-center text-blue-900 mb-8" data-lang-key="payment_guide_title">Payment Guide</h1>
        
        <?php if ($upload_message): ?>
            <div class="max-w-4xl mx-auto mb-6 p-4 rounded-lg text-center <?php echo $upload_type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                <?php echo htmlspecialchars($upload_message); ?>
            </div>
        <?php endif; ?>

        <section class="content-card space-y-16">

            <!-- Step 1 -->
            <div class="step">
                <div class="step-text">
                    <h2 class="step-header" data-lang-key="payment_step_1">Step 1</h2>
                    <p class="text-gray-700 leading-relaxed" data-lang-key="payment_text_1">
                        Go to QuickPay in the KBZPay app.
                    </p>
                </div>
                <div class="step-image">
                    <img src="./Img/payment-guide/step1.jpeg" alt="Step 1 Screenshot" class="payment-guide-screenshot" loading="lazy">
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step reverse">
                <div class="step-text">
                    <h2 class="step-header" data-lang-key="payment_step_2">Step 2</h2>
                    <p class="text-gray-700 leading-relaxed" data-lang-key="payment_text_2">
                        Select Education in Categories.
                    </p>
                </div>
                <div class="step-image">
                    <img src="./Img/payment-guide/step2.jpeg" alt="Step 2 Screenshot" class="payment-guide-screenshot" loading="lazy">
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step">
                <div class="step-text">
                    <h2 class="step-header" data-lang-key="payment_step_3">Step 3</h2>
                    <p class="text-gray-700 leading-relaxed" data-lang-key="payment_text_3">
                        Search for University of Technology (YCC) in the list.
                    </p>
                </div>
                <div class="step-image">
                    <img src="./Img/payment-guide/step3.jpeg" alt="Step 3 Screenshot" class="payment-guide-screenshot" loading="lazy">
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step reverse">
                <div class="step-text">
                    <h2 class="step-header" data-lang-key="payment_step_4">Step 4</h2>
                    <p class="text-gray-700 leading-relaxed" data-lang-key="payment_text_4">
                        Fill in the required information and Submit.
                    </p>
                </div>
                <div class="step-image">
                    <img src="./Img/payment-guide/step4.jpeg" alt="Step 4 Screenshot" class="payment-guide-screenshot" loading="lazy">
                </div>
            </div>

             <!-- Upload Section -->
            <div class="border-t-2 border-dashed border-gray-300 my-16"></div>
            
            <div class="text-center">
                <h2 class="text-3xl font-bold text-blue-900 mb-4" data-lang-key="upload_title">Upload Payment Receipt</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto" data-lang-key="upload_instruction">
                    After making the payment, please upload a screenshot of your successful transaction here.
                </p>
                
                <?php if ($form_data_exists && !$show_js_redirect): ?>
                <form id="uploadForm" action="paymentGuide.php" method="post" enctype="multipart/form-data" class="max-w-xl mx-auto bg-slate-50 p-8 rounded-2xl shadow-inner border border-gray-200">
                    <div id="file-drop-area" class="file-drop-area mb-6 border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer bg-white hover:bg-gray-50">
                        <input type="file" name="receipt" id="receipt" required class="hidden" accept="image/png, image/jpeg, image/gif, application/pdf">
                        <div id="file-drop-prompt">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 font-medium">Drag & drop your file here or</p>
                            <p class="text-blue-600 font-semibold">Click to select a file</p>
                            <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF, or PDF (Max 5MB)</p>
                        </div>
                        <div id="file-preview-wrapper" class="hidden">
                             <img id="file-preview" src="#" alt="Receipt Preview" class="max-w-full max-h-48 mx-auto rounded">
                             <p id="file-name" class="text-sm text-gray-700 mt-2 font-medium"></p>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-transform transform hover:scale-105" data-lang-key="upload_button">Upload and Complete</button>
                </form>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="contact" class="bg-blue-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="animate-on-scroll" style="--i:1;">
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4 icon-hover-effect" loading="lazy" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4"><a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">Yatanarpon Cyber City,Near Pyin Oo Lwin,<br />Mandalay Region, Myanmar</a></p>
                    <div class="mt-4 text-sm text-blue-200">
                        <a href="mailto:utyccstudentaffair2010@gmail.com">Email: info@utycc.site utyccstudentaffair2010@gmail.com</a>
                        <br><a href="tel:+959445767834">Phone: +959445767834 </a>
                    </div>
                </div>
                <div class="animate-on-scroll" style="--i:2;">
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">Faculties</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="./Majors/ist.php" data-lang-key="footer_faculty_ist">Information Science Technology</a></li>
                        <li><a href="./Majors/ce.php" data-lang-key="footer_faculty_ce">Computer Engineering</a></li>
                        <li><a href="./Majors/ece.php" data-lang-key="footer_faculty_ece">Electronics Engineering</a></li>
                        <li><a data-lang-key="footer_faculty_pre" href="./Majors/pre.php">Precision Engineering</a></li>
                        <li><a data-lang-key="footer_faculty_ame" href="./Majors/ame.php">Advanced Materials Engineering</a></li>
                    </ul>
                </div>
                <div class="animate-on-scroll" style="--i:3;">
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="./terms.php" class="hover:text-white shine_text" data-lang-key="footer_link_terms">Terms & Policies</a></li>
                        <li><a href="./FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a></li>
                        <li><a href="./about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a></li>
                        <li><a href="./randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a></li>
                        <li><a href="./data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a></li>
                    </ul>
                </div>
                <div class="animate-on-scroll" style="--i:4;">
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="https://mm.linkedin.com/school/university-of-technology-yatanarpon-cyber-city/" class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                    <br /><br />
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
                © 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.
            </div>
        </div>
    </footer>
    <?php if ($show_js_redirect): ?>
    <script>
        setTimeout(() => window.location.href = "Rform/final.php", 2500);
    </script>
    <?php endif; ?>
    <script>
        document.getElementById("mobile-menu-button").addEventListener("click", () => {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        });

        const translations = {
            my: {
                utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
                nav_about: "ကျွန်ုပ်တို့အကြောင်း",
                nav_activity: "လှုပ်ရှားမှုများ",
                nav_examresult: "အောင်စာရင်း",
                nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
                nav_activity_mobile: "လှုပ်ရှားမှုများ",
                nav_examresult_mobile: "အောင်စာရင်း",
                payment_guide_title: "ငွေပေးချေမှုလမ်းညွှန်",
                payment_step_1: "အဆင့် ၁",
                payment_step_2: "အဆင့် ၂",
                payment_step_3: "အဆင့် ၃",
                payment_step_4: "အဆင့် ၄",
                payment_text_1: "KBZPay အက်ပ်တွင် QuickPay သို့သွားပါ။",
                payment_text_2: "အမျိုးအစားများ တွင် ပညာရေး ကိုရွေးချယ်ပါ။",
                payment_text_3: "စာရင်းထဲမှ University of Technology (YCC) ကိုရှာပါ။",
                payment_text_4: "လိုအပ်သောအချက်အလက်များကိုဖြည့်ပြီး တင်သွင်းပါ။",
                upload_title: "ငွေပေးချေမှုပြေစာတင်ပါ။",
                upload_instruction: "KBZPay ဖြင့် ငွေပေးချေပြီးနောက်၊ သင်၏ငွေပေးချေမှုအောင်မြင်ကြောင်းပြေစာ၏စခရင်ရှော့ကို ဤနေရာတွင် တင်ပေးပါ။",
                receipt_label: "ငွေပေးချေမှု စခရင်ရှော့",
                upload_button: "တင်ပြီး အပြီးသတ်ပါ။",
            },
            en: {
                utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
                nav_about: "About Us",
                nav_activity: "Activities",
                nav_examresult: "Exam Results",
                nav_about_mobile: "About Us",
                nav_activity_mobile: "Activities",
                nav_examresult_mobile: "Exam Results",
                payment_guide_title: "Payment Guide",
                payment_step_1: "Step 1",
                payment_step_2: "Step 2",
                payment_step_3: "Step 3",
                payment_step_4: "Step 4",
                payment_text_1: "Go to QuickPay in the KBZPay app.",
                payment_text_2: "Select Education in Categories.",
                payment_text_3: "Search for University of Technology (YCC) in the list.",
                payment_text_4: "Fill in the required information and Submit.",
                upload_title: "Upload Payment Receipt",
                upload_instruction: "After making the payment, please upload a screenshot of your successful transaction here.",
                receipt_label: "Payment Screenshot",
                upload_button: "Upload and Complete",
            },
        };

        let currentLanguage = localStorage.getItem("language") || "en";

        function setLanguage(lang) {
            currentLanguage = lang;
            localStorage.setItem("language", lang);
            ['desktop', 'mobile'].forEach(device => {
                const flagImg = document.getElementById(`selected-lang-flag-${device}`);
                const textSpan = document.getElementById(`selected-lang-text-${device}`);
                const select = document.getElementById(`language-switcher-${device}`);
                if (select) select.value = lang;
                if (lang === 'my') {
                    if (flagImg) flagImg.src = 'https://flagcdn.com/w20/mm.png';
                    if (textSpan) textSpan.textContent = 'မြန်မာ';
                } else {
                    if (flagImg) flagImg.src = 'https://flagcdn.com/w20/gb.png';
                    if (textSpan) textSpan.textContent = 'English';
                }
            });
            document.querySelectorAll("[data-lang-key]").forEach(element => {
                const key = element.dataset.langKey;
                if (translations[lang] && translations[lang][key]) {
                    element.innerHTML = translations[lang][key];
                }
            });
        }

        function setupLangSwitcher(device) {
            const container = document.getElementById(`lang-switcher-container-${device}`);
            if (!container) return;
            const button = container.querySelector('.lang-switcher-button');
            const menu = container.querySelector('.lang-switcher-menu');
            const options = container.querySelectorAll('.lang-switcher-option');
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    setLanguage(option.getAttribute('data-lang'));
                    menu.classList.add('hidden');
                });
            });
        }

        document.addEventListener('click', () => {
            document.querySelectorAll('.lang-switcher-menu').forEach(menu => menu.classList.add('hidden'));
        });

        document.addEventListener("DOMContentLoaded", () => {
            const savedLang = localStorage.getItem("language") || "en";
            setLanguage(savedLang);
            setupLangSwitcher('desktop');
            setupLangSwitcher('mobile');
            
            const dropArea = document.getElementById('file-drop-area');
            const fileInput = document.getElementById('receipt');
            const prompt = document.getElementById('file-drop-prompt');
            const previewWrapper = document.getElementById('file-preview-wrapper');
            const previewImage = document.getElementById('file-preview');
            const fileNameDisplay = document.getElementById('file-name');

            if(dropArea) {
                dropArea.addEventListener('click', () => fileInput.click());
                dropArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropArea.classList.add('border-blue-500', 'bg-blue-50');
                });
                dropArea.addEventListener('dragleave', () => {
                    dropArea.classList.remove('border-blue-500', 'bg-blue-50');
                });
                dropArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropArea.classList.remove('border-blue-500', 'bg-blue-50');
                    if (e.dataTransfer.files.length) {
                        fileInput.files = e.dataTransfer.files;
                        handleFileChange({ target: fileInput });
                    }
                });
                fileInput.addEventListener('change', handleFileChange);
            }

            function handleFileChange(event) {
                const [file] = event.target.files;
                if (file) {
                    prompt.classList.add('hidden');
                    previewWrapper.classList.remove('hidden');
                    fileNameDisplay.textContent = file.name;

                    if (file.type.startsWith('image/')) {
                        previewImage.style.display = 'block';
                        previewImage.src = URL.createObjectURL(file);
                        previewImage.onload = () => URL.revokeObjectURL(previewImage.src);
                    } else {
                        previewImage.style.display = 'none';
                    }
                } else {
                    prompt.classList.remove('hidden');
                    previewWrapper.classList.add('hidden');
                }
            }
        });
    </script>
</body>

</html>

