<?php
require_once '../Rform/db.php'; // Database connection
require_once 'auth_check.php';


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
        .btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: var(--shadow-card); }
        .btn-link { background: none; border: none; box-shadow: none; color: hsl(var(--primary)); padding: 0; font-weight: 600; cursor: pointer; }
        .toast-wrap { position: fixed; bottom: 20px; right: 20px; top: auto; width: min(360px, 92vw); display: grid; gap: 12px; z-index: 9999; }
        .toast { display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 12px; padding: 14px 18px; border-radius: 10px; color: hsl(var(--fg)); background: hsl(var(--card)); box-shadow: 0 10px 30px -12px hsl(var(--fg)/0.25); border-left: 4px solid; }
        .toast.success { border-left-color: hsl(var(--success)); }
        .toast.error { border-left-color: hsl(var(--danger)); }

        /* MODAL STYLES */
        dialog { border: none; border-radius: 16px; padding: 0; background: hsl(var(--card)); color: hsl(var(--card-foreground)); width: min(600px, 94vw); box-shadow: 0 30px 100px -40px hsl(var(--fg)/0.5); }
        dialog::backdrop { background: hsl(222 47% 11% / 0.45); backdrop-filter: blur(2px); }
        .modal-header { padding: 16px 18px; border-bottom: 1px solid hsl(var(--border)); display: flex; justify-content: space-between; align-items: center; }
        .modal-header strong { font-size: 1.1rem; }
        .modal-body { padding: 18px; display: grid; gap: 16px; max-height: 70vh; overflow-y: auto; }
        .modal-footer { padding: 14px 18px; border-top: 1px solid hsl(var(--border)); display: flex; justify-content: flex-end; gap: 8px; }
        .field { display: grid; gap: 6px; }
        .field label { font-size: 13px; color: hsl(var(--muted-foreground)); }
        .field input, .field textarea { padding: 10px 12px; border-radius: 10px; border: 1px solid hsl(var(--border)); background: hsl(var(--bg)); color: hsl(var(--fg)); outline: none; font: inherit; }
        .field textarea { min-height: 120px; resize: vertical; }
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
         <a class="nav-link" href="manage_stats.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            Manage Stats
        </a>
        <a class="nav-link" href="activity.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            Upload Activity
        </a>
        <a class="nav-link" href="students.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          Students
        </a>
        <a class="nav-link active" href="support.php">
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
            <h1>Student Feedback</h1>
            <div style="flex-grow: 1;"></div>
            <div class="user-info" style="display: flex; align-items: center; gap: 0.75rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 1.25rem; height: 1.25rem; color: hsl(var(--muted-foreground));"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span style="font-weight: 600; color: hsl(var(--fg));">
                    <?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?>
                </span>
            </div>
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
                                <p class="message-text" data-full-message="<?php echo htmlspecialchars($item['message']); ?>"><?php echo nl2br(htmlspecialchars($item['message'])); ?></p>
                            </div>
                            <div class="feedback-actions">
                                <button class="btn-link see-more-btn" style="display: none;">See More</button>
                                <div class="actions-right">
                                    <button class="btn primary reply-btn" data-email="<?php echo htmlspecialchars($item['student_email']); ?>" data-name="<?php echo htmlspecialchars($item['student_name']); ?>">Reply</button>
                                    <button class="btn destructive delete-btn" data-id="<?php echo htmlspecialchars($item['feedback_id']); ?>">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <!-- MODAL for Reply -->
    <dialog id="replyModal">
        <form id="replyForm">
            <div class="modal-header">
                <strong>Reply to Feedback</strong>
                <button type="button" class="btn-link" id="closeModalBtn" style="font-size: 20px;">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="reply_student_email" name="email">
                <input type="hidden" id="reply_student_name" name="name">
                <input type="hidden" id="reply_original_message" name="original_message">
                
                <div class="field">
                    <label for="reply_to">To:</label>
                    <input type="text" id="reply_to" disabled>
                </div>
                <div class="field">
                    <label for="reply_subject">Subject</label>
                    <input type="text" id="reply_subject" name="subject" required>
                </div>
                <div class="field">
                    <label for="reply_message">Your Message</label>
                    <textarea id="reply_message" name="message" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="cancelReplyBtn">Cancel</button>
                <button type="submit" class="btn primary" id="sendReplyBtn">Send Reply</button>
            </div>
        </form>
    </dialog>
    
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
            const replyModal = document.getElementById('replyModal');
            const replyForm = document.getElementById('replyForm');
            const sendReplyBtn = document.getElementById('sendReplyBtn');

            // --- "See More" Functionality ---
            feedbackGrid.querySelectorAll('.feedback-card').forEach(card => {
                const messageText = card.querySelector('.message-text');
                const seeMoreBtn = card.querySelector('.see-more-btn');

                if (messageText.scrollHeight > messageText.clientHeight) {
                    seeMoreBtn.style.display = 'inline-block';
                }

                seeMoreBtn.addEventListener('click', () => {
                    messageText.classList.toggle('expanded');
                    seeMoreBtn.textContent = messageText.classList.contains('expanded') ? 'See Less' : 'See More';
                });
            });

            // --- Event Delegation for Delete and Reply ---
            feedbackGrid.addEventListener('click', async (e) => {
                const target = e.target;
                if (target.matches('.delete-btn')) {
                    const id = target.dataset.id;
                    if (!confirm('Are you sure you want to delete this feedback?')) return;
                    
                    const response = await apiRequest('delete_feedback', { id });
                    if (response.status === 'success') {
                        document.getElementById(`feedback-${id}`)?.remove();
                        showToast('Feedback deleted successfully.', 'success');
                    }
                }
                
                if (target.matches('.reply-btn')) {
                    const name = target.dataset.name;
                    const email = target.dataset.email;
                    const originalMessage = target.closest('.feedback-card').querySelector('.message-text').dataset.fullMessage;

                    document.getElementById('reply_to').value = `${name} <${email}>`;
                    document.getElementById('reply_student_email').value = email;
                    document.getElementById('reply_student_name').value = name;
                    document.getElementById('reply_original_message').value = originalMessage;
                    document.getElementById('reply_subject').value = 'Re: Your Feedback to UTYCC';
                    document.getElementById('reply_message').value = '';
                    
                    replyModal.showModal();
                }
            });

            // --- Modal Controls ---
            document.getElementById('closeModalBtn').addEventListener('click', () => replyModal.close());
            document.getElementById('cancelReplyBtn').addEventListener('click', () => replyModal.close());
            
            replyForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                sendReplyBtn.disabled = true;
                sendReplyBtn.textContent = 'Sending...';

                const formData = new FormData(replyForm);
                const data = Object.fromEntries(formData.entries());

                const response = await apiRequest('send_feedback_reply', data);
                if (response.status === 'success') {
                    showToast('Reply sent successfully!', 'success');
                    replyModal.close();
                } else {
                     showToast(response.message || 'Failed to send reply.', 'error');
                }
                
                sendReplyBtn.disabled = false;
                sendReplyBtn.textContent = 'Send Reply';
            });
        });
    </script>
</body>
</html>
