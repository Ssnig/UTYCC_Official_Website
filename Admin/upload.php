<?php
// Include the database connection file
require_once 'auth_check.php';
require_once '../Rform/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    $semester = filter_input(INPUT_POST, 'semester', FILTER_VALIDATE_INT);
    $major = filter_input(INPUT_POST, 'major', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$year || !$semester || !$major) {
        echo json_encode(['success' => false, 'message' => 'Invalid form data.']);
        exit;
    }

    // Define the target directory for result images, which is one level up from the current directory.
    $targetDir = __DIR__ . "/../uploadResults/";

    // Create the directory if it doesn't exist
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            echo json_encode(['success' => false, 'message' => 'Failed to create uploadResults directory. Please check server permissions.']);
            exit;
        }
    }

    $files_uploaded_count = 0;
    $errors = [];

    // Check if multiple files were uploaded
    if (isset($_FILES["result_image"]["name"]) && is_array($_FILES["result_image"]["name"])) {
        // Loop through each file
        for ($i = 0; $i < count($_FILES["result_image"]["name"]); $i++) {
            $file = [
                'name' => $_FILES["result_image"]["name"][$i],
                'type' => $_FILES["result_image"]["type"][$i],
                'tmp_name' => $_FILES["result_image"]["tmp_name"][$i],
                'error' => $_FILES["result_image"]["error"][$i],
                'size' => $_FILES["result_image"]["size"][$i],
            ];

            // Validate the file
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $errors[] = "File " . htmlspecialchars($file['name']) . " failed to upload.";
                continue;
            }

            // Check if file is an actual image
            $check = getimagesize($file["tmp_name"]);
            if($check === false) {
                $errors[] = "File " . htmlspecialchars($file['name']) . " is not an image.";
                continue;
            }

            // Check file size (5MB limit)
            if ($file["size"] > 5000000) {
                $errors[] = "File " . htmlspecialchars($file['name']) . " is too large. Max 5MB allowed.";
                continue;
            }

            // Allow certain file formats
            $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
                $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                continue;
            }

            // Try to upload file
            $targetFile = $targetDir . uniqid() . '.' . $fileType;
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                // File uploaded successfully, now insert data into database
                try {
                    // Store the path relative to the admin directory for correct display
                    $imagePathForDB = "../uploadResults/" . basename($targetFile);
                    $stmt = $pdo->prepare("INSERT INTO exam_results (year, semester, major, image_path) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$year, $semester, $major, $imagePathForDB]);
                    $files_uploaded_count++;
                } catch (PDOException $e) {
                    $errors[] = 'Database error: ' . $e->getMessage();
                    // If the database insert fails, delete the uploaded file
                    unlink($targetFile);
                    break; 
                }
            } else {
                $errors[] = "Sorry, there was an error uploading file " . htmlspecialchars($file['name']) . ".";
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No files were selected or unexpected file upload format. Please try again.']);
        exit;
    }

    if ($files_uploaded_count > 0) {
        $message = "Successfully uploaded " . $files_uploaded_count . " file(s).";
        if (!empty($errors)) {
            $message .= " Some files had errors: " . implode(", ", $errors);
        }
        echo json_encode(['success' => true, 'message' => $message]);
    } else {
        echo json_encode(['success' => false, 'message' => "No files were uploaded. " . implode(", ", $errors)]);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>

