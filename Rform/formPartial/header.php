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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/font.css" />
    <title>Student's Registration Form 1</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Padauk:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="form.css">
    <style>
         .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 1rem;
            border: 1px solid #e2e8f0;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #4a5568;
        }
        select, input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e0;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        select:focus, input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }
        .error-message {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        body {
            font-family: 'Padauk', 'Inter', sans-serif;
        }

        /* Custom styles for better table borders */
        table,
        th,
        td {
            border: 1px solid #e5e7eb;
            /* gray-200 */
        }

        th,
        td {
            padding: 0.75rem;
            /* p-3 */
            text-align: left;
            white-space: nowrap;
            /* Prevent text wrapping in table cells */
        }

        input,
        textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            /* gray-300 */
            border-radius: 0.375rem;
            /* rounded-md */
            padding: 0.5rem;
            /* p-2 */
            transition: border-color 0.2s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            /* blue-500 */
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        #photo-preview-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        #photo-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.375rem;
        }

        #remove-photo-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 9999px;
            width: 1.75rem;
            height: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
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
                <a href="#about" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_about">About Us</a>
                <a href="#programs" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_programs">Academic Programs</a>
                <a href="#collaboration" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_collaboration">Collaboration</a>
                <a href="#contact" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
                    data-lang-key="nav_contact">Contact</a>

                <div class="relative ml-4">
                    <div class="relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                        <i class="fas fa-globe text-gray-500 absolute left-3 z-10 pointer-events-none"></i>
                        <select id="language-switcher"
                            class="cursor-pointer appearance-none bg-transparent text-gray-700 font-medium rounded-full py-1.5 pl-9 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="my">မြန်မာ</option>
                            <option value="en">English</option>
                        </select>
                        <i
                            class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 z-10 pointer-events-none"></i>
                    </div>
                </div>
            </div>
            <button id="mobile-menu-button" class="md:hidden text-blue-900">
                <i class="fas fa-bars text-2xl" id="menu-icon"></i>
            </button>
        </nav>
        <div id="mobile-menu" class="hidden px-6 pb-4 border-t md:hidden">
            <a href="#about" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_about_mobile">About Us</a>
            <a href="#programs" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_programs_mobile">Academic Programs</a>
            <a href="#collaboration" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_collaboration_mobile">Collaboration</a>
            <a href="#contact" class="nav-link block py-2 text-gray-700 hover:text-blue-800"
                data-lang-key="nav_contact_mobile">Contact</a>
        </div>
    </div>