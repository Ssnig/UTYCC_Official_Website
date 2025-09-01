<?php
/**
 * api.php
 *
 * Handles all backend data manipulation (Create, Update, Delete) using PDO.
 * This script expects JSON input and returns JSON responses.
 */

header('Content-Type: application/json');
require_once 'db_config.php'; // Provides the $pdo object

// Get the request data from the frontend
$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';
$response = ['status' => 'error', 'message' => 'Invalid Request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        switch ($action) {
            // NOTE: The 'add' case would need to be expanded similarly to 'update' to handle all fields.
            // For now, it remains simple as per the previous version.
            case 'add':
                $student = $data['student'] ?? null;
                if ($student) {
                    $pdo->beginTransaction();

                    // Insert into students table
                    $sqlStudent = "INSERT INTO students (student_name_en, seat_no, student_email, student_phone, date) VALUES (:name, :seat, :email, :phone, CURDATE())";
                    $stmtStudent = $pdo->prepare($sqlStudent);
                    $stmtStudent->execute([
                        ':name' => $student['student_name_en'],
                        ':seat' => $student['seat_no'],
                        ':email' => $student['student_email'],
                        ':phone' => $student['student_phone']
                    ]);
                    $newId = $pdo->lastInsertId();

                    // ... Logic to insert into fathers and mothers tables would go here ...

                    $pdo->commit();
                    
                    // Fetch the newly created record to return to the frontend
                    $fetchStmt = $pdo->prepare("SELECT * FROM students WHERE student_id = :id");
                    $fetchStmt->execute([':id' => $newId]);
                    $newStudent = $fetchStmt->fetch(PDO::FETCH_ASSOC);
                    
                    $response = ['status' => 'success', 'student' => $newStudent];
                } else {
                    $response['message'] = 'No student data provided.';
                }
                break;

            case 'update':
                $student = $data['student'] ?? null;
                if ($student && !empty($student['student_id'])) {
                    $student_id = $student['student_id'];
                    $pdo->beginTransaction();

                    // 1. Update Students Table
                    $sqlStudents = "UPDATE students SET 
                        year = :year, academic_year = :academic_year, seat_no = :seat_no, entry_year = :entry_year, student_email = :student_email, 
                        dormitory_preference = :dormitory_preference, student_name_mm = :student_name_mm, student_name_en = :student_name_en, 
                        student_race = :student_race, student_religion = :student_religion, student_nrc = :student_nrc, student_dob = :student_dob, 
                        student_birthplace = :student_birthplace, state_region = :state_region, township = :township, student_phone = :student_phone, 
                        student_address = :student_address 
                        WHERE student_id = :student_id";
                    
                    $stmtStudents = $pdo->prepare($sqlStudents);
                    $stmtStudents->execute([
                        ':year' => $student['year'], ':academic_year' => $student['academic_year'], ':seat_no' => $student['seat_no'], 
                        ':entry_year' => $student['entry_year'], ':student_email' => $student['student_email'], ':dormitory_preference' => $student['dormitory_preference'], 
                        ':student_name_mm' => $student['student_name_mm'], ':student_name_en' => $student['student_name_en'], ':student_race' => $student['student_race'], 
                        ':student_religion' => $student['student_religion'], ':student_nrc' => $student['student_nrc'], ':student_dob' => $student['student_dob'], 
                        ':student_birthplace' => $student['student_birthplace'], ':state_region' => $student['state_region'], ':township' => $student['township'], 
                        ':student_phone' => $student['student_phone'], ':student_address' => $student['student_address'], ':student_id' => $student_id
                    ]);

                    // 2. Upsert Fathers Table
                    $stmtCheckFather = $pdo->prepare("SELECT father_id FROM fathers WHERE student_id = :student_id");
                    $stmtCheckFather->execute([':student_id' => $student_id]);
                    if ($stmtCheckFather->fetch()) { // Father exists, UPDATE
                        $sqlFathers = "UPDATE fathers SET father_name_mm = ?, father_name_en = ?, father_race = ?, father_religion = ?, father_nrc = ?, father_phone = ?, father_info = ?, father_deceased_year = ?, father_address = ? WHERE student_id = ?";
                        $stmtFathers = $pdo->prepare($sqlFathers);
                        $stmtFathers->execute([$student['father_name_mm'], $student['father_name_en'], $student['father_race'], $student['father_religion'], $student['father_nrc'], $student['father_phone'], $student['father_info'], $student['father_deceased_year'], $student['father_address'], $student_id]);
                    } else { // Father does not exist, INSERT
                        $sqlFathers = "INSERT INTO fathers (student_id, father_name_mm, father_name_en, father_race, father_religion, father_nrc, father_phone, father_info, father_deceased_year, father_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmtFathers = $pdo->prepare($sqlFathers);
                        $stmtFathers->execute([$student_id, $student['father_name_mm'], $student['father_name_en'], $student['father_race'], $student['father_religion'], $student['father_nrc'], $student['father_phone'], $student['father_info'], $student['father_deceased_year'], $student['father_address']]);
                    }

                    // 3. Upsert Mothers Table
                    $stmtCheckMother = $pdo->prepare("SELECT mother_id FROM mothers WHERE student_id = :student_id");
                    $stmtCheckMother->execute([':student_id' => $student_id]);
                     if ($stmtCheckMother->fetch()) { // Mother exists, UPDATE
                        $sqlMothers = "UPDATE mothers SET mother_name_mm = ?, mother_name_en = ?, mother_race = ?, mother_religion = ?, mother_nrc = ?, mother_phone = ?, mother_info = ?, mother_deceased_year = ?, mother_address = ? WHERE student_id = ?";
                        $stmtMothers = $pdo->prepare($sqlMothers);
                        $stmtMothers->execute([$student['mother_name_mm'], $student['mother_name_en'], $student['mother_race'], $student['mother_religion'], $student['mother_nrc'], $student['mother_phone'], $student['mother_info'], $student['mother_deceased_year'], $student['mother_address'], $student_id]);
                    } else { // Mother does not exist, INSERT
                        $sqlMothers = "INSERT INTO mothers (student_id, mother_name_mm, mother_name_en, mother_race, mother_religion, mother_nrc, mother_phone, mother_info, mother_deceased_year, mother_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmtMothers = $pdo->prepare($sqlMothers);
                        $stmtMothers->execute([$student_id, $student['mother_name_mm'], $student['mother_name_en'], $student['mother_race'], $student['mother_religion'], $student['mother_nrc'], $student['mother_phone'], $student['mother_info'], $student['mother_deceased_year'], $student['mother_address']]);
                    }

                    $pdo->commit();

                    // 4. Fetch the fully updated record to send back to the frontend
                    $fullRecordSql = "SELECT s.*, f.*, m.* FROM students s LEFT JOIN fathers f ON s.student_id = f.student_id LEFT JOIN mothers m ON s.student_id = m.student_id WHERE s.student_id = :student_id";
                    $stmtFetch = $pdo->prepare($fullRecordSql);
                    $stmtFetch->execute([':student_id' => $student_id]);
                    $updatedStudent = $stmtFetch->fetch(PDO::FETCH_ASSOC);
                    
                    $response = ['status' => 'success', 'student' => $updatedStudent];
                } else {
                    $response['message'] = 'Incomplete student data for update.';
                }
                break;

            case 'delete':
                $ids = $data['ids'] ?? [];
                if (!empty($ids) && is_array($ids)) {
                    $sanitized_ids = array_map('intval', $ids);
                    $placeholders = implode(',', array_fill(0, count($sanitized_ids), '?'));
                    
                    // Note: Because of ON DELETE CASCADE, deleting from students will also delete from fathers and mothers.
                    $sql = "DELETE FROM students WHERE student_id IN ($placeholders)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($sanitized_ids);
                    
                    $response = ['status' => 'success', 'message' => $stmt->rowCount() . ' student(s) deleted.'];
                } else {
                    $response['message'] = 'No student IDs provided for deletion.';
                }
                break;
        }
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
}

// Close the connection
$pdo = null;
echo json_encode($response);
?>

