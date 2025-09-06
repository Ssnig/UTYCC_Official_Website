<?php
// Database connection file ကို include လုပ်ပါ
require_once '../Rform/db.php';

// Major, Year, Semester တို့ကို ဖော်ပြရန်အတွက် mapping array များ
$major_map = [
    'ist' => 'IST',
    'ce' => 'CE',
    'ece' => 'ECE',
    'pre' => 'PRE',
    'ame' => 'AME'
];
$year_map = ['1' => '1st Year', '2' => '2nd Year', '3' => '3rd Year', '4' => '4th Year', '5' => '5th Year', '6' => 'Final Year'];
$semester_map = ['1' => '1st Semester', '2' => '2nd Semester'];

// Database မှ ရလဒ်များအားလုံးကို ဆွဲထုတ်ပါ
try {
    $stmt = $pdo->query("SELECT id, year, semester, major, image_path, uploaded_at FROM exam_results ORDER BY year ASC, major ASC, uploaded_at DESC");
    $results_flat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ရလဒ်များကို Year နှင့် Major အလိုက် အုပ်စုဖွဲ့ပါ
    $grouped_results = [];
    foreach ($results_flat as $result) {
        $grouped_results[$result['year']][$result['major']][] = $result;
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Exam Results — UTYCC Admin</title>
  <link rel="shortcut icon" href="./Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
    .sidebar { grid-area: sidebar; border-right: 1px solid #e2e8f0; background: #fff; padding: 20px 16px; position: sticky; top: 0; height: 100vh; }
    .brand { display: flex; align-items: center; gap: 12px; padding: 8px 10px; }
    .brand img { width: 32px; height: 32px; }
    .brand h1 { font-size: 18px; margin: 0; font-weight: 700; }
    nav { margin-top: 18px; display: grid; gap: 8px; }
    .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: #64748b; }
    .nav-link:hover { background: #f1f5f9; color: #0f172a; }
    .nav-link.active { background: #3b82f6; color: #fff; }
    /* Modal styles */
    .modal-backdrop { position: fixed; inset: 0; background-color: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 50; opacity: 0; visibility: hidden; transition: opacity 0.3s, visibility 0.3s; }
    .modal-backdrop.visible { opacity: 1; visibility: visible; }
    .modal-content { background: white; padding: 2rem; border-radius: 0.75rem; width: 90%; max-width: 500px; transform: scale(0.95); transition: transform 0.3s; }
    .modal-backdrop.visible .modal-content { transform: scale(1); }
  </style>
</head>
<body class="flex">
   <aside class="sidebar" aria-label="Sidebar navigation">
      <div class="brand" aria-label="Brand">
        <img src="./Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        <h1>UTYCC Admin Panel</h1>
      </div>
      <nav>
        <a class="nav-link" href="admin_dashboard.php">Registrations</a>
        <a class="nav-link" href="upload_result.php">Upload Results</a>
        <a class="nav-link active" href="manage_results.php">Manage Results</a>
        <a class="nav-link" href="students.php">Students</a>
        <a class="nav-link" href="support.php">Support</a>
        <a class="nav-link" href="settings.php">Settings</a>
      </nav>
    </aside>

  <main class="flex-1 p-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manage Exam Results</h1>
        <!-- Filters -->
        <div class="flex gap-4 mt-4 md:mt-0">
            <select id="filter-year" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="all" selected>All Years</option>
                <?php foreach ($year_map as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
            <select id="filter-major" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="all" selected>All Majors</option>
                <?php foreach ($major_map as $key => $value): ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    
    <div id="status-message" class="mb-4 p-3 rounded-lg text-center hidden" role="alert"></div>

    <div class="space-y-8" id="results-container">
        <?php if (empty($grouped_results)): ?>
            <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
                <p>No results found.</p>
            </div>
        <?php else: ?>
            <?php foreach ($grouped_results as $year => $majors): ?>
                <div class="year-group" data-year="<?php echo $year; ?>">
                    <h2 class="text-2xl font-bold text-gray-700 border-b pb-2 mb-4"><?php echo $year_map[$year] ?? 'Unknown Year'; ?></h2>
                    <?php foreach ($majors as $major => $results): ?>
                        <div class="major-group" data-major="<?php echo $major; ?>">
                            <h3 class="text-xl font-semibold text-gray-600 mb-4"><?php echo $major_map[$major] ?? 'Unknown Major'; ?></h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                                <?php foreach ($results as $result): ?>
                                    <div class="result-card border rounded-lg shadow-sm overflow-hidden" id="result-card-<?php echo $result['id']; ?>" data-year="<?php echo $year; ?>" data-major="<?php echo $major; ?>">
                                        <img src="<?php echo htmlspecialchars($result['image_path']); ?>" alt="Exam Result" class="w-full h-48 object-cover">
                                        <div class="p-4">
                                            <p class="font-semibold text-gray-700"><?php echo $semester_map[$result['semester']] ?? 'Unknown Semester'; ?></p>
                                            <p class="text-xs text-gray-400 mt-1">ID: <?php echo $result['id']; ?> | Uploaded: <?php echo date('d M Y', strtotime($result['uploaded_at'])); ?></p>
                                            <div class="mt-4 flex gap-2">
                                                <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($result)); ?>)" class="flex-1 text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-md transition-colors">Edit</button>
                                                <button onclick="confirmDelete(<?php echo $result['id']; ?>)" class="flex-1 text-sm bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-md transition-colors">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
             <div id="no-results-message" class="hidden bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
                <p>No results match the selected filters.</p>
            </div>
        <?php endif; ?>
    </div>
  </main>

  <!-- Modals (Edit and Delete) -->
  <!-- Edit Modal -->
  <div id="editModal" class="modal-backdrop">
    <div class="modal-content">
        <h2 class="text-2xl font-bold mb-4">Edit Result</h2>
        <form id="editForm">
            <input type="hidden" id="edit-id" name="id">
            <div class="space-y-4">
                <div>
                    <label for="edit-year" class="block text-sm font-medium text-gray-700">Year</label>
                    <select id="edit-year" name="year" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <?php foreach ($year_map as $key => $value) echo "<option value='{$key}'>{$value}</option>"; ?>
                    </select>
                </div>
                <div>
                    <label for="edit-semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <select id="edit-semester" name="semester" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                         <?php foreach ($semester_map as $key => $value) echo "<option value='{$key}'>{$value}</option>"; ?>
                    </select>
                </div>
                <div>
                    <label for="edit-major" class="block text-sm font-medium text-gray-700">Major</label>
                    <select id="edit-major" name="major" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <?php foreach ($major_map as $key => $value) echo "<option value='{$key}'>{$value}</option>"; ?>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md">Cancel</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-md">Save Changes</button>
            </div>
        </form>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="modal-backdrop">
    <div class="modal-content text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        <h3 class="text-xl font-bold mt-4">Are you sure?</h3>
        <p class="text-gray-600 mt-2">Do you really want to delete this result? This process cannot be undone.</p>
        <div class="mt-6 flex justify-center gap-4">
            <button id="cancelDelete" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-6 rounded-md">Cancel</button>
            <button id="confirmDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-md">Delete</button>
        </div>
    </div>
  </div>

<script>
    const filterYear = document.getElementById('filter-year');
    const filterMajor = document.getElementById('filter-major');
    const noResultsMessage = document.getElementById('no-results-message');

    function filterResults() {
        const selectedYear = filterYear.value;
        const selectedMajor = filterMajor.value;
        let resultsFound = false;

        document.querySelectorAll('.year-group').forEach(yearGroup => {
            const year = yearGroup.dataset.year;
            let yearHasVisibleMajors = false;
            
            yearGroup.querySelectorAll('.major-group').forEach(majorGroup => {
                const major = majorGroup.dataset.major;
                let majorHasVisibleCards = false;

                majorGroup.querySelectorAll('.result-card').forEach(card => {
                    const cardYear = card.dataset.year;
                    const cardMajor = card.dataset.major;
                    const yearMatch = (selectedYear === 'all' || selectedYear === cardYear);
                    const majorMatch = (selectedMajor === 'all' || selectedMajor === cardMajor);

                    if (yearMatch && majorMatch) {
                        card.style.display = 'block';
                        majorHasVisibleCards = true;
                        resultsFound = true;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (majorHasVisibleCards) {
                    majorGroup.style.display = 'block';
                    yearHasVisibleMajors = true;
                } else {
                    majorGroup.style.display = 'none';
                }
            });

            if (yearHasVisibleMajors) {
                yearGroup.style.display = 'block';
            } else {
                yearGroup.style.display = 'none';
            }
        });

        noResultsMessage.style.display = resultsFound ? 'none' : 'block';
    }

    filterYear.addEventListener('change', filterResults);
    filterMajor.addEventListener('change', filterResults);
    
    // --- Modal and API call scripts ---
    const editModal = document.getElementById('editModal');
    const deleteModal = document.getElementById('deleteModal');
    const statusMessage = document.getElementById('status-message');

    // Edit Modal Functions
    function openEditModal(result) {
        document.getElementById('edit-id').value = result.id;
        document.getElementById('edit-year').value = result.year;
        document.getElementById('edit-semester').value = result.semester;
        document.getElementById('edit-major').value = result.major;
        editModal.classList.add('visible');
    }

    function closeEditModal() {
        editModal.classList.remove('visible');
    }

    document.getElementById('editForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'update');

        const response = await fetch('mrhandler.php', { method: 'POST', body: formData });
        const result = await response.json();
        
        showStatus(result.message, result.success);
        if (result.success) {
            setTimeout(() => location.reload(), 1500);
        }
        closeEditModal();
    });

    // Delete Modal Functions
    let deleteId = null;
    function confirmDelete(id) {
        deleteId = id;
        deleteModal.classList.add('visible');
    }

    document.getElementById('cancelDelete').addEventListener('click', () => {
        deleteModal.classList.remove('visible');
        deleteId = null;
    });
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', async () => {
        if (!deleteId) return;

        // Hide modal immediately
        deleteModal.classList.remove('visible');

        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', deleteId);

        const response = await fetch('mrhandler.php', { method: 'POST', body: formData });
        const result = await response.json();
        
        showStatus(result.message, result.success);

        if (result.success) {
            const cardToRemove = document.getElementById(`result-card-${deleteId}`);
            if (cardToRemove) {
                const majorGroup = cardToRemove.closest('.major-group');
                cardToRemove.remove(); // Remove the card

                // If the major group has no more cards, remove the major group itself
                if (majorGroup && !majorGroup.querySelector('.result-card')) {
                    const yearGroup = majorGroup.closest('.year-group');
                    majorGroup.remove();

                    // If the year group has no more major groups, remove the year group
                    if (yearGroup && !yearGroup.querySelector('.major-group')) {
                        yearGroup.remove();
                    }
                }
            }
        }
        
        // Reset the ID after operation
        deleteId = null;
    });

    // Universal status message function
    function showStatus(message, isSuccess) {
        statusMessage.textContent = message;
        statusMessage.classList.remove('hidden');
        statusMessage.className = isSuccess 
            ? 'mb-4 p-3 rounded-lg text-center bg-green-100 text-green-800'
            : 'mb-4 p-3 rounded-lg text-center bg-red-100 text-red-800';
        setTimeout(() => statusMessage.classList.add('hidden'), 5000);
    }

    // Initial filter on page load
    document.addEventListener('DOMContentLoaded', filterResults);
</script>
</body>
</html>
