<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - UTYCC</title>

  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="./CSS/star-layout.css" />
  <link rel="stylesheet" href="./CSS/footer.css" />
  <link rel="stylesheet" href="./CSS/hero-carousel.css" />
  <link rel="stylesheet" href="CSS/font.css" />
  <link rel="stylesheet" href="./CSS/memory_game.css" />

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Oswald:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- GSAP CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      overflow-x: hidden;
    }

    h1,
    h2,
    h3 {
      font-family: 'Oswald', sans-serif;
    }

    .hero-icon {
      position: absolute;
      right: 5%;
      top: 50%;
      transform: translateY(-50%);
      font-size: 14rem;
      opacity: 0.05;
      color: #1e3a8a;
      z-index: 1;
      pointer-events: none;
    }

    .stat-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Timeline styling */
    .timeline-item {
      position: relative;
      padding-left: 2.5rem;
      padding-bottom: 2rem;
      border-left: 2px solid #d1d5db;
      /* gray-300 */
    }

    .timeline-item:last-child {
      border-left: 2px solid transparent;
    }

    .timeline-dot {
      position: absolute;
      left: -0.5625rem;
      top: 0;
      height: 1rem;
      width: 1rem;
      background-color: #3b82f6;
      /* blue-500 */
      border-radius: 9999px;
      border: 2px solid white;
    }

    /* --- Unique Uiverse Card Styles (Adapted for this site) --- */
    .uiverse-major-card {
      width: 100%;
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      transition: all 0.5s ease-in-out;
      clip-path: polygon(30px 0%, 100% 0, 100% calc(100% - 30px), calc(100% - 30px) 100%, 0 100%, 0% 30px);
      border-top-right-radius: 20px;
      border-bottom-left-radius: 20px;
      display: flex;
      flex-direction: column;
    }

    .uiverse-major-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .uiverse-major-card .card-image {
      width: 100%;
      object-fit: cover;
    }

    .uiverse-major-card .card-content {
      padding: 1.5rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      text-align: center;
    }

    .uiverse-major-card .card-title {
      font-weight: bold;
      color: #111827;
      font-size: 1.25em;
      margin-bottom: 0.5rem;
    }

    .uiverse-major-card .card-info {
      font-weight: 400;
      color: #4b5563;
      font-size: 0.9em;
      margin-bottom: 1.5rem;
      flex-grow: 1;
    }

    .uiverse-major-card .card-button {
      padding: 0.8em 1.7em;
      border-radius: 25px;
      border: none;
      font-weight: bold;
      background: #1e40af;
      color: white;
      transition: 0.4s ease-in-out;
    }

    .uiverse-major-card .card-button:hover {
      background: #1d4ed8;
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-gray-100">
  <header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="./index.php" class="flex items-center space-x-3">
        <div class="p-2 rounded-lg">
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" loading="lazy" />
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
        <a href="./Rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult">Exam Results</a>
        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <button
              class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/gb.png" alt="Selected Flag"
                class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
              <span id="selected-lang-text-desktop" class="ml-2">English</span>
              <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 pointer-events-none"></i>
            </button>
            <div
              class="lang-switcher-menu hidden absolute mt-1 w-auto min-w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                data-lang="my">
                <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                  class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
                <span>မြန်မာ</span>
              </a>
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                data-lang="en">
                <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
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
      <a href="./Rform/examResults.php" class="block py-2 text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_examresult_mobile">Exam Results</a>
      <div class="relative mt-4 pt-4 border-t">
        <div id="lang-switcher-container-mobile" class="relative">
          <button
            class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/gb.png" alt="Selected Flag"
              class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
            <span id="selected-lang-text-mobile" class="ml-3">English</span>
            <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
          </button>
          <div
            class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="my">
              <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
              <span>မြန်မာ</span>
            </a>
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="en">
              <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
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

  <main class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <section class="relative bg-white p-8 md:p-12 rounded-lg shadow-lg mb-16 overflow-hidden animate-section">
      <i class="fas fa-university hero-icon"></i>
      <div class="relative z-10 text-center max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold text-blue-900 mb-4 animate-title" data-lang-key="about_title">About Our University</h1>
        <p class="text-lg text-gray-600 leading-relaxed animate-fade" data-lang-key="AOU">
          At our esteemed institution, we are dedicated to fostering academic excellence, critical thinking, and a vibrant community. We offer a diverse range of programs designed to equip students with the skills and knowledge needed to excel in their chosen fields and make a meaningful impact on the world.
        </p>
      </div>
    </section>

    <!-- Mission and Vision Section -->
    <section class="grid md:grid-cols-2 gap-8 mb-16 animate-section">
      <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <i class="fas fa-bullseye text-4xl text-blue-500 mb-4"></i>
        <h2 class="text-3xl font-bold text-blue-900 mb-3" data-lang-key="mission_title">Our Mission</h2>
        <p class="text-gray-600" data-lang-key="mission_text">To provide world-class technical education, foster research and innovation, and produce highly competent graduates who can contribute to the nation's technological advancement and societal well-being.</p>
      </div>
      <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <i class="fas fa-eye text-4xl text-blue-500 mb-4"></i>
        <h2 class="text-3xl font-bold text-blue-900 mb-3" data-lang-key="vision_title">Our Vision</h2>
        <p class="text-gray-600" data-lang-key="vision_text">To be a leading center of excellence in technology education and research, recognized globally for our contribution to innovation and sustainable development.</p>
      </div>
    </section>

    <!-- University History Section -->
    <section class="mb-16 animate-section">
      <h2 class="text-4xl font-bold text-center text-blue-900 mb-10" data-lang-key="history_title">Our History</h2>
      <div class="max-w-3xl mx-auto">
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <h3 class="text-xl font-semibold text-blue-800" data-lang-key="history_2009_title">2010 - Foundation</h3>
          <p class="text-gray-600 mt-1" data-lang-key="history_2009_text">The University of Technology (Yatanarpon Cyber City) was established to be a benchmark for technological education in Myanmar.</p>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <h3 class="text-xl font-semibold text-blue-800" data-lang-key="history_2012_title">2014-2015 - First Graduating Class</h3>
          <p class="text-gray-600 mt-1" data-lang-key="history_2012_text">Celebrated the convocation of our first batch of graduates, ready to make their mark in the tech industry.</p>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <h3 class="text-xl font-semibold text-blue-800" data-lang-key="history_2018_title">2018 - Program Expansion</h3>
          <p class="text-gray-600 mt-1" data-lang-key="history_2018_text">Introduced new engineering programs to meet the evolving demands of the global technology landscape.</p>
        </div>
        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <h3 class="text-xl font-semibold text-blue-800" data-lang-key="history_2023_title">2023 - New Research Center</h3>
          <p class="text-gray-600 mt-1" data-lang-key="history_2023_text">Opened a state-of-the-art research center to promote innovation and collaborative projects.</p>
        </div>
      </div>
    </section>

    <!-- By the Numbers Section -->
    <section class="mb-16 text-center animate-section">
      <h2 class="text-4xl font-bold text-blue-900 mb-10" data-lang-key="numbers_title">UTYCC by the Numbers</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="stat-card bg-white p-6 rounded-lg shadow-lg">
          <i class="fas fa-graduation-cap text-4xl text-blue-500 mb-3"></i>
          <div class="text-4xl font-bold text-blue-900" data-stat-value="5">5</div>
          <p class="text-gray-500" data-lang-key="numbers_majors">Major Programs</p>
        </div>
        <div class="stat-card bg-white p-6 rounded-lg shadow-lg">
          <i class="fas fa-users text-4xl text-blue-500 mb-3"></i>
          <div class="text-4xl font-bold text-blue-900" data-stat-value="2000">3000</div>
          <p class="text-gray-500" data-lang-key="numbers_students">Students</p>
        </div>
        <div class="stat-card bg-white p-6 rounded-lg shadow-lg">
          <i class="fas fa-chalkboard-teacher text-4xl text-blue-500 mb-3"></i>
          <div class="text-4xl font-bold text-blue-900" data-stat-value="150">50</div>
          <p class="text-gray-500" data-lang-key="numbers_faculty">Faculty Members</p>
        </div>
        <div class="stat-card bg-white p-6 rounded-lg shadow-lg">
          <i class="fas fa-user-graduate text-4xl text-blue-500 mb-3"></i>
          <div class="text-4xl font-bold text-blue-900" data-stat-value="5000">1027</div>
          <p class="text-gray-500" data-lang-key="numbers_alumni">Alumni</p>
        </div>
      </div>
    </section>

    <!-- Major Programs Section -->
    <section class="animate-section">
      <h2 id="majorProgramsHeader" class="text-4xl font-bold text-center text-blue-900 mb-10 cursor-pointer" title="A secret awaits..." data-lang-key="major_programs_title">
        Our Major Programs
      </h2>
      <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6 card_1">
        <a href="./Majors/ist.php" class="uiverse-major-card">
          <img src="Img/logo/IST.webp" alt="Information Science and Technology" class="card-image w-full h-auto object-contain p-4" loading="lazy" />
          <div class="card-content">
            <h3 class="card-title" data-lang-key="major_ist_title">Information Science and Technology (IST)</h3>
            <p class="card-info" data-lang-key="major_ist_desc">Learn to design, implement, and manage information systems that drive business success.</p>
            <button class="card-button" data-lang-key="card_button_text">Learn More</button>
          </div>
        </a>
        <a href="./Majors/ce.php" class="uiverse-major-card">
          <img src="Img/logo/CE.webp" alt="Computer Engineering" class="card-image w-full h-auto object-contain p-4" loading="lazy" />
          <div class="card-content">
            <h3 class="card-title" data-lang-key="major_ce_title">Computer Engineering (CE)</h3>
            <p class="card-info" data-lang-key="major_ce_desc">Combine computer science and electrical engineering to build hardware and software systems.</p>
            <button class="card-button" data-lang-key="card_button_text">Learn More</button>
          </div>
        </a>
        <a href="./Majors/ece.php" class="uiverse-major-card">
          <img src="Img/logo/EcE.jpg" alt="Electronics Engineering" class="card-image w-full h-auto object-contain p-4" loading="lazy" />
          <div class="card-content">
            <h3 class="card-title" data-lang-key="major_ece_title">Electronics Engineering (EcE)</h3>
            <p class="card-info" data-lang-key="major_ece_desc">Explore the principles of electricity, electronics, and computing for innovative solutions.</p>
            <button class="card-button" data-lang-key="card_button_text">Learn More</button>
          </div>
        </a>
        <a href="./Majors/pre.php" class="uiverse-major-card">
          <img src="Img/logo/PrE.png" alt="Precision Engineering" class="card-image w-full h-auto object-contain p-4" loading="lazy" />
          <div class="card-content">
            <h3 class="card-title" data-lang-key="major_pre_title">Precision Engineering (PrE)</h3>
            <p class="card-info" data-lang-key="major_pre_desc">Focus on the exploration, drilling, production, and management of oil and natural gas resources.</p>
            <button class="card-button" data-lang-key="card_button_text">Learn More</button>
          </div>
        </a>
        <a href="./Majors/ame.php" class="uiverse-major-card">
          <img src="Img/logo/AME_updated.jpg" alt="Advanced Materials Engineering" class="card-image w-full h-auto object-contain p-4" loading="lazy" />
          <div class="card-content">
            <h3 class="card-title" data-lang-key="major_ame_title">Advanced Materials Engineering (AME)</h3>
            <p class="card-info" data-lang-key="major_ame_desc">Design, analyze, and test aircraft, spacecraft, and other mechanical systems.</p>
            <button class="card-button" data-lang-key="card_button_text">Learn More</button>
          </div>
        </a>
      </div>
    </section>
  </main>

  <div class="memoryGameToast_overlay" id="memoryGameToast_overlay">
    <div class="memoryGameToast_container">
      <div class="memoryGameToast_header">
        <h2>Memory Game</h2>
        <div class="memoryGameToast_stats">
          <div id="memoryGameToast_score">Score: 0</div>
          <div id="memoryGameToast_timer">Time: 1:30</div>
        </div>
        <button class="memoryGameToast_closeBtn" id="memoryGameToast_closeBtn" title="Close Game">&times;</button>
      </div>
      <div class="memoryGameToast_grid" id="memoryGameToast_grid"></div>
      <div class="memoryGameToast_modal" id="memoryGameToast_endGameModal">
        <div class="memoryGameToast_modal-content">
          <h3 id="memoryGameToast_modalTitle" class="memoryGameToast_modal-title">You Won!</h3>
          <button id="memoryGameToast_playAgainBtn" class="memoryGameToast_playAgainBtn">Play Again</button>
        </div>
      </div>
    </div>
  </div>

  <footer id="contact" class="bg-blue-900 text-white mt-16">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" loading="lazy" />
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 text-sm mt-4">
            <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
              Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
              Region, Myanmar
            </a>
          </p>
          <div class="mt-4 text-sm text-blue-200">
            <a href="mailto:utyccstudentaffair2010@gmail.com">Email: info@utycc.site utyccstudentaffair2010@gmail.com</a>
            <a href="tel:+959445767834">Phone: +959445767834 </a>
          </div>
        </div>
        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">Faculties</h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li><a href="./Majors/ist.php" data-lang-key="footer_faculty_ist">Information Science Technology</a></li>
            <li><a href="./Majors/ce.php" data-lang-key="footer_faculty_ce">Computer Engineering</a></li>
            <li><a href="./Majors/ece.php" data-lang-key="footer_faculty_ece">Electronics Engineering</a></li>
            <li><a data-lang-key="footer_faculty_pre" href="./Majors/pre.php">Precision Engineering</a></li>
            <li><a data-lang-key="footer_faculty_ame" href="./Majors/ame.php">Advanced Materials Engineering</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">Quick Links</h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li><a href="./terms.php" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a></li>
            <li><a href="./FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a></li>
            <li><a href="./about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a></li>
            <li><a href="./randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a></li>
            <li><a href="./data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a></li>
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
    document.getElementById("mobile-menu-button").addEventListener("click", () => {
      document.getElementById("mobile-menu").classList.toggle("hidden");
    });

    const translations = {
      my: {
        about_title: "ကျွန်ုပ်တို့တက္ကသိုလ်အကြောင်း",
        AOU: "ကျွန်ုပ်တို့၏ လေးစားထိုက်သော အဖွဲ့အစည်းတွင် ပညာရေးဆိုင်ရာ ထူးချွန်မှု၊ ဝေဖန်ပိုင်းခြားတွေးခေါ်မှုနှင့် တက်ကြွသောအသိုင်းအဝိုင်းကို ပြုစုပျိုးထောင်ရန် ရည်စူးပါသည်။ ကျောင်းသားများအား ၎င်းတို့နှစ်သက်ရာနယ်ပယ်တွင် ထူးချွန်ရန်နှင့် ကမ္ဘာကြီးအပေါ် အဓိပ္ပာယ်ပြည့်ဝသော အကျိုးသက်ရောက်မှုဖြစ်စေရန် လိုအပ်သော ကျွမ်းကျင်မှုနှင့် အသိပညာများ တပ်ဆင်ပေးနိုင်ရန် ဒီဇိုင်းထုတ်ထားသည့် ကွဲပြားသော ပရိုဂရမ်များကို ပေးအပ်ပါသည်။",
        mission_title: "ကျွန်ုပ်တို့၏ ရည်မှန်းချက်",
        mission_text: "ကမ္ဘာ့အဆင့်မီ နည်းပညာပညာရေးကို ပံ့ပိုးပေးရန်၊ သုတေသနနှင့် ဆန်းသစ်တီထွင်မှုကို မြှင့်တင်ရန်၊ နိုင်ငံ၏ နည်းပညာတိုးတက်မှုနှင့် လူမှုဘဝသာယာဝပြောရေးကို အထောက်အကူပြုနိုင်သော အရည်အချင်းပြည့်ဝသည့် ဘွဲ့ရများ မွေးထုတ်ရန်။",
        vision_title: "ကျွန်ုပ်တို့၏ မျှော်မှန်းချက်",
        vision_text: "နည်းပညာပညာရေးနှင့် သုတေသနတွင် ထိပ်တန်းထူးချွန်သော ဗဟိုဌာနတစ်ခုဖြစ်လာစေရန်၊ ဆန်းသစ်တီထွင်မှုနှင့် ရေရှည်တည်တံ့သော ဖွံ့ဖြိုးတိုးတက်မှုအတွက် ကျွန်ုပ်တို့၏ ပံ့ပိုးမှုများကို ကမ္ဘာက အသိအမှတ်ပြုစေရန်။",
        history_title: "ကျွန်ုပ်တို့၏ သမိုင်းကြောင်း",
        history_2009_title: "၂၀၁၀ - တည်ထောင်ခြင်း",
        history_2009_text: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ကို မြန်မာနိုင်ငံ၏ နည်းပညာပညာရေးအတွက် စံတစ်ခုအဖြစ် တည်ထောင်ခဲ့သည်။",
        history_2012_title: "၂၀၁၄-၂၀၁၅ - ပထမဆုံး ဘွဲ့နှင်းသဘင်",
        history_2012_text: "နည်းပညာလောကတွင် မိမိတို့၏ခြေရာကို ချန်ထားရန် အဆင်သင့်ဖြစ်နေသော ကျွန်ုပ်တို့၏ ပထမဆုံး ဘွဲ့ရကျောင်းသားအသုတ်၏ ဘွဲ့နှင်းသဘင်ကို ဂုဏ်ပြုကျင်းပခဲ့သည်။",
        history_2018_title: "၂၀၁၈ - ပရိုဂရမ် တိုးချဲ့ခြင်း",
        history_2018_text: "ကမ္ဘာလုံးဆိုင်ရာ နည်းပညာအခင်းအကျင်း၏ ပြောင်းလဲလာသော လိုအပ်ချက်များကို ဖြည့်ဆည်းရန် အင်ဂျင်နီယာပရိုဂရမ်အသစ်များကို မိတ်ဆက်ခဲ့သည်။",
        history_2023_title: "၂၀၂၃ - သုတေသနစင်တာအသစ်",
        history_2023_text: "ဆန်းသစ်တီထွင်မှုနှင့် ပူးပေါင်းဆောင်ရွက်သော ပရောဂျက်များကို မြှင့်တင်ရန်အတွက် ခေတ်မီဆန်းသစ်သော သုတေသနစင်တာတစ်ခုကို ဖွင့်လှစ်ခဲ့သည်။",
        numbers_title: "UTYCC ကိန်းဂဏန်းများ",
        numbers_majors: "အဓိက ပရိုဂရမ်များ",
        numbers_students: "ကျောင်းသားများ",
        numbers_faculty: "မဟာဌာန၀င်များ",
        numbers_alumni: "ဘွဲ့ရကျောင်းသားဟောင်းများ",
        major_programs_title: "ကျွန်ုပ်တို့၏ အဓိက ပရိုဂရမ်များ",
        utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity_mobile: "လှုပ်ရှားမှုများ",
        nav_examresult_mobile: "အောင်စာရင်း",
        major_ist_title: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ (IST)",
        major_ist_desc: "လုပ်ငန်းအောင်မြင်မှုကို မြှင့်တင်ပေးသော သတင်းအချက်အလက်စနစ်များကို ဒီဇိုင်းဆွဲရန်၊ အကောင်အထည်ဖော်ရန်နှင့် စီမံခန့်ခွဲရန် သင်ယူနိုင်ပါသည်။",
        major_ce_title: "ကွန်ပျူတာ အင်ဂျင်နီယာ (CE)",
        major_ce_desc: "ကွန်ပျူတာနည်းပညာနဲ့ အင်ဂျင်နီယာသိပ္ပံကို ပေါင်းစပ်ပြီး အဆင့်မြင့် ဟာ့ဒ်ဝဲနဲ့ ဆော့ဖ်ဝဲစနစ်များ ဖန်တီးရန် သင်ယူနိုင်ပါသည်။",
        major_ece_title: "အီလက်ထရောနစ် အင်ဂျင်နီယာ (EcE)",
        major_ece_desc: "ကွန်ပျူတာ၊ အီလက်ထရောနစ်နှင့် လျှပ်စစ်နည်းပညာများကို ပေါင်းစပ်ပြီး နည်းလမ်းသစ်များကို ဖန်တီးရန် သင်ယူနိုင်ပါသည်။",
        major_pre_title: "တိကျစက်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ (PrE)",
        major_pre_desc: "တိကျမှန်ကန်သော စက်ပစ္စည်းများနှင့် အစိတ်အပိုင်းများကို ဒီဇိုင်းဆွဲထုတ်လုပ်ပြီး အလိုအလျောက်ထိန်းချုပ်စနစ်များ ဖန်တီးနိုင်ရန် သင်ယူနိုင်ပါသည်။",
        major_ame_title: "အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ (AME)",
        major_ame_desc: "သတ္တုနှင့် သတ္တုစပ်ပစ္စည်းများကို ဒီဇိုင်းရေးဆွဲခြင်းနှင့် ဖွံ့ဖြိုးတိုးတက်စေရန် အခြေခံသိပ္ပံနှင့် နည်းပညာများကို သင်ယူနိုင်ပါသည်။",
        card_button_text: "ပိုမိုလေ့လာရန်",
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
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
      },
      en: {
        about_title: "About Our University",
        AOU: "At our esteemed institution, we are dedicated to fostering academic excellence, critical thinking, and a vibrant community. We offer a diverse range of programs designed to equip students with the skills and knowledge needed to excel in their chosen fields and make a meaningful impact on the world.",
        mission_title: "Our Mission",
        mission_text: "To provide world-class technical education, foster research and innovation, and produce highly competent graduates who can contribute to the nation's technological advancement and societal well-being.",
        vision_title: "Our Vision",
        vision_text: "To be a leading center of excellence in technology education and research, recognized globally for our contribution to innovation and sustainable development.",
        history_title: "Our History",
        history_2009_title: "2010 - Foundation",
        history_2009_text: "The University of Technology (Yatanarpon Cyber City) was established to be a benchmark for technological education in Myanmar.",
        history_2012_title: "2014-2015 - First Graduating Class",
        history_2012_text: "Celebrated the convocation of our first batch of graduates, ready to make their mark in the tech industry.",
        history_2018_title: "2018 - Program Expansion",
        history_2018_text: "Introduced new engineering programs to meet the evolving demands of the global technology landscape.",
        history_2023_title: "2023 - New Research Center",
        history_2023_text: "Opened a state-of-the-art research center to promote innovation and collaborative projects.",
        numbers_title: "UTYCC by the Numbers",
        numbers_majors: "Major Programs",
        numbers_students: "Students",
        numbers_faculty: "Faculty Members",
        numbers_alumni: "Alumni",
        major_programs_title: "Our Major Programs",
        utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
        nav_about: "About Us",
        nav_activity: "Activities",
        nav_examresult: "Exam Results",
        nav_about_mobile: "About Us",
        nav_activity_mobile: "Activities",
        nav_examresult_mobile: "Exam Results",
        major_ist_title: "Information Science and Technology (IST)",
        major_ist_desc: "Learn to design, implement, and manage information systems that drive business success.",
        major_ce_title: "Computer Engineering (CE)",
        major_ce_desc: "Combine computer science and electrical engineering to build hardware and software systems.",
        major_ece_title: "Electronics Engineering (EcE)",
        major_ece_desc: "Explore the principles of electricity, electronics, and computing for innovative solutions.",
        major_pre_title: "Precision Engineering (PrE)",
        major_pre_desc: "Learn to design and manufacture precise machinery and components, and to create automated control systems.",
        major_ame_title: "Advanced Materials Engineering (AME)",
        major_ame_desc: "Learn the fundamental science and technologies to design and develop metals and metal alloy materials.",
        card_button_text: "Learn More",
        footer_address: "Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay Region, Myanmar",
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
        footer_link_dp: "Data Protection",
      },
    };

    let currentLanguage = localStorage.getItem("language") || "en";

    function setLanguage(lang) {
      currentLanguage = lang;
      localStorage.setItem("language", lang);
      ['desktop', 'mobile'].forEach(device => {
        const flagImg = document.getElementById(`selected-lang-flag-${device}`);
        const textSpan = document.getElementById(`selected-lang-text-${device}`);
        const select = document.getElementById(`language-switcher-${device}`);
        if (select) select.value = lang;
        if (lang === 'my') {
          if (flagImg) flagImg.src = 'https://flagcdn.com/w20/mm.png';
          if (textSpan) textSpan.textContent = 'မြန်မာ';
        } else {
          if (flagImg) flagImg.src = 'https://flagcdn.com/w20/gb.png';
          if (textSpan) textSpan.textContent = 'English';
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
          setLanguage(option.getAttribute('data-lang'));
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
  <!-- <script src="./JS/lgl.js"></script> -->
  <script src="./JS/memory_game.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Game Trigger
      const majorProgramsHeader = document.getElementById('majorProgramsHeader');
      let clickCount = 0;
      let clickTimer;
      majorProgramsHeader.addEventListener('click', () => {
        clickCount++;
        clearTimeout(clickTimer);
        clickTimer = setTimeout(() => {
          clickCount = 0;
        }, 2000);
        if (clickCount === 10) {
          if (typeof memoryGameToast_openGame === 'function') {
            memoryGameToast_openGame();
          }
          clickCount = 0;
        }
      });

      // GSAP Animations
      gsap.registerPlugin(ScrollTrigger);
      gsap.utils.toArray('.animate-section').forEach(section => {
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

      // Animated counter
      const counters = document.querySelectorAll('[data-stat-value]');
      counters.forEach(counter => {
        const endValue = parseInt(counter.getAttribute('data-stat-value'));
        gsap.from(counter, {
          textContent: 0,
          duration: 2,
          ease: "power1.inOut",
          snap: {
            textContent: 1
          },
          scrollTrigger: {
            trigger: counter,
            start: "top 90%",
            toggleActions: "play none none none"
          },
          onUpdate: function() {
            counter.textContent = Math.ceil(this.targets()[0].textContent).toLocaleString();
          }
        });
      });
    });
  </script>
</body>

</html>