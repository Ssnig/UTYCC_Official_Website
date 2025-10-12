<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./CSS/star-layout.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="./CSS/footer.css" />
    <script src="./JS/star-layout.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Activities - Yatanarpon Cyber City (UTYCC)</title>
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="./CSS/hero-carousel.css" />
    <script src="./JS/hero-carousel.js"></script>
    <link rel="stylesheet" href="CSS/font.css" />
    <!-- GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <style>
      body {
        font-family: "Inter", sans-serif;
        background-color: #f3f4f6;
      }

      @keyframes float {

        0%,
        100% {
          transform: translateY(0);
        }

        50% {
          transform: translateY(-10px);
        }
      }

      .floating-icon {
        animation: float 3s ease-in-out infinite;
      }

      .activity-card {
        transition: all 0.3s ease;
        transform-origin: top center;
      }

      .activity-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }

      .club-card {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
      }

      .club-card:hover {
        transform: translateX(5px);
        border-left-color: #3b82f6;
      }

      .river-wrapper {
        position: relative;
        padding: 80px 0;
        margin-bottom: 4rem;
      }

      .river-background {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
      }

      .river-background::before,
      .river-background::after {
        content: "";
        position: absolute;
        border-radius: 9999px;
        filter: blur(0.5px);
        opacity: 0.7;
        background: linear-gradient(135deg, rgba(191, 219, 254, 0.65), rgba(59, 130, 246, 0.45));
      }

      .river-background::before {
        width: min(1200px, 90vw);
        height: clamp(160px, 28vw, 240px);
      }

      .river-background::after {
        width: min(1000px, 75vw);
        height: clamp(120px, 20vw, 200px);
        transform: rotate(-3deg);
        background: linear-gradient(135deg, rgba(96, 165, 250, 0.35), rgba(30, 64, 175, 0.4));
      }

      .river-carousel {
        position: relative;
        width: min(1200px, 92vw);
        height: clamp(200px, 32vw, 280px);
        margin: 0 auto;
        overflow: hidden;
        --river-duration: 40s;
      }

      .river-carousel::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 50% 50%, rgba(191, 219, 254, 0.35), transparent 65%);
        filter: blur(5px);
        z-index: 0;
      }

      .river-track {
        position: absolute;
        top: 50%;
        left: 0;
        display: flex;
        gap: clamp(1rem, 2vw, 1.75rem);
        padding-right: clamp(1rem, 2vw, 1.75rem);
        transform: translate(0, -50%);
        animation: river-scroll var(--river-duration) linear infinite;
        will-change: transform;
        z-index: 1;
      }

      .river-item {
        flex: 0 0 clamp(140px, 16vw, 200px);
        height: clamp(105px, 12vw, 150px);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 15px 40px -18px rgba(15, 23, 42, 0.55);
        background-size: cover;
        background-position: center;
        position: relative;
      }

      .river-item::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0) 45%, rgba(15, 23, 42, 0.35));
        opacity: 0;
        transition: opacity 0.3s ease;
      }

      .river-item:hover::after {
        opacity: 1;
      }

      @keyframes river-scroll {
        from {
          transform: translate(0, -50%);
        }
        to {
          transform: translate(-50%, -50%);
        }
      }
      
      /* Modal styles */
      .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
      }

      .modal-overlay.active {
        opacity: 1;
        pointer-events: all;
      }

      .modal-content {
        background-color: white;
        border-radius: 0.5rem;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        transform: translateY(20px);
        transition: transform 0.3s ease;
      }

      .modal-overlay.active .modal-content {
        transform: translateY(0);
      }

      .close-modal {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #6b7280;
      }

      .close-modal:hover {
        color: #374151;
      }

      /* Animation Classes */
      @keyframes fadeIn {
        from {
          opacity: 0;
        }

        to {
          opacity: 1;
        }
      }

      @keyframes slideIn {
        from {
          transform: translateY(20px);
          opacity: 0;
        }

        to {
          transform: translateY(0);
          opacity: 1;
        }
      }

      .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
      }

      .animate-slide-in {
        animation: slideIn 0.5s ease-out forwards;
      }
      
      /* Space between content and footer */
      .content-before-footer {
        padding-bottom: 5rem; /* Added space between content and footer */
      }

      /* Pinterest-style gallery */
      .pinterest-gallery {
        column-count: 1;
        column-gap: 1.5rem;
      }

      @media (min-width: 640px) {
        .pinterest-gallery {
          column-count: 2;
        }
      }

      @media (min-width: 1024px) {
        .pinterest-gallery {
          column-count: 3;
        }
      }

      @media (min-width: 1280px) {
        .pinterest-gallery {
          column-count: 4;
        }
      }

      .gallery-item {
        break-inside: avoid;
        margin-bottom: 1.5rem;
      }

      .gallery-card {
        position: relative;
        display: block;
        overflow: hidden;
        border-radius: 1.25rem;
        background-color: #ffffff;
        box-shadow: 0 18px 45px -25px rgba(15, 23, 42, 0.45);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
      }

      .gallery-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 50px -25px rgba(30, 64, 175, 0.45);
      }

      .gallery-image {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.6s ease;
      }

      .gallery-card:hover .gallery-image {
        transform: scale(1.05);
      }

      .gallery-meta {
        padding: 1.25rem 1.5rem 1.5rem;
      }

      .gallery-meta h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e3a8a;
        margin-bottom: 0.35rem;
      }

      .gallery-meta p {
        font-size: 0.9rem;
        color: #4b5563;
        line-height: 1.45;
      }

      .gallery-tag {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(30, 64, 175, 0.85);
        color: #fff;
        font-size: 0.7rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 0.35rem 0.75rem;
        border-radius: 9999px;
        font-weight: 600;
      }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

      @media (max-width: 768px) {
        .content-before-footer {
          padding-bottom: 3rem;
        }
      }
    </style>
  </head>

  <body class="bg-gray-100">
    <!-- Header and Navigation -->
    <div class="bg-white shadow-md sticky top-0 z-50">
      <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
        <!-- Logo -->
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
        
        <!-- Desktop Navigation & Actions -->
        <div class="hidden md:flex items-center space-x-6">
          <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about">About Us</a>
          <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_activity">Activities</a>
          <a href="/Rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_examresult">Exam Results</a>
          
          <!-- Language Switcher - Desktop -->
          <div class="relative ml-4">
              <div id="lang-switcher-container-desktop">
                  <button class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
                      <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/gb.png" alt="Selected Flag" class="h-4 w-6 object-cover flex-shrink-0" loading="lazy">
                      <span id="selected-lang-text-desktop" class="ml-2">English</span>
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
              <select id="language-switcher" class="hidden">
                  <option value="my">မြန်မာ</option>
                  <option value="en" selected>English</option>
              </select>
          </div>
        </div>
        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-blue-900">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </nav>
      
      <!-- Mobile Menu -->
      <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
          <div class="flex flex-col space-y-4 py-4">
              <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about_mobile">About Us</a>
              <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_activity_mobile">Activities</a>
              <a href="/Rform/examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_examresult_mobile">Exam Results</a>
          </div>

        <!-- Language Switcher - Mobile -->
        <div class="relative pt-4 border-t">
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
              <option value="my" selected>မြန်မာ</option>
              <option value="en">English</option>
          </select>
        </div>
      </div>
    </div>
    
    <!-- Main content container -->
    <main class="container mx-auto px-4 content-before-footer py-12">
      <!-- Activities Section -->
      <section class="mb-16" id="about">
        <h1 class="text-4xl font-bold text-center text-blue-800 mb-2" data-lang-key="activities_title">University Activities</h1>
        <p class="text-xl text-center text-gray-600 mb-8" data-lang-key="activities_subtitle">Explore our vibrant campus life</p>
        
        <!-- Pinterest Gallery Section -->
        <section id="campus-gallery" class="mb-16 animate-section">
          <div class="pinterest-gallery" id="pinterest-gallery-container">
            <!-- Dynamic content will be injected here -->
            <div class="loader-container col-span-full flex justify-center items-center h-64">
                <div class="loader"></div>
            </div>
          </div>
        </section>

        <!-- River Carousel Section -->
        <section class="mb-20" id="river-carousel-section">
          <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="inline-block uppercase tracking-[0.3em] text-xs text-blue-600 font-semibold mb-3" data-lang-key="gallery_section_label">Featured Moments</span>
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3" data-lang-key="gallery_section_title">Glide Through Campus Life</h2>
            <p class="text-gray-600 text-base md:text-lg" data-lang-key="gallery_section_description">
              Drift along a ribbon of highlights featuring activities, labs, and daily life at UTYCC. Watch the snapshots flow by like a river weaving through our community.
            </p>
          </div>
          <div class="river-wrapper">
            <div class="river-background" aria-hidden="true"></div>
            <div class="river-carousel" id="riverCarousel" role="list"></div>
          </div>
        </section>

        <!-- Activities Grid -->
        <section id="programs">
          <h2 class="text-3xl font-bold text-center text-gray-800 mb-12" data-lang-key="academic_programs">Academic Programs</h2>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-6">
            <!-- Academic Activities -->
            <div class="activity-card bg-white p-6 rounded-lg shadow-lg">
              <div class="text-blue-600 mb-4 floating-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-center mb-3" data-lang-key="academic">Academic Excellence</h3>
              <p class="text-gray-600 text-center" data-lang-key="research">Research symposiums, hackathons, and
                interdisciplinary projects that challenge minds.</p>
              <div class="mt-4 text-center">
                <button class="learn-more-btn text-blue-600 hover:text-blue-800 font-medium" data-category="academic" data-lang-key="learn_more">Learn
                  more →</button>
              </div>
            </div>

            <!-- Cultural Activities -->
            <div class="activity-card bg-white p-6 rounded-lg shadow-lg">
              <div class="text-blue-600 mb-4 floating-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-center mb-3" data-lang-key="cultural_events">Cultural Events</h3>
              <p class="text-gray-600 text-center" data-lang-key="cultural_desc">Celebrate diversity with our international festivals, performances, and
                exhibitions.</p>
              <div class="mt-4 text-center">
                <button class="learn-more-btn text-blue-600 hover:text-blue-800 font-medium" data-category="cultural" data-lang-key="learn_more">Learn
                  more →</button>
              </div>
            </div>

            <!-- Sports Activities -->
            <div class="activity-card bg-white p-6 rounded-lg shadow-lg">
              <div class="text-blue-600 mb-4 floating-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
              <h3 class="text-xl font-semibold text-center mb-3" data-lang-key="sports">Athletics & Sports</h3>
              <p class="text-gray-600 text-center" data-lang-key="sports_desc">Join our competitive teams or recreational leagues to stay active and
                build teamwork.</p>
              <div class="mt-4 text-center">
                <button class="learn-more-btn text-blue-600 hover:text-blue-800 font-medium" data-category="sports" data-lang-key="learn_more">Learn
                  more →</button>
              </div>
            </div>
          </div>
        </section>
      </section>
    </main>
    
    <!-- Modals and Notifications -->

    <!-- Clubs Modal -->
    <div class="modal-overlay" id="clubsModal">
      <div class="modal-content">
        <button class="close-modal">&times;</button>
        <div class="p-6">
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800" id="modalTitle">Academic Clubs</h3>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="clubsContainer">
            <!-- Clubs will be inserted here by JavaScript -->
          </div>
        </div>
      </div>
    </div>
    
    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-5 right-5 bg-blue-600 text-white py-3 px-5 rounded-lg shadow-lg transition-transform transform translate-y-20 opacity-0 duration-300 ease-out z-[1100]">
      <p id="toast-message"></p>
    </div>

    <!-- Footer Section -->
    <footer id="contact" class="bg-blue-900 text-white">
      <div class="container mx-auto px-6 py-12">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" loading="lazy"/>
            <h3 class="text-lg font-bold">UTYCC</h3>
            <p class="text-blue-200 text-sm mt-4">
              <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
                Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay
                Region, Myanmar
              </a>
            </p>
            <div class="mt-4 text-sm text-blue-200">
                <a href="mailto:utyccstudentaffair2010@gmail.com">Email: utyccstudentaffair2010@gmail.com</a><br/>
                <a href="tel:+959445767834">Phone: +959445767834 </a>
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
              <li><a data-lang-key="footer_faculty_pre" href="./Majors/pre.php">Precision Engineering</a></li>
              <li><a data-lang-key="footer_faculty_ame" href="./Majors/ame.php">
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
              <a href="https://mm.linkedin.com/school/university-of-technology-yatanarpon-cyber-city/" class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
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
      // --- DATA --- //
      
      // Store all gallery photos fetched from API
      let allGalleryPhotos = [];

      const clubsData = {
        academic: {
          title: { en: "Academic Clubs & Activities", my: "ပညာရေး ကလပ်များနှင့် လှုပ်ရှားမှုများ" },
          clubs: [
            { name: { en: "Computer Science Club", my: "ကွန်ပျူတာသိပ္ပံ ကလပ်" }, description: { en: "For students interested in programming, algorithms, and software development.", my: "ပရိုဂရမ်ရေးသားခြင်း၊ အယ်လ်ဂိုရီသမ်းများနှင့် ဆော့ဖ်ဝဲဖွံ့ဖြိုးရေးတို့ကို စိတ်ဝင်စားသော ကျောင်းသားများအတွက်" }, meeting: { en: "Every Tuesday, 4pm, Main Building Room", my: "အင်္ဂါနေ့တိုင်း ညနေ ၄နာရီ၊ အဓိကအဆောက်အဦး အခန်း" } },
            { name: { en: "Engineering Society", my: "အင်ဂျင်နီယာအသင်း" }, description: { en: "Open to all engineering students with workshops and guest lectures.", my: "အင်ဂျင်နီယာကျောင်းသားအားလုံးအတွက် ပွဲဦးထွက်သင်တန်းများနှင့် အထူးဟောပြောပွဲများဖြင့် ဖွင့်လှစ်ထားသည်။" }, meeting: { en: "Every Wednesday, 5pm, Engineering Hall", my: "ဗုဒ္ဓဟူးနေ့တိုင်း ညနေ ၅နာရီ၊ အင်ဂျင်နီယာခန်းမ" } },
            { name: { en: "Math Circle", my: "သင်္ချာအသင်း" }, description: { en: "Explore advanced mathematical concepts beyond the classroom.", my: "စာသင်ခန်းပြင်ပမှ အဆင့်မြင့်သင်္ချာအယူအဆများကို စူးစမ်း လေ့လာပါ။" }, meeting: { en: "Every Friday, 4pm, Main Building Room", my: "သောကြာနေ့တိုင်း ညနေ ၄နာရီ၊ အဓိကအဆောက်အဦး အခန်း" } },
          ]
        },
        cultural: {
          title: { en: "Cultural Clubs & Events", my: "ယဉ်ကျေးမှု ကလပ်များနှင့် ပွဲများ" },
          clubs: [
            { name: { en: "International Students Association", my: "နိုင်ငံတကာကျောင်းသားအသင်း" }, description: { en: "Celebrating cultural diversity with events and food festivals.", my: "ပွဲများနှင့် အစားအသောက်ပွဲတော်များဖြင့် ယဉ်ကျေးမှုကွဲပြားမှုကို ဂုဏ်ပြုခြင်း။" }, meeting: { en: "First Friday of each month, 5pm, Student Hall", my: "လအစသောကြာနေ့တိုင်း ညနေ ၅နာရီ၊ ကျောင်းသားခန်းမ" } },
            { name: { en: "Film Society", my: "ရုပ်ရှင်အသင်း" }, description: { en: "Weekly screenings and discussions of international cinema.", my: "နိုင်ငံတကာရုပ်ရှင်များ၏ အပတ်စဉ်ပြသခြင်းနှင့် ဆွေးနွေးပွဲများ။" }, meeting: { en: "Every Thursday, 7pm, Arts Building Theater", my: "ကြာသပတေးနေ့တိုင်း ည ၇နာရီ၊ အနုပညာအဆောက်အဦး ရုံး" } },
            { name: { en: "Music Club", my: "ဂီတကလပ်" }, description: { en: "To reduce stress and to keep happy at University life", my: "တက္ကသိုလ်ဘဝတွင် စိတ်ဖိစီးမှုလျှော့ချရန်နှင့် ပျော်ရွှင်စေရန်" }, meeting: { en: "Every Wednesday, 4pm, Lecture Hall 4", my: "ဗုဒ္ဓဟူးနေ့တိုင်း ညနေ ၄နာရီ၊ ပို့ချခန်း ၄" } },
            { name: { en: "Dance Troupe", my: "အကအဖွဲ့" }, description: { en: "Learn and perform traditional dances from around the world.", my: "ကမ္ဘာတစ်ဝှမ်းမှ ရိုးရာအကများကို လေ့လာခြင်းနှင့် ဖျော်ဖြေခြင်း။" }, meeting: { en: "Every Tuesday & Thursday, 4:30pm, Lecture Hall 4", my: "အင်္ဂါနှင့် ကြာသပတေးနေ့တိုင်း ညနေ ၄:၃၀နာရီ၊ ပို့ချခန်း ၄" } }
          ]
        },
        sports: {
          title: { en: "Sports Teams & Activities", my: "အားကစားအသင်းများနှင့် လှုပ်ရှားမှုများ" },
          clubs: [
            { name: { en: "Basketball Team", my: "ဘတ်စကက်ဘောအသင်း" }, description: { en: "Competitive team playing in inter-university leagues.", my: "တက္ကသိုလ်ချင်းဆိုင်ရာ လိဂ်များတွင် ပြိုင်ပွဲဝင်အသင်း။" }, meeting: { en: "Monday/Wednesday/Friday, 6:30am, Beside Hall", my: "တနင်္လာ/ဗုဒ္ဓဟူး/သောကြာနေ့တိုင်း မနက် ၆:၃၀နာရီ၊ ခန်းမဘေး" } },
            { name: { en: "Badminton Club", my: "ကြက်တောင်ရိုက် ကလပ်" }, description: { en: "Beginner to advanced Badminton for all students.", my: "ကျောင်းသားအားလုံးအတွက် အခြေခံမှ အဆင့်မြင့်အထိ ကြက်တောင်ရိုက်။" }, meeting: { en: "Daily, 7am and 5pm, Wellness Center", my: "နေ့တိုင်း မနက် ၇နာရီနှင့် ညနေ ၅နာရီ၊ ကျန်းမာရေးစင်တာ" } },
            { name: { en: "Football Club", my: "ဘောလုံးကလပ်" }, description: { en: "Group runs and training for football.", my: "ဘောလုံးအတွက် အသုတ်လိုက်ပြေးခြင်းနှင့် လေ့ကျင့်ခြင်း။" }, meeting: { en: "Tuesday/Thursday, 6am, Main Gate", my: "အင်္ဂါ/ကြာသပတေးနေ့တိုင်း မနက် ၆နာရီ၊ အဓိကတံခါး" } },
            { name: { en: "E-sport Club", my: "အီးစပို့ကလပ်" }, description: { en: "To improve team work and skill and more friendly", my: "အသင်းအဖွဲ့လုပ်ဆောင်မှုနှင့် ကျွမ်းကျင်မှုတိုးတက်စေ ရန် နှင့် ပိုမိုခင်မင်ရင်း နှီးစေ ရန်" }, meeting: { en: "Saturday mornings, 9am, At Hall", my: "စနေနေ့မနက်ပိုင်းတိုင်း မနက် ၉နာရီ၊ ခန်းမ၌" } }
          ]
        }
      };

      const translations = {
        my: {
          utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)", nav_about: "ကျွန်ုပ်တို့အကြောင်း", nav_activity: "လှုပ်ရှားမှုများ", nav_examresult: "အောင်စာရင်းများ",
          footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ", footer_faculties_title: "မဟာဌာနများ", footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
          footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ", footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ", footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစင့်ည်း အင်ဂျင်နီယာ", footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
          footer_contact_title: "ဆက်သွယ်ရန်", footer_follow_title: "Follow Us", footer_copyright: "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။", footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
          footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ", footer_link_faq: "အမေးများသော မေးခွန်းများ", footer_link_about: "ကျွန်ုပ်တို့အကြောင်း", footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
          activities_title: "တက္ကသိုလ် လှုပ်ရှားမှုများ", activities_subtitle: "ကျွန်ုပ်တို့၏ စိတ်လှုပ်ရှားဖွယ် ကမ့်ပပ်ဘဝကို စူးစမ်း လေ့လာပါ", academic_programs: "ပညာရေး အစီအစဉ်များ", academic: "ပညာရေး ထူးချွန်မှု",
          research: "စိတ်ကိုစိန်ခေါ်သော သုတေသနဆွေးနွေးပွဲများ၊ ဟက်ကာသွန်များနှင့် ဘာသာရပ်စုံ ပရောဂျက်များ", cultural_events: "ယဉ်ကျေးမှုပွဲများ", cultural_desc: "ကျွန်ုပ်တို့၏ နိုင်ငံတကာပွဲတော်များ၊ ဖျော်ဖြေပွဲများနှင့် ပြပွဲများဖြင့် ကွဲပြားမှုများကို ဂုဏ်ပြုပါ",
          sports: "အားကစားနှင့် ကစားကွင်းများ", sports_desc: "တက်ကြွစွာနေထိုင်ရန်နှင့် အသင်းအဖွဲ့ငယ်များ တည်ဆောက်ရန် ကျွန်ုပ်တို့၏ ပြိုင်ပွဲအသင်းများ သို့မဟုတ် ပျော်ပွဲစားလိဂ်များတွင် ပါဝင်ပါ", learn_more: "ပိုမိုလေ့လာရန် →", footer_link_dp: "ဒေတာကာကွယ်ရေး",
          nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
          nav_activity_mobile: "လှုပ်ရှားမှုများ",
          nav_examresult_mobile: "အောင်စာရင်းများ",
          gallery_section_label: "အထူးပြသထားသော အခိုက်အတန့်များ",
          gallery_section_title: "တက္ကသိုလ်ဘဝကို ဖြတ်သန်းကြည့်ရှုခြင်း",
          gallery_section_description: "UTYCC ရှိ လှုပ်ရှားမှုများ၊ လက်တွေ့ခန်းများနှင့် နေ့စဉ်ဘဝများကို မြင်တွေ့နိုင်သော ပုံရိပ်များကို ကြည့်ရှုလိုက်ပါ။ ကျွန်ုပ်တို့၏ အသိုက်အဝန်းကို ဖြတ်သန်းစီးဆင်းနေသော မြစ်တစ်စင်းကဲ့သို့ ပုံရိပ်များကို ကြည့်ရှုလိုက်ပါ။",
          gallery_tag_campus: "တက္ကသိုလ်ဧရိယာ",
          gallery_tag_community: "လူ့အသိုင်းအဝိုင်း",
          gallery_tag_innovation: "တီထွင်မှု",
          gallery_tag_events: "ပွဲများ",
        },
        en: {
          utycc_full_name: "University of Technology (Yatanarpon Cyber City)", nav_about: "About Us", nav_activity: "Activities", nav_examresult: "Exam Results",
          footer_address: "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar", footer_faculties_title: "Faculties", footer_faculty_ist: "Information Science Technology",
          footer_faculty_ce: "Computer Engineering", footer_faculty_ece: "Electronics Engineering", footer_faculty_ame: "Advanced Materials Engineering", footer_faculty_pre: "Precision Engineering",
          footer_contact_title: "Contact Us", footer_follow_title: "Follow Us", footer_copyright: "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.", footer_quick_links_title: "Quick Links",
          footer_link_terms: "Terms & Policies", footer_link_faq: "FAQs", footer_link_about: "About Us", footer_link_rules: "Rules & Regulations",
          activities_title: "University Activities", activities_subtitle: "Explore our vibrant campus life", academic_programs: "Academic Programs", academic: "Academic Excellence",
          research: "Research symposiums, hackathons, and interdisciplinary projects that challenge minds.", cultural_events: "Cultural Events", cultural_desc: "Celebrate diversity with our international festivals, performances, and exhibitions.",
          sports: "Athletics & Sports", sports_desc: "Join our competitive teams or recreational leagues to stay active and build teamwork.", learn_more: "Learn more →", footer_link_dp: "Data Protection",
          nav_about_mobile: "About Us",
          nav_activity_mobile: "Activities",
          nav_examresult_mobile: "Exam Results",
          gallery_section_label: "Featured Moments",
          gallery_section_title: "Glide Through Campus Life",
          gallery_section_description: "Drift along a ribbon of highlights featuring activities, labs, and daily life at UTYCC. Watch the snapshots flow by like a river weaving through our community.",
          gallery_tag_campus: "Campus",
          gallery_tag_community: "Community",
          gallery_tag_innovation: "Innovation",
          gallery_tag_events: "Events",
        }
      };

      let currentLanguage = 'en';

      // --- FUNCTIONS --- //
      
       /**
       * Renders the gallery based on the fetched photo data and current language.
       */
      function renderGallery() {
        const container = document.getElementById('pinterest-gallery-container');
        if (!container || !allGalleryPhotos) return;

        container.innerHTML = ''; // Clear existing content

        allGalleryPhotos.forEach(photo => {
            const title = photo.title[currentLanguage] || photo.title['en'];
            const description = photo.description[currentLanguage] || photo.description['en'];
            const tagKey = `gallery_tag_${photo.tag}`;
            const tagText = (translations[currentLanguage] && translations[currentLanguage][tagKey])
                ? translations[currentLanguage][tagKey]
                : photo.tag;

            const article = document.createElement('article');
            article.className = 'gallery-item';
            // Image path is relative from root (uploads_activity/image.jpg)
            article.innerHTML = `
                <div class="gallery-card">
                    <span class="gallery-tag">${tagText}</span>
                    <img src="${photo.image_path}" alt="${title}" class="gallery-image" loading="lazy" />
                    <div class="gallery-meta">
                        <h3>${title}</h3>
                        <p>${description}</p>
                    </div>
                </div>
            `;
            container.appendChild(article);
        });

        // Re-translate newly added static text
        changeLanguage(currentLanguage, false); 
      }


      /**
       * Translates the page content to the selected language.
       * @param {string} lang - The language code ('en' or 'my').
       * @param {boolean} rerender - Whether to re-render the dynamic gallery.
       */
      function changeLanguage(lang, rerender = true) {
        currentLanguage = lang;
        localStorage.setItem("language", lang);

        const desktopSelect = document.getElementById('language-switcher');
        const mobileSelect = document.getElementById('language-switcher-mobile');
        if (desktopSelect) desktopSelect.value = lang;
        if (mobileSelect) mobileSelect.value = lang;
        
        const optionDetails = { my: { text: 'မြန်မာ', flag: 'https://flagcdn.com/w20/mm.png' }, en: { text: 'English', flag: 'https://flagcdn.com/w20/gb.png' } };
        if (optionDetails[lang]) {
            ['desktop', 'mobile'].forEach(type => {
                const selectedFlag = document.getElementById(`selected-lang-flag-${type}`);
                const selectedText = document.getElementById(`selected-lang-text-${type}`);
                if (selectedFlag && selectedText) {
                    selectedFlag.src = optionDetails[lang].flag;
                    selectedText.textContent = optionDetails[lang].text;
                }
            });
        }

        document.querySelectorAll("[data-lang-key]").forEach(el => {
          const key = el.dataset.langKey;
          if (translations[lang] && translations[lang][key]) {
            el.innerHTML = translations[lang][key].replace(/\\n/g, "<br>");
          }
        });
        
        if (rerender) {
            renderGallery();
        }
      }
      
      /**
       * Sets up the infinitely scrolling river carousel.
       * @param {string[]} images - An array of image URLs.
       */
      function setupRiverCarousel(images) {
        const container = document.getElementById('riverCarousel');
        if (!container || !images || images.length === 0) {
            if (container) container.innerHTML = '';
            return;
        }

        container.innerHTML = '';
        const riverAnimationDuration = 40;
        container.style.setProperty('--river-duration', `${riverAnimationDuration}s`);

        const track = document.createElement('div');
        track.className = 'river-track';
        track.setAttribute('role', 'presentation');
        
        // If there are few images, repeat them to create a longer base sequence.
        // This makes the infinite loop's repetition far less obvious.
        let baseImageSet = [...images];
        while (baseImageSet.length > 0 && baseImageSet.length < 10) {
            baseImageSet.push(...images);
        }

        // The seamless CSS animation requires the entire sequence to be duplicated.
        const finalImageSet = [...baseImageSet, ...baseImageSet];

        finalImageSet.forEach((src) => {
            const item = document.createElement('div');
            item.className = 'river-item';
            item.style.backgroundImage = `url(${src})`;
            item.setAttribute('role', 'listitem');
            track.appendChild(item);
        });

        container.appendChild(track);
      }
      
      /**
       * Displays a toast notification.
       * @param {string} message - The message to display.
       */
      function showToast(message) {
          const toast = document.getElementById('toast');
          const toastMessage = document.getElementById('toast-message');
          if (!toast || !toastMessage) return;

          toastMessage.textContent = message;
          toast.classList.remove('opacity-0', 'translate-y-20');
          toast.classList.add('opacity-100', 'translate-y-0');

          setTimeout(() => {
              toast.classList.remove('opacity-100', 'translate-y-0');
              toast.classList.add('opacity-0', 'translate-y-20');
          }, 3000);
      }
      
      /**
       * Shows the modal with club information for a specific category.
       * @param {string} category - The category of clubs to show ('academic', 'cultural', 'sports').
       */
      function showClubsModal(category) {
        const modal = document.getElementById('clubsModal');
        const title = clubsData[category].title[currentLanguage] || clubsData[category].title['en'];
        document.getElementById('modalTitle').textContent = title;
        const container = document.getElementById('clubsContainer');
        container.innerHTML = '';

        clubsData[category].clubs.forEach((club, index) => {
          const card = document.createElement('div');
          card.className = 'club-card bg-gray-50 p-4 rounded-lg shadow-sm opacity-0';
          card.style.animationDelay = `${index * 0.1}s`;
          const name = club.name[currentLanguage] || club.name['en'];
          const desc = club.description[currentLanguage] || club.description['en'];
          const meeting = club.meeting[currentLanguage] || club.meeting['en'];
          card.innerHTML = `<h4 class="text-lg font-semibold text-blue-700 mb-1">${name}</h4><p class="text-gray-600 text-sm mb-2">${desc}</p><p class="text-gray-500 text-xs"><strong>Meeting:</strong> ${meeting}</p>`;
          setTimeout(() => card.classList.add('animate-slide-in'), 10);
          container.appendChild(card);
        });
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
      }

      /** Closes the currently active modal. */
      function closeModal() {
        const activeModal = document.querySelector('.modal-overlay.active');
        if (activeModal) {
            activeModal.classList.remove('active');
        }
        document.body.style.overflow = 'auto';
      }

      // --- EVENT LISTENERS & INITIALIZATION --- //
      document.addEventListener('DOMContentLoaded', function() {
          // Setup for both desktop and mobile language switchers
          function setupLangSwitcher(type) {
              const container = document.getElementById(`lang-switcher-container-${type}`);
              if (!container) return;
              const button = container.querySelector('.lang-switcher-button');
              const menu = container.querySelector('.lang-switcher-menu');
              const hiddenSelect = document.getElementById(`language-switcher${type === 'mobile' ? '-mobile' : ''}`);
              
              button.addEventListener('click', (e) => { e.stopPropagation(); menu.classList.toggle('hidden'); });
              menu.addEventListener('click', (e) => {
                  if (e.target.closest('.lang-switcher-option')) {
                      e.preventDefault();
                      const lang = e.target.closest('.lang-switcher-option').dataset.lang;
                      hiddenSelect.value = lang;
                      hiddenSelect.dispatchEvent(new Event('change'));
                      menu.classList.add('hidden');
                  }
              });
              hiddenSelect.addEventListener('change', () => changeLanguage(hiddenSelect.value));
          }

          setupLangSwitcher('desktop');
          setupLangSwitcher('mobile');
          document.addEventListener('click', () => document.querySelectorAll('.lang-switcher-menu').forEach(menu => menu.classList.add('hidden')));
        
          // Initialize language from localStorage or default to Myanmar
          const savedLang = localStorage.getItem("language") || "my";
          
        
          // Mobile menu toggle
          document.getElementById("mobile-menu-button").addEventListener("click", () => document.getElementById("mobile-menu").classList.toggle("hidden"));
          
          // Learn More buttons for club modals
          document.querySelectorAll('.learn-more-btn').forEach(btn => btn.addEventListener('click', (e) => showClubsModal(e.target.dataset.category)));
          
          // Close modal listeners
          document.querySelectorAll('.close-modal').forEach(btn => btn.addEventListener('click', closeModal));
          document.getElementById('clubsModal').addEventListener('click', (e) => { if (e.target.id === 'clubsModal') closeModal(); });
          
          
          // GSAP Animations on scroll
          gsap.registerPlugin(ScrollTrigger);
          gsap.utils.toArray('.animate-section').forEach(section => {
              gsap.from(section, {
                scrollTrigger: { trigger: section, start: "top 85%", toggleActions: "play none none none" },
                y: 50, opacity: 0, duration: 1, ease: "power3.out"
              });
          });

          // Fetch and render gallery photos
          async function initializeGallery() {
                const galleryContainer = document.getElementById('pinterest-gallery-container');
                const riverSection = document.getElementById('river-carousel-section');
                try {
                    const response = await fetch('Admin/activity_api.php');
                    if (!response.ok) throw new Error('Failed to fetch gallery data.');
                    allGalleryPhotos = await response.json();
                    
                    // Use new photos for the river carousel as well
                    if (allGalleryPhotos.length > 0) {
                        riverSection.style.display = 'block';
                        const dynamicRiverImages = allGalleryPhotos.map(p => p.image_path).slice(0, 10); // Use up to 10 newest images
                        setupRiverCarousel(dynamicRiverImages);
                    } else {
                        // If no dynamic images, hide the river section completely
                        riverSection.style.display = 'none';
                    }
                    
                    changeLanguage(savedLang); // This will call renderGallery inside
                } catch (error) {
                    console.error('Error initializing gallery:', error);
                    galleryContainer.innerHTML = '<p class="text-center text-red-500 col-span-full">Could not load gallery photos.</p>';
                    riverSection.style.display = 'none';
                }
            }

            initializeGallery();
      });
    </script>
  </body>

  </html>

