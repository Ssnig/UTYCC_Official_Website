<?php
require_once 'auth_check.php';

function safe_json_encode($value) {
    try {
        $json = json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        return $json;
    } catch (JsonException $e) {
        error_log("json_encode error: " . $e->getMessage());
        return '[]';
    }
}

$students_json = '[]';
$pdo = null;

try {
    $db_path = __DIR__ . '/../Rform/db.php';
    if (!file_exists($db_path)) {
        throw new Exception("Database configuration file not found at: {$db_path}");
    }
    require_once $db_path;

    if (!isset($pdo)) {
        throw new Exception("PDO connection object was not created in db.php.");
    }

    date_default_timezone_set('Asia/Yangon');

    $students = [];
    $sql = "SELECT s.*, s.preferences,
                   f.father_id, f.father_name_mm, f.father_name_en, f.father_race, f.father_religion, f.father_nrc, f.father_phone, f.father_info, f.father_deceased_year, f.father_address,
                   m.mother_id, m.mother_name_mm, m.mother_name_en, m.mother_race, m.mother_religion, m.mother_nrc, m.mother_phone, m.mother_info, m.mother_deceased_year, m.mother_address
            FROM students s
            LEFT JOIN fathers f ON s.student_id = f.student_id
            LEFT JOIN mothers m ON s.student_id = m.student_id
            WHERE s.status = 'pending'
            ORDER BY s.date DESC";

    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        $row['student_id'] = (int)$row['student_id'];
        $row['dormitory_preference'] = (bool)$row['dormitory_preference'];
        if (!empty($row['father_deceased_year'])) $row['father_deceased_year'] = (int)$row['father_deceased_year'];
        if (!empty($row['mother_deceased_year'])) $row['mother_deceased_year'] = (int)$row['mother_deceased_year'];
        
        $row['preferences'] = !empty($row['preferences']) ? json_decode($row['preferences'], true) : null;

        $students[] = $row;
    }

    $students_json = safe_json_encode($students);

} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $students_json = '[]'; 

} catch (Throwable $e) {
    error_log("General Error: " . $e->getMessage());
    $students_json = '[]';
}

