<?php
/**
 * api.php
 *
 * Handles all backend data manipulation (Create, Update, Delete, Import) using PDO.
 * This script now handles both JSON and multipart/form-data.
 * Added output buffering to prevent corrupted JSON responses.
 */

ob_start(); // Start output buffering
require_once 'auth_check.php';

header('Content-Type: application/json');
require_once '../Rform/db.php'; // Provides the $pdo object
require_once 'send_email.php'; // Include the new email sending function

// Determine action from POST data (for forms with files) or JSON payload (for simple requests)
$action = $_POST['action'] ?? (json_decode(file_get_contents('php://input'), true)['action'] ?? null);
$response = ['status' => 'error', 'message' => 'Invalid Request'];

// Define a helper function to process student data for consistent output
function processStudentRow($studentRow) {
    if (!$studentRow) return null;

    $studentRow['student_id'] = (int)$studentRow['student_id'];
    $studentRow['dormitory_preference'] = (bool)$studentRow['dormitory_preference'];
    if(isset($studentRow['father_deceased_year']) && $studentRow['father_deceased_year']) {
        $studentRow['father_deceased_year'] = (int)$studentRow['father_deceased_year'];
    }
    if(isset($studentRow['mother_deceased_year']) && $studentRow['mother_deceased_year']) {
        $studentRow['mother_deceased_year'] = (int)$studentRow['mother_deceased_year'];
    }
    if (isset($studentRow['preferences'])) {
        $studentRow['preferences'] = $studentRow['preferences'] ? json_decode($studentRow['preferences'], true) : null;
    }
    // Correctly construct the full URL for the photo
    if (isset($studentRow['photo_url']) && !empty($studentRow['photo_url'])) {
        // Assuming photo_url is stored like '/uploads/filename.jpg'
        // And the script is in 'admin' directory, so we go up one level.
        $studentRow['photo_url'] = '../Rform' . $studentRow['photo_url'];
    }
    return $studentRow;
}


$fileSystemUploadDir = __DIR__ . '/../Rform/uploads/';
$urlUploadDir = '/uploads/'; 


