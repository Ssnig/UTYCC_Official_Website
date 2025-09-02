<?php
    
    session_start();
    // echo '<pre>';
    // print_r($_SESSION);
    // Check if form1 data exists, if not, redirect back to form1
    if (!isset($_SESSION['form1_data'])) {
        header("location: form1.php");
        exit;
    }

    // Get the photo URL from the session data
    $photo_url = $_SESSION['form1_data']['photo_url'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Check if a new photo is uploaded
        if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] == UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if (in_array($_FILES['student_photo']['type'], $allowed_types) && $_FILES['student_photo']['size'] <= $max_size) {
                
                $upload_dir = __DIR__ . "/uploads/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                $file_name = uniqid('photo_', true) . "_" . basename($_FILES['student_photo']['name']);
                $target_file = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $target_file)) {
                    // Successfully uploaded new photo, now delete the old one
                    $old_photo_url = $_SESSION['form1_data']['photo_url'] ?? '';
                    if (!empty($old_photo_url) && file_exists(__DIR__ . $old_photo_url)) {
                        unlink(__DIR__ . $old_photo_url);
                    }
                    
                    // Save the new file path into session
                    $_SESSION['form1_data']['photo_url'] = "/uploads/" . $file_name;

                } else {
                    // Handle upload error if needed, for now, we just proceed with old photo
                }
            }
        } 
        
        // If no new photo or failed upload, the old photo_url in session remains.
        // Proceed to the final form
        header('Location: final.php');  
        exit();
    }
