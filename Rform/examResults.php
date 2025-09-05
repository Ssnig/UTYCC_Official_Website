<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Exam Results - UTYCC</title>
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Main Content -->
    <!-- <div class="container mx-auto p-4 md:p-8"> -->
       
    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 text-center mb-6">View Exam Results</h2>
            <form method="GET" action="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="year">Year</label>
                        <select name="year" id="year" class="w-full p-3 border border-gray-300 rounded-lg">
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
                        <select name="semester" id="semester" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="">Select Semester</option>
                            <option value="1" <?= (isset($_GET['semester']) && $_GET['semester'] == '1') ? 'selected' : '' ?>>1st Semester</option>
                            <option value="2" <?= (isset($_GET['semester']) && $_GET['semester'] == '2') ? 'selected' : '' ?>>2nd Semester</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="major">Major</label>
                        <select name="major" id="major" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="">Select Major</option>
                            <option value="ist" <?= (isset($_GET['major']) && $_GET['major'] == 'ist') ? 'selected' : '' ?>>Information Science Technology</option>
                            <option value="ce" <?= (isset($_GET['major']) && $_GET['major'] == 'ce') ? 'selected' : '' ?>>Computer Engineering</option>
                            <option value="ece" <?= (isset($_GET['major']) && $_GET['major'] == 'ece') ? 'selected' : '' ?>>Electronics Engineering</option>
                            <option value="pre" <?= (isset($_GET['major']) && $_GET['major'] == 'pre') ? 'selected' : '' ?>>Precision Engineering</option>
                            <option value="ame" <?= (isset($_GET['major']) && $_GET['major'] == 'ame') ? 'selected' : '' ?>>Advanced Materials Engineering</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-colors">
                        Show Results
                    </button>
                </div>
            </form>

            <div class="mt-8">
            <?php
            // Include the database connection file
            require_once  'db.php';

            // Check if form has been submitted
            if (isset($_GET['year']) && isset($_GET['semester']) && isset($_GET['major'])) {
                $year = $_GET['year'];
                $semester = $_GET['semester'];
                $major = $_GET['major'];

                if (!empty($year) && !empty($semester) && !empty($major)) {
                    try {
                        // Prepare and execute the query to find the result image
                        $stmt = $pdo->prepare("SELECT image_path FROM exam_results WHERE year = ? AND semester = ? AND major = ? ORDER BY uploaded_at DESC LIMIT 1");
                        $stmt->execute([$year, $semester, $major]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($result) {
                            // Display the image
                            echo '<div class="bg-gray-100 p-4 rounded-lg shadow-inner text-center">';
                            echo '<h3 class="text-2xl font-bold text-gray-800 mb-4">Your Exam Result</h3>';
                            echo '<img src="' . htmlspecialchars($result['image_path']) . '" alt="Exam Result" class="max-w-full h-auto mx-auto rounded-lg shadow-lg" />';
                            echo '</div>';
                        } else {
                            // No result found
                            echo '<div class="bg-yellow-100 p-4 rounded-lg shadow-inner text-center text-yellow-800">';
                            echo '<p class="font-bold">No exam result found for the selected criteria.</p>';
                            echo '</div>';
                        }
                    } catch (PDOException $e) {
                        // Database error
                        echo '<div class="bg-red-100 p-4 rounded-lg shadow-inner text-center text-red-800">';
                        echo '<p class="font-bold">Database error: ' . htmlspecialchars($e->getMessage()) . '</p>';
                        echo '</div>';
                    }
                } else {
                    // Form fields are empty
                    echo '<div class="bg-red-100 p-4 rounded-lg shadow-inner text-center text-red-800">';
                    echo '<p class="font-bold">Please select all fields to view the result.</p>';
                    echo '</div>';
                }
            }
            ?>
            </div>
        </div>
    <!-- </div> -->
    </div>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" />
                    <h3 class="text-lg font-bold">UTYCC</h3>
                    <p class="text-blue-200 text-sm mt-4">Yatanarpon Cyber City, Mandalay Region, Myanmar</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Faculties</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="./Majors/ist.html">Information Science Technology</a></li>
                        <li><a href="./Majors/ce.html">Computer Engineering</a></li>
                        <li><a href="./Majors/ece.html">Electronics Engineering</a></li>
                        <li><a href="./Majors/pre.html">Precision Engineering</a></li>
                        <li><a href="./Majors/ame.html">Advanced Materials Engineering</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-blue-200">
                        <li><a href="./terms.html">Terms & Policies</a></li>
                        <li><a href="./FAQs.html">FAQs</a></li>
                        <li><a href="./about.html">About Us</a></li>
                        <li><a href="./randr.html">Rules & Regulations</a></li>
                        <li><a href="./data_protection.html">Data Protection</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in text-xl"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300">
                &copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>
</html>
