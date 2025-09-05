<?php
// You can add session validation here to ensure only logged-in admins can access this page.
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Exam Results — UTYCC Admin</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo." type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
    .card { background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); }
    .form-select, .form-input {
        border-color: #d1d5db;
        transition: all 0.2s ease-in-out;
    }
    .form-select:focus, .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4);
        outline: none;
    }
    .btn-primary {
        background-color: #2563eb;
        color: white;
        transition: background-color 0.2s ease-in-out;
    }
    .btn-primary:hover {
        background-color: #1d4ed8;
    }
    .preview-box {
        background-color: #f9fafb;
        border: 2px dashed #d1d5db;
        transition: border-color 0.2s ease-in-out;
    }
    .preview-box.dragover {
        border-color: #3b82f6;
    }
  </style>
  <style>
       :root {
          /* Light Theme */
          --bg: 220 20% 98%; --fg: 222 47% 11%; --muted: 214 32% 91%;
          --muted-foreground: 215 17% 47%; --primary: 220 83% 58%;
          --primary-foreground: 0 0% 100%; --secondary: 0 0% 100%;
          --secondary-foreground: 222 47% 11%; --card: 0 0% 100%;
          --card-foreground: 222 47% 11%; --border: 214 32% 91%;
          --ring: 220 83% 58%; --success: 153 61% 34%; --warning: 43 96% 56%;
          --danger: 0 84% 60%; --radius: 12px; --ease: cubic-bezier(.2,.8,.2,1);
          --duration: 220ms; --shadow-soft: 0 10px 30px -12px hsl(var(--primary)/0.25);
          --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
        }
        html.dark {
            /* Dark Theme */
            --bg: 222 47% 11%; --fg: 210 40% 98%; --muted: 217 33% 17%;
            --muted-foreground: 215 20% 65%; --primary: 217 91% 60%;
            --primary-foreground: 210 40% 98%; --secondary: 222 47% 13%;
            --secondary-foreground: 210 40% 98%; --card: 222 47% 15%;
            --card-foreground: 210 40% 98%; --border: 217 33% 22%;
            --ring: 217 91% 60%; --shadow-card: 0 10px 20px -10px hsl(220 40% 2% / 0.45);
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body { margin: 0; color: hsl(var(--fg)); background: hsl(var(--bg)); font: 500 16px/1.4 'Inter', sans-serif; text-rendering: optimizeLegibility; transition: background var(--duration) var(--ease), color var(--duration) var(--ease); }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; }
        .app { display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 72px 1fr; grid-template-areas: "sidebar header" "sidebar main"; min-height: 100dvh; }
        .sidebar { grid-area: sidebar; border-right: 1px solid hsl(var(--border)); background: hsl(var(--secondary)); padding: 20px 16px; position: sticky; top: 0; height: 100dvh; }
        .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
        .brand img { width: 32px; height: 32px; }
        .brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
        nav { margin-top: 18px; display: grid; gap: 8px; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); transition: background var(--duration) var(--ease), color var(--duration) var(--ease); }
        .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
        .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); box-shadow: var(--shadow-soft); }
        .header { grid-area: header; position: sticky; top: 0; z-index: 10; background: hsl(var(--card)); border-bottom: 1px solid hsl(var(--border)); display: flex; align-items: center; gap: 12px; padding: 16px 20px; }
        .header h1 { font-size: 24px; margin: 0; }
        .main { grid-area: main; padding: 20px; }
        .feedback-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
        .feedback-card { background: hsl(var(--card)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 16px; box-shadow: var(--shadow-card); display: flex; flex-direction: column; }
        .feedback-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 12px; }
        .feedback-header .info { display: grid; }
        .feedback-header .name { font-weight: 700; }
        .feedback-header .email { font-size: 13px; color: hsl(var(--muted-foreground)); }
        .feedback-body { font-size: 15px; line-height: 1.6; color: hsl(var(--card-foreground)); flex-grow: 1; margin-bottom: 16px; }
        .feedback-footer { font-size: 12px; color: hsl(var(--muted-foreground)); text-align: right; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 14px; border-radius: 12px; border: 1px solid hsl(var(--border)); background: hsl(var(--card)); color: hsl(var(--fg)); box-shadow: var(--shadow-card); cursor: pointer; transition: all var(--duration) var(--ease); }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 30px -12px hsl(var(--fg)/0.25); }
        .btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
        .toast-wrap { position: fixed; top: 20px; right: 20px; width: min(360px, 92vw); display: grid; gap: 12px; z-index: 9999; }
        .toast { display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--primary-foreground)); background: hsl(var(--fg)); box-shadow: var(--shadow-card); border-left: 4px solid; }
        .toast.success { border-left-color: hsl(var(--success)); }
        .toast.error { border-left-color: hsl(var(--danger)); }
    </style>
