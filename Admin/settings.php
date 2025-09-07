<?php
require_once 'auth_check.php';

// We need to fetch the list of current admins to display on the page.
require_once '../Rform/db.php';

$admins = [];
try {
    $stmt = $pdo->query("SELECT id, admin_user FROM admins ORDER BY admin_user ASC");
    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle error gracefully in a real application
    error_log("Could not fetch admins: " . $e->getMessage());
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Settings — UTYCC Admin</title>
    <meta name="description" content="Settings for the UTYCC student registration system." />
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

    <!-- Theme Loader Script -->
    <script>
      (function() {
        try {
          const theme = localStorage.getItem('theme');
          if (theme === 'dark') {
            document.documentElement.classList.add('dark');
          }
        } catch (e) { console.error(e); }
      })();
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
       :root {
          /* Light Theme */
          --bg: 220 20% 98%; --fg: 222 47% 11%; --muted: 214 32% 91%; --muted-foreground: 215 17% 47%;
          --primary: 220 83% 58%; --primary-foreground: 0 0% 100%; --secondary: 0 0% 100%; --secondary-foreground: 222 47% 11%;
          --card: 0 0% 100%; --card-foreground: 222 47% 11%; --border: 214 32% 91%; --ring: 220 83% 58%;
          --success: 153 61% 34%; --warning: 43 96% 56%; --danger: 0 84% 60%; --radius: 12px;
          --ease: cubic-bezier(.2,.8,.2,1); --duration: 220ms; --shadow-soft: 0 10px 30px -12px hsl(var(--primary)/0.25);
          --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
        }
        html.dark {
            /* Dark Theme */
            --bg: 222 47% 11%; --fg: 210 40% 98%; --muted: 217 33% 17%; --muted-foreground: 215 20% 65%;
            --primary: 217 91% 60%; --primary-foreground: 210 40% 98%; --secondary: 222 47% 13%; --secondary-foreground: 210 40% 98%;
            --card: 222 47% 15%; --card-foreground: 210 40% 98%; --border: 217 33% 22%; --ring: 217 91% 60%;
            --shadow-card: 0 10px 20px -10px hsl(220 40% 2% / 0.45);
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body { margin: 0; color: hsl(var(--fg)); background: hsl(var(--bg)); font: 500 16px/1.4 'Inter', sans-serif; }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; }
        /* Layout */
        .app { display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 72px 1fr; grid-template-areas: "sidebar header" "sidebar main"; min-height: 100dvh; }
        .sidebar { grid-area: sidebar; border-right: 1px solid hsl(var(--border)); background: hsl(var(--secondary)); padding: 20px 16px; position: sticky; top: 0; height: 100dvh; }
        .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
        .brand img { width: 32px; height: 32px; }
        .brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
        nav { margin-top: 18px; display: grid; gap: 8px; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); transition: background .2s ease, color .2s ease; }
        .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
        .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); box-shadow: var(--shadow-soft); }
        .header { grid-area: header; position: sticky; top: 0; z-index: 10; background: hsl(var(--card)); border-bottom: 1px solid hsl(var(--border)); display: flex; align-items: center; padding: 16px 20px; }
        .header h1 { font-size: 24px; margin: 0; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 14px; border-radius: 12px; border: 1px solid hsl(var(--border)); background: hsl(var(--card)); color: hsl(var(--fg)); box-shadow: var(--shadow-card); transition: all var(--duration) var(--ease); cursor: pointer; }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 30px -12px hsl(var(--fg)/0.25); }
        .btn.primary { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
        .btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
        .btn.active { box-shadow: 0 0 0 3px hsl(var(--ring)/0.4); }
        .main { grid-area: main; padding: 20px; background: hsl(var(--bg)); }
        .cards { display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 20px; }
        .card { background: hsl(var(--card)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow-card); transition: transform 0.2s var(--ease), box-shadow 0.2s var(--ease); }
        .card:hover { transform: translateY(-4px); box-shadow: 0 15px 30px -10px hsl(220 40% 20% / 0.2); }
        html.dark .card:hover { box-shadow: 0 15px 30px -10px hsl(220 40% 2% / 0.5); }
        .card h3 { margin: 0 0 8px; font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .card-description { font-size: 14px; color: hsl(var(--muted-foreground)); margin: 0 0 16px; line-height: 1.5; }
        .icon { color: hsl(var(--primary)); }
        .danger-zone { border-color: hsl(var(--danger) / 0.5); }
        .danger-zone h3 .icon { color: hsl(var(--danger)); }
        .toast-wrap { position: fixed; top: 20px; right: 20px; width: min(360px, 92vw); display: grid; gap: 12px; z-index: 9999; pointer-events: none; }
        .toast { pointer-events: auto; display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--primary-foreground)); background: hsl(var(--fg)); box-shadow: var(--shadow-card); border-left: 4px solid hsl(var(--primary)); animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards; }
        .toast.success { border-left-color: hsl(var(--success)); }
        .toast.warning { border-left-color: hsl(var(--warning)); }
        .toast.error { border-left-color: hsl(var(--danger)); }
        .toast .close-btn { background: transparent; border: 0; color: hsl(var(--primary-foreground)); opacity: 0.7; cursor: pointer; font-size: 20px; }
        @keyframes toastIn { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
        @keyframes toastOut { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(100%); } }
        dialog { border: none; border-radius: 16px; padding: 0; background: hsl(var(--card)); color: hsl(var(--card-foreground)); width: min(500px, 94vw); box-shadow: 0 30px 100px -40px hsl(var(--fg)/0.5); }
        dialog::backdrop { background: hsl(222 47% 11% / 0.45); backdrop-filter: blur(2px); }
        .modal-header { padding: 16px 20px; border-bottom: 1px solid hsl(var(--border)); display: flex; justify-content: space-between; align-items: center; }
        .modal-body { padding: 20px; display: grid; gap: 16px; }
        .modal-footer { padding: 14px 20px; border-top: 1px solid hsl(var(--border)); display: flex; justify-content: flex-end; gap: 8px; }
        .field { display: grid; gap: 6px; }
        .field label { font-size: 14px; color: hsl(var(--muted-foreground)); }
        .field input, .field textarea { padding: 10px 12px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--bg)); color: hsl(var(--fg)); outline: none; font: inherit; }
        .field input:focus, .field textarea:focus { border-color: hsl(var(--ring)); box-shadow: 0 0 0 3px hsl(var(--ring)/0.25); }
        .admin-list { list-style: none; padding: 0; margin: 0; max-height: 200px; overflow-y: auto; border: 1px solid hsl(var(--border)); border-radius: 10px; }
        .admin-list li { display: flex; justify-content: space-between; align-items: center; padding: 10px 14px; }
        .admin-list li:not(:last-child) { border-bottom: 1px solid hsl(var(--border)); }
        @media (max-width: 780px) { .app { grid-template-columns: 1fr; grid-template-areas: "header" "main"; } .sidebar { display: none; } }
        @media (max-width: 900px) { .cards { grid-template-columns: 1fr; } .admin-management-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="app" id="app">
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
        <a class="nav-link active" href="settings.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 0 2l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1 0-2l.15-.08a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
          Settings
        </a>
      </nav>
        </aside>

        <header class="header" id="header">
            <h1>Settings</h1>
        </header>

        <main class="main" id="main">
            <div class="cards">
                <div class="card" style="grid-column: 1 / -1;">
                    <h3><i class="fas fa-users-cog icon"></i>Admin Management</h3>
                    <p class="card-description">Add new admin accounts or remove existing ones.</p>
                    <div class="admin-management-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                        <div>
                            <h4>Add New Admin</h4>
                            <form id="addAdminForm" class="space-y-4" style="margin-top: 12px;">
                                <div class="field">
                                    <label for="adminUsername">Username</label>
                                    <input id="adminUsername" required placeholder="e.g., new_admin">
                                </div>
                                <div class="field">
                                    <label for="adminPassword">Password</label>
                                    <input type="password" id="adminPassword" required placeholder="••••••••">
                                </div>
                                <button type="submit" class="btn primary">Add Admin</button>
                            </form>
                        </div>
                        <div>
                            <h4>Existing Admins</h4>
                            <ul class="admin-list" id="adminList" style="margin-top: 12px;">
                                <!-- Admin list populated by JS -->
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3><i class="fas fa-bullhorn icon"></i>Announcement Management</h3>
                    <p class="card-description">Control the announcement banner on the student portal.</p>
                    <div class="field">
                        <label for="announcementText">Announcement Text</label>
                        <textarea id="announcementText" rows="3" placeholder="Registration will close on..."></textarea>
                    </div>
                    <div class="field" style="margin-top: 16px;">
                        <label>Announcement Status</label>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" id="announcementEnableBtn">Enable</button>
                            <button class="btn" id="announcementDisableBtn">Disable</button>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 16px;">
                        <button class="btn primary" id="saveAnnouncementBtn">Save Announcement</button>
                    </div>
                </div>
                
                <div class="card">
                    <h3><i class="fas fa-palette icon"></i>Appearance</h3>
                    <p class="card-description">Customize the look and feel of the admin panel.</p>
                    <div class="field">
                        <label>Theme</label>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" id="themeLight">Light</button>
                            <button class="btn" id="themeDark">Dark</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3><i class="fas fa-clipboard-check icon"></i>Enrollment Settings</h3>
                    <p class="card-description">Enable or disable the student registration form.</p>
                    <div class="field">
                        <label>Enrollment Status</label>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" id="enrollmentOpenBtn">Open</button>
                            <button class="btn" id="enrollmentCloseBtn">Close</button>
                        </div>
                    </div>
                </div>

                <div class="card danger-zone">
                    <h3><i class="fas fa-user-circle icon"></i>Account</h3>
                    <p class="card-description">Log out of your admin account.</p>
                    <div style="text-align: right; margin-top: 16px;">
                        <button class="btn destructive" id="logoutBtn">Logout</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <div class="toast-wrap"></div>
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
        const state = {
            admins: <?php echo json_encode($admins); ?>
        };

        // API request function specifically for admin management
        async function adminApiRequest(action, data) {
            try {
                const response = await fetch('admin_api.php', {
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
        
        // API request function for all other settings
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

        function showConfirm(title, message, confirmClass = 'destructive') {
          return new Promise(resolve => {
            const confirmModal = document.getElementById('confirmModal');
            document.getElementById('confirmTitle').textContent = title;
            document.getElementById('confirmMessage').textContent = message;
            const confirmBtn = document.getElementById('confirmOK');
            
            confirmBtn.className = `btn ${confirmClass}`;

            confirmModal.showModal();
            const handleConfirm = () => { confirmModal.close(); resolve(true); };
            const handleCancel = () => { confirmModal.close(); resolve(false); };
            confirmBtn.addEventListener('click', handleConfirm, { once: true });
            document.getElementById('confirmCancel').addEventListener('click', handleCancel, { once: true });
          });
        }

        function renderAdminList() {
            const adminList = document.getElementById('adminList');
            adminList.innerHTML = '';
            if (state.admins.length === 0) {
                adminList.innerHTML = '<li style="color: hsl(var(--muted-foreground));">No admins found.</li>';
                return;
            }
            state.admins.forEach(admin => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span>${admin.admin_user}</span>
                    <button class="btn destructive" data-id="${admin.id}">Delete</button>
                `;
                adminList.appendChild(li);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderAdminList();

            document.getElementById('addAdminForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                const username = document.getElementById('adminUsername').value;
                const password = document.getElementById('adminPassword').value;

                if (!username || !password) {
                    showToast('Username and password are required.', 'warning');
                    return;
                }

                const response = await adminApiRequest('add_admin', { username, password });
                
                if (response.status === 'success' && response.admin) {
                    state.admins.push(response.admin);
                    state.admins.sort((a, b) => a.admin_user.localeCompare(b.admin_user));
                    renderAdminList();
                    showToast('Admin added successfully!', 'success');
                    e.target.reset();
                }
            });

            document.getElementById('adminList').addEventListener('click', async (e) => {
                if (e.target.matches('.btn.destructive')) {
                    const adminId = e.target.dataset.id;
                    const admin = state.admins.find(a => a.id == adminId);
                    
                    if (!admin) return;

                    const confirmed = await showConfirm('Delete Admin', `Are you sure you want to delete admin "${admin.admin_user}"? This action cannot be undone.`);
                    if (!confirmed) return;

                    const response = await adminApiRequest('delete_admin', { id: adminId });
                    if (response.status === 'success') {
                        state.admins = state.admins.filter(a => a.id != adminId);
                        renderAdminList();
                        showToast('Admin deleted successfully!', 'success');
                    }
                }
            });
            
            // --- Other settings event listeners ---
            const announcementText = document.getElementById('announcementText');
            const announcementEnableBtn = document.getElementById('announcementEnableBtn');
            const announcementDisableBtn = document.getElementById('announcementDisableBtn');
            const saveAnnouncementBtn = document.getElementById('saveAnnouncementBtn');
            let currentAnnouncementStatus = 'disabled';

            function updateAnnouncementButtonState() {
                announcementEnableBtn.classList.toggle('active', currentAnnouncementStatus === 'enabled');
                announcementEnableBtn.classList.toggle('primary', currentAnnouncementStatus === 'enabled');
                announcementDisableBtn.classList.toggle('active', currentAnnouncementStatus === 'disabled');
                announcementDisableBtn.classList.toggle('destructive', currentAnnouncementStatus === 'disabled');
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
                    showToast('Announcement saved successfully!', 'success');
                }
            });

            const themeLightBtn = document.getElementById('themeLight');
            const themeDarkBtn = document.getElementById('themeDark');

            function setTheme(theme) {
                document.documentElement.classList.toggle('dark', theme === 'dark');
                localStorage.setItem('theme', theme);
                updateThemeButtons();
            }

            function updateThemeButtons() {
                const theme = localStorage.getItem('theme') || 'light';
                themeLightBtn.classList.toggle('active', theme === 'light');
                themeDarkBtn.classList.toggle('active', theme === 'dark');
            }
            
            themeLightBtn.addEventListener('click', () => setTheme('light'));
            themeDarkBtn.addEventListener('click', () => setTheme('dark'));

            const enrollmentOpenBtn = document.getElementById('enrollmentOpenBtn');
            const enrollmentCloseBtn = document.getElementById('enrollmentCloseBtn');

             function updateEnrollmentButtonState() {
                const status = localStorage.getItem('enrollmentStatus') || 'open';
                enrollmentOpenBtn.classList.toggle('active', status === 'open');
                enrollmentOpenBtn.classList.toggle('primary', status === 'open');
                enrollmentCloseBtn.classList.toggle('active', status === 'closed');
                enrollmentCloseBtn.classList.toggle('destructive', status === 'closed');
            }
            
            enrollmentOpenBtn.addEventListener('click', () => {
                localStorage.setItem('enrollmentStatus', 'open');
                showToast('Enrollment is now open.', 'success');
                updateEnrollmentButtonState();
            });
            enrollmentCloseBtn.addEventListener('click', () => {
                localStorage.setItem('enrollmentStatus', 'closed');
                showToast('Enrollment is now closed.', 'warning');
                updateEnrollmentButtonState();
            });

             // --- Logout Button ---
            document.getElementById('logoutBtn').addEventListener('click', async () => {
                const confirmed = await showConfirm(
                    'Logout',
                    'Are you sure you want to logout?',
                    'primary'
                );
                if (confirmed) {
                    window.location.href = 'logout.php';
                }
            });

            // Initial UI state updates
            updateEnrollmentButtonState();
            updateThemeButtons();
            updateAnnouncementButtonState();
        });
    </script>
</body>
</html>

