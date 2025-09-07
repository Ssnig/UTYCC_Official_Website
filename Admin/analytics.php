<?php
// You can add session validation here if needed
session_start();
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: ./signin.php"); // Corrected path to signin.php in the same directory
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Analytics & Reporting — UTYCC Admin</title>
    <meta name="description" content="Analytics dashboard for the UTYCC student registration system." />
    <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

    <!-- Theme Loader Script -->
    <script>
      (function() {
        try {
          const theme = localStorage.getItem('theme');
          if (theme === 'dark') {
            document.documentElement.classList.add('dark');
          }
        } catch (e) { /* ignore */ }
      })();
    </script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       :root {
          /* Light Theme */
          --bg: 220 20% 98%; --fg: 222 47% 11%; --muted: 214 32% 91%;
          --muted-foreground: 215 17% 47%; --primary: 220 83% 58%;
          --primary-foreground: 0 0% 100%; --secondary: 0 0% 100%;
          --secondary-foreground: 222 47% 11%; --card: 0 0% 100%;
          --card-foreground: 222 47% 11%; --border: 214 32% 91%;
          --ring: 220 83% 58%; --radius: 12px; --ease: cubic-bezier(.2,.8,.2,1);
          --duration: 220ms; --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
        }
        html.dark {
            /* Dark Theme */
            --bg: 222 47% 11%; --fg: 210 40% 98%; --muted: 217 33% 17%;
            --muted-foreground: 215 20% 65%; --primary: 217 91% 60%;
            --primary-foreground: 210 40% 98%; --secondary: 222 47% 13%;
            --secondary-foreground: 210 40% 98%; --card: 222 47% 15%;
            --card-foreground: 210 40% 98%; --border: 217 33% 22%;
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body { margin: 0; color: hsl(var(--fg)); background: hsl(var(--bg)); font: 500 16px/1.4 'Inter', sans-serif; }
        a { color: inherit; text-decoration: none; }
        .app { display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 72px 1fr; grid-template-areas: "sidebar header" "sidebar main"; min-height: 100dvh; }
        .sidebar { grid-area: sidebar; border-right: 1px solid hsl(var(--border)); background: hsl(var(--secondary)); padding: 20px 16px; position: sticky; top: 0; height: 100dvh; }
        .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
        .brand img { width: 32px; height: 32px; }
        .brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
        nav { margin-top: 18px; display: grid; gap: 8px; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); transition: background var(--duration) var(--ease), color var(--duration) var(--ease); }
        .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
        .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); }
        .header { grid-area: header; position: sticky; top: 0; z-index: 10; background: hsl(var(--card)); border-bottom: 1px solid hsl(var(--border)); display: flex; align-items: center; gap: 12px; padding: 16px 20px; }
        .header h1 { font-size: 24px; margin: 0; }
        .main { grid-area: main; padding: 20px; }
        .charts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; }
        .card { background: hsl(var(--card)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow-card); }
        .card-header { margin-bottom: 16px; }
        .card-header h2 { font-size: 18px; font-weight: 700; margin: 0; }
        .chart-container { position: relative; height: 350px; }
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
        <a class="nav-link" href="upload_result.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
          Upload Results
        </a>
        <a class="nav-link" href="manage_results.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
            Manage Results
        </a>
        <a class="nav-link active" href="analytics.php">
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
            <h1>Analytics & Reporting</h1>
        </header>

        <main class="main" id="main">
            <div class="charts-grid">
                <div class="card">
                    <div class="card-header">
                        <h2>Applications by Major</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="majorsChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Applications by State/Region</h2>
                    </div>
                    <div class="chart-container">
                         <canvas id="regionsChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // --- API Request Helper ---
            async function apiRequest(action, data = {}) {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action, ...data }),
                });
                if (!response.ok) {
                    const errorData = await response.json().catch(() => ({ message: response.statusText }));
                    throw new Error(errorData.message || `HTTP error ${response.status}`);
                }
                return response.json();
            }

            // --- Chart Rendering Logic ---
            try {
                const analyticsData = await apiRequest('get_analytics_data');

                if (analyticsData.status === 'success') {
                    const { byMajor, byRegion } = analyticsData.data;

                    // --- Chart 1: Applications by Major (Pie Chart) ---
                    const majorsCtx = document.getElementById('majorsChart').getContext('2d');
                    new Chart(majorsCtx, {
                        type: 'doughnut',
                        data: {
                            labels: byMajor.map(item => item.academic_year || 'Not Specified'),
                            datasets: [{
                                label: 'Students',
                                data: byMajor.map(item => item.student_count),
                                backgroundColor: [
                                    '#3b82f6', '#ef4444', '#22c55e', '#f97316', '#8b5cf6', '#eab308', '#14b8a6'
                                ],
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'top' } }
                        }
                    });

                    // --- Chart 2: Applications by Region (Bar Chart) ---
                    const regionsCtx = document.getElementById('regionsChart').getContext('2d');
                    new Chart(regionsCtx, {
                        type: 'bar',
                        data: {
                            labels: byRegion.map(item => item.state_region || 'Unknown'),
                            datasets: [{
                                label: 'Number of Students',
                                data: byRegion.map(item => item.student_count),
                                backgroundColor: '#3b82f6',
                                borderColor: '#1d4ed8',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            indexAxis: 'y', // Horizontal bar chart
                             plugins: { legend: { display: false } },
                             scales: {
                                x: { beginAtZero: true }
                            }
                        }
                    });
                } else {
                    console.error("Failed to load analytics data:", analyticsData.message);
                }
            } catch (error) {
                console.error("Error fetching or rendering analytics:", error);
            }
        });
    </script>
</body>
</html>

