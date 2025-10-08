<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./CSS/star-layout.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="stylesheet" href="./CSS/footer.css" />
  <script src="./JS/star-layout.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
  <title>FAQs - UTYCC</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="./CSS/hero-carousel.css" />
  <script src="./JS/hero-carousel.js"></script>
  <link rel="stylesheet" href="CSS/font.css" />
  <style>
    :root {
      --primary: #0350a3;
      --primary-dark: #02356a;
      --accent: #ff6b35;
      --light: #f4f4f4;
      --dark: #333;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      line-height: 1.6;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      color: #333;
      font-family: "Inter", sans-serif;
      overflow-x: hidden;
    }

    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }

    /* Header and Navigation */
    .bg-white {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .nav-link {
      position: relative;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: "";
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -4px;
      left: 0;
      background-color: var(--primary);
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 0%;
    }

    /* Hero Section */
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

    /* --- NEW/UPDATED STYLES --- */

    /* FAQ Tabs */
    .faq-tabs {
      border-bottom: 2px solid #dee2e6;
    }

    .faq-tab {
      transition: all 0.3s ease;
      border-bottom: 3px solid transparent;
    }

    .faq-tab.active {
      color: var(--primary);
      border-bottom-color: var(--primary);
    }

    .faq-tab:hover {
      color: var(--primary-dark);
      background-color: #f0f0f0;
    }

    /* Search Bar */
    .search-container {
      position: relative;
    }

    .search-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
    }

    .faq-search-input {
      padding-left: 470px;
      height: 50px;
      font-size: 1rem;
    }

    .faq-search-input:focus {
      box-shadow: 0 0 0 3px rgba(3, 80, 163, 0.2);
      border-color: var(--primary);
    }

    /* Accordion */
    .accordion .accordion-item {
      border: 1px solid #ddd;
      margin-bottom: 10px;
      border-radius: 8px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .accordion .accordion-item:hover {
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      border-color: var(--primary);
    }

    .accordion .accordion-header {
      background: linear-gradient(to right, #f8f9fa, #e9ecef);
      padding: 18px 20px;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      color: #333;
      transition: all 0.3s ease;
    }

    .accordion .accordion-header:hover {
      background: linear-gradient(to right, #e9ecef, #dee2e6);
    }

    .accordion .accordion-content {
      padding: 0 20px;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease-out, padding 0.4s ease-out;
      background-color: #ffffff;
    }

    .accordion .accordion-content.active {
      padding: 20px;
      max-height: 500px;
    }

    .accordion .accordion-header::after {
      content: "\f078";
      /* Font Awesome chevron-down */
      font-family: "Font Awesome 5 Free", "Font Awesome 6 Free";
      font-weight: 900;
      font-size: 1em;
      transition: transform 0.3s ease;
    }

    .accordion .accordion-header.active::after {
      content: "\f077";
      /* Font Awesome chevron-up */
    }

    /* Call to Action (CTA) */
    .cta-section {
      text-align: center;
      padding: 50px 40px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-radius: 12px;
      margin-top: 40px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .cta-section h2 {
      color: #ffffff;
      margin-bottom: 15px;
      font-size: 2.2rem;
      font-weight: 700;
    }

    .cta-section p {
      font-size: 1.1em;
      color: #e0e0e0;
      margin-bottom: 25px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .cta-section .btn {
      display: inline-block;
      background: white;
      color: var(--primary);
      padding: 14px 30px;
      text-decoration: none;
      border-radius: 50px;
      font-size: 1.1em;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .cta-section .btn:hover {
      background: #f0f0f0;
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    /* --- END NEW/UPDATED STYLES --- */

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }

      100% {
        transform: scale(1);
      }
    }

    .animate-fadeIn {
      animation: fadeIn 0.8s ease forwards;
    }

    /* Back to top button */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: var(--primary);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
    }

    .back-to-top.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .back-to-top:hover {
      background: var(--primary-dark);
      transform: translateY(-5px);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
      .container {
        margin: 10px;
        padding: 15px;
      }
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="./index.php" class="flex items-center space-x-3">
        <div class="p-2 rounded-lg">
          <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" loading="lazy"/>
        </div>
        <div>
          <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
          <span class="text-xs text-gray-500" data-lang-key="utycc_full_name">University of Technology (Yatanarpon Cyber
            City)</span>
        </div>
      </a>
      <div class="hidden md:flex items-center space-x-6">
        <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about">About Us</a>
        <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_activity">Activities</a>
        <a href="./exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_examresult">Exam Results</a>

        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <button class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag" class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
              <span id="selected-lang-text-desktop" class="ml-2">မြန်မာ</span>
              <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 pointer-events-none"></i>
            </button>
            <div class="lang-switcher-menu hidden absolute mt-1 w-auto min-w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
              <a href="#" class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="my">
                <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
                <span>မြန်မာ</span>
              </a>
              <a href="#" class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="en">
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
      <br><br>
      <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about_mobile">About Us</a>
      <br><br>
      <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_activity_mobile">Activities</a>
      <br><br>
      <a href="./exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_examresult_mobile">Exam results</a>
      <br><br>
      <div class="relative mt-4 pt-4 border-t">
        <div id="lang-switcher-container-mobile" class="relative">
          <button class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag" class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
            <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
            <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
          </button>
          <div class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="my">
              <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0" loading="lazy">
              <span>မြန်မာ</span>
            </a>
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="en">
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
  </div>

  <header class="mb-12 rounded-3xl overflow-hidden shadow-2xl py-4">
    <div class="relative h-96">
      <img src="../Img/utycc_buildings/lab3.JPG" alt="Hero image of a bustling university campus" class="absolute inset-0 w-full h-full object-cover brightness-75" loading="lazy"/>
      <div class="relative z-10 flex items-center justify-center h-full bg-black bg-opacity-40">
        <div class="text-center text-white p-4 animate-fadeIn">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4" data-lang-key="faq">
            Frequently Asked Questions
          </h1>
          <p class="text-xl" data-lang-key="faq2">
            Find answers to your most common questions below.
          </p>
        </div>
      </div>
    </div>
  </header>
  <br />

  <main class="container mx-auto px-4 pb-20">
    <div class="max-w-4xl mx-auto">
      <div class="mb-8 search-container">
        <!-- <i class="fas fa-search search-icon"></i> -->
        <input type="text" id="faq-search" class=" faq-search-input w-full p-3 border border-gray-300 rounded-lg focus:outline-none" data-lang-key="search_placeholder" placeholder="Search for a question..." />
      </div>

      <div class="faq-tabs flex flex-wrap justify-center mb-8 gap-4 md:gap-8">
        <button class="faq-tab active px-4 py-2 font-semibold text-lg" data-tab="general">
          <i class="fas fa-university mr-2"></i><span data-lang-key="tab_general">General</span>
        </button>
        <button class="faq-tab px-4 py-2 font-semibold text-lg" data-tab="academics">
          <i class="fas fa-book-open mr-2"></i><span data-lang-key="tab_academics">Academics</span>
        </button>
        <button class="faq-tab px-4 py-2 font-semibold text-lg" data-tab="admissions">
          <i class="fas fa-graduation-cap mr-2"></i><span data-lang-key="tab_admissions">Admissions & Graduation</span>
        </button>
      </div>

      <section id="general" class="faq-section animate-fadeIn">
        <div class="accordion">
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q1">In which year was UTYCC founded?</div>
            <div class="accordion-content">
              <p data-lang-key="p1">October 17, 2010</p>
            </div>
          </div>
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q2">What is the address and contact information of UTYCC?</div>
            <div class="accordion-content">
              <p data-lang-key="p2">Address – Yadanapon Cyber City, Pyin Oo Lwin, Mandalay Region<br />Phone – +959445767834<br />Fax – +959445767834<br />Email – hr.admin@utycc.edu.mm</p>
            </div>
          </div>
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q7">Who is the current Rector of UTYCC?</div>
            <div class="accordion-content">
              <p data-lang-key="p7">Dr. Aung Sann Lin (Professor, Rector of UTYCC)</p>
            </div>
          </div>
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q8">What departments support UTYCC students?</div>
            <div class="accordion-content">
              <p data-lang-key="p8">Supporting Departments <br />Maintenance <br />Administration <br />Finance <br />Student Affairs Department <br /><br />Academic Departments <br />Myanmar <br />English <br />Engineering Mathematics <br />Engineering Physics <br />Engineering Chemistry</p>
            </div>
          </div>
        </div>
      </section>

      <section id="academics" class="faq-section animate-fadeIn hidden">
        <div class="accordion">
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q6">What majors are offered at UTYCC?</div>
            <div class="accordion-content">
              <p data-lang-key="p6">B.E. & M.E. <br />Information Science and Technology <br />Computer Engineering <br />Electronics Engineering <br />Precision Engineering <br />Advanced Materials Engineering <br /><br />Ph.D. <br />Information Technology (IT) <br />Electronics Engineering</p>
            </div>
          </div>
        </div>
      </section>

      <section id="admissions" class="faq-section animate-fadeIn hidden">
        <div class="accordion">
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q3">How long is the B.E. (Undergraduate) program and what are the requirements for graduation?</div>
            <div class="accordion-content">
              <p data-lang-key="p3">Duration <br />G10 – 6 years <br />G12 – 5 years <br /><br />Requirements <br />Mini thesis</p>
            </div>
          </div>
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q4">How long is the M.E. (Postgraduate) program and what are the requirements for graduation?</div>
            <div class="accordion-content">
              <p data-lang-key="p4">Duration <br />2 years (1 year coursework + 1 year thesis)<br /><br />Requirements <br />Thesis</p>
            </div>
          </div>
          <div class="accordion-item">
            <div class="accordion-header" data-lang-key="q5">How long is the Ph.D. (IT) program and what are the requirements for graduation?</div>
            <div class="accordion-content">
              <p data-lang-key="p5">Duration <br />3 years (1 year coursework + 2 years dissertation )<br /><br />Requirements <br />Dissertation</p>
            </div>
          </div>
        </div>
      </section>
      
      <div id="no-results" class="text-center text-gray-500 my-8 hidden" data-lang-key="no_results">
          No matching questions found.
      </div>
    </div>

    <section id="contact" class="cta-section mt-16 animate-fadeIn">
      <h2 data-lang-key="ca1">Still Can't Find Your Answer?</h2>
      <p data-lang-key="ca2">Our team is here to help! Reach out to us directly for personalized assistance.</p>
      <a href="./Rform/feedback.php" class="btn" data-lang-key="ca3">Contact Support</a>
    </section>
  </main>

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
        </div>
      </div>
      <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300" data-lang-key="footer_copyright">
        © 2025 University of Technology - Yatanarpon Cyber City. All
        Rights Reserved.
      </div>
    </div>
  </footer>

  <div class="back-to-top">
    <i class="fas fa-arrow-up"></i>
  </div>

  <script>
    // --- UPDATED JAVASCRIPT ---
    document.addEventListener("DOMContentLoaded", () => {
      // --- Mobile Menu and Back to Top Button (No changes) ---
      const mobileMenuButton = document.getElementById("mobile-menu-button");
      const mobileMenu = document.getElementById("mobile-menu");
      mobileMenuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
      });

      const backToTopButton = document.querySelector(".back-to-top");
      window.addEventListener("scroll", () => {
        if (window.pageYOffset > 300) {
          backToTopButton.classList.add("visible");
        } else {
          backToTopButton.classList.remove("visible");
        }
      });
      backToTopButton.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });

      // --- Accordion Functionality (No changes) ---
      document.querySelectorAll(".accordion-header").forEach((header) => {
        header.addEventListener("click", () => {
          const accordionContent = header.nextElementSibling;
          header.classList.toggle("active");
          accordionContent.classList.toggle("active");

          document.querySelectorAll(".accordion-content").forEach((item) => {
            if (item !== accordionContent && item.classList.contains("active")) {
              item.classList.remove("active");
              item.previousElementSibling.classList.remove("active");
            }
          });
        });
      });
      
      // --- NEW: FAQ Tabs Functionality ---
      const tabs = document.querySelectorAll(".faq-tab");
      const sections = document.querySelectorAll(".faq-section");

      tabs.forEach(tab => {
        tab.addEventListener("click", () => {
          tabs.forEach(item => item.classList.remove("active"));
          tab.classList.add("active");
          
          const target = tab.getAttribute("data-tab");
          sections.forEach(section => {
            if(section.id === target){
              section.classList.remove("hidden");
            } else {
              section.classList.add("hidden");
            }
          });
        });
      });

      // --- NEW: Live Search Functionality ---
      const searchInput = document.getElementById("faq-search");
      const allFaqItems = document.querySelectorAll(".accordion-item");
      const noResultsMessage = document.getElementById("no-results");

      searchInput.addEventListener("keyup", (e) => {
        const searchTerm = e.target.value.toLowerCase();
        let resultsFound = 0;

        allFaqItems.forEach(item => {
          const question = item.querySelector(".accordion-header").textContent.toLowerCase();
          const answer = item.querySelector(".accordion-content").textContent.toLowerCase();
          
          if(question.includes(searchTerm) || answer.includes(searchTerm)){
            item.style.display = "block";
            resultsFound++;
          } else {
            item.style.display = "none";
          }
        });
        
        // If searching, show all sections to display results from all categories
        if(searchTerm) {
          sections.forEach(section => section.classList.remove('hidden'));
          tabs.forEach(tab => tab.classList.remove('active')); // Deactivate tabs during search
        } else {
          // If search is cleared, reset to the default tab view
          tabs[0].click(); 
        }

        // Show 'no results' message if needed
        if (resultsFound === 0) {
            noResultsMessage.classList.remove('hidden');
        } else {
            noResultsMessage.classList.add('hidden');
        }
      });
    });

    // --- Translation Script (Updated with new keys) ---
    const translations = {
      my: {
        faq: "အမေးများသော မေးခွန်းများ",
        faq2: "အောက်တွင် အများဆုံးမေးလေ့ရှိသော မေးခွန်းများကို ရှာဖွေပါ။",
        p8: "အထောက်အပံ့ဌာနများ<br>စောင့်ရှောက်ထိန်းသိမ်း ရေးဌာန၊<br>အုပ်ချုပ်ရေးဌာန၊<br>ငွေကြေးဌာန၊<br>ကျောင်းသားရေးရာဌာန<br><br>သင်ကြားရေးဌာနများ<br>မြန်မာစာဌာန၊<br>အင်္ဂလိပ်စာဌာန၊<br>အင်ဂျင်နီယာသင်္ချာဌာန၊<br>အင်ဂျင်နီယာရူပဗေဒဌာန၊<br>အင်ဂျင်နီယာဓာတုဗေဒဌာန",
        q8: "ကျောင်းသား/သူများကို ထောက်ပံ့‌ကူညီပေးသော ဌာနများက ဘာတွေလဲ။",
        p7: "ဒေါက်တာအောင်ဆန်းလင်း (ပါမောက္ခ၊ ပါမောက္ခချုပ်)",
        q7: "လက်ရှိ ပါမောက္ခချုပ်က ဘယ်သူလဲ။",
        p6: "B.E. & M.E.<br>သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာ<br>ကွန်ပျူတာအင်ဂျင်နီယာ<br>အီလက်ထရောနစ်အင်ဂျင်နီယာ<br>တိကျစက်မှု အင်ဂျင်နီယာ<br>အဆင့်မြင့်ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ<br><br>Ph.D.<br>သတင်းအချက်အလက်နည်းပညာ (IT)<br>အီလက်ထရောနစ်အင်ဂျင်နီယာ",
        q6: "UTYCC တွင် မည်သည့်မေဂျာများ တက်ရောက်နိုင်သနည်း။",
        p5: "သင်တန်းကြာချိန်<br>၃ နှစ် (၁ နှစ် သင်တန်း + ၂ နှစ် စာတမ်း)<br><br>လိုအပ်ချက်<br>စာတမ်း",
        q5: "Ph.D. (IT) သင်တန်းက ဘယ်လောက်ကြာပါသလဲ၊ ဘွဲ့ရရန် ဘာတွေလိုအပ်ပါသလဲ။",
        p4: "သင်တန်းကြာချိန်<br>၂ နှစ် (၁ နှစ် သင်တန်း + ၁ နှစ် ကျမ်း)<br><br>လိုအပ်ချက်<br>ကျမ်း",
        q4: "M.E. (ဘွဲ့လွန်) သင်တန်းက ဘယ်လောက်ကြာပါသလဲ၊ ဘွဲ့ရရန် ဘာတွေလိုအပ်ပါသလဲ။",
        p3: "သင်တန်းကြာချိန်<br>G10 – ၆ နှစ်<br>G12 – ၅ နှစ်<br><br>လိုအပ်ချက်<br>အသေးစား ကျမ်း",
        q3: "B.E. (ဘွဲ့ကြို) သင်တန်းက ဘယ်လောက်ကြာပါသလဲ၊ ဘွဲ့ရရန် ဘာတွေလိုအပ်ပါသလဲ။",
        p2: "လိပ်စာ – ရတနာပုံဆိုက်ဘာစီးတီး၊ ပြင်ဦးလွင်၊ မန္တလေးတိုင်းဒေသကြီး<br>ဖုန်း – +၉၅၉၄၄၅၇၆၇၈၃၄<br>ဖက်စ် – +၉၅၉၄၄၅၇၆၇၈၃၄<br>အီးမေးလ် – hr.admin@utycc.edu.mm",
        q2: "UTYCC ၏ လိပ်စာနှင့် ဆက်သွယ်ရန် အချက်အလက်များက ဘာတွေလဲ။",
        p1: "၂၀၁၀ ခုနှစ်၊ အောက်တိုဘာလ ၁၇ ရက်",
        q1: "UTYCC ကို ဘယ်ခုနှစ်မှာ တည်ထောင်ခဲ့ပါသလဲ။",
        utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊ ပြင်ဦးလွင်မြို့အနီး၊ မန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
        footer_faculties_title: "မဟာဌာနများ",
        footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
        footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
        footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
        footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
        footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
        footer_follow_title: "Follow Us",
        footer_copyright: "© ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များ ရယူပြီး။",
        footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
        footer_link_terms: "စည်းမျဉ်းများ နှင့် မူဝါဒများ",
        footer_link_faq: "အမေးများသော မေးခွန်းများ",
        footer_link_about: "ကျွန်ုပ်တို့အကြောင်း",
        footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
        ca1: "သင်၏ အဖြေကို ရှာမတွေ့သေးဘူးလား။",
        ca2: "ကျွန်ုပ်တို့၏အဖွဲ့သည် ကူညီရန် အသင့်ရှိပါသည်။ တစ်ဦးချင်းအကူအညီအတွက် ကျွန်ုပ်တို့ထံ တိုက်ရိုက်ဆက်သွယ်ပါ။",
        ca3: "အကူအညီရယူရန်",
        search_placeholder: "မေးခွန်းများကို ရှာဖွေပါ...",
        tab_general: "အထွေထွေ",
        tab_academics: "ပညာရေး",
        tab_admissions: "ဝင်ခွင့်နှင့် ဘွဲ့",
        no_results: "ကိုက်ညီသောမေးခွန်းများ မတွေ့ပါ။"
      },
      en: {
        faq: "Frequently Asked Questions",
        faq2: "Find answers to your most common questions below.",
        p8: "Supporting Departments<br>Maintenance<br>Administration<br>Finance<br>Student Affairs Department<br><br>Academic Departments<br>Myanmar<br>English<br>Engineering Mathematics<br>Engineering Physics<br>Engineering Chemistry",
        q8: "What departments support UTYCC students?",
        p7: "Dr. Aung Sann Lin (Professor, Rector of UTYCC)",
        q7: " Who is the current Rector of UTYCC?",
        p6: "B.E. & M.E.<br>Information Science and Technology<br>Computer Engineering<br>Electronics Engineering<br>Precision Engineering<br>Advanced Materials Engineering<br><br>Ph.D.<br>Information Technology (IT)<br>Electronics Engineering",
        q6: " What majors are offered at UTYCC?",
        p5: "Duration<br>3 years (1 year coursework + 2 years dissertation)<br><br>Requirements<br>Dissertation",
        q5: " How long is the Ph.D. (IT) program and what are the requirements for graduation?",
        p4: "Duration<br>2 years (1 year coursework + 1 year thesis)<br><br>Requirements<br>Thesis",
        q4: " How long is the M.E. (Postgraduate) program and what are the requirements for graduation?",
        p3: "Duration<br>G10 – 6 years<br>G12 – 5 years<br><br>Requirements<br>Mini thesis",
        q3: "How long is the B.E. (Undergraduate) program and what are the requirements for graduation?",
        p2: "Address – Yadanapon Cyber City, Pyin Oo Lwin, Mandalay Region<br>Phone – +959445767834<br>Fax – +959445767834<br>Email – hr.admin@utycc.edu.mm",
        q2: "What is the address and contact information of UTYCC?",
        p1: "October 17, 2010",
        q1: "In which year was UTYCC founded?",
        utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
        nav_about: "About Us",
        nav_activity: "Activities",
        nav_examresult: "Exam Results",
        footer_address: "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
        footer_faculties_title: "Faculties",
        footer_faculty_ist: "Information Science Technology",
        footer_faculty_ce: "Computer Engineering",
        footer_faculty_ece: "Electronics Engineering",
        footer_faculty_ame: "Advanced Materials Engineering",
        footer_faculty_pre: "Precision Engineering",
        footer_follow_title: "Follow Us",
        footer_copyright: "© 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
        footer_quick_links_title: "Quick Links",
        footer_link_terms: "Terms & Policies",
        footer_link_faq: "FAQs",
        footer_link_about: "About Us",
        footer_link_rules: "Rules & Regulations",
        footer_link_dp: "Data Protection",
        ca1: "Still Can't Find Your Answer?",
        ca2: "Our team is here to help! Reach out to us directly for personalized assistance.",
        ca3: "Contact Support",
        search_placeholder: "Search for a question...",
        tab_general: "General",
        tab_academics: "Academics",
        tab_admissions: "Admissions & Graduation",
        no_results: "No matching questions found."
      },
    };

    // Language switching functionality (No changes to this part)
    const setLanguage = (lang) => {
        localStorage.setItem("language", lang);
        document.documentElement.lang = lang;

        // Update main dropdowns
        const desktopSwitcher = document.getElementById("language-switcher-desktop");
        const mobileSwitcher = document.getElementById("language-switcher-mobile");
        if (desktopSwitcher) desktopSwitcher.value = lang;
        if (mobileSwitcher) mobileSwitcher.value = lang;

        // Translate elements
        document.querySelectorAll("[data-lang-key]").forEach(element => {
            const key = element.getAttribute("data-lang-key");
            if (translations[lang] && translations[lang][key]) {
                 if (element.tagName === 'INPUT' && element.hasAttribute('placeholder')) {
                    element.placeholder = translations[lang][key];
                } else {
                    element.innerHTML = translations[lang][key];
                }
            }
        });

        // Update custom dropdown UI
        const flagSrc = lang === 'my' ? 'https://flagcdn.com/w20/mm.png' : 'https://flagcdn.com/w20/gb.png';
        const langText = lang === 'my' ? 'မြန်မာ' : 'English';
        
        document.getElementById('selected-lang-flag-desktop').src = flagSrc;
        document.getElementById('selected-lang-text-desktop').textContent = langText;
        document.getElementById('selected-lang-flag-mobile').src = flagSrc;
        document.getElementById('selected-lang-text-mobile').textContent = langText;
    };

    // Initialize with saved language or default
    const savedLang = localStorage.getItem("language") || "en";
    setLanguage(savedLang);

    // Event listeners for custom dropdowns
    document.querySelectorAll('.lang-switcher-button').forEach(button => {
        button.addEventListener('click', () => {
            const menu = button.nextElementSibling;
            menu.classList.toggle('hidden');
        });
    });

    document.querySelectorAll('.lang-switcher-option').forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            const lang = option.getAttribute('data-lang');
            setLanguage(lang);
            const menu = option.parentElement;
            menu.classList.add('hidden');
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
      if (!e.target.closest('[id^="lang-switcher-container-"]')) {
        document.querySelectorAll('.lang-switcher-menu').forEach(menu => {
          menu.classList.add('hidden');
        });
      }
    });

  </script>
</body>

</html>