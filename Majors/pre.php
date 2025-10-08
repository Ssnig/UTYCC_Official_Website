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
  <title>Precision Engineering</title>
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
      <a href="../index.php" class="flex items-center space-x-3">
        <div class="p-2 rounded-lg">
          <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" loading="lazy"/>
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
        <a href="../Rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult">Exam Results</a>

        <!-- Language Switcher Dropdown - Updated Style -->
        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <!-- Custom Button -->
            <button
              class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
                class="h-4 w-6 object-cover flex-shrink-0"loading="lazy">
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
                  class="h-4 w-6 mr-3 object-cover flex-shrink-0"loading="lazy">
                <span>မြန်မာ</span>
              </a>
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                data-lang="en">
                <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0"loading="lazy">
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
      <a href="../Rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_examresult_mobile">Exam Results</a>
        <br><br>
      <div class="relative mt-4 pt-4 border-t">
        <!-- Language Switcher for Mobile -->
        <div id="lang-switcher-container-mobile" class="relative">
          <!-- Custom Button -->
          <button
            class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
              class="h-4 w-6 object-cover flex-shrink-0"loading="lazy">
            <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
            <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
          </button>
          <!-- Custom Dropdown Menu -->
          <div
            class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="my">
              <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                class="h-4 w-6 mr-3 object-cover flex-shrink-0"loading="lazy">
              <span>မြန်မာ</span>
            </a>
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="en">
              <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0"loading="lazy">
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
        <img id="PrE" class="h-48 w-full object-cover md:h-full md:w-48" src="../Img/logo/PrE.png" alt="Major Image" loading="lazy"/>
      </div>
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold" data-lang-key="uni_name">
          University of Technology (Yatanarpon Cyber City)
        </div>
        <a id="major-title" href="#"
          class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"data-lang-key="major_title">Faculty of Precision Engineering</a>
        <p id="major-description" class="mt-2 text-slate-500"data-lang-key="major_description">
