<?php
session_start();
date_default_timezone_set('Asia/Yangon');
// require_once 'auth_check.php'; // Assuming this file exists for security

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

// Fetch all students
$students = $pdo->query("SELECT * FROM pre_approved_students ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Pre-Approved Students</title>
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
        <a class="nav-link" href="settings.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 0 2l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l-.22-.38a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1 0-2l.15-.08a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
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
                    <label for="nrc" class="block text-sm font-medium">NRC</label>
                    <input type="text" name="nrc" required class="form-input mt-1 block w-full rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['nrc'] ?? ''); ?>">
                </div>
                <div>
                    <label for="dob" class="block text-sm font-medium">Date of Birth</label>
                    <input type="date" name="dob" required class="form-input mt-1 block w-full rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['dob'] ?? ''); ?>">
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
            <h2 class="text-2xl font-bold mb-4">Pre-Approved Student List</h2>
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
    // --- THEME APPLIER SCRIPT ---
    // Applies the theme from localStorage on page load. Theme is controlled from settings.php
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // --- MYANMAR NUMBER CONVERSION SCRIPT ---
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>

</body>
</html>

