<?php
  // --- SUPER ADMIN CHECK ---
  // Initialize the variable as false
  $is_super_admin_flag = false;
  
  // If session variable 'is_super_admin' exists and is true, set the flag
  if (isset($_SESSION['is_super_admin']) && $_SESSION['is_super_admin'] === true) {
      $is_super_admin_flag = true;
  }
?>
