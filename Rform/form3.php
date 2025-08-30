<?php
session_start();
require_once "db.php";

// Check sessions
if (!isset($_SESSION['form1_data']) || !isset($_SESSION['form2_data']) || !isset($_SESSION['option_data'])) {
    header("Location: form1.php");
    exit;
}

$form1 = $_SESSION['form1_data'];
$form2 = $_SESSION['form2_data'];
$option = $_SESSION['option_data'];

// Insert into table1
$stmt = $pdo->prepare("
    INSERT INTO table1 
    (student_name, seat_no, nrc, dob, father_name, mother_name, address, phone, preferences, dormitory) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $form1['student_name_mm'],
    $form1['seat_no'],
    $form1['student_nrc'],
    $form1['student_dob'],
    $form1['father_name_mm'],
    $form1['mother_name_mm'],
    $form1['student_address'],
    $form1['student_phone'],
    json_encode($form2['preferences']),
    $option['dormitory_preference']
]);

$main_form_id = $pdo->lastInsertId();

// If hostel option = 1 → insert into table2
if ($option['dormitory_preference'] == '1' && isset($_SESSION['student_photo'])) {
    $stmt2 = $pdo->prepare("INSERT INTO table2 (main_form_id, student_photo) VALUES (?, ?)");
    $stmt2->execute([$main_form_id, $_SESSION['student_photo']]);
}

// Clear session
session_destroy();
?>

<script>
    alert("✅ Registration completed successfully!");
    // window.location.href = "home.php"; 
    // redirect to success page
</script>
