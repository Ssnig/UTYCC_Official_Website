<?php
/**
 * auth_check.php
 *
 * This file provides a centralized authentication check for all admin-only pages.
 * It ensures that the session is started and verifies that an admin is logged in.
 * If the user is not logged in, it redirects them to the sign-in page or returns a JSON error for API requests.
 */

// If a session has not already been started, start one.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security check: If the 'admin_loggedin' session variable is not set or not true,
// the user is not authenticated.
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    
    // Check if the request is an API call (AJAX). This is more robust.
    $is_api_request = (
        (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ||
        (!empty($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false)
    );

    if ($is_api_request) {
        // For API requests, send a JSON error response with a 401 Unauthorized status
        // This prevents sending HTML to a script expecting JSON.
        http_response_code(401); 
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Authentication required. Your session may have expired.'
        ]);
    } else {
        // For regular page loads, redirect to the sign-in page.
        header("location: signin.php");
    }
    
    // Terminate the script immediately to prevent any further code execution.
    exit;
}
?>

