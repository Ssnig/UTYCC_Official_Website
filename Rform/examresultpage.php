<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Exam Result</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f1f5f9; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white rounded-xl shadow-lg p-6 md:p-10 w-full max-w-2xl text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900 mb-6">Your Exam Result</h1>
        
        <?php
        // results.php
        require_once '../Rform/db.php';
        // Check if the form was submitted with POST method
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $year = $_POST['year'] ?? '';
            $semester = $_POST['semester'] ?? '';
            $major = $_POST['major'] ?? '';

            // Simple validation
            if (empty($year) || empty($semester) || empty($major)) {
                echo '<div class="bg-red-100 text-red-800 p-4 rounded-lg">Please select all required fields.</div>';
                echo '<div class="mt-4"><a href="examResult.php" class="text-blue-600 hover:underline">Go Back</a></div>';
            } else {
                $dataFile = 'data/results_db.json';
                
                if (file_exists($dataFile)) {
                    $json = file_get_contents($dataFile);
                    $results = json_decode($json, true);

                    $foundResult = false;
                    
                    if ($results) {
                        foreach ($results as $result) {
                            if ($result['year'] == $year && $result['semester'] == $semester && $result['major'] == $major) {
                                // Display the image
                                $imagePath = htmlspecialchars($result['image_path']);
                                echo '<p class="text-gray-600 mb-4">Here is your exam result for ' . htmlspecialchars($year) . ' Year, ' . htmlspecialchars($semester) . ' Semester, ' . htmlspecialchars($major) . ' major:</p>';
                                echo '<img src="' . $imagePath . '" alt="Exam Result" class="w-full h-auto rounded-lg shadow-md mt-6 object-contain">';
                                echo '<p class="text-xs text-gray-400 mt-2">Uploaded on: ' . htmlspecialchars($result['uploaded_at']) . '</p>';
                                $foundResult = true;
                                break;
                            }
                        }
                    }

                    if (!$foundResult) {
                        echo '<div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">No exam result found for the selected details.</div>';
                        echo '<div class="mt-4"><a href="examResult.php" class="text-blue-600 hover:underline">Go Back</a></div>';
                    }

                } else {
                    echo '<div class="bg-red-100 text-red-800 p-4 rounded-lg">Error: Database file not found.</div>';
                    echo '<div class="mt-4"><a href="examResult.php" class="text-blue-600 hover:underline">Go Back</a></div>';
                }
            }
        } else {
            // Redirect if accessed directly
            header('Location: examResult.php');
            exit;
        }
        ?>

    </div>

</body>
</html>
