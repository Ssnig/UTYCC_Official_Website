<?php
session_start();
date_default_timezone_set('Asia/Yangon');
require_once 'auth_check.php'; // Assuming this file exists for security

// Database connection file ကို include လုပ်ပါ
require_once '../Rform/db.php';

// **** FIX: Define the self_url variable which was missing ****
$self_url = htmlspecialchars($_SERVER['PHP_SELF']);

// --- CRUD Logic ---
$message = '';
$edit_student = null;

// Handle Delete
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM pre_approved_students WHERE id = ?");
    if ($stmt->execute([$id])) $message = "Student deleted successfully.";
    else $message = "Failed to delete student.";
}

// Handle Add/Update
if (isset($_POST['save'])) {
    $id = $_POST['id'] ?? null;

    // Store Myanmar sequence number directly
    $sequence_no = $_POST['sequence_no'];
    
    $seat_no = $_POST['seat_no'];
    $student_name_mm = $_POST['student_name_mm'];
    $nrc = $_POST['nrc'];
    $dob = $_POST['dob'];

    try {
        if ($id) { // Update
            $stmt = $pdo->prepare("UPDATE pre_approved_students SET sequence_no=?, seat_no=?, student_name_mm=?, nrc=?, dob=? WHERE id=?");
            $stmt->execute([$sequence_no, $seat_no, $student_name_mm, $nrc, $dob, $id]);
            $message = "Student updated successfully.";
        } else { // Add
            $stmt = $pdo->prepare("INSERT INTO pre_approved_students (sequence_no, seat_no, student_name_mm, nrc, dob) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$sequence_no, $seat_no, $student_name_mm, $nrc, $dob]);
            $message = "Student added successfully.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Handle Edit Request
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM pre_approved_students WHERE id = ?");
    $stmt->execute([$id]);
    $edit_student = $stmt->fetch(PDO::FETCH_ASSOC);
}

// --- Fetching Students with Search/Filter and Sort Logic ---
$search_term = trim($_GET['search'] ?? '');
$sort_option = trim($_GET['sort'] ?? 'desc'); // Default to 'desc' (newest first)

// Validate sort option to prevent potential SQL injection issues
$sort_order = ($sort_option === 'asc') ? 'ASC' : 'DESC';

$sql = "SELECT * FROM pre_approved_students";
$params = [];

if ($search_term) {
    // Search across multiple relevant columns, making NRC search space-insensitive
    $sql .= " WHERE sequence_no LIKE ? OR seat_no LIKE ? OR student_name_mm LIKE ? OR REPLACE(nrc, ' ', '') LIKE ?";
    $search_like = "%" . $search_term . "%";
    $nrc_search_like = "%" . str_replace(' ', '', $search_term) . "%";
    $params = [$search_like, $search_like, $search_like, $nrc_search_like];
}


// Apply the validated sort order
$sql .= " ORDER BY id " . $sort_order;

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Pre-Approved Students</title>
    <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

    <!-- Theme Loader Script -->
    <script>
      (function() {
        try {
          // Use 'theme' key to match settings.php
          const theme = localStorage.getItem('theme');
          if (theme === 'dark') {
            document.documentElement.classList.add('dark');
          }
        } catch (e) { console.error(e); }
      })();
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
    :root {
      /* Light Theme */
      --bg: 220 14% 96%;
      --fg: 222 84% 5%;
      --muted: 220 13% 91%;
      --muted-foreground: 220 9% 46%;
      --primary: 221 83% 53%;
      --primary-foreground: 210 40% 98%;
      --card: 0 0% 100%;
      --card-foreground: 222 84% 5%;
      --border: 215 20% 90%;
      --shadow-card: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }
    
    html.dark {
        /* Dark Theme */
        --bg: 0 0% 4%;
        --fg: 210 40% 98%;
        --muted: 0 0% 12%;
        --muted-foreground: 215 20% 65%;
        --primary: 217 91% 60%;
        --primary-foreground: 210 40% 98%;
        --card: 0 0% 8%;
        --card-foreground: 210 40% 98%;
        --border: 0 0% 15%;
        --shadow-card: 0 10px 20px -10px hsl(0 0% 0% / 0.45);
    }

    body { 
        font-family: 'Inter', sans-serif; 
        background-color: hsl(var(--bg));
        color: hsl(var(--fg));
    }
    
    .card { 
        background-color: hsl(var(--card)); 
        border-radius: 1rem; 
        box-shadow: var(--shadow-card);
        color: hsl(var(--card-foreground));
    }
    .form-input {
        background-color: hsl(var(--muted));
        border: 1px solid hsl(var(--border));
        color: hsl(var(--fg));
        transition: all 0.2s ease-in-out;
    }
    .form-input:focus {
        border-color: hsl(var(--primary));
        box-shadow: 0 0 0 2px hsla(var(--primary), 0.4);
        outline: none;
    }

    /* --- LAYOUT STYLES --- */
    .app {
      display: grid;
      grid-template-columns: 280px 1fr;
      grid-template-rows: 72px 1fr;
      grid-template-areas:
        "sidebar header"
        "sidebar main";
      min-height: 100dvh;
    }
    .header {
      grid-area: header;
      position: sticky; top: 0; z-index: 10;
      background: hsl(var(--card));
      border-bottom: 1px solid hsl(var(--border));
      display: flex; align-items: center; gap: 12px; padding: 16px 20px;
    }
    .main { grid-area: main; padding: 20px; }
    .sidebar { 
        grid-area: sidebar; 
        border-right: 1px solid hsl(var(--border)); 
        background: hsl(var(--card)); 
        padding: 20px 16px; 
        position: sticky; top: 0; 
        height: 100vh; 
    }
    .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
    .brand img { width: 32px; height: 32px; }
    .brand h1 { color: hsl(var(--card-foreground)); font-size: 18px; margin: 0; font-weight: 700;}
    nav { margin-top: 18px; display: grid; gap: 8px; }
    .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: hsl(var(--muted-foreground)); }
    .nav-link:hover { background: hsl(var(--muted)); color: hsl(var(--fg)); }
    .nav-link.active { background: hsl(var(--primary)); color: hsl(var(--primary-foreground)); }

    /* Component specific overrides */
    h1, h2, label { color: hsl(var(--fg)); }
    table { border-collapse: collapse; width: 100%;}
    th, td { padding: 0.75rem 1.5rem; text-align: left; border-bottom: 1px solid hsl(var(--border));}
    thead th { color: hsl(var(--muted-foreground)); font-size: 0.75rem; text-transform: uppercase;}
    tbody tr:last-child td { border-bottom: none; }
    </style>
</head>
<body>
<div class="app">
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
                <a class="nav-link" href="students.php">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
          Students
        </a>
 <a class="nav-link active" href="pre_approve.php">
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

    <header class="header">
        <h1 class="text-2xl font-bold">Pre-Approved Students</h1>
        <div class="flex-grow"></div>
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            <span class="font-semibold">
                 <?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?>
            </span>
        </div>
    </header>

    <main class="main">
        <?php if ($message): ?>
            <div class="mb-4 p-4 rounded-md <?php echo strpos($message, 'Error') !== false ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Add/Edit Form -->
        <div class="card p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4"><?php echo $edit_student ? 'Edit Student' : 'Add New Student'; ?></h2>
            <form action="<?php echo $self_url; ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <input type="hidden" name="id" value="<?php echo $edit_student['id'] ?? ''; ?>">
                <div>
                    <label for="sequence_no" class="block text-sm font-medium">စဉ် (No.)</label>
                    <input type="text" name="sequence_no" required class="form-input mt-1 block w-full rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['sequence_no'] ?? ''); ?>">
                </div>
                <div>
                    <label for="seat_no" class="block text-sm font-medium">Seat No.</label>
                    <input type="text" name="seat_no" required class="form-input mt-1 block w-full rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['seat_no'] ?? ''); ?>">
                </div>
                <div>
                    <label for="student_name_mm" class="block text-sm font-medium">Student Name (MM)</label>
                    <input type="text" name="student_name_mm" required class="form-input mt-1 block w-full rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['student_name_mm'] ?? ''); ?>">
                </div>
                
                <div>
                    <div class="flex justify-between items-center">
                        <label for="nrc_group" class="block text-sm font-medium">NRC</label>
                        <div class="flex items-center gap-2">
                             <input type="checkbox" id="nrc_applying" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                             <label for="nrc_applying" class="text-sm">လျှောက်ထားဆဲ</label>
                        </div>
                    </div>
                    <div id="nrc_group" class="mt-1"></div>
                    <input type="hidden" name="nrc" id="nrc_hidden" value="<?php echo htmlspecialchars($edit_student['nrc'] ?? ''); ?>">
                </div>

                <div>
                    <label class="block text-sm font-medium">Date of Birth</label>
                    <div class="grid grid-cols-3 gap-3 mt-1">
                        <div>
                            <select id="dob_year" class="form-input block w-full rounded-md p-2" required>
                                <option value="">Year</option>
                            </select>
                        </div>
                        <div>
                            <select id="dob_month" class="form-input block w-full rounded-md p-2" required>
                                <option value="">Month</option>
                            </select>
                        </div>
                        <div>
                            <select id="dob_day" class="form-input block w-full rounded-md p-2" required>
                                <option value="">Day</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="dob_hidden_input" name="dob" value="<?php echo htmlspecialchars($edit_student['dob'] ?? ''); ?>">
                </div>
                <div class="lg:col-span-3 flex justify-end gap-3 mt-6">
                     <?php if ($edit_student): ?>
                        <a href="<?php echo $self_url; ?>" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Cancel Edit</a>
                    <?php endif; ?>
                    <button type="submit" name="save" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Save Student</button>
                </div>
            </form>
        </div>

        <!-- Student List -->
        <div class="card p-6">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                <h2 class="text-2xl font-bold">Pre-Approved Student List</h2>
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Total Students: <?php echo count($students); ?>
                </span>
            </div>
            <div class="mb-4">
                <!-- Search and Sort Form -->
                <form action="<?php echo $self_url; ?>" method="GET" class="flex flex-wrap items-center gap-2">
                    <input type="text" name="search" class="form-input rounded-md p-2 w-auto flex-grow sm:w-64" placeholder="Search by Name, Seat No, etc." value="<?php echo htmlspecialchars($search_term); ?>">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Search</button>
                    <select name="sort" class="form-input rounded-md p-2" onchange="this.form.submit()">
                        <option value="desc" <?php if ($sort_option === 'desc') echo 'selected'; ?>>အသစ်ဆုံး အရင်ပြရန်</option>
                        <option value="asc" <?php if ($sort_option === 'asc') echo 'selected'; ?>>အဟောင်းဆုံး အရင်ပြရန်</option>
                    </select>
                    <?php if ($search_term || $sort_option !== 'desc'): ?>
                        <a href="<?php echo $self_url; ?>" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Clear</a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th>စဉ်</th>
                            <th>Seat No</th>
                            <th>Name</th>
                            <th>NRC</th>
                            <th>DOB</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($students)): ?>
                            <tr><td colspan="6" class="text-center py-8" style="color: hsl(var(--muted-foreground));">No students found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['sequence_no']); ?></td>
                                <td><?php echo htmlspecialchars($student['seat_no']); ?></td>
                                <td><?php echo htmlspecialchars($student['student_name_mm']); ?></td>
                                <td><?php echo htmlspecialchars($student['nrc']); ?></td>
                                <td><?php echo htmlspecialchars($student['dob']); ?></td>
                                <td class="whitespace-nowrap text-sm font-medium">
                                    <a href="?edit=<?php echo $student['id']; ?>" class="text-indigo-500 hover:text-indigo-700 mr-4">Edit</a>
                                    <form action="<?php echo $self_url; ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                        <button type="submit" name="delete" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- MYANMAR NUMBER CONVERSION SCRIPT ---
        function convertToMyanmarNumber(str) {
            const english_numerals = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g];
            const myanmar_numerals = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
            let newStr = String(str);
            for (let i = 0; i < english_numerals.length; i++) {
                newStr = newStr.replace(english_numerals[i], myanmar_numerals[i]);
            }
            return newStr;
        }

        const sequenceInput = document.querySelector('input[name="sequence_no"]');
        if (sequenceInput) {
            sequenceInput.addEventListener('input', function() {
                const myanmarValue = convertToMyanmarNumber(this.value);
                const sanitizedValue = myanmarValue.replace(/[^၀-၉]/g, '');
                if (this.value !== sanitizedValue) {
                   this.value = sanitizedValue;
                }
            });
        }
        
        // --- START OF NRC LOGIC ---
        function setupNrcSection(containerId, prefix) {
            const container = document.getElementById(containerId);
            const hiddenInput = document.getElementById(`${prefix}_hidden`);
            const checkbox = document.getElementById(`${prefix}_applying`);
            if (!container || !hiddenInput || !checkbox) return;

            const nrcTownships = {
                1: ["အဂယ", "အတန", "ဗကန", "ဗမန", "ဒဖယ", "ဟပန", "ဆဒန", "ဆပဘ", "ကမန", "ကမတ", "ကပတ", "ခဘဒ", "ခလဖ", "ခဖန", "လဂန", "မဂဒ", "မကန","မကတ", "မကသ", "မခဘ", "မလန", "မမန", "မညန", "မစန","မတန","နမန","ပမန","ပနဒ","ပတအ","ပဝန","ဖကန","ရဗယ", "ဆဘန", "ဆဘတ", "စကန", "ဆလန", "စပဘ", "တနန","ဝမန","သဝတ","ဝမန","ရကန"],
                2: ["ဘလခ", "ဒမဆ", "ဖဆန", "ထတပ","ခစန", "လကန", "မစန", "ဖလဆ", "ဖရဆ", "ရသန","စစန","ရတန"],
                3: ["ဘအန", "ဘဂလ", "ဘသဆ", "ကဒန", "ကကရ", "ကမမ","ကဆက", "ကတခ", "လဘန", "လသန","မဆလ", "မဝတ", "ပကန", "ဖအန", "ဖပန", "စကလ","သတက","သတန","ဝလမ","ရရသ"],
                4: ["ဟခန", "ဖလန", "ဆမန", "ထတလ", "ကခန", "ကပလ","မတန", "မတပ", "ပလဝ", "ရခဒ","ရဇန", "တတန", "တဇန"],
                5: ["အထန", "အမဇ", "အတန", "အရတ", "ဗမန", "ဘတလ", "ဒဟန", "ဓကန", "ဒပယ", "ဟမလ", "ထခန", "ထပခ", "ကဘလ", "ကလထ","ကလန", "ကလတ", "ကလသ", "ကလဝ", "ကနန", "ကဆလ", "ကသန", "ခဥန", "ခပန", "ခတန", "ခဥတ","လဟန", "လရန", "မကန", "မလန", "မမန", "မမတ","မပလ", "မသန", "မရန", "နယန", "ငစန", "ငဇန", "ပလဘ", "ပလန", "ပဆန", "ဖပန","စကန", "ဆလက", "ဆမရ", "တဥန", "တမန", "တဆန","ဝလန", "ဝသန", "ရဥန", "ရဘန", "ယမပ"],
                6: ["အမရ", "ဘပန", "ဟသတ", "ထဝန", "ကလအ", "ကပန", "ကစန", "ကသမ", "ကသန", "ကရရ", "ခမက","လလန", "မအန", "မအရ", "မမလ", "မမန","မတန", "ပကမ", "ပလန", "ပလတ", "တသရ", "သရခ", "ရဖန"],
                7: ["အဖန", "အတန", "ဘသရ", "ဒဥန", "ထတပ", "ကကန", "ကပက", "ကတခ","ကဝန", "လပတ", "မလန", "မညန", "မဝတ", "နတလ", "ညလပ", "ပခန","ပခတ", "ပမန", "ပစတ", "ပတန", "ပတတ", "ဖမန", "တငန", "သကန","သနပ","သဝတ","ဝမန","ရကန","ရတန","ရတရ","ဇကန"],
                8: ["အလန", "ဘကလ", "ဂဂန", "ဆမန", "ထလန", "ကထန", "ကမန", "ခမန","မဘန", "မဂဒ", "မထလ", "မထန", "မကန", "မလန", "မမန", "မတန", "မသန", "မရဆ", "နမန", "ငဖန", "ပခက", "ပမန" , "ပဖန", "စလန","ဆပဝ","ဆဖန", "စတရ", "တတက", "သရန", "ရနခ", "ရစက"],
                9: ["အခန", "အမဘ", "အမရ", "အမဇ", "အစန", "အရတ", "ဥတသ", "ဒခသ", "ကမန", "ကပတ", "ကဆန", "ခအဇ", "ခမခ","ခမမ", "ခမန", "ခမစ", "ခမသ", "ခမဇ", "လကန", "လဝန", "မဟမ", "မထလ", "မကခ", "မကန","မခန", "မလန", "မမန", "မနမ", "မနတ", "မစန","မတလ", "မတန", "မတရ", "မသန", "မရမ", "မရတ", "နထက", "နမန", "နနမ", "နတက", "ငသရ","ငဇန", "ညဉန", "ပဥလ", "ပဘန", "ပဗသ", "ပကခ","ပခက", "ပခမ", "ပမန", "ပသက", "စကန", "စကတ", "တကတ" , "တတဥ", "တသန", "သပက", "သစန", "သတရ", "သဝန", "ဝတန", "ရဥန","ရမသ","ဇဗသ","ဇယသ"],
                10: ["ဘအန", "ဘလန", "ထထန", "ကထန", "ကမလ", "ကမရ", "ခဆန", "ခဇန", "လမန", "မဒန", "မလမ","မစန", "ပမန", "ဖပန", "သထန", "သဖရ", "ရမန"],
                11: ["အမန", "ဘသတ", "ဂမန", "ကဖန", "ကတလ", "ကတန", "လမတ", "မအတ","မအန", "မဥန", "မမန", "မပန", "မပတ", "မတန", "ပဏက", "ပတန", "စတန", "တကန", "တပဝ", "သတန", "ရဗန", "ရတန" , "ရတသ", "ရသတ"],
                12: ["အလန", "အစန", "ဥကမ", "ဥကတ", "ဗဟန", "ဗတထ", "ဒဂမ", "ဒဂန", "ဒဂဆ", "ဒဂရ", "ဒလန", "ဒပန", "ထတပ", "ကကက", "ကခက", "ကမန", "ကမတ", "ကမရ", "ကတန", "ကတတ", "ခရန", "လကန" , "လမန", "လမတ", "လသန", "လသယ", "လယန", "လယရ", "မဥက", "မဘန","မဂဒ", "မဂတ", "မရက", "ပဘတ", "ပဇတ", "ဆကခ", "စခန", "တဥက", "တကန", "တမန", "တတန", "တတတ", "သဃက", "သကတ", "သခန", "သလန","ရကန","ရပသ"],
                13: ["အပန", "အသရ", "အတန", "ဟမန", "ဟပန", "ဟပတ", "ကဟန", "ကကန", "ကခန", "ကလဒ", "ကလထ", "ကလန", "ကလတ", "ကမန", "ကတလ", "ကတန", "ကတတ", "ကသန", "ခလန", "ခရဟ", "လကန", "လခန", "လခတ", "လလန" ,"လရန", "မဘန", "မဟရ", "မထထ", "မကထ", "မကန", "မကတ", "မခန", "မခတ", "မလန", "မလတ", "မမထ", "မမန", "မနန", "မနတ", "မငန", "မပထ", "မပန", "မပတ", "မဖန", "မဖတ", "မရန", "မရတ", "မဆန", "မဆတ", "မတန", "မတတ", "မယထ", "မယန", "မယတ", "နခန", "နခတ" ,"နမတ", "နဖန", "နစန", "နတန", "နတရ", "ညရန" , "ပဆတ", "ပလထ", "ပလန", "ပလတ", "ပပက", "ပဆန", "ပဝန", "ပယန", "ဖခန", "ဆဆန", "တကန" ,"တခလ", "တလန", "တမည", "တတန", "တယန", "သနန",  "သပန", "ဝကန","ရငန","ရညန" ,"ရစန"],
                14: ["အမတ", "အဂပ", "အမန", "အပန", "အစန", "ဘကလ", "ဒဒရ", "ဓနဖ", "ဟကက", "ဟသတ", "ကကထ", "ကကန", "ကခန", "ကလန" , "ကမန", "ကမသ", "ကပန", "လမန", "လပတ", "မအန", "မအပ", "မမက", "မမန", "မရက", "ငပတ", "ငဆန", "ငသခ" , "ငရက", "ညတန", "ပကခ", "မပလ", "ပတန", "ပသန", "ပသရ", "ဖပန", "တမန", "သပန" ,"ဝခမ", "ရကန", "ရသယ", "ဇလန"]
            };
            const nrcTypes = ["နိုင်", "ဧည့်", "ပြု", "သာ", "ယာယီ"];

            container.innerHTML = `
                <div class="flex flex-col space-y-2">
                    <div class="grid grid-cols-3 gap-2">
                        <select name="${prefix}_state" class="form-input w-full rounded-md p-2"></select>
                        <select name="${prefix}_township" class="form-input w-full rounded-md p-2"></select>
                        <select name="${prefix}_type" class="form-input w-full rounded-md p-2"></select>
                    </div>
                    <input type="text" name="${prefix}_number" class="form-input w-full rounded-md p-2 mt-2" placeholder="၁၂၃၄၅၆" maxlength="6" pattern="[၀-၉]{6}">
                </div>
            `;

            const stateSelect = container.querySelector(`select[name="${prefix}_state"]`);
            const townshipSelect = container.querySelector(`select[name="${prefix}_township"]`);
            const typeSelect = container.querySelector(`select[name="${prefix}_type"]`);
            const numberInput = container.querySelector(`input[name="${prefix}_number"]`);
            const allNrcInputs = [stateSelect, townshipSelect, typeSelect, numberInput];

            for (let i = 1; i <= 14; i++) {
                stateSelect.add(new Option(convertToMyanmarNumber(i), i));
            }
            nrcTypes.forEach(type => {
                typeSelect.add(new Option(`(${type})`, `(${type})`));
            });

            const updateHiddenNrcInput = () => {
                if (checkbox.checked) {
                    hiddenInput.value = 'လျှောက်ထားဆဲ';
                    return;
                }
                if (stateSelect.value && townshipSelect.value && typeSelect.value && numberInput.value.match(/^[၀-၉]{6}$/)) {
                    hiddenInput.value = `${convertToMyanmarNumber(stateSelect.value)}/${townshipSelect.value}${typeSelect.value}${numberInput.value}`;
                } else {
                    hiddenInput.value = '';
                }
            };

            const updateNrcTownships = (townshipToSelect = null) => {
                const selectedState = stateSelect.value;
                const townships = nrcTownships[selectedState] || [];
                townshipSelect.innerHTML = '';
                townships.forEach(township => {
                    townshipSelect.add(new Option(township, township));
                });
                if (townshipToSelect && townships.includes(townshipToSelect)) {
                    townshipSelect.value = townshipToSelect;
                }
                updateHiddenNrcInput();
            };

            const convertToEnglishNumber = (myanmarStr) => {
                const map = {'၀':'0', '၁':'1', '၂':'2', '၃':'3', '၄':'4', '၅':'5', '၆':'6', '၇':'7', '၈':'8', '၉':'9'};
                return String(myanmarStr).replace(/[၀-၉]/g, m => map[m]);
            };

            const parseAndRepopulateNrc = () => {
                const nrcValue = hiddenInput.value;
                if (!nrcValue || nrcValue === 'လျှောက်ထားဆဲ') return;

                const nrcRegex = /^([၀-၉]{1,2})\/([က-အ]+)\((.+?)\)([၀-၉]{6})$/;
                const match = nrcValue.match(nrcRegex);
                if (match) {
                    stateSelect.value = convertToEnglishNumber(match[1]);
                    // Manually trigger change to update townships, THEN set the values
                    stateSelect.dispatchEvent(new Event('change'));
                    setTimeout(() => {
                        townshipSelect.value = match[2];
                        typeSelect.value = `(${match[3]})`;
                        numberInput.value = match[4];
                         updateHiddenNrcInput();
                    }, 50); // Small delay to ensure township dropdown is populated
                }
            };
            
            const toggleNrcFields = (isApplying) => {
                allNrcInputs.forEach(input => {
                    input.disabled = isApplying;
                    input.classList.toggle('bg-gray-200', isApplying);
                    input.classList.toggle('dark:bg-gray-700', isApplying);
                });
                if (isApplying) {
                    hiddenInput.value = 'လျှောက်ထားဆဲ';
                } else {
                    updateHiddenNrcInput();
                }
            };

            allNrcInputs.forEach(input => input.addEventListener('change', updateHiddenNrcInput));
            numberInput.addEventListener('input', function() {
                this.value = convertToMyanmarNumber(this.value).replace(/[^၀-၉]/g, '');
                updateHiddenNrcInput();
            });
            stateSelect.addEventListener('change', () => updateNrcTownships());
            checkbox.addEventListener('change', () => toggleNrcFields(checkbox.checked));

            // Initial setup
            if (hiddenInput.value) {
                if (hiddenInput.value === 'လျှောက်ထားဆဲ') {
                    checkbox.checked = true;
                    toggleNrcFields(true);
                } else {
                    parseAndRepopulateNrc();
                    toggleNrcFields(false);
                }
            } else {
                 updateNrcTownships();
                 toggleNrcFields(false);
            }
        }

        setupNrcSection('nrc_group', 'nrc');
        // --- END OF NRC LOGIC ---

        // --- DATE OF BIRTH DROPDOWNS ---
        const yearSelect = document.getElementById('dob_year');
        const monthSelect = document.getElementById('dob_month');
        const daySelect = document.getElementById('dob_day');
        const dobHiddenInput = document.getElementById('dob_hidden_input');

        if (yearSelect && monthSelect && daySelect && dobHiddenInput) {
            const currentYear = new Date().getFullYear();
            const startYear = currentYear - 100;

            for (let i = currentYear - 16; i >= startYear; i--) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }

            for (let i = 1; i <= 12; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = i;
                monthSelect.appendChild(option);
            }

            function populateDays(dayToPreselect = null) {
                const year = parseInt(yearSelect.value, 10);
                const month = parseInt(monthSelect.value, 10);
                const currentSelectedDay = dayToPreselect || daySelect.value;
                daySelect.innerHTML = '<option value="">Day</option>';

                if (year && month) {
                    const daysInMonth = new Date(year, month, 0).getDate();
                    for (let i = 1; i <= daysInMonth; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i;
                        daySelect.appendChild(option);
                    }
                    if (currentSelectedDay && currentSelectedDay <= daysInMonth) {
                        daySelect.value = currentSelectedDay;
                    }
                }
            }

            function updateHiddenDob() {
                const year = yearSelect.value;
                const month = monthSelect.value;
                const day = daySelect.value;

                if (year && month && day) {
                    const monthPadded = String(month).padStart(2, '0');
                    const dayPadded = String(day).padStart(2, '0');
                    dobHiddenInput.value = `${year}-${monthPadded}-${dayPadded}`;
                } else {
                    dobHiddenInput.value = '';
                }
            }

            const initialDob = dobHiddenInput.value;
            if (initialDob) {
                const dateParts = initialDob.split('-');
                if (dateParts.length === 3) {
                    const initialYear = parseInt(dateParts[0], 10);
                    const initialMonth = parseInt(dateParts[1], 10);
                    const initialDay = parseInt(dateParts[2], 10);
                    yearSelect.value = initialYear;
                    monthSelect.value = initialMonth;
                    populateDays(initialDay);
                }
            }

            yearSelect.addEventListener('change', () => { populateDays(); updateHiddenDob(); });
            monthSelect.addEventListener('change', () => { populateDays(); updateHiddenDob(); });
            daySelect.addEventListener('change', updateHiddenDob);
        }
    });
</script>

</body>
</html>

