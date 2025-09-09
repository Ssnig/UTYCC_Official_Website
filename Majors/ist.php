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
  <title>Information Science & Technology - UTYCC</title>
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
        <img id="IST" class="h-48 w-full object-cover md:h-full md:w-48" src="../Img/logo/IST.webp" alt="Major Image" />
      </div>
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold" data-lang-key="uni_name">
          University of Technology (Yatanarpon Cyber City)
        </div>
        <a id="major-title" href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"
          data-lang-key="major_Title">Information Science and Technology</a>
        <p id="major-description" class="mt-2 text-slate-500" data-lang-key="major_Description">
          The Department of Information Science and Technology (IST) at the University of Technology (Yatanarpon Cyber
          City) is an engineering discipline that combines the study of information systems, computer technology, and
          communication technologies.
        </p>
      </div>
    </div>
  </div>
  <!-- headline -->
  <!-- Hero Section to start the page with a strong visual -->
  <header class="mb-12 rounded-3xl overflow-hidden shadow-2xl py-4">
    <div class="relative h-96">
      <!-- ဒီအောက်ကဟာ ကြိုက်တဲ့ပုံထည့်လို့ရတယ် ဥပမာ majorနဲ့ဆိုင်တဲ့ buildingတွေ ပုံတွေက "./Img/utycc_buildings/"ထဲက ဟာတွေယူသုံး srcမှာနော် -->
      <img src="../Img/utycc_buildings/Lab1.JPG" alt="Hero image of a bustling university campus"
        class="absolute inset-0 w-full h-full object-cover brightness-75" />
      <div class="relative z-10 flex items-center justify-center h-full bg-black bg-opacity-40">
        <div class="text-center text-white p-4">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4"
            style="font-family: 'Times New Roman', Times, serif">
            Our Motto
          </h1>
          <!-- mottoက မေဂျာ တစ်ခုချင်းစီရဲ့ ဆောင်ပုဒ် အမ မယမင်း ရဲ့ doc fileတွေမှာသေချာထည့်ပေးထားတယ် အဲ့တာကိုထည့်ပေး -->
          <p class="text-lg sm:text-xl font-light max-w-2xl mx-auto italic" data-lang-key="motto">
            "To build a better society through ICT"
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
      To deliver high-quality theoretical and practical training so that students can become innovative creators in emerging information technologies and user communities. To support the effective use of new technologies in order to genuinely solve the problems and challenges facing the world. To widely create learning environments and opportunities that utilize ICT. To enable students to become future leaders in information technology by equipping them with the necessary knowledge, competencies, practical skills, and emerging information technologies. Additionally, to train students to become proficient in their specialized subjects and to engage in innovative scientific research. The IST course aims to provide students with fundamental knowledge in technology, progressing to advanced research and practical expertise. The main topics to be studied are as follows
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
            <circle cx="12" cy="6" r="2"></circle>

            <circle cx="12" cy="18" r="2"></circle>

            <circle cx="6" cy="12" r="2"></circle>

            <circle cx="18" cy="12" r="2"></circle>

            <path d="M12 8v8"></path>
            <path d="M8 12h8"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="basic_tech">Basic IT Technologies</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="tech_1">
            Programming Languages (C, C++, Java, Python,...)
          </li>
          <li class="font-medium text-lg" data-lang-key="tech_2">
            Data Structures & Algorithms
          </li>
          <li class="font-medium text-lg" data-lang-key="tech_3">
            Computer Organization & Architecture
          </li>
          <li class="font-medium text-lg" data-lang-key="tech_4">
            Operating Systems
          </li>
        </ol>
      </div>

      <!-- Card 2 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-green-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 7v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7a3 3 0 00-3 3z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4m0 4v4m0 4v4" />
            <ellipse cx="12" cy="7" rx="8" ry="3" />
            <ellipse cx="12" cy="17" rx="8" ry="3" />
            <path d="M4 7c0-1.657 3.582-3 8-3s8 1.343 8 3" />
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="data_db">Data and Database</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="data_1">
            Database Management Systems (DBMS)
          </li>
          <li class="font-medium text-lg" data-lang-key="data_2">Data Modeling & SQLs</li>
          <li class="font-medium text-lg" data-lang-key="data_3">Big Data Concepts</li>
          <li class="font-medium text-lg" data-lang-key="data_4">Data Analytics & Visualization</li>
        </ol>
      </div>

      <!-- Card 3   -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-red-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>

            <circle cx="12" cy="12" r="1.5"></circle>
            <circle cx="9" cy="9" r="1.5"></circle>
            <circle cx="15" cy="9" r="1.5"></circle>

            <path d="M12 13.5v-1.5"></path>
            <path d="M10.2 9.8l1.6 1.4"></path>
            <path d="M13.8 9.8l-1.6 1.4"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="network_sec">Networking & Security</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="netsec_1">Computer Networks</li>
          <li class="font-medium text-lg" data-lang-key="netsec_2">Internet Protocols</li>
          <li class="font-medium text-lg" data-lang-key="netsec_3">Cybersecurity Fundamentals</li>
          <li class="font-medium text-lg" data-lang-key="netsec_4">Network Administration</li>
        </ol>
      </div>

      <!-- card 4 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-orange-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M7 8l-4 4 4 4"></path>

            <path d="M17 8l4 4-4 4"></path>

            <path d="M14 4l-4 16"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="software_dev">Software Development</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="softdev_1">
            Software Engineering & Methodologies
          </li>
          <li class="font-medium text-lg" data-lang-key="softdev_2">
            Web Development(Frontend & Backend)
          </li>
          <li class="font-medium text-lg" data-lang-key="softdev_3">Mobile Application Development</li>
          <li class="font-medium text-lg" data-lang-key="softdev_4">Software Testing & Development</li>
        </ol>
      </div>

      <!-- card 5 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-amber-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="2"></circle>

            <circle cx="12" cy="3" r="1"></circle>

            <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(45 12 12)"></ellipse>
            <ellipse cx="12" cy="12" rx="10" ry="4" transform="rotate(-45 12 12)"></ellipse>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="emerge_tech">Emerging Technologies</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="emtech_1">
            Artificial Intelligence (AI) & Machine Learning (ML)
          </li>
          <li class="font-medium text-lg" data-lang-key="emtech_2">Cloud Computing</li>
          <li class="font-medium text-lg" data-lang-key="emtech_3">Internet of Things (IoT)</li>
          <li class="font-medium text-lg" data-lang-key="emtech_4">Software Testing & Development</li>
        </ol>
      </div>

      <!-- card 6 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-yellow-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>

            <path d="M9 12l2 2 4-4"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="pro_ethic">
          Professional & Ethical Practices
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="ethic_1">ICT Laws & Ethics</li>
          <li class="font-medium text-lg" data-lang-key="ethic_2">Intellectual Property Rights</li>
          <li class="font-medium text-lg" data-lang-key="ethic_3">Sustainable Technology Use</li>
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
        <h3 class="text-xl font-bold mb-2" data-lang-key="pj_skills">Project & Research Skills</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="skill_1">ICT Project Management</li>
          <li class="font-medium text-lg" data-lang-key="skill_2">Research Methodology</li>
          <li class="font-medium text-lg" data-lang-key="skill_3">
            Final Year Project (Capstone Project)
          </li>
          <li class="font-medium text-lg" data-lang-key="skill_4">Teamwork & Communication Skills</li>
        </ol>
      </div>
    </div>
  </div>

  <!-- anoter description panel -->
  <!-- ဒီမှာကတစ်မျိုး -->
  <!-- New section for "What You Can Learn" -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="lab_heading">
      Where You Can Learn
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="lab_intro">
      In the Information Science and Technology major, laboratories have been established to help students master technologies through both theoretical and practical learning
    </p>

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
          data-description="Programming သင်ခန်းစာများ၊ Software Engineering Project များ၊ Algorithm လေ့ကျင့်ရန်။">
          <div class="bg-blue-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Software Development -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M7 8l-4 4 4 4"></path>

              <path d="M17 8l4 4-4 4"></path>

              <path d="M14 4l-4 16"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="prog_lab">
            <!-- ဒီမှာ - ရှေ့ကဟာကိုရေး -->
            Programming & Software Development Lab
          </h3>
        </div>

        <!-- Skill Card 2: Networking & Security -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Database Design, SQL လေ့ကျင့်ခန်းများ၊ Data Analytics နှင့် Big Data စမ်းသပ်ရန်။">
          <div class="bg-green-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Networking & Security -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 7v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7a3 3 0 00-3 3z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v4m0 4v4m0 4v4" />
              <ellipse cx="12" cy="7" rx="8" ry="3" />
              <ellipse cx="12" cy="17" rx="8" ry="3" />
              <path d="M4 7c0-1.657 3.582-3 8-3s8 1.343 8 3" />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="data_lab">
            Database & Data Analytics Lab
          </h3>
        </div>

        <!-- Skill Card 3: Emerging Technology -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Network Configuration, Simulation နှင့် Cybersecurity လေ့ကျင့်ရန်။">
          <div class="bg-yellow-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Emerging Technology -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>

              <circle cx="12" cy="12" r="1.5"></circle>
              <circle cx="9" cy="9" r="1.5"></circle>
              <circle cx="15" cy="9" r="1.5"></circle>

              <path d="M12 13.5v-1.5"></path>
              <path d="M10.2 9.8l1.6 1.4"></path>
              <path d="M13.8 9.8l-1.6 1.4"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="netsec_lab">
            Networking & Security Lab
          </h3>
        </div>

        <!-- Skill Card 4: Professional & Ethical Practices -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Web Application နှင့် Mobile App တည်ဆောက်ရန်၊ စမ်းသပ်ရန်။
