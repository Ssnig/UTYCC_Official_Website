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
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <h1 class="text-xl font-bold text-indigo-600">Admin Panel</h1>
            </div>
            <div class="flex items-center">
                 <form method="POST" action="<?php echo $self_url; ?>">
                    <button type="submit" name="logout" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <?php if ($message): ?>
        <div class="mb-4 p-4 rounded-md <?php echo strpos($message, 'Error') !== false ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <!-- Add/Edit Form -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold mb-4"><?php echo $edit_student ? 'Edit Student' : 'Add New Student'; ?></h2>
        <form action="<?php echo $self_url; ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <input type="hidden" name="id" value="<?php echo $edit_student['id'] ?? ''; ?>">
            <div>
                <label for="sequence_no" class="block text-sm font-medium">စဉ် (No.)</label>
                <input type="text" name="sequence_no" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['sequence_no'] ?? ''); ?>">
            </div>
            <div>
                <label for="seat_no" class="block text-sm font-medium">Seat No.</label>
                <input type="text" name="seat_no" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['seat_no'] ?? ''); ?>">
            </div>
            <div>
                <label for="student_name_mm" class="block text-sm font-medium">Student Name (MM)</label>
                <input type="text" name="student_name_mm" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['student_name_mm'] ?? ''); ?>">
            </div>
            <div>
                <label for="nrc" class="block text-sm font-medium">NRC</label>
                <input type="text" name="nrc" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['nrc'] ?? ''); ?>">
            </div>
            <div>
                <label for="dob" class="block text-sm font-medium">Date of Birth</label>
                <input type="date" name="dob" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" value="<?php echo htmlspecialchars($edit_student['dob'] ?? ''); ?>">
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
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Pre-Approved Student List</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">စဉ်</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Seat No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NRC</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">DOB</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($student['sequence_no']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($student['seat_no']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($student['student_name_mm']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($student['nrc']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($student['dob']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="?edit=<?php echo $student['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                            <form action="<?php echo $self_url; ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                <button type="submit" name="delete" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
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

