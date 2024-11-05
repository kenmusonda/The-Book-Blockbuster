<?php
require 'session.php';
checkSession('Admin');
require '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ensure this matches the link parameter

    try {
        $sql = "DELETE FROM Users WHERE user_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        // Check if any row was deleted
        if ($stmt->rowCount() > 0) {
            $_SESSION['feedback'] = "User deleted successfully!";
        } else {
            $_SESSION['feedback'] = "No user found with that ID.";
        }
    } catch (PDOException $e) {
        $_SESSION['feedback'] = "Error deleting user: " . $e->getMessage();
    }
} else {
    $_SESSION['feedback'] = "Invalid user ID.";
}

header('Location: ../public/user_management.php');
exit();
?>