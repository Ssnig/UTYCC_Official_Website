<?php
// stats_api.php
// This file specifically handles fetching and saving website statistics.
ob_start();
require_once 'auth_check.php';
header('Content-Type: application/json');
require_once '../Rform/db.php';

$response = ['status' => 'error', 'message' => 'Invalid Request'];
$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        switch ($action) {
            case 'get_site_stats':
                $sql = "SELECT setting_key, setting_value FROM stats_settings WHERE setting_key IN ('students_stat', 'acceptance_rate_stat')";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $stats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
                
                // Ensure default values if not present in the database
                $defaults = [
                    'students_stat' => '3000',
                    'acceptance_rate_stat' => '21'
                ];
                $stats = array_merge($defaults, $stats);

                $response = ['status' => 'success', 'stats' => $stats];
                break;

            case 'save_site_stats':
                $students_stat = $data['students_stat'] ?? '0';
                $acceptance_rate_stat = $data['acceptance_rate_stat'] ?? '0';

                $pdo->beginTransaction();

                $sqlStudents = "INSERT INTO stats_settings (setting_key, setting_value) VALUES ('students_stat', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
                $stmtStudents = $pdo->prepare($sqlStudents);
                $stmtStudents->execute([$students_stat]);

                $sqlAcceptance = "INSERT INTO stats_settings (setting_key, setting_value) VALUES ('acceptance_rate_stat', ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)";
                $stmtAcceptance = $pdo->prepare($sqlAcceptance);
                $stmtAcceptance->execute([$acceptance_rate_stat]);
                
                $pdo->commit();
                $response = ['status' => 'success', 'message' => 'Site stats saved successfully.'];
                break;

            default:
                $response['message'] = 'Unknown action for stats API.';
                break;
        }
    } catch (Exception $e) {
        if ($pdo && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        http_response_code(500);
        $response['message'] = 'An error occurred: ' . $e->getMessage();
    }
}

ob_end_clean();
echo json_encode($response);
$pdo = null;
?>
