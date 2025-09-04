<?php
require_once './Rform/db.php'; 
$announcement_text = '';
$announcement_status = 'disabled';

try {
    
    $stmt = $pdo->prepare("SELECT 1 FROM site_settings LIMIT 1");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key IN ('announcement_text', 'announcement_status')");
        $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        $announcement_text = $settings['announcement_text'] ?? '';
        $announcement_status = $settings['announcement_status'] ?? 'disabled';
    }

} catch (PDOException $e) {
    // Table does not exist, ignore and use default values
}
$pdo = null; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="./CSS/shine_text.css">
    <link rel="stylesheet" href="./CSS/star-layout.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="./CSS/footer.css" />
    <script src="./JS/star-layout.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>University of Technology - Yatanarpon Cyber City (UTYCC)</title>
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="CSS/font.css" />
    <script src="./JS/GSAP.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        /* --- Preloader Styles --- */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.75s ease, visibility 0.75s ease;
        }

        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #e0e0e0;
            /* light grey */
            border-top-color: #3b82f6;
            /* blue-500 */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* --- Smooth Scrolling --- */
        html {
            scroll-behavior: smooth;
        }

        /* --- Scroll Animation Styles --- */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered animation delay for children */
        .animate-on-scroll.is-visible .program-card {
            transition-delay: calc(0.1s * var(--i));
        }

        /* --- Hero Slideshow Styles --- */
        .hero-container {
            position: relative;
            height: 80vh;
            /* Adjust height as needed */
            color: #1e3a8a;
            /* Tailwind blue-900 for text */
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }


        .game-toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            /* Set a fixed width for the game container */
            height: 400px;
            /* Set a fixed height */
            background-color: #2d3748;
            /* Tailwind gray-800 */
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
            transition: transform 0.5s ease-out, opacity 0.5s ease-out;
            transform: translateY(100vh);
            /* Start off-screen */
            opacity: 0;
            z-index: 1000;
            /* Ensure it's on top of other content */
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Class to show the toast with a smooth animation */
        .game-toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Basic styling for the close button */
        .close_button2 {
            background-color: #ef4444;
            /* Tailwind red-500 */
            color: white;
            border: none;
            padding: 8px 12px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
        }

        .close_button2:hover {
            background-color: #dc2626;
            /* Tailwind red-600 */
        }

        /* Style the canvas to fill the container */
        .game-toast canvas {
            width: 100%;
            flex: 1;
            /* Make canvas fill remaining space */
            background-color: #f0f8ff;
            /* AliceBlue, nice and light */
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
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

        /* --- Styles for Verification Modal --- */
        :root {
            --bg-light: #ecf0f1;
            --bg-dark: #34495e;
            --card-bg: #ffffff;
            --text-primary: #2c3e50;
            --text-muted: #7f8c8d;
            --border-color: #bdc3c7;
            --accent-color: #3498db;
            --accent-hover: #2980b9;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.08);
            --shadow-dark: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            padding: 16px;
        }

        .auth-wrapper {
            width: min(900px, 95vw);
            display: flex;
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: var(--shadow-dark);
            overflow: hidden;
            animation: fadeIn 0.4s ease-out both;
            position: relative;
            /* For the close button */
        }

        .shell {
            flex: 1 1 50%;
            padding: 32px 28px;
        }

        .image-panel {
            flex: 1 1 50%;
            display: block;
        }

        .image-panel img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .g-head {
            display: grid;
            justify-items: center;
            gap: 8px;
            text-align: center;
            margin-bottom: 8px;
        }

        .brand-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .modal-h1 {
            margin: 8px 0 4px;
            font-size: 28px;
            font-weight: 700;
        }

        .sub {
            color: var(--text-muted);
            font-size: 15px;
        }

        form {
            display: grid;
            gap: 20px;
            margin-top: 24px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
        }

        .input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background: var(--card-bg);
            color: var(--text-primary);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .input::placeholder {
            color: var(--text-muted);
        }

        .input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .btn {
            appearance: none;
            border: 0;
            cursor: pointer;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 700;
            color: #fff;
            background: var(--accent-color);
            box-shadow: var(--shadow-dark);
            transition: background-color 0.2s ease, transform 0.1s ease,
                opacity 0.2s ease;
        }

        .btn:hover {
            background-color: var(--accent-hover);
        }

        .btn:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .toast-wrap {
            position: fixed;
            top: 20px;
            right: 20px;
            width: min(360px, 92vw);
            display: grid;
            gap: 12px;
            z-index: 1100;
            /* Higher than modal */
            pointer-events: none;
        }

        .toast {
            pointer-events: auto;
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 10px;
            color: var(--card-bg);
            background: var(--text-primary);
            box-shadow: var(--shadow-dark);
            border-left: 4px solid var(--accent-color);
            animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards;
        }

        .toast.error {
            border-left-color: var(--error-color);
        }

        .toast.success {
            border-left-color: var(--success-color);
        }

        .toast .close-btn {
            background: transparent;
            border: 0;
            color: #fff;
            opacity: 0.7;
            cursor: pointer;
            font-size: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @media (max-width: 800px) {
            .image-panel {
                display: none;
            }
        }

        .modal-close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--text-muted);
            cursor: pointer;
            z-index: 10;
            /* This ensures the button is on top of other elements */
        }

        .terms,
        .auth-toggle {
            font-size: 13px;
            color: var(--text-muted);
            text-align: center;
        }

        .terms a,
        .auth-toggle a {
            color: var(--accent-color);
            text-decoration: none;
            cursor: pointer;
        }

        .terms a:hover,
        .auth-toggle a:hover {
            text-decoration: underline;
        }

        .view {
            display: none;
        }

        .view.active {
            display: block;
        }

        /* --- Back to Top Button --- */
        #back-to-top-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        #back-to-top-btn.show {
            opacity: 1;
            visibility: visible;
        }

        /* --- Photo Gallery & Lightbox Styles --- */
        .gallery-item {
            cursor: pointer;
        }

        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .lightbox.show {
            opacity: 1;
            visibility: visible;
        }

        .lightbox img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            cursor: pointer;
            font-weight: bold;
        }

        /* --- Enhanced Hover Effects --- */
        .card-hover-effect {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card-hover-effect:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1), 0 8px 16px -8px rgba(0, 0, 0, 0.1);
        }

        .btn-hover-effect {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .btn-hover-effect:hover {
            transform: scale(1.05) translateY(-2px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .icon-hover-effect {
            transition: transform 0.3s ease;
        }

        .icon-hover-effect:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <div id="header" class="bg-white shadow-md sticky top-0 z-50 transition-colors duration-300">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="./home.html" id="header-logo-link" class="flex items-center space-x-3">
                <div class="p-2 rounded-lg icon-hover-effect ">
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
                </div>
                <div>
                    <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
                    <span class="text-xs text-gray-500" data-lang-key="utycc_full_name">University of Technology (
                        Yatanarpon Cyber City )</span>
                </div>
            </a>
            <div class="hidden md:flex items-center space-x-6">
                <a href="#about" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_about">ကျွန်ုပ်တို့အကြောင်း</a>
                <a href="#programs" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_programs">ပညာရေးအစီအစဉ်များ</a>
                <a href="#collaboration" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_collaboration">ပူးပေါင်းဆောင်ရွက်မှု</a>
                <a href="#contact" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_contact">ဆက်သွယ်ရန်</a>
                <!-- Language Switcher Dropdown - Updated Style -->
                <div class="relative ml-4">
                    <div id="lang-switcher-container-desktop">
                        <!-- Custom Button -->
                        <button class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
                            <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag" class="h-4 w-6 object-cover flex-shrink-0">
                            <span id="selected-lang-text-desktop" class="ml-2">မြန်မာ</span>
                            <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 pointer-events-none"></i>
                        </button>
                        <!-- Custom Dropdown Menu -->
                        <div class="lang-switcher-menu hidden absolute mt-1 w-auto min-w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
                            <a href="#" class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="my">
                                <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
                                <span>မြန်မာ</span>
                            </a>
                            <a href="#" class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="en">
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
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden px-6 pb-4 border-t md:hidden">
            <a href="#about" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_about_mobile">ကျွန်ုပ်တို့အကြောင်း</a>
            <a href="#programs" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_programs_mobile">ပညာရေးအစီအစဉ်များ</a>
            <a href="#collaboration" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_collaboration_mobile">ပူးပေါင်းဆောင်ရွက်မှု</a>
            <a href="#contact" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_contact_mobile">ဆက်သွယ်ရန်</a>
            <div class="relative mt-4 pt-4 border-t">
                <div id="lang-switcher-container-mobile" class="relative">
                    <!-- Custom Button -->
                    <button class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
                        <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag" class="h-4 w-6 object-cover flex-shrink-0">
                        <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
                        <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
                    </button>
                    <!-- Custom Dropdown Menu -->
                    <div class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
                        <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="my">
                            <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
                            <span>မြန်မာ</span>
                        </a>
                        <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-lang="en">
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
     <?php if ($announcement_status === 'enabled' && !empty($announcement_text)): ?>
    <div id="announcement-banner" class="bg-yellow-400 border-b-4 border-yellow-500 text-yellow-900 text-center p-4 shadow-lg">
        <div class="container mx-auto flex items-center justify-center space-x-4">
            <i class="fas fa-bullhorn fa-2x animate-pulse"></i>
            <p class="font-semibold"><?php echo nl2br(htmlspecialchars($announcement_text)); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <div id="main-content">
        <!-- Hero Section -->
        <section class="hero-container">
            <div class="hero-slideshow">
                <div class="hero-slide active" style="background-image: url(./Img/hero-carousel/2.jpg)"></div>
                <div class="hero-slide" style="background-image: url(./Img/hero-carousel/5.JPG)"></div>
                <div class="hero-slide" style="background-image: url(./Img/hero-carousel/7.jpg)"></div>
                <div class="hero-slide" style="background-image: url(./Img/utycc_buildings/front_view2.JPG)"></div>
                <div class="hero-slide" style="background-image: url(./Img/utycc_buildings/lab.JPG)"></div>
                <div class="hero-slide" style="background-image: url(./Img/utycc_buildings/lab3.JPG)"></div>
                <div class="hero-slide" style="background-image: url(./Img/utycc_buildings/lecture.JPG)"></div>
                <div class="hero-slide" style="background-image: url(./Img/utycc_buildings/workshop2.JPG)"></div>
            </div>
            <div class="hero-overlay bg-gradient-to-br from-blue-900/40 to-blue-500/20"></div>
            <div class="hero-content container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 leading-tight text-white" data-lang-key="hero_title">
                    University of Technology - Yatanarpon Cyber City
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto font-light" data-lang-key="hero_subtitle">
                    A Leading Engineering Institution for Sustainable Development
                </p>
                <a href="#enrollment-card"
                    class="bg-white text-blue-800 font-bold py-3 px-8 rounded-full hover:bg-gray-200 transition text-lg shadow-lg btn-hover-effect"
                    data-lang-key="hero_button">TO ENROLL</a>
            </div>
        </section>

        <!-- Stats Section -->
        <section id="stats-section" class="bg-blue-800 text-white">
            <div class="container mx-auto px-6 py-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div>
                        <i class="fas fa-calendar-alt text-3xl mb-2 text-blue-300"></i>
                        <p class="text-xl font-bold" data-lang-key="est">
                            Established 2010
                        </p>
                        <p class="text-sm text-blue-200" data-lang-key="stats_since">
                            Serving Since
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-users text-3xl mb-2 text-blue-300"></i>
                        <p class="text-xl font-bold" id="students-stat">~0</p>
                        <p class="text-sm text-blue-200" data-lang-key="stats_students">
                            Students
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-check-circle text-3xl mb-2 text-blue-300"></i>
                        <p class="text-xl font-bold" id="acceptance-rate-stat">~0%</p>
                        <p class="text-sm text-blue-200" data-lang-key="stats_acceptance">
                            Acceptance Rate
                        </p>
                    </div>
                    <div>
                        <i class="fas fa-award text-3xl mb-2 text-blue-300"></i>
                        <p class="text-xl font-bold">ISO 9001:2015</p>
                        <p class="text-sm text-blue-200" data-lang-key="stats_quality">
                            Certified Quality
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Main Content -->
        <main id="about" class="container mx-auto px-6 py-16">
            <!-- About Us Section -->
            <section class="mb-20">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1">
                        <h2 class="text-3xl font-bold text-blue-900 mb-4" data-lang-key="about_title">
                            Our Vision & Mission
                        </h2>
                        <p class="text-gray-700 mb-6 leading-relaxed" data-lang-key="about_p1">
                            Established on 17 October 2010, UTYCC is a public university
                            under the Ministry of Science and Technology, located in
                            Yatanarpon Cyber City, near Pyin Oo Lwin.
                        </p>
                        <div class="space-y-4">
                            <div>
                                <h3 class="font-semibold text-lg text-blue-900 flex items-center">
                                    <i class="fas fa-eye mr-3 text-blue-600"></i><span
                                        data-lang-key="vision_title">Vision</span>
                                </h3>
                                <p class="text-gray-600 ml-8" data-lang-key="vision_text">
                                    To be a leading engineering institution for sustainable
                                    development.
                                </p>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-blue-900 flex items-center">
                                    <i class="fas fa-bullseye mr-3 text-blue-600"></i><span
                                        data-lang-key="mission_title">Mission</span>
                                </h3>
                                <p class="text-gray-600 ml-8" data-lang-key="mission_text">
                                    To provide high-quality teaching, research, and socially
                                    responsible engineering education.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Star Container -->
                    <div class="star-wrapper">
                        <div class="star-center">
                            <img src="Img/logo/utycc_logo_favicon/apple-touch-icon.png" class="logo-badge static-logo "
                                alt="UTYCC" />
                        </div>

                        <div class="star-point " style="--angle: 0deg">
                            <a href="./Majors/ist.html">
                                <img src="Img/logo/IST.webp" class="logo-badge static-logo" alt="IST" />
                            </a>
                        </div>

                        <div class="star-point" style="--angle: 72deg">
                            <a href="./Majors/ce.html">
                                <img src="Img/logo/CE.webp" class="logo-badge static-logo" alt="CE" />
                            </a>
                        </div>
                        <div class="star-point" style="--angle: 144deg">
                            <a href="./Majors/ece.html">
                                <img src="Img/logo/EcE.jpg" class="logo-badge static-logo" alt="EcE" />
                            </a>
                        </div>
                        <div class="star-point" style="--angle: 216deg">
                            <a href="./Majors/pre.html">
                                <img src="Img/logo/PrE.png" class="logo-badge static-logo" alt="PrE" />
                            </a>
                        </div>
                        <div class="star-point" style="--angle: 288deg">
                            <a href="./Majors/ame.html">
                                <img src="Img/logo/AME_updated.jpg" class="logo-badge static-logo" alt="AmE" />
                            </a>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Academic Programs Section -->
            <section id="programs" class="mb-20 bg-white p-8 md:p-12 rounded-lg shadow-lg animate-on-scroll">
                <h2 class="text-3xl font-bold text-blue-900 mb-10 text-center" data-lang-key="programs_title">
                    Academic Programs
                </h2>
                <div class="mb-10">
                    <h3 class="text-2xl font-semibold text-blue-800 mb-6 border-b-2 border-blue-200 pb-2"
                        data-lang-key="bachelor_title">
                        Bachelor's Degrees (6 Years)
                    </h3>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6 card_1">
                        <a href="./Majors/ist.html" class="program-card" style="--i:1;">
                            <div class="card-hover-effect border border-gray-200 rounded-lg p-6 hover:border-blue-500 h-full"
                                data-program="ist">
                                <img src="Img\logo\IST.webp" alt="Information Science and Technology" />
                                <h3 class="text-lg font-bold text-blue-900" data-lang-key="program_ist">
                                    Information Science and Technology (IST)
                                </h3>
                            </div>
                        </a>
                        <a href="./Majors/ce.html" class="program-card" style="--i:2;">
                            <div class="card-hover-effect border border-gray-200 rounded-lg p-6 hover:border-blue-500 h-full"
                                data-program="ce">
                                <img src="Img\logo\CE.webp" alt="Computer Engineering" />
                                <h3 class="text-lg font-bold text-blue-900" data-lang-key="program_ce">
                                    Computer Engineering (CE)
                                </h3>
                            </div>
                        </a>
                        <a href="./Majors/ece.html" class="program-card" style="--i:3;">
                            <div class="card-hover-effect border border-gray-200 rounded-lg p-6 hover:border-blue-500 h-full"
                                data-program="ece">
                                <img src="Img/logo/EcE.jpg" alt="Electronics Engineering" />
                                <h3 class="text-lg font-bold text-blue-900" data-lang-key="program_ece">
                                    Electronics Engineering (EcE)
                                </h3>
                            </div>
                        </a>
                        <a href="./Majors/pre.html" class="program-card" style="--i:4;">
                            <div class="card-hover-effect border border-gray-200 rounded-lg p-6 hover:border-blue-500 h-full"
                                data-program="pre">
                                <img src="Img/logo/PrE.png" alt="Precision Engineering" />
                                <h3 class="text-lg font-bold text-blue-900" data-lang-key="program_pre">
                                    Precision Engineering (PrE)
                                </h3>
                            </div>
                        </a>
                        <a href="./Majors/ame.html" class="program-card" style="--i:5;">
                            <div class="card-hover-effect border border-gray-200 rounded-lg p-6 hover:border-blue-500 h-full"
                                data-program="ame">
                                <img src="Img\logo\Ame_updated.jpg" alt="Advanced Materials Engineering" />
                                <h3 class="text-lg font-bold text-blue-900" data-lang-key="program_ame">
                                    Advanced Materials Engineering (AME)
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-2xl font-semibold text-blue-800 mb-6 border-b-2 border-blue-200 pb-2"
                            data-lang-key="masters_title">
                            Master's Degrees (2 Years)
                        </h3>
                        <p class="text-gray-700" data-lang-key="masters_text">
                            Master's degrees are offered in IST, CE, ECE, AME, and PrE,
                            combining coursework and a thesis.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold text-blue-800 mb-6 border-b-2 border-blue-200 pb-2"
                            data-lang-key="phd_title">
                            Doctoral Degree (3 Years)
                        </h3>
                        <p class="text-gray-700" data-lang-key="phd_text">
                            A Ph.D. program is available in Information Technology.
                        </p>
                    </div>
                </div>
                <br>
                <br>
                <!-- Exam Results Section -->
                <div class="relative overflow-hidden shadow-lg group ">
                    <!-- Background Image with Overlay -->
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110" style="background-image: url('./Img/utycc_buildings/roadmap.JPG');"></div>
                    <div class="absolute inset-0 bg-black opacity-60"></div>

                    <!-- Content (Text and Button) -->
                    <div class="relative z-10 p-6 md:p-10 text-white flex flex-col items-center justify-center text-center min-h-[250px]">
                        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 drop-shadow-md">View Your Exam Results</h2>
                        <p class="max-w-md mb-8 text-sm md:text-base drop-shadow-sm">
                            Access your academic performance and check your latest exam results from all years and semesters.
                        </p>
                        <a href="./exam_results.html" class="inline-block px-8 py-3 bg-white text-blue-900 font-bold rounded-full shadow-lg transition-transform duration-300 transform-gpu hover:scale-105 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50">
                            Check Results
                        </a>
                    </div>
                </div>
            </section>


            <!-- International Collaboration Section -->
            <section id="collaboration" class="mb-16 animate-on-scroll">
                <h2 class="text-3xl font-bold text-blue-900 mb-8 text-center" data-lang-key="collab_title">
                    International Collaboration
                </h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-md flex items-center space-x-6 card-hover-effect">
                        <img src="https://placehold.co/100x100/3b82f6/ffffff?text=ACU" class="rounded-full"
                            alt="ACU Logo" />
                        <div>
                            <h3 class="text-xl font-semibold text-blue-900" data-lang-key="collab_acu_title">
                                ASEAN-KOREA Cyber University (ACU)
                            </h3>
                            <p class="text-gray-600 mt-1" data-lang-key="collab_acu_text">
                                Engaging in e-Learning projects to enhance digital education
                                across the region.
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-md flex items-center space-x-6 card-hover-effect">
                        <img src="https://placehold.co/100x100/16a34a/ffffff?text=MU" class="rounded-full"
                            alt="Miyazaki University Logo" />
                        <div>
                            <h3 class="text-xl font-semibold text-blue-900" data-lang-key="collab_mu_title">
                                Miyazaki University, Japan
                            </h3>
                            <p class="mt-1 shine_text" data-lang-key="collab_mu_text">
                                Offering a Double Master's Degree program, fostering
                                international academic exchange.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>


    <!-- Enrollment Section -->
    <section id="enrollment-card" class="relative bg-cover bg-center py-12 sm:py-20 px-4"
        style="background-image: url('./Img/utycc_buildings/front_view.JPG')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div
            class="relative container mx-auto max-w-5xl bg-white/90 backdrop-blur-sm rounded-lg shadow-2xl overflow-hidden animate-on-scroll">

            <!-- This part will be shown when enrollment is open -->
            <div id="enrollment-open" class="flex flex-col md:flex-row">
                <!-- New Students Card -->
                <div class="flex-1 p-6 sm:p-10 flex flex-col items-center justify-center text-center">
                    <h3 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-4 "
                        data-lang-key="enroll_new_title">
                        New Students
                    </h3>
                    <p class="text-base sm:text-lg text-gray-700 mb-6 max-w-sm" data-lang-key="enroll_new_text">
                        Start your journey with us! Click here to enroll for the upcoming
                        academic year.
                    </p>
                    <button id="new-student-enroll-trigger"
                        class="w-full sm:w-auto bg-blue-800 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 transition shadow-lg btn-hover-effect"
                        data-lang-key="enroll_new_button">
                        Enroll as a Fresher
                    </button>
                </div>

                <!-- Divider -->
                <div class="border-t md:border-t-0 md:border-l border-gray-300"></div>

                <!-- Current Students Card -->
                <div class="flex-1 p-6 sm:p-10 flex flex-col items-center justify-center text-center">
                    <h3 class="text-2xl sm:text-3xl font-bold text-blue-900 mb-4" data-lang-key="enroll_current_title">
                        Current Students
                    </h3>
                    <p class="text-base sm:text-lg text-gray-700 mb-6 max-w-sm" data-lang-key="enroll_current_text">
                        Welcome back! Continue your studies by enrolling for the next
                        year.
                    </p>
                    <button id="current-student-enroll-trigger"
                        class="w-full sm:w-auto bg-blue-800 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 transition shadow-lg btn-hover-effect"
                        data-lang-key="enroll_current_button">
                        Enroll for Next Year
                    </button>
                </div>
            </div>

            <!-- This part will be shown when enrollment is closed -->
            <div id="enrollment-closed" class="hidden">
                <div class="p-8 md:p-12 text-center w-full">
                    <div class="mx-auto bg-gray-200 w-32 h-32 rounded-full flex items-center justify-center mb-6">
                        <img src="./Img/logo/utycc_logo.png" alt="UTYCC Logo" class="p-2">
                    </div>
                    <h1 class="text-3xl font-bold text-red-600 mb-4" data-lang-key="admission_closed_title">
                        ADMISSIONS ARE CURRENTLY CLOSED
                    </h1>
                    <p class="text-gray-700 text-lg mb-8" data-lang-key="admission_closed_text">
                        Our university is not accepting new student applications at this time.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <div id="gameContainer" class="game-toast">
        <button id="closeGameBtn" class="close_button2">Close Game</button>
        <canvas id="gameCanvas"></canvas>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox">
        <span class="lightbox-close">&times;</span>
        <img class="lightbox-content" id="lightbox-img">
    </div>


    <!-- Footer -->
    <footer id="contact" class="bg-blue-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="animate-on-scroll" style="--i:1;">
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4 icon-hover-effect" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4">
                        <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address"
                            target="_blank">
                            Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay
                            Region, Myanmar
                        </a>
                    </p>
                    <div class="mt-4 text-sm text-blue-200">
                        <p>Email: info@utycc.edu.mm (example)</p>
                        <p>Phone: +95 (XX) XXX XXX (example)</p>
                    </div>
                </div>
                <div class="animate-on-scroll" style="--i:2;">
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">
                        Faculties
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="./Majors/ist.html" data-lang-key="footer_faculty_ist">Information Science
                                Technology</a>
                        </li>
                        <li>
                            <a href="./Majors/ce.html" data-lang-key="footer_faculty_ce">Computer Engineering</a>
                        </li>
                        <li>
                            <a href="./Majors/ece.html" data-lang-key="footer_faculty_ece">Electronics Engineering</a>
                        </li>
                        <li>
                            <a data-lang-key="footer_faculty_pre" href="./Majors/pre.html">Precision Engineering</a>
                        </li>
                        <li>
                            <a data-lang-key="footer_faculty_ame" href="./Majors/ame.html">Advanced Materials
                                Engineering</a>
                        </li>
                    </ul>
                </div>
                <div class="animate-on-scroll" style="--i:3;">
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
                        Quick Links
                    </h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="./terms.html" class="hover:text-white shine_text"
                                data-lang-key="footer_link_terms">Terms &
                                Policies</a>
                        </li>
                        <li>
                            <a href="./FAQs.html" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
                        </li>
                        <li>
                            <a href="./about.html" class="hover:text-white" data-lang-key="footer_link_about">About
                                Us</a>
                        </li>
                        <li>
                            <a href="./randr.html" class="hover:text-white" data-lang-key="footer_link_rules">Rules &
                                Regulations</a>

                        </li>
                        <li>
                            <a href="./data_protection.html" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a>
                        </li>
                    </ul>
                </div>
                <div class="animate-on-scroll" style="--i:4;">
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
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300"
                data-lang-key="footer_copyright">
                © 2025 University of Technology - Yatanarpon Cyber City. All
                Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top-btn" class="bg-blue-800 text-white w-12 h-12 rounded-full shadow-lg hover:bg-blue-700 focus:outline-none flex items-center justify-center btn-hover-effect">
        <i class="fas fa-arrow-up"></i>
    </button>


    <!-- Verification Modal -->
    <div id="verification-modal" class="modal-overlay hidden">
        <div class="auth-wrapper">
            <button id="modal-close-btn" class="modal-close-btn" aria-label="Close">
                &times;
            </button>
            <div class="shell">
                <header class="g-head">
                    <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="brand-logo" />
                    <h1 class="modal-h1" id="modal-title" data-lang-key="signup_title">
                        Create Account
                    </h1>
                    <p class="sub" id="modal-subtitle" data-lang-key="signup_subtitle">
                        to enroll at UTYCC
                    </p>
                </header>

                <!-- View for Sign Up -->
                <div id="view-signup" class="view active">
                    <form id="signup-form">
                        <div class="field">
                            <label for="signup-name" data-lang-key="signup_name_label">Name</label>
                            <input type="text" id="signup-name" class="input" placeholder="Your Full Name" required />
                        </div>
                        <div class="field">
                            <label for="signup-email" data-lang-key="signup_email_label">Email</label>
                            <input type="email" id="signup-email" class="input" placeholder="your.email@example.com"
                                required />
                        </div>
                        <div class="field">
                            <label for="signup-phone" data-lang-key="signup_phone_label">Phone Number</label>
                            <input type="tel" id="signup-phone" class="input" placeholder="e.g., 09xxxxxxxxx"
                                required />
                        </div>
                        <div class="terms">
                            <input type="checkbox" id="signup-terms" required />
                            <label for="signup-terms">
                                <span data-lang-key="signup_terms_agree">I agree to the</span>
                                <a href="/policy/policy_create.html" target="_blank" data-lang-key="signup_terms_link">Terms &
                                    Policy</a>
                            </label>
                        </div>
                        <button type="submit" id="signup-submit-btn" class="btn" disabled data-lang-key="signup_button">
                            Create Account
                        </button>
                    </form>
                    <p class="auth-toggle" data-lang-key="signup_toggle">
                        Already have an account? <a id="toggle-to-login-btn">Sign In</a>
                    </p>
                </div>

                <!-- View for Login -->
                <div id="view-login" class="view">
                    <form id="login-form">
                        <div class="field">
                            <label for="login-id" data-lang-key="login_id_label">Student ID</label>
                            <input type="text" id="login-id" class="input" placeholder="Your Student ID" required />
                        </div>
                        <div class="field">
                            <label for="login-password" data-lang-key="login_password_label">Password</label>
                            <input type="password" id="login-password" class="input" placeholder="Your Password"
                                required />
                        </div>
                        <button type="submit" class="btn" data-lang-key="login_button">
                            Sign In
                        </button>
                    </form>
                    <p class="auth-toggle" data-lang-key="login_toggle">
                        Don't have an account? <a id="toggle-to-signup-btn">Create one</a>
                    </p>
                </div>
            </div>
            <div class="image-panel">
                <img src="./Img/hero-carousel/3.JPG" style="opacity: 70%" alt="UTYCC Photo" />
            </div>
        </div>
    </div>

    <div class="toast-wrap"></div>

    <script>
        // --- DOM Elements ---
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        const langSwitcherDesktop = document.getElementById(
            "language-switcher-desktop"
        );
        const langSwitcherMobile = document.getElementById(
            "language-switcher-mobile"
        );

        const newStudentEnrollTrigger = document.getElementById(
            "new-student-enroll-trigger"
        );
        const currentStudentEnrollTrigger = document.getElementById(
            "current-student-enroll-trigger"
        );

        // --- Modal Elements ---
        const verificationModal = document.getElementById("verification-modal");
        const closeModalBtn = document.getElementById("modal-close-btn");
        const toastWrap = document.querySelector(".toast-wrap");
        const modalTitle = document.getElementById("modal-title");
        const modalSubtitle = document.getElementById("modal-subtitle");

        // Views
        const viewSignup = document.getElementById("view-signup");
        const viewLogin = document.getElementById("view-login");

        // Signup Form
        const signupForm = document.getElementById("signup-form");
        const signupTerms = document.getElementById("signup-terms");
        const signupSubmitBtn = document.getElementById("signup-submit-btn");

        // Login Form
        const loginForm = document.getElementById("login-form");

        // --- Easter Egg Game Elements ---
        const headerLogo = document.getElementById('header-logo-link');
        const gameContainer = document.getElementById('gameContainer');
        const closeGameBtn = document.getElementById('closeGameBtn');
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        // --- State ---
        let currentLang = "my";
        let logoClickCount = 0;
        const requiredClicks = 10;

        // --- Game State Variables ---
        let score = 0;
        let gameActive = false;
        let animationFrameId;
        let logoSpawnerInterval;
        const logoImg = new Image();
        logoImg.src = './Img/logo/utycc_logo_favicon/favicon.ico';
        const catcher = {
            x: 150,
            y: 350,
            width: 60,
            height: 10,
            color: '#3b82f6'
        };
        const fallingLogos = [];


        // --- Translations ---
        const translations = {
            my: {
                utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
                nav_about: "ကျွန်ုပ်တို့အကြောင်း",
                nav_programs: "ပညာရေးအစီအစဉ်များ",
                nav_collaboration: "ပူးပေါင်းဆောင်ရွက်မှု",
                nav_contact: "ဆက်သွယ်ရန်",
                nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
                nav_programs_mobile: "ပညာရေးအစီအစဉ်များ",
                nav_collaboration_mobile: "ပူးပေါင်းဆောင်ရွက်မှု",
                nav_contact_mobile: "ဆက်သွယ်ရန်",
                hero_title: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
                hero_subtitle: "စဉ်ဆက်မပြတ် ဖွံ့ဖြိုးတိုးတက်မှုအတွက် ဦးဆောင်အင်ဂျင်နီယာကျောင်း",
                hero_button: "ကျောင်းအပ်ရန်",
                stats_since: "တည်ထောင်ခဲ့သောနှစ်",
                stats_students: "ကျောင်းသား/သူများ",
                stats_acceptance: "ဝင်ခွင့်ရရှိနှုန်း",
                stats_quality: "အရည်အသွေး အသိအမှတ်ပြု",
                about_title: "ကျွန်ုပ်တို့၏ မျှော်မှန်းချက်နှင့် ရည်မှန်းချက်",
                about_p1: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး) ကို ၂၀၁၀ ခုနှစ်၊ အောက်တိုဘာလ ၁၇ ရက်နေ့တွင် သိပ္ပံနှင့်နည်းပညာဝန်ကြီးဌာန လက်အောက်၌ တည်ထောင်ခဲ့ပါသည်။ တက္ကသိုလ်သည် ပြင်ဦးလွင်မြို့အနီး၊ ရတနာပုံဆိုက်ဘာစီးတီးတွင် တည်ရှိသည်။",
                vision_title: "မျှော်မှန်းချက်",
                vision_text: "စဉ်ဆက်မပြတ် ဖွံ့ဖြိုးတိုးတက်မှုအတွက် ဦးဆောင်အင်ဂျင်နီယာကျောင်းတစ်ကျောင်း ဖြစ်လာစေရန်။",
                mission_title: "ရည်မှန်းချက်",
                mission_text: "အရည်အသွေးမြင့်မားသော သင်ကြားရေး၊ သုတေသနနှင့် လူမှုရေးအရ တာဝန်ယူမှုရှိသော အင်ဂျင်နီယာပညာရေးကို ပံ့ပိုးပေးရန်။",
                programs_title: "ပညာရေးအစီအစဉ်များ",
                bachelor_title: "ဘွဲ့ကြိုသင်တန်းများ (၆ နှစ်)",
                program_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                program_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                program_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                program_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                program_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                masters_title: "ဘွဲ့လွန်သင်တန်းများ (၂ နှစ်)",
                masters_text: "IST, CE, ECE, AME, နှင့် PrE ဘာသာရပ်များတွင် မဟာဘွဲ့သင်တန်းများကို သင်ကြားလျက်ရှိပြီး သင်တန်း coursework နှင့် ကျမ်းတစ်စောင် ပြုစုရန် လိုအပ်ပါသည်။",
                phd_title: "ပါရဂူဘွဲ့ (၃ နှစ်)",
                phd_text: "သတင်းအချက်အလက်နည်းပညာဘာသာရပ်တွင် ပါရဂူဘွဲ့ (Ph.D.) သင်တန်းကို တက်ရောက်နိုင်သည်။",
                collab_title: "နိုင်ငံတကာ ပူးပေါင်းဆောင်ရွက်မှု",
                collab_acu_title: "အာဆီယံ-ကိုရီးယား ဆိုက်ဘာတက္ကသိုလ် (ACU)",
                collab_acu_text: "ဒေသတွင်း ဒစ်ဂျစ်တယ်ပညာရေး မြှင့်တင်ရန်အတွက် e-Learning ပရောဂျက်များတွင် ပါဝင်ဆောင်ရွက်လျက်ရှိသည်။",
                collab_mu_title: "မီယာဇာကီ တက္ကသိုလ်၊ ဂျပန်",
                collab_mu_text: "နိုင်ငံတကာ ပညာရေးဖလှယ်မှုကို အားပေးသည့် နှစ်နိုင်ငံ မဟာဘွဲ့ ပရိုဂရမ်ကို ဖွင့်လှစ်ထားသည်။",
                news_title: "သတင်းနှင့် ကြေညာချက်များ",
                news_cat_announcement: "ကြေညာချက်",
                news_cat_event: "ပွဲလမ်းသဘင်",
                news_cat_research: "သုတေသန",
                news_date_1: "ဩဂုတ် ၂၈၊ ၂၀၂၅",
                news_title_1: "၂၀၂၅-၂၀၂၆ ပညာသင်နှစ်အတွက် ကျောင်းအပ်လက်ခံခြင်း",
                news_desc_1: "လာမည့် ပညာသင်နှစ်အတွက် ကျောင်းအပ်လက်ခံမည့်ရက်နှင့် လိုအပ်ချက်များအကြောင်း အသေးစိတ်ကို ဤနေရာတွင် ကြည့်ရှုနိုင်ပါသည်။",
                news_date_2: "ဩဂုတ် ၁၅၊ ၂၀၂၅",
                news_title_2: "UTYCC နည်းပညာပြပွဲနှင့် အလုပ်အကိုင်အခွင့်အလမ်းပွဲတော်",
                news_desc_2: "ကျောင်းသားများ၏ တီထွင်ဖန်တီးမှုများကို ပြသပြီး ထိပ်တန်းကုမ္ပဏီများနှင့် တွေ့ဆုံနိုင်မည့် အခွင့်အရေး။",
                news_date_3: "ဇူလိုင် ၃၀၊ ၂၀၂၅",
                news_title_3: "AME ဌာနမှ သုတေသနစာတမ်းသစ် ထုတ်ဝေခြင်း",
                news_desc_3: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာဌာနမှ နောက်ဆုံးထုတ်ဝေလိုက်သော နာနိုနည်းပညာဆိုင်ရာ သုတေသနစာတမ်း။",
                news_read_more: "ဆက်လက်ဖတ်ရှုရန်",
                gallery_title: "ကျောင်းတွင်းဘဝပုံရိပ်များ",
                enroll_new_title: "ကျောင်းသား/သူအသစ်များ",
                enroll_new_text: "သင်၏ ပညာရေးခရီးကို ကျွန်ုပ်တို့နှင့်အတူ စတင်လိုက်ပါ။ လာမည့် ပညာသင်နှစ်အတွက် ကျောင်းအပ်ရန် ဤနေရာကို နှိပ်ပါ။",
                enroll_new_button: "ကျောင်းသား/သူအသစ်အဖြစ် စာရင်းသွင်းရန်",
                enroll_current_title: "လက်ရှိကျောင်းသား/သူများ",
                enroll_current_text: "ပြန်လည်ကြိုဆိုပါသည်။ နောက်နှစ်အတွက် ကျောင်းအပ်ခြင်းဖြင့် သင်၏ပညာရေးကို ဆက်လက်သင်ယူပါ။",
                enroll_current_button: "နောက်နှစ်အတွက် စာရင်းသွင်းရန်",
                footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
                footer_faculties_title: "မဟာဌာနများ",
                footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
                footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
                footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ",
                footer_link_faq: "အမေးများသော မေးခွန်းများ",
                footer_link_about: "ကျွန်ုပ်တို့အကြောင်း",
                footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
                footer_follow_title: "Follow Us",
                footer_copyright: "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
                signup_title: "အကောင့်ပြုလုပ်ရန်",
                signup_subtitle: "UTYCC တွင်ကျောင်းအပ်ရန်",
                signup_name_label: "အမည်",
                signup_email_label: "အီးမေးလ်",
                signup_phone_label: "ဖုန်းနံပါတ်",
                signup_terms_agree: "ကျွန်ုပ်သည်",
                signup_terms_link: "စည်းမျဉ်းများနှင့် မူဝါဒများ ကိုသဘောတူပါသည်။",
                signup_button: "အကောင့်ပြုလုပ်မည်",
                signup_toggle: "အကောင့်ရှိပြီးသားလား? <a id='toggle-to-login-btn'>ဝင်ရောက်ရန်</a>",
                login_title: "ဝင်ရောက်ရန်",
                login_subtitle: "သင်၏အကောင့်သို့",
                login_id_label: "ကျောင်းသား ID",
                login_password_label: "စကားဝှက်",
                login_button: "ဝင်ရောက်မည်",
                login_toggle: "အကောင့်မရှိသေးဘူးလား? <a id='toggle-to-signup-btn'>အသစ်ပြုလုပ်ရန်</a>",
                admission_closed_title: "ကျောင်းအပ်လက်ခံခြင်း ယာယီပိတ်ထားပါသည်",
                admission_closed_text: "တက္ကသိုလ်မှ ကျောင်းသား/သူအသစ်များ လက်ခံခြင်းကို လက်ရှိတွင် ရပ်ဆိုင်းထားပါသည်။",
                footer_link_dp: "ဒေတာကာကွယ်ရေး",

            },
            en: {
                utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
                nav_about: "About Us",
                nav_programs: "Academic Programs",
                nav_collaboration: "Collaboration",
                nav_contact: "Contact",
                nav_about_mobile: "About Us",
                nav_programs_mobile: "Academic Programs",
                nav_collaboration_mobile: "Collaboration",
                nav_contact_mobile: "Contact",
                hero_title: "University of Technology - Yatanarpon Cyber City",
                hero_subtitle: "A Leading Engineering Institution for Sustainable Development",
                hero_button: "TO ENROLL",
                stats_since: "Serving Since",
                stats_students: "Students",
                stats_acceptance: "Acceptance Rate",
                stats_quality: "Certified Quality",
                about_title: "Our Vision & Mission",
                about_p1: "Established on 17 October 2010, UTYCC is a public university under the Ministry of Science and Technology, located in Yatanarpon Cyber City, near Pyin Oo Lwin.",
                vision_title: "Vision",
                vision_text: "To be a leading engineering institution for sustainable development.",
                mission_title: "Mission",
                mission_text: "To provide high-quality teaching, research, and socially responsible engineering education.",
                programs_title: "Academic Programs",
                bachelor_title: "Bachelor's Degrees (6 Years)",
                program_ist: "Information Science and Technology (IST)",
                program_ce: "Computer Engineering (CE)",
                program_ece: "Electronics Engineering (EcE)",
                program_pre: "Precision Engineering (PrE)",
                program_ame: "Advanced Materials Engineering (AME)",
                masters_title: "Master's Degrees (2 Years)",
                masters_text: "Master's degrees are offered in IST, CE, ECE, AME, and PrE, combining coursework and a thesis.",
                phd_title: "Doctoral Degree (3 Years)",
                phd_text: "A Ph.D. program is available in Information Technology.",
                collab_title: "International Collaboration",
                collab_acu_title: "ASEAN-KOREA Cyber University (ACU)",
                collab_acu_text: "Engaging in e-Learning projects to enhance digital education across the region.",
                collab_mu_title: "Miyazaki University, Japan",
                collab_mu_text: "Offering a Double Master's Degree program, fostering international academic exchange.",
                news_title: "News & Announcements",
                news_cat_announcement: "Announcement",
                news_cat_event: "Event",
                news_cat_research: "Research",
                news_date_1: "August 28, 2025",
                news_title_1: "Enrollment for 2025-2026 Academic Year",
                news_desc_1: "Details about the upcoming academic year's enrollment dates and requirements are now available here.",
                news_date_2: "August 15, 2025",
                news_title_2: "UTYCC Tech Expo and Career Fair",
                news_desc_2: "An opportunity to showcase student innovations and connect with leading tech companies.",
                news_date_3: "July 30, 2025",
                news_title_3: "New Research Paper Published by AME Department",
                news_desc_3: "The latest research paper on nanotechnology from the Advanced Materials Engineering department.",
                news_read_more: "Read More",
                gallery_title: "Campus Life Photo Gallery",
                enroll_new_title: "New Students",
                enroll_new_text: "Start your journey with us! Click here to enroll for the upcoming academic year.",
                enroll_new_button: "Enroll as a Fresher",
                enroll_current_title: "Current Students",
                enroll_current_text: "Welcome back! Continue your studies by enrolling for the next year.",
                enroll_current_button: "Enroll for Next Year",
                footer_address: "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
                footer_faculties_title: "Faculties",
                footer_faculty_ist: "Information Science Technology",
                footer_faculty_ce: "Computer Engineering",
                footer_faculty_ece: "Electronics Engineering",
                footer_faculty_ame: "Advanced Materials Engineering",
                footer_faculty_pre: "Precision Engineering",
                footer_quick_links_title: "Quick Links",
                footer_link_terms: "Terms & Policies",
                footer_link_faq: "FAQs",
                footer_link_about: "About Us",
                footer_link_rules: "Rules & Regulations",
                footer_follow_title: "Follow Us",
                footer_copyright: "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
                signup_title: "Create Account",
                signup_subtitle: "to enroll at UTYCC",
                signup_name_label: "Name",
                signup_email_label: "Email",
                signup_phone_label: "Phone Number",
                signup_terms_agree: "I agree to the",
                signup_terms_link: "Terms & Policy",
                signup_button: "Create Account",
                signup_toggle: "Already have an account? <a id='toggle-to-login-btn'>Sign In</a>",
                login_title: "Sign In",
                login_subtitle: "to your account",
                login_id_label: "Student ID",
                login_password_label: "Password",
                login_button: "Sign In",
                login_toggle: "Don't have an account? <a id='toggle-to-signup-btn'>Create one</a>",
                admission_closed_title: "ADMISSIONS ARE CURRENTLY CLOSED",
                admission_closed_text: "Our university is not accepting new student applications at this time.",
                footer_link_dp: "Data Protection",
            },
        };

        // --- Functions ---
        function setLanguage(lang) {
            currentLang = lang;
            localStorage.setItem("selectedLanguage", lang);
            document.querySelectorAll("[data-lang-key]").forEach((el) => {
                const key = el.getAttribute("data-lang-key");
                if (translations[lang] && translations[lang][key]) {
                    el.innerHTML = translations[lang][key];
                }
            });
            // Re-add event listeners for toggles after innerHTML is changed
            document
                .getElementById("toggle-to-login-btn")
                .addEventListener("click", () => switchView("login"));
            document
                .getElementById("toggle-to-signup-btn")
                .addEventListener("click", () => switchView("signup"));

            langSwitcherDesktop.value = lang;
            langSwitcherMobile.value = lang;
        }

        function showToast(message, type = "success", duration = 4000) {
            const toast = document.createElement("div");
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span>${message}</span><button class="close-btn" aria-label="Close">×</button>`;
            const removeToast = () => toast.remove();
            toast
                .querySelector(".close-btn")
                .addEventListener("click", removeToast);
            toastWrap.appendChild(toast);
            setTimeout(removeToast, duration);
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function switchView(viewName) {
            if (viewName === "login") {
                viewSignup.classList.remove("active");
                viewLogin.classList.add("active");
                modalTitle.setAttribute("data-lang-key", "login_title");
                modalSubtitle.setAttribute("data-lang-key", "login_subtitle");
            } else {
                viewLogin.classList.remove("active");
                viewSignup.classList.add("active");
                modalTitle.setAttribute("data-lang-key", "signup_title");
                modalSubtitle.setAttribute("data-lang-key", "signup_subtitle");
            }
            // Re-translate the modal title and subtitle
            setLanguage(currentLang);
        }

        // --- Game Functions ---
        function resizeCanvas() {
            const gameToast = document.getElementById('gameContainer');
            const buttonHeight = document.getElementById('closeGameBtn').offsetHeight;
            canvas.width = gameToast.clientWidth;
            canvas.height = gameToast.clientHeight - buttonHeight;
            catcher.y = canvas.height - 20;
            catcher.x = (canvas.width / 2) - (catcher.width / 2);
        }

        function spawnLogo() {
            if (gameActive) {
                fallingLogos.push({
                    x: Math.random() * (canvas.width - 24),
                    y: -24,
                    width: 24,
                    height: 24,
                    speed: 1.5 + Math.random() * 2
                });
            }
        }

        function gameLoop() {
            if (!gameActive) return;

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw catcher
            ctx.fillStyle = catcher.color;
            ctx.fillRect(catcher.x, catcher.y, catcher.width, catcher.height);

            // Update and draw logos
            for (let i = fallingLogos.length - 1; i >= 0; i--) {
                const logo = fallingLogos[i];
                logo.y += logo.speed;
                ctx.drawImage(logoImg, logo.x, logo.y, logo.width, logo.height);

                // Collision detection
                if (
                    logo.x < catcher.x + catcher.width &&
                    logo.x + logo.width > catcher.x &&
                    logo.y + logo.height > catcher.y &&
                    logo.y < catcher.y + catcher.height
                ) {
                    score++;
                    fallingLogos.splice(i, 1);
                } else if (logo.y > canvas.height) {
                    fallingLogos.splice(i, 1);
                }
            }

            // Draw score
            ctx.fillStyle = '#1e3a8a';
            ctx.font = '16px Inter, sans-serif';
            ctx.fillText('Score: ' + score, 10, 25);

            animationFrameId = requestAnimationFrame(gameLoop);
        }

        function startGame() {
            if (gameActive) return;
            gameActive = true;
            score = 0;
            fallingLogos.length = 0;
            resizeCanvas();
            logoSpawnerInterval = setInterval(spawnLogo, 900);
            gameLoop();
        }

        function stopGame() {
            gameActive = false;
            cancelAnimationFrame(animationFrameId);
            clearInterval(logoSpawnerInterval);
        }

        // --- Event Listeners ---

        mobileMenuButton.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        langSwitcherDesktop.addEventListener("change", (e) =>
            setLanguage(e.target.value)
        );
        langSwitcherMobile.addEventListener("change", (e) =>
            setLanguage(e.target.value)
        );

        // --- Modal Logic ---
        newStudentEnrollTrigger.addEventListener("click", () => {
            verificationModal.classList.remove("hidden");
            switchView("signup");
        });

        currentStudentEnrollTrigger.addEventListener("click", () => {
            verificationModal.classList.remove("hidden");
            switchView("login");
        });

        closeModalBtn.addEventListener("click", () => {
            verificationModal.classList.add("hidden");
        });

        verificationModal.addEventListener("click", (e) => {
            if (e.target === verificationModal) {
                verificationModal.classList.add("hidden");
            }
        });

        document
            .getElementById("toggle-to-login-btn")
            .addEventListener("click", () => switchView("login"));
        document
            .getElementById("toggle-to-signup-btn")
            .addEventListener("click", () => switchView("signup"));

        signupTerms.addEventListener("input", () => {
            signupSubmitBtn.disabled = !signupTerms.checked;
        });

        signupForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const name = document.getElementById("signup-name").value.trim();
            const email = document.getElementById("signup-email").value.trim();
            const phone = document.getElementById("signup-phone").value.trim();

            if (!name) {
                showToast("Please enter your name.", "error");
                return;
            }
            if (!isValidEmail(email)) {
                showToast("Please enter a valid email.", "error");
                return;
            }
            if (!phone) {
                showToast("Please enter your phone number.", "error");
                return;
            }

            showToast(
                "Account creation successful! Please wait for admin approval.",
                "success"
            );
            setTimeout(() => verificationModal.classList.add("hidden"), 2000);
        });

        loginForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const studentId = document.getElementById("login-id").value.trim();
            const password = document.getElementById("login-password").value.trim();

            if (!studentId || !password) {
                showToast("Please enter both ID and Password.", "error");
                return;
            }

            showToast("Login successful! Welcome back.", "success");
            setTimeout(() => verificationModal.classList.add("hidden"), 2000);
        });

        // --- GSAP Animation for Stats ---
        const statsSection = document.getElementById('stats-section');
        const studentsStat = document.getElementById('students-stat');
        const acceptanceRateStat = document.getElementById('acceptance-rate-stat');

        const animateStat = (element, endValue, prefix = '', suffix = '', decimals = 0) => {
            const counter = {
                value: 0
            };
            gsap.to(counter, {
                value: endValue,
                duration: 2,
                ease: "power1.out",
                onUpdate: () => {
                    element.textContent = `${prefix}${Math.round(counter.value).toLocaleString()}${suffix}`;
                }
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStat(studentsStat, 3000, '~');
                    animateStat(acceptanceRateStat, 21, '~', '%');
                    observer.unobserve(statsSection); // Animate only once
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of the element is visible
        });

        observer.observe(statsSection);

        // --- Easter Egg Game Logic ---
        headerLogo.addEventListener('click', (event) => {
            event.preventDefault();
            logoClickCount++;
            if (logoClickCount >= requiredClicks) {
                gameContainer.classList.add('show');
                startGame();
                logoClickCount = 0;
            }
        });

        closeGameBtn.addEventListener('click', () => {
            gameContainer.classList.remove('show');
            stopGame();
            logoClickCount = 0;
        });

        canvas.addEventListener('mousemove', e => {
            if (!gameActive) return;
            const rect = canvas.getBoundingClientRect();
            let mouseX = e.clientX - rect.left;
            catcher.x = mouseX - catcher.width / 2;
            if (catcher.x < 0) catcher.x = 0;
            if (catcher.x + catcher.width > canvas.width) catcher.x = canvas.width - catcher.width;
        });


        // --- Initial Page Load ---
        window.onload = function() {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('hidden');
        };

        document.addEventListener("DOMContentLoaded", () => {
            // --- Custom Language Switcher Logic ---
            function setupLangSwitcher(type) { // type is 'desktop' or 'mobile'
                const container = document.getElementById(`lang-switcher-container-${type}`);
                if (!container) return;

                const button = container.querySelector('.lang-switcher-button');
                const menu = container.querySelector('.lang-switcher-menu');
                const options = container.querySelectorAll('.lang-switcher-option');
                const selectedFlag = document.getElementById(`selected-lang-flag-${type}`);
                const selectedText = document.getElementById(`selected-lang-text-${type}`);
                const hiddenSelect = document.getElementById(`language-switcher-${type}`);
                
                const optionDetails = {
                    my: { text: 'မြန်မာ', flag: 'https://flagcdn.com/w20/mm.png' },
                    en: { text: 'English', flag: 'https://flagcdn.com/w20/gb.png' }
                };

                // Function to update the button's appearance
                function updateButton(lang) {
                    if (optionDetails[lang]) {
                        selectedFlag.src = optionDetails[lang].flag;
                        selectedText.textContent = optionDetails[lang].text;
                    }
                }

                // Toggle menu visibility
                button.addEventListener('click', (e) => {
                    e.stopPropagation();
                    // Close other switcher if open
                    const otherType = type === 'desktop' ? 'mobile' : 'desktop';
                    const otherMenu = document.querySelector(`#lang-switcher-container-${otherType} .lang-switcher-menu`);
                    if (otherMenu) otherMenu.classList.add('hidden');

                    menu.classList.toggle('hidden');
                });

                // Handle option selection
                options.forEach(option => {
                    option.addEventListener('click', (e) => {
                        e.preventDefault();
                        const lang = option.getAttribute('data-lang');
                        
                        // Update the hidden select and trigger its change event
                        hiddenSelect.value = lang;
                        hiddenSelect.dispatchEvent(new Event('change'));
                        
                        // Close menu
                        menu.classList.add('hidden');
                    });
                });

                // Listen to the original select's changes to update the custom button
                // This keeps everything in sync, even if something else changes the select's value
                hiddenSelect.addEventListener('change', () => {
                    updateButton(hiddenSelect.value);
                });

                // Set initial state from the hidden select
                updateButton(hiddenSelect.value);
            }
            
            setupLangSwitcher('desktop');
            setupLangSwitcher('mobile');

            // Close dropdowns when clicking outside
            document.addEventListener('click', () => {
                document.querySelectorAll('.lang-switcher-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });

            const savedLang = localStorage.getItem("selectedLanguage") || "my";
            setLanguage(savedLang);

            // --- Enrollment Status Check ---
            const enrollmentStatus = localStorage.getItem('enrollmentStatus');
            const enrollmentOpenSection = document.getElementById('enrollment-open');
            const enrollmentClosedSection = document.getElementById('enrollment-closed');

            if (enrollmentStatus === 'closed') {
                if (enrollmentOpenSection) enrollmentOpenSection.style.display = 'none';
                if (enrollmentClosedSection) enrollmentClosedSection.classList.remove('hidden');
            }

            // Close mobile menu when a nav link is clicked
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            });

            // --- Scroll Animation Observer ---
            const animatedElements = document.querySelectorAll('.animate-on-scroll');

            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        scrollObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1 // Trigger when 10% of the element is visible
            });

            animatedElements.forEach(el => {
                scrollObserver.observe(el);
            });

            // --- Hero Slideshow Logic ---
            const slides = document.querySelectorAll('.hero-slide');
            let currentSlide = 0;

            if (slides.length > 0) {
                // Ensure only the first slide is active initially
                slides.forEach((slide, index) => {
                    if (index === 0) {
                        slide.classList.add('active');
                    } else {
                        slide.classList.remove('active');
                    }
                });

                setInterval(() => {
                    slides[currentSlide].classList.remove('active');
                    currentSlide = (currentSlide + 1) % slides.length;
                    slides[currentSlide].classList.add('active');
                }, 5000); // Change image every 5 seconds
            }

            // --- Back to Top Button Logic ---
            const backToTopBtn = document.getElementById('back-to-top-btn');

            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) { // Show button after scrolling 300px
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // --- Lightbox Logic ---
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const galleryItems = document.querySelectorAll('.gallery-item');
            const lightboxClose = document.querySelector('.lightbox-close');

            galleryItems.forEach(item => {
                item.addEventListener('click', () => {
                    const imgSrc = item.querySelector('img').src;
                    lightboxImg.src = imgSrc;
                    lightbox.classList.add('show');
                });
            });

            const closeLightbox = () => {
                lightbox.classList.remove('show');
            }

            lightboxClose.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });

        });
    </script>

    <!-- animation script -->
    <script>
        gsap.from(".order-2 h2", {
            opacity: 0,
            y: -20,
            duration: 2,
            ease: "power3.out",
            onComplete: () => {
                gsap.to(".order-2 h2", {
                    borderBottom: "3px solid #1e3a8a", // Tailwind blue-900
                    duration: 1,
                });
            },
        });
        gsap.from(".order-2 h3, .order-2 p.text-gray-600", {
            opacity: 0,
            x: -50,
            duration: 2,
            stagger: 1,
            ease: "back.out(1.7)",
        });
    </script>

   
    
</body>

</html>
