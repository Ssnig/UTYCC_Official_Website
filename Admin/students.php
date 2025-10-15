<?php
// Include the database configuration file
require_once '../Rform/db.php';
require_once 'auth_check.php';

// --- FETCH ALL APPROVED STUDENT DATA ---
$students = [];
// MODIFICATION: Added s.preferences to the SELECT statement
$sql = "SELECT s.*, s.preferences,
               f.father_id, f.father_name_mm, f.father_name_en, f.father_race, f.father_religion, f.father_nrc, f.father_phone, f.father_info, f.father_deceased_year, f.father_address,
               m.mother_id, m.mother_name_mm, m.mother_name_en, m.mother_race, m.mother_religion, m.mother_nrc, m.mother_phone, m.mother_info, m.mother_deceased_year, m.mother_address
        FROM students s
        LEFT JOIN fathers f ON s.student_id = f.student_id
        LEFT JOIN mothers m ON s.student_id = m.student_id
        WHERE s.status = 'approved'
        ORDER BY s.date DESC";

try {
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        // Ensure numeric and boolean types are correctly cast for JSON
        $row['student_id'] = (int)$row['student_id'];
        $row['dormitory_preference'] = (bool)$row['dormitory_preference'];
        if($row['father_deceased_year']) $row['father_deceased_year'] = (int)$row['father_deceased_year'];
        if($row['mother_deceased_year']) $row['mother_deceased_year'] = (int)$row['mother_deceased_year'];

        // MODIFICATION: Decode the JSON preferences string into an array
        $row['preferences'] = $row['preferences'] ? json_decode($row['preferences'], true) : null;

        $students[] = $row;
    }
} catch (PDOException $e) {
    // For a real application, you might want to log this error and show a friendly message.
    die("Error fetching student data: " . $e->getMessage());
}