?>
<?php include 'hostelpartials/header.php'; ?>
    <br>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto border border-gray-300 shadow-lg p-6 md:p-10">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-lg font-bold">နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)</h1>
            <p class="text-sm mt-2">ကျောင်းအပ်လက်ခံရရှိကြောင်း၊ ကျောင်းသား၏ သတင်းအချက်အလက်များ တင်သွင်းခြင်း</p>
            <!-- <p class="text-xs text-gray-500 mt-2">၂၀၂၅-၂၀၂၆ ပညာသင်နှစ်</p>
            <p class="text-xs text-gray-500 mt-1">ကျောင်းအပ်နံပါတ်.................................</p> -->
        </div>
        
        <!-- Form Start -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <!-- Photo Upload/Display -->
            <div class="my-8 flex justify-center">
                 <div class="upload-area w-48 text-center">
                    <div id="preview-container" class="relative">
                        <img id="image-preview" 
                             src="<?php echo !empty($photo_url) && file_exists($photo_url) ? htmlspecialchars($photo_url) : 'https://placehold.co/192x224/e2e8f0/64748b?text=No+Photo'; ?>" 
                             alt="Student Photo" 
                             class="w-full h-full object-cover rounded-lg mb-2 border">
                    </div>
                    <input type="file" name="student_photo" id="photo-upload" accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('photo-upload').click()" class="mt-2 w-full bg-gray-200 text-gray-800 text-sm py-2 px-4 rounded-lg hover:bg-gray-300 transition">ဓာတ်ပုံပြောင်းရန်</button>
                    <p id="photo-error" class="text-red-500 text-xs mt-1 h-4"></p>
                </div>
            </div>
            
            <!-- Form Fields -->
            <div class="mt-8">
                <div class="form-item">
                    <span class="form-label">အမည်:</span>
                    <input type="text" name="student_name" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_name_mm'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">ခုံအမှတ်:</span>
                    <input type="text" name="seat_number" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['seat_no'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">နိုင်ငံသားစိစစ်ရေးကတ်အမှတ်:</span>
                    <input type="text" name="nrc" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_nrc'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">မွေးသက္ကရာဇ်:</span>
                    <input type="text" name="dob" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_dob'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">အဖအမည်:</span>
                    <input type="text" name="father_name" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['father_name_mm'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">အမိအမည်:</span>
                    <input type="text" name="mother_name" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['mother_name_mm'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">ဆက်သွယ်ရန်လိပ်စာ:</span>
                    <input type="text" name="address" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_address'] ?? ''); ?>" readonly>
                </div>
                <div class="form-item">
                    <span class="form-label">ဖုန်းနံပါတ်:</span>
                    <input type="text" name="phone_number" class="form-input" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_phone'] ?? ''); ?>" readonly>
                </div>
            </div>
            
            <!-- Declaration -->
            <div class="mt-8 text-center">
                <p class="text-sm text-red-500">အထက်ပါ သတင်းအချက်အလက်များသည် မှန်ကန်ကြောင်း ဝန်ခံပါသည်။</p>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="nav-buttons mt-8 flex justify-between">
                <!-- This back button should go to the previous logical step, e.g., form1.php or an options page -->
                <a href="form1.php" class="nav-button bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Back</a>
                <button type="submit" class="nav-button bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Next</button>
            </div>
        </form>
        <!-- Form End -->

        <!-- Footer -->
        <div class="mt-8 flex justify-between items-center text-xs text-gray-500">
            <span>UTYCC/SA/F-18/Rev-0/20-6-2022</span>
        </div>
    </div>
    
    <br>
    
    <!-- footer -->
    <footer id="contact" class="bg-blue-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <img src="https://placehold.co/40x40/f3f4f6/334155?text=UTYCC" alt="UTYCC Logo" class="h-12 mb-4" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4">
                        <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
                            Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay Region, Myanmar
                        </a>
                    </p>
                    <div class="mt-4 text-sm text-blue-200">
                        <p>Email: info@utycc.edu.mm (example)</p>
                        <p>Phone: +95 (XX) XXX XXX (example)</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">Faculties</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="#" data-lang-key="footer_faculty_ist">Information Science Technology</a></li>
                        <li><a href="#" data-lang-key="footer_faculty_ce">Computer Engineering</a></li>
                        <li><a href="#" data-lang-key="footer_faculty_ece">Electronics Engineering</a></li>
                        <li><a data-lang-key="footer_faculty_pre" href="#">Precision Engineering</a></li>
                        <li><a data-lang-key="footer_faculty_ame" href="#">Advanced Materials Engineering</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="#" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a></li>
                        <li><a href="#" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a></li>
                        <li><a href="#" class="hover:text-white" data-lang-key="footer_link_about">About Us</a></li>
                        <li><a href="#" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">Follow Us</h3>
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
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300" data-lang-key="footer_copyright">
                &copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.
            </div>
        </div>
    </footer>
    
    <script>
        const photoUpload = document.getElementById('photo-upload');
        const imagePreview = document.getElementById('image-preview');
        const photoError = document.getElementById('photo-error');

        photoUpload.addEventListener('change', function(event) {
            photoError.textContent = ''; // Clear previous errors
            const file = event.target.files[0];
            if (file) {
                // Client-side validation
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (!allowedTypes.includes(file.type)) {
                    photoError.textContent = 'JPG, PNG, GIF ဖိုင်အမျိုးအစားသာရွေးပါ။';
                    this.value = ''; // Clear the input
                    return;
                }

                if (file.size > maxSize) {
                    photoError.textContent = 'ဖိုင်ဆိုဒ် 5MB ထက်ကြီးနေပါသည်။';
                    this.value = ''; // Clear the input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

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
                footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
                footer_faculties_title: "မဟာဌာနများ",
                footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                footer_contact_title: "ဆက်သွယ်ရန်",
                footer_follow_title: "Follow Us",
                footer_copyright: "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
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
                footer_copyright: "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
                footer_quick_links_title: "Quick Links",
                footer_link_terms: "Terms & Policies",
                footer_link_faq: "FAQs",
                footer_link_about: "About Us",
                footer_link_rules: "Rules & Regulations",
            },
        };
        
        const languageSwitcher = document.getElementById("language-switcher");
        
        const changeLanguage = (lang) => {
            // Store the selected language
            localStorage.setItem("language", lang);
            
            // Set the dropdown to the correct value
            if(languageSwitcher) languageSwitcher.value = lang;
            
            // Translate all elements with the data-lang-key attribute
            document.querySelectorAll("[data-lang-key]").forEach((element) => {
                const key = element.dataset.langKey;
                const translation = translations[lang][key];
                if (translation) {
                    element.innerHTML = translation.replace(/\\n/g, "<br>");
                }
            });
        };
        
        // Event listener for the language switcher
        if(languageSwitcher) languageSwitcher.addEventListener("change", (event) => {
            changeLanguage(event.target.value);
        });
        
        // Function to run when the page loads
        document.addEventListener("DOMContentLoaded", () => {
            // Check for a saved language in localStorage, otherwise default to 'en'
            const savedLang = localStorage.getItem("language") || "en";
            changeLanguage(savedLang);
        });
    </script>
</body>

</html>

