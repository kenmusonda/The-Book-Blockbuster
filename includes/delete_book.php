<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM Books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    $_SESSION['feedback'] = "Book deleted successfully!";
} else {
    $_SESSION['feedback'] = "Invalid book ID.";
}

header('Location: ../public/manage_books.php');
exit();
?>