if (!is_dir($fileSystemUploadDir)) {
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
                $student = $_POST;
                
                if (empty($student['student_name_en']) || empty($student['seat_no'])) {
                    $response['message'] = 'Required fields are missing.';
                    break;
                }

                $studentIdToExclude = ($action === 'update' && !empty($student['student_id'])) ? $student['student_id'] : 0;

                if (!empty($student['student_nrc'])) {
                    $sqlCheckNrc = "SELECT COUNT(*) FROM students WHERE student_nrc = ? AND student_id != ?";
                    $stmtCheckNrc = $pdo->prepare($sqlCheckNrc);
                    $stmtCheckNrc->execute([$student['student_nrc'], $studentIdToExclude]);
                    if ($stmtCheckNrc->fetchColumn() > 0) {
                        throw new Exception('ဤမှတ်ပုံတင်နံပါတ်သည် အခြားကျောင်းသားတစ်ဦးမှ အသုံးပြုပြီးဖြစ်သည်။');
                    }
                }
                
                if (!empty($student['seat_no'])) {
                    $sqlCheckSeatNo = "SELECT COUNT(*) FROM students WHERE seat_no = ? AND student_id != ?";
                    $stmtCheckSeatNo = $pdo->prepare($sqlCheckSeatNo);
                    $stmtCheckSeatNo->execute([$student['seat_no'], $studentIdToExclude]);
                    if ($stmtCheckSeatNo->fetchColumn() > 0) {
                        throw new Exception('ဤခုံနံပါတ်သည် အခြားကျောင်းသားတစ်ဦးမှ အသုံးပြုပြီးဖြစ်သည်။');
                    }
                }

                $pdo->beginTransaction();

                $photoUrl = null; 
                if ($action === 'update') {
                    $stmt = $pdo->prepare("SELECT photo_url FROM students WHERE student_id = ?");
                    $stmt->execute([$student['student_id']]);
                    $photoUrl = $stmt->fetchColumn();
                }

                if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] === UPLOAD_ERR_OK) {
                    if ($action === 'update' && !empty($photoUrl)) {
                        $oldFileName = basename($photoUrl);
                        $oldFileSystemPath = $fileSystemUploadDir . $oldFileName;
                        if (file_exists($oldFileSystemPath)) {
                            unlink($oldFileSystemPath);
                        }
                    }
                    
                    $fileName = uniqid() . '-' . basename(preg_replace("/[^a-zA-Z0-9\.\-\_]/", "", $_FILES['student_photo']['name']));
                    $newFileSystemPath = $fileSystemUploadDir . $fileName;

                    if (move_uploaded_file($_FILES['student_photo']['tmp_name'], $newFileSystemPath)) {
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
                        student_address, photo_url, date, status
                    ) VALUES (
                        :year, :academic_year, :seat_no, :entry_year, :student_email, 
                        :dormitory_preference, :student_name_mm, :student_name_en, 
                        :student_race, :student_religion, :student_nrc, :student_dob, 
                        :student_birthplace, :state_region, :township, :student_phone, 
                        :student_address, :photo_url, CURDATE(), 'approved'
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
                
                // --- FIX: Correctly fetch all aliased parent columns to avoid name collisions ---
                $fullRecordSql = "SELECT s.*,
                                       f.father_id, f.father_name_mm, f.father_name_en, f.father_race, f.father_religion, f.father_nrc, f.father_phone, f.father_info, f.father_deceased_year, f.father_address,
                                       m.mother_id, m.mother_name_mm, m.mother_name_en, m.mother_race, m.mother_religion, m.mother_nrc, m.mother_phone, m.mother_info, m.mother_deceased_year, m.mother_address
                                FROM students s
                                LEFT JOIN fathers f ON s.student_id = f.student_id
                                LEFT JOIN mothers m ON s.student_id = m.student_id
                                WHERE s.student_id = ?";
                $stmtFetch = $pdo->prepare($fullRecordSql);
                $stmtFetch->execute([$student_id]);
                $finalStudent = $stmtFetch->fetch(PDO::FETCH_ASSOC);

                $response = ['status' => 'success', 'student' => processStudentRow($finalStudent)];
                break;

            case 'approve_students':
                $data = json_decode(file_get_contents('php://input'), true);
                $ids = $data['ids'] ?? [];
                if (!empty($ids) && is_array($ids)) {
                    $sanitized_ids = array_map('intval', $ids);
                    $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                    
                    $sqlFetch = "SELECT student_id, student_name_en, student_email FROM students WHERE student_id IN ($placeholders)";
                    $stmtFetch = $pdo->prepare($sqlFetch);
                    $stmtFetch->execute($sanitized_ids);
                    $students_to_email = $stmtFetch->fetchAll(PDO::FETCH_ASSOC);

                    $sql = "UPDATE students SET status = 'approved' WHERE student_id IN ($placeholders)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($sanitized_ids);
                    $approved_count = $stmt->rowCount();
                    
                    $message = "{$approved_count} student(s) approved. Welcome emails are being sent in the background.";
                    $response = ['status' => 'success', 'message' => $message];
                    
                    if (ob_get_level() > 0) ob_end_clean();
                    
                    header("Connection: close");
                    header("Content-Length: " . strlen(json_encode($response)));
                    header('Content-Type: application/json');

                    echo json_encode($response);
                    
                    if (function_exists('fastcgi_finish_request')) fastcgi_finish_request();
                    else { ob_end_flush(); flush(); }
                    
                    foreach ($students_to_email as $student) {
                        if (isset($student['student_email']) && !empty($student['student_email'])) {
                            sendWelcomeEmail($student['student_name_en'], $student['student_email']);
                            sleep(1); 
                        }
                    }
                    exit();
                } else {
                    $response['message'] = 'No student IDs provided for approval.';
                }
                break;

            case 'delete':
                $data = json_decode(file_get_contents('php://input'), true);
                $ids = $data['ids'] ?? [];
                if (!empty($ids) && is_array($ids)) {
                    $sanitized_ids = array_map('intval', $ids);
                    $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                    
                    $sqlFetch = "SELECT student_id, student_name_en, student_email FROM students WHERE student_id IN ($placeholders)";
                    $stmtFetch = $pdo->prepare($sqlFetch);
                    $stmtFetch->execute($sanitized_ids);
                    $students_to_email_rejection = $stmtFetch->fetchAll(PDO::FETCH_ASSOC);

                    $stmtSelect = $pdo->prepare("SELECT photo_url FROM students WHERE student_id IN ($placeholders)");
                    $stmtSelect->execute($sanitized_ids);
                    $photoUrls = $stmtSelect->fetchAll(PDO::FETCH_COLUMN);

                    $sql = "DELETE FROM students WHERE student_id IN ($placeholders)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($sanitized_ids);
                    $deleted_count = $stmt->rowCount();
                    
                    foreach ($photoUrls as $url) {
                        if (!empty($url)) {
                           $fileName = basename($url);
                           $fileSystemPath = $fileSystemUploadDir . $fileName;
                           if (file_exists($fileSystemPath)) unlink($fileSystemPath);
                        }
                    }
                    
                    $message = "{$deleted_count} student(s) rejected and deleted. Rejection emails are being sent in the background.";
                    $response = ['status' => 'success', 'message' => $message];
                    
                    if (ob_get_level() > 0) ob_end_clean();
                    
                    header("Connection: close");
                    header("Content-Length: " . strlen(json_encode($response)));
                    header('Content-Type: application/json');

                    echo json_encode($response);
                    
                    if (function_exists('fastcgi_finish_request')) fastcgi_finish_request();
                    else { ob_end_flush(); flush(); }
                    
                    foreach ($students_to_email_rejection as $student) {
                        if (isset($student['student_email']) && !empty($student['student_email'])) {
                            sendRejectionEmail($student['student_name_en'], $student['student_email']);
                            sleep(1); 
                        }
                    }
                    exit();
                } else {
                    $response['message'] = 'No student IDs provided for deletion.';
                }
                break;

            case 'import_students':
                $data = json_decode(file_get_contents('php://input'), true);
                $studentsToImport = $data['students'] ?? [];
                $importedStudents = [];
                
                if (empty($studentsToImport)) {
                    $response['message'] = 'No student data provided for import.';
                    break;
                }

                $pdo->beginTransaction();
                try {
                    $stmtFindStudent = $pdo->prepare("SELECT student_id FROM students WHERE seat_no = ?");
                    
                    foreach ($studentsToImport as $s) {
                        if (empty($s['seat_no'])) continue;

                        $stmtFindStudent->execute([$s['seat_no']]);
                        $existingStudentId = $stmtFindStudent->fetchColumn();

                        $studentData = [
                            'year' => $s['year'] ?? null, 'academic_year' => $s['academic_year'] ?? null, 'seat_no' => $s['seat_no'], 'entry_year' => $s['entry_year'] ?? null, 'student_email' => $s['student_email'] ?? null,
                            'dormitory_preference' => (isset($s['dormitory_preference']) && $s['dormitory_preference'] == '1') ? 1 : 0,
                            'student_name_mm' => $s['student_name_mm'] ?? null, 'student_name_en' => $s['student_name_en'] ?? null, 'student_race' => $s['student_race'] ?? null, 'student_religion' => $s['student_religion'] ?? null, 'student_nrc' => $s['student_nrc'] ?? null, 'student_dob' => empty($s['student_dob']) ? null : $s['student_dob'],
                            'student_birthplace' => $s['student_birthplace'] ?? null, 'state_region' => $s['state_region'] ?? null, 'township' => $s['township'] ?? null, 'student_phone' => $s['student_phone'] ?? null, 'student_address' => $s['student_address'] ?? null, 'photo_url' => $s['photo_url'] ?? null,
                            'date' => empty($s['date']) ? date('Y-m-d') : $s['date'], 'status' => 'approved'
                        ];
                        
                        $prefs = [];
                        for ($i=1; $i<=5; $i++) { if (!empty($s["preference$i"])) $prefs[$i] = $s["preference$i"]; }
                        $studentData['preferences'] = !empty($prefs) ? json_encode($prefs) : null;

                        if ($existingStudentId) {
                            $studentData['student_id'] = $existingStudentId;
                            $sqlStudent = "UPDATE students SET year=:year, academic_year=:academic_year, entry_year=:entry_year, student_email=:student_email, dormitory_preference=:dormitory_preference, student_name_mm=:student_name_mm, student_name_en=:student_name_en, student_race=:student_race, student_religion=:student_religion, student_nrc=:student_nrc, student_dob=:student_dob, student_birthplace=:student_birthplace, state_region=:state_region, township=:township, student_phone=:student_phone, student_address=:student_address, photo_url=:photo_url, date=:date, status=:status, preferences=:preferences WHERE student_id=:student_id";
                        } else {
                            $sqlStudent = "INSERT INTO students (year, academic_year, seat_no, entry_year, student_email, dormitory_preference, student_name_mm, student_name_en, student_race, student_religion, student_nrc, student_dob, student_birthplace, state_region, township, student_phone, student_address, photo_url, date, status, preferences) VALUES (:year, :academic_year, :seat_no, :entry_year, :student_email, :dormitory_preference, :student_name_mm, :student_name_en, :student_race, :student_religion, :student_nrc, :student_dob, :student_birthplace, :state_region, :township, :student_phone, :student_address, :photo_url, :date, :status, :preferences)";
                        }

                        $stmtStudent = $pdo->prepare($sqlStudent);
                        $stmtStudent->execute($studentData);
                        $student_id = $existingStudentId ?: $pdo->lastInsertId();

                        foreach (['father', 'mother'] as $parent) {
                            $stmtCheck = $pdo->prepare("SELECT {$parent}_id FROM {$parent}s WHERE student_id = ?");
                            $stmtCheck->execute([$student_id]);
                            $params = [
                                $s["{$parent}_name_mm"] ?? null, $s["{$parent}_name_en"] ?? null, $s["{$parent}_race"] ?? null, $s["{$parent}_religion"] ?? null, $s["{$parent}_nrc"] ?? null, $s["{$parent}_phone"] ?? null, $s["{$parent}_info"] ?? null, empty($s["{$parent}_deceased_year"]) ? null : $s["{$parent}_deceased_year"], $s["{$parent}_address"] ?? null, $student_id
                            ];
                            if ($stmtCheck->fetch()) {
                                $sql = "UPDATE {$parent}s SET {$parent}_name_mm = ?, {$parent}_name_en = ?, {$parent}_race = ?, {$parent}_religion = ?, {$parent}_nrc = ?, {$parent}_phone = ?, {$parent}_info = ?, {$parent}_deceased_year = ?, {$parent}_address = ? WHERE student_id = ?";
                            } else {
                                $sql = "INSERT INTO {$parent}s ({$parent}_name_mm, {$parent}_name_en, {$parent}_race, {$parent}_religion, {$parent}_nrc, {$parent}_phone, {$parent}_info, {$parent}_deceased_year, {$parent}_address, student_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            }
                            $stmtParent = $pdo->prepare($sql);
                            $stmtParent->execute($params);
                        }

                        $fullRecordSql = "SELECT s.*, f.*, m.* FROM students s LEFT JOIN fathers f ON s.student_id = f.student_id LEFT JOIN mothers m ON s.student_id = m.student_id WHERE s.student_id = ?";
                        $stmtFetch = $pdo->prepare($fullRecordSql);
                        $stmtFetch->execute([$student_id]);
                        $finalStudent = $stmtFetch->fetch(PDO::FETCH_ASSOC);

                        if ($finalStudent) {
                            $importedStudents[] = processStudentRow($finalStudent);
                        }
                    }
                    
                    $pdo->commit();
                    $response = ['status' => 'success', 'imported_students' => $importedStudents];

                } catch (Exception $e) {
                    $pdo->rollBack();
                    http_response_code(500);
                    $response['message'] = 'Import failed: ' . $e->getMessage();
                }
                break;
            
            // --- MODIFIED: Fetch all settings at once ---
            case 'get_settings':
                $sql = "SELECT setting_key, setting_value FROM site_settings WHERE setting_key IN ('announcement_text', 'announcement_status', 'enrollment_status')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
                
                $defaults = [
                    'announcement_text' => '',
                    'announcement_status' => 'disabled',
                    'enrollment_status' => 'open' // Default to 'open' if not in DB
                ];
                
                $response = ['status' => 'success', 'settings' => array_merge($defaults, $settings)];
                break;

            // --- UNCHANGED ---
            case 'save_announcement':
                $data = json_decode(file_get_contents('php://input'), true);
                $text = $data['text'] ?? '';
                $status = $data['status'] ?? 'disabled';

                if (!in_array($status, ['enabled', 'disabled'])) {
                    $status = 'disabled';
                }
                
                $pdo->beginTransaction();
                
                $sqlText = "INSERT INTO site_settings (setting_key, setting_value) VALUES ('announcement_text', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
                $stmtText = $pdo->prepare($sqlText);
                $stmtText->execute([$text]);

                $sqlStatus = "INSERT INTO site_settings (setting_key, setting_value) VALUES ('announcement_status', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
                $stmtStatus = $pdo->prepare($sqlStatus);
                $stmtStatus->execute([$status]);

                $pdo->commit();
                
                $response = ['status' => 'success', 'message' => 'Announcement settings saved.'];
                break;
            
            // --- NEW: Handle saving enrollment status ---
            case 'save_enrollment_status':
                $data = json_decode(file_get_contents('php://input'), true);
                $status = $data['status'] ?? 'open';

                if (!in_array($status, ['open', 'closed'])) {
                    $status = 'open'; // Default to a safe value
                }

                $sql = "INSERT INTO site_settings (setting_key, setting_value) VALUES ('enrollment_status', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$status]);

                $response = ['status' => 'success', 'message' => 'Enrollment status updated.'];
                break;


            case 'send_feedback_reply':
                $data = json_decode(file_get_contents('php://input'), true);
                $email = $data['email'] ?? null;
                $name = $data['name'] ?? 'Student';
                $subject = $data['subject'] ?? 'No Subject';
                $replyMessage = $data['message'] ?? '';
                $originalMessage = $data['original_message'] ?? '';

                if (!$email || !$subject || !$replyMessage) {
                    http_response_code(400);
                    $response['message'] = 'Missing required fields for sending reply.';
                    break;
                }

                $response = ['status' => 'success', 'message' => 'Reply sent successfully!'];
                
                if (ob_get_level() > 0) ob_end_clean();
                
                header("Connection: close");
                header("Content-Length: " . strlen(json_encode($response)));
                header('Content-Type: application/json');

                echo json_encode($response);
                
                if (function_exists('fastcgi_finish_request')) {
                    fastcgi_finish_request();
                } else {
                    ob_end_flush();
                    flush();
                }
                
                sendSupportReplyEmail($name, $email, $subject, $replyMessage, $originalMessage);
                
                exit();

            case 'delete_feedback':
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? 0;
                if ($id > 0) {
                    $stmt = $pdo->prepare("DELETE FROM feedback WHERE feedback_id = ?");
                    $stmt->execute([$id]);
                    $response = ['status' => 'success', 'message' => 'Feedback deleted.'];
                } else {
                    $response['message'] = 'Invalid feedback ID.';
                }
                break;
                
            case 'clear_all_data':
                $pdo->beginTransaction();
                $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
                $pdo->exec('TRUNCATE TABLE mothers');
                $pdo->exec('TRUNCATE TABLE fathers');
                $pdo->exec('TRUNCATE TABLE students');
                $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
                $pdo->commit();
                $response = ['status' => 'success', 'message' => 'All student data has been cleared.'];
                break;

            case 'get_dashboard_stats':
                date_default_timezone_set('Asia/Yangon');
                $today_date = date('Y-m-d');
                
                $stmt_pending = $pdo->query("SELECT COUNT(*) FROM students WHERE status = 'pending'");
                $pending_count = $stmt_pending->fetchColumn();

                $stmt_dorm = $pdo->query("SELECT COUNT(*) FROM students WHERE dormitory_preference = 1 AND status = 'pending'");
                $dorm_count = $stmt_dorm->fetchColumn();

                $stmt_today = $pdo->prepare("SELECT COUNT(*) FROM students WHERE DATE(date) = ?");
                $stmt_today->execute([$today_date]);
                $today_count = $stmt_today->fetchColumn();
                
                $response = [
                    'status' => 'success',
                    'data' => [
                        'pending_applications' => $pending_count,
                        'dormitory_requests' => $dorm_count,
                        'today_applications' => $today_count,
                    ]
                ];
                break;

            case 'get_analytics_data':
                $sqlMajors = "SELECT academic_year, COUNT(student_id) as student_count FROM students GROUP BY academic_year ORDER BY student_count DESC";
                $stmtMajors = $pdo->prepare($sqlMajors);
                $stmtMajors->execute();
                $byMajor = $stmtMajors->fetchAll(PDO::FETCH_ASSOC);
                
                $sqlRegions = "SELECT state_region, COUNT(student_id) as student_count FROM students WHERE state_region IS NOT NULL AND state_region != '' GROUP BY state_region ORDER BY student_count DESC LIMIT 15";
                $stmtRegions = $pdo->prepare($sqlRegions);
                $stmtRegions->execute();
                $byRegion = $stmtRegions->fetchAll(PDO::FETCH_ASSOC);

                $response = [
                    'status' => 'success',
                    'data' => [
                        'byMajor' => $byMajor,
                        'byRegion' => $byRegion,
                    ]
                ];
                break;
        }
    } catch (Exception $e) {
        if ($pdo && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        http_response_code(500);
        $response['message'] = $e->getMessage();
    }
}

ob_end_clean(); // Clean any stray output
echo json_encode($response);
$pdo = null; // Close connection
?>
