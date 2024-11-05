<?php
// includes/return_book.php
require '../config/db.php';
require '../includes/session.php';
checkSession('Customer'); // Allow only customers to access this page

if (isset($_POST['rental_id'])) {
    $rental_id = $_POST['rental_id'];

    try {
        // Update the rental status to "Returned"
        $sql = "UPDATE Rentals SET status = 'Returned' WHERE rental_id = :rental_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':rental_id' => $rental_id]);

        // Get the book ID related to this rental
        $book_id_sql = "SELECT book_id FROM Rentals WHERE rental_id = :rental_id";
        $stmt = $pdo->prepare($book_id_sql);
        $stmt->execute([':rental_id' => $rental_id]);
        $book_id = $stmt->fetchColumn();

        // Update the book availability in the Books table
        $sql = "UPDATE Books SET availability = 'Available' WHERE book_id = :book_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':book_id' => $book_id]);

        // Redirect back to the customer dashboard with a success message
        header("Location: ../public/dashboard_customer.php?message=Book returned successfully!");
        exit;
    } catch (PDOException $e) {
        echo "<div class='error-message'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
} else {
    echo "<div class='error-message'>Invalid request.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        /* Custom CSS for returning books */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <title>Return Book</title>
</head>
<body>

<div class="container mt-4">
    <?php if (isset($_GET['message'])): ?>
        <div class="success-message"><?php echo htmlspecialchars($_GET['message']); ?></div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>