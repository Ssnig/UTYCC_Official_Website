<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../CSS/star-layout.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../CSS/footer.css" />
  <link rel="stylesheet" href="../CSS/BE_Advantages.css" />
  <script src="../JS/star-layout.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- name ပြောင်းရန် -->
  <title>Computer Engineering - UTYCC</title>
  <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../CSS/hero-carousel.css" />
  <script src="../JS/hero-carousel.js"></script>
  <link rel="stylesheet" href="../CSS/font.css" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }

    .hero-bg {
      background-image: linear-gradient(rgba(0, 51, 102, 0.75),
          rgba(0, 51, 102, 0.75)),
        url("https://placehold.co/1600x800/003366/FFFFFF?text=UTYCC+Campus");
      background-size: cover;
      background-position: center;
    }

    .stat-card {
      background-color: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
    }

    /* This new style makes the program cards look clickable */
    .program-card {
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="../home.php" class="flex items-center space-x-3">
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
       <a href="../about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about">About Us</a>
        <a href="../activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity">Activities</a>
        <a href="../exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
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
      <a href="../about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_about_mobile">About Us</a>
        <br><br>
      <a href="../activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_activity_mobile">Activities</a>
        <br><br>
      <a href="../rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_examresult_mobile">Exam Results</a>
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
          <option value="en" selected>English</option>
        </select>
      </div>
    </div>
  </div>

  <!-- ဒီကစရန် -->
  <div class="w-full max-w-7xl bg-white rounded-2xl shadow-xl overflow-hidden mx-auto mt-8">
    <div class="md:flex">
      <div class="md:shrink-0">
        <!-- ဒီမှာပုံပြောင်းရန် -->
        <img id="CE" class="h-48 w-full object-cover md:h-full md:w-48" src="../Img/logo/CE.webp" alt="Major Image" />
      </div>
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold" data-lang-key="uni_name">
          University of Technology (Yatanarpon Cyber City)
        </div>
        <a id="major-title" href="#"
          class="block mt-1 text-lg leading-tight font-medium text-black hover:underline" data-lang-key="major_Title">Computer Engineering</a>
        <p id="major-description" class="mt-2 text-slate-500" data-lang-key="major_Description">
        The Department of Computer Engineering (CE) at the University of Technology (Yatanarpon Cyber City) is a discipline that combines the study of both computer hardware (computer systems, internet networks) and software (Embedded Systems and AI/Robotics). Computer Engineering involves the design, creation, testing, and maintenance of systems used in computers, software, internet networks, and industrial applications. Our graduates are equipped with technical expertise and problem-solving skills to succeed in industry, research, and innovation.
        </p>
      </div>
    </div>
  </div>
  <!-- headline -->
  <!-- Hero Section to start the page with a strong visual -->
  <header class="mb-12 rounded-3xl overflow-hidden shadow-2xl py-4">
    <div class="relative h-96">
      <!-- ဒီအောက်ကဟာ ကြိုက်တဲ့ပုံထည့်လို့ရတယ် ဥပမာ majorနဲ့ဆိုင်တဲ့ buildingတွေ ပုံတွေက "./Img/utycc_buildings/"ထဲက ဟာတွေယူသုံး srcမှာနော် -->
      <img src="../Img/utycc_buildings/lab2.JPG" alt="Hero image of a bustling university campus"
        class="absolute inset-0 w-full h-full object-cover brightness-75" />
      <div class="relative z-10 flex items-center justify-center h-full bg-black bg-opacity-40">
        <div class="text-center text-white p-4">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4"
            style="font-family: 'Times New Roman', Times, serif">
            Our Motto
          </h1>
          <!-- mottoက မေဂျာ တစ်ခုချင်းစီရဲ့ ဆောင်ပုဒ် အမ မယမင်း ရဲ့ doc fileတွေမှာသေချာထည့်ပေးထားတယ် အဲ့တာကိုထည့်ပေး -->
          <p class="text-lg sm:text-xl font-light max-w-2xl mx-auto italic" data-lang-key="motto">
            "Create the Modern World with the outstanding Computer Engineers"
          </p>
        </div>
      </div>
    </div>
  </header>
  <br />

  <!-- Main content container with a grid of cards -->
  <div class="container mx-auto">
    <!-- အောက်ကဟာတွေက ရည်ရွယ်ချက် တာဝန်တွေ ခေါင်းစဥ်နဲ့ စာကိုယ်ခွဲထည့်  -->
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="objectives_heading">
      The objectives and responsibilities
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl px-2 mx-auto" data-lang-key="objectives">
      To produce innovative engineers who are highly skilled and capable in the field of ICT. To develop human resources that can continuously learn and solve complex problems. To support new technologies and tools in the field of computer engineering to meet the needs of industry and society. To provide opportunities in learning environments that utilize ICT. Additionally, students will be trained and taught to become proficient in their specialized subjects and to conduct innovative scientific research. The Computer Engineering (CE) program aims to provide students with knowledge starting from the fundamentals of technology to advanced levels involving research and practical applications. The main areas of study include the following
    </p>

    <!-- Grid to hold the cards -->
    <div id="majorsGrid" class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 py-4">
      <!-- cardတွေမှာက ခေါင်းစဥ်တွေ နံပါတ်တွေကို အစဥ်လိုက်ထည့်ပေး တစ်ခုချင်းစီတွက် card တစ်ခုစီ အမယမင်းရေးထားတဲ့ IST docက ပုံစံနဲ့ အောက်ဟာကိုယှဥ်ကြည့် h3မှာခေါင်းစဥ် li မှာအောက်ကအချက် အချက်လိုရင်liထည့်ထပ်ရေး cardလိုရင် cardတစ်ခုကို copy paste သုံးလို့ရ -->
      <!-- Card 1  -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-indigo-500 text-white rounded-full p-3 mb-4">
          <!-- Icon for the card - using a simple SVG or emoji is great -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"></path>

            <polyline points="7 9 10 12 7 15"></polyline>

            <line x1="11" y1="15" x2="15" y2="15"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="prog_dev">
          Programming & Software Development
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="pdev_1">
            Programming Languages (C, C++, Java, Python etc.)
          </li>
          <li class="font-medium text-lg" data-lang-key="pdev_2">
            Data Structures & Algorithms
          </li>
          <li class="font-medium text-lg" data-lang-key="pdev_3">
            Software Engineering
          </li>
          <li class="font-medium text-lg" data-lang-key="pdev_4">
            Web Development
          </li>
          <li class="font-medium text-lg" data-lang-key="pdev_5">
            Mobile Application Development
          </li>
        </ol>
      </div>

      <!-- Card 2 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-green-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="4" y1="8" x2="20" y2="8"></line>
            <line x1="4" y1="16" x2="20" y2="16"></line>
            <line x1="8" y1="4" x2="8" y2="20"></line>
            <line x1="16" y1="4" x2="16" y2="20"></line>

            <rect x="9" y="9" width="6" height="6" rx="1"></rect>
            <line x1="9" y1="12" x2="6" y2="12"></line>
            <line x1="15" y1="12" x2="18" y2="12"></line>
            <line x1="12" y1="9" x2="12" y2="6"></line>
            <line x1="12" y1="15" x2="12" y2="18"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="hw_architecture">
          Computer Hardware & Architecture
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="archit_1">
            Digital Logic Design
          </li>
          <li class="font-medium text-lg" data-lang-key="archit_2">
            Computer Organization & Architecture
          </li>
          <li class="font-medium text-lg" data-lang-key="archit_3">
            Microprocessor & Microcontroller Systems
          </li>
          <li class="font-medium text-lg" data-lang-key="archit_4">
            Embedded Systems Design
          </li>
        </ol>
      </div>

      <!-- Card 3   -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-red-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 18 15.3 15.3 0 0 1-8 0 15.3 15.3 0 0 1 4-18z"></path>

            <circle cx="12" cy="5" r="1"></circle>
            <circle cx="19" cy="14" r="1"></circle>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="network_com">
          Networking & Communication
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="netcom_1">
            Computer Networks
          </li>
          <li class="font-medium text-lg" data-lang-key="netcom_2">
            Network Administration
          </li>
          <li class="font-medium text-lg" data-lang-key="netcom_3">
            Network Security
          </li>
          <li class="font-medium text-lg" data-lang-key="netcom_4">
            Internet & Web Technologies
          </li>
        </ol>
      </div>

      <!-- card 4 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-orange-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>

            <rect x="10" y="9" width="4" height="6" rx="1"></rect>
            <line x1="10" y1="11" x2="14" y2="11"></line>
            <line x1="10" y1="13" x2="14" y2="13"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="sec_system">
          Security & Systems
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="secur_1">
            Operating Systems
          </li>
          <li class="font-medium text-lg" data-lang-key="secur_2">
            Information Security
          </li>
          <li class="font-medium text-lg" data-lang-key="secur_3">
            Cryptography & Network Security
          </li>
          <li class="font-medium text-lg" data-lang-key="secur_4">
            System Programming
          </li>
        </ol>
      </div>

      <!-- card 5 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-amber-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v4"></path>

            <polyline points="14 4 20 10 14 16"></polyline>
            <line x1="20" y1="10" x2="4" y2="10"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="adv_emTech">
          Advanced & Emerging Technologies
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="advem_1">
            Artificial Intelligence
          </li>
          <li class="font-medium text-lg" data-lang-key="advem_2">
            Machine Learning
          </li>
          <li class="font-medium text-lg" data-lang-key="advem_3">
            Cloud Computing
          </li>
          <li class="font-medium text-lg" data-lang-key="advem_4">
            Internet of Things (IoT)
          </li>
          <li class="font-medium text-lg" data-lang-key="advem_5">
            Parallel & Distributed Computing
          </li>
          <li class="font-medium text-lg" data-lang-key="advem_6">
            Data Mining
          </li>
        </ol>
      </div>

      <!-- card 6 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-purple-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="12" rx="2"></rect>
            <line x1="7" y1="21" x2="17" y2="21"></line>
            <line x1="12" y1="15" x2="12" y2="21"></line>

            <path d="M10 10l-6 6"></path>
            <path d="M14 10l6 6"></path>
            <path d="M10 14l-1.5 1.5"></path>
            <path d="M14 14l1.5 1.5"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="ict_tools">
          ICT & Tools
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="tool_1">
            Computer Applications
          </li>
          <li class="font-medium text-lg" data-lang-key="tool_2">
            Database Systems
          </li>
          <li class="font-medium text-lg" data-lang-key="tool_3">
            Human-Computer Interaction
          </li>
          <li class="font-medium text-lg" data-lang-key="tool_4">
            ICT Ethics & Laws
          </li>
        </ol>
      </div>

      <!-- card 7 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-emerald-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="8" y1="13" x2="12" y2="13"></line>
            <line x1="8" y1="17" x2="16" y2="17"></line>

            <circle cx="15.5" cy="14.5" r="3.5"></circle>
            <line x1="18" y1="17" x2="20" y2="19"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="pj_research">
          Project & Research
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="project_1">
            ICT Project Management
          </li>
          <li class="font-medium text-lg" data-lang-key="project_2">
            Research Methodology
          </li>
          <li class="font-medium text-lg" data-lang-key="project_3">
            Final Year Project (B.E Thesis)
          </li>
          <li class="font-medium text-lg" data-lang-key="project_4">
            Industrial Attachment / Internship
          </li>
          <li class="font-medium text-lg" data-lang-key="project_5">
            Teamwork & Communication Skills
          </li>
        </ol>
      </div>
    </div>
  </div>

  <!-- anoter description panel -->
  <!-- ဒီမှာကတစ်မျိုး -->
  <!-- New section for "What You Can Learn" -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="lab_heading">
      What You Can Learn
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="lab_intro">
      In the Computer Engineering major, laboratories have been established to help students master technologies through both theoretical and practical learning
    </p>

    <!-- Description box above the cards -->
    <div id="skillCardContainer">
      <!-- Description box - Its position in HTML does not matter as much now -->
      <div id="descriptionBox"
        class="transition-opacity duration-200 opacity-100 ease-in-out w-full h-24 bg-white rounded-xl shadow-lg flex mb-8 italic items-center justify-center p-4 text-center text-gray-700">
        <p id="descriptionText" data-lang-key="tap">
          Hover over or tap a skill to see a brief description.
        </p>
      </div>

      <!-- Grid to display the skills -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <!-- Skill Card 1: Software Development -->
        <!-- ဒီထဲက data descriptionဆိုတာမှာက -နောက်က အချက်ကို copy paste ထည့် -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Digital circuits နှင့် logic gates ကို ဒီဇိုင်းဆွဲခြင်း၊ စမ်းသပ်ခြင်းများ ပြုလုပ်ရန်။">
          <div class="bg-blue-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Software Development -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="2" y1="6" x2="6" y2="6"></line>
              <line x1="2" y1="10" x2="6" y2="10"></line>
              <line x1="2" y1="14" x2="6" y2="14"></line>
              <line x1="2" y1="18" x2="6" y2="18"></line>

              <path d="M6 4h2a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H6z"></path>
              <path d="M6 12h2a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H6z"></path>

              <line x1="10" y1="8" x2="14" y2="8"></line>
              <line x1="10" y1="16" x2="14" y2="16"></line>

              <path d="M14 5c2.5 0 4 3 4 7s-1.5 7-4 7"></path>

              <line x1="18" y1="12" x2="22" y2="12"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="dld_lab">
            <!-- ဒီမှာ - ရှေ့ကဟာကိုရေး -->
            Digital Logic Design Lab
          </h3>
        </div>

        <!-- Skill Card 2: Networking & Security -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description=" Microprocessor နှင့် microcontroller programming နှင့် စနစ်များကို လေ့လာရန်။">
          <div class="bg-green-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Networking & Security -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="7" y="7" width="10" height="10" rx="1"></rect>

              <line x1="12" y1="7" x2="12" y2="3"></line>
              <line x1="12" y1="17" x2="12" y2="21"></line>
              <line x1="7" y1="12" x2="3" y2="12"></line>
              <line x1="17" y1="12" x2="21" y2="12"></line>

              <circle cx="12" cy="2" r="1"></circle>
              <circle cx="12" cy="22" r="1"></circle>
              <circle cx="2" cy="12" r="1"></circle>
              <circle cx="22" cy="12" r="1"></circle>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="microp_lab">
            Microprocessor and Microcontroller Lab
          </h3>
        </div>

        <!-- Skill Card 3: Emerging Technology -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Embedded system design နှင့် IoT စက်ပစ္စည်းများ ဖန်တီးခြင်း၊ စမ်းသပ်ရန်။">
          <div class="bg-yellow-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Emerging Technology -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"></path>
              <path
                d="M12 4V2M12 22v-2M18.36 5.64l1.42-1.42M4.22 19.78l1.42-1.42M20 12h2M2 12H4m14.36 8.36l-1.42-1.42M5.64 5.64L4.22 4.22">
              </path>

              <rect x="9" y="9" width="6" height="6" rx="1"></rect>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="embed_lab">Embedded Systems Lab</h3>
        </div>

        <!-- Skill Card 4: Professional & Ethical Practices -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Telecommunication နှင့် data communication စနစ်များ လေ့လာရန်။">
          <div class="bg-purple-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Professional & Ethical Practices -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="9" width="6" height="6" rx="1"></rect>
              <line x1="5" y1="6" x2="5" y2="9"></line>

              <path d="M8 12h3l2-4 2 8 2-4h3"></path>

              <rect x="16" y="9" width="6" height="6" rx="1"></rect>
              <line x1="19" y1="15" x2="19" y2="18"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="coms_lab">
            Communication Systems Lab
          </h3>
        </div>

        <!-- Skill Card 5: Project & Research Skills -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description=" Automation နှင့် control theory ကို လေ့လာ၍ practical experiments ပြုလုပ်ရန်။">
          <div class="bg-red-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Project & Research Skills -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="1" y1="12" x2="4" y2="12"></line>

              <circle cx="6" cy="12" r="2"></circle>

              <rect x="9" y="9" width="5" height="6" rx="1"></rect>

              <rect x="15" y="9" width="5" height="6" rx="1"></rect>

              <line x1="20" y1="12" x2="23" y2="12"></line>

              <path d="M18 15v3a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-3"></path>
              <line x1="6" y1="14" x2="6" y2="16"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="control_lab">Control Systems Lab</h3>
        </div>

        <!-- Skill Card 6: Critical Thinking -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Semiconductor device များ၊ electronic circuits နှင့် testing လုပ်ငန်းများ လက်တွေ့စမ်းသပ်ရန်။">
          <div class="bg-indigo-500 text-white rounded-full p-4 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="semi_elec_lab">
            Semiconductors and Electronics Lab
          </h3>
        </div>

       
      </div>
    </div>
  </div>

  <!-- it's end here -->

  <!-- what you will learn here tab -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="advantagesH">
      What You Will Learn After BE Course
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="advan_intro">
      Our Bachelor of Engineering curriculum is designed to prepare you for
      the real world with these key advantages.
    </p>

    <div class="slider-container w-full max-w-6xl mx-auto rounded-2xl shadow-xl overflow-hidden group">
      <div id="slides" class="slides">
        <!-- Slide 1 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_1">
              <!-- ဒီထဲမှာက BEရပြီးရင်သိမယ့်ဟာတွေ sliderမို့လို့ slide divကို copy pasteလုပ်လို့ရတယ် ပိုနေရင်ဖျက် လိုနေရင်ထည့် -->
              Hardware & Software Integration
            </h3>
            <!-- <p class="text-gray-700">Gain practical experience by working on real-world projects and case studies throughout your studies.</p> -->
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_2">
              Computer Systems Knowledge
            </h3>
            <!-- <p class="text-gray-700">Our curriculum is continuously updated to align with the latest industry demands and technologies.</p> -->
          </div>
        </div>
        <!-- Slide 3 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_3">Networking & Security</h3>
            <!-- <p class="text-gray-700">Connect with peers, professors, and industry professionals from around the globe.</p> -->
          </div>
        </div>
        <!-- Slide 4 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_4">
              Embedded & IoT Development
            </h3>
            <!-- <p class="text-gray-700">Receive personalized support for internships, job searches, and career development.</p> -->
          </div>
        </div>
        <!-- Slide 5 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_5">
              Programming & Circuit Design
            </h3>
            <!-- <p class="text-gray-700">Build a solid base in engineering principles that will last throughout your career.</p> -->
          </div>
        </div>
        <!-- Slide 6 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_6">IoT Device Development</h3>
            <!-- <p class="text-gray-700">Tailor your education to your interests with specialized tracks in various engineering fields.</p> -->
          </div>
        </div>
        <!-- Slide 7 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_7">
              Security Awareness (Hardware & Firmware)
            </h3>
            <!-- <p class="text-gray-700">Participate in leadership programs and team-based projects to hone your soft skills.</p> -->
          </div>
        </div>
        <!-- Slide 8 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_8">Advanced Technologies</h3>
            <!-- <p class="text-gray-700">Work alongside faculty on cutting-edge research projects and contribute to new discoveries.</p> -->
          </div>
        </div>
        <!-- Slide 9 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_9">
              Problem Solving & Logical Thinking
            </h3>
            <!-- <p class="text-gray-700">Learn to identify opportunities and develop your own ventures with our dedicated support.</p> -->
          </div>
        </div>
        <!-- Slide 10 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_10">
              Engineering Problem-Solving
            </h3>
            <!-- <p class="text-gray-700">Understand the societal impact of your work and practice engineering with integrity.</p> -->
          </div>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <button id="left-button" class="nav-button left-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button id="right-button" class="nav-button right-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <!-- Dots Container -->
    <div id="dots-container" class="dots-container"></div>
  </div>

  <!-- job opportunities -->
  <!-- Section for Job Opportunities -->
  <div class="container mx-auto job-opportunities-section p-8">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="job_header">
      Career Paths & Job Opportunities
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="job_info">
      <!-- ဒီမှာက စာလေးပြင် -->
     Graduates with a B.E. in Computer Engineering can work in IT and telecommunications companies, hardware manufacturing firms, robotics and automation companies, embedded systems startups, government technology departments, and other related organizations.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- h3 job-cardတွေမှာ စာတွေပြောင်း cardလည်း လိုတိုးပိုလျှော့  -->
      <!-- Job Card 1 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_1">Hardware Engineer</h3>
      </div>
      <!-- Job Card 2 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_2">Embedded Systems Developer</h3>
      </div>
      <!-- Job Card 3 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_3">Network Engineer</h3>
      </div>
      <!-- Job Card 4 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_4">Systems Architect</h3>
      </div>
      <!-- Job Card 5 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_5">IoT Solutions Engineer</h3>
      </div>
      <!-- Job Card 6 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_6">Control Systems Engineer</h3>
      </div>
      <!-- Job Card 7 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_7">Telecommunication Engineer</h3>
      </div>
      <!-- Job Card 8 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_8">Automation Engineer</h3>
      </div>
      <!-- Job Card 9 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_9">Robotics Engineer</h3>
      </div>
      <!-- Job Card 10 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_10">Research and Development Engineer</h3>
      </div>
    </div>
  </div>
  <!-- footer region -->

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
              <a href="../Majors/ist.php" data-lang-key="footer_faculty_ist">Information Science Technology</a>
            </li>
            <li>
              <a href="../Majors/ce.php" data-lang-key="footer_faculty_ce">Computer Engineering</a>
            </li>
            <li>
              <a href="../Majors/ece.php" data-lang-key="footer_faculty_ece">Electronics Engineering</a>
            </li>
            <li><a data-lang-key="footer_faculty_pre" href="../Majors/pre.php">Precision Engineering</a></li>
            <li><a data-lang-key="footer_faculty_ame" href="../Majors/ame.php">
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
              <a href="../terms.php" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a>
            </li>
            <li>
              <a href="../FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
            </li>
            <li>
              <a href="../about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
            </li>
            <li>
              <a href="../randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a>
            </li>
            <li>
              <a href="../data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a>
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
    // ပြင်စရာရှိတယ်
    // Function to update the major details panel
    function updateMajorPanel(title, description, imageUrl) {
      const majorTitle = document.getElementById("major-title");
      const majorDescription = document.getElementById("major-description");
      const majorImage = document.getElementById("major-image");

      // Check if elements exist before updating
      if (majorTitle) {
        majorTitle.textContent = title;
      }
      if (majorDescription) {
        majorDescription.textContent = description;
      }
      if (majorImage) {
        majorImage.src = imageUrl;
      }
    }

    // major name change ပြီးတော့ descriptionရော change
    // --- DOM Elements ---
    const navLinks = document.querySelectorAll(".nav-link");
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    // --- Event Listeners ---
    navLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        // This ensures the page scrolls smoothly to the target section
        const targetId = link.getAttribute("href");
        document
          .querySelector(targetId)
          .scrollIntoView({ behavior: "smooth" });
      });
    });

    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  </script>
  <script src="../js/Des_Major.js"></script>
  <script src="../js/BE_Advantages.js"></script>
  <script>
    // --- Translation Script ---
    const translations = {
      my: {
        major_Title: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
        major_Description:"နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ၏ ကွန်ပျူတာအင်ဂျင်နီယာဌာန (Department of Computer Engineering - CE) သည် ကွန်ပျူတာ hardware (ကွန်ပျူတာစနစ်များ၊ အင်တာနက်ကွန်ယက်များ) နှင့် software (Embedded Systems နှင့် AI/Robotics) နှစ်မျိုးစလုံးကို ပေါင်းစပ်လေ့လာသည့် အင်ဂျင်နီယာဘာသာရပ်တစ်ခု ဖြစ်ပါသည်။ ကွန်ပျူတာအင်ဂျင်နီယာ သည် ကွန်ပျူတာစက်ပစ္စည်းများ၊ ဆော့ဖ်ဝဲများ၊ အင်တာနက်ကွန်ယက်များ၊ စက်မှုလုပ်ငန်းများတွင် အသုံးပြုသော စနစ်များကို ဒီဇိုင်းရေးဆွဲခြင်း၊ ဖန်တီးခြင်း၊ စမ်းသပ်ခြင်းနှင့် ထိန်းသိမ်းခြင်းတို့ကို လေ့လာသည့် နယ်ပယ်ဖြစ်ပါသည်။ ကျွန်ုပ်တို့၏ ဘွဲ့ရရှိသူများသည် နည်းပညာပိုင်းဆိုင်ရာ ကျွမ်းကျင်မှုများနှင့် ပြဿနာဖြေရှင်းနိုင်သော စွမ်းရည်များကို ရရှိထားပြီး စက်မှုလုပ်ငန်း၊ သုတေသနနှင့် တီထွင်ဆန်းသစ်မှုတို့တွင် အောင်မြင်ရန် ပြင်ဆင်ထားပါသည်။",
        utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity_mobile: "လှုပ်ရှားမှုများ",
        nav_examresult_mobile: "အောင်စာရင်း",
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
        uni_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        motto: "ထူးချွန်သော ကွန်ပျူတာအင်ဂျင်နီယာများဖြင့် ခေတ်သစ်ကမ္ဘာကို ဖန်တီးကြမည်။",
        objectives_heading: "ကွန်ပျူတာအင်ဂျင်နီယာဌာန၏ ရည်ရွယ်ချက်နှင့် တာဝန်များမှာ",
        objectives: "ICT နယ်ပယ်တွင် ကျွမ်းကျင်ပြီး စွမ်းဆောင်ရည်ပြည့်ဝသည့် တီထွင်ဆန်းသစ်နိုင်သော အင်ဂျင်နီယာများ ဖော်ဆောင်ပေးရန်။ ခက်ခဲသည့် ပြဿနာများကို ဖြေရှင်းနိုင်သော သင်ယူမှု အဆက်မပြတ်ဆောင်ရွက်နိုင်သော လူ့စွမ်းအားများ ဖန်တီးပေးရန်။ စက်မှုလုပ်ငန်းနှင့် လူမှုအသိုင်းအဝိုင်း၏ လိုအပ်ချက်များ ဖြေရှင်းနိုင်ရန် ကွန်ပျူတာအင်ဂျင်နီယာနယ်ပယ်တွင် နည်းပညာသစ်များနှင့် ပစ္စည်းကိရိယာများ ပံ့ပိုးပေးရန်။ ICT ကို အသုံးချသည့် သင်ယူမှုပတ်ဝန်းကျင် တွင် အခွင့်အလမ်းများ ပေးရန်။ ထို့အပြင် တက်ရောက်လေ့လာမည့် ကျောင်းသား/သူများအား မိမိတို့ အထူးပြုသည့် ဘာသာရပ်များတွင် ကျွမ်းကျင်စေရန် နှင့် တီထွင်ဆန်းသစ်သော သိပ္ပံသုတေသနများ ဆောင်ရွက်ခြင်းတို့ကို လုပ်ဆောင်နိုင်ရန် လေ့ကျင့်သင်ကြားပေးမည် ဖြစ်ပါသည်။ ကွန်ပျူတာအင်ဂျင်နီယာ သင်တန်းသည် ကျောင်းသား/သူများကို နည်းပညာပိုင်းတွင် အခြေခံပညာမှ စ၍ သုတေသနနှင့် လက်တွေ့ကျကျ အဆင့်မြင့်ပညာရရှိစေရန် ရည်ရွယ်ထားပြီး အဓိကလေ့လာရမည့် အကြောင်းအရာများမှာ အောက်ပါအတိုင်းဖြစ်ပါသည်။",
        prog_dev: "ပရိုဂရမ်ရေးခြင်းနှင့် ဆော့ဖ်ဝဲဖွံ့ဖြိုးတိုးတက်မှု",
        pdev_1: "ပရိုဂရမ်းမင်းဘာသာရပ်များ (C, C++, Java, Python စသည်)",
        pdev_2: "ဆော့ဖ်ဝဲအင်ဂျင်နီယာနည်းပညာဒေတာဖွဲ့စည်းပုံများနှင့် အယ်လ်ဂေါရီသမ်များ",
        pdev_3: "ဝဘ်ဆိုက်ဖွံ့ဖြိုးတိုးတက်မှု",
        pdev_4: "မိုဘိုင်းအက်ပ်လီကေးရှင်းဖန်တီးခြင်း",
        pdev_5: "ဆော့ဖ်ဝဲစမ်းသပ်ခြင်းနှင့် အရည်အသွေးအာမခံမှု",
        hw_architecture: "ကွန်ပျူတာဟာ့ဒ်ဝဲ နှင့် ဖွဲ့စည်းပုံဒီဇိုင်း",
        archit_1: "ဒီဂျစ်တယ်လောဂျစ်ဒီဇိုင်း",
        archit_2: "ကွန်ပျူတာဖွဲ့စည်းပုံ နှင့် ပုံစံ",
        archit_3: "မိုက်ခရိုပရိုဆက်ဆာနှင့် မိုက်ခရိုကွန်ထရိုလာ စနစ်များ",
        archit_4: "အတွင်းပိုင်းဖန်တီးတပ်ဆင်ထားသော စနစ်ဒီဇိုင်း",
        network_com: "အင်တာနက်ကွန်ယက် ဖွဲ့စည်းခြင်း နှင့် ဆက်သွယ်ရေး နည်းပညာ",
        netcom_1: "ကွန်ပျူတာကွန်ယက်များ",
        netcom_2: "အင်တာနက်ကွန်ယက်စီမံခန့်ခွဲမှု",
        netcom_3: "ကွန်ယက်လုံခြုံရေးနည်းပညာ",
        netcom_4: "အင်တာနက်နှင့် ဝဘ်နည်းပညာများ",
        sec_system: "လုံခြုံရေးနှင့် စနစ်ဆိုင်ရာနည်းပညာများ",
        secur_1: "အော်ပရေတာစနစ်များ",
        secur_2: "သတင်းအချက်အလက်လုံခြုံရေး",
        secur_3: "ကုဒ်ရေးနည်းပညာနှင့် ကွန်ယက်လုံခြုံရေး",
        secur_4: "စနစ်ပရိုဂရမ်းရေးခြင်း နည်းပညာ",
        adv_emTech: "အဆင့်မြင့်နည်းပညာများနှင့် တိုးတက်လျက်ရှိသောနည်းပညာများ",
        advem_1: "AI အသိဉာဏ်နည်းပညာ",
        advem_2: "စက်ကိရိယာသင်ယူလေ့လာမှု နည်းပညာ",
        advem_3: "Cloud တွက်ချက်ခြင်း နည်းပညာ",
        advem_4: "အရာဝတ္ထုများဆက်သွယ်ရေး(IoT) နည်းပညာ",
        advem_5: "တစ်ချိန်တည်းနှင့် တနေရာတည်းမဟုတ်သော ကွန်ပျူတာစနစ်အလုပ်လုပ်နည်းများ",
        advem_6: "ဒေတာတူးဖော်ခြင်း နည်းပညာ",
        ict_tools: "သိပ္ပံနည်းပညာ၊ ဆက်သွယ်ရေးနှင့် ကိရိယာများ",
        tool_1: "ကွန်ပျူတာအက်ပ်လီကေးရှင်းများ",
        tool_2: "ဒေတာဘေ့စ်စနစ်များ",
        tool_3: "လူနှင့်ကွန်ပျူတာ အပြန်အလှန်သုံးစွဲမှု",
        tool_4: "သတင်းအချက်အလက် နှင့် ဆက်သွယ်ရေးနည်းပညာ ဆိုင်ရာ ကျင့်ဝတ်နှင့် ဥပဒေများ",
        pj_research: "စီမံကိန်း နှင့် သုတေသနလုပ်ငန်းများ",
        project_1: "သတင်းအချက်အလက်နည်းပညာစီမံကိန်းစီမံခန့်ခွဲမှု",
        project_2: "သုတေသနနည်းလမ်းများ",
        project_3: "နောက်ဆုံးနှစ်ပရောဂျက် (ဘွဲ့ကြိုသုတေသနစာတမ်း)",
        project_4: "စက်မှုလုပ်ငန်းဆိုင်ရာလေ့ကျင့်ခွင့် / လက်တွေ့အလုပ်သင်",
        project_5: "အဖွဲ့လိုက်ပူးပေါင်းလုပ်ဆောင်မှု နှင့် ဆက်သွယ်ပြောဆိုနိုင်မှုစွမ်းရည်",
        lab_heading: "သင်ယူလေ့လာနိုင်မည့် နေရာများ",
        lab_intro: "ကွန်ပျူတာအင်ဂျင်နီယာဌာနတွင် သီအိုရီနဲ့ လက်တွေ့ကျကျ လေ့လာမှုများမှတစ်ဆင့် နည်းပညာများကို ကျွမ်းကျင်စေရန်  စမ်းသပ်ခန်းများ (Laboratories) တည်ဆောက်ထားပါသည်။",
        tap: "ကျွမ်းကျင်မှုတစ်ခု၏ အသေးစိတ်ဖော်ပြချက်များကို ကြည့်ရန် နှိပ်ပါ။",
        dld_lab: "ဒစ်ဂျစ်တယ်ဒီဇိုင်း စမ်းသပ်ခန်း",
        microp_lab: "မိုင်ခရိုပရိုဆက်ဆာ နှင့် မိုင်ခရိုကွန်ထရိုလာ စမ်းသပ်ခန်း",
        embed_lab: "စက်ပစ္စည်းထဲတွင် တပ်ဆင်ထည့်သွင်းထားသောစနစ် (Embedded System) များအား စမ်းသပ်ခန်း",
        coms_lab: "ဆက်သွယ်ရေးစနစ် စမ်းသပ်ခန်း",
        control_lab: "ထိန်းချုပ်မှုစနစ် စမ်းသပ်ခန်း",
        semi_elec_lab: "လျှပ်ကူးပစ္စည်းများ နှင့် အီလက်ထရောနစ် စမ်းသပ်ခန်း",
        advantagesH: "ဘွဲ့ကြိုသင်တန်းပြီးနောက် သင်ယူရရှိမည့် အကျိုးကျေးဇူးများ",
        advan_intro: "ကျွန်ုပ်တို့၏ အင်ဂျင်နီယာဘွဲ့ သင်ရိုးညွှန်းတမ်းကို လက်တွေ့အသက်မွေးဝမ်းကျောင်းလောကတွင် အသုံးချနိုင်စေရန် အဓိကအားသာချက်များဖြင့် ပြုစုထားပါသည်။",
        advan_1: "ဟာ့ဒ်ဝဲနှင့် ဆော့ဖ်ဝဲ ပေါင်းစပ် ထည့်သွင်းခြင်း",
        advan_2: "ကွန်ပျူတာစနစ်ဆိုင်ရာ အခြေခံသဘောတရားများ",
        advan_3: "ကွန်ပျူတာကွန်ယက် ဆက်သွယ်မှုစနစ်များ နှင့် လုံခြုံရေးနည်းပညာ",
        advan_4: "ထည့်သွင်းတပ်ဆင်ထားသည့် စနစ်များနှင့် IoT ဖွံ့ဖြိုးတိုးတက်မှု",
        advan_5: "ပရိုဂရမ်ရေးဆွဲခြင်း နှင့် လျှပ်စစ်စက်ဝန်းဒီဇိုင်း",
        advan_6: "IoT ကိရိယာများ ဖန်တီးတိုးတက်မှု",
        advan_7: "ဟာ့ဒ်ဝဲနှင့် ဆော့ဖ်ဝဲ ဆိုင်ရာ လုံခြုံရေးအသိပညာ",
        advan_8: "အဆင့်မြင့် နည်းပညာများ",
        advan_9: "ပြဿနာဖြေရှင်းနိုင်သောစွမ်းရည် နှင့် ယုတ္တိကျသောတွေးခေါ်မှု",
        advan_10: "အင်ဂျင်နီယာနည်းပညာများ သုံး၍ ပြဿနာဖြေရှင်းနည်း",
        job_header: "အလုပ်အကိုင် လမ်းကြောင်းများနှင့် အခွင့်အလမ်းများ",
        job_info: "ကွန်ပျူတာအင်ဂျင်နီယာဘွဲ့ (B.E. Computer Engineering) ရရှိသူများသည် သတင်းအချက်အလက်နည်းပညာ (IT) နှင့် ဆက်သွယ်ရေးကုမ္ပဏီများ၊ ဟာ့ဒ်ဝဲထုတ်လုပ်ရေးကုမ္ပဏီများ၊ robot နှင့် အလိုအလျောက်လုပ်ငန်းများ၊ Embedded System ဖြင့် စတင်သည့်လုပ်ငန်းများ၊ အစိုးရ နည်းပညာဌာနများ၊ ဆက်သွယ်ရေးနယ်ပယ်ဆိုင်ရာ အဖွဲ့အစည်းများနှင့် အခြားဆိုင်ရာအဖွဲ့အစည်းများတွင် အလုပ်လုပ်ကိုင်နိုင်ပါသည်။",
        job_1: "ကွန်ပျူတာပစ္စည်းနှင့် စက်ပစ္စည်း (hardware) အင်ဂျင်နီယာ",
        job_2: "Embedded System တီထွင်ဖန်တီးဖွံ့ဖြိုးရေး အင်ဂျင်နီယာ",
        job_3: "ကွန်ပျူတာကွန်ယက် ဖွဲ့စည်းမှုနှင့် စီမံခန့်ခွဲမှု အင်ဂျင်နီယာ",
        job_4: "အချက်အလက်စနစ် ဖန်တီးမှုနှင့် အစီအစဉ်ရေးဆွဲသူ",
        job_5: "အရာဝတ္ထုအင်တာနက် (IoT) အသုံးချဖန်တီး အင်ဂျင်နီယာ",
        job_6: "ထိန်းချုပ်မှုစနစ် အင်ဂျင်နီယာ",
        job_7: "ဖုန်းနှင့် အင်တာနက် ဆက်သွယ်ရေးစနစ် အင်ဂျင်နီယာ",
        job_8: "အလိုအလျောက် ထိန်းချုပ်မှုနှင့် စက်မှုစနစ် ဖန်တီးသူ",
        job_9: "Robotics နှင့် စက်မှုစနစ် အင်ဂျင်နီယာ",
        job_10: "သုတေသနနှင့် နည်းပညာ ဖန်တီးမှု အင်ဂျင်နီယာ",
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
        
      },
      en: {
        major_Title: "Computer Engineering",
        major_Description:"The Department of Computer Engineering (CE) at the University of Technology (Yatanarpon Cyber City) is a discipline that combines the study of both computer hardware (computer systems, internet networks) and software (Embedded Systems and AI/Robotics). Computer Engineering involves the design, creation, testing, and maintenance of systems used in computers, software, internet networks, and industrial applications. Our graduates are equipped with technical expertise and problem-solving skills to succeed in industry, research, and innovation.",
        utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
       nav_about: "About Us",
        nav_activity: "Activities",
        nav_examresult: "Exam Results",
        nav_about_mobile: "About Us",
        nav_activity_mobile: "Activities",
        nav_examresult_mobile: "Exam Results",
        nav_programs_mobile: "Academic Programs",
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
        uni_name: "University of Technology (Yatanarpon Cyber City)",
        objectives_heading: "The objectives and responsibilities",
        objectives: "To produce innovative engineers who are highly skilled and capable in the field of ICT. To develop human resources that can continuously learn and solve complex problems. To support new technologies and tools in the field of computer engineering to meet the needs of industry and society. To provide opportunities in learning environments that utilize ICT. Additionally, students will be trained and taught to become proficient in their specialized subjects and to conduct innovative scientific research. The Computer Engineering (CE) program aims to provide students with knowledge starting from the fundamentals of technology to advanced levels involving research and practical applications. The main areas of study include the following:",
        prog_dev: "Programming & Software Development",
        pdev_1: "Programming Languages (C, C++, Java, Python စသည်)",
        pdev_2: "Data Structures & Algorithms",
        pdev_3: "Software Engineering",
        pdev_4: "Web Development",
        pdev_5: "Mobile Application Development",
        hw_architecture: "Computer Hardware & Architecture",
        archit_1: "Digital Logic Design",
        archit_2: "Computer Organization & Architecture",
        archit_3: "Microprocessor & Microcontroller Systems",
        archit_4: "Embedded Systems Design",
        network_com: "Networking & Communication",
        netcom_1: "Computer Networks",
        netcom_2: "Network Administration",
        netcom_3: "Network Security",
        netcom_4: "Internet & Web Technologies",
        sec_system: "Security & Systems",
        secur_1: "Operating Systems",
        secur_2: "Information Security",
        secur_3: "Cryptography & Network Security",
        secur_4: "System Programming",
        adv_emTech: "Advanced & Emerging Technologies",
        advem_1: "Artificial Intelligence",
        advem_2: "Machine Learning",
        advem_3: "Cloud Computing",
        advem_4: "Internet of Things (IoT)",
        advem_5: "Parallel & Distributed Computing",
        advem_6: "Data Mining",
        ict_tools: "ICT & Tools",
        tool_1: "Computer Applications",
        tool_2: "Database Systems",
        tool_3: "Human-Computer Interaction",
        tool_4: "ICT Ethics & Laws",
        pj_research: "Project & Research",
        project_1: "ICT Project Management",
        project_2: "Research Methodology",
        project_3: "Final Year Project (B.E Thesis)",
        project_4: "Industrial Attachment / Internship",
        project_5: "Teamwork & Communication Skills",
        lab_heading: "Where You Can Learn",
        lab_intro: "In the Information Science and Technology major, laboratories have been established to help students master technologies through both theoretical and practical learning",
        tap: "Hover over or tap a skill to see a brief description",
        dld_lab: "Digital Logic Design Lab",
        microp_lab: "Microprocessor and Microcontroller Lab",
        embed_lab: "Embedded Systems Lab",
        coms_lab: "Communication Systems Lab",
        control_lab: "Control Systems Lab",
        semi_elec_lab: "Semiconductors and Electronics Lab",
        advantagesH: "What You Will Learn After B.E. Course",
        advan_intro: "Our Bachelor of Engineering curriculum is designed to prepare you for the real world with these key advantages.",
        advan_1: "Hardware & Software Integration",
        advan_2: "Computer Systems Knowledge",
        advan_3: "Embedded & IoT Development",
        advan_4: "Programming & Circuit Design",
        advan_5: "IoT Device Development",
        advan_6: "Programming & Circuit Design",
        advan_7: "Security Awareness (Hardware & Firmware)",
        advan_8: "Advanced Technologies",
        advan_9: "Problem Solving & Logical Thinking",
        advan_10: "Engineering Problem-Solving",
        job_header: "Career Paths & Job Opportunities",
        job_info: "Graduates with a B.E. in Computer Engineering can work in IT and telecommunications companies, hardware manufacturing firms, robotics and automation companies, embedded systems startups, government technology departments, and other related organizations.",
        job_1: "Hardware Engineer",
        job_2: "Embedded Systems Developer",
        job_3: "Network Engineer",
        job_4: "Systems Architect",
        job_5: "IoT Solutions Engineer",
        job_6: "Control Systems Engineer",
        job_7: "Telecommunication Engineer",
        job_8: "Automation Engineer",
        job_9: "Robotics Engineer",
        job_10: "Research and Development Engineer",
        footer_link_dp: "Data Protection",
      },
    };

    const languageSwitcher = document.getElementById("language-switcher-desktop");
    const languageSwitcherMobile = document.getElementById(
      "language-switcher-mobile"
    );

    const changeLanguage = (lang) => {
      // Store the selected language
      localStorage.setItem("language", lang);

      // Set the dropdown to the correct value
      languageSwitcher.value = lang;
      languageSwitcherMobile.value = lang;

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
    languageSwitcher.addEventListener("change", (event) => {
      changeLanguage(event.target.value);
    });

    languageSwitcherMobile.addEventListener("change", (event) => {
      changeLanguage(event.target.value);
    });

    // Function to run when the page loads
    document.addEventListener("DOMContentLoaded", () => {
      // Check for a saved language in localStorage, otherwise default to 'en'
      const savedLang = localStorage.getItem("language") || "en";
      setLanguage(savedLang);
    });
  </script>
  <script src="../js/lgl.js"></script>
</body>

</html>