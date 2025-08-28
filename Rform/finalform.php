<?php

session_start();
echo "<pre>";
// Display all session data for debugging purposes
print_r($_SESSION['form1_data']);
print_r($_SESSION['form2_data']);
print_r($_SESSION['option_data']['dormitory_preference']);
print_r($_SESSION['student_photo']);


?>