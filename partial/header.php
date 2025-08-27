<!DOCTYPE html>
<html lang="my">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../CSS/footer.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/font.css" />
    <title>Student's Registration Form 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Padauk:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="form.css">


    
</head>

<body class="bg-gray-100">
    <div class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="flex items-center space-x-3">
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
                <a href="#about" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_about">About Us</a>
                <a href="#programs" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_programs">Academic Programs</a>
                <a href="#collaboration" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_collaboration">Collaboration</a>
                <a href="#contact" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium" data-lang-key="nav_contact">Contact</a>

                <div class="relative ml-4">
                    <div class="relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                        <i class="fas fa-globe text-gray-500 absolute left-3 z-10 pointer-events-none"></i>
                        <select id="language-switcher" class="cursor-pointer appearance-none bg-transparent text-gray-700 font-medium rounded-full py-1.5 pl-9 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="my">မြန်မာ</option>
                            <option value="en">English</option>
                        </select>
                        <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 z-10 pointer-events-none"></i>
                    </div>
                </div>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-blue-900">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
            <a href="#about" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_about_mobile">About Us</a>
            <a href="#programs" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_programs_mobile">Academic Programs</a>
            <a href="#collaboration" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_collaboration_mobile">Collaboration</a>
            <a href="#contact" class="nav-link block py-2 text-gray-700 hover:text-blue-800" data-lang-key="nav_contact_mobile">Contact</a>
        </div>
    </div>