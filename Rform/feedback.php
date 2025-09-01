<?php
// Include the database connection file.
// This assumes you have a file named 'db.php' with your PDO connection logic.
include "db.php";

// Initialize a variable to store the message to be displayed.
$message = '';

// Check if the request method is POST. This indicates a form submission.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate required fields.
    if (empty($_POST['name']) || empty($_POST['comments'])) {
        // Redirect with a status for missing fields.
        header("Location: feedback.php?status=error_missing");
        exit(); // Stop further script execution.
    } else {
        try {
            // SQL query to insert data. Using named placeholders for security.
            $sql = "INSERT INTO feedback (student_name, student_email, message) VALUES (:name, :email, :comments)";
            
            // Prepare the SQL statement to prevent SQL injection.
            $stmt = $pdo->prepare($sql);
            
            // Bind the form data to the placeholders.
            // PDO automatically handles the sanitization.
            $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindParam(':comments', $_POST['comments'], PDO::PARAM_STR);
            
            // Execute the prepared statement.
            if ($stmt->execute()) {
                // On successful insertion, redirect to the same page with a success status.
                header("Location: feedback.php?status=success");
                exit();
            } else {
                // If execution fails, redirect with a database error status.
                header("Location: feedback.php?status=error_db");
                exit();
            }
        } catch (PDOException $e) {
            // Catch any PDO connection or query errors.
            // Log the detailed error for debugging purposes.
            error_log("PDO Error: " . $e->getMessage());
            // Redirect with a generic error status to the user.
            header("Location: feedback.php?status=error_db_exception");
            exit();
        }
    }
}

