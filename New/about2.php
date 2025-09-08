<!DOCTYPE html>
<!-- The 'dark' class will be managed by JavaScript -->
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

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <!-- Animate On Scroll (AOS) Library -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


  <script>
    // Initialize Tailwind dark mode
    tailwind.config = {
      darkMode: 'class',
    }
  </script>

  <style>
    /* Base styles */

    /* --- Unique Uiverse Card Styles (Adapted for this site) --- */
    .uiverse-major-card {
      width: 100%;
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      transition: all 0.5s ease-in-out;
      clip-path: polygon(30px 0%,
          100% 0,
          100% calc(100% - 30px),
          calc(100% - 30px) 100%,
          0 100%,
          0% 30px);
      border-top-right-radius: 20px;
      border-bottom-left-radius: 20px;
      display: flex;
      flex-direction: column;
    }

    .dark .uiverse-major-card {
      background: #1f2937; /* gray-800 */
      border-color: #374151; /* gray-700 */
    }

    .uiverse-major-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
     .dark .uiverse-major-card:hover {
       box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2),
        0 4px 6px -2px rgba(0, 0, 0, 0.1);
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
    .dark .uiverse-major-card .card-title {
      color: #f3f4f6; /* gray-100 */
    }

    .uiverse-major-card .card-info {
      font-weight: 400;
      color: #4b5563;
      font-size: 0.9em;
      margin-bottom: 1.5rem;
      flex-grow: 1;
    }
     .dark .uiverse-major-card .card-info {
       color: #9ca3af; /* gray-400 */
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

<body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-500">
  <!-- Navigation Bar -->
  <div class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="./home.php" class="flex items-center space-x-3">
        <div class="p-2 rounded-lg">
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        </div>
        <div>
          <span class="text-lg font-bold text-blue-900 dark:text-blue-400 block">UTYCC</span>
          <span class="text-xs text-gray-500 dark:text-gray-400" data-lang-key="utycc_full_name">University of Technology (Yatanarpon Cyber
            City)</span>
        </div>
      </a>
      <div class="hidden md:flex items-center space-x-6">
        <a href="./about.php" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-800 dark:hover:text-blue-400 transition font-medium"
          data-lang-key="nav_about">About Us</a>
        <a href="./activity.php" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-800 dark:hover:text-blue-400 transition font-medium"
          data-lang-key="nav_activity">Activities</a>
        <a href="./Rform/examResults.php" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-800 dark:hover:text-blue-400 transition font-medium"
          data-lang-key="nav_examresult">Exam Results</a>

        <!-- Dark Mode Toggle -->
        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm-.707 10.607a1 1 0 011.414 0l.707-.707a1 1 0 111.414 1.414l-.707.707a1 1 0 01-1.414 0zM3 11a1 1 0 100 2H2a1 1 0 100-2h1z"></path></svg>
        </button>

        <!-- Language Switcher Dropdown -->
        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <button
              class="lang-switcher-button relative flex items-center bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 dark:text-gray-300 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/gb.png" alt="Selected Flag"
                class="h-4 w-6 object-cover flex-shrink-0">
              <span id="selected-lang-text-desktop" class="ml-2">English</span>
              <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 text-xs absolute right-3 pointer-events-none"></i>
            </button>
            <div
              class="lang-switcher-menu hidden absolute mt-1 w-auto min-w-full rounded-md bg-white dark:bg-gray-700 shadow-lg z-20 ring-1 ring-black ring-opacity-5">
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600"
                data-lang="my">
                <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
                <span>မြန်မာ</span>
              </a>
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600"
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
      <button id="mobile-menu-button" class="md:hidden text-blue-900 dark:text-blue-400">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t border-gray-200 dark:border-gray-700">
      <br><br>
      <a href="./about.php" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-800 dark:hover:text-blue-400 transition font-medium"
        data-lang-key="nav_about_mobile">About Us</a>
        <br><br>
      <a href="./activity.php" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-800 dark:hover:text-blue-400 transition font-medium"
        data-lang-key="nav_activity_mobile">Activities</a>
        <br><br>
      <a href="./exam_results.php" class="nav-link text-gray-700 dark:text-gray-300 hover:text-blue-800 dark:hover:text-blue-400 transition font-medium"
        data-lang-key="nav_examresult_mobile">Exam Results</a>
        <br><br>
      <div class="relative mt-4 pt-4 border-t dark:border-gray-700">
        <!-- Language Switcher for Mobile -->
        <div id="lang-switcher-container-mobile" class="relative">
          <button
            class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 dark:text-gray-300 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/gb.png" alt="Selected Flag"
              class="h-4 w-6 object-cover flex-shrink-0">
            <span id="selected-lang-text-mobile" class="ml-3">English</span>
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
  </div>

  <main class="container mx-auto px-4 py-12">
    <section class="text-center max-w-3xl mx-auto">
      <h1 class="text-4xl font-bold text-blue-900 dark:text-blue-400 mb-4">
        About Our University
      </h1>
      <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed" data-lang-key="AOU">
        At our esteemed institution, we are dedicated to fostering academic
        excellence, critical thinking, and a vibrant community. We offer a
        diverse range of programs designed to equip students with the skills
        and knowledge needed to excel in their chosen fields and make a
        meaningful impact on the world.
      </p>
    </section>

    <section class="mt-16">
      <h2 id="majorProgramsHeader" class="text-3xl font-bold text-center text-blue-900 dark:text-blue-400 mb-8 cursor-pointer" title="A secret awaits...">
        Our Major Programs
      </h2>
      <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6 card_1">
        <a href="./Majors/ist.php" class="uiverse-major-card" data-aos="fade-up">
          <img src="Img/logo/IST.webp" alt="Information Science and Technology"
            class="card-image w-full h-50 object-cover" />
          <div class="card-content">
            <span class="card-title" data-lang-key="major_ist_title">Information Science and Technology (IST)</span>
            <p class="card-info" data-lang-key="major_ist_desc">
              Learn to design, implement, and manage information systems that
              drive business success.
            </p>
            <div class="card-button" data-lang-key="card_button_text" href="./Majors/ist.php">
              Learn More
            </div>
          </div>
        </a>

        <a href="./Majors/ce.php" class="uiverse-major-card" data-aos="fade-up" data-aos-delay="100">
          <img src="Img/logo/CE.webp" alt="Computer Engineering" class="card-image w-full h-50 object-cover" />
          <div class="card-content">
            <span class="card-title" data-lang-key="major_ce_title">Computer Engineering (CE)</span>
            <p class="card-info" data-lang-key="major_ce_desc">
              Combine computer science and electrical engineering to build
              hardware and software systems.
            </p>
            <div class="card-button" data-lang-key="card_button_text" href="./Majors/ce.php">
              Learn More
            </div>
          </div>
        </a>

        <a href="./Majors/ece.php" class="uiverse-major-card" data-aos="fade-up" data-aos-delay="200">
          <img src="Img/logo/EcE.jpg" alt="Electronics Engineering" class="card-image w-full h-50 object-cover" />
          <div class="card-content">
            <span class="card-title" data-lang-key="major_ece_title">Electronics Engineering (EcE)</span>
            <p class="card-info" data-lang-key="major_ece_desc">
              Explore the principles of electricity, electronics, and
              computing for innovative solutions.
            </p>
            <div class="card-button" data-lang-key="card_button_text" href="./Majors/ece.php">
              Learn More
            </div>
          </div>
        </a>

        <a href="./Majors/pre.php" class="uiverse-major-card" data-aos="fade-up" data-aos-delay="300">
          <img src="Img/logo/PrE.png" alt="Precision Engineering" class="card-image w-full h-50 object-cover" />
          <div class="card-content">
            <span class="card-title" data-lang-key="major_pre_title">Precision Engineering (PrE)</span>
            <p class="card-info" data-lang-key="major_pre_desc">
              Focus on the exploration, drilling, production, and management
              of oil and natural gas resources.
            </p>
            <div class="card-button" data-lang-key="card_button_text" href="./Majors/pre.php">
              Learn More
            </div>
          </div>
        </a>

        <a href="./Majors/ame.php" class="uiverse-major-card" data-aos="fade-up" data-aos-delay="400">
          <img src="Img/logo/AME_updated.jpg" alt="Advanced Materials Engineering"
            class="card-image w-full h-50 object-cover" />
          <div class="card-content">
            <span class="card-title" data-lang-key="major_ame_title">Advanced Materials Engineering (AME)</span>
            <p class="card-info" data-lang-key="major_ame_desc">
              Design, analyze, and test aircraft, spacecraft, and other
              mechanical systems.
            </p>
            <div class="card-button" data-lang-key="card_button_text" href="./Majors/‌ame.php">
              Learn More
            </div>
          </div>
        </a>
      </div>
    </section>

    <!-- NEW: "By the Numbers" Section -->
    <section class="mt-20 py-16 bg-blue-50 dark:bg-gray-800 rounded-lg">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-900 dark:text-blue-400 mb-12">UTYCC By The Numbers</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div>
            <span class="text-5xl font-bold text-blue-800 dark:text-blue-300 counter" data-target="5">0</span>
            <p class="text-gray-600 dark:text-gray-400 mt-2 font-medium">Major Programs</p>
          </div>
          <div>
            <span class="text-5xl font-bold text-blue-800 dark:text-blue-300 counter" data-target="2000">0</span>
            <p class="text-gray-600 dark:text-gray-400 mt-2 font-medium">Students Enrolled</p>
          </div>
          <div>
            <span class="text-5xl font-bold text-blue-800 dark:text-blue-300 counter" data-target="500">0</span>
            <p class="text-gray-600 dark:text-gray-400 mt-2 font-medium">Graduates Per Year</p>
          </div>
          <div>
            <span class="text-5xl font-bold text-blue-800 dark:text-blue-300 counter" data-target="50">0</span>
            <p class="text-gray-600 dark:text-gray-400 mt-2 font-medium">Faculty Members</p>
          </div>
        </div>
      </div>
    </section>
  </main>

    <!-- MEMORY GAME HTML STRUCTURE -->
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


  <!-- Footer -->
  <footer id="contact" class="bg-blue-900 dark:bg-gray-900 text-white mt-16">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" />
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 dark:text-gray-400 text-sm mt-4">
            <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
              Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
              Region, Myanmar
            </a>
          </p>
          <div class="mt-4 text-sm text-blue-200 dark:text-gray-400">
            <p>Email: info@utycc.edu.mm (example)</p>
            <p>Phone: +95 (XX) XXX XXX (example)</p>
          </div>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">
            Faculties
          </h3>
          <ul class="space-y-2 text-sm text-blue-200 dark:text-gray-400">
            <li><a href="./Majors/ist.php" data-lang-key="footer_faculty_ist" class="hover:text-white">Information Science Technology</a></li>
            <li><a href="./Majors/ce.php" data-lang-key="footer_faculty_ce" class="hover:text-white">Computer Engineering</a></li>
            <li><a href="./Majors/ece.php" data-lang-key="footer_faculty_ece" class="hover:text-white">Electronics Engineering</a></li>
            <li><a data-lang-key="footer_faculty_pre" href="./Majors/pre.php" class="hover:text-white">Precision Engineering</a></li>
            <li><a data-lang-key="footer_faculty_ame" href="./Majors/ame.php" class="hover:text-white">Advanced Materials Engineering</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
            Quick Links
          </h3>
          <ul class="space-y-2 text-sm text-blue-200 dark:text-gray-400">
            <li><a href="./terms.php" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a></li>
            <li><a href="./FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a></li>
            <li><a href="./about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a></li>
            <li><a href="./randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a></li>
            <li><a href="./data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">
            Follow Us
          </h3>
          <div class="flex space-x-4">
            <a href="#" class="text-blue-200 dark:text-gray-400 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
            <a href="https://mm.linkedin.com/school/university-of-technology-yatanarpon-cyber-city/"
              class="text-blue-200 dark:text-gray-400 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
            <a href="#" class="text-blue-200 dark:text-gray-400 hover:text-white"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" class="text-blue-200 dark:text-gray-400 hover:text-white"><i class="fa-brands fa-tiktok"></i></a>
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
      <div class="mt-10 border-t border-blue-800 dark:border-gray-700 pt-6 text-center text-sm text-blue-300 dark:text-gray-500"
        data-lang-key="footer_copyright">
        &copy; 2025 University of Technology - Yatanarpon Cyber City. All
        Rights Reserved.
      </div>
    </div>
  </footer>

  <!-- Original Scripts -->
  <script src="./JS/lgl.js"></script>
  <script src="./JS/memory_game.js"></script>
  
  <!-- Animate on Scroll (AOS) JS -->
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <!-- ALL NEW and Consolidated JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      
      // --- Initialize Animate On Scroll (AOS) ---
      AOS.init({
        duration: 800, // animation duration in ms
        once: true,    // whether animation should happen only once
      });
      
      // --- Mobile Menu Script ---
      const mobileMenuButton = document.getElementById("mobile-menu-button");
      const mobileMenu = document.getElementById("mobile-menu");
      mobileMenuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
      });

      // --- Dark Mode Toggle Script ---
      const themeToggleBtn = document.getElementById('theme-toggle');
      const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
      const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

      // Function to apply the theme
      function applyTheme(theme) {
          if (theme === 'dark') {
              document.documentElement.classList.add('dark');
              themeToggleLightIcon.classList.remove('hidden');
              themeToggleDarkIcon.classList.add('hidden');
          } else {
              document.documentElement.classList.remove('dark');
              themeToggleDarkIcon.classList.remove('hidden');
              themeToggleLightIcon.classList.add('hidden');
          }
      }

      // Check for saved theme in localStorage
      const savedTheme = localStorage.getItem('color-theme');
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

      if (savedTheme) {
          applyTheme(savedTheme);
      } else if (prefersDark) {
          applyTheme('dark');
      } else {
          applyTheme('light');
      }

      themeToggleBtn.addEventListener('click', function() {
          const isDark = document.documentElement.classList.contains('dark');
          if (isDark) {
              localStorage.setItem('color-theme', 'light');
              applyTheme('light');
          } else {
              localStorage.setItem('color-theme', 'dark');
              applyTheme('dark');
          }
      });

      // --- Animated Counter for "By the Numbers" Section ---
      const counters = document.querySelectorAll('.counter');
      const animationSpeed = 400; 

      const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const count = +counter.innerText;
        const increment = target / animationSpeed;

        if (count < target) {
            counter.innerText = Math.ceil(count + increment);
            setTimeout(() => animateCounter(counter), 1);
        } else {
            // Format with commas for better readability
            counter.innerText = target.toLocaleString();
        }
      };

      const observer = new IntersectionObserver((entries, observer) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  animateCounter(entry.target);
                  observer.unobserve(entry.target);
              }
          });
      }, { threshold: 0.5 }); // Trigger when 50% of the element is visible

      counters.forEach(counter => {
          observer.observe(counter);
      });

      // --- Secret Game Trigger Script ---
      const majorProgramsHeader = document.getElementById('majorProgramsHeader');
      let clickCount = 0;
      let clickTimer;
      majorProgramsHeader.addEventListener('click', () => {
        clickCount++;
        clearTimeout(clickTimer);
        clickTimer = setTimeout(() => { clickCount = 0; }, 2000);
        if (clickCount === 10) {
          if(typeof memoryGameToast_openGame === 'function') {
            memoryGameToast_openGame();
          }
          clickCount = 0;
        }
      });

      // --- COMPLETE TRANSLATION SCRIPT ---
      // (This is your original translation script, unchanged)
      const translations = {
        my: {
            AOU: "ကျွန်ုပ်တို့၏ လေးစားထိုက်သော အဖွဲ့အစည်းတွင် ကျွန်ုပ်တို့သည် ပညာရေးကို မြှင့်တင်ရန် ရည်စူးပါသည်။ထူးချွန်မှု၊ ဝေဖန်ပိုင်းခြားတွေးခေါ်မှုနှင့် တက်ကြွသောအသိုင်းအဝိုင်း။ တစ်ခုကမ်းလှမ်းတယ်။ကျောင်းသားများအား အရည်အချင်းများ ဖြည့်ဆည်းပေးနိုင်ရန် အမျိုးမျိုးသော ပရိုဂရမ်များ ရေးဆွဲထားသည်။မိမိတို့ရွေးချယ်ထားသော နယ်ပယ်တွင် ထူးချွန်ရန် လိုအပ်သော အသိပညာ၊ကမ္ဘာကြီးအပေါ် အဓိပ္ပာယ်သက်ရောက်သည် ",
            utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
            nav_about: "ကျွန်ုပ်တို့အကြောင်း", nav_activity: "လှုပ်ရှားမှုများ", nav_examresult: "အောင်စာရင်း",
            nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း", nav_activity_mobile: "လှုပ်ရှားမှုများ", nav_examresult_mobile: "အောင်စာရင်း",
            major_ist_title: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ (IST)", major_ist_desc: "လုပ်ငန်းအောင်မြင်မှုကို မြှင့်တင်ပေးသော သတင်းအချက်အလက်စနစ်များကို ဒီဇိုင်းဆွဲရန်၊ အကောင်အထည်ဖော်ရန်နှင့် စီမံခန့်ခွဲရန် သင်ယူနိုင်ပါသည်။",
            major_ce_title: "ကွန်ပျူတာ အင်ဂျင်နီယာ (CE)", major_ce_desc: "ကွန်ပျူတာနည်းပညာနဲ့ အင်ဂျင်နီယာသိပ္ပံကို ပေါင်းစပ်ပြီး အဆင့်မြင့် ဟာ့ဒ်ဝဲနဲ့ ဆော့ဖ်ဝဲစနစ်များ ဖန်တီးရန် သင်ယူနိုင်ပါသည်။",
            major_ece_title: "အီလက်ထရောနစ် အင်ဂျင်နီယာ (EcE)", major_ece_desc: "ကွန်ပျူတာ၊ အီလက်ထရောနစ်နှင့် လျှပ်စစ်နည်းပညာများကို ပေါင်းစပ်ပြီး နည်းလမ်းသစ်များကို ဖန်တီးရန် သင်ယူနိုင်ပါသည်။",
            major_pre_title: "တိကျစက်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ (PrE)", major_pre_desc: "တိကျမှန်ကန်သော စက်ပစ္စည်းများနှင့် အစိတ်အပိုင်းများကို ဒီဇိုင်းဆွဲထုတ်လုပ်ပြီး အလိုအလျောက်ထိန်းချုပ်စနစ်များ ဖန်တီးနိုင်ရန် သင်ယူနိုင်ပါသည်။",
            major_ame_title: "အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ (AME)", major_ame_desc: "သတ္တုနှင့် သတ္တုစပ်ပစ္စည်းများကို ဒီဇိုင်းရေးဆွဲခြင်းနှင့် ဖွံ့ဖြိုးတိုးတက်စေရန် အခြေခံသိပ္ပံနှင့် နည်းပညာများကို သင်ယူနိုင်ပါသည်။",
            card_button_text: "ပိုမိုလေ့လာရန်",
            footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
            footer_faculties_title: "မဟာဌာနများ", footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ", footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ", footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ", footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ", footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
            footer_contact_title: "ဆက်သွယ်ရန်", footer_follow_title: "Follow Us", footer_copyright: "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
            footer_quick_links_title: "အသုံးဝင်သောလင့်များ", footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ", footer_link_faq: "အမေးများသော မေးခွန်းများ", footer_link_about: "ကျွန်ုပ်တို့အကြောင်း", footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ", footer_link_dp: "ဒေတာကာကွယ်ရေး",
        },
        en: {
            AOU: "At our esteemed institution, we are dedicated to fostering academic excellence, critical thinking, and a vibrant community. We offer adiverse range of programs designed to equip students with the skillsand knowledge needed to excel in their chosen fields and make ameaningful impact on the world.",
            utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
            nav_about: "About Us", nav_activity: "Activities", nav_examresult: "Exam Results",
            nav_about_mobile: "About Us", nav_activity_mobile: "Activities", nav_examresult_mobile: "Exam Results",
            major_ist_title: "Information Science and Technology (IST)", major_ist_desc: "Learn to design, implement, and manage information systems that drive business success.",
            major_ce_title: "Computer Engineering (CE)", major_ce_desc: "Combine computer science and electrical engineering to build hardware and software systems.",
            major_ece_title: "Electronics Engineering (EcE)", major_ece_desc: "Explore the principles of electricity, electronics, and computing for innovative solutions.",
            major_pre_title: "Precision Engineering (PrE)", major_pre_desc: "Learn to design and manufacture precise machinery and components, and to create automated control systems.",
            major_ame_title: "Advanced Materials Engineering (AME)", major_ame_desc: "Learn the fundamental science and technologies to design and develop metals and metal alloy materials.",
            card_button_text: "Learn More",
            footer_address: "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
            footer_faculties_title: "Faculties", footer_faculty_ist: "Information Science Technology", footer_faculty_ce: "Computer Engineering", footer_faculty_ece: "Electronics Engineering", footer_faculty_ame: "Advanced Materials Engineering", footer_faculty_pre: "Precision Engineering",
            footer_contact_title: "Contact Us", footer_follow_title: "Follow Us", footer_copyright: "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
            footer_quick_links_title: "Quick Links", footer_link_terms: "Terms & Policies", footer_link_faq: "FAQs", footer_link_about: "About Us", footer_link_rules: "Rules & Regulations", footer_link_dp: "Data Protection",
        },
      };

      const languageSwitcherDesktop = document.getElementById("language-switcher-desktop");
      const languageSwitcherMobile = document.getElementById("language-switcher-mobile");

      const changeLanguage = (lang) => {
        localStorage.setItem("language", lang);
        languageSwitcherDesktop.value = lang;
        languageSwitcherMobile.value = lang;
        document.querySelectorAll("[data-lang-key]").forEach((element) => {
          const key = element.dataset.langKey;
          const translation = translations[lang][key];
          if (translation) {
            element.innerHTML = translation.replace(/\\n/g, "<br>");
          }
        });
      };
      
      const setLanguage = (lang) => {
        // This function might be defined in lgl.js, if so, this is a fallback.
        // Assuming lgl.js handles the initial call, if not, this ensures it works.
        changeLanguage(lang);
      }

      languageSwitcherDesktop.addEventListener("change", (event) => { changeLanguage(event.target.value); });
      languageSwitcherMobile.addEventListener("change", (event) => { changeLanguage(event.target.value); });

      const savedLang = localStorage.getItem("language") || "en";
      // The setLanguage function seems to be missing from the original code but logic implies its existence
      // It's safer to just call changeLanguage directly.
      changeLanguage(savedLang);
    });
  </script>

</body>

</html>
