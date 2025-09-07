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
  <title>Terms & Policies - UTYCC</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="./CSS/hero-carousel.css" />
  <script src="./JS/hero-carousel.js"></script>
  <link rel="stylesheet" href="CSS/font.css" />
  <meta name="robots" content="noindex, nofollow">
    <!-- GSAP CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <!-- === Game Stylesheet === -->
  <link rel="stylesheet" href="./CSS/game-style.css" />
  <!-- === End Game Stylesheet === -->

  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="bg-white shadow-md sticky top-0 z-50">
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
          data-lang-key="nav_about">ကျွန်ုပ်တို့အကြောင်း</a>
        <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity">လှုပ်ရှားမှုများ</a>
        <a href="./exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult">အောင်စာရင်းများ</a>
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
            <option value="en">English</option>
          </select>
        </div>
      </div>
      <button id="mobile-menu-button" class="md:hidden text-blue-900">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
      <br><br>
      <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about_mobile">ကျွန်ုပ်တို့အကြောင်း</a>
          <br><br>
        <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity_mobile">လှုပ်ရှားမှုများ</a>
          <br><br>
        <a href="./exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult_mobile">အောင်စာရင်းများ</a>
          <br><br>
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
          <option value="en">English</option>
        </select>
      </div>
    </div>
  </div>


  <main class="container mx-auto px-6 py-12 animate-section">
    <div class="bg-white p-8 md:p-12 rounded-lg shadow-lg">
      <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 animate-title" data-lang-key="terms_policies_title">Terms & Policies</h1>
      <p class="text-gray-600 mb-10 animate-title" data-lang-key="terms_policies_intro">
        Welcome to the UTYCC Student Registration Website. By accessing and using this website, you agree to comply with and be bound by the following terms and policies. Please read them carefully.
      </p>

      <section class="mb-10">
        <h2 class="text-2xl font-semibold text-blue-800 mb-4" data-lang-key="section_terms_title">1. Terms and Conditions</h2>
        <p class="text-gray-700 mb-4" data-lang-key="section_terms_intro">
          This section outlines the rules and guidelines for using our student registration services.
        </p>

        <div class="space-y-6 text-gray-700">
          <article>
            <h3 class="font-bold text-lg mb-2 animate-title" data-lang-key="terms_account_section">1.1. User Accounts and Eligibility</h3>
            <p class="animate-fade" data-lang-key="account_eligible">
              To register for courses and access certain features, you must create a user account. You must be a currently enrolled student at UTYCC to be eligible to use this service.
            </p>
          </article>

          <article>
            <h3 class="font-bold text-lg mb-2 animate-title" data-lang-key="terms_conduct_section">1.2. Prohibited Conduct</h3>
            <p class="animate-fade" data-lang-key="prohibit_act">
              You agree not to use this website for any unlawful or prohibited activities, including, but not limited to:
            </p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1 ">
              <li class="animate-fade" data-lang-key="prohibit_1">Attempting to access unauthorized data or accounts.</li>
              <li class="animate-fade" data-lang-key="prohibit_2">Providing false or misleading information during registration.</li>
              <li class="animate-fade" data-lang-key="prohibit_3">Interfering with the operation of the website or its security features.</li>
            </ul>
          </article>

          <article>
            <h3 class="font-bold text-lg mb-2 animate-title" data-lang-key="terms_intellectual_section">1.3. Intellectual Property</h3>
            <p class="animate-fade" data-lang-key="intellectual_property">
              All content on this website, including text, graphics, and code, is the property of UTYCC and is protected by copyright and intellectual property laws. You may not copy, reproduce, or distribute any content without prior written permission.
            </p>
          </article>
        </div>
      </section>

      <section>
        <h2 class="text-2xl font-semibold text-blue-800 mb-4  animate-title" data-lang-key="section_privacy_title">2. Privacy Policy</h2>
        <p class="text-gray-700 mb-4 animate-fade" data-lang-key="section_privacy_intro">
          This policy explains how UTYCC collects, uses, and protects your personal information.
        </p>
        <p class="text-gray-700 mb-6 italic animate-fade" data-lang-key="privacy_effective_date">
          Effective Date: August 10, 2025
        </p>

        <div class="space-y-6 text-gray-700">
          <article>
            <h3 class="font-bold text-lg mb-2 animate-title" data-lang-key="privacy_data_collection_section">2.1. Information We Collect</h3>
            <p class="animate-fade" data-lang-key="data_collection_intro">
              We collect information that you provide directly to us during the registration process, including:
            </p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li class="animate-fade" data-lang-key="personal_details">Personal Identifiers (e.g., name, student ID, date of birth).</li>
              <li class="animate-fade" data-lang-key="contact_info">Contact Information (e.g., email address, phone number, address).</li>
              <li class="animate-fade" data-lang-key="academic_info">Academic Information (e.g., major, year of study, course selections).</li>
            </ul>
          </article>

          <article>
            <h3 class="font-bold text-lg mb-2 animate-title" data-lang-key="privacy_data_use_section">2.2. How We Use Your Information</h3>
            <p class="animate-fade" data-lang-key="info_used_in">
              The information we collect is used to:
            </p>
            <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
              <li class="animate-fade" data-lang-key="registration">Process your course registration and academic records.</li>
              <li class="animate-fade" data-lang-key="studies_announce">Communicate with you regarding your studies and university announcements.</li>
              <li class="animate-fade" data-lang-key="impro_functionality">Improve our services and website functionality.</li>
            </ul>
          </article>

          <article>
            <h3 class="font-bold text-lg mb-2 animate-title" data-lang-key="privacy_data_sharing_section">2.3. Data Sharing</h3>
            <p class="animate-fade" data-lang-key="data_sharing_P">
              We do not sell your personal information. Your data may be shared with internal university departments and third-party service providers (e.g., academic software) only as necessary to provide our services and manage your academic records.
            </p>
          </article>

          <article>
            <h3 class="font-bold text-lg mb-2 addEventListener" data-lang-key="privacy_security_section">2.4. Data Security</h3>
            <p class="animate-fade" data-lang-key="security_P">
              We implement reasonable security measures to protect your personal information from unauthorized access, alteration, or disclosure.
            </p>
          </article>
        </div>
      </section>
    </div>
  </main>

  <footer id="contact" class="bg-blue-900 text-white">
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
              <a href="./terms.php" class="hover:text-white shine_text"
                data-lang-key="footer_link_terms">Terms &
                Policies</a>
            </li>
            <li>
              <a href="./FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
            </li>
            <li>
              <a href="./about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
            </li>
            <li>
              <a href="./randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules &
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

  <!-- === Game HTML Elements === -->
  <div id="sj-game-toast" class="sj-game-toast-hidden">
      <p>Bored, wanna play a game?</p>
      <div class="sj-game-toast-buttons">
          <button id="sj-game-toast-yes">Yes</button>
          <button id="sj-game-toast-no">No</button>
      </div>
  </div>

  <div id="sj-game-modal-overlay" class="sj-game-modal-hidden">
      <div id="sj-game-modal-content">
          <button id="sj-game-modal-close-top">&times;</button>
          <div class="sj-game-header">
              <img src="./Img/logo/utycc_logo.png" alt="UTYCC Logo">
              <div class="sj-game-title-container">
                  <h1 class="sj-game-h1">Super Jumper</h1>
              </div>
              <div class="sj-game-score-container">
                  <div>SCORE: <span id="sj-game-score">0</span></div>
                  <div class="sj-game-best-score">BEST: <span id="sj-game-highScore">0</span></div>
              </div>
          </div>
          <canvas id="sj-game-canvas"></canvas>
          <div id="sj-game-countdown" class="sj-game-countdown-hidden"></div>
          <div class="sj-game-touch-controls">
              <div id="sj-game-leftBtn" class="sj-game-touch-btn">&#9664;</div>
              <div id="sj-game-jumpBtn" class="sj-game-touch-btn sj-game-jump-btn">&#9650;</div>
              <div id="sj-game-rightBtn" class="sj-game-touch-btn">&#9654;</div>
          </div>
          <div id="sj-game-over-screen" class="sj-game-over-hidden">
              <h2>GAME OVER</h2>
              <button id="sj-game-play-again">Play Again</button>
              <button id="sj-game-modal-close-bottom">Close</button>
          </div>
      </div>
  </div>
  <!-- === End Game HTML === -->


    <script>
    // --- Mobile Menu and Smooth Scroll Script ---
    const navLinks = document.querySelectorAll(".nav-link");
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    navLinks.forEach((link) => {
      link.addEventListener("click", () => {
        const targetId = link.getAttribute("href");
        document.querySelector(targetId).scrollIntoView({
          behavior: "smooth"
        });
      });
    });

    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
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
        terms_policies_title: "စည်းမျဉ်းများနှင့် မူဝါဒများ",
        terms_policies_intro: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ၏ ကျောင်းသားမှတ်ပုံတင် ဝက်ဘ်ဆိုဒ်မှ ကြိုဆိုပါသည်။ ဤဝက်ဘ်ဆိုဒ်ကို ဝင်ရောက်အသုံးပြုပါက အောက်ဖော်ပြပါ စည်းမျဉ်းများနှင့် မူဝါဒများကို လိုက်နာရန် သဘောတူရပါမည်။ ကျေးဇူးပြု၍ သေချာဖတ်ရှုပါ။",
        section_terms_title: "၁။ စည်းမျဉ်းစည်းကမ်းများ",
        section_terms_intro: "ဤအပိုင်းတွင် ကျွန်ုပ်တို့၏ ကျောင်းသားမှတ်ပုံတင်ခြင်း ဝန်ဆောင်မှုများကို အသုံးပြုရန်အတွက် စည်းမျဉ်းများနှင့် လမ်းညွှန်ချက်များကို ဖော်ပြထားပါသည်။",
        terms_account_section: "၁.၁။ သုံးစွဲသူအကောင့်နှင့် အရည်အချင်းပြည့်မီမှု",
        account_eligible: "သင်တန်းများကို စာရင်းသွင်းခြင်းနှင့် အချို့သော လုပ်ဆောင်ချက်များကို အသုံးပြုနိုင်ရန်အတွက် သင့်ကိုယ်ပိုင် အသုံးပြုသူအကောင့်တစ်ခု ဖန်တီးရပါမည်။ဤဝန်ဆောင်မှုကို အသုံးပြုနိုင်ရန် နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) တွင် လက်ရှိစာရင်းသွင်းထားသော ကျောင်းသား/သူဖြစ်ရပါမည်။",
        terms_conduct_section: "၁.၂။ တားမြစ်ထားသော အပြုအမူ",
        prohibit_act: "သင့်အနေဖြင့် ဤဝဘ်ဆိုဒ်ကို တရားမဝင်သော သို့မဟုတ် တားမြစ်ထားသော လှုပ်ရှားမှုများအတွက် အသုံးမပြုရန် သဘောတူရပါမည်။ ထိုအတွင်း ပါဝင်ပြီး ကန့်သတ်မထားသည့် လှုပ်ရှားမှုများမှာ–",
        prohibit_1: "ခွင့်မပြုထားသည့် အချက်အလက်များ သို့မဟုတ် အခြားသူ၏ အကောင့်များကို ဝင်ရောက်ကြိုးပမ်းခြင်း။",
        prohibit_2: "မှတ်ပုံတင် စာရင်းပေးသွင်းစဉ် အမှန်မဟုတ်သော သို့မဟုတ် လိမ်လည်ထားသော အချက်အလက်များ ဖြည့်သွင်းပေးခြင်း။",
        prohibit_3: "ဝဘ်ဆိုဒ်၏ လုပ်ငန်းစဉ် သို့မဟုတ် လုံခြုံရေးအင်္ဂါရပ်များကို ချိုးဖောက်အနှောင့်အယှက် ဖြစ်စေခြင်း။",
        terms_intellectual_section: "၁.၃။ ဉာဏပစ္စည်းမူပိုင်ခွင့်",
        intellectual_property: "ဤဝဘ်ဆိုဒ်ရှိ အကြောင်းအရာများအားလုံး (စာသားများ၊ ရုပ်ပုံများနှင့် ကုဒ်များ အပါအဝင်)သည် နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ၏ ပိုင်ဆိုင်မှုဖြစ်ပြီး မူပိုင်ခွင့်နှင့် ဉာဏပညာ၏ ပိုင်ဆိုင်မှုဆိုင်ရာ ဥပဒေများအောက်တွင် ကာကွယ်ထားပါသည်။ တရားဝင်ရေးစာဖြင့် ကြိုတင် ခွင့်ပြုချက်မရရှိဘဲ အကြောင်းအရာများကို မိတ္တူကူးခြင်း၊ မူပွားခြင်း သို့မဟုတ် ဖြန့်ချိခြင်း မပြုရပါ။",
        section_privacy_title: "၂။ ကိုယ်ရေးကိုယ်တာ မူဝါဒ",
        section_privacy_intro: "ဤမူဝါဒသည် သင့်ကိုယ်ရေးကိုယ်တာအချက်အလက်များကို နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) မှ မည်သို့စုဆောင်း၊ အသုံးပြုပြီး ကာကွယ်ပေးသည်ကို ရှင်းပြထားသည်။",
        privacy_effective_date: "အသက်ဝင်သည့်ရက်စွဲ: ၂၀၂၅ ခုနှစ်၊ ဩဂုတ်လ ၁၀ ရက်",
        privacy_data_collection_section: "၂.၁။ ကျွန်ုပ်တို့စုဆောင်းသော အချက်အလက်များ",
        data_collection_intro: "ကျွန်ုပ်တို့သည် ကျောင်းသား/သူအဖြစ် မှတ်ပုံတင် စာရင်းပေးသွင်းခြင်း လုပ်ငန်းစဉ်အတွင်း ကျောင်းသား/သူများထံမှ တိုက်ရိုက်ပေးသော အချက်အလက်များကို စုဆောင်းထားရှိပါသည်။ ထိုအချက်အလက်များတွင် ပါဝင်သည့်အရာများမှာ–",
        personal_details: "ကိုယ်ပိုင်အမည်များ (ဥပမာ – အမည်၊ ကျောင်းသားအမှတ်၊ မွေးသက္ကရာဇ်)",
        contact_info: "ဆက်သွယ်ရန်အချက်အလက်များ (ဥပမာ – အီးမေးလ်၊ ဖုန်းနံပါတ်၊ လိပ်စာ)",
        academic_info: "ပညာရေးဆိုင်ရာအချက်အလက်များ (ဥပမာ – အဓိကမေဂျာဘာသာရပ်၊ သင်ယူသည့်နှစ်၊ ရွေးချယ်သည့်ဘာသာများ)",
        privacy_data_use_section: "၂.၂။ သင့်အချက်အလက်များကို ကျွန်ုပ်တို့ မည်သို့အသုံးပြုသနည်း",
        info_used_in: "ကျွန်ုပ်တို့ စုဆောင်းသည့် အချက်အလက်များကို အောက်ပါအတွက် အသုံးပြုပါသည်–",
        registration: "ကျောင်းသား/သူ ၏ သင်တန်း မှတ်ပုံတင်ခြင်းနှင့် ပညာရေးဆိုင်ရာ မှတ်တမ်းများကို စီမံဆောင်ရွက်ရန်။",
        studies_announce: "ကျောင်းသား/သူ ၏ သင်ကြားမှုများနှင့် တက္ကသိုလ်၏ အသိပေးကြေညာချက်များ နှင့် ပတ်သက်၍ ဆက်သွယ်ရန်။",
        impro_functionality: "ကျွန်ုပ်တို့၏ ဝန်ဆောင်မှုများနှင့် ဝဘ်ဆိုဒ် လည်ပတ်မှုကို တိုးတက်ကောင်းမွန်စေရန်။",
        privacy_data_sharing_section: "၂.၃။ အချက်အလက်များ မျှဝေခြင်း",
        data_sharing_P: "ကျွန်ုပ်တို့သည် သင်၏ ကိုယ်ပိုင်အချက်အလက်များကို ရောင်းချမည်မဟုတ်ပါ။ သင်၏ အချက်အလက်များကို ကျွန်ုပ်တို့၏ ဝန်ဆောင်မှုများပေးစွမ်းရန်နှင့် သင်၏ ပညာရေးမှတ်တမ်းများကို စီမံခန့်ခွဲရန် လိုအပ်သည့် တက္ကသိုလ်အတွင်းရှိ ဌာနများနှင့် တစ်ဆင့်ဝန်ဆောင်မှုပေးသူများ (ဥပမာ – ပညာရေးဆိုင်ရာ ဆော့ဖ်ဝဲ) ထံသာ မျှဝေသွားနိုင်ပါသည်။",
        privacy_security_section: "၂.၄။ အချက်အလက်လုံခြုံရေး",
        security_P: "ကျွန်ုပ်တို့သည် သင်၏ ကိုယ်ပိုင်အချက်အလက်များကို ခွင့်မပြုထားသည့် ဝင်ရောက်မှု၊ ပြင်ဆင်မှု သို့မဟုတ် ဖော်ပြမှုမှ ကာကွယ်ရန် သင့်တော်သော လုံခြုံရေးအစီအစဉ်များကို လုပ်ဆောင်ပါသည်။",
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
        terms_policies_title: "Terms & Policies",
        terms_policies_intro: "Welcome to the UTYCC Student Registration Website. By accessing and using this website, you agree to comply with and be bound by the following terms and policies. Please read them carefully.",
        section_terms_title: "1. Terms and Conditions",
        section_terms_intro: "This section outlines the rules and guidelines for using our student registration services.",
        terms_account_section: "1.1. User Accounts and Eligibility",
        account_eligible: "To register for courses and access certain features, you must create a user account. You must be a currently enrolled student at UTYCC to be eligible to use this service.",
        terms_conduct_section: "1.2. Prohibited Conduct",
        prohibit_act: "You agree not to use this website for any unlawful or prohibited activities, including, but not limited to:",
        prohibit_1: "Attempting to access unauthorized data or accounts.",
        prohibit_2: "Providing false or misleading information during registration.",
        prohibit_3: "Interfering with the operation of the website or its security features.",
        terms_intellectual_section: "1.3. Intellectual Property",
        intellectual_property: "All content on this website, including text, graphics, and code, is the property of UTYCC and is protected by copyright and intellectual property laws. You may not copy, reproduce, or distribute any content without prior written permission.",
        section_privacy_title: "2. Privacy Policy",
        section_privacy_intro: "This policy explains how UTYCC collects, uses, and protects your personal information.",
        privacy_effective_date: "Effective Date: August 10, 2025",
        privacy_data_collection_section: "2.1. Information We Collect",
        data_collection_intro: "We collect information that you provide directly to us during the registration process, including:",
        personal_details: "Personal Identifiers (e.g., name, student ID, date of birth).",
        contact_info: "Contact Information (e.g., email address, phone number, address).",
        academic_info: "Academic Information (e.g., major, year of study, course selections).",
        privacy_data_use_section: "2.2. How We Use Your Information",
        info_used_in: "The information we collect is used to:",
        registration: "Process your course registration and academic records.",
        studies_announce: "Communicate with you regarding your studies and university announcements.",
        impro_functionality: "Improve our services and website functionality.",
        privacy_data_sharing_section: "2.3. Data Sharing",
        data_sharing_P: "We do not sell your personal information. Your data may be shared with internal university departments and third-party service providers (e.g., academic software) only as necessary to provide our services and manage your academic records.",
        privacy_security_section: "2.4. Data Security",
        security_P: "We implement reasonable security measures to protect your personal information from unauthorized access, alteration, or disclosure.",
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

    const desktopLanguageSwitcher = document.getElementById("language-switcher-desktop");
    const mobileLanguageSwitcher = document.getElementById("language-switcher-mobile");

    const changeLanguage = (lang) => {
      localStorage.setItem("language", lang);
      if (desktopLanguageSwitcher) {
        desktopLanguageSwitcher.value = lang;
      }
      if (mobileLanguageSwitcher) {
        mobileLanguageSwitcher.value = lang;
      }
      document.querySelectorAll("[data-lang-key]").forEach((element) => {
        const key = element.dataset.langKey;
        const translation = translations[lang][key];
        if (translation) {
          element.innerHTML = translation.replace(/\\n/g, "<br>");
        }
      });
    };

    if (desktopLanguageSwitcher) {
      desktopLanguageSwitcher.addEventListener("change", (event) => {
        changeLanguage(event.target.value);
      });
    }

    if (mobileLanguageSwitcher) {
      mobileLanguageSwitcher.addEventListener("change", (event) => {
        changeLanguage(event.target.value);
      });
    }

    document.addEventListener("DOMContentLoaded", () => {
      const savedLang = localStorage.getItem("language") || "en";
      changeLanguage(savedLang);
    });
  </script>
  <!-- gsap animation -->
    <script>
    gsap.registerPlugin(ScrollTrigger);

    // Title animation
    gsap.from(".animate-title", {
      y: -50,
      opacity: 0,
      duration: 1,
      ease: "power3.out"
    });

    // Intro fade in
    gsap.from(".animate-fade", {
      opacity: 0,
      duration: 1.2,
      delay: 0.5,
      ease: "power2.out"
    });

    // Sections fade in on scroll
    gsap.utils.toArray(".animate-section").forEach((section) => {
      gsap.from(section, {
        scrollTrigger: {
          trigger: section,
          start: "top 85%",
        },
        y: 40,
        opacity: 0,
        duration: 1,
        ease: "power2.out"
      });
    });
  </script>
  <script src="./js/lgl.js"></script>

  <!-- === Game Script === -->
  <script src="./js/game-script.js"></script>
  <!-- === End Game Script === -->

</body>

</html>