</head>
<body class="flex">
   <aside class="sidebar" aria-label="Sidebar navigation">
      <div class="brand" aria-label="Brand">
        <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        <h1>UTYCC Admin Panel</h1>
      </div>
      <nav>
        <a class="nav-link" href="admin_dashboard.php">Registrations</a>
        <a class="nav-link active" href="upload_result.php">TO upload Results</a>
        <a class="nav-link" href="students.php">Students</a>
        <a class="nav-link" href="support.php">Support</a>
        <a class="nav-link" href="settings.php">Settings</a>
      </nav>
    </aside>

  <main class="flex-1 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Upload Exam Results</h1>
        
        <!-- Status Message Placeholder -->
        <div id="status-message" class="hidden mb-6 p-4 rounded-lg"></div>

        <div class="card p-8">
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Year -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <select id="year" name="year" required class="w-full p-3 border rounded-lg form-select">
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
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                        <select id="semester" name="semester" required class="w-full p-3 border rounded-lg form-select">
                            <option value="">Select Semester</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                        </select>
                    </div>
                    <!-- Major -->
                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Major</label>
                        <select id="major" name="major" required class="w-full p-3 border rounded-lg form-select">
                            <option value="">Select Major</option>
                            <option value="ist">Information Science Technology</option>
                            <option value="ce">Computer Engineering</option>
                            <option value="ece">Electronics Engineering</option>
                            <option value="pre">Precision Engineering</option>
                            <option value="ame">Advanced Materials Engineering</option>
                        </select>
                    </div>
                </div>

                <!-- File Upload Area -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Result Image</label>
                    <div id="preview-box" class="preview-box mt-1 flex justify-center items-center w-full h-64 rounded-lg">
                        <div id="upload-prompt" class="text-center text-gray-500">
                            <svg class="mx-auto h-12 w-12" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            <p class="mt-2">Drag & drop a file here or <span class="font-medium text-blue-600 cursor-pointer hover:underline">click to upload</span></p>
                            <p class="text-xs mt-1">PNG, JPG, GIF up to 5MB</p>
                        </div>
                        <img id="image-preview" src="" alt="Image Preview" class="hidden h-full w-full object-contain rounded-lg p-2" />
                    </div>
                    <input type="file" id="result_image" name="result_image" class="hidden" accept="image/png, image/jpeg, image/gif" required>
                </div>

                <div class="mt-8 text-right">
                    <button type="submit" id="submit-btn" class="btn-primary font-bold py-3 px-8 rounded-lg shadow-md">
                        <span id="btn-text">Upload Result</span>
                        <span id="btn-spinner" class="hidden loading-spinner"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const uploadForm = document.getElementById('uploadForm');
        const previewBox = document.getElementById('preview-box');
        const uploadPrompt = document.getElementById('upload-prompt');
        const imagePreview = document.getElementById('image-preview');
        const fileInput = document.getElementById('result_image');
        const statusMessage = document.getElementById('status-message');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnSpinner = document.getElementById('btn-spinner');

        // Handle click to upload
        previewBox.addEventListener('click', () => fileInput.click());

        // Handle file selection
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                displayPreview(file);
            }
        });

        // Handle drag and drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            previewBox.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            previewBox.addEventListener(eventName, () => previewBox.classList.add('dragover'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            previewBox.addEventListener(eventName, () => previewBox.classList.remove('dragover'), false);
        });

        previewBox.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const file = dt.files[0];
            if (file) {
                fileInput.files = dt.files; // Assign dropped file to input
                displayPreview(file);
            }
        }, false);

        function displayPreview(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
        
        // Handle form submission
        uploadForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            statusMessage.classList.add('hidden');

            const formData = new FormData(uploadForm);
            
            try {
                // Send the data to the backend script
                const response = await fetch('handle_upload.php', {
                    method: 'POST',
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                
                if (result.success) {
                    showStatusMessage(result.message, 'success');
                    uploadForm.reset();
                    imagePreview.classList.add('hidden');
                    uploadPrompt.classList.remove('hidden');
                } else {
                    throw new Error(result.message);
                }

            } catch (error) {
                showStatusMessage(error.message, 'error');
            } finally {
                // Restore button state
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnSpinner.classList.add('hidden');
            }
        });

        function showStatusMessage(message, type) {
            statusMessage.textContent = message;
            statusMessage.className = `p-4 rounded-lg mb-6 ${type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
            statusMessage.classList.remove('hidden');
        }
    });
  </script>
</body>
</html>
