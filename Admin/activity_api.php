<?php
// Set headers for JSON response and error reporting
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0); // Do not display errors to the client
ini_set('log_errors', 1); // Log errors to a file

// --- UPDATED FILE PATHS ---
$dataFile = 'gallery_data.json';
// The new upload directory is at the root level, one level up from this file's directory (Admin)
$uploadDir = '../uploads_activity/';

// --- DIRECTORY AND FILE SETUP ---
// Ensure the upload directory exists and is writable
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0775, true)) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create upload directory. Check permissions on the root folder.']);
        exit;
    }
}
// Ensure the data file exists and is writable
if (!file_exists($dataFile)) {
    if (file_put_contents($dataFile, json_encode([])) === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create data file. Check permissions on the Admin folder.']);
        exit;
    }
}

// --- HELPER FUNCTIONS ---
function getGalleryData($file) {
    $data = file_get_contents($file);
    return json_decode($data, true) ?: [];
}

function saveGalleryData($file, $data) {
    // Sort data so newest items appear first in the admin panel
    usort($data, function($a, $b) {
        return (isset($b['timestamp']) ? $b['timestamp'] : 0) <=> (isset($a['timestamp']) ? $a['timestamp'] : 0);
    });
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// --- REQUEST HANDLING ---
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode(getGalleryData($dataFile));
        break;

    case 'POST':
        // --- Validation ---
        if (!isset($_FILES['image']) || empty($_POST['title_en']) || empty($_POST['title_my']) || empty($_POST['description_en']) || empty($_POST['description_my']) || empty($_POST['tag'])) {
            http_response_code(400);
            echo json_encode(['error' => 'All fields are required.']);
            exit;
        }

        $file = $_FILES['image'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            http_response_code(500);
            echo json_encode(['error' => 'File upload error code: ' . $file['error']]);
            exit;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid file type. Only JPG, PNG, and WEBP are allowed.']);
            exit;
        }
        
        if ($file['size'] > 5 * 1024 * 1024) { // 5 MB
            http_response_code(400);
            echo json_encode(['error' => 'File size exceeds 5MB limit.']);
            exit;
        }

        // --- File Processing ---
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueName = uniqid('img_', true) . '.' . $extension;
        $destination = $uploadDir . $uniqueName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $data = getGalleryData($dataFile);
            $newItem = [
                'id' => uniqid(),
                // --- UPDATED IMAGE PATH ---
                // Path is now relative to project root, without leading slash
                'image_path' => 'uploads_activity/' . $uniqueName,
                'tag' => htmlspecialchars($_POST['tag']),
                'title' => [
                    'en' => htmlspecialchars($_POST['title_en']),
                    'my' => htmlspecialchars($_POST['title_my'])
                ],
                'description' => [
                    'en' => htmlspecialchars($_POST['description_en']),
                    'my' => htmlspecialchars($_POST['description_my'])
                ],
                'timestamp' => time() // For sorting
            ];
            $data[] = $newItem;
            saveGalleryData($dataFile, $data);
            echo json_encode(['success' => true, 'item' => $newItem]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Could not save the uploaded file.']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing item ID.']);
            exit;
        }

        $idToDelete = $input['id'];
        $data = getGalleryData($dataFile);
        $itemToDelete = null;
        $found = false;

        $newData = array_filter($data, function($item) use ($idToDelete, &$found, &$itemToDelete) {
            if (isset($item['id']) && $item['id'] === $idToDelete) {
                $found = true;
                $itemToDelete = $item;
                return false; // Remove item from array
            }
            return true;
        });

        if ($found && $itemToDelete) {
            // Delete the physical image file from the root uploads_activity folder
            $filePath = '../' . $itemToDelete['image_path'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            saveGalleryData($dataFile, array_values($newData)); // Re-index array
            echo json_encode(['success' => true]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Item not found.']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}
?>