The Department of Precision Engineering (PrE) at the University of Technology (Yatanarpon Cyber City) focuses on the design, manufacturing, and creation of automated control systems for precise machinery and components.        </p>
      </div>
    </div>
  </div>
  <!-- headline -->
  <!-- Hero Section to start the page with a strong visual -->
  <header class="mb-12 rounded-3xl overflow-hidden shadow-2xl py-4">
    <div class="relative h-96">
      <!-- ဒီအောက်ကဟာ ကြိုက်တဲ့ပုံထည့်လို့ရတယ် ဥပမာ majorနဲ့ဆိုင်တဲ့ buildingတွေ ပုံတွေက "./Img/utycc_buildings/"ထဲက ဟာတွေယူသုံး srcမှာနော် -->
      <img src="../Img/utycc_buildings/lab3.JPG" alt="Hero image of a bustling university campus"
        class="absolute inset-0 w-full h-full object-cover brightness-75"loading="lazy" />
      <div class="relative z-10 flex items-center justify-center h-full bg-black bg-opacity-40">
        <div class="text-center text-white p-4">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4"
            style="font-family: 'Times New Roman', Times, serif">
            Our Motto
          </h1>
          <!-- mottoက မေဂျာ တစ်ခုချင်းစီရဲ့ ဆောင်ပုဒ် အမ မယမင်း ရဲ့ doc fileတွေမှာသေချာထည့်ပေးထားတယ် အဲ့တာကိုထည့်ပေး -->
          <p class="text-lg sm:text-xl font-light max-w-2xl mx-auto italic" data-lang-key="motto">
            “Our Precision is Your Advantages”<br />
          </p>
        </div>
      </div>
    </div>
  </header>
  <br />

  <!-- Main content container with a grid of cards -->
  <div class="container mx-auto">
    <!-- အောက်ကဟာတွေက ရည်ရွယ်ချက် တာဝန်တွေ ခေါင်းစဥ်နဲ့ စာကိုယ်ခွဲထည့်  -->
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="objectivesH">
      The objectives and responsibilities
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl px-2 mx-auto" data-lang-key="objectives">
      To develop the ability to design products and machinery with high precision. To understand and solve problems related to automation control systems. To comprehend issues concerning electric energy consumption, the operation of various types of AC/DC motors, and the necessary operating conditions for automated factory processes. To prepare students to face future challenges in the field of precision machinery manufacturing engineering.
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
            <path d="M18 6a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v12a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4v-3"></path>

            <line x1="18" y1="10" x2="22" y2="10"></line>
            <line x1="20" y1="8" x2="20" y2="12"></line>

            <line x1="4" y1="12" x2="8" y2="12"></line>
            <line x1="14" y1="12" x2="18" y2="12"></line>

            <rect x="8" y="10" width="6" height="4" rx="0.5"></rect>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="fund_pre">
          Fundamentals of Precision Engineering
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700" data-lang-key="fdpre_1">
          <li class="font-medium text-lg">
            Introduction to precision measurement
          </li>
          <li class="font-medium text-lg" data-lang-key="fdpre_2">Tolerances and fits</li>
          <li class="font-medium text-lg" data-lang-key="fdpre_3">Metrology principles</li>
        </ol>
      </div>

      <!-- Card 2 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-green-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="6" cy="12" r="4" stroke-dasharray="2 2"></circle>
            <path d="M6 12l4-6"></path>
            <path d="M6 12l-2 3.46"></path>
            <circle cx="10" cy="6" r="1"></circle>
            <circle cx="4" cy="15.46" r="1"></circle>

            <line x1="11" y1="12" x2="13" y2="12"></line>

            <circle cx="18" cy="12" r="2"></circle>
            <path d="M18 10V8m0 8v-2m2.8-2.8l1.4-1.4m-8.4 8.4l1.4-1.4m7 0l-1.4-1.4m-8.4 0l-1.4 1.4"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="design_manu">
          Mechanical Design and Manufacturing
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="dgmanu_1">Precision machine design</li>
          <li class="font-medium text-lg" data-lang-key="dgmanu_2">
            Manufacturing processes for high-accuracy components
          </li>
          <li class="font-medium text-lg" data-lang-key="dgmanu_3">CNC machining and tooling</li>
        </ol>
      </div>

      <!-- Card 3   -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-red-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"></line>

            <line x1="5" y1="6" x2="5" y2="10"></line>

            <rect x="11" y="6" width="6" height="12" rx="1"></rect>
            <line x1="14" y1="6" x2="14" y2="10"></line>

            <circle cx="14" cy="14" r="3"></circle>
            <line x1="14" y1="14" x2="16" y2="13"></line>

            <rect x="6" y="8" width="7" height="2" rx="0.5"></rect>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="measure_in">
          Measurement and Instrumentation
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="measure_1">
            Precision measurement instruments
          </li>
          <li class="font-medium text-lg" data-lang-key="measure_2">Sensors and transducers</li>
          <li class="font-medium text-lg" data-lang-key="measure_3">Calibration techniques</li>
        </ol>
      </div>

      <!-- card 4 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-orange-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="1" y1="12" x2="6" y2="12"></line>
            <rect x="6" y="9" width="4" height="6" rx="1"></rect>

            <path d="M10 12h4"></path>
            <path d="M14 12l3-3"></path>
            <path d="M17 9l2 2-2 2"></path>

            <line x1="19" y1="14" x2="23" y2="14"></line>

            <path d="M21 14v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h1"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="auto_contr">Automation and Control Systems</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="auto_1">Automated manufacturing systems</li>
          <li class="font-medium text-lg" data-lang-key="auto_2">Control theory and applications</li>
          <li class="font-medium text-lg" data-lang-key="auto_3">Robotics basics</li>
        </ol>
      </div>

      <!-- card 5 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-amber-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="14" width="20" height="8" rx="1"></rect>
            <line x1="6" y1="18" x2="10" y2="18"></line>
            <line x1="14" y1="18" x2="18" y2="18"></line>
            <line x1="10" y1="16" x2="14" y2="16"></line>
            <line x1="10" y1="20" x2="14" y2="20"></line>

            <line x1="2" y1="14" x2="22" y2="14"></line>

            <rect x="10" y="2" width="4" height="4" rx="1"></rect>
            <line x1="12" y1="6" x2="12" y2="12"></line>
            <polyline points="9 11 12 14 15 11"></polyline>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="material_sur">
          Materials Science and Surface Engineering
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="materials">
            Material properties affecting precision
          </li>
          <li class="font-medium text-lg" data-lang-key="surface">
            Surface finishing and treatment techniques
          </li>
        </ol>
      </div>

      <!-- card 6 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-yellow-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="10" y="2" width="4" height="6" rx="1"></rect>
            <line x1="12" y1="8" x2="12" y2="14"></line>
            <path d="M10 14h4v2h-4z"></path>

            <rect x="4" y="16" width="16" height="6" rx="1"></rect>

            <path d="M7 16v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" stroke-dasharray="2 2"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="cad_cam">
          Computer-Aided Design and Manufacturing (CAD/CAM)
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="cad">CAD modeling</li>
          <li class="font-medium text-lg" data-lang-key="cam">
            CAM programming for precision machining
          </li>
        </ol>
      </div>

      <!-- card 7 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-emerald-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="2 12 5 12 7 8 11 16 13 12 16 12"></polyline>
            <line x1="2" y1="6" x2="16" y2="6" stroke-dasharray="2 2"></line>
            <line x1="2" y1="18" x2="16" y2="18" stroke-dasharray="2 2"></line>

            <circle cx="16" cy="12" r="6"></circle>
            <line x1="20" y1="16" x2="22" y2="18"></line>

            <polyline points="14 12 16 14 18 10"></polyline>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="qual_statis">
          Quality Assurance and Statistical Process Control
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="quality">Quality control methods</li>
          <li class="font-medium text-lg" data-lang-key="statis">
            Statistical analysis for manufacturing processes
          </li>
        </ol>
      </div>
      <!-- card 8 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-amber-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 16c8 4 12-4 20 0v4H2v-4z"></path>

            <rect x="4" y="12" width="6" height="4" rx="1"></rect>
            <rect x="14" y="10" width="6" height="6" rx="1"></rect>

            <circle cx="7" cy="9" r="1"></circle>
            <ellipse cx="7" cy="9" rx="3" ry="1.5"></ellipse>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="micro_nano">
          Microsystems and Nanotechnology
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="nicro">Microfabrication techniques</li>
          <li class="font-medium text-lg" data-lang-key="nano">
            Applications of nanotechnology in precision engineering
          </li>
        </ol>
      </div>
      <!-- card 9 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-yellow-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="16" width="20" height="6" rx="1"></rect>
            <line x1="6" y1="18" x2="6" y2="20"></line>
            <line x1="10" y1="18" x2="10" y2="20"></line>
            <line x1="14" y1="18" x2="14" y2="20"></line>
            <line x1="18" y1="18" x2="18" y2="20"></line>

            <path d="M14 10V4a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v2"></path>
            <path d="M10 10l-1.5 1.5"></path>
            <path d="M14 10l1.5 1.5"></path>

            <rect x="10.5" y="11.5" width="3" height="3" rx="0.5"></rect>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="lab_work">Practical Laboratory Work</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="hands_on">
            Hands-on experience with precision instruments and manufacturing
            equipment
          </li>
          <li class="font-medium text-lg" data-lang-key="real_w">Real-world project implementation</li>
        </ol>
      </div>
    </div>
  </div>
  <!-- card 8 -->

  <!-- card 9 -->


  <!-- anoter description panel -->
  <!-- ဒီမှာကတစ်မျိုး -->
  <!-- New section for "What You Can Learn" -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="lab_heading">
      Where You Can Learn
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="lab_intro">
      In the Department of Precision Engineering, Laboratories have been established to allow students to gain practical knowledge of the precision and automation technologies required in industrial operations.
    </p>

    <!-- Description box above the cards -->
    <div id="skillCardContainer">
      <!-- Description box - Its position in HTML does not matter as much now -->
      <div id="descriptionBox"
        class="transition-opacity duration-200 opacity-100 ease-in-out w-full h-24 bg-white rounded-xl shadow-lg flex mb-8 italic items-center justify-center p-4 text-center text-gray-700">
        <p id="descriptionText" data-lang-key="tap">Hover over or tap a skill to see a brief description.</p>
      </div>

      <!-- Grid to display the skills -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <!-- Skill Card 1: Software Development -->
        <!-- ဒီထဲက data descriptionဆိုတာမှာက -နောက်က အချက်ကို copy paste ထည့် -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Precision measurement tools and instruments 

