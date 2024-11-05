<?php
// includes/logout.php
session_start();
session_destroy(); // Destroy the session
header("Location: ../public/login.php"); // Redirect to login page
exit();
?>