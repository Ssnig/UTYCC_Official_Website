<?php
// No database actions are needed on page load for settings, but you could add them here in the future.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Settings — UTYCC Admin</title>
    <meta name="description" content="Settings for the UTYCC student registration system." />
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

    <!-- Theme Loader Script: Prevents a flash of incorrect theme on page load -->
    <script>
      (function() {
        try {
          const theme = localStorage.getItem('theme');
          if (theme === 'dark') {
            document.documentElement.classList.add('dark');
          }
        } catch (e) {
          console.error('Could not apply theme from localStorage', e);
        }
      })();
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
       :root {
  /* Light Theme */
  --bg: 220 20% 98%;
  --fg: 222 47% 11%;
  --muted: 214 32% 91%;
  --muted-foreground: 215 17% 47%;
  --primary: 220 83% 58%;
  --primary-foreground: 0 0% 100%;
  --secondary: 0 0% 100%;
  --secondary-foreground: 222 47% 11%;
  --card: 0 0% 100%;
  --card-foreground: 222 47% 11%;
  --border: 214 32% 91%;
  --ring: 220 83% 58%;
  --success: 153 61% 34%;
  --warning: 43 96% 56%;
  --danger: 0 84% 60%;
  --radius: 12px;
  --ease: cubic-bezier(.2,.8,.2,1);
  --duration: 220ms;
  --shadow-soft: 0 10px 30px -12px hsl(var(--primary)/0.25);
  --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
}

html.dark {
    /* Dark Theme */
    --bg: 222 47% 11%;
    --fg: 210 40% 98%;
    --muted: 217 33% 17%;
    --muted-foreground: 215 20% 65%;
    --primary: 217 91% 60%;
    --primary-foreground: 210 40% 98%;
    --secondary: 222 47% 13%;
    --secondary-foreground: 210 40% 98%;
    --card: 222 47% 15%;
    --card-foreground: 210 40% 98%;
    --border: 217 33% 22%;
    --ring: 217 91% 60%;
    --shadow-card: 0 10px 20px -10px hsl(220 40% 2% / 0.45);
}


* { box-sizing: border-box; }
html, body { height: 100%; }
body {
  margin: 0;
  color: hsl(var(--fg));
  background: hsl(var(--bg));
  font: 500 16px/1.4 'Inter', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Apple Color Emoji", "Segoe UI Emoji";
  text-rendering: optimizeLegibility;
  transition: background var(--duration) var(--ease), color var(--duration) var(--ease);
}
a { color: inherit; text-decoration: none; }
button { font: inherit; }

/* Layout */
.app {
  display: grid;
  grid-template-columns: 280px 1fr;
  grid-template-rows: 72px 1fr;
  grid-template-areas:
    "sidebar header"
    "sidebar main";
  min-height: 100dvh;
}
.sidebar {
  grid-area: sidebar;
  border-right: 1px solid hsl(var(--border));
  background: hsl(var(--secondary));
  padding: 20px 16px;
  position: sticky; top: 0; height: 100dvh;
}
.brand {
  display: flex; align-items: center; gap: 12px; padding: 8px 10px;
}
.brand img {
  width: 32px;
  height: 32px;
}
.brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
nav { margin-top: 18px; display: grid; gap: 8px; }
.nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); border: 1px solid transparent; transition: background var(--duration) var(--ease), color var(--duration) var(--ease), border var(--duration) var(--ease); }
.nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
.nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); box-shadow: var(--shadow-soft); }

.header {
  grid-area: header;
  position: sticky; top: 0; z-index: 10;
  background: hsl(var(--card));
  border-bottom: 1px solid hsl(var(--border));
  display: flex; align-items: center; gap: 12px; padding: 16px 20px;
}
.header h1 { font-size: 24px; margin: 0; }
.search {
  flex: 1; display: flex; gap: 8px; align-items: center; background: hsl(var(--bg)); border: 1px solid hsl(var(--border)); border-radius: 12px; padding: 10px 12px;
}
.search input { width: 100%; border: none; outline: none; background: transparent; color: hsl(var(--fg)); }

.userbar { display: flex; gap: 8px; align-items: center; }

