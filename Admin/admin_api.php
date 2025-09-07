<?php
/**
 * admin_api.php
 *
 * Handles all backend data manipulation for Admins (Create, Delete).
 */

ob_start(); // Start output buffering
require_once 'auth_check.php';
header('Content-Type: application/json');
require_once '../Rform/db.php'; // Provides the $pdo object

$response = ['status' => 'error', 'message' => 'Invalid Request'];

// Security Check: Ensure the user is a logged-in admin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Admin actions are expected to be JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? null;

    try {
        switch ($action) {
            case 'add_admin':
                $username = $data['username'] ?? null;
                $password = $data['password'] ?? null;

                if (empty($username) || empty($password)) {
                    throw new Exception('Username and password are required.');
                }

                // Check for duplicate username
                $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM admins WHERE admin_user = ?");
                $stmtCheck->execute([$username]);
                if ($stmtCheck->fetchColumn() > 0) {
                    throw new Exception('This username is already taken.');
                }
                
                // Hash the password for security
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO admins (admin_user, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $password_hash]);
                
                $newId = $pdo->lastInsertId();
                
                // Return the new admin's info (without password) to the frontend
                $response = [
                    'status' => 'success', 
                    'admin' => ['id' => (int)$newId, 'admin_user' => $username]
                ];
                break;

            case 'delete_admin':
                $id = $data['id'] ?? null;

                if (empty($id)) {
                    throw new Exception('Admin ID is required.');
                }

                // Safety check: prevent deleting the last admin
                $stmtCount = $pdo->query("SELECT COUNT(*) FROM admins");
                if ($stmtCount->fetchColumn() <= 1) {
                    throw new Exception('You cannot delete the last admin account.');
                }

                $sql = "DELETE FROM admins WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);

                if ($stmt->rowCount() > 0) {
                    $response = ['status' => 'success', 'message' => 'Admin deleted successfully.'];
                } else {
                    throw new Exception('Admin not found or could not be deleted.');
                }
                break;

            default:
                http_response_code(400);
                $response['message'] = 'Invalid admin action specified.';
                break;
        }
    } catch (Exception $e) {
        // Use 500 for server-side errors, 409 for client-side (like duplicates)
        if ($e->getCode() == 23000 || strpos($e->getMessage(), 'taken') !== false) {
             http_response_code(409); // Conflict
        } else {
             http_response_code(500);
        }
        $response['message'] = $e->getMessage();
    }
}

ob_end_clean();
echo json_encode($response);
$pdo = null;
?>

