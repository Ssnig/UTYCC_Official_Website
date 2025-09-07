<?php
/**
 * auth_check.php
 *
 * This file provides a centralized authentication check for all admin-only pages.
 * It ensures that the session is started and verifies that an admin is logged in.
 * If the user is not logged in, it redirects them to the sign-in page.
 */

// If a session has not already been started, start one.
// Using session_status() prevents errors if a session is already active.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security check: If the 'admin_loggedin' session variable is not set or not true,
// the user is not authenticated.
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    // Redirect the user to the sign-in page.
    header("location: signin.php");
    // Terminate the script immediately to prevent any further code execution.
    exit;
}
?>
