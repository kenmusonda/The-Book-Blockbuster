<?php
// includes/session.php

session_start();

function checkSession($role) {
    if (!isset($_SESSION['user_id'])) {
        // Not logged in, redirect to login page
        header("Location: ../public/login.php");
        exit();
    } elseif ($_SESSION['user_type'] !== $role) {
        // Logged in but does not have the required role, redirect to login page
        header("Location: ../public/login.php");
        exit();
    }
}
?>