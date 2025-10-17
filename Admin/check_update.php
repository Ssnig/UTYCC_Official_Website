<?php
header('Content-Type: application/json');

try {
    $db_path = __DIR__ . '/../Rform/db.php';
    if (!file_exists($db_path)) {
        throw new Exception("Database configuration file not found at: {$db_path}");
    }
    require_once $db_path;

    if (!isset($pdo)) {
        throw new Exception("PDO connection object was not created in db.php.");
    }

    date_default_timezone_set('Asia/Yangon');
    // Get last update from GET parameter (sent by JS)
    $lastKnown = isset($_GET['last']) ? $_GET['last'] : null;


    if ($lastKnown === null) {
        echo json_encode(['changed' => false, 'students' => [], 'last_update' => null]);
        exit;
    }

    $stmt = $pdo->prepare("
        SELECT s.*, 
               f.father_id, f.father_name_mm, f.father_name_en, f.father_race, f.father_religion, f.father_nrc, f.father_phone, f.father_info, f.father_deceased_year, f.father_address,
               m.mother_id, m.mother_name_mm, m.mother_name_en, m.mother_race, m.mother_religion, m.mother_nrc, m.mother_phone, m.mother_info, m.mother_deceased_year, m.mother_address
        FROM students s
        LEFT JOIN fathers f ON s.student_id = f.student_id
        LEFT JOIN mothers m ON s.student_id = m.student_id
        WHERE s.status='pending' AND s.updated_at > :last_update
        ORDER BY s.date DESC
    ");
    $stmt->execute(['last_update' => $lastKnown]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $latestUpdate = $lastKnown;
    foreach ($students as $s) {
        if ($s['updated_at'] > $latestUpdate) $latestUpdate = $s['updated_at'];
    }

    echo json_encode([
        'changed' => !empty($students),
        'students' => $students,
        'last_update' => $latestUpdate
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