$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard — UTYCC</title>
  <meta name="description" content="Admin dashboard for the UTYCC student registration system." />
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
    .header h1 { margin-right: auto; }
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
    .btn.success { background: hsl(var(--success)); color: hsl(0 0% 100%); border-color: hsl(var(--success)); }
    .btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
    .btn.ghost { background: transparent; box-shadow: none; border-color: hsl(var(--border)); }
    .btn.ghost:hover { background: hsl(var(--muted)); box-shadow: none; }
    .btn.icon-btn { padding: 8px; box-shadow: var(--shadow-sm); }
    .btn.icon-btn svg { width: 16px; height: 16px; }
    .main { grid-area: main; padding: 20px; background: hsl(var(--bg));}
    .cards { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; }
    .card { background: hsl(var(--card)); color: hsl(var(--card-foreground)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 16px; box-shadow: var(--shadow-md); transition: all var(--duration) var(--ease); }
    .card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
    .card h3 { margin: 0 0 6px; font-size: 14px; color: hsl(var(--muted-foreground)); font-weight: 600; }
    .card .value { font-size: 28px; font-weight: 800; letter-spacing: -0.02em; }
    .section { margin-top: 24px; }
    .section-header { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 12px; }
    .section-header h2 { font-size: 20px; margin: 0; font-weight: 700; }
    .table-wrap { overflow: auto; border: 1px solid hsl(var(--border)); border-radius: var(--radius); background: hsl(var(--card)); box-shadow: var(--shadow-md); }
    table { width: 100%; border-collapse: collapse; min-width: 900px; }
    thead th { text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: .08em; color: hsl(var(--muted-foreground)); background: hsl(var(--bg)); position: sticky; top: 0; z-index: 1; }
    th, td { padding: 14px 16px; border-bottom: 1px solid hsl(var(--border)); transition: background var(--duration) var(--ease); }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:nth-child(even) { background-color: hsl(var(--bg)); }
    tbody tr:hover { background: hsl(var(--muted)); }
    .toolbar { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; width: 100%;}
    .toolbar .spacer { flex: 1; }
    .toast-wrap { position: fixed; bottom: 20px; right: 20px; top: auto; width: min(380px, 92vw); display: grid; gap: 12px; z-index: 9999; pointer-events: none; }
    .toast { pointer-events: auto; display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--fg)); background: hsl(var(--card)); box-shadow: var(--shadow-lg); border-left: 4px solid hsl(var(--primary)); animation: toastIn 0.3s ease forwards, toastOut 0.3s ease 4.2s forwards; }
    .toast.success { border-left-color: hsl(var(--success)); }
    .toast.warning { border-left-color: hsl(var(--warning)); }
    .toast.error { border-left-color: hsl(var(--danger)); }
    .toast .close-btn { background: transparent; border: 0; color: hsl(var(--muted-foreground)); opacity: 0.7; cursor: pointer; font-size: 20px; }
    .toast .close-btn:hover { opacity: 1; }
    @keyframes toastIn { from { opacity: 0; transform: translateY(100%); } to { opacity: 1; transform: translateY(0); } }
    @keyframes toastOut { from { opacity: 1; transform: translateY(0); } to { opacity: 0; transform: translateY(100%); } }
    dialog { border: none; border-radius: 16px; padding: 0; background: hsl(var(--card)); color: hsl(var(--card-foreground)); width: min(860px, 94vw); box-shadow: var(--shadow-lg); }
    dialog::backdrop { background: hsl(222 47% 11% / 0.45); backdrop-filter: blur(4px); }
    .modal-header { padding: 16px 24px; border-bottom: 1px solid hsl(var(--border)); display: flex; justify-content: space-between; align-items: center; }
    .modal-header strong { font-size: 1.1rem; font-weight: 700; }
    .modal-body { padding: 24px; display: grid; gap: 16px; max-height: 70vh; overflow-y: auto; }
    .modal-footer { padding: 14px 24px; border-top: 1px solid hsl(var(--border)); display: flex; justify-content: flex-end; gap: 8px; }
    .field { display: grid; gap: 6px; }
    .field label { font-size: 13px; color: hsl(var(--muted-foreground)); font-weight: 600; }
    .field input, .field select, .field textarea { padding: 10px 12px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--bg)); color: hsl(var(--fg)); outline: none; font: inherit; transition: all var(--duration) var(--ease); }
    .field input:focus, .field select:focus, .field textarea:focus { border-color: hsl(var(--ring)); box-shadow: 0 0 0 3px hsl(var(--ring)/0.25); }
    .field input:disabled, .field select:disabled { background: hsl(var(--muted)); cursor: not-allowed; opacity: 0.7; }
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
    .documents-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; }
    .doc-item a { display: block; border: 1px solid hsl(var(--border)); border-radius: 8px; overflow: hidden; text-decoration: none; color: hsl(var(--fg)); transition: all .2s ease; }
    .doc-item a:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .doc-item img { width: 100%; height: 120px; object-fit: cover; background-color: hsl(var(--muted)); }
    .doc-item p { font-size: 13px; padding: 8px; text-align: center; font-weight: 500; }
    .pagination { display: flex; align-items: center; gap: 8px; justify-content: flex-end; padding-top: 10px; }
    .pagination .info { color: hsl(var(--muted-foreground)); font-size: 13px; margin-right: auto; }
    @media (max-width: 1000px) { .cards { grid-template-columns: repeat(2, minmax(0,1fr)); } .form-grid { grid-template-columns: 1fr; } }
    @media (max-width: 780px) { .app { grid-template-columns: 1fr; grid-template-areas: "header" "main"; } .sidebar { display: none; } .cards { grid-template-columns: 1fr; } }
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
        <a class="nav-link active" href="admin_dashboard.php">
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
        <a class="nav-link" href="activity.php">
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
        <h1>Dashboard</h1>
        <div class="user-info">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span><?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?></span>
        </div>
    </header>

    <main class="main" id="main">
      <section class="cards" aria-label="Overview">
        <article class="card" aria-live="polite">
          <h3>Pending Applications</h3>
          <div class="value" id="statTotal">0</div>
        </article>
        <article class="card">
            <h3>By Major (IST)</h3>
            <div class="value" id="statMajorIST">0</div>
        </article>
        <article class="card">
          <h3>Today's Applications</h3>
          <div class="value" id="statToday">0</div>
        </article>
      </section>

      <section class="section" id="students">
        <div class="section-header">
          <h2>Pending Applications</h2>
          <div class="toolbar">
             <div class="field" style="min-width: 200px;">
                <select id="majorFilter" aria-label="Filter by Major">
                    <option value="all">All Majors</option>
                    <option value="IST">Information Science & Technology (IST)</option>
                    <option value="CE">Computer Engineering (CE)</option>
                    <option value="EcE">Electronic Engineering (EcE)</option>
                    <option value="PrE">Precision Engineering (PrE)</option>
                    <option value="AME">Advanced Materials Engineering (AME)</option>
                </select>
             </div>
             <div class="field" style="min-width: 200px;">
                <select id="yearFilter" aria-label="Filter by Year">
                    <option value="all">All Academic Years</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                    <option value="Fifth Year">Fifth Year</option>
                    <option value="Sixth Year">Sixth Year (Final)</option>
                </select>
             </div>
             <div class="spacer"></div>
             <button class="btn success" id="bulkApproveBtn" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width:16px; height: 16px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Approve Selected
             </button>
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
  
  <dialog id="studentModal" aria-modal="true">
    <form method="dialog" id="studentForm">
      <div class="modal-header">
        <strong id="modalTitle">Edit Student</strong>
        <button class="btn ghost icon-btn" type="button" id="closeModal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="student_id" name="student_id" />
        <div class="form-grid">
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
                <input id="student_name_mm" name="student_name_mm" />
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
                <input id="student_phone" name="student_phone" />
            </div>
            <div class="field">
                <label for="student_nrc">NRC</label>
                <input id="student_nrc" name="student_nrc" />
            </div>
            <div class="field">
                <label for="student_dob">Date of Birth</label>
                <input id="student_dob" name="student_dob" type="date" />
            </div>
             <div class="field">
                <label for="student_birthplace">Birthplace</label>
                <input id="student_birthplace" name="student_birthplace" />
            </div>
            <div class="field">
                <label for="student_race">Race</label>
                <input id="student_race" name="student_race" />
            </div>
            <div class="field">
                <label for="student_religion">Religion</label>
                <input id="student_religion" name="student_religion" />
            </div>
            <div class="field">
                <label for="township">Township</label>
                <input id="township" name="township" />
            </div>
            <div class="field">
                <label for="state_region">State/Region</label>
                <input id="state_region" name="state_region" />
            </div>
             <div class="field" style="grid-column: 1 / -1;">
                <label for="student_address">Address</label>
                <textarea id="student_address" name="student_address"></textarea>
            </div>
            <div class="field-checkbox" style="grid-column: 1 / -1;">
                <input id="dormitory_preference" name="dormitory_preference" type="checkbox" />
                <label for="dormitory_preference">Requires Dormitory</label>
            </div>

            <h3 class="detail-section-header">Academic Information</h3>
            <div class="field">
                <label for="year">Year</label>
                <input id="year" name="year" />
            </div>
            <div class="field">
                <label for="academic_year">Academic Year</label>
                <select id="academic_year" name="academic_year">
                    <option value="">Select Academic Year</option>
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Third Year">Third Year</option>
                    <option value="Fourth Year">Fourth Year</option>
                    <option value="Fifth Year">Fifth Year</option>
                    <option value="Sixth Year">Sixth Year (Final)</option>
                </select>
            </div>
            <div class="field">
                <label for="entry_year">Entry Year</label>
                <input id="entry_year" name="entry_year" />
            </div>

            <h3 class="detail-section-header">Major Preferences</h3>
            <div class="field">
                <label for="preference1">ဦးစားပေး ၁</label>
                <select id="preference1" name="preference1" disabled></select>
            </div>
             <div class="field">
                <label for="preference2">ဦးစားပေး ၂</label>
                <select id="preference2" name="preference2" disabled></select>
            </div>
             <div class="field">
                <label for="preference3">ဦးစားပေး ၃</label>
                <select id="preference3" name="preference3" disabled></select>
            </div>
             <div class="field">
                <label for="preference4">ဦးစားပေး ၄</label>
                <select id="preference4" name="preference4" disabled></select>
            </div>
             <div class="field">
                <label for="preference5">ဦးစားပေး ၅</label>
                <select id="preference5" name="preference5" disabled></select>
            </div>

            <h3 class="detail-section-header">Father's Information</h3>
            <div class="field">
                <label for="father_name_en">Name (EN)</label>
                <input id="father_name_en" name="father_name_en" />
            </div>
            <div class="field">
                <label for="father_name_mm">Name (MM)</label>
                <input id="father_name_mm" name="father_name_mm" />
            </div>
             <div class="field">
                <label for="father_nrc">NRC</label>
                <input id="father_nrc" name="father_nrc" />
            </div>
            <div class="field">
                <label for="father_phone">Phone</label>
                <input id="father_phone" name="father_phone" />
            </div>
             <div class="field">
                <label for="father_race">Race</label>
                <input id="father_race" name="father_race" />
            </div>
            <div class="field">
                <label for="father_religion">Religion</label>
                <input id="father_religion" name="father_religion" />
            </div>
             <div class="field" style="grid-column: 1 / -1;">
                <label for="father_info">Occupation</label>
                <input id="father_info" name="father_info" />
            </div>
            <div class="field" style="grid-column: 1 / -1;">
                <label for="father_address">Address</label>
                <textarea id="father_address" name="father_address"></textarea>
            </div>
             <div class="field">
                <label for="father_deceased_year">Deceased Year (if applicable)</label>
                <input id="father_deceased_year" name="father_deceased_year" type="number" placeholder="YYYY" />
            </div>

            <h3 class="detail-section-header">Mother's Information</h3>
            <div class="field">
                <label for="mother_name_en">Name (EN)</label>
                <input id="mother_name_en" name="mother_name_en" />
            </div>
            <div class="field">
                <label for="mother_name_mm">Name (MM)</label>
                <input id="mother_name_mm" name="mother_name_mm" />
            </div>
             <div class="field">
                <label for="mother_nrc">NRC</label>
                <input id="mother_nrc" name="mother_nrc" />
            </div>
            <div class="field">
                <label for="mother_phone">Phone</label>
                <input id="mother_phone" name="mother_phone" />
            </div>
             <div class="field">
                <label for="mother_race">Race</label>
                <input id="mother_race" name="mother_race" />
            </div>
            <div class="field">
                <label for="mother_religion">Religion</label>
                <input id="mother_religion" name="mother_religion" />
            </div>
             <div class="field" style="grid-column: 1 / -1;">
                <label for="mother_info">Occupation</label>
                <input id="mother_info" name="mother_info" />
            </div>
            <div class="field" style="grid-column: 1 / -1;">
                <label for="mother_address">Address</label>
                <textarea id="mother_address" name="mother_address"></textarea>
            </div>
             <div class="field">
                <label for="mother_deceased_year">Deceased Year (if applicable)</label>
                <input id="mother_deceased_year" name="mother_deceased_year" type="number" placeholder="YYYY" />
            </div>

            <!-- New section for documents in edit modal -->
            <h3 class="detail-section-header">တင်သွင်းထားသော အထောက်အထားများ</h3>
            <div id="edit-documents-grid" class="documents-grid" style="grid-column: 1 / -1;">
                <!-- Document items will be injected here by JavaScript -->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn ghost" value="cancel" type="button" id="cancelModal">Cancel</button>
        <button class="btn primary" value="default" id="saveStudent">Save Changes</button>
      </div>
    </form>
  </dialog>

  <dialog id="detailsModal" aria-modal="true">
    <div class="modal-header">
      <strong>Student Details</strong>
      <button class="btn ghost icon-btn" type="button" id="closeDetailsModal" aria-label="Close">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
      </button>
    </div>
    <div class="modal-body" id="detailsModalBody">
    </div>
    <div class="modal-footer">
      <button class="btn primary" type="button" id="okDetailsModal">OK</button>
    </div>
  </dialog>
  
  <dialog id="confirmModal" aria-modal="true">
    <div class="modal-header">
        <strong id="confirmTitle">Confirm Action</strong>
    </div>
    <div class="modal-body">
        <p id="confirmMessage">Are you sure?</p>
    </div>
    <div class="modal-footer">
        <button class="btn ghost" id="confirmCancel">Cancel</button>
        <button class="btn" id="confirmOK">Confirm</button>
    </div>
  </dialog>
  
  <div class="toast-wrap"></div>

  <script>
    const PAGE_SIZE = 8;
    const PHOTO_PLACEHOLDER = 'https://placehold.co/120x120/EFEFEF/AAAAAA?text=Photo';
    
    const availableMajors = {
        'IST': 'သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာအင်ဂျင်နီယာဘာသာရပ်(IST)',
        'CE' : 'ကွန်ပျူတာအင်ဂျင်နီယာ ဘာသာရပ်(CE)',
        'EcE': 'အီလက်ထရောနစ် အင်ဂျင်နီယာ ဘာသာရပ်(EcE)',
        'PrE': 'တိကျပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ ဘာသာရပ်(PrE)',
        'AME': 'အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ ဘာသာရပ်(AME)',
    };

    const state = {
      students: <?php echo $students_json; ?>,
      q: '',
      major: 'all',
      year: 'all',
      page: 1,
      sort: { key: 'date', dir: 'desc' },
      selected: new Set(),
    };
    
    function getSafeUrl(path) {
        if (!path) return `https://placehold.co/150x120/EFEFEF/AAAAAA?text=No+Image`;
        const uploadsIndex = path.indexOf('uploads/');
        if (uploadsIndex !== -1) return `../Rform/${path}`;
        return path;
    }

    function todayStr(d = new Date()) { return d.toISOString().split('T')[0]; }
    function formatDate(iso) {
      if (!iso) return 'N/A';
      try { const d = new Date(iso); return d.toLocaleDateString('en-GB'); } catch { return iso; }
    }
    function cmp(a, b, key) {
      const av = a[key] || ''; 
      const bv = b[key] || '';
      if (key === 'date' || key === 'student_dob') {
        const dateA = new Date(av).getTime() || 0;
        const dateB = new Date(bv).getTime() || 0;
        return dateA - dateB;
      }
      return av.toString().localeCompare(bv.toString());
    }

    async function apiRequest(action, data) {
        try {
            const response = await fetch('./api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action, ...data }),
            });
            const responseText = await response.text(); 
            if (!response.ok) throw new Error(responseText || `HTTP error ${response.status}`);
            try { return JSON.parse(responseText); } catch (e) { throw new Error(`Invalid JSON response from server: ${responseText}`); }
        } catch (error) {
            console.error('API Request Failed:', error.message);
            showToast(error.message, 'error', 8000);
            return { status: 'error', message: error.message };
        }
    }

    const toastWrap = document.querySelector(".toast-wrap");
    function showToast(message, type = "success", duration = 4000) {
        const toast = document.createElement("div");
        toast.className = `toast ${type}`;
        toast.innerHTML = `<span><pre style="white-space: pre-wrap; margin: 0; font-family: inherit;">${message}</pre></span><button class="close-btn" aria-label="Close">×</button>`;
        const removeToast = () => { if (toast.parentElement) toast.parentElement.removeChild(toast); };
        toast.querySelector(".close-btn").addEventListener("click", removeToast);
        toastWrap.appendChild(toast);
        setTimeout(removeToast, duration);
    }
    
    const formElements = {};
    document.querySelectorAll('#studentForm [name]').forEach(el => { formElements[el.name] = el; });

    function showConfirm(title, message, confirmClass = 'destructive') {
      return new Promise(resolve => {
        const confirmModal = document.getElementById('confirmModal');
        const confirmBtn = document.getElementById('confirmOK');
        const cancelBtn = document.getElementById('confirmCancel');
        
        document.getElementById('confirmTitle').textContent = title;
        document.getElementById('confirmMessage').textContent = message;
        confirmBtn.className = `btn ${confirmClass}`;
        
        let resolved = false;
        const handleConfirm = () => { if (resolved) return; resolved = true; confirmModal.close(); cleanup(); resolve(true); };
        const handleCancel = () => { if (resolved) return; resolved = true; confirmModal.close(); cleanup(); resolve(false); };
        const handleClose = () => { if (resolved) return; resolved = true; cleanup(); resolve(false); };
        
        const cleanup = () => {
            newConfirmBtn.removeEventListener('click', handleConfirm);
            newCancelBtn.removeEventListener('click', handleCancel);
            confirmModal.removeEventListener('close', handleClose);
        };

        const newConfirmBtn = confirmBtn.cloneNode(true);
        confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
        newConfirmBtn.addEventListener('click', handleConfirm, { once: true });
        const newCancelBtn = cancelBtn.cloneNode(true);
        cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);
        newCancelBtn.addEventListener('click', handleCancel, { once: true });
        confirmModal.addEventListener('close', handleClose, { once: true });
        
        if (!confirmModal.open) { confirmModal.showModal(); }
      });
    }
    
    function openModal(mode, student = null) {
      const modal = document.getElementById('studentModal');
      const form = document.getElementById('studentForm');
      document.getElementById('modalTitle').textContent = 'Edit Student Application';
      
      form.reset();
      document.getElementById('photo_preview').src = PHOTO_PLACEHOLDER;
      formElements.student_id.value = '';

      if (mode === 'edit' && student) {
          for (const key in formElements) {
              const element = formElements[key];
              if (student.hasOwnProperty(key) && element) {
                  if (element.type === 'checkbox') { element.checked = !!student[key]; } 
                  else if (element.type !== 'file' && !element.name.startsWith('preference')) { element.value = student[key] || ''; }
              }
          }
          document.getElementById('photo_preview').src = getSafeUrl(student.photo_url);

          for (let i = 1; i <= 5; i++) {
              const selectEl = document.getElementById(`preference${i}`);
              selectEl.innerHTML = ''; 
              let placeholder = document.createElement('option');
              placeholder.value = ""; placeholder.text = "Select a major"; placeholder.disabled = true;
              selectEl.add(placeholder);
              for (const code in availableMajors) {
                  let option = document.createElement('option');
                  option.value = code; option.text = availableMajors[code];
                  selectEl.add(option);
              }
              const prefValue = student.preferences ? student.preferences[i] : null;
              if (prefValue) { selectEl.value = prefValue; } else { selectEl.selectedIndex = 0; }
          }

          // --- NEW: Populate document files in Edit Modal ---
          const documentsGrid = document.getElementById('edit-documents-grid');
          documentsGrid.innerHTML = ''; // Clear previous documents

          const documents = [
              { label: 'ရပ်ကွက်/ရဲစခန်း ထောက်ခံစာ', key: 'doc_recommendation' },
              { label: 'ဆေးထောက်ခံစာ', key: 'doc_medical' },
              { label: 'အောင်လက်မှတ်', key: 'doc_certificate' },
              { label: 'အမှတ်စာရင်း', key: 'doc_grades' },
              { label: 'အိမ်ထောင်စုဇယား', key: 'doc_household' },
              { label: 'ကျောင်းသား NRC (ရှေ့)', key: 'doc_student_nrc_front' },
              { label: 'ကျောင်းသား NRC (နောက်)', key: 'doc_student_nrc_back' },
              { label: 'အဖေ NRC (ရှေ့)', key: 'doc_father_nrc_front' },
              { label: 'အဖေ NRC (နောက်)', key: 'doc_father_nrc_back' },
              { label: 'အမေ NRC (ရှေ့)', key: 'doc_mother_nrc_front' },
              { label: 'အမေ NRC (နောက်)', key: 'doc_mother_nrc_back' },
          ];

          let documentsHtml = '';
          let hasDocuments = false;
          documents.forEach(doc => {
              const docPath = student[doc.key];
              if (docPath) {
                  hasDocuments = true;
                  documentsHtml += `
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
          } else {
              documentsGrid.innerHTML = documentsHtml;
          }
          // --- END NEW SECTION ---
      } 
      modal.showModal();
      formElements.student_name_en.focus();
    }
    
    function closeModalSafe() { document.getElementById('studentModal').close(); }

    function openDetailsModal(s) {
        const detailsModal = document.getElementById('detailsModal');
        const detailsModalBody = document.getElementById('detailsModalBody');
        const photoUrl = getSafeUrl(s.photo_url);

        let preferencesHtml = '';
        if (s.preferences && typeof s.preferences === 'object' && Object.keys(s.preferences).length > 0) {
            preferencesHtml += `<h3 class="detail-section-header">Major Preferences</h3><dl class="details-grid">`;
            for (let i = 1; i <= 5; i++) {
                const prefCode = s.preferences[i];
                if (prefCode) {
                    preferencesHtml += `<dt>ဦးစားပေး ${i}</dt><dd>${availableMajors[prefCode] || 'Unknown Major'}</dd>`;
                }
            }
            preferencesHtml += `</dl>`;
        }
        
        const documents = [
            { label: 'ရပ်ကွက်/ရဲစခန်း ထောက်ခံစာ', key: 'doc_recommendation' },
            { label: 'ဆေးထောက်ခံစာ', key: 'doc_medical' },
            { label: 'အောင်လက်မှတ်', key: 'doc_certificate' },
            { label: 'အမှတ်စာရင်း', key: 'doc_grades' },
            { label: 'အိမ်ထောင်စုဇယား', key: 'doc_household' },
            { label: 'ကျောင်းသား NRC (ရှေ့)', key: 'doc_student_nrc_front' },
            { label: 'ကျောင်းသား NRC (နောက်)', key: 'doc_student_nrc_back' },
            { label: 'အဖေ NRC (ရှေ့)', key: 'doc_father_nrc_front' },
            { label: 'အဖေ NRC (နောက်)', key: 'doc_father_nrc_back' },
            { label: 'အမေ NRC (ရှေ့)', key: 'doc_mother_nrc_front' },
            { label: 'အမေ NRC (နောက်)', key: 'doc_mother_nrc_back' },
        ];

        let documentsHtml = '<h3 class="detail-section-header">Required Documents</h3><div class="documents-grid">';
        documents.forEach(doc => {
            const docPath = s[doc.key];
            documentsHtml += `
                <div class="doc-item">
                    <a href="${getSafeUrl(docPath)}" target="_blank">
                        <img src="${getSafeUrl(docPath)}" alt="${doc.label}" loading="lazy">
                        <p>${doc.label}</p>
                    </a>
                </div>`;
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

    function getFilteredSorted() {
      const q = state.q.toLowerCase();
      const selectedMajor = state.major;
      const selectedYear = state.year;
      
      const base = state.students.filter(s => {
        const matchesSearch = !q || 
          (s.student_name_en && s.student_name_en.toLowerCase().includes(q)) || 
          (s.student_email && s.student_email.toLowerCase().includes(q)) || 
          (s.seat_no && s.seat_no.toLowerCase().includes(q));
        
        const matchesMajor = selectedMajor === 'all' || 
          (s.preferences && Object.values(s.preferences).includes(selectedMajor));
        
        const matchesYear = selectedYear === 'all' || s.academic_year === selectedYear;
        
        return matchesSearch && matchesMajor && matchesYear;
      });
      
      const { key, dir } = state.sort;
      base.sort((a,b) => {
        const res = cmp(a,b,key);
        return dir === 'asc' ? res : -res;
      });
      return base;
    }

    function renderStats() {
      const filteredStudents = getFilteredSorted();
      const total = filteredStudents.length;
      
      // Count by major
      const majorCounts = {
        'IST': 0,
        'CE': 0,
        'EcE': 0,
        'PrE': 0,
        'AME': 0
      };
      
      filteredStudents.forEach(s => {
        if (s.preferences) {
          Object.values(s.preferences).forEach(major => {
            if (majorCounts.hasOwnProperty(major)) {
              majorCounts[major]++;
            }
          });
        }
      });
      
      document.getElementById('statTotal').textContent = total;
      document.getElementById('statMajorIST').textContent = majorCounts.IST;
      // Today's stat is handled by fetchDashboardStats()
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
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center; padding: 2rem;">No pending applications found.</td></tr>';
      } else {
        for (const s of pageRows) {
          const tr = document.createElement('tr');
          tr.dataset.studentId = s.student_id;
          tr.innerHTML = `
            <td><input type="checkbox" data-id="${s.student_id}" ${state.selected.has(s.student_id)?'checked':''} /></td>
            <td>${s.seat_no || ''}</td>
            <td>${s.student_name_en || ''}</td>
            <td>${s.student_email || ''}</td>
            <td>${s.student_phone || ''}</td>
            <td>${formatDate(s.date)}</td>
            <td>
              <div style="display:flex; gap:6px;">
                <button class="btn success icon-btn" data-approve="${s.student_id}" title="Approve"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></button>
                <button class="btn ghost icon-btn" data-edit="${s.student_id}" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></button>
                <button class="btn ghost icon-btn" data-details="${s.student_id}" title="View Details"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></button>
                <button class="btn destructive icon-btn" data-del="${s.student_id}" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
              </div>
            </td>`;
          tbody.appendChild(tr);
        }
      }

      document.getElementById('pageInfo').textContent = total ? `${start + 1}–${Math.min(start + PAGE_SIZE, total)} of ${total}` : '0–0 of 0';
      document.getElementById('prevPage').disabled = state.page <= 1;
      document.getElementById('nextPage').disabled = state.page >= totalPages;
      document.getElementById('bulkApproveBtn').disabled = state.selected.size === 0;
      document.getElementById('selectAll').checked = pageRows.length > 0 && pageRows.every(s => state.selected.has(s.student_id));
    }

    function render() {
      renderStats();
      renderTable();
    }
    
    function addEventListeners() {
      // Add major filter event listener
      document.getElementById('majorFilter').addEventListener('change', (e) => {
        state.major = e.target.value;
        state.page = 1;
        render();
      });

      document.getElementById('yearFilter').addEventListener('change', (e) => {
          state.year = e.target.value;
          state.page = 1;
          render();
      });

      document.getElementById('prevPage').addEventListener('click', () => { if (state.page > 1) { state.page--; render(); } });
      document.getElementById('nextPage').addEventListener('click', () => { 
        const rows = getFilteredSorted();
        const totalPages = Math.max(1, Math.ceil(rows.length / PAGE_SIZE));
        if (state.page < totalPages) { state.page++; render(); } 
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
        render();
      });

      const tbody = document.getElementById('tbody');
      tbody.addEventListener('change', e => {
        if(e.target.matches('input[type="checkbox"]')) {
            const id = parseInt(e.target.dataset.id, 10);
            if (e.target.checked) state.selected.add(id);
            else state.selected.delete(id);
            render();
        }
      });
      
      tbody.addEventListener('click', async e => {
          const targetButton = e.target.closest('button');
          if (!targetButton) return;

          const id = parseInt(targetButton.dataset.approve || targetButton.dataset.edit || targetButton.dataset.details || targetButton.dataset.del, 10);
          const student = state.students.find(s => s.student_id === id);
          if (!student) return;

          if (targetButton.dataset.details !== undefined) openDetailsModal(student);
          if (targetButton.dataset.edit !== undefined) openModal('edit', student);
          
          if (targetButton.dataset.approve !== undefined) {
              const confirmed = await showConfirm('Approve Student', `Are you sure you want to approve "${student.student_name_en}"?`, 'success');
              if (!confirmed) return;
              
              const response = await apiRequest('approve_students', { ids: [id] });
              if (response.status === 'success') {
                  state.students = state.students.filter(s => s.student_id !== id);
                  state.selected.delete(id);
                  render();
                  showToast(response.message || 'Student approved.', 'success');
              }
          }

          if (targetButton.dataset.del !== undefined) {
              const confirmed = await showConfirm('Reject Student', `Are you sure you want to reject and delete the application for "${student.student_name_en}"?`);
              if (!confirmed) return;
              
              const response = await apiRequest('delete', { ids: [id] });
              if (response.status === 'success') {
                  state.students = state.students.filter(s => s.student_id !== id);
                  state.selected.delete(id);
                  render();
                  showToast(`Application for "${student.student_name_en}" deleted.`, 'success');
              }
          }
      });

      document.getElementById('bulkApproveBtn').addEventListener('click', async () => {
        if (!state.selected.size) return;
        const confirmed = await showConfirm('Approve Selected', `Approve ${state.selected.size} student(s)?`, 'success');
        if (!confirmed) return;
        
        const ids = Array.from(state.selected);
        const response = await apiRequest('approve_students', { ids });
        if (response.status === 'success') {
            state.students = state.students.filter(s => !state.selected.has(s.student_id));
            state.selected.clear();
            render();
            showToast(response.message || 'Selected students approved.', 'success');
        }
      });
      
      document.getElementById('saveStudent').addEventListener('click', async (e) => {
        e.preventDefault();
        
        const form = document.getElementById('studentForm');
        const studentId = parseInt(formElements.student_id.value, 10) || null;
        
        if (!formElements.student_name_en.value || !formElements.seat_no.value || !formElements.student_email.value) {
            showToast('Please fill all required fields: Name (EN), Seat No, Email.', 'warning');
            return;
        }
        
        const formData = new FormData(form);
        formData.append('action', studentId ? 'update' : 'add');

        try {
            const response = await fetch('./api.php', {
                method: 'POST',
                body: formData,
            });

            const responseText = await response.text();

            let result;
            try {
                result = JSON.parse(responseText);
            } catch (jsonError) {
                // This is the most common error point: the server sent back something that wasn't JSON.
                console.error("Failed to parse JSON from server. Response text:", responseText);
                throw new Error("The server sent an invalid response. This is likely a PHP error. Please check the browser's developer console for the full server output.");
            }
            
            if (!response.ok) {
                 // The response was JSON, but the HTTP status indicates an error (e.g., 400, 500).
                 throw new Error(result.message || `The server returned an error (Status: ${response.status}).`);
            }

            if (result.status === 'success' && result.student) {
                const index = state.students.findIndex(s => s.student_id === studentId);
                if (index !== -1) {
                    state.students[index] = result.student;
                }
                render();
                closeModalSafe();
                showToast(`Student "${result.student.student_name_en}" updated.`, 'success');
            } else {
                // The response was valid JSON with status 200, but the action failed logically.
                throw new Error(result.message || 'Failed to save student data.');
            }
        } catch (error) {
            console.error('Save Student Failed:', error);
            // Display the caught error message directly in the toast.
            showToast(error.message, 'error', 8000);
        }
      });
    }
    async function fetchDashboardStats() {
        const response = await apiRequest('get_dashboard_stats', {});
        if (response.status === 'success' && response.data) {
            document.getElementById('statTotal').textContent = response.data.pending_applications;
            document.getElementById('statToday').textContent = response.data.today_applications;
            // Note: You'll need to update your API to provide major-specific counts
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
      if (<?php echo json_encode(empty($students_json) || $students_json === '[]'); ?> && state.students.length === 0) {
        console.warn("Initial student data is empty. This could indicate a PHP error during data fetching.");
      }
      addEventListeners();
      fetchDashboardStats();
      render();
    });
  </script>
</body>
</html>