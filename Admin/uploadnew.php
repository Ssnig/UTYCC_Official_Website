<?php

// You can add session validation here to ensure only logged-in admins can access this page.
// session_start();
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: login.php');
//     exit;
// }


// require_once '../Rform/db.php';

header('Content-Type: application/json');

$uploadsDir = 'uploads/';
$dataFile = 'data/results_db.json';

// Create directories if they don't exist
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0777, true);
}
if (!is_dir('data')) {
    mkdir('data', 0777, true);
}

// Check if all necessary POST data and file are present
if (!isset($_POST['year']) || !isset($_POST['semester']) || !isset($_POST['major']) || !isset($_FILES['result_image'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required data.']);
    exit;
}

$year = $_POST['year'];
$semester = $_POST['semester'];
$major = $_POST['major'];
$file = $_FILES['result_image'];

// Validate file
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 5 * 1024 * 1024; // 5MB

if (!in_array($file['type'], $allowedTypes)) {
    echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.']);
    exit;
}

if ($file['size'] > $maxFileSize) {
    echo json_encode(['success' => false, 'message' => 'File size exceeds the 5MB limit.']);
    exit;
}

// Generate a unique filename to prevent conflicts
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$fileName = uniqid() . '.' . $extension;
$destination = $uploadsDir . $fileName;

// Move the uploaded file to the destination folder
if (!move_uploaded_file($file['tmp_name'], $destination)) {
    echo json_encode(['success' => false, 'message' => 'Failed to move the uploaded file.']);
    exit;
}

// Prepare data to save to JSON file
$newResult = [
    'year' => $year,
    'semester' => $semester,
    'major' => $major,
    'image_path' => $destination,
    'uploaded_at' => date('Y-m-d H:i:s')
];

// Read existing data from the JSON file
$resultsData = [];
if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $resultsData = json_decode($json, true);
    if ($resultsData === null) {
        // Handle malformed JSON
        $resultsData = [];
    }
}

// Add the new result to the data
$resultsData[] = $newResult;

// Write the updated data back to the JSON file
if (file_put_contents($dataFile, json_encode($resultsData, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'File uploaded and data saved successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save results data.']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Result Upload</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Upload Result Image</h2>
    <div id="status-message" class="hidden"></div>
    <form id="upload-form" action="upload.php" method="POST" enctype="multipart/form-data">
      <div class="mb-4">
        <label for="year" class="block text-gray-700 font-bold mb-2">Year</label>
        <input type="text" id="year" name="year" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      </div>
      <div class="mb-4">
        <label for="semester" class="block text-gray-700 font-bold mb-2">Semester</label>
        <input type="text" id="semester" name="semester" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      </div>
      <div class="mb-4">
        <label for="major" class="block text-gray-700 font-bold mb-2">Major</label>
        <input type="text" id="major" name="major" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
      </div>
      <div class="mb-6">
        <label for="result_image" class="block text-gray-700 font-bold mb-2">Result Image</label>
        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition-all duration-300">
            <input type="file" id="result_image" name="result_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/jpeg, image/png, image/gif" required>
            <div id="upload-prompt" class="text-gray-500">
                Drag & drop your image here, or click to select a file.
            </div>
            <div id="image-preview" class="hidden">
                <img id="preview-image" src="" alt="Image Preview" class="max-h-48 mx-auto rounded-lg">
            </div>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <button id="submit-btn" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full flex justify-center items-center">
            <span id="btn-text">Upload Result</span>
            <svg id="btn-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadForm = document.getElementById('upload-form');
        const fileInput = document.getElementById('result_image');
        const imagePreview = document.getElementById('image-preview');
        const previewImage = document.getElementById('preview-image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const statusMessage = document.getElementById('status-message');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnSpinner = document.getElementById('btn-spinner');

        // Handle file input change to show image preview
        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('hidden');
                uploadPrompt.classList.remove('hidden');
            }
        });

        // Handle form submission
        uploadForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            statusMessage.classList.add('hidden');

            const formData = new FormData(uploadForm);
            
            try {
                // Send the data to the backend script
                const response = await fetch('handle_upload.php', {
                    method: 'POST',
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                
                if (result.success) {
                    showStatusMessage(result.message, 'success');
                    uploadForm.reset();
                    imagePreview.classList.add('hidden');
                    uploadPrompt.classList.remove('hidden');
                } else {
                    throw new Error(result.message);
                }

            } catch (error) {
                showStatusMessage(error.message, 'error');
            } finally {
                // Restore button state
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnSpinner.classList.add('hidden');
            }
        });

        function showStatusMessage(message, type) {
            statusMessage.textContent = message;
            statusMessage.className = `p-4 rounded-lg mb-6 ${type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
            statusMessage.classList.remove('hidden');
        }
    });
  </script>
</body>
</html>