<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="./CSS/star-layout.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" href="./CSS/footer.css" />
  <script src="./JS/star-layout.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Protection - UTYCC</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="./CSS/hero-carousel.css" />
  <script src="./JS/hero-carousel.js"></script>
  <link rel="stylesheet" href="CSS/font.css" />
    <link rel="stylesheet" href="./CSS/shine_text.css" />
    <script src="./JS/animation_trigger.js"></script>
  <meta name="robots" content="noindex, nofollow">
    <!-- GSAP CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  <style>
    body {
      font-family: "Inter", sans-serif;
      overflow-x: hidden; /* Prevent horizontal scrollbars from animations */
    }
    .policy-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .policy-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .hero-icon {
        position: absolute;
        right: 10%;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12rem;
        opacity: 0.05;
        color: #1e3a8a; /* Using a color from the existing palette */
        z-index: 1;
        pointer-events: none;
    }
  </style>
</head>

<body class="bg-gray-100">
  <!-- Replicated Header from term&policies.php -->
  <header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="./home.php" class="flex items-center space-x-3">
        <div class="p-2 rounded-lg">
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        </div>
        <div>
          <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
          <span class="text-xs text-gray-500" data-lang-key="utycc_full_name">University of Technology (Yatanarpon Cyber
            City)</span>
        </div>
      </a>
      <div class="hidden md:flex items-center space-x-6">
        <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about">About Us</a>
        <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity">Activities</a>
        <a href="/Rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult">Exam Results</a>
        <!-- Language Switcher Dropdown - Updated Style -->
        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <!-- Custom Button -->
            <button
              class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
                class="h-4 w-6 object-cover flex-shrink-0">
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
                  class="h-4 w-6 mr-3 object-cover flex-shrink-0">
                <span>မြန်မာ</span>
              </a>
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                data-lang="en">
                <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
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
      <br><br>
      <a href="./about.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about_mobile">About Us</a>
        <a href="./activity.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity_mobile">Activities</a>
        <a href="/Rform/examResults.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult_mobile">Exam Results</a>
      <div class="relative mt-4 pt-4 border-t">
        <!-- Language Switcher for Mobile -->
        <div id="lang-switcher-container-mobile" class="relative">
          <!-- Custom Button -->
          <button
            class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
              class="h-4 w-6 object-cover flex-shrink-0">
            <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
            <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
          </button>
          <!-- Custom Dropdown Menu -->
          <div
            class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="my">
              <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                class="h-4 w-6 mr-3 object-cover flex-shrink-0">
              <span>မြန်မာ</span>
            </a>
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="en">
              <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
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
  </header>

  <!-- Main Content Section for Data Protection -->
  <main class="container mx-auto px-6 py-12">
    <!-- Hero Section -->
    <div class="relative bg-white p-8 md:p-12 rounded-lg shadow-lg mb-12 overflow-hidden animate-section">
        <i class="fas fa-shield-alt hero-icon"></i>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-blue-900 mb-4 animate-title" data-lang-key="dataprotection_title">Data Protection Policy</h1>
            <p class="text-gray-600 max-w-3xl text-lg animate-fade" data-lang-key="dataprotection_intro">
                The University of Technology (Yatanarpon Cyber City) is committed to protecting the privacy and security of your personal data. This policy outlines our principles for handling your information and your rights concerning your data.
            </p>
        </div>
    </div>

    <!-- Principles Section -->
    <section class="mb-16 animate-section">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-semibold text-blue-800 animate-title" data-lang-key="section_principles_title">1. Key Data Protection Principles</h2>
            <p class="text-gray-700 mt-2 max-w-2xl mx-auto animate-fade" data-lang-key="section_principles_intro">
                We adhere to the following core principles when processing your personal data:
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-balance-scale text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="principles_legality_section">1.1. Lawfulness, Fairness, and Transparency</h3>
                <p class="text-gray-600 text-sm" data-lang-key="legality_description">
                    Your data is processed in a lawful, fair, and transparent manner. We will inform you about what data we are collecting, why, and how it will be used.
                </p>
            </div>
            <!-- Card 2 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-bullseye text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="principles_purpose_section">1.2. Purpose Limitation</h3>
                <p class="text-gray-600 text-sm" data-lang-key="purpose_description">
                    We collect your data only for specific, explicit, and legitimate purposes related to your university registration and studies. Your data will not be used for any other purposes without your consent.
                </p>
            </div>
            <!-- Card 3 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-compress-arrows-alt text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="principles_minimisation_section">1.3. Data Minimisation</h3>
                <p class="text-gray-600 text-sm" data-lang-key="minimisation_description">
                    We only collect data that is necessary and relevant for the stated purpose. We avoid collecting excessive information.
                </p>
            </div>
            <!-- Card 4 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-check-circle text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="principles_accuracy_section">1.4. Accuracy</h3>
                <p class="text-gray-600 text-sm" data-lang-key="accuracy_description">
                    We take all reasonable steps to ensure your personal data is accurate and, where necessary, kept up to date. You have the right to request a correction if your data is inaccurate.
                </p>
            </div>
            <!-- Card 5 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-hourglass-end text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="principles_storage_section">1.5. Storage Limitation</h3>
                <p class="text-gray-600 text-sm" data-lang-key="storage_description">
                    Your data is stored for no longer than is necessary. Once no longer needed, it will be securely deleted or anonymized.
                </p>
            </div>
        </div>
    </section>

    <!-- Rights Section -->
    <section class="animate-section">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-semibold text-blue-800 animate-title" data-lang-key="section_your_rights_title">2. Your Rights</h2>
            <p class="text-gray-700 mt-2 max-w-2xl mx-auto animate-fade" data-lang-key="section_your_rights_intro">
                As a student, you have the following rights regarding your personal data:
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Right 1 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-eye text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="rights_access_section">2.1. Right to Access</h3>
                <p class="text-gray-600 text-sm" data-lang-key="rights_access_P">
                    You have the right to request a copy of the personal data we hold about you.
                </p>
            </div>
            <!-- Right 2 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-pencil-alt text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="rights_rectification_section">2.2. Right to Rectification</h3>
                <p class="text-gray-600 text-sm" data-lang-key="rights_rectification_P">
                    You have the right to have any inaccurate or incomplete data corrected.
                </p>
            </div>
            <!-- Right 3 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-trash-alt text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="rights_erasure_section">2.3. Right to Erasure</h3>
                <p class="text-gray-600 text-sm" data-lang-key="rights_erasure_P">
                    You may request the deletion of your personal data where there is no legitimate reason for us to continue processing it.
                </p>
            </div>
            <!-- Right 4 -->
            <div class="policy-card bg-white p-6 rounded-lg shadow-md text-center">
                <i class="fas fa-hand-paper text-4xl text-blue-500 mb-4"></i>
                <h3 class="font-bold text-lg mb-2 text-blue-900" data-lang-key="rights_objection_section">2.4. Right to Object</h3>
                <p class="text-gray-600 text-sm" data-lang-key="rights_objection_P">
                    You have the right to object to the processing of your personal data in certain circumstances.
                </p>
            </div>
        </div>
    </section>
  </main>

  <!-- Replicated Footer from term&policies.php -->
  <footer id="contact" class="bg-blue-900 text-white mt-16">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4 hover_up" />
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 text-sm mt-4">
            <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
              Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
              Region, Myanmar
            </a>
          </p>
          <div class="mt-4 text-sm text-blue-200">
                        <p>Email: info@utycc.site utyccstudentaffair2010@gmail.com</p>
                        <p>Phone: +959445767834 </p>
                    </div>
        </div>
        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">
            Faculties
          </h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li>
              <a href="./Majors/ist.php" data-lang-key="footer_faculty_ist">Information Science
                Technology</a>
            </li>
            <li>
              <a href="./Majors/ce.php" data-lang-key="footer_faculty_ce">Computer Engineering</a>
            </li>
            <li>
              <a href="./Majors/ece.php" data-lang-key="footer_faculty_ece">Electronics Engineering</a>
            </li>
            <li>
              <a data-lang-key="footer_faculty_pre" href="./Majors/pre.php">Precision Engineering</a>
            </li>
            <li>
              <a data-lang-key="footer_faculty_ame" href="./Majors/ame.php">Advanced Materials
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
              <a href="./terms.php" class="hover:text-white " data-lang-key="footer_link_terms">Terms &
                Policies</a>
            </li>
            <li>
              <a href="./FAQs.php" class="hover:text-white " data-lang-key="footer_link_faq">FAQs</a>
            </li>
            <li>
              <a href="./about.php" class="hover:text-white " data-lang-key="footer_link_about">About Us</a>
            </li>
            <li>
              <a href="./randr.php" class="hover:text-white " data-lang-key="footer_link_rules">Rules &
                Regulations</a>
            </li>
            <li>
              <a href="./data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a>
            </li>
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

  <script>
    // --- Mobile Menu ---
    document.getElementById("mobile-menu-button").addEventListener("click", () => {
      document.getElementById("mobile-menu").classList.toggle("hidden");
    });
  </script>

  <script>
    // --- Translation Script ---
    const translations = {
      my: {
        utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
          nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity_mobile: "လှုပ်ရှားမှုများ",
        nav_examresult_mobile: "အောင်စာရင်း",
        dataprotection_title: "ဒေတာကာကွယ်ရေး မူဝါဒ",
        dataprotection_intro: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) သည် သင့်ကိုယ်ပိုင် ကိုယ်ရေးအချက်အလက်များ၏ ကိုယ်ရေးကိုယ်တာနှင့် လုံခြုံရေးကို ကာကွယ်ရန် ကတိပြုပါသည်။ ဤမူဝါဒသည် သင့်အချက်အလက်များကို ကိုင်တွယ်မည့် ကျွန်ုပ်တို့၏ စည်းမျဉ်းများအပြင် သင်၏ အချက်အလက်များနှင့် ပတ်သက်၍ သင့်အခွင့်အရေးများကိုပါ ဖော်ပြထားပါသည်။",
        section_principles_title: "၁။ အဓိက ဒေတာကာကွယ်ရေး အခြေခံမူများ",
        section_principles_intro: "သင်၏ ကိုယ်ရေးကိုယ်တာအချက်အလက်များကို ဆောင်ရွက်ရာတွင် အောက်ဖော်ပြပါ အခြေခံမူများကို ကျွန်ုပ်တို့လိုက်နာသည်-",
        principles_legality_section: "၁.၁။ ဥပဒေနှင့်ညီမှု၊ တရားမျှတမှု နှင့် ပွင့်လင်းမြင်သာမှု",
        legality_description: "သင့်အချက်အလက်များကို တရားဝင် တရားမျှတပြီး ပြတ်သားစွာ ဆောင်ရွက်ပါသည်။ ကျွန်ုပ်တို့သည် အချက်အလက်များကို အဘယ်ကြောင့် စုဆောင်းထားကြောင်း၊ ဘာကြောင့် စုဆောင်းထားကြောင်း နှင့် ၎င်းတို့ကို ဘယ်လိုအသုံးပြုမည်ကို သင့်အား အသိပေးပါမည်။",
        principles_purpose_section: "၁.၂။ ရည်ရွယ်ချက် ကန့်သတ်ချက်",
        purpose_description: "ကျွန်ုပ်တို့သည် သင့်အချက်အလက်များကို တက္ကသိုလ်ကျောင်းသား/သူအဖြစ် မှတ်ပုံတင်ခြင်းနှင့် သင်တန်းဆိုင်ရာ လေ့လာမှုများနှင့် သက်ဆိုင်သော တိကျပြတ်သားပြီး တရားဝင်သော ရည်ရွယ်ချက်များအတွက်သာ စုဆောင်းပါသည်။ သင်၏ သဘောတူညီချက်မရှိဘဲ အချက်အလက်များကို အခြားရည်ရွယ်ချက်များအတွက် အသုံးပြုမည် မဟုတ်ပါ။",
        principles_minimisation_section: "၁.၃။ ဒေတာလျှော့ချခြင်း",
        minimisation_description: "ကျွန်ုပ်တို့သည် အထက်ဖော်ပြပါ ရည်ရွယ်ချက်အတွက် လိုအပ်ပြီး သက်ဆိုင်သော အချက်အလက်များကိုသာ စုဆောင်းပါသည်။ မလိုအပ်သော အချက်အလက်များကို စုဆောင်းခြင်း မပြုပါ။",
        principles_accuracy_section: "၁.၄။ တိကျမှု",
        accuracy_description: "ကျွန်ုပ်တို့သည် သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များကို တိကျမှန်ကန်မှုရှိစေရန်၊ လိုအပ်လျှင် နောက်ဆုံးအခြေအနေအတိုင်း ထိန်းသိမ်းထားစေရန် စီမံချက်အားလုံးကို လုပ်ဆောင်ပါသည်။ အကယ်၍ သင့်အချက်အလက်များ မှားနေပါက ပြန်လည်ပြင်ဆင်ရန် တောင်းဆိုခွင့်ရှိပါသည်။",
        principles_storage_section: "၁.၅။ သိုလှောင်မှု ကန့်သတ်ချက်",
        storage_description: "ကျွန်ုပ်တို့သည် သင့်အချက်အလက်များကို စုဆောင်းခဲ့သည့် ရည်ရွယ်ချက်များအတွက်သာ လိုအပ်သည့် ကာလအတွင်း သိမ်းဆည်းထားပါသည်။ ၎င်းကာလပြီးဆုံးလျှင် ဒေတာကို လုံခြုံစွာ ဖျက်သိမ်းမည် သို့မဟုတ် အမည်မဖော်နိုင်အောင် ပြင်ဆင်ထားမည် ဖြစ်ပါသည်။",
        section_your_rights_title: "၂။ သင့်အခွင့်အရေးများ",
        section_your_rights_intro: "ကျောင်းသားတစ်ဦးအနေဖြင့် သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များနှင့် ပတ်သက်၍ အောက်ပါအခွင့်အရေးများကို ရရှိပါမည်။",
        rights_access_section: "၂.၁။ ဝင်ရောက်ခွင့်ရပိုင်ခွင့်",
        rights_access_P: "ကျွန်ုပ်တို့ထံတွင် သိမ်းဆည်းထားသည့် သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များကို ကူးယူရန် တောင်းဆိုခွင့် ရှိပါသည်။",
        rights_rectification_section: "၂.၂။ ပြုပြင်ပိုင်ခွင့်",
        rights_rectification_P: "သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များ မှားနေခြင်း သို့မဟုတ် မပြည့်စုံခြင်းရှိပါက ၎င်းတို့ကို ပြန်လည်ပြင်ဆင်ခွင့် ရှိပါသည်။",
        rights_erasure_section: "၂.၃။ ဖျက်ပိုင်ခွင့် (မေ့လျော့ခံပိုင်ခွင့်)",
        rights_erasure_P: "ကျွန်ုပ်တို့သည် သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များကို ဆက်လက်အသုံးပြုရန် တရားဝင်အကြောင်းမရှိပါက ထိုအချက်အလက်များကို ဖျက်ရန် တောင်းဆိုနိုင်ပါသည်။",
        rights_objection_section: "၂.၄။ ကန့်ကွက်ပိုင်ခွင့်",
        rights_objection_P: "အချို့အခြေအနေများတွင် သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များ စီမံခန့်ခွဲခြင်းကို ကန့်ကွက်ခွင့် ရှိပါသည်။",
        footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊<br>ပြင်ဦးလွင်မြို့အနီး၊<br>မန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
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
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
      },
      en: {
        utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
        nav_about: "About Us",
        nav_activity: "Activities",
        nav_examresult: "Exam Results",
        nav_about_mobile: "About Us",
        nav_activity_mobile: "Activities",
        nav_examresult_mobile: "Exam Results",
        dataprotection_title: "Data Protection Policy",
        dataprotection_intro: "The University of Technology (Yatanarpon Cyber City) is committed to protecting the privacy and security of your personal data. This policy outlines our principles for handling your information and your rights concerning your data.",
        section_principles_title: "1. Key Data Protection Principles",
        section_principles_intro: "We adhere to the following core principles when processing your personal data:",
        principles_legality_section: "1.1. Lawfulness, Fairness, and Transparency",
        legality_description: "Your data is processed in a lawful, fair, and transparent manner. We will inform you about what data we are collecting, why, and how it will be used.",
        principles_purpose_section: "1.2. Purpose Limitation",
        purpose_description: "We collect your data only for specific, explicit, and legitimate purposes related to your university registration and studies. Your data will not be used for any other purposes without your consent.",
        principles_minimisation_section: "1.3. Data Minimisation",
        minimisation_description: "We only collect data that is necessary and relevant for the stated purpose. We avoid collecting excessive information.",
        principles_accuracy_section: "1.4. Accuracy",
        accuracy_description: "We take all reasonable steps to ensure your personal data is accurate and, where necessary, kept up to date. You have the right to request a correction if your data is inaccurate.",
        principles_storage_section: "1.5. Storage Limitation",
        storage_description: "Your data is stored for no longer than is necessary. Once no longer needed, it will be securely deleted or anonymized.",
        section_your_rights_title: "2. Your Rights",
        section_your_rights_intro: "As a student, you have the following rights regarding your personal data:",
        rights_access_section: "2.1. Right to Access",
        rights_access_P: "You have the right to request a copy of the personal data we hold about you.",
        rights_rectification_section: "2.2. Right to Rectification",
        rights_rectification_P: "You have the right to have any inaccurate or incomplete data corrected.",
        rights_erasure_section: "2.3. Right to Erasure (Right to be Forgotten)",
        rights_erasure_P: "You may request the deletion of your personal data where there is no legitimate reason for us to continue processing it.",
        rights_objection_section: "2.4. Right to Object",
        rights_objection_P: "You have the right to object to the processing of your personal data in certain circumstances.",
        footer_address: "Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay Region, Myanmar",
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
        footer_link_dp: "Data Protection",
      },
    };
    
    function setLanguage(lang) {
        // Update local storage
        localStorage.setItem("language", lang);

        // Update UI elements for both desktop and mobile
        ['desktop', 'mobile'].forEach(device => {
            const flagImg = document.getElementById(`selected-lang-flag-${device}`);
            const textSpan = document.getElementById(`selected-lang-text-${device}`);
            const select = document.getElementById(`language-switcher-${device}`);
            
            if(select) select.value = lang;

            if (lang === 'my') {
                if(flagImg) flagImg.src = 'https://flagcdn.com/w20/mm.png';
                if(textSpan) textSpan.textContent = 'မြန်မာ';
            } else {
                if(flagImg) flagImg.src = 'https://flagcdn.com/w20/gb.png';
                if(textSpan) textSpan.textContent = 'English';
            }
        });
        
        // Translate all elements with data-lang-key
        document.querySelectorAll("[data-lang-key]").forEach(element => {
            const key = element.dataset.langKey;
            if (translations[lang] && translations[lang][key]) {
                element.innerHTML = translations[lang][key];
            }
        });
    }

    // --- Custom Language Switcher Logic ---
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
                const lang = option.getAttribute('data-lang');
                setLanguage(lang);
                menu.classList.add('hidden');
            });
        });
    }

    document.addEventListener('click', () => {
        document.querySelectorAll('.lang-switcher-menu').forEach(menu => menu.classList.add('hidden'));
    });

    // --- Initialize Language and Switchers on DOMContentLoaded ---
    document.addEventListener("DOMContentLoaded", () => {
      const savedLang = localStorage.getItem("language") || "en";
      setLanguage(savedLang);
      setupLangSwitcher('desktop');
      setupLangSwitcher('mobile');
    });
  </script>
  <!-- gsap animation -->
    <script>
    gsap.registerPlugin(ScrollTrigger);
    
    // Animate sections on scroll
    gsap.utils.toArray(".animate-section").forEach((section) => {
        gsap.from(section, {
            scrollTrigger: {
                trigger: section,
                start: "top 85%",
                toggleActions: "play none none none"
            },
            y: 50,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });
    });

    // Staggered animation for policy cards
    gsap.utils.toArray(".policy-card").forEach((card) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: "top 90%",
                toggleActions: "play none none none"
            },
            y: 40,
            opacity: 0,
            duration: 0.8,
            ease: "power2.out",
        });
    });

    // Animate titles
    gsap.from(".animate-title", {
      scrollTrigger: {
          trigger: ".animate-title",
          start: "top 90%",
          toggleActions: "play none none none"
      },
      y: -30,
      opacity: 0,
      duration: 1,
      ease: "power3.out"
    });

    // Animate fade elements
    gsap.from(".animate-fade", {
      scrollTrigger: {
          trigger: ".animate-fade",
          start: "top 90%",
          toggleActions: "play none none none"
      },
      opacity: 0,
      duration: 1.2,
      delay: 0.3,
      ease: "power2.out"
    });
  </script>

</body>

</html>
