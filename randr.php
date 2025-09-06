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

  <style>
    body {
      font-family: "Inter", sans-serif;
    }

    /* Custom styles for the rule cards */
    .card {
      background-color: #ffffff;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1),
        0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .card h2 {
      font-family: "Oswald", sans-serif;
      color: #1a237e;
      /* Darker blue for heading */
      border-bottom: 2px solid #e2e8f0;
    }

    .card ol li {
      position: relative;
      padding-left: 1.5rem;
      list-style: none;
    }

    .card ol li::before {
      content: "•";
      position: absolute;
      left: 0;
      top: 2px;
      color: #3b82f6;
      /* Blue bullet points */
      font-size: 1.35rem;
      line-height: 1;
    }

    /* Responsive Navbar adjustments */
    #mobile-menu-button {
      z-index: 100;
    }

    #mobile-menu {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
      z-index: 99;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">
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
        <a href="./about.html" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about">ကျွန်ုပ်တို့အကြောင်း</a>
        <a href="./activity.html" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity">လှုပ်ရှားမှုများ</a>
        <a href="./exam_results.html" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
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
      <a href="./about.html" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about_mobile">ကျွန်ုပ်တို့အကြောင်း</a>
          <br><br>
        <a href="./activity.html" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity_mobile">လှုပ်ရှားမှုများ</a>
          <br><br>
        <a href="./exam_results.html" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
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

  <main class="container mx-auto px-4 py-8 md:py-12">
    <h1 class="text-3xl md:text-4xl font-extrabold text-center text-blue-900 mb-8" data-lang-key="rules_title">
      Student Rules & Regulations
    </h1>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      <div class="card p-6">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="T1">
          1. Peaceful Learning Environment
        </h2>
        <ol class="list-disc space-y-3 pl-4 text-gray-600">
          <li data-lang-key="p1">
            Students must not directly or indirectly disrupt or cause harm to
            the peaceful learning environment.
          </li>
        </ol>
      </div>

      <div class="card p-6 md:col-span-2">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="T2">
          2. Prohibition of Moral Misconduct
        </h2>
        <ol class="list-disc space-y-3 pl-4 text-gray-600">
          <li data-lang-key="p2">
            Students are strictly prohibited from using, possessing, buying,
            selling, or distributing narcotics. Smoking or chewing betel nut
            in classrooms, workshops, and campus premises is also forbidden.
          </li>
          <li data-lang-key="p3">
            Students must not say or do anything that could harm the Rector,
            Pro-Rector, teachers, or staff.
          </li>
          <li data-lang-key="p4">
            Students must not harass or harm female students or other women,
            on or off campus.
          </li>
          <li data-lang-key="p5">
            Gambling, drinking alcohol, or using intoxicants are strictly
            prohibited on and off campus.
          </li>
          <li data-lang-key="p6">
            Students must obey the instructions and guidance of their
            teachers.
          </li>
          <li data-lang-key="p7">
            Students must not destroy, steal, or forcibly take the property of
            others, whether on or off campus.
          </li>
          <li data-lang-key="p8">
            Fighting among students or with outsiders is not permitted, on or
            off campus.
          </li>
          <li data-lang-key="p9">
            Students must adhere to all rules and regulations of the
            university/college/institute, including behavior and speech
            outside school hours.
          </li>
        </ol>
      </div>

      <div class="card p-6">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="T3">
          3. Strict Adherence to School Discipline
        </h2>
        <ol class="list-decimal space-y-3 pl-4 text-gray-600">
          <li data-lang-key="p10">
            All students must attend classes regularly.
          </li>
          <li data-lang-key="p11">
            To be eligible for the final exam, a student must have a minimum
            of **75% class attendance** throughout the academic year. Students
            with less than 75% attendance will not be allowed to take the
            final exam.
          </li>
          <li data-lang-key="p12">
            Students must abide by the rules and regulations set by the school
            and for their specific courses.
          </li>
        </ol>
      </div>

      <div class="card p-6">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="T4">
          4. Compliance with Exam Regulations
        </h2>
        <ol class="list-decimal space-y-3 pl-4 text-gray-600">
          <li data-lang-key="p13">
            All students must take the mid-term exam. If a student misses the
            mid-term exam, they will not be allowed to take the final exam.
          </li>
          <li data-lang-key="p14">
            Cheating or using any dishonest means during an exam will result
            in severe action.
          </li>
        </ol>
      </div>

      <div class="card p-6">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="T5">
          5. Dress Code and Conduct
        </h2>
        <ol class="list-decimal space-y-3 pl-4 text-gray-600">
          <li data-lang-key="p15">
            Students must wear the designated uniform and behave and speak in
            a manner appropriate for a student.
          </li>
        </ol>
      </div>

      <div class="card p-6 md:col-span-2">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="T6">
          6. Simultaneous Enrollment
        </h2>
        <ol class="list-decimal space-y-3 pl-4 text-gray-600">
          <li data-lang-key="p16">
            While attending this university, students are not permitted to be
            simultaneously enrolled in any other university, college, or
            institute. Violation of this rule will result in the student being
            removed from the roster.
          </li>
        </ol>
      </div>
      <div class="card p-6 md:col-span-3">
        <h2 class="text-xl md:text-2xl font-semibold pb-3 mb-4" data-lang-key="V">
          Penalties for Violation
        </h2>
        <ol class="list-decimal space-y-3 pl-4 text-gray-600">
          <li class="mt-6">
            <!-- <h4 class="font-bold text-gray-900" data-lang-key="V">
                Penalties for Violation
              </h4> -->
            <p class="mt-2" data-lang-key="p17">
              Upon a thorough reading and understanding of the above-mentioned
              points, any failure to comply with or violation of these rules
              will result in disciplinary action appropriate to the severity
              of the offense.
            </p>
          </li>
        </ol>
      </div>
    </div>
  </main>

  <footer id="contact" class="bg-blue-900 text-white">
    <div class="container mx-auto px-6 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="flex flex-col items-start">
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 w-12 mb-4" />
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 text-sm mt-4 leading-relaxed" data-lang-key="footer_address">
            Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
            Region, Myanmar
          </p>
          <div class="mt-4 text-sm text-blue-200">
            <p>Email: info@utycc.edu.mm</p>
            <p>Phone: +95 (XX) XXX XXX</p>
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
              <a href="#" class="hover:text-white transition duration-200" data-lang-key="footer_link_terms">Terms &
                Policies</a>
            </li>
            <li>
              <a href="#" class="hover:text-white transition duration-200" data-lang-key="footer_link_faq">FAQs</a>
            </li>
            <li>
              <a href="#" class="hover:text-white transition duration-200" data-lang-key="footer_link_about">About
                Us</a>
            </li>
            <li>
              <a href="#" class="hover:text-white transition duration-200" data-lang-key="footer_link_rules">Rules &
                Regulations</a>
            </li>
            <li>
              <a href="./data_protection.html" class="hover:text-white " data-lang-key="footer_link_dp">Data
                Protection</a>
            </li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">
            Follow Us
          </h3>
          <div class="flex space-x-4">
            <a href="#" class="text-blue-200 hover:text-white transition duration-200"><i
                class="fab fa-facebook-f text-xl"></i></a>
            <a href="#" class="text-blue-200 hover:text-white transition duration-200"><i
                class="fab fa-linkedin-in text-xl"></i></a>
          </div>
          <div class="newtons-cradle mt-8">
            <div class="newtons-cradle__dot"></div>
            <div class="newtons-cradle__dot"></div>
            <div class="newtons-cradle__dot"></div>
            <div class="newtons-cradle__dot"></div>
          </div>
        </div>
      </div>

      <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300"
        data-lang-key="footer_copyright">
        © 2025 University of Technology - Yatanarpon Cyber City. All Rights
        Reserved.
      </div>
    </div>
  </footer>

  <script>
    // Toggle mobile menu visibility
    document
      .getElementById("mobile-menu-button")
      .addEventListener("click", () => {
        document.getElementById("mobile-menu").classList.toggle("hidden");
      });

    // Language translation logic
    const translations = {
      // ... (Your existing translations object)
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

    const languageSwitcher = document.getElementById("language-switcher-desktop");
    const mobileLanguageSwitcher = document.getElementById(
      "language-switcher-mobile"
    );

    const changeLanguage = (lang) => {
      localStorage.setItem("language", lang);
      languageSwitcher.value = lang;
      mobileLanguageSwitcher.value = lang;
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

    mobileLanguageSwitcher.addEventListener("change", (event) => {
      changeLanguage(event.target.value);
    });

    document.addEventListener("DOMContentLoaded", () => {
      const savedLang = localStorage.getItem("language") || "en";
      changeLanguage(savedLang);
    });
  </script>
  <script src="./js/lgl.js"></script>
</body>

</html>