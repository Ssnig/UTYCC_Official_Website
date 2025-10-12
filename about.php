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

    .gallery-add-card {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      min-height: 320px;
      border: 2px dashed rgba(30, 64, 175, 0.35);
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(30, 64, 175, 0.08));
    }

    .gallery-add-content {
      padding: 2.5rem 2rem;
    }

    .gallery-add-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 3rem;
      height: 3rem;
      border-radius: 50%;
      background-color: rgba(30, 64, 175, 0.15);
      color: #1e40af;
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .gallery-add-title {
      font-size: 1.25rem;
      font-weight: 600;
      color: #1e3a8a;
      margin-bottom: 0.5rem;
    }

    .gallery-add-text {
      font-size: 0.95rem;
      color: #475569;
      margin-bottom: 1.25rem;
      line-height: 1.45;
    }

    .gallery-add-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.6rem 1.6rem;
      border-radius: 9999px;
      background-color: #1e40af;
      color: #fff;
      font-weight: 600;
      border: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
      cursor: pointer;
    }

    .gallery-add-button:hover {
      background-color: #1d4ed8;
      transform: translateY(-2px);
    }

    .gallery-modal-overlay {
      position: fixed;
      inset: 0;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      background: rgba(15, 23, 42, 0.45);
      backdrop-filter: blur(4px);
      z-index: 60;
    }

    .gallery-modal-overlay.open {
      display: flex;
    }

    .gallery-modal {
      width: min(600px, 100%);
      max-height: 92vh;
      background: #ffffff;
      border-radius: 1.5rem;
      box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.45);
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .gallery-modal-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 1.75rem 2rem 0;
    }

    .gallery-modal-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1e3a8a;
      margin: 0;
    }

    .gallery-modal-close {
      border: none;
      background: transparent;
      color: #475569;
      font-size: 1.5rem;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .gallery-modal-close:hover {
      color: #1e3a8a;
    }

    .gallery-modal-content {
      padding: 1.5rem 2rem 2rem;
      overflow-y: auto;
    }

    .gallery-modal-intro {
      color: #475569;
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .gallery-modal-form {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .gallery-form-group {
      text-align: left;
    }

    .gallery-form-label {
      display: block;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 0.5rem;
    }

    .gallery-form-input,
    .gallery-form-textarea,
    .gallery-form-select {
      width: 100%;
      border: 1px solid #cbd5f5;
      border-radius: 0.75rem;
      padding: 0.75rem 0.9rem;
      font-size: 0.95rem;
      color: #1e293b;
      background-color: #ffffff;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .gallery-form-input:focus,
    .gallery-form-textarea:focus,
    .gallery-form-select:focus {
      outline: none;
      border-color: #2563eb;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    .gallery-form-textarea {
      min-height: 110px;
      resize: vertical;
    }

    .gallery-form-hint {
      font-size: 0.8rem;
      color: #64748b;
      margin-top: 0.4rem;
    }

    .gallery-modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 0.75rem;
      margin-top: 0.5rem;
    }

    .gallery-secondary-button,
    .gallery-primary-button {
      border-radius: 9999px;
      padding: 0.65rem 1.8rem;
      font-weight: 600;
      transition: transform 0.2s ease, background-color 0.2s ease, color 0.2s ease;
      cursor: pointer;
    }

    .gallery-secondary-button {
      border: 1px solid #cbd5f5;
      color: #1e3a8a;
      background: #ffffff;
    }

    .gallery-secondary-button:hover {
      background: #eff2ff;
      transform: translateY(-1px);
    }

    .gallery-primary-button {
      border: none;
      background: #1e40af;
      color: #ffffff;
    }

    .gallery-primary-button:hover {
      background: #1d4ed8;
      transform: translateY(-1px);
    }

    body.modal-open {
      overflow: hidden;
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

    <!-- Pinterest Gallery Section -->
    <section id="campus-gallery" class="mb-16 animate-section">
      <div class="text-center mb-12 max-w-3xl mx-auto">
        <span class="inline-block uppercase tracking-[0.35em] text-xs text-blue-600 font-semibold mb-4" data-lang-key="gallery_section_label">Campus Life</span>
        <h2 class="text-4xl md:text-5xl font-bold text-blue-900 mb-4" data-lang-key="gallery_section_title">Moments Around UTYCC</h2>
        <p class="text-gray-600 text-base md:text-lg" data-lang-key="gallery_section_description">
          A curated look at the places, people, and energy that shape our community. Scroll through the mosaic to revisit familiar corners or discover new perspectives across campus.
        </p>
      </div>
      <div class="pinterest-gallery">
        <article class="gallery-item">
          <div class="gallery-card gallery-card-campus">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/front_view.JPG" alt="Main UTYCC building framed by trees" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_morning_title">Morning Entrance</h3>
              <p data-lang-key="gallery_card_morning_desc">Sunrise over the main facade welcomes students starting their day early.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card gallery-card-campus">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/front_view2.JPG" alt="Walkway leading to the university entrance" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_gateway_title">Gateway Path</h3>
              <p data-lang-key="gallery_card_gateway_desc">A calm walkway lined with green guiding visitors toward the heart of campus.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card gallery-card-campus">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/front_view3.JPG" alt="Wide view of the main UTYCC pavilion" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_pavilion_title">Central Pavilion</h3>
              <p data-lang-key="gallery_card_pavilion_desc">An open space where students gather between classes and events.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card gallery-card-campus">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/front_view4.JPG" alt="Panoramic view of UTYCC courtyard" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_courtyard_title">Courtyard Panorama</h3>
              <p data-lang-key="gallery_card_courtyard_desc">Expansive courtyard showcasing the symmetry of the campus grounds.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card gallery-card-campus">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/front_view5.JPG" alt="Aerial perspective highlighting UTYCC architecture" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_wings_title">Academic Wings</h3>
              <p data-lang-key="gallery_card_wings_desc">Academic blocks stretching out across the skyline of Yatanarpon Cyber City.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/main.JPG" alt="Main administrative building at UTYCC" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_admin_title">Main Administration</h3>
              <p data-lang-key="gallery_card_admin_desc">The hub of student services ensuring smooth academic journeys.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/main1.JPG" alt="Perspective of UTYCC main building with blue sky" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_blue_title">Blue Skies</h3>
              <p data-lang-key="gallery_card_blue_desc">Bright afternoons highlighting the bold lines of the main complex.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/roadmap.JPG" alt="Tree-lined road leading across UTYCC campus" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_shaded_title">Shaded Avenue</h3>
              <p data-lang-key="gallery_card_shaded_desc">A favourite stretch for evening walks and quick coffee runs.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_campus">Campus</span>
            <img src="Img/utycc_buildings/roadmap2.JPG" alt="Parking and open spaces around the UTYCC grounds" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_crossroads_title">Campus Crossroads</h3>
              <p data-lang-key="gallery_card_crossroads_desc">Intersections connecting the library, labs, and lecture halls.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_community">Community</span>
            <img src="Img/utycc_buildings/canteen.JPG" alt="Students ordering meals at the campus canteen" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_canteen_break_title">Canteen Break</h3>
              <p data-lang-key="gallery_card_canteen_break_desc">A bustling lunch hour filled with local flavours and laughter.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_community">Community</span>
            <img src="Img/utycc_buildings/canteen2.JPG" alt="Seating area in the UTYCC canteen" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_shared_title">Shared Tables</h3>
              <p data-lang-key="gallery_card_shared_desc">Groups gather here to refuel, collaborate, and recharge.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_community">Community</span>
            <img src="Img/utycc_buildings/canteen3.JPG" alt="Students lining up for meals at the canteen counter" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_lunch_queue_title">Lunch Queue</h3>
              <p data-lang-key="gallery_card_lunch_queue_desc">Friendly conversations fill the air as everyone waits for their turn.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_innovation">Innovation</span>
            <img src="Img/utycc_buildings/lab.JPG" alt="Students practicing in an electronics laboratory" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_elec_lab_title">Electronics Lab</h3>
              <p data-lang-key="gallery_card_elec_lab_desc">Hands-on experimentation powering ideas into tangible solutions.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_innovation">Innovation</span>
            <img src="Img/utycc_buildings/lab2.JPG" alt="Laboratory benches with equipment ready for experiments" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_ready_research_title">Ready for Research</h3>
              <p data-lang-key="gallery_card_ready_research_desc">Calibrated instruments waiting for the next breakthrough.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_innovation">Innovation</span>
            <img src="Img/utycc_buildings/lab3.JPG" alt="Close-up of lab workspace and tools" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_precision_title">Precision Bench</h3>
              <p data-lang-key="gallery_card_precision_desc">Detail-oriented setups supporting advanced materials research.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_innovation">Innovation</span>
            <img src="Img/utycc_buildings/lab4.JPG" alt="Students collaborating during a practical lab session" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_team_experiments_title">Team Experiments</h3>
              <p data-lang-key="gallery_card_team_experiments_desc">Collaboration at the centre of every lab-based challenge.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_innovation">Innovation</span>
            <img src="Img/utycc_buildings/lab5.JPG" alt="Instrumentation and wiring inside a UTYCC laboratory" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_lab_instruments_title">Lab Instruments</h3>
              <p data-lang-key="gallery_card_lab_instruments_desc">State-of-the-art equipment supporting multi-disciplinary projects.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_events">Events</span>
            <img src="Img/activity/ce_lab.jpg" alt="Students observing a demonstration in the computer engineering lab" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_ce_demo_title">CE Demo Day</h3>
              <p data-lang-key="gallery_card_ce_demo_desc">Hands-on workshops that spark curiosity among future engineers.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_events">Events</span>
            <img src="Img/activity/ce_project.jpg" alt="Students presenting a computer engineering project" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_project_showcase_title">Project Showcase</h3>
              <p data-lang-key="gallery_card_project_showcase_desc">Presentations that blend innovation, teamwork, and real-world impact.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card">
            <span class="gallery-tag" data-lang-key="gallery_tag_events">Events</span>
            <img src="Img/activity/football.jpg" alt="UTYCC students playing football on the field" class="gallery-image" loading="lazy" />
            <div class="gallery-meta">
              <h3 data-lang-key="gallery_card_evening_match_title">Evening Match</h3>
              <p data-lang-key="gallery_card_evening_match_desc">Friendly competitions that keep our community active and connected.</p>
            </div>
          </div>
        </article>
        <article class="gallery-item">
          <div class="gallery-card gallery-add-card">
            <div class="gallery-add-content">
              <span class="gallery-add-icon">+</span>
              <h3 class="gallery-add-title" data-lang-key="gallery_add_title">Add Your Memory</h3>
              <p class="gallery-add-text" data-lang-key="gallery_add_text">Have a moment that captures campus life? Share it with the student affairs team and see it join the wall.</p>
              <button type="button" class="gallery-add-button" data-lang-key="gallery_add_button">Submit Photo</button>
            </div>
          </div>
        </article>
      </div>
    </section>

    <div class="gallery-modal-overlay" id="galleryModalOverlay" aria-hidden="true">
      <div class="gallery-modal" role="dialog" aria-modal="true" aria-labelledby="galleryModalTitle">
        <div class="gallery-modal-header">
          <h3 class="gallery-modal-title" id="galleryModalTitle" data-lang-key="gallery_modal_title">Share Your Memory</h3>
          <button type="button" class="gallery-modal-close" id="galleryModalClose" aria-label="Close">
            &times;
          </button>
        </div>
        <div class="gallery-modal-content">
          <p class="gallery-modal-intro" data-lang-key="gallery_modal_intro">
            Upload a photo and include short descriptions in both English and Myanmar so we can feature it in the gallery.
          </p>
          <form id="galleryModalForm" class="gallery-modal-form">
            <div class="gallery-form-group">
              <label for="galleryImage" class="gallery-form-label" data-lang-key="gallery_modal_image_label">Photo</label>
              <input type="file" id="galleryImage" name="image" class="gallery-form-input" accept="image/*" required />
              <p class="gallery-form-hint" data-lang-key="gallery_modal_image_hint">
                Accepted formats: JPG, PNG, WEBP. Max size 5&nbsp;MB.
              </p>
            </div>
            <div class="gallery-form-group">
              <label for="galleryDescEn" class="gallery-form-label" data-lang-key="gallery_modal_desc_en_label">Description (English)</label>
              <textarea id="galleryDescEn" name="description_en" class="gallery-form-textarea" rows="4" required></textarea>
            </div>
            <div class="gallery-form-group">
              <label for="galleryDescMy" class="gallery-form-label" data-lang-key="gallery_modal_desc_my_label">Description (Myanmar)</label>
              <textarea id="galleryDescMy" name="description_my" class="gallery-form-textarea" rows="4" required></textarea>
            </div>
            <div class="gallery-form-group">
              <label for="galleryTag" class="gallery-form-label" data-lang-key="gallery_modal_tag_label">Tag</label>
              <select id="galleryTag" name="tag" class="gallery-form-select" required>
                <option value="" data-lang-key="gallery_modal_tag_placeholder">Select a tag</option>
                <option value="campus" data-lang-key="gallery_tag_campus">Campus</option>
                <option value="community" data-lang-key="gallery_tag_community">Community</option>
                <option value="innovation" data-lang-key="gallery_tag_innovation">Innovation</option>
                <option value="events" data-lang-key="gallery_tag_events">Events</option>
              </select>
            </div>
            <div class="gallery-modal-actions">
              <button type="button" class="gallery-secondary-button" id="galleryModalCancel" data-lang-key="gallery_modal_cancel">Cancel</button>
              <button type="submit" class="gallery-primary-button" data-lang-key="gallery_modal_submit">Send Request</button>
            </div>
          </form>
        </div>
      </div>
    </div>

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
        gallery_section_label: "ဓာတ်ပုံပြခန်း",
        gallery_section_title: "ကျွန်ုပ်တို့၏ တက္ကသိုလ်မှ အမှတ်တရများ",
        gallery_section_description: "ကျောင်းသားများ၏ နေ့စဉ်ဘဝ၊ လှုပ်ရှားမှုများနှင့် အမှတ်တရများကို ဖော်ပြသည့် ဓာတ်ပုံများကို ကြည့်ရှုနိုင်ပါသည်။ ကျွန်ုပ်တို့၏ တက္ကသိုလ်၏ စွမ်းဆောင်ရည်၊ ပညာရေးပတ်ဝန်းကျင်နှင့် အသိုင်းအဝိုင်းကို တွေ့မြင်နိုင်ပါသည်။",
        gallery_section_label: "ထူးခြားသော အမှတ်တရများ",
        gallery_section_title: "တက္ကသိုလ်ဘဝကို လျှောလှဲကြည့်ပါ",
        gallery_section_description: "UTYCC ၏ လှုပ်ရှားမှုများ၊ စမ်းသပ်ခန်းများနှင့် နေ့စဉ်ဘဝအပြင်အဆင်များကို တစ်ချောင်းသွေးလိုမျိုး သွေးဆောင်သွားမည့် ပုံရိပ်အတွဲများအဖြစ် ခံစားပါ။",
        gallery_tag_campus: "တက္ကသိုလ်ဧရိယာ",
        gallery_tag_community: "လူ့အသိုင်းအဝိုင်း",
        gallery_tag_innovation: "တီထွင်မှု",
        gallery_tag_events: "ပွဲများ",
        gallery_card_morning_title: "မနက်အဖွင့်",
        gallery_card_morning_desc: "အဓိက ဦးတည်နေရာအပေါ် မနက်ခင်းနေမင်းရောင်တောက်ပနေ၍ သင်ကြားရေးနေ့စတင်မှုကို ကြိုဆိုနေပါသည်။",
        gallery_card_gateway_title: "ဝင်ပေါက်လမ်းကြောင်း",
        gallery_card_gateway_desc: "စိမ်းလန်းသည့် မျဉ်းပန်းများဖြင့် တက်ကြွစွာ လမ်းလျှောက်နိုင်သော တက်ကသိုလ်၏ သွေးလည်နေရာသို့ ဦးတည်သည့် အေးချမ်းသော လမ်းကြောင်း။",
        gallery_card_pavilion_title: "အလယ်ဗဟိုပဗီးလီယံ",
        gallery_card_pavilion_desc: "စာသင်တန်းများနှင့် ပွဲများအကြား ကျောင်းသားများ စုပေါင်းဆုံနေသော ပွင့်လင်းနေရာ။",
        gallery_card_courtyard_title: "အလယ်ဝင်းရှုခင်း",
        gallery_card_courtyard_desc: "တက္ကသိုလ်၏ ပေါင်းစပ်ညီညွတ်မှုကို ပြသသော ကျယ်ပြန့်သော အလယ်ဝင်း။",
        gallery_card_wings_title: "သင်ကြားရေးအဆောက်အဦများ",
        gallery_card_wings_desc: "ယာတနာပုန် ဆိုင်ဘာမြို့၏ မိုးကောင်းကင်အထက်တွင် ဆွဲဆောင်နေသော သင်ကြားရေးအဆောက်အဦများ။",
        gallery_card_admin_title: "အုပ်ချုပ်ရေးဌာနအဓိကအဆောက်အဦ",
        gallery_card_admin_desc: "ကျောင်းသားဝန်ဆောင်မှုများ၏ ဗဟိုနေရာဖြစ်ပြီး သင်ကြားရေးလမ်းကြောင်းကို ပြေလည်အောင် ထောက်ပံ့ပေးနေပါသည်။",
        gallery_card_blue_title: "မိုးပြာရောင်အပေါ်ကောင်းကင်",
        gallery_card_blue_desc: "နံနက်ခင်းနွေးနွေးထဲတွင် တက္ကသိုလ်အဆောက်အဦအကြီး၏ လှည့်ကွက်များကို ထင်ထင်ရှားရှား ဖော်ပြနေသော အချိန်။",
        gallery_card_shaded_title: "အရိပ်ရှိလမ်းကြောင်း",
        gallery_card_shaded_desc: "ညနေပိုင်း လမ်းလျှောက်ခြင်း သို့မဟုတ် ကော်ဖီသောက်ခြင်းအတွက် လူအများကြိုက်သော လမ်းကြောင်း။",
        gallery_card_crossroads_title: "တက္ကသိုလ်အလယ်လမ်းဆုံ",
        gallery_card_crossroads_desc: "စာကြည့်တိုက်၊ စမ်းသပ်ခန်းများနှင့် စာသင်ခန်းများကို ဆက်သွယ်ပေးသော လမ်းဆုံ။",
        gallery_card_canteen_break_title: "အစာစားအနားချိန်",
        gallery_card_canteen_break_desc: "အဖျော်အချိန်တွင် ဟယ်လှတဲ့ မျက်နှာပြင်များနှင့် ရယ်မောသံများဖြင့် ပြည့်နေသော အချိန်။",
        gallery_card_shared_title: "အမျှစားစားပွဲများ",
        gallery_card_shared_desc: "အဖွဲ့လိုက် စုပေါင်းပြီး အားဖြည့်ခြင်း၊ အလုပ်လုပ်ခြင်းနှင့် အားလပ်ခြင်းများ ပြုလုပ်သည့် နေရာ။",
        gallery_card_lunch_queue_title: "ထမင်းစာတန်းစဉ်",
        gallery_card_lunch_queue_desc: "ထမင်းစာတန်းစဉ်အတွင်း သင်တန်းသားများ အပြန်အလှန် ပြောဆိုပြီး ပျော်ရွှင်နေကြသော အချိန်။",
        gallery_card_elec_lab_title: "အီလက်ထရွန်းနစ်စမ်းသပ်ခန်း",
        gallery_card_elec_lab_desc: "အင်ဂျင်နီယာအဖြစ်အနာဂတ်အတွက် အကြံဉာဏ်များကို လက်တွေ့အောင်မြင်အောင် ပြုလုပ်သည့် နေရာ။",
        gallery_card_ready_research_title: "သုတေသနအတွက် အဆင်သင့်",
        gallery_card_ready_research_desc: "နည်းပညာသစ်များကို ဖန်တီးရန် အစိတ်အပိုင်းများ ပြင်ဆင်ပြီး စောင့်ဆိုင်းနေသော စက်ကိရိယာများ။",
        gallery_card_precision_title: "တိကျမှုစမ်းသပ်ခန်း",
        gallery_card_precision_desc: "အကြောင်းအရာအသေးစိတ်များကို ဂရုစိုက်သည့် သုတေသနခုံ။",
        gallery_card_team_experiments_title: "အဖွဲ့လိုက် စမ်းသပ်မှုများ",
        gallery_card_team_experiments_desc: "သုတေသနတိုင်းတွင် ပူးပေါင်းဆောင်ရွက်မှုအရေးပါမှုကို ပြသနေသည်။",
        gallery_card_lab_instruments_title: "စမ်းသပ်ခန်းကိရိယာများ",
        gallery_card_lab_instruments_desc: "အမျိုးမျိုးသော နယ်ပယ်များအတွက် အသုံးပြုနိုင်သော နည်းပညာမြင့် စမ်းသပ်ကိရိယာများ။",
        gallery_card_ce_demo_title: "စက်မှုအင်ဂျင်နီယာ စမ်းသပ်ပြပွဲနေ့",
        gallery_card_ce_demo_desc: "အနာဂတ်အင်ဂျင်နီယာများအတွက် စိတ်ဝင်စားမှုကို ပေါ်ထွက်စေသည့် လက်တွေ့အခြေပြု စမ်းသပ်မှုများ။",
        gallery_card_project_showcase_title: "စီမံကိန်းပြပွဲ",
        gallery_card_project_showcase_desc: "တီထွင်မှု၊ အဖွဲ့လိုက်လုပ်ဆောင်မှုနှင့် လက်တွေ့အသုံးချမှုကို ပေါင်းစပ်ထားသော ပြသမှုများ။",
        gallery_card_evening_match_title: "ညနေပိုင်း အားကစားပြိုင်ပွဲ",
        gallery_card_evening_match_desc: "အသိုင်းအဝိုင်းအကြား ဆက်ဆံရေးတိုးတက်အောင် လုပ်ဆောင်သည့် အားကစားပွဲများ။",
        gallery_add_title: "သင့်အမှတ်တရကို မျှဝေပါ",
        gallery_add_text: "တက္ကသိုလ်ဘဝကို ကိုယ်တိုင်ဖော်ပြသော ပုံရိပ်တစ်ပုံရှိပါသလား။ ကျောင်းသားရေးရာဌာနထံ သင့်အမှတ်တရကို ပေးပို့ပြီး ဤပြခန်းတွင် ထည့်သွင်းပါ။",
        gallery_add_button: "ပုံတင်ပါ",
        gallery_modal_title: "မိမိရဲ့ အမှတ်တရကို မျှဝေပါ",
        gallery_modal_intro: "ဤပြခန်းတွင် ထည့်သွင်းရန် ဓာတ်ပုံတစ်ပုံနှင့် အင်္ဂလိပ်၊ မြန်မာဖော်ပြချက်တိုများကို ပူးတွဲပေးပါ။",
        gallery_modal_image_label: "ဓာတ်ပုံ",
        gallery_modal_image_hint: "လက်ခံသည့်ဖိုင်များ — JPG, PNG, WEBP (အရွယ်အစား အများဆုံး ၅ မီဂါဘိုင်)",
        gallery_modal_desc_en_label: "ဖော်ပြချက် (အင်္ဂလိပ်)",
        gallery_modal_desc_my_label: "ဖော်ပြချက် (မြန်မာ)",
        gallery_modal_tag_label: "တပ်ဆိုင်ရန် အမျိုးအစား",
        gallery_modal_tag_placeholder: "တပ်ဆိုင်ရာကို ရွေးချယ်ပါ",
        gallery_modal_cancel: "ပယ်ဖျက်မည်",
        gallery_modal_submit: "တင်သွင်းမည်",
        gallery_modal_success: "ကျေးဇူးတင်ပါတယ်။ သင်တင်သွင်းထားသော ဓာတ်ပုံကို ကျောင်းသားရေးရာအဖွဲဆောင်မှ စိစစ်ဆောင်ရွက်ပါမည်။",
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
        gallery_section_label: "Featured Moments",
        gallery_section_title: "Glide Through Campus Life",
        gallery_section_description: "Drift along a ribbon of highlights featuring activities, labs, and daily life at UTYCC. Watch the snapshots flow by like a river weaving through our community.",
        gallery_tag_campus: "Campus",
        gallery_tag_community: "Community",
        gallery_tag_innovation: "Innovation",
        gallery_tag_events: "Events",
        gallery_card_morning_title: "Morning Entrance",
        gallery_card_morning_desc: "Sunrise over the main facade welcomes students starting their day early.��ade welcomes students starting their day early.",
        gallery_card_gateway_title: "Gateway Path",
        gallery_card_gateway_desc: "A calm walkway lined with green guiding visitors toward the heart of campus.",
        gallery_card_pavilion_title: "Central Pavilion",
        gallery_card_pavilion_desc: "An open space where students gather between classes and events.",
        gallery_card_courtyard_title: "Courtyard Panorama",
        gallery_card_courtyard_desc: "Expansive courtyard showcasing the symmetry of the campus grounds.",
        gallery_card_wings_title: "Academic Wings",
        gallery_card_wings_desc: "Academic blocks stretching out across the skyline of Yatanarpon Cyber City.",
        gallery_card_admin_title: "Main Administration",
        gallery_card_admin_desc: "The hub of student services ensuring smooth academic journeys.",
        gallery_card_blue_title: "Blue Skies",
        gallery_card_blue_desc: "Bright afternoons highlighting the bold lines of the main complex.",
        gallery_card_shaded_title: "Shaded Avenue",
        gallery_card_shaded_desc: "A favourite stretch for evening walks and quick coffee runs.",
        gallery_card_crossroads_title: "Campus Crossroads",
        gallery_card_crossroads_desc: "Intersections connecting the library, labs, and lecture halls.",
        gallery_card_canteen_break_title: "Canteen Break",
        gallery_card_canteen_break_desc: "A bustling lunch hour filled with local flavours and laughter.",
        gallery_card_shared_title: "Shared Tables",
        gallery_card_shared_desc: "Groups gather here to refuel, collaborate, and recharge.",
        gallery_card_lunch_queue_title: "Lunch Queue",
        gallery_card_lunch_queue_desc: "Friendly conversations fill the air as everyone waits for their turn.",
        gallery_card_elec_lab_title: "Electronics Lab",
        gallery_card_elec_lab_desc: "Hands-on experimentation powering ideas into tangible solutions.",
        gallery_card_ready_research_title: "Ready for Research",
        gallery_card_ready_research_desc: "Calibrated instruments waiting for the next breakthrough.",
        gallery_card_precision_title: "Precision Bench",
        gallery_card_precision_desc: "Detail-oriented setups supporting advanced materials research.",
        gallery_card_team_experiments_title: "Team Experiments",
        gallery_card_team_experiments_desc: "Collaboration at the centre of every lab-based challenge.",
        gallery_card_lab_instruments_title: "Lab Instruments",
        gallery_card_lab_instruments_desc: "State-of-the-art equipment supporting multi-disciplinary projects.",
        gallery_card_ce_demo_title: "CE Demo Day",
        gallery_card_ce_demo_desc: "Hands-on workshops that spark curiosity among future engineers.",
        gallery_card_project_showcase_title: "Project Showcase",
        gallery_card_project_showcase_desc: "Presentations that blend innovation, teamwork, and real-world impact.",
        gallery_card_evening_match_title: "Evening Match",
        gallery_card_evening_match_desc: "Friendly competitions that keep our community active and connected.",
        gallery_add_title: "Add Your Memory",
        gallery_add_text: "Have a moment that captures campus life? Share it with the student affairs team and see it join the wall.",
        gallery_add_button: "Submit Photo",
        gallery_modal_title: "Share Your Memory",
        gallery_modal_intro: "Upload a photo and include short descriptions in both English and Myanmar so we can feature it in the gallery.",
        gallery_modal_image_label: "Photo",
        gallery_modal_image_hint: "Accepted formats: JPG, PNG, WEBP (maximum 5 MB).",
        gallery_modal_desc_en_label: "Description (English)",
        gallery_modal_desc_my_label: "Description (Myanmar)",
        gallery_modal_tag_label: "Tag",
        gallery_modal_tag_placeholder: "Select a tag",
        gallery_modal_cancel: "Cancel",
        gallery_modal_submit: "Send Request",
        gallery_modal_success: "Thank you! Your submission has been forwarded to the student affairs team for review.",
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

      const galleryAddButton = document.querySelector('.gallery-add-button');
      const galleryModalOverlay = document.getElementById('galleryModalOverlay');
      const galleryModalClose = document.getElementById('galleryModalClose');
      const galleryModalCancel = document.getElementById('galleryModalCancel');
      const galleryModalForm = document.getElementById('galleryModalForm');

      const openGalleryModal = () => {
        if (!galleryModalOverlay) return;
        galleryModalOverlay.classList.add('open');
        document.body.classList.add('modal-open');
      };

      const closeGalleryModal = () => {
        if (!galleryModalOverlay) return;
        galleryModalOverlay.classList.remove('open');
        document.body.classList.remove('modal-open');
        if (galleryModalForm) galleryModalForm.reset();
      };

      if (galleryAddButton) {
        galleryAddButton.addEventListener('click', openGalleryModal);
      }
      if (galleryModalClose) {
        galleryModalClose.addEventListener('click', closeGalleryModal);
      }
      if (galleryModalCancel) {
        galleryModalCancel.addEventListener('click', (event) => {
          event.preventDefault();
          closeGalleryModal();
        });
      }
      if (galleryModalOverlay) {
        galleryModalOverlay.addEventListener('click', (event) => {
          if (event.target === galleryModalOverlay) {
            closeGalleryModal();
          }
        });
      }
      if (galleryModalForm) {
        galleryModalForm.addEventListener('submit', (event) => {
          event.preventDefault();
          closeGalleryModal();
          const message = translations[currentLanguage]?.gallery_modal_success || "Thank you! Your submission has been forwarded to the student affairs team for review.";
          alert(message);
        });
      }
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

      // Gallery card animations
      const galleryCards = gsap.utils.toArray('.gallery-card');
      galleryCards.forEach((card, index) => {
        const direction = index % 2 === 0 ? 80 : -80;
        gsap.from(card, {
          y: direction,
          opacity: 0,
          duration: 1,
          ease: "power3.out",
          scrollTrigger: {
            trigger: card,
            start: "top 85%",
            toggleActions: "play none none none"
          }
        });
      });
    });
  </script>
</body>

</html>

