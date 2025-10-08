<?php
/**
 * activity_api.php (with Debug Logging)
 *
 * This version includes logging to a 'debug_log.txt' file to diagnose update/delete issues on the server.
 */

// Simple logging function to write messages to a file.
function write_log($message) {
    // Log message to a file named debug_log.txt in the same directory (admin).
    // Ensure the 'admin' directory has write permissions (e.g., 755).
    file_put_contents('debug_log.txt', date('[Y-m-d H:i:s] ') . $message . "\n", FILE_APPEND);
}

ob_start(); // Start output buffering.

// Clear previous log on a new day or if it gets too big, to keep it manageable.
if (file_exists('debug_log.txt') && filesize('debug_log.txt') > 2000000) { // 2MB
    unlink('debug_log.txt');
}

write_log("--- New API Request ---");

require_once 'auth_check.php';
header('Content-Type: application/json');
// [FIXED] Changed folder name to all lowercase for hosting compatibility.
require_once '../Rform/db.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = null;
$response = ['status' => 'error', 'message' => 'Invalid Request'];
$inputData = []; // Variable to hold decoded JSON data

if ($requestMethod === 'GET') {
    $action = $_GET['action'] ?? null;
} elseif ($requestMethod === 'POST') {
    if (isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
        $inputData = json_decode(file_get_contents("php://input"), true);
        $action = $inputData['action'] ?? null;
    } else {
        $action = $_POST['action'] ?? null;
    }
}

write_log("Request Method: $requestMethod | Action: " . ($action ?? 'Not specified'));

if (!$action) {
    http_response_code(400);
    $response['message'] = 'No action specified.';
    echo json_encode($response);
    exit;
}

// [FIXED] Changed folder name to all lowercase for hosting compatibility.
$fileSystemUploadDir = '../uploads_activity/';
$urlUploadDir = '/uploads_activity/';

// ... (Directory creation logic remains the same) ...