">
          <div class="bg-purple-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Professional & Ethical Practices -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="7" y="2" width="10" height="20" rx="2" ry="2"></rect>
              <line x1="11" y1="5" x2="13" y2="5"></line>

              <circle cx="12" cy="13" r="4"></circle>
              <line x1="8" y1="13" x2="16" y2="13"></line>
              <path d="M12 9a6.7 6.7 0 0 0-4 1.22m8 5.56A6.7 6.7 0 0 0 12 17"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="webdev_lab">
            Web & Mobile Development Lab
          </h3>
        </div>

        <!-- Skill Card 5: Project & Research Skills -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Artificial Intelligence, Machine Learning Model Training နှင့် Data-driven Project များ ပြုလုပ်ရန်။">
          <div class="bg-red-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Project & Research Skills -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19.5 15.5c-1.5 2.5-4 4.5-7.5 4.5s-6-2-7.5-4.5c-1.5-2.5-1.5-5.5 0-8C6 5 8.5 3 12 3s6 2 7.5 4.5">
              </path>

              <circle cx="12" cy="12" r="2"></circle>
              <path d="M12 8v1M12 15v1M14.5 9.5l.7-.7M8.8 15.2l-.7.7M16 12h-1M9 12H8m6.5 2.5l-.7-.7M9.2 8.8l.7.7">
              </path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="ai_lab">
            AI & Machine Learning Lab
          </h3>
        </div>

        <!-- Skill Card 6: Critical Thinking -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Cloud-based Application Deployment နှင့် Internet of Things (IoT) Device တွေ အပြန်အလှန်ချိတ်ဆက်သုံးစွဲရန်။">
          <div class="bg-indigo-500 text-white rounded-full p-4 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 7.5A4.5 4.5 0 0 0 12 2a4.5 4.5 0 0 0-6 3A3.5 3.5 0 0 0 6 12h12a3 3 0 0 0 0-6h-1"></path>

              <rect x="7" y="13" width="10" height="4" rx="1"></rect>

              <circle cx="8" cy="21" r="1"></circle>
              <circle cx="12" cy="21" r="1"></circle>
              <circle cx="16" cy="21" r="1"></circle>

              <line x1="12" y1="13" x2="12" y2="9"></line>
              <line x1="12" y1="17" x2="12" y2="20"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="cloudIoT_lab">
            Cloud Computing & IoT Lab
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
                Fundamental and Advanced ICT Skills
              </h3>
              <!-- <p class="text-gray-700">Gain practical experience by working on real-world projects and case studies throughout your studies.</p> -->
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_2">Data-related Technologies</h3>
              <!-- <p class="text-gray-700">Our curriculum is continuously updated to align with the latest industry demands and technologies.</p> -->
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_3">Emerging Technologies</h3>
              <!-- <p class="text-gray-700">Connect with peers, professors, and industry professionals from around the globe.</p> -->
            </div>
          </div>
          <!-- Slide 4 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_4">Cybersecurity Awareness</h3>
              <!-- <p class="text-gray-700">Receive personalized support for internships, job searches, and career development.</p> -->
            </div>
          </div>
          <!-- Slide 5 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_5">
                Project Management & Teamwork
              </h3>
              <!-- <p class="text-gray-700">Build a solid base in engineering principles that will last throughout your career.</p> -->
            </div>
          </div>
          <!-- Slide 6 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_6">Problem-Solving with ICT</h3>
              <!-- <p class="text-gray-700">Tailor your education to your interests with specialized tracks in various engineering fields.</p> -->
            </div>
          </div>
          <!-- Slide 7 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_7">
                Logical & Analytical Thinking
              </h3>
              <!-- <p class="text-gray-700">Participate in leadership programs and team-based projects to hone your soft skills.</p> -->
            </div>
          </div>
          <!-- Slide 8 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_8">Problem-Solving Skills</h3>
              <!-- <p class="text-gray-700">Work alongside faculty on cutting-edge research projects and contribute to new discoveries.</p> -->
            </div>
          </div>
          <!-- Slide 9 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_9">Coding & System Design</h3>
              <!-- <p class="text-gray-700">Learn to identify opportunities and develop your own ventures with our dedicated support.</p> -->
            </div>
          </div>
          <!-- Slide 10 -->
          <div class="slide bg-white rounded-xl">
            <div class="slide-content">
              <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_10">
                Research & Innovation Skills
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
        Graduates with a B.E. in Information Science and Technology can work in IT companies, banking and financial institutions, telecom, software houses, e-commerce companies, startups, government digital projects, and so on, as the following job positions
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- h3 job-cardတွေမှာ စာတွေပြောင်း cardလည်း လိုတိုးပိုလျှော့  -->
        <!-- Job Card 1 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_1">Software Developer / Engineer</h3>
        </div>
        <!-- Job Card 2 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_2">Data Analyst / Data Scientist</h3>
        </div>
        <!-- Job Card 3 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_3">Database Administrator</h3>
        </div>
        <!-- Job Card 4 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_4">Network Administrator</h3>
        </div>
        <!-- Job Card 5 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_5">Cybersecurity Specialist</h3>
        </div>
        <!-- Job Card 6 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_6">Web & Mobile Application Developer</h3>
        </div>
        <!-- Job Card 7 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_7">Cloud Solutions Architect</h3>
        </div>
        <!-- Job Card 8 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_8">IT Project Manager</h3>
        </div>
        <!-- Job Card 9 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_9">AI/Machine Learning Engineer</h3>
        </div>
        <!-- Job Card 10 -->
        <div class="job-card">
          <h3 class="job-title" data-lang-key="job_10">Business Intelligence Analyst</h3>
        </div>
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
              <a href="../data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data
                Protection</a>
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
        majorTitle.textContent = translations[currentLang][titleKey] || titleKey;
      }
      if (majorDescription) {
        majorDescription.textContent = translations[currentLang][descriptionKey] || descriptionKey;
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
        major_Title: "သတင်းအချက်အလက်သိပ္ပံ နှင့် နည်းပညာ",
        major_Description: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ၏ သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာဌာန (Department of Information Science and Technology - IST) သည် သတင်းအချက်အလက်စနစ်၊ ကွန်ပျူတာနည်းပညာနှင့် ဆက်သွယ်ရေးနည်းပညာများကို ပေါင်းစပ်လေ့လာသည့် အင်ဂျင်နီယာဘာသာရပ်ဖြစ်ပါသည်။",
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
        major_name: "သတင်းအချက်အလက်သိပ္ပံ နှင့် နည်းပညာ",
        objectives_heading: "သတင်းအချက်အလက်သိပ္ပံ နှင့် နည်းပညာဌာန၏ ရည်ရွယ်ချက်နှင့် တာဝန်များ",
        objectives: "ပေါ်ထွန်းလာသည့် အချက်အလက်နည်းပညာများနှင့် အသုံးပြုသူအသိုင်းအဝိုင်းဆိုင်ရာ ဆန်းသစ်တီထွင်နိုင်သော ကျောင်းသားများဖြစ်စေရန် သီအိုရီနှင့် လက်တွေ့ အရည်အသွေးအမြင့်ဆုံး ဖြင့် သင်တန်းပေးသင်ကြားရန်။ နည်းပညာအသစ်များကို ထိရောက်စွာ, အသုံးပြုခြင်းအားဖြင့် ကမ္ဘာပေါ်ရှိ အခက်အခဲပြဿနာများကို အမှန်တကယ်, ဖြေရှင်းနိုင်ရန် ပံ့ပိုးပေးရန်။ ICT ကို အသုံးချသည့် သင်ယူပတ်ဝန်းကျင် အခွင့်အလမ်းများကို ကျယ်ကျယ်ပြန့်ပြန့် ဖန်တီးပေးရန်။ နည်းပညာလောကတွင် လိုအပ်သော ပညာဉာဏ်နှင့်အတူ စွမ်းရည်ပြည့်ဝမှုများ၊ လက်တွေ့ကျွမ်းကျင်မှုများနှင့် ပေါ်ထွန်းလာသော အချက်အလက်နည်းပညာများ၏ အနာဂတ်ခေါင်းဆောင်များ ဖြစ်လာစေရန်။ စသည်တို့ ဖြစ်ပါသည်။ ထို့အပြင် တက်ရောက်လေ့လာမည့် ကျောင်းသား/သူများအား မိမိတို့ အထူးပြုသည့် ဘာသာရပ်များတွင် ကျွမ်းကျင်စေရန် နှင့် တီထွင်ဆန်းသစ်သော သိပ္ပံသုတေသနများ ဆောင်ရွက်ခြင်းတို့ကို လုပ်ဆောင်နိုင်ရန် လေ့ကျင့်သင်ကြားပေးမည် ဖြစ်ပါသည်။ IST ဘာသာရပ်သင်တန်းသည် ကျောင်းသား/သူများကို နည်းပညာပိုင်းတွင် အခြေခံပညာမှစ၍ သုတေသနနှင့် လက်တွေ့ကျကျ အဆင့်မြင့်ပညာရရှိစေရန် ရည်ရွယ်ထားပြီး အဓိကလေ့လာရမည့် အကြောင်းအရာများမှာ အောက်ပါအတိုင်းဖြစ်ပါသည်။",
        motto: '"ICT ဖြင့် ပိုမိုကောင်းမွန်သော ဘဝတစ်ခု တည်ဆောက်ရန်။"',
        basic_tech: "အခြေခံ IT နည်းပညာများ",
        tech_1: "ပရိုဂရမ်မင်းဘာသာရပ်များ (C, C++, Java, Python, …)",
        tech_2: "ဒေတာဖွဲ့စည်းမှုများနှင့် အယ်လဂေါရစ်သမ်များ",
        tech_3: "ကွန်ပျူတာအဖွဲ့အစည်းနှင့် ဖွဲ့စည်းပုံ",
        tech_4: "စက်ပစ္စည်း စီမံခန့်ခွဲမှု စနစ်",
        data_db: "ဒေတာနှင့် ဒေတာဘေ့စ် စနစ်",
        data_1: "ဒေတာဘေ့စ် စီမံခန့်ခွဲမှု စနစ်",
        data_2: "ဒေတာမော်ဒယ်ရေးဆွဲခြင်း နှင့် SQL ကုဒ်များ",
        data_3: "အကြီးစား ဒေတာ ယူဆချက်များ",
        data_4: "ဒေတာခွဲခြမ်းစိတ်ဖြာခြင်းနှင့် အမြင်ဖော်ပြခြင်း",
        network_sec: "အင်တာနက်ကွန်ယက်ချိတ်ဆက်မှု နှင့် လုံခြုံရေး",
        netsec_1: "ကွန်ပျူတာကွန်ယက်များ",
        netsec_2: "အင်တာနက်ဆက်သွယ်ရေး စံနှုန်းစည်းမျဉ်းများ",
        netsec_3: "ဆိုင်ဘာလုံခြုံရေး အခြေခံအသိပညာများ",
        netsec_4: "ကွန်ယက် စီမံအုပ်ချုပ်ရေးနည်းပညာ",
        software_dev: "ဆော့ဖ်ဝဲ ဖန်တီးထုတ်လုပ်ခြင်း",
        softdev_1: "ဆော့ဖ်ဝဲအင်ဂျင်နီယာ နှင့် နည်းဗျူဟာများ",
        softdev_2: "ဝဘ်ဆိုက် ဖန်တီးတိုးတက်မှု (Frontend & Backend) နည်းပညာ",
        softdev_3: "မိုဘိုင်း အက်ပလီကေးရှင်း ဖန်တီးထုတ်လုပ်မှု",
        softdev_4: "ဆော့ဖ်ဝဲ စမ်းသပ်မှုနှင့် ဖန်တီးတိုးတက်မှု",
        emerge_tech: "ပေါ်ထွက်လာသော နည်းပညာအသစ်များ",
        emtech_1: "AI နည်းပညာ နှင့် အချက်အလက်မှ သင်ယူတတ်စေသည့် စက်နည်းပညာ",
        emtech_2: "Cloud တွက်ချက်ခြင်း နည်းပညာ",
        emtech_3: "အရာဝတ္ထုများ အင်တာနက်ချိတ်ဆက်မှု (IoT)",
        emtech_4: "ဆော့ဖ်ဝဲ စမ်းသပ်မှုနည်းပညာ နှင့် ဖန်တီးတိုးတက်မှု",
        pro_ethic: "အသက်မွေးဝမ်းကျောင်း နှင့် ကျင့်ဝတ်ဆိုင်ရာ ကျင့်ဝတ်များ",
        ethic_1: "ICT ဥပဒေများ နှင့် ကျင့်ဝတ်စည်းကမ်းများ",
        ethic_2: "ဉာဏ်ပညာပိုင်ဆိုင်ခွင့် မူပိုင်ခွင့်များ",
        ethic_3: "ရေရှည်နည်းပညာအသုံးပြုမှု",
        pj_skills: "စီမံချက်နှင့် သုတေသန ကျွမ်းကျင်မှုများ",
        skill_1: "ICT စီမံချက် စီမံခန့်ခွဲမှု",
        skill_2: "သုတေသန နည်းဗျူဟာများ နှင့် နည်းလမ်းများ",
        skill_3: "နောက်ဆုံးနှစ်ပရောဂျက် (ဘွဲ့ကြိုသုတေသနစာတမ်း)",
        skill_4: "အဖွဲ့လိုက်ပူးပေါင်းလုပ်ဆောင်မှု နှင့် ဆက်သွယ်ပြောဆိုနိုင်မှုစွမ်းရည်",
        lab_heading: "သင်ယူလေ့လာနိုင်မည့် နေရာများ",
        lab_intro: "သတင်းအချက်အလက်သိပ္ပံ နှင့် နည်းပညာမေဂျာတွင် သီအိုရီနဲ့ လက်တွေ့ကျကျ လေ့လာမှုများမှတစ်ဆင့် နည်းပညာများကို ကျွမ်းကျင်စေရန် စမ်းသပ်ခန်းများ (Laboratories) တည်ဆောက်ထားပါသည်။",
        tap: "ကျွမ်းကျင်မှုတစ်ခု၏ အသေးစိတ်ဖော်ပြချက်များကို ကြည့်ရန် နှိပ်ပါ။",
        prog_lab: "ပရိုဂရမ်ရေးဆွဲခြင်း နှင့် ဆော့ဖ်ဝဲ ဖန်တီးတိုးတက်မှု စမ်းသပ်ခန်း",
        data_lab: "ဒေတာဘေ့စ် စီမံခန့်ခွဲမှု နှင့် ဒေတာခွဲခြမ်းစိတ်ဖြာခြင်း စမ်းသပ်ခန်း",
        netsec_lab: "ကွန်ယက် စီမံခန့်ခွဲမှု နှင့် လုံခြုံရေး စမ်းသပ်ခန်း",
        webdev_lab: "ဝဘ်ဆိုက် ဖန်တီးတိုးတက်မှုနှင့် မိုဘိုင်း အက်ပလီကေးရှင်း ဖန်တီးခြင်း စမ်းသပ်ခန်း",
        ai_lab: "AI နှင့် စက်နည်းပညာ စမ်းသပ်ခန်း",
        cloudIoT_lab: "Cloud တွက်ချက်ခြင်း နှင့် အရာဝတ္ထုအင်တာနက် (IoT) စမ်းသပ်ခန်း",
        advantagesH: "ဘွဲ့ကြိုသင်တန်းပြီးနောက် သင်ယူရရှိမည့် အကျိုးကျေးဇူးများ",
        advan_intro: "ကျွန်ုပ်တို့၏ အင်ဂျင်နီယာဘွဲ့ သင်ရိုးညွှန်းတမ်းကို လက်တွေ့အသက်မွေးဝမ်းကျောင်းလောကတွင် အသုံးချနိုင်စေရန် အဓိကအားသာချက်များဖြင့် ပြုစုထားပါသည်။",
        advan_1: "သတင်းအချက်အလက် နှင့် ဆက်သွယ်ရေးနည်းပညာ အခြေခံ နှင့် အဆင့်မြင့်ကျွမ်းကျင်မှုများ",
        advan_2: "ဒေတာဆိုင်ရာ နည်းပညာများ",
        advan_3: "ပေါ်ထွက်လာသည့် နည်းပညာအသစ်များ",
        advan_4: "ကွန်ပျူတာနှင့် ဆိုက်ဘာလုံခြုံရေး အသိပညာ",
        advan_5: "ပရောဂျက်စီမံခန့်ခွဲမှု နှင့် အဖွဲ့လိုက်ပူးပေါင်းဆောင်ရွက်မှု စွမ်းရည်",
        advan_6: "သတင်းအချက်အလက်နည်းပညာဖြင့် ပြဿနာဖြေရှင်းနိုင်သော စွမ်းရည်",
        advan_7: "ယုတ္တိကျသောအတွေးအခေါ် တိကျသေချာမှုနှင့် ခွဲခြမ်းစိတ်ဖြာနိုင်သော စွမ်းရည်",
        advan_8: "အခြေအနေအခက်အခဲများ ဖြေရှင်းနိုင်သော စွမ်းရည်",
        advan_9: "ပရိုဂရမ်ကုဒ်ရေးဆွဲခြင်း နှင့် စနစ်ဖွဲ့စည်းခြင်း ဒီဇိုင်းနည်းပညာ",
        advan_10: "သုတေသနကျွမ်းကျင်မှု နှင့် တီထွင်ဖန်တီးနိုင်သော စွမ်းရည်",
        job_header: "အလုပ်အကိုင် လမ်းကြောင်းများနှင့် အခွင့်အလမ်းများ",
        job_info: "အချက်အလက် သိပ္ပံနှင့် နည်းပညာဘွဲ့ (B.E. Information Science and TEchnology) ရရှိသူများသည် IT ကုမ္ပဏီများ၊ ဘဏ်နှင့် ငွေကြေးအဖွဲ့အစည်းများ၊ ဆက်သွယ်ရေးလုပ်ငန်းများ၊ ဆော့ဖ်ဝဲလုပ်ငန်းများ၊ အီလက်ထရောနစ် ကုန်သွယ်လုပ်ငန်းများ၊ စတင်တည်ထောင်သည့် စီးပွားရေးလုပ်ငန်းအသစ်များ၊ အစိုးရ ဒစ်ဂျစ်တယ် ပရောဂျက်များ စသဖြင့် အောက်ပါ အလုပ်ရာထူးများတွင် အလုပ်လုပ်နိုင်ပါသည်။",
        job_1: "ဆော့ဖ်ဝဲ အင်ဂျင်နီယာ",
        job_2: "ဒေတာ သုတေသနပညာရှင်",
        job_3: "ဒေတာစနစ် စီမံခန့်ခွဲသူ",
        job_4: "ကွန်ယက် စီမံခန့်ခွဲသူ",
        job_5: "ဆိုင်ဘာလုံခြုံရေး ပညာရှင်",
        job_6: "ဝဘ်/မိုဘိုင်း အက်ပလီကေးရှင်း အင်ဂျင်နီယာ",
        job_7: "Cloud စီမံဖြေရှင်းခြင်း ပညာရှင်",
        job_8: "IT စီမံကိန်း မန်နေဂျာ",
        job_9: "AI / စက်ပစ္စည်း သင်ယူမှု အင်ဂျင်နီယာ",
        job_10: "စီးပွားရေး အချက်အလက် သုံးသပ်သူ",
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
      },
      en: {
        major_Title: "Information Science and Technology",
        major_Description: "The Department of Information Science and Technology (IST) at the University of Technology (Yatanarpon Cyber City) is an engineering discipline that combines the study of information systems, computer technology, and communication technologies.",
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
        objectives_heading: "The objectives and responsibilities",
        objectives: "To deliver high-quality theoretical and practical training so that students can become innovative creators in emerging information technologies and user communities. To support the effective use of new technologies in order to genuinely solve the problems and challenges facing the world. To widely create learning environments and opportunities that utilize ICT. To enable students to become future leaders in information technology by equipping them with the necessary knowledge, competencies, practical skills, and emerging information technologies. Additionally, to train students to become proficient in their specialized subjects and to engage in innovative scientific research. The IST course aims to provide students with fundamental knowledge in technology, progressing to advanced research and practical expertise. The main topics to be studied are as follows:",
        motto: '"To build a better society through ICT"',
        basic_tech: "Basic IT Technologies",
        tech_1: "Programming Languages (C, C++, Java, Python, ...)",
        tech_2: "Data Structures & Algorithms",
        tech_3: "Computer Organization & Architecture",
        tech_4: "Operating Systems",
        data_db: "Data and Database",
        data_1: "Database Management Systems (DBMS)",
        data_2: "Data Modeling & SQLs",
        data_3: "Big Data Concepts",
        data_4: "Data Analytics & Visualization",
        network_sec: "Networking & Security",
        netsec_1: "Computer Networks",
        netsec_2: "Internet Protocols",
        netsec_3: "Cybersecurity Fundamentals",
        netsec_4: "Network Administration",
        software_dev: "Software Development",
        softdev_1: "Software Engineering & Methodologies",
        softdev_2: "Web Development(Frontend & Backend)",
        softdev_3: "Mobile Application Development",
        softdev_4: "Software Testing & Development",
        emerge_tech: "Emerging Technologies",
        emtech_1: "Artificial Intelligence (AI) & Machine Learning (ML)",
        emtech_2: "Cloud Computing",
        emtech_3: "Internet of Things (IoT)",
        emtech_4: "Software Testing & Development",
        pro_ethic: "Professional & Ethical Practices",
        ethic_1: "ICT Laws & Ethics",
        ethic_2: "Intellectual Property Rights",
        ethic_3: "Sustainable Technology Use",
        pj_skills: "Project & Research Skills",
        skill_1: "ICT Project Management",
        skill_2: "Research Methodology",
        skill_3: "Final Year Project (Capstone Project)",
        skill_4: "Teamwork & Communication Skills",
        lab_heading: "Where You Can Learn",
        lab_intro: "In the Information Science and Technology major, laboratories have been established to help students master technologies through both theoretical and practical learning",
        tap: "Hover over or tap a skill to see a brief description",
        prog_lab: "Programming & Software Development Lab",
        data_lab: "Database & Data Analytics Lab",
        netsec_lab: "Networking & Security Lab",
        webdev_lab: "Web & Mobile Development Lab",
        ai_lab: "AI & Machine Learning Lab",
        cloudIoT_lab: "Cloud Computing & IoT Lab",
        advantagesH: "What You Will Learn After B.E. Course",
        advan_intro: "Our Bachelor of Engineering curriculum is designed to prepare you for the real world with these key advantages.",
        advan_1: "Fundamental and Advanced ICT Skills",
        advan_2: "Data-related Technologies",
        advan_3: "Emerging Technologies",
        advan_4: "Cybersecurity Awareness",
        advan_5: "Project Management & Teamwork",
        advan_6: "Problem-Solving with ICT",
        advan_7: "Logical & Analytical Thinking",
        advan_8: "Problem-Solving Skills",
        advan_9: "Coding & System Design",
        advan_10: "Research & Innovation Skills",
        job_header: "Career Paths & Job Opportunities",
        job_info: "Graduates with a B.E. in Information Science and Technology can work in IT companies, banking and financial institutions, telecom, software houses, e-commerce companies, startups, government digital projects, and so on, as the following job positions:",
        job_1: "Software Developer / Engineer",
        job_2: "Data Analyst / Data Scientist",
        job_3: "Database Administrator",
        job_4: "Network Administrator",
        job_5: "Cybersecurity Specialist",
        job_6: "Web & Mobile Application Developer",
        job_7: "Cloud Solutions Architect",
        job_8: "IT Project Manager",
        job_9: "AI/Machine Learning Engineer",
        job_10: "Business Intelligence Analyst",
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