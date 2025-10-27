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
  <title>Electronics Engineering</title>
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
        <img id="EcE" class="h-48 w-full object-cover md:h-full md:w-48" src="../Img/logo/EcE.jpg" alt="Major Image" loading="lazy"/>
      </div>
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold" data-lang-key="uni_name">
          University of Technology (Yatanarpon Cyber City)
        </div>
        <a id="major-title" href="#"
          class="block mt-1 text-lg leading-tight font-medium text-black hover:underline" data-lang-key="major_title">Faculty of Electronics Engineering</a>
        <p id="major-description" class="mt-2 text-slate-500"data-lang-key="major_description">
          The Faculty of Electronics Engineering (EcE) at the University of Technology (Yatanarpon Cyber City) is an engineering discipline that focuses on the study, design, integration, and testing of electronic systems, devices, communication technologies, and signal processing.
        </p>
      </div>
    </div>
  </div>
  <!-- headline -->
  <!-- Hero Section to start the page with a strong visual -->
  <header class="mb-12 rounded-3xl overflow-hidden shadow-2xl py-4">
    <div class="relative h-96">
      <!-- ဒီအောက်ကဟာ ကြိုက်တဲ့ပုံထည့်လို့ရတယ် ဥပမာ majorနဲ့ဆိုင်တဲ့ buildingတွေ ပုံတွေက "./Img/utycc_buildings/"ထဲက ဟာတွေယူသုံး srcမှာနော် -->
      <img src="../Img/utycc_buildings/lab3.JPG" alt="Hero image of a bustling university campus"
        class="absolute inset-0 w-full h-full object-cover brightness-75" loading="lazy"/>
      <div class="relative z-10 flex items-center justify-center h-full bg-black bg-opacity-40">
        <div class="text-center text-white p-4">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4"
            style="font-family: 'Times New Roman', Times, serif">
            Our Motto
          </h1>
          <!-- mottoက မေဂျာ တစ်ခုချင်းစီရဲ့ ဆောင်ပုဒ် အမ မယမင်း ရဲ့ doc fileတွေမှာသေချာထည့်ပေးထားတယ် အဲ့တာကိုထည့်ပေး -->
          <p class="text-lg sm:text-xl font-light max-w-2xl mx-auto italic" data-lang-key="motto">
            “Let’s innovate for SMART Living!”
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
      The program is designed to provide students with foundational knowledge and advanced expertise in electronics and communication technologies. It aims to enable them to actively participate in designing and developing widely used communication systems and smart systems in various contexts. The curriculum ensures that students acquire the technical skills required in the professional workplace, becoming fully qualified and competent engineers. It also emphasizes the development of critical thinking and problem-solving abilities through research, innovation, and practical application of technology-related challenges. Moreover, students will be trained to face challenges in their specialized field of electronics engineering through enhanced learning and practical training systems. The Electronics and Communication Engineering (EcE) program is intended to equip students to carry out research activities with innovation using the latest technologies, with the key topics of study outlined as follows.
    </p>

    <!-- Grid to hold the cards -->
    <div id="majorsGrid" class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 py-4">
      <!-- cardတွေမှာက ခေါင်းစဥ်တွေ နံပါတ်တွေကို အစဥ်လိုက်ထည့်ပေး တစ်ခုချင်းစီတွက် card တစ်ခုစီ အမယမင်းရေးထားတဲ့ IST docက ပုံစံနဲ့ အောက်ဟာကိုယှဥ်ကြည့် h3မှာခေါင်းစဥ် li မှာအောက်ကအချက် အချက်လိုရင်liထည့်ထပ်ရေး cardလိုရင် cardတစ်ခုကို copy paste သုံးလို့ရ -->
      <!-- Card 1  -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-indigo-500 text-white rounded-full p-3 mb-4">
          <!-- Icon for the card - using a simple SVG or emoji is great -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 12h4l2-4 4 8 4-8 2 4h4"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="elec_fundas">
          Fundamentals of Electronics
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="fundas_1">
            Circuit Theory
          </li>
          <li class="font-medium text-lg" data-lang-key="fundas_2">
            Data Structures & Algorithms
          </li>
          <li class="font-medium text-lg" data-lang-key="fundas_3">
            Analog Electronics
          </li>
          <li class="font-medium text-lg" data-lang-key="fundas_4">
            Digital Electronics
          </li>
          <li class="font-medium text-lg" data-lang-key="fundas_5">
            Semiconductor Devices
          </li>
        </ol>
      </div>

      <!-- Card 2 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-green-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 8L16 12L12 16L8 12Z"></path>
            <path d="M12 16V20"></path>
            <path d="M10 20Q12 22 14 20"></path>
            <path d="M8 12L2 6"></path>
            <path d="M16 12L22 6"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="com_systems">
          Communication Systems
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="system_1">
            Analog and Digital Communication
          </li>
          <li class="font-medium text-lg" data-lang-key="system_2">
            Wireless Communication
          </li>
          <li class="font-medium text-lg" data-lang-key="system_3">
            Optical Communication
          </li>
          <li class="font-medium text-lg" data-lang-key="system_4">
            Satellite and Mobile Communication
          </li>
        </ol>
      </div>

      <!-- Card 3   -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-red-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 12h2.5c1.5 0 1.5-4 3-4s1.5 4 3 4h5c1.5 0 1.5-4 3-4s1.5 4 3 4H22"></path>
            <path d="M2 12h2.5c1.5 0 1.5 4 3 4s1.5-4 3-4h5c1.5 0 1.5 4 3 4s1.5-4 3-4H22"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="signal_pro">
          Signal Processing
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="sigpro_1">
            Signals and Systems
          </li>
          <li class="font-medium text-lg" data-lang-key="sigpro_2">
            Digital Signal Processing (DSP)
          </li>
          <li class="font-medium text-lg" data-lang-key="sigpro_3">
            Image and Audio Processing
          </li>
        </ol>
      </div>

      <!-- card 4 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-orange-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="6" y="6" width="12" height="12" rx="1"></rect>
            <line x1="12" y1="2" x2="12" y2="6"></line>
            <line x1="12" y1="18" x2="12" y2="22"></line>
            <line x1="2" y1="12" x2="6" y2="12"></line>
            <line x1="18" y1="12" x2="22" y2="12"></line>
            <line x1="9" y1="2" x2="9" y2="6"></line>
            <line x1="15" y1="2" x2="15" y2="6"></line>
            <line x1="9" y1="18" x2="9" y2="22"></line>
            <line x1="15" y1="18" x2="15" y2="22"></line>
            <line x1="2" y1="9" x2="6" y2="9"></line>
            <line x1="18" y1="9" x2="22" y2="9"></line>
            <line x1="2" y1="15" x2="6" y2="15"></line>
            <line x1="18" y1="15" x2="22" y2="15"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="micro_emb">
          Microprocessors and Embedded Systems
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="micemb_1">
            Microprocessor and Microcontroller Architecture
          </li>
          <li class="font-medium text-lg" data-lang-key="micemb_2">
            Embedded System Design
          </li>
          <li class="font-medium text-lg" data-lang-key="micemb_3">
            Real-Time Systems
          </li>
        </ol>
      </div>

      <!-- card 5 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-amber-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 20h4l2-4 4 4 2-4h10"></path>
            <path d="M12 16V4l4 4"></path>
            <path d="M16 4h4"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="control_auto">
          Control Systems and Automation
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="conauto_1">
            Control Theory
          </li>
          <li class="font-medium text-lg" data-lang-key="conauto_2">
            Industrial Automation
          </li>
          <li class="font-medium text-lg" data-lang-key="conauto_3">
            Robotics Basics
          </li>
        </ol>
      </div>
      <!-- card 6 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-yellow-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 9v6"></path>
            <path d="M9 12c0-2.5 2-4.5 4-5"></path>
            <path d="M15 12c0 2.5-2 4.5-4 5"></path>
            <path d="M6 12c0-4.5 3-8.5 7-9"></path>
            <path d="M18 12c0 4.5-3 8.5-7 9"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="mag_mcwave">
          Electromagnetics and Microwave Engineering
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="magwave_1">
            Electromagnetic Theory
          </li>
          <li class="font-medium text-lg" data-lang-key="magwave_2">
            Microwave Engineering
          </li>
          <li class="font-medium text-lg" data-lang-key="magwave_3">
            Antennas and Wave Propagation
          </li>
        </ol>
      </div>

      <!-- card 7 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-emerald-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="18" cy="5" r="3"></circle>
            <circle cx="6" cy="12" r="3"></circle>
            <circle cx="18" cy="19" r="3"></circle>
            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="netcom_c">
          Networking and Computer Communication
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="netcom_1">
            Computer Networks
          </li>
          <li class="font-medium text-lg" data-lang-key="netcom_2">
            Network Protocols
          </li>
          <li class="font-medium text-lg" data-lang-key="netcom_3">
            Data Communication
          </li>
        </ol>
      </div>
      <!-- card 8 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-emerald-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 3h16"></path>
            <path d="M4 21h16"></path>
            <path d="M6 3v18"></path>
            <path d="M18 3v18"></path>
            <path d="M8 9h8"></path>
            <path d="M8 13h8"></path>
            <path d="M8 17h8"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="labs_pj">
          Practical Labs and Projects
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="labpj_1">
            Circuit Design and Testing
          </li>
          <li class="font-medium text-lg" data-lang-key="labpj_2">
            Communication System Implementation
          </li>
          <li class="font-medium text-lg" data-lang-key="labpj_3">
            Embedded System Projects
          </li>
        </ol>
      </div>
    </div>
  </div>
  <!-- anoter description panel -->
  <!-- ဒီမှာကတစ်မျိုး -->
  <!-- New section for "What You Can Learn" -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="labs_header">
      Where You Can Learn
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="labs_intro">
      In the Department of Electronics Engineering, Laboratories have been established to allow students to practically apply the theories they have learned and to enhance their technical skills and expertise.
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
          data-description="Circuit ဖွဲ့စည်းခြင်း၊ Analog နဲ့ Digital electronic devices များ စမ်းသပ်လေ့လာနိုင်ရန်။">
          <div class="bg-blue-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Software Development -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="6" width="20" height="12" rx="2"></rect>
              <path d="M2 12h20"></path>
              <path d="M12 6v12"></path>
              <path d="M6 12c0-1.5 1-3 3-3s3 1.5 3 3-1.5 3-3 3-3-1.5-3-3z"></path>
              <path d="M12 12c0-1.5 1-3 3-3s3 1.5 3 3-1.5 3-3 3-3-1.5-3-3z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="elec_lab">
            <!-- ဒီမှာ - ရှေ့ကဟာကိုရေး -->
            Electronics Laboratory
          </h3>
        </div>

        <!-- Skill Card 2: Networking & Security -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Communication Systems Laboratory —Analog, Digital Communication systems များကို စမ်းသပ်၊ Simulation လုပ်၍ နားလည်မှုမြင့်စေရန်။">
          <div class="bg-green-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Networking & Security -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 12c0 4.4 3.6 8 8 8s8-3.6 8-8"></path>
              <path d="M12 12L16 8"></path>
              <path d="M12 20V12"></path>
              <path d="M12 12l-4-4"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="comst_lab">
            Communication Systems Laboratory
          </h3>
        </div>

        <!-- Skill Card 3: Emerging Technology -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Microprocessor နှင့် Microcontroller အခြေခံ programming နှင့် စနစ်ဖန်တီးမှုများ လေ့ကျင့်ရန်။">
          <div class="bg-yellow-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Emerging Technology -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="8" width="20" height="8" rx="1"></rect>
              <rect x="8" y="10" width="8" height="4" rx="1"></rect>
              <path d="M7 8V5a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3"></path>
              <line x1="12" y1="8" x2="12" y2="4"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="micro_lab">
            Microprocessor and Microcontroller Laboratory
          </h3>
        </div>

        <!-- Skill Card 4: Professional & Ethical Practices -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="DSP အစိတ်အပိုင်းများကို လက်တွေ့ထိတွေ့စမ်းသပ်ခြင်း၊ Algorithm များကို လေ့လာရန်။">
          <div class="bg-purple-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Professional & Ethical Practices -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M2 12c2-4 4-4 6 0s4 4 6 0 4-4 6 0"></path>
              <circle cx="5" cy="8" r="1"></circle>
              <circle cx="8" cy="12" r="1"></circle>
              <circle cx="11" cy="16" r="1"></circle>
              <circle cx="14" cy="12" r="1"></circle>
              <circle cx="17" cy="8" r="1"></circle>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="dsp_lab">
            Digital Signal Processing Laboratory
          </h3>
        </div>

        <!-- Skill Card 5: Project & Research Skills -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Computer network devices များ၊ Protocols စမ်းသပ်သုံးစွဲရန်။">
          <div class="bg-red-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Project & Research Skills -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="14" width="20" height="6" rx="1"></rect>
              <path d="M6 17h.01"></path>
              <path d="M10 17h.01"></path>
              <path d="M14 17h.01"></path>
              <path d="M4 6h16"></path>
              <path d="M8 6l-2 5h12l-2-5"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="netw_lab">
            Networking Laboratory
          </h3>
        </div>
      </div>
    </div>

    <!-- it's end here -->

    <!-- what you will learn here tab -->
    <div class="container mx-auto mt-16 p-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="advantagesH">
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
                Electronic Circuit Theory & Design
              </h3>
              <!-- <p class="text-gray-700">Gain practical experience by working on real-world projects and case studies throughout your studies.</p> -->
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_2">
                Analog and Digital Electronics
              </h3>
              <!-- <p class="text-gray-700">Our curriculum is continuously updated to align with the latest industry demands and technologies.</p> -->
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_3">
                Communication Systems & Technologies
              </h3>
              <!-- <p class="text-gray-700">Connect with peers, professors, and industry professionals from around the globe.</p> -->
            </div>
          </div>
          <!-- Slide 4 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_4">
                Microprocessor & Microcontroller Applications
              </h3>
              <!-- <p class="text-gray-700">Receive personalized support for internships, job searches, and career development.</p> -->
            </div>
          </div>
          <!-- Slide 5 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_5">
                Signal Processing Techniques
              </h3>
              <!-- <p class="text-gray-700">Build a solid base in engineering principles that will last throughout your career.</p> -->
            </div>
          </div>
          <!-- Slide 6 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_6">
                Electromagnetic & Microwave Engineering
              </h3>
              <!-- <p class="text-gray-700">Tailor your education to your interests with specialized tracks in various engineering fields.</p> -->
            </div>
          </div>
          <!-- Slide 7 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_7">
                Computer Networks & Protocols
              </h3>
              <!-- <p class="text-gray-700">Participate in leadership programs and team-based projects to hone your soft skills.</p> -->
            </div>
          </div>
          <!-- Slide 8 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_8">
                Hands-on Laboratory Skills
              </h3>
              <!-- <p class="text-gray-700">Work alongside faculty on cutting-edge research projects and contribute to new discoveries.</p> -->
            </div>
          </div>
          <!-- Slide 9 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_9">
                Engineering Problem Solving
              </h3>
              <!-- <p class="text-gray-700">Learn to identify opportunities and develop your own ventures with our dedicated support.</p> -->
            </div>
          </div>
          <!-- Slide 10 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_10">
                Research and Technological Innovation
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
      <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="job_info">
        <!-- ဒီမှာက စာလေးပြင် -->
        Graduates with a B.E. in Electronics can work in electronics manufacturing plants, consumer electronics factories, telecommunications companies, automation and control system firms, power and energy companies, and other related organizations.
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- h3 job-cardတွေမှာ စာတွေပြောင်း cardလည်း လိုတိုးပိုလျှော့  -->
        <!-- Job Card 1 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_1">
            Electronics Engineer
          </h3>
        </div>
        <!-- Job Card 2 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_2">
            Communication Engineer
          </h3>
        </div>
        <!-- Job Card 3 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_3">Network Engineer</h3>
        </div>
        <!-- Job Card 4 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_4">
            Embedded Systems Engineer
          </h3>
        </div>
        <!-- Job Card 5 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_5">
            Control Systems Engineer
          </h3>
        </div>
        <!-- Job Card 6 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_6">
            Field Service Engineer
          </h3>
        </div>
        <!-- Job Card 7 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_7">
            Quality Assurance Engineer
          </h3>
        </div>
        <!-- Job Card 8 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_8">Test Engineer</h3>
        </div>
        <!-- Job Card 9 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_9">
            Technical Support Engineer
          </h3>
        </div>
        <!-- Job Card 10 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_10">R&D Engineer</h3>
        </div>
      </div>
    </div>
  </div>
  <!-- footer region -->

  <footer id="contact" class="bg-blue-900 text-white">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" loading="lazy"/>
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 text-sm mt-4">
            <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
              Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
              Region, Myanmar
            </a>
          </p>
          <div class="mt-4 text-sm text-blue-200">
            <a href="mailto:utyccstudentaffair2010@gmail.com">Email: info@utycc.site utyccstudentaffair2010@gmail.com</a>
                       <br> <a href="tel:+959445767834">Phone: +959445767834 </a>
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
            <li>
              <a data-lang-key="footer_faculty_pre" href="../Majors/pre.php">Precision Engineering</a>
            </li>
            <li>
              <a data-lang-key="footer_faculty_ame" href="../Majors/ame.php">
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
        major_title: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
        major_description:
          "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)  ၏ အီလက်ထရောနစ်အင်ဂျင်နီယာဌာန (Faculty of Electronics Engineering - EcE) သည် အီလက်ထရောနစ်စနစ်များ၊ ကိရိယာများ၊ ဆက်သွယ်ရေးနည်းပညာများနှင့် Signal Processing စသည့်နယ်ပယ်များကို အခြေခံ၍ ဖန်တီး၊ ပေါင်းဆက်၊ စမ်းသပ်နိုင်ရန် လေ့ကျင့်သင်ကြားပေးသည့် အင်ဂျင်နီယာဘာသာရပ်တစ်ခု ဖြစ်ပါသည်။",  
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
        uni_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        motto: '"ခေတ်မီဖွံ့ဖြိုးတိုးတက်သော ဘဝအတွက် တီထွင်ဖန်တီးကြပါစို့။"',
        objectivesH:
          "အီလက်ထရောနစ်အင်ဂျင်နီယာဌာန၏ ရည်ရွယ်ချက်နှင့် တာဝန်များ",
        objectives:
          "အီလက်ထရောနစ်နဲ့ ဆက်သွယ်ရေးနည်းပညာဆိုင်ရာ နည်းပညာများကို အခြေခံပြီး တိုးတက်ကျွမ်းကျင်မှု ရရှိစေရန်။ နေရာတိုင်းတွင် အသုံးပြုနေသော ဆက်သွယ်ရေးစနစ်များ၊ smart system များ တီထွင်ဖန်တီးရာတွင် တက်ကြွစွာ ပါဝင်နိုင်စေရန်။ လုပ်ငန်းခွင်တွင် လိုအပ်သော နည်းပညာဆိုင်ရာ စွမ်းဆောင်ရည်များကို ရရှိပြီး အရည်အချင်းပြည့်စုံသော အင်ဂျင်နီယာများ ဖြစ်လာစေရန်။ နည်းပညာဆိုင်ရာ ပြဿနာများကို ဖြေရှင်းနိုင်စေရန် အတွေးအခေါ် တိုးတက်မှု ဖွံ့ဖြိုးစေရန် ရှာဖွေသုတေသနလုပ်ခြင်း၊ တီထွင်ဖန်တီးခြင်း နဲ့ ပြဿနာတွေကို ကျွမ်းကျင်စွာ ဖြေရှင်းနိုင်စေရန် စသည်တို့ ဖြစ်ပါသည်။ ထို့အပြင် တက်ရောက်လေ့လာမည့် ကျောင်းသား/သူများအား မိမိတို့ အထူးပြုလေ့လာသည့် အီလက်ထရွန်နစ်အင်ဂျင်နီယာကဏ္ဍတွင် စိန်ခေါ်မှုများကို ရင်ဆိုင်နိုင်စေရန် လေ့လာသင်ယူမှုစနစ်ကို တိုးမြှင့်၍ လေ့ကျင့်သင်ကြားပေးမည် ဖြစ်ပါသည်။ အီလက်ထရောနစ်မေဂျာ ဘာသာရပ်သင်တန်းသည် ကျောင်းသား/သူများကို နောက်ဆုံးပေါ်နည်းပညာဖြင့် တီထွင်ဖန်တီးမှုရှိသည့် သုတေသနလှုပ်ရှားမှုများကို ကျွမ်းကျင်စွာ လုပ်ဆောင်နိုင်စေရန် ရည်ရွယ်ထားပြီး အဓိကလေ့လာရမည့် အကြောင်းအရာများမှာ အောက်ပါအတိုင်းဖြစ်ပါသည်။",
        elec_fundas: "လျှပ်စစ်နှင့် အီလက်ထရောနစ် နည်းပညာ အခြေခံများ",
        fundas_1: "လျှပ်စစ်စက်ဝိုင်း (Circuit) သီအိုရီ",
        fundas_2: "ဒေတာဖွဲ့စည်းပုံများနှင့် အယ်လဂိုရီသမ်များ",
        fundas_3: "အန်နာလော့ဂ် (Analog) အီလက်ထရောနစ်",
        fundas_4: "ဒစ်ဂျစ်တယ် အီလက်ထရောနစ်",
        fundas_5:
          "လျှပ်ကူးပစ္စည်း (Semiconductor) နည်းပညာဆိုင်ရာ ပစ္စည်းများ",
        com_systems: "ကွန်ယက်နှင့် ဆက်သွယ်ရေး စနစ် အခြေခံများ",
        system_1: "ဆက်သွယ်ရေး စနစ် (Analog + Digital)",
        system_2: "ကြိုးမဲ့ ဆက်သွယ်ရေးနည်းပညာ",
        system_3: "အော်ပတီကယ် (Optical) နည်းပညာ နှင့် ဆက်သွယ်ရေး",
        system_4: "ဂြိုဟ်တုနှင့် မိုဘိုင်း ဆက်သွယ်ရေး",
        signal_pro: "အချက်အလက်နည်းပညာဖြင့် စနစ်များလုပ်ဆောင်ခြင်း",
        sigpro_1: "အချက်အလက် လမ်းကြောင်းနှင့် စနစ်ဆိုင်ရာ နားလည်မှု",
        sigpro_2: "ဒီဂျစ်တယ်အစိတ်အပိုင်းများ သုံး၍ စစ်ဆေးခြင်း",
        sigpro_3: "ပုံရိပ်နှင့် အသံအချက်အလက်များဖြင့် စနစ်များလုပ်ဆောင်ခြင်း",
        micro_emb: "မိုက်ခရိုစနစ်များ နှင့် ထည့်သွင်းစနစ်များ",
        micemb_1: "မိုက်ခရိုစနစ် နှင့် ကွန်ထရိုလာ ပစ္စည်းဖွဲ့စည်းပုံ",
        micemb_2: "အတွင်းပိုင်းထည့်သွင်းတပ်ဆင်သည့် စနစ် ဖန်တီးမှု",
        micemb_3: "အချိန်နှင့်အမျှ လုပ်ဆောင်နိုင်သော စနစ်များ",
        control_auto: "ထိန်းချုပ်မှုနည်းပညာနှင့် စက်မှုအလိုအလျောက်စနစ်များ",
        conauto_1: "အလိုအလျောက်စနစ် ထိန်းချုပ်မှု အယူအဆ",
        conauto_2: "စက်မှုလုပ်ငန်း အလိုအလျောက်စနစ်",
        conauto_3: "Robot နည်းပညာ အခြေခံများ",
        mag_mcwave: "လျှပ်စစ်သံလိုက်နှင့် မိုက်ခရိုဝေ့ အင်ဂျင်နီယာနည်းပညာ",
        magwave_1: "လျှပ်စစ်သံလိုက်အကျိုးသက်ရောက်မှု အယူအဆ",
        magwave_2: "မိုက်ခရိုဝေ့စနစ်ဖန်တီးမှု အင်ဂျင်နီယာနည်းပညာ",
        magwave_3: "အင်တင်နာစနစ် နှင့် လှိုင်းပျံ့နှံ့မှုနည်းပညာ",
        netcom_c: "ကွန်ယက်ဖွဲ့စည်းမှု နှင့် ကွန်ပျူတာဆက်သွယ်ရေး နည်းပညာ",
        netcom_1: "ကွန်ပျူတာကွန်ယက်များ",
        netcom_2: "ကွန်ယက်ဆက်သွယ်ရေး စည်းမျဉ်းစနစ်များ",
        netcom_3: "ဒေတာအချက်အလက်များ ဆက်သွယ်ရေး",
        labs_pj: "လက်တွေ့ စမ်းသပ်ခန်းများနှင့် စီမံချက်များ",
        labpj_1: "လျှပ်စစ်စက်ဝိုင်း (Circuit) ဒီဇိုင်းနှင့် စမ်းသပ်မှု",
        labpj_2: "ဆက်သွယ်ရေး စနစ်ကို လက်တွေ့ အကောင်အထည်ဖော်ခြင်း",
        labpj_3: "ထည့်သွင်းတပ်ဆင်ထားသည့်စနစ် ပါဝင်သော ပရောဂျက်များ",
        labs_header: "သင်ယူလေ့လာနိုင်မည့် နေရာများ",
        labs_intro:
          "အီလက်ထရောနစ်အင်ဂျင်နီယာဌာနတွင် သင်ယူထားသော သီအိုရီများကို လက်တွေ့ကျကျ ပြုလုပ်လေ့လာနိုင်ပြီး အတတ်ပညာပိုင်းတွင် ကျွမ်းကျင်မှုများ တိုးတက်စေရန်   စမ်းသပ်ခန်းများ (Laboratories) တည်ဆောက်ထားပါသည်။",
        tap: "ကျွမ်းကျင်မှုတစ်ခု၏ အသေးစိတ်ဖော်ပြချက်များကို ကြည့်ရန် နှိပ်ပါ။",
        elec_lab: "အီလက်ထရောနစ်နည်းပညာ စမ်းသပ်ခန်း",
        comst_lab: "ဆက်သွယ်ရေး စနစ် စမ်းသပ်ခန်း",
        micro_lab: "မိုက်ခရိုပရိုဆက်ဆာနှင့် မိုက်ခရိုကွန်ထရိုလာ စမ်းသပ်ခန်း",
        dsp_lab: "အချက်အလက် ဒီဂျစ်တယ် လုပ်ဆောင်မှု နည်းပညာ စမ်းသပ်ခန်း",
        netw_lab: "ကွန်ယက်ဖွဲ့စည်းမှုနည်းပညာ စမ်းသပ်ခန်း",
        advantagesH:
          "ဘွဲ့ကြိုသင်တန်းပြီးနောက် သင်ယူရရှိမည့် အကျိုးကျေးဇူးများ",
        advan_intro:
          "ကျွန်ုပ်တို့၏ အင်ဂျင်နီယာဘွဲ့ သင်ရိုးညွှန်းတမ်းကို လက်တွေ့အသက်မွေးဝမ်းကျောင်းလောကတွင် အသုံးချနိုင်စေရန် အဓိကအားသာချက်များဖြင့် ပြုစုထားပါသည်။",
        advan_1: "အီလက်ထရောနစ်စက်ဝိုင်း (Circuit) သဘောတရားနှင့် ဒီဇိုင်း",
        advan_2: "အန်နာလော့ဂ် နှင့် ဒီဂျစ်တယ် အီလက်ထရောနစ် နည်းပညာ",
        advan_3: "ဆက်သွယ်ရေးစနစ်များ နှင့် နည်းပညာများ",
        advan_4:
          "မိုင်ခရိုပရိုဆက်ဆာ နှင့် မိုင်ခရိုကွန်ထရိုလာ အသုံးချမှုများ",
        advan_5: "စစ်ဂနယ်အလုပ်လုပ်ခြင်း နည်းပညာများ",
        advan_6: "အီလက်ထရိုမက်ဂနက်တစ် နှင့် မိုင်ခရိုဝေဗ် အင်ဂျင်နီယာ",
        advan_7: "ကွန်ပျူတာကွန်ယက်များ နှင့် စည်းမျဉ်းစည်းကမ်းများ",
        advan_8: "လက်တွေ့လေ့ကျင့်ခန်းမှ ကျွမ်းကျင်မှုများ",
        advan_9: "အင်ဂျင်နီယာ ပြဿနာ ဖြေရှင်းနည်း",
        advan_10: "သုတေသနနှင့် နည်းပညာ အသစ်တီထွင်မှု",
        job_heading: "အလုပ်အကိုင် လမ်းကြောင်းများနှင့် အခွင့်အလမ်းများ",
        job_info:
          "အီလက်ထရောနစ်အင်ဂျင်နီယာဘွဲ့ (B.E. Electronics Engineering) ရရှိသူများသည် အီလက်ထရောနစ် ထုတ်လုပ်ရေးစက်ရုံများ၊ လူသုံးအီလက်ထရောနစ်ကုန်ပစ္စည်းစက်ရုံများ၊ ဆက်သွယ်ရေးကုမ္ပဏီများ၊ အလိုအလျောက်ထိန်းချုပ်မှုစနစ်ဆိုင်ရာ ကုမ္ပဏီများနှင့် လျှပ်စစ်စွမ်းအားနှင့် ဓာတ်အား ကုမ္ပဏီများ စသည်တို့တွင် အလုပ်လုပ်ကိုင်နိုင်ပါသည်။",
        job_1: "အီလက်ထရောနစ်အင်ဂျင်နီယာ",
        job_2: "ဆက်သွယ်ရေးအင်ဂျင်နီယာ",
        job_3: "ကွန်ယက်အင်ဂျင်နီယာ",
        job_4: "ထည့်သွင်းထားသော (Embedded) စနစ် အင်ဂျင်နီယာ",
        job_5: "ထိန်းချုပ်ရေးစနစ်အင်ဂျင်နီယာ",
        job_6: "လုပ်ငန်းဌာနဆောင်ရွက်မှုအင်ဂျင်နီယာ",
        job_7: "အရည်အသွေးထိန်းချုပ်မှုအင်ဂျင်နီယာ",
        job_8: "စမ်းသပ်မှုအင်ဂျင်နီယာ (Tester)",
        job_9: "နည်းပညာအထောက်အပံ့အင်ဂျင်နီယာ",
        job_10: "သုတေသန နှင့် ဖွံ့ဖြိုးတိုးတက်ရေးအင်ဂျင်နီယာ",
        footer_link_dp: "ဒေတာကာကွယ်ရေး", 
      },
      en: {
        major_title: "Electronics Engineering",
        major_description:
          "The Faculty of Electronics Engineering (EcE) at the University of Technology (Yatanarpon Cyber City) is an engineering discipline that focuses on the study, design, integration, and testing of electronic systems, devices, communication technologies, and signal processing.",
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
        uni_name: "University of Technology (Yadanarpon Cyber City)",
        motto: '"Let’s innovate for SMART Living!"',
        objectivesH: "The objectives and responsibilities",
        objectives:
          "The program is designed to provide students with foundational knowledge and advanced expertise in electronics and communication technologies. It aims to enable them to actively participate in designing and developing widely used communication systems and smart systems in various contexts. The curriculum ensures that students acquire the technical skills required in the professional workplace, becoming fully qualified and competent engineers. It also emphasizes the development of critical thinking and problem-solving abilities through research, innovation, and practical application of technology-related challenges. Moreover, students will be trained to face challenges in their specialized field of electronics engineering through enhanced learning and practical training systems. The Electronics and Communication Engineering (EcE) program is intended to equip students to carry out research activities with innovation using the latest technologies, with the key topics of study outlined as follows.",
        elec_fundas: "Fundamentals of Electronics",
        fundas_1: "Circuit Theory",
        fundas_2: "Data Structures & Algorithms",
        fundas_3: "Analog Electronics",
        fundas_4: "Digital Electronics",
        fundas_5: "Semiconductor Devices",
        com_systems: "Communication Systems",
        system_1: "Analog and Digital Communication",
        system_2: "Wireless Communication",
        system_3: "Optical Communication",
        system_4: "Satellite and Mobile Communication",
        signal_pro: "Signal Processing",
        sigpro_1: "Signals and Systems",
        sigpro_2: "Digital Signal Processing (DSP)",
        sigpro_3: "Image and Audio Processing",
        micro_emb: "Microprocessors and Embedded Systems",
        micemb_1: "Microprocessor and MicrocontrollerArchitecture",
        micemb_2: "Embedded System Design",
        micemb_3: "Real-Time Systems",
        control_auto: "Control Systems and Automation",
        conauto_1: "Control Theory",
        conauto_2: "Industrial Automation",
        conauto_3: "Robotics Basics",
        mag_mcwave: "Electromagnetics and Microwave Engineering",
        magwave_1: "Electromagnetic Theory",
        magwave_2: "Microwave Engineering",
        magwave_3: "Antennas and Wave Propagation",
        netcom_c: "Networking and Computer Communication",
        netcom_1: "Computer Networks",
        netcom_2: "Network Protocols",
        netcom_3: "Data Communication",
        labs_pj: "Practical Labs and Projects",
        labpj_1: "Circuit Design and Testing",
        labpj_2: "Communication System Implementation",
        labpj_3: "Embedded System Projects",
        labs_header: "Where You Can Learn",
        labs_intro:
          "In the Department of Electronics Engineering, Laboratories have been established to allow students to practically apply the theories they have learned and to enhance their technical skills and expertise.",
        tap: "Hover over or tap a skill to see a brief description",
        elec_lab: "Electronics Laboratory",
        comst_lab: "Communication Systems Laboratory ",
        micro_lab: "Microprocessor and Microcontroller Laboratory",
        dsp_lab: "Digital Signal Processing Laboratory",
        netw_lab: "Networking Laboratory",
        advantagesH: "What You Will Learn After B.E. Course",
        advan_intro:
          "Our Bachelor of Engineering curriculum is designed to prepare you for the real world with these key advantages.",
        advan_1: "Electronic Circuit Theory & Design",
        advan_2: "Analog and Digital Electronics",
        advan_3: "Communication Systems & Technologies",
        advan_4: "Microprocessor & Microcontroller Applications",
        advan_5: "Signal Processing Techniques",
        advan_6: "Electromagnetic & Microwave Engineering",
        advan_7: "Computer Networks & Protocols",
        advan_8: "Hands-on Laboratory Skills",
        advan_9: "Engineering Problem Solving",
        advan_10: "Research and Technological Innovation",
        job_heading: "Career Paths & Job Opportunities",
        job_info:
          "Graduates with a B.E. in Electronics can work in electronics manufacturing plants, consumer electronics factories, telecommunications companies, automation and control system firms, power and energy companies, and other related organizations.",
        job_1: "Electronics Engineer",
        job_2: "Communication Engineer",
        job_3: "Network Engineer",
        job_4: "Embedded Systems Engineer",
        job_5: "Control Systems Engineer",
        job_6: "Field Service Engineer",
        job_7: "Quality Assurance Engineer",
        job_8: "Test Engineer",
        job_9: "Technical Support Engineer",
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
  <script src="../JS/lgl.js"></script>
</body>

</html>
