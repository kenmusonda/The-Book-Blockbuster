<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rental_id'])) {
    $rental_id = $_POST['rental_id'];

    // Update rental status to 'Returned'
    $stmt = $pdo->prepare("UPDATE Rentals SET status = 'Returned' WHERE id = :rental_id");
    $stmt->execute(['rental_id' => $rental_id]);

    // Redirect back to rental management page with success message
    header("Location: rental_management.php?message=Book returned successfully.");
    exit();
}
?>