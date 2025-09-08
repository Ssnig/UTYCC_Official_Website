<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>University Rules & Regulations - UTYCC</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Oswald:wght@200..700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./CSS/footer.css">
  
  <!-- GSAP CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <style>
    body {
      font-family: "Inter", sans-serif;
      overflow-x: hidden; /* Prevent horizontal scrollbars */
    }
    .rule-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        background-color: #ffffff;
        border-radius: 0.75rem; /* Slightly more rounded corners */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .rule-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .hero-icon {
        position: absolute;
        right: 10%;
        top: 50%;
        transform: translateY(-50%);
        font-size: 10rem;
        opacity: 0.05;
        color: #1e3a8a;
        z-index: 1;
        pointer-events: none;
    }
    .rule-card ol li {
      position: relative;
      padding-left: 1.75rem; /* More space for the icon */
      list-style: none;
    }
    .rule-card ol li::before {
      content: "\f00c"; /* FontAwesome check icon */
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      left: 0;
      top: 5px;
      color: #3b82f6;
      font-size: 0.9rem;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">
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

        <!-- Language Switcher Dropdown -->
        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <button
              class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
                class="h-4 w-6 object-cover flex-shrink-0">
              <span id="selected-lang-text-desktop" class="ml-2">မြန်မာ</span>
              <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 pointer-events-none"></i>
            </button>
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
       <a href="./about.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about_mobile">About Us</a>
        <a href="./activity.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity_mobile">Activities</a>
        <a href="/Rform/examResults.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult_mobile">Exam Results</a>
      <div class="relative mt-4 pt-4 border-t">
        <div id="lang-switcher-container-mobile" class="relative">
          <button
            class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
              class="h-4 w-6 object-cover flex-shrink-0">
            <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
            <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
          </button>
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
        <select id="language-switcher-mobile" class="hidden">
          <option value="my">မြန်မာ</option>
          <option value="en" selected>English</option>
        </select>
      </div>
    </div>
  </header>

  <main class="container mx-auto px-4 py-8 md:py-12">
    <!-- Hero Section -->
    <div class="relative bg-white p-8 md:p-12 rounded-lg shadow-lg mb-12 overflow-hidden animate-section">
        <i class="fas fa-gavel hero-icon"></i>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-blue-900 mb-4 animate-title" data-lang-key="rules_title">
              Student Rules & Regulations
            </h1>
            <p class="text-gray-600 max-w-3xl text-lg animate-fade">
                A guide to maintaining a respectful, disciplined, and productive academic environment for all students at UTYCC.
            </p>
        </div>
    </div>
    
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- Card 1: Peaceful Learning Environment -->
        <div class="rule-card p-6 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-handshake-angle text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="T1">Peaceful Learning</h2>
            </div>
            <ol class="space-y-3 text-gray-600 flex-grow">
                <li data-lang-key="p1">Students must not directly or indirectly disrupt or cause harm to the peaceful learning environment.</li>
            </ol>
        </div>

        <!-- Card 2: School Discipline -->
        <div class="rule-card p-6 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-user-check text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="T3">School Discipline</h2>
            </div>
            <ol class="space-y-3 text-gray-600 flex-grow">
                <li data-lang-key="p10">All students must attend classes regularly.</li>
                <li data-lang-key="p11">A minimum of <strong>75% class attendance</strong> is required to be eligible for the final exam.</li>
                <li data-lang-key="p12">Students must abide by all rules and regulations set by the university for their courses.</li>
            </ol>
        </div>

        <!-- Card 3: Exam Regulations -->
        <div class="rule-card p-6 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-file-signature text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="T4">Exam Regulations</h2>
            </div>
            <ol class="space-y-3 text-gray-600 flex-grow">
                <li data-lang-key="p13">All students must take the mid-term exam to be eligible for the final exam.</li>
                <li data-lang-key="p14">Cheating or using any dishonest means during an exam will result in severe action.</li>
            </ol>
        </div>

        <!-- Card 4: Moral Misconduct (takes more space) -->
        <div class="rule-card p-6 md:col-span-2 lg:col-span-3 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-ban text-3xl text-red-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="T2">Prohibition of Moral Misconduct</h2>
            </div>
            <ol class="space-y-3 text-gray-600 grid grid-cols-1 md:grid-cols-2 gap-x-6">
                <li data-lang-key="p2">Strictly prohibited from using, possessing, or distributing narcotics. No smoking or betel nut on campus.</li>
                <li data-lang-key="p3">Must not disrespect or harm any university staff, including Rector, teachers, or staff.</li>
                <li data-lang-key="p4">Must not harass or harm female students or other women, on or off campus.</li>
                <li data-lang-key="p5">Gambling, drinking alcohol, or using intoxicants are strictly prohibited on and off campus.</li>
                <li data-lang-key="p6">Must obey the instructions and guidance of their teachers.</li>
                <li data-lang-key="p7">Must not destroy, steal, or forcibly take the property of others.</li>
                <li data-lang-key="p8">Fighting among students or with outsiders is not permitted.</li>
                <li data-lang-key="p9">Must adhere to all university rules, including behavior outside school hours.</li>
            </ol>
        </div>
        
        <!-- Card 5: Dress Code -->
        <div class="rule-card p-6 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-user-tie text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="T5">Dress Code & Conduct</h2>
            </div>
            <ol class="space-y-3 text-gray-600 flex-grow">
                <li data-lang-key="p15">Students must wear the designated uniform and behave in a manner appropriate for a student.</li>
            </ol>
        </div>
        
        <!-- Card 6: Enrollment -->
        <div class="rule-card p-6 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-school-circle-xmark text-3xl text-blue-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="T6">Simultaneous Enrollment</h2>
            </div>
            <ol class="space-y-3 text-gray-600 flex-grow">
                <li data-lang-key="p16">Students are not permitted to be simultaneously enrolled in any other university or institute.</li>
            </ol>
        </div>

        <!-- Card 7: Penalties -->
        <div class="rule-card p-6 bg-blue-50 flex flex-col">
            <div class="flex items-center mb-4">
                <i class="fas fa-exclamation-triangle text-3xl text-yellow-500 mr-4"></i>
                <h2 class="text-xl font-semibold text-blue-900" data-lang-key="V">Penalties for Violation</h2>
            </div>
            <ol class="space-y-3 text-gray-700 flex-grow">
                <li data-lang-key="p17">Failure to comply with or violation of these rules will result in disciplinary action appropriate to the severity of the offense.</li>
            </ol>
        </div>
    </div>
</main>


  <footer id="contact" class="bg-blue-900 text-white mt-16">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" />
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
              <a href="./Majors/ist.php" data-lang-key="footer_faculty_ist">Information Science Technology</a>
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
              <a data-lang-key="footer_faculty_ame" href="./Majors/ame.php">
                Advanced Materials Engineering
              </a>
            </li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
            Quick Links
          </h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li>
              <a href="./terms.php" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a>
            </li>
            <li>
              <a href="./FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
            </li>
            <li>
              <a href="./about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
            </li>
            <li>
              <a href="./randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a>
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
        &copy; 2025 University of Technology - Yatanarpon Cyber City. All
        Rights Reserved.
      </div>
    </div>
  </footer>

  <script>
    // --- Mobile Menu ---
    document.getElementById("mobile-menu-button").addEventListener("click", () => {
      document.getElementById("mobile-menu").classList.toggle("hidden");
    });

    // --- Translation Logic ---
    const translations = {
      my: {
        utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
          nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity_mobile: "လှုပ်ရှားမှုများ",
        nav_examresult_mobile: "အောင်စာရင်း",
        rules_title: "ကျောင်းသား/များအတွက် စည်းကမ်းနှင့် စည်းမျဉ်းများ",
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
        T1: "၁။ ငြိမ်းချမ်းသော သင်ယူမှု ပတ်ဝန်းကျင်",
        T2: "၂။ ကိုယ်ကျင့်တရား ချိုးဖောက်မှု တားမြစ်ခြင်း",
        T3: "၃။ ကျောင်းစည်းကမ်းများကို တင်းကြပ်စွာ လိုက်နာခြင်း",
        T4: "၄။ စာမေးပွဲ စည်းမျဉ်းများကို လိုက်နာခြင်း",
        T5: "၅။ အဝတ်အစားနှင့် အပြုအမူ",
        T6: "၆။ တပြိုင်နက် တက်ရောက်ခြင်း",
        V: " အပြစ်ဒဏ်များ",
        p1: "ကျောင်းသား/သူများသည် ငြိမ်းချမ်းသော သင်ယူမှုပတ်ဝန်းကျင်ကို တိုက်ရိုက်ဖြစ်စေ၊ တစ်ဆင့်ခံဖြစ်စေ ပျက်စီးစေခြင်း သို့မဟုတ် ထိခိုက်စေခြင်း မပြုရ။",
        p2: "ကျောင်းသား/သူများသည် မူးယစ်ဆေးဝါးများကို အသုံးပြုခြင်း၊ ပိုင်ဆိုင်ခြင်း၊ ဝယ်ယူခြင်း၊ ရောင်းချခြင်း သို့မဟုတ် ဖြန့်ဝေခြင်းများကို တင်းကျပ်စွာ တားမြစ်ထားသည်။ အတန်းများ၊ လက်မှုအလုပ်ရုံများနှင့် ကျောင်းတွင်း စသည့်နေရာများတွင် ဆေးလိပ်သောက်ခြင်း သို့မဟုတ် ကွမ်းစားခြင်းများကိုလည်း တင်းကျပ်စွာတားမြစ်ထားသည်။",
        p3: "ကျောင်းသား/သူများသည် တက္ကသိုလ်၊ ကောလိပ် နှင့် ပညာရေးအဖွဲ့အစည်း၏ စည်းမျဉ်းများနှင့် စည်းကမ်းများအားလုံးကို လိုက်နာရမည်ဖြစ်ပြီး၊ ကျောင်းအချိန်ပြင်ပတွင်ပါ အပြုအမူနှင့် စကားအပြောအဆိုတို့ကိုပါ လိုက်နာရမည်။",
        p4: "ကျောင်းသား/သူများသည် ကျောင်းဝန်းထဲတွင်ဖြစ်စေ၊ ကျောင်းပြင်ပတွင်ဖြစ်စေ မိန်းကလေးကျောင်းသား/သူများ သို့မဟုတ် အမျိုးသမီးများကို စွပ်စွဲခြင်း သို့မဟုတ် ထိခိုက်စေခြင်း မပြုရ။",
        p5: "လောင်းကစားလုပ်ခြင်း၊ အရက်သောက်ခြင်း သို့မဟုတ် မူးယစ်ဆေးဝါးများ အသုံးပြုခြင်းတို့ကို ကျောင်းဝန်းထဲတွင်ဖြစ်စေ၊ ကျောင်းပြင်ပတွင်ဖြစ်စေ တင်းကျပ်စွာ တားမြစ်ထားသည်။",
        p6: "ကျောင်းသား/သူများသည် သူတို့၏ ဆရာ/ဆရာမများ၏ ညွှန်ကြားချက်များနှင့် လမ်းညွှန်ချက်များကို လိုက်နာရမည်။",
        p7: "ကျောင်းသား/သူများသည် ကျောင်းဝန်းထဲတွင်ဖြစ်စေ၊ ကျောင်းပြင်ပတွင်ဖြစ်စေ၊ အခြားသူများ၏ ပစ္စည်းများကို ဖျက်ဆီးခြင်း၊ ခိုးယူခြင်း သို့မဟုတ် အကြမ်းဖက်အားဖြင့် ယူသွားခြင်း မပြုရ။",
        p8: "ကျောင်းသား/သူများ အချင်းချင်းဖြစ်စေ၊ ကျောင်းပြင်ပမှ အပြင်လူများနှင့်ဖြစ်စေ အကြမ်းဖက်ခိုက်ရန်ဖြစ်ပွားခြင်း မပြုရ။",
        p9: "ကျောင်းသား/သူများသည် ကျောင်းအချိန်ပြင်ပတွင် တက္ကသိုလ်၊ ကောလိပ် နှင့် ပညာရေးအဖွဲ့အစည်း၏ စည်းမျဉ်းများနှင့် စည်းကမ်းများအားလုံးကို လိုက်နာရမည်။",
        p10: "ကျောင်းသား/သူများသည် အတန်းများကို ပုံမှန်တက်ရောက်ရမည်။",
        p11: "ကျောင်းသား/သူသည် အတန်းတင်စာမေးပွဲအတွက် အရည်အချင်းပြည့်မီရန် တစ်နှစ်တာ ပညာသင်နှစ်အတွင်း အနည်းဆုံး **၇၅% အတန်းတက်ရောက်မှု** ရှိရမည်။ ၇၅% ထက်နည်းသော တက်ရောက်မှုရှိသော ကျောင်းသား/သူများကို နောက်ဆုံးစာမေးပွဲဖြေဆိုခွင့် မပေးပါ။",
        p12: "ကျောင်းသားများသည် ကျောင်းမှ သတ်မှတ်ထားသော စည်းကမ်းနှင့် စည်းမျဉ်များကို အပါအဝင် မိမိတို့ တက်ရောက်နေသော သီးသန့်ဘာသာရပ်များအတွက် သတ်မှတ်ထားသော စည်းမျဉ်များကိုလည်း လိုက်နာရမည်။",
        p13: "ကျောင်းသား/သူများသည် စာသင်နှစ်ဝက်စာမေးပွဲကို အားလုံးဖြေဆိုရမည်။ နှစ်ဝက်စာမေးပွဲကို မဖြေဆိုနိုင်ပါက နောက်ဆုံးစာမေးပွဲကို ဖြေဆိုခွင့်ပေးမည် မဟုတ်ပါ။",
        p14: "ကျောင်းသား/သူများသည် စာမေးပွဲအတွင်း လိမ်လည်ခြင်း သို့မဟုတ် မည်သည့် မသမာသော နည်းလမ်းကိုမဆို အသုံးပြုပါက ပြင်းထန်သော အရေးယူမှုကို ခံကြရမည်။",
        p15: "ကျောင်းသား/သူများသည် သတ်မှတ်ထားသော ကျောင်းဝတ်စုံကို ဝတ်ဆင်ရမည်ဖြစ်ပြီး၊ ကျောင်းသား/သူအဖြစ် သင့်တော်သော အပြုအမူနှင့် စကားပြောဆိုမှုကို ပြုလုပ်ရမည်။",
        p16: "ဤတက္ကသိုလ်တွင် တက်ရောက်နေစဉ်အတွင်း ကျောင်းသား/သူများသည် အခြား တက္ကသိုလ်၊ ကောလိပ် သို့မဟုတ် ပညာရေးအဖွဲ့အစည်းတစ်ခုခုတွင် တပြိုင်နက် တက်ရောက်ခြင်း မပြုရ။ ဤစည်းမျဉ်းကို ချိုးဖောက်ပါက အဆိုပါ ကျောင်းသား/သူကို အမည်စာရင်းမှ ဖယ်ရှားမည်ဖြစ်သည်။",
        p17: "အထက်ဖော်ပြပါ အချက်များကို သေချာစွာ ဖတ်ရှုနားလည်ပြီးနောက် ဤစည်းမျဉ်းများကို မလိုက်နာခြင်း သို့မဟုတ် ချိုးဖောက်ခြင်း ပြုလုပ်ပါက ပြစ်မှု၏ ပြင်းထန်မှုအပေါ် မူတည်၍ သင့်လျော်သော အရေးယူမှုများကို ခံရမည်ဖြစ်သည်။",
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
        rules_title: "Student Rules & Regulations",
        footer_address:
          "Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay Region, Myanmar",
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
        T1: "1. Peaceful Learning Environment",
        T2: "2. Prohibition of Moral Misconduct",
        T3: "3. Strict Adherence to School Discipline",
        T4: "4. Compliance with Exam Regulations",
        T5: "5. Dress Code and Conduct",
        T6: "6. Simultaneous Enrollment",
        V: "Penalties for Violation",
        p1: "Students must not directly or indirectly disrupt or cause harm to the peaceful learning environment.",
        p2: "Students are strictly prohibited from using, possessing, buying, selling, or distributing narcotics. Smoking or chewing betel nut in classrooms, workshops, and campus premises is also forbidden.",
        p3: "Students must adhere to all rules and regulations of the university/college/institute, including behavior and speech outside school hours.",
        p4: "Students must not harass or harm female students or other women, on or off campus.",
        p5: "Gambling, drinking alcohol, or using intoxicants are strictly prohibited on and off campus.",
        p6: "Students must obey the instructions and guidance of their teachers.",
        p7: "Students must not destroy, steal, or forcibly take the property of others, whether on or off campus.",
        p8: "Fighting among students or with outsiders is not permitted, on or off campus.",
        p9: "Students must adhere to all rules and regulations of the university/college/institute, including behavior and speech outside school hours.",
        p10: "All students must attend classes regularly.",
        p11: "To be eligible for the final exam, a student must have a minimum of **75% class attendance** throughout the academic year. Students with less than 75% attendance will not be allowed to take the final exam.",
        p12: "Students must abide by the rules and regulations set by the school and for their specific courses.",
        p13: "All students must take the mid-term exam. If a student misses the mid-term exam, they will not be allowed to take the final exam.",
        p14: "Cheating or using any dishonest means during an exam will result in severe action.",
        p15: "Students must wear the designated uniform and behave and speak in a manner appropriate for a student.",
        p16: "While attending this university, students are not permitted to be simultaneously enrolled in any other university, college, or institute. Violation of this rule will result in the student being removed from the roster.",
        p17: "Upon a thorough reading and understanding of the above-mentioned points, any failure to comply with or violation of these rules will result in disciplinary action appropriate to the severity of the offense.",
        footer_link_dp: "Data Protection",
      },
    };
    
    function setLanguage(lang) {
        localStorage.setItem("language", lang);
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
                const lang = option.getAttribute('data-lang');
                setLanguage(lang);
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
    });
  </script>
  
  <!-- GSAP Animation Script -->
  <script>
    gsap.registerPlugin(ScrollTrigger);
    
    // Animate hero section
    gsap.from(".animate-section", { y: 50, opacity: 0, duration: 1, ease: "power3.out" });
    gsap.from(".animate-title", { y: -30, opacity: 0, duration: 1, delay: 0.2, ease: "power3.out" });
    gsap.from(".animate-fade", { opacity: 0, duration: 1.2, delay: 0.5, ease: "power2.out" });

    // Staggered animation for rule cards on scroll
    gsap.utils.toArray(".rule-card").forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: "top 90%",
                toggleActions: "play none none none"
            },
            y: 40,
            opacity: 0,
            duration: 0.8,
            delay: i * 0.1, // Stagger effect
            ease: "power2.out",
        });
    });
  </script>
  
  <!-- <script src="./js/lgl.js"></script> -->
</body>

</html>
