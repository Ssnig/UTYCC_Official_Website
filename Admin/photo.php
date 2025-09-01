<?php
header('Content-Type: application/json');

require_once '../rform/db.php';

// Simple router based on 'action'
$action = $_POST['action'] ?? (json_decode(file_get_contents('php://input'), true)['action'] ?? null);

if (!$action) {
    echo json_encode(['status' => 'error', 'message' => 'No action specified.']);
    exit;
}

// Ensure the uploads directory exists and is writable
$uploadDir = '../Rform/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0775, true);
}


// Function to handle database operations for student and parents
function saveStudentData($pdo, $studentData, $isUpdate = false) {
    $pdo->beginTransaction();
    try {
        // --- Handle Photo Upload ---
        $photoPath = $studentData['existing_photo'] ?? null;
        if (isset($_FILES['student_photo']) && $_FILES['student_photo']['error'] === UPLOAD_ERR_OK) {
            // Delete old photo if a new one is uploaded
            if ($isUpdate && !empty($photoPath) && file_exists($photoPath)) {
                unlink($photoPath);
            }

            $uploadDir = '../Rform/uploads/';
            $fileName = uniqid() . '-' . basename($_FILES['student_photo']['name']);
            $photoPath = $uploadDir . $fileName;
            if (!move_uploaded_file($_FILES['student_photo']['tmp_name'], $photoPath)) {
                throw new Exception('Failed to move uploaded file.');
            }
        }

        // --- Student Table ---
        if ($isUpdate) {
            $sql = "UPDATE students SET student_name_en=?, student_name_mm=?, seat_no=?, student_email=?, student_phone=?, student_nrc=?, student_dob=?, student_birthplace=?, student_race=?, student_religion=?, student_address=?, photo_url=?, township=?, state_region=?, dormitory_preference=?, year=?, academic_year=?, entry_year=? WHERE student_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $studentData['student_name_en'], $studentData['student_name_mm'], $studentData['seat_no'], $studentData['student_email'], $studentData['student_phone'], $studentData['student_nrc'], $studentData['student_dob'], $studentData['student_birthplace'], $studentData['student_race'], $studentData['student_religion'], $studentData['student_address'], $photoPath, $studentData['township'], $studentData['state_region'], $studentData['dormitory_preference'], $studentData['year'], $studentData['academic_year'], $studentData['entry_year'], $studentData['student_id']
            ]);
            $studentId = $studentData['student_id'];
        } else {
            $sql = "INSERT INTO students (student_name_en, student_name_mm, seat_no, student_email, student_phone, student_nrc, student_dob, student_birthplace, student_race, student_religion, student_address, student_photo, township, state_region, dormitory_preference, year, academic_year, entry_year, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $studentData['student_name_en'], $studentData['student_name_mm'], $studentData['seat_no'], $studentData['student_email'], $studentData['student_phone'], $studentData['student_nrc'], $studentData['student_dob'], $studentData['student_birthplace'], $studentData['student_race'], $studentData['student_religion'], $studentData['student_address'], $photoPath, $studentData['township'], $studentData['state_region'], $studentData['dormitory_preference'], $studentData['year'], $studentData['academic_year'], $studentData['entry_year']
            ]);
            $studentId = $pdo->lastInsertId();
        }

        // --- Father & Mother Table (Update or Insert) ---
        foreach (['father', 'mother'] as $parent) {
            // Check if parent data exists for this student
            $stmt = $pdo->prepare("SELECT {$parent}_id FROM {$parent}s WHERE student_id = ?");
            $stmt->execute([$studentId]);
            $parentId = $stmt->fetchColumn();

            if ($parentId) { // Update
                $sql = "UPDATE {$parent}s SET {$parent}_name_en=?, {$parent}_name_mm=?, {$parent}_nrc=?, {$parent}_phone=?, {$parent}_race=?, {$parent}_religion=?, {$parent}_info=?, {$parent}_address=?, {$parent}_deceased_year=? WHERE student_id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $studentData["{$parent}_name_en"], $studentData["{$parent}_name_mm"], $studentData["{$parent}_nrc"], $studentData["{$parent}_phone"], $studentData["{$parent}_race"], $studentData["{$parent}_religion"], $studentData["{$parent}_info"], $studentData["{$parent}_address"], $studentData["{$parent}_deceased_year"], $studentId
                ]);
            } else { // Insert
                $sql = "INSERT INTO {$parent}s (student_id, {$parent}_name_en, {$parent}_name_mm, {$parent}_nrc, {$parent}_phone, {$parent}_race, {$parent}_religion, {$parent}_info, {$parent}_address, {$parent}_deceased_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                 $stmt->execute([
                    $studentId, $studentData["{$parent}_name_en"], $studentData["{$parent}_name_mm"], $studentData["{$parent}_nrc"], $studentData["{$parent}_phone"], $studentData["{$parent}_race"], $studentData["{$parent}_religion"], $studentData["{$parent}_info"], $studentData["{$parent}_address"], $studentData["{$parent}_deceased_year"]
                ]);
            }
        }

        $pdo->commit();
        return $studentId;
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
}