.btn {
  --bcol: var(--border);
  display: inline-flex; align-items: center; justify-content: center; gap: 8px;
  padding: 10px 14px; border-radius: 12px; border: 1px solid hsl(var(--bcol));
  background: hsl(var(--card)); color: hsl(var(--fg));
  box-shadow: var(--shadow-card);
  transition: transform var(--duration) var(--ease), box-shadow var(--duration) var(--ease), background var(--duration) var(--ease), color var(--duration) var(--ease), border-color var(--duration) var(--ease);
  cursor: pointer;
}
.btn:hover { transform: translateY(-1px); box-shadow: 0 10px 30px -12px hsl(var(--fg)/0.25); }
.btn:focus-visible { outline: 2px solid hsl(var(--ring)); outline-offset: 2px; }
.btn.primary { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
.btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
.btn.ghost { background: transparent; border-color: hsl(var(--border)); }

.main { grid-area: main; padding: 20px; background: hsl(var(--bg));}

.cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px; }
.card { background: hsl(var(--card)); color: hsl(var(--card-foreground)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 16px; box-shadow: var(--shadow-card); }
.card h3 { margin: 0 0 12px; font-size: 16px; font-weight: 600;}
.card .value { font-size: 28px; font-weight: 800; letter-spacing: -0.02em; }

.section { margin-top: 24px; }
.section-header { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px; }
.section-header h2 { font-size: 20px; margin: 0; }

/* Table */
.table-wrap { overflow: auto; border: 1px solid hsl(var(--border)); border-radius: var(--radius); background: hsl(var(--card)); box-shadow: var(--shadow-card); }
table { width: 100%; border-collapse: collapse; min-width: 900px; }
thead th { text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; color: hsl(var(--muted-foreground)); background: hsl(var(--bg)); position: sticky; top: 0; z-index: 1; }
th, td { padding: 12px 14px; border-bottom: 1px solid hsl(var(--border)); }
tbody tr:hover { background: hsl(var(--muted)); }

.toast-wrap { position: fixed; top: 20px; right: 20px; width: min(360px, 92vw); display: grid; gap: 12px; z-index: 9999; pointer-events: none; }
.toast { pointer-events: auto; display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--primary-foreground)); background: hsl(var(--fg)); box-shadow: var(--shadow-card); border-left: 4px solid hsl(var(--primary)); animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards; }
.toast.success { border-left-color: hsl(var(--success)); }
.toast.warning { border-left-color: hsl(var(--warning)); }
.toast.error { border-left-color: hsl(var(--danger)); }
.toast .close-btn { background: transparent; border: 0; color: hsl(var(--primary-foreground)); opacity: 0.7; cursor: pointer; font-size: 20px; }
@keyframes toastIn { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
@keyframes toastOut { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(100%); } }

/* Modal */
dialog { border: none; border-radius: 16px; padding: 0; background: hsl(var(--card)); color: hsl(var(--card-foreground)); width: min(860px, 94vw); box-shadow: 0 30px 100px -40px hsl(var(--fg)/0.5); }
dialog::backdrop { background: hsl(222 47% 11% / 0.45); backdrop-filter: blur(2px); }
.modal-header { padding: 16px 18px; border-bottom: 1px solid hsl(var(--border)); display: flex; justify-content: space-between; align-items: center; }
.modal-body { padding: 18px; display: grid; gap: 16px; max-height: 70vh; overflow-y: auto; }
.modal-footer { padding: 14px 18px; border-top: 1px solid hsl(var(--border)); display: flex; justify-content: flex-end; gap: 8px; }

.field { display: grid; gap: 6px; }
.field label { font-size: 13px; color: hsl(var(--muted-foreground)); }
.field input, .field select, .field textarea { padding: 10px 12px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--bg)); color: hsl(var(--fg)); outline: none; font: inherit; }
.field input:focus, .field select:focus, .field textarea:focus { border-color: hsl(var(--ring)); box-shadow: 0 0 0 3px hsl(var(--ring)/0.25); }
.field textarea { min-height: 60px; resize: vertical; }
.field-checkbox { display: flex; align-items: center; gap: 8px; }
.field-checkbox label { margin: 0; }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 18px; }
.details-grid { display: grid; grid-template-columns: 140px 1fr; gap: 16px; font-size: 15px; }
.details-grid dt { font-weight: 600; color: hsl(var(--muted-foreground)); }
.details-grid dd { margin: 0; word-break: break-all; }
.detail-section-header { font-size: 1.1rem; font-weight: 700; color: hsl(var(--fg)); margin-top: 20px; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid hsl(var(--border)); grid-column: 1 / -1; }
.detail-section-header:first-of-type { margin-top: 0; }
.detail-parent-section h4 { font-weight: 600; margin-top: 16px; margin-bottom: 8px; color: hsl(var(--primary)); }

.pagination { display: flex; align-items: center; gap: 8px; justify-content: flex-end; padding-top: 10px; }
.pagination .info { color: hsl(var(--muted-foreground)); font-size: 13px; margin-right: auto; }

/* Responsive */
@media (max-width: 1000px) {
  .cards { grid-template-columns: repeat(2, minmax(0,1fr)); }
  .form-grid { grid-template-columns: 1fr; }
}
@media (max-width: 780px) {
  .app { grid-template-columns: 1fr; grid-template-areas: "header" "main"; }
  .sidebar { position: static; height: auto; display: none; }
  .cards { grid-template-columns: 1fr; }
}

    </style>
