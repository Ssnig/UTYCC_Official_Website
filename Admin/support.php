<?php
require_once '../Rform/db.php'; // Database connection
session_start();
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: ./signin.php"); // Corrected path to signin.php in the same directory
    exit;
}

$feedbacks = [];
try {
    $stmt = $pdo->query("SELECT feedback_id, student_name, student_email, message, submitted_at FROM feedback ORDER BY submitted_at DESC");
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // For a real app, log this error and show a friendly message
    die("Error fetching feedback data: ". $e->getMessage());
}
$pdo = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Feedback — UTYCC Admin</title>
    <meta name="description" content="View student feedback for the UTYCC registration system." />
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
    <style>
       :root {
          /* Light Theme */
          --bg: 220 20% 98%; --fg: 222 47% 11%; --muted: 214 32% 91%;
          --muted-foreground: 215 17% 47%; --primary: 220 83% 58%;
          --primary-foreground: 0 0% 100%; --secondary: 0 0% 100%;
          --secondary-foreground: 222 47% 11%; --card: 0 0% 100%;
          --card-foreground: 222 47% 11%; --border: 214 32% 91%;
          --ring: 220 83% 58%; --success: 153 61% 34%; --warning: 43 96% 56%;
          --danger: 0 84% 60%; --radius: 12px; --ease: cubic-bezier(.2,.8,.2,1);
          --duration: 220ms; --shadow-soft: 0 10px 30px -12px hsl(var(--primary)/0.25);
          --shadow-card: 0 10px 20px -10px hsl(220 40% 20% / 0.15);
        }
        html.dark {
            /* Dark Theme */
            --bg: 222 47% 11%; --fg: 210 40% 98%; --muted: 217 33% 17%;
            --muted-foreground: 215 20% 65%; --primary: 217 91% 60%;
            --primary-foreground: 210 40% 98%; --secondary: 222 47% 13%;
            --secondary-foreground: 210 40% 98%; --card: 222 47% 15%;
            --card-foreground: 210 40% 98%; --border: 217 33% 22%;
            --ring: 217 91% 60%; --shadow-card: 0 10px 20px -10px hsl(220 40% 2% / 0.45);
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body { margin: 0; color: hsl(var(--fg)); background: hsl(var(--bg)); font: 500 16px/1.4 'Inter', sans-serif; text-rendering: optimizeLegibility; transition: background var(--duration) var(--ease), color var(--duration) var(--ease); }
        a { color: inherit; text-decoration: none; }
        button { font: inherit; }
        .app { display: grid; grid-template-columns: 280px 1fr; grid-template-rows: 72px 1fr; grid-template-areas: "sidebar header" "sidebar main"; min-height: 100dvh; }
        .sidebar { grid-area: sidebar; border-right: 1px solid hsl(var(--border)); background: hsl(var(--secondary)); padding: 20px 16px; position: sticky; top: 0; height: 100dvh; }
        .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
        .brand img { width: 32px; height: 32px; }
        .brand h1 { font-size: 18px; margin: 0; font-weight: 700; color: hsl(var(--secondary-foreground)); }
        nav { margin-top: 18px; display: grid; gap: 8px; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); transition: background var(--duration) var(--ease), color var(--duration) var(--ease); }
        .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
        .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); box-shadow: var(--shadow-soft); }
        .header { grid-area: header; position: sticky; top: 0; z-index: 10; background: hsl(var(--card)); border-bottom: 1px solid hsl(var(--border)); display: flex; align-items: center; gap: 12px; padding: 16px 20px; }
        .header h1 { font-size: 24px; margin: 0; }
        .main { grid-area: main; padding: 20px; }
        .feedback-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px; }
        .feedback-card { background: hsl(var(--card)); border: 1px solid hsl(var(--border)); border-radius: var(--radius); padding: 16px; box-shadow: var(--shadow-card); display: flex; flex-direction: column; }
        .feedback-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 8px; }
        .feedback-header .info { display: grid; }
        .feedback-header .name { font-weight: 700; }
        .feedback-header .email { font-size: 13px; color: hsl(var(--muted-foreground)); }
        .feedback-body { font-size: 15px; line-height: 1.6; color: hsl(var(--card-foreground)); flex-grow: 1; margin-bottom: 16px; }
        .feedback-body .message-text { display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden; text-overflow: ellipsis; }
        .feedback-body .message-text.expanded { -webkit-line-clamp: unset; }
        .feedback-actions { display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 12px; border-top: 1px solid hsl(var(--border)); }
        .feedback-actions .actions-right { display: flex; gap: 8px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 8px 12px; font-size: 14px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--card)); color: hsl(var(--fg)); box-shadow: var(--shadow-card); cursor: pointer; transition: all var(--duration) var(--ease); }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 30px -12px hsl(var(--fg)/0.25); }
        .btn.primary { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); border-color: hsl(var(--primary)); }
        .btn.destructive { background: hsl(var(--danger)); color: hsl(0 0% 100%); border-color: hsl(var(--danger)); }
        .btn-link { background: none; border: none; box-shadow: none; color: hsl(var(--primary)); padding: 0; font-weight: 600; cursor: pointer; }
        .toast-wrap { position: fixed; top: 20px; right: 20px; width: min(360px, 92vw); display: grid; gap: 12px; z-index: 9999; }
        .toast { display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--primary-foreground)); background: hsl(var(--fg)); box-shadow: var(--shadow-card); border-left: 4px solid; }
        .toast.success { border-left-color: hsl(var(--success)); }
        .toast.error { border-left-color: hsl(var(--danger)); }
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
        <a class="nav-link" href="admin_dashboard.php">Registrations</a>
        <a class="nav-link" href="upload_result.php">Upload Results</a>
        <a class="nav-link" href="manage_results.php">Manage Results</a>
        <a class="nav-link" href="analytics.php">Analytics</a>
        <a class="nav-link" href="activity.php">Upload Activity</a>
        <a class="nav-link" href="students.php">Students</a>
        <a class="nav-link active" href="support.php">Support</a>
        <a class="nav-link" href="settings.php">Settings</a>
      </nav>
        </aside>

        <header class="header">
            <h1>Student Feedback</h1>
        </header>

        <main class="main" id="main">
            <div class="feedback-grid" id="feedbackGrid">
                <?php if (empty($feedbacks)): ?>
                    <p>No feedback submitted yet.</p>
                <?php else: ?>
                    <?php foreach ($feedbacks as $item): ?>
                        <div class="feedback-card" id="feedback-<?php echo htmlspecialchars($item['feedback_id']); ?>">
                            <div class="feedback-header">
                                <div class="info">
                                    <span class="name"><?php echo htmlspecialchars($item['student_name']); ?></span>
                                    <a href="mailto:<?php echo htmlspecialchars($item['student_email']); ?>" class="email"><?php echo htmlspecialchars($item['student_email']); ?></a>
                                </div>
                                <span class="feedback-footer" style="font-size: 12px; color: hsl(var(--muted-foreground)); text-align: right;">
                                    <?php echo date('M d, Y, h:i A', strtotime($item['submitted_at'])); ?>
                                </span>
                            </div>
                            <div class="feedback-body">
                                <p class="message-text"><?php echo nl2br(htmlspecialchars($item['message'])); ?></p>
                            </div>
                            <div class="feedback-actions">
                                <button class="btn-link see-more-btn" style="display: none;">See More</button>
                                <div class="actions-right">
                                    <a href="mailto:<?php echo htmlspecialchars($item['student_email']); ?>?subject=Re: Your Feedback" class="btn primary">Reply</a>
                                    <button class="btn destructive delete-btn" data-id="<?php echo htmlspecialchars($item['feedback_id']); ?>">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <div class="toast-wrap"></div>

    <script>
        async function apiRequest(action, data) {
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action, ...data }),
                });
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(`API Error: ${errorText}`);
                }
                return await response.json();
            } catch (error) {
                showToast(`Error: ${error.message}`, 'error');
                return { status: 'error' };
            }
        }

        const toastWrap = document.querySelector(".toast-wrap");
        function showToast(message, type = "success") {
            const toast = document.createElement("div");
            toast.className = `toast ${type}`;
            toast.innerHTML = `<span>${message}</span>`;
            toastWrap.appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const feedbackGrid = document.getElementById('feedbackGrid');

            // --- "See More" Functionality ---
            feedbackGrid.querySelectorAll('.feedback-card').forEach(card => {
                const messageText = card.querySelector('.message-text');
                const seeMoreBtn = card.querySelector('.see-more-btn');

                // Show the "See More" button only if the text is overflowing
                if (messageText.scrollHeight > messageText.clientHeight) {
                    seeMoreBtn.style.display = 'inline-block';
                }

                seeMoreBtn.addEventListener('click', () => {
                    messageText.classList.toggle('expanded');
                    if (messageText.classList.contains('expanded')) {
                        seeMoreBtn.textContent = 'See Less';
                    } else {
                        seeMoreBtn.textContent = 'See More';
                    }
                });
            });

            // --- Delete Functionality (Event Delegation) ---
            feedbackGrid.addEventListener('click', async (e) => {
                if (e.target.matches('.delete-btn')) {
                    const id = e.target.dataset.id;
                    if (!confirm('Are you sure you want to delete this feedback?')) return;
                    
                    const response = await apiRequest('delete_feedback', { id });
                    if (response.status === 'success') {
                        const cardToRemove = document.getElementById(`feedback-${id}`);
                        if(cardToRemove) {
                            cardToRemove.remove();
                        }
                        showToast('Feedback deleted successfully.', 'success');
                    }
                }
            });
        });
    </script>
</body>
</html>