// Check for status messages in the URL (from a redirect).
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    
    // Set the appropriate message based on the status code.
    if ($status == 'success') {
        $message = "<div class='bg-green-100 border-green-400 text-green-700 font-bold px-4 py-3 rounded-md shadow-lg flex items-center justify-between mb-4 animate-fade-down' role='alert'>
                        <div class='flex items-center'>
                            <svg class='w-6 h-6 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path>
                            </svg>
                                                   <strong class='font-bold'>Success!</strong>
                        <span class='block sm:inline'> Your feedback has been submitted successfully.</span>

                        </div>
                        <button type='button' onclick='this.parentElement.style.display=\"none\";' class='text-white hover:text-gray-200 transition duration-150 ease-in-out'>
                            <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path>
                            </svg>
                        </button>
                    </div>";
    } elseif ($status == 'error_missing') {
        $message = "<div class='bg-yellow-500 text-white font-bold px-4 py-3 rounded-md shadow-lg flex items-center justify-between mb-4 animate-fade-down' role='alert'>
                        <div class='flex items-center'>
                            <svg class='w-6 h-6 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'></path>
                            </svg>
                            <span>Please fill out all required fields.</span>
                        </div>
                        <button type='button' onclick='this.parentElement.style.display=\"none\";' class='text-white hover:text-gray-200 transition duration-150 ease-in-out'>
                            <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path>
                            </svg>
                        </button>
                    </div>";
    } elseif ($status == 'error_db' || $status == 'error_db_exception') {
        $message = "<div class='bg-red-500 text-white font-bold px-4 py-3 rounded-md shadow-lg flex items-center justify-between mb-4 animate-fade-down' role='alert'>
                        <div class='flex items-center'>
                            <svg class='w-6 h-6 mr-2' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path>
                            </svg>
                            <span>There was a problem submitting your feedback. Please try again.</span>
                        </div>
                        <button type='button' onclick='this.parentElement.style.display=\"none\";' class='text-white hover:text-gray-200 transition duration-150 ease-in-out'>
                            <svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12'></path>
                            </svg>
                        </button>
                    </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link
      rel="shortcut icon"
      href="../Img/logo/utycc_logo_favicon/favicon.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./CSS/footer.css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedbacks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <style>
      /* Animation Classes */
      .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
      }
      .animate-fade-up {
        animation: fadeUp 0.6s ease-out forwards;
      }
      .animate-fade-down {
        animation: fadeDown 0.4s ease-out forwards;
      }
      .animate-scale-in {
        animation: scaleIn 0.4s ease-out forwards;
      }
      .animate-pulse {
        animation: pulse 1s ease infinite;
      }
      .animate-ripple {
        animation: ripple 0.6s linear forwards;
      }

      /* Keyframes */
      @keyframes fadeIn {
        from {
          opacity: 0;
        }
        to {
          opacity: 1;
        }
      }
      @keyframes fadeUp {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      @keyframes fadeDown {
        from {
          opacity: 0;
          transform: translateY(-20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      @keyframes scaleIn {
        from {
          opacity: 0;
          transform: scale(0.95);
        }
        to {
          opacity: 1;
          transform: scale(1);
        }
      }
      @keyframes pulse {
        0%,
        100% {
          transform: scale(1);
        }
        50% {
          transform: scale(1.05);
        }
      }
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }

      /* Custom Components */
      .star-rating {
        direction: rtl;
        display: inline-block;
      }
      .star-rating input[type="radio"] {
        display: none;
      }
      .star-rating label {
        color: #ddd;
        font-size: 2rem;
        padding: 0 5px;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .star-rating label:hover,
      .star-rating label:hover ~ label,
      .star-rating input[type="radio"]:checked ~ label {
        color: #f8d64e;
        transform: scale(1.1);
      }
      .file-upload {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
      }
      .file-upload:hover {
        border-color: #818cf8;
        transform: translateY(-2px);
      }
      .file-upload-input {
        position: absolute;
        font-size: 50px;
        opacity: 0;
        right: 0;
        top: 0;
        cursor: pointer;
      }
      .feedback-card {
        transition: all 0.3s ease;
        transform-origin: top center;
      }
      .feedback-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
          0 10px 10px -5px rgba(0, 0, 0, 0.04);
      }
      .file-preview {
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        object-fit: cover;
        transition: all 0.3s ease;
      }
      .file-preview:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
          0 2px 4px -1px rgba(0, 0, 0, 0.06);
      }
    </style>
  </head>
  <body
    class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen opacity-0 animate-fade-in"
  >
    <header
        class="text-center mb-12 opacity-0 animate-fade-up"
        style="animation-delay: 0.2s"
      >
        <h1 class="text-4xl font-bold text-indigo-800 mb-3">
          Share Your Feedback
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          We value your opinion! Please share your experience with us.
        </p>
      </header>

      <div
        class="bg-white rounded-xl shadow-lg p-8 max-w-3xl mx-auto mb-16 opacity-0 animate-scale-in"
        style="animation-delay: 0.4s"
      >
        <h2
          class="text-2xl font-semibold text-gray-800 mb-6 opacity-0 animate-fade-down"
          style="animation-delay: 0.6s"
        >
          Submit Feedback
        </h2>

        <?php echo $message; ?>

        <form id="feedbackForm" method="POST" class="space-y-6">
          <div class="opacity-0 animate-fade-up" style="animation-delay: 0.7s">
            <label
              for="name"
              class="block text-sm font-medium text-gray-700 mb-1"
              >Your Name</label
            >
            <input
              type="text"
              id="name"
              name="name"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
              placeholder="John Doe"
              required
            />
          </div>

          <div class="opacity-0 animate-fade-up" style="animation-delay: 0.8s">
            <label
              for="email"
              class="block text-sm font-medium text-gray-700 mb-1"
              >Email (optional)</label
            >
            <input
              type="email"
              id="email"
              name="email"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
              placeholder="john@example.com"
            />
          </div>
          <div class="opacity-0 animate-fade-up" style="animation-delay: 1s">
            <label
              for="comments"
              class="block text-sm font-medium text-gray-700 mb-1"
              >Your Problems</label
            >
            <textarea
              id="comments"
              name="comments"
              rows="4"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
              placeholder="Share your problems..."
              required
            ></textarea>
          </div>
          <div
            class="pt-2 opacity-0 animate-fade-up"
            style="animation-delay: 1.2s"
          >
            <button
              type="submit"
              id="submitBtn"
              class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center relative overflow-hidden"
            >
              <span class="relative z-10 flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  ></path>
                </svg>
                Submit
              </span>
            </button>
          </div>
        </form>
      </div>



       <script>
        // Check if the URL contains the status parameter
        if (window.location.search.includes('status=success')) {
            // Use the history API to replace the current URL
            // This removes the "?status=success" part from the URL
            history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
    </body>
</html>