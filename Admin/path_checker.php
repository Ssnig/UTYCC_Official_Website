<?php
// path_checker.php
// Upload this file to your 'admin' directory and open it in your browser.
// Example: https://yourdomain.com/admin/path_checker.php

header('Content-Type: text/plain; charset=utf-8');

echo "Server Path and Permissions Checker\n";
echo "===================================\n\n";
echo "This script checks if the required folders exist with the correct case-sensitivity.\n";
echo "Current Directory: " . getcwd() . "\n\n";

// --- Folder paths to check (all lowercase as per your code) ---
$folders_to_check = [
    '../rform',
    '../uploads_activity',
    '../img'
];

foreach ($folders_to_check as $folder_path) {
    echo "Checking for folder: '$folder_path' ...\n";

    if (file_exists($folder_path)) {
        if (is_dir($folder_path)) {
            echo "  [SUCCESS] Found directory at '$folder_path'.\n";

            // Check permissions
            $permissions = substr(sprintf('%o', fileperms($folder_path)), -4);
            echo "  - Permissions: $permissions\n";

            // Check if writable (important for uploads_activity)
            if (is_writable($folder_path)) {
                echo "  - Status: Writable (OK)\n";
            } else {
                echo "  - Status: NOT WRITABLE. This will cause upload/delete to fail. Please set permissions to 755 or 775.\n";
            }

        } else {
            echo "  [FATAL ERROR] A file exists at '$folder_path', but it is NOT a directory.\n";
        }
    } else {
        echo "  [FATAL ERROR] NOT FOUND. The folder '$folder_path' does not exist. This is the cause of your problem. Check your hosting File Manager for the correct case-sensitivity (e.g., is it 'rform' or 'Rform'?) and rename it to be all lowercase.\n";
    }
    echo "--------------------------------------------------\n";
}
?>