function getFullStudentData($pdo, $studentId) {
    $sql = "SELECT s.*, 
                   f.father_id, f.father_name_mm, f.father_name_en, f.father_race, f.father_religion, f.father_nrc, f.father_phone, f.father_info, f.father_deceased_year, f.father_address,
                   m.mother_id, m.mother_name_mm, m.mother_name_en, m.mother_race, m.mother_religion, m.mother_nrc, m.mother_phone, m.mother_info, m.mother_deceased_year, m.mother_address
            FROM students s
            LEFT JOIN fathers f ON s.student_id = f.student_id
            LEFT JOIN mothers m ON s.student_id = m.student_id
            WHERE s.student_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$studentId]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Recast types for JS consistency
    if ($student) {
        $student['student_id'] = (int)$student['student_id'];
        $student['dormitory_preference'] = (bool)$student['dormitory_preference'];
        if($student['father_deceased_year']) $student['father_deceased_year'] = (int)$student['father_deceased_year'];
        if($student['mother_deceased_year']) $student['mother_deceased_year'] = (int)$student['mother_deceased_year'];
    }
    return $student;
}


switch ($action) {
    case 'add':
    case 'update':
        try {
            // Sanitize and prepare data from $_POST
            $studentData = [];
            foreach ($_POST as $key => $value) {
                // Handle empty strings as null, except for required fields
                $studentData[$key] = trim($value) === '' ? null : trim($value);
            }
            $studentData['dormitory_preference'] = isset($_POST['dormitory_preference']) ? 1 : 0;
            $studentData['student_id'] = !empty($_POST['student_id']) ? (int)$_POST['student_id'] : null;

            // For updates, fetch existing photo path to handle deletion
            if ($action === 'update') {
                $stmt = $pdo->prepare("SELECT student_photo FROM students WHERE student_id = ?");
                $stmt->execute([$studentData['student_id']]);
                $studentData['existing_photo'] = $stmt->fetchColumn();
            }

            $studentId = saveStudentData($pdo, $studentData, ($action === 'update'));
            $newStudentData = getFullStudentData($pdo, $studentId);

            echo json_encode(['status' => 'success', 'student' => $newStudentData]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
        break;

    case 'delete':
        $data = json_decode(file_get_contents('php://input'), true);
        $ids = $data['ids'] ?? [];

        if (empty($ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No IDs provided for deletion.']);
            exit;
        }

        try {
             // First, select the photo paths to delete the files
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = $pdo->prepare("SELECT student_photo FROM students WHERE student_id IN ($placeholders)");
            $stmt->execute($ids);
            $photoPaths = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Delete student records (cascading deletes should handle fathers/mothers if set up)
            $stmt = $pdo->prepare("DELETE FROM students WHERE student_id IN ($placeholders)");
            $stmt->execute($ids);
            
            // Now, delete the photo files from the server
            foreach ($photoPaths as $path) {
                if (!empty($path) && file_exists($path)) {
                    unlink($path);
                }
            }

            echo json_encode(['status' => 'success', 'message' => 'Students deleted successfully.']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action.']);
        break;
}

$pdo = null;
?>
