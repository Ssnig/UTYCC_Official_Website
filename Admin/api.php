<?php
/**
 * api.php
 *
 * Handles all backend data manipulation (Create, Update, Delete, Import) using PDO.
 * This script now handles both JSON and multipart/form-data.
 * Added output buffering to prevent corrupted JSON responses.
 */

ob_start(); // Start output buffering

header('Content-Type: application/json');
require_once '../Rform/db.php'; // Provides the $pdo object

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
    return $studentRow;
}


$fileSystemUploadDir = '../uploads/';
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

                // ===== CHECK FOR DUPLICATES (for both add and update) =====
                $studentIdToExclude = ($action === 'update' && !empty($student['student_id'])) ? $student['student_id'] : 0;

                // Check for duplicate NRC
                if (!empty($student['student_nrc'])) {
                    $sqlCheckNrc = "SELECT COUNT(*) FROM students WHERE student_nrc = ? AND student_id != ?";
                    $stmtCheckNrc = $pdo->prepare($sqlCheckNrc);
                    $stmtCheckNrc->execute([$student['student_nrc'], $studentIdToExclude]);
                    if ($stmtCheckNrc->fetchColumn() > 0) {
                        throw new Exception('ဤမှတ်ပုံတင်နံပါတ်သည် အခြားကျောင်းသားတစ်ဦးမှ အသုံးပြုပြီးဖြစ်သည်။');
                    }
                }
                
                // Check for duplicate Seat No
                if (!empty($student['seat_no'])) {
                    $sqlCheckSeatNo = "SELECT COUNT(*) FROM students WHERE seat_no = ? AND student_id != ?";
                    $stmtCheckSeatNo = $pdo->prepare($sqlCheckSeatNo);
                    $stmtCheckSeatNo->execute([$student['seat_no'], $studentIdToExclude]);
                    if ($stmtCheckSeatNo->fetchColumn() > 0) {
                        throw new Exception('ဤခုံနံပါတ်သည် အခြားကျောင်းသားတစ်ဦးမှ အသုံးပြုပြီးဖြစ်သည်။');
                    }
                }
                // ===== END OF DUPLICATE CHECK =====

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
                
                $fullRecordSql = "SELECT s.*, f.*, m.* FROM students s LEFT JOIN fathers f ON s.student_id = f.student_id LEFT JOIN mothers m ON s.student_id = m.student_id WHERE s.student_id = ?";
                $stmtFetch = $pdo->prepare($fullRecordSql);
                $stmtFetch->execute([$student_id]);
                $finalStudent = $stmtFetch->fetch(PDO::FETCH_ASSOC);

                // **FIX**: Process the student row for consistent data types
                $response = ['status' => 'success', 'student' => processStudentRow($finalStudent)];
                break;

            case 'approve_students':
                $data = json_decode(file_get_contents('php://input'), true);
                $ids = $data['ids'] ?? [];
                if (!empty($ids) && is_array($ids)) {
                    $sanitized_ids = array_map('intval', $ids);
                    $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                    
                    $sql = "UPDATE students SET status = 'approved' WHERE student_id IN ($placeholders)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($sanitized_ids);
                    
                    $response = ['status' => 'success', 'message' => $stmt->rowCount() . ' student(s) approved.'];
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
                    
                    $stmtSelect = $pdo->prepare("SELECT photo_url FROM students WHERE student_id IN ($placeholders)");
                    $stmtSelect->execute($sanitized_ids);
                    $photoUrls = $stmtSelect->fetchAll(PDO::FETCH_COLUMN);

                    $sql = "DELETE FROM students WHERE student_id IN ($placeholders)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($sanitized_ids);
                    
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
        }
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        http_response_code(500);
        // Return the specific exception message for frontend display
        $response['message'] = $e->getMessage();
    }
}

ob_end_clean(); // Clean any stray output
echo json_encode($response);
$pdo = null; // Close connection
?>
