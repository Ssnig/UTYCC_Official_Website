<?php
// You can add session validation here to ensure only logged-in admins can access this page.
require_once 'auth_check.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Exam Results — UTYCC Admin</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
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
    /* --- LAYOUT STYLES --- */
    .app {
      display: grid;
      grid-template-columns: 280px 1fr;
      grid-template-rows: 72px 1fr;
      grid-template-areas:
        "sidebar header"
        "sidebar main";
      min-height: 100dvh;
      background-color: #f1f5f9;
    }
    .header {
      grid-area: header;
      position: sticky; top: 0; z-index: 10;
      background: white;
      border-bottom: 1px solid #e2e8f0;
      display: flex; align-items: center; gap: 12px; padding: 16px 20px;
    }
    .main { grid-area: main; padding: 20px; }
    .sidebar { grid-area: sidebar; border-right: 1px solid #e2e8f0; background: #fff; padding: 20px 16px; position: sticky; top: 0; height: 100vh; }
    .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
    .brand img { width: 32px; height: 32px; }
    .brand h1 { font-size: 18px; margin: 0; font-weight: 700; }
    nav { margin-top: 18px; display: grid; gap: 8px; }
    .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: #64748b; }
    .nav-link:hover { background: #f1f5f9; color: #0f172a; }
    .nav-link.active { background: #3b82f6; color: #fff; }

    /* Custom styles for image previews */
    .image-preview-container { display: flex; flex-wrap: wrap; gap: 1rem; padding-top: 1rem; }
    .image-preview-item { position: relative; width: 100px; height: 100px; }
    .image-preview-item img { width: 100%; height: 100%; object-fit: cover; border-radius: 0.5rem; border: 1px solid #e2e8f0; }
    .remove-btn { position: absolute; top: -8px; right: -8px; background-color: #ef4444; color: white; border-radius: 50%; cursor: pointer; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }

    @media (max-width: 780px) {
      .app { grid-template-columns: 1fr; grid-template-areas:
          "header"
          "main"; }
      .sidebar { position: static; height: auto; display: none; }
    }
    </style>
</head>
<body>
  <div class="app">
    <aside class="sidebar" aria-label="Sidebar navigation">
      <div class="brand" aria-label="Brand">
        <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        <h1>UTYCC Admin Panel</h1>
      </div>
      <nav>
        <a class="nav-link" href="admin_dashboard.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
          Registrations
        </a>
        <a class="nav-link active" href="upload_result.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
          Upload Results
        </a>
        <a class="nav-link" href="manage_results.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            Manage Results
        </a>
        <a class="nav-link" href="analytics.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            Analytics
        </a>
        <a class="nav-link" href="activity.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            Upload Activity
        </a>
        <a class="nav-link" href="students.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          Students
        </a>
        <a class="nav-link" href="support.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
          Support
        </a>
        <a class="nav-link" href="settings.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 0 2l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1 0-2l.15-.08a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
          Settings
        </a>
      </nav>
    </aside>

    <header class="header">
      <h1 class="text-2xl font-bold text-gray-800">Upload Exam Results</h1>
    </header>

    <main class="main">
      <div class="card w-full p-8">
          <form id="uploadForm" class="space-y-8" enctype="multipart/form-data">
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
                          <option value="ist">IST</option>
                          <option value="ce">CE</option>
                          <option value="ece">ECE</option>
                          <option value="pre">PRE</option>
                          <option value="ame">AME</option>
                      </select>
                  </div>
              </div>

              <div>
                  <label class="block text-sm font-medium text-gray-700">Exam Result Images</label>
                  <div id="preview-box" class="mt-1 flex justify-center items-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6 min-h-[250px] cursor-pointer hover:border-blue-500 transition-colors duration-200">
                      <div class="space-y-1 text-center" id="upload-prompt">
                          <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                          <p class="text-sm text-gray-600">
                              <span class="font-medium text-blue-600 cursor-pointer hover:underline">Click to upload</span> or drag and drop
                          </p>
                          <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB each</p>
                      </div>
                      <div id="image-previews-container" class="hidden image-preview-container"></div>
                  </div>
                  <input type="file" id="result_image" accept="image/*" class="sr-only" multiple>
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
    </main>
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
                          <div class="remove-btn" data-index="${index}">
                              <svg class="h-4 w-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                          </div>
                      `;
                      imagePreviewsContainer.appendChild(previewItem);
                  };
                  reader.readAsDataURL(file);
              });
          } else {
              uploadPrompt.classList.remove('hidden');
              imagePreviewsContainer.classList.add('hidden');
          }
      }

      imagePreviewsContainer.addEventListener('click', (e) => {
          if (e.target.closest('.remove-btn')) {
              const indexToRemove = parseInt(e.target.closest('.remove-btn').dataset.index, 10);
              filesToUpload.splice(indexToRemove, 1);
              renderPreviews();
          }
      });

      previewBox.addEventListener('click', (e) => {
          if (e.target.closest('.image-preview-item')) return;
          resultImageInput.click();
      });

      previewBox.addEventListener('dragover', (e) => { e.preventDefault(); previewBox.classList.add('dragover'); });
      previewBox.addEventListener('dragleave', () => { previewBox.classList.remove('dragover'); });

      previewBox.addEventListener('drop', (e) => {
          e.preventDefault();
          previewBox.classList.remove('dragover');
          const newFiles = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
          filesToUpload.push(...newFiles);
          renderPreviews();
      });

      resultImageInput.addEventListener('change', (e) => {
          const newFiles = Array.from(e.target.files);
          filesToUpload.push(...newFiles);
          renderPreviews();
          resultImageInput.value = ''; // Clear the input
      });

      uploadForm.addEventListener('submit', async (e) => {
          e.preventDefault();

          if (filesToUpload.length === 0) {
              statusMessage.textContent = 'Please select at least one image to upload.';
              statusMessage.className = 'mt-4 p-3 rounded-lg text-center bg-red-100 text-red-800';
              return;
          }

          const formData = new FormData();
          formData.append('year', document.getElementById('year').value);
          formData.append('semester', document.getElementById('semester').value);
          formData.append('major', document.getElementById('major').value);
          
          filesToUpload.forEach(file => {
              formData.append('result_image[]', file, file.name);
          });

          submitBtn.disabled = true;
          btnText.classList.add('hidden');
          btnSpinner.classList.remove('hidden');
          statusMessage.classList.add('hidden');

          try {
              const response = await fetch('upload.php', {
                  method: 'POST',
                  body: formData
              });

              if (!response.ok) {
                  throw new Error(`Server error: ${response.statusText}`);
              }

              const result = await response.json();

              statusMessage.textContent = result.message;
              statusMessage.classList.remove('hidden');
              if (result.success) {
                  statusMessage.className = 'mt-4 p-3 rounded-lg text-center bg-green-100 text-green-800';
                  uploadForm.reset();
                  filesToUpload = [];
                  renderPreviews();
              } else {
                  statusMessage.className = 'mt-4 p-3 rounded-lg text-center bg-red-100 text-red-800';
              }
          } catch (error) {
              console.error('Upload error:', error);
              statusMessage.textContent = 'An unexpected error occurred. Please check the console and try again.';
              statusMessage.className = 'mt-4 p-3 rounded-lg text-center bg-red-100 text-red-800';
          } finally {
              submitBtn.disabled = false;
              btnText.classList.remove('hidden');
              btnSpinner.classList.add('hidden');
          }
      });
  });
  </script>
</body>
</html>

