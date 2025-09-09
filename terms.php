<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Terms & Policies - UTYCC</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Oswald:wght@400;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./CSS/footer.css">
  
  <!-- GSAP CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <style>
    body {
      font-family: "Inter", sans-serif;
      overflow-x: hidden;
    }
    h1, h2, h3 {
        font-family: 'Oswald', sans-serif;
    }
    .policy-card {
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .policy-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
    }
    .hero-icon {
        position: absolute;
        right: 10%;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12rem;
        opacity: 0.05;
        color: #1e3a8a;
        z-index: 1;
        pointer-events: none;
    }
    .policy-card ul li {
      position: relative;
      padding-left: 1.75rem;
      list-style: none;
    }
    .policy-card ul li::before {
      content: "\f058"; /* FontAwesome check-circle icon */
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      left: 0;
      top: 5px;
      color: #3b82f6;
      font-size: 1rem;
    }
  </style>
</head>

<body class="bg-gray-100">
  <header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="./index.php" class="flex items-center space-x-3">
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
      <a href="./about.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about_mobile">About Us</a>
      <a href="./activity.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_activity_mobile">Activities</a>
      <a href="/Rform/examResults.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_examresult_mobile">Exam Results</a>
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
              <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
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

  <main class="container mx-auto px-6 py-12">
    <!-- Hero Section -->
    <section class="relative bg-white p-8 md:p-12 rounded-lg shadow-lg mb-16 overflow-hidden animate-section">
        <i class="fas fa-file-contract hero-icon"></i>
        <div class="relative z-10 text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-900 mb-4 animate-title" data-lang-key="terms_policies_title">Terms & Policies</h1>
            <p class="text-lg text-gray-600 leading-relaxed animate-fade" data-lang-key="terms_policies_intro">
                Welcome to the UTYCC Student Registration Website. By accessing and using this website, you agree to comply with and be bound by the following terms and policies. Please read them carefully.
            </p>
        </div>
    </section>
    
    <!-- Terms and Conditions Section -->
    <section class="mb-16 animate-section">
        <h2 class="text-4xl font-bold text-center text-blue-900 mb-10" data-lang-key="section_terms_title">1. Terms and Conditions</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="policy-card p-6">
                <div class="flex items-center mb-4"><i class="fas fa-user-check text-3xl text-blue-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="terms_account_section">User Accounts</h3></div>
                <p class="text-gray-600 flex-grow" data-lang-key="account_eligible">To register for courses, you must create an account. You must be a currently enrolled student at UTYCC to be eligible.</p>
            </div>
            <div class="policy-card p-6">
                <div class="flex items-center mb-4"><i class="fas fa-copyright text-3xl text-blue-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="terms_intellectual_section">Intellectual Property</h3></div>
                <p class="text-gray-600 flex-grow" data-lang-key="intellectual_property">All content on this site is the property of UTYCC. You may not reproduce or distribute any content without written permission.</p>
            </div>
            <div class="policy-card p-6 md:col-span-2 lg:col-span-1">
                <div class="flex items-center mb-4"><i class="fas fa-ban text-3xl text-red-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="terms_conduct_section">Prohibited Conduct</h3></div>
                <p class="text-gray-600 mb-3" data-lang-key="prohibit_act">You agree not to use this website for any unlawful activities, including:</p>
                <ul class="space-y-2 text-gray-600 text-sm flex-grow">
                    <li data-lang-key="prohibit_1">Attempting to access unauthorized data.</li>
                    <li data-lang-key="prohibit_2">Providing false or misleading information.</li>
                    <li data-lang-key="prohibit_3">Interfering with website security features.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Privacy Policy Section -->
    <section class="animate-section">
        <h2 class="text-4xl font-bold text-center text-blue-900 mb-4" data-lang-key="section_privacy_title">2. Privacy Policy</h2>
        <p class="text-center text-gray-500 mb-10" data-lang-key="privacy_effective_date">Effective Date: August 10, 2025</p>
        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-8">
            <div class="policy-card p-6">
                <div class="flex items-center mb-4"><i class="fas fa-database text-3xl text-blue-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="privacy_data_collection_section">Information We Collect</h3></div>
                <p class="text-gray-600 mb-3" data-lang-key="data_collection_intro">We collect information you provide during registration, including:</p>
                <ul class="space-y-2 text-gray-600 text-sm flex-grow">
                    <li data-lang-key="personal_details">Personal Identifiers (name, student ID, etc.).</li>
                    <li data-lang-key="contact_info">Contact Information (email, phone, address).</li>
                    <li data-lang-key="academic_info">Academic Information (major, course selections).</li>
                </ul>
            </div>
            <div class="policy-card p-6">
                <div class="flex items-center mb-4"><i class="fas fa-tasks text-3xl text-blue-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="privacy_data_use_section">How We Use Information</h3></div>
                 <p class="text-gray-600 mb-3" data-lang-key="info_used_in">The information collected is used to:</p>
                <ul class="space-y-2 text-gray-600 text-sm flex-grow">
                    <li data-lang-key="registration">Process course registration and academic records.</li>
                    <li data-lang-key="studies_announce">Communicate with you about studies and announcements.</li>
                    <li data-lang-key="impro_functionality">Improve our services and website functionality.</li>
                </ul>
            </div>
            <div class="policy-card p-6">
                <div class="flex items-center mb-4"><i class="fas fa-share-alt text-3xl text-blue-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="privacy_data_sharing_section">Data Sharing</h3></div>
                <p class="text-gray-600 flex-grow" data-lang-key="data_sharing_P">We do not sell your personal information. Data may be shared with university departments or third-party service providers as necessary to manage your academic records.</p>
            </div>
            <div class="policy-card p-6">
                <div class="flex items-center mb-4"><i class="fas fa-shield-alt text-3xl text-blue-500 mr-4"></i><h3 class="text-xl font-semibold text-blue-800" data-lang-key="privacy_security_section">Data Security</h3></div>
                <p class="text-gray-600 flex-grow" data-lang-key="security_P">We implement reasonable security measures to protect your personal information from unauthorized access, alteration, or disclosure.</p>
            </div>
        </div>
    </section>
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
                <p>Email: info@utycc.site utyccstudentaffair2010@gmail.com</p>
                <p>Phone: +959445767834 </p>
            </div>
        </div>
        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">Faculties</h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li><a href="./Majors/ist.php" data-lang-key="footer_faculty_ist" class="hover:text-white transition">Information Science Technology</a></li>
            <li><a href="./Majors/ce.php" data-lang-key="footer_faculty_ce" class="hover:text-white transition">Computer Engineering</a></li>
            <li><a href="./Majors/ece.php" data-lang-key="footer_faculty_ece" class="hover:text-white transition">Electronics Engineering</a></li>
            <li><a data-lang-key="footer_faculty_pre" href="./Majors/pre.php" class="hover:text-white transition">Precision Engineering</a></li>
            <li><a data-lang-key="footer_faculty_ame" href="./Majors/ame.php" class="hover:text-white transition">Advanced Materials Engineering</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">Quick Links</h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li><a href="./terms.php" class="hover:text-white transition" data-lang-key="footer_link_terms">Terms & Policies</a></li>
            <li><a href="./FAQs.php" class="hover:text-white transition" data-lang-key="footer_link_faq">FAQs</a></li>
            <li><a href="./about.php" class="hover:text-white transition" data-lang-key="footer_link_about">About Us</a></li>
            <li><a href="./randr.php" class="hover:text-white transition" data-lang-key="footer_link_rules">Rules & Regulations</a></li>
            <li><a href="./data_protection.php" class="hover:text-white transition" data-lang-key="footer_link_dp">Data Protection</a></li>
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
        &copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.
      </div>
    </div>
  </footer>

  <script>
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
            terms_account_section: "သုံးစွဲသူအကောင့်",
            account_eligible: "သင်တန်းများကို စာရင်းသွင်းရန်အတွက် အကောင့်တစ်ခုဖန်တီးရပါမည်။ ဤဝန်ဆောင်မှုကို အသုံးပြုရန်အတွက် သင်သည် UTYCC တွင် လက်ရှိတက်ရောက်နေသော ကျောင်းသားတစ်ဦးဖြစ်ရပါမည်။",
            terms_conduct_section: "တားမြစ်ထားသော အပြုအမူ",
            prohibit_act: "ဤဝဘ်ဆိုဒ်ကို တရားမဝင်သော လုပ်ဆောင်ချက်များအတွက် အသုံးမပြုရန် သင်သဘောတူသည်၊ အောက်ပါတို့အပါအဝင်:",
            prohibit_1: "ခွင့်ပြုချက်မရှိဘဲ ဒေတာများကို ဝင်ရောက်ရန် ကြိုးစားခြင်း။",
            prohibit_2: "မှားယွင်းသော သို့မဟုတ် လွဲမှားစေသော အချက်အလက်များကို ပေးခြင်း။",
            prohibit_3: "ဝဘ်ဆိုဒ် လုံခြုံရေးအင်္ဂါရပ်များကို နှောင့်ယှက်ခြင်း။",
            terms_intellectual_section: "ဉာဏပစ္စည်းမူပိုင်ခွင့်",
            intellectual_property: "ဤဆိုက်ရှိ အကြောင်းအရာအားလုံးသည် UTYCC ၏ ပိုင်ဆိုင်မှုဖြစ်သည်။ စာဖြင့်ရေးသားခွင့်ပြုချက်မရှိဘဲ မည်သည့်အကြောင်းအရာကိုမဆို ပြန်လည်ထုတ်လုပ်ခြင်း သို့မဟုတ် ဖြန့်ဝေခြင်းမပြုရပါ။",
            section_privacy_title: "၂။ ကိုယ်ရေးကိုယ်တာ မူဝါဒ",
            privacy_effective_date: "အသက်ဝင်သည့်ရက်စွဲ: ၂၀၂၅ ခုနှစ်၊ ဩဂုတ်လ ၁၀ ရက်",
            privacy_data_collection_section: "ကျွန်ုပ်တို့စုဆောင်းသော အချက်အလက်များ",
            data_collection_intro: "မှတ်ပုံတင်စဉ်အတွင်း သင်ပေးသော အချက်အလက်များကို ကျွန်ုပ်တို့ စုဆောင်းပါသည်၊ အောက်ပါတို့အပါအဝင်:",
            personal_details: "ကိုယ်ရေးကိုယ်တာ အထောက်အထားများ (အမည်၊ ကျောင်းသားနံပါတ် စသည်)။",
            contact_info: "ဆက်သွယ်ရန် အချက်အလက် (အီးမေးလ်၊ ဖုန်း၊ လိပ်စာ)။",
            academic_info: "ပညာရေးဆိုင်ရာ အချက်အလက် (မေဂျာ၊ သင်တန်းရွေးချယ်မှုများ)။",
            privacy_data_use_section: "ကျွန်ုပ်တို့ အချက်အလက်များကို မည်သို့အသုံးပြုသနည်း",
            info_used_in: "စုဆောင်းထားသော အချက်အလက်များကို အောက်ပါတို့အတွက် အသုံးပြုသည်:",
            registration: "သင်တန်းမှတ်ပုံတင်ခြင်းနှင့် ပညာရေးဆိုင်ရာ မှတ်တမ်းများကို စီမံဆောင်ရွက်ရန်။",
            studies_announce: "သင်၏ သင်ကြားရေးနှင့် ကြေငြာချက်များနှင့် ပတ်သက်၍ သင်နှင့် ဆက်သွယ်ရန်။",
            impro_functionality: "ကျွန်ုပ်တို့၏ ဝန်ဆောင်မှုများနှင့် ဝဘ်ဆိုဒ် လုပ်ဆောင်နိုင်စွမ်းကို မြှင့်တင်ရန်။",
            privacy_data_sharing_section: "အချက်အလက် မျှဝေခြင်း",
            data_sharing_P: "ကျွန်ုပ်တို့သည် သင်၏ ကိုယ်ရေးကိုယ်တာ အချက်အလက်များကို မရောင်းချပါ။ သင်၏ ပညာရေးဆိုင်ရာ မှတ်တမ်းများကို စီမံခန့်ခွဲရန် လိုအပ်သလို တက္ကသိုလ်ဌာနများ သို့မဟုတ် ပြင်ပဝန်ဆောင်မှုပေးသူများနှင့် ဒေတာများကို မျှဝေနိုင်ပါသည်။",
            privacy_security_section: "အချက်အလက်လုံခြုံရေး",
            security_P: "သင်၏ ကိုယ်ရေးကိုယ်တာ အချက်အလက်များကို ခွင့်ပြုချက်မရှိဘဲ ဝင်ရောက်ခြင်း၊ ပြောင်းလဲခြင်း သို့မဟုတ် ထုတ်ဖော်ခြင်းမှ ကာကွယ်ရန် ကျိုးကြောင်းဆီလျော်သော လုံခြုံရေးအစီအမံများကို ကျွန်ုပ်တို့ အကောင်အထည်ဖော်ပါသည်။",
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
            terms_account_section: "User Accounts",
            account_eligible: "To register for courses, you must create an account. You must be a currently enrolled student at UTYCC to be eligible.",
            terms_conduct_section: "Prohibited Conduct",
            prohibit_act: "You agree not to use this website for any unlawful activities, including:",
            prohibit_1: "Attempting to access unauthorized data.",
            prohibit_2: "Providing false or misleading information.",
            prohibit_3: "Interfering with website security features.",
            terms_intellectual_section: "Intellectual Property",
            intellectual_property: "All content on this site is the property of UTYCC. You may not reproduce or distribute any content without written permission.",
            section_privacy_title: "2. Privacy Policy",
            privacy_effective_date: "Effective Date: August 10, 2025",
            privacy_data_collection_section: "Information We Collect",
            data_collection_intro: "We collect information you provide during registration, including:",
            personal_details: "Personal Identifiers (name, student ID, etc.).",
            contact_info: "Contact Information (email, phone, address).",
            academic_info: "Academic Information (major, course selections).",
            privacy_data_use_section: "How We Use Information",
            info_used_in: "The information collected is used to:",
            registration: "Process course registration and academic records.",
            studies_announce: "Communicate with you about studies and announcements.",
            impro_functionality: "Improve our services and website functionality.",
            privacy_data_sharing_section: "Data Sharing",
            data_sharing_P: "We do not sell your personal information. Data may be shared with university departments or third-party service providers as necessary to manage your academic records.",
            privacy_security_section: "Data Security",
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
        button.addEventListener('click', (e) => { e.stopPropagation(); menu.classList.toggle('hidden'); });
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
        document.getElementById("mobile-menu-button").addEventListener("click", () => {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        });
        setupLangSwitcher('desktop');
        setupLangSwitcher('mobile');
        const savedLang = localStorage.getItem("language") || "en";
        setLanguage(savedLang);

        gsap.registerPlugin(ScrollTrigger);
        gsap.utils.toArray('.animate-section').forEach(section => {
            gsap.from(section, {
                scrollTrigger: { trigger: section, start: "top 85%", toggleActions: "play none none none" },
                y: 50, opacity: 0, duration: 1, ease: "power3.out"
            });
        });
    });
  </script>
  
  
  <script src="./js/game-script.js"></script>

</body>

</html>
