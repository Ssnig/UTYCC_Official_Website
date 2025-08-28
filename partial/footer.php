 <footer id="contact" class="bg-blue-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4 hover_up" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4">
                        <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address"
                            target="_blank">
                            Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
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
                            <a href="./Majors/ist.html" data-lang-key="footer_faculty_ist">Information Science
                                Technology</a>
                        </li>
                        <li>
                            <a href="./Majors/ce.html" data-lang-key="footer_faculty_ce">Computer Engineering</a>
                        </li>
                        <li>
                            <a href="./Majors/ece.html" data-lang-key="footer_faculty_ece">Electronics Engineering</a>
                        </li>
                        <li>
                            <a data-lang-key="footer_faculty_pre" href="./Majors/pre.html">Precision Engineering</a>
                        </li>
                        <li>
                            <a data-lang-key="footer_faculty_ame" href="./Majors/ame.html">Advanced Materials
                                Engineering</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
                        Quick Links
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="./term.html" class="hover:text-white shine_text"
                                data-lang-key="footer_link_terms">Terms &
                                Policies</a>
                        </li>
                        <li>
                            <a href="./FAQs.html" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
                        </li>
                        <li>
                            <a href="./about.html" class="hover:text-white" data-lang-key="footer_link_about">About
                                Us</a>
                        </li>
                        <li>
                            <a href="./rr.html" class="hover:text-white" data-lang-key="footer_link_rules">Rules &
                                Regulations</a>

                        </li>
                        <!-- <li><a href="#" id="gamesLink"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Dinosaur?</a></li> -->
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">
                        Follow Us
                    </h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="https://mm.linkedin.com/school/university-of-technology-yatanarpon-cyber-city/"
                            class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
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
            <div id="gameContainer" class="game-container hidden text-center mt-10">
                <iframe src="https://chromedino.com/" frameborder="0" scrolling="no" width="100%" height="100%"
                    loading="lazy"></iframe>
                <style type="text/css">
                    iframe {
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        z-index: 999;
                    }
                </style>

            </div>
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300"
                data-lang-key="footer_copyright">
                © 2025 University of Technology - Yatanarpon Cyber City. All
                Rights Reserved.
            </div>
        </div>
    </footer>


    <!-- Verification Modal -->
    <div id="verification-modal" class="modal-overlay hidden">
        <div class="auth-wrapper">
            <button id="modal-close-btn" class="modal-close-btn" aria-label="Close">
                &times;
            </button>
            <div class="shell">
                <header class="g-head">
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="brand-logo" />
                    <h1 class="modal-h1" id="modal-title" data-lang-key="signup_title">
                        Create Account
                    </h1>
                    <p class="sub" id="modal-subtitle" data-lang-key="signup_subtitle">
                        to enroll at UTYCC
                    </p>
                </header>

                <!-- View for Sign Up -->
                <div id="view-signup" class="view active">
                    <form id="signup-form">
                        <div class="field">
                            <label for="signup-name" data-lang-key="signup_name_label">Name</label>
                            <input type="text" id="signup-name" class="input" placeholder="Your Full Name" required />
                        </div>
                        <div class="field">
                            <label for="signup-email" data-lang-key="signup_email_label">Email</label>
                            <input type="email" id="signup-email" class="input" placeholder="your.email@example.com"
                                required />
                        </div>
                        <div class="field">
                            <label for="signup-phone" data-lang-key="signup_phone_label">Phone Number</label>
                            <input type="tel" id="signup-phone" class="input" placeholder="e.g., 09xxxxxxxxx"
                                required />
                        </div>
                        <div class="terms">
                            <input type="checkbox" id="signup-terms" required />
                            <label for="signup-terms">
                                <span data-lang-key="signup_terms_agree">I agree to the</span>
                                <a href="/terms.html" target="_blank" data-lang-key="signup_terms_link">Terms &
                                    Policy</a>
                            </label>
                        </div>
                        <button type="submit" id="signup-submit-btn" class="btn" disabled data-lang-key="signup_button">
                            Create Account
                        </button>
                    </form>
                    <p class="auth-toggle" data-lang-key="signup_toggle">
                        Already have an account? <a id="toggle-to-login-btn">Sign In</a>
                    </p>
                </div>

                <!-- View for Login -->
                <div id="view-login" class="view">
                    <form id="login-form">
                        <div class="field">
                            <label for="login-id" data-lang-key="login_id_label">Student ID</label>
                            <input type="text" id="login-id" class="input" placeholder="Your Student ID" required />
                        </div>
                        <div class="field">
                            <label for="login-password" data-lang-key="login_password_label">Password</label>
                            <input type="password" id="login-password" class="input" placeholder="Your Password"
                                required />
                        </div>
                        <button type="submit" class="btn" data-lang-key="login_button">
                            Sign In
                        </button>
                    </form>
                    <p class="auth-toggle" data-lang-key="login_toggle">
                        Don't have an account? <a id="toggle-to-signup-btn">Create one</a>
                    </p>
                </div>
            </div>
            <div class="image-panel">
                <img src="./Img/hero-carousel/3.JPG" style="opacity: 70%" alt="UTYCC Photo" />
            </div>
        </div>
    </div>

    <div class="toast-wrap"></div>

    <script>
        // --- DOM Elements ---
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const langSwitcherDesktop = document.getElementById(
            "language-switcher-desktop"
        );
        const langSwitcherMobile = document.getElementById(
            "language-switcher-mobile"
        );

        const newStudentEnrollTrigger = document.getElementById(
            "new-student-enroll-trigger"
        );
        const currentStudentEnrollTrigger = document.getElementById(
            "current-student-enroll-trigger"
        );

        // --- Modal Elements ---
        const verificationModal = document.getElementById("verification-modal");
        const closeModalBtn = document.getElementById("modal-close-btn");
        const toastWrap = document.querySelector(".toast-wrap");
        const modalTitle = document.getElementById("modal-title");
        const modalSubtitle = document.getElementById("modal-subtitle");

        // Views
        const viewSignup = document.getElementById("view-signup");
        const viewLogin = document.getElementById("view-login");

        // Signup Form
        const signupForm = document.getElementById("signup-form");
        const signupTerms = document.getElementById("signup-terms");
        const signupSubmitBtn = document.getElementById("signup-submit-btn");

        // Login Form
        const loginForm = document.getElementById("login-form");

        // --- State ---
        let currentLang = "my";

        // --- Translations ---
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
                hero_title: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
                hero_subtitle:
                    "စဉ်ဆက်မပြတ် ဖွံ့ဖြိုးတိုးတက်မှုအတွက် ဦးဆောင်အင်ဂျင်နီယာကျောင်း",
                hero_button: "ကျောင်းအပ်ရန်",
                stats_since: "တည်ထောင်ခဲ့သောနှစ်",
                stats_students: "ကျောင်းသား/သူများ",
                stats_acceptance: "ဝင်ခွင့်ရရှိနှုန်း",
                stats_quality: "အရည်အသွေး အသိအမှတ်ပြု",
                about_title: "ကျွန်ုပ်တို့၏ မျှော်မှန်းချက်နှင့် ရည်မှန်းချက်",
                about_p1:
                    "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ကို ၂၀၁၀ ခုနှစ်၊ အောက်တိုဘာလ ၁၇ ရက်နေ့တွင် သိပ္ပံနှင့်နည်းပညာဝန်ကြီးဌာန လက်အောက်၌ တည်ထောင်ခဲ့ပါသည်။ တက္ကသိုလ်သည် ပြင်ဦးလွင်မြို့အနီး၊ ရတနာပုံဆိုင်ဘာစီးတီးတွင် တည်ရှိသည်။",
                vision_title: "မျှော်မှန်းချက်",
                vision_text:
                    "စဉ်ဆက်မပြတ် ဖွံ့ဖြိုးတိုးတက်မှုအတွက် ဦးဆောင်အင်ဂျင်နီယာကျောင်းတစ်ကျောင်း ဖြစ်လာစေရန်။",
                mission_title: "ရည်မှန်းချက်",
                mission_text:
                    "အရည်အသွေးမြင့်မားသော သင်ကြားရေး၊ သုတေသနနှင့် လူမှုရေးအရ တာဝန်ယူမှုရှိသော အင်ဂျင်နီယာပညာရေးကို ပံ့ပိုးပေးရန်။",
                programs_title: "ပညာရေးအစီအစဉ်များ",
                bachelor_title: "ဘွဲ့ကြိုသင်တန်းများ (၆ နှစ်)",
                program_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                program_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                program_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                program_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                program_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                masters_title: "ဘွဲ့လွန်သင်တန်းများ (၂ နှစ်)",
                masters_text:
                    "IST, CE, ECE, AME, နှင့် PrE ဘာသာရပ်များတွင် မဟာဘွဲ့သင်တန်းများကို သင်ကြားလျက်ရှိပြီး သင်တန်း coursework နှင့် ကျမ်းတစ်စောင် ပြုစုရန် လိုအပ်ပါသည်။",
                phd_title: "ပါရဂူဘွဲ့ (၃ နှစ်)",
                phd_text:
                    "သတင်းအချက်အလက်နည်းပညာဘာသာရပ်တွင် ပါရဂူဘွဲ့ (Ph.D.) သင်တန်းကို တက်ရောက်နိုင်သည်။",
                collab_title: "နိုင်ငံတကာ ပူးပေါင်းဆောင်ရွက်မှု",
                collab_acu_title: "အာဆီယံ-ကိုရီးယား ဆိုက်ဘာတက္ကသိုလ် (ACU)",
                collab_acu_text:
                    "ဒေသတွင်း ဒစ်ဂျစ်တယ်ပညာရေး မြှင့်တင်ရန်အတွက် e-Learning ပရောဂျက်များတွင် ပါဝင်ဆောင်ရွက်လျက်ရှိသည်။",
                collab_mu_title: "မီယာဇာကီ တက္ကသိုလ်၊ ဂျပန်",
                collab_mu_text:
                    "နိုင်ငံတကာ ပညာရေးဖလှယ်မှုကို အားပေးသည့် နှစ်နိုင်ငံ မဟာဘွဲ့ ပရိုဂရမ်ကို ဖွင့်လှစ်ထားသည်။",
                enroll_new_title: "ကျောင်းသား/သူအသစ်များ",
                enroll_new_text:
                    "သင်၏ ပညာရေးခရီးကို ကျွန်ုပ်တို့နှင့်အတူ စတင်လိုက်ပါ။ လာမည့် ပညာသင်နှစ်အတွက် ကျောင်းအပ်ရန် ဤနေရာကို နှိပ်ပါ။",
                enroll_new_button: "ကျောင်းသား/သူအသစ်အဖြစ် စာရင်းသွင်းရန်",
                enroll_current_title: "လက်ရှိကျောင်းသား/သူများ",
                enroll_current_text:
                    "ပြန်လည်ကြိုဆိုပါသည်။ နောက်နှစ်အတွက် ကျောင်းအပ်ခြင်းဖြင့် သင်၏ပညာရေးကို ဆက်လက်သင်ယူပါ။",
                enroll_current_button: "နောက်နှစ်အတွက် စာရင်းသွင်းရန်",
                footer_address:
                    "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
                footer_faculties_title: "မဟာဌာနများ",
                footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
                footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ",
                footer_link_faq: "အမေးများသော မေးခွန်းများ",
                footer_link_about: "ကျွန်ုပ်တို့အကြောင်း",
                footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
                footer_follow_title: "Follow Us",
                footer_copyright:
                    "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
                signup_title: "အကောင့်ပြုလုပ်ရန်",
                signup_subtitle: "UTYCC တွင်ကျောင်းအပ်ရန်",
                signup_name_label: "အမည်",
                signup_email_label: "အီးမေးလ်",
                signup_phone_label: "ဖုန်းနံပါတ်",
                signup_terms_agree: "ကျွန်ုပ်သည်",
                signup_terms_link: "စည်းမျဉ်းများနှင့် မူဝါဒများ ကိုသဘောတူပါသည်။",
                signup_button: "အကောင့်ပြုလုပ်မည်",
                signup_toggle:
                    "အကောင့်ရှိပြီးသားလား? <a id='toggle-to-login-btn'>ဝင်ရောက်ရန်</a>",
                login_title: "ဝင်ရောက်ရန်",
                login_subtitle: "သင်၏အကောင့်သို့",
                login_id_label: "ကျောင်းသား ID",
                login_password_label: "စကားဝှက်",
                login_button: "ဝင်ရောက်မည်",
                login_toggle:
                    "အကောင့်မရှိသေးဘူးလား? <a id='toggle-to-signup-btn'>အသစ်ပြုလုပ်ရန်</a>",
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
                hero_title: "University of Technology - Yatanarpon Cyber City",
                hero_subtitle:
                    "A Leading Engineering Institution for Sustainable Development",
                hero_button: "TO ENROLL",
                stats_since: "Serving Since",
                stats_students: "Students",
                stats_acceptance: "Acceptance Rate",
                stats_quality: "Certified Quality",
                about_title: "Our Vision & Mission",
                about_p1:
                    "Established on 17 October 2010, UTYCC is a public university under the Ministry of Science and Technology, located in Yatanarpon Cyber City, near Pyin Oo Lwin.",
                vision_title: "Vision",
                vision_text:
                    "To be a leading engineering institution for sustainable development.",
                mission_title: "Mission",
                mission_text:
                    "To provide high-quality teaching, research, and socially responsible engineering education.",
                programs_title: "Academic Programs",
                bachelor_title: "Bachelor's Degrees (6 Years)",
                program_ist: "Information Science and Technology (IST)",
                program_ce: "Computer Engineering (CE)",
                program_ece: "Electronics Engineering (EcE)",
                program_pre: "Precision Engineering (PrE)",
                program_ame: "Advanced Materials Engineering (AME)",
                masters_title: "Master's Degrees (2 Years)",
                masters_text:
                    "Master's degrees are offered in IST, CE, ECE, AME, and PrE, combining coursework and a thesis.",
                phd_title: "Doctoral Degree (3 Years)",
                phd_text: "A Ph.D. program is available in Information Technology.",
                collab_title: "International Collaboration",
                collab_acu_title: "ASEAN-KOREA Cyber University (ACU)",
                collab_acu_text:
                    "Engaging in e-Learning projects to enhance digital education across the region.",
                collab_mu_title: "Miyazaki University, Japan",
                collab_mu_text:
                    "Offering a Double Master's Degree program, fostering international academic exchange.",
                enroll_new_title: "New Students",
                enroll_new_text:
                    "Start your journey with us! Click here to enroll for the upcoming academic year.",
                enroll_new_button: "Enroll as a Fresher",
                enroll_current_title: "Current Students",
                enroll_current_text:
                    "Welcome back! Continue your studies by enrolling for the next year.",
                enroll_current_button: "Enroll for Next Year",
                footer_address:
                    "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
                footer_faculties_title: "Faculties",
                footer_faculty_ist: "Information Science Technology",
                footer_faculty_ce: "Computer Engineering",
                footer_faculty_ece: "Electronics Engineering",
                footer_faculty_ame: "Advanced Materials Engineering",
                footer_faculty_pre: "Precision Engineering",
                footer_quick_links_title: "Quick Links",
                footer_link_terms: "Terms & Policies",
                footer_link_faq: "FAQs",
                footer_link_about: "About Us",
                footer_link_rules: "Rules & Regulations",
                footer_follow_title: "Follow Us",
                footer_copyright:
                    "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
                signup_title: "Create Account",
                signup_subtitle: "to enroll at UTYCC",
                signup_name_label: "Name",
                signup_email_label: "Email",
                signup_phone_label: "Phone Number",
                signup_terms_agree: "I agree to the",
                signup_terms_link: "Terms & Policy",
                signup_button: "Create Account",
                signup_toggle:
                    "Already have an account? <a id='toggle-to-login-btn'>Sign In</a>",
                login_title: "Sign In",
                login_subtitle: "to your account",
                login_id_label: "Student ID",
                login_password_label: "Password",
                login_button: "Sign In",
                login_toggle:
                    "Don't have an account? <a id='toggle-to-signup-btn'>Create one</a>",
            },
        };

        // --- Functions ---
        function setLanguage(lang) {
            currentLang = lang;
            localStorage.setItem("selectedLanguage", lang);
            document.querySelectorAll("[data-lang-key]").forEach((el) => {
                const key = el.getAttribute("data-lang-key");
                if (translations[lang] && translations[lang][key]) {
                    el.innerHTML = translations[lang][key];
                }
            });
            // Re-add event listeners for toggles after innerHTML is changed
            document
                .getElementById("toggle-to-login-btn")
                .addEventListener("click", () => switchView("login"));
            document
                .getElementById("toggle-to-signup-btn")
                .addEventListener("click", () => switchView("signup"));

            langSwitcherDesktop.value = lang;
            langSwitcherMobile.value = lang;
        }

        function showToast(message, type = "success", duration = 4000) {
            const toast = document.createElement("div");
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span>${message}</span><button class="close-btn" aria-label="Close">×</button>`;
            const removeToast = () => toast.remove();
            toast
                .querySelector(".close-btn")
                .addEventListener("click", removeToast);
            toastWrap.appendChild(toast);
            setTimeout(removeToast, duration);
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function switchView(viewName) {
            if (viewName === "login") {
                viewSignup.classList.remove("active");
                viewLogin.classList.add("active");
                modalTitle.setAttribute("data-lang-key", "login_title");
                modalSubtitle.setAttribute("data-lang-key", "login_subtitle");
            } else {
                viewLogin.classList.remove("active");
                viewSignup.classList.add("active");
                modalTitle.setAttribute("data-lang-key", "signup_title");
                modalSubtitle.setAttribute("data-lang-key", "signup_subtitle");
            }
            // Re-translate the modal title and subtitle
            setLanguage(currentLang);
        }

        mobileMenuButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        langSwitcherDesktop.addEventListener("change", (e) =>
            setLanguage(e.target.value)
        );
        langSwitcherMobile.addEventListener("change", (e) =>
            setLanguage(e.target.value)
        );

        // --- Modal Logic ---
        newStudentEnrollTrigger.addEventListener("click", () => {
            verificationModal.classList.remove("hidden");
            switchView("signup");
        });

        currentStudentEnrollTrigger.addEventListener("click", () => {
            verificationModal.classList.remove("hidden");
            switchView("login");
        });

        closeModalBtn.addEventListener("click", () => {
            verificationModal.classList.add("hidden");
        });

        verificationModal.addEventListener("click", (e) => {
            if (e.target === verificationModal) {
                verificationModal.classList.add("hidden");
            }
        });

        document
            .getElementById("toggle-to-login-btn")
            .addEventListener("click", () => switchView("login"));
        document
            .getElementById("toggle-to-signup-btn")
            .addEventListener("click", () => switchView("signup"));

        signupTerms.addEventListener("input", () => {
            signupSubmitBtn.disabled = !signupTerms.checked;
        });

        signupForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const name = document.getElementById("signup-name").value.trim();
            const email = document.getElementById("signup-email").value.trim();
            const phone = document.getElementById("signup-phone").value.trim();

            if (!name) {
                showToast("Please enter your name.", "error");
                return;
            }
            if (!isValidEmail(email)) {
                showToast("Please enter a valid email.", "error");
                return;
            }
            if (!phone) {
                showToast("Please enter your phone number.", "error");
                return;
            }

            showToast(
                "Account creation successful! Please wait for admin approval.",
                "success"
            );
            setTimeout(() => verificationModal.classList.add("hidden"), 2000);
        });

        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const studentId = document.getElementById("login-id").value.trim();
            const password = document.getElementById("login-password").value.trim();

            if (!studentId || !password) {
                showToast("Please enter both ID and Password.", "error");
                return;
            }

            showToast("Login successful! Welcome back.", "success");
            setTimeout(() => verificationModal.classList.add("hidden"), 2000);
        });

        // --- GSAP Animation for Stats ---
        const statsSection = document.getElementById('stats-section');
        const studentsStat = document.getElementById('students-stat');
        const acceptanceRateStat = document.getElementById('acceptance-rate-stat');

        const animateStat = (element, endValue, prefix = '', suffix = '', decimals = 0) => {
            const counter = { value: 0 };
            gsap.to(counter, {
                value: endValue,
                duration: 2,
                ease: "power1.out",
                onUpdate: () => {
                    element.textContent = `${prefix}${Math.round(counter.value).toLocaleString()}${suffix}`;
                }
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStat(studentsStat, 3000, '~');
                    animateStat(acceptanceRateStat, 21, '~', '%');
                    observer.unobserve(statsSection); // Animate only once
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of the element is visible
        });

        observer.observe(statsSection);


        // --- Initial Page Load ---
        document.addEventListener("DOMContentLoaded", () => {
            const savedLang = localStorage.getItem("selectedLanguage") || "my";
            setLanguage(savedLang);

            document.querySelectorAll("img").forEach((img) => {
                if (img.src.includes("placehold.co")) {
                    img.onerror = function () {
                        this.src = "https://placehold.co/80x80/cccccc/ffffff?text=Error";
                    };
                }
            });
        });
    </script>

    <!-- animation script -->
    <script>
        gsap.from(".order-2 h2", {
            opacity: 0,
            y: -20,
            duration: 2,
            ease: "power3.out",
            onComplete: () => {
                gsap.to(".order-2 h2", {
                    borderBottom: "3px solid #1e3a8a", // Tailwind blue-900
                    duration: 1,
                });
            },
        });
        gsap.from(".order-2 h3, .order-2 p.text-gray-600", {
            opacity: 0,
            x: -50,
            duration: 2,
            stagger: 1,
            ease: "back.out(1.7)",
        });

        const logos = document.querySelectorAll(".hover_up");

        logos.forEach(logo => {
            logo.addEventListener("mouseenter", () => {
                gsap.to(logo, { scale: 1.1, duration: 0.3, ease: "power1.out" });
            });
            logo.addEventListener("mouseleave", () => {
                gsap.to(logo, { scale: 1, duration: 0.3, ease: "power1.out" });
            });
        });
        // // Game Toggle Script
        // document.addEventListener('DOMContentLoaded', function() {
        //     const gamesLink = document.getElementById("gamesLink");
        //     const gameContainer = document.getElementById("gameContainer");
        //     const closeGameBtn = document.getElementById("closeGameBtn");

        //     // Toggle the game toast on and off when the footer link is clicked
        //     gamesLink.addEventListener("click", (event) => {
        //         event.preventDefault();
        //         gameContainer.classList.toggle("show");
        //     });

        //     // Close the game toast when the close button is clicked
        //     closeGameBtn.addEventListener("click", () => {
        //         gameContainer.classList.remove("show");
        //     });
        // });
    </script>
    <!-- <script>
        // Make sure the DOM is fully loaded before running the script
        document.addEventListener('DOMContentLoaded', function () {
            const gamesLink = document.getElementById("gamesLink");
            const gameContainer = document.getElementById("gameContainer");

            gamesLink.addEventListener("click", (event) => {
                // 1. Prevent the default link behavior (like jumping to the top of the page)
                event.preventDefault();

                // 2. Toggle the 'hidden' class to show/hide the game container
                gameContainer.classList.toggle("hidden");
            });
        });
    </script> -->
    
</body>

</html>