// Close the connection by setting the PDO object to null
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Students — UTYCC Admin</title>
  <meta name="description" content="Manage all registered students in the UTYCC student registration system." />
  <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

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

  <!-- Google Fonts: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  

  <style>
    :root {
      /* Light Theme (Default) */
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

      /* Motion */
      --ease: cubic-bezier(.2,.8,.2,1);
      --duration: 220ms;

      /* Shadows */
      --shadow-soft: 0 10px 30px -12px hsl(var(--primary)/0.25);
      --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
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
    .header h1 {
        font-size: 24px;
        margin: 0;
        margin-right: 16px;
    }
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

    .section { margin-top: 0; }
    .section-header { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px; }
    .section-header h2 { font-size: 20px; margin: 0; }

    /* Table */
    .table-wrap { overflow: auto; border: 1px solid hsl(var(--border)); border-radius: var(--radius); background: hsl(var(--card)); box-shadow: var(--shadow-card); }
    table { width: 100%; border-collapse: collapse; min-width: 900px; }
    thead th { text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; color: hsl(var(--muted-foreground)); background: hsl(var(--bg)); position: sticky; top: 0; z-index: 1; }
    th, td { padding: 12px 14px; border-bottom: 1px solid hsl(var(--border)); }
    tbody tr:hover { background: hsl(var(--muted)); }

    .toolbar { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; width: 100%;}
    .toolbar .spacer { flex: 1; }

    /* Toast Notifications */
    .toast-wrap {
      position: fixed;
      top: 20px;
      right: 20px;
      width: min(360px, 92vw);
      display: grid;
      gap: 12px;
      z-index: 9999;
      pointer-events: none;
    }
    .toast {
      pointer-events: auto;
      display: grid;
      grid-template-columns: 1fr auto;
      align-items: center;
      gap: 12px;
      padding: 14px 18px;
      border-radius: 10px;
      color: hsl(var(--primary-foreground));
      background: hsl(var(--fg));
      box-shadow: var(--shadow-card);
      border-left: 4px solid hsl(var(--primary));
      animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards;
    }
    .toast.success { border-left-color: hsl(var(--success)); }
    .toast.warning { border-left-color: hsl(var(--warning)); }
    .toast.error { border-left-color: hsl(var(--danger)); }
    .toast .close-btn {
      background: transparent;
      border: 0;
      color: hsl(var(--primary-foreground));
      opacity: 0.7;
      cursor: pointer;
      font-size: 20px;
    }

    @keyframes toastIn {
      from { opacity: 0; transform: translateX(100%); }
      to { opacity: 1; transform: translateX(0); }
    }
    @keyframes toastOut {
      from { opacity: 1; transform: translateX(0); }
      to { opacity: 0; transform: translateX(100%); }
    }

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
    .field input:disabled, .field select:disabled { background: hsl(var(--muted)); cursor: not-allowed; }
    .field textarea { min-height: 60px; resize: vertical; }
    .field-checkbox { display: flex; align-items: center; gap: 8px; }
    .field-checkbox label { margin: 0; }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 18px;
    }

    .details-grid {
      display: grid;
      grid-template-columns: 140px 1fr;
      gap: 16px;
      font-size: 15px;
    }
    .details-grid dt {
      font-weight: 600;
      color: hsl(var(--muted-foreground));
    }
    .details-grid dd {
      margin: 0;
      word-break: break-all;
    }
    
    .detail-section-header {
      font-size: 1.1rem;
      font-weight: 700;
      color: hsl(var(--fg));
      margin-top: 20px;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 1px solid hsl(var(--border));
      grid-column: 1 / -1; /* Span across grid columns */
    }
    .detail-section-header:first-of-type {
      margin-top: 0;
    }
    
    .detail-parent-section h4 {
        font-weight: 600;
        margin-top: 16px;
        margin-bottom: 8px;
        color: hsl(var(--primary));
    }

    /* NEW Document Grid Styles */
    .documents-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
      gap: 1rem;
    }
    .doc-item a {
      display: block;
      border: 1px solid hsl(var(--border));
      border-radius: 8px;
      overflow: hidden;
      text-decoration: none;
      color: hsl(var(--fg));
      transition: all .2s ease;
    }
    .doc-item a:hover {
      box-shadow: var(--shadow-card);
      transform: translateY(-2px);
    }
    .doc-item img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      background-color: hsl(var(--muted));
    }
    .doc-item p {
      font-size: 13px;
      padding: 8px;
      text-align: center;
      font-weight: 500;
    }
    /* END NEW Styles */

    .pagination { display: flex; align-items: center; gap: 8px; justify-content: flex-end; padding-top: 10px; }
    .pagination .info { color: hsl(var(--muted-foreground)); font-size: 13px; margin-right: auto; }

    /* MODIFIED: Add Student Choice Modal UI */
    .choice-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }
    .choice-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 2rem 1rem;
      border-radius: var(--radius);
      border: 1px solid hsl(var(--border));
      background: hsl(var(--secondary));
      cursor: pointer;
      transition: all var(--duration) var(--ease);
    }
    .choice-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-card);
      border-color: hsl(var(--primary));
    }
    .choice-card svg {
      color: hsl(var(--primary));
      margin-bottom: 1rem;
    }
    .choice-card h3 {
      margin: 0 0 0.25rem 0;
      font-size: 1.1rem;
      color: hsl(var(--fg));
    }
    .choice-card p {
      margin: 0;
      font-size: 0.9rem;
      color: hsl(var(--muted-foreground));
    }
    .choice-card.primary {
      background: hsl(var(--primary));
      border-color: hsl(var(--primary));
    }
    .choice-card.primary:hover {
       background: hsl(var(--primary) / 0.9);
    }
    .choice-card.primary svg,
    .choice-card.primary h3,
    .choice-card.primary p {
      color: hsl(var(--primary-foreground));
    }
    
    /* NEW: Alert Modal Styles */
    .modal-icon-wrap {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
    }
    .modal-icon-wrap.danger {
        background-color: hsl(var(--danger) / 0.1);
    }
    .modal-icon-wrap.danger svg {
        color: hsl(var(--danger));
    }

    /* Responsive */
    @media (max-width: 1000px) {
      .form-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 780px) {
      .app { grid-template-columns: 1fr; grid-template-areas:
          "header"
          "main"; }
      .sidebar { position: static; height: auto; display: none; }
    }
    @media (max-width: 600px) {
      .choice-container {
        grid-template-columns: 1fr;
      }
    }
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
          <a class="nav-link active" href="students.php">
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
        <a class="nav-link" href="activity.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2 2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
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
      <h1>Approved Students</h1>
      <form class="search" role="search" aria-label="Search students" onsubmit="event.preventDefault()">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="10.5" cy="10.5" r="6.5" stroke="currentColor" stroke-width="2"/></svg>
        <input id="search" name="q" placeholder="Search by name, email, seat no, phone, or NRC..." autocomplete="off" />
      </form>
      <div class="userbar">
        <button class="btn ghost" id="exportBtn" title="Export CSV" aria-label="Export CSV">Export</button>
        <button class="btn primary" id="openAddChoiceBtn" aria-label="Add student">Add Student</button>
        <div class="user-info" style="display: flex; align-items: center; gap: 0.5rem; margin-left: 1rem; border-left: 1px solid hsl(var(--border)); padding-left: 1rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1.25rem; height: 1.25rem; color: hsl(var(--muted-foreground));"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span style="font-weight: 600; color: hsl(var(--fg));">
                <?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?>
            </span>
        </div>
      </div>
    </header>

    <main class="main" id="main">
      <section class="section" id="students">
        <div class="section-header">
          <div class="toolbar">
            <div id="studentCountDisplay" style="font-weight: 600; color: hsl(var(--muted-foreground)); margin-right: 16px;"></div>
             <!-- START: Year Filter Dropdown -->
             <div class="field" style="min-width: 200px;">
                <select id="yearFilter" aria-label="Filter by Year">
                    <option value="all">All Years</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                    <option value="Fifth Year">Fifth Year</option>
                    <option value="Sixth Year">Sixth Year (Final)</option>
                </select>
             </div>
             <!-- END: Year Filter Dropdown -->
             <!-- NEW: Dormitory Filter Dropdown -->
             <div class="field" style="min-width: 200px;">
                <select id="dormitoryFilter" aria-label="Filter by Dormitory">
                    <option value="all">All Dormitory</option>
                    <option value="yes">Dormitory: Yes</option>
                    <option value="no">Dormitory: No</option>
                </select>
             </div>
             <!-- NEW: Major Filter Dropdown -->
             <div class="field" style="min-width: 200px;">
                <select id="majorFilter" aria-label="Filter by Major">
                    <option value="all">All Majors</option>
                    <option value="IST">Information Science & Technology (IST)</option>
                    <option value="CE">Computer Engineering (CE)</option>
                    <option value="EcE">Electronic Engineering (EcE)</option>
                    <option value="PrE">Precision Engineering (PrE)</option>
                    <option value="AME">Advanced Materials Engineering (AME)</option>
                    <option value="unknown">Unknown/No Major</option>
                </select>
             </div>
             <button class="btn ghost" id="clearFiltersBtn" style="margin-left: 8px;">Clear Filters</button>
            <div class="spacer"></div>
            <button class="btn destructive" id="bulkDeleteBtn" disabled>Delete Selected</button>
          </div>
        </div>

        <div class="table-wrap">
          <table aria-describedby="students table">
            <thead>
              <tr>
                <th><input type="checkbox" id="selectAll" aria-label="Select all" /></th>
                <th data-sort="seat_no" class="sortable">Seat No</th>
                <th data-sort="student_name_en" class="sortable">Name</th>
                <th data-sort="student_email" class="sortable">Email</th>
                <th data-sort="student_phone" class="sortable">Phone</th>
                <th data-sort="date" class="sortable">Registered</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="tbody"></tbody>
          </table>
        </div>
        <div class="pagination">
          <div class="info" id="pageInfo">0–0 of 0</div>
          <button class="btn ghost" id="prevPage">Prev</button>
          <button class="btn ghost" id="nextPage">Next</button>
        </div>
      </section>
    </main>
  </div>

  <!-- MODIFIED: Add Student Choice Modal -->
  <dialog id="addChoiceModal" aria-modal="true">
    <div class="modal-header">
        <strong>Add New Student</strong>
        <button class="btn ghost" type="button" onclick="document.getElementById('addChoiceModal').close()" aria-label="Close">✕</button>
    </div>
    <div class="modal-body" style="padding: 2rem;">
        <p style="text-align: center; margin-top: 0; margin-bottom: 2rem; color: hsl(var(--muted-foreground));">Select the type of student you want to add</p>
        <div class="choice-container">
            <div class="choice-card" id="addNewUndecided">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                <h3>Undecided Major</h3>
                <p>For students with 5 major preferences</p>
            </div>
            <div class="choice-card primary" id="addNewDecided">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="m9 12 2 2 4-4"></path></svg>
                <h3>Decided Major</h3>
                <p>For students with one selected major</p>
            </div>
        </div>
    </div>
  </dialog>

  <!-- Modal: Add/Edit Student -->
  <dialog id="studentModal" aria-modal="true">
    <form method="dialog" id="studentForm" novalidate>
      <div class="modal-header">
        <strong id="modalTitle">Add Student</strong>
        <button class="btn ghost" type="button" id="closeModal" aria-label="Close">✕</button>
      </div>
      <div class="modal-body">
        
        <input type="hidden" id="student_id" name="student_id" />
        <div class="form-grid">
            <!-- NEW: Image Upload Section -->
            <div style="grid-column: 1 / -1; text-align: center; margin-bottom: 12px;">
                <img id="photo_preview" src="https://placehold.co/120x120/EFEFEF/AAAAAA?text=Photo" alt="Student Photo Preview" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 2px solid hsl(var(--border)); cursor: pointer;">
                <input type="file" id="student_photo" name="student_photo" accept="image/*" style="display: none;">
                <p style="font-size: 12px; color: hsl(var(--muted-foreground)); margin-top: 8px;">Click image to upload a new photo</p>
            </div>
          
            <h3 class="detail-section-header">Student Information</h3>
            <div class="field">
                <label for="student_name_en">Name (EN)</label>
                <input id="student_name_en" name="student_name_en" required />
            </div>
            <div class="field">
                <label for="student_name_mm">Name (MM)</label>
                <input id="student_name_mm" name="student_name_mm" required/>
            </div>
            <div class="field">
                <label for="seat_no">Seat No.</label>
                <input id="seat_no" name="seat_no" required />
            </div>
            <div class="field">
                <label for="student_email">Email</label>
                <input id="student_email" name="student_email" type="email" required />
            </div>
            <div class="field">
                <label for="student_phone">Phone</label>
                <input id="student_phone" name="student_phone" required/>
            </div>
            <div class="field">
                <label for="student_nrc">NRC</label>
                <input id="student_nrc" name="student_nrc" required/>
            </div>
            <div class="field">
                <label for="student_dob">Date of Birth</label>
                <input id="student_dob" name="student_dob" type="date" required/>
            </div>
             <div class="field">
                <label for="student_birthplace">Birthplace</label>
                <input id="student_birthplace" name="student_birthplace" required/>
            </div>
            <div class="field">
                <label for="student_race">Race</label>
                <input id="student_race" name="student_race" required/>
            </div>
            <div class="field">
                <label for="student_religion">Religion</label>
                <input id="student_religion" name="student_religion" required/>
            </div>
            <div class="field">
                <label for="township">Township</label>
                <input id="township" name="township" required/>
            </div>
            <div class="field">
                <label for="state_region">State/Region</label>
                <input id="state_region" name="state_region" required/>
            </div>
             <div class="field" style="grid-column: 1 / -1;">
                <label for="student_address">Address</label>
                <textarea id="student_address" name="student_address" required></textarea>
            </div>
            <div class="field-checkbox" style="grid-column: 1 / -1;">
                <input id="dormitory_preference" name="dormitory_preference" type="checkbox" />
                <label for="dormitory_preference">Requires Dormitory</label>
            </div>

            <h3 class="detail-section-header">Academic Information</h3>
            <div class="field">
                <label for="year">Year</label>
                <input id="year" name="year" required/>
            </div>
            <div class="field">
                <label for="academic_year">Academic Year</label>
                <input id="academic_year" name="academic_year" required/>
            </div>
            <div class="field">
                <label for="entry_year">Entry Year</label>
                <input id="entry_year" name="entry_year" required/>
            </div>
            
            <!-- NEW: Single Major Selection Section -->
            <div class="field" id="selectedMajorSection" style="display: none; grid-column: 1 / -1;">
                <label for="selected_major">Selected Major</label>
                <select id="selected_major" name="selected_major"></select>
            </div>

            <!-- MODIFIED: Wrapped Preferences in a container -->
            <div id="preferencesSectionContainer" style="grid-column: 1 / -1; display: none;">
                <h3 class="detail-section-header">Major Preferences</h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="preference1">Preference 1</label>
                        <select id="preference1" name="preference1"></select>
                    </div>
                     <div class="field">
                        <label for="preference2">Preference 2</label>
                        <select id="preference2" name="preference2"></select>
                    </div>
                     <div class="field">
                        <label for="preference3">Preference 3</label>
                        <select id="preference3" name="preference3"></select>
                    </div>
                     <div class="field">
                        <label for="preference4">Preference 4</label>
                        <select id="preference4" name="preference4"></select>
                    </div>
                     <div class="field">
                        <label for="preference5">Preference 5</label>
                        <select id="preference5" name="preference5"></select>
                    </div>
                </div>
            </div>

            <h3 class="detail-section-header">Father's Information</h3>
            <div class="field">
                <label for="father_deceased_year">Deceased Year (if applicable)</label>
                <input id="father_deceased_year" name="father_deceased_year" type="number" placeholder="YYYY" />
            </div>
            <div class="field">
                <label for="father_name_en">Name (EN)</label>
                <input id="father_name_en" name="father_name_en" required/>
            </div>
            <div class="field">
                <label for="father_name_mm">Name (MM)</label>
                <input id="father_name_mm" name="father_name_mm" required/>
            </div>
             <div class="field">
                <label for="father_nrc">NRC</label>
                <input id="father_nrc" name="father_nrc" required/>
            </div>
            <div class="field">
                <label for="father_phone">Phone</label>
                <input id="father_phone" name="father_phone" required/>
            </div>
             <div class="field">
                <label for="father_race">Race</label>
                <input id="father_race" name="father_race" required/>
            </div>
            <div class="field">
                <label for="father_religion">Religion</label>
                <input id="father_religion" name="father_religion" required/>
            </div>
             <div class="field" style="grid-column: 1 / -1;">
                <label for="father_info">Occupation</label>
                <input id="father_info" name="father_info" required/>
            </div>
            <div class="field" style="grid-column: 1 / -1;">
                <label for="father_address">Address</label>
                <textarea id="father_address" name="father_address" required></textarea>
            </div>

            <h3 class="detail-section-header">Mother's Information</h3>
            <div class="field">
                <label for="mother_deceased_year">Deceased Year (if applicable)</label>
                <input id="mother_deceased_year" name="mother_deceased_year" type="number" placeholder="YYYY" />
            </div>
            <div class="field">
                <label for="mother_name_en">Name (EN)</label>
                <input id="mother_name_en" name="mother_name_en" required/>
            </div>
            <div class="field">
                <label for="mother_name_mm">Name (MM)</label>
                <input id="mother_name_mm" name="mother_name_mm" required/>
            </div>
             <div class="field">
                <label for="mother_nrc">NRC</label>
                <input id="mother_nrc" name="mother_nrc" required/>
            </div>
            <div class="field">
                <label for="mother_phone">Phone</label>
                <input id="mother_phone" name="mother_phone" required/>
            </div>
             <div class="field">
                <label for="mother_race">Race</label>
                <input id="mother_race" name="mother_race" required/>
            </div>
            <div class="field">
                <label for="mother_religion">Religion</label>
                <input id="mother_religion" name="mother_religion" required/>
            </div>
             <div class="field" style="grid-column: 1 / -1;">
                <label for="mother_info">Occupation</label>
                <input id="mother_info" name="mother_info" required/>
            </div>
            <div class="field" style="grid-column: 1 / -1;">
                <label for="mother_address">Address</label>
                <textarea id="mother_address" name="mother_address" required></textarea>
            </div>

            <!-- NEW: Document section for Edit Modal -->
            <h3 class="detail-section-header">Submitted Documents</h3>
            <div id="edit-documents-grid" class="documents-grid" style="grid-column: 1 / -1;">
                <!-- JS will populate this -->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn ghost" value="cancel" type="button" id="cancelModal">Cancel</button>
        <button class="btn primary" value="default" id="saveStudent">Save Changes</button>
      </div>
    </form>
  </dialog>

  <!-- Modal: View Student Details -->
  <dialog id="detailsModal" aria-modal="true">
    <div class="modal-header">
      <strong>Student Details</strong>
      <button class="btn ghost" type="button" id="closeDetailsModal" aria-label="Close">✕</button>
    </div>
    <div class="modal-body" id="detailsModalBody">
      <!-- Details will be populated here -->
    </div>
    <div class="modal-footer">
      <button class="btn primary" type="button" id="okDetailsModal">OK</button>
    </div>
  </dialog>
  
  <!-- MODIFIED: Modal for Confirmation / Alert -->
  <dialog id="confirmModal" aria-modal="true">
     <div class="modal-body" style="text-align: center; padding: 2.5rem 2rem;">
        <div id="confirmIcon" class="modal-icon-wrap" style="display: none;">
            <!-- SVG will be injected here -->
        </div>
        <h2 id="confirmTitle" style="margin-top: 0; margin-bottom: 0.5rem; font-size: 1.5rem;">Confirm Action</h2>
        <p id="confirmMessage" style="margin-top: 0; color: hsl(var(--muted-foreground)); white-space: pre-wrap;"></p>
    </div>
    <div class="modal-footer" style="padding-top:0; justify-content: center;">
        <button class="btn ghost" id="confirmCancel">Cancel</button>
        <button class="btn destructive" id="confirmOK">Confirm</button>
    </div>
  </dialog>

  <div class="toast-wrap"></div>

  <script>
    const PAGE_SIZE = 8;
    const PHOTO_PLACEHOLDER = 'https://placehold.co/120x120/EFEFEF/AAAAAA?text=Photo';
    
    const availableMajors = {
        'IST': 'Information Science & Technology (IST)',
        'CE' : 'Computer Engineering (CE)',
        'EcE': 'Electronic Engineering (EcE)',
        'PrE': 'Precision Engineering (PrE)',
        'AME': 'Advanced Materials Engineering (AME)',
    };

    const state = {
      students: <?php echo json_encode($students); ?>,
      q: '',
      year: 'all',
      dormitory: 'all',
      major: 'all', // NEW: Add major for filtering
      page: 1,
      sort: { key: 'date', dir: 'desc' },
      selected: new Set(),
    };
    
    // FIXED: Improved getSafeUrl function to handle various path formats
    function getSafeUrl(path) {
        if (!path || path.trim() === '' || path === 'null') {
            return 'https://placehold.co/120x120/EFEFEF/AAAAAA?text=Photo';
        }
        
        if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('data:')) {
            return path;
        }
        
        if (path.startsWith('/uploads/')) {
            return `../Rform${path}`;
        }
        
        if (path.includes('uploads/')) {
            const cleanPath = path.replace(/^\.\.\/Rform\//, '').replace(/^\//, '');
            return `../Rform/${cleanPath}`;
        }
        
        return `../Rform/${path}`;
    }

    function todayStr(d = new Date()) { return d.toISOString().split('T')[0]; }

    function formatDate(iso) {
      if (!iso) return 'N/A';
      try { const d = new Date(iso); return d.toLocaleDateString(); } catch { return iso; }
    }

    function cmp(a, b, key) {
      const av = a[key] || ''; 
      const bv = b[key] || '';
      if (key === 'date' || key === 'student_dob') return new Date(av) - new Date(bv);
      return av.toString().localeCompare(bv.toString());
    }

    async function apiRequest(action, data) {
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action, ...data }),
            });
            if (!response.ok) {
                const errorResult = await response.json();
                throw new Error(errorResult.message || `HTTP error ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('API Request Failed:', error);
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
    
    const formElements = {};
    document.querySelectorAll('#studentForm [name]').forEach(el => {
        formElements[el.name] = el;
    });

    function showAlert(title, message, type = 'danger') {
      const confirmModal = document.getElementById('confirmModal');
      const iconWrap = document.getElementById('confirmIcon');
      const confirmTitle = document.getElementById('confirmTitle');
      const confirmMessage = document.getElementById('confirmMessage');
      const confirmBtn = document.getElementById('confirmOK');
      const cancelBtn = document.getElementById('confirmCancel');
      
      confirmTitle.textContent = title;
      confirmMessage.innerHTML = message.replace(/\n/g, '<br>');

      confirmBtn.className = 'btn primary';
      confirmBtn.textContent = 'OK';
      cancelBtn.style.display = 'none';

      iconWrap.style.display = 'inline-flex';
      iconWrap.className = `modal-icon-wrap ${type}`;
      if(type === 'danger') {
          iconWrap.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>`;
      } else { 
          iconWrap.innerHTML = ``;
      }

      const handleConfirm = () => { 
          confirmModal.close();
          cancelBtn.style.display = '';
          confirmBtn.textContent = 'Confirm';
          iconWrap.style.display = 'none';
          confirmBtn.removeEventListener('click', handleConfirm);
          cancelBtn.removeEventListener('click', handleConfirm);
      };
      
      confirmBtn.addEventListener('click', handleConfirm, { once: true });
      cancelBtn.addEventListener('click', handleConfirm, { once: true }); 

      confirmModal.showModal();
    }


    function showConfirm(title, message, confirmClass = 'destructive') {
      return new Promise(resolve => {
        const confirmModal = document.getElementById('confirmModal');
        const iconWrap = document.getElementById('confirmIcon');
        const confirmTitle = document.getElementById('confirmTitle');
        const confirmMessage = document.getElementById('confirmMessage');
        const confirmBtn = document.getElementById('confirmOK');
        const cancelBtn = document.getElementById('confirmCancel');
        
        iconWrap.style.display = 'none';
        
        confirmTitle.textContent = title;
        confirmMessage.textContent = message;
        
        cancelBtn.style.display = '';
        confirmBtn.textContent = 'Confirm';
        confirmBtn.className = `btn ${confirmClass}`;

        const handleConfirm = () => { confirmModal.close(); resolve(true); cleanup(); };
        const handleCancel = () => { confirmModal.close(); resolve(false); cleanup(); };

        const cleanup = () => {
            confirmBtn.removeEventListener('click', handleConfirm);
            cancelBtn.removeEventListener('click', handleCancel);
        };
        
        confirmBtn.addEventListener('click', handleConfirm, { once: true });
        cancelBtn.addEventListener('click', handleCancel, { once: true });
        confirmModal.showModal();
      });
    }

    // NEW: Function to populate all major dropdowns
    function populateMajorDropdowns() {
        const dropdowns = document.querySelectorAll('#preference1, #preference2, #preference3, #preference4, #preference5, #selected_major');
        dropdowns.forEach(selectEl => {
            selectEl.innerHTML = '';
            let placeholder = document.createElement('option');
            placeholder.value = "";
            placeholder.text = "Select a major";
            // placeholder.disabled = true;
            placeholder.selected = true;
            selectEl.add(placeholder);

            for (const code in availableMajors) {
                let option = document.createElement('option');
                option.value = code;
                option.text = availableMajors[code];
                selectEl.add(option);
            }
        });
    }

    function toggleParentRequired(parentPrefix) {
      const deceasedYearInput = document.getElementById(`${parentPrefix}_deceased_year`);
      const isDeceased = deceasedYearInput.value.trim() !== '';
      
      const fieldsToToggle = [`${parentPrefix}_phone`, `${parentPrefix}_info`, `${parentPrefix}_address`];
      
      fieldsToToggle.forEach(fieldId => {
        const element = document.getElementById(fieldId);
        const label = document.querySelector(`label[for="${fieldId}"]`);
        if (element) {
          element.required = !isDeceased;
          if (label) {
            if (isDeceased) {
              label.textContent = label.textContent.replace(' (Optional)', '') + ' (Optional)';
            } else {
              label.textContent = label.textContent.replace(' (Optional)', '');
            }
          }
        }
      });
    }

    function openModal(mode, student = null, addType = 'undecided') {
        const modal = document.getElementById('studentModal');
        const form = document.getElementById('studentForm');
        const saveButton = document.getElementById('saveStudent');
        
        form.reset();
        document.getElementById('photo_preview').src = PHOTO_PLACEHOLDER;
        formElements.student_id.value = '';

        const selectedMajorSection = document.getElementById('selectedMajorSection');
        const preferencesSectionContainer = document.getElementById('preferencesSectionContainer');
        const selectedMajorDropdown = document.getElementById('selected_major');
        const prefDropdowns = preferencesSectionContainer.querySelectorAll('select');

        selectedMajorSection.style.display = 'none';
        preferencesSectionContainer.style.display = 'none';
        selectedMajorDropdown.required = false;
        prefDropdowns.forEach(el => el.required = false);

        if (mode === 'edit' && student) {
            document.getElementById('modalTitle').textContent = 'Edit Student';
            saveButton.textContent = 'Save Changes';
            const hasPhoto = student.photo_url && student.photo_url.trim() !== '';
            form.dataset.hasExistingPhoto = hasPhoto;

            for (const key in formElements) {
                const element = formElements[key];
                if (element && element.type === 'checkbox') {
                    element.checked = !!student[key];
                } else if (element && element.type !== 'file' && !element.name.startsWith('preference')) {
                    element.value = student[key] || '';
                }
            }
            document.getElementById('photo_preview').src = student.photo_url ? getSafeUrl(student.photo_url) : PHOTO_PLACEHOLDER;
            
            const hasSelectedMajor = student.selected_major && student.selected_major.trim() !== '';
            if (hasSelectedMajor) {
                selectedMajorSection.style.display = 'grid';
                selectedMajorDropdown.required = true;
                selectedMajorDropdown.value = student.selected_major;
            } else {
                preferencesSectionContainer.style.display = 'block';
                document.getElementById('preference1').required = true;
                for (let i = 1; i <= 5; i++) {
                    const selectEl = document.getElementById(`preference${i}`);
                    const prefValue = student.preferences ? student.preferences[i] : '';
                    if (prefValue) {
                        selectEl.value = prefValue;
                    }
                }
            }
            populateDocumentsForEdit(student);
        } else if (mode === 'add') {
            saveButton.textContent = 'Add Student';
            form.dataset.hasExistingPhoto = 'false';
            if (addType === 'decided') {
                document.getElementById('modalTitle').textContent = 'Add Student (Decided Major)';
                selectedMajorSection.style.display = 'grid';
                selectedMajorDropdown.required = true;
            } else { // 'undecided'
                document.getElementById('modalTitle').textContent = 'Add Student (Undecided Major)';
                preferencesSectionContainer.style.display = 'block';
                document.getElementById('preference1').required = true;
            }
            document.getElementById('edit-documents-grid').innerHTML = '<p style="color: hsl(var(--muted-foreground));">No documents available for new student.</p>';
        }

        // Set initial required state for parent fields
        toggleParentRequired('father');
        toggleParentRequired('mother');
        
        modal.showModal();
        formElements.student_name_en.focus();
    }

    function populateDocumentsForEdit(student) {
        const documentsGrid = document.getElementById('edit-documents-grid');
        documentsGrid.innerHTML = ''; // Clear previous
        const documents = [
            { label: 'Recommendation', key: 'doc_recommendation' }, { label: 'Medical', key: 'doc_medical' },
            { label: 'Certificate', key: 'doc_certificate' }, { label: 'Grades', key: 'doc_grades' },
            { label: 'Household', key: 'doc_household' }, { label: 'Student NRC (Front)', key: 'doc_student_nrc_front' },
            { label: 'Student NRC (Back)', key: 'doc_student_nrc_back' }, { label: 'Father NRC (Front)', key: 'doc_father_nrc_front' },
            { label: 'Father NRC (Back)', key: 'doc_father_nrc_back' }, { label: 'Mother NRC (Front)', key: 'doc_mother_nrc_front' },
            { label: 'Mother NRC (Back)', key: 'doc_mother_nrc_back' },
        ];
        let hasDocuments = false;
        documents.forEach(doc => {
            const docPath = student[doc.key];
            if (docPath) {
                hasDocuments = true;
                documentsGrid.innerHTML += `
                    <div class="doc-item">
                        <a href="${getSafeUrl(docPath)}" target="_blank" title="View ${doc.label}">
                            <img src="${getSafeUrl(docPath)}" alt="${doc.label}" loading="lazy">
                            <p>${doc.label}</p>
                        </a>
                    </div>`;
            }
        });
        if (!hasDocuments) {
            documentsGrid.innerHTML = '<p style="color: hsl(var(--muted-foreground));">No documents were submitted.</p>';
        }
    }
    
    function closeModalSafe() { document.getElementById('studentModal').close(); }
    
    function openDetailsModal(s) {
        const detailsModal = document.getElementById('detailsModal');
        const detailsModalBody = document.getElementById('detailsModalBody');
        const photoUrl = s.photo_url ? getSafeUrl(s.photo_url) : PHOTO_PLACEHOLDER;

        const hasSelectedMajor = s.selected_major && s.selected_major.trim() !== '';
        const hasPreferences = s.preferences && typeof s.preferences === 'object' && Object.keys(s.preferences).length > 0;

        let preferencesHtml = '';
        if (hasSelectedMajor) {
            preferencesHtml = `<h3 class="detail-section-header">Selected Major</h3><dl class="details-grid"><dt>Selected Major</dt><dd>${availableMajors[s.selected_major] || 'Unknown Major'}</dd></dl>`;
        } else if (hasPreferences) {
            preferencesHtml += `<h3 class="detail-section-header">Major Preferences</h3><dl class="details-grid">`;
            for (let i = 1; i <= 5; i++) {
                const prefCode = s.preferences ? (s.preferences[i] || null) : null;
                if (prefCode) {
                    preferencesHtml += `<dt>Preference ${i}</dt><dd>${availableMajors[prefCode] || 'Unknown Major'}</dd>`;
                }
            }
            preferencesHtml += `</dl>`;
        }
        
        const documents = [
            { label: 'Recommendation', key: 'doc_recommendation' }, { label: 'Medical', key: 'doc_medical' },
            { label: 'Certificate', key: 'doc_certificate' }, { label: 'Grades', key: 'doc_grades' },
            { label: 'Household', key: 'doc_household' }, { label: 'Student NRC (Front)', key: 'doc_student_nrc_front' },
            { label: 'Student NRC (Back)', key: 'doc_student_nrc_back' }, { label: 'Father NRC (Front)', key: 'doc_father_nrc_front' },
            { label: 'Father NRC (Back)', key: 'doc_father_nrc_back' }, { label: 'Mother NRC (Front)', key: 'doc_mother_nrc_front' },
            { label: 'Mother NRC (Back)', key: 'doc_mother_nrc_back' },
        ];

        let documentsHtml = '<h3 class="detail-section-header">Required Documents</h3><div class="documents-grid">';
        documents.forEach(doc => {
            const docPath = s[doc.key];
            if (docPath) {
                documentsHtml += `
                    <div class="doc-item">
                        <a href="${getSafeUrl(docPath)}" target="_blank">
                            <img src="${getSafeUrl(docPath)}" alt="${doc.label}" loading="lazy">
                            <p>${doc.label}</p>
                        </a>
                    </div>`;
            }
        });
        documentsHtml += '</div>';

        detailsModalBody.innerHTML = `
            <div style="text-align: center; margin-bottom: 16px;">
                 <img src="${photoUrl}" alt="Student Photo" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 2px solid hsl(var(--border));">
            </div>
            <h3 class="detail-section-header">Student Information</h3>
            <dl class="details-grid">
                <dt>Seat No.</dt><dd>${s.seat_no || 'N/A'}</dd> <dt>Name (EN)</dt><dd>${s.student_name_en || 'N/A'}</dd>
                <dt>Name (MM)</dt><dd>${s.student_name_mm || 'N/A'}</dd> <dt>Email</dt><dd>${s.student_email || 'N/A'}</dd>
                <dt>Phone</dt><dd>${s.student_phone || 'N/A'}</dd> <dt>NRC</dt><dd>${s.student_nrc || 'N/A'}</dd>
                <dt>Date of Birth</dt><dd>${formatDate(s.student_dob)}</dd> <dt>Birthplace</dt><dd>${s.student_birthplace || 'N/A'}</dd>
                <dt>Race</dt><dd>${s.student_race || 'N/A'}</dd> <dt>Religion</dt><dd>${s.student_religion || 'N/A'}</dd>
                <dt>Address</dt><dd>${s.student_address || 'N/A'}</dd> <dt>Township</dt><dd>${s.township || 'N/A'}</dd>
                <dt>State/Region</dt><dd>${s.state_region || 'N/A'}</dd> <dt>Dormitory</dt><dd>${s.dormitory_preference ? 'Yes' : 'No'}</dd>
                <dt>Registered On</dt><dd>${formatDate(s.date)}</dd>
            </dl>
            <h3 class="detail-section-header">Academic Info</h3>
             <dl class="details-grid">
                <dt>Year</dt><dd>${s.year || 'N/A'}</dd> <dt>Academic Year</dt><dd>${s.academic_year || 'N/A'}</dd>
                <dt>Entry Year</dt><dd>${s.entry_year || 'N/A'}</dd>
            </dl>
            ${preferencesHtml}
            <h3 class="detail-section-header">Parent Information</h3>
            <div class="detail-parent-section">
                <h4>Father's Details</h4>
                <dl class="details-grid">
                    <dt>Status</dt><dd>${s.father_deceased_year ? `Deceased (${s.father_deceased_year})` : 'Alive'}</dd>
                    <dt>Name (EN)</dt><dd>${s.father_name_en || 'N/A'}</dd> <dt>Name (MM)</dt><dd>${s.father_name_mm || 'N/A'}</dd>
                    <dt>NRC</dt><dd>${s.father_nrc || 'N/A'}</dd> <dt>Race</dt><dd>${s.father_race || 'N/A'}</dd>
                    <dt>Religion</dt><dd>${s.father_religion || 'N/A'}</dd> <dt>Occupation</dt><dd>${s.father_info || 'N/A'}</dd>
                    <dt>Address</dt><dd>${s.father_address || 'N/A'}</dd> <dt>Phone</dt><dd>${s.father_phone || 'N/A'}</dd>
                </dl>
            </div>
            <div class="detail-parent-section">
                <h4>Mother's Details</h4>
                <dl class="details-grid">
                    <dt>Status</dt><dd>${s.mother_deceased_year ? `Deceased (${s.mother_deceased_year})` : 'Alive'}</dd>
                    <dt>Name (EN)</dt><dd>${s.mother_name_en || 'N/A'}</dd> <dt>Name (MM)</dt><dd>${s.mother_name_mm || 'N/A'}</dd>
                    <dt>NRC</dt><dd>${s.mother_nrc || 'N/A'}</dd> <dt>Race</dt><dd>${s.mother_race || 'N/A'}</dd>
                    <dt>Religion</dt><dd>${s.mother_religion || 'N/A'}</dd> <dt>Occupation</dt><dd>${s.mother_info || 'N/A'}</dd>
                    <dt>Address</dt><dd>${s.mother_address || 'N/A'}</dd> <dt>Phone</dt><dd>${s.mother_phone || 'N/A'}</dd>
                </dl>
            </div>
            ${documentsHtml}`;
        detailsModal.showModal();
    }

    function hasMajorData(student) {
        const hasSelectedMajor = student.selected_major && student.selected_major.trim() !== '';
        const hasPreferences = student.preferences && typeof student.preferences === 'object' && Object.keys(student.preferences).length > 0;
        return hasSelectedMajor || hasPreferences;
    }

    function hasSpecificMajor(student, majorCode) {
        if (student.selected_major && student.selected_major === majorCode) {
            return true;
        }
        
        if (student.preferences && typeof student.preferences === 'object') {
            for (let i = 1; i <= 5; i++) {
                if (student.preferences[i] === majorCode) {
                    return true;
                }
            }
        }
        
        return false;
    }

    function getFilteredSorted() {
      const q = state.q.toLowerCase();
      const selectedYear = state.year;
      const selectedDormitory = state.dormitory;
      const selectedMajor = state.major;

      const base = state.students.filter(s => {
          const matchesSearch = !q || 
                                (s.student_name_en && s.student_name_en.toLowerCase().includes(q)) || 
                                (s.student_email && s.student_email.toLowerCase().includes(q)) || 
                                (s.seat_no && s.seat_no.toLowerCase().includes(q)) ||
                                (s.student_phone && s.student_phone.includes(q)) ||
                                (s.student_nrc && s.student_nrc.toLowerCase().includes(q));
          const matchesYear = selectedYear === 'all' || s.academic_year === selectedYear;
          
          const matchesDormitory = selectedDormitory === 'all' ||
                                   (selectedDormitory === 'yes' && s.dormitory_preference) ||
                                   (selectedDormitory === 'no' && !s.dormitory_preference);

          const matchesMajor = selectedMajor === 'all' || 
                              (selectedMajor === 'unknown' && !hasMajorData(s)) ||
                              (selectedMajor !== 'unknown' && hasSpecificMajor(s, selectedMajor));

          return matchesSearch && matchesYear && matchesDormitory && matchesMajor;
      });

      const { key, dir } = state.sort;
      base.sort((a,b) => {
        const res = cmp(a,b,key);
        return dir === 'asc' ? res : -res;
      });
      return base;
    }

    function renderTable() {
      const rows = getFilteredSorted();
      const total = rows.length;
      const totalPages = Math.max(1, Math.ceil(total / PAGE_SIZE));
      state.page = Math.min(state.page, totalPages);
      const start = (state.page - 1) * PAGE_SIZE;
      const pageRows = rows.slice(start, start + PAGE_SIZE);
      const tbody = document.getElementById('tbody');

      tbody.innerHTML = '';
      if(pageRows.length === 0){
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; padding: 2rem;">No approved students found matching criteria.</td></tr>';
      } else {
        for (const s of pageRows) {
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td><input type="checkbox" data-id="${s.student_id}" ${state.selected.has(s.student_id)?'checked':''} /></td>
            <td>${s.seat_no || ''}</td>
            <td>${s.student_name_en || ''}</td>
            <td>${s.student_email || ''}</td>
            <td>${s.student_phone || ''}</td>
            <td>${formatDate(s.date)}</td>
            <td>
                <div style="display:flex; gap:6px;">
                <button class="btn ghost" data-details="${s.student_id}">Details</button>
                <button class="btn ghost" data-edit="${s.student_id}">Edit</button>
                <button class="btn destructive" data-del="${s.student_id}">Delete</button>
                </div>
            </td>`;
            tbody.appendChild(tr);
        }
      }

      document.getElementById('pageInfo').textContent = total ? `${start + 1}–${Math.min(start + PAGE_SIZE, total)} of ${total}` : '0–0 of 0';
      document.getElementById('prevPage').disabled = state.page <= 1;
      document.getElementById('nextPage').disabled = state.page >= totalPages;
      document.getElementById('bulkDeleteBtn').disabled = state.selected.size === 0;
    }

    function render() {
      const filteredCount = getFilteredSorted().length;
      document.getElementById('studentCountDisplay').textContent = `Total Students: ${filteredCount}`;
      renderTable();
    }
    
    function addEventListeners() {
      document.getElementById('yearFilter').addEventListener('change', (e) => {
          state.year = e.target.value;
          state.page = 1;
          render();
      });

      document.getElementById('dormitoryFilter').addEventListener('change', (e) => {
        state.dormitory = e.target.value;
        state.page = 1;
        render();
      });

      document.getElementById('majorFilter').addEventListener('change', (e) => {
        state.major = e.target.value;
        state.page = 1;
        render();
      });

      document.getElementById('search').addEventListener('input', (e) => { state.q = e.target.value; state.page = 1; render(); });
      
      document.getElementById('clearFiltersBtn').addEventListener('click', () => {
        document.getElementById('search').value = '';
        document.getElementById('yearFilter').value = 'all';
        document.getElementById('dormitoryFilter').value = 'all';
        document.getElementById('majorFilter').value = 'all';
        state.q = '';
        state.year = 'all';
        state.dormitory = 'all';
        state.major = 'all';
        state.page = 1;
        render();
        showToast('Filters cleared', 'success');
      });

      document.getElementById('prevPage').addEventListener('click', () => { if (state.page > 1) { state.page--; render(); } });
      document.getElementById('nextPage').addEventListener('click', () => { 
          const rows = getFilteredSorted();
          const totalPages = Math.max(1, Math.ceil(rows.length / PAGE_SIZE));
          if (state.page < totalPages) { state.page++; render(); }
      });
      
      document.getElementById('openAddChoiceBtn').addEventListener('click', () => {
          document.getElementById('addChoiceModal').showModal();
      });

      document.getElementById('addNewUndecided').addEventListener('click', () => {
          document.getElementById('addChoiceModal').close();
          openModal('add', null, 'undecided');
      });

      document.getElementById('addNewDecided').addEventListener('click', () => {
          document.getElementById('addChoiceModal').close();
          openModal('add', null, 'decided');
      });

      document.getElementById('closeModal').addEventListener('click', closeModalSafe);
      document.getElementById('cancelModal').addEventListener('click', closeModalSafe);
      document.getElementById('closeDetailsModal').addEventListener('click', () => document.getElementById('detailsModal').close());
      document.getElementById('okDetailsModal').addEventListener('click', () => document.getElementById('detailsModal').close());

      document.getElementById('photo_preview').addEventListener('click', () => {
          document.getElementById('student_photo').click();
      });
      document.getElementById('student_photo').addEventListener('change', (event) => {
          const file = event.target.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = (e) => {
                  document.getElementById('photo_preview').src = e.target.result;
              }
              reader.readAsDataURL(file);
          }
      });

      document.querySelectorAll('th.sortable').forEach(th => {
        th.addEventListener('click', () => {
          const key = th.getAttribute('data-sort');
          if (state.sort.key === key) {
            state.sort.dir = state.sort.dir === 'asc' ? 'desc' : 'asc';
          } else {
            state.sort.key = key; state.sort.dir = 'asc';
          }
          render();
        });
      });

      document.getElementById('selectAll').addEventListener('change', (e) => {
        const pageRows = getFilteredSorted().slice((state.page - 1) * PAGE_SIZE, state.page * PAGE_SIZE);
        pageRows.forEach(s => {
            if (e.target.checked) state.selected.add(s.student_id);
            else state.selected.delete(s.student_id);
        });
        document.getElementById('bulkDeleteBtn').disabled = state.selected.size === 0;
        render();
      });

      const tbody = document.getElementById('tbody');
      tbody.addEventListener('change', e => {
        if(e.target.matches('input[type="checkbox"]')) {
            const id = parseInt(e.target.dataset.id, 10);
            if (e.target.checked) state.selected.add(id);
            else state.selected.delete(id);
            document.getElementById('bulkDeleteBtn').disabled = state.selected.size === 0;
        }
      });
      
      tbody.addEventListener('click', async e => {
          const targetButton = e.target.closest('button');
          if (!targetButton) return;

          const id = parseInt(targetButton.dataset.details || targetButton.dataset.edit || targetButton.dataset.del, 10);
          const student = state.students.find(s => s.student_id === id);
          if (!student) return;

          if (targetButton.dataset.details !== undefined) openDetailsModal(student);
          if (targetButton.dataset.edit !== undefined) openModal('edit', student);
          if (targetButton.dataset.del !== undefined) {
              const confirmed = await showConfirm('Delete Student', `Are you sure you want to delete "${student.student_name_en}"? This action cannot be undone.`);
              if (!confirmed) return;
              
              const response = await apiRequest('delete', { ids: [id] });
              if (response.status === 'success') {
                  state.students = state.students.filter(s => s.student_id !== id);
                  state.selected.delete(id);
                  render();
                  showToast(`Student "${student.student_name_en}" deleted.`, 'success');
              }
          }
      });

      document.getElementById('bulkDeleteBtn').addEventListener('click', async () => {
        if (!state.selected.size) return;
        const confirmed = await showConfirm('Delete Selected', `Delete ${state.selected.size} student(s)? This cannot be undone.`);
        if (!confirmed) return;
        
        const ids = Array.from(state.selected);
        const response = await apiRequest('delete', { ids });
        if (response.status === 'success') {
            state.students = state.students.filter(s => !state.selected.has(s.student_id));
            state.selected.clear();
            render();
            showToast(`${ids.length} student(s) deleted.`, 'success');
        }
      });
      
      document.getElementById('father_deceased_year').addEventListener('input', () => toggleParentRequired('father'));
      document.getElementById('mother_deceased_year').addEventListener('input', () => toggleParentRequired('mother'));

      document.getElementById('saveStudent').addEventListener('click', async (e) => {
          e.preventDefault();
          
          const form = document.getElementById('studentForm');
          const photoInput = document.getElementById('student_photo');
          
          const hasExistingPhoto = form.dataset.hasExistingPhoto === 'true';
          const isNewFileSelected = photoInput.files.length > 0;
          if (!isNewFileSelected && !hasExistingPhoto) {
              showAlert('Required Field Missing', 'A student photo is required. Please upload an image.');
              return;
          }

          if (!form.checkValidity()) {
              const errors = [];
              form.querySelectorAll(':invalid').forEach(el => {
                  const label = form.querySelector(`label[for="${el.id}"]`);
                  if (label && el.id !== 'student_photo') {
                      errors.push(label.textContent.replace('(Optional)', '').trim());
                  }
              });
              if(errors.length > 0) {
                showAlert(
                  'Required Fields Missing', 
                  'Please provide the following information:\n\n- ' + errors.join('\n- ')
                );
              }
              return;
          }
          
          const formData = new FormData(form);
          const studentId = parseInt(formElements.student_id.value, 10) || null;
          const action = studentId ? 'update' : 'add';
          formData.append('action', action);

          try {
              const response = await fetch('api.php', {
                  method: 'POST',
                  body: formData,
              });

              const result = await response.json();

              if (!response.ok) {
                  throw new Error(result.message || `HTTP error ${response.status}`);
              }

              if (result.status === 'success' && result.student) {
                  if (action === 'add') {
                      state.students.unshift(result.student);
                  } else {
                      const index = state.students.findIndex(s => s.student_id === studentId);
                      if (index !== -1) {
                          state.students[index] = result.student;
                      }
                  }
                  render();
                  closeModalSafe();
                  showToast(`Student "${result.student.student_name_en}" saved.`, 'success');
              } else {
                showAlert('Save Failed', result.message || 'An unknown error occurred.');
              }
          } catch (error) {
              console.error('Save Student Failed:', error);
              showAlert('Save Failed', error.message);
          }
      });
      
      document.getElementById('exportBtn').addEventListener('click', handleExport);
    }
    
    function handleExport() {
        let dataToExport = state.selected.size > 0 
            ? state.students.filter(s => state.selected.has(s.student_id))
            : getFilteredSorted();

        if (dataToExport.length === 0) {
            showToast('No data to export based on current selection or filters.', 'warning');
            return;
        }

        const headers = [
            'student_id', 'seat_no', 'student_name_en', 'student_name_mm', 'student_email', 'student_phone', 'student_nrc', 'student_dob', 'student_birthplace', 'student_race', 'student_religion', 'student_address', 'township', 'state_region', 'dormitory_preference', 'year', 'academic_year', 'entry_year', 'date', 'photo_url',
            'selected_major', 'preference1', 'preference2', 'preference3', 'preference4', 'preference5',
            'father_name_en', 'father_name_mm', 'father_nrc', 'father_race', 'father_religion', 'father_info', 'father_address', 'father_phone', 'father_deceased_year',
            'mother_name_en', 'mother_name_mm', 'mother_nrc', 'mother_race', 'mother_religion', 'mother_info', 'mother_address', 'mother_phone', 'mother_deceased_year'
        ];

        const csvRows = [headers.join(',')];

        const escapeCSV = (str) => {
            if (str === null || str === undefined) return '';
            const val = String(str);
            if (val.includes(',') || val.includes('"') || val.includes('\n')) {
                return `"${val.replace(/"/g, '""')}"`;
            }
            return val;
        };

        for (const s of dataToExport) {
            const row = [
                s.student_id, s.seat_no, s.student_name_en, s.student_name_mm, s.student_email, 
                s.student_phone ? `="${s.student_phone}"` : '', 
                s.student_nrc, s.student_dob, s.student_birthplace, s.student_race, s.student_religion, s.student_address, s.township, s.state_region, s.dormitory_preference ? '1' : '0', s.year, s.academic_year, s.entry_year, s.date, s.photo_url,
                s.selected_major || '',
                s.preferences ? (s.preferences['1'] || '') : '',
                s.preferences ? (s.preferences['2'] || '') : '',
                s.preferences ? (s.preferences['3'] || '') : '',
                s.preferences ? (s.preferences['4'] || '') : '',
                s.preferences ? (s.preferences['5'] || '') : '',
                s.father_name_en, s.father_name_mm, s.father_nrc, s.father_race, s.father_religion, s.father_info, s.father_address, 
                s.father_phone ? `="${s.father_phone}"` : '', 
                s.father_deceased_year,
                s.mother_name_en, s.mother_name_mm, s.mother_nrc, s.mother_race, s.mother_religion, s.mother_info, s.mother_address, 
                s.mother_phone ? `="${s.mother_phone}"` : '', 
                s.mother_deceased_year
            ];
            csvRows.push(row.map(escapeCSV).join(','));
        }

        const csvString = csvRows.join('\n');
        const blob = new Blob(["\uFEFF" + csvString], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        if (link.download !== undefined) {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', `students_${todayStr()}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        showToast(`${dataToExport.length} student record(s) exported.`, 'success');
    }

    document.addEventListener('DOMContentLoaded', () => {
      populateMajorDropdowns();
      addEventListeners();
      render();
    });
  </script>
</body>
</html>

