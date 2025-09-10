<?php
// We will fetch existing activities to pass to the frontend state.
require_once '../Rform/db.php';
require_once 'auth_check.php';


$activities = [];
try {
    $stmt = $pdo->query("SELECT * FROM activities ORDER BY activity_date DESC");
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // In a real app, log this error instead of dying.
    die("Error fetching activities: " . $e->getMessage());
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Activities — UTYCC Admin</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

  <!-- Theme Loader Script -->
  <script>
    (function() {
      try {
        if (localStorage.getItem('theme') === 'dark') {
          document.documentElement.classList.add('dark');
        }
      } catch (e) { console.error(e); }
    })();
  </script>

  <!-- Google Fonts: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Shared Admin Styles -->
  <link rel="stylesheet" href="admin_styles.css">
  <style>
    :root {
      /* Light Theme (Default) */
      --bg: 220 20% 98%; --fg: 222 47% 11%; --muted: 214 32% 91%; --muted-foreground: 215 17% 47%;
      --primary: 220 83% 58%; --primary-foreground: 0 0% 100%; --secondary: 0 0% 100%; --secondary-foreground: 222 47% 11%;
      --card: 0 0% 100%; --card-foreground: 222 47% 11%; --border: 214 32% 91%; --ring: 220 83% 58%;
      --success: 153 61% 34%; --warning: 43 96% 56%; --danger: 0 84% 60%; --radius: 12px;
      --ease: cubic-bezier(.2,.8,.2,1); --duration: 220ms;
      --shadow-soft: 0 10px 30px -12px hsl(var(--primary)/0.25); --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
    }
 html.dark {
        /* Dark Theme */
        --bg: 0 0% 4%;
        --fg: 210 40% 98%;
        --muted: 0 0% 12%;
        --muted-foreground: 215 20% 65%;
        --primary: 217 91% 60%;
        --primary-foreground: 210 40% 98%;
        --secondary: 0 0% 6%;
        --secondary-foreground: 210 40% 98%;
        --card: 0 0% 8%;
        --card-foreground: 210 40% 98%;
        --border: 0 0% 15%;
        --ring: 217 91% 60%;
        --shadow-card: 0 10px 20px -10px hsl(0 0% 0% / 0.45);
    }
    * { box-sizing: border-box; }
    html, body { height: 100%; }
    a { color: inherit; text-decoration: none; }
    body {
      margin: 0; color: hsl(var(--fg)); background: hsl(var(--bg)); font: 500 16px/1.4 'Inter', sans-serif;
      text-rendering: optimizeLegibility; transition: background var(--duration) var(--ease), color var(--duration) var(--ease);
    }
    .app { display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 72px 1fr; grid-template-areas: "sidebar header" "sidebar main"; min-height: 100dvh; }
    .sidebar { grid-area: sidebar; border-right: 1px solid hsl(var(--border)); background: hsl(var(--secondary)); padding: 20px 16px; position: sticky; top: 0; height: 100dvh; }
    .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
    .brand img { width: 32px; height: 32px; }
    .brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
    nav { margin-top: 18px; display: grid; gap: 8px; }
    .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); transition: all var(--duration) var(--ease); }
    .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
    .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); box-shadow: var(--shadow-soft); }
    .header { grid-area: header; position: sticky; top: 0; z-index: 10; background: hsl(var(--card)); border-bottom: 1px solid hsl(var(--border)); display: flex; align-items: center; padding: 16px 20px; }
    .main { grid-area: main; padding: 20px; background: hsl(var(--bg));}
    .section-header { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px; }
    .section-header h2 { font-size: 20px; margin: 0; }
    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 14px; border-radius: 12px; border: 1px solid hsl(var(--border)); background: hsl(var(--card)); color: hsl(var(--fg)); box-shadow: var(--shadow-card); transition: all var(--duration) var(--ease); cursor: pointer; }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 30px -12px hsl(var(--fg)/0.25); }
    .btn.primary { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
    .btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
    .btn.ghost { background: transparent; }
    .table-wrap { overflow: auto; border: 1px solid hsl(var(--border)); border-radius: var(--radius); background: hsl(var(--card)); box-shadow: var(--shadow-card); }
    table { width: 100%; border-collapse: collapse; min-width: 800px; }
    thead th { text-align: left; font-size: 12px; text-transform: uppercase; color: hsl(var(--muted-foreground)); background: hsl(var(--bg)); position: sticky; top: 0; z-index: 1; }
    th, td { padding: 12px 14px; border-bottom: 1px solid hsl(var(--border)); }
    tbody tr:hover { background: hsl(var(--muted)); }
    dialog { border: none; border-radius: 16px; padding: 0; background: hsl(var(--card)); color: hsl(var(--card-foreground)); width: min(720px, 94vw); box-shadow: 0 30px 100px -40px hsl(var(--fg)/0.5); }
    dialog::backdrop { background: hsl(222 47% 11% / 0.45); backdrop-filter: blur(2px); }
    .modal-header, .modal-footer { padding: 16px 18px; display: flex; align-items: center; }
    .modal-header { justify-content: space-between; border-bottom: 1px solid hsl(var(--border)); }
    .modal-body { padding: 18px; display: grid; gap: 16px; max-height: 70vh; overflow-y: auto; }
    .modal-footer { justify-content: flex-end; gap: 8px; border-top: 1px solid hsl(var(--border)); }
    .field { display: grid; gap: 6px; }
    .field label { font-size: 13px; color: hsl(var(--muted-foreground)); }
    .field input, .field textarea { padding: 10px 12px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--bg)); color: hsl(var(--fg)); outline: none; font: inherit; }
    .field textarea { min-height: 80px; resize: vertical; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 18px; }
    .toast-wrap { position: fixed; top: 20px; right: 20px; width: min(360px, 92vw); display: grid; gap: 12px; z-index: 9999; pointer-events: none; }
    .toast { pointer-events: auto; display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--primary-foreground)); background: hsl(var(--fg)); box-shadow: var(--shadow-card); border-left: 4px solid hsl(var(--primary)); animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards; }
    .toast.success { border-left-color: hsl(var(--success)); } .toast.error { border-left-color: hsl(var(--danger)); }
    .toast .close-btn { background: transparent; border: 0; color: hsl(var(--primary-foreground)); opacity: 0.7; cursor: pointer; font-size: 20px; }
    @keyframes toastIn { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
    @keyframes toastOut { from { opacity: 1; transform: translateX(0); } to { opacity: 0; transform: translateX(100%); } }
  </style>
</head>
<body>
  <div class="app" id="app">
    <aside class="sidebar">
      <div class="brand">
        <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        <h1>UTYCC Admin Panel</h1>
      </div>
      <nav>
        <a class="nav-link" href="admin_dashboard.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
          Registrations
        </a>
 <a class="nav-link" href="pre_approve.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
            Pre-Approved
        </a>
        <a class="nav-link" href="upload_result.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
          Upload Results
        </a>
        <a class="nav-link" href="manage_results.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            Manage Results
        </a>
        
          <a class="nav-link" href="manage_stats.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            Manage Stats
        </a>
        <a class="nav-link active" href="activity.php">
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
        <h1>Manage Activities</h1>
        <div style="flex-grow: 1;"></div>
        <div class="user-info" style="display: flex; align-items: center; gap: 0.75rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1.25rem; height: 1.25rem; color: hsl(var(--muted-foreground));"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span style="font-weight: 600; color: hsl(var(--fg));">
                <?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?>
            </span>
        </div>
    </header>

    <main class="main">
      <section class="section">
        <div class="section-header">
          <h2>Campus Activities</h2>
          <button class="btn primary" id="addActivityBtn">Add New Activity</button>
        </div>

        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Image</th>
                <th>Title (EN)</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tbody"></tbody>
          </table>
        </div>
      </section>
    </main>
  </div>
  
  <!-- Add/Edit Modal -->
  <dialog id="activityModal">
    <form id="activityForm">
      <div class="modal-header">
        <strong id="modalTitle">Add New Activity</strong>
        <button class="btn ghost" type="button" id="closeModal">✕</button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="activity_id" name="activity_id" />
        <div class="field" style="grid-column: 1 / -1;">
            <label>Activity Image</label>
            <img id="photo_preview" src="https://placehold.co/400x200/EFEFEF/AAAAAA?text=Click+to+upload" alt="Activity Preview" style="width: 100%; height: auto; border-radius: 8px; object-fit: cover; border: 2px dashed hsl(var(--border)); cursor: pointer; aspect-ratio: 16/9;">
            <input type="file" id="activity_photo" name="activity_photo" accept="image/*" style="display: none;">
        </div>
        <div class="form-grid">
            <div class="field">
                <label for="title_en">Title (English)</label>
                <input id="title_en" name="title_en" required />
            </div>
            <div class="field">
                <label for="title_my">Title (Myanmar)</label>
                <input id="title_my" name="title_my" required />
            </div>
        </div>
        <div class="field">
            <label for="description_en">Description (English)</label>
            <textarea id="description_en" name="description_en" required></textarea>
        </div>
        <div class="field">
            <label for="description_my">Description (Myanmar)</label>
            <textarea id="description_my" name="description_my" required></textarea>
        </div>
        <div class="field">
            <label for="activity_date">Activity Date</label>
            <input id="activity_date" name="activity_date" type="date" required />
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn ghost" type="button" id="cancelModal">Cancel</button>
        <button class="btn primary" id="saveActivity">Save Activity</button>
      </div>
    </form>
  </dialog>
  
  <!-- Confirm Modal -->
  <dialog id="confirmModal">
    <div class="modal-header"> <strong id="confirmTitle">Confirm</strong> </div>
    <div class="modal-body"> <p id="confirmMessage">Are you sure?</p> </div>
    <div class="modal-footer">
        <button class="btn ghost" id="confirmCancel">Cancel</button>
        <button class="btn" id="confirmOK">Confirm</button>
    </div>
  </dialog>
  
  <div class="toast-wrap"></div>

  <script>
    const PHOTO_PLACEHOLDER = 'https://placehold.co/400x200/EFEFEF/AAAAAA?text=Click+to+upload';
    
    const state = {
      activities: <?php echo json_encode($activities); ?>,
    };
    
    function formatDate(iso) {
      if (!iso) return 'N/A';
      try { return new Date(iso).toLocaleDateString('en-CA'); } catch { return iso; }
    }

    function getSafePhotoUrl(path) {
        if (!path) return PHOTO_PLACEHOLDER;
        return `.${path}`; // Prepending dot assuming path is like /uploads/..
    }
    
    const toastWrap = document.querySelector(".toast-wrap");
    function showToast(message, type = "success", duration = 4000) {
        const toast = document.createElement("div");
        toast.className = `toast ${type}`;
        toast.innerHTML = `<span>${message}</span><button class="close-btn">×</button>`;
        toast.querySelector(".close-btn").onclick = () => toast.remove();
        toastWrap.appendChild(toast);
        setTimeout(() => toast.remove(), duration);
    }

    function showConfirm(title, message, confirmClass = 'destructive') {
      return new Promise(resolve => {
        const modal = document.getElementById('confirmModal');
        modal.querySelector('#confirmTitle').textContent = title;
        modal.querySelector('#confirmMessage').textContent = message;
        const okBtn = modal.querySelector('#confirmOK');
        okBtn.className = `btn ${confirmClass}`;
        modal.showModal();
        
        const close = (value) => {
            modal.close();
            resolve(value);
        };
        okBtn.onclick = () => close(true);
        modal.querySelector('#confirmCancel').onclick = () => close(false);
      });
    }

    function renderTable() {
      const tbody = document.getElementById('tbody');
      tbody.innerHTML = '';
      if (state.activities.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding: 20px;">No activities found. Add one to get started!</td></tr>`;
        return;
      }
      state.activities.forEach(act => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><img src="${getSafePhotoUrl(act.image_url)}" alt="${act.title_en}" style="width:100px; height:auto; border-radius: 4px; aspect-ratio: 16/9; object-fit:cover;"></td>
          <td>${act.title_en}</td>
          <td>${formatDate(act.activity_date)}</td>
          <td>
            <div style="display:flex; gap:6px;">
              <button class="btn ghost" data-edit="${act.activity_id}">Edit</button>
              <button class="btn destructive" data-del="${act.activity_id}">Delete</button>
            </div>
          </td>`;
        tbody.appendChild(tr);
      });
    }
    
    function openModal(activity = null) {
      const modal = document.getElementById('activityModal');
      const form = document.getElementById('activityForm');
      form.reset();
      
      document.getElementById('modalTitle').textContent = activity ? 'Edit Activity' : 'Add New Activity';
      document.getElementById('activity_id').value = activity ? activity.activity_id : '';
      document.getElementById('photo_preview').src = activity ? getSafePhotoUrl(activity.image_url) : PHOTO_PLACEHOLDER;

      if (activity) {
        document.getElementById('title_en').value = activity.title_en || '';
        document.getElementById('title_my').value = activity.title_my || '';
        document.getElementById('description_en').value = activity.description_en || '';
        document.getElementById('description_my').value = activity.description_my || '';
        document.getElementById('activity_date').value = formatDate(activity.activity_date);
      }
      modal.showModal();
    }

    function addEventListeners() {
      document.getElementById('addActivityBtn').addEventListener('click', () => openModal());
      document.getElementById('closeModal').addEventListener('click', () => document.getElementById('activityModal').close());
      document.getElementById('cancelModal').addEventListener('click', () => document.getElementById('activityModal').close());

      document.getElementById('photo_preview').addEventListener('click', () => document.getElementById('activity_photo').click());
      document.getElementById('activity_photo').addEventListener('change', (event) => {
          const file = event.target.files[0];
          if (file) {
              document.getElementById('photo_preview').src = URL.createObjectURL(file);
          }
      });
      
      document.getElementById('tbody').addEventListener('click', async e => {
        const btn = e.target.closest('button');
        if (!btn) return;
        
        const id = parseInt(btn.dataset.edit || btn.dataset.del, 10);
        const activity = state.activities.find(a => a.activity_id === id);
        if (!activity) return;

        if (btn.dataset.edit) {
            openModal(activity);
        } else if (btn.dataset.del) {
            const confirmed = await showConfirm('Delete Activity', `Are you sure you want to delete "${activity.title_en}"? This cannot be undone.`);
            if (!confirmed) return;
            
            const response = await fetch('activity_api.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ action: 'delete_activity', ids: [id] })
            }).then(res => res.json());

            if (response.status === 'success') {
                state.activities = state.activities.filter(a => a.activity_id !== id);
                renderTable();
                showToast('Activity deleted successfully.', 'success');
            } else {
                showToast(response.message || 'Failed to delete activity.', 'error');
            }
        }
      });
      
      document.getElementById('saveActivity').addEventListener('click', async (e) => {
        e.preventDefault();
        const form = document.getElementById('activityForm');
        const id = document.getElementById('activity_id').value;
        const action = id ? 'update_activity' : 'add_activity';

        // Basic validation
        if (!form.title_en.value || !form.title_my.value || !form.activity_date.value) {
            showToast('Please fill all required fields.', 'error');
            return;
        }
        if (action === 'add_activity' && !form.activity_photo.files[0]) {
            showToast('Please select an image for the new activity.', 'error');
            return;
        }

        const formData = new FormData(form);
        formData.append('action', action);

        try {
            const response = await fetch('activity_api.php', {
                method: 'POST',
                body: formData,
            });
            const result = await response.json();

            if (result.status === 'success' && result.activity) {
                if (action === 'add_activity') {
                    state.activities.unshift(result.activity); // Add to top
                } else {
                    const index = state.activities.findIndex(a => a.activity_id === result.activity.activity_id);
                    if (index > -1) state.activities[index] = result.activity;
                }
                state.activities.sort((a, b) => new Date(b.activity_date) - new Date(a.activity_date));
                renderTable();
                document.getElementById('activityModal').close();
                showToast(`Activity ${action === 'add_activity' ? 'added' : 'updated'}.`, 'success');
            } else {
                showToast(result.message || 'An unknown error occurred.', 'error');
            }
        } catch (error) {
            showToast('An error occurred while saving. Check console for details.', 'error');
            console.error(error);
        }
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      renderTable();
      addEventListeners();
    });
  </script>
</body>
</html>

