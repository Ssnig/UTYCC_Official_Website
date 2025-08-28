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