အသုံးပြုပြီး အတိုင်းအတာတိုင်းတာခြင်း၊ တိကျမှန်ကန်မှုစစ်ဆေးခြင်းများ လေ့ကျင့်ရန်။">
          <div class="bg-blue-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Software Development -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16v4H4z"></path>
              <line x1="12" y1="8" x2="12" y2="14"></line>

              <circle cx="12" cy="16" r="2"></circle>

              <path d="M6 22c-2-2-2-6 0-8s6-2 8 0"></path>

              <line x1="12" y1="18" x2="10" y2="20"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="metro_lab">
            <!-- ဒီမှာ - ရှေ့ကဟာကိုရေး -->
            Metrology Laboratory
          </h3>
        </div>

        <!-- Skill Card 2: Networking & Security -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="CNC machines, milling machines, lathe machines စသဖြင့် အမြင့်တိကျစွာ စက်မှုလုပ်ငန်းဆိုင်ရာ ကိရိယာများကို လက်တွေ့အသုံးပြုရန်။">
          <div class="bg-green-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Networking & Security -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="9" width="4" height="6" rx="1"></rect>
              <line x1="4" y1="9" x2="4" y2="6"></line>
              <line x1="4" y1="15" x2="4" y2="18"></line>

              <path d="M6 12h12"></path>
              <path d="M18 10a2 2 0 1 1 0 4 2 2 0 0 1 0-4z"></path>

              <path d="M16 12l4-4v8l-4-4z"></path>

              <path d="M14 10a1 1 0 0 1-1-1 1 1 0 0 0-2 0"></path>
              <path d="M15 14a1 1 0 0 0 1 1 1 1 0 0 1 2 0"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="mech_lab">
            Mechanical Manufacturing Laboratory
          </h3>
        </div>

        <!-- Skill Card 3: Emerging Technology -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Automated system design နှင့် control system များကို စမ်းသပ်၊ လေ့လာရန်။">
          <div class="bg-yellow-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Emerging Technology -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="2" y1="18" x2="22" y2="18"></line>
              <circle cx="5" cy="18" r="2"></circle>
              <circle cx="19" cy="18" r="2"></circle>

              <rect x="9" y="14" width="4" height="4" rx="0.5"></rect>

              <path d="M6 14a6 6 0 0 1 12 0"></path>
              <line x1="12" y1="8" x2="12" y2="4"></line>

              <rect x="10" y="2" width="4" height="4" rx="0.5"></rect>

            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="autocon_lab">
            Automation and Control Laboratory
          </h3>
        </div>

        <!-- Skill Card 4: Professional & Ethical Practices -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Materials testing နှင့် surface finishing နည်းပညာများကို လေ့လာရန်။