</head>
<body>
    <div class="app" id="app">
        <aside class="sidebar" aria-label="Sidebar navigation">
            <div class="brand" aria-label="Brand">
                <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
                <h1>UTYCC Admin Panel</h1>
            </div>
            <nav>
                <a class="nav-link" href="admin_dashboard.php">Registrations</a>
               <a class="nav-link" href="upload_result.php">To upload result</a>
                <a class="nav-link" href="students.php">Students</a>
                <a class="nav-link" href="support.php">Support</a>
                <a class="nav-link active" href="#">Settings</a>
            </nav>
        </aside>

        <header class="header" id="header">
            <h1>Settings</h1>
        </header>

        <main class="main" id="main">
            <div class="cards">
                <div class="card">
                    <h3>Academic Settings</h3>
                    <div class="field">
                        <label for="currentAcademicYear">Current Academic Year</label>
                        <input id="currentAcademicYear" value="2025-2026" placeholder="e.g., 2025-2026" />
                    </div>
                    <div style="text-align: right; margin-top: 16px;">
                         <button class="btn primary" id="saveAcademicSettings">Save</button>
                    </div>
                </div>
                <div class="card">
                    <h3>Appearance</h3>
                     <div class="field">
                        <label>Theme</label>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" id="themeLight">Light</button>
                            <button class="btn" id="themeDark">Dark</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h3>ကျောင်းအပ်ခြင်းဆိုင်ရာ သတ်မှတ်ချက်များ</h3>
                    <p style="font-size: 14px; color: hsl(var(--muted-foreground)); margin-bottom: 16px;">ကျောင်းသားများ ကျောင်းအပ်နိုင်ခြင်းကို ထိန်းချုပ်ရန်။</p>
                     <div class="field">
                        <label>ကျောင်းအပ် လက်ခံမှု အခြေအနေ</label>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" id="enrollmentOpenBtn">ဖွင့်ရန်</button>
                            <button class="btn" id="enrollmentCloseBtn">ပိတ်ရန်</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h3>ကြေညာချက်များ စီမံခန့်ခွဲခြင်း (Announcement)</h3>
                    <p style="font-size: 14px; color: hsl(var(--muted-foreground)); margin-bottom: 16px;">
                        ကျောင်းသားများ၏ ပင်မစာမျက်နှာတွင် ကြေညာချက်များ ဖော်ပြရန် (သို့) ပိတ်ထားရန်။
                    </p>
                    <div class="field">
                        <label for="announcementText">ကြေညာချက် စာသား</label>
                        <textarea id="announcementText" rows="4" placeholder="ကျောင်းအပ်ခြင်းကို ... ရက်နေ့တွင် ပိတ်ပါမည်။"></textarea>
                    </div>
                    <div class="field" style="margin-top: 16px;">
                        <label>ကြေညာချက် အခြေအနေ</label>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" id="announcementEnableBtn">Enable</button>
                            <button class="btn" id="announcementDisableBtn">Disable</button>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 16px;">
                        <button class="btn primary" id="saveAnnouncementBtn">Save Announcement</button>
                    </div>
                </div>
                <div class="card" style="border-color: hsl(var(--danger)/0.5);">
                    <h3 style="color: hsl(var(--danger));">Danger Zone</h3>
                    <p style="font-size: 14px; color: hsl(var(--muted-foreground));">This action is irreversible. Please proceed with caution.</p>
                    <div style="text-align: right; margin-top: 16px;">
                         <button class="btn destructive" id="clearAllDataBtn">Clear All Student Data</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <div class="toast-wrap"></div>
    <!-- Confirmation Modal -->
    <dialog id="confirmModal" aria-modal="true">
      <div class="modal-header">
          <strong id="confirmTitle">Confirm Action</strong>
      </div>
      <div class="modal-body">
          <p id="confirmMessage">Are you sure?</p>
      </div>
      <div class="modal-footer">
          <button class="btn ghost" id="confirmCancel">Cancel</button>
          <button class="btn destructive" id="confirmOK">Confirm</button>
      </div>
    </dialog>

    <script>
        // --- API & UI Helpers ---
        async function apiRequest(action, data) {
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action, ...data }),
                });
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({ message: response.statusText }));
                    throw new Error(errorData.message || `HTTP error ${response.status}`);
                }
                return await response.json();
            } catch (error) {
                showToast(`Error: ${error.message}`, 'error');
                return { status: 'error', message: error.message };
            }
        }

        const toastWrap = document.querySelector(".toast-wrap");
        function showToast(message, type = "success", duration = 4000) {
            const toast = document.createElement("div");
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span>${message}</span><button class="close-btn" aria-label="Close">×</button>`;
            const removeToast = () => { if (toast.parentElement) toast.parentElement.removeChild(toast); };
            toast.querySelector(".close-btn").addEventListener("click", removeToast);
            toastWrap.appendChild(toast);
            setTimeout(removeToast, duration);
        }

        function showConfirm(title, message) {
          return new Promise(resolve => {
            const confirmModal = document.getElementById('confirmModal');
            document.getElementById('confirmTitle').textContent = title;
            document.getElementById('confirmMessage').textContent = message;
            confirmModal.showModal();
            const handleConfirm = () => { confirmModal.close(); resolve(true); };
            const handleCancel = () => { confirmModal.close(); resolve(false); };
            document.getElementById('confirmOK').addEventListener('click', handleConfirm, { once: true });
            document.getElementById('confirmCancel').addEventListener('click', handleCancel, { once: true });
          });
        }
        
        // --- Event Listeners ---
        document.addEventListener('DOMContentLoaded', () => {
            // Load saved academic year
            const savedYear = localStorage.getItem('academicYear');
            if (savedYear) {
                document.getElementById('currentAcademicYear').value = savedYear;
            }

            document.getElementById('saveAcademicSettings').addEventListener('click', () => {
                const year = document.getElementById('currentAcademicYear').value;
                localStorage.setItem('academicYear', year);
                showToast('Academic year updated!', 'success');
            });
      
            document.getElementById('themeLight').addEventListener('click', () => setTheme('light'));
            document.getElementById('themeDark').addEventListener('click', () => setTheme('dark'));

            function setTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                localStorage.setItem('theme', theme);
            }

            // --- Enrollment Settings ---
            const enrollmentOpenBtn = document.getElementById('enrollmentOpenBtn');
            const enrollmentCloseBtn = document.getElementById('enrollmentCloseBtn');

            function updateEnrollmentButtonState() {
                const status = localStorage.getItem('enrollmentStatus') || 'open'; // Default to open
                if (status === 'open') {
                    enrollmentOpenBtn.classList.add('primary');
                    enrollmentCloseBtn.classList.remove('destructive');
                } else {
                    enrollmentOpenBtn.classList.remove('primary');
                    enrollmentCloseBtn.classList.add('destructive');
                }
            }
            
            enrollmentOpenBtn.addEventListener('click', () => {
                localStorage.setItem('enrollmentStatus', 'open');
                showToast('ကျောင်းအပ်ခြင်းကို ယခု ဖွင့်လှစ်ထားပါသည်။', 'success');
                updateEnrollmentButtonState();
            });

            enrollmentCloseBtn.addEventListener('click', () => {
                localStorage.setItem('enrollmentStatus', 'closed');
                showToast('ကျောင်းအပ်ခြင်းကို ယခု ပိတ်ထားပါသည်။', 'warning');
                updateEnrollmentButtonState();
            });

            // Initial state on page load
            updateEnrollmentButtonState();
      
            document.getElementById('clearAllDataBtn').addEventListener('click', async () => {
                const confirmed = await showConfirm(
                    'Clear All Data', 
                    'Are you absolutely sure you want to delete ALL student data? This is irreversible.'
                );
                if (!confirmed) return;
          
                const response = await apiRequest('clear_all_data');
                if (response.status === 'success') {
                    showToast('All student data has been cleared.', 'success');
                }
            });

            // --- Announcement Settings ---
            const announcementText = document.getElementById('announcementText');
            const announcementEnableBtn = document.getElementById('announcementEnableBtn');
            const announcementDisableBtn = document.getElementById('announcementDisableBtn');
            const saveAnnouncementBtn = document.getElementById('saveAnnouncementBtn');
            let currentAnnouncementStatus = 'disabled';

            function updateAnnouncementButtonState() {
                if (currentAnnouncementStatus === 'enabled') {
                    announcementEnableBtn.classList.add('primary');
                    announcementDisableBtn.classList.remove('destructive');
                } else {
                    announcementEnableBtn.classList.remove('primary');
                    announcementDisableBtn.classList.add('destructive');
                }
            }

            async function loadSettings() {
                const response = await apiRequest('get_settings');
                if (response.status === 'success' && response.settings) {
                    announcementText.value = response.settings.announcement_text || '';
                    currentAnnouncementStatus = response.settings.announcement_status || 'disabled';
                    updateAnnouncementButtonState();
                }
            }
            
            announcementEnableBtn.addEventListener('click', () => {
                currentAnnouncementStatus = 'enabled';
                updateAnnouncementButtonState();
            });

            announcementDisableBtn.addEventListener('click', () => {
                currentAnnouncementStatus = 'disabled';
                updateAnnouncementButtonState();
            });

            saveAnnouncementBtn.addEventListener('click', async () => {
                const text = announcementText.value;
                const status = currentAnnouncementStatus;
                const response = await apiRequest('save_announcement', { text, status });
                if (response.status === 'success') {
                    showToast('Announcement settings saved successfully!', 'success');
                }
            });

            loadSettings();
        });
    </script>
</body>
</html>

