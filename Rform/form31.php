<?php
session_start();
// $form1_data = $_SESSION['form1_data'];
echo '<pre>';
// print_r($form1_data);

if (isset($_SESSION['form1_data'])) {
    print_r($_SESSION['form1_data']);
} else {
    echo "No data found from Form 1.";
}

echo "\n\n--- FORM 2 DATA ---\n\n";

// Check if form 2 data exists and print it
if (isset($_SESSION['form2_data'])) {
    print_r($_SESSION['form2_data']);
} else {
    echo "No data found from Form 2.";
}

?>
?>