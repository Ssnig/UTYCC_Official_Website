<?php

session_start();
echo "<pre>";
// Display all session data for debugging purposes
print_r($_SESSION['form1_data']);

print_r($_SESSION['form2_data']);
// option data 1 is hostel preference and 2 is final preference
print_r($_SESSION['option_data']['dormitory_preference']);

print_r($_SESSION['student_photo']);


?>

<!-- 

form1 to form2 to option (if 1 go to hostel then go to final page else go to final page)
 
-->