">
          <div class="bg-purple-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Professional & Ethical Practices -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="14" width="20" height="8" rx="1"></rect>

              <path d="M8 4h8v4H8z"></path>
              <line x1="12" y1="8" x2="12" y2="14"></line>

              <polyline points="4 14 6 12 8 14"></polyline>
              <polyline points="10 14 12 12 14 14"></polyline>
              <polyline points="16 14 18 12 20 14"></polyline>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="matesur_lab">
            Materials and Surface Engineering Laboratory
          </h3>
        </div>

        <!-- Skill Card 5: Project & Research Skills -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Computer-Aided Design (CAD) နဲ့ Computer-Aided Manufacturing (CAM) software များကို 

အသုံးပြုပြီး ပရောဂျက်လုပ်ငန်းများ တည်ဆောက်ရန်။">
          <div class="bg-red-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Project & Research Skills -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="10" y="2" width="4" height="6" rx="1"></rect>
              <line x1="12" y1="8" x2="12" y2="14"></line>
              <path d="M10 14h4v2h-4z"></path>

              <rect x="4" y="16" width="16" height="6" rx="1"></rect>

              <path d="M7 16v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" stroke-dasharray="2 2"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="cadcam_lab">CAD/CAM Laboratory</h3>
        </div>

        <!-- Skill Card 6: Critical Thinking -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Statistical process control နဲ့ manufacturing quality analysis လုပ်ငန်းများ လေ့ကျင့်ရန်။">
          <div class="bg-indigo-500 text-white rounded-full p-4 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="8" y="9" width="8" height="6" rx="1"></rect>

              <path d="M4 4v16h4"></path>
              <path d="M20 4v16h-4"></path>
              <line x1="8" y1="12" x2="4" y2="12"></line>
              <line x1="16" y1="12" x2="20" y2="12"></line>

              <polyline points="9 6 11 8 15 4"></polyline>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="qual_lab">
            Quality Control Laboratory
          </h3>
        </div>

        
               
      </div>
    </div>
  </div>
  <!-- it's end here -->

  <!-- what you will learn here tab -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="advandagesH">
      What You Will Learn After B.E. Course
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
              Accurate Mechanical Design Skills
            </h3>
            <!-- <p class="text-gray-700">Gain practical experience by working on real-world projects and case studies throughout your studies.</p> -->
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_2">
              Automation System Development
            </h3>
            <!-- <p class="text-gray-700">Our curriculum is continuously updated to align with the latest industry demands and technologies.</p> -->
          </div>
        </div>
        <!-- Slide 3 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_3">
              Quality Control and Assurance
            </h3>
            <!-- <p class="text-gray-700">Connect with peers, professors, and industry professionals from around the globe.</p> -->
          </div>
        </div>
        <!-- Slide 4 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_4">
              Problem-Solving and Innovation
            </h3>
            <!-- <p class="text-gray-700">Receive personalized support for internships, job searches, and career development.</p> -->
          </div>
        </div>
        <!-- Slide 5 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_5">
              Research and Development Skills
            </h3>
            <!-- <p class="text-gray-700">Build a solid base in engineering principles that will last throughout your career.</p> -->
          </div>
        </div>
        <!-- Slide 6 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_6">CAD/CAM Proficiency</h3>
            <!-- <p class="text-gray-700">Tailor your education to your interests with specialized tracks in various engineering fields.</p> -->
          </div>
        </div>
        <!-- Slide 7 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_7">
              Material Science Understanding
            </h3>
            <!-- <p class="text-gray-700">Participate in leadership programs and team-based projects to hone your soft skills.</p> -->
          </div>
        </div>
        <!-- Slide 8 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_8">
              Teamwork and Communication
            </h3>
            <!-- <p class="text-gray-700">Work alongside faculty on cutting-edge research projects and contribute to new discoveries.</p> -->
          </div>
        </div>
        <!-- Slide 9 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_9">
              Practical Hands-On Experience
            </h3>
            <!-- <p class="text-gray-700">Learn to identify opportunities and develop your own ventures with our dedicated support.</p> -->
          </div>
        </div>
        <!-- Slide 10 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_10">
              Professional Ethics and Standards
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
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="jobs_heading">
      Career Paths & Job Opportunities
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="jobs_info">
      <!-- ဒီမှာက စာလေးပြင် -->
      Graduates with a B.E. in Mechanical Precision and Automation can work in Industrial Automation firms, Consumer Goods manufacturers, Automotive industry companies, Precision Tool and Equipment manufacturers, and similar organizations.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- h3 job-cardတွေမှာ စာတွေပြောင်း cardလည်း လိုတိုးပိုလျှော့  -->
      <!-- Job Card 1 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_1">Manufacturing Engineer</h3>
      </div>
      <!-- Job Card 2 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_2">Quality Assurance Engineer</h3>
      </div>
      <!-- Job Card 3 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_3">Automation Engineer</h3>
      </div>
      <!-- Job Card 4 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_4">Production Engineer</h3>
      </div>
      <!-- Job Card 5 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_5">Maintenance Engineer</h3>
      </div>
      <!-- Job Card 6 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_6">Project Engineer</h3>
      </div>
      <!-- Job Card 7 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_7">Technical Officer</h3>
      </div>
      <!-- Job Card 8 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_8">Process Engineer</h3>
      </div>
      <!-- Job Card 9 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_9">Research and Development Engineer</h3>
      </div>
      <!-- Job Card 10 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_10">Calibration Engineer</h3>
      </div>
    </div>
  </div>
  <!-- footer region -->

  <footer id="contact" class="bg-blue-900 text-white ">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" loading="lazy"/>
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 text-sm mt-4">
            <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
              Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay
              Region, Myanmar
            </a>
          </p>
          <div class="mt-4 text-sm text-blue-200">
            <a href="mailto:utyccstudentaffair2010@gmail.com">Email: info@utycc.site utyccstudentaffair2010@gmail.com</a>
                        <br><a href="tel:+959445767834">Phone: +959445767834 </a>
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
  <script src="../JS/Des_Major.js"></script>
  <script src="../JS/BE_Advantages.js"></script>
  <script>
    // --- Translation Script ---
    const translations = {
      my: {
        major_title: "တိကျစက်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ",
        major_description:
          "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)  ၏ တိကျစက်ပစ္စည်းထုတ်လုပ်မှုအင်ဂျင်နီယာဌာန (Faculty of Precision Engineering - PrE) သည် တိကျမှန်ကန်သော စက်ပစ္စည်းများ၊ စက်ပစ္စည်းအစိတ်အပိုင်းများကို ဒီဇိုင်းရေးဆွဲခြင်း၊ ထုတ်လုပ်ခြင်းနှင့် အလိုအလျောက်ထိန်းချုပ်စနစ်များ ဖန်တီးခြင်းကို အဓိကထား သင်ကြားပေးသော ဘာသာရပ်တစ်ခုဖြစ်သည်။",
        utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity_mobile: "လှုပ်ရှားမှုများ",
        nav_examresult_mobile: "အောင်စာရင်း",
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
          "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
        footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
        footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ",
        footer_link_faq: "အမေးများသော မေးခွန်းများ",
        footer_link_about: "ကျွန်ုပ်တို့အကြောင်း",
        footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
        motto: '"ကျွန်ုပ်တို့၏ တိကျမှန်ကန်မှုက သင့်အတွက် အားသာချက်ဖြစ်စေသည်။"',
        objectivesH: "တိကျစက်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာဌာန၏ ရည်ရွယ်ချက်နှင့် တာဝန်များမှာ",
        objectives: "တိကျမှန်ကန်မှု မြင့်မားသည့် ထုတ်ကုန်များ၊ စက်ပစ္စည်းများအတွက် ဒီဇိုင်းရေးဆွဲနိုင်စွမ်း ရရှိစေရန်။ အလိုအလျောက်ထိန်းချုပ်မှုစနစ်များ (control systems in automation) နှင့် ဆိုင်သော ပြဿနာများကို နားလည်ပြီး ဖြေရှင်းနိုင်စွမ်း ရရှိစေရန်။ လျှပ်စစ်စွမ်းအင် အသုံးစရိတ်၊ AC/DC မော်တော် အမျိုးအစားမျိုးစုံ၏ လည်ပတ်မှု မောင်းနှင်စနစ်များနှင့် စက်ရုံ အလိုအလျောက် လုပ်ငန်းစဉ်များအတွက် လိုအပ်သည့် လည်ပတ်မှု အခြေအနေ ထိန်းသိမ်းခြင်းဆိုင်ရာ ပြဿနာများကို နားလည်စေရန်။ တိကျစက်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာကဏ္ဍ တွင် အနာဂတ် စိန်ခေါ်မှုများကို ရင်ဆိုင်နိုင်စေရန်။ တိကျစက်ပစ္စည်းထုတ်လုပ်မှူ အင်ဂျင်နီယာမေဂျာ ဘာသာရပ်သင်တန်း သည် ကျောင်းသား/သူများကို ထုတ်ကုန်နှင့် လုပ်ငန်းစဉ်များကို အလွန်တိကျမှန်ကန်မှုလိုအပ်သော Ultraprecision မှ အရည်အသွေးမြင့် Mass Production အထိ အကျိုးကျေးဇူး အများအပြား ရရှိနိုင်စေရန် ရည်ရွယ်ထားပြီး၊ အဓိက လေ့လာရမည့် အကြောင်းအရာများမှာ အောက်ပါအတိုင်း ဖြစ်ပါသည်။",
        fund_pre: "တိကျစက်ပစ္စည်းအင်ဂျင်နီယာ အခြေခံများ",
        fdpre_1: "တိကျမှန်ကန်စွာ တိုင်းတာမှု အခြေခံ",
        fdpre_2: "တိကျမှုနှင့် ချိန်ညှိမူ",
        fdpre_3: "တိုင်းတာဗေဒ အခြေခံအကြောင်းအရာများ",
        design_manu: "စက်မှုဒီဇိုင်းနှင့် ထုတ်လုပ်မှု",
        dgmanu_1: "တိကျစက်ယန္တရား ဒီဇိုင်းရေးဆွဲမှု",
        dgmanu_2: "တိကျအစိတ်အပိုင်းများအတွက် ထုတ်လုပ်မှုနည်းလမ်းများ",
        dgmanu_3: "ကွန်ပျူတာနည်းပညာဖြင့် စက်ပစ္စည်း အလိုအလျောက်ထိန်းချုပ်ခြင်း နည်းပညာ နှင့် ကိရိယာထုတ်လုပ်မှု",
        measure_in: "တိုင်းတာခြင်းနှင့် ကိရိယာများ",
        measure_1: "တိကျမှန်ကန်မှု အတိုင်းအတာပစ္စည်းများ",
        measure_2: "အာရုံခံကိရိယာများ နှင့် လျှပ်စစ်-မက်ကန်နစ် အပြောင်းအလဲကိရိယာများ",
        measure_3: "ကိရိယာချိန်ညှိခြင်း နည်းဗျူဟာများ",
        auto_contr: "အလိုအလျောက်စနစ် နှင့် ထိန်းချုပ်ရေးစနစ်များ",
        auto_1: "အလိုအလျောက်ထုတ်လုပ်ရေးစနစ်များ",
        auto_2: "ထိန်းချုပ်ရေးသီအိုရီ နှင့် အသုံးချမှုများ",
        auto_3: "ရိုဘော့နည်းပညာ (Robotics) အခြေခံများ",
        material_sur: "ပစ္စည်းဗေဒ နှင့် မျက်နှာပြင် အင်ဂျင်နီယာ",
        materials: "တိကျမှန်ကန်မှုကို သက်ရောက်စေသော ပစ္စည်းဂုဏ်သတ္တိများ",
        surface: "မျက်နှာပြင် ပြင်ဆင်ခြင်း နှင့် ထိန်းသိမ်းပြုပြင်ခြင်း နည်းပညာများ",
        cad_cam: "ကွန်ပျူတာကူညီဒီဇိုင်းနှင့် ထုတ်လုပ်မှု (CAD/CAM)",
        cad: "CAD မော်ဒယ်ရေးဆွဲခြင်း",
        cam: "တိကျစက်ထည်လုပ်ခြင်းအတွက် CAM ပရိုဂရမ်ရေးဆွဲခြင်း",
        qual_statis: "အရည်အသွေးအာမခံနှင့် စာရင်းအချက်အလက်အခြေပြု လုပ်ငန်းစဉ် ထိန်းချုပ်မှု",
        quality: "အရည်အသွေး ထိန်းချုပ်မှုနည်းလမ်းများ",
        statis: "ထုတ်လုပ်မှုလုပ်ငန်းစဉ်များအတွက် စာရင်းအချက်အလက် ချဲ့ထွင်စိစစ်မှု",
        micro_nano: "မိုက်ခရိုစနစ်များ နှင့် နာနိုနည်းပညာ",
        micro: "မိုက်ခရိုစနစ်ထုတ်လုပ်မှု နည်းလမ်းများ",
        nano: "တိကျထုတ်လုပ်မှူတွင် နာနိုနည်းပညာ အသုံးချမှုများ",
        lab_work: "လက်တွေ့ အလုပ်ရုံ လေ့ကျင့်ခန်းများ",
        hands_on: "တိကျကိရိယာများနှင့် ထုတ်လုပ်ရေးပစ္စည်းများကို လက်တွေ့အသုံးပြု၍ လေ့ကျင့်ခန်း",
        real_w: "လက်တွေ့လုပ်ငန်းအစီအစဉ် ဆောင်ရွက်မှု",
        labs_heading: "သင်ယူလေ့လာနိုင်မည့် နေရာများ",
        lab_intro: "တိကျစက်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာဌာနသည် စက်မှုလုပ်ငန်းများတွင် လိုအပ်သော တိကျမှုနှင့် အလိုအလျောက်စနစ်နည်းပညာများကို လက်တွေ့ကျကျ သင်ယူနိုင်ရန်  စမ်းသပ်ခန်းများ (Laboratories) တည်ဆောက်ထားပါသည်။",
        tap: "ကျွမ်းကျင်မှုတစ်ခု၏ အသေးစိတ်ဖော်ပြချက်များကို ကြည့်ရန် နှိပ်ပါ။",
        metro_lab: "တိုင်းတာဗေဒ စမ်းသပ်ခန်း",
        mech_lab: "စက်မှု ထုတ်လုပ်မှု စမ်းသပ်ခန်း",
        autocon_lab: "အလိုအလျောက်လုပ်ငန်း နှင့် ထိန်းချုပ်ရေး စမ်းသပ်ခန်း",
        matesur_lab: "ပစ္စည်းဗေဒ နှင့် မျက်နှာပြင် အင်ဂျင်နီယာ စမ်းသပ်ခန်း",
        cadcam_lab: "ကွန်ပျူတာ အခြေပြု မော်ဒယ်နှင့် အလိုအလျောက်ထုတ်လုပ်မှု စမ်းသပ်ခန်း",
        qual_lab: "အရည်အသွေး ထိန်းချုပ်စစ်ဆေးမှု စမ်းသပ်ခန်း",
        advandagesH: "ဘွဲ့ကြိုသင်တန်းပြီးနောက် သင်ယူရရှိမည့် အကျိုးကျေးဇူးများ",
        advan_intro: "ကျွန်ုပ်တို့၏ အင်ဂျင်နီယာဘွဲ့ သင်ရိုးညွှန်းတမ်းကို လက်တွေ့အသက်မွေးဝမ်းကျောင်းလောကတွင် အသုံးချနိုင်စေရန် အဓိကအားသာချက်များဖြင့် ပြုစုထားပါသည်။",
        advan_1: "စက်ပစ္စည်းဒီဇိုင်း တိကျကျွမ်းကျင်မှု",
        advan_2: "အလိုအလျောက်စနစ် တီထွင်ဖန်တီးနိုင်မှု",
        advan_3: "ထုတ်ကုန်အရည်အသွေး စောင့်ကြည့်နှင့် အာမခံမှု",
        advan_4: "ပြဿနာဖြေရှင်းနိုင်မှု နှင့် ဆန်းသစ်တီထွင်နိုင်မှု",
        advan_5: "သုတေသန နှင့် ဖွံ့ဖြိုးတိုးတက်ရေး အတတ်ပညာ",
        advan_6: "ကွန်ပျူတာကူညီ ဒီဇိုင်းနှင့် ထုတ်လုပ်မှု ကျွမ်းကျင်မှု",
        advan_7: "ပစ္စည်းနှင့် မျက်နှာပြင် နည်းပညာ နားလည်မှု",
        advan_8: "အဖွဲ့လိုက် လုပ်ဆောင်နိုင်မှုနှင့် ဆက်ဆံရေး ကျွမ်းကျင်မှု",
        advan_9: "လက်တွေ့လေ့ကျင့်မှု အတွေ့အကြုံများ",
        advan_10: "အလုပ်သမားကျင့်ဝတ်များ နှင့် စည်းမျဉ်းစံချိန်များ",
        job_heading: "အလုပ်အကိုင် လမ်းကြောင်းများနှင့် အခွင့်အလမ်းများ",
        jobs_info: "စက်မှုတိကျမှန်ကန်မှု နှင့် အလိုအလျောက်စနစ် အင်ဂျင်နီယာဘွဲ့ (B.E. Mechanical Precision and Automation) ရရှိသူများသည် စက်မှုအလိုအလျောက်လုပ်ငန်းကုမ္ပဏီများ၊ စားသုံးကုန်ထုတ်လုပ်သူများ၊ ယာဉ်စက်မှုလုပ်ငန်းကုမ္ပဏီများ၊ တိကျမှန်ကန်မှုကိရိယာ နှင့် ပစ္စည်းထုတ်လုပ်ခြင်းများ စသည်တို့တွင် အလုပ်လုပ်နိုင်ပါသည်။",
        job_1: "စက်မှုလုပ်ငန်းထုတ်လုပ်မှု အင်ဂျင်နီယာ",
        job_2: "ထုတ်ကုန်အရည်အသွေး စောင့်ကြည့်အင်ဂျင်နီယာ",
        job_3: "အလိုအလျောက်စနစ် အင်ဂျင်နီယာ",
        job_4: "စက်မှုထုတ်လုပ်မှု စီမံခန့်ခွဲ အင်ဂျင်နီယာ",
        job_5: "စက်ပစ္စည်း ပြုပြင်ထိန်းသိမ်းမှု အင်ဂျင်နီယာ",
        job_6: "လုပ်ငန်းစီမံခန့်ခွဲမှု အင်ဂျင်နီယာ",
        job_7: "နည်းပညာဆိုင်ရာ စီမံခန့်ခွဲသူ",
        job_8: "ထုတ်လုပ်မှုလုပ်ငန်းစဉ် အင်ဂျင်နီယာ",
        job_9: "သုတေသနနှင့် ဖွံ့ဖြိုးတိုးတက်ရေး အင်ဂျင်နီယာ",
        job_10: "စက်ပစ္စည်းတိုင်းတာချိန်ညှိ အင်ဂျင်နီယာ",
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
      },
      
      en: {
        major_title: "Mechanical Precision and Automation Engineering",
        major_description:
          "The Department of Precision Engineering (PrE) at the University of Technology (Yatanarpon Cyber City) focuses on the design, manufacturing, and creation of automated control systems for precise machinery and components.",
        utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
        nav_about: "About Us",
        nav_activity: "Activities",
        nav_examresult: "Exam Results",
        nav_about_mobile: "About Us",
        nav_activity_mobile: "Activities",
        nav_examresult_mobile: "Exam Results",
        nav_programs_mobile: "Academic Programs",
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
          "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
        footer_quick_links_title: "Quick Links",
        footer_link_terms: "Terms & Policies",
        footer_link_faq: "FAQs",
        footer_link_about: "About Us",
        footer_link_rules: "Rules & Regulations",
        uni_name: "University of Technology (Yatanarpon Cyber City)",
        motto: '"Our Precision is Your Advantages"',
        objectivesH: "The objectives and responsibilities",
        objectives: "To develop the ability to design products and machinery with high precision. To understand and solve problems related to automation control systems. To comprehend issues concerning electric energy consumption, the operation of various types of AC/DC motors, and the necessary operating conditions for automated factory processes. To prepare students to face future challenges in the field of precision machinery manufacturing engineering.",
        fund_pre: "Fundamentals of Precision Engineering",
        fdpre_1: "Introduction to precision measurement",
        fdpre_2: "Tolerances and fits",
        fdpre_3: "Metrology principles",
        design_manu: "Mechanical Design and Manufacturing",
        dgmanu_1: "Precision machine design",
        dgmanu_2: "Manufacturing processes for high-accuracy components",
        dgmanu_3: "CNC machining and tooling",
        measure_in: "Measurement and Instrumentation",
        measure_1: "Precision measurement instruments",
        measure_2: "Sensors and transducers",
        measure_3: "Calibration techniques",
        auto_contr: "Automation and Control Systems",
        auto_1: "Automated manufacturing systems",
        auto_2: "Control theory and applications",
        auto_3: "Robotics basics",
        material_sur: "Materials Science and Surface Engineering",
        materials: "Material properties affecting precision",
        surface: "Surface finishing and treatment techniques",
        cad_cam: "Computer-Aided Design and Manufacturing (CAD/CAM)",
        cad: "CAD modeling",
        cam: "CAM programming for precision machining",
        qual_statis: "Quality Assurance and Statistical Process Control",
        quality: "Statistical analysis for manufacturing processes",
        statis: "Statistical analysis for manufacturing processes",
        micro_nano: "Microsystems and Nanotechnology",
        micro: "Microfabrication techniques",
        nano: "Applications of nanotechnology in precision engineering",
        lab_work: "Practical Laboratory Work",
        hands_on: "Hands-on experience with precision instruments and manufacturing equipment",
        real_w: "Real-world project implementation",
        lab_heading: "Where You Can Learn",
        lab_intro: "In the Department of Precision Engineering, Laboratories have been established to allow students to gain practical knowledge of the precision and automation technologies required in industrial operations.",
        tap: "Hover over or tap a skill to see a brief description",
        metro_lab: "Metrology Laboratory",
        mech_lab: "Mechanical Manufacturing Laboratory",
        autocon_lab: "Automation and Control Laboratory",
        matesur_lab: "Materials and Surface Engineering Laboratory",
        cadcam_lab: "CAD/CAM Laboratory",
        qual_lab: "Quality Control Laboratory",
        advantagesH: "What You Will Learn After B.E. Course",
        advan_intro: "Our Bachelor of Engineering curriculum is designed to prepare you for the real world with these key advantages.",
        advan_1: "Accurate Mechanical Design Skills",
        advan_2: "Automation System Development",
        advan_3: "Quality Control and Assurance",
        advan_4: "Problem-Solving and Innovation",
        advan_5: "Research and Development Skills",
        advan_6: "CAD/CAM Proficiency",
        advan_7: "Material Science Understanding",
        advan_8: "Teamwork and Communication",
        advan_9: "Practical Hands-On Experience",
        advan_10: "Professional Ethics and Standards",
        jobs_heading: "Career Paths & Job Opportunities",
        jobs_info: "Graduates with a B.E. in Mechanical Precision and Automation can work in Industrial Automation firms, Consumer Goods manufacturers, Automotive industry companies, Precision Tool and Equipment manufacturers, and similar organizations.",
        job_1: "Manufacturing Engineer",
        job_2: "Quality Assurance Engineer",
        job_3: "Automation Engineer",
        job_4: "Production Engineer",
        job_5: "Maintenance Engineer",
        job_6: "Project Engineer",
        job_7: "Technical Officer",
        job_8: "Process Engineer",
        job_9: "Research and Development Engineer",
        job_10: "Calibration Engineer",
        footer_link_dp: "Data Protection",
      },
    };

    const languageSwitcher = document.getElementById("language-switcher-desktop");
    const languageSwitcherMobile = document.getElementById('language-switcher-mobile');

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

    languageSwitcherMobile.addEventListener('change', (event) => {
      changeLanguage(event.target.value);
    });

    // Function to run when the page loads
    document.addEventListener("DOMContentLoaded", () => {
      // Check for a saved language in localStorage, otherwise default to 'en'
      const savedLang = localStorage.getItem("language") || "en";
      setLanguage(savedLang);
    });
  </script>
  <script src="../JS/lgl.js"></script>
</body>

</html>