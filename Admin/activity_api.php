<?php
/**
 * activity_api.php
 *
 * Handles all backend data manipulation for activities (Create, Read, Update, Delete).
 * This script handles GET for fetching data and POST for modifications.
 */

ob_start(); // Start output buffering to prevent any stray output from breaking JSON.

header('Content-Type: application/json');
require_once '../Rform/db.php'; // Provides the $pdo database connection object.

$requestMethod = $_SERVER['REQUEST_METHOD'];
$action = null;
$response = ['status' => 'error', 'message' => 'Invalid Request'];

// Determine the action based on the request method.
if ($requestMethod === 'GET') {
    $action = $_GET['action'] ?? null;
} elseif ($requestMethod === 'POST') {
    // Action can come from a multipart form or a JSON payload.
    $action = $_POST['action'] ?? (json_decode(file_get_contents('php://input'), true)['action'] ?? null);
}

// Exit if no action is specified to prevent invalid requests.
if (!$action) {
    http_response_code(400); // Bad Request
    $response['message'] = 'No action specified.';
    echo json_encode($response);
    exit;
}

// Define upload directories.
$fileSystemUploadDir = '../uploads_activity/';
$urlUploadDir = '/uploads_activity/'; 

// Create the uploads directory if it doesn't exist.
if (!is_dir($fileSystemUploadDir)) {
    if (!mkdir($fileSystemUploadDir, 0775, true)) {
        http_response_code(500);
        $response['message'] = 'Failed to create uploads directory.';
        echo json_encode($response);
        exit;
    }
}

try {
    switch ($action) {
        // Case to fetch all activities (for the public page).
        case 'get_activities':
            if ($requestMethod !== 'GET') throw new Exception('Invalid request method for this action.');
            
            $stmt = $pdo->query("SELECT activity_id, image_url, title_en, title_my, description_en, description_my, activity_date FROM activities ORDER BY activity_date DESC");
            $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'activities' => $activities];
            break;

        // Cases to add or update an activity.
        case 'add_activity':
        case 'update_activity':
            if ($requestMethod !== 'POST') throw new Exception('Invalid request method for this action.');
            
            $data = $_POST;
            if (empty($data['title_en']) || empty($data['title_my']) || empty($data['activity_date'])) {
                throw new Exception('Required fields (titles and date) are missing.');
            }

            $imageUrl = null;
            // If updating, fetch the existing image URL to potentially replace the file.
            if ($action === 'update_activity') {
                $stmt = $pdo->prepare("SELECT image_url FROM activities WHERE activity_id = ?");
                $stmt->execute([$data['activity_id']]);
                $imageUrl = $stmt->fetchColumn();
            }

            // Handle file upload if a new image is provided.
            if (isset($_FILES['activity_photo']) && $_FILES['activity_photo']['error'] === UPLOAD_ERR_OK) {
                // If updating and an old image exists, delete it.
                if ($action === 'update_activity' && !empty($imageUrl)) {
                    $oldFileSystemPath = $fileSystemUploadDir . basename($imageUrl);
                    if (file_exists($oldFileSystemPath)) unlink($oldFileSystemPath);
                }
                
                // Sanitize and create a unique filename.
                $fileName = 'activity-' . uniqid() . '-' . basename(preg_replace("/[^a-zA-Z0-9\.\-\_]/", "", $_FILES['activity_photo']['name']));
                $newFileSystemPath = $fileSystemUploadDir . $fileName;

                if (move_uploaded_file($_FILES['activity_photo']['tmp_name'], $newFileSystemPath)) {
                    $imageUrl = $urlUploadDir . $fileName;
                } else {
                    throw new Exception('Failed to move uploaded file.');
                }
            }
            
            if ($action === 'add_activity') {
                if (!$imageUrl) throw new Exception('An image is required for a new activity.');
                $sql = "INSERT INTO activities (title_en, title_my, description_en, description_my, activity_date, image_url) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$data['title_en'], $data['title_my'], $data['description_en'], $data['description_my'], $data['activity_date'], $imageUrl]);
                $newId = $pdo->lastInsertId();
            } else { // update_activity
                $sql = "UPDATE activities SET title_en = ?, title_my = ?, description_en = ?, description_my = ?, activity_date = ?";
                $params = [$data['title_en'], $data['title_my'], $data['description_en'], $data['description_my'], $data['activity_date']];
                // Only update the image URL if a new one was uploaded.
                if ($imageUrl) {
                    $sql .= ", image_url = ?";
                    $params[] = $imageUrl;
                }
                $sql .= " WHERE activity_id = ?";
                $params[] = $data['activity_id'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                $newId = $data['activity_id'];
            }

            // Fetch the final record to return to the frontend.
            $stmtFetch = $pdo->prepare("SELECT * FROM activities WHERE activity_id = ?");
            $stmtFetch->execute([$newId]);
            $finalActivity = $stmtFetch->fetch(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'activity' => $finalActivity];
            break;

        // Case to delete one or more activities.
        case 'delete_activity':
            if ($requestMethod !== 'POST') throw new Exception('Invalid request method for this action.');
            
            $data = json_decode(file_get_contents('php://input'), true);
            $ids = $data['ids'] ?? [];
            if (!empty($ids) && is_array($ids)) {
                $sanitized_ids = array_map('intval', $ids);
                $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                
                // First, get the image URLs to delete the files from the server.
                $stmtSelect = $pdo->prepare("SELECT image_url FROM activities WHERE activity_id IN ($placeholders)");
                $stmtSelect->execute($sanitized_ids);
                $imageUrls = $stmtSelect->fetchAll(PDO::FETCH_COLUMN);

                // Then, delete the records from the database.
                $sql = "DELETE FROM activities WHERE activity_id IN ($placeholders)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($sanitized_ids);
                
                // Finally, delete the actual image files.
                foreach ($imageUrls as $url) {
                    if (!empty($url)) {
                       $fileSystemPath = $fileSystemUploadDir . basename($url);
                       if (file_exists($fileSystemPath)) unlink($fileSystemPath);
                    }
                }
                $response = ['status' => 'success', 'message' => $stmt->rowCount() . ' activity(s) deleted.'];
            } else {
                $response['message'] = 'No activity IDs provided for deletion.';
            }
            break;
            
        default:
             http_response_code(400); // Bad Request
             $response['message'] = 'Invalid action specified.';
             break;
    }
} catch (Exception $e) {
    if ($pdo && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    $response['message'] = $e->getMessage();
}

ob_end_clean(); // Clean the output buffer.
echo json_encode($response); // Send the final JSON response.
$pdo = null; // Close the database connection.
?>

