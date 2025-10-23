<?php
header('Content-Type: application/json');

try {
    $db_path = __DIR__ . '/../Rform/db.php';
    if (!file_exists($db_path)) throw new Exception("Database config not found");
    require_once $db_path;
    if (!isset($pdo)) throw new Exception("PDO not created");

    date_default_timezone_set('Asia/Yangon');
    $lastKnown = $_GET['last'] ?? null;

    if ($lastKnown === null) {
        echo json_encode(['changed' => false, 'students' => [], 'deleted' => [], 'last_update' => null]);
        exit;
    }

    // 1️⃣ Detect new/updated students
    $stmt = $pdo->prepare("
        SELECT s.*, 
               f.father_id, f.father_name_mm, f.father_name_en, f.father_race, f.father_religion, f.father_nrc, f.father_phone, f.father_info, f.father_deceased_year, f.father_address,
               m.mother_id, m.mother_name_mm, m.mother_name_en, m.mother_race, m.mother_religion, m.mother_nrc, m.mother_phone, m.mother_info, m.mother_deceased_year, m.mother_address
        FROM students s
        LEFT JOIN fathers f ON s.student_id = f.student_id
        LEFT JOIN mothers m ON s.student_id = m.student_id
        WHERE s.updated_at > :last_update
        ORDER BY s.date DESC
    ");
    $stmt->execute(['last_update' => $lastKnown]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2️⃣ Detect deletions
    $stmt = $pdo->prepare("
        SELECT reference_id 
        FROM change_log 
        WHERE table_name = 'students' AND change_type = 'DELETE' AND changed_at > :last_update
    ");
    $stmt->execute(['last_update' => $lastKnown]);
    $deleted = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // 3️⃣ Find the latest update timestamp
    $latestUpdate = $lastKnown;
    foreach ($students as $s) {
        if ($s['updated_at'] > $latestUpdate) $latestUpdate = $s['updated_at'];
    }
    foreach ($deleted as $delId) {
        // optional: if you want the timestamp of deletion
        $stmt = $pdo->prepare("SELECT changed_at FROM change_log WHERE table_name='students' AND change_type='DELETE' AND reference_id=? LIMIT 1");
        $stmt->execute([$delId]);
        $delTime = $stmt->fetchColumn();
        if ($delTime > $latestUpdate) $latestUpdate = $delTime;
    }

    echo json_encode([
        'changed' => !empty($students) || !empty($deleted),
        'students' => $students,
        'deleted' => $deleted,
        'last_update' => $latestUpdate
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
