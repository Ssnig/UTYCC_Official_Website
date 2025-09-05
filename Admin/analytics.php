<?php
// You can add session validation here if needed
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
                <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
                <h1>UTYCC Admin Panel</h1>
            </div>
            <nav>
                <a class="nav-link" href="admin_dashboard.php">Registrations</a>
                <a class="nav-link" href="upload_result.php">Upload Results</a>
                <a class="nav-link" href="students.php">Students</a>
                <a class="nav-link active" href="analytics.php">Analytics</a>
                <a class="nav-link" href="support.php">Support</a>
                <a class="nav-link" href="settings.php">Settings</a>
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

