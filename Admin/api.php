<?php
/**
 * api.php
 *
 * Handles all backend data manipulation (Create, Update, Delete) using PDO.
 * This script now handles both JSON (for delete) and multipart/form-data (for add/update with photo).
 * Added output buffering to prevent corrupted JSON responses.
 */

ob_start(); // Start output buffering

header('Content-Type: application/json');
require_once '../Rform/db.php'; // Provides the $pdo object

// Determine action from POST data (for forms with files) or JSON payload (for simple requests)
$action = $_POST['action'] ?? (json_decode(file_get_contents('php://input'), true)['action'] ?? null);
$response = ['status' => 'error', 'message' => 'Invalid Request'];

// Define both file system path for PHP and URL path for browser
$fileSystemUploadDir = '../rform/uploads/';
$urlUploadDir = '/rform/uploads/'; // Root-relative URL path

if (!is_dir($fileSystemUploadDir)) {
    // The `true` parameter creates nested directories if they don't exist.
    if (!mkdir($fileSystemUploadDir, 0775, true)) {
        http_response_code(500);
        $response['message'] = 'Failed to create uploads directory.';
        echo json_encode($response);
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        switch ($action) {
            case 'add':
            case 'update':
                // For add/update, data comes from $_POST because of FormData
                $student = $_POST;
                
                // Basic validation
                if (empty($student['student_name_en']) || empty($student['seat_no'])) {
                    $response['message'] = 'Required fields are missing.';
                    break;
                }

                $pdo->beginTransaction();

                // --- Handle Photo Upload ---
                $photoUrl = null; // This will be the URL path for the database
                if ($action === 'update') {
                    // Fetch existing photo URL to keep it if no new photo is uploaded
                    $stmt = $pdo->prepare("SELECT photo_url FROM students WHERE student_id = ?");
                    $stmt->execute([$student['student_id']]);
                    $photoUrl = $stmt->fetchColumn();
                }

                if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] === UPLOAD_ERR_OK) {
                    // If an old photo exists, delete it from the file system.
                    if ($action === 'update' && !empty($photoUrl)) {
                        $oldFileName = basename($photoUrl);
                        $oldFileSystemPath = $fileSystemUploadDir . $oldFileName;
                        if (file_exists($oldFileSystemPath)) {
                            unlink($oldFileSystemPath);
                        }
                    }
                    
                    // Sanitize filename and create a unique name
                    $fileName = uniqid() . '-' . basename(preg_replace("/[^a-zA-Z0-9\.\-\_]/", "", $_FILES['student_photo']['name']));
                    $newFileSystemPath = $fileSystemUploadDir . $fileName;

                    if (move_uploaded_file($_FILES['student_photo']['tmp_name'], $newFileSystemPath)) {
                        // Store the web-accessible, root-relative URL path in the database
                        $photoUrl = $urlUploadDir . $fileName; 
                    } else {
                        throw new Exception('Failed to move uploaded file.');
                    }
                }

                if ($action === 'add') {
                     $sqlStudent = "INSERT INTO students (
                        year, academic_year, seat_no, entry_year, student_email, 
                        dormitory_preference, student_name_mm, student_name_en, 
                        student_race, student_religion, student_nrc, student_dob, 
                        student_birthplace, state_region, township, student_phone, 
                        student_address, photo_url, date
                    ) VALUES (
                        :year, :academic_year, :seat_no, :entry_year, :student_email, 
                        :dormitory_preference, :student_name_mm, :student_name_en, 
                        :student_race, :student_religion, :student_nrc, :student_dob, 
                        :student_birthplace, :state_region, :township, :student_phone, 
                        :student_address, :photo_url, CURDATE()
                    )";
                    $stmtStudent = $pdo->prepare($sqlStudent);
                } else { // update
                    $sqlStudent = "UPDATE students SET 
                        year = :year, academic_year = :academic_year, seat_no = :seat_no, entry_year = :entry_year, student_email = :student_email, 
                        dormitory_preference = :dormitory_preference, student_name_mm = :student_name_mm, student_name_en = :student_name_en, 
                        student_race = :student_race, student_religion = :student_religion, student_nrc = :student_nrc, student_dob = :student_dob, 
                        student_birthplace = :student_birthplace, state_region = :state_region, township = :township, student_phone = :student_phone, 
                        student_address = :student_address, photo_url = :photo_url 
                        WHERE student_id = :student_id";
                    $stmtStudent = $pdo->prepare($sqlStudent);
                    $stmtStudent->bindValue(':student_id', $student['student_id']);
                }
                
                // Bind values
                $stmtStudent->bindValue(':year', $student['year'] ?? null);
                $stmtStudent->bindValue(':academic_year', $student['academic_year'] ?? null);
                $stmtStudent->bindValue(':seat_no', $student['seat_no'] ?? null);
                $stmtStudent->bindValue(':entry_year', $student['entry_year'] ?? null);
                $stmtStudent->bindValue(':student_email', $student['student_email'] ?? null);
                $stmtStudent->bindValue(':dormitory_preference', isset($student['dormitory_preference']) ? 1 : 0);
                $stmtStudent->bindValue(':student_name_mm', $student['student_name_mm'] ?? null);
                $stmtStudent->bindValue(':student_name_en', $student['student_name_en'] ?? null);
                $stmtStudent->bindValue(':student_race', $student['student_race'] ?? null);
                $stmtStudent->bindValue(':student_religion', $student['student_religion'] ?? null);
                $stmtStudent->bindValue(':student_nrc', $student['student_nrc'] ?? null);
                $stmtStudent->bindValue(':student_dob', empty($student['student_dob']) ? null : $student['student_dob']);
                $stmtStudent->bindValue(':student_birthplace', $student['student_birthplace'] ?? null);
                $stmtStudent->bindValue(':state_region', $student['state_region'] ?? null);
                $stmtStudent->bindValue(':township', $student['township'] ?? null);
                $stmtStudent->bindValue(':student_phone', $student['student_phone'] ?? null);
                $stmtStudent->bindValue(':student_address', $student['student_address'] ?? null);
                $stmtStudent->bindValue(':photo_url', $photoUrl);
                $stmtStudent->execute();

                $student_id = ($action === 'add') ? $pdo->lastInsertId() : $student['student_id'];

                // Upsert father/mother info (same logic as your original file)
                foreach (['father', 'mother'] as $parent) {
                    $stmtCheck = $pdo->prepare("SELECT {$parent}_id FROM {$parent}s WHERE student_id = ?");
                    $stmtCheck->execute([$student_id]);
                    $params = [
                        $student["{$parent}_name_mm"] ?? null, $student["{$parent}_name_en"] ?? null, $student["{$parent}_race"] ?? null,
                        $student["{$parent}_religion"] ?? null, $student["{$parent}_nrc"] ?? null, $student["{$parent}_phone"] ?? null,
                        $student["{$parent}_info"] ?? null, empty($student["{$parent}_deceased_year"]) ? null : $student["{$parent}_deceased_year"],
                        $student["{$parent}_address"] ?? null, $student_id
                    ];
                    if ($stmtCheck->fetch()) {
                        $sql = "UPDATE {$parent}s SET {$parent}_name_mm = ?, {$parent}_name_en = ?, {$parent}_race = ?, {$parent}_religion = ?, {$parent}_nrc = ?, {$parent}_phone = ?, {$parent}_info = ?, {$parent}_deceased_year = ?, {$parent}_address = ? WHERE student_id = ?";
                    } else {
                        $sql = "INSERT INTO {$parent}s ({$parent}_name_mm, {$parent}_name_en, {$parent}_race, {$parent}_religion, {$parent}_nrc, {$parent}_phone, {$parent}_info, {$parent}_deceased_year, {$parent}_address, student_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    }
                    $stmtParent = $pdo->prepare($sql);
                    $stmtParent->execute($params);
                }

                $pdo->commit();
                
                // Fetch the full record to return
                $fullRecordSql = "SELECT s.*, f.*, m.* FROM students s LEFT JOIN fathers f ON s.student_id = f.student_id LEFT JOIN mothers m ON s.student_id = m.student_id WHERE s.student_id = ?";
                $stmtFetch = $pdo->prepare($fullRecordSql);
                $stmtFetch->execute([$student_id]);
                $finalStudent = $stmtFetch->fetch(PDO::FETCH_ASSOC);

                $response = ['status' => 'success', 'student' => $finalStudent];
                break;

            case 'delete':
                $data = json_decode(file_get_contents('php://input'), true);
                $ids = $data['ids'] ?? [];
                if (!empty($ids) && is_array($ids)) {
                    $sanitized_ids = array_map('intval', $ids);
                    $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                    
                    // First, get photo URLs to delete files
                    $stmtSelect = $pdo->prepare("SELECT photo_url FROM students WHERE student_id IN ($placeholders)");
                    $stmtSelect->execute($sanitized_ids);
                    $photoUrls = $stmtSelect->fetchAll(PDO::FETCH_COLUMN);

                    // Then, delete student records (cascading should handle parents)
                    $sql = "DELETE FROM students WHERE student_id IN ($placeholders)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($sanitized_ids);
                    
                    // Finally, delete the actual files from the file system
                    foreach ($photoUrls as $url) {
                        if (!empty($url)) {
                           $fileName = basename($url);
                           $fileSystemPath = $fileSystemUploadDir . $fileName;
                           if (file_exists($fileSystemPath)) {
                               unlink($fileSystemPath);
                           }
                        }
                    }
                    
                    $response = ['status' => 'success', 'message' => $stmt->rowCount() . ' student(s) deleted.'];
                } else {
                    $response['message'] = 'No student IDs provided for deletion.';
                }
                break;
                
            // Keep your other cases like delete_feedback if needed
        }
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        http_response_code(500);
        $response['message'] = 'Server error: ' . $e->getMessage();
    }
}

ob_end_clean(); // Clean any stray output
echo json_encode($response);
$pdo = null; // Close connection
?>

