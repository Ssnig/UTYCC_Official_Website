<?php
// backend မှ logic များကို ကိုင်တွယ်ရန် file
require_once '../Rform/db.php'; 
header('Content-Type: application/json');
session_start();

// Security check: If the user is not logged in, redirect to the sign-in page.
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("location: ./signin.php"); // Corrected path to signin.php in the same directory
    exit;
}


// POST request ဟုတ်မဟုတ် စစ်ဆေးပါ
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'delete':
        handleDelete();
        break;
    case 'update':
        handleUpdate();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
        break;
}

function handleDelete() {
    global $pdo;
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID provided.']);
        exit;
    }

    try {
        // 1. Database မှ image path ကိုအရင်ရှာပါ
        $stmt = $pdo->prepare("SELECT image_path FROM exam_results WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            echo json_encode(['success' => false, 'message' => 'Result not found.']);
            exit;
        }

        $relativePath = $result['image_path'];
        $basePath = realpath(__DIR__ . '/..'); // Navigate one level up from the current directory (where mrhandler.php is)
        $fullPath = $basePath . '/' . $relativePath;


        // 2. Database record ကို ဖျက်ပါ
        $deleteStmt = $pdo->prepare("DELETE FROM exam_results WHERE id = ?");
        $deleteStmt->execute([$id]);

        // 3. Server မှ image file ကို ဖျက်ပါ
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }

        echo json_encode(['success' => true, 'message' => 'Result successfully deleted.']);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}


function handleUpdate() {
    global $pdo;
    // Input များကို validate လုပ်ပါ
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_VALIDATE_INT);
    $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$id || !$year || !$semester || !$major) {
        echo json_encode(['success' => false, 'message' => 'Invalid data provided for update.']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE exam_results SET year = ?, semester = ?, major = ? WHERE id = ?");
        $stmt->execute([$year, $semester, $major, $id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Result successfully updated.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No changes were made or result not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>