try {
    switch ($action) {
        case 'add_activity':
        case 'update_activity':
            write_log("Entering action: $action");
            if ($requestMethod !== 'POST') throw new Exception('Invalid request method.');

            $data = $_POST;
            if (empty($data['title_en']) || empty($data['title_my']) || empty($data['activity_date'])) {
                throw new Exception('Required fields are missing.');
            }

            $imageUrl = null;
            if ($action === 'update_activity') {
                write_log("UPDATE: Fetching existing image for activity_id: " . $data['activity_id']);
                $stmt = $pdo->prepare("SELECT image_url FROM activities WHERE activity_id = ?");
                $stmt->execute([$data['activity_id']]);
                $imageUrl = $stmt->fetchColumn();
                write_log("UPDATE: Found existing image_url: " . ($imageUrl ?: 'None'));
            }

            if (isset($_FILES['activity_photo']) && $_FILES['activity_photo']['error'] === UPLOAD_ERR_OK) {
                write_log("UPDATE: New photo uploaded: " . $_FILES['activity_photo']['name']);
                if ($action === 'update_activity' && !empty($imageUrl)) {
                    $oldFileSystemPath = $fileSystemUploadDir . basename($imageUrl);
                    write_log("UPDATE: Attempting to delete old file at: " . $oldFileSystemPath);

                    if (file_exists($oldFileSystemPath)) {
                        write_log("UPDATE: Old file exists. Trying to unlink...");
                        if (unlink($oldFileSystemPath)) {
                            write_log("UPDATE: [SUCCESS] Unlinked old file.");
                        } else {
                            $error = error_get_last();
                            write_log("UPDATE: [FATAL ERROR] FAILED to unlink old file. PHP Error: " . ($error['message'] ?? 'N/A'));
                            // Optional: throw an exception to stop the process if deleting the old file is critical
                            // throw new Exception('Could not delete the old image file. Check server permissions.');
                        }
                    } else {
                        write_log("UPDATE: Old file does not exist at path. Skipping unlink.");
                    }
                }
                
                $fileName = 'activity-' . uniqid() . '-' . basename(preg_replace("/[^a-zA-Z0-9\.\-\_]/", "", $_FILES['activity_photo']['name']));
                $newFileSystemPath = $fileSystemUploadDir . $fileName;

                if (move_uploaded_file($_FILES['activity_photo']['tmp_name'], $newFileSystemPath)) {
                    $imageUrl = $urlUploadDir . $fileName;
                    write_log("UPDATE: New file moved successfully to: " . $newFileSystemPath);
                } else {
                    throw new Exception('Failed to move uploaded file.');
                }
            }
            
            // ... (SQL INSERT/UPDATE logic remains the same) ...
            if ($action === 'add_activity') {
                 if (!$imageUrl) throw new Exception('An image is required for a new activity.');
                $sql = "INSERT INTO activities (title_en, title_my, description_en, description_my, activity_date, image_url) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$data['title_en'], $data['title_my'], $data['description_en'], $data['description_my'], $data['activity_date'], $imageUrl]);
                $newId = $pdo->lastInsertId();
            } else { // update_activity
                $sql = "UPDATE activities SET title_en = ?, title_my = ?, description_en = ?, description_my = ?, activity_date = ?";
                $params = [$data['title_en'], $data['title_my'], $data['description_en'], $data['description_my'], $data['activity_date']];
                if (isset($_FILES['activity_photo']) && $_FILES['activity_photo']['error'] === UPLOAD_ERR_OK && $imageUrl) {
                    $sql .= ", image_url = ?";
                    $params[] = $imageUrl;
                }
                $sql .= " WHERE activity_id = ?";
                $params[] = $data['activity_id'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                $newId = $data['activity_id'];
            }
            write_log("SQL operation for '$action' completed.");

            $stmtFetch = $pdo->prepare("SELECT * FROM activities WHERE activity_id = ?");
            $stmtFetch->execute([$newId]);
            $finalActivity = $stmtFetch->fetch(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'activity' => $finalActivity];
            break;

        case 'delete_activity':
            $ids = $inputData['ids'] ?? [];
            write_log("DELETE: Received request to delete IDs: " . implode(', ', $ids));
            if (!empty($ids) && is_array($ids)) {
                $sanitized_ids = array_map('intval', $ids);
                $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                
                $stmtSelect = $pdo->prepare("SELECT image_url FROM activities WHERE activity_id IN ($placeholders)");
                $stmtSelect->execute($sanitized_ids);
                $imageUrls = $stmtSelect->fetchAll(PDO::FETCH_COLUMN);
                write_log("DELETE: Found image URLs to delete: " . implode(', ', $imageUrls));

                $sql = "DELETE FROM activities WHERE activity_id IN ($placeholders)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($sanitized_ids);
                
                foreach ($imageUrls as $url) {
                    if (!empty($url)) {
                       $fileSystemPath = $fileSystemUploadDir . basename($url);
                       write_log("DELETE: Attempting to delete file at: " . $fileSystemPath);
                       if (file_exists($fileSystemPath)) {
                           if (unlink($fileSystemPath)) {
                               write_log("DELETE: [SUCCESS] Unlinked file.");
                           } else {
                               $error = error_get_last();
                               write_log("DELETE: [FATAL ERROR] FAILED to unlink file. PHP Error: " . ($error['message'] ?? 'N/A'));
                           }
                       } else {
                           write_log("DELETE: File not found at path. Skipping.");
                       }
                    }
                }
                $response = ['status' => 'success', 'message' => $stmt->rowCount() . ' activity(s) deleted.'];
            } else {
                write_log("DELETE: No valid IDs provided.");
                $response['message'] = 'No activity IDs provided for deletion.';
            }
            break;
            
        default:
             http_response_code(400);
             $response['message'] = 'Invalid action specified.';
             write_log("Error: Invalid action specified - '$action'");
             break;
    }
} catch (Exception $e) {
    http_response_code(500);
    $response['message'] = $e->getMessage();
    write_log("EXCEPTION CAUGHT: " . $e->getMessage());
}

ob_end_clean();
echo json_encode($response);
$pdo = null;
?>

