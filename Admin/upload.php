<?php


require_once '../Rform/db.php';

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
if (file_put_contents($dataFile, json_encode($resultsData, JSON_PRETTY_PRINT)) === false) {
    // If saving fails, delete the uploaded image
    unlink($destination);
    echo json_encode(['success' => false, 'message' => 'Failed to save result information.']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Result uploaded and saved successfully!']);

?>
