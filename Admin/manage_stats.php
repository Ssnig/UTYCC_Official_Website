<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Site Stats — UTYCC Admin</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
    .card { background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); }
    .form-input {
        border-color: #d1d5db;
        transition: all 0.2s ease-in-out;
    }
    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.4);
        outline: none;
    }
    .btn {
        transition: all 0.2s ease-in-out;
    }
    .loading-spinner {
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-top-color: #fff;
        border-radius: 50%;
        width: 1.25rem;
        height: 1.25rem;
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
        <a class="nav-link" href="upload_result.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
          Upload Results
        </a>
        <a class="nav-link" href="manage_results.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            Manage Results
        </a>
        <a class="nav-link active" href="manage_stats.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            Manage Stats
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
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 0 2l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l-.22-.38a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1 0-2l.15-.08a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
          Settings
        </a>
      </nav>
    </aside>

    <header class="header">
      <h1 class="text-2xl font-bold text-gray-800">Manage Site Statistics</h1>
    </header>

    <main class="main">
      <div class="card w-full max-w-2xl mx-auto p-8">
          <form id="statsForm" class="space-y-6">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-3">Home Page Stats</h2>
            
            <div>
              <label for="students_stat" class="block text-sm font-medium text-gray-700">Total Students</label>
              <input type="number" id="students_stat" name="students_stat" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-input" placeholder="e.g., 3000">
              <p class="mt-1 text-xs text-gray-500">The approximate total number of students to display on the home page.</p>
            </div>
            
            <div>
              <label for="acceptance_rate_stat" class="block text-sm font-medium text-gray-700">Acceptance Rate (%)</label>
              <input type="number" id="acceptance_rate_stat" name="acceptance_rate_stat" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 form-input" placeholder="e.g., 21">
               <p class="mt-1 text-xs text-gray-500">The acceptance rate percentage to display (enter the number only).</p>
            </div>

            <div class="flex justify-end">
              <button type="submit" id="save-btn" class="inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 btn">
                <span id="btn-text">Save Changes</span>
                <div id="btn-spinner" class="loading-spinner hidden"></div>
              </button>
            </div>
            <div id="status-message" class="mt-4 text-center hidden" role="alert"></div>
          </form>
      </div>
    </main>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const statsForm = document.getElementById('statsForm');
    const saveBtn = document.getElementById('save-btn');
    const btnText = document.getElementById('btn-text');
    const btnSpinner = document.getElementById('btn-spinner');
    const statusMessage = document.getElementById('status-message');
    const studentsStatInput = document.getElementById('students_stat');
    const acceptanceRateStatInput = document.getElementById('acceptance_rate_stat');

    async function apiRequest(action, data = {}) {
        try {
            const response = await fetch('stats_api.php', { // Ensure this points to your new stats API file
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action, ...data }),
            });
            if (!response.ok) {
                throw new Error(`Server responded with status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('API Request Error:', error);
            return { success: false, message: 'A network error occurred.' };
        }
    }

    function showStatus(message, isSuccess) {
      statusMessage.textContent = message;
      statusMessage.className = `mt-4 text-center p-3 rounded-md ${isSuccess ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
      setTimeout(() => { statusMessage.className = 'mt-4 text-center hidden'; }, 4000);
    }

    async function loadStats() {
      const response = await apiRequest('get_site_stats');
      if (response.status === 'success' && response.stats) {
        studentsStatInput.value = response.stats.students_stat || '';
        acceptanceRateStatInput.value = response.stats.acceptance_rate_stat || '';
      } else {
        showStatus('Could not load current stats.', false);
      }
    }

    statsForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      btnText.classList.add('hidden');
      btnSpinner.classList.remove('hidden');
      saveBtn.disabled = true;

      const data = {
        students_stat: studentsStatInput.value,
        acceptance_rate_stat: acceptanceRateStatInput.value,
      };

      const response = await apiRequest('save_site_stats', data);

      if (response.status === 'success') {
        showStatus('Statistics updated successfully!', true);
      } else {
        showStatus(response.message || 'Failed to update statistics.', false);
      }

      btnText.classList.remove('hidden');
      btnSpinner.classList.add('hidden');
      saveBtn.disabled = false;
    });

    loadStats();
  });
  </script>
</body>
</html>

