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
      <a href="./home.php" class="flex items-center space-x-3">
        <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-8" />
        <div>
          <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
          <span class="text-xs text-gray-500">University of Technology (Yatanarpon Cyber City)</span>
        </div>
      </a>
      <button id="mobile-menu-button" class="md:hidden text-blue-900">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
      <a href="./about.html" class="block py-2 text-gray-700 hover:text-blue-800">About Us</a>
      <a href="./programs.html" class="block py-2 text-gray-700 hover:text-blue-800">Programs</a>
      <a href="./contact.html" class="block py-2 text-gray-700 hover:text-blue-800">Contact</a>
    </div>
  </div>

  <!-- Main Content for Exam Results -->
  
    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 text-center mb-6">View Exam Results</h2>
            <form method="GET" action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="year">Year</label>
                        <select name="year" id="year" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Year</option>
                            <option value="1" <?= (isset($_GET['year']) && $_GET['year'] == '1') ? 'selected' : '' ?>>1st Year</option>
                            <option value="2" <?= (isset($_GET['year']) && $_GET['year'] == '2') ? 'selected' : '' ?>>2nd Year</option>
                            <option value="3" <?= (isset($_GET['year']) && $_GET['year'] == '3') ? 'selected' : '' ?>>3rd Year</option>
                            <option value="4" <?= (isset($_GET['year']) && $_GET['year'] == '4') ? 'selected' : '' ?>>4th Year</option>
                            <option value="5" <?= (isset($_GET['year']) && $_GET['year'] == '5') ? 'selected' : '' ?>>5th Year</option>
                            <option value="6" <?= (isset($_GET['year']) && $_GET['year'] == '6') ? 'selected' : '' ?>>Final Year</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="semester">Semester</label>
                        <select name="semester" id="semester" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Semester</option>
                            <option value="1" <?= (isset($_GET['semester']) && $_GET['semester'] == '1') ? 'selected' : '' ?>>1st Semester</option>
                            <option value="2" <?= (isset($_GET['semester']) && $_GET['semester'] == '2') ? 'selected' : '' ?>>2nd Semester</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="major">Major</label>
                        <select name="major" id="major" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Major</option>
                            <option value="ist" <?= (isset($_GET['major']) && $_GET['major'] == 'ist') ? 'selected' : '' ?>>IST</option>
                            <option value="ce" <?= (isset($_GET['major']) && $_GET['major'] == 'ce') ? 'selected' : '' ?>>CE</option>
                            <option value="ece" <?= (isset($_GET['major']) && $_GET['major'] == 'ece') ? 'selected' : '' ?>>ECE</option>
                            <option value="pre" <?= (isset($_GET['major']) && $_GET['major'] == 'pre') ? 'selected' : '' ?>>PRE</option>
                            <option value="ame" <?= (isset($_GET['major']) && $_GET['major'] == 'ame') ? 'selected' : '' ?>>AME</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-transform transform hover:scale-105">
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

    <!-- Footer -->
    <!-- ... Your footer HTML ... -->

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center p-4 z-[999] hidden transition-opacity duration-300">
        <div class="relative bg-white p-2 rounded-lg max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="Enlarged Exam Result" class="max-w-full max-h-[90vh] object-contain">
            <button id="closeModal" class="absolute -top-3 -right-3 text-white bg-gray-800 rounded-full p-1.5 hover:bg-red-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
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
});
</script>

  <!-- Footer goes here -->
 
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
                            <a href="./Majors/ist.html" data-lang-key="footer_faculty_ist">Information Science Technology</a>
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
                            <a data-lang-key="footer_faculty_ame" href="./Majors/ame.html">
                                Advanced Materials Engineering
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li>
                            <a href="./terms.html" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a>
                        </li>
                        <li>
                            <a href="./FAQs.html" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
                        </li>
                        <li>
                            <a href="./about.html" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
                        </li>
                        <li>
                            <a href="./randr.html" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a>
                        </li>
                        <li>
                            <a href="./data_protection.html" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a>
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


  <!-- <footer> ... your footer code ... </footer> -->
  <!-- ===================================== -->

</body>
</html>
