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
 body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
    .card { background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); }
    .form-select, .form-input {
        border-color: #d1d5db;
    }
    .loading-spinner {
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top-color: #fff;
        border-radius: 50%;
        width: 1.5rem;
        height: 1.5rem;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .dragover {
        border-color: #3b82f6;
    }

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
         <div class="flex items-center justify-center min-h-screen p-6">
        <div class="flex items-center justify-center min-h-screen p-6">
        <div class="card w-full max-w-4xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Upload Exam Results</h2>
            <form id="uploadForm" class="space-y-6" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <select id="year" name="year" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-select">
                            <option value="">Select Year</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                            <option value="5">5th Year</option>
                            <option value="6">Final Year</option>
                        </select>
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                        <select id="semester" name="semester" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-select">
                            <option value="">Select Semester</option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                        </select>
                    </div>
                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">Major</label>
                        <select id="major" name="major" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-select">
                            <option value="">Select Major</option>
                            <option value="ist">Information Science Technology</option>
                            <option value="ce">Computer Engineering</option>
                            <option value="ece">Electronics Engineering</option>
                            <option value="pre">Precision Engineering</option>
                            <option value="ame">Advanced Materials Engineering</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Exam Result Images</label>
                    <div id="preview-box" class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 cursor-pointer hover:border-blue-500 transition-colors duration-200">
                        <div class="space-y-1 text-center" id="upload-prompt">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            <p class="text-sm text-gray-600">
                                <span class="font-medium text-blue-600 cursor-pointer hover:underline">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB each</p>
                        </div>
                        <div id="image-previews-container" class="hidden image-preview-container"></div>
                    </div>
                    <!-- The 'multiple' attribute is added here -->
                    <input type="file" id="result_image" name="result_image[]" accept="image/*" class="sr-only" multiple required>
                </div>

                <div>
                    <button type="submit" id="submit-btn" class="w-full flex items-center justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <span id="btn-text">Upload Results</span>
                        <div id="btn-spinner" class="loading-spinner hidden"></div>
                    </button>
                </div>

                <div id="status-message" class="mt-4 p-3 rounded-lg text-center hidden" role="alert"></div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadForm = document.getElementById('uploadForm');
            const statusMessage = document.getElementById('status-message');
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const resultImageInput = document.getElementById('result_image');
            const uploadPrompt = document.getElementById('upload-prompt');
            const previewBox = document.getElementById('preview-box');
            const imagePreviewsContainer = document.getElementById('image-previews-container');
            let filesToUpload = [];

            function renderPreviews() {
                imagePreviewsContainer.innerHTML = '';
                if (filesToUpload.length > 0) {
                    uploadPrompt.classList.add('hidden');
                    imagePreviewsContainer.classList.remove('hidden');
                    filesToUpload.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'image-preview-item';
                            previewItem.innerHTML = `
                                <img src="${e.target.result}" alt="Image Preview">
                                <svg class="remove-btn h-5 w-5 text-gray-500 hover:text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            `;
                            imagePreviewsContainer.appendChild(previewItem);
                            previewItem.querySelector('.remove-btn').addEventListener('click', () => {
                                filesToUpload.splice(index, 1);
                                if (filesToUpload.length === 0) {
                                    uploadForm.reset();
                                    uploadPrompt.classList.remove('hidden');
                                    imagePreviewsContainer.classList.add('hidden');
                                } else {
                                    renderPreviews();
                                }
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                } else {
                    uploadPrompt.classList.remove('hidden');
                    imagePreviewsContainer.classList.add('hidden');
                }
            }

            // Handle file input click
            previewBox.addEventListener('click', (e) => {
                if (e.target.closest('.image-preview-item')) return;
                resultImageInput.click();
            });

            // Handle file drag and drop
            previewBox.addEventListener('dragover', (e) => {
                e.preventDefault();
                previewBox.classList.add('dragover');
            });

            previewBox.addEventListener('dragleave', () => {
                previewBox.classList.remove('dragover');
            });

            previewBox.addEventListener('drop', (e) => {
                e.preventDefault();
                previewBox.classList.remove('dragover');
                const newFiles = Array.from(e.dataTransfer.files);
                filesToUpload = filesToUpload.concat(newFiles);
                renderPreviews();
            });

            // Handle file selection via input
            resultImageInput.addEventListener('change', (e) => {
                const newFiles = Array.from(e.target.files);
                filesToUpload = newFiles; // Reset files to new selection
                renderPreviews();
            });

            // Handle form submission via AJAX
            uploadForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                if (filesToUpload.length === 0) {
                    statusMessage.textContent = 'Please select at least one image to upload.';
                    statusMessage.classList.remove('hidden', 'bg-green-200', 'text-green-800');
                    statusMessage.classList.add('bg-red-200', 'text-red-800');
                    return;
                }

                const formData = new FormData(uploadForm);
                filesToUpload.forEach(file => {
                    formData.append('result_image[]', file);
                });

                // Show loading state
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnSpinner.classList.remove('hidden');
                statusMessage.classList.add('hidden');

                try {
                    const response = await fetch('upload.php', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();

                    // Display status message
                    statusMessage.textContent = result.message;
                    statusMessage.classList.remove('hidden');
                    if (result.success) {
                        statusMessage.classList.remove('bg-red-200', 'text-red-800');
                        statusMessage.classList.add('bg-green-200', 'text-green-800');
                        uploadForm.reset();
                        filesToUpload = []; // Reset the file array
                        renderPreviews(); // Clear previews
                    } else {
                        statusMessage.classList.remove('bg-green-200', 'text-green-800');
                        statusMessage.classList.add('bg-red-200', 'text-red-800');
                    }
                } catch (error) {
                    statusMessage.textContent = 'An unexpected error occurred. Please try again.';
                    statusMessage.classList.remove('bg-green-200', 'text-green-800');
                    statusMessage.classList.add('bg-red-200', 'text-red-800');
                    statusMessage.classList.remove('hidden');
                } finally {
                    // Hide loading state
                    submitBtn.disabled = false;
                    btnText.classList.remove('hidden');
                    btnSpinner.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
