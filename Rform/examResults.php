<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../CSS/shine_text.css">
    <link rel="stylesheet" href="../CSS/star-layout.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="../CSS/footer.css" />
    <script src="../JS/star-layout.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>University of Technology - Yatanarpon Cyber City (UTYCC)</title>
    <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/font.css" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f1f5f9;
    }
    .loading-spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
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
  </style>
</head>
<body>
  <!-- Navigation Bar -->
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
        <a href="examResults.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
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
        <a href="../about.php" class="block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_about_mobile">About Us</a>
        <a href="../activity.php" class="block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_activity_mobile">Activities</a>
        <a href="examResults.php" class="block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_examresult_mobile">Exam Results</a>
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
  <!-- Main Content for Exam Results -->
  
    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 text-center mb-6" data-lang-key="exam_result">View Exam Results</h2>
            <form method="GET" action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="year" data-lang-key="yr">Year</label>
                        <select name="year" id="year" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" data-lang-key="yrs">Select Year</option>
                            <option value="1" data-lang-key="firsty" <?= (isset($_GET['year']) && $_GET['year'] == '1') ? 'selected' : '' ?>>1st Year</option>
                            <option value="2" data-lang-key="secondy" <?= (isset($_GET['year']) && $_GET['year'] == '2') ? 'selected' : '' ?>>2nd Year</option>
                            <option value="3" data-lang-key="thirdy" <?= (isset($_GET['year']) && $_GET['year'] == '3') ? 'selected' : '' ?>>3rd Year</option>
                            <option value="4" data-lang-key="fourthy" <?= (isset($_GET['year']) && $_GET['year'] == '4') ? 'selected' : '' ?>>4th Year</option>
                            <option value="5" data-lang-key="fifthy" <?= (isset($_GET['year']) && $_GET['year'] == '5') ? 'selected' : '' ?>>5th Year</option>
                            <option value="6" data-lang-key="sixthy" <?= (isset($_GET['year']) && $_GET['year'] == '6') ? 'selected' : '' ?>>Final Year</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="semester"data-lang-key="sem">Semester</label>
                        <select name="semester" id="semester" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" data-lang-key="sems">Select Semester</option>
                            <option value="1" data-lang-key="firsts" <?= (isset($_GET['semester']) && $_GET['semester'] == '1') ? 'selected' : '' ?>>1st Semester</option>
                            <option value="2" data-lang-key="seconds" <?= (isset($_GET['semester']) && $_GET['semester'] == '2') ? 'selected' : '' ?>>2nd Semester</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="major" data-lang-key="major">Major</label>
                        <select name="major" id="major" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" data-lang-key="maj">Select Major</option>
                            <option value="ist" data-lang-key="ist" <?= (isset($_GET['major']) && $_GET['major'] == 'ist') ? 'selected' : '' ?>>IST</option>
                            <option value="ce" data-lang-key="ce" <?= (isset($_GET['major']) && $_GET['major'] == 'ce') ? 'selected' : '' ?>>CE</option>
                            <option value="ece" data-lang-key="ece" <?= (isset($_GET['major']) && $_GET['major'] == 'ece') ? 'selected' : '' ?>>ECE</option>
                            <option value="pre" data-lang-key="pre" <?= (isset($_GET['major']) && $_GET['major'] == 'pre') ? 'selected' : '' ?>>PRE</option>
                            <option value="ame" data-lang-key="ame" <?= (isset($_GET['major']) && $_GET['major'] == 'ame') ? 'selected' : '' ?>>AME</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-transform transform hover:scale-105" data-lang-key="sh_re">
                        Show Results
                    </button>
                </div>
            </form>

            <div class="mt-8">
            <?php
            // Include the database connection file
            require_once 'db.php';

            if (isset($_GET['year']) && isset($_GET['semester']) && isset($_GET['major'])) {
                $year = $_GET['year'];
                $semester = $_GET['semester'];
                $major = $_GET['major'];

                if (!empty($year) && !empty($semester) && !empty($major)) {
                    try {
                        // --- FIXED PART ---
                        // Remove "LIMIT 4" to show all matching results
                        $stmt = $pdo->prepare("SELECT image_path FROM exam_results WHERE year = ? AND semester = ? AND major = ? ORDER BY uploaded_at DESC");
                        $stmt->execute([$year, $semester, $major]);
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($results) {
                            echo '<div class="bg-gray-50 p-4 rounded-lg shadow-inner">';
                            echo '<h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Exam Results Found (' . count($results) . ' images)</h3>';
                            echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';

                            foreach ($results as $result) {
                                $imagePath = htmlspecialchars($result['image_path']);
                                echo '<div class="relative group border rounded-lg overflow-hidden shadow-sm">';
                                echo '<img src="' . $imagePath . '" alt="Exam Result" class="w-full h-auto cursor-pointer result-image transition-transform transform group-hover:scale-105" />';
                                echo '<a href="' . $imagePath . '" download class="absolute bottom-2 right-2 bg-blue-600 text-white text-xs font-bold py-1.5 px-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                    Save
                                  </a>';
                                echo '</div>';
                            }

                            echo '</div></div>';
                        } else {
                            echo '<div class="bg-yellow-100 p-4 rounded-lg shadow-inner text-center text-yellow-800 border border-yellow-300">';
                            echo '<p class="font-semibold">No exam result found for the selected criteria.</p>';
                            echo '</div>';
                        }
                    } catch (PDOException $e) {
                        echo '<div class="bg-red-100 p-4 rounded-lg shadow-inner text-center text-red-800 border border-red-300">';
                        echo '<p class="font-semibold">Database error: Unable to fetch results.</p>';
                        // For debugging: error_log($e->getMessage());
                        echo '</div>';
                    }
                } else if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($_GET['year']) || isset($_GET['semester']) || isset($_GET['major']))) {
                    echo '<div class="bg-blue-100 p-4 rounded-lg shadow-inner text-center text-blue-800 border border-blue-300">';
                    echo '<p class="font-semibold">Please select all fields (Year, Semester, and Major) to view the results.</p>';
                    echo '</div>';
                }
            }
            ?>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center p-4 z-[999] hidden transition-opacity duration-300">
        <div class="relative bg-white p-2 rounded-lg max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="Enlarged Exam Result" class="max-w-full max-h-[90vh] object-contain">
            <button id="closeModal" class="absolute -top-3 -right-3 text-white bg-gray-800 rounded-full p-1.5 hover:bg-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

 <!-- Footer -->
    <footer id="contact" class="bg-blue-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4">
                        <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
                            Yatanarpon Cyber City,<br />Near Pyin Oo Lwin,<br />Mandalay Region, Myanmar
                        </a>
                    </p>
                    <div class="mt-4 text-sm text-blue-200">
                        <p>Email: info@utycc.edu.mm (example)</p>
                        <p>Phone: +95 (XX) XXX XXX (example)</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">Faculties</h3>
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
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">Quick Links</h3>
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
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">Follow Us</h3>
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
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300" data-lang-key="footer_copyright">
                &copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.
            </div>
        </div>
    </footer>
    
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const translations = {
            my: {
                utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
                nav_about: "ကျွန်ုပ်တို့အကြောင်း",
                nav_activity: "လှုပ်ရှားမှုများ",
                nav_examresult: "အောင်စာရင်း",
                nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
                nav_activity_mobile: "လှုပ်ရှားမှုများ",
                nav_examresult_mobile: "အောင်စာရင်း",
                footer_address: "ရတနာပုံဆိုက်ဘာစီးတီး၊ \nပြင်ဦးလွင်မြို့အနီး၊ \nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
                footer_faculties_title: "မဟာဌာနများ",
                footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင် နီယာ",
                footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                footer_contact_title: "ဆက်သွယ် ရန်",
                footer_follow_title: "Follow Us",
                footer_copyright: "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။  မူပိုင်ခွင့်များ ရယူပြီး။",
                footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
                footer_link_terms: "စည်း မျဉ်းများ နှင့် မူဝါဒများ",
                footer_link_faq: "အမေးများသော မေးခွန်း များ",
                footer_link_about: "ကျွန်ုပ် တို့အကြောင်း",
                footer_link_rules: "စည်းကမ်း များနှင့်  စည်းမျဉ်းများ",
                footer_link_dp: "ဒေတာကာကွယ်ရေး",
                exam_result: "ကျောင်းသား စာမေးပွဲ ရလဒ်များ",
                exam_exp: "သင်၏ ပညာရေး အသေးစိတ်ကို ရွေးချယ်၍ သင်၏ ရလဒ်များကို ကြည့်ရှုပါ။",
                yr: "စာသင်နှစ်",
                yrs: "စာသင်နှစ် ရွေးချယ်ပါ",
                ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
                ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
                ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
                pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
                ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင် နီယာ",
                sem: "သင်တန်း",
                sems: "သင်တန်း ရွေးချယ်ပါ",
                major: "အထူးပြုဘာသာရပ်",
                maj: "အထူးပြုဘာသာရပ် ရွေးချယ်ပါ",
                firsty: "ပထမနှစ်",
                secondy: "ဒုတိယနှစ်",
                thirdy: "တတိယနှစ်",
                fourthy: "စတုတ္ထနှစ်",
                fifthy: "ပဉ္စမနှစ်",
                sixthy: "နောက်ဆုံးနှစ်",
                firsts: "ပထမသင်တန်း",
                seconds: "ဒုတိယသင်တန်း",
                Go_Back: "နောက်သို့ ပြန်သွားရန်",
                sh_re: "ရလဒ် ပြပါ",
            },
            en: {
                utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
                nav_about: "About Us",
                nav_activity: "Activities",
                nav_examresult: "Exam Results",
                nav_about_mobile: "About Us",
                nav_activity_mobile: "Activities",
                nav_examresult_mobile: "Exam Results",
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
                footer_link_dp: "Data Protection",
                exam_result: "Student Exam Results",
                exam_exp: "Select your academic details to view your results.",
                yr: "Year",
                yrs: "Select Year",
                ist: "Information Science Technology",
                ce: "Computer Engineering",
                ece: "Electronics Engineering",
                pre: "Precision Engineering",
                ame: "Advanced Materials Engineering",
                sem: "Semester",
                sems: "Select Semester",
                major: "Major",
                maj: "Select Major",
                firsty: "1st Year",
                secondy: "2nd Year",
                thirdy: "3rd Year",
                fourthy: "4th Year",
                fifthy: "5th Year",
                sixthy: "Final Year",
                firsts: "1st Semester",
                seconds: "2nd Semester",
                Go_Back: "Go Back",
                sh_re: "Show Results",
            },
        };

        // --- Language Function ---
        const changeLanguage = (lang) => {
            localStorage.setItem("language", lang);
            document.getElementById('language-switcher-desktop').value = lang;
            document.getElementById('language-switcher-mobile').value = lang;

            const optionDetails = {
                my: { text: 'မြန်မာ', flag: 'https://flagcdn.com/w20/mm.png' },
                en: { text: 'English', flag: 'https://flagcdn.com/w20/gb.png' }
            };

            if (optionDetails[lang]) {
                ['desktop', 'mobile'].forEach(type => {
                    const flag = document.getElementById(`selected-lang-flag-${type}`);
                    const text = document.getElementById(`selected-lang-text-${type}`);
                    if (flag && text) {
                        flag.src = optionDetails[lang].flag;
                        text.textContent = optionDetails[lang].text;
                    }
                });
            }

            document.querySelectorAll("[data-lang-key]").forEach((element) => {
                const key = element.dataset.langKey;
                const translation = translations[lang]?.[key];
                if (translation) {
                    element.innerHTML = translation.replace(/\\n/g, "<br>");
                }
            });
        };
        
        // --- Setup Language Switchers ---
        function setupLangSwitcher(type) {
            const container = document.getElementById(`lang-switcher-container-${type}`);
            if (!container) return;

            const button = container.querySelector('.lang-switcher-button');
            const menu = container.querySelector('.lang-switcher-menu');
            const options = container.querySelectorAll('.lang-switcher-option');
            const hiddenSelect = document.getElementById(`language-switcher-${type}`);

            button.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    const lang = option.getAttribute('data-lang');
                    changeLanguage(lang);
                    menu.classList.add('hidden');
                });
            });
        }

        setupLangSwitcher('desktop');
        setupLangSwitcher('mobile');
        document.addEventListener('click', () => document.querySelectorAll('.lang-switcher-menu').forEach(menu => menu.classList.add('hidden')));


        // --- Setup Mobile Menu ---
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
            });
        }

        // --- Setup Image Modal ---
        const modal = document.getElementById('imageModal');
        if (modal) {
            const modalImg = document.getElementById('modalImage');
            const closeModalBtn = document.getElementById('closeModal');
            
            document.body.addEventListener('click', function(event) {
                if (event.target.classList.contains('result-image')) {
                    modal.classList.remove('hidden');
                    modalImg.src = event.target.src;
                }
            });

            const closeModal = () => modal.classList.add('hidden');
            closeModalBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });
        }

        // --- Initial Load ---
        const savedLang = localStorage.getItem("language") || "my";
        changeLanguage(savedLang);
    });
    </script>
</body>
</html>
