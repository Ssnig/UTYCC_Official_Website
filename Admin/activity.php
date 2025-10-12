<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Activity — UTYCC Admin</title>
  <meta name="description" content="Admin dashboard for managing UTYCC activity photos." />
  <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

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
      --bg: 220 20% 98%; --fg: 222 47% 11%; --muted: 220 20% 94%; --muted-foreground: 215 17% 47%;
      --primary: 220 83% 58%; --primary-foreground: 0 0% 100%;
      --secondary: 0 0% 100%; --secondary-foreground: 222 47% 11%;
      --card: 0 0% 100%; --card-foreground: 222 47% 11%; --border: 220 20% 91%; --ring: 220 83% 58%;
      --success: 153 61% 34%; --warning: 43 96% 56%; --danger: 0 84% 60%; --radius: 12px;
      --ease: cubic-bezier(.2,.8,.2,1); --duration: 220ms;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05); --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); --shadow-inset: inset 0 2px 4px 0 rgb(0 0 0 / 0.05);
    }
    html.dark {
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
    body {
      margin: 0; color: hsl(var(--fg)); background: hsl(var(--bg));
      font: 500 16px/1.4 'Inter', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial, "Apple Color Emoji", "Segoe UI Emoji";
      text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;
      transition: background var(--duration) var(--ease), color var(--duration) var(--ease);
    }
    a { color: inherit; text-decoration: none; }
    button { font: inherit; }
    .app { display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 72px 1fr; grid-template-areas: "sidebar header" "sidebar main"; min-height: 100dvh; }
    .sidebar { grid-area: sidebar; border-right: 1px solid hsl(var(--border)); background: hsl(var(--secondary)); padding: 20px 16px; position: sticky; top: 0; height: 100dvh; }
    .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
    .brand img { width: 32px; height: 32px; }
    .brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
    nav { margin-top: 18px; display: grid; gap: 8px; }
    .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); border: 1px solid transparent; transition: all var(--duration) var(--ease); }
    .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
    .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); box-shadow: var(--shadow-md); font-weight: 600; }
    .nav-link svg { width: 20px; height: 20px; }
    .header {
      grid-area: header; position: sticky; top: 0; z-index: 10;
      background: hsl(var(--card) / 0.8); backdrop-filter: blur(8px);
      border-bottom: 1px solid hsl(var(--border)); display: flex; align-items: center; gap: 12px; padding: 16px 20px;
    }
    .header h1 { margin-right: auto; font-size: 24px; font-weight: 800; }
    .user-info { display: flex; align-items: center; gap: 0.75rem; border-left: 1px solid hsl(var(--border)); padding-left: 1rem; margin-left: 1rem;}
    .user-info svg { width: 1.25rem; height: 1.25rem; color: hsl(var(--muted-foreground));}
    .user-info span { font-weight: 600; color: hsl(var(--fg));}

    .btn {
      --bcol: var(--border);
      display: inline-flex; align-items: center; justify-content: center; gap: 6px; 
      padding: 10px 14px; border-radius: 12px; border: 1px solid hsl(var(--bcol));
      background: hsl(var(--card)); color: hsl(var(--fg)); box-shadow: var(--shadow-md);
      transition: all var(--duration) var(--ease); cursor: pointer; font-weight: 600; 
    }
    .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
    .btn:active { transform: translateY(-1px) scale(0.98); box-shadow: var(--shadow-md); }
    .btn:focus-visible { outline: 2px solid hsl(var(--ring)); outline-offset: 2px; }
    .btn.primary { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
    .btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
    .btn.icon-btn { padding: 8px; box-shadow: var(--shadow-sm); }
    .main { grid-area: main; padding: 20px; background: hsl(var(--bg));}
    .section { margin-top: 24px; }
    .section:first-child { margin-top: 0; }
    .section-header { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px; }
    .section-header h2 { font-size: 20px; margin: 0; font-weight: 700; }
    .card { background: hsl(var(--card)); color: hsl(var(--card-foreground)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-md); }
    .toast-wrap { position: fixed; bottom: 20px; right: 20px; top: auto; width: min(380px, 92vw); display: grid; gap: 12px; z-index: 9999; pointer-events: none; }
    .toast { pointer-events: auto; display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--fg)); background: hsl(var(--card)); box-shadow: var(--shadow-lg); border-left: 4px solid hsl(var(--primary)); animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards; }
    .toast.success { border-left-color: hsl(var(--success)); }
    .toast.error { border-left-color: hsl(var(--danger)); }
    .toast .close-btn { background: transparent; border: 0; color: hsl(var(--muted-foreground)); opacity: 0.7; cursor: pointer; font-size: 20px; }
    .toast .close-btn:hover { opacity: 1; }
    @keyframes toastIn { from { opacity: 0; transform: translateY(100%); } to { opacity: 1; transform: translateY(0); } }
    @keyframes toastOut { from { opacity: 1; transform: translateY(0); } to { opacity: 0; transform: translateY(100%); } }
    
    .field { display: grid; gap: 6px; }
    .field label { font-size: 13px; color: hsl(var(--muted-foreground)); font-weight: 600; }
    .field input, .field select, .field textarea { padding: 10px 12px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--bg)); color: hsl(var(--fg)); outline: none; font: inherit; transition: all var(--duration) var(--ease); }
    .field input:focus, .field select:focus, .field textarea:focus { border-color: hsl(var(--ring)); box-shadow: 0 0 0 3px hsl(var(--ring)/0.25); }
    .field textarea { min-height: 80px; resize: vertical; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 18px; }
    .form-grid .full-width { grid-column: 1 / -1; }
    
    .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem; }
    .photo-card { border: 1px solid hsl(var(--border)); border-radius: var(--radius); overflow: hidden; background: hsl(var(--card)); box-shadow: var(--shadow-sm); transition: all var(--duration) var(--ease); position: relative; }
    .photo-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
    .photo-card img { width: 100%; height: 160px; object-fit: cover; background-color: hsl(var(--muted)); display: block; }
    .photo-content { padding: 12px; }
    .photo-content h3 { font-size: 14px; font-weight: 600; margin: 0 0 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .photo-content p { font-size: 12px; color: hsl(var(--muted-foreground)); margin: 0; }
    .photo-card .delete-btn { position: absolute; top: 8px; right: 8px; }
    #loader { text-align: center; padding: 2rem; font-weight: 600; color: hsl(var(--muted-foreground)); }

    @media (max-width: 780px) { .app { grid-template-columns: 1fr; grid-template-areas: "header" "main"; } .sidebar { display: none; } .form-grid { grid-template-columns: 1fr; } }
  </style>

</head>
<body>
  <div class="app" id="app">
    <aside class="sidebar" aria-label="Sidebar navigation">
      <div class="brand" aria-label="Brand">
        <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        <h1>UTYCC Admin</h1>
      </div>
      <nav>
        <a class="nav-link" href="admin_dashboard.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
          Registrations
        </a>
        <a class="nav-link" href="students.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          Students
        </a>
        <a class="nav-link" href="pre_approve.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
            Pre-Approved
        </a>
        <a class="nav-link" href="upload_result.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2 2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
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

    <header class="header" id="header">
        <h1>Upload Activity</h1>
        <div class="user-info">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span><?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?></span>
        </div>
    </header>

    <main class="main" id="main">
        <section class="section">
            <div class="section-header">
                <h2>Add New Activity Photo</h2>
            </div>
            <div class="card">
                <form id="uploadForm">
                    <div class="form-grid">
                        <div class="field full-width">
                            <label for="image">Photo File</label>
                            <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/webp, image/gif" required>
                        </div>
                        <div class="field">
                            <label for="title_en">Title (English)</label>
                            <input type="text" id="title_en" name="title_en" required>
                        </div>
                        <div class="field">
                            <label for="title_my">Title (Myanmar)</label>
                            <input type="text" id="title_my" name="title_my" required>
                        </div>
                        <div class="field full-width">
                            <label for="description_en">Description (English)</label>
                            <textarea id="description_en" name="description_en" required></textarea>
                        </div>
                        <div class="field full-width">
                            <label for="description_my">Description (Myanmar)</label>
                            <textarea id="description_my" name="description_my" required></textarea>
                        </div>
                        <div class="field full-width">
                            <label for="tag">Tag</label>
                            <select id="tag" name="tag" required>
                                <option value="" disabled selected>Select a tag</option>
                                <option value="campus">Campus</option>
                                <option value="community">Community</option>
                                <option value="innovation">Innovation</option>
                                <option value="events">Events</option>
                            </select>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: 1.5rem;">
                        <button type="submit" class="btn primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px; height: 16px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            Upload Photo
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <section class="section">
            <div class="section-header">
                <h2>Manage Existing Photos</h2>
            </div>
            <div id="galleryContainer" class="gallery-grid">
                <div id="loader">Loading photos...</div>
            </div>
        </section>
    </main>
  </div>
  
  <div class="toast-wrap"></div>

  <script>
    const galleryContainer = document.getElementById('galleryContainer');
    const uploadForm = document.getElementById('uploadForm');
    const loader = document.getElementById('loader');
    
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

    async function fetchPhotos() {
        loader.style.display = 'block';
        galleryContainer.innerHTML = '';
        galleryContainer.appendChild(loader);

        try {
            const response = await fetch('activity_api.php?action=get');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const photos = await response.json();
            renderPhotos(photos);
        } catch (error) {
            console.error('Failed to fetch photos:', error);
            loader.style.display = 'none';
            galleryContainer.innerHTML = '<p>Error loading photos. Please try again.</p>';
            showToast('Failed to load photos.', 'error');
        }
    }

    function renderPhotos(photos) {
        loader.style.display = 'none';
        galleryContainer.innerHTML = '';
        if (photos.length === 0) {
            galleryContainer.innerHTML = '<p style="color: hsl(var(--muted-foreground)); grid-column: 1 / -1; text-align: center;">No activity photos have been uploaded yet.</p>';
            return;
        }

        photos.forEach(photo => {
            const photoCard = document.createElement('div');
            photoCard.className = 'photo-card';
            // Use ../uploads_activity/ path to correctly locate image from Admin folder
            photoCard.innerHTML = `
                <img src="../uploads_activity/${photo.image_path.split('/').pop()}" alt="${photo.title.en}">
                <div class="photo-content">
                    <h3>${photo.title.en}</h3>
                    <p>Tag: ${photo.tag}</p>
                </div>
                <button class="btn destructive icon-btn delete-btn" data-id="${photo.id}" title="Delete Photo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:14px; height: 14px; pointer-events: none;"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
            `;
            galleryContainer.appendChild(photoCard);
        });
    }

    uploadForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(uploadForm);
        const submitButton = uploadForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Uploading...';

        try {
            const response = await fetch('activity_api.php?action=upload', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (response.ok && result.status === 'success') {
                showToast('Photo uploaded successfully!', 'success');
                uploadForm.reset();
                fetchPhotos();
            } else {
                throw new Error(result.message || 'An unknown error occurred.');
            }
        } catch (error) {
            console.error('Upload failed:', error);
            showToast(`Upload failed: ${error.message}`, 'error');
        } finally {
            submitButton.disabled = false;
            submitButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px; height: 16px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg> Upload Photo`;
        }
    });

    galleryContainer.addEventListener('click', async (e) => {
        if (e.target.closest('.delete-btn')) {
            const button = e.target.closest('.delete-btn');
            const photoId = button.dataset.id;
            
            if (confirm('Are you sure you want to delete this photo? This action cannot be undone.')) {
                try {
                    const response = await fetch('activity_api.php?action=delete', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: photoId })
                    });
                    
                    const result = await response.json();
                    if (response.ok && result.status === 'success') {
                        showToast('Photo deleted successfully.', 'success');
                        fetchPhotos();
                    } else {
                        throw new Error(result.message || 'Failed to delete photo.');
                    }
                } catch (error) {
                     console.error('Delete failed:', error);
                     showToast(`Delete failed: ${error.message}`, 'error');
                }
            }
        }
    });

    document.addEventListener('DOMContentLoaded', fetchPhotos);
  </script>
</body>
</html>

