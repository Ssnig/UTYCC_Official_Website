<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Exam Results - UTYCC</title>
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
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
    <div class="container mx-auto p-4 md:p-8">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-10 my-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-6 text-center">Student Exam Results</h1>
            <p class="text-gray-600 text-center mb-8">Select your academic details to view your results.</p>
            
            <!-- Update the form to send data to results.php -->
            <form method="POST" action="examResult.php">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Year -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="year">Year</label>
                        <select name="year" id="year" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="">Select Year</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                            <option value="5">5th Year</option>
                            <option value="6">Final Year</option>
                        </select>
                    </div>
                    <!-- Semester -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="semester">Semester</label>
                        <select name="semester" id="semester" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="">Select Semester</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                        </select>
                    </div>
                    <!-- Major -->
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="major">Major</label>
                        <select name="major" id="major" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="">Select Major</option>
                            <option value="ist">Information Science Technology</option>
                            <option value="ce">Computer Engineering</option>
                            <option value="ece">Electronics Engineering</option>
                            <option value="pre">Precision Engineering</option>
                            <option value="ame">Advanced Materials Engineering</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center">
                    <!-- to show image form upload from admin dashboard -->



                    
                </div>
            </form>
        </div>
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
